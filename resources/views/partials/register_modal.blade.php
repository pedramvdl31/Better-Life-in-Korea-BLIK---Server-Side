<div class="modal fade" id="register-modal">
	{!! Form::open(array('action' => 'UsersController@postRegistration','id'=>'reg-form', 'class'=>'','role'=>"form")) !!}
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Signup</h4>
	      </div>
	      <div class="modal-body">

			<div class="form-group">
	      		<input type="text" class="form-control form-control-login" id="email" name="email" placeholder="Email *" aria-describedby="sizing-addon2">
			</div>
			<div class="form-group">
				<input type="text" class="form-control form-control-login" name="username" id="username" placeholder="Username" aria-describedby="sizing-addon2">
			</div>
			<div class="form-group">
				<input type="password" class="form-control form-control-login" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">			
			</div>
			<div class="form-group">
				<input type="password" class="form-control form-control-login"  name="password_again" id="password_again" placeholder="Re-Enter Password" aria-describedby="sizing-addon2">
			</div>

	      </div>
	      <div class="modal-footer clearfix">
    		<a class="btn btn-link-1 btn-link-1-facebook" href="auth/facebook">
        		<i class="fa fa-facebook"></i>  Sign Up with Facebook
        	</a>
	        <button type="submit" id="login-btn-1" class="btn btn-warning pull-right login-btn">Register</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	{!! Form::close() !!}
</div><!-- /.modal -->