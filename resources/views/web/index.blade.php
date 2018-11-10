@extends('web.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/peanut.css') }}">
@endsection

@section('js')

@endsection

@section('content')
    <div class="peanut-introduce">
        <h2 class="section-title">
            <strong>花生日记</strong>
            -网购达人的省钱神器，创业者的理想平台
        </h2>
        <ul class="section-content">
            <li>
                <h5>花生日记APP介绍</h5>
                <p>花生日记主要功能为：查找优惠少花钱，消费收益、邀请注册多生钱等。APP内栏目主要有9.9包邮，品牌闪购，新人免单福利，花生小店，每日爆款，拼团，信用卡，花粉社区，限时抢购等。</p>
            </li>
            <li>
                <h5>花生日记的优势</h5>
                <p>花生日记提供海量网购优惠券，优选商品，创新模式，互利共赢。零投资！零囤货！低门槛！粉丝裂变不伤人脉，长久受益！让大家购物省钱、同时帮助更多的人轻松创业，自由生活。</p>
            </li>
            <li>
                <h5>花生日记的未来</h5>
                <p>花生日记以线上几千万用户为支持，打造社交新零售生态系统，让线上店铺，实体店商家、消费者一起实现多方共赢，为大家创造价值，欢迎各方有志之士加入花生日记！共创美好的明天！</p>
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