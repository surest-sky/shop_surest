<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/9
 * Time: 15:36
 */

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getParams($request)
    {
        $result = $this->setParams($request);
        return $result;
    }

    public function setParams($request)
    {
        $arr = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'actived' => $request->actived,
            'sold_count' => 0,
            'price' => $this->getMinPrice($request->skus),
            'actived' => intval($request->actived)
        ];

        return $arr;
    }

    public function getStock($skus)
    {
        $stock = 0;
        foreach ($skus as $sku){
            $stock += $sku['stock'];
        }
        return $stock;
    }

    public function getMinPrice($skus)
    {
        $arr = [];
        foreach ($skus as $sku){
           array_push($arr,$sku['price']);
        }
        return min($arr);
    }

    public function getSkusParms($request,$pid)
    {
        $result = $this->setSkusParms($request,$pid);
        return $result;
    }

    public function setSkusParms($request,$pid)
    {
        $skus = $request->skus;

        $arr = [];

        $index = 1;
        foreach ($skus as $sku){
            $arr[$index] = [
                  "product_id" => $pid,
                  "name" => $sku['name'],
                  "description" =>$sku['description'],
                  "price" =>$sku['price'],
                  "stock" => $sku['stock']
            ];
            ++$index;
        }

        return $arr;
    }
}