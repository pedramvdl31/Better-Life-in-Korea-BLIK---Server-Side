$(document).ready(function(){
	chat.pageLoad();
	chat.events();
	chat.socket_io();
});
chat = {
	pageLoad: function() {

		$('#inner-chat-wrapper').slimScroll({
        	height: '285px'
    	});
		$('.inner-wrapper-child').slimScroll({
        	height: '218px'
    	});
    	

	    EmbedJS.setOptions({
		  	//An option when set to true will use marked.js to parse markdown and convert it to HTML.
		    // Make sure you have loaded marked.js before loading embed.js if this option is set to
		    // true else the plugin will throw an error.
		    marked                 : false,

		    // The option takes the marked.js options.
		    markedOptions          : {},

		    // Instructs the plugin whether or not to embed urls/ convert urls into HTML anchor tags.
		    link                   : true,

		    linkOptions            : {
		        // Same as the target attribute in html anchor tag . supports all html supported target values.
		        target : 'self',

		        // Accept array of extensions to be excluded from converting into HTML anchor links
		        exclude: ['pdf'],

		        // Same as the rel attribute.
		        rel    : ''
		    },

		    // Set to false if you want to disable converting emoji codes into actual emojis.
		    emoji                  : true,

		    // Include the names of custom emojis. Eg : ['emoji1', 'emoji2']. Now they can be
		    // used using :emoji1: :emoji2:
		    customEmoji            : [],
		    fontIcons              : true,
		    customFontIcons        : [],
		    highlightCode          : false,
		    videoJS                : false,
		    videojsOptions         : {
		        fluid  : true,
		        preload: 'metadata'
		    },
		    locationEmbed          : true,
		    mapOptions             : {
		        mode: 'place'
		    },
		    tweetsEmbed            : false,
		    tweetOptions           : {
		        maxWidth  : 550,
		        hideMedia : false,
		        hideThread: false,
		        align     : 'none',
		        lang      : 'en'
		    },
		    singleEmbed            : false,

		    // For using the open graph support (fetching site's meta data) , you will have
		    // to set up your own server due to cross domain restrictions. This option takes
		    // the api template as the string where url is a variable.
		    openGraphEndpoint      : null,

		    // Urls that have the array items in their string won't be processed by the
		    // openGraph API.
		    openGraphExclude       : [],

		    // Set to false if you want to disable embedding supported video formats.
		    videoEmbed             : true,
		    videoHeight            : null,
		    videoWidth             : null,
		    videoDetails           : true,
		    audioEmbed             : true,
		    excludeEmbed           : [],
		    inlineEmbed            : [],
		    inlineText             : true,
		    codeEmbedHeight        : 500,
		    vineOptions            : {
		        maxWidth  : null,
		        type      : 'postcard', //'postcard' or 'simple' embedding
		        responsive: true,
		        width     : 350,
		        height    : 460
		    },
		    // The google dev auth key needed if the user is using youtube embedding or
		    // google map embedding feature of the plugin.
		    googleAuthKey          : '',

		    soundCloudOptions      : {
		        height      : 160,
		        themeColor  : 'f50000', //Hex Code of the player theme color
		        autoPlay    : false,
		        hideRelated : false,
		        showComments: true,
		        showUser    : true,
		        showReposts : false,
		        visual      : false, //Show/hide the big preview image
		        download    : false //Show/Hide download buttons
		    },
		    videoClickClass        : 'ejs-video-thumb',
		    customVideoClickHandler: false,
		    beforeEmbedJSApply     : function () {},
		    afterEmbedJSApply      : function () {},
		    onVideoShow            : function () {},
		    onTweetsLoad           : function () {},
		    videojsCallback        : function () {},
		    onOpenGraphFetch       : function () {},
		    videoClickHandler      : function () {},
	        // singleEmbed:true,
	        onOpenGraphFetch: function(data) {
	            data.hybridGraph.success = data.error ? false : true;
	            return data.hybridGraph;
	        }
	    });

	},	
	socket_io: function() {
       //  socket.on('_forward', function(data) {
       //  	if (!$('.main-list-dock').hasClass('hide')) {
       //  		$('.main-list-dock').find('.have-msg').removeClass('hide');
       //  	}
       //  	if ($('.dockChild[uid="'+data['aid']+'"]').length == 1) {
	    		// var randtxt = randomString();
	      //  		var input_bubble = make_bubble_rc(data['msg'],randtxt);
	      //  		var dock_no = $('.dockChild[uid="'+data['aid']+'"]').attr('dock-no');
	      //  		$('._ctb'+dock_no).append(input_bubble);
	      //  		document.getElementById('ctb'+dock_no).scrollTop = 10000;
       //  	} else {
       //  		if ($('.conv-wrapper[tf="'+data['aid']+'"]').length == 1) {
       //  			$('.conv-wrapper[tf="'+data['aid']+'"]').find('.conv-c').removeClass('hide');
       //  		}
       //  	}
       //  });
	},
	events: function() {
		$('#cta1, #cta2').bind('input propertychange', function() {
		    var len = $(this).val().length;
		    if (len == 29) {
		    	var ch = parseInt($(this).css('height'));
		    	var nh = ch + 25;
		    	$(this).css('height',nh);
		    	var slimsc = $(this).parents('.wpNubButton-max:first').find('.slimScrollDiv:first');
		    	var ss = parseInt(slimsc.css('height'));
		    	var ns = ss - 25;
		    	slimsc.css('height',ns);
		    } else if(len < 29){
		    	$(this).css('height','52');
		    	var slimsc = $(this).parents('.wpNubButton-max:first').find('.slimScrollDiv:first');
		    	slimsc.css('height','218');
		    }
		});

		$('.cc1').click(function(){
			$('.dc1').attr('uid','');
			if ($('.dc2').hasClass('hide')) {
				$('.dc1').addClass('hide');
			} else {
				$('.dc2').addClass('hide');
			}
		});
		$('.cc2').click(function(){
			$('.dc2').attr('uid','');
			$('.dc2').addClass('hide');
		});

		$('.ChatTextArea').keypress(function(event){
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    if(keycode == '13'){
		    	var tinput = $(this).val();
		    	if (!$.isBlank(tinput)) {
		    		$(this).val('');
		    		var randtxt = randomString();
		       		var input_bubble = make_bubble(tinput,randtxt);
		       		var dock_no = $(this).parents('.dockChild').attr('dock-no');
		       		$('._ctb'+dock_no).append(input_bubble);
		       		document.getElementById('ctb'+dock_no).scrollTop = 10000;
		       		var fid = $(this).parents('.dockChild').attr('uid');
		       		request_c.snddata(tinput,fid,randtxt);

        		}
		    }
		});
		

		$('.conv-wrapper').click(function(){
			var tab_id = check_tabs();
			var cu = $('#ufh').val();
			var fu = $(this).attr('tf');
			var fe = $(this).find('._femail').text();
			var duplength = $(".dockChild[uid='"+fu+"']").length;
			$(this).find('.conv-c').addClass('hide');
			if (duplength==0) {
				if (typeof(cu) != "undefined" && cu !== null) {
			    	var _ar = $(window["cdata_"+cu+"_"+fu]);
			    	var msgs_html = prepare_html(_ar,cu,fu);
			    	$('._ctb'+tab_id).html(msgs_html);
			    	$('._ctb'+tab_id).scrollTop($('._ctb'+tab_id).scrollHeight);
			    	$('._cbnm'+tab_id).text(fe);
			    	$('.dc'+tab_id).attr('uid',fu);
				}
				$('.dc'+tab_id).removeClass('hide');
			}
			document.getElementById('ctb'+tab_id).scrollTop = 10000;

		});

		$('.nb-lb').click(function(){
			$(this).parents('.wpNubButton').find('.have-msg').addClass('hide');
			var parent = $(this).parents('.dock_wrapper:first');
			var type = parseInt(parent.attr('type'));
			parent.addClass('hide');
			switch(type) {
				case 0: 
					$('.dock-max').removeClass('hide');
				break;				
				case 1: 
					$('.dock-min').removeClass('hide');
				break;
				default:
				break;
			}
		});
	}
}
request_c = {
	snddata: function(tdata,fi,randtxt) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/data-update',
			{
				"_token": token,
				"tdata":tdata,
				"fi":fi
			},
			function(result){
				var status = result.status;
				var wl_html = result.wl_html;
				var aid = result.aid;
				switch(status){					
		 			case 200:
		 				$('.plane-'+randtxt).css('color','#5cb85c');
		                socket.emit("trans", { 
	                    	recip: fi,
	                    	msg: tdata,
	                    	aid:aid
	                     });            

		 			break;
		 			case 400:
		 			break;

				}
			}
			);
	}
};
function prepare_html(_ar,tu,tf) {
	var html = '';
	console.log(_ar);
	$.each(_ar, function(index,value) {
		if (index != 0) {
			var sdr = value['sdr'];
			if (tu == sdr) {
				html += '<div class="_msnd _msgss">'+
							'<div class="_mavs">'+
								'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
							'</div>'+
							'<div class="_mtwps">'+
								'<div class="_mb _sndb">'+
								'<span class="_mtxt embd" >'+
									'<span class="_plin">'+
										value['msg']+
									'</span>'+
									'<br>'+
									'<div class="_mtime" style="width: 100%">'+
										'<small>'+value['ago']+'</small>'+
									'</div>'+
									'</span>'+
								'</div>'+
							'</div>'+
						'</div>';
			} else {
				html += '<div class="_mrcv _msgsr">'+
							'<div class="_mavr">'+
								'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
							'</div>'+
							'<div class="_mtwpr">'+
								'<div class="_mb _rcvb">'+
								'<span class="_mtxt embd" >'+
									'<span class="_plin">'+
										value['msg']+
									'</span>'+
									'<br>'+
									'<div class="_mtime" style="width: 100%">'+
										'<small>'+value['ago']+'</small>'+
									'</div>'+
									'</span>'+
								'</div>'+
							'</div>'+
						'</div>';
			}
		}
	});
	return html;
}
function check_tabs() {
	var data = null;
	if ($('.dc1').hasClass('hide')) {
		data = 1;
	} else if ($('.dc2').hasClass('hide')){
		data = 2;
	}
	return data;
}

function make_bubble(tinput,rtxt) {
	var escapedtxt = escapeHTML(tinput);
	html = '<div class="_msnd _msgss" this-id="'+rtxt+'">'+
				'<div class="_mavs">'+
					'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
				'</div>'+
				'<div class="_mtwps">'+
					'<div class="_mb _sndb">'+
					'<span class="_mtxt embd" >'+
						'<span class="_plin">'+
							escapedtxt+
						'</span>'+
						'<br>'+
						'<div class="_mtime" style="width: 100%">'+
							'<small>Now</small>&nbsp'+
							'<small class="plane-'+rtxt+'"><i class="fa fa-paper-plane-o"></i></small>'+
						'</div>'+
						'</span>'+
					'</div>'+
				'</div>'+
			'</div>';
	return html;
}
function make_bubble_rc(tinput,rtxt) {
	var escapedtxt = escapeHTML(tinput);
	html = '<div class="_mrcv _msgsr" this-id="'+rtxt+'">'+
				'<div class="_mavr">'+
					'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
				'</div>'+
				'<div class="_mtwpr">'+
					'<div class="_mb _rcvb">'+
					'<span class="_mtxt embd" >'+
						'<span class="_plin">'+
							escapedtxt+
						'</span>'+
						'<br>'+
						'<div class="_mtime" style="width: 100%">'+
							'<small>Now</small>&nbsp'+
						'</div>'+
						'</span>'+
					'</div>'+
				'</div>'+
			'</div>';
	return html;
}
function randomString() {
    var result = '';
    var length = 4;
    var dt = $.now();
    var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return dt+result;
}
function escapeHTML(txt) {
    return txt.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}