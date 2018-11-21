<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    public $guarded = [
        'skuImg'
    ];
    public function image()
    {
        return $this->hasOne(Image::class,'product_sku_id','id')->select('id','src','product_sku_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'product_sku_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','id')->select('id','category_id');
    }
}
