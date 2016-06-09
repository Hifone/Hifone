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

class NodeMenuComposer
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
            'nodes' => [
                'title'  => trans('dashboard.nodes.nodes'),
                'url'    => route('dashboard.node.index'),
                'icon'   => 'fa fa-sitemap',
                'active' => false,
            ],
            'sections' => [
                'title'  => trans('dashboard.sections.sections'),
                'url'    => route('dashboard.section.index'),
                'icon'   => 'fa fa-folder',
                'active' => false,
            ],
        ];

        $view->withSubMenu($subMenu);
        $view->withSubTitle(trans_choice('dashboard.nodes.nodes', 2));
    }
}
