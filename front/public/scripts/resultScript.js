$(window).load( function() {
	$("#iWant > div:gt(0)").hide();
	setInterval(function() { 
	  $('#iWant > div:first')
	    .fadeOut(1000)
	    .next()
	    .fadeIn(1000)
	    .end()
	    .appendTo('#iWant');
	},  3000);
	$("#iLike > div:gt(0)").hide();
		setInterval(function() { 
	$('#iLike > div:first')
		.fadeOut(1000)
		.next()
		.fadeIn(1000)
		.end()
		.appendTo('#iLike');
	},  3000);
});