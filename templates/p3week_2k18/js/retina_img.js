
var $ = jQuery.noConflict()

$(document).ready(function() {
	let retina = window.devicePixelRatio > 1

	if (retina) {
		let img_to_replace = $('img.retina').get()

		for (var i=0,l=img_to_replace.length; i<l; i++) {
			let src = img_to_replace[i].src

			src = src.replace(/\.(png|jpg|gif)+$/i, '_retina.$1')

			img_to_replace[i].src = src
		}
	}
})
