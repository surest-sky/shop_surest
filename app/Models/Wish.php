<?php

namespace App\Models;

use App\Exceptions\SysException;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Wish extends Model
{
    public $fillable = [
        'product_id'
    ];

    public $casts = [
        'product_ids' => 'json'
    ];


    /**
     * 通过关联取出 收藏表的数据
     * @return array|\Illuminate\Support\Collection
     */
    public function products()
    {
        $productIds = $this->product_ids;

        $products = [];

        $productAll = Product::getCacheProduct();

        foreach ($productIds as $id) {
            if( $product = $productAll->find($id) ) {
                array_push($products,$product);
            }
        }
        $products = collect($products);

        return $products;
    }


    /**
     * 更新愿望商品
     * @param array $ids
     * @return bool|void
     */
//    public function update($ids)
//    {
//
//    }

    public static function remove($pid)
    {
        try{
            $uid = \Auth::id();
            $pids = collect(self::getProducts($uid)->pluck('id')->toArray());

            $pids = $pids->diff($pid)->toArray();

            $wish = self::where('user_id',$uid)->first();
            $wish->product_ids = $pids;
            $wish->save();
            return true;
        }catch (\Exception $e){
            throw new SysException([
                'message' => $e->getMessage()
            ]);
        }
    }

    public static function getProducts()
    {
        $uid = \Auth::id();
        if( $wish = self::where('user_id',$uid)->first() ) {
            $products = $wish->products();
            return $products;
        }
        return collect([]);
    }
}
