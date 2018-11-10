@extends('web.layouts.master')

@section('title', '资讯详情')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('js')

@endsection

@section('script')

@endsection

@section('content')
    <div class="cont-box">
        <div class="content wp">
            <div class="position">
                <ul>
                    <a href="/">首页</a>&gt;
                    <a href="/article/category/{{$category->slug}}">{{$category->name}}</a>&gt;
                    <a href="/article/{{$article->slug}}">{{$article->title}}</a>
                </ul>
            </div>
            <div class="list-zw">
                <div class="list-zw-left l">
                    <div class="xq-title">
                        <h1>{{$article->title}}</h1>
                    </div>
                    <div class="xq-bianji">
                        <span>发布时间：{{$article->created_at}}</span>
                    </div>
                    <div class="xq-nr">
                        {!! $article->content !!}
                    </div>
                </div>
                <div class="list-zw-right msglist-zw-right l">
                    <div class="jingdiantj">
                        <div class="jingdiantj-title">
                            <p>热门排行</p> <span>NEWS</span>
                        </div>
                        <div class="jingdiantj-list">
                            @foreach(\App\Article::orderBy('views','desc')->take(10)->get() as $to_article)
                                <a href="/article/{{$to_article->slug}}" title="{{$to_article->title}}">
                                    <h3>{{$to_article->title}}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection