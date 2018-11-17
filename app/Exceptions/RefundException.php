<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 14:52
 */

namespace App\Exceptions;
use App\Logs\BaseLoghandler;


class RefundException extends BaseException
{
    public function __construct($errorInfo=[])
    {
        parent::__construct($errorInfo);
        $this->report();

    }

    /**
     * 通过日志报告一个异常
     */
    public function report()
    {

        $logger = new BaseLoghandler(config('log.order'));
        $logger->write($this->message);
    }

    public function render()
    {
        return response()->json([
            'msg' => 'no'
        ],500);
    }
}