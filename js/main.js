//@koala-prepend "spin-2.0.1.js"

$(function(){

	var spinOpts = {
		lines: 8, // The number of lines to draw
		length: 0, // The length of each line
		width: 3, // The line thickness
		radius: 4, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 0, // The rotation offset
		direction: 1, // 1: clockwise, -1: counterclockwise
		color: '#444', // #rgb or #rrggbb or array of colors
		speed: 2, // Rounds per second
		trail: 60, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: true, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent
	};

	var testch = $('#test');
	var refreshb = $('#refresh');
	var printb = $('#print');

	testch.click( function(){ 
		if( testch.prop( "checked" ) ) {
			$(document.body).addClass('border');
		}
		else {
			$(document.body).removeClass('border');
		}
	} );

	refreshb.click( function() {
		location.reload();
	});

	printb.click( function() {
		var spinner = new Spinner(spinOpts).spin();
		$('.spinner', printb).prepend(spinner.el);
		printb.prop('disabled', true);
	});

});