var $ = jQuery;



$(window).bind('load', function() {
	$(document).on('paste', '#jform_title', function () {
		setTimeout(function() {
			var articleTitle        = $('#jform_title');
			var articleContent      = $('#jform_articletext');
			var articleDateCreated  = $('#jform_created');
			var articleDatePublish  = $('#jform_publish_up');
			var articleImg          = $('#jform_images_image_intro');
			var articleReadMore     = '<hr id="system-readmore" />';
			var articleAliasLabel   = $('#jform_alias-lbl');

			var ext_url             = articleTitle.val();

			if ( !ext_url.length && ~ext_url.indexOf('http') ) {
				console.log('link is not correct or empty');

				return false;
			}
			else {
				articleAliasLabel.text('...');
			}



			var host_http;
			var hostname;

			if (ext_url.indexOf("//") > -1) {
				host_http   = ext_url.split('/')[0];
				hostname    = ext_url.split('/')[2];
			}
			else {
				host_http   = '';
				hostname    = ext_url.split('/')[0];
			}



			var host_full = host_http + '//' + hostname;

			var linkOriginal = '<p>Источник: <a href="' + ext_url + '" target="_blank">' + hostname + '</a></p>';

			$.ajax({
				method: 'POST',
				url: '/templates/p3week_2k18/add_news.php',
				data: {
					'ext_url': ext_url
				},
				success: function(data) {
					var $h1                 = $(data).find('h1').html();
					var $imgSrc             = $(data).find('.article__img').attr('src');
					var $img                = '<img src="' + host_full + $imgSrc + '" alt="" />';

					var $dateFull           = $(data).find('.article__meta').find('.article__main');
					$dateFull.find('.meta--dotted').remove();
					$dateFull.find('.meta__time-changer').remove();

					var $date = $dateFull.text()
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
						.replace(/[^0-9-]/g, '');

					var $content            = $(data).find('.article__textarea').html().replace(/<img.+">/g, '').replace(/ class="ql-align-justify"/g, '');
					var $contentShort       = $(data).find('.article__textarea').find('p:first-of-type').html().replace(/<img.+">/g, '').replace(/ class="ql-align-justify"/g, '');



					articleDateCreated.val($date);
					articleDatePublish.val($date);
					articleTitle.val($h1);
					articleImg.val(host_full + $imgSrc);
					articleContent.val('<p>' + $contentShort + '</p>' + articleReadMore + $img + $content + linkOriginal);

					articleDateCreated.focus();
					articleDatePublish.focus();
					articleDateCreated.focus();

					$('.button-save-new').click();
				},
				error:function() {
					console.log('Error');
				}
			});
		}, 500);
	});
});


