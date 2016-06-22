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
use Hifone\Models\Ad\Adblock as AdblockModel;
use Widget;

class Adblock extends AbstractWidget
{
    protected $items = [];
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'block'    => 'top',
        'template' => 'default',
    ];

    public function run()
    {
        $adblock = AdblockModel::where('slug', $this->config['slug'])->first();
        if (!$adblock) {
            return;
        }

        $adblock->adspaces->map(function ($adspace) {
            $this->addItem($adspace);
        });

        return $this->output();
    }

    protected function addItem($adspace)
    {
        if (!$adspace) {
            return;
        }
        $item = Widget::Adshow(['position' => $adspace->position, 'template' => $this->config['template']]);
        if (!$item) {
            return;
        }

        $this->items[] = $item;
    }

    protected function output()
    {
        return implode('', $this->items);
    }
}
