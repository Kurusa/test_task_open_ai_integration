<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Exception;

class AiIncompleteDataException extends Exception
{
    public static function missingFields(): self
    {
        return new self(
            'Please add first name, last name, and address to your description.',
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }
}
