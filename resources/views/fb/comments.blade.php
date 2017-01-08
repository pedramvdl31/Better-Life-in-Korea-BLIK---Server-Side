@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')
	<div class="fb-comments modalfc"  data-href={!!Request::root()!!}/posts/{{$pid}}
	data-width="100%" data-numposts="5">
	</div>
@stop