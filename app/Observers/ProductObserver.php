<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 23:55
 */

namespace App\Observers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;

class ProductObserver
{

    public function deleted(Product $product)
    {
        Product::remove($product->category_id);
    }

    public function updated(Product $product)
    {
        # 创建商品触缓存
        Category::setCategorySimple($product->category_id);
    }

    public function deleting(Product $product)
    {
        $id = $product->id;
        $psku_id1 = $product->productSkus->first()->id;
        $psku_id2 = $product->productSkus->last()->id;
        if( $image = Image::where('product_id',$id)->first() ){
            $image->delete();
        }
        if( $sku_image1 = Image::where('product_sku_id',$psku_id1)->first()){
            $sku_image1->delete();
        }
        if( $sku_image2 = Image::where('product_sku_id',$psku_id2)->first()){
            $sku_image2->delete();
        }

    }


}