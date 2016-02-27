$(document).ready(function(){
	mainf.pageLoad();
	mainf.events();

});
mainf = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});


	},
	events: function() {

        $(document).on('click','.login-btn',function(){
			$('#login-modal').modal('show');
        });
        $(document).on('click','.logout-btn',function(){
			$('#logout-modal').modal('show');
        });
        $(document).on('click','.reg-btn',function(){
			$('#register-modal').modal('show');
        });
        $('#submit-btn').click(function(){
			var reg_form = $('#reg-form').serialize();
			requestm.form_validate(reg_form);
		});
    }
}
requestm = {
	form_validate: function(reg_form) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/users/validate',
			{
				"_token": token,
				"reg_form":reg_form
			},
			function(result){
				var status = result.status;
				var call_back = result.validation_callback;
				reset_errors();
				view_errors(call_back);
			}
			);
	}
};
function mainff(url)
{

}
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function reset_errors()
{
	$('.error-feedback').addClass('hide');
	$('.form-group').removeClass('has-error');
}

function view_errors(data)
{
	var error_status = false;
	$.each(data, function (i, j) {
		var message = null;
 		switch(i){
 			case "email":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.email-error-feedback').removeClass('hide').html(message);
 				$('.email-error-feedback').parents('.form-group').addClass('has-error');
 			}
 			break;
 			case "password":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.password-error-feedback').removeClass('hide').html(message);
 				$('.password-error-feedback').parents('.form-group').addClass('has-error');

 			}
 			break;
 			case "password_again":
 			if (j['status'] == 400) {
 				error_status = true;
 				message = j['message'];
 				$('.password-again-error-feedback').removeClass('hide').html(message);
 				$('.password-again-error-feedback').parents('.form-group').addClass('has-error');
 			}
 			break;
 		}

	});
 		//IF THERE WAS NO ERRORS SUBMIT THE FORM
 		if (error_status == false) {
 			$('#reg-form').submit()
 		};

}
function removeHash() {
    var scrollV, scrollH, loc = window.location;
    if ('replaceState' in history) {
        history.replaceState('', document.title, loc.pathname + loc.search);
    } else {
        // Prevent scrolling by storing the page's current scroll offset
        scrollV = document.body.scrollTop;
        scrollH = document.body.scrollLeft;

        loc.hash = '';

        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scrollV;
        document.body.scrollLeft = scrollH;
    }
}
function addCommas(val) {

	while (/(\d+)(\d{3})/.test(val.toString())){
	      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	    }
	    return val;
}

(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);