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

use Hifone\Console\Commands\InstallCommand;
use Hifone\Console\Commands\ResetCommand;
use Hifone\Console\Commands\SeedCommand;
use Hifone\Console\Commands\Subscribers\CommandSubscriber;
use Hifone\Console\Commands\UpdateCommand;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands('command.hifone_update', 'command.hifone_install', 'command.hifone_reset', 'command.hifone_seed');

        $this->setupListeners();
    }

    /**
     * Setup the listeners.
     *
     * @return void
     */
    protected function setupListeners()
    {
        $subscriber = $this->app->make(CommandSubscriber::class);

        $this->app->events->subscribe($subscriber);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUpdateCommand();
        $this->registerInstallCommand();
        $this->registerResetCommand();
        $this->registerSeedCommand();
    }

    /**
     * Register the updated command class.
     *
     * @return void
     */
    protected function registerUpdateCommand()
    {
        $this->app->singleton('command.hifone_update', function (Container $app) {
            $events = $app['events'];

            return new UpdateCommand($events);
        });
    }

    /**
     * Register the install command class.
     *
     * @return void
     */
    protected function registerInstallCommand()
    {
        $this->app->singleton('command.hifone_install', function (Container $app) {
            $events = $app['events'];

            return new InstallCommand($events);
        });
    }

    /**
     * Register the reset command class.
     *
     * @return void
     */
    protected function registerResetCommand()
    {
        $this->app->singleton('command.hifone_reset', function (Container $app) {
            $events = $app['events'];

            return new ResetCommand($events);
        });
    }

    /**
     * Register the seed command class.
     *
     * @return void
     */
    protected function registerSeedCommand()
    {
        $this->app->singleton('command.hifone_seed', function (Container $app) {
            $events = $app['events'];

            return new SeedCommand($events);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'command.hifone_update',
            'command.hifone_install',
            'command.hifone_reset',
            'command.hifone_seed',
        ];
    }
}
