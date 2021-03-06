
var $ = jQuery.noConflict()

$(window).bind("load", function() {
	// replace SVG with inline SVG code to change color with CSS
	$('img.svg, img.js-svg').each(function() {
		let $img        = $(this)
		let imgID       = $img.attr('id')
		let imgClass    = $img.attr('class')
		let imgURL      = $img.attr('src')

		$.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			let $svg = $(data).find('svg')

			// Add replaced image's ID to the new SVG
			if (typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID)
			}

			// Add replaced image's classes to the new SVG
			if (typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg')
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a')

			// Replace image with new SVG
			$img.replaceWith($svg)

		}, 'xml')
	})
})
