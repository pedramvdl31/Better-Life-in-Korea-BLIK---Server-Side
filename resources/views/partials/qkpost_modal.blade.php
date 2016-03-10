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
    		padding: 2px !important;
    		margin: 0 !important;
    	}
        .modal{
            padding-right: 0 !important;
        }
    }

    /* Custom, iPhone Retina */ 
    @media only screen and (max-width : 320px) {
        .qkpost_dialog{
    		width: 100% !important;
    		padding: 2px !important;
    		margin: 0 !important;
    	}  
        .modal{
            padding-right: 0 !important;
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
    ._required{
        font-weight: 300;
        font-size: 12px;        
    }

.col-no-padding{
    padding-left: 0;
    padding-right: 0;
}
</style>
<div class="modal fade" id="qkpost-modal">
	{!! Form::open(array('route' => 'qkpost-process', 'class'=>'','role'=>"form",'id'=>'pkpost-form', 'style'=>'height:100%')) !!}
	  <div class="modal-dialog qkpost_dialog" style="width: 44%;margin-top: 10px;height: 563px">
	    <div class="modal-content" style="height: 100%">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">It will just take few minuts...</h4>
	      </div>
	      <div class="modal-body" style="height: 78%;overflow: auto;padding-bottom: 0;margin-bottom: 5px;">
            <div class="body-wrapsp">

                <div class="form-group" id="cat-wrap">
                    <label>Select Category:</label>
                    {!! Form::select('cat',$cats ,null, ['id'=>'cats','class'=>'form-control qp-selects','status'=>false]) !!}
                </div>
                <div class="form-group hide anim" id="subcat-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Select Sub Category:</label>
                    <select class="form-control qp-selects" id="subcat-select" name="subcat">
                    </select>
                </div>


                <div class="form-group hide anim 2t-wrap" style="width: 100%;visibility: hidden;
                    opacity: 0;">
                    <style type="text/css">
                        .eac-description{
                            width: 100% !important;
                        }
                    </style>
                    <label>Select City:</label>
                    <input name="city" class="form-control pk-form" id="cities-autocomplete" placeholder="Search Your City" style="width: 100%"  aria-describedby="sizing-addon2" />
                </div>

                <div class="form-group hide anim 2t-wrap" id="title-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Title: <span class="_required">*required</span></label>
                    <input type="text" class="form-control  pk-form" name="title" id="email" placeholder="Title" aria-describedby="sizing-addon2">
                </div>


                <div class="form-group 2t-wrap hide anim" id="des-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Description: <span class="_required">*required</span></label>
                    <textarea style="resize:vertical;" class="form-control pk-form" name="description"></textarea>
                </div>
                <div id="file-div"></div>
                {!! Form::close() !!}
                <div id="dropzone" class="hide anim 2t-wrap col-md-6 col-no-padding" style="visibility: hidden;
                    opacity: 0;
                    margin-bottom: 10px;
                    ">
                    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_image">
                      <div class="dz-message needsclick">
                        Drop images and videos here or click to upload.<br>
                        <span class="note needsclick">(Images and Videos max size <strong>30000000mb</strong>.)</span>
                      </div>
                    </form>
                </div>            
                <div id="dropzone" class="hide anim 2t-wrap col-md-6 col-no-padding" style="visibility: hidden;
                    opacity: 0;">
                    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_video">
                      <div class="dz-message needsclick">
                        Drop images and videos here or click to upload.<br>
                        <span class="note needsclick">(Images and Videos max size <strong>30000000mb</strong>.)</span>
                      </div>
                    </form>
                </div>            
            </div>


	      </div>
	      <div class="modal-footer clearfix">
	        <a id="qk-post-btn" class="btn btn-warning pull-right" disabled="disabled">Post</a>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	
</div><!-- /.modal -->