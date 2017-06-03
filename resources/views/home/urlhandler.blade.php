@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
  <script src="/assets/js/deeplink.js"></script>
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
<script type="text/javascript">
  var e = "blikapp://";
  setTimeout(function(){ 

    alert();
    window.location = e

   }, 1000);

</script>
<article class="col-md-6 col-sm-12 col-xs-12">
    <h3><a href="blikapp://?adid={{$adid}}">View Post</a></h3>
    <div>
        <p>**You must have the app installed on your phone, Download the app and try again**
        <br>
        <small><a href="https://play.google.com/store/apps/details?id=com.phonegap.blikrel&hl=en">BLIK APP - ANDROID</a></small>
        <br>
        <small><a href="https://itunes.apple.com/us/app/blik-better-life-in-korea/id1183706806?ls=1&mt=8">BLIK APP - IPHONE</a></small>
        </p>


    </div>
</article>
@stop