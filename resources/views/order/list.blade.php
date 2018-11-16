@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.css') }}">
@stop

@section('title','我的愿望清单')

@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-12 row-tb-20">

                    <div class="page-sidebar col-xs-12 col-sm-12 col-md-12">
                        @if($status = session('status'))
                            {{ $status }}
                        @endif
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
                                                    <th>订单号</th>
                                                    <th>订单信息</th>
                                                    <th>订单总价格</th>
                                                    <th>订单状态</th>
                                                    <th>查看</th>
                                                </tr>

                                                @foreach($orders as $order)
                                                <tr>
                                                        <td><a href="{{ route('order.show',['id' => $order->id]) }}">{{ $order->no }}</a></td>
                                                        <td>
                                                            <ul>
                                                                @foreach($order->extra['product_skus'] as $option)
                                                                    <li>{{ $option['name'] }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                        <td>{{ $order->total_price }}</td>
                                                        <td style="color: red;">{{ $order->status }}</td>
                                                        <td><a href="{{ route('order.show',['id' => $order->id]) }}" class="btn btn-success btn-block btn-sm">查看</a></td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
@stop
