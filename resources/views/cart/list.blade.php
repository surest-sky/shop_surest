@extends('layout.layout')
@section('title','我的愿望清单')
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container">
            <div class="container">
                <div class="cart-area ptb-60">
                    <div class="container">
                        <div class="cart-wrapper">
                            <h3 class="h-title mb-30 t-uppercase">My Cart</h3>
                            <table id="cart_list" class="cart-list mb-30">
                                <thead class="panel t-uppercase">
                                <tr>
                                    <th>商品名称</th>
                                    <th>商品价格</th>
                                    <th>商品数量(限100)</th>
                                    <th>商品总价</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                    <tr class="panel alert">
                                    <td>
                                        <div class="media-left is-hidden-sm-down">
                                            <figure class="product-thumb">
                                                <img src="{{ $cart->image }}" alt="product">
                                            </figure>
                                        </div>
                                        <div class="media-body valign-middle">
                                            <h6 class="title mb-15 t-uppercase"><a href="#">{{ $cart->name }}</a></h6>
                                            <div class="type font-12"><span class="t-uppercase">归类 : </span>{{ $cart->cname }}</div>
                                        </div>
                                    </td>
                                    <td>￥{{ $cart->price }}</td>
                                    <td>
                                        <input class="quantity-label" type="number" onchange="amount(this)" value="{{ $cart->amount }}">
                                    </td>
                                    <td>
                                        <div class="sub-total">￥{{ $cart->totalPrice }}</div>
                                    </td>
                                    <td>
                                        <button type="button" class="close" onclick="cart_del(this,'{{ $cart->id }}')">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="cart-price">
                                <h5 class="t-uppercase mb-20">购物车结算</h5>
                                <ul class="panel mb-20">

                                    <li>
                                        <div class="item-name">
                                            优惠券
                                        </div>
                                        <div>
                                            <input type="text" class="form-control input-lg search-input" name="优惠券" id="" value="aaaa">
                                        </div>
                                        <div>
                                            <button class="btn btn-lg btn-search btn-block">检查优惠券</button>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="item-name">
                                            优惠前
                                        </div>
                                        <div class="price" id="before-price">
                                            ￥{{ $totalPrice }}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item-name">
                                            优惠额度
                                        </div>
                                        <div class="price" id="sale-price">
                                            0
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item-name">
                                            <strong class="t-uppercase">最后价格</strong>
                                        </div>
                                        <div class="price" id="after-price" >
                                            ￥{{ $totalPrice }}
                                        </div>
                                    </li>
                                </ul>
                                <div class="t-right">
                                    <a href="checkout_method.html" class="btn btn-rounded btn-lg">支付</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop

@section('script')
    <script>
        function cart_del(obj,id)
        {
            var r=confirm("是真的要删除它吗")
            var price = $(obj).parents("tr").find('.sub-total').html();

            if (r==true)
            {
                $.ajax({
                    type: 'delete',
                    url: '{{ route('cart.delete') }}',
                    dataType: 'json',
                    data: {
                        _method: 'delete',
                        id: id,

                    },
                    success: function (data, text, response) {
                        if (response.status == 200) {
                            swal('删除成功','','success');
                            $(obj).parents("tr").remove();
                            edit_price(price)
                        } else {
                            swal('系统错误','','error');
                        }
                    },
                    error: function (error) {
                        swal('系统错误','','error');
                    }
                });
            }
        }

        function amount(obj) {
            if( $(obj).val() <= 0 || $(obj).val() > 100 ){
                $(obj).val(1);
                swal('选择商品数量在1-100之间','','error');
                return;
            }

            var num = $(obj).val();

        }
        
        function edit_price(price) {
            var total = parseInt($('#after-price').html());
            var sale_price = parseInt($('#sale-price').html());

            $('#after-price').html(total-price);
            $('#before-price').html(price);

        }

    </script>
@stop
