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
        # 检测是否使用redis缓存
        if( self::isRedis() ){
            return self::getRedisCategory();
        }else{
            return self::getFileCategory();
        }
    }

    public function setCacheCategory()
    {
        # 检测是否使用redis缓存
        if( self::isRedis() ){
            return self::setRedisCategory();
        }else{
            return self::setFileCategory();
        }
    }
    /**
     * 从redis中获取缓存
     */
    public static function getRedisCategory()
    {

    }

    /**
     * 设置redis缓存
     */
    public static function setRedisCategory()
    {

    }

    /**
     * 从文件中缓存缓存
     */
    public static function getFileCategory()
    {
        $key = self::getCategoryKey();
        $categories = Cache::get($key);
        if( !$categories ){
            $categories = self::setFileCategory();
        }
        $categories = unserialize($categories);
        return $categories;
    }

    /**
     * 设置文件缓存
     */
    public static function setFileCategory()
    {
        $key = self::getKey();
        # 获取所有的分类数据
        $expirAt = Carbon::now()->addDays(10);
        $categories = Category::with(['product'])->orderBy('created_at','DESC')
            ->get();

        $categories = serialize($categories);
        Cache::put($key,$categories,$expirAt);
        return $categories;
    }

    /**
     * 获取某个分类下的商品数据
     * @param $id int 分类id
     * @return CategoryCacheTrait[]|\Illuminate\Database\Eloquent\Collection|mixed|string
     */
    public static function getCategoryByProduct($id)
    {
        $key = self::setByProductKey($id);
        $products = Cache::get($key);
        if( !$products ){
            $products = self::setCategoryByProduct($id);
        }
        $products = unserialize($products);
        return $products;
    }

    public static function setCategoryByProduct($id)
    {
        $key = self::setByProductKey($id);
        $expirAt = Carbon::now()->addDays(10);
        $products = Product::with(['image','category'])->orderBy('created_at','DESC')->where('category_id',$id)
                      ->get();
        $products = serialize($products);
        Cache::put($key,$products,$expirAt);

        return $products;
    }


    public static function isRedis()
    {
        return (boolean)config('main.redis_open');
    }

    public static function setByProductKey($id)
    {
        return 'category_by_product' . $id;
    }

    public static function getCategoryKey()
    {
        return 'category_index';
    }
}