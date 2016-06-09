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

use Hifone\Http\Controllers\Controller;
use Hifone\Models\Reply;
use Illuminate\Support\Facades\View;

class ReplyController extends Controller
{
    /**
     * Creates a new reply controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'replies',
            'sub_title'    => trans_choice('dashboard.replies.replies', 2),
        ]);
    }

    public function index()
    {
        return $this->showReplies();
    }

    public function showReplies()
    {
        $replies = Reply::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.replies.index')
            ->withPageTitle(trans('dashboard.replies.replies').' - '.trans('dashboard.dashboard'))
            ->withReplies($replies);
    }
}
