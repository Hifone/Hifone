<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Test\Api;

class ThreadTest extends AbstractApiTestCase
{
    public function testGetThreads()
    {
        $threads = factory('Hifone\Models\Thread', 3)->create();
        $this->get('/api/v1/threads');
        $this->seeJson(['id' => $threads[0]->id]);
        $this->seeJson(['id' => $threads[1]->id]);
        $this->seeJson(['id' => $threads[2]->id]);
        $this->assertResponseOk();
    }

    public function testGetInvalidThread()
    {
        $this->get('/api/v1/threads/0');
        $this->assertResponseStatus(404);
    }
}
