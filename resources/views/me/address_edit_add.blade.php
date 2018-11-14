
@extends('layout.layout')

@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">
                <div class="row row-rl-12 row-tb-20">
                    <div class="page-content col-xs-12 col-sm-12 col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                           </div>
                        @endif

                        @if($error = session('error') )
                            {{ $error }}
                        @endif

                        <!-- Checkout Area -->
                        <section class="section checkout-area panel prl-30 pt-20 pb-40">
                            <h2 class="h3 mb-20 h-title">我的收货地址: <i style="font-size: 8px">*必填</i></h2>

                            @if( isset($address) && !empty($address) )
                                <form class="mb-30" action="{{ route('me.address.update') }}" method="post">
                                    @method('put')

                                    <input type="hidden" name="id" value="{{ $address->id }}">
                            @else
                                <form class="mb-30" action="{{ route('me.address.create') }}" method="post">
                            @endif

                                @csrf()
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>用户名</label>
                                            <input type="text" value="{{ $address->name ?? old('name') ?? Auth::user()->name ?? '' }}" name="name" class="form-control" placeholder="用户名">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>手机号码</label>
                                            *<input type="text" name="phone" value="{{ $address->phone ??old('phone') ?? Auth::user()->phone ?? '' }}" class="form-control" placeholder="手机号码">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>省/市/区</label>
                                            *<input type="text" name="address" class="form-control" value="{{ $address->address ?? old('address') ?? '' }}" placeholder="省/市/区">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            *<label>详细地址</label>
                                            <input type="text" name="detail" class="form-control" value="{{ $address->detail ?? old('detail') ?? '' }}"  placeholder="详细地址">
                                        </div>
                                    </div>
                                    @if( isset($address) && !empty($address) )
                                        <button type="submit" class="btn btn-lg btn-rounded mr-10">更新收货地址</button>
                                    @else
                                        <button type="submit" class="btn btn-lg btn-rounded mr-10">新增收货地址</button>
                                    @endif
                                </div>
                            </form>
                        </section>
                        <!-- End Checkout Area -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Container -->


    </main>
@stop