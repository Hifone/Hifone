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

use AltThree\Validator\ValidationException;
use Auth;
use Hifone\Commands\Reply\AddReplyCommand;
use Hifone\Commands\Reply\RemoveReplyCommand;
use Hifone\Models\Reply;
use Input;
use Redirect;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Creates a new node.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $replyData = Input::get('reply');

        try {
            $reply = dispatch(new AddReplyCommand(
                $replyData['body'],
                Auth::user()->id,
                $replyData['thread_id']
            ));
        } catch (ValidationException $e) {
            return Redirect::route('thread.show', $replyData['thread_id'])
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', [$reply->thread_id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function destroy(Reply $reply)
    {
        $this->needAuthorOrAdminPermission($reply->user_id);

        dispatch(new RemoveReplyCommand($reply));

        return Redirect::route('thread.show', $reply->thread_id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
