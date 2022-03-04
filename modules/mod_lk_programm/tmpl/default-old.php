<?php defined('_JEXEC') or die('(@)|(@)');
?>
<style>
	.checkbox input{
		margin: 2px 0 0;
	}
	#issue-forma1 tr {
		height: 50px;
	}
</style>


<?
	$current_user = JFactory::getUser();
$lang = JFactory::getLanguage();
$curlang =  $lang->getTag();
?>

<?php if('en-GB' == $curlang ): ?>
	<h3>SELECT THE DAYS AND ACTIVITIES IN WHICH YOU TAKE PART</h3>
<?php elseif('ru-RU' == $curlang ): ?>
	<h3>ВЫБЕРИТЕ ДНИ И МЕРОПРИЯТИЯ, В КОТОРЫХ ВЫ ПРИМИТЕ УЧАСТИЕ</h3>
<?php endif; ?>

<?php
	$counter = 1;
foreach ($items4 as $item4) {
	$imyaU = $item4->imya;
	$otchestvo = $item4->otchestvo;
	$organizatsiya = $item4->organizatsionnopravovayaforma.' '.$item4->organizatsiya;
	$dolzhnost = $item4->dolzhnost;
	$kontaktnyytelefon = $item4->kontaktnyytelefon;
	$Email = $item4->email;
}
if (!$items){
	echo "
<form class='form-reg form-horizontal' id='issue-forma" . $counter . "' name='issue-forma" . $counter . "' method='post' action=''>
	<table class='uchasnikitbl'>
		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march17'>29 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer01 != '' ? 'checked' : '')." name='17MAR10001200' type='checkbox' value='Пленарное заседание «ГЧП в развитии региональной инфраструктуры: практика, проблемы, перспективы»'>--><span>Пленарное заседание
«Инвестиции в инфраструктуру страны – импульс для развития территорий»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 14.30</b>
			</td>
			<td class='selectone0 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer02 != '' ? 'checked' : '')." name='17MAR123014301' type='checkbox' value='Презентационная сессия «Лучшие практики управления сферой ГЧП»'>---><span>Презентационная сессия «Лучшие практики управления сферой ГЧП»</span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer03 != '' ? 'checked' : '')." name='17MAR123014302' type='checkbox' value='Мастер-класс «13 подзаконных актов закона о ГЧП: инструкция к применению»'>---><span>Юридические дебаты «Федеральный закон о ГЧП и 13 подзаконных актов: инструкция по применению»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone0 input').click(function() {
	if (this.checked == true)  { $('.selectone0 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone0 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.30 – 17.30</b>
			</td>
			<td class='selectone1 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer04 != '' ? 'checked' : '')." name='17MAR153018001' type='checkbox' value='Интерактивная сессия «ГЧП или ГОСЗАКАЗ: оценка эффективности и сравнительного преимущества проектов»'>---><span>Интерактивная сессия «ГЧП или ГОСЗАКАЗ: оценка эффективности и сравнительного преимущества проектов»  </span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer05 != '' ? 'checked' : '')." name='17MAR153018002' type='checkbox' value='Панельная дискуссия «Длинные» деньги в ГЧП: проектное финансирование и инфраструктурные облигации»'>---><span>Панельная дискуссия «Длинные» деньги в ГЧП: проектное финансирование и инфраструктурные облигации»</span></label></div>
				
			</td>
		</tr>
<script>
$('.selectone1 input').click(function() {
	if (this.checked == true)  { $('.selectone1 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone1 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>


		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march18'>30 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='selectone23 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer07 != '' ? 'checked' : '')." name='18MAR100012001' type='checkbox' value='Пленарное заседание «Поиск баланса интересов и минимизация рисков партнеров в транспортных инфраструктурных проектах»'>---><span>Пленарное заседание «Поиск баланса интересов и минимизация рисков партнеров в транспортных инфраструктурных проектах»</span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer07 != '' ? 'checked' : '')." name='18MAR100012001' type='checkbox' value='Пленарное заседание «Поиск баланса интересов и минимизация рисков партнеров в транспортных инфраструктурных проектах»'>---><span>Открытая дискуссия
«Концессии в ЖКХ: как запустить конвейер успешных проектов»
</span></label></div>
				
			</td>
			
		</tr>
<script>
$('.selectone23 input').click(function() {
	if (this.checked == true)  { $('.selectone23 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone23 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 14.30</b>
			</td>
			<td class='selectone2 head' style=' vertical-align: middle;'>
			<div class='checkbox'><label><!--<input ".($item5->mer08 != '' ? 'checked' : '')." name='18MAR123014301' type='checkbox' value='«Стресс-тест проектов, претендующих на финансирование из федерального дорожного фонда»'>---><span>«Стресс-тест проектов, претендующих на финансирование из федерального дорожного фонда»</span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer09 != '' ? 'checked' : '')." name='18MAR123014301' type='checkbox' value='Открытая дискуссия «Проекты фотовидеофиксации: концессия или нет?»  '>---><span>Круглый стол «Роль ГЧП в новой модели рынка обращения с ТБО»  </span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer10 != '' ? 'checked' : '')." name='18MAR123014302' type='checkbox' value='Стратегическая панель «Возможности развития аэропортовой инфраструктуры в рамках 224-ФЗ»'>--><span>Стратегическая панель «Возможности развития аэропортовой инфраструктуры в рамках 224-ФЗ»  </span></label></div>
			</td>
		</tr>
<script>
$('.selectone2 input').click(function() {
	if (this.checked == true)  { $('.selectone2 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone2 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.30 – 17.30</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer11 != '' ? 'checked' : '')." name='18MAR15001630' type='checkbox' value='Мастер-класс «Коммунальные концессии: распространенные ошибки и пути их решения»'>---><span>	Открытая дискуссия «Проекты фотовидеофиксации: концессия или нет?»</span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer11 != '' ? 'checked' : '')." name='18MAR15001630' type='checkbox' value='Круглый стол «Роль ГЧП в новой модели рынка обращения с ТКО»'>---><span>Открытая дискуссия «ГЧП в электроэнергетике»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone3 input').click(function() {
	if (this.checked == true)  { $('.selectone3 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone3 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>


		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march19'>31 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 15.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer12 != '' ? 'checked' : '')." name='19MAR10001130' type='checkbox' value='Открытая презентация ГЧП в здравоохранении: опыт регионов'>---><span>Открытая презентация ГЧП в здравоохранении: опыт регионов</span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer12 != '' ? 'checked' : '')." name='19MAR10001130' type='checkbox' value='Панельная дискуссия Новые возможности государственно-частного партнерства для развития инфраструктуры спорта'>---><span>Панельная дискуссия Новые возможности государственно-частного партнерства для развития инфраструктуры спорта</span></label></div>
				<div class='checkbox'><label><!--<input ".($item5->mer12 != '' ? 'checked' : '')." name='19MAR10001130' type='checkbox' value='Круглый стол «Культурные» проекты ГЧП: новая реальность»'>---><span>Круглый стол
«Культурные» проекты ГЧП: новая реальность»</span></label></div>
			</td>
		</tr>
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>16.00 – 17.30</b>
			</td>
			<td class='selectone4 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer13 != '' ? 'checked' : '')." name='19MAR120013301' type='checkbox' value='Пленарное заседание «ГЧП в социальной сфере: качество услуги и источники возврата инвестиций»'>---><span>Пленарное заседание «ГЧП в социальной сфере: качество услуги и источники возврата инвестиций»</span></label></div>	
			</td>
		</tr>
<script>
$('.selectone4 input').click(function() {
	if (this.checked == true)  { $('.selectone4 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone4 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>		
<script>
$('.selectone5 input').click(function() {
	if (this.checked == true)  { $('.selectone5 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone5 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		
<script>
$('.selectone33 input').click(function() {
	if (this.checked == true)  { $('.selectone33 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone33 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
</table>

<table>
		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march20'>1 апреля</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.20</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer20 != '' ? 'checked' : '')." name='20MAR10001120' type='checkbox' value='МОДУЛЬ I. ПРАВОВОЕ И ФИНАНСОВОЕ СТРУКТУРИРОВАНИЕ ПРОЕКТА ГЧП'>---><span>МОДУЛЬ I. ПРАВОВОЕ И ФИНАНСОВОЕ СТРУКТУРИРОВАНИЕ ПРОЕКТА ГЧП</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
		  <td width='120' class='head lkname' rowspan='2'  style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 10.40</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer21 != '' ? 'checked' : '')." name='20MAR11301300' type='checkbox' value='Группа 1 (Правовое структурирование) Мастер-класс: Законодательные изменения, способствующие расширению практики реализации проектов государственно-частного партнерства в России в 2016 г.'>---><span>Группа 1 (Правовое структурирование) Мастер-класс: Законодательные изменения, способствующие расширению практики реализации проектов государственно-частного партнерства в России в 2016 г.</span></label></div>
			</td></tr><tr>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer21 != '' ? 'checked' : '')." name='20MAR11301300' type='checkbox' value='Группа 2 (Финансовое структурирование) Мастер-класс: Ключевые принципы финансового структурирования проектов ГЧП'>---><span>Группа 2 (Финансовое структурирование)
Мастер-класс: Ключевые принципы финансового структурирования проектов ГЧП</span></label></div>
			</td>
		</tr>
		<tr class='uslov_table_7'>
		  <td class='head lkname' rowspan='2' style='text-align: center; vertical-align: middle;'>
				<b>10.40 – 11.20</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Группа 1 (Правовое структурирование) Case-study: подходы к определению оптимальной структуры соглашений о государственно-частном партнерстве (концессионных соглашений)'>---><span>Группа 1 (Правовое структурирование) Case-study: подходы к определению оптимальной структуры соглашений о государственно-частном партнерстве (концессионных соглашений)</span></label></div>
			</td></tr><tr class='uslov_table_7'>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Группа 2 (Финансовое структурирование) Case-study: подходы к определению оптимальной структуры финансирования проектов ГЧП в текущих условиях валютного рынка'>---><span>Группа 2 (Финансовое структурирование) Case-study: подходы к определению оптимальной структуры финансирования проектов ГЧП в текущих условиях валютного рынка</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td rowspan='2' class='head lkname'  style='text-align: center; vertical-align: middle;'>
				<b>11.20 – 12.20</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Группа 1 (Правовое структурирование) Экспертная сессия: наиболее распространенные заблуждения правового структурирования проектов ГЧП – работа над ошибками'>---><span>Группа 1 (Правовое структурирование) Экспертная сессия: наиболее распространенные заблуждения правового структурирования проектов ГЧП – работа над ошибками</span></label></div>
			</td></tr><tr>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Группа 2 (Финансовое структурирование) Экспертная сессия: поиск баланса интересов государственного и частного финансирования проектов'>---><span>Группа 2 (Финансовое структурирование)
Экспертная сессия: поиск баланса интересов государственного и частного финансирования проектов</span></label></div>
			</td>
		</tr>
		
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>13.00 – 15.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='МОДУЛЬ II.  ПОСТРОЕНИЕ МАТРИЦЫ РИСКОВ И ВЫБОР СПОСОБА ХЕДЖИРОВАНИЯ РИСКОВ'>---><span>МОДУЛЬ II.  ПОСТРОЕНИЕ МАТРИЦЫ РИСКОВ И ВЫБОР СПОСОБА ХЕДЖИРОВАНИЯ РИСКОВ</span></label></div>
			</td>			
		</tr>
		
		<tr class='user-row'>
			<td rowspan='2' class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>13.00 – 15.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Группа 1 (Правовое структурирование) Реализация проекта на основе концессионного соглашения: ключевые риски и «подводные камни» - юридический анализ (на примере конкретного проекта или проектов в субъекте РФ)'>---><span>Группа 1 (Правовое структурирование)
Реализация проекта на основе концессионного соглашения: ключевые риски и «подводные камни» - юридический анализ (на примере конкретного проекта или проектов в субъекте РФ)</span></label></div>
			</td></tr><tr>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Группа 2 (Финансовое структурирование) Реализация проекта на основе концессионного соглашения: ключевые риски и «подводные камни» со стороны концессионера – финансовый анализ (на примере конкретного проекта или проектов одной из инфраструктурных компаний)'>---><span>Группа 2 (Финансовое структурирование) Реализация проекта на основе концессионного соглашения: ключевые риски и «подводные камни» со стороны концессионера – финансовый анализ (на примере конкретного проекта или проектов одной из инфраструктурных компаний)</span></label></div>
			</td></tr>		
		<tr class='uslov_table_7'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>13.00 – 15.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><!--<input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='МОДУЛЬ III. ДЕЛОВАЯ ИГРА: ОЦЕНКА ВОЗМОЖНЫХ РИСКОВ ПРОЕКТА ГЧП И ПОСТРОЕНИЕ МАТРИЦЫ РИСКОВ. (ОДНА ГРУППА, РАЗДЕЛЕННАЯ НА НЕСКОЛЬКО КОМАНД)'>---><span>МОДУЛЬ III. ДЕЛОВАЯ ИГРА: ОЦЕНКА ВОЗМОЖНЫХ РИСКОВ ПРОЕКТА ГЧП И ПОСТРОЕНИЕ МАТРИЦЫ РИСКОВ. (ОДНА ГРУППА, РАЗДЕЛЕННАЯ НА НЕСКОЛЬКО КОМАНД)
 </span></label></div>
		  </td>			
  </tr>
		
	</table><br>
	<p class='underprog'><strong>Мероприятия образовательной программы доступны только при условии приобретения пакетов «<a href='/ru/uchastnikam/usloviya-uchastiya'>VIP</a>» или «<a href='/ru/uchastnikam/usloviya-uchastiya'>Образование</a>»</strong></p>

</form>
";

}
foreach ($items as $item5) {
	echo "
<form class='form-reg form-horizontal' id='issue-forma" . $counter . "' name='issue-forma" . $counter . "' method='post' action=''>
	<table class='uchasnikitbl'>
		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march17'>29 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer01 != '' ? 'checked' : '')." name='17MAR10001200' type='checkbox' value='Пленарное заседание
«Инвестиции в инфраструктуру страны – импульс для развития территорий»'><span>Пленарное заседание
«Инвестиции в инфраструктуру страны – импульс для развития территорий»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 14.30</b>
			</td>
			<td class='selectone0 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer02 != '' ? 'checked' : '')." name='17MAR123014301' type='checkbox' value='Презентационная сессия
«Рейтинг регионов 2016: лучшие практики управления сферой ГЧП»'><span>Презентационная сессия
«Рейтинг регионов 2016: лучшие практики управления сферой ГЧП»</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer03 != '' ? 'checked' : '')." name='17MAR123014302' type='checkbox' value='Юридические дебаты «Федеральный закон о ГЧП и 13 подзаконных актов: инструкция по применению»'><span>Юридические дебаты «Федеральный закон о ГЧП и 13 подзаконных актов: инструкция по применению»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone0 input').click(function() {
	if (this.checked == true)  { $('.selectone0 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone0 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.30 – 17.30</b>
			</td>
			<td class='selectone1 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer04 != '' ? 'checked' : '')." name='17MAR153018001' type='checkbox' value='Интерактивная сессия 
«ГЧП или ГОСЗАКАЗ: оценка эффективности и сравнительного преимущества проектов» '><span>Интерактивная сессия 
«ГЧП или ГОСЗАКАЗ: оценка эффективности и сравнительного преимущества проектов» </span></label></div>
				<div class='checkbox'><label><input ".($item5->mer05 != '' ? 'checked' : '')." name='17MAR153018002' type='checkbox' value='Панельная дискуссия «Длинные» деньги в ГЧП: проектное финансирование и инфраструктурные облигации»'><span>Панельная дискуссия «Длинные» деньги в ГЧП: проектное финансирование и инфраструктурные облигации»</span></label></div>				
			</td>
		</tr>
<script>
$('.selectone1 input').click(function() {
	if (this.checked == true)  { $('.selectone1 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone1 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>


		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march18'>30 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='selectone23 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer07 != '' ? 'checked' : '')." name='18MAR100012001' type='checkbox' value='Пленарная сессия
«Поиск баланса интересов и минимизация рисков партнеров в транспортных инфраструктурных проектах»'><span>Пленарная сессия «Поиск баланса интересов и минимизация рисков партнеров в транспортных инфраструктурных проектах»</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer08 != '' ? 'checked' : '')." name='18MAR100012002' type='checkbox' value='Открытая дискуссия
«Концессии в ЖКХ: как запустить конвейер успешных проектов?»'><span>Открытая дискуссия «Концессии в ЖКХ: как запустить конвейер успешных проектов?»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone23 input').click(function() {
	if (this.checked == true)  { $('.selectone23 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone23 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 14.30</b>
			</td>
			<td class='selectone2 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer09 != '' ? 'checked' : '')." name='18MAR123014301' type='checkbox' value='«Стресс-тест проектов, претендующих на финансирование из федерального дорожного фонда»'><span>«Стресс-тест проектов, претендующих на финансирование из федерального дорожного фонда»</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer10 != '' ? 'checked' : '')." name='18MAR123014302' type='checkbox' value='Круглый стол «Роль ГЧП в новой модели рынка обращения с ТБО»'><span>Круглый стол «Роль ГЧП в новой модели рынка обращения с ТБО»  </span></label></div>
				<div class='checkbox'><label><input ".($item5->mer10 != '' ? 'checked' : '')." name='18MAR123014302' type='checkbox' value='Стратегическая панель «Возможности развития аэропортовой инфраструктуры в рамках 224-ФЗ»'><span>Стратегическая панель «Возможности развития аэропортовой инфраструктуры в рамках 224-ФЗ»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone2 input').click(function() {
	if (this.checked == true)  { $('.selectone2 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone2 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.30 – 17.30</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer11 != '' ? 'checked' : '')." name='18MAR15001630' type='checkbox' value='Открытая дискуссия «Проекты фотовидеофиксации: концессия или нет?»'><span>Открытая дискуссия «Проекты фотовидеофиксации: концессия или нет?»</span></label></div>
<div class='checkbox'><label><input ".($item5->mer11 != '' ? 'checked' : '')." name='18MAR15001630' type='checkbox' value='Открытая дискуссия «ГЧП в электроэнергетике»'><span>Открытая дискуссия «ГЧП в электроэнергетике»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone3 input').click(function() {
	if (this.checked == true)  { $('.selectone3 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone3 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>


		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march19'>31 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer12 != '' ? 'checked' : '')." name='19MAR10001130' type='checkbox' value='Пленарное заседание «ГЧП в социальной сфере: качество услуги и источники возврата инвестиций»'><span>Пленарное заседание «ГЧП в социальной сфере: качество услуги и источники возврата инвестиций»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.00 – 13.30</b>
			</td>
			<td class='selectone4 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer13 != '' ? 'checked' : '')." name='19MAR120013301' type='checkbox' value='Открытая презентация
ГЧП в здравоохранении: опыт регионов'><span>Открытая презентация ГЧП в здравоохранении: опыт регионов</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer14 != '' ? 'checked' : '')." name='19MAR120013302' type='checkbox' value='Открытая дискуссия 
«Драйверы развития рынка услуг социального обслуживания пожилого населения в новой экономической реальности»'><span>Открытая дискуссия 
«Драйверы развития рынка услуг социального обслуживания пожилого населения в новой экономической реальности»</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer15 != '' ? 'checked' : '')." name='19MAR120013303' type='checkbox' value='Совместное заседание Координационного совета АСИ и Деловой России по развитию негосударственного сектора в социальной сфере'><span>Совместное заседание Координационного совета АСИ и Деловой России по развитию негосударственного сектора в социальной сфере</span></label></div>
			</td>
		</tr>
<script>
$('.selectone4 input').click(function() {
	if (this.checked == true)  { $('.selectone4 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone4 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.30 – 17.30</b>
			</td>
			<td class='selectone5 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer16 != '' ? 'checked' : '')." name='19MAR140015301' type='checkbox' value='Круглый стол «Культурные» проекты ГЧП: новая реальность»'><span>Круглый стол «Культурные» проекты ГЧП: новая реальность»</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer17 != '' ? 'checked' : '')." name='19MAR140015302' type='checkbox' value='Открытое заседание Рабочая группа стратегической инициативы «Новое качество жизни для людей с ограниченными возможностями здоровья'><span>Открытое заседание Рабочая группа стратегической инициативы «Новое качество жизни для людей с ограниченными возможностями здоровья</span></label></div>
				<div class='checkbox'><label><input ".($item5->mer18 != '' ? 'checked' : '')." name='19MAR140015303' type='checkbox' value='Панельная дискуссия «Новые возможности ГЧП для развития инфраструктуры спорта и туризма»'><span>Панельная дискуссия «Новые возможности ГЧП для развития инфраструктуры спорта и туризма»</span></label></div>
			</td>
		</tr>
<script>
$('.selectone5 input').click(function() {
	if (this.checked == true)  { $('.selectone5 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone5 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>		
<script>
$('.selectone33 input').click(function() {
	if (this.checked == true)  { $('.selectone33 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = true; });}
	if (this.checked == false) { $('.selectone33 input').each(function(){ this.checked = false; }); $(this).each(function(){ this.checked = false;  });}
});
</script>

		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march20'>1 апреля</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 11.20</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer20 != '' ? 'checked' : '')." name='20MAR10001120' type='checkbox' value='Модуль I: «Применение концессионных соглашений для развития инфраструктуры в регионах Российской Федерации» (1 группа).'><span>Модуль I: «Применение концессионных соглашений для развития инфраструктуры в регионах Российской Федерации» (1 группа).</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>11.30 – 13.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer21 != '' ? 'checked' : '')." name='20MAR11301300' type='checkbox' value='Модуль II: «Специфика концессионной модели от лидеров рынка» (2 группы – государственные служащие и представители частных компаний).'><span>Модуль II: «Специфика концессионной модели от лидеров рынка» (2 группы – государственные служащие и представители частных компаний).</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>14.00 – 17.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($item5->mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Модуль III. Деловая игра: «Принятие решения о возможности реализации проекта на основе механизма частной инициативы» (1 группа, разделенная на 2 команды).'><span>Модуль III. Деловая игра: «Принятие решения о возможности реализации проекта на основе механизма частной инициативы» (1 группа, разделенная на 2 команды).</span></label></div>
			</td>
		</tr>
	</table>
	<p class='underprog'><strong>Мероприятия образовательной программы доступны только при условии приобретения пакетов «<a href='/ru/uchastnikam/usloviya-uchastiya'>VIP</a>» или «<a href='/ru/uchastnikam/usloviya-uchastiya'>Образование</a>»</strong></p>
	
</form>
";
}

if ($_POST["prsubmit"]) {

	$input = new JInput;
	$post = $input->getArray($_POST);
	$user_id = $current_user->id;
	$mer01 = $post["17MAR10001200"];
	$mer02 = $post["17MAR123014301"];
	$mer03 = $post["17MAR123014302"];
	$mer04 = $post["17MAR153018001"];
	$mer05 = $post["17MAR153018002"];
	$mer06 = $post["17MAR153018003"];
	$mer07 = $post["18MAR100012001"];
	$mer08 = $post["18MAR100012002"];
	$mer09 = $post["18MAR123014301"];
	$mer10 = $post["18MAR123014302"];
	$mer11 = $post["18MAR15001630"];
	$mer12 = $post["19MAR10001130"];
	$mer13 = $post["19MAR120013301"];
	$mer14 = $post["19MAR120013302"];
	$mer15 = $post["19MAR120013303"];
	$mer16 = $post["19MAR140015301"];
	$mer17 = $post["19MAR140015302"];
	$mer18 = $post["19MAR140015303"];
	$mer19 = $post["19MAR16001800"];
	$mer20 = $post["20MAR10001120"];
	$mer21 = $post["20MAR11301300"];
	$mer22 = $post["20MAR14001700"];



	$title = "".$current_user->name." ".$imyaU." ".$otchestvo." cохранил(а) или изменил(а) программу";
	$from = 'p3week@p3week.ru';
	$to= 'p3week@p3week.ru';
	$header = "From: ".$from."\r\n";
	$header.= "CC: p3week@p3week.ru\r\n";
	$header.= "MIME-Version: 1.0\r\n";
	$header.= "Content-Type: text/html; charset=utf-8\r\n";
	$header.= "X-Priority: 1\r\n";

	$message = "
	<table class='uchasnikitbl' border='1'>
		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march17'>29 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen' width='20%'>Время</th>
			<th class='head meropren'  width='*'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer01 != '' ? 'checked' : '')." name='17MAR10001200' type='checkbox' value='Пленарное заседание «Антикризисный план развития инфраструктуры»'><span>Пленарное заседание «Антикризисный план развития инфраструктуры»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 14.30</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer02 != '' ? 'checked' : '')." name='17MAR12301430' type='checkbox' value='Презентационная сессия «Рейтинг регионов России по развитию ГЧП»'><span>Презентационная сессия «Рейтинг регионов России по развитию ГЧП»</span></label></div>
				<div class='checkbox'><label><input ".($mer03 != '' ? 'checked' : '')." name='17MAR12301430' type='checkbox' value='Юридические дебаты «Законодательное регулирование ГЧП: тенденции и тренды»'><span>Юридические дебаты «Законодательное регулирование ГЧП: тенденции и тренды»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.30 – 18.00</b>
			</td>
			<td class='selectone1 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer04 != '' ? 'checked' : '')." name='17MAR153018001' type='checkbox' value='Круглый стол «Роль механизмов ГЧП в развитии инфраструктуры на Дальнем Востоке: текущая ситуация, лучшие практики, перспективы применения в рамках ТОСЭР»'><span>Круглый стол «Роль механизмов ГЧП в развитии инфраструктуры на Дальнем Востоке: текущая ситуация, лучшие практики, перспективы применения в рамках ТОСЭР»</span></label></div>
				<div class='checkbox'><label><input ".($mer05 != '' ? 'checked' : '')." name='17MAR153018002' type='checkbox' value='Панельная дискуссия «Особенности финансирования инфраструктурных проектов в условиях экономической нестабильности»'><span>Панельная дискуссия «Особенности финансирования инфраструктурных проектов в условиях экономической нестабильности»</span></label></div>
				<div class='checkbox'><label><input ".($mer06 != '' ? 'checked' : '')." name='17MAR153018003' type='checkbox' value='Панельная дискуссия «ГЧП в Москве: что готова предложить столица частным инвесторам?»'><span>Панельная дискуссия «ГЧП в Москве: что готова предложить столица частным инвесторам?»</span></label></div>
			</td>
		</tr>
		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march18'>30 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 12.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer07 != '' ? 'checked' : '')." name='18MAR100012001' type='checkbox' value='Всероссийский семинар «Правовое регулирование и особенности передачи неэффективных унитарных предприятий коммунальной сферы в концессию»'><span>Всероссийский семинар «Правовое регулирование и особенности передачи неэффективных унитарных предприятий коммунальной сферы в концессию»</span></label></div>
				<div class='checkbox'><label><input ".($mer08 != '' ? 'checked' : '')." name='18MAR100012002' type='checkbox' value='Стратегическая панель «Перспективные проекты ГЧП в сфере транспортной инфраструктуры в Российской Федерации»'><span>Стратегическая панель «Перспективные проекты ГЧП в сфере транспортной инфраструктуры в Российской Федерации»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.30 – 14.30</b>
			</td>
			<td class='selectone2 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer09 != '' ? 'checked' : '')." name='18MAR123014301' type='checkbox' value='Пленарное заседание «Острые вопросы передачи в концессию систем централизованного теплоснабжения, водоснабжения и водоотведения»'><span>Пленарное заседание «Острые вопросы передачи в концессию систем централизованного теплоснабжения, водоснабжения и водоотведения»</span></label></div>
				<div class='checkbox'><label><input ".($mer10 != '' ? 'checked' : '')." name='18MAR123014302' type='checkbox' value='Круглый стол «Аэропорты – точка роста регионального развития»'><span>Круглый стол «Аэропорты – точка роста регионального развития»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>15.00 – 16.30</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer11 != '' ? 'checked' : '')." name='18MAR15001630' type='checkbox' value='Мозговой штурм: «Федеральный закон «Об отходах производства и потребления»: от нормативной базы к практической реализации»'><span>Мозговой штурм: «Федеральный закон «Об отходах производства и потребления»: от нормативной базы к практической реализации»</span></label></div>
			</td>
		</tr>
		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march19'>31 марта</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 11.30</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer12 != '' ? 'checked' : '')." name='19MAR10001130' type='checkbox' value='Пленарное заседание «Бизнес в социальной сфере: пути развития»'><span>Пленарное заседание «Бизнес в социальной сфере: пути развития»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>12.00 – 13.30</b>
			</td>
			<td class='selectone4 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer13 != '' ? 'checked' : '')." name='19MAR120013301' type='checkbox' value='Панельная дискуссия «Практика применения концессий в здравоохранении»'><span>Панельная дискуссия «Практика применения концессий в здравоохранении»</span></label></div>
				<div class='checkbox'><label><input ".($mer14 != '' ? 'checked' : '')." name='19MAR120013302' type='checkbox' value='Круглый стол «Развитие негосударственного сектора в сфере социального обслуживания: жизнь по новому закону»'><span>Круглый стол «Развитие негосударственного сектора в сфере социального обслуживания: жизнь по новому закону»</span></label></div>
				<div class='checkbox'><label><input ".($mer15 != '' ? 'checked' : '')." name='19MAR120013303' type='checkbox' value='Круглый стол «ГЧП в системе образования: опыт развития дошкольного, перспективы среднего и высшего»'><span>Круглый стол «ГЧП в системе образования: опыт развития дошкольного, перспективы среднего и высшего»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>14.00 – 15.30</b>
			</td>
			<td class='selectone5 head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer16 != '' ? 'checked' : '')." name='19MAR140015301' type='checkbox' value='Открытое заседание рабочей группы по вопросу расширения производства продукции для инвалидов и граждан пожилого возраста'><span>Открытое заседание рабочей группы по вопросу расширения производства продукции для инвалидов и граждан пожилого возраста</span></label></div>
				<div class='checkbox'><label><input ".($mer17 != '' ? 'checked' : '')." name='19MAR140015302' type='checkbox' value='Панельная дискуссия «Есть ли будущее у российского здравоохранения без государственно-частного взаимодействия?»'><span>Панельная дискуссия «Есть ли будущее у российского здравоохранения без государственно-частного взаимодействия?»</span></label></div>
				<div class='checkbox'><label><input ".($mer18 != '' ? 'checked' : '')." name='19MAR140015303' type='checkbox' value='Круглый стол «ГЧП в сфере культуры – миф или реальность?»'><span>Круглый стол «ГЧП в сфере культуры – миф или реальность?»</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>16.00 – 18.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer19 != '' ? 'checked' : '')." name='19MAR16001800' type='checkbox' value='Круглый стол «Проекты государственно-частного партнерства по развитию инфраструктуры детского отдыха. Модели. Успешные кейсы. Барьеры реализации»'><span>Круглый стол «Проекты государственно-частного партнерства по развитию инфраструктуры детского отдыха. Модели. Успешные кейсы. Барьеры реализации»</span></label></div>
			</td>
		</tr>


		<tr>
			<th colspan='2' class='head' style='text-align: left; vertical-align: middle; height: 25px;'>
				<h3 class='march20'>1 апреля</h3>
			</th>
		</tr>
		<tr>
			<th class='head lkname  head-num timeen'>Время</th>
			<th class='head meropren'>Мероприятия</th>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>10.00 – 11.20</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer20 != '' ? 'checked' : '')." name='20MAR10001120' type='checkbox' value='Модуль I: «Применение концессионных соглашений для развития инфраструктуры в регионах Российской Федерации» (1 группа).'><span>Модуль I: «Применение концессионных соглашений для развития инфраструктуры в регионах Российской Федерации» (1 группа).</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>11.30 – 13.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer21 != '' ? 'checked' : '')." name='20MAR11301300' type='checkbox' value='Модуль II: «Специфика концессионной модели от лидеров рынка» (2 группы – государственные служащие и представители частных компаний).'><span>Модуль II: «Специфика концессионной модели от лидеров рынка» (2 группы – государственные служащие и представители частных компаний).</span></label></div>
			</td>
		</tr>
		<tr class='user-row'>
			<td class='head lkname' style='text-align: center; vertical-align: middle;'>
				<b>14.00 – 17.00</b>
			</td>
			<td class='head' style=' vertical-align: middle;'>
				<div class='checkbox'><label><input ".($mer22 != '' ? 'checked' : '')." name='20MAR14001700' type='checkbox' value='Модуль III. Деловая игра: «Принятие решения о возможности реализации проекта на основе механизма частной инициативы» (1 группа, разделенная на 2 команды).'><span>Модуль III. Деловая игра: «Принятие решения о возможности реализации проекта на основе механизма частной инициативы» (1 группа, разделенная на 2 команды).</span></label></div>
			</td>
		</tr>

	</table>
";
	$body = $message."";
	mail($to, $title, $body, $header);



	if(!$items) {
		//

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns = array('ID_USER','17MAR10001200', '17MAR123014301', '17MAR123014302', '17MAR153018001', '17MAR153018002', '17MAR153018003', '18MAR100012001', '18MAR100012002', '18MAR123014301', '18MAR123014302', '18MAR15001630', '19MAR10001130', '19MAR120013301', '19MAR120013302', '19MAR120013303', '19MAR140015301', '19MAR140015302', '19MAR140015303', '19MAR16001800', '20MAR10001120', '20MAR11301300', '20MAR14001700'); // add more table columns here
		$values = array(
			$db->quote($user_id),
			$db->quote($mer01),
			$db->quote($mer02),
			$db->quote($mer03),
			$db->quote($mer04),
			$db->quote($mer05),
			$db->quote($mer06),
			$db->quote($mer07),
			$db->quote($mer08),
			$db->quote($mer09),
			$db->quote($mer10),
			$db->quote($mer11),
			$db->quote($mer12),
			$db->quote($mer13),
			$db->quote($mer14),
			$db->quote($mer15),
			$db->quote($mer16),
			$db->quote($mer17),
			$db->quote($mer18),
			$db->quote($mer19),
			$db->quote($mer20),
			$db->quote($mer21),
			$db->quote($mer22)
		); // add more values here
		$query
			->insert($db->quoteName('#__meetings'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));
		$db->setQuery($query);
		$db->execute();
		$page = $_SERVER['REQUEST_URI'];
//                    header("Refresh:1; url=$page");
		header("Location: /lichnyj-kabinet");
	}
	else{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
			$db->quoteName('ID_USER') . ' = ' . $current_user->id
		);
		$query->delete($db->quoteName('#__meetings'));
		$query->where($conditions);
		$db->setQuery($query);
		$db->execute();


		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns = array('ID_USER','17MAR10001200', '17MAR123014301', '17MAR123014302', '17MAR153018001', '17MAR153018002', '17MAR153018003', '18MAR100012001', '18MAR100012002', '18MAR123014301', '18MAR123014302', '18MAR15001630', '19MAR10001130', '19MAR120013301', '19MAR120013302', '19MAR120013303', '19MAR140015301', '19MAR140015302', '19MAR140015303', '19MAR16001800', '20MAR10001120', '20MAR11301300', '20MAR14001700'); // add more table columns here
		$values = array(
			$db->quote($user_id),
			$db->quote($mer01),
			$db->quote($mer02),
			$db->quote($mer03),
			$db->quote($mer04),
			$db->quote($mer05),
			$db->quote($mer06),
			$db->quote($mer07),
			$db->quote($mer08),
			$db->quote($mer09),
			$db->quote($mer10),
			$db->quote($mer11),
			$db->quote($mer12),
			$db->quote($mer13),
			$db->quote($mer14),
			$db->quote($mer15),
			$db->quote($mer16),
			$db->quote($mer17),
			$db->quote($mer18),
			$db->quote($mer19),
			$db->quote($mer20),
			$db->quote($mer21),
			$db->quote($mer22)
		); // add more values here
		$query
			->insert($db->quoteName('#__meetings'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));
		$db->setQuery($query);
		$db->execute();
		$page = $_SERVER['REQUEST_URI'];
//                    header("Refresh:1; url=$page");
		header("Location: /lichnyj-kabinet");
	}

}
?>


<?php if('en-GB' == $curlang ): ?>
	<script>
		$('.mclasspr .nn_tabs-toggle-inner').html('Program');
		$('[name="17MAR10001200"]').parent().children('span').html('Plenary session: «Anti-crisis infrastructure development plan»');
		$('[name="17MAR123014301"]').parent().children('span').html('Presentation session: «Rankings of Russian regions by PPP development level»');
		$('[name="17MAR123014302"]').parent().children('span').html('Legal debate «Legislative regulation of PPP: trends and tendencies»');
		$('[name="17MAR153018001"]').parent().children('span').html('Round table: «Role of PPP mechanisms in developing the social infrastructure of the Russian Far East: current situation, best practices, implementation prospects within Advanced Social and Economic Development Zones»"');
		$('[name="17MAR153018002"]').parent().children('span').html('Panel discussion: «Peculiarities of financing infrastructure projects during economic turbulence»');
		$('[name="17MAR153018003"]').parent().children('span').html('Panel discussion: «PPP in Moscow: what can the capital offer private investors?»');



		$('[name="18MAR100012001"]').parent().children('span').html('Plenary session: «Legal regulation and peculiarities related to granting concessions to unitary enterprises in the public utilities sector»');
		$('[name="18MAR100012002"]').parent().children('span').html('Strategic panel: «Promising  transport infrastructure PPP projects in the Russian Federation»');
		$('[name="18MAR123014301"]').parent().children('span').html('Plenary session: «Topical issues of granting concession to the systems of district heating, water supply and water discharge.»');
		$('[name="18MAR123014302"]').parent().children('span').html('Round table: «Airports as a regional development growth point»');
		$('[name="18MAR15001630"]').parent().children('span').html('Brainstorm: «Federal law on wastage and consumption residue: from regulatory framework to implementation»');

		$('[name="19MAR10001130"]').parent().children('span').html('Plenary session: «Business in the field of social welfare: development trends»');
		$('[name="19MAR120013301"]').parent().children('span').html('Panel discussion: «Use of concession agreements in the healthcare field»');
		$('[name="19MAR120013302"]').parent().children('span').html('Round table: «Developing non-state sector participation in providing social service: living according the new law»');
		$('[name="19MAR120013303"]').parent().children('span').html('Round table: «PPP in the education system: experience and prospects of the development of pre-school, primary, secondary and higher education»');
		$('[name="19MAR140015301"]').parent().children('span').html('Open workgroup session on expending production of goods for senior citizens and the disabled');
		$('[name="19MAR140015302"]').parent().children('span').html('Panel discussion: «Public-private cooperation in healthcare: expanding the frontiers of PPP»');
		$('[name="19MAR140015303"]').parent().children('span').html('Round table: «PPP in culture: myth or reality?»');
		$('[name="19MAR16001800"]').parent().children('span').html("Round table: «PPP projects in developing infrastructure for children's recreation. Models. Successful cases. Implementation barriers»");

		$('[name="20MAR10001120"]').parent().children('span').html('Module I: «Use of concession agreements for the infrastructure development in Russian regions» (1 group)');
		$('[name="20MAR11301300"]').parent().children('span').html('Module II: «The specifics of the concession model developed by market leaders» (2 groups – public officials and representatives of private companies)');
		$('[name="20MAR14001700"]').parent().children('span').html('Module III. Simulation Exercise: «Making a decision on possibility of implementing a projects through the private initiative mechanism»');

		$('.underprog').html('<strong>Events Educational programs are available only if you have purchased packages «<a href="/en/participants/conditions-of-participation">VIP</a>» or «<a href="/en/participants/conditions-of-participation">Education</a>»</strong>');
		$('#prsubmit').val('SAVE');
		$('.march17').html('March 17');
		$('.march18').html('March 18');
		$('.march19').html('March 19');
		$('.march20').html('March 20');
		$('.timeen').html('Time');
		$('.meropren').html('Measures');
	</script>
<?php elseif('ru-RU' == $curlang ): ?>
	<script>
	</script>
<?php endif; ?>
