    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Home | Kora</title>

        <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyAN5kdxBmHyX28NMWF3z3ZaV-71FjRiAh0&libraries=places'></script>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- STAR RATING -->
        <link href="/assets/plugins/krajee-star/star-rating.css" rel="stylesheet">
        <!-- STAR RATING -->

        <link href="/packages/bootstrap-social/bootstrap-social.css" rel="stylesheet">
        <link href="/packages/bootstrap-social/assets/css/docs.css" rel="stylesheet">

        <link href="/assets/css/prettyPhoto.css" rel="stylesheet">
        <link href="/assets/css/animate.css" rel="stylesheet">
        <link href="/assets/css/main.css" rel="stylesheet">
        <link href="/assets/css/responsive.css" rel="stylesheet">

        <link href="/assets/css/general.css" rel="stylesheet">
        <link rel="stylesheet" href="/packages/dropzone/dropzone.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <!-- AUTOCOMPLETE -->
        <link rel="stylesheet" href="/packages/easy_autocomplete/easy-autocomplete.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

        <!-- BLUEIMP-GALLERY -->
        <link rel="stylesheet" href="/packages/gallery-master/css/blueimp-gallery.css">


        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
    </head><!--/head-->
    <style type="text/css">
        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
        outline: none;
        }
        .close {
            font-size: 27px !important;
        }
        .pr-img img{
        width: 100%;
        }
        .links{
        cursor: pointer;
        }
        #nav.affix {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 9999;
        }
        .text-to-icon{
            padding: 3px;
            border-radius: 4px;
            background-color: rgba(0, 0, 0, 0.62);
            color: #00aeff;
            text-shadow: none;
            font-weight: 900;
        }
        #flash-alert{
            border-radius: 0;
        }
    </style>
    @yield('stylesheets')
    <body>
        
        <!-- google analytics tag -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-83202323-1', 'auto');
          ga('send', 'pageview');
        </script>
        <!-- google analytics tag -->

        <header id="header"><!--header-->
            <!-- -------- NAVBAR ----------- -->
            <nav class="navbar navbar-default my-nav" data-spy="affix" id="nav" style="margin-bottom: 0">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#z" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Better Life In Korea</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="z">
                        <div class="navbar-form navbar-left my-navbar-left" role="search">
                            <div class="form-group">
                              <input id="searchbar" type="text" class="form-control" placeholder="Search for ads">
                            </div>
                            <div class="text-center search-loading hide" style="line-height: 34px;
                                float: right;
                                margin-left: 10px;
                                width: 20px;
                                ">
                                    <i class="fa fa-cog fa-spin fa-3x fa-fw" style="font-size: 28px;"></i>
                            </div>
                        </div>
                        <ul class="nav navbar-nav navbar-right my-navbar-right">
                            <li><a class="tab-c tab-home"> <span class="text-to-icon">Posts</span> </a></li>
                            <li><a class="tab-c tab-cat tab-active"><span class="text-to-icon"><i class="glyphicon glyphicon-th-large" aria-hidden="true"></i>&nbsp;Categories</a></span></li>
                            <li><span class="nav-vertical-seperator">|</span></li>
                            <li><a href="{!!route('users_dash')!!}"><i class="fa fa-level-up"></i> Profile</a></li>
                            @if(Auth::check())
                                <li><a id="view_wl" class="pointer"><i class="fa fa-folder-o"></i> Wishlist</a></li>
                                <li><a href="{!!route('users_logout')!!}"><i class="fa fa-lock"></i> Logout</a></li>
                            @else
                                <li><a class="login-btn pointer"><i class="fa fa-lock"></i> Login</a></li>
                                <li><a class="reg-btn pointer"><i class="fa fa-crosshairs"></i> Register</a></li>
                            @endif
                            <li class="lg-forms"><button style="margin-top: 8px;" href="" class="btn btn-primary qkpost"><i class="glyphicon glyphicon-plus"></i>&nbspPost Something</button></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <!-- ---------- NAVBAR END ---------- -->
            <div>
                <a style="margin-bottom: 0;" class="btn btn-primary btn-block qkpost sm-forms qkpost-btn-sm"><i class="glyphicon glyphicon-plus">     
                </i>&nbspQuick Post</a>  
            </div>


            <input type="hidden" id="_auth" data={!!Auth::check()?1:0!!}></input>
            <input type="hidden" id="web_root" value={!!Request::root()!!}></input>

        </header><!--/header-->
        <div class="flash-notification">
            @include('flash::message')
        </div>

        <style type="text/css">
            .controls {
                margin-top: 10px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
              }

              #pac-input {
                background-color: #fff;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 0 11px 0 13px;
                text-overflow: ellipsis;
                width: 300px;
              }

              #pac-input:focus {
                border-color: #4d90fe;
              }

              .pac-container {
                z-index: 9999;
                font-family: Roboto;
              }

              #type-selector {
                color: #fff;
                background-color: #4d90fe;
                padding: 5px 11px 0px 11px;
              }

              #type-selector label {
                font-family: Roboto;
                font-size: 13px;
                font-weight: 300;
              }
              #city_select{
                position: absolute;
                width: 100%;
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                -o-transition: all 1s ease;
                -ms-transition: all 1s ease;
                transition: all 1s ease;
              }
              #cat_select{
                position: absolute;
                width: 100%;
                left: 100%;
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                -o-transition: all 1s ease;
                -ms-transition: all 1s ease;
                transition: all 1s ease;
                
              }
              #mylocation1{
                right: 0 !important;
                left:auto !important;
              }
        </style>
        <!-- PAGE VIEW -->

        

        <!-- CITIES MAP -->
        <div id="city_select">   
            {!! View::make('partials.cities_map') !!} 
        </div>
        <!-- CITIES MAP -->
        <!-- CITIES MAP -->
        <div id="cat_select">   
            {!! View::make('partials.categories')->with('all_categories',$all_categories)
            ->with('ads',$ads)
            ->__toString()!!}
        </div>
        <!-- CITIES MAP -->




        @yield('content')
        <!-- PAGE VIEW END -->

        <input type="hidden" id="user-status" value="{!! (Auth::check())?1:0; !!}">

        {!! View::make('partials.login_modal') !!}    
        {!! View::make('partials.postview_modal') !!}    
        {!! View::make('partials.register_modal') !!}    
        {!! View::make('partials.success_modal') !!}
        {!! View::make('partials.warning_modal') !!}      
        {!! View::make('partials.blueimp_gallery') !!}      
        @if(Auth::check())
            <!-- CHAT MUST BE HERE -->
            {!! View::make('partials.qkpost_modal')
            ->with('cats',$cats)
            ->__toString()!!}   
            {!! View::make('partials.wishlist_modal')
            ->with('wishlist',$wishlist)
            ->__toString() !!}
        @endif

        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

        <script src="/packages/touch-punch/jquery.ui.touch-punch.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


        <script src="/assets/js/jquery.prettyPhoto.js"></script>
        <script src="/assets/js/layouts/main.js"></script>
        <!-- POPUP AD -->
        @if($popup!=0)
            <input type="hidden" name="popup_id" id="popup_id" value="{{$popup}}">
            <script src="/assets/js/layouts/popup.js"></script>
        @endif
        <!-- POPUP AD -->
        <script src="/packages/scroll_style/jquery.slimscroll.js"></script>
        <script src="/packages/jquery-sortable-photos/jquery-sortable-photos.js"></script>

        <script src="/packages/dropzone/dropzone.js"></script>
        <!-- <script src="/packages/moment/moment.js"></script> -->
        <script src="/packages/easy_autocomplete/jquery.easy-autocomplete.js"></script>

        <!-- Star-Rating -->
        <script src="/assets/plugins/krajee-star/star-rating.min.js"></script>
        <!-- Star-Rating -->

        <!-- //BLUEIMG-GALLERT -->
        <script src="/packages/gallery-master/js/blueimp-gallery.js"></script>
        <!-- //BLUEIMG-GALLERT -->
        <!-- PAEG SCRIPT -->
        @yield('scripts')
        <!-- PAGE SCRIPT -->

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