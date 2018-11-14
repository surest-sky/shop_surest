@extends('layout.layout')

@section('title','我的收货地址')
@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-10 row-tb-20">
                    <div class="page-sidebar col-xs-12 col-sm-12 col-md-12">
                        @if($status = session('status') )
                            <div class="alert alert-success">
                                <ul>
                                    <li>{{ $status }}</li>
                                </ul>
                            </div>
                        @endif

                        @if($error = session('error') )
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $error }}</li>
                                    </ul>
                                </div>
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
                                                    <th>操作</th>
                                                </tr>
                                                @foreach($addresses as $address)
                                                <tr >
                                                    <td>{{ $address->name }}</td>
                                                    <td>{{ $address->addresses }}</td>
                                                    <td>{{ $address->phone }}</td>
                                                    <td>
                                                        <a href="{{ route('me.address.add_edit' ,['id' => $address->id ]) }}"><i></i><font>编辑</font></a>
                                                        <a class="delete_addr" href="javascript:;" data-id="{{ $address->id }}"><i></i><font>删除</font></a>
                                                    </td>
                                                </tr>
                                                @endforeach
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

@section('script')
    <script>
            $('.delete_addr').on('click' , function () {

                var r = confirm('是否确认删除');
                if( r != true ) {
                    return false;
                }
                var $obj = $(this);
                var id = $obj.attr('data-id');
                $.ajax({
                    url: '{{ route('me.address.delete') }}',
                    method: 'delete',
                    data: {
                        _method: 'delete',
                        id: id
                    },
                    success: function (data) {
                        if( data.status == 200 ) {
                            swal(
                                '删除成功','','success'
                            );
                            $obj.parents('tr').remove();
                        }else{
                            swal(
                                '未知异常','','error'
                            );
                        }
                    },
                    error: function (error) {
                        swal(
                            '删除失败', '', 'error'
                        );
                    }
                })
            })
        
    </script>
@stop