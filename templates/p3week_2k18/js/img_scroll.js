
var $ = jQuery.noConflict()

$(window).on('load', function () {
	img_scroll()

	$(window).on('resize scroll', function() {
		img_scroll()
	})
})

function img_scroll() {
	$('img.js-img_scroll').each(function () {
		let $this               = $(this)
		let top_of_element      = $this.offset().top
		let bottom_of_element   = $this.offset().top + $this.outerHeight()
		let bottom_of_screen    = $(window).scrollTop() + $(window).innerHeight()
		let top_of_screen       = $(window).scrollTop()

		if ( (bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element) ) {
			let img_src = $this.attr('data-img-src')

			$this.removeClass('js-img_scroll').attr( 'src', img_src )
		}
	})
}



// pure JS version
let changeImgSrc = () => {
	document.querySelectorAll('.js-img-scroll').forEach((e) => {
		if (window.pageYOffset + window.innerHeight > e.offsetTop) {
			e.classList.remove('js-img-scroll')
			e.src = e.dataset.src
		}
	})
}

changeImgSrc()

window.addEventListener('resize', function() {
	changeImgSrc()
})

window.addEventListener('scroll', function() {
	changeImgSrc()
})
