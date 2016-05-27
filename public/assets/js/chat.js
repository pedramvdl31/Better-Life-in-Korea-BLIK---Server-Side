$(document).ready(function(){
	chat.pageLoad();
	chat.events();
	chat.socket_io();
});
chat = {
	pageLoad: function() {
		var newDate = new Date().getTime(); //convert string date to Date object
		// $('.test-tttttttttttttt').removeClass('act');
		// $('.t1r').addClass('act');
		// var currentDate = new Date().getTime();
		// var diff = currentDate-newDate;
		// console.log(diff);
		// var newDate = new Date().getTime(); //convert string date to Date object
		// $('.test-t2').attr('this-act','');
		// $('.t2r').attr('this-act','1');
		// var currentDate = new Date().getTime();
		// var diff = currentDate-newDate;
		// console.log(diff);


		$( ".resizable" ).resizable({
		  handles: "n"
		});


		window.ema = {
			"smile":":)",
			"frown":":(",
			"tongue":":p",
			"wtongue":";p",
			"wink":";)",
			"bsmile":":d",
			"smiley":":-)",
			"heart":"&lt;3",
			"heart2":"<3",
			"heart3":"&amp;lt;3"
			};
		window.ema_plain = {
			"smile":":)",
			"frown":":(",
			"tongue":":p",
			"wtongue":";p",
			"wink":";)",
			"bsmile":":d",
			"smiley":":-)",
			"heart":"<3"
			};

		rqst_server_time();
		$('#inner-chat-wrapper').slimScroll({
        	height: '285px'
    	});

	    EmbedJS.setOptions({
	        // element: document.getElementById('block'),
	        videoJS: true,
	        videoWidth: 720,
	        videoDetails: true,
	        excludeEmbed: ['github'],
	        // openGraphEndpoint:'https://opengraph.io/api/1.0/site/${url}',
	        openGraphExclude: ['github'],
	        googleAuthKey: 'AIzaSyCqFouT8h5DKAbxlrTZmjXEmNBjC69f0ts',
	         // inlineEmbed: 'all',
	        marked: true,
	        highlightCode:true,
	        codeHighlighter:'prismjs',
	        link: true,
	        // singleEmbed:true,
	        onOpenGraphFetch: function(data) {
	            data.hybridGraph.success = data.error ? false : true;
	            return data.hybridGraph;
	        }
	    });
	},	
	socket_io: function() {
        socket.on('_forward', function(data) {
        	var cu = $('#ufh').val();
        	var count = $('.msg-tmp-'+cu+'-'+data['aid']+'').length;
        	if (count!=0) {pmtoa(cu,data['aid'],data['msg'])}
        	if (!$('.main-list-dock').hasClass('hide')) {
        		$('.main-list-dock').find('.have-msg').removeClass('hide');
        	}
        	if ($('.ctabs[uid="'+data['aid']+'"]').length == 1) {
	    		var randtxt = randomString();
	    		var fin = StrToEmo(data['msg']);
	       		var input_bubble = make_bubble_rc(fin,randtxt);
	       		var dock_no = $('.ctabs[uid="'+data['aid']+'"]').attr('dock-no');
	       		$('._ctb'+dock_no).append(input_bubble);
	       		document.getElementById('ctb'+dock_no).scrollTop = 10000;
        	} else {
        		if ($('.conv-wrapper[tf="'+data['aid']+'"]').length == 1) {
        			$('.conv-wrapper[tf="'+data['aid']+'"]').find('.conv-c').removeClass('hide');
        		}
        	}
        });
	},
	events: function() {

		$('.ec').click(function(){
			var ttxt = $(this).attr('txt');
			var ttab = $(this).attr('tab');
			togglehs('#emoji-list-'+ttab);
			var emh = MakeEmoHtml(ttxt);
			$('#cta'+ttab).append(emh);
		});
		$('.dts').click(function(){
			// $('.ctabs').removeClass('tcvis');
			$('#mtab').addClass('tvis');
		});
		$('.dtsc').click(function(){	
			$('.ctabs').removeClass('tcvis');
			$(this).parents('.ctabs').addClass('tcvis');
		});
		$(document).on('keypress', '.ChatTextArea', function() {
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    var tat = $(this).attr('ttab');
		    if(keycode == '13'){
		    	var tor = $(this).html();
		    	if (!$.isBlank(tor)) {
		    		var randtxt = randomString();
		    		var prepared_array = PrepareTArray(tor);
		       		var input_bubble = make_bubble_lst(prepared_array['f'],randtxt);
		       		var dock_no = $(this).parents('.ctabs').attr('dock-no');
		       		$('._ctb'+dock_no).append(input_bubble);
		       		document.getElementById('ctb'+dock_no).scrollTop = 10000;
		       		var fid = $(this).parents('.ctabs').attr('uid');
		       		request_c.snddata(prepared_array['e'],fid,randtxt);
		       		var cu = $('#ufh').val();
		       		pmtta_sndr(cu,fid,prepared_array['e']);
		       		var thisid = $(this).attr('id');
		       		$(this).parents('.inputBar:first').find('.chatemoji').css('height','52');
		       		$(this).parents('.wpNubButton-max:first').find('.slimScrollDiv:first').css('height','218');
		       		$(this).replaceWith( '<div  ttab="'+tat+'" class="ChatTextArea" id="'+thisid+'" contenteditable="true"></div>' );
		       		setTimeout(function(){ $('#'+thisid).focus() }, 3000);
        		}
		    }
		});
		$('.nm').click(function(){
			$(this).parents('.wpNubButton').find('.have-msg').addClass('hide');
			$(this).parents('.dock_wrapper:first').addClass('hide');
			$('.dock-max').removeClass('hide');
		});
		$('#da').click(function(){
			$(this).parents('.dock_wrapper:first').addClass('hide');
			$('.dock-min').removeClass('hide');
			clear_ctabs();
		});
		$(document).on('keyup', '.ChatTextArea', function() {
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    var tat = $(this).attr('ttab');
		    if (keycode == '32') {
		    	var tv = $(this).html();
	    		var nt = StrToEmo(tv);
	    		$(this).html(nt);
	    		placeCaretAtEnd(document.getElementById("cta"+tat));
		    }
		});
		$('#cta1, #cta2').bind('input propertychange', function() {
		    var len = $(this).text().length;
		    if (len == 29) {
		    	var ch = parseInt($(this).css('height'));
		    	var nh = ch + 25;
		    	$(this).css('height',nh);
		    	var slimsc = $(this).parents('.wpNubButton-max:first').find('.slimScrollDiv:first');
		    	var ss = parseInt(slimsc.css('height'));
		    	var ns = ss - 25;
		    	slimsc.css('height',ns);
		    	$(this).parents('.inputBar:first').find('.chatemoji').css('height',nh);
		    } else if(len < 29){
		    	$(this).css('height','52');
		    	$(this).parents('.inputBar:first').find('.chatemoji').css('height','52');
		    	var slimsc = $(this).parents('.wpNubButton-max:first').find('.slimScrollDiv:first').css('height','218');
		    }
		});
		$(document).on('click', '#emoji-list-1>pre>code>.emoticon', function() {
			togglehs('#emoji-list-1');
			var t = $(this).attr('title');
			var nt = t.trim();
			var tb = $('#cta1').text();
			var ntb = tb+' '+nt+' ';
			$('#cta1').text(ntb+" ");
        });
		$('#emoi-1').click(function(){
			togglehs('#emoji-list-1');
		});
		$(document).on('click', '#emoji-list-2>pre>code>.emoticon', function() {
			togglehs('#emoji-list-2');
			var t = $(this).attr('title');
			var nt = t.trim();
			var tb = $('#cta2').text();
			var ntb = tb+' '+nt+' ';
			$('#cta2').text(ntb);
        });
		$('#emoi-2').click(function(){
			togglehs('#emoji-list-2');
		});

		$('.cc1').click(function(){
			$('.dc1').attr('uid','');
			if ($('.dc2').hasClass('hide')) {
				$('.dc1').addClass('hide');
			} else { 
				$('.dc1').addClass('hide');
				$('.dc2').addClass('toright');
			}
			make_child_active(2);
			mopac();
		});
		$('.cc2').click(function(){
			$('.dc2').attr('uid','');
			$('.dc2').addClass('hide');
			make_child_active(1);
			mopac();
		});
		$('.conv-wrapper').click(function(){
			var tab_id = check_tabs();
			make_active(tab_id);
	    	$('.sc-wrapper-'+tab_id).html('');
	    	$('.sc-wrapper-'+tab_id).html('<div style="height:218px" class="inner-wrapper-child _ctb'+tab_id+'" id="ctb'+tab_id+'"></div>');
			var cu = $('#ufh').val();
			var fu = $(this).attr('tf');
			make_active(fu);
			var fe = $(this).find('._femail').text();
			$('._cbnm'+tab_id).text(fe);
			$(this).find('.conv-c').addClass('hide');
			var duplength = $(".ctabs[uid='"+fu+"']").length;
			if (duplength==0) {
					$('.dc'+tab_id).removeClass('hide');
					$('.dc'+tab_id).attr('uid',fu);
					$('.dc2').removeClass('toright');
				}
			$tmp = $('.msg-tmp-'+cu+'-'+fu+'');
			if ($tmp.length>0) {
				t_g_m($tmp,cu,fu,tab_id);
			} else {
				g_m(cu,fu,tab_id);
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
				$(".bbl[this-id='"+randtxt+"']").attr('tdt',result.tcat);
				switch(status){					
		 			case 200:
		 				$('.plane-'+randtxt).css('color','#5cb85c');
		                socket.emit("trans", { 
	                    	recip: fi,
	                    	msg: tdata,
	                    	aid:result.aid
	                     });            
		 			break;
		 			case 400:
		 			break;
				}
			}
			);
	}
};
function g_m(cu,fu,tab_id){
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/g-m',
		{
			"_token": token,
			"fi":fu,
		},
		function(result){
			var status = result.status;
			var _ar = result.l_mgs;
			switch(status){					
	 			case 200:
					if (typeof(cu) != "undefined" && cu !== null) {
				    	var msgs_html = prepare_html(_ar,cu,fu);
				    	$('._ctb'+tab_id).html(msgs_html);
				    	$('._ctb'+tab_id).slimScroll({
				        	height: '218px',
				        	start: 'bottom'
				    	});
					}
					inject_tmp(_ar,cu,fu);
	 			break;
	 			case 400:
	 			break;

			}
		}
		);
}
function t_g_m(tmp_m,cu,fu,tab_id){
		if (typeof(cu) != "undefined" && cu !== null) {
	    	var msgs_html = prepare_html_tmp(tmp_m,cu,fu);
	    	$('._ctb'+tab_id).html('');
	    	$('._ctb'+tab_id).html(msgs_html);
	    	$('._ctb'+tab_id).slimScroll({
	        	height: '218px',
	        	start: 'bottom'
	    	});
		}
}
function prepare_html(_ar,tu,tf) {
	var html = '';
	$.each(_ar, function(index,value) {
		var sdr = value['user_id'];
		var tm = StrToEmo(value['message']);
		if (tu == sdr) {
			html += '<div class="_msnd _msgss bbl">'+
						'<div class="_mavs">'+
							'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
						'</div>'+
						'<div class="_mtwps">'+
							'<div class="_mb _sndb">'+
							'<span class="_mtxt embd" >'+
								'<span class="_plin">'+
									tm+
								'</span>'+
								'<br>'+
								'<div class="_mtime" style="width: 100%">'+
									'<small><span class="_tago">'+value['ago']+'</span></small>'+
								'</div>'+
								'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
		} else {
			html += '<div class="_mrcv _msgsr bbl">'+
						'<div class="_mavr">'+
							'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
						'</div>'+
						'<div class="_mtwpr">'+
							'<div class="_mb _rcvb">'+
							'<span class="_mtxt embd" >'+
								'<span class="_plin">'+
									tm+
								'</span>'+
								'<br>'+
								'<div class="_mtime" style="width: 100%">'+
									'<small><span class="_tago">'+value['ago']+'</span></small>'+
								'</div>'+
								'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
		}
	});
	return html;
}
function prepare_html_tmp(_ar,tu,tf) {
	var html = '';
	$.each(_ar, function(index,value) {
		var sdr = $(this).attr('user_id');
		var frm_now = gago($(this).attr('ago'));
		var tm = StrToEmo($(this).attr('message'));
		if (tu == sdr) {
			html += '<div class="_msnd _msgss bbl">'+
						'<div class="_mavs">'+
							'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
						'</div>'+
						'<div class="_mtwps">'+
							'<div class="_mb _sndb">'+
							'<span class="_mtxt embd" >'+
								'<span class="_plin">'+
									tm+
								'</span>'+
								'<br>'+
								'<div class="_mtime" style="width: 100%">'+
									'<small><span class="_tago">'+frm_now+'</span></small>'+
								'</div>'+
								'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
		} else {
			html += '<div class="_mrcv _msgsr bbl">'+
						'<div class="_mavr">'+
							'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
						'</div>'+
						'<div class="_mtwpr">'+
							'<div class="_mb _rcvb">'+
							'<span class="_mtxt embd" >'+
								'<span class="_plin">'+
									tm+
								'</span>'+
								'<br>'+
								'<div class="_mtime" style="width: 100%">'+
									'<small><span class="_tago">'+frm_now+'</span></small>'+
								'</div>'+
								'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
		}
	});
	return html;
}
function inject_tmp(_ar,tu,tf) {
	var html = '';
	$.each(_ar, function(index,value) {
		html += '<input type="hidden" name="" class="msg-tmp-'+tu+'-'+tf+'" id="msg-tmp-'+tu+'-'+tf+'['+index+']" user_id="'+value['user_id']+'" ago="'+value['created_at']+'" message="'+value['message']+'"></input>';
	});
	$('#msgs_tmp').append(html);
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
function clear_ctabs() { 
	for (var i=1; i <= 2; i++) {
		$('#ctab'+i).attr('uid','');
		$('#ctab'+i).addClass('hide');
	}
}
function make_bubble_lst(tinput,rtxt) {
	html = '<div class="_msnd _msgss bbl" this-id="'+rtxt+'" data="last">'+
				'<div class="_mavs">'+
					'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
				'</div>'+
				'<div class="_mtwps">'+
					'<div class="_mb _sndb">'+
					'<span class="_mtxt embd" >'+
						'<span class="_plin">'+
							tinput+
						'</span>'+
						'<br>'+
						'<div class="_mtime" style="width: 100%">'+
							'<small><span class="_tago">Now</span></small>&nbsp'+
							'<small class="plane-'+rtxt+'"><i class="fa fa-paper-plane-o"></i></small>'+
						'</div>'+
						'</span>'+
					'</div>'+
				'</div>'+
			'</div>';
	return html;
}


function make_bubble_rc(tinput,rtxt) {
	html = '<div class="_mrcv _msgsr bbl" this-id="'+rtxt+'">'+
				'<div class="_mavr">'+
					'<img src="/assets/images/profile-images/perm/blank_male.png" width="35px">'+
				'</div>'+
				'<div class="_mtwpr">'+
					'<div class="_mb _rcvb">'+
					'<span class="_mtxt embd" >'+
						'<span class="_plin">'+
							tinput+
						'</span>'+
						'<br>'+
						'<div class="_mtime" style="width: 100%">'+
							'<small><span class="_tago">Now</span></small>&nbsp'+
						'</div>'+
						'</span>'+
					'</div>'+
				'</div>'+
			'</div>';
	return html;
}
function gago(ttgo){
	var s_t = $('#crnt_dt').val();
	var ago_f = moment(ttgo, "YYYY-MM-DD hh:mm:ss");
	var server_f = moment(s_t, "YYYY-MM-DD hh:mm:ss");
	var duration = moment.utc(server_f.diff(ago_f)).format("HH:mm:ss");
	return moment.duration(duration, "days").humanize();
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
//put msg to tmp array
function pmtoa(tu,tf,msg){
	var count = $('.msg-tmp-'+tu+'-'+tf+'').length;
	var nc = count + 1;
	var c_time = $('#crnt_dt').val();
	var html = '<input type="hidden" name="" class="msg-tmp-'+tu+'-'+tf+'" id="msg-tmp-'+tu+'-'+tf+'['+nc+']" user_id="'+tf+'" ago="'+c_time+'" message="'+msg+'"></input>';
	$('#msgs_tmp').append(html);
}
//put msg to tmp array after sent
function pmtta_sndr(tu,tf,msg){
	var count = $('.msg-tmp-'+tu+'-'+tf+'').length;
	var nc = count + 1;
	var c_time = $('#crnt_dt').val();
	var html = '<input type="hidden" name="" class="msg-tmp-'+tu+'-'+tf+'" id="msg-tmp-'+tu+'-'+tf+'['+nc+']" user_id="'+tu+'" ago="'+c_time+'" message="'+msg+'"></input>';
	$('#msgs_tmp').append(html);
}
function mopac(){
	if ($('.dc1').hasClass('hide') && $('.dc2').hasClass('hide')) {
		$('#mtab').addClass('tvis');
	}
}
function rqst_server_time(){
	setInterval(function(){ 
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/rqst-s-time',
			{
				"_token": token
			},
			function(result){
				var s_time = result.rst;
				if (!$.isBlank(s_time)) {
					$('#crnt_dt').val(s_time);
				}
			}
			);
	}, 180000);
}
function renembd(elem){
	EmbedJS.applyEmbedJS(elem);
}
function togglehs(d){
	if ($(d).hasClass('hide')) {
		$(d).removeClass('hide');
	} else {
		$(d).addClass('hide');
	}
}
function PrepareTArray(txt){
	var oa={"p":"","e":"","f":""};
	oa["p"] = SrtipEmojiHtml(txt);
	oa["e"] = escapeHTML(oa["p"]);
	oa["f"] = StrToEmo(oa["e"],ema);
	return oa;
}
function isExist(obj,str) {
	var o = -1
	$.each( obj, function(k,v) {
		if (v==str) {
			o=k;
		}
	});
	return o;
}
function SrtipEmojiHtml(txt) {
	var o = -1
	var ot = txt;
	$.each(ema_plain, function(k,v) {
		var ht = '<i class="emoticon emoticon_'+k+'"></i>';
		var regg = new RegExp(ht,"g");
		ot = ot.replace(regg,v);
	});
	return ot;
}
function StrToEmo(txt) {
	var ot = txt;
	$.each(ema, function(k,v) {
		var ht = '<i class="emoticon emoticon_'+k+'"></i>';
		var regg = new RegExp(escapeRegExp(v),"g");
		ot = ot.replace(regg,ht);
	});
	return ot;
}
function escapeRegExp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}
function MakeEmoHtml(str) {
	return '<i class="emoticon emoticon_'+str+'"></i>';
}
function make_active(fi) {
	var ti = ct_vis(fi);
	$('#mtab').removeClass('tvis');
	make_child_active(ti)
}
function ct_vis(fid) {
	var data = null;
	if ($('.dc1').hasClass('hide') || $('.dc1').attr('uid')==fid) {
		data = 1;
	} else if ($('.dc2').hasClass('hide') || $('.dc2').attr('uid')==fid ){
		data = 2;
	}
	return data;
}
function RemoveStr(tt,cutnum) {
	var tlen = tt.length;
	var o = tt.slice(0,tlen-cutnum);
	return o;
}
function make_child_active(ci) {
	$('.ctabs').removeClass('tcvis');
	$('#ctab'+ci).addClass('tcvis');
}

function placeCaretAtEnd(el) {
    el.focus();
    if (typeof window.getSelection != "undefined"
            && typeof document.createRange != "undefined") {
        var range = document.createRange();
        range.selectNodeContents(el);
        range.collapse(false);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (typeof document.body.createTextRange != "undefined") {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(false);
        textRange.select();
    }
}
