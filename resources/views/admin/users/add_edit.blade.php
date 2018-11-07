@extends('admin.common.layout')
@section('body')
    
    <body>
        <div class="x-body">
            @if( is_null($id) )
                <form action="{{ route('admin.user.create') }}" method="post" class="layui-form layui-form-pane">
            @else
                <form action="{{ route('admin.user.update',['id' => $id]) }}" method="post" class="layui-form layui-form-pane">
                    <input type="hidden" name="_method" value="put">
            @endif

                @if( $status = session('status') )
                    <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $status }}</button>
                @endif
                <div class="layui-form-item">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                    @endforeach
                @endif

                    {{ csrf_field() }}
                </div>
                    <div class="layui-form-item">

                        <label for="name" class="layui-form-label">
                            <span class="x-red">*</span>用户名
                        </label>
                        <div class="layui-input-block">
                            <input type="text" id="name" name="name" required="" lay-verify="required" value="{{ old('name') ?? $user->name ?? ''}}" autocomplete="off" class="layui-input">
                            <input type="hidden" name="id" value="{{ $user->id ?? ''}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="name" class="layui-form-label">
                            <span class="x-red"></span>手机号码
                        </label>
                        <div class="layui-input-block">
                            <input type="text" id="phone" name="phone" value="{{  old('phone') ?? $user->phone ?? '' }}" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="name" class="layui-form-label">
                            <span class="x-red"></span>邮箱
                        </label>
                        <div class="layui-input-block">
                            <input type="text" id="email" name="email"  value="{{ old('email') ?? $user->email ?? '' }}" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="name" class="layui-form-label">
                            <span class="x-red">*</span>密码
                        </label>
                        <div class="layui-input-block">
                            <input type="text" id="name" name="password" required="" lay-verify="required" value="{{ $user->password ?? '' }}" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="name" class="layui-form-label">
                            <span class="x-red">*</span>确认密码
                        </label>
                        <div class="layui-input-block">
                            <input type="text" id="name" name="password_confirmation" required="" lay-verify="required" value="{{ $user->password ?? '' }}" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
            </form>
        </div>
    </body>
        @stop

        @section('script')
            <script>
                layui.use(['form','layer'], function(){
                    $ = layui.jquery;
                    var form = layui.form()
                        ,layer = layui.layer;
                });
            </script>
        @stop