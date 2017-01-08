@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')
	<script type="text/javascript">
	alert('terst');
	$("button").click(function(e){
		  e.preventDefault();
		  alert('ehre');
		  // window.open($(e.currentTarget).attr('href'), '_system', '');
		});

	</script>
	<div class="fb-comments modalfc"  data-href={!!Request::root()!!}/posts/{{$pid}}
	data-width="100%" data-numposts="5">
	</div>
@stop