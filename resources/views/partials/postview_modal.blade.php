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
  .my-item{
    cursor: zoom-in;
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
                

              <div id="postview-data">
              
              </div>

              <!-- MAP -->
              <div class="form-group">
                <div id="qkpost-map-container" style="width:80%;margin:0 auto;margin-top: 15px !important;">
                  <div style="height:300px" id="map-post-view"></div>                        
                </div>
              </div>
              <!-- DRIVE-TO BTN WRAPPER -->
              <div id="dtw"></div>

            </div>
            <div class="text-center vwad-loading">
                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="font-size:25px"></i>
            </div>
            <div class="fbc"></div>
	      </div>
	      <div class="modal-footer clearfix">

          <form>
            <span id="fbShareWrap"></span>
            <a id="atwl-btn" class="btn btn-warning add-to-wishlist" data="" role="button">Add to Wishlist</a>
          </form>
        </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	
</div><!-- /.modal -->




