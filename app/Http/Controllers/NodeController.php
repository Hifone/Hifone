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

use Hifone\Models\Node;
use Hifone\Models\Thread;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class NodeController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('order')->get();

        return $this->view('nodes.index')
            ->withSections($sections);
    }

    public function show(Node $node)
    {
        $this->breadcrumb->push($node->name, $node->url);
        $threads = Thread::NodeThreads(Input::get('filter'), $node->id)->search(Input::query('q'))->paginate(Config::get('setting.per_page'));

        return $this->view('threads.index')
            ->withThreads($threads)
            ->withNode($node);
    }

    public function showBySlug($slug)
    {
        return $this->show(Node::where('slug', $slug)->firstOrFail());
    }
}
