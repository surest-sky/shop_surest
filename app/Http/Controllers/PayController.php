<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderException;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Policies\OwnPolicy;
use Carbon\Carbon;
use App\Logs\BaseLoghandler;
use App\Notifications\OrderToMail;

class PayController extends Controller
{
    /**
     * 支付宝支付处理
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function payByAlipay(Request $request, Order $order)
    {
        $id = $request->id;
        if( !$order = Order::with('user')->where('id',$id)->first() ) {
            return view('error.404',['msg'=>'订单未找到']);
        }

        # 验证
        $this->authorize('own',$order);

        if( $order->closed || ($order->expir_at < Carbon::now())) {
            return view('error.404',['msg'=>'订单已经关闭']);
        }

        $data = [
            'out_trade_no' => $order->no,
            'total_amount' => $order->total_price,
            'subject' => '支付付款 - 测试',
        ];

        # 发送给用户一个消息，叫他准备支付
        Order::sendInfo($order,'创建订单成功，待支付');

        # 发起字符
        return app('alipay')->web($data);

    }

    /**
     * 支付宝前端回调
     * @param Request $request
     */
    public function alipayReturn(Request $request)
    {
        $data = app('alipay')->verify();

        return view('error.show',['msg'=>'支付成功']);
    }

    /**
     * 支付宝服务器端回调
     * @return bool
     */
    public function alipayNotify()
    {
        try {
            $data = app('alipay')->verify();

            # 支付成功
            Order::apliy_success($data->out_trade_no,$data->trade_no,$data->timestamp);

            # 写日志
            $logger = new BaseLoghandler(config('log.order'));
            $logger->write('Alipay-success: ' . $data->all());

            return true;
        }catch (\Exception $exception) {
            $logger = new BaseLoghandler(config('log.sys'));
            $logger->write('Alipay-error: '.$exception->getMessage());
        }
    }
}
