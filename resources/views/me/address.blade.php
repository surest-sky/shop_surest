@extends('layout.layout')

@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-10 row-tb-20">
                    {{--<div class="page-content col-xs-12 col-sm-8 col-md-9">--}}

                        {{--<!-- Checkout Area -->--}}
                        {{--<section class="section checkout-area panel prl-30 pt-20 pb-40">--}}
                            {{--<h2 class="h3 mb-20 h-title">我的收货地址: <i style="font-size: 8px">*必填</i></h2>--}}
                            {{--<form class="mb-30">--}}
                                {{--<div class="row">--}}

                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>用户名</label>--}}
                                            {{--<input type="text" name="name" class="form-control" placeholder="用户名">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>手机号码</label>--}}
                                            {{--*<input type="text" name="phone" class="form-control" placeholder="手机号码">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>省/市/区</label>--}}
                                            {{--*<input type="text" name="address" class="form-control" placeholder="省/市/区">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>详细地址</label>--}}
                                            {{--<input type="text" name="detail" class="form-control" placeholder="详细地址">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                            {{--</form>--}}
                            {{--<button class="btn btn-lg btn-rounded mr-10">新增收货地址</button>--}}
                        {{--</section>--}}
                        {{--<!-- End Checkout Area -->--}}

                    {{--</div>--}}
                    <div class="page-sidebar col-xs-12 col-sm-12 col-md-12">

                        <!-- Blog Sidebar -->
                        <aside class="sidebar blog-sidebar">
                            <div class="row row-tb-10">
                                <div class="col-xs-12">
                                    <!-- Recent Posts -->
                                    <div class="widget checkout-widget panel p-20">
                                        <div class="widget-body">
                                            <table class="table mb-15">
                                                <tbody>
                                                <tr>
                                                    <th class="color-mid">用户名</th>
                                                    <th>我的地址</th>
                                                    <th>联系方式</th>
                                                </tr>
                                                <tr >
                                                    <td>用户名</td>
                                                    <td>地址 + 详细地址</td>
                                                    <td>联系方式</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <a href="{{ route('me.address.add_edit') }}" class="btn btn-info btn-block btn-sm">添加收货地址</a>
                                        </div>
                                    </div>
                                    <!-- End Recent Posts -->
                                </div>
                            </div>
                        </aside>
                        <!-- End Blog Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Container -->


    </main>
@stop