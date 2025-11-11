<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class MissingAiApiKeyException extends Exception
{
    public static function for(string $driver): self
    {
        return new self(strtoupper($driver) . ' API key is missing or not configured.');
    }
}
