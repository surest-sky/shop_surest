<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/18
 * Time: 22:44
 */

namespace App\Redis;

use Illuminate\Support\Facades\Redis;

class LoginCache
{

    /**
     * 记录登录时间
     */
    public static function setLoginAt($id)
    {
        $key = config('rket.login_key');

        # 使用hash结构登录信息

        # 检查当前用户是否已经保存到其中了，如果没有执行写入当前用户的登录信息
        $res = Redis::hexists($key,$id);
        if( !$res ) {
            $now = \Carbon\Carbon::now();
            Redis::hset($key,$id,$now);
            return $now;
        }
            return false;
    }

    /**
     * 从缓存中获取最近的登录信息
     * @param $id
     * @return bool
     */
    public static function getLoginAt($id)
    {
        $key = config('rket.login_key');

        $res = Redis::hexists($key,$id);
        if( $res ) {
            return Redis::hget($key,$id);
        }
        return false;
    }

    /**
     * 写入到数据库
     */
    public static function writeDatebase()
    {
        
    }

    /**
     * 每天晚上0.00 分删除所有的key
     */
    public static function delLoginAt()
    {
        
    }
}