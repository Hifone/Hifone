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

class LocaleComposer
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
        $enabledLangs = Config::get('langs');
        $langs = array_map(function ($lang) use ($enabledLangs) {
            $locale = basename($lang);

            return [$locale => $enabledLangs[$locale]];
        }, glob(base_path('resources/lang').'/*'));

        $langs = call_user_func_array('array_merge', $langs);

        $view->withLangs($langs);
    }
}
