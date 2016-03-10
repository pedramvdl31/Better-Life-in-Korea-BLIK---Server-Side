<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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
</style>
<body>

    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +82 000 0000 0000</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@kora.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        @include('flash::message')
        <input type="hidden" id="_auth" data={!!Auth::check()?1:0!!}></input>
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">

                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                            <li><a href="{!!route('users_dash')!!}"><i class="fa fa-level-up"></i> Dashboard</a></li>
                                @if(Auth::check())
                                
                                <li><a href="{!!route('users_logout')!!}"><i class="fa fa-lock"></i> Logout</a></li>
                                @else
                                <li><a class="login-btn pointer"><i class="fa fa-lock"></i> Login</a></li>
                                <li><a class="reg-btn pointer"><i class="fa fa-crosshairs"></i> Register</a></li>
                                @endif
                                <li><button href="" class="btn btn-primary btn-lg qkpost"><i class="glyphicon glyphicon-plus"></i>&nbspQuick Post</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="index.html" class="active">Home</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    

    
    <section>
        <div class="container">
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
                                            <li><a href="#">Agencies </a></li>
                                            <li><a href="#">Private </a></li>
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
                                            <li><a href="#">Dealership </a></li>
                                            <li><a href="#">C-C </a></li>
                                            <li><a href="#">Sofa Document Fee </a></li>
                                            <li><a href="#">Insurance </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Move In/Out
                                        </a>
                                    </h4>
                                </div>
                                <div id="womens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Cleaning</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Moving Company</a></li>
                                            <li><a href="#">Medical</a></li>
                                            <li><a href="#">Cellphone</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#">Flea Market</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#">Events</a></h4>
                                </div>
                            </div>
                        </div><!--/category-products-->
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
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
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
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
                        
                        <div class="col-sm-3">
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
                        
                        <div class="col-sm-3">
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
                        
                        <div class="col-sm-3">
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
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="/assets/images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-5">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
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

</style>

@if(Auth::check())
 <input type="hidden" id="ufh" value="{{Auth::user()->id}}"></input>
@endif
<div class="chat_dock">
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
                                <span class="label nb-lb lb-m pointer "><span class="_cbnm">Pedram</span> <span class="cc1 ChatClose pull-right"><i class="fa fa-times"></i></span></span>
                                <div class="inner-wrapper-child">
                                    <div class="_mrcv _msgsr"> 
                                        <div class="_mavr">
                                            <img src="/assets/images/profile-images/perm/blank_male.png" width="35px">
                                        </div>  
                                        <div class="_mtwpr">
                                            <div class="_mb _rcvb">
                                                <span class="_mtxt embd" >
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
                                <div class="inner-wrapper-child">
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
                                    <div class="conv-wrapper pointer">
                                        <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
                                        <img src="/assets/images/home/product4.jpg" alt="" />
                                        <span>Pedram</span>
                                        <span class="label label-success conv-c">2</span>
                                    </div>
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


    <!-- --------------------------------------------- -->
    <!-- -------------------------------------------- -->
    {!! View::make('partials.login_modal') !!}    
    {!! View::make('partials.register_modal') !!}    
    {!! View::make('partials.success_modal') !!}    
    @if(Auth::check())
        {!! View::make('partials.qkpost_modal')
        ->with('cats',$cats)
        ->__toString()!!}   
    @endif
  
    <!-- Load js libs only when the page is loaded. -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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