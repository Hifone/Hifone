<?php

return [
    'title'   => '第三方接入',
    'heading' => '第三方接入',
    'single'  => '第三方接入',
    'model'   => 'Hifone\Models\Provider',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '名称',
            'sortable' => false,
        ],
        'slug' => [
            'title'    => '标识',
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
        'name' => [
            'title' => '名称',
            'type'  => 'text',
        ],
        'slug' => [
            'title' => '标识',
            'type'  => 'text',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'slug' => [
            'title' => '标识',
        ],
    ],
];