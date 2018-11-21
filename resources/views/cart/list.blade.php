@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.css') }}">
@stop

@section('title','我的购物车')

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container">
            <div class="container">
                <div class="cart-area ptb-60">
                    <form action="{{ route('order.create') }}" method="post">
                        @csrf()

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($status = session('$status') )
                            {{ $status }}
                        @endif

                        <div class="container">
                        <div class="cart-wrapper">
                            <h3 class="h-title mb-30 t-uppercase">我的购物车</h3>
                            <table id="cart_list" class="cart-list mb-30">
                                <thead class="panel t-uppercase">
                                <tr>
                                    <th>商品名称</th>
                                    <th>商品价格</th>
                                    <th>商品数量(限10)</th>
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
                                            <input type="hidden" name="pids[]" value="{{ $cart->productSku->id }}">
                                            <h6 class="title mb-15 t-uppercase"><a href="{{ route('product.show',['id' => $cart->productSku->product->id ]) }}">{{ $cart->name }}</a></h6>
                                            <div class="type font-12"><span class="t-uppercase">归类 : </span>{{ $cart->cname }}</div>
                                        </div>
                                    </td>
                                    <td>￥{{ $cart->price }}</td>
                                    <td>
                                        <input class="quantity-label" type="number" name="count[]" data-price="{{ $cart->productSku->price }}" onchange="amount(this)" value="{{ $cart->amount }}">
                                    </td>
                                    <td>
                                        <div class="sub-total">￥ <span class="single-total-price">{{ $cart->totalPrice }}</span></div>
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
                                <ul class="panel mb-20" style="overflow: visible">
                                    <li>
                                        <div class="item-name">
                                            优惠券
                                        </div>
                                        <div>
                                            <input type="text" disabled class="form-control input-lg search-input" name="优惠券" id="" value="暂未开启">
                                        </div>
                                        <div>
                                            <button type="button" disabled onclick="" class="btn btn-lg btn-search btn-block">检查优惠券</button>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="item-name">
                                            优惠前
                                        </div>
                                        <div class="price">￥<span id="before-price">{{ $totalPrice }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item-name">
                                            优惠额度
                                        </div>
                                        <div class="price"><span id="sale-price">0</span></div>
                                    </li>
                                    <li>
                                        <div class="item-name">
                                            收货地址选择
                                        </div>
                                        <div class="price">
                                            <select name="address_id" id="select">
                                                @foreach($addresses as $address)
                                                    <option value="{{ $address->id }}">{{ $address->addresses }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item-name">
                                            <strong class="t-uppercase">最后价格</strong>
                                        </div>
                                        <div class="price" >￥<span id="after-price">{{ $totalPrice }}</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="t-right">
                                    <button type="submit" class="btn btn-rounded btn-lg">支付</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@stop

@section('script')
    <script src="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.js') }}"></script>
    <script>
        $('#select').searchableSelect();
        $('.searchable-select-caret').remove();
        function cart_del(obj,id)
        {
            var r = confirm("是真的要删除它吗")
            var price = $(obj).parents("tr").find('.single-total-price').html();

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
            if( $(obj).val() <= 0 || $(obj).val() > 10 ){
                $(obj).val(1);
                swal('选择商品数量在1-10之间','','error');
            }
            var price = $(obj).attr('data-price'); // 原价
            var num = $(obj).val();

            $(obj).parents('tr').find('.single-total-price').html( run(parseInt(price) * num) );

            // 改变数量后计算所有价格
            calculate();
            return;

        }

        /**
         * 获取当前删除的价格
         * 获取当前的优惠价格
         * 优惠后的价格
         * @param price
         */
        function edit_price(price) {

            var after_price = parseInt($('#before-price').html());  // 优惠前
            var before_price = parseInt($('#after-price').html());  // 优惠后

            $('#after-price').html(run((before_price - price)));
            $('#before-price').html( run((before_price - price)))

        }

        function run($price) {
            return $price.toFixed(2);
        }

        /**
         * 计算所有的价格
         */
        function calculate() {

            var total_price = 0;
            $('.single-total-price').each(function () {
                total_price += parseInt( $(this).html() );
            })

            var sale_price = $('#sale-price').html(); // 优惠额度

            var after_price = Math.ceil(total_price - sale_price); // 优惠后

            // 优惠前的价格
            $('#before-price').html( run(total_price) );
            $('#after-price').html( run(after_price) );
        }

        // 检查优惠券
        function checkCoupon(obj,code) {
            // 检查优惠券
            swal({
                title: "<b>如遇验证码错误，请手动点击图片：</b><br/><img src='{!! captcha_src() !!}' onclick=\"this.src = '{!! captcha_src() !!}' + '?' + +Math.random();\">",
                input: 'text',
                showCancelButton: true,
                confirmButtonText: '提交',
                cancelButtonText: '取消',
                showLoaderOnConfirm: true,
                preConfirm: function(captcha) {
                    return new Promise(function (resolve) {
                        $.ajax({
                            async: false,
                            type : 'POST',
                            url: '{{ route('register.account')}}',
                            data: {
                                'account' : account,
                                'captcha' : captcha
                            },
                            success:function (data) {
                                $('#key').val(data['key']);
                                $(this).val('已发送').css({"background" : "#c12d2b"}).attr('disabled',true);
                                $('#account').attr('disabled','true');
                                _alert('验证码已经发送',true)
                            },
                            error:function (data) {
                                var msg = data.responseJSON;
                                console.log(data);
                                if( data.status == 422 ) {
                                    if( typeof msg.errors.captcha !== 'undefined' ) {
                                        _alert(msg.errors.captcha[0],false);
                                    }else if( typeof msg.account !== 'undefined' ){
                                        _alert(msg.account[0],false);
                                    }
                                }else if(data.status == 401) {
                                    _alert(msg.errors,false);
                                }else{
                                    _alert('请正确检查邮箱或者手机号码',false);
                                }
                                return;
                            }
                        })
                    })
                }
            });

        }
    </script>
@stop
