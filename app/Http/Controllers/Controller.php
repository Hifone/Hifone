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

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use View;
use Zizaco\Entrust\EntrustFacade as Entrust;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function needAuthorOrAdminPermission($author_id)
    {
        if (!Entrust::hasRole(['Founder', 'Admin']) && $author_id != Auth::id()) {
            throw new HttpException(401);
        }
    }
}
