<?php

return [
    'title'   => '节点',
    'heading' => '节点',
    'single'  => '节点',
    'model'   => 'Hifone\Models\Node',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '名称',
            'sortable' => false,
        ],
        'slug' => [
            'title'    => 'Slug',
            'sortable' => false,
        ],
        'description' => [
            'title'    => '描述',
            'sortable' => false,
        ],
        'section' => [
            'title'    => '分类',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return admin_link(
                    $model->section->name,
                    'sections',
                    $model->section_id
                );
            },
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
        ],
        'slug' => [
            'title' => 'Slug',
        ],
        'description' => [
            'title' => '描述',
            'type' => 'textarea',
        ],
        'section' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'slug' => [
            'title' => 'Slug',
        ],
        'description' => [
            'title' => '描述',
        ],
        'section' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', screen_name)"),
            'options_sort_field' => 'id',
        ],
    ],
    'rules'   => [
        'name' => 'required|min:1|unique:nodes'
    ],
    'messages' => [
        'name.unique'   => '分类名在数据库里有重复，请选用其他名称。',
        'name.required' => '请确保名字至少一个字符以上',
    ],
];