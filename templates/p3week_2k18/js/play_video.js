
var $ = jQuery.noConflict();

$(window).bind('load', function() {
	play_button_add()

	play_video()

	let windowHash = window.location.hash;

	if (windowHash.toLowerCase().indexOf('js_video_autoplay') >= 0) {
		$('.js-home_video_play').click()
	}
})

// add play button
function play_button_add() {
	$('.p_home_block_3_video, .p_home_block_4_video, .p_video__item_img, .video_preview').each(function() {
		if ( !$(this).find('.btn__play').length ) {
			$(this).append('<div class="btn btn__play"><img class="svg" src="/images/btn__play.svg" alt="play"></div>')
		}
	})
}

// load youtube or vimeo player
function play_video() {
	$(document).on('click', '.video_preview', function() {
		let $this       = $(this)
		let $videoImg   = $this.find('img')

		if (!$videoImg.length) return

		// if it is youtube preview image
		if ($videoImg.attr('src').indexOf('youtube') !== -1) {
			$videoImg.hide()
			$videoImg.parent().addClass('active').append('<iframe allowfullscreen src="//www.youtube.com/embed/' + $videoImg.attr('src').replace('http://img.youtube.com/vi/', '').replace('/mqdefault.jpg', '') + '?autoplay=1"></iframe>')
		}
		// if it is vimeo image
		else if ($videoImg.attr('class').indexOf('vimeo') !== -1) {
			$videoImg.hide()
			$videoImg.parent().addClass('active').append('<iframe src="//player.vimeo.com/video/' + $videoImg.attr('data-vimeo-id') + '?autoplay=1"></iframe>')
		}
	})

	$(document).on('click', '.js-home_video_play', function() {
		let $this       = $(this)
		let dataVideo   = $this.attr('data-video')

		$this.append('<iframe src="https://www.youtube.com/embed/' + dataVideo + '?autoplay=1&mute=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
	})

	$('.home_video').find('.btn').click(function () {
		$(this).parent().click()
	})
}
