<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Actors\ActorCreateController;
use App\Http\Controllers\Actors\ActorIndexController;

Route::get('/', ActorCreateController::class)->name('actors.create');
Route::get('/actors', ActorIndexController::class)->name('actors.index');
