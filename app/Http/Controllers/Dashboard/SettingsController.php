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
use Illuminate\Support\Str;
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
     * Shows the settings analytics view.
     *
     * @return \Illuminate\View\View
     */
    public function showAnalyticsView()
    {
        return View::make('dashboard.settings.analytics')
            ->withPageTitle(trans('dashboard.settings.analytics.analytics').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('analytics');
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
     * Shows the settings theme view.
     *
     * @return \Illuminate\View\View
     */
    public function showThemeView()
    {
        return View::make('dashboard.settings.theme')
            ->withPageTitle(trans('dashboard.settings.theme.theme').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('theme');
    }

    /**
     * Shows the settings security view.
     *
     * @return \Illuminate\View\View
     */
    public function showSecurityView()
    {
        $unsecureUsers = [];

        return View::make('dashboard.settings.security')
            ->withPageTitle(trans('dashboard.settings.security.security').' - '.trans('dashboard.dashboard'))
            ->withCurrentMenu('security')
            ->withUnsecureUsers($unsecureUsers);
    }

    /**
     * Shows the settings stylesheet view.
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
     * Updates the status page settings.
     *
     * @return \Illuminate\View\View
     */
    public function postSettings()
    {
        $redirectUrl = Session::get('redirect_to', route('dashboard.settings.general'));

        $setting = app('setting');

        if (Request::get('remove_banner') === '1') {
            $setting->set('site_banner', null);
        }

        $parameters = Request::all();

        if (isset($parameters['header'])) {
            if ($header = Request::get('header', null, false, false)) {
                $setting->set('header', $header);
            } else {
                $setting->delete('header');
            }
        }

        if (isset($parameters['footer'])) {
            if ($footer = Request::get('footer', null, false, false)) {
                $setting->set('footer', $footer);
            } else {
                $setting->delete('footer');
            }
        }

        if (Request::hasFile('site_banner')) {
            $file = Request::file('site_banner');

            // Image Validation.
            // Image size in bytes.
            $maxSize = $file->getMaxFilesize();

            if ($file->getSize() > $maxSize) {
                return Redirect::to($redirectUrl)->withErrors(trans('dashboard.settings.general.too-big', ['size' => $maxSize]));
            }

            if (!$file->isValid() || $file->getError()) {
                return Redirect::to($redirectUrl)->withErrors($file->getErrorMessage());
            }

            if (!Str::startsWith($file->getMimeType(), 'image/')) {
                return Redirect::to($redirectUrl)->withErrors(trans('dashboard.settings.general.images-only'));
            }

            // Store the banner.
            $setting->set('site_banner', base64_encode(file_get_contents($file->getRealPath())));

            // Store the banner type.
            $setting->set('site_banner_type', $file->getMimeType());
        }

        $excludedParams = [
            '_token',
            'site_banner',
            'remove_banner',
            'header',
            'footer',
        ];

        try {
            foreach (Request::except($excludedParams) as $settingName => $settingValue) {
                if ($settingName === 'site_analytics_pi_url') {
                    $settingValue = rtrim($settingValue, '/');
                }

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
