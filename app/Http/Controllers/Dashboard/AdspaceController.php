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

use AltThree\Validator\ValidationException;
use Hifone\Http\Controllers\Controller;
use Hifone\Models\Ad\Adblock;
use Hifone\Models\Ad\Adspace;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class AdspaceController extends Controller
{
    /**
     * Creates a new adspace controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'adspaces',
            'sub_title'    => trans('dashboard.advertisements.advertisements'),
        ]);
    }

    /**
     * Shows the adspaces view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $adspaces = Adspace::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.adspaces.index')
        ->withPageTitle(trans('dashboard.adspaces.adspaces').' - '.trans('dashboard.dashboard'))
        ->withAdspaces($adspaces);
    }

    /**
     * Shows the add adspace view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $adblocks = Adblock::all();

        return View::make('dashboard.adspaces.create_edit')
            ->withAdblocks($adblocks)
            ->withSubMenu('adspaces');
    }

    /**
     * Shows the edit adspace view.
     *
     * @param \Hifone\Models\Ad\Adspace $adspace
     *
     * @return \Illuminate\View\View
     */
    public function edit(Adspace $adspace)
    {
        return View::make('dashboard.adspaces.create_edit')
            ->withAdspace($adspace)
            ->withAdblocks(Adblock::all())
            ->withSubMenu('adspaces');
    }

    /**
     * Edit a adspace.
     *
     * @param \Hifone\Models\Ad\Adspace $adspace
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Adspace $adspace)
    {
        $adspaceData = Request::get('adspace');

        try {
            $adspace->update($adspaceData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.adspace.edit', ['id' => $adspace->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.adspaces.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.adspace.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.adspaces.edit.success')));
    }

    /**
     * Creates a new adspace.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $adspaceData = Request::get('adspace');

        try {
            Adspace::create($adspaceData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.adspace.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.adspaces.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.adspace.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.adspaces.edit.success')));
    }
}
