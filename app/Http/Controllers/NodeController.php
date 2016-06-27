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
use Hifone\Repositories\Contracts\ThreadRepositoryInterface;
use Hifone\Repositories\Criteria\Thread\BelongsToNode;
use Hifone\Repositories\Criteria\Thread\Search;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class NodeController extends Controller
{
    protected $thread;

    /**
     * Creates a new thread controller instance.
     *
     * @return void
     */
    public function __construct(ThreadRepositoryInterface $thread)
    {
        parent::__construct();

        $this->thread = $thread;
    }

    public function index()
    {
        $sections = Section::orderBy('order')->get();

        return $this->view('nodes.index')
            ->withSections($sections);
    }

    public function show(Node $node)
    {
        $this->breadcrumb->push($node->name, $node->url);
        $this->thread->pushCriteria(new Search(Input::query('q')));
        $this->thread->pushCriteria(new BelongsToNode($node->id));

        $threads = $this->thread->getList(Config::get('setting.per_page'));

        return $this->view('threads.index')
            ->withThreads($threads)
            ->withNode($node);
    }

    public function showBySlug($slug)
    {
        return $this->show(Node::where('slug', $slug)->firstOrFail());
    }
}
