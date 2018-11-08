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
use App\Models\Category;


class ProductController
{
    public function list()
    {
        $products = Product::getProductsAll();
        $productsAll = Product::getProductsAll(false);

        return view('admin.product.list',compact('products','productsAll'));
    }

    // 添加用户
    public function addOrEdit(Request $request)
    {
        $product = null;
        $id = $request->id ?? null;
        if( $id ) {
            $product = Product::find($id);
        }
        $categoies = Category::all();
        return view('admin.product.add_edit',compact('product','id','categoies'));

    }

    public function upload()
    {
        return response()->json([
            'code' => '0',
            'msg' => '失败',
            'data' => [
                'src' => 'https://ss0.baidu.com/9rkZbzqaKgQUohGko9WTAnF6hhy/pacific/1147952599.jpg',
                'title' => 'upload'
            ]
        ],200);
    }
}