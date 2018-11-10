<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="{{ app()->getLocale() }}">
    <title>@hasSection('title')@yield('title') - @endif对培网</title>
    <meta name="keywords" content="对培网">
    <meta name="description" content="对培网">
    <meta name="format-detection" content="telephone=no, email=no">
    <meta name="applicable-device" content="mobile">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css')
    @yield('style')
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="{{ asset('css/ie8fixed.css') }}">
    <script src="{{ asset('js/lib/html5shiv.js') }}"></script>
    <script src="{{ asset('js/lib/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<div class="header">
    <div id="header">
        <div class="header-bottom">
            <div class="header-bottom-left" style="margin-top:0px">
                <h1 class="logo"><a href="{{ route('home') }}"><img src="http://hs.momseo.com/wp-content/themes/Nana/images/logo.png" alt="对培网">对培网</a></h1>
            </div>
            <div class="header-top-search">
                <div class="search-box">
                    <div class="header-search">
                        <input type="text" id="search_key" name="key" placeholder="你想培训什么？"
                               @if(!empty($_GET['key'])) value="{{$_GET['key']}}" @endif  class="search-input"/>
                        <input type="hidden" name="type" id="search_type" value="school">
                        <?php
                        $url = explode('/', $_SERVER["REQUEST_URI"]);
                        print_r(\Illuminate\Support\Facades\Route::currentRouteName());?>
                    </div>
                    <div class="search-btn">
                        <div class="icon-searchDiv"><i class="icon-icon-search"></i></div>
                        <span onclick="search_submit()">搜索</span></div>
                </div>
            </div>
        </div>
        <!--导航-->
        <div class="index-nav">
            <div class="index-nav-con">
                <span class="index-all-classifications">
                </span>
                <ul class="index-all-ul">
                    <li><a href="/" title="首页">首页</a></li>
                    @foreach(\App\ArticleCategory::get() as $key =>$category)
                    <li><a href="{{ route('article_category', $category->slug) }}" title="{{$category->name}}">{{$category->name}}</a></li>
                   @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@yield('content')
<div class="footer">

    <div class="footer-bottom">
        <div class="footer-bottom-top">
            <div>
                @foreach(\App\Link::orderBy('sort','desc')->get() as $link)
                    <a href="{{$link->url}}" title="{{$link->name}}" target="_blank">{{$link->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="footer-bottom-bottom">
            <nav>
                <a href="/about-details" title="对培网">关于对培 <span></span></a>
                <a href="/contact" title="对培网">联系我们 <span></span></a>
                <a href="/job" title="对培网">诚聘英才 <span></span></a>
                <a href="javascript:" title="对培网">合作伙伴 <span></span></a>
                <a href="javascript:" title="对培网">法律声明 <span></span></a>
                <a href="javascript:" title="对培网">建议与投诉</a>
            </nav>
            <div id="copyright">Copyright 2016-{{ date('Y') }} duipei.com All right reserved.
                <a href="javascript:">粤ICP备12345678903232号</a>
                <div class="icon-footerDiv"><i class="icon-icon-footer"></i></div>
                粤公网安备 1234567891021545号
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/lib/jquery.min.js?v=1.11.3') }}"></script>
<script>
    function search_switch(type) {
        $('#search_type').val(type);
    }

    function search_submit() {

        var key = $('#search_key').val();
        if (key) {
            window.location.href = "/" + $('#search_type').val() + '?key=' + $('#search_key').val();
        } else {
            window.location.href = "/" + $('#search_type').val();
        }
    }

</script>
@yield('js')
@yield('script')
</body>
</html>