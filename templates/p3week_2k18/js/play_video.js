var $ = jQuery.noConflict();



$(window).bind('load', function() {
	play_button_add();

	play_video();



	var windowHash = window.location.hash;

	if (windowHash.toLowerCase().indexOf('js_video_autoplay') >= 0) {
		$('.js-home_video_play').click();
	}
});



// add play button
function play_button_add() {
	$('.p_home_block_3_video, .p_home_block_4_video, .p_video__item_img, .video_preview').each(function() {
		if ( !$(this).find('.btn__play').length ) {
			$(this).append('<div class="btn btn__play"><img class="svg" src="/images/btn__play.svg" alt="play"></div>');
		}
	});
}



// load youtube or vimeo player
function play_video() {
	$(document).on('click', '.video_preview', function() {
		// if it is youtube preview image
		if ($(this).find("img").attr("src").indexOf("youtube") !== -1) {
			$(this).find("img").hide();
			$(this).find("img").parent().addClass("active").append("<iframe allowfullscreen src=\"//www.youtube.com/embed/" + $(this).find("img").attr("src").replace("http://img.youtube.com/vi/", "").replace("/mqdefault.jpg", "") + "?autoplay=1\"></iframe>");
		}
		// if it is vimeo image
		else if ($(this).find("img").attr("class").indexOf("vimeo") !== -1) {
			$(this).find("img").hide();
			$(this).find("img").parent().addClass("active").append("<iframe src=\"//player.vimeo.com/video/" + $(this).find("img").attr("data-vimeo-id") + "?autoplay=1\"></iframe>");
		}
	});



	$(document).on('click', '.js-home_video_play', function() {
		var data_video = $(this).attr('data-video');

		$(this).append('<iframe src="https://www.youtube.com/embed/' + data_video + '?autoplay=1&mute=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
	});

	$('.home_video').find('.btn').click(function () {
		$(this).parent().click();
	});
}



// function autoAnchor(){
// 	document.querySelector('#js_video_autoplay').scrollIntoView({
// 		behavior: 'smooth'
// 	});
// 	setTimeout(document.querySelector('#js_video_autoplay').click(),1000);
// 	setTimeout(document.querySelector('#js_video_autoplay').click(),1000);
// }
//
// window.onload = setTimeout(autoAnchor, 1500);


