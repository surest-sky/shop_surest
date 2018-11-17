<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    public function list()
    {
        $products = Wish::getProducts();

        return view('wish.list', compact('products') );
    }

    // 删除收藏
    public function delete(Request $request)
    {
        $pid = $request->id;
        if ($pid) {
            if( Wish::remove($pid) ){
                return response()->json([
                    'message' => '删除成功'
                ], 200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ], 404);

    }
}
