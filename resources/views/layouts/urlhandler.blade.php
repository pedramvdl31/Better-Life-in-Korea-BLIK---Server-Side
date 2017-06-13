    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Home | Kora</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="webprinciples"> 
        <meta name="description" content="Better Life in Korea allows you to promote your business, service or event. Your costumers and friends can use all available GPS applications to directly drive or walk to your posts.">
        <meta property="og:title" content="Better Life in Korea" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.betterlifeinkorea.com" />
        <meta property="og:image" content="{!!$img_path!!}" />
        <meta property="og:description" content="Better Life in Korea allows you to promote your business, service or event. Your costumers and friends can use all available GPS applications to directly drive or walk to your posts." /> 
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <!-- Custom Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <title>Home | Kora</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        </head><!--/head-->
        @yield('stylesheets')
        <body>
            <img style="display: none" src="{!!$img_path!!}">
            <script>    
                var adid = {!!$adid!!};
            </script>

            @yield('content')

            <!-- PAEG SCRIPT -->
            @yield('scripts')
            <!-- PAGE SCRIPT -->
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        </body>
</html>