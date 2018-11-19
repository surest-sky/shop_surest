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
        # sort - set
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



}