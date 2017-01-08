@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')

	@if(!Auth::check())
		<center>
			<a class="btn btn-social btn-facebook" href="api/auth/facebook">
				<span class="fa fa-facebook"></span>  Sign in to Facebook
			</a>		
		</center>
	@else
		<div class="fb-comments modalfc"  data-href={!!Request::root()!!}/posts/{{$pid}}
		data-width="100%" data-numposts="5">
		</div>
	@endif

@stop