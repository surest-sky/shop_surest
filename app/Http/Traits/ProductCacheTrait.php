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
    public static function latestProduct()
    {

        $key = Product::latest;
        $len = Product::len;

        $products = Redis::get($key);

        if( !$products ) {
            $products = Product::with(['image','category'])
                ->orderBy('created_at','DESC')
                ->limit($len)
                ->get();
            if( $products ) {
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

}