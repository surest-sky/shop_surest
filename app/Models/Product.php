<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Traits\ProductCacheTrait;

class Product extends Model
{

    use ProductCacheTrait;

    public $guarded = [];

    const total = 10;

    const type = 'DESC';

    /**
     * 获取所有的商品数据
     * @param bool $page true = 分页数据获取 false = 获取全部数据
     * @return Product[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection|mixed|string|void
     */
    public static function getProductsAll($page=true)
    {
        if( $page ) {
            $products = self::getPageProduct();
        }else{
            $products = self::getAllProduct();
        }
        return $products;
    }

    /**
     * 后台管理模块
     * 分页数据获取商品数据
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPageProduct()
    {
        $products = self::with(['productSkus','category'])->orderBy('created_at',self::type)
                    ->paginate(self::total);

        return $products;
    }

    /**
     * 从缓存中获取所有的商品
     * @return Product[]|Collection|mixed|string|void
     */
    public static function getAllProduct()
    {
        $products = self::getCacheProduct();
        return $products;
    }

    /**
     * 关联图片
     * 一对一
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class,'product_id','id');
    }

    /**
     * 关联分类
     * 多对一
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    /**
     * 关联sku
     * 一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSkus()
    {
        return $this->hasMany(ProductSku::class,'product_id','id');
    }


    /**
     * 修改器
     * @return int
     */
    public function getStockAttribute()
    {
        $stock = 0;
        foreach ($this->productSkus as $sku){
            $stock += $sku->stock;
        }
        return $stock;
    }

    public function getRatingXingAttribute()
    {
        $value = $this->rating;
        $value= max(1,sprintf('%d',$value));
        return str_repeat('⭐',$value);
    }

    public function getSku1Attribute()
    {
        return $this->productSkus->first();
    }

    public function getSku2Attribute()
    {
        return $this->productSkus->last();
    }

    public function getProductImgAttribute()
    {
        return $this->image->src;
    }

    public function getPriceAttribute($value)
    {
        return '￥' . $value;
    }
}
