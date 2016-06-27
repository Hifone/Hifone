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

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Repositories to bind.
     *
     * @var array
     */
    private $eloquent = [
        'Thread',
        'Tag',
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bind('', $this->eloquent);
    }

    /**
     * @param $folder
     * @param $repositories
     */
    private function bind($folder, $repositories)
    {
        if ($folder) {
            $folder = '\\'.$folder;
        }

        foreach ($repositories as $key => $name) {
            if (is_array($name)) {
                $this->bind($key, $name);
            } else {
                $repository = "${name}Repository";

                $this->app->bind(
                    "Hifone\\Repositories\\Contracts$folder\\${repository}Interface",
                    "Hifone\\Repositories\\Eloquent$folder\\$repository"
                );
                /*
                $this->app->bind(
                    $repository,
                    "Hifone\\Repositories\\Eloquent$folder\\$repository"
                );
                */
            }
        }
    }
}
