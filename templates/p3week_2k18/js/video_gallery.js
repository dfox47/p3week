
var $ = jQuery.noConflict();



$('.js-menu-video-link').click(function () {
	let $this           = $(this)
	let selectedDay     = $this.attr('data-day')
	let $videoDay       = $('.js-video-day')

	// hightlight menu
	$('.js-menu-video-link').parent().removeClass('active')
	$this.parent().addClass('active')

	// show/hide videos by days
	if (selectedDay === 'all') {
		$videoDay.addClass('active')

		return
	}

	$videoDay.removeClass('active')

	$videoDay.each(function () {
		let $this = $(this)

		if ($this.attr('data-day') === selectedDay) {
			$this.addClass('active')
		}
	})
})



$(window).bind('load', function() {
	$('.p_video__item_img').find('.btn__play').click(function () {
		$(this).parent().find('a').click()
	})
})
