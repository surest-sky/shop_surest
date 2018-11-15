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
     * 从redis中获取数据
     */
    public static function getCacheProduct()
    {
        # 检测是否使用redis缓存
        if( self::isRedis() ){
            return self::getRedisProduct();
        }else{
            return self::getFileProduct();
        }
    }

    public static function setCacheProduct()
    {
        # 检测是否使用redis缓存
        if( self::isRedis() ){
            return self::ssetFileProduct();
        }else{
            return self::setFileProduct();
        }
    }

    /**
     * 从redis中获取缓存
     */
    public static function getRedisProduct()
    {

    }

    /**
     * 设置redis缓存
     */
    public static function setRedisProduct()
    {

    }

    /**
     * 从文件中缓存缓存
     */
    public static function getFileProduct()
    {
        $products = Cache::get('product_index');
        if( !$products ){
            $products = self::setFileProduct();
        }
        $products = unserialize($products);
        return $products;
    }

    /**
     * 设置文件缓存
     */
    public static function setFileProduct()
    {
        # 获取所有的分类数据
        $expirAt = Carbon::now()->addDays(10);
        $products = Product::with(['productSkus.image','category','image'])->orderBy('created_at','DESC')
            ->where('actived',1)
            ->get();

        $products = serialize($products);
        Cache::put('product_index',$products,$expirAt);
        return $products;
    }

    public static function isRedis()
    {
        return (boolean)config('main.redis_open');
    }
}