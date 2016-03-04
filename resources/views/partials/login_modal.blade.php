<div class="modal fade" id="login-modal">
	{!! Form::open(array('action' => 'UsersController@postLoginModal', 'class'=>'','role'=>"form",'id'=>'login-form-1')) !!}
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Login</h4>
	      </div>
	      <div class="modal-body">
			<div class="form-group">
				<input type="text" class="form-control form-control-login" name="email" id="email" placeholder="Email" aria-describedby="sizing-addon2">
			</div>
			<div class="form-group">
				<input type="password" class="form-control form-control-login" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">			
			</div>
			<div class="checkbox">
			  <label><input name="remember" type="checkbox" value="">Remember me</label>
			</div>
	        <a href="password/email" class="a-style" id="forgot"> I forgot my password</a>
	      </div>
	      <div class="modal-footer clearfix">
	        <a class="btn btn-social btn-facebook" href="auth/facebook">
        		<span class="fa fa-facebook"></span>  Sign in with Facebook
        	</a>
	        <button type="submit" id="login-btn-1" class="btn btn-warning pull-right login-btn">Login</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	{!! Form::close() !!}
</div><!-- /.modal -->