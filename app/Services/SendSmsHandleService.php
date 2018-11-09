<?php
/**
 * Created by PhpStorm.
 * User: dcf
 * Date: 2018/10/6
 * Time: 15:09
 */

namespace App\Services;


use App\Exceptions\BaseException;
use App\Exceptions\SmsException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SendMailJob;
class SendSmsHandleService
{
    public function handler($account,$type,$len=5)
    {
        $result = [
            'msg' => '',
            'status' => false,
            'code' => '',
            'key' => ''
        ];


        $minutes = Carbon::now()->addMinute(2);

        $key = 'verify_' . str_random(10);

        if( env('APP_ENV','') === 'local' ) {
            $sendSms = true;
            $code = 1234;
        }else{
            // 生成验证码
            $code = $this->setCode($len);
            $sendSms = $this->send($account,$type,$code);

        }
        if( $sendSms ) {
            $result['status'] = true;
            $result['code'] = $code;
            $result['key'] = $key;

            $data = [
              'account' => $account,
              'code' => $code
            ];
            Cache::put($key,$data,$minutes);

        }else{
            $result['msg'] = '发送短信失败，超出频率限制';
        }
        return $result;

    }

    protected function setCode($num)
    {
        $i = 0;
        $code = '';
        while ($i<$num) {
            $code .= random_int(0,9);
            $i++;
        }
        return $code;
    }

    protected function send($account,$type,$code)
    {
        try{
            // 校验是否是手机还是邮箱
            switch ($type) {
                case 'phone' :
                    $sendSmsService = new SendSmsService();
                    $sendSms = $sendSmsService->easysms($account , $code);
                    return $sendSms;
                    break;
                case 'email' :
                    SendMailJob::dispatch($code,$account);
                    break;
                default :
                    throw new SmsException([
                        'message' => '短信组件问题，未知异常，请检查'
                    ]);
            }
            return true;
        }catch (\Exception $e){
            throw new SmsException([
                'message' => ' 短信组件问题: 来自于账号'.$account .$e->getMessage()
            ]);
        }

    }
}