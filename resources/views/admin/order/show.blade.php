@extends('admin.common.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.css') }}">
@stop
@section('css')
    <style>
        .bb {
            font-weight: bold;
        }
        tr>td:first-child{
            font-weight: bold;
        }
    </style>
@stop
@section('body')
    
    <body>
        <div class="x-body">
            <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="default">订单流水号：{{ $order->no }}</a></legend>
            </fieldset>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="color: red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="layui-table">
                <tbody>
                <tr>
                    <td>买家：</td>
                    <td>{{ $order->user->name }}</td>
                    <td>支付时间：</td>
                    <td>{{ $order->paid_at }}</td>
                </tr>
                <tr>
                    <td>支付方式：</td>
                    <td>{{ $order->pay_method }}</td>
                    <td>支付渠道单号：</td>
                    <td>{{ $order->pay_no }}</td>
                </tr>
                <tr>
                    <td>收货地址</td>
                    <td colspan="3">{{ $order->address }}</td>
                </tr>
                <tr>
                    <td rowspan="{{ count($order->extra['product_skus'])+1 }}">商品列表</td>
                    <td>商品名称</td>
                    <td>单价</td>
                    <td>数量</td>
                </tr>
                @foreach($order->extra['product_skus'] as $sku)
                <tr>
                    <td style="font-weight: normal">{{ $sku['name'] }}</td>
                    <td>￥{{ $sku['price']  }}</td>
                    <td>{{ $sku['count']  }}</td>
                </tr>
                @endforeach
                <tr>
                    <td>订单金额：</td>
                    <td colspan="3">￥{{ $order->total_price }}</td>
                </tr>
                <tr>
                    <td>订单金额：</td>
                    <td>￥{{ $order->total_price }}</td>
                    <!-- 这里也新增了一个发货状态 -->
                    <td>发货状态：</td>
                    <td>{{ $order->shipOrstatus }}</td>
                </tr>
                <!-- 订单发货开始 --><!-- 如果订单未发货，展示发货表单 -->
                <tr>
                    <td>退款状态：</td>
                    <td colspan="2">{{ $order->refundOrStatus }}，理由：2</td>
                    <td>
                        <!-- 如果订单退款状态是已申请，则展示处理按钮 -->
                    </td>
                </tr>

                {{--@if($order->)--}}
                @if($order->pay_status == \App\Models\Order::PAY_STATUS_DELIVERED && $order->ship_status == \App\Models\Order::SHIP_STATUS_PENDING)
                    <form action="{{ route('admin.order.ship') }}" method="post">
                        @csrf()
                <tr>
                    <td>发货：</td>
                    <td>
                        <select name="serial" id="select">
                            @foreach($expresses as $express)
                                <option value="{{ $express->serial }}">{{ $express->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="1">
                        <input type="text" name="ship_no" placeholder="物流单号" autocomplete="off" class="layui-input">
                        <input type="hidden" name="id" value="{{ $order->id }}">
                    </td>
                    <td>
                        <button type="submit" class="layui-btn" >发货</button>
                    </td>
                </tr>
                    </form>

                @elseif($data = $order->shipOrdata)
                    <tr>
                    <td rowspan="2">物流信息： </td>
                    <td colspan="2">{{ $data['company'] }}</td>
                    <td>{{ $data['no'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <ul class="layui-timeline">
                                @foreach($result as $value)
                                <li class="layui-timeline-item">
                                    <div class="layui-timeline-content layui-text">
                                        <h3 class="layui-timeline-title">{{ $value['AcceptTime'] }}</h3>
                                        <p>{{ $value['AcceptStation'] }}</p>
                                    </div>
                                    <hr>
                                </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </body>
@stop

@section('script')
    <script src="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.js') }}"></script>
    <script>
        $(function(){
            $('#select').searchableSelect();
        });
    </script>
@stop
