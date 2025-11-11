<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Actors;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActorStoreRequest;
use App\Http\Resources\ActorResource;
use App\Repositories\ActorRepository;
use App\Services\Ai\Services\AiServiceInterface;
use Illuminate\Http\JsonResponse;

class ActorStoreController extends Controller
{
    public function __construct(
        private readonly AiServiceInterface $aiService,
        private readonly ActorRepository    $actorRepository,
    ) {
    }

    public function __invoke(ActorStoreRequest $request): ActorResource|JsonResponse
    {
        $actorData = $this->aiService->process(
            $request->get('description'),
            $request->get('email')
        );

        $actor = $this->actorRepository->create($actorData);

        return ActorResource::make($actor);
    }
}
