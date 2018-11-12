<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $guarded = [];

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class,'product_sku_id','id');
    }

    public static function getCartByProductSku()
    {
        $user = Auth::user();

        $products = collect([]);

        $carts = self::with(['productSku','productSku.image','productSku.product.category'])->where('user_id',$user->id)->get();

        return $carts;
    }


    public function getImageAttribute()
    {
        return $this->productSku->image->src;
    }

    public function getNameAttribute()
    {
        return $this->productSku->name;
    }

    public function getCnameAttribute()
    {
        return $this->productSku->product->category->name;
    }

    public function getPriceAttribute()
    {
        return $this->productSku->price;
    }

    public function getTotalPriceAttribute()
    {
        $total = $this->price * $this->amount;
        return sprintf('%.2f',$total);
    }

    public static function remove($pid)
    {
        $uid = Auth::id();
        if( $simple = self::where('id',$pid)->orWhere('user_id',$uid)->first() ){
            $simple->delete();
            return true;
        }

        dd($simple);
        return false;
    }
}
