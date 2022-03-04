var $ = jQuery.noConflict();

$('.bt_search, .search__close').click(function () {
	$('body, html').animate({
		scrollTop: 0
	}, 300);

	$('html').toggleClass('search__active');

	$('.search__input').focus();
});