<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
    public function show(Request $request)
    {
        $id = $request->id;
        if( !$products = Category::getCategoryByProduct($id) ){
            return view('error.404','未找到分类');
        }

        return view('category.show',compact('products'));
    }
}
