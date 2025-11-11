<?php

declare(strict_types=1);

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ActorCreateController extends Controller
{
    public function __invoke(): View
    {
        return view('actors.create');
    }
}
