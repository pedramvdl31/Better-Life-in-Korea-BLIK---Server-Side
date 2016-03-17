<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Kora</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://vjs.zencdn.net/5.0.0/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/github.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.css">

    <link href="/packages/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="/packages/bootstrap-social/assets/css/docs.css" rel="stylesheet">

    <link href="/assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="/assets/css/animate.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">

    <link href="/assets/css/general.css" rel="stylesheet">
    <link rel="stylesheet" href="/packages/embed/dist/embed.min.css" />
    <link rel="stylesheet" href="/packages/dropzone/dropzone.css" />
    <!-- AUTOCOMPLETE -->
    <link rel="stylesheet" href="/packages/easy_autocomplete/easy-autocomplete.css" />

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       

    <link rel="apple-touch-icon-precomposed" href="/assets/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<style type="text/css">
    .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
    outline: none;
    }
    .pr-img img{
        width: 100%;
    }
    .links{
        cursor: pointer;
    }
</style>
<body>

    <header id="header"><!--header-->
    <!-- -------- NAVBAR ----------- -->

        <nav class="navbar navbar-default my-nav">
          <div class="container-fluid">
            <span style="
                position: absolute;
                right: 71px;
                top: 15px;
                font-weight: 900;
                color: #757575
                ">Menu</span>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><span style="color: #759CD8;">K</span>ora</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <div class="navbar-form navbar-left my-navbar-left" role="search">
                <div class="form-group">
                  <input id="searchbar" type="text" class="form-control" placeholder="Search for ads">
                </div>
                <a id="search-for-ad" class="btn btn-default">Search</a>
                <div class="text-center search-loading hide" style="line-height: 34px;
                    float: right;
                    margin-left: 10px;">
                        <img src="/assets/images/icons/gif/loading1.gif" width="20px;">
                </div>
              </div>
              <ul class="nav navbar-nav navbar-right my-navbar-right">
                <li><a href="{!!route('users_dash')!!}"><i class="fa fa-level-up"></i> Profile</a></li>
                    @if(Auth::check())
                    <li><a id="view_wl" class="pointer"><i class="fa fa-folder-o"></i> Wishlist</a></li>
                    <li><a href="{!!route('users_logout')!!}"><i class="fa fa-lock"></i> Logout</a></li>
                    @else
                    <li><a class="login-btn pointer"><i class="fa fa-lock"></i> Login</a></li>
                    <li><a class="reg-btn pointer"><i class="fa fa-crosshairs"></i> Register</a></li>
                    @endif
                    <li class="lg-forms"><button style="margin-top: 8px;" href="" class="btn btn-primary qkpost"><i class="glyphicon glyphicon-plus"></i>&nbspQuick Post</button></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>


    <!-- ---------- NAVBAR END ---------- -->
        @include('flash::message')
        <div style="padding: 10px">
            <a class="btn btn-primary btn-block qkpost sm-forms"><i class="glyphicon glyphicon-plus"></i>&nbspQuick Post</a>   
        </div>

        <input type="hidden" id="_auth" data={!!Auth::check()?1:0!!}></input>
    </header><!--/header-->
    

    
    <section>
        <div class="container" style="margin-bottom: 30px;">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Real Estate 
                                        </a>
                                    </h4>
                                </div>
                                <div id="sportswear" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a class="links" cat-id="1" subcat-id="1">Agencies 
                                            <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
                                            </a></li>
                                            <li><a class="links" cat-id="1" subcat-id="2">Private 
                                            <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">

                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#res">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Restaurant
                                        </a>
                                    </h4>
                                </div>
                                <div id="res" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a class="links" cat-id="2" subcat-id="1">Asian                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="2" subcat-id="2">Italian                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="2" subcat-id="3">Western                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="2" subcat-id="4">Mexican                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="2" subcat-id="5">Other                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Used Car
                                        </a>
                                    </h4>
                                </div>
                                <div id="mens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a class="links" cat-id="3" subcat-id="1">Dealership                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="3" subcat-id="2">Private                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="3" subcat-id="3">Sofa Document Fee                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a  data-toggle="collapse" data-parent="#accordian" href="#womens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Move In/Out
                                        </a>
                                    </h4>
                                </div>
                                <div id="womens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a class="links" cat-id="4" subcat-id="1">Cleaning                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="4" subcat-id="2">Services                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="4" subcat-id="3">Moving Company                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                            <li><a class="links" cat-id="4" subcat-id="4">Cellphone                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="links pointer" cat-id="5" subcat-id="0">Flea Market                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="links pointer" cat-id="6" subcat-id="0">Events                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="links pointer" cat-id="7" subcat-id="0">Fun                                             <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
</a></h4>
                                </div>
                            </div>

                        </div><!--/category-products-->
                    </div>
                </div>
                
                <div class="col-sm-9 ads-warps">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>K</span>ora</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="/assets/images/home/iframe1.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="/assets/images/home/iframe2.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="/assets/images/home/iframe3.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="/assets/images/home/iframe4.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2016 Webprinciples.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.Webprinciples.com">Webprinciples</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->


<!-- ------------------------------------------- -->
<!-- ----------------------------------- -->

<style type="text/css">
    .chrome .dock_wrapper {
        transform: translateZ(0);
    }
    .dockWrapperRight,.dockWrapperRightChilds {
        left: auto;
    }
    .dock-min {
        bottom: 4px;
        direction: ltr;
        height: 28px;
        left: 0;
        position: fixed;
        right: 0;
        z-index: 300;
    }
    .dock-max {
        bottom: 295px;
        direction: ltr;
        height: 28px;
        left: 0;
        position: fixed;
        right: 0;
        z-index: 300;
    }
    .dock-max-1 {
        bottom: 280px;
        direction: ltr;
        height: 28px;
        left: 0;
        position: fixed;
        right: 285px;
        z-index: 300;
    }
    .dock-max-2 {
        bottom: 280px;
        direction: ltr;
        height: 28px;
        left: 0;
        position: fixed;
        right: 570px;
        z-index: 300;
    }

    ._dock {
        margin: 0 15px 0 0;
    }

    .m_clearfix {
        zoom: 1;
    }
    .m_clearfix:after {
        clear: both;
        content: ".";
        display: block;
        font-size: 0;
        height: 0;
        line-height: 0;
        visibility: hidden;
    }
    ._dock .rNubContainer {
        float: right;
    }


    .nubContainer>div, ._dock {
        float: right;
        position: relative;
    }
    .rNubContainer ._50-v {
        margin-left: 12px;
    }

    ._4mq3.wpNub, ._4mq3.wpNub.openToggler {
        margin-left: 12px;
        margin-right: 1px;
    }
    ._50-v, .wpNubGroup, .wpDock .nubContainer>div, .wpDock .wpNubGroup>div {
        float: left;
        position: relative;
    }
    ._4mq3 {
        height: 25px;
        min-width: 201px;
        width: 276px;
    }
    ._4mq3 .wpNubButton {
        background-color: #f6f7f8;
        border: 1px solid rgba(29, 49, 91, .3);
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        box-shadow: none;
        padding-left: 12px;
        padding-right: 12px;
    }
    ._4mq3 .wpNubButton-max {
        background-color: #f6f7f8;
        border: 1px solid rgba(29, 49, 91, .3);
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        box-shadow: none;
        padding-left: 0;
        padding-right: 0;
        padding-top: 2px;
    }
    .wpNubButton, .wpNubButton:hover,.wpNubButton-max, ._50-v.openToggler .wpNubButton, .wpNubFlyout, .wpNubFlyout .flyoutInner, .wpNubFlyoutTitlebar, .wpNubFlyoutHeader, .wpNubFlyoutBody, .wpNubFlyoutFooter {
        background-clip: padding-box;
    }
    .wpNubButton {
        border: 1px solid rgba(29, 49, 91, .3);
        border-width: 1px 0 0;
        color: #333;
        display: block;
        font-weight: bold;
        height: 69px;
        outline: none;
        padding: 6px 4px 5px;
        position: relative;
        z-index: 1;
    }
    .wpNubButton-max {
        border: 1px solid rgba(29, 49, 91, .3);
        border-width: 1px 0 0;
        color: #333;
        display: block;
        font-weight: bold;
        min-height: 311px;
        height: 311px;
        outline: none;
        padding: 6px 4px 5px;
        position: relative;
        z-index: 1;
    }
    .wpNubButton-max-main {
        border: 1px solid rgba(29, 49, 91, .3);
        border-width: 1px 0 0;
        color: #333;
        display: block;
        font-weight: bold;
        min-height: 311px;
        height: 325px;
        outline: none;
        padding: 6px 4px 5px;
        position: relative;
        z-index: 1;
    }
    .wpNubButton:before, .wpNubButton:after,.wpNubButton-max:before, .wpNubButton-max:after {
        content: '';
        height: 28px;
        position: absolute;
        top: -1px;
        width: 4px;
    }
    ._4mq3 .wpNubButton:before, ._4mq3 .wpNubButton:after,._4mq3 .wpNubButton-max:before, ._4mq3 .wpNubButton-max:after, {
        background-image: none;
    }
    .wpNubButton:after,.wpNubButton-max:after {
        background-repeat: no-repeat;
        background-size: auto;
        background-position: -15px -40px;
        right: -4px;
    }
    .wpNubButton:before, .wpNubButton:after,.wpNubButton-max:before, .wpNubButton-max:after {
        content: '';
        height: 28px;
        position: absolute;
        top: -1px;
        width: 4px;
    }
    ._4mq3 .wpNubButton .label {
        color: black;
        font-size: 14px;
        line-height: 16px;
        margin-right: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    ._4mq3 .wpNubButton-max .label {
        color: black;
        font-size: 14px;
        line-height: 16px;
        margin-right: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .lb-m{
       padding-left: 20px;
       line-height: 35px !important;
    }



    #inner-chat-wrapper{
        height: 100%;
        background-color: #f6f7f8;;
        border-top: 1px solid rgba(29, 49, 91, .3); 
        padding: 5px 10px;
        max-height: 285px;
        overflow-y: scroll;
    }

    .inner-wrapper-child{
        width: 100%
        height: 100%;
        background-color: #f6f7f8;;
        border-top: 1px solid rgba(29, 49, 91, .3); 
        padding: 5px 10px;
        max-height: 257px;
        overflow-y: scroll;
    }

    .conv-wrapper {
        height: 40px;
        margin-bottom: 2px;
    }
    .conv-wrapper img {
        width: 39px;
    }
    .sp_BNtOXyg0vlE {
        background-size: auto;
        background-repeat: no-repeat;
        display: inline-block;
        height: 12px;
        width: 16px;
    }
    ._4mq3 .wpNubButton ._4xia {
        float: left;
        height: 12px;
        margin: 2px 4px 0 0;
        width: 12px;
    }
    .sp_BNtOXyg0vlE.sx_78fc23 {
        width: 12px;
        background-position: -75px -471px;
    }
    .conv-c{
        color: white !important;
        float: right;
        margin-top: 5px;
    }
    .ChatClose{
        margin-right: 8px;
    }
    .ChatTextArea{
        background: white;
        border-top: 1px solid #C7C7C7;
    }
    #cta1{
        height: 52px;
    }
    #cta2{
        height: 52px;
    }
    .tooltip {
        position: fixed;
    }




    ._mb {
        position: relative;
        display: inline-block;
        margin: .5em .75em;
        padding: 6px 15px 6px 15px;
        border-radius: 1.5em;
        text-shadow: 0 1px 1px white;
        background-color: #fff;
        border: 1px solid #CDCDCA;
        box-shadow: 0 1px 1px 0 #CDCDCA;
        overflow: hidden;

    }

    ._msnd{
        text-align: right;   
        width: 100%;
    }
    ._mrcv{
        text-align: left;
        width: 100%;
    }
    ._mtxt{
        color: #373e4d;
        text-shadow: rgba(255, 255, 255, .5) 0 1px 0;
        line-height: 1.28;
        font-size: 12px;
        word-break: break-word;
    }
    ._sndb {
        background-color: #e0edff !important;
        border: 1px solid #bcc7d6 !important;
        border-top-right-radius: 0;
    }
    ._rcvb {
        border-top-left-radius: 0;
    }
    ._msgss{
        float: right;
        width: 100%;
    }
    ._mavs{
        float: right;
        width: 15%;
    }
    ._mtwps{
        float: right;
        width: 85%;
    }
    ._msgsr{
        float: left;
        width: 100%;
    }
    ._mavr{
        float: left;
        width: 15%;
    }
    ._mtwpr{
        float: left;
        width: 85%;
    }
    ._mtime{
        color: #9197a3;
        display: inline-block;
        font-size: 10px;
        font-weight: bold;
        padding: 0 5px;
    }

    .sp_P9ChxUVwaFx {
        background-image: url("/assets/images/icons/on.png");
        background-size: auto;
        background-repeat: no-repeat;
        display: inline-block;
        height: 12px;
        width: 12px;
    }
    .sp_P9ChxUVwaFx.sx_74fd99 {
        background-position: -300px -5px;
    }
    ._cbnm{
        float: left;
        padding-left: 10px;
    }
</style>

@if(Auth::check())
 <input type="hidden" id="ufh" value="{{Auth::user()->id}}"></input>
@endif
<div class="chat_dock hide">
    <div class="dock_wrapper dock-min dockWrapperRight" type="0">
        <div class="_dock m_clearfix">
            <div class="m_clearfix nubContainer rNubContainer">
                <div id="BuddylistPagelet">
                    <div class="_56ox ">
                        <div class="uiToggle _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                            <div class="wpNubButton">
                                <span class="label nb-lb pointer">Chat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dock_wrapper dock-max dockWrapperRight hide" type="1">
        <div class="_dock m_clearfix">
            <div class="m_clearfix nubContainer rNubContainer">
                <div id="BuddylistPagelet">
                    <div class="_56ox ">
                        <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                            <div class="wpNubButton-max wpNubButton-max-main">
                                <span class="label nb-lb lb-m pointer ">Chat</span>
                                <div id="inner-chat-wrapper">
                                    {!!$friends_list!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="chat_dockChilds">
    <div class="dockChild dc1 dock_wrapperChilds dock-max-1 dockWrapperRightChilds hide" type="1">
        <div class="_dock m_clearfix">
            <div class="m_clearfix nubContainer rNubContainer">
                <div id="BuddylistPagelet">
                    <div class="_56ox ">
                        <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                            <div class="wpNubButton-max">
                                <span class="label nb-lb lb-m pointer ">
                                    <span class="_cbnm">Pedram</span> 
                                    <span class="cc1 ChatClose pull-right"><i class="fa fa-times"></i></span>
                                </span>
                                <div class="inner-wrapper-child _ctb1">

                                    <div class="_msnd _msgss"> 
                                        <div class="_mavs">
                                            <img src="/assets/images/profile-images/perm/blank_male.png" width="35px">
                                        </div>  
                                        <div class="_mtwps">
                                            <div class="_mb _sndb">
                                             <span class="_mtxt tstbox">
                                                <span class="_plin">
                                                    :smile:
                                                    Default
                                                </span>
                                                <div class="_mtime" style="width: 100%">
                                                    <small>1 hour ago</small>
                                                </div>
                                             </span>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="inputBar">

                                    <textarea class="ChatTextArea" id="cta1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dockChild dc2 dock_wrapperChilds dock-max-2 dockWrapperRightChilds hide" type="1">
        <div class="_dock m_clearfix">
            <div class="m_clearfix nubContainer rNubContainer">
                <div id="BuddylistPagelet">
                    <div class="_56ox ">
                        <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                            <div class="wpNubButton-max">
                                <span class="label nb-lb lb-m pointer ">Chat <span class="cc2 ChatClose pull-right"><i class="fa fa-times"></i></span></span>
                                <div class="_ctb2 inner-wrapper-child">

                                </div>
                                <div class="inputBar">
                                    <textarea class="ChatTextArea" id="cta2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--     @if(Auth::check())
        <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
        <script>
            //var socket = io('http://localhost:3000');
            var socket = io('http://192.168.10.10:3000');
            socket.emit("_init", { data: "{!!Auth::id()!!}" });
            // var socket = io.connect('http://192.168.10.10:3000');
            socket.on('_forward', function(data) {
                alert(data['msg']);
            });
            socket.on('on_not', function(data) {
                $('.on-sign-'+data['data']).removeClass('hide');
            });
            $('#sendm').click(function(){
                socket.emit("trans", { 
                    recip: 2,
                    msg: "hello man!"
                     });
            });
        </script>
    @endif -->


    <!-- --------------------------------------------- -->
    <!-- -------------------------------------------- -->
    {!! View::make('partials.login_modal') !!}    
    {!! View::make('partials.postview_modal') !!}    
    {!! View::make('partials.register_modal') !!}    
    {!! View::make('partials.success_modal') !!}
    {!! View::make('partials.warning_modal') !!}      
    @if(Auth::check())
        {!! View::make('partials.qkpost_modal')
        ->with('cats',$cats)
        ->with('cities',$cities)
        ->__toString()!!}   
        {!! View::make('partials.wishlist_modal')
        ->with('wishlist',$wishlist)
        ->__toString() !!}
    @endif
  
    <!-- Load js libs only when the page is loaded. -->

    <script src="/packages/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- <script src="/assets/js/jquery.scrollUp.min.js"></script> -->
    <script src="/assets/js/jquery.prettyPhoto.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/chat.js"></script>
    <script src="/assets/js/layouts/main.js"></script>
    <script src="/packages/scroll_style/jquery.slimscroll.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
    <script src="//platform.twitter.com/widgets.js"></script>
    <script src="http://vjs.zencdn.net/5.0.0/video.js"></script>
    <script src="https://cdn.jsdelivr.net/prism/1.4.1/prism.js"></script>
    <script src="/packages/embed/src/embed.js"></script>
    <script src="/packages/dropzone/dropzone.js"></script>
    <script src="/packages/easy_autocomplete/jquery.easy-autocomplete.js"></script>


    
</body>
</html>