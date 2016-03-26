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

	$("#qkpost-modal").on("shown.bs.modal", function () {

	});

	  //       $('#somecomponent').locationpicker(
			// {
			//     location: {latitude: 37.5551069, longitude: 126.97069110000007},
			//     locationName: "",
			//     radius: 0,
			//     zoom: 15,
			//     scrollwheel: true,
			//     inputBinding: {
			//         latitudeInput: null,
			//         longitudeInput: null,
			//         radiusInput: null,
			//         locationNameInput: $('#us2-address')
			//     }
			// }
			// );

	    $('#us2').locationpicker({
	    location: {latitude: 37.5551069, longitude: 126.97069110000007},   
	    radius: 0,
	    inputBinding: {
	        latitudeInput: $('#us2-lat'),
	        longitudeInput: $('#us2-lon'),
	        radiusInput: $('#us2-radius'),
	        locationNameInput: $('#us2-address')
	    },
	    enableAutocomplete: true,
	    });

		$('#nav').affix({
			offset: {
		    	top: 80
		  	}
		});
		$("#nav").on('affix.bs.affix', function(){
	    	$('.main-container').css('margin-top','50px');
	    });

	    $("#nav").on('affix-top.bs.affix', function(){
	    	$('.main-container').css('margin-top','0');
	    });

		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
		$('[data-toggle="tooltip"]').tooltip();

		$('.body-wrapp').slimScroll({
        	height: '100%'
    	});
        // var es = new EventSource("/update-messages");
        // es.addEventListener("message", function(e) {
        // 	console.log(e.data['time']);
        // }, false);
		Dropzone.autoDiscover = false;
		  $('#post_upload_zone_image').dropzone({ 
		    url: "/upload-ads-tmp",
		    paramName: "file",
		    maxFilesize: 5,
		    acceptedFiles: "image/*",
		    maxFiles: 10,
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
		    maxFilesize: 30,
		    acceptedFiles: "video/*",
		    maxFiles: 3,
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

	    url: "/assets/cities2.json",

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
			var t_v = $("#cats option:selected").val();
			if (t_v != '0') {
				$('.subcats').addClass('hide');
				$('.subcats').attr('name','');
				$('#subcat-select-'+t_v).removeClass('hide');
				$('#subcat-select-'+t_v).attr('name','subcat');
				$('#subcat-wrap').removeClass('hide');
				setTimeout(function(){
					$('#subcat-wrap').css('visibility','visible').css('opacity',1);
				}, 50);
			} else {
				$('.subcats').addClass('hide');
				$('.2t-wrap').css('visibility','hidden').css('opacity',0);
				$('#subcat-wrap').css('visibility','hidden').css('opacity',0);
				$('#qk-post-btn').attr('disabled','disabled');
				setTimeout(function(){
					$('.2t-wrap').addClass('hide');
					$('#subcat-wrap').addClass('hide');
				}, 500);
			}
		});

		$(".subcats").change(function(){
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
        $(document).on('click','.view-ad',function(){
			var this_id = $(this).attr('data');
			$('#atwl-btn').attr('data',this_id);
			findAndViewAd(this_id);
        });
        $(document).on('click','.qkpost',function(){
        	var _auth = parseInt($('#_auth').attr('data'));
        	if (_auth == 1) {
				$('#qkpost-modal').modal('show');
        	} else {
        		$('#login-modal').modal('show');
        	}
	    });
        $(document).on('click','.remove-ad-wl',function(){
        	$t_id = $(this).attr('data');
        	$('.modal-remove-btn').attr('data',$t_id);
        	$('#warning-modal').modal('show');
        });
        $('.modal-remove-btn').click(function(event){
        	$('#warning-modal').modal('hide');
        	$t_id = $(this).attr('data');
        	requestm.removeWishList($t_id);
		});

        $(document).on('click','.view-ad-wl',function(){
			var this_id = $(this).attr('data');
			findAndViewAd2(this_id);
        });

		$('#searchbar').keypress(function(event){
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    if(keycode == '13'){
		    	$tval = $(this).val();
    			if (!$.isBlank($tval)) {
    				requestm.s_func_txt($tval);
            	}
		    }
		});

		$('#address-checkbox').click(function(event){
			var $this = $(this);
		    if ($this.is(':checked')) {
		    	$('#us2-lat').attr('name','lat');
		    	$('#us2-lon').attr('name','long');

				$('.address-wrap').removeClass('hide');
				lastCenter=_map.getCenter(); 
				google.maps.event.trigger(_map, "resize");
				_map.setCenter(lastCenter);
				setTimeout(function(){
					$('.address-wrap').css('visibility','visible').css('opacity',1);
				}, 500);		       
		    } else {
		    	$('#us2-lat').attr('name','');
		    	$('#us2-lon').attr('name','');

				$('.address-wrap').css('visibility','hidden').css('opacity',0);
				setTimeout(function(){
					$('.address-wrap').addClass('hide');
				}, 500);		       
		    }
		});
		
        $('#submit-btn').click(function(){
			var reg_form = $('#reg-form').serialize();
			requestm.form_validate(reg_form);
		});

        $('.tab-c').click(function(){
        	$('.tab-c').css('border','none');
        	$(this).css('border-bottom','1px solid white');
		});

        $('.tab-home').click(function(){
        	$('.all-tabs').addClass('hide');
        	$('.home-tab').removeClass('hide');
		});
        $('.tab-cat').click(function(){
        	$('.all-tabs').addClass('hide');
        	$('.cat-tab').removeClass('hide');
		});
		
		
		
		//menus
        $('.links').click(function(){
			var cat_id = $(this).attr('cat-id');
			var subcat_id = $(this).attr('subcat-id');
			$('.tab-c').css('border','none');
			$('.tab-home').css('border-bottom','1px solid white');
        	$('.cat-tab').addClass('hide');
        	$('.home-tab').removeClass('hide');

			var _this = $(this);
			requestm.refresh_ads(cat_id,subcat_id,_this);
		});
		$("#city-select-home").change(function(){
			var t_v = $("#city-select-home option:selected").val();
			if (t_v != '') {
				requestm.refresh_ads_city(t_v);
			}
		});
        $('#qk-post-btn').click(function(){
			var _form = $('#pkpost-form').serialize();
			requestm.process_qkpost(_form);
		});
        $('#back-to-wl').click(function(){
        	$(this).parents('.modal-footer').addClass('hide');
        	$('#wishlist-ad-content').addClass('hide');
        	$('.vwad-loading').addClass('hide');
        	$('.wl_modal_body').removeClass('hide');
		});
		 $(document).on('click','.add-to-wishlist',function(e){
        	e.preventDefault();
        	var _auth = parseInt($('#_auth').attr('data'));
        	if (_auth == 1) {
				var _data = $(this).attr('data');
				$(this).css('color','green');
				requestm.add_to_wishlist(_data);
        	} else {
        		$('.modal').modal('hide');
        		$('#login-modal').modal('show');
        	}
        });
        $('#view_wl').click(function(e){
        	e.preventDefault();
        	$('#wishlist-modal').modal('show');
		});


    }
}
requestm = {
	removeWishList: function(ad_id) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/remove-wishlist',
			{
				"_token": token,
				"ad_id":ad_id
			},
			function(result){
				var status = result.status;
				var wl_html = result.wl_html;
				switch(status){					
		 			case 200:
		 				$('#wishlist-table').html(wl_html);
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	refresh_ads: function(cat_id,subcat_id,_this) {
		_this.find('img').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/search-02',
			{
				"_token": token,
				"cat_id":cat_id,
				"subcat_id": subcat_id
			},
			function(result){
				_this.find('img').addClass('hide');
				var status = result.status;
				var ads = result.ads;
				var render = result.render;
				switch(status){					
		 			case 200:
		 				$('#ads-wrapper').html(ads['html']);
		 				$('#pagi').html('');
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	refresh_ads_city: function(city_id) {
		$('#img-city').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/search-03',
			{
				"_token": token,
				"city_id":city_id
			},
			function(result){
				$('#img-city').addClass('hide');
				var status = result.status;
				var ads = result.ads;
				var render = result.render;
				switch(status){					
		 			case 200:
		 				$('#ads-wrapper').html(ads['html']);
		 				$('#pagi').html('');
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	s_func_txt: function(ttxt) {
		$('.search-loading').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/search-01',
			{
				"_token": token,
				"ttxt":ttxt
			},
			function(result){
				$('.search-loading').addClass('hide');
				var status = result.status;
				var ads = result.ads;
				switch(status){					
		 			case 200:
		 				$('#ads-wrapper').html(ads);
		 				$('#pagi').html('');
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	add_to_wishlist: function(data_id) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/store-wishlist',
			{
				"_token": token,
				"data_id":data_id
			},
			function(result){
				var status = result.status;
				switch(status){					
		 			case 200:

		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	vwad2: function(data_id) {
		$('.postview_modal_body').addClass('hide');
		$('.vwad-loading').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/prepare-ad',
			{
				"_token": token,
				"data_id":data_id
			},
			function(result){
				var status = result.status;
				var ad = result.ad;
				switch(status){					
		 			case 200:
		 				$('#wishlist-ad-content').removeClass('hide');
		 				$('#wishlist-ad-content').html(ad);
						$('.vwad-loading').addClass('hide');
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	vwad: function(data_id) {
		$('.postview_modal_body').addClass('hide');
		$('.vwad-loading').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/prepare-ad',
			{
				"_token": token,
				"data_id":data_id
			},
			function(result){
				var status = result.status;
				var ad = result.ad;
				var lat_long = result.lat_long;
				switch(status){					
		 			case 200:
						$('.postview_modal_body').removeClass('hide');
						$('.postview_modal_body').html(ad);
						$('.vwad-loading').addClass('hide');
						$('.my-container').sortablePhotos({
						  selector: '> .my-item',
						  sortable: 0,
						  padding: 1
						});
						$('#us2-view').locationpicker({
					    location: {latitude: lat_long['lat'], longitude: lat_long['long']},   
					    radius: 0,
					    inputBinding: {
					        latitudeInput: $('#us2-lat-view'),
					        longitudeInput: $('#us2-lon-view'),
					        locationNameInput: $('#us2-address-view')
					    }
					    });
					    lastCenter=_map.getCenter(); 
						google.maps.event.trigger(_map, "resize");
						_map.setCenter(lastCenter);
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	process_qkpost: function(_form) {
		$('._required').css('color','inherit');
		$('#validating').removeClass('hide');
		$('#pos-gif').removeClass('hide');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/process-qkpost',
			{
				"_token": token,
				"_form":_form
			},
			function(result){
				$('#pos-gif').addClass('hide');
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
		 				$('body').css('padding-right','0')
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

function findAndViewAd(this_id)
{
	$('#postview-modal').modal('show');
	requestm.vwad(this_id);
}
function findAndViewAd2(this_id)
{
	$('.wl_modal_body').addClass('hide');
	$('.vwad-loading').removeClass('hide');
	$('.wl-footer').removeClass('hide');
	requestm.vwad2(this_id);
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
	

	$('.address-wrap').addClass('hide');
	$('.address-wrap').css('visibility','hidden').css('opacity','0');
	$('#address-checkbox').attr('checked', false);

	$('#subcat-wrap').addClass('hide');
	$('#subcat-wrap').css('visibility','hidden').css('opacity','0');

	$('.2t-wrap').addClass('hide');
	$('.2t-wrap').css('visibility','hidden').css('opacity','0');

	$('#title-wrap').addClass('hide');
	$('#title-wrap').css('visibility','hidden').css('opacity','0');
	
	$('#des-wrap').addClass('hide');
	$('#des-wrap').css('visibility','hidden').css('opacity','0');
	
	$('.zones').addClass('hide');
	$('.zones').css('visibility','hidden').css('opacity','0');

	$('.pk-form').val('');
	$(".qp-selects").val("0");
	$("#city-select").val("0");

	Dropzone.forElement("#post_upload_zone_image").removeAllFiles(true);
	Dropzone.forElement("#post_upload_zone_video").removeAllFiles(true);
	$('#file-div').html('');
}

