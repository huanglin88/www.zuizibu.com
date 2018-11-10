@extends('web.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/lib/idangerous.swiper.css?v=2.7.6') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/lib/idangerous.swiper.min.js?v=2.7.6') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
    <main>
        <div class="news-info">
            <div class="news-info-con">
                <div class="module-title">
                    <div class="title-left">
                        <div class="title-blue"></div>
                        <h3>新闻资讯</h3>
                    </div>
                    <div class="title-right">
                        <a href="{{ route('article.index') }}" target="_blank">查看全部</a>
                        <div class="icon-checkAllDiv"><i class="icon-icon-checkAll"></i></div>
                    </div>
                </div>
                <div class="news-info-list">
                    <div class="news-info-items box">
                        <div class="news-items-msg">
                            <div class="news-msg-top">
                                <h6>最新资讯</h6>
                                <div class="icon-checkAllDiv"><i class="icon-icon-checkAll"></i></div>
                                <a href="{{ route('article.index') }}" title="最新资讯" target="_blank">更多</a>
                            </div>
                            <ul>
                                @foreach($articles_newest as $article)
                                    <li>
                                        <a class="news-title" target="_blank"
                                           href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a><span
                                                class="news-send-time">{{ $article->created_at->format('m-d') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @foreach($categories as $category)
                        <div class="news-info-items box">
                            <div class="news-items-msg">
                                <div class="news-msg-top">
                                    <h6>{{ $category->name }}</h6>
                                    <div class="icon-checkAllDiv"><i class="icon-icon-checkAll"></i></div>
                                    <a href="/article/category/{{ $category->slug}}" title="{{ $category->name }}"
                                       target="_blank">更多</a>
                                </div>
                                <ul>
                                    @foreach($category->articles()->take(5)->get() as $article)
                                        <li>
                                            <a class="news-title"
                                               href="{{ route('article.show', $article->slug) }}"
                                               target="_blank">{{ $article->title }}</a><span
                                                    class="news-send-time">{{ $article->created_at->format('m-d') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection