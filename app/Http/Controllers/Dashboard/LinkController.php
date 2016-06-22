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

use Hifone\Events\Link\LinkWasUpdatedEvent;
use Hifone\Http\Controllers\Controller;
use Hifone\Models\Link;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Input;

class LinkController extends Controller
{
    /**
     * Creates a link controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'links',
            'sub_title'    => trans_choice('dashboard.links.links', 2),
        ]);
    }

    /**
     * Shows the links view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $links = Link::orderBy('order')->paginate(10);

        return View::make('dashboard.links.index')
        ->withPageTitle(trans('dashboard.links.links').' - '.trans('dashboard.dashboard'))
        ->withLinks($links);
    }

    /**
     * Shows the add link view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('dashboard.links.create_edit')
            ->withPageTitle(trans('dashboard.links.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new link.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $linkData = Input::get('link');

        try {
            Link::create($linkData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.link.create')
                ->withInput($linkData)
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.links.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.link.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.links.add.success')));
    }

    /**
     * Shows the edit link view.
     *
     * @param \Hifone\Models\Link $link
     *
     * @return \Illuminate\View\View
     */
    public function edit(Link $link)
    {
        return View::make('dashboard.links.create_edit')
            ->withPageTitle(trans('dashboard.links.edit.title').' - '.trans('dashboard.dashboard'))
            ->withLink($link);
    }

    /**
     * Edit an link.
     *
     * @param \Hifone\Models\Link $link
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Link $link)
    {
        $linkData = Input::get('link');

        $link->update($linkData);

        event(new LinkWasUpdatedEvent($link));

        return Redirect::route('dashboard.link.edit', ['id' => $link->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.links.edit.success')));
    }

    /**
     * Deletes a given link.
     *
     * @param \Hifone\Models\Link $link
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Link $link)
    {
        $link->delete();

        return Redirect::route('dashboard.link.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.links.delete.success')));
    }
}
