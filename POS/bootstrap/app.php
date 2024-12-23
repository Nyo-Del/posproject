<?php

use App\Http\Middleware\Adminmiddleware;
use App\Http\Middleware\Superadminmiddleware;
use App\Http\Middleware\Usermiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
        ->withMiddleware(function (Middleware $middleware) {
            $middleware->alias( [
                'admin' => Adminmiddleware::class,
                'user' => Usermiddleware::class,
                'superadmin' =>Superadminmiddleware::class,
            ] );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
