<style type="text/css">
	    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {
        .smodal{
            width: 30% !important;
            margin: 30px auto;
        }
    }

    /* Extra Small Devices, Phones */ 
    @media only screen and (max-width : 480px) {
    	.smodal{
    		width: 50% !important;
    		margin: 30px auto;    
    	}
        .modal{
            padding-right: 0 !important;
        }
    }

    /* Custom, iPhone Retina */ 
    @media only screen and (max-width : 320px) {
        .smodal{
    		width: 60% !important;
    		margin: 30px auto;
    	}  
        .modal{
            padding-right: 0 !important;
        }
    }
</style>



<div class="modal fade" id="success-modal">
	  <div class="modal-dialog smodal" style="width: 15%;">
	    <div class="modal-content" style="background: rgb(255, 255, 255);border: 1px solid rgb(92, 184, 92);">
	      <div class="modal-body text-center">
	      	<span>
	      		<i class="glyphicon glyphicon-ok" style="color: #5cb85c;font-size: 31px;"></i>
	      		<br>
	      		<span style="font-weight: 900;">Successfully Posted!</span>
	      	</span>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->