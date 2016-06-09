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

use Exception;
use Hifone\Config\Repository;
use Hifone\Models\Setting as SettingModel;
use Illuminate\Support\ServiceProvider;

/**
 * This is the config service provider class.
 */
class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        try {
            // Get the default settings.
            $defaultSettings = $this->app->config->get('setting');

            // Get the configured settings.
            $appSettings = $this->app->setting->all();

            // Merge the settings
            $settings = array_merge($defaultSettings, $appSettings);

            $this->app->config->set('setting', $settings);
        } catch (Exception $e) {
            //
        }

        if ($appDomain = $this->app->config->get('setting.app_domain')) {
            $this->app->config->set('app.url', $appDomain);
        }

        if ($appLocale = $this->app->config->get('setting.app.locale')) {
            $this->app->config->set('app.locale', $appLocale);
            $this->app->translator->setLocale($appLocale);
        }

        if ($appTimezone = $this->app->config->get('setting.app_timezone')) {
            $this->app->config->set('cachet.timezone', $appTimezone);
        }

        $allowedOrigins = $this->app->config->get('cors.defaults.allowedOrigins');

        if ($allowedDomains = $this->app->config->get('setting.allowed_domains')) {
            $domains = explode(',', $allowedDomains);
            foreach ($domains as $domain) {
                $allowedOrigins[] = $domain;
            }
        } else {
            $allowedOrigins[] = $this->app->config->get('app.url');
        }

        $this->app->config->set('cors.paths.api/v1/*.allowedOrigins', $allowedOrigins);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('setting', function () {
            return new Repository(new SettingModel());
        });

        $this->app->alias('setting', Repository::class);
    }
}
