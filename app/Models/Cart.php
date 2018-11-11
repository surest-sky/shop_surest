<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    public function productSkus()
    {
        return $this->belongsTo(ProductSku::class,'product_sku_id','id');
    }

    public static function getCartByProductSkus()
    {
        $user = Auth::user();

        $products = collect([]);

        $carts = self::with(['productSkus','productSkus.image','productSkus.product.category'])->where('user_id',$user->id)->get();

        return $carts;
    }


    public function getImageAttribute()
    {
        return $this->productSkus->image->src;
    }

    public function getNameAttribute()
    {
        return $this->productSkus->name;
    }

    public function getCnameAttribute()
    {
        return $this->productSkus->product->category->name;
    }

    public function getPriceAttribute()
    {
        return $this->productSkus->price;
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
