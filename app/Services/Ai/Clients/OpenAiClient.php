<?php

declare(strict_types=1);

namespace App\Services\Ai\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

readonly class OpenAiClient implements AiClientInterface
{
    public function __construct(private Client $client, private string $apiKey) {}

    /**
     * @throws GuzzleException
     */
    public function send(string $prompt): ResponseInterface
    {
        return $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a precise data extraction assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.2,
            ],
            'http_errors' => false,
            'timeout' => 15,
        ]);
    }
}
