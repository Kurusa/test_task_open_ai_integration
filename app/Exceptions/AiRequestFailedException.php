<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\AiDriver;
use RuntimeException;

class AiRequestFailedException extends RuntimeException
{
    public static function invalidJson(AiDriver $provider): self
    {
        return new self(sprintf('%s returned invalid JSON.', strtoupper($provider->value)), 500);
    }

    public static function withStatus(int $status, AiDriver $provider): self
    {
        return new self(sprintf('%s returned HTTP %d.', strtoupper($provider->value), $status), $status);
    }
}
