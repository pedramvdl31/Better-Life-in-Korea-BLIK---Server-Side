@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')
	<script type="text/javascript">
	</script>
	@if(Auth::check())

	@else
	    <a class="btn btn-social btn-facebook" href="/auth/facebook">
			<span class="fa fa-facebook"></span>  Sign in with Facebook
		</a>
	@endif
	<div class="fb-comments modalfc"  data-href={!!Request::root()!!}/posts/{{$pid}}
	data-width="100%" data-numposts="5">
	</div>
@stop