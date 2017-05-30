$(document).ready(function(){
	uh.pageLoad();
	uh.events();
});
uh = {
	pageLoad: function() {



		
			if (adid==0) {
				window.location.href = 'blikapp://';
			} else {
				// window.location.href = 'blikapp://?adid='+adid;
				// window.open(
				//   'blikapp://?adid='+adid,
				//   '_blank' // <- This is what makes it open in a new window.
				// );
			}
			

		},
	events: function() {

	}
}
request = {

};

