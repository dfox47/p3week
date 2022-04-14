
let day

let day_1
let day_2
let day_3
let day_4
let day_all
let selected_day



$('.blog__photo').find('.gal_item__img').click(function () {
	var link = $(this).parent().find('.readmore').find('a').attr('href');

	window.location.href = link;
});



if ( $('.gal_menu_days__2014').length ) {
	day_1 = 11;
	day_2 = 12;
	day_3 = 13;
}
else if ( $('.gal_menu_days__2015').length ) {
	day_1 = 17;
	day_2 = 18;
	day_3 = 19;
	day_4 = 20;
}
else if ( $('.gal_menu_days__2016').length ) {
	day_1 = 29;
	day_2 = 30;
	day_3 = 31;
	day_4 = '1 апр';
}
else if ( $('.gal_menu_days__2017').length ) {
	day_1 = 28;
	day_2 = 29;
	day_3 = 30;
	day_4 = 31;
}
else if ( $('.gal_menu_days__2018').length ) {
	day_1 = 24;
	day_2 = 25;
	day_3 = 26;
	day_4 = 27;
}
else if ( $('.gal_menu_days__2019').length ) {
	day_1 = 23;
	day_2 = 24;
	day_3 = 25;
	day_4 = 26;
}
else if ( $('.gal_menu_days__2020').length ) {
	day_1 = 28;
	day_2 = 29;
	day_3 = 30;
	day_4 = 1;
}



$('.gal_menu_days').find('a').click(function () {
	var data_day = $(this).attr('data-day');

	var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?day=' + data_day;
	window.history.pushState({ path: newurl }, '', newurl);

	if ( data_day == 1 ) {
		selected_day = day_1;
	}
	else if ( data_day == 2 ) {
		selected_day = day_2;
	}
	else if ( data_day == 3 ) {
		selected_day = day_3;
	}
	else if ( data_day == 4 ) {
		selected_day = day_4;
	}
	else if ( data_day == 'all' ) {
		selected_day = day_all;
	}

	if ( selected_day == day_all ) {
		$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').addClass('active');
	}
	else {
		$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').removeClass('active');

		$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').each(function () {
			$(this).find('.gal_item__date').find('span:contains("' + selected_day + '")').parent().parent().addClass('active');
		});
	}



	$('.gal_menu_days').find('li').removeClass('active');
	$('.gal_menu_days').find('li').find('a[data-day="' + data_day + '"]').parent().addClass('active');
});



// show only gallery of first day at page load
$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').each(function () {
	$(this).find('.gal_item__date').find('span:contains("' + day_1 + '")').parent().parent().addClass('active');
});



function current_day_on_load() {
	// получаем значение парметра из URL
	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				// return sParameterName[1] === undefined ? true : sParameterName[1];
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	};

	// check if there are any parameters in the URL
	var queryString = window.location.search;

	if ( queryString.length ) {
		// проверяем переменные из URL при загрузке страницы и создаём массив из переменных
		if ( getUrlParameter('day') == '' ) {
			day = '0';
		}
		else {
			day = getUrlParameter('day');
		}



		if ( day == 1 ) {
			selected_day = day_1;
		}
		else if ( day == 2 ) {
			selected_day = day_2;
		}
		else if ( day == 3 ) {
			selected_day = day_3;
		}
		else if ( day == 4 ) {
			selected_day = day_4;
		}
		else if ( day == 'all' ) {
			selected_day = day_all;
		}

		if ( selected_day == day_all ) {
			$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').addClass('active');
		}
		else {
			$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').removeClass('active');

			$('.blog__photo').find('.blog__items_wrap').find('> div').find('> div').each(function () {
				$(this).find('.gal_item__date').find('span:contains("' + selected_day + '")').parent().parent().addClass('active');
			});
		}

		$('.gal_menu_days').find('li').removeClass('active');
		$('.gal_menu_days').find('li').find('a[data-day="' + day + '"]').parent().addClass('active');
	}
}

current_day_on_load();


