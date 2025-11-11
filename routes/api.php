<?php

use App\Http\Controllers\Api\Actors\ActorPromptValidationController;
use App\Http\Controllers\Api\Actors\ActorStoreController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'actors'], function () {
    Route::post('/', ActorStoreController::class)->name('api.actors.store');

    Route::get('/prompt-validation', ActorPromptValidationController::class)
        ->name('api.actors.prompt-validation');
});
