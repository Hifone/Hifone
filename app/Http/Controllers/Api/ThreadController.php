<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Api;

use Hifone\Models\Thread;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Request;
use Input;

class ThreadController extends AbstractApiController
{
    /**
     * Get all Threads.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getThreads()
    {
        $threadVisibility = app(Guard::class)->check() ? 0 : 1;
        $threads = Thread::where('is_blocked', '!=', $threadVisibility)->orderBy('id', 'desc');

        $threads = $threads->paginate(Input::get('per_page', 20));

        return $this->paginator($threads, Request::instance());
    }
}
