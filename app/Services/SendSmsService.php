<?php
/**
 * Created by PhpStorm.
 * User: dcf
 * Date: 2018/10/6
 * Time: 13:24
 */

namespace App\Services;

use App\Exceptions\SmsException;
use Carbon\Carbon;
use Overtrue\EasySms\EasySms;

/**
 * Class SendSmsService 发送短信接口
 * @package App\Services
 */
class SendSmsService
{
    /**
     * easysms - sdk发送
     * @param $phoneNumbers static 电话号码
     * @param $code string 验证码
     * @return bool true为发送成功
     */
    public function easysms($phoneNumbers,$code)
    {
        $config = config('easysms');
        $easySms = new EasySms($config);

        try{
            $result = $easySms->send($phoneNumbers, [
                'template' => config('easysms.gateways.qcloud.tid'),
                'data' => [
                    'code' => $code
                ],
            ]);     // 这里会返回一个发送短信的结果

            if( $result['qcloud']['result']['errmsg'] == 'OK' ) {
                return true;
            }
        }catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception){
            $error = [
                'msg' =>   json_encode($exception->getMessage()),
                'phone' => $phoneNumbers,
                'time' => Carbon::now()
            ];
            throw new SmsException(json_encode($error));
        }
        return false;
    }
}