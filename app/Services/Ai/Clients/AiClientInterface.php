<?php

declare(strict_types=1);

namespace App\Services\Ai\Clients;

use Psr\Http\Message\ResponseInterface;

interface AiClientInterface
{
    public function send(string $prompt): ResponseInterface;
}
