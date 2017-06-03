@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="/assets/js/urlhandler.js?ver0.2"></script>
@stop

@section('content')

<style>
  body { text-align: center; padding: 10px; }
  h1 { font-size: 50px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <ul class="nav navbar-nav">
      <a href="#" id="opemapp" class="btn btn-default btn-lg">Open in app</a>
    </ul>
  </div><!-- /.container-fluid -->
</nav>
<article class="col-md-6 col-sm-12 col-xs-12" style="margin-top: 90px">
    <div>
        <center>
          <a href="https://play.google.com/store/apps/details?id=com.phonegap.blikrel&hl=en"><img width="200px" src="/assets/images/gp.png"></a>
          <p>&nbsp;&nbsp;</p>
          <a href="https://itunes.apple.com/us/app/blik-better-life-in-korea/id1183706806?ls=1&mt=8"><img width="200px" src="/assets/images/it.png"></a>
        </center>
        
        <script type="text/javascript">

          var e = "blikapp://?adid={{$adid}}";
          $('#opemapp').click(function(){
            window.location = e;
          });

        </script>
    </div>
</article>
@stop