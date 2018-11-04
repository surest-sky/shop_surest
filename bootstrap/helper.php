<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/1
 * Time: 21:21
 */

/**
 * 获取静态文件的地址
 * @return string
 */
function getAssets() {
    return config('APP_URL') . config('mian.assets');
}

function checkParamType($value) {
    if( filter_var($value,FILTER_VALIDATE_EMAIL) ) {
        return 'email';
    }

    $res = filter_var($value,FILTER_CALLBACK,[
        'options' => function ($value){
            if( preg_match('/^1[34578]\d{9}$/',$value) ) {
                return 'phone';
            }
        }
    ]);

    return false;
}