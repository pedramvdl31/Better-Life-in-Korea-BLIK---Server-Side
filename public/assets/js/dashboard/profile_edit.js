$(document).ready(function(){
	pedit.pageLoad();
	pedit.events();

});
pedit = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
	},
	events: function() {
		$('#form-submit-btn').change(function () {
			event.stopPropagation(); // Stop stuff happening
		    event.preventDefault(); // Totally stop stuff happening

		    // Create a formdata object and add the files
		    var this_file = new FormData();
		    $.each(this.files, function(key, value)
		    {
		        this_file.append(key, value);
		    });
		 	$.ajax({
			        url: '/users/send-file',
			        type: 'POST',
			        data: this_file,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	var status = data.status;
			        	switch (status){
			        		case 200:
			        			var newpath = data.newpath;
			        			$('.profile_img').attr('src',newpath);
			        			$('#saved').removeClass('hide');
			        		break;
			        		case 'error':
			        		break;
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {

			        }
			    });
		});
	}
}
request = {
	pedit: function(id) {
		var token = $('meta[name=csrf-token]').attr('content');
		$.post(
			'/',
			{
				"_token": token
			},
			function(result){
				var status = result.status;

				switch(status) {
					case 200: 
						
					break;				
					case 400: 
						
					break;
					default:
					break;
				}

				}
				);
	}
};
function peditf(url)
{

}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);