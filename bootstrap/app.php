<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureUserIsTrainer;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Register Trainer Middleware
        $middleware->alias([
            'trainer' => EnsureUserIsTrainer::class,
        ]);

        // Redirect authenticated users away from login/register
        $middleware->redirectUsersTo(function (Request $request) {

            if ($request->user()?->role === 'trainer') {
                return route('trainer.dashboard');
            }

            return route('player.dashboard');

        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) =>
                $request->is('api/*') || $request->expectsJson(),
        );

    })->create();
