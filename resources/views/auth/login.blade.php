@extends('layout.layout')
@section('title','登录页面')
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <section class="sign-area panel p-40">
                    <h3 class="sign-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登录</font></font><small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">或</font></font><a href="signup.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font></a></small></h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-left">

                            @if($status = session('status') )
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $status }}</li>
                                    </ul>
                                </div>
                            @endif

                                <?php session('status','aaa'); echo session('status'); ?>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            <form class="p-40" action="{{ route('login.store') }}" method="post">
                                {{{ csrf_field() }}}
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户名/手机号/邮箱/</font></font></label>
                                    <input required name="name" type="text" class="form-control input-lg" placeholder="用户名/手机号/邮箱">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">密码</font></font></label>
                                    <input required type="password" name="password" class="form-control input-lg" placeholder="密码">
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('forget') }}" class="forgot-pass-link color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">忘记密码？</font></font></a>
                                </div>
                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="remember_account" checked="">
                                    <label class="color-mid" for="remember_account"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">让我在这台电脑上登录。</font></font></label>
                                </div>
                                <button type="submit" class="btn btn-block btn-lg"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登入</font></font></button>
                            </form>
                            <span class="or"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">要么</font></font></span>
                        </div>
                        <div class="col-sm-6 col-md-5 col-right">
                            <div class="social-login p-40">
                                <div class="mb-20">
                                    <a href="{{ route('login.weibo') }}" class="btn btn-lg btn-block btn-social btn-facebook"><i class="fa fa-weibo"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微博登录</font></font></a>
                                </div>
                                <div class="mb-20">
                                    <a href="{{ route('login.qq') }}" class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-qq"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">QQ登录</font></font></a>
                                </div>
                                <div class="mb-20">
                                    <button id="w_login" class="btn btn-lg btn-block btn-social btn-google-plus"><i class="fa fa-wechat"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微信登录</font></font></button>
                                </div>
                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="remember_social" checked="">
                                    <label class="color-mid" for="remember_social"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">记住登录。</font></font></label>
                                </div>
                                <div class="text-center color-mid"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            需要一个账户 ？</font></font><a href="{{ route('register') }}" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">创建帐号</font></font></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
@section( 'script' )
    <script>
        $('#w_login').on('click' , function () {
            // 请求获得二维码地址和标识符
            $.ajax({
                url: '{{ route('wx.data') }}',
                type: 'get',
                success: function (data) {
                    if( data.codeUri && data.stateCode ) {
                        swal({
                            title: '<img src="'+ data.codeUri +'" alt="">',
                            showCloseButton: true,
                            showCancelButton: true,
                            html:
                                '<h2>登录成功将自动跳转</h2><br><h4>此为模拟登录</h4>',
                        })
                        running(data.stateCode);
                    }else{
                        swal('请求发生错误，请重试','','error');
                    }
                },
                error: function () {
                    swal('请求发生错误，请重试','','error');
                }
            })
        })
        function running($state) {
            var i = 0;
            var run;
            run = setInterval(function () {
                if( i>60 ) {
                    clearInterval(run);
                }else{
                    $.ajax({
                        url : '{{ route('wx.read') }}',
                        type: 'post',
                        data: {
                            state: $state
                        },
                        success:function (data) {
                            if( data.key ) {
                                var key = data.key;
                                window.location.href = '{{route('wx.login')}}'+'?key=' + key;
                                clearInterval(run);
                                swal('扫码成功,请勿关闭,登陆中......','','true');
                            }
                        },
                        error: function (error) {
                        }
                    })
                    i++;
                }
            },1000);
        }

        function checkLogin($state) {
            console.log('登陆中..' +$state )
        }
    </script>
@stop