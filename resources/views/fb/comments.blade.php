@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')


	<div 
	class="fb-comments modalfc" data-href={!!Request::root()!!}/posts/{{$pid}}
	data-width="100%" data-numposts="5">
		
	</div>

	<script type="text/javascript">
	 	setTimeout(function(){ 
			if (typeof FB != 'undefined') {
					FB.XFBML.parse();
			}
		}, 700);
	</script>
@stop