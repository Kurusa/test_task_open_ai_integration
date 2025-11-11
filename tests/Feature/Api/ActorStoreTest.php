<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\DTO\ActorData;
use App\Models\Actor;
use App\Services\Ai\Services\AiServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActorStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_actor_and_returns_resource(): void
    {
        $payload = [
            'email' => 'test@example.com',
            'description' => 'A tall actor from NY.',
        ];

        $mockedActorData = new ActorData(
            email: $payload['email'],
            description: $payload['description'],
            first_name: 'John',
            last_name: 'Doe',
            address: '123 Main St',
            height: '180',
            weight: '75',
            gender: 'male',
            age: 30
        );

        $this->mock(AiServiceInterface::class)
            ->shouldReceive('process')
            ->once()
            ->with($payload['description'], $payload['email'])
            ->andReturn($mockedActorData);

        $this->postJson(route('api.actors.store'), $payload)
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'first_name' => 'John',
                    'address' => '123 Main St',
                    'gender' => 'male',
                    'height' => '180',
                ],
            ]);

        $this->assertDatabaseHas('actors', [
            'email' => 'test@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    public function test_it_fails_validation_when_email_is_missing(): void
    {
        $payload = [
            'description' => 'Some text',
        ];

        $this->postJson(route('api.actors.store'), $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_fails_when_duplicate_email_description_combination_exists(): void
    {
        Actor::factory()->create([
            'email' => 'dup@example.com',
            'description' => 'duplicate actor',
        ]);

        $this->postJson(route('api.actors.store'), [
            'email' => 'dup@example.com',
            'description' => 'duplicate actor',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_fails_when_email_is_invalid(): void
    {
        $payload = [
            'email' => 'invalid',
            'description' => 'valid text',
        ];

        $this->postJson(route('api.actors.store'), $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }
}
