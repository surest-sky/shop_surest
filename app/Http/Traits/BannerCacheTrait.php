<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/10
 * Time: 12:24
 */

namespace App\Http\Traits;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

trait BannerCacheTrait
{

    /**
     * 从redis中获取数据
     */
    public static function getCacheBanner()
    {
        # 检测是否使用redis缓存
        if( self::isRedis() ){
            return self::getRedisBanner();
        }else{
            return self::getFileBanner();
        }
    }

    public static function setCacheBanner()
    {
        # 检测是否使用redis缓存
        if( self::isRedis() ){
            return self::setRedisBanner();
        }else{
            return self::setFileBanner();
        }
    }
    /**
     * 从redis中获取缓存
     */
    public static function getRedisBanner()
    {

    }

    /**
     * 设置redis缓存
     */
    public static function setRedisBanner()
    {

    }

    /**
     * 从文件中缓存缓存
     */
    public static function getFileBanner()
    {
        $key = self::getBannerKey();
        $banners = Cache::get($key);
        if( !$banners ){
            $banners = self::setFileBanner();
        }
        $banners = unserialize($banners);
        return $banners;
    }

    /**
     * 设置文件缓存
     */
    public static function setFileBanner()
    {
        $key = self::getBannerKey();
        # 获取所有的分类数据
        $expirAt = Carbon::now()->addDays(10);
        $banners = Banner::with(['product','product.category','product.image'])->orderBy('created_at','desc')->get();

        $banners = serialize($banners);
        Cache::put($key,$banners,$expirAt);
        return $banners;
    }



    public static function isRedis()
    {
        return (boolean)config('main.redis_open');
    }


    public static function getBannerKey()
    {
        return 'banner_index';
    }
}