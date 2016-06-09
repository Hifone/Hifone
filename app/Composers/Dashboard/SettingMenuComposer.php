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
            'theme' => [
                'title'  => trans('dashboard.settings.theme.theme'),
                'url'    => route('dashboard.settings.theme'),
                'icon'   => 'fa fa-image',
                'active' => false,
            ],
            'customization' => [
                'title'  => trans('dashboard.settings.customization.customization'),
                'url'    => route('dashboard.settings.customization'),
                'icon'   => 'fa fa-link',
                'active' => false,
            ],
            'stylesheet' => [
                'title'  => trans('dashboard.settings.stylesheet.stylesheet'),
                'url'    => route('dashboard.settings.stylesheet'),
                'icon'   => 'fa fa-magic',
                'active' => false,
            ],
            'security' => [
                'title'  => trans('dashboard.settings.security.security'),
                'url'    => route('dashboard.settings.security'),
                'icon'   => 'fa fa-key',
                'active' => false,
            ],
            'analytics' => [
                'title'  => trans('dashboard.settings.analytics.analytics'),
                'url'    => route('dashboard.settings.analytics'),
                'icon'   => 'fa fa-line-chart',
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
    }
}
