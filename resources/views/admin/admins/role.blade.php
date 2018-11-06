@extends('admin.common.layout')
@section('body')
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>角色管理</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">


            <xblock><button class="layui-btn"
                            onclick="role_add('添加用户','{{ route('admin.admins.role.edit_or_add') }}','900','500')">
                    <i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：{{ $roles->count() }} 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            权限名字
                        </th>
                        <th>
                            权限内容
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>
                            {{ $loop->index + 1 }}
                        </td>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td >
                            @foreach($role->permissions as $permission)
                                <button class="layui-btn layui-btn-mini layui-btn-radius layui-btn-normal" onclick="">{{ $permission->name }}</button>
                            @endforeach()
                        </td>
                        <td >
                            {{ $role->description }}
                        </td>
                        <td class="td-manage">
                            <a title="编辑" href="javascript:;" onclick="role_edit('编辑','{{ route('admin.admins.role.edit_or_add',['id'=>$role->id]) }}','4','','510')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="role_del(this,'{{ $role->id }}')"
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div id="page"></div>
        </div>
    @stop
@section('script')
    <script>
        layui.use(['laydate','element','laypage','layer'], function(){
            $ = layui.jquery;//jquery
            laydate = layui.laydate;//日期插件
            lement = layui.element();//面包导航
            laypage = layui.laypage;//分页
            layer = layui.layer;//弹出层

            //以上模块根据需要引入
        });


        /*添加*/
        function role_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }


        //编辑
        function role_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }

        /*删除*/
        function role_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                $.ajax({
                    type: 'delete',
                    url: '{{ route('admin.admins.role.delete') }}',
                    dataType: 'json',
                    data: {
                        _method: 'delete',
                        id : id,

                    },
                    success: function (data,text,response) {
                         if( response.status == 200 ){
                             $(obj).parents("tr").remove();
                             layer.msg('已删除!',{icon:1,time:1000});
                         }else{
                             layer.msg('系统错误!',{icon:1,time:1000});
                         }
                    },
                    error: function (error) {
                        layer.msg('系统错误!',{icon:1,time:1000});
                    }
                });

            });
        }
    </script>
@stop