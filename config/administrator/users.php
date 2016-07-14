<?php

return [
    'title'   => '用户',
    'heading' => '用户',
    'single'  => '用户',
    'model'=>'Hifone\Models\User',
    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'avatar_url' => [
            'title'  => '头像',
            'output' => function ($value) {
                return empty($value) ? 'N/A' : <<<EOD
    <img src="$value" width="80">
EOD;
            },
            'sortable' => false,
        ],
        'username' => [
            'title'    => '用户名',
            'sortable' => false,
        ],
        'nickname' => [
            'title'    => '真实姓名',
            'sortable' => false,
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'is_banned' => [
            'title' => '是否被屏蔽',
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
        'username' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'is_banned' => [
            'title'    => '是否被屏蔽',
            'type'     => 'enum',
            'options'  => [
                'yes' => '是',
                'no'  => '否',
            ],
        ],
        'avatar_url' => [
            'title' => '头像 URL'
        ],
        'location' => [
            'title' => '所处城市'
        ],
        'company' => [
            'title' => '所处公司'
        ],
        'website' => [
            'title' => '个人网站'
        ],
        'signature' => [
            'title' => '个性签名'
        ],
        'nickname' => [
            'title' => '真实姓名'
        ],
        'roles' => array(
            'type'       => 'relationship',
            'title'      => '用户组',
            'name_field' => 'display_name',
        ),
    ],
    'filters' => [
        'id' => [
            'title' => '用户 ID',
        ],
        'name' => [
            'title' => '姓名',
        ],
        'nickname' => [
            'title' => '昵称'
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'roles' => [
            'type'       => 'relationship',
            'title'      => '用户组',
            'name_field' => 'display_name',
        ],
        'is_banned' => [
            'title'    => '是否被屏蔽',
            'type'     => 'enum',
            'options'  => [
                'yes' => '是',
                'no'  => '否',
            ],
        ],
    ],
    'actions' => [],
];