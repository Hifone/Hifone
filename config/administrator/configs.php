<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'title'   => 'Settings',
    'single'  => 'setting',
    'model'   => 'Hifone\Models\Setting',
    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => 'Name',
        ],
        'value' => [
            'title' => 'Value',
        ],
    ],
    'edit_fields' => [
        'name' => [
            'type' => 'text',
        ],
        'value' => [
            'type' => 'textarea',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '变量名',
        ],
        'value' => [
            'title' => '变量值',
        ],
    ],
];
