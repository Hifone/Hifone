<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Providers;

use Hifone\Services\Notifier\Notifier;
use Illuminate\Support\ServiceProvider;

class NotifierServiceProvider extends ServiceProvider
{
    /**
     * Indicats if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the parser provider.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the parser services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('notifier', function ($app) {
            return new Notifier();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'notifier',
        ];
    }
}
