<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Test\Events\Thread;

use Hifone\Events\Thread\ThreadWasAddedEvent;
use Hifone\Models\Thread;

class ThreadWasAddedEventTest extends AbstractThreadEventTestCase
{
    protected function objectHasHandlers()
    {
        return true;
    }

    protected function getObjectAndParams()
    {
        $params = ['thread' => new Thread()];
        $object = new ThreadWasAddedEvent($params['thread']);

        return compact('params', 'object');
    }
}
