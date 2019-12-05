<?php

namespace Bolt\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Bolt\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Bolt\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => \Bolt\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can'        => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest'      => \Bolt\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'video'      => \Bolt\Http\Middleware\ValidateVideo::class,
        'avatar'     => \Bolt\Http\Middleware\ValidateAvatar::class,
        'comment'    => \Bolt\Http\Middleware\ValidateComment::class,
        'owner'      => \Bolt\Http\Middleware\CheckOwnership::class,
        'category'   => \Bolt\Http\Middleware\ValidateCategory::class,
        'available'  => \Bolt\Http\Middleware\ModelIsAvailable::class,
        'userUpdate' => \Bolt\Http\Middleware\ValidateUserUpdate::class,
    ];
}
