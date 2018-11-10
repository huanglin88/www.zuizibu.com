@extends('web.layouts.master')

@section('title', '资讯列表')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/swiper.min.js') }}"></script>
@endsection

@section('script')
    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-l fl">
            <div class="app">
                <h4>{{$category->name}}</h4>
                <img src="{{$category->logo}}" width="130" height="124" alt="">
                <p>大小：5.98M</p>
                <p>版本：5.1.38</p>
            </div>
            <div class="download">
                <div class="download-title">{{$category->name}}下载</div>
                <a href="{{$category->android_download_url}}">安卓版下载</a>
                <a href="{{$category->ios_download_url}}">iphone版下载</a>
                <a href="" class="download-qr">二维码下载</a>
                <img src="{{$category->code_img}}" width="126" height="126" alt="">
            </div>
        </div>
        <div class="card-r fl">
            <div class="card-item">
                <div class="card-title">{{$category->name}}APP介绍</div>
                <div class="card-content">
                    {{$category->content}}
                </div>
            </div>
            <div class="card-item">
                <div class="card-title">其他手机应用</div>
                <div class="card-content">
                    <ol class="card-content-app">
                        @foreach(\App\ArticleCategory::where('id','<>',$category->id)->orderBy('id')->take(5)->get() as $cate)
                            <li>
                                <a target="_blank" href="/article/category/{{$cate->slug}}">
                                    <img src="{{$cate->logo}}" width="68" height="68" alt="">
                                    <p>{{$cate->name}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="card-item">
                <div class="card-title">{{$category->name}}</div>
                <div class="card-content">
                    <ul>
                        @foreach($articles as $article)
                            <li class="card-content-item">
                                <h5><a href="/article/{{$article->slug}}" target="_blank">{{$article->title}}</a></h5>
                                <div>
                                    {{$article->abstract}}
                                </div>
                                <p>{{$article->created_at->format('Y年m月d日')}}</p>
                            </li>
                        @endforeach
                    </ul>
                    {{--<div class="pagination">--}}
                    {{--<button type="button" disabled="disabled" class="btn-prev"><i class="fa fa-angle-left"></i>--}}
                    {{--</button>--}}
                    {{--<ul class="pager">--}}
                    {{--<li class="number active">1</li><!---->--}}
                    {{--<li class="number">2</li>--}}
                    {{--<li class="number">3</li>--}}
                    {{--<li class="number">4</li>--}}
                    {{--<li class="number">5</li>--}}
                    {{--</ul>--}}
                    {{--<button type="button" class="btn-next"><i class="fa fa-angle-right"></i></button>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection