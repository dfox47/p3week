


var $ = jQuery.noConflict();



$('.js-menu-video-link').click(function () {
	var $this           = $(this);
	var selectedDay     = $this.attr('data-day');
	var videoDay        = $('.js-video-day');

	// hightlight menu
	$('.js-menu-video-link').parent().removeClass('active');
	$this.parent().addClass('active');

	// show/hide videos by days
	if (selectedDay === 'all') {
		videoDay.addClass('active');
	}
	else {
		videoDay.removeClass('active');

		videoDay.each(function () {
			var videoDayData = $(this).attr('data-day');

			if (videoDayData === selectedDay) {
				$(this).addClass('active');
			}

			console.log('videoDayData | ', videoDayData);
		});
	}
});



$(window).bind('load', function() {
	$('.p_video__item_img').find('.btn__play').click(function () {
		$(this).parent().find('a').click();
	});
});


