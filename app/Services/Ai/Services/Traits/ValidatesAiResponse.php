<?php

declare(strict_types=1);

namespace App\Services\Ai\Services\Traits;

use App\Exceptions\AiIncompleteDataException;

trait ValidatesAiResponse
{
    protected function ensureRequiredFields(array $actorPayload): void
    {
        foreach (['first_name', 'last_name', 'address'] as $field) {
            if (empty($actorPayload[$field])) {
                throw AiIncompleteDataException::missingFields();
            }
        }
    }
}
