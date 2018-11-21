<?php

namespace App\Models;

use App\Exceptions\SysException;
use App\Http\Traits\WishCacheTrait;

class Wish extends BaseModel
{
    public $fillable = [
        'product_id'
    ];

    public $casts = [
        'product_ids' => 'json'
    ];

    use WishCacheTrait;

    const key = 'wish';

    public static function remove($pid)
    {
        try{
            $uid = \Auth::id();
            $pids = collect(self::getProducts($uid)->pluck('id')->toArray());

            $pids = $pids->diff($pid)->toArray();

            $wish = self::where('user_id',$uid)->first();
            $wish->product_ids = $pids;
            $wish->save();
            return true;
        }catch (\Exception $e){
            throw new SysException([
                'message' => $e->getMessage()
            ]);
        }
    }

    public static function getProducts()
    {
        $id = \Auth::id();
        $products  = self::getWishCache($id);
        return $products;
    }
}
