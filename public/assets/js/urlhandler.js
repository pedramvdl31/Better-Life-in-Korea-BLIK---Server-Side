$(document).ready(function(){
	uh.pageLoad();
	uh.events();
});
uh = {
	pageLoad: function() {
			// if (adid==0) {
			// 	window.location.href = 'blikapp://';
			// } else {
			// 	// window.location.href = 'blikapp://?adid='+adid;
			// 	window.open(
			// 	  'blikapp://?adid='+adid,
			// 	  '_blank' // <- This is what makes it open in a new window.
			// 	);
			// }
			    function open_appstore() {
			        window.location='http://itunes.com/';
			    }

			    function try_to_open_app() {
			        setTimeout('open_appstore()', 300);
			    }
		},
	events: function() {

	}
}
request = {

};

