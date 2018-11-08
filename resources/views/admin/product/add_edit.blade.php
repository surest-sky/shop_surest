@extends('admin.common.layout')
@section('body')
    
    <body>
        <div class="x-body">

            @if($id)
                <form class="layui-form layui-form-pane" action="{{ route('admin.product.update',['id' => $id]) }}">
                    @method('put')
            @else
                <form class="layui-form layui-form-pane" action="{{ route('admin.product.create') }}">
                    @method('post')
            @endif
                @csrf

                 @if( $status = session('status') )
                     <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $status }}</button>
                 @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <button class="layui-btn layui-btn-danger layui-btn-radius">{{ $error }}</button>
                        @endforeach
                    @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">商品名称</label>
                    <div class="layui-input-block">
                        <input required type="text" name="name" autocomplete="off" placeholder="商品名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-form-item">
                        <img style="max-width: 400px; max-height: 600px" src="http://img2.niutuku.com/desk/1208/1322/ntk-1322-44337.jpg" alt="">
                        <input required type="hidden" name="image" value="">
                    </div>
                    <button type="button" class="layui-btn" id="test1">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">分类选择</label>
                    <div class="layui-input-block">
                        <select required name="interest" lay-filter="aihao">
                            @foreach($categoies as $categoy)
                                <option value="{{ $categoy->id }}}">{{ $categoy->name }}</option>
                            @endforeach
                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="阅读" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">请选择</dd><dd lay-value="0" class="">写作</dd><dd lay-value="1" class="layui-this">阅读</dd><dd lay-value="2" class="">游戏</dd><dd lay-value="3" class="">音乐</dd><dd lay-value="4" class="">旅行</dd></dl></div>
                    </div>
                </div>

                <div class="layui-form-item reday-insert" pane="">
                    <label class="layui-form-label">是否上架</label>
                    <div class="layui-input-block">
                        <input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" title="开关">
                        <div class="layui-unselect layui-form-switch" lay-skin="_switch"><em></em><i></i></div>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">商品详情</label>
                    <div class="layui-input-block">
                        <textarea required id="demo" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>

                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                        <legend>SKU1</legend>
                    </fieldset>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku名称</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new_1][name]" autocomplete="off" placeholder="Sku名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-form-item">
                            <img style="max-width: 400px; max-height: 600px" src="http://img2.niutuku.com/desk/1208/1322/ntk-1322-44337.jpg" alt="">
                            <input required type="hidden" name="skus[new_1][image]" value="{{ old('skus[new_1][image]') ?? '' }}">
                        </div>
                        <button type="button" class="layui-btn" id="test1">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku描述</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new_1][description]" value="{{ old('skus[new_1][description]') ?? '' }}" autocomplete="off" placeholder="Sku描述" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku单价</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new_1][price]" value="{{ old('skus[new_1][price]') ?? '' }}" autocomplete="off" placeholder="Sku单价" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku库存</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new_1][stock]" value="{{ old('skus[new_1][stock]') ?? '' }}" autocomplete="off" placeholder="Sku库存" class="layui-input">
                        </div>
                    </div>


                <div class="layui-form-item">
                    <button class="layui-btn" lay-submit="" lay-filter="demo2" type="submit">提交</button>
                </div>
            </form>
        </div>
    </body>
        @stop

        @section('script')
            <script>
                alert('{{ url()->full() }}');
                layui.use(['form','layer'], function(){
                    $ = layui.jquery;
                    var form = layui.form()
                        ,layer = layui.layer;
                });
                layui.use('layedit', function(){
                    var layedit = layui.layedit;

                    layedit.set({
                        uploadImage: {
                            url: '{{ route('admin.product.upload') }}' //接口url
                        }
                    });
                    layedit.build('demo'); //建立编辑器

                });



                $('img').on('click',function () {
                    layer.open({
                        type: 1,
                        title: false,
                        closeBtn: 0,
                        area: '516px',
                        skin: 'layui-layer-nobg', //没有背景色
                        shadeClose: true,
                        content: `<img style="max-width: 100%; max-height: 100%" src="${$(this).attr('src')}" alt="">`
                    });
                })
            </script>


        @stop