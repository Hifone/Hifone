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

class AdvertisementMenuComposer
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
            'advertisements' => [
                'title'  => trans('dashboard.advertisements.advertisements'),
                'url'    => route('dashboard.advertisement.index'),
                'icon'   => 'fa fa-audio-description',
                'active' => false,
            ],
            'adspaces' => [
                'title'  => trans('dashboard.adspaces.adspaces'),
                'url'    => route('dashboard.adspace.index'),
                'icon'   => 'fa fa-columns',
                'active' => false,
            ],
            'adblocks' => [
                'title'  => trans('dashboard.adblocks.adblocks'),
                'url'    => route('dashboard.adblock.index'),
                'icon'   => 'fa fa-object-group',
                'active' => false,
            ],
        ];

        $view->withSubMenu($subMenu);
        $view->withSubTitle(trans('dashboard.advertisements.advertisements'));
    }
}
