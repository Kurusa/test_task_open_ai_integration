<?php

declare(strict_types=1);

namespace App\Services\Ai;

use App\Enums\AiDriver;
use App\Services\Ai\Services\AiServiceInterface;
use App\Services\Ai\Services\GeminiService;
use App\Services\Ai\Services\OpenAiService;

readonly class AiServiceFactory
{
    public function make(AiDriver $driver): AiServiceInterface
    {
        return match ($driver) {
            AiDriver::OPENAI => app(OpenAiService::class),
            AiDriver::GEMINI => app(GeminiService::class),
        };
    }
}
