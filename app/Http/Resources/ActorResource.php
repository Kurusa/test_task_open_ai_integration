<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Actor
 */
class ActorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'address' => $this->address,
            'gender' => $this->gender,
            'height' => $this->height,
        ];
    }
}
