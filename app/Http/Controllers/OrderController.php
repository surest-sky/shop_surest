<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Express;
use App\Http\Requests\RefundRequest;

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

        # 快递讯息
        $result = Express::getDetail($order);

        return view('order.simple',compact('order','extra','result'));

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
            return redirect()->route('cart');
        }

        $order = Order::createNewOrder($result,$data);

        return redirect()->route('order.show',['id' => $order->id]);

    }

    /**
     * 退款处理
     * @param Request $request
     */
    public function refund(RefundRequest $request)
    {
        $refund_reason = $request->refund_reason;
        $order = Order::where('id',$request->id)->select('id','refund_reason','ship_status')->first();
        $order->refund_status = Order::REFUND_STATUS_PROCESSING;
        $order->refund_reason = $refund_reason;
        $order->save();

        session()->flash('status','申请退款成功');
        return redirect()->back();
    }
}
