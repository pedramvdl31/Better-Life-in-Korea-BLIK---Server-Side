$(document).ready(function(){
	mainf.pageLoad();
	mainf.events();
});
mainf = {
	pageLoad: function() {
		// getContent();
		if ( (location.hash == "#_=_" || location.href.slice(-1) == "#_=_") ) {
		    removeHash();
		}
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
		$('[data-toggle="tooltip"]').tooltip();

		$('.body-wrapp').slimScroll({
        	height: '100%'
    	});

		Dropzone.autoDiscover = false;
		  $('#post_upload_zone_image').dropzone({ 
		    url: "/upload-ads-tmp",
		    paramName: "file",
		    maxFilesize: 10,
		    acceptedFiles: "image/*",
		    maxFiles: 100,
		    addRemoveLinks: true,
		    init: function() {
				 this.on('success', function(file, json) {
				   var new_name = json['img_name'];
				   var old_name = json['old_name'];
				   var base_type = json['base_type'];
				   var new_input = create_input(new_name,old_name,base_type);
				   $("#file-div").append(new_input);
				   $('#qk-post-btn').removeAttr('disabled');
				 });
				  
				 this.on('addedfile', function(file) {
				 	$('#qk-post-btn').attr('disabled','disabled');
				 });
				  
				 this.on('drop', function(file) {
				 });

				this.on("removedfile", function(file) {
					dropz_removefile(file);
				}); 
		    }
		 });
		Dropzone.autoDiscover = false;
		  $('#post_upload_zone_video').dropzone({ 
		    url: "/upload-ads-tmp",
		    paramName: "file",
		    maxFilesize: 10,
		    acceptedFiles: "video/*",
		    maxFiles: 100,
		    addRemoveLinks: true,
		    init: function() {
				 this.on('success', function(file, json) {
				   var new_name = json['img_name'];
				   var old_name = json['old_name'];
				   var base_type = json['base_type'];
				   var new_input = create_input(new_name,old_name,base_type);
				   $("#file-div").append(new_input);
				   $('#qk-post-btn').removeAttr('disabled');
				 });
				  
				 this.on('addedfile', function(file) {
				 	$('#qk-post-btn').attr('disabled','disabled');
				 });
				  
				 this.on('drop', function(file) {
				 });

				this.on("removedfile", function(file) {
					dropz_removefile(file);
				}); 
		    }
		 });

	//--------------------------------------
	//--------------------------------------

	var options = {

	    url: "/assets/cities.json",

	    categories: [{
	        listLocation: "Korea",
	        maxNumberOfElements: 4,
	        header: "South Korea"
	    }],

	    getValue: function(element) {
	        return element.name;
	    },

	    template: {
	        type: "description",
	        fields: {
	            description: "realName"
	        }
	    },

	    list: {
	        maxNumberOfElements: 8,
	        match: {
	            enabled: true
	        },
	        sort: {
	            enabled: true
	        }
	    },
	    theme: "square"
	};

	$("#cities-autocomplete").easyAutocomplete(options);

	//--------------------------------------
	//--------------------------------------

	},
	events: function() {
		$("#cats").change(function(){
			var t_v = $("option:selected", this).val();
			if (t_v != '0') {
				renew_subcat(t_v);
				$('#subcat-wrap').removeClass('hide');
				setTimeout(function(){
					$('#subcat-wrap').css('visibility','visible').css('opacity',1);
				}, 50);
			} else {
				$('.2t-wrap').css('visibility','hidden').css('opacity',0);
				$('#qk-post-btn').attr('disabled','disabled');
				setTimeout(function(){
					$('.2t-wrap').addClass('hide');
				}, 500);
			}
		});

		$("#subcat-select").change(function(){
			var t_v = $("option:selected", this).val();
			if (t_v != '0') {
				$('.2t-wrap').removeClass('hide');
				setTimeout(function(){
					$('.2t-wrap').css('visibility','visible').css('opacity',1);
					$('#qk-post-btn').removeAttr('disabled');
				}, 50);
			} else {
					$('.2t-wrap').css('visibility','hidden').css('opacity',0);
					$('#qk-post-btn').attr('disabled','disabled');
				setTimeout(function(){
					$('.2t-wrap').addClass('hide');
				}, 500);
			}
		});
        $(document).on('click','.login-btn',function(){
			$('#login-modal').modal('show');
        });
        $(document).on('click','.logout-btn',function(){
			$('#logout-modal').modal('show');
        });
        $(document).on('click','.reg-btn',function(){
			$('#register-modal').modal('show');
        });
        $(document).on('click','.qkpost',function(){
        	var _auth = parseInt($('#_auth').attr('data'));
        	if (_auth == 1) {
				$('#qkpost-modal').modal('show');
        	} else {
        		$('#login-modal').modal('show');
        	}
        });
        $('#submit-btn').click(function(){
			var reg_form = $('#reg-form').serialize();
			requestm.form_validate(reg_form);
		});
        $('#qk-post-btn').click(function(){
			var _form = $('#pkpost-form').serialize();
			requestm.process_qkpost(_form);
		});
    }
}
requestm = {
	process_qkpost: function(_form) {
		$('._required').css('color','inherit');
		$('#validating').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/process-qkpost',
			{
				"_token": token,
				"_form":_form
			},
			function(result){
				var status = result.status;
				switch(status){					
		 			case 200:
		 				$('#qkpost-modal').modal('hide');
		 				setTimeout(function(){ 
		 					$('#success-modal').modal('show');
		 				 }, 100);
		 				setTimeout(function(){ 
		 					$('#success-modal').modal('hide');
		 				 }, 1500);
		 				clear_qp_modal();
		 			break;

		 			case 400:
		 				$('._required').css('color','red');
		 			break;

				}
			}
			);
	},
	form_validate: function(reg_form) {
		$('#validating').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/users/validate',
			{
				"_token": token,
				"reg_form":reg_form
			},
			function(result){
				$('#validating').addClass('hide');
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
function create_input(name,old_name,base_type) {
	var count = $(document).find('.posted-files').length;
	return '<input old-name="'+old_name+'" class="posted-files" name="posted_files['+count+']['+base_type+'][name]" type="hidden" value="'+name+'"/>';
}

function getContent(timestamp)
{
    var queryString = {'timestamp' : timestamp};

    $.ajax(
        {
            type: 'GET',
            url: '/users/get-content',
            data: queryString,
            success: function(data){
                // put result data into "obj"
                var obj = jQuery.parseJSON(data);
                // put the data_from_file into #response
                $('#response').html(obj.data_from_file);
                // call the function again, this time with the timestamp we just got from server.php
                getContent(obj.timestamp);
            }
        }
    );
}
function renew_subcat(t_v)
{
	var select_html = '<option value="0">Select Sub Category</option>';
	switch(t_v){
		case "1":
			select_html += 	'<option value="1">Agencies</option>'+
							'<option value="2">Private</option>';
		break;		
		case "2":
			select_html += 	'<option value="1">Dealership</option>'+
							'<option value="2">Private</option>'+
							'<option value="3">Sofa Document Fee</option>'+
							'<option value="4">Insurance</option>';
		break;		
		case "3":
			select_html += 	'<option value="1">Cleaning</option>'+
							'<option value="2">Services</option>'+
							'<option value="3">Moving Company</option>'+
							'<option value="4">Medical</option>'+
							'<option value="5">CellPhone</option>';
		break;		
		case "4":
			select_html += 	'<option value="1">Agencies</option>'+
							'<option value="2">Private</option>';
		break;		
		case "5":
			select_html += 	'<option value="1">Agencies</option>'+
							'<option value="2">Private</option>';
		break;		
	}
	$('#subcat-select').html(select_html);
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

function dropz_removefile(file) {
	var name = file['name'];
	var poste_input = $('.posted-files[old-name="'+name+'"]');
	if (poste_input.length > 0) {
		poste_input.remove();
	} else {
		alert('Somthing Went Wrong!');
	}
}

function clear_qp_modal() {
	$('.pk-form').val('');
	$(".qp-selects").val("0");
	Dropzone.forElement("#post_upload_zone_image").removeAllFiles(true);
	Dropzone.forElement("#post_upload_zone_video").removeAllFiles(true);
	$('#file-div').html('');
}



