<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\RefundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Express;
use App\Http\Requests\Admin\ShipRequest;
use App\Http\Requests\Admin\RefundRequest;

class OrderController extends Controller
{
    /**
     * 订单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $orders = Order::getOrdersAll();
        $ordersAll = Order::getOrdersAll(false);

        return view('admin.order.list',compact('orders','ordersAll'));
    }

    /**
     * 显示订单详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $id = $request->id;
        if( !$order = Order::find($id) ) {
            return view('admin.error.title',['msg' => "订单不存在"]);
        }
//        $expresses = Express::getAll();

        # 快递讯息
//        $result = Express::getDetail($order);
        $expresses = $result = [];
        return view('admin.order.show', compact('order','expresses','result'));
    }

    /**
     * 处理物流单子模块
     * @param ShipRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ship(ShipRequest $request)
    {
        $order = Order::find($request->id);
        $order->ship_status = Order::SHIP_STATUS_DELIVERED;
        $order->ship_data = $request->serial .  '-' . $request->ship_no;
        $order->save();
        return redirect()->back();
    }

    /**
     * 处理退款请求
     */
    public function refund(RefundRequest $request)
    {
        $order = Order::find($request->oid);
        $agreen = $request->agreen;

        try {
            # 同意退货
            if( $agreen == 'y') {
                if( !Order::refundHandler($order) ){
                    return response()->json([
                        'msg' => 'yes'
                    ],500);
                }

                # 通知邮箱
                Order::sendInfo($order,['管理员已经同意退款']);

            }else{  # 退款失败
                $order->refund_status = Order::REFUND_STATUS_FAILED;
                $order->save();

                # 通知邮箱
                Order::sendInfo($order,['退款失败']);
            }

            return response()->json([
                'msg' => 'yes'
            ],200);

        }catch (\Exception $e) {
            throw new RefundException([
                'message' => '执行退款等操作失败: ' . $e->getMessage()
            ]);
        }
    }
}
