var $ = jQuery.noConflict();

$(window).bind("load", function() {
	// get thumbnails from vimeo.com
	drawVimeoImages();

	function getVimeoThumbnail(id) {
		$.ajax({
			type:			'GET',
			url:			'http://vimeo.com/api/v2/video/' + id + '.json',
			jsonp:			'callback',
			dataType:		'jsonp',
			success:		function(data) {
				var thumbnail_src = data[0].thumbnail_large;
				$('[data-vimeo-id='+id+']').attr('src', thumbnail_src);
			}
		});
	}

	function drawVimeoImages() {
		var vimeoImgDataAttr			= 'data-vimeo-id',
			vimeoThumbnails				= $('[' + vimeoImgDataAttr + ']'),
			vimeoThumbnailsLength		= vimeoThumbnails.length;

		if(vimeoThumbnailsLength) {
			for(var i=0, l = vimeoThumbnailsLength; i < l; i++) {
				var vimeoImg		= $(vimeoThumbnails).get(i),
					vimeoImgId		= $(vimeoImg).attr(vimeoImgDataAttr);

				getVimeoThumbnail(vimeoImgId);
			}
		}
	};
});