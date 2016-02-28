$(document).ready(function(){
	chat.pageLoad();
	chat.events();
});
chat = {
	pageLoad: function() {
		$('#inner-chat-wrapper').slimScroll({
        	height: '285px'
    	});
		$('.inner-wrapper-child').slimScroll({
        	height: '218px'
    	});
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
			if ($('.dc2').hasClass('hide')) {
				$('.dc1').addClass('hide');
			} else {
				$('.dc2').addClass('hide');
			}
		});
		$('.cc2').click(function(){
			$('.dc2').addClass('hide');
		});

		$('.conv-wrapper').click(function(){
			if ($('.dc1').hasClass('hide')) {
				$('.dc1').removeClass('hide');
			} else if ($('.dc2').hasClass('hide')){
				$('.dc2').removeClass('hide');
			}
		});
		$('.nb-lb').click(function(){
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

};

