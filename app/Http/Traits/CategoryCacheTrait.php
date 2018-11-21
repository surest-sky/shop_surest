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
use App\Models\Category;
use App\Models\Product;

trait CategoryCacheTrait
{

    /**
     * 从redis中获取数据
     */
    public static function getCacheCategory()
    {
        return self::getRedisCategory();
    }

    /**
     * 从redis中获取缓存
     */
    public static function getRedisCategory()
    {
        # 获取所有分类
        # 分类数据包含字段 分类id ， 分类下关联的商品数量，分类名称

        $categories = Redis::HGETALL(Category::key);

        if( empty($categories) ) {
            # 写数据
            $categories = self::setRedisCategory();
        }

        $categories = call_user_func('collect',array_map('unserialize',$categories));

        return $categories;

    }

    /**
     * 设置redis缓存
     */
    public static function setRedisCategory()
    {
        $categories = Category::with(['product.image','product.category'])->withOnly('product',['category_id','name'] )->select('id','name')->get();
        foreach ($categories as $category) {
            Redis::HSET(Category::key,$category->id,serialize($category));
        }

        Redis::PEXPIRE(Category::key,\Carbon\Carbon::now()->addDays(7)->timestamp);

        return Redis::HGETALL(Category::key);
    }

    /**
     * 分类id
     * @param $id
     */
    public static function getCategoryByProduct($id)
    {
        $products = Redis::hget(Category::key,$id);

        $products =  call_user_func('unserialize',$products);

        return $products->product;
    }
}