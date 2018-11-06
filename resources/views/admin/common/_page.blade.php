
{{--
    需要传递两个参数 一个是分页数据、一个是所有数据，用来迭代
--}}
@if($datas->hasMorePages() > 0)
<div id="page"><div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
        <a href="{{ $datas->previousPageUrl() }}" class="layui-laypage-prev" data-page="1"><em>&lt;</em></a>
        @foreach($datasAll as $data)
            @if( $datas->currentPage() == $loop->index+1 )
                <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{{ $loop->index+1 }}</em></span>
            @else
                <a href="{{ $datas->url($loop->index+1) }}" data-page="{{ $loop->index+1 }}">{{ $loop->index+1 }}</a>
            @endif
        @endforeach
        <a href="{{ $datas->nextPageUrl() }}" class="layui-laypage-next" data-page="3"><em>&gt;</em></a>
    </div>
</div>
@endif