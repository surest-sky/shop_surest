<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Product extends Model
{

    public $guarded = [];

    const total = 10;

    const type = 'DESC';


    public static function getProductsAll($page=true)
    {
        if( $page ) {
            $products = self::getPageProduct();
        }else{
            $products = self::getAllProduct();
        }
        return $products;
    }

    public static function getPageProduct()
    {
        $products = self::with(['productSkus','category'])->orderBy('created_at',self::type)
                    ->paginate(self::total);

//        $products = $products instanceof Collection ? $products : Collection::make($products);

        return $products;
    }

    public static function getAllProduct()
    {
        $products = self::with(['productSkus','category'])->orderBy('created_at',self::type)
            ->get();
        return $products;
    }

    public function image()
    {
        return $this->hasOne(Image::class,'product_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function productSkus()
    {
        return $this->hasMany(ProductSku::class,'product_id','id');
    }

    public function getStockAttribute()
    {
        $stock = 0;
        foreach ($this->productSkus as $sku){
            $stock += $sku->stock;
        }
        return $stock;
    }

    public function getRatingAttribute($value)
    {
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

}
