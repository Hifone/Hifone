<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the dashboard routes class.
 */
class DashboardRoutes
{
    /**
     * Define the dashboard routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['middleware' => ['web', 'auth', 'role:Admin|Founder'], 'prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard.'], function (Registrar $router) {
            $router->get('/', [
                'as'   => 'index',
                'uses' => 'DashboardController@index',
            ]);

            // Settings
            $router->group(['as' => 'settings.', 'prefix' => 'settings'], function (Registrar $router) {
                $router->get('general', [
                    'as'   => 'general',
                    'uses' => 'SettingsController@showGeneralView',
                ]);
                $router->get('analytics', [
                    'as'   => 'analytics',
                    'uses' => 'SettingsController@showAnalyticsView',
                ]);
                $router->get('security', [
                    'as'   => 'security',
                    'uses' => 'SettingsController@showSecurityView',
                ]);
                $router->get('theme', [
                    'as'   => 'theme',
                    'uses' => 'SettingsController@showThemeView',
                ]);
                $router->get('stylesheet', [
                    'as'   => 'stylesheet',
                    'uses' => 'SettingsController@showStylesheetView',
                ]);
                $router->get('customization', [
                    'as'   => 'customization',
                    'uses' => 'SettingsController@showCustomizationView',
                ]);
                $router->get('aboutus', [
                    'as'   => 'aboutus',
                    'uses' => 'SettingsController@showAboutusView',
                ]);
                $router->post('/', 'SettingsController@postSettings');
            });

            // Dashboard API
            $router->group(['prefix' => 'api'], function (Registrar $router) {
                $router->post('link/order', 'ApiController@postUpdateLinkOrder');
                $router->post('section/order', 'ApiController@postUpdateSectionOrder');
                $router->post('node/order', 'ApiController@postUpdateNodeOrder');
                $router->post('adspace/order', 'ApiController@postUpdateAdspaceOrder');
            });
        });

        //Resources
        $router->group(['middleware' => ['web', 'auth', 'role:Admin|Founder'], 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function (Registrar $router) {
            // Advertisements
            $router->resource('adblock', 'AdblockController');
            $router->resource('adspace', 'AdspaceController');
            $router->resource('advertisement', 'AdvertisementController');
             // Photos
            $router->resource('photo', 'PhotoController');
            // Pages
            $router->resource('page', 'PageController');
            // Sections
            $router->resource('section', 'SectionController');
            // Nodes
            $router->resource('node', 'NodeController');
            // Threads
            $router->resource('thread', 'ThreadController');
            $router->resource('reply', 'ReplyController');
            $router->resource('tip', 'TipController');
            $router->resource('link', 'LinkController');
            // Users
            $router->resource('user', 'UserController');
        });
    }
}
