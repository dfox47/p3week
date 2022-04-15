
let $ = jQuery

$(window).bind('load', function() {
	$(document).on('paste', '#jform_title', function () {
		setTimeout(function() {
			let articleTitle        = $('#jform_title')
			let articleContent      = $('#jform_articletext')
			let articleDateCreated  = $('#jform_created')
			let articleDatePublish  = $('#jform_publish_up')
			let articleImg          = $('#jform_images_image_intro')
			let articleReadMore     = '<hr id="system-readmore" />'
			let articleAliasLabel   = $('#jform_alias-lbl')

			let ext_url             = articleTitle.val()

			if ( !ext_url.length && ~ext_url.indexOf('http') ) {
				console.log('link is not correct or empty')

				return false
			}
			else {
				articleAliasLabel.text('...')
			}



			let host_http
			let hostname

			if (ext_url.indexOf("//") > -1) {
				host_http   = ext_url.split('/')[0]
				hostname    = ext_url.split('/')[2]
			}
			else {
				host_http   = ''
				hostname    = ext_url.split('/')[0]
			}

			let host_full = host_http + '//' + hostname

			let linkOriginal = '<p>Источник: <a href="' + ext_url + '" target="_blank">' + hostname + '</a></p>'

			$.ajax({
				method: 'POST',
				url: '/templates/p3week_2k18/add_news.php',
				data: {
					'ext_url': ext_url
				},
				success: function(data) {
					let $h1                 = $(data).find('h1').html()
					let $imgSrc             = $(data).find('.article__img').attr('src')
					let $img                = '<img src="' + host_full + $imgSrc + '" alt="" />'

					let $dateFull           = $(data).find('.article__meta').find('.article__main')
					$dateFull.find('.meta--dotted').remove()
					$dateFull.find('.meta__time-changer').remove()

					let $date = $dateFull.text()
						.replace(/ /g, '')
						.replace('г.', '')
						.replace('января',      '-01-')
						.replace('февраля',     '-02-')
						.replace('марта',       '-03-')
						.replace('апреля',      '-04-')
						.replace('мая',         '-05-')
						.replace('июня',        '-06-')
						.replace('июля',        '-07-')
						.replace('августа',     '-08-')
						.replace('сентября',    '-09-')
						.replace('октября',     '-10-')
						.replace('ноября',      '-11-')
						.replace('декабря',     '-12-')
						.replace(/ /g, '')
						.replace(/[^0-9-]/g, '')

					let $content            = $(data).find('.article__textarea').html().replace(/<img.+">/g, '').replace(/ class="ql-align-justify"/g, '')
					let $contentShort       = $(data).find('.article__textarea').find('p:first-of-type').html().replace(/<img.+">/g, '').replace(/ class="ql-align-justify"/g, '')

					articleDateCreated.val($date)
					articleDatePublish.val($date)
					articleTitle.val($h1)
					articleImg.val(host_full + $imgSrc)
					articleContent.val('<p>' + $contentShort + '</p>' + articleReadMore + $img + $content + linkOriginal)

					articleDateCreated.focus()
					articleDatePublish.focus()
					articleDateCreated.focus()

					$('.button-save-new').click()
				},
				error:function() {
					console.log('Error')
				}
			})
		}, 500)
	})
})
