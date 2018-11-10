@extends('web.layouts.master')

@section('title', '资讯列表')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/lib/idangerous.swiper.css?v=2.7.6') }}">
    <link rel="stylesheet" href="{{ asset('css/information.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/lib/idangerous.swiper.min.js?v=2.7.6') }}"></script>
    <script src="{{ asset('js/information.js') }}"></script>
@endsection

@section('content')
    <main>
        <div class="web">
            <aside>
                <!--文章列表-->
                <div class="infomation-box">
                    <div class="info-article-items">
                        @foreach($articles as $article)
                            <a href="{{ route('article.show', $article->slug) }}">
                                <div class="info-article-box box">
                                    <div class="article-img">
                                        <img src="{{ $article->cover }}?x-oss-process=image/resize,m_fill,w_400,h_280"
                                             alt="{{ $article->title }}">
                                    </div>
                                    <div class="article-msg">
                                        <h2>{{ $article->title }}</h2>
                                        <p>{{ str_limit(strip_tags($article->content), 300) }}</p>
                                        <div class="article-else">
                                            <div class="else-left">
                                                <span class="box-time">{{ $article->created_at->format('Y-m-d') }}</span>
                                                <div class="box-classify">
                                                    <span>分类：</span><span class="classifyName"
                                                                          title="{{ $article->category->name }}">{{ $article->category->name }}</span>
                                                </div>
                                            </div>
                                            <div class="else-right">
                                                <div class="icon-accessNumberDiv">
                                                    <i class="icon-icon-accessNumber"></i>
                                                </div>
                                                <span class="accessNumber">{{ $article->views }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                {{ $articles->links() }}
            </aside>

        </div>
    </main>
@endsection