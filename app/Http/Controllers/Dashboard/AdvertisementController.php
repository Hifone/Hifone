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
use Hifone\Models\Ad\Adspace;
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

    /**
     * Shows the advertisements view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $advertisements = Advertisement::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.advertisements.index')
        ->withPageTitle(trans('dashboard.advertisements.advertisements').' - '.trans('dashboard.dashboard'))
        ->withAdvertisements($advertisements);
    }

    /**
     * Shows the add advertisement view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $adspaces = Adspace::orderBy('created_at', 'desc')->get();
        $adspace = Adspace::find(Input::get('adspace_id'));

        return View::make('dashboard.advertisements.create_edit')
            ->withInput(Input::all())
            ->withAdspace($adspace)
            ->withAdspaces($adspaces);
    }

    /**
     * Shows the edit advertisement view.
     *
     * @param \Hifone\Models\Advertisement $advertisement
     *
     * @return \Illuminate\View\View
     */
    public function edit(Advertisement $advertisement)
    {
        $adspaces = Adspace::orderBy('created_at', 'desc')->get();

        return View::make('dashboard.advertisements.create_edit')
            ->withAdvertisement($advertisement)
            ->withAdspace($advertisement->adspace)
            ->withAdspaces($adspaces);
    }

    /**
     * Edit an advertisement.
     *
     * @param \Hifone\Models\Advertisement $advertisement
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Advertisement $advertisement)
    {
        $advertisementData = Request::get('advertisement');

        try {
            $advertisement->update($advertisementData);
            event(new AdvertisementWasUpdatedEvent($advertisement));
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.advertisement.edit', ['id' => $advertisement->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.advertisements.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.advertisement.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.advertisements.edit.success')));
    }

    /**
     * Creates a new advertisement.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $advertisementData = Request::get('advertisement');

        try {
            Advertisement::create($advertisementData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.advertisement.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.advertisements.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.advertisement.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.advertisements.edit.success')));
    }

    /**
     * Destroy an advertisement.
     *
     * @param \Hifone\Models\Advertisement $advertisement
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return Redirect::route('dashboard.advertisement.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
