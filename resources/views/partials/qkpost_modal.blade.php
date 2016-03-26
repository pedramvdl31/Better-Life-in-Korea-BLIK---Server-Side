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
                <div class="form-group hide anim" id="subcat-wrap" style="visibility:hidden;opacity:0">
                    <label>Select Sub Category:</label>
                    <select class="form-control qp-selects subcats " id="subcat-select-1" >
                        <option value="0">Select Sub Category</option>
                        <option value="1">Agencies</option>
                        <option value="2">Private</option>
                    </select>
                    <select class="form-control qp-selects subcats " id="subcat-select-2" >
                        <option value="0">Select Sub Category</option>
                        <option value="1">Asian</option>
                        <option value="2">Italian</option>
                        <option value="3">Western</option>
                        <option value="4">Mexican</option>
                        <option value="5">Other</option>
                    </select>
                    <select class="form-control qp-selects subcats " id="subcat-select-3" >
                        <option value="0">Select Sub Category</option>
                        <option value="1">Dealership</option>
                        <option value="2">Private</option>
                        <option value="3">Sofa Document Fee</option>
                    </select>
                    <select class="form-control qp-selects subcats" id="subcat-select-4" >
                        <option value="0">Select Sub Category</option>
                        <option value="1">Cleaning</option>
                        <option value="2">Services</option>
                        <option value="3">Moving Company</option>
                        <option value="5">CellPhone</option>
                    </select>
                    <select class="form-control qp-selects subcats " id="subcat-select-5" >
                        <option value="0">Select Sub Category</option>
                        <option value="1">Agencies</option>
                        <option value="2">Private</option>
                    </select>
                    <select class="form-control qp-selects subcats " id="subcat-select-6" >
                        <option value="0">Select Sub Category</option>
                        <option value="1">Agencies</option>
                        <option value="2">Private</option>
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
                    <select class="form-control" name="city" id="city-select">
                        {!!$cities!!}
                    </select>
                </div>
                <div class="form-group hide anim 2t-wrap" style="width: 100%;visibility: hidden;
                    opacity: 0;">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="address-checkbox"> Add Address (optional)
                    </label>
                  </div>
                </div>
                <div class="form-group hide anim address-wrap" style="width: 100%;visibility: hidden;
                    opacity: 0;">
                    <label>Address:</label>
                    <input type="text" class="form-control" id="us2-address" />
                    <input type="hidden" id="us2-lat"/>
                    <input type="hidden" id="us2-lon"/>
                    <div id="us2" style="width: 90%; height: 400px;margin: 10px auto;"></div>
                </div>


                <div class="form-group hide anim 2t-wrap" id="title-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Title: <span class="_required">*required</span></label>
                    <input type="text" class="form-control pk-form" name="title" id="email" placeholder="Title" aria-describedby="sizing-addon2">
                </div>
                <style type="text/css">
                .dropzone{
                    margin: 2px;
                }
                </style>

                <div class="form-group 2t-wrap hide anim" id="des-wrap" style="visibility: hidden;
                    opacity: 0;">
                    <label>Description: <span class="_required">*required</span></label>
                    <textarea style="resize:vertical;" class="form-control pk-form" name="description"></textarea>
                </div>
                <div id="file-div"></div>
                {!! Form::close() !!}
                <div id="dropzone" class="zones hide anim 2t-wrap col-md-6 col-no-padding" style="visibility: hidden;
                    opacity: 0;
                    margin-bottom: 10px;
                    ">
                    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_image">
                      <div class="dz-message needsclick">
                        Upload Images<br>
                        <span class="note needsclick">(Images and Videos max size <strong>5mb</strong>.)</span>
                      </div>
                    </form>
                </div>            
                <div id="dropzone" class="zones hide anim 2t-wrap col-md-6 col-no-padding" style="visibility: hidden;
                    opacity: 0;">
                    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_video">
                      <div class="dz-message needsclick">
                        Upload Videos<br>
                        <span class="note needsclick">(Images and Videos max size <strong>30mb</strong>.)</span>
                      </div>
                    </form>
                </div>            
            </div>


	      </div>
	      <div class="modal-footer clearfix">
	           <a id="qk-post-btn" class="btn btn-warning pull-right" disabled="disabled">Post</a>
              <div id="pos-gif" class="pull-right hide" style="line-height: 32px;
                margin-right: 10px;">
                <img src="/assets/images/icons/gif/loading1.gif" width="20px;">
              </div>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	
</div><!-- /.modal -->