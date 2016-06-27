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

use Hifone\Commands\Favorite\AddFavoriteCommand;
use Hifone\Models\Thread;
use Illuminate\Support\Facades\Response;

class FavoriteController extends Controller
{
    public function createOrDelete(Thread $thread)
    {
        try {
            dispatch(new AddFavoriteCommand($thread));
        } catch (ValidationException $e) {
            //
        }

        return Response::json(['status' => 1]);
    }
}
