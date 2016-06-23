<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers;

use Hifone\Models\Tag;
use Illuminate\Support\Facades\Config;

class TagController extends Controller
{
    /**
     * Shows threads of the tag.
     *
     * @param \Hifone\Models\Tag $tag
     *
     * @return \Illuminate\View\View
     */
    public function show(Tag $tag)
    {
        $this->breadcrumb->push($tag->name);

        $threads = $tag->threads()->paginate(Config::get('setting.per_page'));

        return $this->view('threads.index')
            ->withTag($tag)
            ->withThreads($threads);
    }
}
