<?php

declare(strict_types=1);

namespace App\Services\Ai\Clients;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

final readonly class GeminiClient implements AiClientInterface
{
    public function __construct() {}

    public function send(string $prompt): ResponseInterface
    {
        $dummyBody = json_encode([
            'candidates' => [[
                'content' => [
                    'parts' => [[
                        'text' => json_encode([
                            'first_name' => 'Stub',
                            'last_name' => 'Gemini',
                            'address' => 'N/A',
                            'email' => 'gemini@example.com',
                            'description' => $prompt,
                        ]),
                    ]],
                ],
            ]],
        ]);

        return new Response(200, [], $dummyBody);
    }
}
