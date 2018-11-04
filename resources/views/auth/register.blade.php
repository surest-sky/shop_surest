@extends('layout.layout')
@section('title','注册页面')
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <section class="sign-area panel p-40">
                    <h3 class="sign-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font><small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">或</font></font><a href="signin.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登录</font></font></a></small></h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-12 col-md-12 col-left">
                            <form class="p-40" action="{{ route('register.store') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">全名</font></font></label>
                                    <input type="text"  name="name" class="form-control input-lg" placeholder="姓名" value="{{ $name ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <div class="row row-rl-0">
                                        <div class="col-sm-6 col-md-6">
                                            <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手机号码/邮箱</font></font></label>
                                            <input value="18270952773" id="account" type="text" name="model" class="form-control input-lg" placeholder="手机号码/邮箱">
                                        </div>
                                        <div class="col-sm-1 col-md-1"></div>
                                        <div class="col-sm-2 col-md-2">
                                            <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">验证码</font></font></label>
                                            <input type="password" name="model" class="form-control input-lg" placeholder="验证码">
                                        </div>
                                        <div class="col-sm-1 col-md-1"></div>
                                        <div class="col-sm-2 col-md-2">
                                            <form action="{{ route('register.account') }}" style="display: none">
                                                <input type="hidden" name="account" value="">
                                                <input id="getCode" type="button" class="btn btn-block" value="获取验证码">
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">密码</font></font></label>
                                    <input type="password" name="password" class="form-control input-lg" placeholder="密码">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">确认密码</font></font></label>
                                    <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="确认密码">
                                </div>
                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="agree_terms">
                                    <label class="color-mid" for="agree_terms"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">我同意</font></font><a href="terms_conditions.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">使用条款</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">和</font></font><a href="terms_conditions.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隐私声明</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></label>
                                </div>
                                <button type="submit" class="btn btn-block btn-lg"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font></button>
                            </form>

                        </div>

                    </div>
                </section>
            </div>
        </div>


    </main>
@endsection
@section('script')
    <script>

        window.onload = function () {

            $('#getCode').on('click',function () {
                var account = $('#account').val();

                console.log(account.length);
                if( account.length == 0 ){
                    _alert('请输入',false);
                }
                // 执行请求

                $(this).val('...');

                axios.post('{{ route('register.account')}}' , {
                    'account' : account,
                }).then(function (response) {
                    console.log(response.data);
                })
            })

        }

    </script>
@stop