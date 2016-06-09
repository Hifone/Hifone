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

use Hifone\Events\Thread\ThreadEventInterface;
use Hifone\Test\Events\AbstractEventTestCase;

class AbstractThreadEventTestCase extends AbstractEventTestCase
{
    protected function getEventInterfaces()
    {
        return [ThreadEventInterface::class];
    }
}
