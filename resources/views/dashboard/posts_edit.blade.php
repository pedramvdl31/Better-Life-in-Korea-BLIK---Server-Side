@extends($layout)
@section('stylesheets')
    <link rel="stylesheet" href="/packages/dropzone/dropzone.css" />
    <!-- AUTOCOMPLETE -->
    <link rel="stylesheet" href="/packages/easy_autocomplete/easy-autocomplete.css" />
@stop
@section('scripts')
    <script src="/packages/dropzone/dropzone.js"></script>
    <script src="/packages/easy_autocomplete/jquery.easy-autocomplete.js"></script>
    <script src="/assets/js/dashboard/posts/edit.js"></script>
@stop

@section('content')
<style type="text/css">
    .dropzone {
    border: 2px dashed #0087F7;
    border-radius: 5px;
    background: white;
    min-height: 150px;
    }
    .anim {
        transition: all 0.5s ease !important;
    }

	.col-no-padding{
    	padding-left: 0;
    	padding-right: 0;
	}




	         .flex-video {
          position: relative;
          padding-top: 25px;
          padding-bottom: 67.5%;
          height: 0;
          margin-bottom: 16px;
          overflow: hidden;
           }

          .flex-video.widescreen { padding-bottom: 57.25%; }
          .flex-video.vimeo { padding-top: 0; }

          .flex-video video,
          .flex-video object,
          .flex-video embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
          }

 @media only screen and (max-device-width: 800px),  
 only screen and (device-width:1024px) and (device-height: 600px), only screen 

 and (width: 1280px) and (orientation: landscape), only screen 

 and (device-width: 800px), only screen and (max-width: 767px) {

 .flex-video { padding-top: 0; }
   }
</style>



<div class="panel panel-default">
  <div class="panel-body">
	{!! Form::open(array('route' => 'posts-edit', 'class'=>'','role'=>"form",'id'=>'post-form')) !!}
	<input type="hidden" name="ad_id" value="{{$ps->id}}"></input>
   <div class="form-group" id="cat-wrap">
	    <label>Select Category:</label>
        <select name="cat" class="form-control qp-selects" id="cats">
            <option value="1" @if ($ps->cat_id == 1) selected  @endif>Bar & Pub</option>
            <option value="2" @if ($ps->cat_id == 2) selected  @endif>Car Dealership</option>
            <option value="3" @if ($ps->cat_id == 3) selected  @endif>Coffee Shop</option>
            <option value="4" @if ($ps->cat_id == 4) selected  @endif>Entertainment</option>
            <option value="5" @if ($ps->cat_id == 5) selected  @endif>Food</option>
            <option value="6" @if ($ps->cat_id == 6) selected  @endif>Gas Station</option>
            <option value="29" @if ($ps->cat_id == 29) selected  @endif>Church</option>
            <option value="7" @if ($ps->cat_id == 7) selected  @endif>Hotel</option>
            <option value="8" @if ($ps->cat_id == 8) selected  @endif>Medical Center</option>
            <option value="9" @if ($ps->cat_id == 9) selected  @endif>Movie Theater</option>
            <option value="10" @if ($ps->cat_id == 10) selected  @endif>Nightlife Spot</option>
            <option value="23" @if ($ps->cat_id == 23) selected  @endif>Institution</option>
            <option value="11" @if ($ps->cat_id == 11) selected  @endif>Outdoors & Recreation</option>
            <option value="12" @if ($ps->cat_id == 12) selected  @endif>Parking</option>
            <option value="13" @if ($ps->cat_id == 13) selected  @endif>Pharmacy</option>
            <option value="14" @if ($ps->cat_id == 14) selected  @endif>Real Estate</option>
            <option value="28" @if ($ps->cat_id == 28) selected  @endif>Temple</option>
            <option value="15" @if ($ps->cat_id == 15) selected  @endif>Supermarket</option>
            <option value="16" @if ($ps->cat_id == 16) selected  @endif>Taxi</option>
            <option value="17" @if ($ps->cat_id == 17) selected  @endif>Transport</option>
            <option value="18" @if ($ps->cat_id == 18) selected  @endif>Travel Agency</option>
            <option value="19" @if ($ps->cat_id == 19) selected  @endif>Cosmetic</option>
            <option value="20" @if ($ps->cat_id == 20) selected  @endif>Pet-Shop</option>
            <option value="27" @if ($ps->cat_id == 27) selected  @endif>Museum</option>
            <option value="21" @if ($ps->cat_id == 21) selected  @endif>Event</option>
            <option value="22" @if ($ps->cat_id == 22) selected  @endif>Mall</option>
            <option value="24" @if ($ps->cat_id == 24) selected  @endif>Sightseeing</option>
            <option value="25" @if ($ps->cat_id == 25) selected  @endif>Subway-Station</option>
            <option value="26" @if ($ps->cat_id == 26) selected  @endif>Government</option>
            <option value="30" @if ($ps->cat_id == 30) selected  @endif>Kids</option>
            <option value="31" @if ($ps->cat_id == 31) selected  @endif>Beach</option>
        </select>
	</div>
	<div class="form-group 2t-wrap {!! $errors->has('title') ? 'has-error' : false !!}" id="title-wrap">
	    <label>Title: <span class="_required">*required</span></label>
	    <input value="{{$ps->title}}" type="text" class="form-control  pk-form" name="title" id="email" placeholder="Title" aria-describedby="sizing-addon2">
    	@foreach($errors->get('title') as $message)
		<span class='help-block'>{!! $message !!}</span>
		@endforeach
	</div>

	<div class="form-group 2t-wrap {!! $errors->has('description') ? 'has-error' : false !!}" id="des-wrap">
	    <label>Description: <span class="_required">*required</span></label>
	    <textarea rows="4" cols="50" style="resize:vertical;" class="form-control pk-form" name="description">{{$ps->des}}</textarea>
	    @foreach($errors->get('description') as $message)
		<span class='help-block'>{!! $message !!}</span>
		@endforeach
	</div>
	<div id="file-div">

	</div>
	<div id="remove-file-div">
		
	</div>
	<div class="form-group">
	    <label>Images:</label>
	    <div class="row thumb-row" style="margin: 0;">
		    @if(isset($ps->decoded_files))
				@foreach($ps->decoded_files as $pfk => $pfv)
					@foreach($pfv as $pk => $pv)
						@if($pk=="image")
					      <div class="col-xs-12 col-md-3 thumb-wrap">
						    <div href="#" class="thumbnail">
						      <img src="{!!$ps['base-path'].$pk.DIRECTORY_SEPARATOR.$pv['name']!!}" alt="...">
						      <a data="{!!$pv['name']!!}" class="btn btn-block btn-danger remove-ofile" style="margin-top: 5px">Remove</a>
						    </div>
						  </div>
						@endif
					@endforeach
				@endforeach
			@else
				<p>None</p>
			@endif	
	    </div>
	</div>
	{!! Form::close() !!}
	<hr>
	<div id="dropzone" class="2t-wrap col-md-6 col-no-padding">
	    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_image">
	      <div class="dz-message needsclick">
	        Drop images and videos here or click to upload.<br>
	        <span class="note needsclick">(Images and Videos max size <strong>30000000mb</strong>.)</span>
	      </div>
	    </form>
	</div>            
  </div>
  <div class="panel-footer clearfix">
  	<a class="btn btn-default pull-left" href="{!!route('dash_view_posts')!!}">Back</a>
  	<a  class="btn btn-primary pull-right" id="post-btn">Edit</a>
  </div>
</div>

         
	
@stop