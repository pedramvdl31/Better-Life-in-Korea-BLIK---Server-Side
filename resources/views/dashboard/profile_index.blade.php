@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')
<input type="hidden" id="cities-autocomplete"></input>
<div class="panel panel-default">
  <div class="panel-body">
    
	<dl>
	  <dt></dt>
	  <dd>
	  	
		@if(isset(Auth::user()->avatar))
		<img src="{!!$uiPath.Auth::user()->avatar!!}" width="125px" alt="..." class="img-circlex profile_img" >
		@else
		<img src="/assets/images/profile-images/perm/blank_male.png" alt="..." class="img-circlex profile_img" width="125px">
		@endif

	  </dd>
	  <dt>Email</dt>
	  <dd>{!!$user->email!!}</dd>
	  <dt>Short Description</dt>
	  @if(isset($user->description))
	  	<dd>{!!$user->description!!}</dd>
	  @else
	  	<dd>-</dd>
	  @endif	  
	  <dt>Firstname</dt>
	  @if(isset($user->first_name))
	  	<dd>{!!$user->first_name!!}</dd>
	  @else
	  	<dd>-</dd>
	  @endif
	  <dt>Lastname</dt>
	  @if(isset($user->last_name))
	  	<dd>{!!$user->last_name!!}</dd>
	  @else
	  	<dd>-</dd>
	  @endif
	</dl>

  </div>
  <div class="panel-footer clearfix">
  	<a class="btn btn-default pull-left" href="{!!route('users_dash')!!}">Back</a>
  	<a href="{!!route('edit-profile','current')!!}"  class="btn btn-primary pull-right" >Edit</a>
  </div>
</div>

@stop