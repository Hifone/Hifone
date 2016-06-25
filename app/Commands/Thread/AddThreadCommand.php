<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Thread;

final class AddThreadCommand
{
    public $title;

    public $body;

    public $user_id;

    public $node_id;

    public $tags;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'title'   => 'required|string',
        'body'    => 'required|string',
        'user_id' => 'int',
        'node_id' => 'int',
    ];

    /**
     * Create a new add thread command instance.
     *
     * @param string $body
     */
    public function __construct($title, $body, $user_id, $node_id, $tags)
    {
        $this->title = $title;
        $this->body = $body;
        $this->user_id = $user_id;
        $this->node_id = $node_id;
        $this->tags = $tags;
    }
}
