@extends("layout.layout")

@section('title',$product->name)
@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-10 row-tb-20">
                    <div class="page-content col-xs-12 col-sm-7 col-md-8">
                        <div class="row row-tb-20">
                            <div class="col-xs-12">
                                <div class="deal-deatails panel">
                                    <div class="deal-slider">
                                        <div id="product_slider" class="flexslider">
                                            <ul class="slides">
                                                <li>
                                                    <img id="image" style="max-width: 620px; max-height: 800px" alt="{{ $product->name }}" src="{{ $product->image->src ?? '' }}">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="deal-body p-20">
                                        <h3 class="mb-10">{{ $product->name }}</h3>
                                        <div class="rating mb-10">
                                                <span class="rating-stars" data-rating="{{ $product->rating }}">
				                        <i class="fa fa-star-o"></i>
				                        <i class="fa fa-star-o"></i>
				                        <i class="fa fa-star-o"></i>
				                        <i class="fa fa-star-o"></i>
				                        <i class="fa fa-star-o"></i>
				                    </span>
                                        </div>
                                        <h2 class="price mb-15">￥{{ $product->price }}</h2><p class="mb-20">{!! $product->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-xs-12">--}}
                                {{--<div class="posted-review panel p-30">--}}
                                    {{--<h3 class="h-title">{{ $product->comments->count() }} 评论</h3>--}}

                                    {{--@foreach($product->comments as $comment)--}}
                                    {{--<div class="review-single pt-30">--}}
                                        {{--<div class="media">--}}
                                            {{--<div class="media-left">--}}
                                                {{--<img class="media-object mr-10 radius-4" src="{{ $comment->user->avatar }}" width="90" alt="">--}}
                                            {{--</div>--}}
                                            {{--<div class="media-body">--}}
                                                {{--<div class="review-wrapper clearfix">--}}
                                                    {{--<ul class="list-inline">--}}
                                                        {{--<li>--}}
                                                            {{--<span class="review-holder-name h5">{{ $comment->user->name }}</span>--}}
                                                        {{--</li>--}}
                                                        {{--<li>--}}
                                                            {{--<div class="rating">--}}
                                                                    {{--<span class="rating-stars" data-rating="5">--}}
										                        {{--<i class="fa fa-star-o"></i>--}}
										                        {{--<i class="fa fa-star-o"></i>--}}
										                        {{--<i class="fa fa-star-o"></i>--}}
										                        {{--<i class="fa fa-star-o"></i>--}}
										                        {{--<i class="fa fa-star-o"></i>--}}
										                    {{--</span>--}}
                                                            {{--</div>--}}
                                                        {{--</li>--}}
                                                    {{--</ul>--}}
                                                    {{--<p class="review-date mb-5">{{ $comment->create_at }}</p>--}}
                                                    {{--<p class="copy">{{ $comment->content }}</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--@endforeach--}}

                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-12">--}}
                                {{--<div class="post-review panel p-20">--}}
                                    {{--<h3 class="h-title">发送评论</h3>--}}
                                    {{--<form class="horizontal-form pt-30" action="#">--}}
                                        {{--<div class="row row-v-10">--}}
                                            {{--<div class="col-sm-6">--}}
                                                {{--<input type="text" class="form-control" placeholder="姓名" value="{{ Auth::user()->name ?? '' }}">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-sm-6">--}}
                                                {{--<input type="text" class="form-control" placeholder="邮件" value="{{ Auth::user()->email ?? '' }}">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12">--}}
                                                {{--<ul class="select-rate list-inline ptb-20">--}}
                                                    {{--<li><span>你的评分: </span>--}}
                                                    {{--</li>--}}
                                                    {{--<li>--}}
                                                            {{--<span class="rating" role="button">--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                    {{--</span>--}}
                                                    {{--</li>--}}
                                                    {{--<li>--}}
                                                            {{--<span class="rating" role="button">--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                    {{--</span>--}}
                                                    {{--</li>--}}
                                                    {{--<li>--}}
                                                            {{--<span class="rating" role="button">--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                    {{--</span>--}}
                                                    {{--</li>--}}
                                                    {{--<li>--}}
                                                            {{--<span class="rating" role="button">--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                    {{--</span>--}}
                                                    {{--</li>--}}
                                                    {{--<li>--}}
                                                            {{--<span class="rating" role="button">--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                        {{--<i class="fa fa-star"></i>--}}
			                                    {{--</span>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12">--}}
                                                {{--<textarea class="form-control" placeholder="你的评论" rows="6"></textarea>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12 text-right">--}}
                                                {{--<button type="submit" class="btn mt-20">发送评论</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="page-sidebar col-md-4 col-sm-5 col-xs-12">
                        <!-- Blog Sidebar -->
                        <form action="{{ route('cart.create') }}" method="post">
                            @csrf()
                            @method('put')
                            <aside class="sidebar blog-sidebar">
                                <div class="row row-tb-10">
                                    <div class="col-xs-12">
                                        <div class="widget single-deal-widget panel ptb-30 prl-20">
                                            <div class="widget-body text-center">
                                                <h2 class="mb-20 h3">
                                                    {{ $product->name }}
                                                </h2>
                                                <ul class="deal-meta list-inline mb-10 color-mid">
                                                    <li><i class="ico fa fa-shopping-basket mr-10"></i>{{ $product->sold_count }} 人购买了</li>
                                                    <br>
                                                    <li>剩余：<span id="p_stock">{{ $product->productSkus->first()->stock }}</span> 件 </li>
                                                    <br>
                                                    <li>请选择一个商品： </li>
                                                </ul>
                                                <div class="price mb-20">
                                                    <ol class="prodcut-sku">
                                                        @foreach($product->productSkus as $sku)
                                                            <li onclick="select_sku(this,{{ $sku->id }})" @if($loop->index+1 == 1) class="active" @endif
                                                            title="{{ $sku->description }}"
                                                                data-img="{{ $sku->image->src ?? '' }}"
                                                                data-price="{{ $sku->price }}"
                                                                data-stock="{{ $sku->stock }}"
                                                            >{{ $sku->name }}</li>
                                                        @endforeach
                                                        <input type="hidden" name="skuId" value="{{ $product->productSkus->first()->id }}">
                                                    </ol>
                                                    <br>
                                                    <label for="">请输入购买量：</label>
                                                    <input id="amount" type="number" name="amount" min=1 value="1">
                                                    <h2 class="price"><span class="price-sale"></span> ￥ <span id="price">{{ $product->price }}</span></h2>
                                                </div>
                                                <div class="buy-now mb-40">
                                                    <button type="submit" class="btn btn-block btn-lg buy">
                                                        <i class="fa fa-shopping-cart font-16 mr-10"></i> 现在购买
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <!-- Best Rated Deals -->
                                        <div class="widget best-rated-deals panel pt-20 prl-20">
                                            <h3 class="widget-title h-title">推荐商品</h3>
                                            <div class="widget-body ptb-30">

                                                @foreach($goods as $good)
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="{{ route('product.show',['id' => $good->id]) }}">
                                                                <img class="media-object" src="{{ $good->image->src ?? '' }}" alt="Thumb" width="80">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-5">
                                                                <a href="{{ route('product.show',['id' => $good->id]) }}">{{ $good->name }}</a>
                                                            </h6>
                                                            <div class="mb-5">
                                                            <span class="rating">
                        <span class="rating-stars" data-rating="{{ $good->rating }}">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                                                            </span>
                                                            </div>
                                                            <h4 class="price font-16">￥{{ $product->price }} <span class="price-sale color-muted"></span></h4>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Best Rated Deals -->
                                    </div>

                                </div>
                            </aside>

                        </form>
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
        function select_sku(obj,id) {
            $(obj).parents('ol').find('li').removeClass('active');
            $(obj).addClass('active');
            var $src = $(obj).attr('data-img');
            var $price = $(obj).attr('data-price');
            var $stock = $(obj).attr('data-stock');

            $('.slides #image').attr('src',$src);

            $('#p_stock').text($stock);
            $(obj).parent().find('input[name=skuId]').val(id);
            $('#price').html($price);

        }

        $('.buy').on('click',function () {
            if( $('.prodcut-sku').find('input').val().length == 0 ) {
                swal('请选择一个商品','','error');
                return;
            }
        })


        $('#amount').on('change',function () {
            var val = $('#amount').val();
            return check(val);

        })

        function check(val) {
            if(val <= 0 || val >= 10) {
                swal(
                    '请选择数量1-9之间',
                    '',
                    'error'
                )
                $('#amount').val(1);
                return false;
            }
            return true;
        }

    </script>
@stop