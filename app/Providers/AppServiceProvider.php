<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\AiDriver;
use App\Exceptions\MissingAiApiKeyException;
use App\Services\Ai\AiServiceFactory;
use App\Services\Ai\Clients\AiClientInterface;
use App\Services\Ai\Clients\GeminiClient;
use App\Services\Ai\Clients\OpenAiClient;
use App\Services\Ai\PromptBuilder;
use App\Services\Ai\Services\AiServiceInterface;
use App\Services\Ai\Services\GeminiService;
use App\Services\Ai\Services\OpenAiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerAiClient(OpenAiClient::class, 'openai');
        $this->registerAiClient(GeminiClient::class, 'gemini');

        $this->app->when(OpenAiService::class)
            ->needs(AiClientInterface::class)
            ->give(OpenAiClient::class);

        $this->app->when(GeminiService::class)
            ->needs(AiClientInterface::class)
            ->give(GeminiClient::class);

        $this->app->singleton(OpenAiService::class, fn($app) => new OpenAiService(
            promptBuilder: $app->make(PromptBuilder::class),
            client: $app->make(OpenAiClient::class)
        ));

        $this->app->singleton(GeminiService::class, fn($app) => new GeminiService(
            promptBuilder: $app->make(PromptBuilder::class),
            client: $app->make(GeminiClient::class)
        ));

        $this->app->singleton(AiServiceFactory::class);

        $this->app->bind(AiServiceInterface::class, function ($app) {
            $factory = $app->make(AiServiceFactory::class);
            $driver = AiDriver::from(config('ai.default', AiDriver::OPENAI->value));
            return $factory->make($driver);
        });
    }

    private function registerAiClient(
        string $class,
        string $driver,
    ): void {
        $this->app->singleton($class, function ($app) use ($driver, $class) {
            $apiKey = config("ai.drivers.$driver.key");
            if (empty($apiKey)) {
                throw MissingAiApiKeyException::for($driver);
            }

            return new $class(
                client: $app->make(Client::class),
                apiKey: $apiKey
            );
        });
    }
}
