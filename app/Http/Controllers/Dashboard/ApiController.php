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
use Hifone\Models\Ad\Adspace;
use Hifone\Models\Link;
use Hifone\Models\Location;
use Hifone\Models\Node;
use Hifone\Models\Section;
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

    public function postUpdateSectionOrder()
    {
        $sectionData = Request::get('ids');

        foreach ($sectionData as $order => $sectionId) {
            // Ordering should be 1-based, data comes in 0-based
            Section::find($sectionId)->update(['order' => $order + 1]);
        }

        return $sectionData;
    }

    public function postUpdateNodeOrder()
    {
        $nodeData = Request::get('ids');

        foreach ($nodeData as $order => $nodeId) {
            // Ordering should be 1-based, data comes in 0-based
            Node::find($nodeId)->update(['order' => $order + 1]);
        }

        return $nodeData;
    }

    public function postUpdateAdspaceOrder()
    {
        $adspaceData = Request::get('ids');

        foreach ($adspaceData as $order => $adspaceId) {
            // Ordering should be 1-based, data comes in 0-based
            Adspace::find($adspaceId)->update(['order' => $order + 1]);
        }

        return $adspaceData;
    }

    public function postUpdateLocationOrder()
    {
        $locationData = Request::get('ids');

        foreach ($locationData as $order => $locationId) {
            // Ordering should be 1-based, data comes in 0-based
            Location::find($locationId)->update(['order' => $order + 1]);
        }

        return $locationData;
    }
}
