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
use Hifone\Models\Photo;
use Illuminate\Support\Facades\View;

class PhotoController extends Controller
{
    /**
     * Creates a new page controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'photo',
            'sub_title'    => trans('dashboard.photos.photos'),
        ]);
    }

    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.photos.index')
            ->withPageTitle(trans('dashboard.photos.photos').' - '.trans('dashboard.dashboard'))
            ->withPhotos($photos);
    }

    public function destroy($id)
    {
        echo $id;
    }
}
