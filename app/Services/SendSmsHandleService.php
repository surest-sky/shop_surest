<?php
/**
 * Created by PhpStorm.
 * User: dcf
 * Date: 2018/10/6
 * Time: 15:09
 */

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SendSmsHandleService
{
    public function handler($phone,$len=5)
    {
        $sendSmsService = new SendSmsService();
        $result = [
            'msg' => '',
            'status' => false,
            'code' => '',
            'key' => ''
        ];


        $minutes = Carbon::now()->addMinute(10);

        $key = 'verify_' . str_random(10);

        if( env('APP_ENV','') === 'local' ) {
            $sendSms = true;
            $code = 1234;
        }else{
            $code = $this->setCode($len);
            $sendSms = $sendSmsService->easysms($phone , $code);
        }
        if( $sendSms ) {
            $result['status'] = true;
            $result['code'] = $code;
            $result['key'] = $key;

            $data = [
              'phone' => $phone,
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
}