<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    # 需要查询的字段
    public function index()
    {
        $categories = Category::getCategoryAll(true);

        return view('category.index',compact('categories'));
    }

    /**
     * 显示某个分类下的商品数据
     */
    public function show(Request $request,Product $product)
    {
        $id = $request->id;
        if( !$products = Category::getCategoryByProduct($id) ){
            return view('error.404','未找到分类');
        }

        $sort = $request->sort ?? 'new';

        $products = $product->productSort($products,$sort);

        $currentPage = $request->current ?? 1;

        # 分页数据组装
        $result = $product->productPage($products,$currentPage);

        $products = $result['products'];

        return view('category.show',compact('products','sort','result'));
    }


}
