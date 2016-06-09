<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Identity;

final class AddIdentityCommand
{
    public $user_id;

    public $provider_id;

    public $extern_uid;

    public $nickname;

    public $data;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'user_id'     => 'int|required',
        'provider_id' => 'int|required',
        'extern_uid'  => 'int|required',
    ];

    /**
     * Create a new add thread command instance.
     *
     * @param string $body
     */
    public function __construct($user_id, $data)
    {
        $this->user_id = $user_id;
        $this->data = $data;
    }
}
