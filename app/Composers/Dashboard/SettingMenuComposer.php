<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Composers\Dashboard;

use Illuminate\Contracts\View\View;
use Config;

class SettingMenuComposer
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
        $subMenu = [
            'general' => [
                'title'  => trans('dashboard.settings.general.general'),
                'url'    => route('dashboard.settings.general'),
                'icon'   => 'fa fa-gear',
                'active' => false,
            ],
            'localization' => [
                'title'  => trans('dashboard.settings.localization.localization'),
                'url'    => route('dashboard.settings.localization'),
                'icon'   => 'fa fa-language',
                'active' => false,
            ],
            'tips' => [
                'title'  => trans('dashboard.tips.tips'),
                'url'    => route('dashboard.tip.index'),
                'icon'   => 'fa fa-tint',
                'active' => 'false',
            ],
            'links' => [
                'title'  => trans('dashboard.links.links'),
                'url'    => route('dashboard.link.index'),
                'icon'   => 'fa fa-link',
                'active' => 'false',
            ],
            'locations' => [
                'title'  => trans('dashboard.locations.locations'),
                'url'    => route('dashboard.location.index'),
                'icon'   => 'fa fa-location-arrow',
                'active' => 'false',
            ],
            'customization' => [
                'title'  => trans('dashboard.settings.customization.customization'),
                'url'    => route('dashboard.settings.customization'),
                'icon'   => 'fa fa-plug',
                'active' => false,
            ],
            'aboutus' => [
                'title'  => trans('dashboard.settings.aboutus.aboutus'),
                'url'    => route('dashboard.settings.aboutus'),
                'icon'   => 'fa fa-info-circle',
                'active' => false,
            ],
        ];

        $view->withSubMenu($subMenu);
        $view->withSubTitle(trans('dashboard.settings.settings'));

        $view->withCaptchaRegDisabled(Config::get('setting.captcha_reg_disabled'));
        $view->withCaptchaLoginDisabled(Config::get('setting.captcha_login_disabled'));
    }
}
