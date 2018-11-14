@extends('layout.layout')

@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-10 row-tb-20">
                    <div class="page-sidebar col-xs-12 col-sm-12 col-md-12">
                        @if( $status = session('$status') )
                            {{ $status }}
                        @endif
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