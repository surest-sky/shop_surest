<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/10
 * Time: 12:24
 */

namespace App\Http\Traits;

use App\Models\Banner;
use Illuminate\Support\Facades\Redis;

trait BannerCacheTrait
{

    /**
     * 从redis中获取数据
     */
    public static function getCacheBanner()
    {
        # 检测是否使用redis缓存
        return self::getRedisBanner();
    }

    /**
     * 从redis中获取缓存
     */
    public static function getRedisBanner()
    {
        # 获取所有轮播图数据

        $banners = Redis::HGETALL(Banner::key);

        if( empty($banners) ) {
            # 写数据
            $banners = self::setRedisBanner();
        }

        $banners = call_user_func('collect',array_map('unserialize',$banners));

        return $banners;
    }

    /**
     * 设置redis缓存
     */
    public static function setRedisBanner()
    {
        $banners = Banner::with(['product.image','product.category'])
            ->withOnly('product',['name','rating','review_count','price','category_id'])
            ->select('id','description','product_id')
            ->get();

        foreach ($banners as $banner) {
            Redis::HSET(Banner::key,$banner->id,serialize($banner));
        }

        return Redis::HGETALL(Banner::key);
    }
}