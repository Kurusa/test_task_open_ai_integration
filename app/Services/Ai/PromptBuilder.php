<?php

declare(strict_types=1);

namespace App\Services\Ai;

final class PromptBuilder
{
    public function forActor(string $description, string $email): string
    {
        $template = config('ai.prompts.actor');

        return strtr($template, [
            '{{email}}' => $email,
            '{{description}}' => $description,
        ]);
    }

    public function templateOnly(): string
    {
        return config('ai.prompts.actor');
    }
}
