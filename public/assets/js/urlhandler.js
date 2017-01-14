$(document).ready(function(){
	uh.pageLoad();
	uh.events();
});
uh = {
	pageLoad: function() {
			if (adid==0) {
				window.location.href = 'blikapp://';
			} else {
				window.location.href = 'blikapp://somepath?adid='+adid;
			}
			
		},
	events: function() {

	}
}
request = {

};

