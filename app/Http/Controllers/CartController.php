<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function list()
    {
        $carts = Cart::getCartByProductSkus();

        $totalPrice = $this->totalAllPrice($carts);

        return view('cart.list',compact('carts','totalPrice'));
    }

    public function totalAllPrice($carts)
    {
        $total = 0;

        foreach ($carts as $cart) {
            $simple_price = $cart->totalPrice;
            $total += $simple_price;
        }
        return sprintf('%.2f',$total);
    }

    // 删除购物车数据
    public function delete(Request $request)
    {
        $pid = $request->id;

        if ($pid) {
            if( Cart::remove($pid) ){
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
