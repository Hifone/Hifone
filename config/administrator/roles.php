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
    'title'   => '用户组',
    'heading' => '用户组',
    'single'  => '用户组',
    'model'   => 'Hifone\Models\Role',

    'permission' => function () {
        // return Auth::user()->hasRole('developer');
        return true;
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'display_name' => [
            'title'    => '显示名称',
            'sortable' => false,
        ],
        'name' => [
            'title' => '标识',
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
        'display_name' => [
            'title' => '显示名称',
        ],
        'name' => [
            'title' => '标识',
        ],
        'perms' => [
            'type'       => 'relationship',
            'title'      => '权限',
            'name_field' => 'display_name',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'display_name' => [
            'title' => '显示名称',
        ],
        'name' => [
            'title' => '标识',
        ],
    ],

    'rules' => [
        'name'         => 'required|max:15|unique:roles,name',
        'display_name' => 'required|unique:roles,display_name',
    ],

    'messages' => [
        'name.required'         => '标识不能为空',
        'name.unique'           => '标识已存在',
        'display_name.required' => '显示名称不能为空',
        'display_name.unique'   => '显示名称已存在',
    ],
];
