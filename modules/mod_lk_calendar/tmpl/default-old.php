<?php defined('_JEXEC') or die('(@)|(@)');
?>

<link rel="stylesheet" href="/colorbox/example1/colorbox.css">
<script src="/colorbox/jquery.colorbox.js"></script>
<style>
    .minmin, .minmin td{
        padding: 0px;
        font-size: 12px;
        vertical-align: middle;
        color: #999;
    }
		
		a.cboxcal{
			display:block;
			float:left;
			flex-basis: 100%;
		}
    .uchasnikitblcal th, .uchasnikitblcal tr {
        border-bottom: 1px dotted rgb(187, 189, 191);
    }
    .uchasnikitblcal div {
        overflow: hidden;        
        height: 83px;
        resize: none;
        border: 0;
        padding: 0;

    }
		
		.redinbox{
			display: flex;
			justify-content: space-between;
		}
    .uchasnikitblcal th {
        padding: 5px;
        width: 234px;
        max-width: 234px;
        min-width: 234px;
        text-transform: none;
        vertical-align: middle;
        color: rgb(145, 145, 145);
        font-weight: bold;
        font-size: 16px;
        text-align: center;
    }
    .minnumsbig {
        font-size: 32px;
        vertical-align: middle;
        color: #999;
        text-indent: -4px;
        padding-right: 4px;
    }
    .strokizaglushki {
        width: 100%;
        height: 100%;
    }
    .strokizaglushki td {
        width: 100%;
    }
    .uchasnikitblcal .infolockcal {
        border: 3px solid rgb(146, 20, 24);
        padding: 5px;
        background: rgb(213, 32, 41);
        color: #550005;
    }
    .infolockcal p {
        padding-top: 39px;
        padding-bottom: 0;
        font-size: 11px;
    }
    .uchasnikitblcal .infolockcal strong {
        color: #000;
    }
    .uchasnikitblcal .infolockcal span {
        color: #fff;
        font-style: italic;
        float: left;
        min-width: 100%;
        font-size: 11px;
    }
    .h70 {
        height: 70px;
    }
    .h30 {
        height: 30px;
    }
    .p20{
        padding-right: 20px;
    }
</style>

<?php
$current_user = JFactory::getUser();


$lang = JFactory::getLanguage();
$curlang =  $lang->getTag();
?>

<?php if('en-GB' == $curlang ): ?>
    <h3>MEETING SCHEDULE</h3>
<?php elseif('ru-RU' == $curlang ): ?>
    <h3>КАЛЕНДАРЬ ВСТРЕЧ</h3>
<?php endif; ?>


<?php

if ($current_user->id != 580) {
    $counter = 1;
    foreach ($items1 as $item1) {
        $imya = $item1->imya;
        $otchestvo = $item1->otchestvo;
        $organizatsiya = $item1->organizatsionnopravovayaforma . ' ' . $item1->organizatsiya;
        $dolzhnost = $item1->dolzhnost;
        $kontaktnyytelefon = $item1->kontaktnyytelefon;
        $Email = $item1->email;
    }
    foreach ($items22 as $item22) {
        if('en-GB' == $curlang ):
        echo "
        <div class='hiddendiv' style='display: none;'>
            <div id='calmm" . $counter . "'>
                <form class='form-reg form-horizontal' id='issue-formdd" . $counter . "' name='issue-form" . $counter . "' method='post' action=''>
                    <h2 style='text-align: center; padding-bottom: 30px;'>MEETING BETWEEN:</h2>
                    <div class='w50 p20'>
                        <label class=''>Full name: " . $item22->USER_ID1_FIO . "</label>
                        <input name='id2info1' id='id2info1' type='hidden' value ='" . $item22->USER_ID1_FIO . "'/>
                        <label class=''>Position: " . $item22->USER_ID1_DOLJ . "</label>
                        <input name='id2info3' id='id2info3' type='hidden' value ='" . $item22->USER_ID1_DOLJ . "'/>
                        <label class=''>Organization: " . $item22->USER_ID1_ORG . "</label>
                        <input name='id2info2' id='id2info2' type='hidden' value ='" . $item22->USER_ID1_ORG . "'/>
                    </div>
                    <div class='w50 p20'>
                        <label class=''>Full name: " . $item22->USER_ID2_FIO . "</label>
                        <input name='id3info1' id='id3info1' type='hidden' value ='" . $item22->USER_ID2_FIO . "'/>
                        <label class=''>Position: " . $item22->USER_ID2_DOLJ . "</label>
                        <input name='id3info3' id='id3info3' type='hidden' value ='" . $item22->USER_ID2_DOLJ . "'/>
                        <label class=''>Organization: " . $item22->USER_ID2_ORG . "</label>
                        <input name='id3info2' id='id3info2' type='hidden' value ='" . $item22->USER_ID2_ORG . "'/>
                    </div>
                    <div>
                        <label class=''>Purpose of meeting: " . $item22->TSEL . "</label><br />
                        <label class=''>Date: " . $item22->LK_DATE . "</label><br />
                        <input name='date' id='date' type='hidden' value ='" . $item22->LK_DATE . "'/>
                        <label class=''>Time: " . $item22->LK_TIME . "</label><br />
                        <input name='time' id='time' type='hidden' value ='" . $item22->LK_TIME . "'/>
                        <label class=''>Boardroom: " . $item22->N_PER . "</label><br />
                        <input name='nper' id='nper' type='hidden' value ='" . $item22->N_PER . "'/>
                    </div>
                    <div style='display: none;'>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_name'>Your full name <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_name' id='Issue_from_name' type='text' maxlength='255' value='" . trim($current_user->name) . " " . trim($imya) . " " . trim($otchestvo) . "' />
                                <p id='Issue_from_name_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_org'>Your organization <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_org' id='Issue_from_org' type='text' maxlength='255' value='" . $organizatsiya . "' />
                                <p id='Issue_from_org_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_post'>Your position <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_post' id='Issue_from_post' type='text' maxlength='255' value='" . $dolzhnost . "' />
                                <p id='Issue_from_post_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_tel'>Your phone <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_tel' id='Issue_from_tel' type='text' maxlength='255' value='" . $kontaktnyytelefon . "' />
                                <p id='Issue_from_tel_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_email'>Your E-Mail <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_email' id='Issue_from_email' type='text' maxlength='255' value='" . $Email . "' />
                                <p id='Issue_from_email_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                    </div>
                    <div style='text-align:center; padding-top:30px;'>
                        <input id='dsubmmm" . $counter . "' name='dsubmmm" . $counter . "' class='btn btn-primary' type='submit' value='Cancel'  />
                    </div>
                </form>
            </div>
        </div>";
        elseif('ru-RU' == $curlang ):
            echo "
        <div class='hiddendiv' style='display: none;'>
            <div id='calmm" . $counter . "'>
                <form class='form-reg form-horizontal' id='issue-formdd" . $counter . "' name='issue-form" . $counter . "' method='post' action=''>
                    <h2 style='text-align: center; padding-bottom: 30px;'>ВСТРЕЧА МЕЖДУ:</h2>
                    <div class='col-sm-6'>
                        <p><label class=''>Ф.И.О.: </label> " . $item22->USER_ID1_FIO . "</p>
                        <input name='id2info1' id='id2info1' type='hidden' value ='" . $item22->USER_ID1_FIO . "'/>
												<p><label class=''>Должность: </label> " . $item22->USER_ID1_DOLJ . "</p>
                        <input name='id2info3' id='id2info3' type='hidden' value ='" . $item22->USER_ID1_DOLJ . "'/>
												<p><label class=''>Компания: </label> " . $item22->USER_ID1_ORG . "</p>
                        <input name='id2info2' id='id2info2' type='hidden' value ='" . $item22->USER_ID1_ORG . "'/>
                    </div>
                    <div class='col-sm-6'>
                        <p><label class=''>Ф.И.О.: </label> " . $item22->USER_ID2_FIO . "</p>
                        <input name='id3info1' id='id3info1' type='hidden' value ='" . $item22->USER_ID2_FIO . "'/>
                        <p><label class=''>Должность: </label> " . $item22->USER_ID2_DOLJ . "</p>
                        <input name='id3info3' id='id3info3' type='hidden' value ='" . $item22->USER_ID2_DOLJ . "'/>
                        <p><label class=''>Компания: </label> " . $item22->USER_ID2_ORG . "</p>
                        <input name='id3info2' id='id3info2' type='hidden' value ='" . $item22->USER_ID2_ORG . "'/>
                    </div>
                    <div class='col-sm-12'>
                        <p><label class=''>Цель: </label>" . $item22->TSEL . "</p>
                        <p><label class=''>Дата: </label>" . $item22->LK_DATE . "</p>
                        <input name='date' id='date' type='hidden' value ='" . $item22->LK_DATE . "'/>                        

											<p><label class=''>Время: </label> " . $item22->LK_TIME . "</p>
											<input name='time' id='time' type='hidden' value ='" . $item22->LK_TIME . "'/>
											<p><label class=''>Переговорная: </label> " . $item22->N_PER . "</p>
											<input name='nper' id='nper' type='hidden' value ='" . $item22->N_PER . "'/>
										</div>
                    <div style='display: none;'>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_name'>Ваши Ф.И.О. <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_name' id='Issue_from_name' type='text' maxlength='255' value='" . trim($current_user->name) . " " . trim($imya) . " " . trim($otchestvo) . "' />
                                <p id='Issue_from_name_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_org'>Ваша организация <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_org' id='Issue_from_org' type='text' maxlength='255' value='" . $organizatsiya . "' />
                                <p id='Issue_from_org_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_post'>Ваша должность <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_post' id='Issue_from_post' type='text' maxlength='255' value='" . $dolzhnost . "' />
                                <p id='Issue_from_post_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_tel'>Ваш телефон <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_tel' id='Issue_from_tel' type='text' maxlength='255' value='" . $kontaktnyytelefon . "' />
                                <p id='Issue_from_tel_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                        <div class='control-group'>
                            <label class='control-label required' for='Issue_from_email'>Ваш E-Mail <span class='required'>*</span></label>
                            <div class='controls'>
                                <input name='from_email' id='Issue_from_email' type='text' maxlength='255' value='" . $Email . "' />
                                <p id='Issue_from_email_em_' style='display:none' class='help-block'></p>
                            </div>
                        </div>
                    </div>
										<div class='col-sm-6' style='margin-left:40%'>                   
                        <input id='dsubmmm" . $counter . "' name='dsubmmm" . $counter . "' class='btn btn-primary' type='submit' value='Отменить'  />
                    </div>
                </form>
            </div>
        </div>";
        endif;

        echo "<div class='preparecalendarall' style='display:none;'>";
        $str = preg_replace("/[^0-9]/", '', $item22->LK_DATE);
        echo "<div data-value='mart" . $item22->LK_TIME . "" . $str . "'>";
        echo "<a class='cboxcal' href='#calmm" . $counter . "'>";
        echo "<div class='infolockcal'>";
        echo "<span>"; if ($current_user->id == $item22->USER_ID1) { echo $item22->USER_ID2_FIO; }else{ echo $item22->USER_ID1_FIO; } echo "</span>";
        echo "<span>"; if ($current_user->id == $item22->USER_ID1) { echo $item22->USER_ID2_ORG; }else{ echo $item22->USER_ID1_ORG; } echo "</span>";

        if('en-GB' == $curlang ):
        echo "<p style='text-align: center;'>BOARDROOM <strong>" . $item22->N_PER . "</strong></p>";
        elseif('ru-RU' == $curlang ):
        echo "<p style='text-align: center;'>ПЕРЕГОВОРНАЯ <strong>" . $item22->N_PER . "</strong></p>";
        endif;

        echo "</div>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
        if ($_POST["dsubmmm" . $counter]) {

            $input = new JInput;
            $post = $input->getArray($_POST);
            if ($current_user->id == $item22->USER_ID2) {
                $from = $item22->USER_ID2;
                $to = $item22->USER_ID1;
            }
            if ($current_user->id == $item22->USER_ID1) {
                $from = $item22->USER_ID1;
                $to = $item22->USER_ID2;
            }
            $tsel = $item22->TSEL;
            $date = $post["date"];
            $time = $post["time"];
            $nper = $post["nper"];
            $soglas = 0;
            $from_name = $post["from_name"];
            $from_org = $post["from_org"];
            $from_post = $post["from_post"];
            $from_tel = $post["from_tel"];
            $from_email = $post["from_email"];
            $readed = 1;
            $datetime = date('Y-m-d H:i:s');
            if ($current_user->id == $item22->USER_ID1) {
                $from_fio = $post["id3info1"];
                $from_org1 = $post["id3info2"];
                $from_dolj = $post["id3info3"];
                $fromemail = $item22->USER_ID1_EMAIL;
                $toemail = $item22->USER_ID2_EMAIL;
                $fromphone = $item22->USER_ID1_PHONE;
                $tophone = $item22->USER_ID2_PHONE;
            }
            if ($current_user->id == $item22->USER_ID2) {
                $from_fio = $post["id2info1"];
                $from_org1 = $post["id2info2"];
                $from_dolj = $post["id2info3"];
                $fromemail = $item22->USER_ID2_EMAIL;
                $toemail = $item22->USER_ID1_EMAIL;
                $fromphone = $item22->USER_ID2_PHONE;
                $tophone = $item22->USER_ID1_PHONE;
            }
            $deleted = 1;

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $columns1 = array('USER_ID1', 'USER_ID2', 'TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'USER_ID1_FIO', 'USER_ID1_ORG', 'USER_ID1_DOLJ', 'USER_ID1_PHONE', 'USER_ID1_EMAIL', 'LK_READ', 'LK_DATETIME', 'USER_ID2_FIO', 'USER_ID2_ORG', 'USER_ID2_DOLJ', 'DELETED', 'USER_ID2_EMAIL', 'USER_ID2_PHONE'); // add more table columns here
            $values1 = array(
                $db->quote($from),
                $db->quote($to),
                $db->quote($tsel),
                $db->quote($item22->LK_DATE),
                $db->quote($item22->LK_TIME),
                $db->quote($item22->N_PER),
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
            $query1 = $db->getQuery(true);
            $query1
                ->insert($db->quoteName('#__lk_vstrechi_view'))
                ->columns($db->quoteName($columns1))
                ->values(implode(',', $values1));
            $db->setQuery($query1);
            $db->execute();
            $db = JFactory::getDbo();
            $conditions3 = array(
                $db->quoteName('LK_DATE') . '=' . $db->quote($item22->LK_DATE),
                $db->quoteName('LK_TIME') . '=' . $db->quote($item22->LK_TIME),
                $db->quoteName('N_PER') . '=' . $db->quote($item22->N_PER)
            );
            $db = JFactory::getDbo();
            $query3 = $db->getQuery(true);
            $query3
                ->delete($db->quoteName('#__lk_vstrechi'))
                ->where($conditions3);
            $db->setQuery($query3);
            $db->execute();
            $page = $_SERVER['REQUEST_URI'];

            $title = "Встреча с ".$from_org." отменена / Meeting with".$from_org." is cancelled";
            $from = 'p3week@p3week.ru';
            $to= $toemail;
            $header = "From: ".$from."\r\n";
            $header.= "CC: p3week@p3week.ru\r\n";
            $header.= "MIME-Version: 1.0\r\n";
            $header.= "Content-Type: text/plain; charset=utf-8\r\n";
            $header.= "X-Priority: 1\r\n";
            $message = "
Уважаемый(ая) ".$from_fio."!

".$from_name." (".$from_post.", ".$from_org.") не сможет принять участие во встрече с  Вами в рамках Российской недели ГЧП.


Dear ".$from_fio."!

".$from_name." (".$from_post.", ".$from_org.") will not be able to participate in the meeting with you at Russian PPP Week.
";

            $body = $message."";
            mail($to, $title, $body, $header);

            $title = "Встреча с ".$from_org1." отменена / Meeting with".$from_org1." is cancelled";
            $from = 'p3week@p3week.ru';
            $to= $fromemail;
            $header = "From: ".$from."\r\n";
            $header.= "CC: p3week@p3week.ru\r\n";
            $header.= "MIME-Version: 1.0\r\n";
            $header.= "Content-Type: text/plain; charset=utf-8\r\n";
            $header.= "X-Priority: 1\r\n";
            $message = "
Уважаемый(ая) ".$from_name."!

Вы отменили свое участие во встрече с ".$from_org1." в рамках Российской недели ГЧП.

Вы можете снова назначить встречу и выбрать более удобные для Вас дату, время и номер переговорной в личном кабинете (http://p3week.ru/ru/lichnyj-kabinet).


Dear ".$from_name."!

You have cancelled your participation in the meeting with ".$from_org1." on Russian PPP Week.

You can reappoint the meeting and choose a date and time more suitable for you in Personal Account (http://p3week.ru/en/lichnyj-kabinet).
";

            $body = $message."";
            mail($to, $title, $body, $header);

//        header("Refresh:1; url=$page");
            header("Location: /lichnyj-kabinet");
        }
        $counter++;
    }
}
if ($current_user->id == 580) {
    $counter = 1;
    foreach ($items33 as $item33) {
        echo "
            <div class='hiddendiv' style='display: none;'>
                <div id='calmma" . $counter . "'>
                    <form class='form-reg form-horizontal' id='issue-formdd" . $counter . "' name='issue-form" . $counter . "' method='post' action=''>
                        <h2 style='text-align: center; padding-bottom: 30px;'>ВСТРЕЧА МЕЖДУ:</h2>
                        <div class='w50 p20'>
                            <label class=''>Ф.И.О.: " . $item33->USER_ID1_FIO . "</label>
                            <input name='id2info1' id='id2info1' type='hidden' value ='" . $item33->USER_ID1_FIO . "'/>
                            <label class=''>Должность: " . $item33->USER_ID1_DOLJ . "</label>
                            <input name='id2info3' id='id2info3' type='hidden' value ='" . $item33->USER_ID1_DOLJ . "'/>
                            <label class=''>Компания: " . $item33->USER_ID1_ORG . "</label>
                            <input name='id2info2' id='id2info2' type='hidden' value ='" . $item33->USER_ID1_ORG . "'/>
                        </div>
                        <div class='w50 p20'>
                            <label class=''>Ф.И.О.: " . $item33->USER_ID2_FIO . "</label>
                            <input name='id3info1' id='id3info1' type='hidden' value ='" . $item33->USER_ID2_FIO . "'/>
                            <label class=''>Должность: " . $item33->USER_ID2_DOLJ . "</label>
                            <input name='id3info3' id='id3info3' type='hidden' value ='" . $item33->USER_ID2_DOLJ . "'/>
                            <label class=''>Компания: " . $item33->USER_ID2_ORG . "</label>
                            <input name='id3info2' id='id3info2' type='hidden' value ='" . $item33->USER_ID2_ORG . "'/>
                        </div>
                        <div>
                            <label class=''>Цель: " . $item33->TSEL . "</label><br />
                            <label class=''>Дата: " . $item33->LK_DATE . "</label><br />
                            <input name='date' id='date' type='hidden' value ='" . $item33->LK_DATE . "'/>
                            <label class=''>Время: " . $item33->LK_TIME . "</label><br />
                            <input name='time' id='time' type='hidden' value ='" . $item33->LK_TIME . "'/>
                            <label class=''>Переговорная: " . $item33->N_PER . "</label><br />
                            <input name='nper' id='nper' type='hidden' value ='" . $item33->N_PER . "'/>
                        </div>
                        <div style='text-align:center; padding-top:30px;'>
                            <input id='dsubmmma" . $counter . "' name='dsubmmma" . $counter . "' class='btn btn-primary' type='submit' value='Отменить'  />
                        </div>
                    </form>
                </div>
            </div>";

        echo "<div class='preparecalendarall' style='display:none;'>";
        $str = preg_replace("/[^0-9]/", '', $item33->LK_DATE);
        echo "<div data-value='mart" . $item33->LK_TIME . "" . $str . "'>";
        echo "<a class='cboxcal' href='#calmma" . $counter . "'>";
        echo "<div class='infolockcal'>";
        echo "<span>" . $item33->TSEL . "</span>";
        echo "<p style='text-align: center;'>ПЕРЕГОВОРНАЯ <strong>" . $item33->N_PER . "</strong></p>";
        echo "</div>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
        if ($_POST["dsubmmma" . $counter]) {
            $input = new JInput;
            $post = $input->getArray($_POST);
            $from = 0;
            $to = $item33->USER_ID2;
            $tsel = $item33->TSEL;
            $date = $post["date"];
            $time = $post["time"];
            $nper = $post["nper"];
            $soglas = 0;
            $readed = 1;
            $datetime = date('Y-m-d H:i:s');
            $deleted = 1;
            $USER_ID1_FIO = 'Администратор';

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $columns1 = array('USER_ID1', 'USER_ID2', 'TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'LK_READ', 'LK_DATETIME', 'DELETED', 'USER_ID2_FIO'); // add more table columns here
            $values1 = array(
                $db->quote($from),
                $db->quote($to),
                $db->quote($tsel),
                $db->quote($item33->LK_DATE),
                $db->quote($item33->LK_TIME),
                $db->quote($item33->N_PER),
                $db->quote($soglas),
                $db->quote($readed),
                $db->quote($datetime),
                $db->quote($deleted),
                $db->quote($USER_ID1_FIO)
            ); // add more values here
            $query1 = $db->getQuery(true);
            $query1
                ->insert($db->quoteName('#__lk_vstrechi_view'))
                ->columns($db->quoteName($columns1))
                ->values(implode(',', $values1));
            $db->setQuery($query1);
            $db->execute();

            $from = 0;
            $to = $item33->USER_ID1;
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $columns1 = array('USER_ID1', 'USER_ID2', 'TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'LK_READ', 'LK_DATETIME', 'DELETED', 'USER_ID2_FIO'); // add more table columns here
            $values1 = array(
                $db->quote($from),
                $db->quote($to),
                $db->quote($tsel),
                $db->quote($item33->LK_DATE),
                $db->quote($item33->LK_TIME),
                $db->quote($item33->N_PER),
                $db->quote($soglas),
                $db->quote($readed),
                $db->quote($datetime),
                $db->quote($deleted),
                $db->quote($USER_ID1_FIO)
            ); // add more values here
            $query1 = $db->getQuery(true);
            $query1
                ->insert($db->quoteName('#__lk_vstrechi_view'))
                ->columns($db->quoteName($columns1))
                ->values(implode(',', $values1));
            $db->setQuery($query1);
            $db->execute();

            $db = JFactory::getDbo();
            $conditions3 = array(
                $db->quoteName('LK_DATE') . '=' . $db->quote($item33->LK_DATE),
                $db->quoteName('LK_TIME') . '=' . $db->quote($item33->LK_TIME),
                $db->quoteName('N_PER') . '=' . $db->quote($item33->N_PER)
            );
            $db = JFactory::getDbo();
            $query3 = $db->getQuery(true);
            $query3
                ->delete($db->quoteName('#__lk_vstrechi'))
                ->where($conditions3);
            $db->setQuery($query3);
            $db->execute();
            $page = $_SERVER['REQUEST_URI'];
//        header("Refresh:1; url=$page");
            header("Location: /lichnyj-kabinet");
        }
        $counter++;
    }
}
?>
<table class="uchasnikitblcal">
    <?php if('en-GB' == $curlang ): ?>
        <tr>
            <th class="head head-num" colspan="2" style="width: 50px;min-width: 50px;text-align: center;"></th>
            <th class="head lkname">March 29</th>
            <th class="head">March 30</th>
            <th class="head lkname">March 31</th>
        </tr>
    <?php elseif('ru-RU' == $curlang ): ?>
        <tr>
            <th class="head head-num" colspan="2" style="width: 50px;min-width: 50px;text-align: center;"></th>
            <th class="head lkname">29 марта</th>
            <th class="head">30 марта</th>
            <th class="head lkname">31 марта</th>
        </tr>
    <?php endif; ?>


    <tr>
        <td class='minnumsbig'>9</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart09-0029"></div>
        </td>
        <td>
            <div class="redinbox mart09-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart09-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>10</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart10-0029"></div>
        </td>
        <td>
            <div class="redinbox mart10-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart10-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>11</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart11-0029"></div>
        </td>
        <td>
            <div class="redinbox mart11-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart11-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>12</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart12-0029"></div>
        </td>
        <td>
            <div class="redinbox mart12-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart12-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>13</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart13-0029"></div>
        </td>
        <td>
            <div class="redinbox mart13-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart13-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>14</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart14-0029"></div>
        </td>
        <td>
            <div class="redinbox mart14-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart14-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>15</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart15-0029"></div>
        </td>
        <td>
            <div class="redinbox mart15-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart15-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>16</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart16-0029"></div>
        </td>
        <td>
            <div class="redinbox mart16-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart16-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>17</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart17-0029"></div>
        </td>
        <td>
            <div class="redinbox mart17-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart17-0031"></div>
        </td>
    </tr>
    <tr>
        <td class='minnumsbig'>18</td>
        <td class='minmin'><table><tr><td>00</td></tr><tr><td>15</td></tr><tr><td>30</td></tr><tr style='border-bottom:0;'><td>45</td></tr></table></td>
        <td class='lkname'>
            <div class="redinbox mart18-0029"></div>
        </td>
        <td>
            <div class="redinbox mart18-0030"></div>
        </td>
        <td class='lkname'>
            <div class="redinbox mart18-0031"></div>
        </td>
    </tr>
</table>
<script>

   /* stroki = "<table class='strokizaglushki'><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr style='border-bottom:0;'><td></td></tr></table>";
    jQuery(".uchasnikitblcal div").html(stroki);*/

    jQuery(".preparecalendarall div").each(function() {
        var sosok = jQuery(this).attr("data-value");
				sosok = "."+sosok;
				var html = jQuery(this).html();
				console.log(sosok);
				jQuery(html).appendTo(sosok);
        //jQuery(sosok).html(jQuery(this).html());
    });
    jQuery(".preparecalendarall").html('');

    jQuery(".cboxcal").colorbox({width:"600px", height:"650px", inline:true, href:function(){
        var elementID = jQuery(this).attr('id');
        return elementID;
    }, onComplete: function() {

    }});

</script>

<?php if('en-GB' == $curlang ): ?>
    <script>
        jQuery('.mclassca .nn_tabs-toggle-inner').html('Calendar');
    </script>
<?php elseif('ru-RU' == $curlang ): ?>
    <script>
    </script>
<?php endif; ?>


