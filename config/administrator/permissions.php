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
    'title'   => '用户组权限',
    'heading' => '用户组权限',
    'single'  => '用户组权限',
    'model'   => 'Hifone\Models\Permission',

    'permission' => function () {
        // return Auth::user()->hasRole('Developer');
        return true;
    },
    /*
    'action_permissions' => [
        'create' => function ($model) {
            return false;
        },
        'update' => function ($model) {
            return false;
        },
        'delete' => function ($model) {
            return false;
        },
        'view' => function ($model) {
            return true;
        },
    ],
    */

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '标示',
            'sortable' => false,
        ],
        'display_name' => [
            'title'    => '权限名称',
            'sortable' => false,
        ],
        'description' => [
            'title'    => '描述',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return empty($value) ? 'N/A' : $value;
            },
        ],
        'roles' => [
            'title'  => '用户组',
            'output' => function ($value, $model) {
                $model->load('roles');
                $result = [];
                foreach ($model->roles as $role) {
                    $result[] = $role->display_name;
                }

                return empty($result) ? 'N/A' : implode($result, ' | ');
            },
            'sortable' => false,
        ],
        'operation' => [
            'title'    => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '标示（请慎重修改）',
        ],
        'display_name' => [
            'title' => '权限名称',
        ],
        'description' => [
            'title' => '描述',
        ],
    ],
    'filters' => [
        'name' => [
            'title' => '标示',
        ],
        'display_name' => [
            'title' => '权限名称',
        ],
        'description' => [
            'title' => '描述',
        ],
    ],

    'actions' => [],
];
