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
        $view->withSiteBanner(Config::get('setting.site_banner'));
        $view->withSiteBannerStyleFullWidth(Config::get('setting.style_fullwidth_header'));
        $view->withSiteBannerType(Config::get('setting.site_banner_type'));

         // Theme colors.
        $view->withThemeBackgroundColor(Config::get('setting.style_background_color', '#F0F3F4'));
        $view->withThemeBackgroundFills(Config::get('setting.style_background_fills', '#FFFFFF'));
        $view->withThemeBannerBackgroundColor(Config::get('setting.style_banner_background_color', ''));
        $view->withThemeBannerPadding(Config::get('setting.style_banner_padding', '40px 0'));
        $view->withThemeTextColor(Config::get('setting.style_text_color', '#333333'));
        $view->withThemeReds(Config::get('setting.style_reds', '#ff6f6f'));
        $view->withThemeBlues(Config::get('setting.style_blues', '#3498db'));
        $view->withThemeGreens(Config::get('setting.style_greens', '#7ED321'));
        $view->withThemeYellows(Config::get('setting.style_yellows', '#F7CA18'));
        $view->withThemeOranges(Config::get('setting.style_oranges', '#FF8800'));
        $view->withThemeMetrics(Config::get('setting.style_metrics', '#0dccc0'));
        $view->withThemeLinks(Config::get('setting.style_links', '#7ED321'));

        $view->withAppAnalytics(Config::get('setting.app_analytics'));
        $view->withAppAnalyticsGoSquared(Config::get('setting.app_analytics_gs'));
        $view->withAppAnalyticsPiwikUrl(Config::get('setting.app_analytics_piwik_url'));
        $view->withAppAnalyticsPiwikSiteId(Config::get('setting.app_analytics_piwik_site_id'));

        $view->withSiteTitle(Config::get('setting.site_name').' | Hifone');
    }
}
