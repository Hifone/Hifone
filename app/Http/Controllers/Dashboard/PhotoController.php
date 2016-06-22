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

use File;
use Hifone\Http\Controllers\Controller;
use Hifone\Models\Photo;
use Illuminate\Support\Facades\View;
use Redirect;

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

    /**
     * Shows the photos view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.photos.index')
            ->withPageTitle(trans('dashboard.photos.photos').' - '.trans('dashboard.dashboard'))
            ->withPhotos($photos);
    }

    /**
     * Deletes a given photo.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $file_path = str_replace(upload_url(), public_path(), $photo->image);

        File::delete($file_path);
        $photo->delete();

        return Redirect::route('dashboard.photo.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
