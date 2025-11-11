<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\ActorData;
use App\Models\Actor;
use Illuminate\Support\Collection;

class ActorRepository
{
    public function all(): Collection
    {
        return Actor::query()
            ->latest()
            ->get(['first_name', 'address', 'gender', 'height']);
    }

    public function create(ActorData $actorData): Actor
    {
        return Actor::create($actorData->toArray());
    }
}
