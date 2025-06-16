<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Console\Scheduling\Schedule;


class Kernel extends HttpKernel
{
    /**
     * Middlewares globales (se ejecutan en cada solicitud)
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        \Illuminate\Http\Middleware\TrustHosts::class,
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Http\Middleware\TrimStrings::class,
        \Illuminate\Http\Middleware\ConvertEmptyStringsToNull::class,
        // \Illuminate\Session\Middleware\StartSession::class,
    ];

    /**
     * Middlewares de grupo (por defecto en Laravel)
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\MultiSession::class, // 🔹 Agregamos nuestro middleware aquí
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\VerifyCsrfToken::class,

        ],

        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middlewares individuales (se pueden asignar a rutas específicas)
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // 🔹 Middlewares personalizados por rol
        'profesor' => \App\Http\Middleware\ProfesorMiddleware::class,
        'estudiante' => \App\Http\Middleware\EstudianteMiddleware::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('preguntas:eliminar-antiguas')->daily();
    }
    

}
