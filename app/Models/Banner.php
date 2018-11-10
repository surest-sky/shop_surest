<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\BannerCacheTrait;

class Banner extends Model
{
    use BannerCacheTrait;

    public $guarded = [];

    public function product()
    {
        return $this->hasOne(Product::class , 'id','product_id');
    }

    public function getImageAttribute()
    {
        return $this->product->image->src;
    }

    public function getCNameAttribute()
    {
        return str_limit($this->product->category->name,4,'...');
    }
}
