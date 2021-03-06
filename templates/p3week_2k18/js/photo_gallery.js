
let day

let day_1 = 28
let day_2 = 29
let day_3 = 30
let day_4 = 31
let dayAll
let selected_day

let $galMenuDays    = $('.gal_menu_days')
let $blogPhoto      = $('.blog__photo')
let $blogPhotoDiv   = $blogPhoto.find('.blog__items_wrap').find('> div').find('> div')

$blogPhoto.find('.gal_item__img').click(function () {
	window.location.href = $(this).parent().find('.readmore').find('a').attr('href')
})



if ( $('.gal_menu_days__2014').length ) {
	day_1 = 11
	day_2 = 12
	day_3 = 13
}
else if ( $('.gal_menu_days__2015').length ) {
	day_1 = 17
	day_2 = 18
	day_3 = 19
	day_4 = 20
}
else if ( $('.gal_menu_days__2016').length ) {
	day_1 = 29
	day_2 = 30
	day_3 = 31
	day_4 = '1 апр'
}
else if ( $('.gal_menu_days__2017').length ) {
	day_1 = 28
	day_2 = 29
	day_3 = 30
	day_4 = 31
}
else if ( $('.gal_menu_days__2018').length ) {
	day_1 = 24
	day_2 = 25
	day_3 = 26
	day_4 = 27
}
else if ( $('.gal_menu_days__2019').length ) {
	day_1 = 23
	day_2 = 24
	day_3 = 25
	day_4 = 26
}
else if ( $('.gal_menu_days__2020').length ) {
	day_1 = 28
	day_2 = 29
	day_3 = 30
	day_4 = 1
}
else if ( $('.gal_menu_days__2021').length ) {
	day_1 = 28
	day_2 = 29
	day_3 = 30
	day_4 = 1
}



$galMenuDays.find('a').click(function () {
	let dataDay = $(this).attr('data-day')

	let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?day=' + dataDay
	window.history.pushState({ path: newUrl }, '', newUrl)

	if ( dataDay === '1' ) {
		selected_day = day_1
	}
	else if ( dataDay === '2' ) {
		selected_day = day_2
	}
	else if ( dataDay === '3' ) {
		selected_day = day_3
	}
	else if ( dataDay === '4' ) {
		selected_day = day_4
	}
	else if ( dataDay === 'all' ) {
		selected_day = dayAll
	}

	if ( selected_day === dayAll ) {
		$blogPhotoDiv.addClass('active')
	}
	else {
		$blogPhotoDiv.removeClass('active')

		$blogPhotoDiv.each(function () {
			$(this).find('.gal_item__date').find('span:contains("' + selected_day + '")').parent().parent().addClass('active')
		})
	}

	$galMenuDays.find('li').removeClass('active').find('a[data-day="' + dataDay + '"]').parent().addClass('active')
})



// show only gallery of first day at page load
$blogPhotoDiv.each(function () {
	$(this).find('.gal_item__date').find('span:contains("' + day_1 + '")').parent().parent().addClass('active')
})



function currentDayOnLoad() {
	// получаем значение параметра из URL
	let getUrlParameter = function getUrlParameter(sParam) {
		let sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=')

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1])
			}
		}
	}

	// check if there are any parameters in the URL
	let queryString = window.location.search

	if ( queryString.length ) {
		// проверяем переменные из URL при загрузке страницы и создаём массив из переменных
		if ( getUrlParameter('day') === '' ) {
			day = '0'
		}
		else {
			day = getUrlParameter('day')
		}



		if ( day === '1' ) {
			selected_day = day_1
		}
		else if ( day === '2' ) {
			selected_day = day_2
		}
		else if ( day === '3' ) {
			selected_day = day_3
		}
		else if ( day === '4' ) {
			selected_day = day_4
		}
		else if ( day === 'all' ) {
			selected_day = dayAll
		}

		if ( selected_day === dayAll ) {
			$blogPhotoDiv.addClass('active')
		}
		else {
			$blogPhotoDiv.removeClass('active')

			$blogPhotoDiv.each(function () {
				$(this).find('.gal_item__date').find('span:contains("' + selected_day + '")').parent().parent().addClass('active')
			})
		}

		$galMenuDays.find('li').removeClass('active').find('a[data-day="' + day + '"]').parent().addClass('active')
	}
}

currentDayOnLoad()
