var $ = jQuery.noConflict();



$(window).bind('load', function() {
	var showPopupRosinfra = localStorage.getItem('showPopup') ? localStorage.getItem('showPopup') : 'true';

	if ( showPopupRosinfra === 'true' ) {
		$('html').toggleClass('popup_rosinfra_active');
	}

	$(document).on('click', '.js-popup-rosinfra-toggle', function () {
		$('html').toggleClass('popup_rosinfra_active');

		localStorage.setItem('showPopup', 'false');
	});
});


