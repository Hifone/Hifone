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

use Hifone\Commands\Thread\AddThreadCommand;
use Hifone\Handlers\Commands\Thread\AddThreadCommandHandler;
use Hifone\Test\Commands\AbstractCommandTestCase;

/**
 * This is the add thread command test class.
 */
class AddThreadCommandTest extends AbstractCommandTestCase
{
    protected function getObjectAndParams()
    {
        $params = [
            'title'   => 'Foo bar baz',
            'body'    => 'Issue body',
            'user_id' => 1,
            'node_id' => 1,
            'tags'    => 'tag1,tag2',
        ];
        $object = new AddThreadCommand(
            $params['title'],
            $params['body'],
            $params['user_id'],
            $params['node_id'],
            $params['tags']
        );

        return compact('params', 'object');
    }

    protected function objectHasRules()
    {
        return true;
    }

    protected function getHandlerClass()
    {
        return AddThreadCommandHandler::class;
    }
}
