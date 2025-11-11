<?php

declare(strict_types=1);

namespace App\Services\Ai\Services;

use App\DTO\ActorData;

final readonly class GeminiService implements AiServiceInterface
{
    public function process(string $description, string $email): ActorData
    {
        return new ActorData(
            email: $email,
            description: $description,
            first_name: 'Stub',
            last_name: 'Gemini',
            address: 'N/A',
            height: null,
            weight: null,
            gender: null,
            age: null
        );
    }
}
