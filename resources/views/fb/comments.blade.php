@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')
	<script type="text/javascript">
 		setTimeout(function(){ 
			if (typeof FB != 'undefined') {
		        FB.api('/me', function(responseMe) {
		            if (!responseMe.id) {
		                return false;
		            }
		            var accessToken = "{{$actkn}}";
		            $.post('/web/register/faceBookRegistration',{
		                data                : responseMe,
		                accessTokenValue    : accessToken
		            }).done(function(data) {
						 
		            });   
		        });
			}

		}, 700);

	</script>
	<div class="fb-comments modalfc"  data-href={!!Request::root()!!}/posts/{{$pid}}
	data-width="100%" data-numposts="5">
	</div>
@stop