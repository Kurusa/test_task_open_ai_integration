<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Actors;

use App\Http\Controllers\Controller;
use App\Services\Ai\PromptBuilder;
use Illuminate\Http\JsonResponse;

class ActorPromptValidationController extends Controller
{
    public function __construct(private readonly PromptBuilder $promptBuilder)
    {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'message' => $this->promptBuilder->templateOnly(),
        ]);
    }
}
