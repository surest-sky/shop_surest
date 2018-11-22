<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $pid = $request->id;
        if( !$pid || !$product = Product::getSimpleProduct($pid) ) {
            return view('error.404',['msg'=>'商品不存在']);
        }

        $cid = $product->category->id;

        # 推荐
        $goods = Product::getGoodsProductOnCategory($cid,$pid)->take(4);

        return view('product.simple',compact('product','goods'));
    }

    public function list(Request $request,Product $product)
    {
        $products = Product::getProductsAll(false);

        $sort = $request->sort ?? 'new';

        $products = $product->productSort($products,$sort);

        $currentPage = $request->current ?? 1;

        # 分页数据组装
        $result = $product->productPage($products,$currentPage);

        $products = $result['products'];

        return view('product.show',compact('products','sort','result'));
    }
}
