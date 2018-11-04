<header id="mainHeader" class="main-header">

    <!-- Top Bar -->
    <div class="top-bar bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 is-hidden-sm-down">
                    <ul class="nav-top nav-top-left list-inline t-left">
                        <li><a href="terms_conditions.html"><i class="fa fa-question-circle"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">折扣指南</font></font></a>
                        </li>
                        <li><a href="faq.html"><i class="fa fa-support"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">客户协助</font></font></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul class="nav-top nav-top-right list-inline t-xs-center t-md-right">
                        @if( $user = Auth::user())
                            <li><a href="#"><i class="fa fa-user"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font>{{ $user->name }}</font></a>
                            </li>
                            <li id="logout-click"><a href="javascript:;"><i class="fa fa-sign-out"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font>注销</font></a>
                            </li>
                            <form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value='{{ $user->id }}'>
                                <button type="submit"></button>
                            </form>
                        @else
                        <li><a href="{{ route('login.normal') }}"><i class="fa fa-lock"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登入</font></font></a>
                        </li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-user"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <!-- Header Header -->
    <div class="header-header bg-white">
        <div class="container">
            <div class="row row-rl-0 row-tb-20 row-md-cell">
                <div class="brand col-md-3 t-xs-center t-md-left valign-middle">
                    <a href="#" class="logo">
                        <img src="assets/images/logo.png" alt="" width="250">
                    </a>
                </div>
                <div class="header-search col-md-9">
                    <div class="row row-tb-10 ">
                        <div class="col-sm-8">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg search-input" placeholder="Enter Keywork Here ..." required="required">
                                    <div class="input-group-btn">
                                        <div class="input-group">
                                            <select class="form-control input-lg search-select">
                                                <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">选择您的类别</font></font></option>
                                                <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">交易</font></font></option>
                                                <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">优惠券</font></font></option>
                                                <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">折扣</font></font></option>
                                            </select>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-lg btn-search btn-block">
                                                    <i class="fa fa-search font-16"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4 t-xs-center t-md-right">
                            <div class="header-cart">
                                <a href="cart.html">
                                    <span class="icon lnr lnr-cart"></span>
                                    <div><span class="cart-number">0</span>
                                    </div>
                                    <span class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">大车</font></font></span>
                                </a>
                            </div>
                            <div class="header-wishlist ml-20">
                                <a href="wishlist.html">
                                    <span class="icon lnr lnr-heart font-30"></span>
                                    <span class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">愿望清单</font></font></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Header -->

    <!-- Header Menu -->
    <div class="header-menu bg-blue">
        <div class="container">
            <nav class="nav-bar nav-mobile">
                <div class="nav-header">
                            <span class="nav-toggle" data-toggle="#header-navbar">
		                        <i></i>
		                        <i></i>
		                        <i></i>
		                    </span>
                </div>
                <div id="header-navbar" class="nav-collapse" style="display: block;">
                    <ul class="nav-menu">
                        <li class="active active-mobile">
                            <a href="index.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">家</font></font></a>
                        </li>
                        <li class="dropdown-mega-menu">
                            <a href="deals_grid.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">交易</font></font><span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <div class="mega-menu">
                                <div class="row row-v-10">
                                    <div class="col-md-3">
                                        <ul>
                                            <li><a href="deals_grid.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网格视图</font></font></a>
                                            </li>
                                            <li><a href="deals_grid_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">带侧边栏的网格</font></font></a>
                                            </li>
                                            <li><a href="deals_list.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">列表显示</font></font></a>
                                            </li>
                                            <li><a href="deal_single.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">交易单身</font></font></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_03.jpg" style="background-image: url(&quot;assets/images/deals/deal_03.jpg&quot;);">
                                            <div class="label-discount top-10 right-10">-15%</div>
                                            <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                <div class="rating mb-10">
                                                            <span class="rating-stars rate-allow" data-rating="2">
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o star-active"></i>
										                        <i class="fa fa-star-o"></i>
										                    </span>
                                                </div>
                                                <h6 class="deal-title mb-10">
                                                    <a href="deal_single.html" class="color-lighter"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">茉莉如临床或质量</font></font></a>
                                                </h6>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-md-3">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_04.jpg" style="background-image: url(&quot;assets/images/deals/deal_04.jpg&quot;);">
                                            <div class="label-discount top-10 right-10">-60%</div>
                                            <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                <div class="rating mb-10">
                                                            <span class="rating-stars rate-allow" data-rating="3">
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o star-active"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                    </span>
                                                </div>
                                                <h6 class="deal-title mb-10">
                                                    <a href="deal_single.html" class="color-lighter"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">茉莉如临床或质量</font></font></a>
                                                </h6>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-md-3">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_05.jpg" style="background-image: url(&quot;assets/images/deals/deal_05.jpg&quot;);">
                                            <div class="label-discount top-10 right-10"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">-60%</font></font></div>
                                            <div class="deal-about p-10 pos-a bottom-0 left-0">
                                                <div class="rating mb-10">
                                                            <span class="rating-stars rate-allow" data-rating="5">
										                        <i class="fa fa-star-o star-active"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                        <i class="fa fa-star-o"></i>
										                    </span>
                                                </div>
                                                <h6 class="deal-title mb-10">
                                                    <a href="deal_single.html" class="color-lighter"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">茉莉如临床或质量</font></font></a>
                                                </h6>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="coupons_grid.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">优惠券</font></font><span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                <li><a href="coupons_grid.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网格视图</font></font></a>
                                </li>
                                <li><a href="coupons_grid_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">带侧边栏的网格</font></font></a>
                                </li>
                                <li><a href="coupons_list.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">列表显示</font></font></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="stores_01.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商店</font></font><span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                <li><a href="stores_01.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商店搜索</font></font></a>
                                </li>
                                <li><a href="stores_02.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商店类别</font></font></a>
                                </li>
                                <li><a href="store_single_01.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商店单身1</font></font></a>
                                </li>
                                <li><a href="store_single_02.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商店单身2</font></font></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="contact_us_01.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系我们</font></font><span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                <li><a href="contact_us_01.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系我们1</font></font></a>
                                </li>
                                <li><a href="contact_us_02.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系我们2</font></font></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">博客</font></font><span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">经典视图</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="blog_classic_right_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">右边的</font></font></a>
                                        </li>
                                        <li><a href="blog_classic_left_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">左侧边栏</font></font></a>
                                        </li>
                                        <li><a href="blog_classic_fullwidth.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">全屏宽度</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网格视图</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="blog_grid_3col.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3列</font></font></a>
                                        </li>
                                        <li><a href="blog_grid_2col.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2列</font></font></a>
                                        </li>
                                        <li><a href="blog_grid_right_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">右侧边栏</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">列表显示</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="blog_list_right_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">右边的</font></font></a>
                                        </li>
                                        <li><a href="blog_list_left_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">左侧边栏</font></font></a>
                                        </li>
                                        <li><a href="blog_list_fullwidth.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">全屏宽度</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">博客单身</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="blog_single_standard.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标准邮政</font></font></a>
                                        </li>
                                        <li><a href="blog_single_gallery.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">画廊邮报</font></font></a>
                                        </li>
                                        <li><a href="blog_single_youtube.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Youtube视频</font></font></a>
                                        </li>
                                        <li><a href="blog_single_vimeo.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vimeo视频</font></font></a>
                                        </li>
                                        <li><a href="blog_single_map.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">谷歌地图</font></font></a>
                                        </li>
                                        <li><a href="blog_single_quote.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">引用帖子</font></font></a>
                                        </li>
                                        <li><a href="blog_single_audio.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">音频发布</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网页</font></font><span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                <li><a href="index.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">主页默认</font></font></a>
                                </li>
                                <li><a href="signin.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登入</font></font></a>
                                </li>
                                <li><a href="signup.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font></a>
                                </li>
                                <li><a href="404.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">404页</font></font></a>
                                </li>
                                <li><a href="faq.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FAQ页面</font></font></a>
                                </li>
                                <li><a href="cart.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">购物车页面</font></font></a>
                                </li>
                                <li>
                                    <a href="checkout_method.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">查看</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="checkout_method.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">结帐方法</font></font></a>
                                        </li>
                                        <li><a href="checkout_billing.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">账单信息</font></font></a>
                                        </li>
                                        <li><a href="checkout_payment.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">支付信息</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系我们</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="contact_us_01.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系我们1</font></font></a>
                                        </li>
                                        <li><a href="contact_us_02.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系我们2</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">优惠页面</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="deals_grid.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网格视图</font></font></a>
                                        </li>
                                        <li><a href="deals_list.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">列表显示</font></font></a>
                                        </li>
                                        <li><a href="deal_single.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">交易单身</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">优惠券页面</font></font><span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul>
                                        <li><a href="coupons_grid.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网格视图</font></font></a>
                                        </li>
                                        <li><a href="coupons_grid_sidebar.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">带侧边栏的网格</font></font></a>
                                        </li>
                                        <li><a href="coupons_list.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">列表显示</font></font></a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="terms_conditions.html"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">条款和条件</font></font></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="nav-menu nav-menu-fixed">
                    <a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">获得报价</font></font></a>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Header Menu -->

</header>