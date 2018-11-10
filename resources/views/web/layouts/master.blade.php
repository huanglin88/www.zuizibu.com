<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="{{ app()->getLocale() }}">
    <title>@hasSection('title')@yield('title') - @endif花生日记</title>
    <meta name="keywords" content="花生日记">
    <meta name="description" content="花生日记">
    <meta name="format-detection" content="telephone=no, email=no">
    <meta name="applicable-device" content="mobile">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('css')
    @yield('style')
    <!--[if lt IE 9]>

    <![endif]-->
</head>
<body>
<div class="header">
    <div class="nav " style="width: 85%;margin: 0 auto;">
        <div class="wp">
            <ul class="nav1">
                <li><a href="/">首页</a></li>
                @foreach(\App\ArticleCategory::select('slug','name')->get() as $category)
                <li><a href="/article/category/{{$category->slug}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@yield('content')

<div class="footer">
    <div>
        <a href="">关于我们</a>
        <a href="">联系我们</a>
        <a href="">工作机会</a>
        <a href="">商务合作</a>
        <a href="">法律声明</a>
    </div>
    <p>版权所有 2018  |</p>
</div>
@yield('js')
@yield('script')
</body>
</html>
