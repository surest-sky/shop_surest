<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/4
 * Time: 16:49
 */

namespace App\Exceptions;

use App\Logs\BaseLoghandler;

class SmsException extends BaseException
{
    protected $message = '短信组件问题'; // 错误信息

    protected $code = 500; // 错误代码

    public function report()
    {
        $logger = new BaseLoghandler(config('log.sms'));
        $logger->write($this->message);
    }

    public function render()
    {
        
    }
}