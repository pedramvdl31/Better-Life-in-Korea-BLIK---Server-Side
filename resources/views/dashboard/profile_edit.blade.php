@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="/assets/js/dashboard/profile_edit.js"></script>
@stop

@section('content')
<input type="hidden" id="cities-autocomplete"></input>
    <style type="text/css">
		/* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
		 .fileinput-button {
		    position: relative;
		    overflow: hidden;
		}
		/*Also*/
		 .fileinput-button input {
		    position: absolute;
		    top: 0;
		    right: 0;
		    margin: 0;
		    opacity: 0;
		    -ms-filter:'alpha(opacity=0)';
		    font-size: 200px;
		    direction: ltr;
		    cursor: pointer;
		}
    </style>

<div class="panel panel-default">

  	<div class="panel-body">


		<div class="form-group {!! $errors->has('email') ? 'has-error' : false !!}">
			@if(isset(Auth::user()->avatar))
				<img src="{!!$uiPath.Auth::user()->avatar!!}"  width="125px" alt="..." class="img-circlex profile_img" >
			@else
				<img src="/assets/images/profile-images/perm/blank_male.png" alt="..." class="img-circlex profile_img" width="125px" height="125px">
			@endif
			<span class="btn btn-success fileinput-button">
		        <span>Change Avatar</span>
		        <form id="file-form" action="handler.php" method="POST">
		    		<input type="file" name="file" id="form-submit-btn">
		    	</form>
		    </span>
		</div>
		{!! Form::open(array('route' => 'profile-edit-post', 'class'=>'','role'=>"form",'id'=>'post-form')) !!}
		<div class="form-group {!! $errors->has('email') ? 'has-error' : false !!}">
		    <label>Email: <span class="_required">*required</span></label>
		    <input type="text" class="form-control  pk-form" name="email" id="email" disabled="true" placeholder="{!!$user->email!!}" aria-describedby="sizing-addon2">
	    	@foreach($errors->get('title') as $message)
			<span class='help-block'>{!! $message !!}</span>
			@endforeach
		</div>
		<div class="form-group {!! $errors->has('description') ? 'has-error' : false !!}">
		    <label>Short Description:</label>
		    <input type="text" class="form-control  pk-form" name="description" value="{!!$user->description!!}" aria-describedby="sizing-addon2">
	    	@foreach($errors->get('description') as $message)
			<span class='help-block'>{!! $message !!}</span>
			@endforeach
		</div>
		<div class="form-group {!! $errors->has('first_name') ? 'has-error' : false !!}">
		    <label>Firstname:</label>
		    <input type="text" class="form-control  pk-form" name="first_name" value="{!!$user->first_name!!}" aria-describedby="sizing-addon2">
	    	@foreach($errors->get('first_name') as $message)
			<span class='help-block'>{!! $message !!}</span>
			@endforeach
		</div>
		<div class="form-group {!! $errors->has('last_name') ? 'has-error' : false !!}">
		    <label>Lastname:</label>
		    <input type="text" class="form-control  pk-form" name="last_name" value="{!!$user->last_name!!}" aria-describedby="sizing-addon2">
	    	@foreach($errors->get('last_name') as $message)
			<span class='help-block'>{!! $message !!}</span>
			@endforeach
		</div>


  	</div>
  <div class="panel-footer clearfix">
  	<a class="btn btn-default pull-left" href="{!!route('users_dash')!!}">Back</a>
  	<button type="submit" class="btn btn-primary pull-right" >Edit</button>
  </div>
</div>
{!! Form::close() !!}
@stop