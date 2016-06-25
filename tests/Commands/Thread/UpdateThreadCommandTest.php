<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Test\Commands\Thread;

use Hifone\Commands\Thread\UpdateThreadCommand;
use Hifone\Handlers\Commands\Thread\UpdateThreadCommandHandler;
use Hifone\Models\Thread;
use Hifone\Test\Commands\AbstractCommandTestCase;

/**
 * This is the update thread command test class.
 */
class UpdateThreadCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'thread'  => new Thread(),
            'data'    => [
                'title'   => 'Test',
                'body'    => 'Foo bar baz',
                'tags'    => 'hello,world',
            ],
        ];

        $object = new UpdateThreadCommand(
            $params['thread'],
            $params['data']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return false;
    }

    protected function getHandlerClass()
    {
        return UpdateThreadCommandHandler::class;
    }
}
