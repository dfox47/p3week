var $ = jQuery.noConflict();

var isMobile = false;



// mobile device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;


$('.bt_reg_click').click(function() {
	$(".bt_reg").click();
});



$('.p_news__back').click(function () {
	parent.history.back();

	return false;
});



$('.table_programm__more').click(function () {
	$(this).parent().toggleClass('active');

	$('html,body').animate({
		scrollTop: $(this).parent().parent().offset().top - 45
	}, 900);
});



$('.p_org__more, .hello__more').click(function () {
	$(this).toggleClass('active');

	$(this).parent().toggleClass('active');

	$('html,body').animate({
		scrollTop: $(this).parent().offset().top - 200
	}, 900);
});



$('.p_programm_link').click(function() {
	$(".p_programm_more").removeClass("active");
	$(this).parent().toggleClass("active");

	$('body,html').animate({
		scrollTop: $(this).parent().offset().top
	}, 700);
});

$('.p_programm_link__close').click(function() {
	$(".p_programm_more").removeClass("active");
});

$('.p_programm_close').click(function() {
	$(this).parent().parent().toggleClass("active");

	$('body,html').animate({
		scrollTop: $(this).parent().parent().offset().top
	}, 700);
});



$('.speakers_nav').find("> li").click(function() {
	var name_link = $(this).attr("data-name-link");

	$(".speakers_nav").find("> li").removeClass("active");
	$(this).addClass("active");

	if ( name_link === "all" ) {
		$(".speakers").find("> div").removeClass("hidden");
	}
	else {
		$(".speakers").find("> div").addClass("hidden");

		$(".speakers").find("*[data-name='" + name_link + "']").removeClass("hidden");
	}
});









$(window).bind('load', function() {
	$('body').removeClass('no_js');



	windowResize();

	$(window).resize(windowResize);

	var covidClosed = localStorage.getItem('covidClosed');
	var $popupCovid = $('.js-popup-covid');

	if ( covidClosed !== 'true' ) {
		$popupCovid.addClass('active');
	}

	$('.js-popup-covid-close').click(function () {
		$popupCovid.removeClass('active');
		localStorage.setItem('covidClosed', 'true');
	});



	var hash = window.location.hash;

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
	// $('.presentation__menu').find('> li').click(function() {
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
});


