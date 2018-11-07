<div class="layui-header header header-demo">
    <div class="layui-main">
        <a class="logo" href="./index.html">
            后台管理
        </a>
        <ul class="layui-nav" lay-filter="">
            <li class="layui-nav-item"><img src="./images/logo.png" class="layui-circle" style="border: 2px solid #A9B7B7;" width="35px" alt=""></li>
            <li class="layui-nav-item">
                <a href="javascript:;">{{ $user->name }}</a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <dd><a href="">个人信息</a></dd>
                    <dd><a href="javascript:;" onclick="document.getElementById('logout').submit()">切换帐号</a></dd>
                    <form id="logout" action="{{ route('admin.logout') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                </dl>
            </li>
            <!-- <li class="layui-nav-item">
              <a href="" title="消息">
                  <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
              </a>
              </li> -->
            <li class="layui-nav-item x-index"><a href="/">前台首页</a></li>
        </ul>
    </div>
</div>