@extends('layout.layout')
@section('title','首页')
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-10">
            <div class="container">
                <div class="section deals-header-area ptb-30">
                    <div class="row row-tb-20">
                        <div class="col-xs-12 col-md-4 col-lg-3">
                            <aside>
                                <ul class="nav-coupon-category panel">
                                    @foreach($categories as $category)
                                        <li><a href="{{ route('category.show',['id' => $category->id]) }}"><i class="fa fa-navicon"></i>{{ $category->name }}
                                                <span>{{ $category->pcount }}</span></a>
                                        </li>
                                    @endforeach
                                    <li class="all-cat">
                                        <a class="font-14" href="{{ route('category') }}">查看所有分类</a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-xs-12 col-md-8 col-lg-9">
                            <div class="header-deals-slider owl-slider" data-loop="true" data-autoplay="true"
                                 data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false"
                                 data-nav="true" data-xxs-items="1" data-xxs-nav="true" data-xs-items="1"
                                 data-xs-nav="true" data-sm-items="1" data-sm-nav="true" data-md-items="1"
                                 data-md-nav="true" data-lg-items="1" data-lg-nav="true">
                                @foreach($banners as $banner)
                                <div class="deal-single panel item">
                                    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9"
                                            data-bg-img="{{ $banner->image }}">
                                        <div class="label-discount top-10 right-10">{{ $banner->cName }}</div>
                                        <ul class="deal-actions top-10 left-10">
                                            <li class="like-deal">
                                                    <span>
			                        <i class="fa fa-heart"></i>
			                    </span>
                                            </li>
                                            <li class="share-btn">
                                                <div class="share-tooltip fade">
                                                    <a target="_blank" href="#"><i class="fa fa-weibo"></i></a>
                                                    <a target="_blank" href="#"><i class="fa fa-qq"></i></a>
                                                    <a target="_blank" href="#"><i class="fa fa-wechat"></i></a>
                                                </div>
                                                <span><i class="fa fa-share-alt"></i></span>
                                            </li>
                                            <li>
                                                    <span>
			                        <i class="fa fa-camera"></i>
			                    </span>
                                            </li>
                                        </ul>
                                        <div class="deal-about p-20 pos-a bottom-0 left-0">
                                            <div class="rating mb-10">
                                                    <span class="rating-stars" data-rating="{{ $banner->product->rating }}">
			                        <i class="fa fa-star-o star-active"></i>
			                        <i class="fa fa-star-o"></i>
			                        <i class="fa fa-star-o"></i>
			                        <i class="fa fa-star-o"></i>
			                        <i class="fa fa-star-o"></i>
			                    </span>
                                                <span class="rating-reviews color-light">
			                    	( <span class="rating-count">{{ $banner->product->review_count }}</span> Reviews )
                                                    </span>
                                            </div>
                                            <h3 class="deal-title mb-10 ">
                                                <a href="{{ route('product.show',['id'=>$banner->product->id]) }}l" class="color-light color-h-lighter">{{ $banner->product->name }}</a>
                                            </h3>
                                        </div>
                                    </figure>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <section class="section latest-deals-area ptb-30">
                    <header class="panel ptb-15 prl-20 pos-r mb-30">
                        <h3 class="section-title font-18">最新商品</h3>
                        <a href="{{ route('product.showAll') }}" class="btn btn-o btn-xs pos-a right-10 pos-tb-center">查看所有</a>
                    </header>

                    <div class="row row-masnory row-tb-20">
                        @foreach($products as $product)
                            <div class="col-sm-6 col-lg-4">
                                <div class="deal-single panel">
                                    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9"
                                            data-bg-img="{{ $product->image->src ?? '' }}">
                                        <div class="label-discount left-20 top-15">{{ str_limit($product->category->name,4,'..') }}</div>
                                        <ul class="deal-actions top-15 right-20">
                                            <li class="like-deal"><span><i class="fa fa-heart"></i></span>
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
                                        </ul>
                                        <div class="deal-store-logo">
                                            <a href="{{ route('product.show',['id'=>$product->id]) }}"><img src="{{ $product->image->src ?? '' }}" alt=""></a>
                                        </div>
                                    </figure>
                                    <div class="bg-white pt-20 pl-20 pr-15">
                                        <div class="pr-md-10">
                                            <div class="rating mb-10">
                                                <span class="rating-stars rate-allow"
                                                      data-rating="{{ $product->rating ?? 1 }}">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </span>
                                                <span class="rating-reviews">
                                ( <span class="rating-count">{{ $product->review_count }}</span> 评论数 )
                                                </span>
                                            </div>
                                            <h3 class="deal-title mb-10">
                                                <a href="{{ route('product.show',['id'=>$product->id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                <li>
                                                    <i class="ico mr-10">成交量:</i>{{ $product->sold_count }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="deal-price pos-r mb-15">
                                            <h3 class="price ptb-5 text-right">价格：<span
                                                        class="price-sale"></span>{{ $product->price }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>


                {{--折扣商品 见 about.temp_sale--}}

                {{-- 活跃用户 --}}
                <section class="section stores-area stores-area-v1 ptb-30">
                    <header class="panel ptb-15 prl-20 pos-r mb-30">
                        <h3 class="section-title font-18">活跃用户</h3>
                        <a href="stores_01.html" class="btn btn-o btn-xs pos-a right-10 pos-tb-center">所有用户</a>
                    </header>
                    <div class="popular-stores-slider owl-slider" data-loop="true" data-autoplay="true"
                         data-smart-speed="1000" data-autoplay-timeout="10000" data-margin="20" data-items="2"
                         data-xxs-items="2" data-xs-items="2" data-sm-items="3" data-md-items="5" data-lg-items="6">
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_01.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">Amazon</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_02.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">Ashford</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_03.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">DELL</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_04.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">Card Cash</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_05.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">Finish Line</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_06.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">JC Penny</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_07.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">Callaway Golf</h6>
                            </a>
                        </div>
                        <div class="store-item t-center">
                            <a href="store_single_01.html" class="panel is-block">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="store-logo">
                                        <img src="assets/images/brands/brand_08.jpg" alt="">
                                    </div>
                                </div>
                                <h6 class="store-name ptb-10">Car Toys</h6>
                            </a>
                        </div>
                    </div>
                </section>


                {{-- 最新文章 --}}
                <section class="section latest-news-area blog-area blog-grid blog-3-col ptb-30">
                    <header class="panel ptb-15 prl-20 pos-r mb-30">
                        <h3 class="section-title font-18">最新文章</h3>
                        <a href="blog_classic_right_sidebar.html" class="btn btn-o btn-xs pos-a right-10 pos-tb-center">Visit
                            相关博文</a>
                    </header>

                    <div class="row row-tb-20">

                        <!-- Blog Post -->
                        <div class="blog-post col-xs-12 col-sm-6 col-md-4">
                            <article class="entry panel">
                                <figure class="entry-media post-thumbnail embed-responsive embed-responsive-16by9"
                                        data-bg-img="assets/images/blog/post_01.jpg">
                                    <div class="entry-date">
                                        <h4>13</h4>
                                        <h6>JUN</h6>
                                    </div>
                                </figure>
                                <div class="entry-wrapper pt-20 pb-10 prl-20">
                                    <header class="entry-header">
                                        <h4 class="entry-title mb-10 mb-md-15 font-xs-16 font-sm-18 font-md-16 font-lg-16">
                                            <a href="blog_single_standard.html">Restaurant Employer Read Clients Orders
                                                On His iPad</a>
                                        </h4>
                                        <div class="entry-meta mb-10">
                                            <ul class="tag-info list-inline">
                                                <li><i class="icon fa fa-user"></i> By : John Doe</li>
                                                <li><i class="icon fa fa-comments"></i>14 Comments</li>
                                            </ul>
                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <p class="entry-summary">Vivamus sem massa, cursus at mollis eu, euismod id
                                            risus. Vestibulum nunc ante, sagittis ut nisl at, porta porttitor justo. Nam
                                            imperdiet im...</p>
                                    </div>
                                    <footer class="entry-footer text-right">
                                        <a href="blog_single_standard.html" class="more-link btn btn-link">Continue
                                            reading <i class="icon fa fa-long-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </article>
                        </div>
                        <!-- End Blog Post -->

                        <!-- Blog Post -->
                        <div class="blog-post col-xs-12 col-sm-6 col-md-4">
                            <article class="entry panel">
                                <figure class="entry-media embed-responsive embed-responsive-16by9">
                                    <iframe src="" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    <div class="entry-date">
                                        <h4>13</h4>
                                        <h6>JUN</h6>
                                    </div>
                                </figure>
                                <div class="entry-wrapper pt-20 pb-10 prl-20">
                                    <header class="entry-header">
                                        <h4 class="entry-title mb-10 mb-md-15 font-xs-16 font-sm-18 font-md-16 font-lg-16">
                                            <a href="blog_single_vimeo.html">Amazing Classic Interior Design With
                                                Perfect Lighting</a>
                                        </h4>
                                        <div class="entry-meta mb-10">
                                            <ul class="tag-info list-inline">
                                                <li><i class="icon fa fa-user"></i> By : John Doe</li>
                                                <li><i class="icon fa fa-comments"></i> 14 Comments</li>
                                            </ul>
                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <p class="entry-summary">Vivamus sem massa, cursus at mollis eu, euismod id
                                            risus. Vestibulum nunc ante, sagittis ut nisl at, porta porttitor justo. Nam
                                            imperdiet im...</p>
                                    </div>
                                    <footer class="entry-footer text-right">
                                        <a href="blog_single_vimeo.html" class="more-link btn btn-link">Continue reading
                                            <i class="icon fa fa-long-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </article>
                        </div>
                        <!-- End Blog Post -->

                        <!-- Blog Post -->
                        <div class="blog-post col-xs-12 col-sm-6 col-md-4">
                            <article class="entry panel">
                                <figure class="entry-media embed-responsive embed-responsive-16by9">
                                    <iframe src="" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    <div class="entry-date">
                                        <h4>13</h4>
                                        <h6>JUN</h6>
                                    </div>
                                </figure>
                                <div class="entry-wrapper pt-20 pb-10 prl-20">
                                    <header class="entry-header">
                                        <h4 class="entry-title mb-10 mb-md-15 font-xs-16 font-sm-18 font-md-16 font-lg-16">
                                            <a href="blog_single_youtube.html">English Breakfast Tea With Tasty Donut
                                                Desserts</a>
                                        </h4>
                                        <div class="entry-meta mb-10">
                                            <ul class="tag-info list-inline">
                                                <li><i class="icon fa fa-user"></i> By : John Doe</li>
                                                <li><i class="icon fa fa-comments"></i> 14 Comments</li>
                                            </ul>
                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <p class="entry-summary">Vivamus sem massa, cursus at mollis eu, euismod id
                                            risus. Vestibulum nunc ante, sagittis ut nisl at, porta porttitor justo. Nam
                                            imperdiet im...</p>
                                    </div>
                                    <footer class="entry-footer text-right">
                                        <a href="blog_single_youtube.html" class="more-link btn btn-link">Continue
                                            reading <i class="icon fa fa-long-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </article>
                        </div>
                        <!-- End Blog Post -->

                    </div>
                </section>


                <section class="section subscribe-area ptb-40 t-center">
                    <div class="newsletter-form">
                        <h4 class="mb-20"><i class="fa fa-envelope-o color-green mr-10"></i>订阅我们</h4>
                        <p class="mb-20 color-mid">我们将每天9.00给您发一篇最新的资讯文章或者商品</p>
                        <form method="post" action="#">
                            @csrf
                            <div class="input-group mb-10">
                                <input type="email" class="form-control bg-white" placeholder="邮箱地址" required="required">
                                <span class="input-group-btn">
                                        <button class="btn" type="submit">订阅我们</button>
                                    </span>
                            </div>
                        </form>
                        <p class="color-muted"><small>我们绝不会外泄您的邮箱</small> </p>
                    </div>
                </section>
            </div>
        </div>


    </main>
@stop