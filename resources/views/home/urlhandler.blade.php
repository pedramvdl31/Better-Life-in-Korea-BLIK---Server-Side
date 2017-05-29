@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
	<script src="/assets/js/urlhandler.js"></script>
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

<article class="col-md-6 col-sm-12 col-xs-12">
    <h3>Redirecting to BLIK APP!&nbsp;<img src="/assets/images/icons/gif/loading1.gif" width="20px;"></h3>
    <div>
        <p>**You must have the app installed on your phone, Download the app and try again**
        <br>
        <small><a href="https://play.google.com/store/apps/details?id=com.phonegap.blikrel&hl=en">BLIK APP - ANDROID</a></small>
        <br>
        <small><a href="https://itunes.apple.com/us/app/blik-better-life-in-korea/id1183706806?ls=1&mt=8">BLIK APP - IPHONE</a></small>
        </p>


        <a onClick="javascript:try_to_open_app();" href="'blikapp://?adid='{{adid}}">App name</a>
    </div>
</article>
@stop