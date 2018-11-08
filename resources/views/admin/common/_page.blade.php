
{{--
    需要传递两个参数 一个是分页数据、一个是所有数据，用来迭代
--}}
@if($datas->perPage() > 0)
<div id="page"><div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
        <a href="{{ $datas->previousPageUrl() }}" class="layui-laypage-prev" data-page="1"><em>&lt;</em></a>
        @for($i=1; $i<=$datas->lastPage(); $i++)
            @if( $datas->currentPage() == $i )
                <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{{ $i }}</em></span>
            @else
                <a href="{{ $datas->url($i) }}" data-page="{{ $i }}">{{ $i }}</a>
            @endif
        @endfor
        <a href="{{ $datas->nextPageUrl() }}" class="layui-laypage-next" data-page="3"><em>&gt;</em></a>
    </div>
</div>
@endif