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
}
