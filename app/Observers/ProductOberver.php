<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/9
 * Time: 16:47
 */

namespace App\Observers;

use App\Models\Product;
use App\Models\Image;

class ProductOberver
{
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