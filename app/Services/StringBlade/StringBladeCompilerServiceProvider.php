<?php 
namespace Hifone\Services\StringBlade;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;

class StringBladeCompilerServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $config_path = __DIR__ . '/../../../config/stringblade.php';
        $this->publishes([$config_path => config_path('stringblade.php')], 'config');

        $views_path = __DIR__ . '/../../../config';
        $this->publishes([$views_path => storage_path('app/stringblade')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config_path = __DIR__ . '/../../../config/stringblade.php';
        $this->mergeConfigFrom($config_path, 'stringblade');

        $this->app['stringblade'] = $this->app->share(function ($app) {
            $cache_path = storage_path('app/stringblade');

            $string_view = new StringBlade($app['config']);
            $compiler = new StringBladeCompiler($app['files'], $cache_path, $app['config'], $app);
            $string_view->setEngine(new CompilerEngine($compiler));

            return $string_view;
        });
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('StringBlade', 'Hifone\Services\StringBlade\Facades\StringBlade');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}