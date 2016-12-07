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

use Auth;
use Hifone\Commands\Pm\AddPmCommand;
use Hifone\Models\Pm;
use Hifone\Models\User;
use Hifone\Repositories\Criteria\OnlyMine;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;

class PmController extends Controller
{
    /**
     * Creates a new pm controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows the pms view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $method = Input::get('tab') == 'inbox' ? 'inbox' : 'outbox';

        $pms = $this->$method(Auth::user()->id);

        return $this->view('pms.index')
            ->withPms($pms);
    }

    public function show($id)
    {
        $repository = app('repository');
        $repository->pushCriteria(new OnlyMine(Auth::user()->id));
        $pm = $repository->model(Pm::class)->findOrFail($id);

        return $this->view('pms.show')
            ->withPm($pm);
    }

    /**
     * Shows the add pm view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $repository = app('repository');
        $recipient = Input::has('user_id') ? $repository->model(User::class)->findBy('id', Input::get('user_id')) : $repository->model(User::class)->findBy('username', Input::get('username'));

        return $this->view('pms.create_edit')
            ->withRecipient($recipient);
    }

    /**
     * Creates a new pm.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $pmData = Input::get('pm');

        $repository = app('repository');
        $recipient = $repository->model(User::class)->findBy('username', array_pull($pmData, 'username'));

        if (!$recipient) {
            return Redirect::route('pm.create')
                ->withInput(Input::all())
                ->withErrors([trans('hifone.pms.recipient_error')]);
        }

        try {
            $pm = dispatch(new AddPmCommand(
                $recipient->id,
                Auth::user()->id,
                $pmData['body']
            ));
        } catch (ValidationException $e) {
            return Redirect::route('pm.create')
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('pm.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    protected function inbox($userId)
    {
        return Pm::forUser($userId)->recent()->paginate(10);
    }

    protected function outbox($userId)
    {
        return Pm::where('author_id', $userId)->recent()->paginate(10);
    }
}
