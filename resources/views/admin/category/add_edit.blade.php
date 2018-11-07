@extends('admin.common.layout')
@section('body')
    
    <body>
    <div class="x-body">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="cname" class="layui-form-label">
                    ID
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="cname" name="cname" required="" lay-verify="required" autocomplete="off" value="1" disabled="" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="cname" class="layui-form-label">
                    <span class="x-red">*</span>分类名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="cname" name="cname" required="" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">所属分类</label>
                <div class="layui-input-inline">
                    <select name="fid">
                        <option value="0">顶级分类</option>
                    </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="顶级分类" value="顶级分类" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="0" class="layui-this">顶级分类</dd><dd lay-value="新闻" class="">新闻</dd><dd lay-value="新闻子类1" class="">--新闻子类1</dd><dd lay-value="新闻子类2" class="">--新闻子类2</dd><dd lay-value="产品" class="">产品</dd><dd lay-value="产品子类1" class="">--产品子类1</dd><dd lay-value="产品子类2" class="">--产品子类2</dd></dl></div>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button class="layui-btn" lay-filter="save" lay-submit="">
                    保存
                </button>
            </div>
        </form>
    </div>
    </body>
        @stop

        @section('script')
            <script>
                layui.use(['form','layer'], function(){
                    $ = layui.jquery;
                    var form = layui.form()
                        ,layer = layui.layer;
                });
            </script>
        @stop