<style type="text/css">
	    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {
    	.qkpost_dialog{
    		width: 100% !important;
    		padding: 10px !important;
    		margin: 0 !important;
    	}
    }

    /* Extra Small Devices, Phones */ 
    @media only screen and (max-width : 480px) {
    	.qkpost_dialog{
    		width: 100% !important;
    		padding: 10px !important;
    		margin: 0 !important;
    	}
    }

    /* Custom, iPhone Retina */ 
    @media only screen and (max-width : 320px) {
        .qkpost_dialog{
    		width: 100% !important;
    		padding: 10px !important;
    		margin: 0 !important;
    	}  
    }

    /*-----------*/
    .dropzone {
    border: 2px dashed #0087F7;
    border-radius: 5px;
    background: white;
    min-height: 150px;
    }

    .anim {
        transition: all 0.5s ease !important;
    }
</style>
<div class="modal fade" id="qkpost-modal">
	{!! Form::open(array('action' => 'UsersController@postLoginModal', 'class'=>'','role'=>"form",'id'=>'login-form-1', 'style'=>'height:100%')) !!}
	  <div class="modal-dialog qkpost_dialog" style="width: 44%;margin-top: 10px;height: 100%">
	    <div class="modal-content" style="height: 96%">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">It will just take few minuts...</h4>
	      </div>
	      <div class="modal-body" style="height: 76%;overflow: auto;">
            <div class="body-wrapp">
                <div class="form-group" id="cat-wrap">
                    <label>Select Category:</label>
                    {!! Form::select('cat',$cats ,null, ['id'=>'cats','class'=>'form-control','status'=>false]) !!}
                </div>
                <div class="form-group hide anim" id="subcat-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Select Sub Category:</label>
                    {!! Form::select('subcat',$subcats ,null, ['id'=>'subcats','class'=>'form-control','status'=>false]) !!}
                </div>
                <div class="form-group hide anim" id="title-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Title:</label>
                    <input type="text" class="form-control" name="title" id="email" placeholder="Title" aria-describedby="sizing-addon2">
                </div>
                <div class="form-group hide anim" id="des-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Description:</label>
                    <textarea class="form-control" name="title"></textarea>
                </div>
                {!! Form::close() !!}
                <div id="dropzone" class="hide anim" style="visibility: hidden;
                    opacity: 0;">
                    <form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">
                      <div class="dz-message needsclick">
                        Drop images and videos here or click to upload.<br>
                        <span class="note needsclick">(Images and Videos max size <strong>30mb</strong>.)</span>
                      </div>
                    </form>
                </div>            
            </div>


	      </div>
	      <div class="modal-footer clearfix">
	        <a id="login-btn-1" class="btn btn-warning pull-right login-btn">Post</a>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	
</div><!-- /.modal -->