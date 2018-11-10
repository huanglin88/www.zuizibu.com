@extends('web.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/peanut.css') }}">
@endsection

@section('js')

@endsection

@section('content')
    <div class="peanut-introduce">
        <?php $site_title = '花生日记'; $set = \App\Set::where('id',1)->first();?>
        <h2 class="section-title">
            <strong>{{$site_title}}</strong>
            -{{$set->content_1}}
        </h2>
        <ul class="section-content">
            <li>
                <h5>{{$site_title}}APP介绍</h5>
                <p>{{$set->content_2}}</p>
            </li>
            <li>
                <h5>{{$site_title}}的优势</h5>
                <p>{{$set->content_3}}</p>
            </li>
            <li>
                <h5>{{$site_title}}的未来</h5>
                <p>{{$set->content_3}}</p>
            </li>
        </ul>
    </div>
    <div class="peanut-list">
        @foreach(\App\ArticleCategory::select('slug','name','logo','content','id')->get() as $category)
            <div class="peanut-list-item">
                <div class="qrcode fl">
                    <a href="/article/category/{{$category->slug}}" target="_blank">
                        <img src="{{$category->logo}}" alt="" style="width: 366px;height: 155px">
                        <p> {{$category->content}}</p>
                    </a>
                </div>
                <div class="news-list fl">
                    <div class="news-list-title">{{$category->name}}怎么赚钱</div>
                    <ul>
                        @foreach(\App\Article::select('title','slug')->where('article_category_id',$category->id)->take(12)->get() as $article)
                            <li><a target="_blank" href="/article/{{$article->slug}}">{{$article->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="invite-code fl">
                    <p>花生日记</p>
                    <p>邀请码</p>
                    <p><b>2RMMEQ5</b></p>
                    <p>(长按复制注册)</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="peanut-links">
        <div class="in-links fl">
            <div class="peanut-links-title">站内链接</div>
            <ul>
                <li>演示文章-web主题公园的虚拟主机的优势</li>
                <li>演示文章-进入可视化编辑时代</li>
                <li>演示文章-网站模板新阶段</li>
                <li>演示文章-WordPress多重筛选功能介绍</li>
                <li>演示文章-web主题公园的虚拟主机的优势</li>
                <li>演示文章-进入可视化编辑时代</li>
            </ul>
        </div>
        <div class="about-us fl">
            <div class="peanut-links-title">关于我们</div>
            <ul>
                <li>演示文章-web主题公园的虚拟主机的优势</li>
                <li>演示文章-进入可视化编辑时代</li>
                <li>演示文章-网站模板新阶段</li>
                <li>演示文章-WordPress多重筛选功能介绍</li>
                <li>演示文章-web主题公园的虚拟主机的优势</li>
                <li>演示文章-进入可视化编辑时代</li>
            </ul>
        </div>
        <div class="contact fl">
            <div class="peanut-links-title">联系我们</div>
            <div>
                <img src="resource/imgs/qrcode-icon.png" class="fl" alt="">
                <div class="fl">
                    <p class="text-center">建议你添加KKKK朋友微信号：</p>
                    <p class="text-center red">wbiao01</p>
                    <p class="text-center">(长按复制加微信，添加好友)</p>
                </div>
            </div>
        </div>
    </div>
@endsection