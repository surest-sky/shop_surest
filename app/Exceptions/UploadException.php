<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/9
 * Time: 13:09
 */

namespace App\Exceptions;

use App\Logs\BaseLoghandler;

class UploadException extends BaseException
{
    protected $message = '上传图片错误'; // 错误信息

    protected $code = 500; // 错误代码

    public function __construct($err=[])
    {
        parent::__construct($err);
        $this->report();
        $this->render();
    }
    public function report()
    {
        $logger = new BaseLoghandler(config('log.sms'));
        $logger->write($this->message);
    }

    public function render()
    {
        $result = [
            'code' => 404,
            'msg' => '上传组件出现问题，请检查日志',
            'data' => [
                'src' => '',
                'title' => 'upload'
            ]
        ];
        return response()->json($result,200);
    }
}