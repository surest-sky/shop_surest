<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            {{ config('main.name') }} - 后台管理
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="{{ asset('assets/admin/css/x-admin.css') }}" media="all">
    </head>
    <body>
        <div class="layui-layout layui-layout-admin">

            @include('admin.layout._header')

            @include('admin.layout._menu')
            <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
                <div class="x-slide_left"></div>
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        我的桌面
                        <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
                    </li>
                </ul>
                <div class="layui-tab-content site-demo site-demo-body">
                    <div class="layui-tab-item layui-show">
                        <iframe frameborder="0" src="{{ route('admin.welcome') }}" class="x-iframe"></iframe>
                    </div>
                </div>
            </div>
            <div class="site-mobile-shade">
            </div>
        </div>
        <script src="{{ asset('assets/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
        <script src="{{ asset('assets/admin/js/x-admin.js') }}"></script>
    </body>
</html>