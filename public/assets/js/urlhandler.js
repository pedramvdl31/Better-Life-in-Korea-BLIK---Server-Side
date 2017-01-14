$(document).ready(function(){
	uh.pageLoad();
	uh.events();
});
uh = {
	pageLoad: function() {
			if (adid==0) {
				window.location.href = 'blikapp://';
			} else {
				alert(adid);
				// window.location.href = 'blikapp://?adid='+adid;
			}
			
		},
	events: function() {

	}
}
request = {

};

