
var $ = jQuery.noConflict()

$(window).on('load', function () {
	imgScroll()
})

window.addEventListener('resize', () => {
	imgScroll()
})

window.addEventListener('scroll', () => {
	imgScroll()
})

function imgScroll() {
	$('img.js-imgScroll').each(function () {
		let $this = $(this)

		if ( ($(window).scrollTop() + $(window).innerHeight() > $this.offset().top) && ($(window).scrollTop() < $this.offset().top + $this.outerHeight()) ) {
			let img_src = $this.attr('data-img-src')

			$this.removeClass('js-imgScroll').attr( 'src', img_src )
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
