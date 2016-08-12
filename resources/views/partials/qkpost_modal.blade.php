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
    #qkpost-map-container{
        margin-top: 15px;
    }
    .col-no-padding{
        padding-left: 0;
        padding-right: 0;
    }
</style>
<div class="modal fade" id="qkpost-modal">
	{!! Form::open(array('route' => 'qkpost-process', 'class'=>'','role'=>"form",'id'=>'pkpost-form', 'style'=>'height:100%')) !!}
	  <div class="modal-dialog qkpost_dialog" style="width: 94%;margin-top: 10px;height: 563px">
	    <div class="modal-content" style="height: 100%">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">It will just take few minuts...</h4>
	      </div>
	      <div class="modal-body" style="height: 78%;overflow: auto;padding-bottom: 0;margin-bottom: 5px;">
            <div class="body-wrapsp">
                <div class="form-group" id="cat-wrap">
                    {!! Form::select('cat',$cats ,null, ['id'=>'cats','class'=>'form-control qp-selects','status'=>false]) !!}
                </div>
                <div class="form-group hide anim" id="subcat-wrap" style="visibility:hidden;opacity:0">
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
                    <select class="form-control" name="city" id="city-select">
                        <option value="">Select Your City</option>
                        <option value="1" lat="36.99231316337308" lng="127.1126876079345">Pyeongtaek Downtown</option>
                        <option value="2" lat="37.456306800434405" lng="126.70522765767214">Incheon</option>
                        <option value="3" lat="36.96916529999999" lng="127.03331281349188">Dongchang-ri</option>
                        <option value="4" lat="36.81516335686547" lng="127.1138939">Cheonan</option>
                        <option value="5" lat="37.04250471819789" lng="127.08627511349187">Songtan</option>
                        <option value="6" lat="36.96087981734297" lng="127.04473080000002">Anjeong-ri</option>
                    </select>
                </div>



                <style type="text/css">
                                    
                    @media only screen and (max-width : 850px) {
                        #type-selector{
                            left: 136px !important;
                            top: 32px !important;
                            width: 300px !important;
                            border-radius: 0 !important;
                        }

                    }
                    @media only screen and (max-width : 620px) {
                        #pac-input{
                            left:0 !important;
                            width: calc(100% - 24px) !important;
                        }
                        #type-selector{
                            left: 12px !important;
                            width: calc(100% - 24px) !important;
                        }
                        .gmnoprint.gm-style-mtc{
                            display: none;
                        }
                    }

                </style>



                <div class="form-group hide anim 2t-wrap" style="float:left;width: 100%;visibility: hidden;
                    opacity: 0;">
                    <input type="hidden" id="qkp-lat" name="lat"/>
                    <input type="hidden" id="qkp-lng" name="long" />
                    <div id="qkpost-map-container" style="width:80%;margin:0 auto">
                        <input id="pac-input" class="controls" type="text"
                            placeholder="Enter a location">

                        <div id="type-selector" class="controls">
                        <input type="radio" name="type" id="changetype-all" checked="checked">
                        <label for="changetype-all">All</label>

                        <input type="radio" name="type" id="changetype-establishment">
                        <label for="changetype-establishment">Establishments</label>

                        </div>
                        <div style="height:300px" id="map"></div>                        
                    </div>


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
                        Upload Images&nbsp<i class="glyphicon glyphicon-plus"></i><br>
                        <span class="note needsclick">(Images and Videos max size <strong>5mb</strong>.)</span>
                      </div>
                    </form>
                </div>            
                <div id="dropzone" class="zones hide anim 2t-wrap col-md-6 col-no-padding" style="visibility: hidden;
                    opacity: 0;">
                    <form style="overflow: auto;" accept="video/*" action="/upload-ads" class="dropzone needsclick dz-clickable" id="post_upload_zone_video">
                      <div class="dz-message needsclick">
                        Upload Videos&nbsp<i class="glyphicon glyphicon-plus"></i><br>
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