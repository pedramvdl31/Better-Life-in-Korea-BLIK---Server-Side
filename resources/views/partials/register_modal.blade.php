<div class="modal fade" id="register-modal">
	{!! Form::open(array('action' => 'UsersController@postRegistration','id'=>'reg-form', 'class'=>'','role'=>"form")) !!}
	<style type="text/css">
	.error-feedback{
		color: #d9534f;
	}

	</style>
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Signup</h4>
	      </div>
	      <div class="modal-body">

			<div class="form-group">
	      		<input type="text" class="form-control form-control-login" id="email" name="email" placeholder="Email *" aria-describedby="sizing-addon2">
	      		<span class="error-feedback email-error-feedback hide">Not Matched</span>
			</div>
			<div class="form-group">
				<input type="password" class="form-control form-control-login" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">
				<span class="error-feedback password-error-feedback hide">Not Matched</span>	
			</div>
			<div class="form-group">
				<input type="password" class="form-control form-control-login"  name="password_again" id="password_again" placeholder="Re-Enter Password" aria-describedby="sizing-addon2">
				<span class="error-feedback password-again-error-feedback hide">Not Matched</span>
			</div>
	      </div>
	      <div class="modal-footer clearfix">
			<img class="hide" id="validating" src="/assets/images/icons/gif/loading1.gif" width="20px;">
	        <a class="btn btn-social btn-facebook" href="auth/facebook">
        		<span class="fa fa-facebook"></span>  Sign in with Facebook
        	</a>
	        <a class="btn modal-btn btn-warning " id="submit-btn">Register</a>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	{!! Form::close() !!}
</div><!-- /.modal -->