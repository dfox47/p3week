<?  require_once 'form_data.php'; ?>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<script src="/bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="/bootstrap/bootstrap-datepicker/css/datepicker.css"/>


<script src="/bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/bootstrap/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js"></script>

<link rel="stylesheet" href="/modules/mod_registration_event/tmpl/assets/qtip2/jquery.qtip.min.css">
<script src="/modules/mod_registration_event/tmpl/assets/qtip2/jquery.qtip.js"></script>

<script src="/modules/mod_registration_event/tmpl/assets/tFormer.js"></script>

<script src="/modules/mod_registration_event/tmpl/assets/form.js"></script>

<style>
    .container.register-container {
        width: 810px !important;
    }

    .required {
        color: red;
    }

    hr {
        height: 0px;
    }

    #leftmenu {
        margin: 0 !important;
    } 

    #leftmenu li {
        list-style: none;
    }
    .error{
        border: 1px solid red !important;
    }
    .validation_errors{
        clear: both;

    }
    .validation_errors li{
        background: none; 
        color: red;       
    }
    div.controls #pi_birthday{
        display: block !important;
    }
</style>

<script>
$(function(){

    $('.lang').click(function(){
        if(clist.current !== $(this).attr('lang')){
            var country_html = '';
            $.each(clist[$(this).attr('lang')], function(key, value){
                country_html += '<option value="'+value+'" '+(key == 'RU' ? 'selected' : '') +'>'+value+'</option>';
            });
            $('.country_list').html(country_html);

            //Замена основных элементов
            $('*[lang-en]').each(function(){
                var temp = $(this).html();
                $(this).html($(this).attr('lang-en'));
                $(this).attr('lang-en', temp);
            });

            //Замена плейсхолдеров
            $('*[lang-en-pl]').each(function(){
                var temp = $(this).attr('placeholder');
                $(this).attr('placeholder', $(this).attr('lang-en-pl'));
                $(this).attr('lang-en-pl', temp);
            });

           $('.datepicker').datepicker('remove').datepicker({
                startView: 2,
                language: $(this).attr('lang'),
                autoclose: true,
                format: 'dd.mm.yyyy',
            });

            //$('#org_form option').show();
            if($(this).attr('lang') == 'en'){
                $('#org_form').hide().prop('disabled', true);
                $('#org_form-en').show().prop('disabled', false);

                $('#org_industry').hide().prop('disabled', true);
                $('#org_industry-en').show().prop('disabled', false);

                $('#agreement').attr('href', '/tmp/Anouncement.pdf');
            }else{
                $('#org_form-en').hide().prop('disabled', true);
                $('#org_form').show().prop('disabled', false);

                $('#org_industry-en').hide().prop('disabled', true);
                $('#org_industry').show().prop('disabled', false);

                $('#agreement').attr('href', '/tmp/agreed.pdf');
            }
           

        }
        clist.current = $(this).attr('lang');
    });
});
    
</script>
<form class="form-horizontal" id="register-form" method="post" enctype="multipart/form-data" >
<div class="container register-container">

<fieldset class="wis_all">
    <legend lang-en="Select your role:">Выберите Вашу роль:</legend>
    <div class="btn-group" data-toggle="buttons-radio">
        <button type="button" class="role btn" data-role="3" lang-en="Participant">Участник</button>
        <button type="button" class="role btn" data-role="1" lang-en="Speaker">Спикер</button>
        <button type="button" class="role btn" data-role="1" lang-en="Sponsor">Спонсор</button>
        <button type="button" class="role btn btn-danger" data-role="2">СМИ</button>
    </div>

    <div class="btn-group pull-right form-lang" data-toggle="buttons-radio">
        <button type="button" class="btn active lang" lang="ru">RU</button>
        <button type="button" class="btn lang" lang="en">ENG</button>
    </div>

    <input name="user_role" type="hidden" id="user_role" value="1"/><br/><br/>
    <div  role="1" style="display: none">
        <label class="control-label" for="topic" style="width:260px;margin-right: 20px" lang-en="Expected topic of the speech: <span class='required'>*</span>">Предполагаемая тема выступления: <span class="required">*</span></label>
        <input id="topic" name="topic" type="text" placeholder="(Для спикеров)" lang-en-pl="(for speakers)" class="input-xlarge" >
    </div>

</fieldset>
<div id="main_form" style="display: none">
<fieldset>
    <legend lang-en="Personal information">Персональная информация</legend>

    <div class="row-fluid">

        <div class="span6">
            <div class="control-group">
                <label class="control-label" for="pi_surname" lang-en="Family name <span class='required'>*</span>">Фамилия <span class="required">*</span></label>

                <div class="controls">
                    <input id="pi_surname" name="pi[surname]" type="text" placeholder="Фамилия" lang-en-pl="Family name" data-tip="Укажите корректно фамилию (поле должно содержать только буквы русского алфавита)">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="pi_name" lang-en="First name <span class='required'>*</span>">Имя <span class="required">*</span></label>

                <div class="controls">
                    <input id="pi_name" name="pi[name]" type="text" placeholder="Имя" lang-en-pl="First name" data-tip="Укажите корректно имя (поле должно содержать только буквы русского алфавита)" >
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="pi_patronymic" lang-en="Patronymic <span class='required'>*</span>">Отчество <span class="required">*</span></label>

                <div class="controls">
                    <input id="pi_patronymic" name="pi[patronymic]" type="text" placeholder="(При наличии)" lang-en-pl="Patronymic" data-tip="Укажите корректно отчество (поле должно содержать только буквы русского алфавита)">
                    <label class="help-block checkbox" for="non_patronymic">
                        <input type="checkbox" name="non_patronymic" id="non_patronymic"><span lang-en="No patronymic">Нет отчества</span>
                    </label>
                </div>

            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <label class="control-label" lang-en="Gender <span class='required'>*</span>">Пол <span class="required">*</span></label>

                <div class="controls">
                    <label class="radio" for="pi_pol_male">
                        <input type="radio" name="pi[pol]" id="pi_pol_male" value="Мужской" checked="checked"><span lang-en="Male">Мужской</span>
                    </label>
                    <label class="radio" for="pi_pol_female">
                        <input type="radio" name="pi[pol]" id="pi_pol_female" value="Женский"><span lang-en="Female">Женский</span>
                    </label>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="pi_birthday" lang-en="Birth date <span class='required'>*</span>">Дата рождения <span class="required">*</span></label>

                <div class="controls">
                    <input id="pi_birthday" class="datepicker" name="pi[birthday]" type="text" placeholder="(ДД.ММ.ГГ)" lang-en-pl="(DD.MM.YYYY)" data-tip="Укажите корректно дату рождения"/>
                </div>
            </div>
        </div>


    </div>
</fieldset>


<fieldset>
    <legend lang-en="Passport data">Паспортные данные</legend>

    <div class="row-fluid">
        <div class="span6">

            <div class="control-group">
                <label class="control-label"><span lang-en="Citizenship (state the country)">Гражданство</span> <span class="required">*</span></label>

                <div class="controls">
                    <select class="country_list" name="pass[citizenship]"></select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="pass_series"><span lang-en="Passport">Паспорт</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="pass_series" name="pass[series]" type="text" placeholder="Серия" class="span6" lang-en-pl="Series" data-tip="Серия Вашего паспорта.<br>Поле может содержать только цифры.<br>Размерность поля 4 символа.">
                    <input id="pass_number" name="pass[number]" type="text" placeholder="Номер" class="span6" lang-en-pl="Number" data-tip="Номер Вашего паспорта.<br>Поле может содержать только цифры.<br>Размерность поля 6 символов.">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="pass_city"><span lang-en="Place of birth">Место рождения</span> <span class="required">*</span>:</label>

                <div class="controls">
                    <select class="country_list" name="pass[country]"></select>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input id="pass_city" name="pass[city]" type="text" placeholder="Город" lang-en-pl="City" data-tip="Ваш город рождения. По паспорту.">
                </div>
            </div>


        </div>

        <div class="span6">

            <div class="control-group">
                <label class="control-label" for="pass_adds_index"><span lang-en="Registered address">Адрес регистрации</span> <span class="required">*</span>:</label>

                <div class="controls">
                    <input id="pass_adds_index" name="pass[adds][index]" type="text" lang-en-pl="Postcode" placeholder="Индекс" class="span4" maxlength="6">
                    <select class="span8 country_list" name="pass[adds][country]"></select>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input id="pass_adds_region" name="pass[adds][region]" type="text" placeholder="Регион" lang-en-pl="Region" class="span6">
                    <input id="pass_adds_city" name="pass[adds][city]" type="text" placeholder="Город *" lang-en-pl="City*" class="span6" data-tip="Укажите корректно название города (поле должно содержать только буквы русского алфавита)">
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input id="pass_adds_street" name="pass[adds][street]" type="text" placeholder="Улица*" lang-en-pl="Street*" class="span9" data-tip="Укажите корректно название улицы (поле должно содержать только буквы русского алфавита)">
                    <input id="pass_adds_house" name="pass[adds][house]" type="text" placeholder="Дом*" lang-en-pl="House*" class="span3" data-tip="Введите правильный номер дома">
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input id="pass_adds_structure" name="pass[adds][structure]" type="text" placeholder="Строение" lang-en-pl="Building" class="span4">
                    <input id="pass_adds_housing" name="pass[adds][housing]" type="text" placeholder="Корпус" lang-en-pl="Block" class="span4">
                    <input id="pass_adds_apartment" name="pass[adds][apartment]" type="text" placeholder="Квартира" lang-en-pl="Apartment" class="span4">
                </div>
            </div>

        </div>
    </div>
</fieldset>

<fieldset>
    <legend lang-en="Contact details">Контактные данные</legend>

    <div class="row-fluid">
        <div class="span6">

            <div class="control-group" role="1">
                <label class="control-label" for="contact_name"><span lang-en="Contact persons">Контактное лицо</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="contact_name" name="contact[name]" type="text" placeholder="ФИО" lang-en-pl="full name">

                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="contact_phone"><span lang-en="Contact phone">Контактный телефон</span> <span
                        class="required">*</span></label>

                <div class="controls">
                    <input id="contact_phone" name="contact[phone]" type="text" placeholder="Телефон" lang-en-pl="Contact phone" data-tip="Укажите корректный телефонный номер (поле должно содержать только цифры)">
                </div>
            </div>

        </div>

        <div class="span6">

            <div class="control-group">
                <label class="control-label" for="contact_mail">E-mail <span class="required">*</span></label>

                <div class="controls">
                    <input id="contact_mail" name="contact[mail]" type="text" placeholder="E-mail" data-tip="Введите корректный e-mail">
                </div>
            </div>

        </div>
    </div>
</fieldset>

<fieldset>
    <legend lang-en="Company details">Данные об организации</legend>

    <div class="row-fluid">
        <div class="span6">

            <div class="control-group">
                <label class="control-label" for="org_name"><span lang-en="Name">Наименование организации</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="org_name" name="org[name]" type="text" placeholder="( без кавычек )" lang-en-pl="(without quotation marks)" data-tip="Укажите правильное наименование организации (поле не должно содержать кавычек)">

                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="org_form"><span lang-en="Form of incorporation">Организационно-правовая форма</span> <span class="required">*</span></label>

                <div class="controls">
                    <select name="org[form]" id="org_form">
                        <option lang-hide="ru">АНО</option>
                        <option lang-hide="ru">АО</option>
                        <option lang-hide="ru">ЗАО</option>
                        <option lang-hide="ru">Казеное учреждение</option>
                        <option lang-hide="ru">КФХ</option>
                        <option lang-hide="ru">МУП</option>
                        <option lang-hide="ru">НП</option>
                        <option lang-hide="ru">ОАО</option>
                        <option lang-hide="ru">ОДО</option>
                        <option selected lang-hide="ru">ООО</option>
                        <option lang-hide="ru">ПИФ</option>
                        <option lang-hide="ru">Потребительский кооператив</option>
                        <option lang-hide="ru">Производственный кооператив</option>
                        <option lang-hide="ru">Товарищество</option>
                        <option lang-hide="ru">ТСЖ</option>
                        <option lang-hide="ru">Унитарное предприятие</option>
                        <option lang-hide="ru">ФГБУ</option>
                        <option lang-hide="ru">ФКУ</option>
                        <option lang-hide="ru">ФГУП</option>
                        <option lang-hide="ru">Фонд</option>
                        <option>PLC.</option>
                        <option>Ltd</option>
                        <option>Inc.</option>
                        <option>Corp.</option>
                        <option>LLC</option>
                        <option>LDC</option>
                        <option>IBC</option>
                        <option>IC</option>
                        <option>& Со</option>
                        <option>LP</option>
                        <option>SA</option>
                        <option>SARL</option>
                        <option>BV</option>
                        <option>NV</option>
                        <option>AVV</option>
                        <option>GmbH</option>
                        <option>AG</option>
                    </select>

                    <select name="org[form]" style="display:none" disabled id="org_form-en">
                        <option>PLC.</option>
                        <option>Ltd</option>
                        <option selected>Inc.</option>
                        <option>Corp.</option>
                        <option>LLC</option>
                        <option>LDC</option>
                        <option>IBC</option>
                        <option>IC</option>
                        <option>& Со</option>
                        <option>LP</option>
                        <option>SA</option>
                        <option>SARL</option>
                        <option>BV</option>
                        <option>NV</option>
                        <option>AVV</option>
                        <option>GmbH</option>
                        <option>AG</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="org_post"><span lang-en="Position">Должность</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="org_post" name="org[post]" type="text" placeholder="Должность" lang-en-pl="Position" data-tip="Укажите корректно должность">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="org_industry"><span lang-en="Industry">Отраслевая принадлежность</span> <span class="required">*</span></label>

                <div class="controls">
                    <select name="org[industry]" id="org_industry">
                        <option>СМИ</option>
                        <option>Государственный и муниципальный сектор</option>
                        <option>Добывающие отрасли</option>
                        <option>ЖКХ, ВКХ, ТБО</option>
                        <option>Здравоохранение</option>
                        <option>Информационные технологии</option>
                        <option>Консалтинг</option>
                        <option>НИОКР, технологии, инновации</option>
                        <option>Обрабатывающие производства</option>
                        <option>Образование</option>
                        <option>Операции с недвижимостью</option>
                        <option>Прочее</option>
                        <option>Сектор услуг</option>
                        <option>Сельское хозяйство</option>
                        <option selected>Строительство и проектирование</option>
                        <option>Торговля</option>
                        <option>Транспорт, связь, инфраструктура</option>
                        <option>Финансовая деятельность</option>
                        <option>Энергетика и промышленная инфраструктура</option>
                        <option>Инвестиции</option>
                    </select>
                    
                    <select name="org[industry]" style="display:none" disabled id="org_industry-en">
                        <option>Public and municipal sector</option>
                        <option>Extractive industries</option>
                        <option>Housing and utilities, water supply, municipal solid waste</option>
                        <option>Health care</option>
                        <option>Information technologies</option>
                        <option>Consulting</option>
                        <option>R&D, technologies, innovations</option>
                        <option>Processing and manufacturing</option>
                        <option>Education</option>
                        <option>Real estate activities</option>
                        <option>Miscellaneous</option>
                        <option>Services</option>
                        <option>Agriculture</option>
                        <option>Construction and designing</option>
                        <option>Trade</option>
                        <option>Transport, communications, infrastructure</option>
                        <option>Financial activities</option>
                        <option>Energy and industrial infrastructure</option>
                    </select>

                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="org_country"><span lang-en="Country">Страна</span> <span class="required">*</span></label>

                <div class="controls">
                    <select class="country_list" id="org_country" name="org[country]" placeholder="Страна" lang-en-pl="Country" ></select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="org_city"><span lang-en="City">Город</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="org_city" name="org[city]" type="text" placeholder="Город" lang-en-pl="City" data-tip="Укажите корректно название города (поле должно содержать только буквы русского алфавита)">
                </div>
            </div>


        </div>

        <div class="span6">

            <div class="control-group">
                <label class="control-label" for="org_phone"><span lang-en="Tel./fax">Телефон/Факс</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="org_phone" name="org[phone]" type="text" placeholder="Телефон/Факс" lang-en-pl="Tel./fax" data-tip="Введите корректный номер телефона/факса (поле должно содержать только цифры)">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="org_site"><span lang-en="Internet site">Интернет-сайт</span> <span class="required">*</span></label>

                <div class="controls">
                    <input id="org_site" name="org[site]" type="text" placeholder="www.p3week.ru" data-tip="Введите правильное наименование интернет-сайта">
                </div>
            </div>
            <br><br>

            <div class="control-group">
                <label class="control-label" for="org_adds_index"><span lang-en="Postal address">Почтовый адрес</span> <span class="required">*</span>:</label>

                <div class="controls">
                    <input id="org_adds_index" name="org[adds][index]" type="text" placeholder="Индекс" lang-en-pl="Postcode"  class="span4">
                    <select class="span8 country_list" name="org[adds][country]"></select>
                </div>
            </div>


            <div class="control-group">
                <div class="controls">
                    <input id="org_adds_region" name="org[adds][region]" type="text" placeholder="Регион" lang-en-pl="Region" class="span6">
                    <input id="org_adds_city" name="org[adds][city]" type="text" placeholder="Город*" lang-en-pl="City*" class="span6" data-tip="Укажите корректно название города (поле должно содержать только буквы русского алфавита)">
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input id="org_adds_street" name="org[adds][street]" type="text" placeholder="Улица*" lang-en-pl="Street*" class="span9" data-tip="Укажите корректно название улицы (поле должно содержать только буквы русского алфавита)">
                    <input id="org_adds_house" name="org[adds][house]" type="text" placeholder="Дом*" lang-en-pl="House*" class="span3" data-tip="Введите правильный номер дома">
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <input id="org_adds_structure" name="org[adds][structure]" type="text" placeholder="Строение" lang-en-pl="Building"class="span4">
                    <input id="org_adds_housing" name="org[adds][housing]" type="text" placeholder="Корпус" lang-en-pl="Block"class="span4">
                    <input id="org_adds_apartment" name="org[adds][apartment]" type="text" placeholder="Квартира" lang-en-pl="Apartment"class="span4">
                </div>
            </div>

        </div>
    </div>
</fieldset>

<fieldset>
    <legend lang-en="Additional information">Дополнительная информация</legend>
    <div class="control-group">
        <label class="control-label"><span lang-en="How did you learn about the event">Откуда Вы узнали о мероприятии</span> <span class="required">*</span></label>

        <div class="controls">
            <div class="row-fluid know">
                <div class="span6">
                    <label class="checkbox" for="add_info_know-1">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-1" value="1"><span lang-en="Information on the Internet">Информация в Интернет</span>
                    </label>
                    <label class="checkbox" for="add_info_know-2">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-2" value="2"><span lang-en="Information in social networks (Facebook/ Twitter/other)">Информация в социальных сетях (Facebook/Twitter/др)</span>
                    </label>
                    <label class="checkbox" for="add_info_know-3">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-3" value="3"><span lang-en="Information in newspaper/magazine">Информация в газете/журнале</span>
                    </label>
                    <label class="checkbox" for="add_info_know-4">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-4" value="4"><span lang-en="Information on TV/radio">Информация на ТВ/радио</span>
                    </label>
                    <label class="checkbox" for="add_info_know-5">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-5" value="5"><span lang-en="Information from colleagues/partners">Информация от коллег/партнеров</span>
                    </label>
                </div>
                <div class="span6">
                    <label class="checkbox" for="add_info_know-6">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-6" value="6"><span lang-en="Personal letter/invitation from the Organizing Committee">Личное письмо/приглашение от Оргкомитета</span>
                    </label>
                    <label class="checkbox" for="add_info_know-7">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-7" value="7"><span lang-en="E-mail newsletter">Рассылка по e-mail</span>
                    </label>
                    <label class="checkbox" for="add_info_know-8">
                        <input type="checkbox" name="add_info[know][]" id="add_info_know-8" value="8"><span lang-en="Working sessions/ business events">Рабочие заседания/деловые мероприятия</span>
                    </label>
                    <br>

                    <div class="input-prepend">
                        <span class="add-on" lang-en="Other:">Иное:</span>
                        <input id="add_info_know-0" name="add_info[know][other]"  lang-en-pl="Other" placeholder="Указать" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr role="1">

    <div class="control-group" role="1">
        <label class="control-label"><span lang-en="Reason to participate in the event">Причина посещения мероприятия</span> <span class="required">*</span><br><br>(<span lang-en="please, specify up to 3 items">указать не
            более 3х пунктов</span>)</label>

        <div class="controls">
            <div class="row-fluid cause">
                <div class="span6">
                    <label class="checkbox" for="add_info_cause-1">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-1" value="1"><span lang-en="Timeliness of the topic">Актуальность тематики</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-2">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-2" value="2"><span lang-en="Exchange of experience">Обмен опытом</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-3">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-3" value="3"><span lang-en="Looking for business partners/ clients">Поиск бизнес-партнеров/клиентов</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-4">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-4" value="4"><span lang-en="Looking for qualified personnel">Поиск квалифицированных кадров</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-5">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-5" value="5"><span lang-en="Looking for new technologies, projects, ideas">Поиск новых технологий, проектов, идей</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-6">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-6" value="6"><span lang-en="Presentation of own technologies, projects, ideas">Привлечение инвестиций</span>
                    </label>
                </div>
                <div class="span6">
                    <label class="checkbox" for="add_info_cause-7">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-7" value="7"><span lang-en="Attraction of investments">Представление собственных технологий, проектов, идей</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-8">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-8" value="8"><span lang-en="Participation of leading experts">Участие ведущих экспертов</span>
                    </label>
                    <label class="checkbox" for="add_info_cause-9">
                        <input type="checkbox" name="add_info[cause][]" id="add_info_cause-9" value="9"><span lang-en="PR campaigns/ Personal PR">PR компании/Личный PR</span>
                    </label>
                    <br>

                    <div class="input-prepend">
                        <span class="add-on" lang-en="Other:">Иное:</span>
                        <input id="add_info_cause-0" name="add_info[cause][other]" lang-en-pl="Other" placeholder="Указать" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr/>

    <div class="row-fluid">
        <div class="span6">

            <div class="control-group">
                <label class="control-label" for="add_info_comment" lang-en="Comments">Комментарий</label>

                <div class="controls">
                    <textarea id="add_info_comment" name="add_info[comment]" placeholder="Комментарий" lang-en-pl="Comments" rows="3" style="resize:none;"></textarea>
                </div>
            </div>
        </div>

        <div class="span6" role="1">

            <div class="control-group">
                <label class="control-label" for="add_info_foto"><span lang-en="Photo <br>(for speakers)">Фотография <br>(для спикеров)</span><span class="required">*</span></label>

                <div class="controls">
                    <input id="add_info_foto" name="add_info_foto" type="file">
                </div>
            </div>

        </div>
    </div>
    <hr/>

</fieldset>

<fieldset id="all-days">
<legend lang-en="Please, select days and activities in which you will participate">Выберите Дни мероприятия, в которых Вы примите участие</legend>
<label class="checkbox" for="days_all">
    <input type="checkbox" name="days[days_all]" id="days_all" value="1"><span lang-en="All days">Все дни мероприятия</span>
</label>
<div class="day1_wrap">
<div class="row-fluid">
    <div class="offset1">
        <label class="checkbox" for="day1_all">
            <input type="checkbox" name="days[day1][all]" id="day1_all" value="0"><strong lang-en="1<sup>st</sup> day">1-ый день</strong>
        </label>
        <span lang-en="March 11, 2014">11 марта 2014</span><br><br><span lang-en="PPP Ideology – International Development Summit">Международный саммит развития &laquo;Идеология ГЧП&raquo;</span>
        <span class="required">*</span> :<br><br>
    </div>
</div>

<div class="control-group">
    <label class="control-label">10.00 - 12.00</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day1_c1">
                    <input type="checkbox" name="days[day1][]" id="day1_c1" value="1"><span lang-en="Plenary session &laquo;PPP ideology or PPP as ideology&raquo;">Пленарное заседание &laquo;Идеология
                    ГЧП или ГЧП как идеология&raquo;</span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="control-group">
    <label class="control-label">13.00 - 15.30</label>

    <div class="controls">
        <div class="row-fluid">
            
            <div class="span4">
                <label class="checkbox" for="day1_c7">
                    <input type="checkbox" name="days[day1][]" id="day1_c7" value="7" class="cb_group" data-group="1"><span lang-en="Practical session “The State as a qualified customer: how to competently prepare a PPP project and to evaluate the effectiveness of its implementation”">Практическая сессия &laquo;Государство - квалифицированный заказчик: как грамотно подготовить проект ГЧП и оценить эффективность его реализации&raquo;</span>
                </label>
            </div>

            <div class="span4">
                <label class="checkbox" for="day1_c4">
                    <input type="checkbox" name="days[day1][]" id="day1_c4" value="4" class="cb_group" data-group="1"><span  lang-en="Open joint session of the Innovative Development Group of the Foreign Investment Advisory Council and the Group on Modernization and Innovation of the Association of European Businesses">Международный семинар «ГЧП в России: правила игры для зарубежных инвесторов»</span>
                </label>
            </div>

            <div class="span4">
                <label class="checkbox" for="day1_c2">
                    <input type="checkbox" name="days[day1][]" id="day1_c2" value="2" class="cb_group" data-group="1"><span lang-en="Panel discussion Modernization of Russian infrastructure: “butterfly effect” or  “domino principle”">Панельная дискуссия
«Модернизация инфраструктуры России: эффект бабочки» или «принцип домино»?</span>
                </label>
            </div>

        </div>
    </div>
</div>

<div class="control-group">
    <label class="control-label">16.00 - 18.00</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day1_c3">
                    <input type="checkbox" name="days[day1][]" id="day1_c3" value="3" class="cb_group" data-group="2"><span lang-en="Legal debates “Discussing PPP legislation”">Юридические дебаты &laquo;Обсуждение законодательства о ГЧП&raquo;</span>
                </label>
            </div>
            <div class="span4">
                <label class="checkbox" for="day1_c5">
                    <input type="checkbox" name="days[day1][]" id="day1_c5" value="5" class="cb_group" data-group="2"><span lang-en="Prognosis session “Private operators of social security facilities”">Прогноз-сессия &laquo;Частные операторы объектов социального обеспечения&raquo;</span>
                </label>
            </div>
           
        </div>
    </div>
</div>

</div>

<hr>
<div class="day2_wrap">
<div class="row-fluid">
    <div class="offset1">
        <label class="checkbox" for="day2_all">
            <input type="checkbox" name="days[day2][all]" id="day2_all" value="0"><strong lang-en="2<sup>nd</sup> day">2-ой день</strong>
        </label>
        <span lang-en="March 12, 2014 ">12 марта 2014</span><br>
        <br><span lang-en="Infrastructure of Russian cities — Urban Development Forum">Форум регионального развития «Инфраструктура российских городов»</span> <span class="required">*</span> :<br><br>
    </div>
</div>

<div class="control-group">
    <label class="control-label">10.00 - 12.00</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day2_c1">
                    <input type="checkbox" name="days[day2][]" id="day2_c1" value="1"><span  lang-en="Plenary session &laquo;PPP role in solving infrastructural problems of megalopolises&raquo;">Пленарное заседание &laquo;Роль ГЧП в решении инфраструктурных проблем мегаполиса&raquo;</span>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="control-group">
    <label class="control-label">13.00 - 15.30</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day2_c2">
                    <input type="checkbox" name="days[day2][]" id="day2_c2" value="2" class="cb_group" data-group="3"><span lang-en="Open conference on city transport infrastructure development">Открытое совещание по вопросам развития инфраструктуры городского транспорта</span>
                </label>
            </div>
            <div class="span4">
                <label class="checkbox" for="day2_c3">
                    <input type="checkbox" name="days[day2][]" id="day2_c3" value="3" class="cb_group" data-group="3"><span lang-en="Focus group “PPP opportunities in the power supply and the energy efficiency”">Экспертная сессия «Возможности ГЧП в сфере энергообеспечения и энергоэффективности»</span>
                </label>
            </div>
            <div class="span4">
                <label class="checkbox" for="day2_c4">
                    <input type="checkbox" name="days[day2][]" id="day2_c4" value="4" class="cb_group" data-group="3"><span lang-en="Expert session “PPP in health care”">Экспертная сессия &laquo;ГЧП в здравоохранении&raquo;</span>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="control-group">
    <label class="control-label">16.00 - 18.00</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day2_c6">
                    <input type="checkbox" name="days[day2][]" id="day2_c6" value="6" class="cb_group" data-group="4"><span lang-en="Open dialogue “Specifics of tariff regulation in the housing and utilities sector”">Открытый диалог &laquo;Особенности тарифного регулирования в сфере ЖКХ&raquo;</span>
                </label>
            </div>
            <div class="span4">
                <label class="checkbox" for="day2_c5">
                    <input type="checkbox" name="days[day2][]" id="day2_c5" value="5" class="cb_group" data-group="4"><span lang-en="Panel discussion “Airports as a source of impetus for regional development”">Панельная дискуссия &laquo;Аэропорты – источник импульса регионального развития&raquo;</span>
                </label>
            </div>
            <div class="span4">
                <label class="checkbox" for="day2_c8">
                    <input type="checkbox" name="days[day2][]" id="day2_c8" value="8" class="cb_group" data-group="4"><span lang-en="Expert session “Role of risk insurance in providing easier access to specialized medical aid”">Экспертная сессия «Роль рискового страхования в повышении доступности специализированной медицинской помощи»</span>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="control-group">
    <label class="control-label">18.30 - 20.30</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day2_c7">
                    <input type="checkbox" name="days[day2][]" id="day2_c7" value="7"><span lang-en="Award ceremony of the ROSINFRA National Prize in infrastructure">Церемония вручения Российской
                    национальной премии в сфере инфраструктуры &laquo;ROSINFRA&raquo;. PPP Business Party.</span>
                </label>
            </div>
        </div>
    </div>
</div>
</div>

<hr>

<div class="day3_wrap">
<div class="row-fluid">
    <div class="offset1">
        <label class="checkbox" for="day3_all">
            <input type="checkbox" name="days[day3][all]" id="day3_all" value="0"><strong lang-en="3<sup>rd</sup> day">3-ий день</strong>
        </label>
        <span lang-en="March 13, 2014">13 марта 2014</span>
        <br>
        <br><span lang-en="PPP in Defence – National Congress">«Национальный конгресс «Государственно-частное партнерство в сфере обеспечения обороны»</span> <span class="required">*</span> :<br><br>
    </div>
</div>

<div class="control-group">
    <label class="control-label">11.00 - 12.30<br/>13.00 - 15.00</label>

    <div class="controls">
        <div class="row-fluid">
            <div class="span4">
                <label class="checkbox" for="day3_c2">
                    <input type="checkbox" name="days[day3][]" id="day3_c2" value="2" class="cb_group" data-group="5" ><span lang-en="Visiting session of Military-Industrial Commission Board under the Russian Government in the interest of creation and production of a new generation of weapons, military and special purpose equipment">Выездное заседание Совета ВПК при Правительстве РФ по развитию ГЧП в интересах создания и производства нового поколения вооружения, военной и специальной техники</span>
                </label>
            </div>            
        </div>
    </div>
</div>
<hr>
</div>
</fieldset>

<label class="checkbox pull-left" for="license">
    <input type="checkbox" name="license" id="license"><span lang-en="I give consent to processing of my personal data">C обработкой персональных данных согласен</span> <span
        class="required">*</span> <a href="/tmp/agreed.pdf" target="_blank" id="agreement" lang-en="AGREEMENT">СОГЛАШЕНИЕ</a>
</label>
<button class="btn btn-danger pull-right" type="submit" id="form_submit" lang-en="Join">Зарегистрироваться</button>
<ul class="validation_errors"></ul>
</div>
</div>
</form>