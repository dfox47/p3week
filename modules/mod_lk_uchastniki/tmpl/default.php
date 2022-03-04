<?php defined('_JEXEC') or die('(@)|(@)');
?>

<link rel="stylesheet" href="/colorbox/example1/colorbox.css">
<script src="/colorbox/jquery.colorbox.js"></script>
<style type="text/css">
    .container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {
        width: 830px;
    }
    .form-reg .control-label{
        text-align: left;
        text-transform: uppercase;
        font-weight: bold;
        width: 210px;
    }
    .form-reg .controls {
        margin-left: 210px;
        overflow: hidden;
    }
    .big{
        font-weight:normal;
				line-height:15px;
        padding-top: 9px;
    }
    #cboxContent .control-group {
        float: initial;
        width: 100%;

    }
    #cboxContent .control-label {
        float: left;
        padding-right: 10px;
        
    }
    #cboxContent .controls input {
       
    }
    #cboxContent .btn-default {
        -webkit-appearance: none;
        -webkit-user-select: none;
        -webkit-writing-mode: horizontal-tb;
        align-items: flex-start;
        background: rgb(240, 240, 240);
        background-image: none;
        border-bottom-color: rgb(204, 204, 204);
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        border-bottom-style: solid;
        border-bottom-width: 1px;
        border-image-outset: 0px;
        border-image-repeat: stretch;
        border-image-slice: 100%;
        border-image-source: none;
        border-image-width: 1;
        border-left-color: rgb(204, 204, 204);
        border-left-style: solid;
        border-left-width: 1px;
        border-right-color: rgb(204, 204, 204);
        border-right-style: solid;
        border-right-width: 1px;
        border-top-color: rgb(204, 204, 204);
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-top-style: solid;
        border-top-width: 1px;
        box-sizing: border-box;
        color: rgb(51, 51, 51);
        cursor: pointer;
        display: inline-block;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        height: 34px;
        letter-spacing: normal;
        line-height: 20px;
        overflow-x: visible;
        overflow-y: visible;
        padding-bottom: 6px;
        padding-top: 6px;
        text-align: center;
        text-indent: 0px;
        text-shadow: none;
        text-transform: none;
        touch-action: manipulation;
        vertical-align: middle;
        white-space: nowrap;
        width: 75px;
        word-spacing: 0px;
        padding-left: 3px !important;
        padding-right: 3px !important;
        margin-right: 2px;
    }
    #cboxContent .btn-default.active {
        background-color: rgb(0, 255, 61);
    }
    #Issue_hour_wrap input {
        width: 44px !important;
    }
    .btnoccup {
        float: left;
        box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
        border-radius: 0;
        position: relative;
        margin-right: 2px !important;
        background-color: rgba(255, 44, 44, 0.3) !important;
        border-radius: 0 !important;
    }
    .user-row {
        height: 71px;
    }
    tr.user-row:hover {
        background-color: rgba(0, 0, 0, 0.1) !important;
        background: rgba(0, 0, 0, 0.1) !important;
    }
    .head-num {
        height: 70px;
    }
</style>


<script>

jQuery(function(){
	current_pop = jQuery('.cbox').colorbox();
	//Окрашивание букв(в зависимости от того какие фамилии есть)
	jQuery('.letter span').each(function(key, value){
		if(jQuery('.user-row[data-char="'+jQuery(value).attr('data-char')+'"]').length != 0){
			jQuery(value).addClass('notempty');
		}
	});
	//Нажатие на букву
	jQuery('.letter span:not(.all-char)').click(function(){
		jQuery('.user-row').hide();
		jQuery('.user-row[data-char="'+jQuery(this).attr('data-char')+'"]').show();

		jQuery('.current-char').removeClass('current-char');
		jQuery(this).addClass('current-char');

	});
	//Нажатие на ссылку Все
	jQuery('.all-char').click(function(){
		jQuery('.user-row').show();

		jQuery('.current-char').removeClass('current-char');
		jQuery(this).addClass('current-char');
	});
});
</script>



<?php

$current_user = JFactory::getUser();
$lang = JFactory::getLanguage();
$curlang =  $lang->getTag();
?>

<?php if('en-GB' == $curlang ): ?>
    <h3>LIST OF THE RUSSIAN PPP WEEK 2015 PARTISIPANTS</h3>
<?php elseif('ru-RU' == $curlang ): ?>
    <h3>ОБЩИЙ СПИСОК УЧАСТНИКОВ</h3>
<?php endif; ?>


<?php
$char_ban_array = array('Ы', 'Ь', 'Ъ');
$abc = '';

echo '<div class="letter firstall1"><span class="all-char notempty current-char">Все</span></div>';
//Вывод всех букв алфавита
foreach (range(chr(0xC0), chr(0xDF)) as $b) {
	$abc = iconv('CP1251', 'UTF-8', $b);
	if(!in_array($abc, $char_ban_array))
		echo '<div class="letter"><span data-char="'.$abc.'">'.$abc.'</span></div>';

	//Вставка буквы Ё
	if ($abc == "Е")
		echo '<div class="letter"><span data-char="Ё">Ё</span></div>';
}
//echo "<!--";
echo '<div style="clear:both;"></div><div class="letter firstall2"><span class="all-char correctchar notempty current-char">All</span></div>';
//Вывод всех букв алфавита
foreach (range('A', 'Z') as $b) {
	$abc = iconv('CP1251', 'UTF-8', $b);
	if(!in_array($abc, $char_ban_array))
		echo '<div class="letter"><span data-char="'.$abc.'">'.$abc.'</span></div>';
}
//echo "-->";
?>

<table class="uchasnikitbl">

    <?php if('en-GB' == $curlang ): ?>
        <tr>
            <th class="head head-num">№</th>
            <th class="head avatar"></th>
            <th class="head lkname">Full name</th>
            <th class="head">Company</th>
            <th class="head lkname">Position</th>
        </tr>
    <?php elseif('ru-RU' == $curlang ): ?>
        <tr>
            <th class="head head-num">№</th>
            <th class="head avatar"></th>
            <th class="head lkname">ФИО</th>
            <th class="head">Предприятие</th>
            <th class="head lkname">Должность</th>
        </tr>
    <?php endif; ?>

<?
	$counter = 1;
    foreach ($items3 as $item1) {
        $imyaU = $item1->imya;
        $otchestvo = $item1->otchestvo;
        $organizatsiya = $item1->organizatsiya;
        $dolzhnost = $item1->dolzhnost;
        $kontaktnyytelefon = $item1->kontaktnyytelefon;
        $Email = $item1->email;
    }
	foreach ($items as $item) {

		if (($current_user->id != $item->id) || ($item->id != 580))  {

			if ($item->profilepicturefile == '') {
				$foto = '<img src="/images/unknownperson.gif" />';
			}else{ 
				$foto = '<img src="/media/plg_user_profilepicture/images/200/'.$item->profilepicturefile.'" />';
			}
            $res1 = preparedataNMallow($current_user->id);




            if('en-GB' == $curlang ):
			echo "
				<tr class='user-row' data-char='".  mb_convert_case(mb_substr($item->name,0,1,"UTF-8"), MB_CASE_UPPER, "UTF-8")."'>
					<td class='num'><span class='ol'>".$counter++. "</span></td>
					<td class='avatar'>".$foto."</td>
					<td class='lkname'>
						<table class='uchastnikfio'>
							<tr>
								<td>".$item->name. "</td>
								<td>".$item->imya."</td>
								<td>".$item->otchestvo."</td>
							</tr>
						</table>
					</td>
					<td class='nolowercase'>".$item->organizatsiya."</td>
					<td class='dolj'>".(($res1 < 3)?"<div class='add_notice' style='margin-left: -20px;'><a class=\"cbox btn\" href=\"#formlkuchastnikim".$counter."\">SCHEDULE AN APPOINTMENT</a></div>":'')." ".$item->dolzhnost."
					</td>
				</tr>";
            elseif('ru-RU' == $curlang ):
                echo "
				<tr class='user-row' data-char='".  mb_convert_case(mb_substr($item->name,0,1,"UTF-8"), MB_CASE_UPPER, "UTF-8")."'>
					<td class='num'><span class='ol'>".$counter++. "</span></td>
					<td class='avatar'>".$foto."</td>
					<td class='lkname'>
						<table class='uchastnikfio'>
							<tr>
								<td>".$item->name. "</td>
								<td>".$item->imya."</td>
								<td>".$item->otchestvo."</td>
							</tr>
						</table>
					</td>
					<td class='nolowercase'>".$item->organizatsiya."</td>
					<td class='dolj'>".(($res1 < 3)?"<div class='add_notice'><a onclick='clickajax".$counter."(); return false;' class=\"cbox btn\" href=\"#formlkuchastnikim".$counter."\">НАЗНАЧИТЬ ВСТРЕЧУ</a></div>":'')." ".$item->dolzhnost."
					</td>
				</tr>";
            endif;

            ${"id".$counter} = $counter;
            ${"hisname".$counter} = $item->name;
            ${"hisimya".$counter} = $item->imya;
            ${"hisotchestvo".$counter} = $item->otchestvo;
            ${"hisdolzhnost".$counter} = $item->dolzhnost;
            ${"hisorganizatsiya".$counter} = $item->organizatsiya;

            ${"myname".$counter} = $current_user->name;
            ${"myimya".$counter} = $imyaU;
            ${"myotchestvo".$counter} = $otchestvo;
            ${"mydolzhnost".$counter} = $dolzhnost;
            ${"myorganizatsiya".$counter} = $organizatsiya;
            ${"mykontaktnyytelefon".$counter} = $kontaktnyytelefon;
            ${"myEmail".$counter} = $Email;


echo "
<script>
	function clickajax".$counter."(clk) {
        var response = jQuery.ajax({
			type:'GET',
			cache:false,
			dataType:'html',
			url:'/checklkuch.php?uid=".$counter."&uname=".trim($item->name)."&uimya=".trim($item->imya)."&uotchestvo=".trim($item->otchestvo)."&udolzhnost=".trim($item->dolzhnost)."&uorganizatsiya=".trim($item->organizatsiya)."&myname=".trim($current_user->name)."&myimya=".$imyaU."&myotchestvo=".trim($otchestvo)."&mydolzhnost=".trim($dolzhnost)."&myorganizatsiya=".trim($organizatsiya)."&mykontaktnyytelefon=".trim($kontaktnyytelefon)."&myemail=".trim($Email)."&curlang=".trim($curlang)."',
			data:jQuery(clk).serializeArray(),
			success: function (data) {
			    jQuery('#formlkuchastnikim".$counter."').html();
			    jQuery('#formlkuchastnikim".$counter."').html(data);
                response = data;
            }
		});
	}
</script>
";
            echo "<div class='hiddendiv' style='display: none;'><div id='formlkuchastnikim".$counter."'></div></div>";

            if ($_POST["subm".$counter]) {

                $input = new JInput;
                $post = $input->getArray($_POST);
                $from = $current_user->id;
                $to = $item->id;
                $tsel = $post["tsel"];
                $date = $post["date"];
                $time = $post["time"];
                $nper = $post["nper"];
                $soglas = 0;
                $from_name = $post["from_name"];
                $from_org = $post["from_org"];
                $from_post = $post["from_post"];
                $from_tel = $post["from_tel"];
                $from_email = $post["from_email"];
                $readed = 0;
                $datetime = date('Y-m-d H:i:s');
                $from_fio = $post["id2info1"];
                $from_org1 = $post["id2info2"];
                $from_dolj = $post["id2info3"];
                $deleted = 0;
                $toemail = $item->email;
                $tophone = $item->kontaktnyytelefon;

                $res = preparedataNM($date, $time, $nper);
                $res1 = preparedataNMallow($from);
                var_dump(123);
                if(($res == 0) && ($res1 < 3)) {
                    $db = JFactory::getDbo();
                    $query = $db->getQuery(true);
                    $columns = array('USER_ID1','USER_ID2','TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'USER_ID1_FIO', 'USER_ID1_ORG', 'USER_ID1_DOLJ', 'USER_ID1_PHONE', 'USER_ID1_EMAIL', 'LK_READ', 'LK_DATETIME', 'USER_ID2_FIO', 'USER_ID2_ORG', 'USER_ID2_DOLJ', 'DELETED', 'USER_ID2_EMAIL', 'USER_ID2_PHONE'); // add more table columns here
                    $values = array(
                        $db->quote($from),
                        $db->quote($to),
                        $db->quote($tsel),
                        $db->quote($date),
                        $db->quote($time),
                        $db->quote($nper),
                        $db->quote($soglas),
                        $db->quote($from_name),
                        $db->quote($from_org),
                        $db->quote($from_post),
                        $db->quote($from_tel),
                        $db->quote($from_email),
                        $db->quote($readed),
                        $db->quote($datetime),
                        $db->quote($from_fio),
                        $db->quote($from_org1),
                        $db->quote($from_dolj),
                        $db->quote($deleted),
                        $db->quote($toemail),
                        $db->quote($tophone)
                    ); // add more values here
                    $query
                        ->insert($db->quoteName('#__lk_vstrechi'))
                        ->columns($db->quoteName($columns))
                        ->values(implode(',', $values));
                    $db->setQuery($query);
                    $db->execute();

                    $query1 = $db->getQuery(true);
                    $query1
                        ->insert($db->quoteName('#__lk_vstrechi_view'))
                        ->columns($db->quoteName($columns))
                        ->values(implode(',', $values));
                    $db->setQuery($query1);
                    $db->execute();

                    $title = "Встреча с ".$from_org." назначена / Meeting with ".$from_org." is appointed";
                    $from = 'p3week@p3week.ru';
                    $to= $toemail;
                    $header = "From: ".$from."\r\n";
                    $header.= "CC: p3week@p3week.ru\r\n";
                    $header.= "MIME-Version: 1.0\r\n";
                    $header.= "Content-Type: text/plain; charset=utf-8\r\n";
                    $header.= "X-Priority: 1\r\n";
                    $message = "
Уважаемый(ая) ".$from_fio."!

".$from_name." (".$from_post.", ".$from_org.") предлагает Вам провести встречу  в рамках Российской недели ГЧП.

Дата и время встречи: ".$date." 2014 года в ".$time."
Место встречи: Переговорная ".$nper.".
Цель встречи: ".$tsel.".

Вы можете подтвердить или отменить встречу, а также внести изменения в предложенные дату, время или номер переговорной в личном кабинете (http://p3week.ru/ru/lichnyj-kabinet).


Dear ".$from_fio.",

".$from_name." (".$from_post.", ".$from_org.") suggests you have a meeting during Russian PPP Week.

Date and time of the meeting: ".$date." 2014 at ".$time."
Venue: Meeting Room ".$nper.".
Purpose: ".$tsel.".

You can confirm or cancel the appointment, as well as edit the suggested date and time in Personal Account (http://p3week.ru/en/lichnyj-kabinet).
";
                    $body = $message."";
                    mail($to, $title, $body, $header);

                    $page = $_SERVER['REQUEST_URI'];
//                    header("Refresh:1; url=$page");
                    header("Location: /lichnyj-kabinet");
                }
            }
		}
	}
?>

</table>
<div class="class-content"></div>
<script>
jQuery('.user-row').hover(function() {jQuery(this).find('.add_notice').stop( true, true ).fadeIn(400);},function() {jQuery(this).find('.add_notice').stop( true, true ).fadeOut(400);});

jQuery(".cbox").colorbox({width:"800px", height:"660px", inline:true, href:function(){
    var elementID = jQuery(this).attr('id');
    return elementID;
}, onComplete: function() {
    jQuery('.chekonload').click();
}});

function addname(data) {
    jQuery('.btn-group input').each(function () {
        jQuery(this).removeAttr('name');
        if (jQuery(this).hasClass('active')) {
            jQuery(this).attr('name', jQuery(this).attr('data-value'));
        }
    });
}
function replaceQueryParam(param, newval, search) {
    var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
    var query = search.replace(regex, "$1").replace(/&$/, '');
    return (query.length > 2 ? query + "&" : "?") + param + "=" + newval
}
function adddatetohref(id, form) {
    jQuery("#"+form.id+" input[data-value=\"time\"], #"+form.id+" input[data-value=\"nper\"]").parent().each(function(){
        var _href = jQuery(this).attr('href');
        if (_href.indexOf("&did") === -1) {
            jQuery(this).attr('href', _href + '&did=' + id.value);
        }
        var str = window.location.search;
        str =  replaceQueryParam('did', id.value, _href+str);
        jQuery(this).attr('href', str);
    });

}
function addtimetohref(id, form) {
    jQuery("#"+form.id+" input[data-value=\"date\"], #"+form.id+" input[data-value=\"nper\"]").parent().each(function(){
        var _href = jQuery(this).attr('href');
        if (_href.indexOf("&tid") === -1) {
            jQuery(this).attr('href', _href + '&tid=' + id.value);
        }
        var str = window.location.search;
        str =  replaceQueryParam('tid', id.value, _href+str);
        jQuery(this).attr('href', str);
    });

}
function addpidtohref(id, form) {
    jQuery("#"+form.id+" input[data-value=\"date\"], #"+form.id+" input[data-value=\"time\"]").parent().each(function(){
        var _href = jQuery(this).attr('href');
        if (_href.indexOf("&pid") === -1) {
            jQuery(this).attr('href', _href + '&pid=' + id.value);
        }
        var str = window.location.search;
        str =  replaceQueryParam('pid', id.value, _href+str);
        jQuery(this).attr('href', str);
    });

}
function clickajax(clk) {
        jQuery.ajax({
            type:'GET',
            cache:false,
            dataType:'html',
            url:jQuery(clk).attr('href'),
            data:jQuery(clk).serializeArray(),
            success:function (data) {
                jQuery(clk).parent().find('.ajax-container').html(data);
            }
        });
}
    jQuery("tr.user-row td").hover(function() {
        jQuery(this).parent().children('.lkname').css('background-color' , 'rgba(0,0,0,0.1)');
        jQuery(this).parent().children('.dolj').css('background-color' , 'rgba(0,0,0,0.1)');
    }, function() {
        jQuery(this).parent().children('.lkname').css('background-color' , 'rgba(241,240,238,1)');
        jQuery(this).parent().children('.dolj').css('background-color' , 'rgba(241,240,238,1)');
    });
</script>


<?php
function preparedataNM($date, $time, $nper) {
    $db3 = JFactory::getDbo();
    $query3 = $db3->getQuery(true);
    $query3
        ->select("count(*) ")
        ->from($db3->quoteName('#__lk_vstrechi'))
        ->where($db3->quoteName('LK_DATE') . " = " . $db3->quote($date) . " AND " . $db3->quoteName('LK_TIME') . " = " . $db3->quote($time) . " AND " . $db3->quoteName('N_PER') . " = " . $db3->quote($nper));
    $db3->setQuery($query3);
    $res = $db3->loadResult();
    return $res;
}
function preparedataNMnew($date, $time, $nper) {
    $db3 = JFactory::getDbo();
    $query3 = $db3->getQuery(true);
    $query3
        ->select("count(*) ")
        ->from($db->quoteName('#__lk_vstrechi'))
        ->where($db->quoteName('LK_DATE') . " = " . $db3->quote($date) . " AND " . $db3->quoteName('LK_TIME') . " = " . $db3->quote($time) . " AND " . $db3->quoteName('N_PER') . " = " . $db3->quote($nper));
    $db3->setQuery($query3);
    $res = $db3->loadResult();
    return $res;
}
function preparedataNMallow($from) {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query
        ->select("count(*) ")
        ->from($db->quoteName('#__lk_vstrechi'))
        ->where($db->quoteName('USER_ID1') . " = " . $db->quote($from));
    $db->setQuery($query);
    $res1 = $db->loadResult();
    return $res1;
}
?>



<?php if('en-GB' == $curlang ): ?>
    <script>
        jQuery('.mclasspu .nn_tabs-toggle-inner').html('Participants list');
    </script>
<?php elseif('ru-RU' == $curlang ): ?>
    <script>
    </script>
<?php endif; ?>