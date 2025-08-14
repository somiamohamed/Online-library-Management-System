<?php

namespace App\Http;

use App\Http\Middleware\CheckAdmin;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // مصفوفة الـ global middleware الافتراضية
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // ...
        ],

        'api' => [
            // ...
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth'       => \App\Http\Middleware\CheckAdmin::class,
        'verified'   => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        
        'check.admin' => \App\Http\Middleware\CheckAdmin::class,
    ];
}
