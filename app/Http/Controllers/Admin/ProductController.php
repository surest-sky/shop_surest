<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/8
 * Time: 19:55
 */

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController
{
    public function list()
    {
        $products = Product::with(['category'])->get();

        return view('admin.product.list',compact('products'));
    }

    // 添加用户
    public function addOrEdit(Request $request)
    {
        $product = null;
        $id = $request->id ?? null;
        if( $id ) {
            $product = Product::find($id);
        }
//        return view('admin.product.add_edit',compact('product','id'));

    }
}