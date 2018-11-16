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
                            <li>
                                <a href="{{ route('me.index') }}">
                                    <i class="fa fa-user"></i>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;"></font>{{ $user->name }}</font></a>
                                <ul>
                                    <li><a href="{{ route('me.address') }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">我的收货地址</font></font></a>
                                    </li>
                                    <li><a href="{{ route('order.list') }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">我的订单</font></font></a>
                                    </li>
                                </ul>
                            </li>
                            <li id="logout-click"><a href="javascript:;"><i class="fa fa-sign-out"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font>注销</font></a>
                            </li>
                            <form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value='{{ $user->id }}'>
                                <button type="submit"></button>
                            </form>
                        @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登入</font></font></a>
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
                    <a href="{{ route('index') }}" class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" width="250">
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
                                <a href="{{ route('cart') }}">
                                    <span class="icon lnr lnr-cart"></span>
                                    <div>
                                        @if( $user = Auth::user() )
                                            <span class="cart-number" style="background-color: #2ed87b">{{ $user->carts->count() }}</span>
                                        @else
                                            <span class="cart-number">0</span>
                                        @endif
                                    </div>
                                    <span class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">购物车</font></font></span>
                                </a>
                            </div>
                            <div class="header-wishlist ml-20">
                                <div>
                                    @if( $user = Auth::user() )
                                        <span class="cart-number" style="background-color: #2ed87b" >{{ $user->wishCount }}</span>
                                    @else
                                        <span class="cart-number">0</span>
                                    @endif
                                </div>
                                <a href="{{ route('wish') }}">
                                    <span class="icon lnr lnr-heart font-30"></span>
                                    <span class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收藏</font></font></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Header -->

</header>