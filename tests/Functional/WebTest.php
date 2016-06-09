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

class WebTest extends AbstractTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->get('/');
        $this->assertResponseStatus(302);
    }
}
