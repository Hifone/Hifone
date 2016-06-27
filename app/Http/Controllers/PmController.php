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
use Hifone\Repositories\Contracts\PmRepositoryInterface;
use Hifone\Repositories\Contracts\UserRepositoryInterface;
use Hifone\Repositories\Criteria\OnlyMine;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;

class PmController extends Controller
{
    protected $user;
    protected $pm;

    /**
     * Creates a new pm controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $user, PmRepositoryInterface $pm)
    {
        $this->user = $user;
        $this->pm = $pm;
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

        $pms = $this->pm->$method(Auth::user()->id);

        return $this->view('pms.index')
            ->withPms($pms);
    }

    public function show($id)
    {

        $this->pm->pushCriteria(new OnlyMine(Auth::user()->id));

        $pm = $this->pm->findOrFail($id);

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
        $recipient = Input::has('user_id') ? $this->user->findBy('id', Input::get('user_id')) : $this->user->findBy('username', Input::get('username'));


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

        $recipient = $this->user->findBy('username', array_pull($pmData, 'username'));

        if (!$recipient) {
            return Redirect::route('pm.create')
                ->withInput(Input::all())
                ->withErrors(['Recipient not exists.']);
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
}
