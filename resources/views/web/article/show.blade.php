@extends('web.layouts.master')

@section('title', $article->title)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/information-details.css') }}">
    <link rel="stylesheet" href="{{ asset('share/css/share.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/information-details.js') }}"></script>
    <script src="{{ asset('share/js/jquery.share.min.js') }}"></script>
@endsection

@section('content')
    <main>
        <!--当前位置-->
        <div class="position-container">
            <div class="current-position">
                当前位置: <a href="{{ route('article.index') }}" class="first-title" title="资讯">资讯</a> >
                <a href="{{ route('article_category', $article->category->slug) }}" class="second-title"
                   title="{{ $article->category->name }}">{{ $article->category->name }}</a>
            </div>
        </div>


        <div class="web">
            <aside>
                <div class="info-details-container">
                    <div class="info-details-top">
                        <h2>{{ $article->title }}</h2>
                        <div class="details-introduce">
                            <span class="details-source">文章来源: <a href="{{ route('home') }}" target="_blank"
                                                                  title="对培网">对培网</a></span><span
                                    class="release-time">{{ $article->created_at }}</span>
                            <span class="watcher">{{ $article->views }}</span>
                            <div class="icon-accessNumberDiv"><i class="icon-icon-accessNumber"></i></div>
                        </div>
                    </div>
                    <div class="info-details-center">
                        {!! $article->content !!}
                    </div>
                </div>
            </aside>

        </div>
    </main>
@endsection