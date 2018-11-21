@extends('layout.layout')
@section('title','我的愿望清单')
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-20">
            <div class="container">
                <section class="wishlist-area ptb-30">
                    <div class="container">
                        <div class="wishlist-wrapper">
                            <h3 class="h-title mb-40 t-uppercase">我的收藏列表</h3>
                            <table id="cart_list" class="wishlist">
                                <tbody>

                                @if($products->count())

                                @foreach($products as $product)
                                <tr class="panel alert">
                                    <td class="col-sm-8 col-md-9">
                                        <div class="media-left is-hidden-sm-down">
                                            <figure class="product-thumb">
                                                <img src="{{ $product->image->src }}" alt="product">
                                            </figure>
                                        </div>
                                        <div class="media-body valign-middle">
                                            <h5 class="title mb-5 t-uppercase"><a href="{{ route('product.show',['id' => $product->id]) }}">{{ $product->name }}</a></h5>
                                            <div class="rating mb-10">
                                                        <span class="rating-stars rate-allow" data-rating="{{ $product->rating }}">
				                        		<i class="fa fa-star-o"></i>
				                        		<i class="fa fa-star-o"></i>
				                        		<i class="fa fa-star-o"></i>
				                        		<i class="fa fa-star-o star-active"></i>
				                        		<i class="fa fa-star-o"></i>
				                        	</span>
                                                <span class="rating-reviews">
				                        		( <span class="rating-count">{{ $product->review_count }}</span> 评论 )
                                                        </span>
                                            </div>
                                            <h4 class="price color-green"><span class="price-sale"></span>{{ $product->strPrice }}</h4>
                                            <button class="btn btn-rounded btn-sm mt-15 is-hidden-sm-up">添加到购物车</button>
                                        </div>
                                    </td>
                                    <td class="col-sm-1">
                                        <button type="button" class="close pr-xs-0 pr-sm-10" onclick="product_del(this,'{{ $product->id }}')">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                                @else
                                    <tr class="panel alert">
                                        <h3>你暂时没有收藏哦</h3>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@stop

@section('script')
    <script>
        function product_del(obj,id)
        {
            var r=confirm("是真的要删除它吗")
            var count = $('#wish_count').text();
            if (r==true)
            {
                $.ajax({
                    type: 'delete',
                    url: '{{ route('wish.delete') }}',
                    dataType: 'json',
                    data: {
                        _method: 'delete',
                        id: id,
                    },
                    success: function (data, text, response) {
                        if (response.status == 200) {
                            swal('删除成功','','success');
                            $(obj).parents("tr").remove();
                            $('#wish_count').text(parseInt(count)-1);
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

    </script>
@stop
