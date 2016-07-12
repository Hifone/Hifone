<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Composers;

use Hifone\StringBlade\Facades\StringBlade;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class AppComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->withSiteName(Config::get('setting.site_name'));
        $view->withSiteAbout(Config::get('setting.site_about'));
        $view->withSiteDomain(Config::get('setting.site_domain'));
        $view->withSiteCdn(Config::get('setting.site_cdn'));
        $view->withSiteLogo(Config::get('setting.site_logo'));
        $view->withSiteTitle(Config::get('setting.site_name').' | Hifone');
        $view->withSiteLocale(Config::get('setting.site_locale'));
        $view->withSiteTimezone(Config::get('setting.site_timezone'));
        $view->withStylesheet(Config::get('setting.stylesheet'));

        $view->withFooterHtml(StringBlade::make(Config::get('setting.footer_html'))
                ->withSiteAbout(Config::get('setting.site_about'))
                ->withSiteTimezone(Config::get('setting.site_timezone'))
                    ->render());
    }
}
