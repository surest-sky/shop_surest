@extends('layout.layout')

@section('main')
    <main id="mainContent" class="main-content">
        <!-- Page Container -->
        <div class="page-container ptb-60">
            <div class="container">

                <!-- Contact Us Area -->
                <div class="contact-area contact-area-v1 panel">

                    <div class="ptb-30 prl-30">
                        <div class="row row-tb-20">
                            <div class="col-xs-12 col-md-6">
                                <div class="contact-area-col contact-info">
                                    <div class="contact-info">
                                        <h3 class="t-uppercase h-title mb-20"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系信息</font></font></h3>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></p>
                                        <ul class="contact-list mb-40">
                                            <li>
                                                <span class="icon lnr lnr-map-marker"></span>
                                                <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">地址</font></font></h5>
                                            </li>
                                            <li>
                                                <span class="icon lnr lnr-envelope"></span>
                                                <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件</font></font></h5>
                                                <p class="color-mid"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $user->email ?? '未绑定' }}</font></font></p>
                                            </li>
                                        </ul>
                                        <br>
                                        <ul>
                                            <li><a href="{{ route('me.address') }}" style="text-decoration: underline; color: #00aced">我的收货地址</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="contact-area-col contact-form">
                                    <h3 class="t-uppercase h-title mb-20"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改我的信息</font></font></h3>
                                    <form action="" method="get">
                                        <div class="form-group">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">名称</font></font></label>
                                            <input disabled="true" type="text" class="form-control" required="required" value=" {{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">电子邮件地址</font></font></label>
                                            <input type="email" disabled class="form-control" required="required" value="{{ $user->email }}">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contact Us Area -->

            </div>
        </div>
        <!-- End Page Container -->


    </main>
@stop