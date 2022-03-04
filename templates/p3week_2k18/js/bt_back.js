var $ = jQuery.noConflict();

$(window).bind('load', function() {
	$('.bt_back').click(function() {
		history.back(1);
	});
});


