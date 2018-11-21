<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 8:32
 */

namespace App\Redis;

use Illuminate\Support\Facades\Redis;
class cartCache
{
    /**
     * @param $id integer 用户的id
     */
    public function getCacheData($id)
    {
        return self::getCartByRedis;
    }
}