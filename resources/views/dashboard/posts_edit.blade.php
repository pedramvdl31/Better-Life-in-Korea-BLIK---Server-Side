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
    ._required{
        font-weight: 300;
        font-size: 12px;        
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
	    {!! Form::select('cat',$cats ,$ps->cat_id, ['id'=>'cats','class'=>'form-control qp-selects','status'=>false]) !!}
	</div>
	<div class="form-group" id="subcat-wrap">
	    <label>Select Sub Category:</label>
	    {!! Form::select('subcat',$ps->subcats_select ,$ps->subcat_id, ['id'=>'subcat-select','class'=>'form-control qp-selects','status'=>false]) !!}
	</div>


	<div class="form-group 2t-wrap {!! $errors->has('city') ? 'has-error' : false !!}">
	    <style type="text/css">
	        .eac-description{
	            width: 100% !important;
	        }
	    </style>
	    <label>Select City:</label>
	    <input name="city" value="{{$ps->city}}" class="form-control pk-form" id="cities-autocomplete" placeholder="Search Your City" style="width: 100%"  aria-describedby="sizing-addon2" />
	    @foreach($errors->get('city') as $message)
		<span class='help-block'>{!! $message !!}</span>
		@endforeach
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
	<div class="form-group">
	    <label>Videos:</label>
	    	<div class="row thumb-row" style="margin: 0;">
		    	@if(isset($ps->decoded_files))
					@foreach($ps->decoded_files as $pfk => $pfv)
						@foreach($pfv as $pk => $pv)
							@if($pk=="video")
						      <div class="col-xs-12 col-md-3 thumb-wrap">
							    <div href="#" class="thumbnail">
								    <div class="flex-video widescreen ">
						                <video class="" frameborder="0" controls>
						                	<source src="{!!$ps['base-path'].$pk.DIRECTORY_SEPARATOR.$pv['name']!!}" type="video/mp4">
						                </video>
						            </div>   

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
	<div id="dropzone" class="2t-wrap col-md-6 col-no-padding">
	    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_video">
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