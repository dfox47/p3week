$(function () {
    //Правка шаблона страницы
    $('#right, #organizer').hide();
    //$('#left').append($('#right').html());
    $('#content').width(835).css('margin-right', 0).css('background-color', 'whitesmoke');

    clist = {ru: false, en:false, current: 'ru'};
    //Список стран
    $.getJSON( "/modules/mod_registration_event/tmpl/assets/country.json", function(country_list) {
        var country_html = '';
        clist.ru = country_list;
        $.each(country_list, function(key, value){
            country_html += '<option value="'+value+'" '+(key == 'RU' ? 'selected' : '') +'>'+value+'</option>';
        });
        $('.country_list').html(country_html);
    });

    $.getJSON( "/modules/mod_registration_event/tmpl/assets/country-en.json", function(country_list) {
        clist.en = country_list;
    });

    //Инициализация дейтпикеров
    $('.datepicker').datepicker({
        startView: 2,
        language: "ru",
        autoclose: true,
        format: 'dd.mm.yyyy',
    });
    $('#pi_birthday').on('change', function(){
        register_form.field('pi[birthday]').validate();
    });

    //Группировка чекбоксов в расписании
    $('.cb_group').change(function(){
        if($(this).is(":checked")) {
            $('.cb_group[data-group="'+$(this).attr('data-group')+'"]:checked').attr("checked", false);
            $(this).prop("checked", true);
        }
    });
    //Нажатие на чекбок "Все дни"
    $('#days_all').change(function(){
        if($(this).is(":checked")){
            $('.cb_group[data-group="1"], .cb_group[data-group="2"], .cb_group[data-group="3"], .cb_group[data-group="4"], .cb_group[data-group="5"]').prop('checked', false);
            $('#day1_c1, #day1_c7, #day1_c3, #day2_c1, #day2_c2, #day2_c6, #day2_c7, #day3_c2, #day1_all, #day2_all, #day3_all').prop( "checked", true );
        }
        else
            $('.day1_wrap, .day2_wrap, .day3_wrap').find(':checkbox').prop( "checked", false );
    });

    //Нажатие на 1-й день мероприятия
    $('#day1_all').change(function(){
        if($(this).is(":checked")){
            $('.cb_group[data-group="1"]').prop('checked', false);
            $('#day1_c1, #day1_c7, #day1_c3').prop('checked', true);
        }
        else
            $('.day1_wrap').find(':checkbox').prop('checked', false);

    });
    //Нажатие на 2-й день мероприятия
    $('#day2_all').change(function(){
        if($(this).is(":checked")){
            $('.cb_group[data-group="2"], .cb_group[data-group="3"]').prop('checked', false);
            $('#day2_c1, #day2_c2, #day2_c6, #day2_c7').prop('checked', true);
        }
        else
            $('.day2_wrap').find(':checkbox').prop('checked', false);

    });
    //Нажатие на 3-й день мероприятия
    $('#day3_all').change(function(){
        if($(this).is(":checked")){
            $('.cb_group[data-group="4"], .cb_group[data-group="5"]').prop('checked', false);
            $('#day3_c2').prop('checked', true);
        }
        else
            $('.day3_wrap').find(':checkbox').prop('checked', false);

    });
    //Нажатие на любой день мероприятия
    $('#all-days input:checkbox').change(function(){
        if($(this).is(":checked")){
            $('#days_all').prop('checked', true);
            register_form.field('days[days_all]').delRule('*');
        }else{
           /* if($('.all-days input:checked').length == 1 && )
                $('#day1_all').prop('checked', false);*/
        }
    });
    //Нажатие на мероприятие 1го дня
    $('.day1_wrap input:checkbox').change(function(){
        if($(this).is(":checked")){
            $('#day1_all').prop('checked', true);
        }else{
            if($('.day1_wrap input:checked').length == 1)
                $('#day1_all').prop('checked', false);
        }
    });
    //Нажатие на мероприятие 2го дня
    $('.day2_wrap input:checkbox').change(function(){
        if($(this).is(":checked")){
            $('#day2_all').prop('checked', true);
        }else{
            if($('.day2_wrap input:checked').length == 1)
                $('#day2_all').prop('checked', false);
        }
    });
    //Нажатие на мероприятие 3го дня
    $('.day3_wrap input:checkbox').change(function(){
        if($(this).is(":checked")){
            $('#day3_all').prop('checked', true);
        }else{
            if($('.day3_wrap input:checked').length == 1)
                $('#day3_all').prop('checked', false);
        }
    });
    //Нажатие на кнопки роль
    //1 - Спикер, спонсор
    //2 - СМИ
    //3 - Участник
    $('.role').click(function () {
        $('#main_form').hide();

        var role = $(this).attr('data-role');
        $('#user_role').val($(this).text());
        if(role == 1){
            if($('.cause input:checked').length == 0){
                register_form.field('add_info[cause][other]').setRules('*');    
            }

            register_form.field('add_info_foto').setRules('*');
            register_form.field('topic').setRules('*');
            register_form.field('contact[name]').setRules('*');

            $('*[role="1"]').show();
        }else if(role == 3){
            if($('.cause input:checked').length == 0){
                register_form.field('add_info[cause][other]').setRules('*');
            }
            
            register_form.field('add_info_foto').delRule('*');
            register_form.field('topic').delRule('*');
            register_form.field('contact[name]').setRules('*');
            
            $('*[role="1"]').show(); 
        }
        else{
        	register_form.field('contact[name]').delRule('*');
            register_form.field('add_info[cause][other]').delRule('*');
            register_form.field('add_info_foto').delRule('*');
            register_form.field('topic').delRule('*');

            $('*[role="1"]').hide();
        }

        $('#main_form').show();
    });

	rules_text = {
		topic 			: 'Необходимо указать предполагаемую тему выступления', 
		pi_name 		: 'Необходимо указать имя',
		pi_surname		: 'Необходимо указать фамилию',
		pi_patronymic	: 'Необходимо указать отчество',
		pi_birthday		: 'Необходимо указать дату рождения',

		pass_series		: 'Необходимо указать серию паспорта',
		pass_number		: 'Необходимо указать номер паспорта',
		pass_city		: 'Необходимо указать город рождения',
		pass_adds_city	: 'Необходимо указать город адреса регистрации',
		pass_adds_street: 'Необходимо указать улицу адреса регистрации',
		pass_adds_house	: 'Необходимо указать дом адреса регистрации',

		contact_name    : 'Необходимо указать контактное лицо',
        contact_phone   : 'Необходимо указать контактный телефон',
        contact_mail    : 'Необходимо указать контактный e-mail',

        org_name        : 'Необходимо указать наименование организации',
        org_post        : 'Необходимо указать Должность',
        org_city        : 'Необходимо указать Данные об организации (Город)',
        org_phone       : 'Необходимо указать Данные об организации (Телефон/Факс)',
        org_site        : 'Необходимо указать Интернет-сайт',
        org_adds_index  : 'Длина индекса города должна быть равна 6',
        org_adds_city   : 'Необходимо указать адрес организации (город)',
        org_adds_street : 'Необходимо указать адрес организации (улица)',
        org_adds_house  : 'Необходимо указать адрес организации (дом)',

        //Дополнительная информация
        add_info_foto    : 'Необходимо прикрепить Вашу фотографию',
        'add_info_know-0': 'Укажите, откуда Вы узнали о мероприятии',
        'add_info_cause-0': 'Укажите причину посещения мероприятия',

        //Дни мероприятия
        days_all   : 'Выберите Дни мероприятия, в которых Вы примите участие',

        //обработка моих персональных данных
        license         : 'Необходимо согласиться с обработкой Ваших персональных данных'



	};

	$('#form_submit').click(function(){
		$('.validation_errors').html('');
		$('.error').each(function(key, value){
			$('.validation_errors').append('<li data-target="'+$(value).attr('id')+'">'+rules_text[$(value).attr('id')] + '</li>');
		});
	});

    //Валидация формы
     register_form = new tFormer('register-form', {
        // обработчик ошибок валидации
        onerror: function(){ 
        	//Записываем все ошибки в массив
        	/*if(rules_text[$(this).attr('id')] !== undefined){
        		//current_rule[$(this).attr('id')] = 3;
        	}*/

            if($(this).attr('data-tip') !== undefined){
                $(this).qtip({
                    content: {
                        text: $(this).attr('data-tip'),
                        title: 'Поле обязательно для заполнения'
                    },
                    show: 'focus',
                    hide: 'blur',
                    style: { classes: 'qtip-bootstrap' },
                    position: {
                        my: 'left top ',
                        at: 'top right',
                        adjust: { x: 5 }
                    }
                });
            }
            //console.log($(this));
        },
       /* onvalid: function(){
        	if(current_rule[$(this).attr('id')] !== undefined){
        		delete current_rule[$(this).attr('id')];
        	}
        },*/
        //
        fields: {
            topic                   : '*',
            //Персональная информация
            'pi[surname]'           : '*',
            'pi[name]'              : '*',
            'pi[patronymic]'        : '*',
            'pi[birthday]'          : '*',

            //Паспортные данные
            //'pass[series]'          : '*',
            //'pass[number]'          : '*',
            //'pass[city]'            : '*',

            //'pass[adds][city]'      : '*',
            //'pass[adds][street]'    : '*',
            //'pass[adds][house]'     : '*',

            //Контактные данные
            'contact[name]'         : '*',
            'contact[phone]'        : '*',
            'contact[mail]'         :	{
                rules:  '* @',
                request: {
                    url   : '/registration/join',
                    method: 'post',
                    data  : {
                        validate: 1,
                    },
                    start : function (){
                        console.log( 'request validation started' );
                    },
                    end   : function (result){
                        if(parseInt($.trim(result)) >  0){
                            alert('Пользователь с таким email уже зарегестрирован');
                            return false;
                        }
                        return true;
                    }
                }
            },

            //Данные об организации
            'org[name]'             : '*',
            'org[post]'             : '*',
            'org[city]'             : '*',
            'org[phone]'            : '*',
            'org[site]'             : '*',

            'org[adds][city]'       : '*',
            'org[adds][street]'     : '*',
            'org[adds][house]'      : '*',

            //Дополнительная информация
            add_info_foto           : '*',
            'add_info[know][other]' : '*',
            'add_info[cause][other]': '*',

            //Дни мероприятия
            'days[days_all]'        : '*',

            //обработка моих персональных данных
            license                 : '*'
        }
    });
	//Валидируем сразу после загрузки
	$('#register-form').submit();
    //Нажатие на чекбокс "Нет отчества"
    $('#non_patronymic').change(function(){
        if($(this).is(":checked")){
            register_form.field('pi[patronymic]').delRule('*');
            $('#pi_patronymic').prop( "disabled", true );
        }
        else{
            register_form.field('pi[patronymic]').setRules('*');
            $('#pi_patronymic').prop( "disabled", false );
        }
    });
    //Валидация группы чекбоксов "Откуда Вы узнали о мероприятии"
    $('.know input:checkbox').change(function(){
        if($('.know input:checked').length){
            register_form.field('add_info[know][other]').delRule('*');
        }else register_form.field('add_info[know][other]').setRules('*');

    });
    //Валидация группы чекбоксов "Причина посещения мероприятия"
    $('.cause input:checkbox').change(function(){
        if($('.cause input:checked').length){
            register_form.field('add_info[cause][other]').delRule('*');
        }else register_form.field('add_info[cause][other]').setRules('*');

    });


});
