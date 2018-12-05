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
    ];

    public function product()
    {
        return $this->hasOne(Product::class , 'id','product_id');
    }

}
