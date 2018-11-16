<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Express;
use App\Http\Requests\Admin\ShipRequest;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::getOrdersAll();
        $ordersAll = Order::getOrdersAll(false);

        return view('admin.order.list',compact('orders','ordersAll'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        if( !$order = Order::find($id) ) {
            return view('admin.error.title',['msg' => "订单不存在"]);
        }
        $expresses = Express::getAll();

        # 快递讯息
        $data = $order->shipOrdata;
        $result = Express::getDetail($data);

        return view('admin.order.show', compact('order','expresses','result'));
    }

    public function ship(ShipRequest $request)
    {
        $order = Order::find($request->id);
        $order->ship_status = Order::SHIP_STATUS_DELIVERED;
        $order->ship_data = $request->serial .  '-' . $request->ship_no;
        $order->save();
        return redirect()->back();
    }
}
