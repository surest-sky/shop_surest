@extends('admin.common.layout')
@section('body')
    <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>分类管理</cite></a>
              <a><cite>分类列表</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <form class="layui-form x-center" method="post" action="{{ route('admin.category.create') }}" style="width:50%" >
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                @endforeach
            @endif

            @method('put')
            @csrf
            <div class="layui-form-pane" style="margin-top: 15px;">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width:60px">分类名字</label>
                    <div class="layui-input-inline" style="width:120px">
                        <input type="text" name="name" placeholder="分类名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn" lay-submit="" lay-filter="add"><i class="layui-icon"></i>增加</button>
                    </div>
                </div>
            </div>
        </form>
        <xblock><span class="x-right" style="line-height:40px">共有数据：{{ $categories->count() }} 条</span></xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    分类名
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            <tbody id="x-link">
            @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->id }}
                </td>
                <td>
                    {{ $category->name }}
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','{{ route('admin.category.add_or_edit',['id'=>$category->id]) }}','4','','510')" class="ml-5" style="text-decoration:none">
                        <i class="layui-icon"></i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="cate_del(this,'{{ $category->id }}')" style="text-decoration:none">
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
        function admin_del(obj,id) {
            layer.confirm('确认要删除吗？', function (index) {
                //发异步删除数据
                $.ajax({
                    type: 'delete',
                    url: '{{ route('admin.user.delete') }}',
                    dataType: 'json',
                    data: {
                        _method: 'delete',
                        id: id,

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
    </script>
@stop

