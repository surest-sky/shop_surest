<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/3
 * Time: 18:01
 */

namespace App\Exceptions;
use Carbon\Carbon;
use Exception;
use App\Logs\BaseLoghandler;


class BaseException extends Exception
{
    protected $message = '系统错误'; // 错误信息

    protected $code = 500; // 错误代码

    protected $time;

    public function __construct($errInfo='')
    {
        if( !is_array($errInfo) || !$errInfo){
            return;
        }
        if( array_key_exists('message',$errInfo) ) {
            $this->message = $errInfo['message'];
        }
        if( array_key_exists('code',$errInfo) ) {
            $this->code = $errInfo['code'];
        }
        $this->time = Carbon::now();
    }

    /**
     * 通过日志报告一个异常
     */
    public function report()
    {
        $logger = new BaseLoghandler(config('log.login'));
        $logger->write($this->message);
    }

    /**
     * 渲染一个错误页面
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->view(
            'error.show',
        [
            'message' => $this->message
        ]
        );
    }
}