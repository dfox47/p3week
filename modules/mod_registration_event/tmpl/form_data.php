<?php
/*error_reporting (E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);*/

require_once dirname(__FILE__).'/assets/PHPMailer-5.1.0/class.phpmailer.php';

//Массив с наимонованием чекбоксов
$label_array = array(
    //Дополнительная информация, Откуда узнали
    'know' => array(
        1 => 'Информация в Интернет',
        2 => 'Информация в социальных сетях (Facebook/Twitter/др)',
        3 => 'Информация в газете/журнале',
        4 => 'Информация на ТВ/радио',
        5 => 'Информация от коллег/партнеров',
        6 => 'Личное письмо/приглашение от Оргкомитета',
        7 => 'Рассылка по e-mail',
        8 => 'Рабочие заседания/деловые мероприятия',
    ),

    //Дополнительная информация, Причина посещения мероприятия
    'cause' => array(
        1 => 'Актуальность тематики',
        2 => 'Обмен опытом',
        3 => 'Поиск бизнес-партнеров/клиентов',
        4 => 'Поиск квалифицированных кадров',
        5 => 'Поиск новых технологий, проектов, идей',
        6 => 'Привлечение инвестиций',
        7 => 'Представление собственных технологий, проектов, идей',
        8 => 'Участие ведущих экспертов',
        9 => 'PR компании/Личный PR',
    ),

    //Выберите Дни мероприятия
    //1-ый день
    'day1' => array(
        //1 => 'Пленарное заседание &laquo;Идеология ГЧП или ГЧП как идеология&raquo;',
        7 => 'Практическая сессия &laquo;Государство - квалифицированный заказчик: как грамотно подготовить проект ГЧП и оценить эффективность его реализации&raquo;',
        4 => 'Международный семинар «ГЧП в России: правила игры для зарубежных инвесторов»',
        2 => 'Панельная дискуссия «Модернизация инфраструктуры России: эффект бабочки» или «принцип домино»?',
        3 => 'Юридические дебаты &laquo;Обсуждение законодательства о ГЧП&raquo;',
        5 => 'Прогноз-сессия «Частные операторы объектов социального обеспечения»',
       // 6 => 'Приветственный коктейль для участников Недели ГЧП',
    ),

    //2-ой день
    'day2' => array(
        1 => 'Пленарное заседание «Роль ГЧП в решении инфраструктурных проблем мегаполиса»',
        2 => 'Открытое совещание по вопросам развития инфраструктуры городского транспорта',
        3 => 'Экспертная сессия «Возможности ГЧП в сфере энергообеспечения и энергоэффективности»',
        4 => 'Экспертная сессия &laquo;ГЧП в здравоохранении&raquo;',
        6 => 'Открытый диалог &laquo;Особенности тарифного регулирования в сфере ЖКХ&raquo;',
        5 => 'Панельная дискуссия &laquo;Аэропорты – источник импульса регионального развития&raquo;',
        8 => 'Экспертная сессия «Роль рискового страхования в повышении доступности специализированной медицинской помощи»',
        7 => 'Церемония вручения Российской национальной премии в сфере инфраструктуры &laquo;ROSINFRA&raquo;. PPP Business Party.',
    ),

    //3-ий день
    'day3' => array(
        //1 => 'Обзорная сессия &laquo;ГЧП в обеспечении обороны и безопасности&raquo;',
        2 => 'Выездное заседание Совета ВПК при Правительстве РФ по развитию ГЧП в интересах создания и производства нового поколения вооружения, военной и специальной техники',
        //3 => 'Рабочая группа по вопросу применения механизмов ГЧП при разработке, внедрении и эксплуатации комплексных информационных систем обеспечения безопасности',
       // 4 => 'Образовательные программы в МГИМО (У) МИД РФ',
        //5 => 'Рабочая группа по перспективам применения механизмов ГЧП  в отношении объектов военной инфраструктуры и инфраструктуры обеспечения общественной безопасности',
       // 6 => 'Рабочая группа по перспективам применения механизмов ГЧП  в отношении объектов военной инфраструктуры и инфраструктуры обеспечения общественной безопасности',
        //7 => 'Культурная программа',
    )
);

$body_tmp = '';
$mail_body = '';

$data = array();

if (isset($_REQUEST['validate'], $_REQUEST['contact']['mail'])){
        header("Content-type: application/json");
        echo JFactory::getDBO()->setQuery('SELECT COUNT(*) FROM `#__meetings` WHERE `contact_mail` = "'.mysql_escape_string($_REQUEST['contact']['mail']).'"')->loadResult();
        exit;

}

//Если пользователь нажал галку лецензия и выбрал роль
if (isset($_POST['license']) && !empty($_POST['license']) && isset($_POST['user_role']) && !empty($_POST['user_role'])) {
    $data['user_role'] = $_POST['user_role'];
    $body_tmp .= '<p><b>Роль :</b> ' . $_POST['user_role'] . '</p>';
    //Предполагаемая тема выступления
    if(isset($_POST['topic']) && !empty($_POST['topic'])){
        $body_tmp .= '<p><b>Предполагаемая тема выступления :</b> ' . $_POST['topic'] . '</p>';
        $data['topic'] = $_POST['topic'];
    }

//Персональная информация
    if (isset($_POST['pi']) && !empty($_POST['pi']) && count($_POST['pi']) >= 4) {
        $data['pi_surname'] = $_POST['pi']['surname'];
        $data['pi_name'] = $_POST['pi']['name'];
        $data['pi_patronymic'] = $_POST['pi']['patronymic'];
        $data['pi_pol'] = $_POST['pi']['pol'];
        $data['pi_birthday'] = $_POST['pi']['birthday'];

        $body_tmp .= '<li>Фамилия : ' . $_POST['pi']['surname'] . '</li>';
        $body_tmp .= '<li>Имя : ' . $_POST['pi']['name'] . '</li>';
        $body_tmp .= '<li>Отчество : ' . $_POST['pi']['patronymic'] . '</li>';
        $body_tmp .= '<li>Пол : ' . $_POST['pi']['pol'] . '</li>';
        $body_tmp .= '<li>Дата рождения : ' . $_POST['pi']['birthday'] . '</li>';

        $mail_body .= '<ul><b>Персональная информация:</b> ' . $body_tmp . '</ul>';
    }


//Паспортные данные
    if (isset($_POST['pass']) && !empty($_POST['pass']) && count($_POST['pass']) < 8) {

        $data['pass_citizenship'] = $_POST['pass']['citizenship'];
        $data['pass_series'] = $_POST['pass']['series'];
        $data['pass_number'] = $_POST['pass']['number'];
        $data['pass_country'] = $_POST['pass']['country'];
        $data['pass_city'] = $_POST['pass']['city'];

        $body_tmp = '<li>Гражданство : ' . $_POST['pass']['citizenship'] . '</li>';
        $body_tmp .= '<li>Паспорт : Серия - ' . $_POST['pass']['series'] . ' Номер - ' . $_POST['pass']['number'] . '</li>';
        $body_tmp .= '<li>Место рождения : Страна - ' . $_POST['pass']['country'] . ', Город - ' . $_POST['pass']['city'] . '</li>';
        //Адрес регистрации

        $data['pass_adds_index'] = $_POST['pass']['adds']['index'];
        $data['pass_adds_country'] = $_POST['pass']['adds']['country'];
        $data['pass_adds_region'] = $_POST['pass']['adds']['region'];
        $data['pass_adds_city'] = $_POST['pass']['adds']['city'];
        $data['pass_adds_street'] = $_POST['pass']['adds']['street'];
        $data['pass_adds_house'] = $_POST['pass']['adds']['house'];
        $data['pass_adds_structure'] = $_POST['pass']['adds']['structure'];
        $data['pass_adds_apartment'] = $_POST['pass']['adds']['apartment'];

        $body_tmp .= '<li>Адрес регистрации  : <ul>';
        $body_tmp .= '<li>Индекс: ' . $_POST['pass']['adds']['index'] . '</li>';
        $body_tmp .= '<li>Страна: ' . $_POST['pass']['adds']['country'] . '</li>';
        $body_tmp .= '<li>Регион: ' . $_POST['pass']['adds']['region'] . '</li>';
        $body_tmp .= '<li>Город: ' . $_POST['pass']['adds']['city'] . '</li>';
        $body_tmp .= '<li>Улица: ' . $_POST['pass']['adds']['street'] . '</li>';
        $body_tmp .= '<li>Дом: ' . $_POST['pass']['adds']['house'] . '</li>';
        $body_tmp .= '<li>Строение: ' . $_POST['pass']['adds']['structure'] . '</li>';
        $body_tmp .= '<li>Корпус: ' . $_POST['pass']['adds']['housing'] . '</li>';
        $body_tmp .= '<li>Квартира: ' . $_POST['pass']['adds']['apartment'] . '</li>';
        $body_tmp .= '</ul></li>';

        $mail_body .= '<ul><b>Паспортные данные:</b> ' . $body_tmp . '</ul>';
    }


//Контактные данные
    if (isset($_POST['contact']) && !empty($_POST['contact']) && count($_POST['contact']) === 3) {

        $data['contact_name'] = $_POST['contact']['name'];
        $data['contact_phone'] = $_POST['contact']['phone'];
        $data['contact_mail'] = $_POST['contact']['mail'];

        $body_tmp = '<li>Контактное лицо (ФИО) : ' . $_POST['contact']['name'] . '</li>';
        $body_tmp .= '<li>Телефон : ' . $_POST['contact']['phone'] . '</li>';
        $body_tmp .= '<li>E-mail : ' . $_POST['contact']['mail'] . '</li>';

        $mail_body .= '<ul><b>Контактные данные:</b> ' . $body_tmp . '</ul>';
    }


//Данные об организации
    if (isset($_POST['org']) && !empty($_POST['org']) && count($_POST['org']) < 12) {

        $data['org_name'] = $_POST['org']['name'];
        $data['org_form'] = $_POST['org']['form'];
        $data['org_post'] = $_POST['org']['post'];
        $data['org_industry'] = $_POST['org']['industry'];
        $data['org_country'] = $_POST['org']['country'];
        $data['org_city'] = $_POST['org']['city'];
        $data['org_phone'] = $_POST['org']['phone'];
        $data['org_site'] = $_POST['org']['site'];

        $body_tmp = '<li>Наименование организации : ' . $_POST['org']['name'] . '</li>';
        $body_tmp .= '<li>Организационно-правовая форма  : ' . $_POST['org']['form'] . '</li>';
        $body_tmp .= '<li>Должность : ' . $_POST['org']['post'] . '</li>';
        $body_tmp .= '<li>Отраслевая принадлежность : ' . $_POST['org']['industry'] . '</li>';
        $body_tmp .= '<li>Страна : ' . $_POST['org']['country'] . '</li>';
        $body_tmp .= '<li>Город : ' . $_POST['org']['city'] . '</li>';
        $body_tmp .= '<li>Телефон/Факс : ' . $_POST['org']['phone'] . '</li>';
        $body_tmp .= '<li>Интернет-сайт : ' . $_POST['org']['site'] . '</li>';
        //Адрес организации

        $data['org_adds_index'] = $_POST['org']['adds']['index'];
        $data['org_adds_country'] = $_POST['org']['adds']['country'];
        $data['org_adds_region'] = $_POST['org']['adds']['region'];
        $data['org_adds_city'] = $_POST['org']['adds']['city'];
        $data['org_adds_street'] = $_POST['org']['adds']['street'];
        $data['org_adds_house'] = $_POST['org']['adds']['house'];
        $data['org_adds_structure'] = $_POST['org']['adds']['structure'];
        $data['org_adds_housing'] = $_POST['org']['adds']['housing'];
        $data['org_adds_apartment'] = $_POST['org']['adds']['apartment'];

        $body_tmp .= '<li>Адрес организации  : <ul>';
        $body_tmp .= '<li>Индекс: ' . $_POST['org']['adds']['index'] . '</li>';
        $body_tmp .= '<li>Страна: ' . $_POST['org']['adds']['country'] . '</li>';
        $body_tmp .= '<li>Регион: ' . $_POST['org']['adds']['region'] . '</li>';
        $body_tmp .= '<li>Город: ' . $_POST['org']['adds']['city'] . '</li>';
        $body_tmp .= '<li>Улица: ' . $_POST['org']['adds']['street'] . '</li>';
        $body_tmp .= '<li>Дом: ' . $_POST['org']['adds']['house'] . '</li>';
        $body_tmp .= '<li>Строение: ' . $_POST['org']['adds']['structure'] . '</li>';
        $body_tmp .= '<li>Корпус: ' . $_POST['org']['adds']['housing'] . '</li>';
        $body_tmp .= '<li>Квартира: ' . $_POST['org']['adds']['apartment'] . '</li>';
        $body_tmp .= '</ul></li>';

        $mail_body .= '<ul><b>Данные об организации:</b> ' . $body_tmp . '</ul>';
    }


//Дополнительная информация
//Откуда Вы узнали о мероприятии
    $body_tmp = '';
    if (isset($_POST['add_info']['know']) && !empty($_POST['add_info']['know'])) {

        $data['add_info_know'] = '';

        foreach ($_POST['add_info']['know'] as $key => $value) {
            if ($key === 'other' && !empty($value)){
                $data['add_info_know'] .= ', '.$_POST['add_info']['know']['other'];
                $body_tmp .= '<li>Другое - ' . $_POST['add_info']['know']['other'] . '</li>';
            }
            else {
                $data['add_info_know'] .= ', '.$label_array['know'][$value];
                $body_tmp .= '<li>' . $label_array['know'][$value] . '</li>';
            }
        }

        $data['add_info_know'] = trim($data['add_info_know'], ', ');

        $mail_body .= '<ul><b>Откуда Вы узнали о мероприятии:</b> ' . $body_tmp . '</ul>';
    }


//Откуда Вы узнали о мероприятии
    $body_tmp = '';
    if (isset($_POST['add_info']['cause']) && !empty($_POST['add_info']['cause'])) {

        $data['add_info_cause'] = '';

        foreach ($_POST['add_info']['cause'] as $key => $value) {
            if ($key === 'other' && !empty($value)){
                $data['add_info_cause'] .= ', '.$_POST['add_info']['cause']['other'];
                $body_tmp .= '<li>Другое - ' . $_POST['add_info']['cause']['other'] . '</li>';
            }
            else {
                $data['add_info_cause'] .= ', '.$label_array['cause'][$value];
                $body_tmp .= '<li>' . $label_array['cause'][$value] . '</li>';
            }
        }

        $data['add_info_cause'] = trim($data['add_info_cause'], ', ');

        $mail_body .= '<ul><b>Причина посещения мероприятия:</b> ' . $body_tmp . '</ul>';
    }
//Комментарий
    if (isset($_POST['add_info']['comment']) && !empty($_POST['add_info']['comment'])) {

        $data['add_info_comment'] = $_POST['add_info']['comment'];
        $mail_body .= '<p><b>Комментарий:</b> ' . $_POST['add_info']['comment'] . '</p>';
    }
//Дни мероприятия
//1-й день
    $body_tmp = '';
    if (isset($_POST['days']['day1']) && !empty($_POST['days']['day1'])) {

        $data['days_day1'] = '';

        foreach ($_POST['days']['day1'] as $key => $value) {
            $data['days_day1'] .= ','.$value;
            $body_tmp .= '<li>' . $label_array['day1'][$value] . '</li>';
        }

        $data['days_day1'] = trim($data['days_day1'], ', ');

        $mail_body .= '<ul><b>День 1:</b> ' . $body_tmp . '</ul>';
    }

//2-й день
    $body_tmp = '';
    if (isset($_POST['days']['day2']) && !empty($_POST['days']['day2'])) {

        $data['days_day2'] = '';

        foreach ($_POST['days']['day2'] as $key => $value) {
            $data['days_day2'] .= ','.$value;
            $body_tmp .= '<li>' . $label_array['day2'][$value] . '</li>';
        }

        $data['days_day2'] = trim($data['days_day2'], ', ');

        $mail_body .= '<ul><b>День 2:</b> ' . $body_tmp . '</ul>';
    }

//3-й день
    $body_tmp = '';
    if (isset($_POST['days']['day3']) && !empty($_POST['days']['day3'])) {
        foreach ($_POST['days']['day3'] as $key => $value) {
            $data['days_day3'] .= ','.$value;
            $body_tmp .= '<li>' . $label_array['day3'][$value] . '</li>';
        }

        $data['days_day3'] = trim($data['days_day3'], ', ');

        $mail_body .= '<ul><b>День 3:</b> ' . $body_tmp . '</ul>';
    }

    $data['days_all'] = $_POST['days']['days_all'];
//Пркрепленный файл
    if(isset($_FILES['add_info_foto']) && !empty($_FILES['add_info_foto'])){
        $uploaddir = '/home/u190838/p3week.ru/www/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['add_info_foto']['name']);

        if (!move_uploaded_file($_FILES['add_info_foto']['tmp_name'], $uploadfile)) {
            echo "Не могу загрузить файл";
        }
        else {
            $uploaded = true;
        }
    }

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->From = $_POST['contact']['mail'];
    $mail->FromName = $_POST['pi']['surname'] . ' ' .$_POST['pi']['name'];
    $mail->Subject = 'p3week.ru Регистрация на мероприятие';
    $mail->Body    = $mail_body;

    $mail->addAddress('info@p3week.ru');
    $mail->addAddress('dred@inetsys.ru');
    $mail->addReplyTo($_POST['contact']['mail'], $_POST['pi']['surname'] . ' ' .$_POST['pi']['name']);
    $mail->isHTML(true);

    //Проверяем прикреплен ли к форме файл
    if(!empty($uploaded)){
        $mail->addAttachment($uploadfile);
        $data['file'] = $uploadfile;
    }

    if($mail->send()) {
        //Тело сообщения для пользователя
        $user_mail_body = '<h4>Уважаем'.($_POST['pi']['pol']==='Мужской'?'ый ':'ая ').$_POST['pi']['name'].' '.$_POST['pi']['patronymic'].'!</h4>
                            <br>Благодарим Вас за регистрацию на Российскую неделю ГЧП 2014. Ваша заявка на участие будет рассмотрена в течение 2-3 рабочих дней, после чего с Вами свяжется сотрудник Исполнительной дирекции Российской недели ГЧП для подтверждения регистрации.<br><br>

                            Подробнее с программой Недели ГЧП и другой информацией Вы можете ознакомиться на сайте www.p3week.ru<br><br>
                            Если у Вас возникли вопросы или предложения, мы с радостью ответим по телефону +7 495 988 77 13 или по электронной почте <a href="mailto:info@p3week.ru">info@p3week.ru</a> !<br><br>
                            С уважением,<br>
                            Исполнительная дирекция<br>
                            Российской недели ГЧП 2014.<br>';


        $user_mail = new PHPMailer;
        $user_mail->CharSet = 'UTF-8';
        $user_mail->From = 'info@p3week.ru';
        $user_mail->FromName = 'Администратор p3week.ru';
        $user_mail->Subject = 'p3week.ru Регистрация на мероприятие';
        $user_mail->Body    = $user_mail_body."<br><b>Данные, которые Вы указали:</b><br>".$mail_body;

        $user_mail->addAddress($_POST['contact']['mail']);
        $user_mail->addReplyTo('info@p3week.ru', 'Администратор p3week.ru');
        $user_mail->isHTML(true);
        //Если сообщение отправляется пользователю, то выводим сообщение что все ок
        if($user_mail->send()){
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$user_mail_body.'</div>';
        }
    }

    if(!empty($data)){

        foreach ($data as $key => $value) {
            if ($value === '' || $value === null){
                unset($data[$key]);
            }
            else {
                $data[$key] = "`{$key}` =  '".mysql_escape_string(trim($value))."'";
            }
        }
        $sql = "INSERT INTO `p3week_meetings` SET ".implode(', ', $data);
        JFactory::getDBO()->setQuery($sql)->query();
    }

    //dred@inetsys.ru,info@p3week.ru
   /* if(mail('', 'p3week.ru Регистрация на мероприятие', $mail_body, $headers)){
        //Заголовки для пользователя заполнивший форму
        $user_headers = 'From: p3week site  <info@p3week.ru>' . "\r\n" .
                        'Reply-To: Администратор p3week.ru <info@p3week.ru>' . "\r\n" .
                        'Content-Type: text/html; charset=ISO-8859-1 '. "\r\n";
        //Шаблон письма и сообщения, в случае удачной регистрации
        $user_mail_body = '<h4>Уважаемый '.$_POST['pi']['name'].' '.$_POST['pi']['patronymic'].'!</h4>
                            <br>Благодарим Вас за регистрацию на Российскую неделю ГЧП 2014. Ваша заявка на участие будет рассмотрена в течение 2-3 рабочих дней, после чего с Вами свяжется сотрудник Исполнительной дирекции Российской недели ГЧП для подтверждения регистрации.<br><br>
                            После подтверждения регистрации от сотрудника Исполнительной дирекции Российской недели ГЧП Вы сможете получить логин и пароль для авторизации на сайте и использования специальных разделов.<br><br>
                            Подробнее с программой Недели ГЧП и другой информацией Вы можете ознакомиться на сайте www.p3week.ru<br><br>
                            Если у Вас возникли вопросы или предложения, мы с радостью ответим по телефону +7 495 988 77 13 или по электронной почте <a href="mailto:info@p3week.ru">info@p3week.ru</a> !<br><br>
                            С уважением,<br>
                            Исполнительная дирекция<br>
                            Российской недели ГЧП 2014.<br>';


        mail($_POST['contact']['mail'], 'p3week.ru Регистрация на мероприятие', $user_mail_body, $user_headers);

        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$user_mail_body.'</div>';
    }*/
}