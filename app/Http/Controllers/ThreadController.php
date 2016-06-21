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
use Hifone\Commands\Append\AddAppendCommand;
use Hifone\Commands\Thread\AddThreadCommand;
use Hifone\Commands\Thread\RemoveThreadCommand;
use Hifone\Commands\Thread\UpdateThreadCommand;
use Hifone\Models\Append;
use Hifone\Models\Node;
use Hifone\Models\Section;
use Hifone\Models\Thread;
use Hifone\Services\Parsers\Markdown;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;

class ThreadController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $threads = Thread::filter(Input::query('filter'))->search(Input::query('q'))->paginate(Config::get('setting.per_page'));

        //$this->breadcrumb->push('Forum', route('thread.index'));

        return $this->view('threads.index')
            ->withThreads($threads)
            ->withSections(Section::orderBy('order')->get());
    }

    public function create()
    {
        $node = Node::find(Input::query('node_id'));
        $sections = Section::orderBy('order')->get();

        $this->breadcrumb->push(trans('hifone.threads.add'), route('thread.create'));

        return $this->view('threads.create_edit')
            ->withSections($sections)
            ->withNode($node);
    }

    public function store()
    {
        $threadData = Input::get('thread');
        $node_id = isset($threadData['node_id']) ? $threadData['node_id'] : null;
        try {
            $thread = dispatch(new AddThreadCommand(
                $threadData['title'],
                $threadData['body'],
                Auth::user()->id,
                $node_id
            ));
        } catch (ValidationException $e) {
            return Redirect::route('thread.create')
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', [$thread->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function show(Thread $thread)
    {
        $replies = $thread->replies()
                    ->orderBy('created_at', 'asc')
                    ->with('user')
                    ->paginate(Config::get('setting.per_page'));

        $node = $thread->node;
        $nodeThreads = $thread->getSameNodeThreads();
        $thread->increment('view_count', 1);

        return $this->view('threads.show')
            ->withThread($thread)
            ->withReplies($replies)
            ->withNodeThreads($nodeThreads)
            ->withNode($node);
    }

    public function edit(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);
        $sections = Section::orderBy('order')->get();
        $node = $thread->node;

        $thread->body = $thread->body_original;

        return $this->view('threads.create_edit')
            ->withThread($thread)
            ->withSections($sections)
            ->withNode($node);
    }

    public function append(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);

        $content = (new Markdown())->convertMarkdownToHtml(Input::get('content'));

        try {
            $append = dispatch(new AddAppendCommand(
                $thread->id,
                $content
            ));
        } catch (ValidationException $e) {
            return Redirect::route('thread.show', $thread->id)
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function update(Thread $thread)
    {
        $threadData = Input::get('thread');

        $this->needAuthorOrAdminPermission($thread->user_id);

        $threadData['body_original'] = $threadData['body'];
        $threadData['body'] = (new Markdown())->convertMarkdownToHtml($threadData['body']);
        $threadData['excerpt'] = Thread::makeExcerpt($threadData['body']);

        try {
            $thread = dispatch(new UpdateThreadCommand($thread, $threadData));
        } catch (ValidationException $e) {
            return Redirect::route('thread.edit', $thread->id)
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function recomend(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);

        $updateData = [
            'is_excellent' => !$thread->is_excellent,
        ];

        $thread = dispatch(new UpdateThreadCommand($thread, $updateData));

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function pin(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);
        ($thread->order > 0) ? $thread->decrement('order', 1) : $thread->increment('order', 1);

        return Redirect::route('thread.show', $thread->id);
    }

    public function sink(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);
        ($thread->order >= 0) ? $thread->decrement('order', 1) : $thread->increment('order', 1);

        return Redirect::route('thread.show', $thread->id);
    }

    public function destroy(Thread $thread)
    {
        $this->needAuthorOrAdminPermission($thread->user_id);

        dispatch(new RemoveThreadCommand($thread));

        return Redirect::route('thread.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
