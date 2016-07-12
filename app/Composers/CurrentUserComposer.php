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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use McCool\LaravelAutoPresenter\Facades\AutoPresenter;

class CurrentUserComposer
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
        $view->withCurrentUser(AutoPresenter::decorate(Auth::user()));
        $view->withUserLocale(Auth::check() && Auth::user()->locale ? Auth::user()->locale : Config::get('setting.site_locale'));
    }
}
