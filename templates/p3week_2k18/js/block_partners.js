var $ = jQuery.noConflict();



$(window).bind("load", function() {
	if ( $('.block_partners_listX').length ) {
		$('.block_partners_list').each(function () {
			var n = $(this).find('li').length;

			if ( n > 5 ) {
				$(this).owlCarousel({
					autoplay:           true,
					autoplayTimeout:    2000,
					autoplayHoverPause: true,
					dots:    false,
					items:   1,
					loop:    true,
					margin:  17,
					nav:     true,
					navText: ["<span></span><span></span>", "<span></span><span></span>"],
					responsive : {
						0 : {
							items : 1
						},
						800 : {
							items : 5
						}
					}
				});
			}
		});
	}
});