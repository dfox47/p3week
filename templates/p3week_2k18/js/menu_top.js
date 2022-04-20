
var $ = jQuery.noConflict()

// for mobile
$('.menu_top__toggle_wrap').click(function() {
	$('html').toggleClass('menu_top__active')

	// for mobile special
	$('.menu_slider').focus()
})

$('.event_link_open').click(function() {
	$('html').removeClass('menu_top__active')
})

$('.menu_slider__close').click(function() {
	$('html').toggleClass('menu_top__active')
})

// when menu opened and user leaving menu
$('.menu_slider').mouseleave(function() {
	$('html').removeClass("menu_top__active")
})
