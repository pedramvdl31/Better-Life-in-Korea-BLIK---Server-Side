    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A Better Life in Korea, find country's favorite places and quickly get around.">
        <meta name="author" content="webprinciples">
        <meta property="og:title" content="Better Life in Korea" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.betterlifeinkorea.com/" />
        <meta property="og:image" content="/assets/images/blik.jpg" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <title>Home | Kora</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        </head><!--/head-->
        @yield('stylesheets')
        <body>
        <script>    
            var adid = {!!$adid!!};
        </script>

        @yield('content')

        <!-- PAEG SCRIPT -->
        @yield('scripts')
        <!-- PAGE SCRIPT -->

        
    </body>
</html>