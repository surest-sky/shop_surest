@extends('admin.common.layout')
@section('body')
    
    <body>
        <div class="x-body">

            @if($id)
                <form class="layui-form layui-form-pane" action="{{ route('admin.product.update',['id' => $id]) }}" method="post">
                    @method('put')
            @else
                <form class="layui-form layui-form-pane" action="{{ route('admin.product.create') }}" method="post">
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
                        <input required type="text" name="name"  value="{{ old('name') ?? $product->name ?? ''}}" autocomplete="off" placeholder="商品名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-form-item">
                        <img id="product_img" style="max-width: 400px; max-height: 600px" src="{{ old('product_img') ?? $product->product_img ?? '' }}" alt="">
                        <input required type="hidden" id="product" name="product_img" value="{{ old('product_img') ?? $product->product_img ?? '' }}">
                    </div>
                        <input type="file" name="file" class="layui-upload-file product">
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">分类选择</label>
                    <div class="layui-input-block">
                        <select required name="category" lay-filter="aihao">
                            @foreach($categoies as $categoy)
                                <option value="{{ $categoy->id }}" @if( ( old('category') ?? $product->category_id ?? '') == $categoy->id  ) selected @endif>{{ $categoy->name ?? '' }}</option>
                            @endforeach
                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="阅读" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">请选择</dd><dd lay-value="0" class="">写作</dd><dd lay-value="1" class="layui-this">阅读</dd><dd lay-value="2" class="">游戏</dd><dd lay-value="3" class="">音乐</dd><dd lay-value="4" class="">旅行</dd></dl></div>
                    </div>
                </div>

                <div class="layui-form-item reday-insert" pane="">
                    <label class="layui-form-label">是否上架</label>
                    <div class="layui-input-block">
                        @if( old('actived') ?? $product->actived ?? '' )
                            <input type="radio" name="actived" value="1" title="上架" checked>
                            <input type="radio" name="actived" value="0" title="下架">
                        @else
                            <input type="radio" name="actived" value="1" title="上架">
                            <input type="radio" name="actived" value="0" title="下架" checked>
                        @endif
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">商品详情</label>
                    <div class="layui-input-block">
                        <textarea name="description" id="demo" placeholder="请输入内容" class="layui-textarea">{{ old('description') ??  $product->description ?? ''  }}</textarea>
                    </div>
                </div>

                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                        <legend>SKU1</legend>
                    </fieldset>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku名称</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new1][name]" value="{{ old('skus.new1.name') ?? $product->sku1->name ?? '' }}" autocomplete="off" placeholder="Sku名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-form-item">
                            <img id="product_img" style="max-width: 400px; max-height: 600px" src="{{ old('skus.new1.skuImg')  ?? $product->sku1->image->src ?? '' }}" alt="">
                            <input required type="hidden" id="product" name="skus[new1][skuImg]" value="{{ old('skus.new1.skuImg') ?? $product->sku1->image->src ?? '' }}">
                        </div>
                        <input type="file" name="file" class="layui-upload-file sku1">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku描述</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new1][description]" value="{{ old('skus.new1.description') ?? $product->sku1->description ?? '' }}" autocomplete="off" placeholder="Sku描述" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku单价</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new1][price]" value="{{ old('skus.new1.price') ?? $product->sku1->price ?? ''  }}" autocomplete="off" placeholder="Sku单价" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku库存</label>
                        <div class="layui-input-block">
                            <input required type="text" name="skus[new1][stock]" value="{{ old('skus.new1.stock') ?? $product->sku1->stock ?? '' }}" autocomplete="off" placeholder="Sku库存" class="layui-input">
                        </div>
                    </div>


                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                        <legend>SKU2</legend>
                    </fieldset>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="skus[new2][name]" value="{{ old('skus.new2.name') ?? $product->sku2->name ?? ''  }}" autocomplete="off" placeholder="Sku名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-form-item">
                            <img id="product_img" style="max-width: 400px; max-height: 600px" src="{{ old('skus.new2.skuImg') ?? $product->sku2->image->src ?? '' }}" alt="">
                            <input required type="hidden" id="product" name="skus[new2][skuImg]" value="{{ old('skus.new2.skuImg') ?? $product->sku2->image->src ?? '' }}">
                        </div>
                        <input type="file" name="file" class="layui-upload-file sku2">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="skus[new2][description]" value="{{ old('skus.new2.description') ?? $product->sku2->description ?? '' }}" autocomplete="off" placeholder="Sku描述" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku单价</label>
                        <div class="layui-input-block">
                            <input type="text" name="skus[new2][price]" value="{{ old('skus.new2.price') ?? $product->sku2->price ?? '' }}" autocomplete="off" placeholder="Sku单价" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Sku库存</label>
                        <div class="layui-input-block">
                            <input type="text" name="skus[new2][stock]" value="{{ old('skus.new2.stock') ?? $product->sku2->stock ?? '' }}" autocomplete="off" placeholder="Sku库存" class="layui-input">
                        </div>
                    </div>
                <div class="layui-form-item">
                    <button class="layui-btn"  type="submit">提交</button>
                </div>
            </form>
        </div>
    </body>
        @stop

        @section('script')
            <script>
                window.onload=function () {
                    layui.use(['form','layer','upload'], function(){
                        $ = layui.jquery;
                        var form = layui.form()
                            ,layer = layui.layer;

                        layui.upload({
                            url: '{{ route('admin.product.upload') }}' //接口url
                            ,ext: 'jpg|png|gif' //那么，就只会支持这三种格式的上传。注意是用|分割。
                            ,success: function(res,elem,a){
                                if( res.code != 0) {
                                    layer.msg(res.msg, {icon: 5});
                                    return;
                                }
                                var src = res.data.src;
                                setImg(elem.className,src)
                            }
                            ,error: function (error) {
                                consloe.load('系统异常');
                            }
                        });
                    });
                    layui.use('layedit', function(){
                        var layedit = layui.layedit;

                        layedit.set({
                            uploadImage: {
                                url: '{{ route('admin.product.upload') }}' //接口url
                            }
                        });
                        layedit.build('demo',{
                            height: 500 //设置编辑器高度
                        }); //建立编辑器

                    });

                    function setImg(className,src){
                        className = className.replace('layui-upload-file ','');
                        $(`.${className}`).parent().parent().parent().find('#product').val(src);
                        $(`.${className}`).parent().parent().parent().find('#product_img').attr('src',src);
                    }

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
                }

            </script>


        @stop