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


<div id="locations" data-locations='[{"name":"Bath","url":"/location/bath","img":"/thumb.jpg"},{"name":"Berkhamsted","url":"/location/berkhamsted","img":"/thumb.jpg"}]'>

    
    <header id="header"><!--header-->
    <!-- -------- NAVBAR ----------- -->
    <style type="text/css">
    #nav.affix {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9999;
    }
    </style>
    <nav class="navbar navbar-default my-nav" data-spy="affix" id="nav" style="margin-bottom: 0">
    <div class="container-fluid">
    <!--             <span style="
    position: absolute;
    right: 71px;
    top: 15px;
    font-weight: 900;
    color: white
    ">Menu</span> -->
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Kora</a>
    <br>
    <div id="tab-holder" class="text-center col-md-12 col-xs-12" style="padding: 0">
      <div class="pointer col-md-6 col-xs-6 tab-c tab-home" style="padding: 0;border-bottom:1px solid white">Home</div>
      <div class="pointer col-md-6 col-xs-6 tab-c tab-cat" style="padding: 0;">Category</div>
    </div>
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
        <li class="lg-forms"><button style="margin-top: 8px;" href="" class="btn btn-primary qkpost"><i class="glyphicon glyphicon-plus"></i>&nbsp글</button></li>
    </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>


    <!-- ---------- NAVBAR END ---------- -->
    <div>
        <a style="margin-bottom: 0;" class="btn btn-primary btn-block qkpost sm-forms qkpost-btn-sm"><i class="glyphicon glyphicon-plus">     
        </i>&nbspQuick Post</a>   
    </div>
    <div class="text-center" id="city-search" style="">
        <select class="form-control my-form-control" name="city" id="city-select-home">
            {!!$cities!!}
        </select>
    </div>

    <input type="hidden" id="_auth" data={!!Auth::check()?1:0!!}></input>
    </header><!--/header-->
    <div class="flash-notification">
    @include('flash::message')
    </div>

    <section>
    <div class="container main-container" style="margin-bottom: 30px;">

    <style type="text/css">

    </style>
    <!-- <div class="mmcontainer"></div> -->

    <div class="row">
    <!--                 <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Category</h2>
            <div class="panel-group category-products" id="accordian">
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
                                <li><a class="links" cat-id="2" subcat-id="2">Italian
                                <img class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
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

            </div>
            <div class="text-center" id="city-search" style="">
                <h2>Search by City</h2>
                <select class="form-control" name="city" id="city-select-home">
                    {!!$cities!!}
                </select>
                <img id="img-city" class="hide" src="/assets/images/icons/gif/loading1.gif" width="10px;">
                
            </div>
            
        </div>
    </div> -->

    <div class="col-sm-12 ads-warps home-tab all-tabs">
        <div class="text-center post-loading" style="margin-top: 15px;">
        
        </div>

        <div id="post-list">
            @yield('content')
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-xs-12 ads-warps cat-tab all-tabs hide">
        {!!$all_categories!!}
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

        </div>
    </div>
    </div>
    </div>
    <div class="footer-bottom clearfix">
        <div class="col-md-12">
            <p class="pull-left">Copyright © 2016 Kora.</p>
            <p class="pull-right">Designed by <span><a target="_blank" href="http://www.Webprinciples.com">Webprinciples</a></span></p>
        </div>
    </div>

    </footer><!--/Footer-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


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
        .ChatTextArea{
            white-space: pre-wrap;       /* css-3 */
            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
            width: 86%;
            background: white;
            height: 36px;
            text-align: left;
            border-top: 1px solid #C7C7C7;
            float: left;
            padding: 3px;
        }


        .chatemoji{
            width: 14%;
            float: right;
            height: 52px;
            background: white;
            border-top: 1px solid #C7C7C7;
            text-align: center;
        }
        .emoi{ 
            cursor: pointer;
            color: gray;
            font-size: 29px;
            padding-top: 11px;
        }
        .emoji-list{
            position: absolute;
            top: 0;
            height: 83%;
            overflow: auto; 
        }
        .emoji-list>pre>code>.emoticon{
            cursor: pointer;
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
        float: right;
        margin-top: 5px;
        font-size: 19px;
        color: #337AB7 !important;
        }
        .have-msg{
        float: right;
        color: #337AB7 !important;
        }
        .ChatClose{
        margin-right: 8px;
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
        /*MESSAGES SEND*/
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
        /*MESSAGES RECVED*/
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
        /*==========  Non-Mobile First Method  ==========*/

        /* Large Devices, Wide Screens */
        @media only screen and (max-width : 1200px) {

        }

        /* Medium Devices, Desktops */
        @media only screen and (max-width : 992px) {

        }

        /* CUS */
        @media only screen and (max-width : 870px) {
            .dock-max-2 {
                bottom: 319px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 285px;
                opacity: 0.5;
                z-index: 299;
            }
        }

        /* Small Devices, Tablets */
        @media only screen and (max-width : 768px) {

        }

        /* Extra Small Devices, Phones */ 
        @media only screen and (max-width : 586px) {
            .dock-max-1 {
                bottom: 280px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 0;
                z-index: 300;
            }
            .dock-max-2 {
                bottom: 319px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 0;
                opacity: 0.9;
                z-index: 299;
            }
            .dock-max {
                bottom: 358px;
                direction: ltr;
                height: 28px;
                left: 0;
                position: fixed;
                right: 0;
                z-index: 298;
                opacity: 0.5;
            }
            ._dock {
                margin: 0;
            }
            ._4mq3.wpNub, ._4mq3.wpNub.openToggler {
                margin-left: 0;
                margin-right: 0;
            }
            ._4mq3 {
                width: 100%;
            }
            .nubContainer>div, ._dock {
                width: 100%;
            }
            ._dock .rNubContainer {
                width: 100%;
            }
            .wpNubButton-max-main {
                height: 386px;
            }
            ._4mq3 .wpNubButton-max {
                border-left: none;
                border-radius: 0;
                border-right: none;
            }
        }

        /* Extra Small Devices, Phones */ 
        @media only screen and (max-width : 480px) {

        }

        /* Custom, iPhone Retina */ 
        @media only screen and (max-width : 320px) {
            
        }
    </style>

    @if(Auth::check())
    <input type="hidden" id="crnt_dt" value="{!!$cdt!!}"></input>
    <input type="hidden" id="ufh" value="{{Auth::user()->id}}"></input>
    <div id="msgs_tmp"></div>
    <div class="chat_dock">
        <div class="dock_wrapper dock-min dockWrapperRight main-list-dock" type="0">
            <div class="_dock m_clearfix">
                <div class="m_clearfix nubContainer rNubContainer">
                    <div id="BuddylistPagelet">
                        <div class="_56ox ">
                            <div class="uiToggle _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                <div class="wpNubButton">
                                    <span class="label nb-lb pointer">Chat</span>
                                    <span class="have-msg nb-lb pointer hide"><i class="fa fa-envelope-o"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dock_wrapper dock-max dockWrapperRight hide dtabs" type="1">
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
        <div class="dockChild dc1 dock_wrapperChilds dock-max-1 dockWrapperRightChilds hide dtabs" dock-no="1" type="1" uid="">
            <div class="_dock m_clearfix">
                <div class="m_clearfix nubContainer rNubContainer">
                    <div id="BuddylistPagelet">
                        <div class="_56ox ">
                            <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                <div class="wpNubButton-max">
                                    <span class="label nb-lb lb-m pointer ">
                                        <span class="_cbnm _cbnm1"></span> 
                                        <span class="cc1 ChatClose pull-right"><i class="fa fa-times"></i></span>
                                    </span>
                                    <div class="sc-wrapper sc-wrapper-1"></div>
                                    <div class="inputBar">
                                        <div id="emoji-list-1" class="emoji-list hide ">
                                            :bowtie: :smile: :laughing: :blush: :smiley: :relaxed: :smirk: :heart_eyes: :kissing_heart: :kissing_closed_eyes: :flushed: :relieved: :satisfied: :grin: :wink: :stuck_out_tongue_winking_eye: :stuck_out_tongue_closed_eyes: :grinning: :kissing: :winky_face: :kissing_smiling_eyes: :stuck_out_tongue: :sleeping: :worried: :frowning: :anguished: :open_mouth: :grimacing: :confused: :hushed: :expressionless: :unamused: :sweat_smile: :sweat: :wow: :disappointed_relieved: :weary: :pensive: :disappointed: :confounded: :fearful: :cold_sweat: :persevere: :cry: :sob: :joy: :astonished: :scream: :neckbeard: :tired_face: :angry: :rage: :triumph: :sleepy: :yum: :mask: :sunglasses: :dizzy_face: :imp: :smiling_imp: :neutral_face: :no_mouth: :innocent: :alien: :yellow_heart: :blue_heart: :purple_heart: :heart: :green_heart: :broken_heart: :heartbeat: :heartpulse: :two_hearts: :revolving_hearts: :cupid: :sparkling_heart: :sparkles: :star: :star2: :dizzy: :boom: :collision: :anger: :exclamation: :question: :grey_exclamation: :grey_question: :zzz: :dash: :sweat_drops: :notes: :musical_note: :fire: :hankey: :poop: :shit: :+1: :thumbsup: :-1: :thumbsdown: :ok_hand: :punch: :facepunch: :fist: :v: :wave: :hand: :raised_hand: :open_hands: :point_up: :point_down: :point_left: :point_right: :raised_hands: :pray: :point_up_2: :clap: :muscle: :metal: :fu: :walking: :runner: :running: :couple: :family: :two_men_holding_hands: :two_women_holding_hands: :dancer: :dancers: :ok_woman: :no_good: :information_desk_person: :raising_hand: :bride_with_veil: :person_with_pouting_face: :person_frowning: :bow: :couplekiss: :couple_with_heart: :massage: :haircut: :nail_care: :boy: :girl: :woman: :man: :baby: :older_woman: :older_man: :person_with_blond_hair: :man_with_gua_pi_mao: :man_with_turban: :construction_worker: :cop: :angel: :princess: :smiley_cat: :smile_cat: :heart_eyes_cat: :kissing_cat: :smirk_cat: :scream_cat: :crying_cat_face: :joy_cat: :pouting_cat: :japanese_ogre: :japanese_goblin: :see_no_evil: :hear_no_evil: :speak_no_evil: :guardsman: :skull: :feet: :lips: :kiss: :droplet: :ear: :eyes: :nose: :tongue: :love_letter: :bust_in_silhouette: :busts_in_silhouette: :speech_balloon: :thought_balloon: :feelsgood: :finnadie: :goberserk: :godmode: :hurtrealbad: :rage1: :rage2: :rage3: :rage4: :suspect: :trollface: :sunny: :umbrella: :cloud: :snowflake: :snowman: :zap: :cyclone: :foggy: :ocean: :cat: :dog: :mouse: :hamster: :rabbit: :wolf: :frog: :tiger: :koala: :bear: :pig: :pig_nose: :cow: :boar: :monkey_face: :monkey: :horse: :racehorse: :camel: :sheep: :elephant: :panda_face: :snake: :bird: :baby_chick: :hatched_chick: :hatching_chick: :chicken: :penguin: :turtle: :bug: :honeybee: :ant: :beetle: :snail: :octopus: :tropical_fish: :fish: :whale: :whale2: :dolphin: :cow2: :ram: :rat: :water_buffalo: :tiger2: :rabbit2: :dragon: :goat: :rooster: :dog2: :pig2: :mouse2: :ox: :dragon_face: :blowfish: :crocodile: :dromedary_camel: :leopard: :cat2: :poodle: :paw_prints: :bouquet: :cherry_blossom: :tulip: :four_leaf_clover: :rose: :sunflower: :hibiscus: :maple_leaf: :leaves: :fallen_leaf: :herb: :mushroom: :cactus: :palm_tree: :evergreen_tree: :deciduous_tree: :chestnut: :seedling: :blossom: :ear_of_rice: :shell: :globe_with_meridians: :sun_with_face: :full_moon_with_face: :new_moon_with_face: :new_moon: :waxing_crescent_moon: :first_quarter_moon: :waxing_gibbous_moon: :full_moon: :waning_gibbous_moon: :last_quarter_moon: :waning_crescent_moon: :last_quarter_moon_with_face: :first_quarter_moon_with_face: :moon: :earth_africa: :earth_americas: :earth_asia: :volcano: :milky_way: :partly_sunny: :octocat: :squirrel: :bamboo: :gift_heart: :dolls: :school_satchel: :mortar_board: :flags: :fireworks: :sparkler: :wind_chime: :rice_scene: :jack_o_lantern: :ghost: :santa: :christmas_tree: :gift: :bell: :no_bell: :tanabata_tree: :tada: :confetti_ball: :balloon: :crystal_ball: :cd: :dvd: :floppy_disk: :camera: :video_camera: :movie_camera: :computer: :tv: :iphone: :phone: :telephone: :telephone_receiver: :pager: :fax: :minidisc: :vhs: :sound: :speaker: :mute: :loudspeaker: :mega: :hourglass: :hourglass_flowing_sand: :alarm_clock: :watch: :radio: :satellite: :loop: :mag: :mag_right: :unlock: :lock: :lock_with_ink_pen: :closed_lock_with_key: :key: :bulb: :flashlight: :high_brightness: :low_brightness: :electric_plug: :battery: :calling: :email: :mailbox: :postbox: :bath: :bathtub: :shower: :toilet: :wrench: :nut_and_bolt: :hammer: :seat: :moneybag: :yen: :dollar: :pound: :euro: :credit_card: :money_with_wings: :e-mail: :inbox_tray: :outbox_tray: :envelope: :incoming_envelope: :postal_horn: :mailbox_closed: :mailbox_with_mail: :mailbox_with_no_mail: :door: :smoking: :bomb: :gun: :hocho: :pill: :syringe: :page_facing_up: :page_with_curl: :bookmark_tabs: :bar_chart: :chart_with_upwards_trend: :chart_with_downwards_trend: :scroll: :clipboard: :calendar: :date: :card_index: :file_folder: :open_file_folder: :scissors: :pushpin: :paperclip: :black_nib: :pencil2: :straight_ruler: :triangular_ruler: :closed_book: :green_book: :blue_book: :orange_book: :notebook: :notebook_with_decorative_cover: :ledger: :books: :bookmark: :name_badge: :microscope: :telescope: :newspaper: :football: :basketball: :soccer: :baseball: :tennis: :8ball: :rugby_football: :bowling: :golf: :mountain_bicyclist: :bicyclist: :horse_racing: :snowboarder: :swimmer: :surfer: :ski: :spades: :hearts: :clubs: :diamonds: :gem: :ring: :trophy: :musical_score: :musical_keyboard: :violin: :space_invader: :video_game: :black_joker: :flower_playing_cards: :game_die: :dart: :mahjong: :clapper: :memo: :pencil: :book: :art: :microphone: :headphones: :trumpet: :saxophone: :guitar: :shoe: :sandal: :high_heel: :lipstick: :boot: :shirt: :tshirt: :necktie: :womans_clothes: :dress: :running_shirt_with_sash: :jeans: :kimono: :bikini: :ribbon: :tophat: :crown: :womans_hat: :mans_shoe: :closed_umbrella: :briefcase: :handbag: :pouch: :purse: :eyeglasses: :fishing_pole_and_fish: :coffee: :tea: :sake: :baby_bottle: :beer: :beers: :cocktail: :tropical_drink: :wine_glass: :fork_and_knife: :pizza: :hamburger: :fries: :poultry_leg: :meat_on_bone: :spaghetti: :curry: :fried_shrimp: :bento: :sushi: :fish_cake: :rice_ball: :rice_cracker: :rice: :ramen: :stew: :oden: :dango: :egg: :bread: :doughnut: :custard: :icecream: :ice_cream: :shaved_ice: :birthday: :cake: :cookie: :chocolate_bar: :candy: :lollipop: :honey_pot: :apple: :green_apple: :tangerine: :lemon: :cherries: :grapes: :watermelon: :strawberry: :peach: :melon: :banana: :pear: :pineapple: :sweet_potato: :eggplant: :tomato: :corn: :house: :house_with_garden: :school: :office: :post_office: :hospital: :bank: :convenience_store: :love_hotel: :hotel: :wedding: :church: :department_store: :european_post_office: :city_sunrise: :city_sunset: :japanese_castle: :european_castle: :tent: :factory: :tokyo_tower: :japan: :mount_fuji: :sunrise_over_mountains: :sunrise: :stars: :themoreyouknow: :tmyk: :statue_of_liberty: :bridge_at_night: :carousel_horse: :rainbow: :ferris_wheel: :fountain: :roller_coaster: :ship: :speedboat: :boat: :sailboat: :rowboat: :anchor: :rocket: :airplane: :helicopter: :steam_locomotive: :tram: :mountain_railway: :bike: :aerial_tramway: :suspension_railway: :mountain_cableway: :tractor: :blue_car: :oncoming_automobile: :car: :red_car: :taxi: :oncoming_taxi: :articulated_lorry: :bus: :oncoming_bus: :rotating_light: :police_car: :oncoming_police_car: :fire_engine: :ambulance: :minibus: :truck: :train: :station: :train2: :bullettrain_front: :bullettrain_side: :light_rail: :monorail: :railway_car: :trolleybus: :ticket: :fuelpump: :vertical_traffic_light: :traffic_light: :warning: :construction: :beginner: :atm: :slot_machine: :busstop: :barber: :hotsprings: :checkered_flag: :crossed_flags: :izakaya_lantern: :moyai: :circus_tent: :performing_arts: :round_pushpin: :triangular_flag_on_post: :jp: :kr: :cn: :us: :fr: :es: :it: :ru: :gb: :uk: :de: :one: :two: :three: :four: :five: :six: :seven: :eight: :nine: :keycap_ten: :1234: :zero: :hash: :symbols: :arrow_backward: :arrow_down: :arrow_forward: :arrow_left: :capital_abcd: :abcd: :abc: :arrow_lower_left: :arrow_lower_right: :arrow_right: :arrow_up: :arrow_upper_left: :arrow_upper_right: :arrow_double_down: :arrow_double_up: :arrow_down_small: :arrow_heading_down: :arrow_heading_up: :leftwards_arrow_with_hook: :arrow_right_hook: :left_right_arrow: :arrow_up_down: :arrow_up_small: :arrows_clockwise: :arrows_counterclockwise: :rewind: :fast_forward: :information_source: :ok: :twisted_rightwards_arrows: :repeat: :repeat_one: :new: :top: :up: :cool: :free: :ng: :cinema: :koko: :signal_strength: :u5272: :u5408: :u55b6: :u6307: :u6708: :u6709: :u6e80: :u7121: :u7533: :u7a7a: :u7981: :sa: :restroom: :mens: :womens: :baby_symbol: :no_smoking: :parking: :wheelchair: :metro: :baggage_claim: :accept: :wc: :potable_water: :put_litter_in_its_place: :secret: :congratulations: :m: :passport_control: :left_luggage: :customs: :ideograph_advantage: :cl: :sos: :id: :no_entry_sign: :underage: :no_mobile_phones: :do_not_litter: :non-potable_water: :no_bicycles: :no_pedestrians: :children_crossing: :no_entry: :eight_spoked_asterisk: :eight_pointed_black_star: :heart_decoration: :vs: :vibration_mode: :mobile_phone_off: :chart: :currency_exchange: :aries: :taurus: :gemini: :cancer: :leo: :virgo: :libra: :scorpius: :sagittarius: :capricorn: :aquarius: :pisces: :ophiuchus: :six_pointed_star: :negative_squared_cross_mark: :a: :b: :ab: :o2: :diamond_shape_with_a_dot_inside: :recycle: :end: :on: :soon: :clock1: :clock130: :clock10: :clock1030: :clock11: :clock1130: :clock12: :clock1230: :clock2: :clock230: :clock3: :clock330: :clock4: :clock430: :clock5: :clock530: :clock6: :clock630: :clock7: :clock730: :clock8: :clock830: :clock9: :clock930: :heavy_dollar_sign: :copyright: :registered: :tm: :x: :heavy_exclamation_mark: :bangbang: :interrobang: :o: :heavy_multiplication_x: :heavy_plus_sign: :heavy_minus_sign: :heavy_division_sign: :white_flower: :100: :heavy_check_mark: :ballot_box_with_check: :radio_button: :link: :curly_loop: :wavy_dash: :part_alternation_mark: :trident: :black_square: :white_square: :white_check_mark: :black_square_button: :white_square_button: :black_circle: :white_circle: :red_circle: :large_blue_circle: :large_blue_diamond: :large_orange_diamond: :small_blue_diamond: :small_orange_diamond: :small_red_triangle: :small_red_triangle_down: :shipit:
                                        </div>

                                        <div class="ChatTextArea" id="cta1" contenteditable="true"></div>
                                        <div class="chatemoji">
                                            <i class="fa fa-smile-o emoi " id="emoi-1" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dockChild dc2 dock_wrapperChilds dock-max-2 dockWrapperRightChilds hide dtabs" dock-no="2" type="1" uid="">
            <div class="_dock m_clearfix">
                <div class="m_clearfix nubContainer rNubContainer">
                    <div id="BuddylistPagelet">
                        <div class="_56ox ">
                            <div class="uiToggle-m _50-v wpNub _4mq3 hide_on_presence_error" id="wpDockChatBuddylistNub">
                                <div class="wpNubButton-max">
                                    <span class="label nb-lb lb-m pointer ">
                                        <span class="_cbnm _cbnm2"></span> 
                                        <span class="cc2 ChatClose pull-right"><i class="fa fa-times"></i></span>
                                    </span>
                                    <div class="sc-wrapper sc-wrapper-2"></div>
                                    <div class="inputBar">
                                        <div id="emoji-list-2" class="emoji-list hide ">
                                            :bowtie: :smile: :laughing: :blush: :smiley: :relaxed: :smirk: :heart_eyes: :kissing_heart: :kissing_closed_eyes: :flushed: :relieved: :satisfied: :grin: :wink: :stuck_out_tongue_winking_eye: :stuck_out_tongue_closed_eyes: :grinning: :kissing: :winky_face: :kissing_smiling_eyes: :stuck_out_tongue: :sleeping: :worried: :frowning: :anguished: :open_mouth: :grimacing: :confused: :hushed: :expressionless: :unamused: :sweat_smile: :sweat: :wow: :disappointed_relieved: :weary: :pensive: :disappointed: :confounded: :fearful: :cold_sweat: :persevere: :cry: :sob: :joy: :astonished: :scream: :neckbeard: :tired_face: :angry: :rage: :triumph: :sleepy: :yum: :mask: :sunglasses: :dizzy_face: :imp: :smiling_imp: :neutral_face: :no_mouth: :innocent: :alien: :yellow_heart: :blue_heart: :purple_heart: :heart: :green_heart: :broken_heart: :heartbeat: :heartpulse: :two_hearts: :revolving_hearts: :cupid: :sparkling_heart: :sparkles: :star: :star2: :dizzy: :boom: :collision: :anger: :exclamation: :question: :grey_exclamation: :grey_question: :zzz: :dash: :sweat_drops: :notes: :musical_note: :fire: :hankey: :poop: :shit: :+1: :thumbsup: :-1: :thumbsdown: :ok_hand: :punch: :facepunch: :fist: :v: :wave: :hand: :raised_hand: :open_hands: :point_up: :point_down: :point_left: :point_right: :raised_hands: :pray: :point_up_2: :clap: :muscle: :metal: :fu: :walking: :runner: :running: :couple: :family: :two_men_holding_hands: :two_women_holding_hands: :dancer: :dancers: :ok_woman: :no_good: :information_desk_person: :raising_hand: :bride_with_veil: :person_with_pouting_face: :person_frowning: :bow: :couplekiss: :couple_with_heart: :massage: :haircut: :nail_care: :boy: :girl: :woman: :man: :baby: :older_woman: :older_man: :person_with_blond_hair: :man_with_gua_pi_mao: :man_with_turban: :construction_worker: :cop: :angel: :princess: :smiley_cat: :smile_cat: :heart_eyes_cat: :kissing_cat: :smirk_cat: :scream_cat: :crying_cat_face: :joy_cat: :pouting_cat: :japanese_ogre: :japanese_goblin: :see_no_evil: :hear_no_evil: :speak_no_evil: :guardsman: :skull: :feet: :lips: :kiss: :droplet: :ear: :eyes: :nose: :tongue: :love_letter: :bust_in_silhouette: :busts_in_silhouette: :speech_balloon: :thought_balloon: :feelsgood: :finnadie: :goberserk: :godmode: :hurtrealbad: :rage1: :rage2: :rage3: :rage4: :suspect: :trollface: :sunny: :umbrella: :cloud: :snowflake: :snowman: :zap: :cyclone: :foggy: :ocean: :cat: :dog: :mouse: :hamster: :rabbit: :wolf: :frog: :tiger: :koala: :bear: :pig: :pig_nose: :cow: :boar: :monkey_face: :monkey: :horse: :racehorse: :camel: :sheep: :elephant: :panda_face: :snake: :bird: :baby_chick: :hatched_chick: :hatching_chick: :chicken: :penguin: :turtle: :bug: :honeybee: :ant: :beetle: :snail: :octopus: :tropical_fish: :fish: :whale: :whale2: :dolphin: :cow2: :ram: :rat: :water_buffalo: :tiger2: :rabbit2: :dragon: :goat: :rooster: :dog2: :pig2: :mouse2: :ox: :dragon_face: :blowfish: :crocodile: :dromedary_camel: :leopard: :cat2: :poodle: :paw_prints: :bouquet: :cherry_blossom: :tulip: :four_leaf_clover: :rose: :sunflower: :hibiscus: :maple_leaf: :leaves: :fallen_leaf: :herb: :mushroom: :cactus: :palm_tree: :evergreen_tree: :deciduous_tree: :chestnut: :seedling: :blossom: :ear_of_rice: :shell: :globe_with_meridians: :sun_with_face: :full_moon_with_face: :new_moon_with_face: :new_moon: :waxing_crescent_moon: :first_quarter_moon: :waxing_gibbous_moon: :full_moon: :waning_gibbous_moon: :last_quarter_moon: :waning_crescent_moon: :last_quarter_moon_with_face: :first_quarter_moon_with_face: :moon: :earth_africa: :earth_americas: :earth_asia: :volcano: :milky_way: :partly_sunny: :octocat: :squirrel: :bamboo: :gift_heart: :dolls: :school_satchel: :mortar_board: :flags: :fireworks: :sparkler: :wind_chime: :rice_scene: :jack_o_lantern: :ghost: :santa: :christmas_tree: :gift: :bell: :no_bell: :tanabata_tree: :tada: :confetti_ball: :balloon: :crystal_ball: :cd: :dvd: :floppy_disk: :camera: :video_camera: :movie_camera: :computer: :tv: :iphone: :phone: :telephone: :telephone_receiver: :pager: :fax: :minidisc: :vhs: :sound: :speaker: :mute: :loudspeaker: :mega: :hourglass: :hourglass_flowing_sand: :alarm_clock: :watch: :radio: :satellite: :loop: :mag: :mag_right: :unlock: :lock: :lock_with_ink_pen: :closed_lock_with_key: :key: :bulb: :flashlight: :high_brightness: :low_brightness: :electric_plug: :battery: :calling: :email: :mailbox: :postbox: :bath: :bathtub: :shower: :toilet: :wrench: :nut_and_bolt: :hammer: :seat: :moneybag: :yen: :dollar: :pound: :euro: :credit_card: :money_with_wings: :e-mail: :inbox_tray: :outbox_tray: :envelope: :incoming_envelope: :postal_horn: :mailbox_closed: :mailbox_with_mail: :mailbox_with_no_mail: :door: :smoking: :bomb: :gun: :hocho: :pill: :syringe: :page_facing_up: :page_with_curl: :bookmark_tabs: :bar_chart: :chart_with_upwards_trend: :chart_with_downwards_trend: :scroll: :clipboard: :calendar: :date: :card_index: :file_folder: :open_file_folder: :scissors: :pushpin: :paperclip: :black_nib: :pencil2: :straight_ruler: :triangular_ruler: :closed_book: :green_book: :blue_book: :orange_book: :notebook: :notebook_with_decorative_cover: :ledger: :books: :bookmark: :name_badge: :microscope: :telescope: :newspaper: :football: :basketball: :soccer: :baseball: :tennis: :8ball: :rugby_football: :bowling: :golf: :mountain_bicyclist: :bicyclist: :horse_racing: :snowboarder: :swimmer: :surfer: :ski: :spades: :hearts: :clubs: :diamonds: :gem: :ring: :trophy: :musical_score: :musical_keyboard: :violin: :space_invader: :video_game: :black_joker: :flower_playing_cards: :game_die: :dart: :mahjong: :clapper: :memo: :pencil: :book: :art: :microphone: :headphones: :trumpet: :saxophone: :guitar: :shoe: :sandal: :high_heel: :lipstick: :boot: :shirt: :tshirt: :necktie: :womans_clothes: :dress: :running_shirt_with_sash: :jeans: :kimono: :bikini: :ribbon: :tophat: :crown: :womans_hat: :mans_shoe: :closed_umbrella: :briefcase: :handbag: :pouch: :purse: :eyeglasses: :fishing_pole_and_fish: :coffee: :tea: :sake: :baby_bottle: :beer: :beers: :cocktail: :tropical_drink: :wine_glass: :fork_and_knife: :pizza: :hamburger: :fries: :poultry_leg: :meat_on_bone: :spaghetti: :curry: :fried_shrimp: :bento: :sushi: :fish_cake: :rice_ball: :rice_cracker: :rice: :ramen: :stew: :oden: :dango: :egg: :bread: :doughnut: :custard: :icecream: :ice_cream: :shaved_ice: :birthday: :cake: :cookie: :chocolate_bar: :candy: :lollipop: :honey_pot: :apple: :green_apple: :tangerine: :lemon: :cherries: :grapes: :watermelon: :strawberry: :peach: :melon: :banana: :pear: :pineapple: :sweet_potato: :eggplant: :tomato: :corn: :house: :house_with_garden: :school: :office: :post_office: :hospital: :bank: :convenience_store: :love_hotel: :hotel: :wedding: :church: :department_store: :european_post_office: :city_sunrise: :city_sunset: :japanese_castle: :european_castle: :tent: :factory: :tokyo_tower: :japan: :mount_fuji: :sunrise_over_mountains: :sunrise: :stars: :themoreyouknow: :tmyk: :statue_of_liberty: :bridge_at_night: :carousel_horse: :rainbow: :ferris_wheel: :fountain: :roller_coaster: :ship: :speedboat: :boat: :sailboat: :rowboat: :anchor: :rocket: :airplane: :helicopter: :steam_locomotive: :tram: :mountain_railway: :bike: :aerial_tramway: :suspension_railway: :mountain_cableway: :tractor: :blue_car: :oncoming_automobile: :car: :red_car: :taxi: :oncoming_taxi: :articulated_lorry: :bus: :oncoming_bus: :rotating_light: :police_car: :oncoming_police_car: :fire_engine: :ambulance: :minibus: :truck: :train: :station: :train2: :bullettrain_front: :bullettrain_side: :light_rail: :monorail: :railway_car: :trolleybus: :ticket: :fuelpump: :vertical_traffic_light: :traffic_light: :warning: :construction: :beginner: :atm: :slot_machine: :busstop: :barber: :hotsprings: :checkered_flag: :crossed_flags: :izakaya_lantern: :moyai: :circus_tent: :performing_arts: :round_pushpin: :triangular_flag_on_post: :jp: :kr: :cn: :us: :fr: :es: :it: :ru: :gb: :uk: :de: :one: :two: :three: :four: :five: :six: :seven: :eight: :nine: :keycap_ten: :1234: :zero: :hash: :symbols: :arrow_backward: :arrow_down: :arrow_forward: :arrow_left: :capital_abcd: :abcd: :abc: :arrow_lower_left: :arrow_lower_right: :arrow_right: :arrow_up: :arrow_upper_left: :arrow_upper_right: :arrow_double_down: :arrow_double_up: :arrow_down_small: :arrow_heading_down: :arrow_heading_up: :leftwards_arrow_with_hook: :arrow_right_hook: :left_right_arrow: :arrow_up_down: :arrow_up_small: :arrows_clockwise: :arrows_counterclockwise: :rewind: :fast_forward: :information_source: :ok: :twisted_rightwards_arrows: :repeat: :repeat_one: :new: :top: :up: :cool: :free: :ng: :cinema: :koko: :signal_strength: :u5272: :u5408: :u55b6: :u6307: :u6708: :u6709: :u6e80: :u7121: :u7533: :u7a7a: :u7981: :sa: :restroom: :mens: :womens: :baby_symbol: :no_smoking: :parking: :wheelchair: :metro: :baggage_claim: :accept: :wc: :potable_water: :put_litter_in_its_place: :secret: :congratulations: :m: :passport_control: :left_luggage: :customs: :ideograph_advantage: :cl: :sos: :id: :no_entry_sign: :underage: :no_mobile_phones: :do_not_litter: :non-potable_water: :no_bicycles: :no_pedestrians: :children_crossing: :no_entry: :eight_spoked_asterisk: :eight_pointed_black_star: :heart_decoration: :vs: :vibration_mode: :mobile_phone_off: :chart: :currency_exchange: :aries: :taurus: :gemini: :cancer: :leo: :virgo: :libra: :scorpius: :sagittarius: :capricorn: :aquarius: :pisces: :ophiuchus: :six_pointed_star: :negative_squared_cross_mark: :a: :b: :ab: :o2: :diamond_shape_with_a_dot_inside: :recycle: :end: :on: :soon: :clock1: :clock130: :clock10: :clock1030: :clock11: :clock1130: :clock12: :clock1230: :clock2: :clock230: :clock3: :clock330: :clock4: :clock430: :clock5: :clock530: :clock6: :clock630: :clock7: :clock730: :clock8: :clock830: :clock9: :clock930: :heavy_dollar_sign: :copyright: :registered: :tm: :x: :heavy_exclamation_mark: :bangbang: :interrobang: :o: :heavy_multiplication_x: :heavy_plus_sign: :heavy_minus_sign: :heavy_division_sign: :white_flower: :100: :heavy_check_mark: :ballot_box_with_check: :radio_button: :link: :curly_loop: :wavy_dash: :part_alternation_mark: :trident: :black_square: :white_square: :white_check_mark: :black_square_button: :white_square_button: :black_circle: :white_circle: :red_circle: :large_blue_circle: :large_blue_diamond: :large_orange_diamond: :small_blue_diamond: :small_orange_diamond: :small_red_triangle: :small_red_triangle_down: :shipit:
                                        </div>
                                        <div class="ChatTextArea" id="cta2" contenteditable="true"></div>
                                        <div class="chatemoji">
                                            <i class="fa fa-smile-o emoi " id="emoi-2" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
        <script>
            //var socket = io('http://localhost:3000');
            window.socket = io('http://192.168.10.10:3000');
            socket.emit("_init", { data: "{!!Auth::id()!!}" });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
        <script src="//platform.twitter.com/widgets.js"></script>
        <script src="http://vjs.zencdn.net/5.0.0/video.js"></script>
        <script src="https://cdn.jsdelivr.net/prism/1.4.1/prism.js"></script>
        <script src="/packages/embed/src/embed.js"></script>
        <script src="/assets/js/chat.js"></script>
    @endif


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

    <script src="/packages/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- <script src="/assets/js/jquery.scrollUp.min.js"></script> -->
    <script src="/assets/js/jquery.prettyPhoto.js"></script>
    <script src="/assets/js/layouts/main.js"></script>
    <script src="/packages/scroll_style/jquery.slimscroll.min.js"></script>
    <script src="/packages/jquery-sortable-photos/jquery-sortable-photos.js"></script>
    <!-- LOCATION PICKER -->
    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src="/packages/location-picker/locationpicker.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
    <script src="http://vjs.zencdn.net/5.0.0/video.js"></script>
    <script src="https://cdn.jsdelivr.net/prism/1.4.1/prism.js"></script>
    <script src="/packages/dropzone/dropzone.js"></script>
    <script src="/packages/moment/moment.js"></script>
    <script src="/packages/easy_autocomplete/jquery.easy-autocomplete.js"></script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1728054614082756";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    </body>
    </html>