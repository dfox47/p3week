
var $ = jQuery.noConflict()

$(window).bind("load", function() {
	// get thumbnails from vimeo.com
	drawVimeoImages()

	function getVimeoThumbnail(id) {
		$.ajax({
			type:           'GET',
			url:            'http://vimeo.com/api/v2/video/' + id + '.json',
			jsonp:          'callback',
			dataType:       'jsonp',
			success:        function(data) {
				let thumbSrc = data[0].thumbnail_large

				$('[data-vimeo-id='+id+']').attr('src', thumbSrc)
			}
		})
	}

	function drawVimeoImages() {
		let vimeoImgDataAttr        = 'data-vimeo-id'
		let vimeoThumbnails         = $('[' + vimeoImgDataAttr + ']')
		let vimeoThumbnailsLength   = vimeoThumbnails.length

		if(vimeoThumbnailsLength) {
			for(var i=0, l = vimeoThumbnailsLength; i < l; i++) {
				let vimeoImg        = $(vimeoThumbnails).get(i)
				let vimeoImgId      = $(vimeoImg).attr(vimeoImgDataAttr)

				getVimeoThumbnail(vimeoImgId)
			}
		}
	}
})
