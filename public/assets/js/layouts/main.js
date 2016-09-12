$(document).ready(function(){
	Components.InitiateApp();
	Components.EventHandler();
	Maps.ViewAdInit(37.554084,126.949903);
});

// COMPONENTS
Components = {
	InitiateApp: function() {
		InitFunctions.SetStates();
		InitFunctions.NavbarListener();
		InitFunctions.PageVisualSetup();
		InitFunctions.SetAjaxHeader();
		InitFunctions.ClearUrl();
		InitFunctions.WindowScrollListener();
		InitFunctions.InitiateDropZones();
		InitFunctions.InitiateAutoComplete();
	},
	EventHandler: function() {
		Listeners.Events();
	}
};

//FUNCTIONS
InitFunctions = {
	PageVisualSetup(){
		window.flag = 0;
		$('#nav').affix({
			offset: {
		    	top: 70
		  	}
		});
		$("#nav").on('affix.bs.affix', function(){
	    	$('#app-view').css('margin-top','50px');
	    });

	    $("#nav").on('affix-top.bs.affix', function(){
	    	$('#app-view').css('margin-top','0');
	    });


		$('[data-toggle="tooltip"]').tooltip();

		$('.body-wrapp').slimScroll({
        	height: '100%'
    	});
	},
	SetStates(){
		window.user_state = document.getElementById('user-status').value;
	},
	SetAjaxHeader(){
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	ClearUrl(){
		if ( (location.hash == "#_=_" || location.href.slice(-1) == "#_=_") ) {
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
	},
	WindowScrollListener(){
		$(window).scroll(function() {
		   if(($('#posts-page').scrollTop() + $('#posts-page').height() > $(document).height() - 100)&&flag==0) {
		   		if (GVar.scroll_load_more==1) {
			   		GVar.skip = GVar.skip+8;
					ServerRequests.get_ad(GVar.skip);
					flag=1;
					$('#loading-data').fadeIn();		   			
		   		} else {
		   			$('#no-ads').fadeIn();
		   		}
		   }
		});
	},
	BindMapToDiv(){
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
	},
	InitiateDropZones(){
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
				   var new_input = HelperFuncions.create_input(new_name,old_name,base_type);
				   $("#file-div").append(new_input);
				   // $('#qk-post-btn').removeAttr('disabled');
				 });
				  
				 this.on('addedfile', function(file) {
				 	// $('#qk-post-btn').attr('disabled','disabled');
				 });
				  
				 this.on('drop', function(file) {
				 });

				this.on("removedfile", function(file) {
					HelperFuncions.dropz_removefile(file);
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
				   var new_input = HelperFuncions.create_input(new_name,old_name,base_type);
				   $("#file-div").append(new_input);
				   $('#qk-post-btn').removeAttr('disabled');
				 });
				  
				 this.on('addedfile', function(file) {
				 	$('#qk-post-btn').attr('disabled','disabled');
				 });
				  
				 this.on('drop', function(file) {
				 });

				this.on("removedfile", function(file) {
					HelperFuncions.dropz_removefile(file);
				}); 
		    }
		 });
	},
	InitiateAutoComplete(){
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
	},
	NavbarListener(){
		$('#z').on('shown.bs.collapse', function () {
		  $(document).bind( "click", handler );
		})
		$('#z').on('hidden.bs.collapse', function () {
		  $(document).unbind( "click", handler );
		})
		var handler = function() {
			$(document).click(function(event) {
		        if (!$(event.target).hasClass("form-control")) {
			  		$('#z').collapse('hide');
		        }
			});
		};		
	}
};

//LISTENERS
Listeners = {
	Events(){
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
					// HelperFuncions.InitGoogleMap();
					Maps.PostAdInit();
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
	    $(document).on('click','#waze-drive-to',function(){
	    	window.location.href = "waze://?ll="+$(this).attr('lat')+","+$(this).attr('lng')+"&navigate=yes";
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
			$('.fbc').html('');
			HelperFuncions.findAndViewAd(this_id);
	    });
	    $(document).on('click','.qkpost',function(){
	    	var _auth = parseInt($('#_auth').attr('data'));
	    	if (_auth == 1) {
				$('#qkpost-modal').modal('show');

				var html = '<div id="map-form-wrapper"><input id="pac-input" class="controls" type="text"'+
							'placeholder="Enter a location">'+
							'<div id="type-selector" class="controls">'+
							'<input type="radio" name="type" id="changetype-all" checked="checked">'+
							'<label for="changetype-all">All</label>'+
							'<input type="radio" name="type" id="changetype-establishment">'+
							'<label for="changetype-establishment">Establishments</label>'+
							'</div></div>';

				$('#qkpost-map-container').append(html);


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
	    	ServerRequests.removeWishList($t_id);
		});
	    $(document).on('click','.view-ad-wl',function(){
			var this_id = $(this).attr('data');
			HelperFuncions.findAndViewAd2(this_id);
	    });
		$('#searchbar').keypress(function(event){
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    if(keycode == '13'){
		    	$tval = $(this).val();
				if (!HelperFuncions.isBlank($tval)) {
					ServerRequests.s_func_txt($tval);
	        	}
		    }
		});

	    $('#submit-btn').click(function(){
			var reg_form = $('#reg-form').serialize();
			ServerRequests.form_validate(reg_form);
		});

	    $('.tab-home').click(function(){
	    	$('.all-tabs').addClass('hide');
	    	$('.home-tab').removeClass('hide');
	    	$('.tab-cat').css('border-bottom','none');
	    	$('.tab-home').css('border-bottom','1px solid white');
		});
	    $('.tab-cat').click(function(){
	    	$('.all-tabs').addClass('hide');
	    	$('.cat-tab').removeClass('hide');
	    	$('.tab-home').css('border-bottom','none');
	    	$('.tab-cat').css('border-bottom','1px solid white');
		});
	    $('.links').click(function(){
			var cat_id = $(this).attr('cat-id');


			$('.tab-c').css('border','none');
			$('.tab-home').css('border-bottom','1px solid white');
	    	

			ServerRequests.refresh_ads(cat_id);
		});
		$("#city-select-home").change(function(){
			var t_v = $("#city-select-home option:selected").val();
			if (t_v != '') {
				$('#post-list').addClass('hide');
				ServerRequests.refresh_ads_city(t_v);
			}
		});
		$("#city-select").change(function(){
			var latlng = {};
			latlng.lat = parseFloat(this.options[this.selectedIndex].getAttribute('lat'));
			latlng.lng = parseFloat(this.options[this.selectedIndex].getAttribute('lng'));
			Maps.SetCenterLatLng(latlng);
		});
	    $('#qk-post-btn').click(function(){
			var _form = $('#pkpost-form').serialize();
			ServerRequests.process_qkpost(_form,document.getElementById("cats").value);
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
				ServerRequests.add_to_wishlist(_data);
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
};

//SERVER REQUESTS
ServerRequests = {
	get_ad: function(ad_num) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/get-adds',
			{
				"_token": token,
				"ad_num":ad_num,
				"category":GVar.category
			},
			function(result){
				var html = result.html_data['html'];
				$('#loading-data').fadeOut();

				//no more ads in this category
	 			if (html=='') {
	 				GVar.scroll_load_more = 0;
	 			}

				$('#ads-wrapper').append(result.html_data['html']);
				$('.updated_ads').fadeIn();
				$('.sin-ad').removeClass('updated_ads');
				flag=0;
			}
		);
	},
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
	refresh_ads: function(cat_id) {
		GVar.category = cat_id;
		//new category reset load more
		GVar.scroll_load_more = 1;
		document.getElementById("no-ads").style.display = 'none';
		$('.home-tab').removeClass('hide');
    	$('.cat-tab').addClass('hide');
    	$('#post-list').addClass('hide');
		$loading_in = HelperFuncions.create_loading_input();
		$('.post-loading').html($loading_in);
		$('.post-loading').removeClass('hide');
		$('#footer').css('margin-top','150px');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/search-02',
			{
				"_token": token,
				"cat_id":cat_id
			},
			function(result){
				$('.post-loading').addClass('hide');
				$('.post-loading').html('');
				$('#footer').css('margin-top','0');
				var status = result.status;
				var ads = result.ads;
				var render = result.render;
				switch(status){					
		 			case 200:
		 				$('#ads-wrapper').html(ads['html']);
		 				$('#post-list').removeClass('hide');
		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	refresh_ads_city: function(city_id) {
		$loading_in = HelperFuncions.create_loading_input();
		$('.post-loading').html($loading_in);
		$('.post-loading').removeClass('hide');
		$('#footer').css('margin-top','150px');
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/search-03',
			{
				"_token": token,
				"city_id":city_id
			},
			function(result){
				$('.post-loading').addClass('hide');
				$('.post-loading').html('');
				$('#footer').css('margin-top','0');
				var status = result.status;
				var ads = result.ads;
				var render = result.render;
				switch(status){					
		 			case 200:
		 				$('#ads-wrapper').html(ads['html']);
		 				$('#post-list').removeClass('hide');
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

		    	$('.all-tabs').addClass('hide');
		    	$('.home-tab').removeClass('hide');
		    	$('.tab-cat').css('border-bottom','none');
		    	$('.tab-home').css('border-bottom','1px solid white');

				$('.search-loading').addClass('hide');
				var status = result.status;
				var ads = result.ads;
				switch(status){					
		 			case 200:
		 				$('#ads-wrapper').html(ads);
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
		$('#postview-modal').modal('show');
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
				var ad_array = result.ad_array;
				var photos = ad_array.images_array;

				switch(status){					
		 			case 200:
			 			//LOAD FACEBOOK COMMENT
						var c_div = '<div class="fb-comments modalfc" '+
									'data-href="'+document.getElementById('web_root').value+'/posts/'+data_id+'"'+
									'data-width="100%" data-numposts="5"></div>';
						$('.fbc').html(c_div);

						//FACEBOOK SHARE BUTTON
						document.getElementById('fbShareWrap').innerHTML = ad_array['fbs'];

						FB.XFBML.parse();

		 				//init
		 				document.getElementById('postview-data').innerHTML = '';

		 				var new_html = "<div class='form-group break_all' id='pt'></div>"+
		 				"<div class='form-group break_all' id='pd'></div>"+
		 				"<div class='my-container' id='pi' style='opacity:0'></div>"+
		 				"<div class='' id='pv' style='opacity:0'></div>";
		 				document.getElementById('postview-data').innerHTML = new_html;
			 			document.getElementById('pt').innerHTML = ad_array['title'];
			 			document.getElementById('pd').innerHTML = ad_array['des'];
			 			// document.getElementById('pi').innerHTML = ad_array['images'];
			 			document.getElementById('pv').innerHTML = ad_array['videos'];
			 			document.getElementById('dtw').innerHTML = ad_array['drivebtn'];

					    var linksContainer = $('#pi');
					    var baseUrl;
					    var title = ad_array['title_txt'];
					    // Add the demo images as links with thumbnails to the page:
					    $.each(photos, function (index, photo) {
					      baseUrl = photo.src;
					      $('<a/>')
					        .append($('<img>').prop('src', baseUrl))
					        .prop('href', baseUrl)
					        .prop('title', title)
					        .addClass('my-item')
					        .attr('data-gallery', '')
					        .appendTo(linksContainer)
					    });

					    // FIT IMAGES c
						$(document).find('.my-container').sortablePhotos({
						  selector: '> .my-item',
						  sortable: 0,
						  padding: 3
						});

						//FULLSCREEN VIEWER
					    $('#pi').click(function(event){
						    event = event || window.event;
						    var target = event.target || event.srcElement,
						        link = target.src ? target.parentNode : target,
						        options = {
									index: link,
									// The number of elements to load around the current index:
									preloadRange: 2,
									// The transition speed for automatic slide changes, set to an integer
									// greater 0 to override the default transition speed:
									slideshowTransitionSpeed: 1,
									// The event object for which the default action will be canceled
									// on Gallery initialization (e.g. the click event to open the Gallery):
									event: event
								},
						        links = this.getElementsByTagName('a');
						    blueimp.Gallery(links, options);
						});		


					    //LOAD MAP
						if (ad_array['lat']!='' && ad_array['lng']!='') {
							Maps.ViewAdUpdate(parseFloat(ad_array['lat']),parseFloat(ad_array['lng']));
							$(document).find('#waze-info').tooltip();
		            	}

						//VIEW IT
		            	$('.postview_modal_body').removeClass('hide');
						$('.vwad-loading').addClass('hide');

						//REFRESH MAP
						Maps.ViewPostMapRefresh();


			 			setTimeout(function(){ 
		 					$('#pi').css('opacity','1');
		 					$('#pv').css('opacity','1');
		 				}, 500);

		 			break;

		 			case 400:
		 			break;

				}
			}
			);
	},
	process_qkpost: function(_form,cat_id) {
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
		 				//relaod-ads-to show new post
		 				ServerRequests.refresh_ads(cat_id);

		 				$('#qkpost-modal').modal('hide');
		 				setTimeout(function(){ 
		 					$('#success-modal').modal('show');
		 				 }, 100);
		 				setTimeout(function(){ 
		 					$('#success-modal').modal('hide');
		 				 }, 1500);
		 				HelperFuncions.clear_qp_modal();
		 				$('body').css('padding-right','0');

		 				//reload map search
		 				$('#map-form-wrapper').remove();
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
				HelperFuncions.reset_errors();
				HelperFuncions.view_errors(call_back);
			}
			);
	}
};

//HELPER FUNCTIONS
HelperFuncions = {
	isBlank(obj){
		return(!obj || $.trim(obj) === "");
	},
	InitGoogleMap(){
		$('#us2-lat').attr('name','lat');
		$('#us2-lon').attr('name','long');
		lastCenter=_map.getCenter(); 
		google.maps.event.trigger(_map, "resize");
		_map.setCenter(lastCenter);
	},
	reset_errors(){
		$('.error-feedback').addClass('hide');
		$('.form-group').removeClass('has-error');
	},
	findAndViewAd(this_id){
		ServerRequests.vwad(this_id);
	},
	findAndViewAd2(this_id){
		$('.wl_modal_body').addClass('hide');
		$('.vwad-loading').removeClass('hide');
		$('.wl-footer').removeClass('hide');
		ServerRequests.vwad2(this_id);
	},
	view_errors(data){
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
	},
	create_input(name,old_name,base_type) {
		var count = $(document).find('.posted-files').length;
		return '<input old-name="'+old_name+'" class="posted-files" name="posted_files['+count+']['+base_type+'][name]" type="hidden" value="'+name+'"/>';
	},
	dropz_removefile(file) {
		var name = file['name'];
		var poste_input = $('.posted-files[old-name="'+name+'"]');
		if (poste_input.length > 0) {
			poste_input.remove();
		} else {
			alert('Somthing Went Wrong!');
		}
	},
	clear_qp_modal() {
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
		$("#city-select").val("0");

		Dropzone.forElement("#post_upload_zone_image").removeAllFiles(true);
		Dropzone.forElement("#post_upload_zone_video").removeAllFiles(true);
		$('#file-div').html('');
	},
	create_loading_input() {
		var loading_html = 	'<div class="cssload-loader">'+
								'<div class="cssload-flipper">'+
								'<div class="cssload-front"></div>'+
								'<div class="cssload-back"></div>'+
								'</div>'+
							'</div>';
		return loading_html;
	}
};

//MAPS
Maps = {
	PostAdInit(){
		var myLatLng = {lat: 37.555172565547075, lng: 126.9708452528564};
		document.getElementById('qkp-lat').value = myLatLng.lat;
    	document.getElementById('qkp-lng').value = myLatLng.lng;
        window.map = new google.maps.Map(document.getElementById('map'), {
        	center: myLatLng,
			zoom: 12,    
			mapTypeControl: true,
			mapTypeControlOptions: {
			  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			  mapTypeIds: ['roadmap', 'satellite']
			},
			streetViewControl: false
        });
        // GOOGLE MAP RESPONSIVENESS
        google.maps.event.addDomListener(window, "resize", function() {
		 var center = map.getCenter();
		 google.maps.event.trigger(map, "resize");
		 map.setCenter(center); 
		});
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));
        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        //MARKER
        var infowindow = new google.maps.InfoWindow();
        window.PostAdMarker = new google.maps.Marker({
          map: map,
          position:myLatLng,
          draggable: true,
          anchorPoint: new google.maps.Point(0, -29)
        });
        //LOAD FROM CURRENT CITY
		var geocoder = new google.maps.Geocoder();
		//     navigator.geolocation.getCurrentPosition(function (position) {
		//        	initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		//        	map.setCenter(initialLocation);

		//        	marker.setPosition(initialLocation);

		//        	infowindow.setContent('<div><strong>Search or Drag Marker</strong></div>');
		// 	infowindow.open(map, marker);
		//     });
        //AFTER DRAG AND DROP SHOWS THE LAT AND LONG
        google.maps.event.addListener(PostAdMarker, 'dragend', function (event) {
			var latlng = {lat: this.getPosition().lat(), lng: this.getPosition().lng()};
	        geocoder.geocode({'location': latlng}, function(results, status) {
	          if (status === 'OK') {
			    if (results[1]) {
			    	// console.log(latlng);
			    	// saving to dom
			    	document.getElementById('qkp-lat').value = latlng.lat;
			    	document.getElementById('qkp-lng').value = latlng.lng;

					infowindow.setContent(results[1].formatted_address);
					document.getElementById('pac-input').value = results[1].formatted_address;
					// infowindow.open(map, marker);
	            } else {
	              window.alert('No results found');
	            }
	          } else {
	            window.alert('Geocoder failed due to: ' + status);
	          }
	        });
		});

        autocomplete.addListener('place_changed', function() {
			infowindow.close();
			PostAdMarker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				window.alert("Autocomplete's returned place contains no geometry");
				return;
			}
			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			}

	    	// saving to dom
	    	document.getElementById('qkp-lat').value = place.geometry.location.lat();
	    	document.getElementById('qkp-lng').value = place.geometry.location.lng();
			PostAdMarker.setPosition(place.geometry.location);
			PostAdMarker.setVisible(true);
			
			var address = '';
			if (place.address_components) {
				address = [
				  (place.address_components[0] && place.address_components[0].short_name || ''),
				  (place.address_components[1] && place.address_components[1].short_name || ''),
				  (place.address_components[2] && place.address_components[2].short_name || '')
				].join(' ');
			}

			infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address+'</div>');
			infowindow.open(map, PostAdMarker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
        	console.log(id);
        	console.log(types);
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-establishment', ['establishment']);
	},
	//initiation of posts map
	ViewAdInit(lat,lng){
		var myLatLng = {lat: lat, lng: lng};
        window.PostViewMap = new google.maps.Map(document.getElementById('map-post-view'), {
        	center: myLatLng,
			zoom: 15,    
			mapTypeControl: true,
			mapTypeControlOptions: {
			  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			  mapTypeIds: ['roadmap', 'satellite']
			},
			streetViewControl: true
        });

	    // var geolocationDiv = document.createElement('div');
	    // var geolocationControl = new GeolocationControl(geolocationDiv, PostViewMap);
	    // PostViewMap.controls[google.maps.ControlPosition.TOP_CENTER].push(geolocationDiv);


        // GOOGLE MAP RESPONSIVENESS
        google.maps.event.addDomListener(window, "resize", function() {
		 var center = PostViewMap.getCenter();
		 google.maps.event.trigger(PostViewMap, "resize");
		 PostViewMap.setCenter(center); 
		});

        //MARKER
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: PostViewMap,
          icon:GVar.flag_image,
          position:myLatLng,
          draggable: false,
          anchorPoint: new google.maps.Point(0, -29)
        });
	},
	ViewAdUpdate(lat,lng){
		var myLatLng = {lat: lat, lng: lng};
		PostViewMap.setCenter(myLatLng);
        var marker = new google.maps.Marker({
          map: PostViewMap,
          icon:GVar.flag_image,
          position:myLatLng,
          draggable: false,
          anchorPoint: new google.maps.Point(0, -29)
        });
	},
	ViewPostMapRefresh(){
		setTimeout(function(){ 
			var center = PostViewMap.getCenter();
			google.maps.event.trigger(PostViewMap, "resize");
			PostViewMap.setCenter(center); 
		 }, 500);
	},
	SetCenterLatLng(latlng){
		document.getElementById('qkp-lat').value = latlng.lat;
    	document.getElementById('qkp-lng').value = latlng.lng;
		map.setCenter(latlng);
		PostAdMarker.setPosition(latlng);
		google.maps.event.trigger(PostViewMap, "resize");
	}
}
//GLOBAL VARIABLES
GVar = {
	'take':8,
	'skip':0,
	'category':0,
	'scroll_load_more':1,
	'flag_image':'/assets/images/icons/beachflag.png'
}

// function GeolocationControl(controlDiv, map) {

//     // Set CSS for the control button
//     var controlUI = document.createElement('div');
//     controlUI.style.backgroundColor = '#444';
//     controlUI.style.borderStyle = 'solid';
//     controlUI.style.borderWidth = '1px';
//     controlUI.style.borderColor = 'white';
//     controlUI.style.height = '28px';
//     controlUI.style.marginTop = '5px';
//     controlUI.style.cursor = 'pointer';
//     controlUI.style.textAlign = 'center';
//     controlUI.title = 'Click to center map on your location';
//     controlDiv.appendChild(controlUI);

//     // Set CSS for the control text
//     var controlText = document.createElement('div');
//     controlText.style.fontFamily = 'Arial,sans-serif';
//     controlText.style.fontSize = '10px';
//     controlText.style.color = 'white';
//     controlText.style.paddingLeft = '10px';
//     controlText.style.paddingRight = '10px';
//     controlText.style.marginTop = '8px';
//     controlText.innerHTML = 'Center map on your location';
//     controlUI.appendChild(controlText);

//     // Setup the click event listeners to geolocate user
//     google.maps.event.addDomListener(controlUI, 'click', geolocate);
// }

// function geolocate() {

//     if (navigator.geolocation) {

//         navigator.geolocation.getCurrentPosition(function (position) {

//             var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

//             // Create a marker and center map on user location
//             marker = new google.maps.Marker({
//                 position: pos,
//                 draggable: true,
//                 animation: google.maps.Animation.DROP,
//                 map: PostViewMap
//             });

//             PostViewMap.setCenter(pos);
//         });
//     }
// }