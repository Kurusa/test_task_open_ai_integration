<?php

declare(strict_types=1);

use App\Enums\AiDriver;

return [
    'default' => env('AI_DRIVER', AiDriver::OPENAI->value),

    'drivers' => [
        AiDriver::OPENAI->value => [
            'key' => env('OPENAI_API_KEY'),
            'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
            'endpoint' => env('OPENAI_ENDPOINT', 'https://api.openai.com/v1/'),
        ],

        AiDriver::GEMINI->value => [
            'key' => env('GEMINI_API_KEY'),
            'model' => env('GEMINI_MODEL', 'gemini-pro'),
            'endpoint' => env('GEMINI_ENDPOINT', 'https://generativelanguage.googleapis.com'),
        ],
    ],

    'prompts' => [
        'actor' => <<<PROMPT
You will receive a description of an actor.
Extract and return a JSON object with these fields:
first_name, last_name, address, height, weight, gender, age, email, description.

Use the provided email and description as values for "email" and "description".

Input:
Email: {{email}}
Description: {{description}}

Return only valid JSON.
PROMPT,
    ],
];
