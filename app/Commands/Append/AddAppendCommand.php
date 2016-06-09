<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Append;

final class AddAppendCommand
{
    public $thread_id;

    public $content;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'thread_id'    => 'int',
        'content'      => 'required|string',
    ];

    /**
     * Create a new add append command instance.
     *
     * @param string $body
     */
    public function __construct($thread_id, $content)
    {
        $this->thread_id = $thread_id;
        $this->content = $content;
    }
}
