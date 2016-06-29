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
use Hifone\Composers\Dashboard\AdvertisementMenuComposer;
use Hifone\Composers\Dashboard\ContentMenuComposer;
use Hifone\Composers\Dashboard\NodeMenuComposer;
use Hifone\Composers\Dashboard\SettingComposer;
use Hifone\Composers\Dashboard\UserMenuComposer;
use Hifone\Composers\LocaleComposer;
use Hifone\Composers\SidebarComposer;
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

        $factory->composer([
            'install.*',
            'users.edit',
            'dashboard.settings.*', ], LocaleComposer::class);

        // 广告
        $factory->composer([
            'dashboard.adblocks.*',
            'dashboard.advertisements.*',
            'dashboard.adspaces.*', ], AdvertisementMenuComposer::class);

        //内容
        $factory->composer([
            'dashboard.threads.*',
            'dashboard.replies.*',
            'dashboard.photos.*',
            'dashboard.pages.*', ], ContentMenuComposer::class);

        // 节点
        $factory->composer(['dashboard.nodes.*', 'dashboard.sections.*'], NodeMenuComposer::class);
        $factory->composer(['dashboard.users.*'], UserMenuComposer::class);
        $factory->composer([
            'dashboard.tips.*',
            'dashboard.links.*',
            'dashboard.locations.*',
            'dashboard.settings.*', ], SettingComposer::class);
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
