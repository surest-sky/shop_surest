<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;

class BannerController extends Controller
{
    public function list()
    {
        $banners = Banner::getCacheBanner();

        $products = Product::getAllProduct();

        return view('admin.banner.list',compact('banners','products'));
    }

    // 删除用户
    public function delete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            if ($banner = Banner::find($id)) {
                $banner->delete();
                Banner::setCacheBanner();
                return response()->json([
                    'message' => '删除成功'
                ], 200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ], 404);
    }

    public function create(Request $request)
    {
        $id = $request->product_id;

        if( !Product::find($id) ){
            session()->flash('status','商品不存在');
            return redirect()->back();
        }

        if( Banner::where('product_id',$id)->count() ){
            session()->flash('status','已经存在于其中');
            return redirect()->back();
        }

        Banner::create([
            'product_id' => $id,
            'description' => $request->description ?? ''
        ]);

        Banner::setCacheBanner();

        session()->flash('success','创建成功');

        return redirect()->back();
    }
}
