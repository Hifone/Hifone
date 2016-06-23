<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Cache;
use Hifone\Models\Ad\Adspace;
use Illuminate\Support\Facades\View;
use Request;
use Route;

class Adshow extends AbstractWidget
{
    const CACHE_KEY = 'ads_';

    const CACHE_MINUTES = 10;
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'position' => 'sidebar',
        'template' => 'default',
    ];

    /**
     * Treat this method as a controller action.
     */
    public function run()
    {
        $adspace = Adspace::where('position', $this->config['position'])->first();

        if (!$adspace || ($adspace->route && !Request::is($adspace->route))) {
            return '';
        }

        return View::make('widgets.adshow.'.$this->config['template'])
            ->withConfig($this->config)
            ->withAdspace($adspace)
            ->withAdvertisements($this->getAdvertisements($adspace));
    }

    private function getAdvertisements($adspace)
    {
        return Cache::remember(self::CACHE_KEY.$adspace->id, self::CACHE_MINUTES, function () use ($adspace) {
            return $adspace->advertisements()->enabled()->get();
        });
    }
}
