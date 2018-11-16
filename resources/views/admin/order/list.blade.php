@extends('admin.common.layout')
@section('body')
    <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品管理</cite></a>
              <a><cite>商品列表</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock><span class="x-right" style="line-height:40px">共有数据：{{ $orders->count() }} 条</span></xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    订单号
                </th>
                <th>
                    价格/数量
                </th>
                <th>
                    支付状态
                </th>
                <th>
                    物流状态
                </th>
                <th>
                    退款状态
                </th>
                <th>
                    备注
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        {{ $loop->index+1 }}
                    </td>
                    <td>
                        {{ $order->no }}
                    </td>
                    <td>
                        {{ '￥' . $order->total_price . ' / ' . $order->total_count }}
                    </td>
                    <td >
                        {{ $order->payOrstatus }}
                    </td>
                    <td >
                        {{ $order->shipOrstatus }}
                    </td>
                    <td >
                        {{ $order->refundOrstatus }}
                    </td>
                    {{--<td class="td-status">--}}
                        {{--@if($product->actived)--}}
                            {{--<span class="layui-btn layui-btn-normal layui-btn-mini">--}}
                                {{--已上架--}}
                            {{--</span>--}}
                        {{--@else--}}
                            {{--<span class="layui-btn layui-btn-disabled layui-btn-mini">--}}
                                {{--已下架--}}
                            {{--</span>--}}
                        {{--@endif--}}
                    {{--</td>--}}
                    <td>

                    </td>
                    <td class="td-manage">

                        <a title="查看" href="javascript:;" onclick="order_show('查看','{{{ route('admin.order.show',['id' => $order->id]) }}}')"
                           class="ml-5" style="text-decoration:none">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        @include('admin.common._page',['datas'=>$orders , 'datasAll' => $ordersAll])

    </div>
@stop

@section('script')
    <script>

        var result = 0;
        layui.use(['element','layer'], function(){
            $ = layui.jquery;//jquery
            laydate = layui.laydate;//日期插件
            lement = layui.element();//面包导航
            layer = layui.layer;//弹出层
            //以上模块根据需要引入

        });

        //编辑
        function order_show (title,url,w,h) {
            x_admin_show(title,url,w,h);
        }

    </script>
@stop

