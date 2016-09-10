$(document).ready(function(){
	var this_id = document.getElementById("popup_id").value;
	$('#atwl-btn').attr('data',this_id);
	$('.fbc').html('');
	HelperFuncions.findAndViewAd(this_id);
});
