<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/2
 * Time: 下午10:27
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>加油邯郸 - 后台管理系统</title>
    {!! Html::style('assets/css/fonts/linecons/css/linecons.css') !!}
    {!! Html::style('assets/css/fonts/fontawesome/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('assets/css/xenon-core.css') !!}
    {!! Html::style('assets/css/xenon-forms.css') !!}
    {!! Html::style('assets/css/xenon-components.css') !!}
    {!! Html::style('assets/css/xenon-skins.css') !!}
    {!! Html::style('assets/css/custom.css') !!}

    {!! Html::script('assets/js/jquery-1.11.1.min.js') !!}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</head>
<body class="page-body skin-facebook">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
    <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
    <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
    <div class="sidebar-menu toggle-others fixed">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="{{ route('dashboard.home') }}" class="logo-expanded">
                        {!! Html::image('assets/images/station/user.png', null, ['width'=> 40]) !!}
                    </a>

                    <a href="{{ route('dashboard.home') }}" class="logo-collapsed">
                        {!! Html::image('assets/images/station/user.png', null, ['width'=> 40]) !!}
                    </a>
                </div>

                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                <div class="mobile-menu-toggle visible-xs">
                    <a href="#" data-toggle="user-info-menu">
                        <i class="fa-bell-o"></i>
                        <span class="badge badge-success">7</span>
                    </a>

                    <a href="#" data-toggle="mobile-menu">
                        <i class="fa-bars"></i>
                    </a>
                </div>

            </header>



            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li class="active opened active">
                    <a href="javascript:;">
                        <i class="linecons-cog"></i>
                        <span class="title">系统设置</span>
                    </a>
                    <ul>
                        <li class="active">
                            <a href="{{ route('dashboard.home') }}">
                                <span class="title">首页</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="linecons-desktop"></i>
                        <span class="title">平台运营</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('gasStations.index') }}">
                                <span class="title">加油站管理</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('series.index') }}">
                                <span class="title">油号管理</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>

    </div>

    <div class="main-content">

        <!-- User Info, Notifications and Menu Bar -->
        <nav class="navbar user-info-navbar" role="navigation">

            <!-- Left links for user info navbar -->
            <ul class="user-info-menu left-links list-inline list-unstyled">

                <li class="hidden-sm hidden-xs">
                    <a href="#" data-toggle="sidebar">
                        <i class="fa-bars"></i>
                    </a>
                </li>

            </ul>


            <!-- Right links for user info navbar -->
            <ul class="user-info-menu right-links list-inline list-unstyled">

                <li class="dropdown user-profile">
                    <a href="#" data-toggle="dropdown">
                        {!! Html::image('assets/images/station/user.png', 'user-image', ['class'=> 'img-circle img-inline userpic-32','width'=> 28]) !!}
                        <span>
                            {{ $user->name }}
                            <i class="fa-angle-down"></i>
                        </span>
                    </a>

                    <ul class="dropdown-menu user-profile-menu list-unstyled">
                        <li class="last">
                            <a href="javascript:;" data-url="{{ route('logout') }}" class="do-logout">
                                <i class="fa-lock"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </nav>

        <div class="page-title">

            @yield('page-nav')

        </div>
        @if(session('message'))
        <div class="row">

            <div class="col-md-12">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>

                    {{ session('message') }}
                </div>
            </div>

        </div>
        @endif
        @yield('main-content')



        <!-- Main Footer -->
        <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
        <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
        <!-- Or class "fixed" to  always fix the footer to the end of page -->
        <footer class="main-footer sticky footer-type-1">

            <div class="footer-inner">

                <!-- Add your copyright text here -->
                <div class="footer-text">
                    &copy; 2018
                    <strong>加油邯郸</strong>
                    theme by <a href="javascript:;" target="_blank">柚子科技</a>
                </div>


                <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                <div class="go-up">

                    <a href="#" rel="go-top">
                        <i class="fa-angle-up"></i>
                    </a>

                </div>

            </div>

        </footer>
    </div>

</div>
@yield('others')
@stack('styles')
<!-- Bottom Scripts -->

{!! Html::script('assets/js/bootstrap.min.js') !!}
{!! Html::script('assets/js/TweenMax.min.js') !!}
{!! Html::script('assets/js/resizeable.js') !!}
{!! Html::script('assets/js/joinable.js') !!}
{!! Html::script('assets/js/xenon-api.js') !!}
{!! Html::script('assets/js/xenon-toggles.js') !!}
{!! Html::script('https://unpkg.com/sweetalert/dist/sweetalert.min.js') !!}
<!-- Imported scripts on this page -->
@stack('scripts')

<!-- JavaScripts initializations and stuff -->
{!! Html::script('assets/js/xenon-custom.js') !!}
<script>
    $('.do-logout').on('click',function(){
        var $this = $(this);
        var url = $this.data('url');
        swal({
            title: "您确定要退出吗?",
            text: "",
            icon: "warning",
            buttons: {
                cancel : "取消",
                confirm: "确定"
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url:url,
                    type:"POST",
                    data:{},
                    success:function(data){
                        swal("退出成功!", {
                            icon: "success"
                        });
                        location.href='{{ route('dashboard.home') }}';
                    },
                    dataType:"json"
                });

            } else {
                swal("已取消!");
            }
        });
    });
</script>
</body>
</html>
