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
    public $action;

    public $user;


    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        //
    ];

    /**
     * Create a new add credit command instance.
     *
     * @param $action
     * @param $user
     */
    public function __construct($action, $user)
    {
        $this->action = $action;
        $this->user = $user;
    }
}
