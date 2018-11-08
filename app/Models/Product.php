<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $guarded = [];

    public function getProductsAll()
    {
        return self::all();
    }


    public function image()
    {
        return $this->hasMany(Image::class,'product_id','id');
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
}
