<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * 我的所有订单
     */
    public function list()
    {
        $orders = Auth::user()->orders;

        return view('order.list',compact('orders'));
    }
    
    /**
     * 我的订单
     */
    public function show(Request $request)
    {
        $id = $request->id;

        if( !$order = Order::where('user_id',Auth::id())->where('id',$id)->first() ) {
            return view('error.404',['msg' => '订单未找到']);
        }

        $extra = $order->extra;

        return view('order.simple',compact('order','extra'));

    }


    /**
     * 准备订单
     * @param Request $request
     */
    public function create(OrderRequest $request)
    {
        if (!$data = Order::prePareData($request)) {
            session()->flash('status', '参数错误');
            return redirect()->back();
        }

        # 库存信息获取
        $result = Order::checkStock($data);


        if( !$result['stock'] ) {
            session()->flash('status',$result['name'] . '库存不足');
            //                return redirect()->route('order.list');
            dd('库存不足');
        }

        $order = Order::createNewOrder($result,$data);

        return redirect()->route('order.show',['id' => $order->id]);

    }

    /**
     * 创建订单
     * @param Request $request
     */
    public function store(Request $request)
    {

    }
}
