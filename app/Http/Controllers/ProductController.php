<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->id;
        if( !$id || !$product = Product::find($id) ) {
            return view('error.404',['msg'=>'商品不存在']);
        }
        return view('product.show',compact('product'));
    }

    public function showAll(Request $request,Product $product)
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
