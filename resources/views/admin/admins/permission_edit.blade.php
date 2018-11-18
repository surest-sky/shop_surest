@extends('admin.common.layout')
@section('body')
    
    <body>
        <div class="x-body">
            <form action="{{ route('admin.admins.permission.store') }}" method="post" class="layui-form layui-form-pane">

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
                        <input type="text" id="name" name="name" required="" lay-verify="required" value="{{  old('name') ?? $permission->name?? ''}}" autocomplete="off" class="layui-input">
                        <input type="hidden" name="id" value="{{ $permission->id ?? ''}}">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>路由 - Url
                    </label>
                    <div class="layui-input-inline">
                        <div class="layui-input-inline" style="width:180px;text-align: left">
                            <select name="route">
                                @foreach($list as $simple)
                                    <option @if( old('route')== $simple ) selected @endif value="{{ $simple }}">{{ $simple }}</option>
                                @endforeach
                            </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="顶级分类" value="顶级分类" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="0" class="layui-this">顶级分类</dd><dd lay-value="新闻" class="">新闻</dd><dd lay-value="新闻子类1" class="">--新闻子类1</dd><dd lay-value="新闻子类2" class="">--新闻子类2</dd><dd lay-value="产品" class="">产品</dd><dd lay-value="产品子类1" class="">--产品子类1</dd><dd lay-value="产品子类2" class="">--产品子类2</dd></dl></div>
                        </div>
                        <input type="hidden" name="id" value="{{ $permission->id ?? ''}}">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="description" class="layui-textarea">{{ old('description') ?? $permission->description ?? '' }}</textarea>
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