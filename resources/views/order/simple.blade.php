@extends('layout.layout')
@section('css')
<style>
    td,th{
        text-align: center;
    }
</style>
@stop

@section('title','我的愿望清单')

@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-12 row-tb-20">

                    <div class="page-sidebar col-xs-12 col-sm-12 col-md-12">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="color: red;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Blog Sidebar -->
                        <aside class="sidebar blog-sidebar">
                            <div class="row row-tb-10">
                                <div class="col-xs-12">
                                    <!-- Recent Posts -->
                                    <div class="widget checkout-widget panel p-20">
                                        <div class="widget-body">
                                            <table class="table" border="1">
                                                <tbody >
                                                <tr>
                                                    <th colspan="3">订单号 : {{ $order->no }}</th>
                                                </tr>
                                                <tr>
                                                    @if($order->closed)
                                                    <th>订单状态 : <i style="color: #ff472a;">已关闭</i></th>
                                                    @else
                                                    <th>订单状态 : <i style="color: #ff472a;">{{ $order->status }}</i></th>
                                                    @endif
                                                    <th>支付状态 : <i style="color: #ff472a;">{{ $order->payOrStatus }}</i></th>
                                                    <th>物流状态 : <i style="color: #ff472a;">{{ $order->shipOrStatus }}</i></th>
                                                </tr>
                                                <tr>
                                                    <th>商品名称</th>
                                                    <th>商品单价 * 商品数量</th>
                                                    <th>使用的优惠券</th>
                                                </tr>
                                                @foreach($extra['product_skus'] as $productSku)
                                                <tr>
                                                    <td><a href="{{ route('product.show',['id'=>$productSku['product_id']]) }}">{{ $productSku['name'] }}</a></td>
                                                    <td>{{ $productSku['price'] }} * {{ $productSku['count'] }}</td>
                                                    <td>无</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th>物流信息： {{ $order->address }}</th>
                                                    <th colspan="1">商品总量: {{ sprintf('%d',$order->total_count) }}</th>
                                                    <th colspan="2">商品总价: {{ $order->total_price }}</th>
                                                </tr>

                                                {{-- 检查是否能退款 --}}
                                                @if($order->refund_status == \App\Models\Order::REFUND_STATUS_PENDING &&
                                                    $order->pay_status == \App\Models\Order::PAY_STATUS_DELIVERED )
                                                    <form action="{{ route('order.refund',['id' => $order->id]) }}" method="post">
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="form-group">
                                                                    <input type="text" name="refund_reason" id="" placeholder="请输入退款理由" class="form-control">
                                                                </div>
                                                            </td>
                                                            <td colspan="1">
                                                                <button type="submit" id="refund" class="btn btn-success btn-block btn-sm">申请退款</button>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @else
                                                    <tr style="font-weight: bold">
                                                        <td>退款信息 </td>
                                                        <td>退款理由： {{ $order->refund_reason ?? '' }}</td>
                                                        <td>退款状态: {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}</td>
                                                    </tr>
                                                @endif


                                                {{-- 物流信息存在的情况下 --}}
                                                @if($data = $order->shipOrdata)
                                                    <tr>
                                                        <th colspan="3">收货地址： {{ $data['company'] . '-' . $data['no'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <ul class="layui-timeline">
                                                                @foreach($result as $value)
                                                                    <li class="layui-timeline-item">
                                                                            <span>{{ $value['AcceptTime'] }}</span>
                                                                            <p>{{ $value['AcceptStation'] }}</p>
                                                                        <hr>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>

                                            {{-- 订单未关闭的情况下 --}}
                                            @if(!$order->closed)

                                                <div class="row row-tb-10">
                                                    <div class="col-xs-12  col-md-6">
                                                        <a id="wx_pay" href="javascript:;" type="button" data-no="{{ $order->no }}" data-id="{{ $order->id }}" class="btn btn-success btn-block btn-sm">微信支付</a>
                                                    </div>
                                                    <div class="col-xs-12  col-md-6">
                                                        <a href="{{ route('pay.alipay', ['id' => $order->id]) }}" type="button" data-no="{{ $order->no }}" class="btn btn-info btn-block btn-sm">支付宝支付</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Recent Posts -->
                                </div>
                            </div>
                        </aside>
                        <!-- End Blog Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Container -->


    </main>
@stop
@section('script')
    <script>
        $('#wx_pay').on('click',function () {
            var id = $(this).attr('data-id');

            swal({
                title: '微信支付',
                text: '支付完成后请刷新查看',
                imageUrl: '{{ route('pay.wechat', ['id' => $order->id]) }}',
                imageWidth: 200,
                imageHeight: 200,
                animation: false
            })
        })
    </script>
@stop

