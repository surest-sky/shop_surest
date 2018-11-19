<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/19
 * Time: 9:10
 */

namespace App\Redis;

use Illuminate\Support\Facades\Redis;


class ActiveUserCache
{
    /**
     * 设置活跃用户的分数
     * @param $ids
     */
    public static function setActiveUser($id,$grade)
    {
        $key  = config('rket.active_key');
        $keyUserInfo  = config('rket.active_info_key');

        # 检查活跃的用户里面是否已经写入数据，如果存在则忽略
        if( !Redis::zrank($key,$id) ) {
            $user = \App\Models\User::where('id',$id)->select('name','id','avatar')->first();
            Redis::hmset($keyUserInfo.$id,'name',$user->name,'avatar',$user->avatar,'id',$id);
        }

        #
        return Redis::zincrby($key,$grade,$id);
    }

    /**
     * 取出活跃用户的分数
     * @param $id
     */
    public static function getActiveUser($len=10)
    {
        $key  = config('rket.active_key');
        $users = Redis::zrevrange($key,0,$len,'WITHSCORES');
        if( empty($users) ) {
            return false;
        }
        return $users;
    }

    /**
     * 删除活跃用户的信息
     */
    public static function delActiveUser()
    {
        $key  = config('rket.active_key');
        Redis::del($key);
    }


    public static function getUserDetail($id)
    {
        $keyUserInfo  = config('rket.active_info_key');
        return Redis::hgetAll($keyUserInfo.$id);
    }



}