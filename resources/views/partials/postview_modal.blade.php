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
<div class="modal fade" id="postview-modal" style="padding-left:0 !important">
	  <div class="modal-dialog qkpost_dialog" style="width: 50%;margin-top: 10px;">
	    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
	      <div class="modal-body" style="overflow: auto;">
            <div class="postview_modal_body">
                
            </div>
            <div class="text-center vwad-loading">
                <img src="/assets/images/icons/gif/loading1.gif" width="35px;">
                Please Wait...
            </div>
            <div class="fbc"></div>
	      </div>
	      <div class="modal-footer clearfix">
	        <a id="atwl-btn" class="btn btn-warning pull-right add-to-wishlist" data="">Add to Wishlist</a>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	
</div><!-- /.modal -->