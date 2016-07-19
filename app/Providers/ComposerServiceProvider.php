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

use Hifone\Composers\AppComposer;
use Hifone\Composers\CurrentUserComposer;
use Hifone\Composers\LocaleComposer;
use Hifone\Composers\SidebarComposer;
use Hifone\Composers\TimezoneComposer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * This is the config service provider class.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @param \Illuminate\Contracts\View\Factory $factory
     */
    public function boot(Factory $factory)
    {
        $factory->composer('*', AppComposer::class);
        $factory->composer('*', CurrentUserComposer::class);
        $factory->composer('partials.sidebar', SidebarComposer::class);

        // Locale
        $factory->composer([
            'install.*',
            'users.edit', ], LocaleComposer::class);

        //Timezone
        $factory->composer([
            'install.*', ], TimezoneComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
