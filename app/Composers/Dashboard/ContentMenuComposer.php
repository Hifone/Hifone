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

class ContentMenuComposer
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
            'threads' => [
                'title'  => trans('dashboard.threads.threads'),
                'url'    => route('dashboard.thread.index'),
                'icon'   => 'fa fa-file-o',
                'active' => false,
            ],
            'replies' => [
                'title'  => trans('dashboard.replies.replies'),
                'url'    => route('dashboard.reply.index'),
                'icon'   => 'fa fa-comments-o',
                'active' => false,
            ],
            'photo' => [
                'title'  => trans('dashboard.photos.photos'),
                'url'    => route('dashboard.photo.index'),
                'icon'   => 'fa fa-image',
                'active' => false,
            ],
            'page' => [
                'title'  => trans('dashboard.pages.pages'),
                'url'    => route('dashboard.page.index'),
                'icon'   => 'fa fa-file-o',
                'active' => false,
            ],
        ];

        $view->withSubMenu($subMenu);
        $view->withSubTitle(trans('dashboard.content.content'));
    }
}
