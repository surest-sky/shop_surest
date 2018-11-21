<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Requests\CartRequest;
use App\Models\Address;

class CartController extends Controller
{
    public function list()
    {
        $id = \Auth::id();

        $carts = Cart::getCacheCart($id);

        $totalPrice = $this->totalAllPrice($carts);

        $addresses = Address::getAddress($id);

        return view('cart.list',compact('carts','totalPrice','addresses'));
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

    public function create(CartRequest $request)
    {
        $skuId = $request->skuId;
        $uid = \Auth::id();
        $amount = $request->amount ?? 1;

        # 查找购物车中是否有库存
        # 存在库存的话则++
        if( $cart = Cart::where('user_id',$uid)->Where('product_sku_id',$skuId)->first() ) {
            $cart->increment('amount',1);
        }else{
            Cart::create([
                'user_id' => $uid,
                'product_sku_id' => $skuId,
                'amount' => $amount
            ]);
        }
        return redirect()->route('cart');
    }
}
