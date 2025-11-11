<?php

declare(strict_types=1);

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use App\Repositories\ActorRepository;
use Illuminate\Contracts\View\View;

class ActorIndexController extends Controller
{
    public function __construct(private readonly ActorRepository $actorRepository)
    {
    }

    public function __invoke(): View
    {
        $actors = $this->actorRepository->all();

        return view('actors.index', compact('actors'));
    }
}
