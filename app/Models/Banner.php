<?php

namespace App\Models;

use App\Http\Traits\BannerCacheTrait;

class Banner extends BaseModel
{
    use BannerCacheTrait;

    public $guarded = [];

    const key = 'banner';

    public $appends = [
        'image',
        'cName'
    ];

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
