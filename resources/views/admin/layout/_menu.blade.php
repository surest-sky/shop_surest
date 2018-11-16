<div class="layui-side layui-bg-black x-side">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe607;</i><cite>问题管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="./question-list.html">
                            <cite>问题列表</cite>
                        </a>
                    </dd>
                    </dd>
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="./question-del.html">
                            <cite>删除问题</cite>
                        </a>
                    </dd>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe62d;</i><cite>产品管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.product') }}">
                            <cite>商品管理</cite>
                        </a>
                    </dd>
                    </dd>
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.banner') }}">
                            <cite>推荐位管理</cite>
                        </a>
                    </dd>
                    </dd>
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="./welcome.html">
                            <cite>类型管理（待开发）</cite>
                        </a>
                    </dd>
                    </dd>
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="./welcome.html">
                            <cite>类型属性（待开发）</cite>
                        </a>
                    </dd>
                    </dd>
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="./category.html">
                            <cite>产品分类</cite>
                        </a>
                    </dd>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe634;</i><cite>轮播管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="./banner-list.html">
                            <cite>轮播列表</cite>
                        </a>
                    </dd>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe642;</i><cite>订单管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                    <dd class="">
                        <a href="javascript:;" _href="{{ route('admin.order') }}">
                            <cite>订单列表</cite>
                        </a>
                    </dd>
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
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe606;</i><cite>评论管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="./comment-list.html">
                            <cite>评论列表</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./feedback-list.html">
                            <cite>意见反馈</cite>
                        </a>
                    </dd>
                </dl>
            </li>
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
                    <dd class="">
                        <a href="javascript:;" _href="./member-view.html">
                            <cite>浏览记录</cite>
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
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe629;</i><cite>系统统计</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="./echarts1.html">
                            <cite>拆线图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts2.html">
                            <cite>柱状图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts3.html">
                            <cite>地图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts4.html">
                            <cite>饼图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts5.html">
                            <cite>雷达图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts6.html">
                            <cite>k线图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts7.html">
                            <cite>热力图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./echarts8.html">
                            <cite>仪表图</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="http://echarts.baidu.com/examples.html" target="_blank" _href="./welcome.html">
                            <cite>更多案例</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="javascript:;" href="javascript:;">
                    <i class="layui-icon" style="top: 3px;">&#xe614;</i><cite>系统设置</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="">
                        <a href="javascript:;" _href="./sys-set.html">
                            <cite>系统设置</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./sys-data.html">
                            <cite>数字字典</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./sys-shield.html">
                            <cite>屏蔽词</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./sys-log.html">
                            <cite>系统日志</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./sys-link.html">
                            <cite>友情链接</cite>
                        </a>
                    </dd>
                    <dd class="">
                        <a href="javascript:;" _href="./sys-qq.html">
                            <cite>第三方登录</cite>
                        </a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item" style="height: 30px; text-align: center">
            </li>
        </ul>
    </div>

</div>