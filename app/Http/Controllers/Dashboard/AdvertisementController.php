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

use Hifone\Events\Advertisement\AdvertisementWasUpdatedEvent;
use Hifone\Http\Controllers\Controller;
use Hifone\Models\Adspace;
use Hifone\Models\Advertisement;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Input;

class AdvertisementController extends Controller
{
    /**
     * Creates a new advertisement controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'advertisements',
        ]);
    }

    public function index()
    {
        $advertisements = Advertisement::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.advertisements.index')
        ->withPageTitle(trans('dashboard.advertisements.advertisements').' - '.trans('dashboard.dashboard'))
        ->withAdvertisements($advertisements);
    }

    public function create()
    {
        $adspaces = Adspace::orderBy('created_at', 'desc')->get();
        $adspace = Adspace::find(Input::get('adspace_id'));

        return View::make('dashboard.advertisements.create_edit')
            ->withInput(Input::all())
            ->withAdspace($adspace)
            ->withAdspaces($adspaces);
    }

    public function edit(Advertisement $advertisement)
    {
        $adspaces = Adspace::orderBy('created_at', 'desc')->get();

        return View::make('dashboard.advertisements.create_edit')
            ->withAdvertisement($advertisement)
            ->withAdspace($advertisement->adspace)
            ->withAdspaces($adspaces);
    }

    public function update(Advertisement $advertisement)
    {
        $advertisementData = Request::get('advertisement');

        try {
            $advertisement->update($advertisementData);
            dispatch(new AdvertisementWasUpdatedEvent($advertisement));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.advertisement.edit', ['id' => $advertisement->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.advertisements.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.advertisement.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.advertisements.edit.success')));
    }

    public function store()
    {
        $advertisementData = Request::get('advertisement');

        try {
            Advertisement::create($advertisementData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.advertisement.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.advertisements.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.advertisement.index')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.advertisements.edit.success')));
    }
}
