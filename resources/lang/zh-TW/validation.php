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

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'   => ':attribute 必須是可以接受的。',
    'active_url' => ':attribute 不是一個有效的 URL 網址。',
    'after'      => ':attribute 必須在 :date 之後。',
    'alpha'      => ':attribute 只能包含字母。',
    'alpha_dash' => ':attribute 只能包含字母，數字和破折號。',
    'alpha_num'  => ':attribute 只允許包含字母和數字。',
    'array'      => ':attribute 必須是個數目。',
    'before'     => ':attribute 必須在 :date 之前。',
    'between'    => [
        'numeric' => ':attribute 必須在 :min 到 :max 之間。',
        'file'    => ':attribute 必須在 :min 到 :max KB 之間。',
        'string'  => ':attribute 必須在 :min 到 :max 字數之間。',
        'array'   => ':attribute 必須在 :min 到 :max 個數目之間。',
    ],
    'boolean'        => ':attribute 必須为 true（正確） 或者 false（錯誤）',
    'confirmed'      => ':attribute 與需要確認的項目不符',
    'date'           => ':attribute 不是個有效日期',
    'date_format'    => ':attribute 不符合 :format 的格式',
    'different'      => ':attribute 和 :other 不能相同。',
    'digits'         => ':attribute 必須是  :digits  位数。',
    'digits_between' => ':attribute 必須在 :min 和 :max 位之間。',
    'email'          => ':attribute 必須是個有效的電子郵件地址。',
    'exists'         => '選擇的 :attribute 無效。',
    'filled'         => ':attribute 欄位必須填寫。',
    'image'          => ':attribute 必須是圖片。',
    'in'             => '選擇的 :attribute 無效。',
    'integer'        => ':attribute 必須是整数。',
    'ip'             => ':attribute 必須是一個有效的 IP 位址。',
    'json'           => ':attribute 必須是符合規範的 JSON 字串。',
    'max'            => [
        'numeric' => ':attribute 不能大於 :max。',
        'file'    => ':attribute 不能大於 :max KB。',
        'string'  => ':attribute 不能大於 :max 個字元。',
        'array'   => ':attribute 不能超过 :max 個。',
    ],
    'mimes' => ':attribute 檔案類型必须是 :values。',
    'min'   => [
        'numeric' => ':attribute 最少是  :min。',
        'file'    => ':attribute 至少需要 :min KB。',
        'string'  => ':attribute 最少需要 :min 個字符。',
        'array'   => ':attribute 最少需要 :min 個。',
    ],
    'not_in'               => '選擇的 :attribute 無效。',
    'numeric'              => ':attribute 必須是数字。',
    'regex'                => ':attribute 格式无效。',
    'required'             => ':attribute 欄位必填。',
    'required_if'          => ':attribute 欄位在 :other 是 :value 時是必须填写的。',
    'required_unless'      => ':attribute 是必須的除非 :other 在 :values 中。',
    'required_with'        => '當含有 :values 時， :attribute 是必需的。',
    'required_with_all'    => '當含有 :values 時， :attribute 是必需的。',
    'required_without'     => '當 :values 不存在時， :attribute 是必需的。',
    'required_without_all' => '一個 :values 也没有时 :attribute 區域是必填的。',
    'same'                 => ':attribute 和 :other  必需互相符合。',
    'size'                 => [
        'numeric' => ':attribute 必須是  :size',
        'file'    => ':attribute 必須是 :size KB 大小',
        'string'  => ':attribute 必須是 :size 個字元',
        'array'   => ':attribute 必須包含 :size 個',
    ],
    'string'   => ':attribute 必須是一串文字。',
    'timezone' => ':attribute 必須是個有效的時區。',
    'unique'   => ':attribute 已經被使用',
    'url'      => ':attribute 的格式無效',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => '自動欄位',
        ],
        'name' => [
            'required' => '名稱不能為空白',
        ],
        'title' => [
            'required' => '標題不能為空',
        ],
        'slug' => [
            'required' => 'Slug 不能為空',
        ],
        'node_id' => [
            'required' => '請選擇頁面',
        ],
        'body' => [
            'required' => '内容不能為空',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
