<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Dashboard;

use Hifone\Models\Node;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index()
    {
        $nodes = Node::orderBy('order')->get();


        $recentThreads = Thread::orderBy('created_at', 'desc')->take(5)->get();
        $recentReplies = Reply::orderBy('created_at', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();

        return View::make('dashboard.index')
            ->withThreadCount(Thread::count())
            ->withReplyCount(Reply::count())
            ->withUserCount(User::count())
            ->withRecentThreads($recentThreads)
            ->withRecentReplies($recentReplies)
            ->withRecentUsers($recentUsers)
            ->withNodes($nodes);
    }
}
