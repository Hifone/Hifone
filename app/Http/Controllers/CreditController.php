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
use Config;
use Illuminate\Support\Facades\View;

class CreditController extends Controller
{
    public function index()
    {
        $credits = Auth::user()->credits()->recent()->paginate(Config::get('setting.per_page'));

        return $this->view('credits.index')
            ->withCredits($credits);
    }
}
