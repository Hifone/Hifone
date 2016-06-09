<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Test\Functional;

use Hifone\Test\AbstractTestCase;
use Illuminate\Contracts\Console\Kernel;

class CommandTest extends AbstractTestCase
{
    public function testMigrations()
    {
        $this->assertSame(0, $this->app->make(Kernel::class)->call('migrate', ['--force' => true]));
    }
}
