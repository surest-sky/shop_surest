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
        return $this->hasOne(Image::class,'product_sku_id','id');
    }
}
