<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/19
 * Time: 16:21
 */

namespace App\Exceptions;

use App\Logs\BaseLoghandler;

class WishException extends BaseException
{
    public function __construct($errorInfo=[])
    {
        parent::__construct($errorInfo);
        $this->report();
        $this->render();
    }

    /**
     * 通过日志报告一个异常
     */
    public function report()
    {

        $logger = new BaseLoghandler(config('log.wish'));
        $logger->write($this->message);
    }

    public function render()
    {
        return response()->json([
            'message' => '非法操作'
        ], 404);
    }
}