@extends('layout.layout')
@section('title','注册页面')
@section('content')

    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">
                <section class="sign-area panel p-40">
                    <h3 class="sign-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font><small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">或</font></font><a href="signin.html" class="color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登录</font></font></a></small></h3>

                    <div class="row row-rl-0">
                        <form class="p-40" action="{{ route('forget.store') }}" method="post">
                            {{ csrf_field() }}
                        <div class="col-sm-12 col-md-12 col-left">

                            @if($status = session('status') )
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $status }}</li>
                                    </ul>
                                </div>
                            @endif


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                <div class="form-group">
                                    <div class="row row-rl-0">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="col-sm-6 col-md-6">
                                                <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手机号码/邮箱</font></font></label>
                                                <input value="18270952773" id="account" type="text" name="model" class="form-control input-lg" placeholder="手机号码/邮箱">
                                                <input type="hidden" name="key" id="key"  value="{{ old('key') ?? session('key') ?? '' }}">
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <label class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">验证码</font></font></label>
                                                <input type="text" name="captcha" class="form-control input-lg" placeholder="验证码" value="{{ old('captcha') ?? ''}}">
                                            </div>
                                            <div class="col-sm-3  col-md-3">
                                                <input id="getCode" type="button" class="btn btn-block" value="获取验证码">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-block btn-lg"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">确认</font></font></button>

                        </div>
                        </form>

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


                console.log(account.length == 0);

                if( account.length == 0 ){
                    _alert('请输入',false);
                }

                swal({
                    title: "<img src='{!! captcha_src() !!}' onclick=\"this.src = '{!! captcha_src() !!}' + '?' + +Math.random();\">",
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    preConfirm: function(captcha) {
                        return new Promise(function (resolve) {
                            $.ajax({
                                async: false,
                                type : 'POST',
                                url: '{{ route('forget.account')}}',
                                data: {
                                    'account' : account,
                                    'captcha' : captcha
                                },
                                success:function (data) {
                                    $('#key').val(data['key']);
                                    console.log(data);
                                    _alert('验证码已经发送',true)
                                },
                                error:function (data) {
                                    var msg = data.responseJSON.errors;
                                    if( data.status == 422 ) {
                                        if( typeof msg.captcha !== 'undefined' ) {
                                            _alert(msg.captcha[0],false);
                                        }else if( typeof msg.account !== 'undefined' ){
                                            _alert(msg.account[0],false);
                                        }else{
                                            _alert('系统错误',false);
                                        }
                                    }else if(data.status == 401) {
                                        _alert(msg,false);
                                    }else{
                                        _alert('系统错误',false);
                                    }

                                }
                            })
                        })
                    }
                });

                {{--axios.post('{{ route('register.account')}}' , {--}}
                //     'account' : account,
                {{--}).then(function (response) {--}}
                    {{--console.log(response.data);--}}
                {{--})--}}
            })


        }

    </script>
@stop