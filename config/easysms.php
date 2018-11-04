<?php

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'qcloud',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => __DIR__.'/../storage/logs/easy-sms.log',
        ],
        'qcloud' => [
            'sdk_app_id' => env('QCLOUD_APP_ID' , ''), // SDK APP ID
            'app_key' => env('QCLOUD_APP_KEY' , ''), // APP KEY
            'sign_name' => env('QCLOUD_SIGN_NAME' , ''), // 短信签名，如果使用默认签名，该字段可缺省（对应官方文档中的sign）
            'tid' => env('QCLOUD_TID' , '') // 短信模板id
        ],
    ],
];