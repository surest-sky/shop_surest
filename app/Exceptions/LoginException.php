<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 18:09
 */

namespace App\Exceptions;


class LoginException extends BaseException
{
    protected $message = [
        'address' => '登录问题',
        'msg' => '授权失败'
    ]; // 错误信息
    protected $code = 403; // 错误代码
    protected $time;

    /**
     * 复写写入日志代码
     * 普通错误不需要写入日志
     */
    public function report()
    {

    }
}