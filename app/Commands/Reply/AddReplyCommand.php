<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Reply;

final class AddReplyCommand
{
    public $body;

    public $user_id;

    public $thread_id;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'body'      => 'required|string',
        'user_id'   => 'int',
        'thread_id' => 'int',
    ];

    /**
     * Create a new add reply command instance.
     *
     * @param string $body
     */
    public function __construct($body, $user_id, $thread_id)
    {
        $this->body = $body;
        $this->user_id = $user_id;
        $this->thread_id = $thread_id;
    }
}
