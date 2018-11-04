@extends('layout.layout')
@section('title','登录页面')
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <section class="sign-area panel p-40">
                    <h3 class="sign-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登录</font></font><small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">或</font></font><a href="signup.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font></a></small></h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-left">
                            <form class="p-40" action="#" method="post">
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件</font></font></label>
                                    <input name="user" type="text" class="form-control input-lg" placeholder="用户名/手机号/QQ邮箱">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">密码</font></font></label>
                                    <input type="password" name="password" class="form-control input-lg" placeholder="密码">
                                </div>
                                <div class="form-group">
                                    <a href="#" class="forgot-pass-link color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">忘了你的密码？</font></font></a>
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
                                    <button class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-qq"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">QQ登录</font></font></button>
                                </div>
                                <div class="mb-20">
                                    <button class="btn btn-lg btn-block btn-social btn-google-plus"><i class="fa fa-wechat"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微信登录</font></font></button>
                                </div>
                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="remember_social" checked="">
                                    <label class="color-mid" for="remember_social"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">记住登录。</font></font></label>
                                </div>
                                <div class="text-center color-mid"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            需要一个账户 ？</font></font><a href="signup.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">创建帐号</font></font></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </main>
@endsection()