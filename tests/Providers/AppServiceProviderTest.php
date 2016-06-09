<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Test\Providers;

use GitaminHQ\BenchTest\LaravelTrait;
use GitaminHQ\BenchTest\ServiceProviderTrait;
use Hifone\Providers\AppServiceProvider;
use Hifone\Test\AbstractTestCase;

class AppServiceProviderTest extends AbstractTestCase
{
    use LaravelTrait, ServiceProviderTrait;

    protected function getServiceProviderClass($app)
    {
        return AppServiceProvider::class;
    }
}
