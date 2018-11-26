@extends('layout.layout')
@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container pt-40 pb-60">
            <div class="container">
                <section class="error-page-area">
                    <div class="container">
                        <div class="error-page-wrapper t-center">
                            <div class="error-page-header" style="font-size: 30px;">
                                {{ $msg ?? '未知错误'}}
                            </div>
                            <br>
                            <a href="/" class="btn btn-rounded"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">回到主页</font></font></a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
@stop