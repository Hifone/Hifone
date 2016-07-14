<?php

return [

    'title' => 'Settings',
    'single'=>'setting',
    'model'=>'Hifone\Models\Setting',
    'columns'=>[
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
    'edit_fields'=>[
        'name' => [
            'type'=>'text',
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