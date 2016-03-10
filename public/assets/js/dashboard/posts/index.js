$(document).ready(function(){
	posts_i.pageLoad();
	posts_i.events();

});
posts_i = {
	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
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
	},
	events: function() {
		$(".remove-post").click(function(){
			var tid = $(this).attr('data');
			$('#warning-modal').attr('data',tid);
			$('#warning-modal').modal('show');
		});
		$(".remove-btn").click(function(){
			var tid = $('#warning-modal').attr('data');
			window.location.replace('/dashboard/posts-remove/'+tid);
		});
		$("#cats").change(function(){
			var t_v = $("option:selected", this).val();
			if (t_v != '0') {
				renew_subcat(t_v);
			}
		});
		$(".remove-ofile").click(function(){
			var name = $(this).attr('data');
			var poste_input = $('.posted-files[old-name="'+name+'"]');
			if (poste_input.length > 0) {
				poste_input.remove();
				$(this).parents('.thumb-wrap:first').remove();
			} else {
				alert('Somthing Went Wrong!');
			}
		});


	}
}
request = {
	posts_i: function(id) {
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
function posts_if(url)
{

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