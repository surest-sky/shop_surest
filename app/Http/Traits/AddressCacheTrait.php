<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 9:31
 */

namespace App\Http\Traits;

use App\Models\Address;
use Illuminate\Support\Facades\Redis;

trait AddressCacheTrait
{
    public static function getAddress($id)
    {
        return self::getAddressByUser($id);
    }

    public static function getAddressByUser($id)
    {
        $addresses = Redis::hget(Address::key,$id);

        if( !$addresses ) {
            $addresses = self::setAddressByUser($id);
        }

        $addresses = call_user_func('unserialize',$addresses);

        return $addresses;
    }

    public static function setAddressByUser($id)
    {
        $addresses = Address::where('user_id',$id)->select('id','phone','address','detail')->get();

        Redis::hset(Address::key,$id,serialize($addresses));

        return Redis::hget(Address::key,$id);
    }

}