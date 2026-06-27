<?php

return [

    'accepted' => ':attribute 必须被接受.',
    'accepted_if' => '当 :other 为 :value 时,:attribute 必须被接受.',
    'active_url' => ':attribute 必须是一个有效的 URL.',
    'after' => ':attribute 必须是 :date 之后的日期.',
    'after_or_equal' => ':attribute 必须是 :date 之后或等于该日期.',
    'alpha' => ':attribute 只能包含字母.',
    'alpha_dash' => ':attribute 只能包含字母、数字、破折号和下划线.',
    'alpha_num' => ':attribute 只能包含字母和数字.',
    'array' => ':attribute 必须是数组.',
    'ascii' => ':attribute 只能包含单字节字母数字字符和符号.',
    'before' => ':attribute 必须是 :date 之前的日期.',
    'before_or_equal' => ':attribute 必须是 :date 之前或等于该日期.',

    'between' => [
        'array' => ':attribute 必须有 :min 到 :max 个元素.',
        'file' => ':attribute 必须在 :min 到 :max KB 之间.',
        'numeric' => ':attribute 必须在 :min 到 :max 之间.',
        'string' => ':attribute 必须在 :min 到 :max 个字符之间.',
    ],

    'boolean' => ':attribute 必须为 true 或 false.',
    'can' => ':attribute 包含未授权的值.',
    'confirmed' => ':attribute 确认不匹配.',
    'contains' => ':attribute 缺少必需值.',
    'current_password' => '密码不正确.',
    'date' => ':attribute 必须是有效日期.',
    'date_equals' => ':attribute 必须等于 :date.',
    'date_format' => ':attribute 格式必须为 :format.',
    'decimal' => ':attribute 必须有 :decimal 位小数.',
    'declined' => ':attribute 必须被拒绝.',
    'declined_if' => '当 :other 为 :value 时,:attribute 必须被拒绝.',
    'different' => ':attribute 和 :other 必须不同.',
    'digits' => ':attribute 必须是 :digits 位数字.',
    'digits_between' => ':attribute 必须在 :min 到 :max 位之间.',
    'dimensions' => ':attribute 图片尺寸无效.',
    'distinct' => ':attribute 存在重复值.',
    'doesnt_end_with' => ':attribute 不能以 :values 结尾.',
    'doesnt_start_with' => ':attribute 不能以 :values 开头.',

    'email' => ':attribute 必须是有效的邮箱地址.',
    'ends_with' => ':attribute 必须以 :values 结尾.',
    'enum' => '所选 :attribute 无效.',
    'exists' => '所选 :attribute 无效.',
    'extensions' => ':attribute 必须是以下类型之一::values.',
    'file' => ':attribute 必须是文件.',
    'filled' => ':attribute 不能为空.',

    'gt' => [
        'array' => ':attribute 必须多于 :value 个元素.',
        'file' => ':attribute 必须大于 :value KB.',
        'numeric' => ':attribute 必须大于 :value.',
        'string' => ':attribute 必须多于 :value 个字符.',
    ],

    'gte' => [
        'array' => ':attribute 至少 :value 个元素.',
        'file' => ':attribute 必须大于或等于 :value KB.',
        'numeric' => ':attribute 必须大于或等于 :value.',
        'string' => ':attribute 必须至少 :value 个字符.',
    ],

    'hex_color' => ':attribute 必须是有效的十六进制颜色.',
    'image' => ':attribute 必须是图片.',
    'in' => '所选 :attribute 无效.',
    'in_array' => ':attribute 不存在于 :other 中.',
    'integer' => ':attribute 必须是整数.',
    'ip' => ':attribute 必须是有效 IP 地址.',
    'ipv4' => ':attribute 必须是有效 IPv4 地址.',
    'ipv6' => ':attribute 必须是有效 IPv6 地址.',
    'json' => ':attribute 必须是有效 JSON 字符串.',

    'lt' => [
        'array' => ':attribute 必须少于 :value 个元素.',
        'file' => ':attribute 必须小于 :value KB.',
        'numeric' => ':attribute 必须小于 :value.',
        'string' => ':attribute 必须少于 :value 个字符.',
    ],

    'lte' => [
        'array' => ':attribute 不得超过 :value 个元素.',
        'file' => ':attribute 必须小于或等于 :value KB.',
        'numeric' => ':attribute 必须小于或等于 :value.',
        'string' => ':attribute 必须不超过 :value 个字符.',
    ],

    'mac_address' => ':attribute 必须是有效 MAC 地址.',
    'max' => [
        'array' => ':attribute 最多 :max 个元素.',
        'file' => ':attribute 不能超过 :max KB.',
        'numeric' => ':attribute 不能大于 :max.',
        'string' => ':attribute 不能超过 :max 个字符.',
    ],

    'mimes' => ':attribute 必须是以下类型文件::values.',
    'mimetypes' => ':attribute 必须是以下类型文件::values.',

    'min' => [
        'array' => ':attribute 至少 :min 个元素.',
        'file' => ':attribute 至少 :min KB.',
        'numeric' => ':attribute 至少 :min.',
        'string' => ':attribute 至少 :min 个字符.',
    ],

    'multiple_of' => ':attribute 必须是 :value 的倍数.',
    'not_in' => '所选 :attribute 无效.',
    'not_regex' => ':attribute 格式无效.',
    'numeric' => ':attribute 必须是数字.',
    'password' => '密码不正确.',
    'present' => ':attribute 必须存在.',
    'prohibited' => ':attribute 被禁止.',
    'prohibited_if' => '当 :other 为 :value 时,:attribute 被禁止.',
    'prohibited_unless' => '除非 :other 在 :values 中,否则 :attribute 被禁止.',
    'prohibits' => ':attribute 禁止 :other 存在.',
    'regex' => ':attribute 格式无效.',
    'required' => ':attribute 是必填项.',
    'required_array_keys' => ':attribute 必须包含 :values.',
    'required_if' => '当 :other 为 :value 时,:attribute 必填.',
    'required_unless' => '除非 :other 在 :values 中,否则 :attribute 必填.',
    'required_with' => '当 :values 存在时,:attribute 必填.',
    'required_with_all' => '当 :values 存在时,:attribute 必填.',
    'required_without' => '当 :values 不存在时,:attribute 必填.',
    'required_without_all' => '当 :values 都不存在时,:attribute 必填.',

    'same' => ':attribute 与 :other 必须一致.',
    'size' => [
        'array' => ':attribute 必须包含 :size 个元素.',
        'file' => ':attribute 必须是 :size KB.',
        'numeric' => ':attribute 必须是 :size.',
        'string' => ':attribute 必须是 :size 个字符.',
    ],

    'starts_with' => ':attribute 必须以 :values 开头.',
    'string' => ':attribute 必须是字符串.',
    'timezone' => ':attribute 必须是有效时区.',
    'unique' => ':attribute 已被使用.',
    'uploaded' => ':attribute 上传失败.',
    'url' => ':attribute 必须是有效 URL.',
    'uuid' => ':attribute 必须是有效 UUID.',

    /*
    |--------------------------------------------------------------------------
    | 自定义验证语言
    |--------------------------------------------------------------------------
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定义错误信息',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 自定义属性名称
    |--------------------------------------------------------------------------
    */
    'attributes' => [],
];