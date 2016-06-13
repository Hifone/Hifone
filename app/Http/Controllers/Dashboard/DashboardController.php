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
use Hifone\Models\Thread;
use Hifone\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;

class DashboardController extends Controller
{
    public function index()
    {
        $nodes = Node::orderBy('order')->get();

        $recentThreads = Thread::orderBy('created_at', 'desc')->take(10)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->take(10)->get();

        return View::make('dashboard.index')
            ->withRecentThreads($recentThreads)
            ->withRecentUsers($recentUsers)
            ->withNodes($nodes);
    }
}
