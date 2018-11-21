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

            Redis::set($key,serialize($products));

            Redis::PEXPIRE(Product::key,\Carbon\Carbon::now()->addDays(1)->timestamp);

            $products = Redis::get(Product::key);
        }

        $products = call_user_func('unserialize',$products);

        return $products;
    }


    public static function simpleByCacheProduct($id)
    {
        $key = Product::simpleKey;

        $product = Redis::get($key);

        if( !$product ) {
            $product = Product::with(['image','category','productSkus'])
                ->orderBy('created_at','DESC')
                ->where('id',$id)
                ->first();

            if($product) {
                Redis::set($key,serialize($product));

                Redis::PEXPIRE(Product::key,\Carbon\Carbon::now()->addDays(3)->timestamp);

                $product = Redis::get(Product::key);
            }
        }

        return $product ? call_user_func('unserialize',$product) : false;
    }
}