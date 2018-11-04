@extends('layout.layout')
@section('content')
    <main id="mainContent" class="main-content">
        <div class="page-container pt-40 pb-60">
            <div class="container">
                <section class="error-page-area">
                    <div class="container">
                        <div class="error-page-wrapper t-center">
                            <div class="error-page-header" style="font-size: 100px;">
                                {{ $message ?? '未知错误'}}
                            </div>
                            <div class="error-page-footer">
                                <h5 class="color-mid mb-5"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">哎呀！</font></font></h5>
                                <h2 class="t-uppercase m-10 color-green"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">抱歉</font></font></h2>
                                <p class="color-muted mb-30 font-15"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            无法找到您正在寻找的页面！
                                        </font></font></p>
                            </div>
                            <a href="/" class="btn btn-rounded"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">回到主页</font></font></a>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </main>
@stop