<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>花生日记</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/Ionicons/css/ionicons.min.css">
    @yield('css')
    <link rel="stylesheet" href="/vendor/adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.MA = @json(['csrfToken' => csrf_token() ]);
    </script>
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-mini"><b>H</b>S</span>
            <span class="logo-lg"><b>花生日记</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('admin.logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/vendor/adminlte/img/user-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->mobile }} (ID:{{ Auth()->id() }})</p>
                    <a href="#"><span><i class="fa fa-user-circle-o"></i> 我的</span></a>
                    &nbsp;&nbsp;
                    <a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> <span>退出</span></a>
                </div>
            </div>
            <ul class="sidebar-menu MA_menu" data-widget="tree">

                <li>
                    <a href="{{ route('admin.user.index') }}"
                       data-tab='@json(['name' => 'menu_user', 'text' => '用户'])'><i
                                class="fa fa-users"></i>
                        用户</a>
                </li>
                <li>
                    <a href="/set/1/edit"
                       data-tab='@json(['name' => 'menu_set', 'text' => '设置'])'><i
                                class="fa fa-toggle-on"></i>
                        <span>设置</span></a>
                </li>

                <li>
                    <a href="{{ route('admin.article.index') }}"
                       data-tab='@json(['name' => 'menu_article', 'text' => '资讯'])'><i
                                class="fa fa-newspaper-o"></i>
                        <span>资讯</span></a>
                </li>
                <li>
                    <a href="{{ route('admin.article-category.index') }}"
                       data-tab='@json(['name' => 'menu_article-category', 'text' => '资讯分类'])'><i
                                class="fa fa-tags"></i>
                        <span>资讯分类</span></a>
                </li>
                <li>
                    <a href="{{ route('admin.link.index') }}"
                       data-tab='@json(['name' => 'menu_link', 'text' => '友情链接'])'><i
                                class="fa fa-ban"></i>
                        友情链接</a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <div class="MA_tabs">
            <div class="nav-tabs-custom tab-success">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#welcome" data-toggle="tab">
                            <span>欢迎</span>
                            <button><i class="fa fa-close"></i></button>
                        </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="welcome">
                        <div style="padding: 20px;">
                            <h3>Mion Admin</h3>
                            <p>Welcome Page</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2009-{{ date('Y') }} <a href="http://www.jizhiba.com" target="_blank">花生</a>.</strong>
        All rights reserved.
    </footer>
</div>
<script src="/vendor/adminlte/plugins/jquery/dist/jquery.min.js"></script>
<script src="/vendor/adminlte/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendor/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/vendor/adminlte/plugins/fastclick/lib/fastclick.js"></script>
@yield('js')
<script src="/vendor/adminlte/js/adminlte.min.js"></script>
<script src="/js/admin.js"></script>
@yield('script')
{!! \Krucas\Notification\Facades\Notification::showAll() !!}
</body>
</html>