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
                    <a href="/" class="logo">
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
                        <li class="active">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="dropdown-mega-menu">
                            <a href="deals_grid.html">Deals<span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <div class="mega-menu" style="">
                                <div class="row row-v-10">
                                    <div class="col-md-3">
                                        <ul>
                                            <li><a href="deals_grid.html">Grid View</a>
                                            </li>
                                            <li><a href="deals_grid_sidebar.html">Grid With Sidebar</a>
                                            </li>
                                            <li><a href="deals_list.html">List View</a>
                                            </li>
                                            <li><a href="deal_single.html">Deal Single</a>
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
                                                    <a href="deal_single.html" class="color-lighter">Aenean ut orci vel massa</a>
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
                                                    <a href="deal_single.html" class="color-lighter">Aenean ut orci vel massa</a>
                                                </h6>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-md-3">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-4by3" data-bg-img="assets/images/deals/deal_05.jpg" style="background-image: url(&quot;assets/images/deals/deal_05.jpg&quot;);">
                                            <div class="label-discount top-10 right-10">-60%</div>
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
                                                    <a href="deal_single.html" class="color-lighter">Aenean ut orci vel massa</a>
                                                </h6>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="coupons_grid.html">Coupons<span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul style="">
                                <li><a href="coupons_grid.html">Grid View</a>
                                </li>
                                <li><a href="coupons_grid_sidebar.html">Grid With Sidebar</a>
                                </li>
                                <li><a href="coupons_list.html">List View</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="stores_01.html">Stores<span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul style="">
                                <li><a href="stores_01.html">Stores Search</a>
                                </li>
                                <li><a href="stores_02.html">Stores Categories</a>
                                </li>
                                <li><a href="store_single_01.html">Store Single 1</a>
                                </li>
                                <li><a href="store_single_02.html">Store Single 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="contact_us_01.html">Contact Us<span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul style="display: none;">
                                <li><a href="contact_us_01.html">Contact Us 1</a>
                                </li>
                                <li><a href="contact_us_02.html">Contact Us 2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Blog<span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul style="">
                                <li>
                                    <a href="#">Classic View<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="blog_classic_right_sidebar.html">Right Sidenar</a>
                                        </li>
                                        <li><a href="blog_classic_left_sidebar.html">Left Sidebar</a>
                                        </li>
                                        <li><a href="blog_classic_fullwidth.html">Full Width</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Grid View<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="blog_grid_3col.html">3 Columns</a>
                                        </li>
                                        <li><a href="blog_grid_2col.html">2 Columns</a>
                                        </li>
                                        <li><a href="blog_grid_right_sidebar.html">Right Sidebar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">List View<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="blog_list_right_sidebar.html">Right Sidenar</a>
                                        </li>
                                        <li><a href="blog_list_left_sidebar.html">Left Sidebar</a>
                                        </li>
                                        <li><a href="blog_list_fullwidth.html">Full Width</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Blog Single<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="blog_single_standard.html">Standard Post</a>
                                        </li>
                                        <li><a href="blog_single_gallery.html">Gallery Post</a>
                                        </li>
                                        <li><a href="blog_single_youtube.html">Youtube Video</a>
                                        </li>
                                        <li><a href="blog_single_vimeo.html">Vimeo Video</a>
                                        </li>
                                        <li><a href="blog_single_map.html">Google Map</a>
                                        </li>
                                        <li><a href="blog_single_quote.html">Quote Post</a>
                                        </li>
                                        <li><a href="blog_single_audio.html">Audio Post</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Pages<span class="indicator"><i class="fa fa-angle-down"></i></span></a>
                            <ul style="">
                                <li><a href="index.html">Home Default</a>
                                </li>
                                <li><a href="signin.html">Sign In</a>
                                </li>
                                <li><a href="signup.html">Sign Up</a>
                                </li>
                                <li><a href="404.html">404 Page</a>
                                </li>
                                <li><a href="faq.html">FAQ Page</a>
                                </li>
                                <li><a href="cart.html">Cart Page</a>
                                </li>
                                <li>
                                    <a href="checkout_method.html">Checkout<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="checkout_method.html">Checkout method</a>
                                        </li>
                                        <li><a href="checkout_billing.html">Billing Information</a>
                                        </li>
                                        <li><a href="checkout_payment.html">Payment Information</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Contact Us<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="contact_us_01.html">Contact Us 1</a>
                                        </li>
                                        <li><a href="contact_us_02.html">Contact Us 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Deals Pages<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="deals_grid.html">Grid View</a>
                                        </li>
                                        <li><a href="deals_list.html">List View</a>
                                        </li>
                                        <li><a href="deal_single.html">Deal Single</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Coupons Pages<span class="indicator"><i class="fa fa-angle-right"></i></span></a>
                                    <ul style="">
                                        <li><a href="coupons_grid.html">Grid View</a>
                                        </li>
                                        <li><a href="coupons_grid_sidebar.html">Grid With Sidebar</a>
                                        </li>
                                        <li><a href="coupons_list.html">List View</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="terms_conditions.html">Terms &amp; conditions</a>
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