@extends('admin.common.layout')
@section('body')
    <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>管理员列表</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock><button class="layui-btn" onclick="user_add('添加用户','{{ route('admin.user.add_or_edit') }}','800','500')">
                <i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：{{ $users->count() }} 条</span></xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    登录名
                </th>
                <th>
                    手机
                </th>
                <th>
                    邮箱
                </th>
                <th>
                    第三方
                </th>
                <th>
                    加入时间
                </th>
                <th>
                    最近登录时间
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td >
                        {{ $user->phone }}
                    </td>
                    <td >
                        {{ $user->email }}
                    </td>
                    <td >
                        {{ $user->type ?? '' }}
                    </td>
                    <td>
                        {{ $user->created_at }}
                    </td>
                    <td>
                        {{ $user->login_at }}
                    </td>
                    <td class="td-manage">

                        <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','{{{ route('admin.user.add_or_edit',['id' => $user->id]) }}}','4','','510')"
                           class="ml-5" style="text-decoration:none">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="admin_del(this,'{{ $user->id }}')"
                           style="text-decoration:none">
                            <i class="layui-icon">&#xe640;</i>
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
            laydate = layui.laydate;//日期插件
            lement = layui.element();//面包导航
            layer = layui.layer;//弹出层

            //以上模块根据需要引入

        });

        /*添加*/
        function user_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }

        //编辑
        function admin_edit (title,url,id,w,h) {
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

