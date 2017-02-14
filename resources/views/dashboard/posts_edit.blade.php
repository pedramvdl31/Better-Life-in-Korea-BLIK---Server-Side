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
            <option value="1" @if ($ps->cat_id == 6) selected  @endif >Bar & Pub</option>
            <option value="2">Car Dealership</option>
            <option value="3">Coffee Shop</option>
            <option value="4">Entertainment</option>
            <option value="5">Food</option>
            <option value="6" @if ($ps->cat_id == 6) selected  @endif>Gas Station</option>
            <option value="7">Hotel</option>
            <option value="8">Medical Center</option>
            <option value="9">Movie Theater</option>
            <option value="10">Nightlife Spot</option>
            <option value="11">Outdoors & Recreation</option>
            <option value="12">Parking</option>
            <option value="13">Pharmacy</option>
            <option value="14">Real Estate</option>
            <option value="15">Supermarket</option>
            <option value="16">Taxi</option>
            <option value="17">Transport</option>
            <option value="18">Travel Agency</option>
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