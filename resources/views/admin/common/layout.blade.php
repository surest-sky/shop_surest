<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        X-admin v1.0
    </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/x-admin.css') }}" media="all">
</head>
<body>
@yield('body')
<script src="{{ asset('assets/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('assets/admin/js/x-layui.js') }}" charset="utf-8"></script>
@yield('script')
</body>
</html>