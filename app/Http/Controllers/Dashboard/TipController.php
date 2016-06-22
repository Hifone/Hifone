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
use Hifone\Models\Tip;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Input;

class TipController extends Controller
{
    /**
     * Creates a tip controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'tips',
            'sub_title'    => trans_choice('dashboard.tips.tips', 2),
        ]);
    }

    /**
     * Shows the tips view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tips = Tip::paginate(10);

        return View::make('dashboard.tips.index')
        ->withPageTitle(trans('dashboard.tips.tips').' - '.trans('dashboard.dashboard'))
        ->withTips($tips);
    }

    /**
     * Shows the add tip view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('dashboard.tips.create_edit')
            ->withPageTitle(trans('dashboard.tips.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new tip.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $tipData = Input::get('tip');

        try {
            Tip::create($tipData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.tip.create')
                ->withInput($tipData)
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.tips.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.tip.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.tips.add.success')));
    }

    /**
     * Shows the edit tip view.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Tip $tip)
    {
        return View::make('dashboard.tips.create_edit')
            ->withPageTitle(trans('dashboard.tips.edit.title').' - '.trans('dashboard.dashboard'))
            ->withTip($tip);
    }

    /**
     * Edit an tip.
     *
     * @param \Hifone\Models\Tip $tip
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Tip $tip)
    {
        $tipData = Input::get('tip');

        $tip->update($tipData);

        return Redirect::route('dashboard.tip.edit', ['id' => $tip->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.tips.edit.success')));
    }

    /**
     * Deletes a given tip.
     *
     * @param \Hifone\Models\Tip $tip
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tip $tip)
    {
        $tip->delete();

        return Redirect::route('dashboard.tip.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.tips.delete.success')));
    }
}
