<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use URL;

class SettingsController extends Controller
{
    /**
     * Creates a new settings controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'general',
            'sub_title'    => '',
        ]);

        if (!Request::isMethod('post')) {
            Session::flash('redirect_to', app('url')->full());
        }
    }

    /**
     * Shows the settings general view.
     *
     * @return \Illuminate\View\View
     */
    public function showGeneralView()
    {
        return View::make('dashboard.settings.general')
            ->withPageTitle(trans('dashboard.settings.general.general').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('general')
            ->withRawSiteAbout(Config::get('setting.site_about'));
    }

    /**
     * Shows the settings localization view.
     *
     * @return \Illuminate\View\View
     */
    public function showLocalizationView()
    {
        return View::make('dashboard.settings.localization')
            ->withPageTitle(trans('dashboard.settings.localization.localization').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('localization')
            ->withRawSiteAbout(Config::get('setting.site_about'));
    }

    /**
     * Shows the settings customization view.
     *
     * @return \Illuminate\View\View
     */
    public function showCustomizationView()
    {
        return View::make('dashboard.settings.customization')
            ->withPageTitle(trans('dashboard.settings.customization.customization').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('customization');
    }

    /**
     * Shows the settings customization view.
     *
     * @return \Illuminate\View\View
     */
    public function showStylesheetView()
    {
        return View::make('dashboard.settings.stylesheet')
            ->withPageTitle(trans('dashboard.settings.stylesheet.stylesheet').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('stylesheet');
    }

    /**
     * Shows the settings system view.
     *
     * @return \Illuminate\View\View
     */
    public function showAboutusView()
    {
        return View::make('dashboard.settings.aboutus')
            ->withPageTitle(trans('dashboard.settings.system.aboutus').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('aboutus');
    }

    /**
     * Updates the site settings.
     *
     * @return \Illuminate\View\View
     */
    public function postSettings()
    {
        $redirectUrl = Session::get('redirect_to', route('dashboard.settings.general'));

        $setting = app('setting');

        $parameters = Request::all();

        $excludedParams = [
            '_token',
        ];

        try {
            foreach (Request::except($excludedParams) as $settingName => $settingValue) {
                $setting->set($settingName, $settingValue);
            }
        } catch (Exception $e) {
            return Redirect::to($redirectUrl)->withErrors(trans('dashboard.settings.edit.failure'));
        }

        if (Request::has('site_locale')) {
            Lang::setLocale(Request::get('site_locale'));
        }

        return Redirect::to($redirectUrl)
            ->withSuccess(trans('dashboard.settings.edit.success'));
    }
}
