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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class AdblockController extends Controller
{
    /**
     * Creates a new adblock controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'adblocks',
            'sub_title'    => trans('dashboard.advertisements.advertisements'),
        ]);
    }

    /**
     * Shows the adblocks view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $adblocks = Adblock::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.adblocks.index')
        ->withPageTitle(trans('dashboard.adblocks.adblocks').' - '.trans('dashboard.dashboard'))
        ->withAdblocks($adblocks);
    }

    /**
     * Shows an adblock in more detail.
     *
     * @param \Hifone\Models\Ad\Adblock $adblock
     *
     * @return \Illuminate\View\View
     */
    public function show(Adblock $adblock)
    {
        $adspaces = $adblock->adspaces()->orderBy('order')->paginate(10);

        return View::make('dashboard.adspaces.index')
        ->withPageTitle(trans('dashboard.adspaces.adspaces').' - '.trans('dashboard.dashboard'))
        ->withAdspaces($adspaces);
    }

    /**
     * Shows the add adblock view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $adblocks = Adblock::all();

        return View::make('dashboard.adblocks.create_edit')
            ->withAdblocks($adblocks)
            ->withSubMenu('adblocks');
    }

    /**
     * Shows the edit adblock view.
     *
     * @param \Hifone\Models\Ad\Adblock $adblock
     *
     * @return \Illuminate\View\View
     */
    public function edit(Adblock $adblock)
    {
        return View::make('dashboard.adblocks.create_edit')
            ->withAdblock($adblock)
            ->withAdblocks(Adblock::all())
            ->withSubMenu('adblocks');
    }

    /**
     * Edit a adblock.
     *
     * @param \Hifone\Models\Ad\Adblock $adblock
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Adblock $adblock)
    {
        $adblockData = Request::get('adblock');

        try {
            $adblock->update($adblockData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.adblock.edit', ['id' => $adblock->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.adblocks.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.adblock.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.adblocks.edit.success')));
    }

    /**
     * Creates a new adblock.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $adblockData = Request::get('adblock');

        try {
            Adblock::create($adblockData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.adblock.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.adblocks.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.adblock.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.adblocks.edit.success')));
    }
}
