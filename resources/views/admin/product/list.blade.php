@extends('admin.common.layout')
@section('body')
    <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>商品管理</cite></a>
              <a><cite>商品列表</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <xblock><button class="layui-btn" onclick="product_add('添加商品','{{ route('admin.product.add_or_edit') }}','800','500')">
                <i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：{{ $products->count() }} 条</span></xblock>
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
                    库存
                </th>
                <th>
                    价格/特价
                </th>
                <th>
                    分类
                </th>
                <th>
                    销售量
                </th>
                <th>
                    评价数
                </th>
                <th>
                    评星(10颗星星)
                </th>
                <th>
                    创建时间
                </th>
                <th>
                    是否上架
                </th>
                <th>
                    操作
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $loop->index+1 }}
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{ $product->stock }}
                    </td>
                    <td >
                        {{ $product->price }}
                    </td>
                    <td >
                        {{ $product->category->name }}
                    </td>
                    <td >
                        {{ $product->sold_count }}
                    </td>
                    <td >
                        {{ $product->review_count }}
                    </td>
                    <td >
                        {{ $product->rating }}
                    </td>
                    <td>
                        {{ $product->created_at }}
                    </td>
                    <td class="td-status">
                        @if($product->actived)
                            <span class="layui-btn layui-btn-normal layui-btn-mini">
                                已上架
                            </span>
                        @else
                            <span class="layui-btn layui-btn-disabled layui-btn-mini">
                                已下架
                            </span>
                        @endif
                    </td>
                    <td class="td-manage">
                        @if($product->actived)
                            <a style="text-decoration:none" onclick="admin_stop(this,'{{ $product->id }}','0')" href="javascript:;" title="停用">
                                <i class="layui-icon">&#xe601;</i>
                            </a>
                        @else
                            <a style="text-decoration:none" onClick="admin_start(this,'{{ $product->id }}','1')" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>
                        @endif

                        <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','{{{ route('admin.product.add_or_edit',['id' => $product->id]) }}}','4','','510')"
                           class="ml-5" style="text-decoration:none">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="admin_del(this,'{{ $product->id }}')"
                           style="text-decoration:none">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{--@include('admin.common._page',['datas'=>$products , 'datasAll' => $productsAll])--}}
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
        function product_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }

        /*停用*/
        function admin_stop(obj,id,actived){
            layer.confirm('确认要停用吗？',function(index){
                if( !parseInt(admin_active(id,actived)) ){
                    return ;
                }
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-manage").prepend(`<a style="text-decoration:none" onClick="admin_start(this,${id},\'1\')" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>`);
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>');
                $(obj).remove();
                layer.msg('已停用!',{icon: 5,time:1000});
            });
        }

        /*启用*/
        function admin_start(obj,id,actived){
            layer.confirm('确认要启用吗？',function(index){
                //发异步把用户状态进行更改
                if( !parseInt(admin_active(id,actived)) ){
                    return ;
                }
                $(obj).parents("tr").find(".td-manage").prepend(`<a style="text-decoration:none" onClick="admin_stop(this,${id},\'0\')" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>`);
                $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
                $(obj).remove();
                layer.msg('已启用!',{icon: 6,time:1000});
            });
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
                    url: '{{ route('admin.admins.delete') }}',
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

        function admin_active(id,active) {
            //发异步删除数据
            $.ajax({
                type: 'put',
                url: '{{ route('admin.admins.active') }}',
                dataType: 'json',
                async: false,
                data: {
                    _method: 'put',
                    id: id,
                    active: active

                },
                success: function (data, text, response) {
                    if (response.status == 200) {
                        // layer.msg('已修改!', {icon: 1, time: 1000});
                        result= 1;
                        console.log(result);
                    } else {
                        layer.msg('系统错误!', {icon: 1, time: 1000});
                        result = 0;
                    }
                },
                error: function (error) {
                    if (error.status == 403) {
                        layer.msg('权限不足!', {icon: 1, time: 1000});
                    }else{
                        layer.msg('系统错误!', {icon: 1, time: 1000});
                    }
                    result = 0;

                }
            });

            console.log(result);
            return result;
        }
    </script>
@stop

