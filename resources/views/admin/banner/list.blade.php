@extends('admin.common.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.css') }}">
@stop
@section('body')
    <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>Banner管理</cite></a>
              <a><cite>Banner列表</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <form class="layui-form x-center" method="post" action="{{ route('admin.banner.create') }}" style="width:50%" >
            @if( $status = session('status') )
                <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $status }}</button>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                @endforeach
            @endif

            @method('post')
            @csrf
            <div class="layui-form-pane" style="margin-top: 15px;">
                <div class="layui-form-item">


                    <label class="layui-form-label" style="width:60px">推荐位</label>
                    <div class="layui-input-inline" style="width:200px">
                        <select name="product_id" id="select">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="layui-input-inline" style="width:120px">
                        <input type="text" name="description" placeholder="banner描述" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn" lay-submit="" lay-filter="add"><i class="layui-icon"></i>增加</button>
                    </div>
                </div>
            </div>
        </form>
        <xblock><span class="x-right" style="line-height:40px">共有数据：{{ $banners->count() }} 条</span></xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    商品名称
                </th>
                <th>
                    Banner名称
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            <tbody id="x-link">
            @foreach($banners as $banner)
            <tr>
                <td>
                    {{ $banner->id }}
                </td>
                <td>
                    {{ $banner->product->name }}
                </td>
                <td>
                    {{ $banner->description }}
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','{{ route('admin.banner.add',['id'=>$banner->id]) }}','4','','510')" class="ml-5" style="text-decoration:none">
                        <i class="layui-icon"></i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="category_del(this,'{{ $banner->id }}')" style="text-decoration:none">
                        <i class="layui-icon"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('script')
    <script src="{{ asset('assets/vendors/select-searchable/jquery.searchableSelect.js') }}"></script>
    <script>

        var result = 0;
        layui.use(['element','layer'], function(){
            $ = layui.jquery;//jquery
            layer = layui.layer;//弹出层
        });


        //-编辑
        function cate_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }


        /*删除*/
        function category_del(obj,id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    type: 'delete',
                    url: '{{ route('admin.banner.delete') }}',
                    dataType: 'json',
                    header: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        _method: 'delete',
                        id: id,
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (data, text, response) {
                        if (response.status == 200) {
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!', {icon: 1, time: 1000});
                        } else {
                            layer.msg('系统错误!', {icon: 1, time: 1000});
                        }
                    },
                    error: function (error) {
                        if (error.status == 403) {
                            layer.msg('权限不足!', {icon: 1, time: 1000});
                        }
                        layer.msg('系统错误!', {icon: 1, time: 1000});
                    }
                });

            });
        }

        $(function(){
            $('#select').searchableSelect();
        });
    </script>
@stop

