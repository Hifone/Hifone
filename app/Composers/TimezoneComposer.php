<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Composers;

use DateTime;
use DateTimeZone;
use Illuminate\Contracts\View\View;

class TimezoneComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $regions = [
            'Africa'     => DateTimeZone::AFRICA,
            'America'    => DateTimeZone::AMERICA,
            'Antarctica' => DateTimeZone::ANTARCTICA,
            'Asia'       => DateTimeZone::ASIA,
            'Atlantic'   => DateTimeZone::ATLANTIC,
            'Australia'  => DateTimeZone::AUSTRALIA,
            'Europe'     => DateTimeZone::EUROPE,
            'Indian'     => DateTimeZone::INDIAN,
            'Pacific'    => DateTimeZone::PACIFIC,
            'UTC'        => DateTimeZone::UTC,
        ];
        $timezones = [];

        foreach ($regions as $name => $mask) {
            $zones = DateTimeZone::listIdentifiers($mask);
            foreach ($zones as $timezone) {
                // Lets sample the time there right now
                $time = new DateTime(null, new DateTimeZone($timezone));
                $ampm = $time->format('H') > 12 ? ' ('.$time->format('g:i a').')' : '';
                // Remove region name and add a sample time
                $timezones[$name][$timezone] = substr($timezone, strlen($name) + 1).' - '.$time->format('H:i').$ampm;
                $timezones[$name] = str_replace('_', ' ', $timezones[$name]);
            }
        }
        $view->withTimezones($timezones);
    }
}
