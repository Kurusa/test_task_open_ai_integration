<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActorStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('actors')->where(function ($query) {
                    return $query->where('description', $this->input('description'));
                }),
            ],
            'description' => 'required|string',
        ];
    }
}
