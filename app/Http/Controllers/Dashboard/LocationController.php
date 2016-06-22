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
use Hifone\Models\Location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Input;

class LocationController extends Controller
{
    /**
     * Creates a location controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'locations',
            'sub_title'    => trans_choice('dashboard.locations.locations', 2),
        ]);
    }

    /**
     * Shows the locations view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $locations = Location::orderBy('order')->paginate(10);

        return View::make('dashboard.locations.index')
        ->withPageTitle(trans('dashboard.locations.locations').' - '.trans('dashboard.dashboard'))
        ->withLocations($locations);
    }

    /**
     * Shows the add location view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('dashboard.locations.create_edit')
            ->withPageTitle(trans('dashboard.locations.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new location.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $locationData = Input::get('location');

        try {
            Location::create($locationData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.location.create')
                ->withInput($locationData)
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.locations.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.location.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.locations.add.success')));
    }

    /**
     * Shows the edit location view.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Location $location)
    {
        return View::make('dashboard.locations.create_edit')
            ->withPageTitle(trans('dashboard.locations.edit.title').' - '.trans('dashboard.dashboard'))
            ->withLocation($location);
    }

    /**
     * Edit a location.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Location $location)
    {
        $locationData = Input::get('location');

        $location->update($locationData);

        return Redirect::route('dashboard.location.edit', ['id' => $location->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.locations.edit.success')));
    }

    /**
     * Deletes a given location.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return Redirect::route('dashboard.location.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.locations.delete.success')));
    }
}
