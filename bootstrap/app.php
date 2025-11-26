<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\CorsMiddleware; // Asegúrate de importar tu middleware
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Aquí no usamos 'add'. En su lugar, agregamos el middleware directamente a los grupos
        $middleware->api[] = CorsMiddleware::class;  // Esto lo agrega a las rutas 'api'
        // Si quieres que sea global, usa $middleware->global[] = CorsMiddleware::class;
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
