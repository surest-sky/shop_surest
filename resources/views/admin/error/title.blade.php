@extends('admin.common.layout')

@section('body')
    <fieldset class="layui-elem-field site-demo-button">
        <div>
            <button class="layui-btn layui-btn-normal layui-btn-radius" onclick="parent.location.reload();">{{ $msg }}</button>
        </div>
    </fieldset>
@stop