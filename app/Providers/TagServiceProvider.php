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

use Hifone\Services\Tag\AddTag;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
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
        $this->app->singleton('tag', function($app) {
            return new AddTag();
        });
    }

    /**
    * Get the services providerd by the provider.
    *
    * @return array
    */
    public function provides()
    {
        return [
            'tag'
        ];
    }

}