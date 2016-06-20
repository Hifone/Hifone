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

use Hifone\Commands\Like\AddLikeCommand;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Input;

class LikeController extends Controller
{
    public function store()
    {
        $data = Input::all();
        if ($data['type'] == 'Thread') {
            $target = Thread::findOrFail($data['id']);
        } elseif ($data['type'] == 'Reply') {
            $target = Reply::findOrFail($data['id']);
        }
        dispatch(new AddLikeCommand($target));

        return Response::json(['status' => 1]);
    }

    public function destroy($id)
    {
        $data = Input::all();
        if ($data['type'] == 'Thread') {
            $target = Thread::findOrFail($data['id']);
        } elseif ($data['type'] == 'Reply') {
            $target = Reply::findOrFail($data['id']);
        }

        dispatch(new AddLikeCommand($target, 'unlike'));

        return Response::json(['status' => 1]);
    }
}
