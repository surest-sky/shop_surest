@extends('layout.layout')
@section('title',$products->first()->category->name)
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-10">
            <div class="container">
                <section class="section deals-area ptb-30">

                    <!-- Page Control -->
                    <header class="page-control panel ptb-15 prl-20 pos-r mb-30">

                        <!-- List Control View -->
                        <ul class="list-control-view list-inline">
                            <li>
                            </li>
                            <li>
                            </li>
                        </ul>
                        <!-- End List Control View -->

                        <div class="right-10 pos-tb-center">
                            <select class="form-control input-sm sort">in
                                <option value="new" @if($sort=='new') selected @endif>最新发布</option>
                                <option value="sale" @if($sort=='sale') selected @endif>销量最多</option>
                                <option value="review" @if($sort=='review') selected @endif>评论最多</option>
                                <option value="h_price" @if($sort=='h_price') selected @endif>价格最贵</option>
                                <option value="b_price" @if($sort=='b_price') selected @endif>价格最低</option>
                            </select>
                        </div>
                    </header>
                    <!-- End Page Control -->
                    <div class="row row-masnory row-tb-20">

                        @foreach($products as $product)
                            <div class="col-sm-6 col-lg-4">
                                <div class="deal-single panel">
                                    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9"
                                            data-bg-img="{{ $product->image->src ?? '' }}">
                                        <div class="label-discount left-20 top-15">{{ str_limit($product->category->name,4,'..') }}</div>
                                        <ul class="deal-actions top-15 right-20">
                                            <li class="like-deal" data-id="{{ $product->id }}"><span><i class="fa fa-heart"></i></span>
                                            </li>
                                            <li class="share-btn">
                                                <div class="share-tooltip fade">
                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                    <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                </div>
                                                <span><i class="fa fa-share-alt"></i></span>
                                            </li>
                                        </ul>
                                        <div class="deal-store-logo">
                                            <img src="{{ $product->image->src ?? '' }}" alt="">
                                        </div>
                                    </figure>
                                    <div class="bg-white pt-20 pl-20 pr-15">
                                        <div class="pr-md-10">
                                            <div class="rating mb-10">
                                                <span class="rating-stars rate-allow"
                                                      data-rating="{{ $product->rating ?? 1 }}">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </span>
                                                <span class="rating-reviews">
                                ( <span class="rating-count">{{ $product->review_count }}</span> 评论数 )
                                                </span>
                                            </div>
                                            <h3 class="deal-title mb-10">
                                                <a href="{{ route('product.show',['id' => $product->id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                <li>
                                                    <i class="ico mr-10">成交量:</i>{{ $product->sold_count }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="deal-price pos-r mb-15">
                                            <h3 class="price ptb-5 text-right">价格：<span
                                                        class="price-sale"></span>{{ $product->price }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Page Pagination -->
                    <div class="page-pagination text-center mt-30 p-10 panel">
                        <nav>
                            <!-- Page Pagination -->
                            <ul class="page-pagination">
                                <li><a href="?current='{{ $result['prev'] }}" class="page-numbers previous" href="#">上一页</a>
                                </li>
                                @for($i=1; $i <= $result['endPage']; $i++ )
                                    @if( $i == $result['current'] )
                                        <li><a href="{{ url()->current() .'?current=' . $i }}" class="page-numbers current">{{ $i }}</a>
                                        </li>
                                    @else
                                        <li><a href="{{ url()->current() .'?current=' . $i }}" class="page-numbers">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                                <li><a href="{{ url()->current() .'?current=' . $result['next'] }}" class="page-numbers next">下一页</a>
                                </li>
                            </ul>
                            <!-- End Page Pagination -->
                        </nav>
                    </div>
                    <!-- End Page Pagination -->

                </section>

            </div>
        </div>


    </main>
@stop
@section('script')
    <script>
        $('.sort').on('change',function () {
            window.location = '?sort='+$(this).val();
        })
    </script>

    @include('layout._extend_js')
@stop