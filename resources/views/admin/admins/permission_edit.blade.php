@extends('admin.common.layout')
@section('body')
    
    <body>
        <div class="x-body">
            <form action="{{ route('admin.admins.role.store') }}" method="post" class="layui-form layui-form-pane">

                {{ csrf_field() }}

                <div class="layui-form-item">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                    @endforeach
                @endif
                </div>

                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>权限名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="required" value="{{ $permission->name ?? ''}}" autocomplete="off" class="layui-input">
                        <input type="hidden" name="id" value="{{ $permission->id ?? ''}}">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>Http - Url
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="required" value="{{ $permission->name ?? ''}}" autocomplete="off" class="layui-input">
                        <input type="hidden" name="id" value="{{ $permission->id ?? ''}}">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="description" class="layui-textarea">{{ $permission->description ?? '' }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="save">保存</button>
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