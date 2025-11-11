<?php

declare(strict_types=1);

namespace App\Services\Ai\Services;

use App\DTO\ActorData;

interface AiServiceInterface
{
    /**
     * Process raw actor description and return structured fields.
     *
     * @param string $description
     * @param string $email
     *
     * @return ActorData
     */
    public function process(string $description, string $email): ActorData;
}
