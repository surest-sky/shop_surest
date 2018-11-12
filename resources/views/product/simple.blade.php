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
                                                    <img alt="" src="{{ $product->image->src }}">
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
                            <div class="col-xs-12">
                                <div class="posted-review panel p-30">
                                    <h3 class="h-title">{{ $product->comments->count() }} 评论</h3>

                                    @foreach($product->comments as $comment)
                                    <div class="review-single pt-30">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object mr-10 radius-4" src="{{ $comment->user->avatar }}" width="90" alt="">
                                            </div>
                                            <div class="media-body">
                                                <div class="review-wrapper clearfix">
                                                    <ul class="list-inline">
                                                        <li>
                                                            <span class="review-holder-name h5">{{ $comment->user->name }}</span>
                                                        </li>
                                                        <li>
                                                            <div class="rating">
                                                                    <span class="rating-stars" data-rating="5">
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                    </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <p class="review-date mb-5">{{ $comment->create_at }}</p>
                                                    <p class="copy">{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="post-review panel p-20">
                                    <h3 class="h-title">发送评论</h3>
                                    <form class="horizontal-form pt-30" action="#">
                                        <div class="row row-v-10">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="姓名" value="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="邮件" value="{{ Auth::user()->email ?? '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <ul class="select-rate list-inline ptb-20">
                                                    <li><span>你的评分: </span>
                                                    </li>
                                                    <li>
                                                            <span class="rating" role="button">
			                                        <i class="fa fa-star"></i>
			                                    </span>
                                                    </li>
                                                    <li>
                                                            <span class="rating" role="button">
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                    </span>
                                                    </li>
                                                    <li>
                                                            <span class="rating" role="button">
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                    </span>
                                                    </li>
                                                    <li>
                                                            <span class="rating" role="button">
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                    </span>
                                                    </li>
                                                    <li>
                                                            <span class="rating" role="button">
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                        <i class="fa fa-star"></i>
			                                    </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xs-12">
                                                <textarea class="form-control" placeholder="你的评论" rows="6"></textarea>
                                            </div>
                                            <div class="col-xs-12 text-right">
                                                <button type="submit" class="btn mt-20">发送评论</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-sidebar col-md-4 col-sm-5 col-xs-12">
                        <!-- Blog Sidebar -->
                        <aside class="sidebar blog-sidebar">
                            <div class="row row-tb-10">
                                <div class="col-xs-12">
                                    <div class="widget single-deal-widget panel ptb-30 prl-20">
                                        <div class="widget-body text-center">
                                            <h2 class="mb-20 h3">
                                                {{ $product->name }}
                                            </h2>
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                </li>
                                                <li><i class="ico fa fa-shopping-basket mr-10"></i>{{ $product->sold_count }}购买了</li>
                                            </ul>
                                            <div class="price mb-20">
                                                <h2 class="price"><span class="price-sale"></span> ￥{{ $product->price }}</h2>
                                            </div>
                                            <div class="buy-now mb-40">
                                                <a href="#" target="_blank" class="btn btn-block btn-lg">
                                                    <i class="fa fa-shopping-cart font-16 mr-10"></i> 现在购买
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <!-- Subscribe Widget -->
                                    <div class="widget subscribe-widget panel pt-20 prl-20">
                                        <h3 class="widget-title h-title">发送邮件</h3>
                                        <div class="widget-content ptb-30">

                                            <p class="color-mid mb-20">订阅我们</p>
                                            <form method="post" action="#">
                                                <div class="input-group">
                                                    <input type="email" class="form-control" placeholder="你的邮件地址" required="required">
                                                    <span class="input-group-btn">
                                        		        	<button class="btn" type="submit">订阅</button>
                                        		    	</span>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- End Subscribe Widget -->
                                </div>
                                <div class="col-xs-12">
                                    <!-- Latest Deals Widegt -->
                                    <div class="widget latest-deals-widget panel prl-20">
                                        <div class="widget-body ptb-20">
                                            <div class="owl-slider" data-loop="true" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-nav="true" data-xxs-items="1" data-xxs-nav="true" data-xs-items="1" data-xs-nav="true" data-sm-items="1" data-sm-nav="true" data-md-items="1" data-md-nav="true" data-lg-items="1" data-lg-nav="true">
                                                <div class="latest-deals__item item">
                                                    <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_02.jpg">
                                                        <div class="label-discount top-10 right-10">-30%</div>
                                                        <ul class="deal-actions top-10 left-10">
                                                            <li class="like-deal">
                                                                    <span>
		                        <i class="fa fa-heart"></i>
		                    </span>
                                                            </li>
                                                            <li class="share-btn">
                                                                <div class="share-tooltip fade">
                                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                                </div>
                                                                <span><i class="fa fa-share-alt"></i></span>
                                                            </li>
                                                            <li>
                                                                    <span>
		                        <i class="fa fa-camera"></i>
		                    </span>
                                                            </li>
                                                        </ul>
                                                        <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                            <div class="rating mb-10">
                                                                    <span class="rating-stars rate-allow" data-rating="4">
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                    </span>
                                                                <span class="rating-reviews color-lighter">
		                    	(<span class="rating-count">{{ $product->comments->count() }}</span> 评论)
                                                                    </span>
                                                            </div>
                                                            <h5 class="deal-title mb-10">
                                                                <a href="deal_single.html" class="color-lighter">Hampton Bay LED Light Ceiling Exhaust Fan</a>
                                                            </h5>
                                                        </div>
                                                    </figure>
                                                </div>
                                                <div class="latest-deals__item item">
                                                    <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_03.jpg">
                                                        <div class="label-discount top-10 right-10">-15%</div>
                                                        <ul class="deal-actions top-10 left-10">
                                                            <li class="like-deal">
                                                                    <span>
		                        <i class="fa fa-heart"></i>
		                    </span>
                                                            </li>
                                                            <li class="share-btn">
                                                                <div class="share-tooltip fade">
                                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                                </div>
                                                                <span><i class="fa fa-share-alt"></i></span>
                                                            </li>
                                                            <li>
                                                                    <span>
		                        <i class="fa fa-camera"></i>
		                    </span>
                                                            </li>
                                                        </ul>
                                                        <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                            <div class="rating mb-10">
                                                                    <span class="rating-stars rate-allow" data-rating="2">
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                    </span>
                                                                <span class="rating-reviews color-lighter">
		                    	(<span class="rating-count">100</span> Reviews)
                                                                    </span>
                                                            </div>
                                                            <h5 class="deal-title mb-10">
                                                                <a href="deal_single.html" class="color-lighter">Timberland Men's Thorton Waterproof Boots</a>
                                                            </h5>
                                                        </div>
                                                    </figure>
                                                </div>
                                                <div class="latest-deals__item item">
                                                    <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_04.jpg">
                                                        <div class="label-discount top-10 right-10">-60%</div>
                                                        <ul class="deal-actions top-10 left-10">
                                                            <li class="like-deal">
                                                                    <span>
		                        <i class="fa fa-heart"></i>
		                    </span>
                                                            </li>
                                                            <li class="share-btn">
                                                                <div class="share-tooltip fade">
                                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                                </div>
                                                                <span><i class="fa fa-share-alt"></i></span>
                                                            </li>
                                                            <li>
                                                                    <span>
		                        <i class="fa fa-camera"></i>
		                    </span>
                                                            </li>
                                                        </ul>
                                                        <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                            <div class="rating mb-10">
                                                                    <span class="rating-stars rate-allow" data-rating="3">
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                    </span>
                                                                <span class="rating-reviews color-lighter">
		                    	(<span class="rating-count">32</span> Reviews)
                                                                    </span>
                                                            </div>
                                                            <h5 class="deal-title mb-10">
                                                                <a href="deal_single.html" class="color-lighter">New and Refurbished Lenovo Laptops</a>
                                                            </h5>
                                                        </div>
                                                    </figure>
                                                </div>
                                                <div class="latest-deals__item item">
                                                    <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_05.jpg">
                                                        <div class="label-discount top-10 right-10">-60%</div>
                                                        <ul class="deal-actions top-10 left-10">
                                                            <li class="like-deal">
                                                                    <span>
		                        <i class="fa fa-heart"></i>
		                    </span>
                                                            </li>
                                                            <li class="share-btn">
                                                                <div class="share-tooltip fade">
                                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                                </div>
                                                                <span><i class="fa fa-share-alt"></i></span>
                                                            </li>
                                                            <li>
                                                                    <span>
		                        <i class="fa fa-camera"></i>
		                    </span>
                                                            </li>
                                                        </ul>
                                                        <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                            <div class="rating mb-10">
                                                                    <span class="rating-stars rate-allow" data-rating="5">
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                        <i class="fa fa-star-o"></i>
		                    </span>
                                                                <span class="rating-reviews color-lighter">
		                    	(<span class="rating-count">29</span> Reviews)
                                                                    </span>
                                                            </div>
                                                            <h5 class="deal-title mb-10">
                                                                <a href="deal_single.html" class="color-lighter">Buying a TV Is Easy When You Know These Terms</a>
                                                            </h5>
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Latest Deals Widegt -->
                                </div>
                                <div class="col-xs-12">
                                    <!-- Best Rated Deals -->
                                    <div class="widget best-rated-deals panel pt-20 prl-20">
                                        <h3 class="widget-title h-title">Best Rated Deals</h3>
                                        <div class="widget-body ptb-30">


                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="assets/images/deals/thumb_01.jpg" alt="Thumb" width="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-5">
                                                        <a href="#">Aenean ut orci vel massa</a>
                                                    </h6>
                                                    <div class="mb-5">
                                                            <span class="rating">
                        <span class="rating-stars" data-rating="4">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                                                            </span>
                                                    </div>
                                                    <h4 class="price font-16">$60.00 <span class="price-sale color-muted">$200.00</span></h4>
                                                </div>
                                            </div>


                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="assets/images/deals/thumb_02.jpg" alt="Thumb" width="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-5">
                                                        <a href="#">Aenean ut orci vel massa</a>
                                                    </h6>
                                                    <div class="mb-5">
                                                            <span class="rating">
                        <span class="rating-stars" data-rating="4">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                                                            </span>
                                                    </div>
                                                    <h4 class="price font-16">$60.00 <span class="price-sale color-muted">$200.00</span></h4>
                                                </div>
                                            </div>


                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="assets/images/deals/thumb_03.jpg" alt="Thumb" width="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-5">
                                                        <a href="#">Aenean ut orci vel massa</a>
                                                    </h6>
                                                    <div class="mb-5">
                                                            <span class="rating">
                        <span class="rating-stars" data-rating="4">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                                                            </span>
                                                    </div>
                                                    <h4 class="price font-16">$60.00 <span class="price-sale color-muted">$200.00</span></h4>
                                                </div>
                                            </div>


                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="assets/images/deals/thumb_04.jpg" alt="Thumb" width="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-5">
                                                        <a href="#">Aenean ut orci vel massa</a>
                                                    </h6>
                                                    <div class="mb-5">
                                                            <span class="rating">
                        <span class="rating-stars" data-rating="4">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                                                            </span>
                                                    </div>
                                                    <h4 class="price font-16">$60.00 <span class="price-sale color-muted">$200.00</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- Best Rated Deals -->
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