<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/10
 * Time: 12:24
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Product;

trait ProductCacheTrait
{
    /**
     * @param $p boolean 传递一个布尔值，表示是否强制更新最新的商品数据
     * 不对缓存做校验
     * @return Product[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public static function latestProduct($p=false)
    {

        $key = Product::latest;
        $len = Product::len;

        $products = Redis::get($key);

        $keyIds = Product::latest . '_ids';

        if( !$products || $p ) {
            $products = Product::with(['image','category'])
                ->orderBy('created_at','DESC')
                ->limit($len)
                ->get();
            if( $products ) {

                $ids  = $products->pluck('id')->toArray();

                Redis::set( $keyIds , serialize($ids) );

                Redis::set($key,serialize($products));

                Redis::PEXPIRE(Product::key,\Carbon\Carbon::now()->addDays(1)->timestamp);

                $products = Redis::get($key);
            }else{
                return call_user_func('collect',[]);
            }
        }

        $products = call_user_func('unserialize',$products);

        return $products;
    }


    public static function simpleByCacheProduct($id)
    {
        $key = Product::simpleKey.$id;

        $product = Redis::get($key);


        if( !$product ) {
            $product = self::setSimpleByCacheProduct($id);
        }

        return $product ? call_user_func('unserialize',$product) : false;
    }

    public static function setSimpleByCacheProduct($id)
    {
        $key = Product::simpleKey.$id;

        $product = Product::with(['image','category','productSkus','productSkus.image'])
            ->where('id',$id)
            ->first();
        if($product) {

            # 更新最新商品的缓存
            self::getlatestOrUpdateCache($id);

            Redis::set($key,serialize($product));

            Redis::PEXPIRE($key,\Carbon\Carbon::now()->addDays(3)->timestamp);

            $product = Redis::get($key);
        }else{
            $product = null;
        }
            return $product;
    }

    public static function setPartByCacheProduct($ids)
    {
        $ids = collect($ids)->pluck('product_id')->toArray();

        foreach ($ids as $id) {

            # 更新单个商品的缓存
            self::setSimpleByCacheProduct($id);
        }
    }

    public static function remove($pid)
    {
        $key = Product::simpleKey.$pid;

        if( self::simpleByCacheProduct($pid) ) {
            Redis::del($key);
        }
        
    }

    /**
     * 触发这个缓存将更新最新商品的缓存
     * 传入的id是商品的id
     * 通过校验商品id是否存在于最新商品的id中，则更新
     * @param $id integer 商品id
     * @return bool
     */
    public static function getlatestOrUpdateCache($id)
    {
        $key = Product::latest . '_ids';

        if( $ids = Redis::get($key) ) {
            $ids = call_user_func('unserialize',$ids );

            if( in_array($id,$ids) ) {
                self::latestProduct(true);
                return true;
            }
        }
        return false;
    }

}