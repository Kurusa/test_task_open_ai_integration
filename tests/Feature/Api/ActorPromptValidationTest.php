<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Tests\TestCase;

class ActorPromptValidationTest extends TestCase
{
    public function test_it_returns_prompt_template(): void
    {
        $response = $this->getJson(route('api.actors.prompt-validation'));

        $response->assertOk()
            ->assertExactJson([
                'message' => config('ai.prompts.actor'),
            ]);
    }
}
