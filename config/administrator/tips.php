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
    'title'   => '小贴士',
    'heading' => '小贴士',
    'single'  => '小贴士',
    'model'   => 'Hifone\Models\Tip',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'body' => [
            'title'    => '内容',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'body' => [
            'title' => '内容',
            'type'  => 'textarea',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'body' => [
            'title' => '内容',
        ],
    ],
];
