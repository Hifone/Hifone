<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Credit;

final class AddCreditCommand
{
    public $user_id;

    public $rule_id;

    public $balance;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'user_id'   => 'int',
        'rule_id'   => 'int',
        'balance'   => 'int',
    ];

    /**
     * Create a new add credit command instance.
     *
     * @param string $body
     */
    public function __construct($user_id, $rule_id, $balance)
    {
        $this->user_id = $user_id;
        $this->rule_id = $rule_id;
        $this->balance = $balance;
    }
}
