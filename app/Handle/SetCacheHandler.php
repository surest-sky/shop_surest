<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 14:17
 */

namespace App\Handle;
use Illuminate\Support\Carbon;


class SetCacheHandler
{
    public static function setCache($value)
    {
        $key = 'forget_' . setCode(10);
        $expirAt = Carbon::now()->addMinute(1);

        \Cache::put($key,$value,$expirAt);

        return $key;
    }

    public static function getCache($key)
    {
        if( $val = \Cache::get($key) ) {
            return $val;
        }
        return false;
    }
}