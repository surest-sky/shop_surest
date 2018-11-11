<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Wish extends Model
{
    public $fillable = [
        'product_id'
    ];


    /**
     * 通过关联取出 收藏表的数据
     * @return array|\Illuminate\Support\Collection
     */
    public function products()
    {
        $productIds = $this->product_ids;
        $productIds = json_decode($productIds,true);

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
}
