<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/4
 * Time: 12:39
 */

namespace App\Exceptions;


class HttpException extends BaseException
{
    protected $message = '请求错误'; // 错误信息

    protected $code = 404; // 错误代码

    public function report()
    {

    }

}