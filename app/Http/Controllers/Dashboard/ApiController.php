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
use Hifone\Models\Link;
use Illuminate\Support\Facades\Request;

class ApiController extends Controller
{
    //
    public function postUpdateLinkOrder()
    {
        $linkData = Request::get('ids');

        foreach ($linkData as $order => $linkId) {
            // Ordering should be 1-based, data comes in 0-based
            Link::find($linkId)->update(['order' => $order + 1]);
        }

        return $linkData;
    }
}
