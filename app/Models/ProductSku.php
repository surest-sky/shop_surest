<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    public function image()
    {
        return $this->hasMany(Image::class,'product_sku_id','id');
    }
}
