
var $ = jQuery.noConflict()

$('.table_programm__more').click(function () {
	$(this).parent().toggleClass('active');

	$('html,body').animate({
		scrollTop: $(this).parent().parent().offset().top - 45
	}, 900);
})

$('.p_org__more, .hello__more').click(function () {
	$(this).toggleClass('active');

	$(this).parent().toggleClass('active');

	$('html,body').animate({
		scrollTop: $(this).parent().offset().top - 200
	}, 900);
})

$('.p_programm_link').click(function() {
	$(".p_programm_more").removeClass("active");
	$(this).parent().toggleClass("active");

	$('body,html').animate({
		scrollTop: $(this).parent().offset().top
	}, 700);
})

$('.p_programm_link__close').click(function() {
	$(".p_programm_more").removeClass("active");
})

$('.p_programm_close').click(function() {
	$(this).parent().parent().toggleClass("active");

	$('body,html').animate({
		scrollTop: $(this).parent().parent().offset().top
	}, 700);
})

$(window).bind('load', function() {
	$('body').removeClass('no_js');

	windowResize();

	$(window).resize(windowResize);

	let covidClosed = localStorage.getItem('covidClosed');
	let $popupCovid = $('.js-popup-covid');

	if ( covidClosed !== 'true' ) {
		$popupCovid.addClass('active');
	}

	$('.js-popup-covid-close').click(function () {
		$popupCovid.removeClass('active');
		localStorage.setItem('covidClosed', 'true');
	});

	let hash = window.location.hash;

	if ( hash ) {
		$(hash).find('.table_programm__desc').addClass('active');
	}

	if ( $('.block_home_2__content').length ) {
		// load only after 5 seconds, to show first speaker for 5 sec
		setTimeout(function () {
			$('.block_home_2__content').find('.speakers').owlCarousel({
				autoplay: true,
				autoplayHoverPause: true,
				autoplayTimeout: 2500,
				dots: false,
				items: 1,
				loop: true,
				nav: true,
				smartSpeed: 350,
				navText: ["<span></span><span></span>", "<span></span><span></span>"],
			});
		}, 5000);
	}

	if ( $('.home_slider').length ) {
		$('.home_slider').find('.owl-carousel').owlCarousel({
			autoplay:           true,
			autoplayHoverPause: true,
			autoplayTimeout:    2500,
			dots:               false,
			items:              1,
			loop:               true,
			nav:                true,
			navText:            ["<span></span><span></span>", "<span></span><span></span>"]
		});
	}

	if ( $('.js-speakers-home').length ) {
		$('.js-speakers-home').find('.owl-carousel').owlCarousel({
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:false,
			dots:       false,
			slideBy :   3,
			items:      4,
			loop:       true,
			margin:     20,
			nav:        true,
			navText: ["<span></span><span></span>", "<span></span><span></span>"],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				750:{
					items: 3
				},
				920:{
					items: 4
				}
			}
		});
	}

	if ( $('.welcome__list').length ) {
		$('.welcome__list').owlCarousel({
			dots: false,
			items: 1,
			loop: true,
			nav: true,
			navText: ["<span></span><span></span>", "<span></span><span></span>"]
		});
	}

	$('.p_home_block_3_video, .p_home_block_4, .p_video').find(".bt_play").click(function() {
		$(this).parent().find("a").click();
	});

	$('.popup_present_bg, .popup_present_close').click(function() {
		$(".popup_present_wrap").removeClass("active");
		$("body, html").removeClass("overflow_hidden");
	});

	$('.presentation__menu').find('> li:not(.divider)').click(function() {
		var link = $(this).attr('data-link');

		$(this).parent().find('> li').removeClass('active');

		$(this).addClass('active');

		$('.presentation__day').removeClass('active');

		$('.presentation__day[data-tab=' + link + ']').addClass('active');
	});

	if ( $('.post_release').length ) {
		$('.post_release').find('.owl-carousel').owlCarousel({
			dots:    false,
			items:   1,
			loop:    true,
			margin:  10,
			nav:     true,
			navText: ["<span></span><span></span>", "<span></span><span></span>"]
		});
	}

	// archive 2019 red year fix
	if ( $('.item-1217').length ) {
		if ( ! $('.page_id_2701').length ) {
			$('.item-1217').removeClass('active');
		}
	}

	// when window resizing
	function windowResize() {}
})
