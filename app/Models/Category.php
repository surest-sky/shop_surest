<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CategoryCacheTrait;

class Category extends Model
{
    use CategoryCacheTrait;

    public static function getCategoryAll($bol=true)
    {
        $categories = self::getCacheCategory();
        return $categories;
    }

    /**
     * 首页获取分类数量
     * @param int $len
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getByCategory($len=9)
    {
        $categories = self::getCacheCategory()->take($len);
        return $categories;
    }


    public function product()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function getPcountAttribute()
    {
        return $this->product->count();
    }
}
