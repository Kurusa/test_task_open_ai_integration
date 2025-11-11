<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (Throwable $exception, $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => class_basename($exception),
                    'error' => $exception->getMessage(),
                ], $exception->getCode() ?: 500);
            }

            return parent::render($request, $exception);
        });
    }
}
