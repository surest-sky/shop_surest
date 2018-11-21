<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 10:10
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Redis;
use App\Models\Wish;
use App\Models\Product;

trait WishCacheTrait
{
    /**
     * @param $id integer 用户id
     */
    public static function getWishCache($id)
    {
        return self::getWishByUser($id);
    }

    public static function getWishByUser($id)
    {
        $wishes = Redis::hget( Wish::key, $id);
        if( !$wishes ) {
            if( !$wishes = self::setWishByUser($id) ){
                return collect([]);
            }
        }
        $wishes = call_user_func('unserialize',$wishes);

        return $wishes;
    }

    public static function setWishByUser($id)
    {
        if( !$wish = Wish::where('user_id',$id)->first() ) {
            return false;
        }

        $productIds = $wish->product_ids;

        $productIds = array_map('intval',$productIds);

        $products = Product::with(['image','category'])->whereIn('id',$productIds)->get(['category_id','id','name','description','rating','review_count','sold_count','on_sale','price']);

        Redis::hset(Wish::key,$id,serialize($products));

        Redis::PEXPIRE(Wish::key,\Carbon\Carbon::now()->addDays(1)->timestamp);

        return Redis::hget(Wish::key,$id);
    }
}