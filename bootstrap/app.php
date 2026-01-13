<?php

//use Illuminate\Foundation\Application;
//use Illuminate\Foundation\Configuration\Exceptions;
//use Illuminate\Foundation\Configuration\Middleware;
//use App\Http\Middleware\RoleMiddleware;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    // ルーティングの設定
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        //　ミドルウェアの設定
        $middleware->validateCsrfTokens(except: [
            'stripe/*',
        ]);

        //　ミドルウェアの設定
        $middleware->alias([
            'admin' => RoleMiddleware::class,

        ]);

        //　ミドルウェアの設定
        $middleware->remove([
            TrimStrings::class,
            ConvertEmptyStringsToNull::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //　例外の設定
    })->create();
