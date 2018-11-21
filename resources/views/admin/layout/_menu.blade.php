<div class="layui-side layui-bg-black x-side">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe62d;</i><cite>产品管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.product') }}">
                            <cite>商品管理</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe634;</i><cite>轮播管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.banner') }}">
                            <cite>轮播管理</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe642;</i><cite>订单管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.order') }}">
                            <cite>订单列表</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe630;</i><cite>分类管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.category') }}">
                            <cite>分类列表</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            {{--<li class="layui-nav-item">--}}
                {{--<a class="javascript:;" href="javascript:;">--}}
                    {{--<i class="layui-icon" style="top: 3px;">&#xe606;</i><cite>评论管理</cite>--}}
                {{--</a>--}}
                {{--<dl class="layui-nav-child">--}}
                    {{--<dd class="">--}}
                        {{--<a href="javascript:;" _href="./comment-list.html">--}}
                            {{--<cite>评论列表</cite>--}}
                        {{--</a>--}}
                    {{--</dd>--}}
                    {{--<dd class="">--}}
                        {{--<a href="javascript:;" _href="./feedback-list.html">--}}
                            {{--<cite>意见反馈</cite>--}}
                        {{--</a>--}}
                    {{--</dd>--}}
                {{--</dl>--}}
            {{--</li>--}}
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe612;</i><cite>会员管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.admins.users') }}">
                            <cite>会员列表</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe613;</i><cite>管理员管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.admins') }}">
                            <cite>管理员列表</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.admins.role') }}">
                            <cite>角色管理</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.admins.permission') }}">
                            <cite>权限管理</cite>
                        </a>
                    </dd>
                </dl>
            </li>

            <li class="layui-nav-item" style="height: 30px; text-align: center">
            </li>
        </ul>
    </div>

</div>