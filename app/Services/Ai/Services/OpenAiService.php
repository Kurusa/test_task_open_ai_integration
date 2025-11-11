<?php

declare(strict_types=1);

namespace App\Services\Ai\Services;

use App\DTO\ActorData;
use App\Enums\AiDriver;
use App\Exceptions\AiIncompleteDataException;
use App\Exceptions\AiRequestFailedException;
use App\Services\Ai\Clients\AiClientInterface;
use App\Services\Ai\PromptBuilder;
use App\Services\Ai\Services\Traits\ValidatesAiResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class OpenAiService implements AiServiceInterface
{
    use ValidatesAiResponse;

    public function __construct(
        private PromptBuilder     $promptBuilder,
        private AiClientInterface $client,
    ) {
    }

    /**
     * @throws AiRequestFailedException
     * @throws AiIncompleteDataException
     */
    public function process(string $description, string $email): ActorData
    {
        $prompt = $this->promptBuilder->forActor($description, $email);
        $response = $this->client->send($prompt);

        if ($response->getStatusCode() >= Response::HTTP_BAD_REQUEST) {
            throw AiRequestFailedException::withStatus(
                $response->getStatusCode(),
                AiDriver::OPENAI,
            );
        }

        $actorPayload = $this->parseJsonContent((string)$response->getBody());

        $this->ensureRequiredFields($actorPayload);

        return ActorData::fromArray($actorPayload);
    }

    protected function parseJsonContent(string $body): array
    {
        $decoded = json_decode($body, true);
        $content = $decoded['choices'][0]['message']['content'] ?? '';

        if (preg_match('/```json\s*(\{.*?\})\s*```/s', $content, $matches)) {
            $content = $matches[1];
        }

        $normalized = trim(preg_replace('/\s+/', ' ', $content));
        $normalized = trim($normalized, " \t\n\r\0\x0B\"");

        $payload = json_decode($normalized, true);

        if (!is_array($payload)) {
            throw AiRequestFailedException::invalidJson(AiDriver::OPENAI);
        }

        return $payload;
    }
}
