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

                        <!-- Blog Sidebar -->
                        <aside class="sidebar blog-sidebar">
                            <div class="row row-tb-10">
                                <div class="col-xs-12">
                                    <!-- Recent Posts -->
                                    <div class="widget checkout-widget panel p-20">
                                        <div class="widget-body">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th colspan="3">订单号 : {{ $order->no }}</th>
                                                </tr>
                                                <tr>
                                                    @if($order->closed)
                                                    <th>订单状态 : <i style="color: #ff472a;">已关闭</i></th>
                                                    @else
                                                    <th>订单状态 : <i style="color: #ff472a;">{{ $order->status }}</i></th>
                                                    @endif
                                                    <th>支付状态 : <i style="color: #ff472a;">{{ $order->pay_status }}</i></th>
                                                    <th>物流状态 : <i style="color: #ff472a;">{{ $order->ship_status }}</i></th>
                                                </tr>
                                                <tr>
                                                    <th>商品名称</th>
                                                    <th>商品单价 * 商品数量</th>
                                                    <th>使用的优惠券</th>
                                                </tr>
                                                @foreach($extra['product_skus'] as $productSku)
                                                <tr>
                                                    <td><a href="{{ route('product.show',['id'=>$productSku['id']]) }}">{{ $productSku['name'] }}</a></td>
                                                    <td>{{ $productSku['price'] }} * {{ $productSku['count'] }}</td>
                                                    <td>无</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th>收货地址： {{ $order->address }}</th>
                                                    <th colspan="1">商品总量: {{ sprintf('%d',$order->total_count) }}</th>
                                                    <th colspan="2">商品总价: {{ $order->total_price }}</th>
                                                </tr>
                                                </tbody>
                                            </table>
                                            @if(!$order->closed)

                                                <div class="row row-tb-10">
                                                    <div class="col-xs-12  col-md-6">
                                                        <a  href="" type="button" data-no="{{ $order->no }}" class="btn btn-success btn-block btn-sm">微信支付</a>
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
        // $('table>tbody').find('odd')
    </script>
@stop

