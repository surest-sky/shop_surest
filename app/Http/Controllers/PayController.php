<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderException;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Policies\OwnPolicy;
use Carbon\Carbon;
use App\Logs\BaseLoghandler;
use App\Notifications\OrderToMail;
use Endroid\QrCode\QrCode;

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

        # 发起支付
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


    /**
     * 微信登录
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function payByWechat(Request $request, Order $order)
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
            'out_trade_no' => $order->no,  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee' => $order->total_price * 100, // 与支付宝不同，微信支付的金额单位是分。
            'body'      => '支付付款 - 测试' , // 订单描述
        ];

        # 发起支付
        $wechatOrder =  app('wechat')->scan($data);

        $qCode = new QrCode($wechatOrder->code_url);

        return response($qCode->writeString(),200,['Cotent-Type' => $qCode->getContentType()]);

    }

    /**
     * 微信服务器端回调
     * @return bool
     */
    public function WechatNotify()
    {
        try {
            $data = app('wechat')->verify();

            # 支付成功
            Order::apliy_success($data->out_trade_no,$data->transaction_id,$data->timestamp,true);

            # 写日志
            $logger = new BaseLoghandler(config('log.order'));

            $logger->write('Alipay-success: ' . $data->all());

            return app('wechat')->success();

        }catch (\Exception $exception) {
            $logger = new BaseLoghandler(config('log.sys'));
            $logger->write('Alipay-error: '.$exception->getMessage());
        }
    }

    // 微信退款回调异步
    public function wechatRefundNotify(Request $request)
    {
        // 给微信的失败响应
        $failXml = '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[FAIL]]></return_msg></xml>';

        $data = app('wechat')->verify(null, true);

        // 没有找到对应的订单，原则上不可能发生，保证代码健壮性
        if(!$order = Order::where('no', $data['out_trade_no'])->first()) {
            return $failXml;
        }

        if ($data['refund_status'] === 'SUCCESS') {
            // 退款成功，将订单退款状态改成退款成功
            $order->update([
                'refund_status' => Order::REFUND_STATUS_SUCCESS,
            ]);

        } else {
            $order->update([
                'refund_status' => Order::REFUND_STATUS_FAILED,
            ]);

        }
        return app('wechat')->success();
    }
}
