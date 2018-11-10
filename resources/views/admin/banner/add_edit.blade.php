@extends('admin.common.layout')
@section('body')
    
    <body>
    <div class="x-body">
        <form class="layui-form" method="post" action="{{ route('admin.category.update') }}">
            @csrf
            @method('put')

            <div class="layui-form-item">
                @if( $status = session('status') )
                    <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $status }}</button>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                    @endforeach
                @endif
                <label for="cname" class="layui-form-label">
                    ID
                </label>
                <div class="layui-input-inline">
                    <input type="text" name="id" lay-verify="required" autocomplete="off" value="{{ $category->id }}" disabled="" class="layui-input">
                    <input type="hidden" name="id" value="{{ $category->id }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="cname" class="layui-form-label">
                    <span class="x-red">*</span>分类名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="cname" name="name" value="{{ old('name') ?? $category->name ?? '' }}" required="" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button class="layui-btn" lay-filter="save" lay-submit="">
                    保存
                </button>
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