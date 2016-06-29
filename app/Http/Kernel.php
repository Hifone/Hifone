<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
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
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Hifone\Http\Middleware\Pjax::class,
        ],
        'api' => [
            \Hifone\Http\Middleware\Acceptable::class,
            \Hifone\Http\Middleware\Timezone::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'          => \Hifone\Http\Middleware\Authenticate::class,
        'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.api'      => \Hifone\Http\Middleware\ApiAuthentication::class,
        'guest'         => \Hifone\Http\Middleware\RedirectIfAuthenticated::class,
        'localize'      => \Hifone\Http\Middleware\Localize::class,
        'ready'         => \Hifone\Http\Middleware\ReadyForUse::class,
        'not_installed' => \Hifone\Http\Middleware\RedirectIfInstallCompleted::class,
        'role'          => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission'    => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability'       => \Zizaco\Entrust\Middleware\EntrustAbility::class,
    ];
}
