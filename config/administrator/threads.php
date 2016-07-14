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
    'title'   => '话题',
    'heading' => '话题',
    'single'  => '话题',
    'model'   => 'Hifone\Models\Thread',

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '标题',
            'sortable' => false,
        ],
        'order' => [
            'title'    => '排序',
        ],
        'user' => [
            'title'    => '用户',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return admin_link(
                    $model->user->username,
                    'users',
                    $model->user_id
                );
            },
        ],
        'node' => [
            'title'    => '分类',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return admin_link(
                    $model->node->name,
                    'nodes',
                    $model->node_id
                );
            },
        ],
        'is_excellent' => [
            'title'    => '是否是推荐',
        ],
        'is_blocked' => [
            'title'    => '是否被屏蔽',
        ],
        'reply_count' => [
            'title'    => '回帖数量',
        ],
        'view_count' => [
            'title'    => '查看数量',
        ],
        'favorite_count' => [
            'title'    => '收藏数量',
        ],
        'like_count' => [
            'title'    => '被赞数量',
        ],

        'operation' => [
            'title'  => '管理',
            'output' => function ($value, $model) {
            },
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title'    => '标题',
            'sortable' => false,
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'username',
            'autocomplete'       => true,
            'search_fields'      => ["CONCAT(id, ' ', username)"],
            'options_sort_field' => 'id',
        ],
        'node' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
        'body_original' => [
            'title'    => 'Markdown 原始内容',
            'hint'     => '请使用 Markdown 格式填写',
            'type'     => 'textarea',
        ],
        'order' => [
            'title'    => '排序',
        ],
        'is_excellent' => [
            'title'    => '是否是推荐',
            'type'     => 'enum',
            'options'  => [
                'yes' => '是',
                'no'  => '否',
            ],
            'value' => 'no',
        ],
        'is_blocked' => [
            'title'    => '是否被屏蔽',
            'type'     => 'enum',
            'options'  => [
                'yes' => '是',
                'no'  => '否',
            ],
            'value' => 'no',
        ],
        'reply_count' => [
            'title'    => '回帖数量',
        ],
        'view_count' => [
            'title'    => '查看数量',
        ],
        'favorite_count' => [
            'title'    => '收藏数量',
        ],
        'like_count' => [
            'title'    => '被赞数量',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '内容 ID',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => ["CONCAT(id, ' ', username)"],
            'options_sort_field' => 'id',
        ],
        'node' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', screen_name)"],
            'options_sort_field' => 'id',
        ],
        'body_original' => [
            'title'    => 'Markdown 原始内容',
        ],
        'order' => [
            'title'    => '排序',
        ],
        'is_excellent' => [
            'title'    => '是否是推荐',
            'type'     => 'enum',
            'options'  => [
                'yes' => '是',
                'no'  => '否',
            ],
            'value' => 'no',
        ],
        'is_blocked' => [
            'title'    => '是否被屏蔽',
            'type'     => 'enum',
            'options'  => [
                'yes' => '是',
                'no'  => '否',
            ],
            'value' => 'no',
        ],
        'view_count' => [
            'type'                => 'number',
            'title'               => '查看次数',
            'thousands_separator' => ',', //optional, defaults to ','
            'decimal_separator'   => '.',   //optional, defaults to '.'
        ],
    ],
    'rules'   => [
        'title' => 'required',
    ],
    'messages' => [
        'title.required' => '请填写标题',
    ],
];
