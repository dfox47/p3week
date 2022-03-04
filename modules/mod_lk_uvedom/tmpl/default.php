<?php defined('_JEXEC') or die('(@)|(@)'); ?>
<link rel="stylesheet" href="/colorbox/example1/colorbox.css">
<script src="/colorbox/jquery.colorbox.js"></script>
<?php
$current_user = JFactory::getUser();
$lang = JFactory::getLanguage();
$curlang =  $lang->getTag(); ?>

<?php if('en-GB' == $curlang ): ?>
	<h3>NOTIFICATIONS</h3>
<?php elseif('ru-RU' == $curlang ): ?>
	<h3>ВАШИ УВЕДОМЛЕНИЯ</h3>
<?php endif; ?>

<table class="uchasnikitbl">
	<?php if('en-GB' == $curlang ): ?>
		<tr>
			<th class="head head-num">№</th>
			<th class="head lkname">Participant</th>
			<th class="head">Notification</th>
			<th class="head lkname">Goal</th>
		</tr>
	<?php elseif('ru-RU' == $curlang ): ?>
		<tr>
			<th class="head head-num">№</th>
			<th class="head lkname">Участник</th>
			<th class="head">Уведомление</th>
			<th class="head lkname">Цель</th>
		</tr>
	<?php endif; ?>

<? $counter = 1;
foreach ($items1 as $item1) {
	$imya = $item1->imya;
	$otchestvo = $item1->otchestvo;
	$organizatsiya = $item1->organizatsionnopravovayaforma.' '.$item1->organizatsiya;
	$dolzhnost = $item1->dolzhnost;
	$kontaktnyytelefon = $item1->kontaktnyytelefon;
	$Email = $item1->email;
}
foreach ($items as $item) {

if('en-GB' == $curlang ):
	$dateen = '';
	if($item->LK_DATE == '29 марта') {$dateen = 'March 29';}
	if($item->LK_DATE == '30 марта') {$dateen = 'March 30';}
	if($item->LK_DATE == '31 марта') {$dateen = 'March 31';}
		if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "You have scheduled a meeting";}
		if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "You have edited a meeting";}
		if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "You have confirmed a meeting";}
		if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "You have confirmed a meeting";}
		if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "You have canceled a meeting";}
		if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "You have canceled a meeting";}

		if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "You have been invited on a meeting";}
		if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "Your meeting has been edited";}
		if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "Your meeting has been confirmed";}
		if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "Your meeting has been confirmed";}
		if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "Your meeting has been canceled";}
		if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "Your meeting has been canceled";}
		echo "
				<tr class='user-row'>
					<td class='num'><span class='ol'>".$counter++. "</span></td>
					<td class='nolowercase lkname'>";
					if (($uved == "You have been invited on a meeting") || ($uved == "Your meeting has been edited")) { echo $item->USER_ID1_FIO."<br />".$item->USER_ID1_ORG."<br />".$item->USER_ID1_DOLJ;}else {echo $item->USER_ID2_FIO."<br />".$item->USER_ID2_ORG."<br />".$item->USER_ID2_DOLJ;}
					echo "</td>
					<td class='nolowercase descnt'><b>";
if( ($uved == "You have been invited on a meeting") || ($uved == "Your meeting has been edited") ){
					echo "<a class='cbox' style='font-weight: bold;' href='#formlkuchastnikimm".$counter."'>";
					echo $uved;
					echo"</a>";
}else{echo $uved;}
					echo "</b><br>".$item->LK_DATETIME."<br>".$dateen." at ".$item->LK_TIME." Boardroom: ".$item->N_PER."<br>";
					echo"</td>
					<td class='dolj'><div class='add_notice'>";
					echo "</div>".$item->TSEL."
					</td>
				</tr>";

elseif('ru-RU' == $curlang ):

	if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "Вы назначили встречу";}
	if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "Вы переназначили встречу";}
	if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "Вы подтвердили встречу";}
	if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "Вы подтвердили встречу";}
	if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "Вы отменили встречу";}
	if( ($item->USER_ID1 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "Вы отменили встречу";}

	if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "Вам назначили встречу";}
	if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 0) ) {$uved = "Вам переназначили встречу";}
	if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "Вам подтвердили встречу";}
	if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 1) && ($item->DELETED == 0) ) {$uved = "Вам подтвердили встречу";}
	if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 0) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "Вам отменили встречу";}
	if( ($item->USER_ID2 == $current_user->id) && ($item->LK_READ == 1) && ($item->SOGLAS == 0) && ($item->DELETED == 1) ) {$uved = "Вам отменили встречу";}
	echo "
				<tr class='user-row'>
					<td class='num'><span class='ol'>".$counter++. "</span></td>
					<td class='nolowercase lkname'>";
	if (($uved == "Вам назначили встречу") || ($uved == "Вам переназначили встречу")) { echo $item->USER_ID1_FIO."<br />".$item->USER_ID1_ORG."<br />".$item->USER_ID1_DOLJ;}else {echo $item->USER_ID2_FIO."<br />".$item->USER_ID2_ORG."<br />".$item->USER_ID2_DOLJ;}
	echo "</td>
					<td class='nolowercase descnt'><b>";
	if( ($uved == "Вам назначили встречу") || ($uved == "Вам переназначили встречу") ){
		echo "<a class='cbox' style='font-weight: bold;' href='#formlkuchastnikimm".$counter."'>";
		echo $uved;
		echo"</a>";
	}else{echo $uved;}
	echo "</b><br>".$item->LK_DATETIME."<br>".$item->LK_DATE." в ".$item->LK_TIME." Переговорная: ".$item->N_PER."<br>";
	echo"</td>
					<td class='dolj'><div class='add_notice'>";
	echo "</div>".$item->TSEL."
					</td>
				</tr>";

endif;



	if('en-GB' == $curlang ):
		echo "
<div class='hiddendiv' style='display: none;'>
	<div id='formlkuchastnikimm".$counter."'>
		<a class='chekonload' href='index.php?action=getForm&ssss=ssss".$counter."&fi=formlkuchastnikimm".$counter."' onclick='clickajax(this);return false'></a>
		<form class='form-reg form-horizontal' id='issue-form".$counter."' name='issue-form".$counter."' method='post' action=''>
			<div class='control-group'>
				<label class='control-label'>Full name:</label>
				<div class='controls'>
					<input name='id2info1' id='id2info1' type='hidden' value ='".$item->USER_ID1_FIO."'/>
					<label class='big'>".$item->USER_ID1_FIO."</label>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label'>Position:</label>
				<div class='controls'>
					<input name='id2info3' id='id2info3' type='hidden' value ='".$item->USER_ID1_DOLJ."'/>
					<label class='big'>".$item->USER_ID1_DOLJ."</label>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label'>Organization:</label>
				<div class='controls'>
					<input name='id2info2' id='id2info2' type='hidden' value ='".$item->USER_ID1_ORG."'/>
					<label class='big'>".$item->USER_ID1_ORG."</label>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_target'>Purpose of meeting<span class='required'>*</span></label>
				<div class='controls'>
					<input onfocusout='checkallowsubmit(sss" . $counter . ");' onkeyup='checkallowsubmit(sss" . $counter . ");' onclick='' name='tsel' id='tselm".$counter."' type='hidden' maxlength='255' value='".$item->TSEL."' />
					<label class='big'>".$item->TSEL."</label>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_date'>Date <span class='required'>*</span></label>
				<div class='controls'>
					<input name='date' id='Issue_date' type='hidden' />
					<div id='Issue_date_wrap' class='btn-group' data-toggle='buttons-radio'>
						<a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=".$item->LK_TIME."&pid=".$item->N_PER."&did=29 марта' onclick='return false'>
							<input type='text' onclick='adddatetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='date' value='29 марта' READONLY/>
						</a>
						<a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=".$item->LK_TIME."&pid=".$item->N_PER."&did=30 марта' onclick='return false'>
							<input type='text' onclick='adddatetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='date' value='30 марта' READONLY/>
						</a>
						<a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=".$item->LK_TIME."&pid=".$item->N_PER."&did=31 марта' onclick='return false'>
							<input type='text' onclick='adddatetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='date' value='31 марта' READONLY/>
						</a>
						<div class='ajax-container'></div>
					</div>
					<p id='Issue_date_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_hour'>Time <span class='required'>*</span></label>
				<div class='controls'>
					<input name='hour' id='Issue_hour' type='hidden' />
					<div id='Issue_hour_wrap' class='btn-group' data-toggle='buttons-radio'>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=09-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='09-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=10-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='10-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=11-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='11-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=12-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='12-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=13-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='13-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=14-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='14-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=15-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='15-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=16-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='16-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=17-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='17-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=18-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='time' value='18-00' READONLY/>
						</a>
						<div class='ajax-container'></div>
					</div>
					<p id='Issue_hour_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_apartments'>Boardroom <span class='required'>*</span></label>
				<div class='controls'>
					<input name='apartments' id='Issue_apartments' type='hidden' />
					<div id='Issue_apartments_wrap' class='btn-group' data-toggle='buttons-radio'>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№1&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='nper' value='№1' READONLY/>
						</a>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№2&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='nper' value='№2' READONLY/>
						</a>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№3&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='nper' value='№3' READONLY/>
						</a>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№4&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default' data-value='nper' value='№4' READONLY/>
						</a>
						<div class='ajax-container'></div>
					</div>
					<p id='Issue_apartments_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_name'>Your full name <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_name' id='Issue_from_name' type='text' maxlength='255' value='".trim($current_user->name)." ".trim($imya)." ".trim($otchestvo)."' />
					<p id='Issue_from_name_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_org'>Your organization <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_org' id='Issue_from_org' type='text' maxlength='255' value='".$organizatsiya."' />
					<p id='Issue_from_org_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_post'>Your position <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_post' id='Issue_from_post' type='text' maxlength='255' value='".$dolzhnost."' />
					<p id='Issue_from_post_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_tel'>Your phone <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_tel' id='Issue_from_tel' type='text' maxlength='255' value='".$kontaktnyytelefon."' />
					<p id='Issue_from_tel_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_email'>Your E-Mail <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_email' id='Issue_from_email' type='text' maxlength='255' value='".$Email."' />
					<p id='Issue_from_email_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='form-actions'>
				<script>
					didmmm".$counter." = '".$item->LK_DATE."';
					tidmmm".$counter." = '".$item->LK_TIME."';
					pidmmm".$counter." = '".$item->N_PER."';
					jQuery('#formlkuchastnikimm".$counter." .dddd').click(function() {
						clickajax(this);
						url".$counter." = jQuery(this).attr('href');
						params".$counter." = getUrlParams(url".$counter.");
						didmm".$counter." = params".$counter."['did'];
						tidmm".$counter." = params".$counter."['tid'];
						pidmm".$counter." = params".$counter."['pid'];
						if ( (tidmm".$counter." == tidmmm".$counter.") && (didmm".$counter." == didmmm".$counter.") && (pidmm".$counter." == pidmmm".$counter.") ) {
							jQuery('#submm".$counter."').hide();
							jQuery('#fsubmm".$counter."').show();
						}else{
							jQuery('#fsubmm".$counter."').hide();
							jQuery('#submm".$counter."').show();
						}
						addname(this);
				   });

				</script>
				<input id='submm".$counter."' name='submm".$counter."' class='btn btn-primary inactive' type='button' value='Reassign' style='display: none;' />
				<input id='fsubmm".$counter."' name='fsubmm".$counter."' class='btn btn-primary' type='submit' value='Confirm' />
				<input id='dsubmm".$counter."' name='dsubmm".$counter."' class='btn btn-primary' type='submit' value='Refuse'  />
				<script>
					jQuery(document).ready(function() {
						ssss" . $counter . " = 'mm" . $counter . "';
					});
				</script>
				<script>if(jQuery('#formlkuchastnikimm".$counter." input[data-value=\"date\"]').attr('onclick')){dateclickformlkuchastnikimm".$counter." = jQuery('#formlkuchastnikimm".$counter." input[data-value=\"date\"]').attr('onclick');}</script>
				<script>if(jQuery('#formlkuchastnikimm".$counter." input[data-value=\"time\"]').attr('onclick')){timeclickformlkuchastnikimm".$counter." = jQuery('#formlkuchastnikimm".$counter." input[data-value=\"time\"]').attr('onclick');}</script>
				<script>if(jQuery('#formlkuchastnikimm".$counter." input[data-value=\"nper\"]').attr('onclick')){nperclickformlkuchastnikimm".$counter." = jQuery('#formlkuchastnikimm".$counter." input[data-value=\"nper\"]').attr('onclick');}</script>
				<script>jQuery('#formlkuchastnikimm".$counter." input[value=\"".$item->LK_DATE."\"]').addClass('btnoccup');</script>
				<script>jQuery('#formlkuchastnikimm".$counter." input[value=\"".$item->LK_TIME."\"]').addClass('btnoccup');</script>
				<script>jQuery('#formlkuchastnikimm".$counter." input[value=\"".$item->N_PER."\"]').addClass('btnoccup');</script>
				<script>setTimeout(function(){ checkallowsubmit(ssss" . $counter . "); }, 2000);</script>
			</div>
		</form>
	</div>
</div>";
	elseif('ru-RU' == $curlang ):
		switch($item->N_PER){
			case '№1' :
				$n1 = 'active';
			break;
			case '№2' :
				$n2 = 'active';
			break;
			case '№3' :
				$n3 = 'active';
			break;
			case '№4' :
				$n4 = 'active';
			break;
		}
		
		switch($item->LK_DATE){
			case '29 марта' :
				$m29 = 'active';
			break;
			case '30 марта' :
				$m30 = 'active';
			break;
			case '31 марта' :
				$m31 = 'active';
			break;
		}
		
		switch($item->LK_TIME){
			case '09-00' :
				$t9 = 'active';
			break;
			case '10-00' :
				$t10 = 'active';
			break;
			case '11-00' :
				$t11 = 'active';
			break;
			case '12-00' :
				$t12 = 'active';
			break;
			case '13-00' :
				$t13 = 'active';
			break;
			case '14-00' :
				$t14 = 'active';
			break;
			case '15-00' :
				$t15 = 'active';
			break;
			case '16-00' :
				$t16 = 'active';
			break;
			case '17-00' :
				$t17 = 'active';
			break;
			case '18-00' :
				$t18 = 'active';
			break;
		}
		echo "
<div class='hiddendiv' style='display: none;'>
	<div id='formlkuchastnikimm".$counter."'>
		<a class='chekonload' href='index.php?action=getForm&ssss=ssss".$counter."&fi=formlkuchastnikimm".$counter."' onclick='clickajax(this);return false'></a>
		<form class='form-reg form-horizontal' id='issue-form".$counter."' name='issue-form".$counter."' method='post' action=''>
				<div class='col-sm-6'>
			<div class='control-group'>
				<label class='control-label'>Ф.И.О.:</label> ".$item->USER_ID1_FIO."
								<input name='id2info1' id='id2info1' type='hidden' value ='".$item->USER_ID1_FIO."'/>               
			</div>
				</div>
				<div class='col-sm-6'>
			<div class='control-group'>
				<label class='control-label'>Должность:</label> ".$item->USER_ID1_DOLJ."
								<input name='id2info3' id='id2info3' type='hidden' value ='".$item->USER_ID1_DOLJ."'/>                
			</div>
				</div>
				<div class='col-sm-6'>
			<div class='control-group'>
				<label class='control-label'>Компания:</label> ".$item->USER_ID1_ORG."
								<input name='id2info2' id='id2info2' type='hidden' value ='".$item->USER_ID1_ORG."'/>                
			</div>
				</div>
				<div class='col-sm-6'>
			<div class='control-group'>
				<label class='control-label required' for='Issue_target'>Цель встречи<span class='required'>*</span></label>
								".$item->TSEL."
				<div class='controls'>
					<input onfocusout='checkallowsubmit(sss" . $counter . ");' onkeyup='checkallowsubmit(sss" . $counter . ");' onclick='' name='tsel' id='tselm".$counter."' type='hidden' maxlength='255' value='".$item->TSEL."' />                    
				</div>
			</div>
				</div>
				<div class='col-sm-6'>
			<div class='control-group'>
				<label class='control-label required' for='Issue_date'>Дата <span class='required'>*</span></label>
				<div class='controls'>
					<input name='date' id='Issue_date' type='hidden' />
					<div id='Issue_date_wrap' class='btn-group' data-toggle='buttons-radio'>
						<a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=".$item->LK_TIME."&pid=".$item->N_PER."&did=29 марта' onclick='return false'>
							<input type='text' onclick='adddatetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$m29."' data-value='date' value='29 марта' READONLY/>
						</a>
						<a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=".$item->LK_TIME."&pid=".$item->N_PER."&did=30 марта' onclick='return false'>
							<input type='text' onclick='adddatetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$m30."' data-value='date' value='30 марта' READONLY/>
						</a>
						<a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=".$item->LK_TIME."&pid=".$item->N_PER."&did=31 марта' onclick='return false'>
							<input type='text' onclick='adddatetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$m31."' data-value='date' value='31 марта' READONLY/>
						</a>
												
						<div class='ajax-container'></div>
					</div>
					<p id='Issue_date_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
						<div class='control-group'>
				<label class='control-label required' for='Issue_apartments'>Переговорная <span class='required'>*</span></label>
				<div class='controls'>
					<input name='apartments' id='Issue_apartments' type='hidden' />
					<div id='Issue_apartments_wrap' class='btn-group' data-toggle='buttons-radio'>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№1&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$n1."' data-value='nper' value='№1' READONLY/>
						</a>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№2&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$n2."' data-value='nper' value='№2' READONLY/>
						</a>
						<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№3&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$n3."' data-value='nper' value='№3' READONLY/>
						</a>
												<a id='pid".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&pid=№4&tid=".$item->LK_TIME."&did=".$item->LK_DATE."' onclick='return false'>
							<input type='text' onclick='addpidtohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$n4."' data-value='nper' value='№4' READONLY/>
						</a>
						<div class='ajax-container'></div>
					</div>
					<p id='Issue_apartments_em_' style='display:none' class='help-block'></p>
				</div>
			</div>     
				</div>
				<div class='col-sm-6'>
				
				<div class='control-group'>
				<label class='control-label required' for='Issue_hour'>Время <span class='required'>*</span></label>
				<div class='controls'>
					<input name='hour' id='Issue_hour' type='hidden' />
					<div id='Issue_hour_wrap' class='btn-group' data-toggle='buttons-radio'>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=09-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t9."' data-value='time' value='09-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=10-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t10."' data-value='time' value='10-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=11-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t11."' data-value='time' value='11-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=12-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t12."' data-value='time' value='12-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=13-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t13."' data-value='time' value='13-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=14-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t14."' data-value='time' value='14-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=15-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t15."' data-value='time' value='15-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=16-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t16."' data-value='time' value='16-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=17-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t17."' data-value='time' value='17-00' READONLY/>
						</a>
						<a id='tid".$counter."' class='dddd pidchech' href='index.php?action=getTime&fi=formlkuchastnikimm".$counter."&ssss=ssss".$counter."&tid=18-00&did=".$item->LK_DATE."&pid=".$item->N_PER."' onclick='return false'>
							<input type='text' onclick='addtimetohref(this,formlkuchastnikimm".$counter.");' class='btn btn-default ".$t18."' data-value='time' value='18-00' READONLY/>
						</a>
						<div class='ajax-container'></div>
					</div>
					<p id='Issue_hour_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
				</div>
				<div class='hidden'>
				<div class='control-group'>
				<label class='control-label required' for='Issue_from_name'>Your full name <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_name' id='Issue_from_name' type='text' maxlength='255' value='".trim($current_user->name)." ".trim($imya)." ".trim($otchestvo)."' />
					<p id='Issue_from_name_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_org'>Your organization <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_org' id='Issue_from_org' type='text' maxlength='255' value='".$organizatsiya."' />
					<p id='Issue_from_org_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_post'>Your position <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_post' id='Issue_from_post' type='text' maxlength='255' value='".$dolzhnost."' />
					<p id='Issue_from_post_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_tel'>Your phone <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_tel' id='Issue_from_tel' type='text' maxlength='255' value='".$kontaktnyytelefon."' />
					<p id='Issue_from_tel_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label required' for='Issue_from_email'>Your E-Mail <span class='required'>*</span></label>
				<div class='controls'>
					<input name='from_email' id='Issue_from_email' type='text' maxlength='255' value='".$Email."' />
					<p id='Issue_from_email_em_' style='display:none' class='help-block'></p>
				</div>
			</div>
				</div>
				<div class='col-sm-12'>
			<div class='form-actions'>
				<script>
					didmmm".$counter." = '".$item->LK_DATE."';
					tidmmm".$counter." = '".$item->LK_TIME."';
					pidmmm".$counter." = '".$item->N_PER."';
					jQuery('#formlkuchastnikimm".$counter." .dddd').click(function() {
						clickajax(this);
						url".$counter." = jQuery(this).attr('href');
						params".$counter." = getUrlParams(url".$counter.");
						didmm".$counter." = params".$counter."['did'];
						tidmm".$counter." = params".$counter."['tid'];
						pidmm".$counter." = params".$counter."['pid'];
						if ( (tidmm".$counter." == tidmmm".$counter.") && (didmm".$counter." == didmmm".$counter.") && (pidmm".$counter." == pidmmm".$counter.") ) {
							jQuery('#submm".$counter."').hide();
							jQuery('#fsubmm".$counter."').show();
						}else{
							jQuery('#fsubmm".$counter."').hide();
							jQuery('#submm".$counter."').show();
						}
						addname(this);
				   });

				</script>
				<input id='submm".$counter."' name='submm".$counter."' class='btn btn-primary inactive' type='button' value='Переназначить' style='display: none;' />
				<input id='fsubmm".$counter."' name='fsubmm".$counter."' class='btn btn-primary' type='submit' value='Подтвердить' />
				<input id='dsubmm".$counter."' name='dsubmm".$counter."' class='btn btn-primary' type='submit' value='Отказаться'  />
				<script>
					jQuery(document).ready(function() {
						ssss" . $counter . " = 'mm" . $counter . "';
					});
				</script>
				<script>if(jQuery('#formlkuchastnikimm".$counter." input[data-value=\"date\"]').attr('onclick')){dateclickformlkuchastnikimm".$counter." = jQuery('#formlkuchastnikimm".$counter." input[data-value=\"date\"]').attr('onclick');}</script>
				<script>if(jQuery('#formlkuchastnikimm".$counter." input[data-value=\"time\"]').attr('onclick')){timeclickformlkuchastnikimm".$counter." = jQuery('#formlkuchastnikimm".$counter." input[data-value=\"time\"]').attr('onclick');}</script>
				<script>if(jQuery('#formlkuchastnikimm".$counter." input[data-value=\"nper\"]').attr('onclick')){nperclickformlkuchastnikimm".$counter." = jQuery('#formlkuchastnikimm".$counter." input[data-value=\"nper\"]').attr('onclick');}</script>
				<script>jQuery('#formlkuchastnikimm".$counter." input[value=\"".$item->LK_DATE."\"]').addClass('btnoccup');</script>
				<script>jQuery('#formlkuchastnikimm".$counter." input[value=\"".$item->LK_TIME."\"]').addClass('btnoccup');</script>
				<script>jQuery('#formlkuchastnikimm".$counter." input[value=\"".$item->N_PER."\"]').addClass('btnoccup');</script>
				<script>setTimeout(function(){ checkallowsubmit(ssss" . $counter . "); }, 2000);</script>
			</div>
				</div>
		</form>
	</div>
</div>";
	endif;

	if ($_POST["submm".$counter]) {
		$input = new JInput;
		$post = $input->getArray($_POST);
		$from = $current_user->id;
		$to = $item->USER_ID1;
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
		$readed = 1;
		$datetime = date('Y-m-d H:i:s');
		$from_fio = $post["id2info1"];
		$from_org1 = $post["id2info2"];
		$from_dolj = $post["id2info3"];
		$deleted = 0;
		$toemail = $item->USER_ID1_EMAIL;
		$tophone = $item->USER_ID1_PHONE;

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

		$title = "Встреча с ".$from_org." изменена / Meeting with ".$from_org." is edited";
		$from = 'p3week@p3week.ru';
		$to= $toemail;
		$header = "From: ".$from."\r\n";
		$header.= "CC: p3week@p3week.ru\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type: text/plain; charset=utf-8\r\n";
		$header.= "X-Priority: 1\r\n";
		$message = "
Уважаемый(ая) ".$from_fio."!

".$from_name." (".$from_post.", ".$from_org.") изменил  дату/время/номер переговорной с Вами в рамках Российской недели ГЧП.

Дата и время встречи: ".$date." 2016 года в ".$time."
Место встречи: Переговорная ".$nper.".
Цель встречи: ".$tsel.".
Контакты: ".$from_name."
Тел: ".$kontaktnyytelefon."
e-mail: ".$Email."

Вы можете подтвердить или отменить встречу, а также внести изменения в предложенные дату, время и номер переговорной в личном кабинете (http://p3week.ru/ru/lichnyj-kabinet).


Dear ".$from_fio.",

".$from_name." (".$from_post.", ".$from_org.") has edited the date/time/Meeting Room of the meeting with you during Russian PPP Week.

Date and time of the meeting: ".$date." 2016 года в ".$time."
Venue: Meeting Room ".$nper.".
Purpose: ".$tsel.".
Contacts: ".$from_name."
Tel: ".$kontaktnyytelefon."
e-mail: ".$Email."

You can confirm or cancel the appointment, as well as edit the suggested date and time in Personal Account (http://p3week.ru/en/lichnyj-kabinet).";


		$body = $message."";
		mail($to, $title, $body, $header);

		$title = "Встреча с ".$from_org1." изменена / Meeting with ".$from_org." is edited";
		$from = 'p3week@p3week.ru';
		$to= $item->USER_ID2_EMAIL;
		$header = "From: ".$from."\r\n";
		$header.= "CC: p3week@p3week.ru\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type: text/plain; charset=utf-8\r\n";
		$header.= "X-Priority: 1\r\n";
		$message = "
Уважаемый(ая) ".$from_name."!

Вы изменили  дату/время/номер переговорной с ".$from_org1." в рамках Российской недели ГЧП.

Дата и время встречи: ".$date." 2016 года в ".$time."
Место встречи: Переговорная ".$nper.".
Цель встречи: ".$tsel.".
Контакты: ".$from_fio."
Тел: ".$item->USER_ID1_PHONE."
e-mail: ".$item->USER_ID1_EMAIL."

Вы можете подтвердить или отменить встречу, а также внести изменения в предложенные дату, время и номер переговорной в личном кабинете (http://p3week.ru/ru/lichnyj-kabinet).


Dear ".$from_name.",

You have edited date/time/Meeting Room of the meeting with ".$from_org1." on Russian PPP Week.

Date and time of the meeting: ".$date." 2016 года в ".$time."
Venue: Meeting Room ".$nper.".
Purpose: ".$tsel.".
Contacts: ".$from_fio."
Tel: ".$item->USER_ID1_PHONE."
e-mail: ".$item->USER_ID1_EMAIL."

You can confirm or cancel the appointment, as well as edit the suggested date and time in Personal Account (http://p3week.ru/en/lichnyj-kabinet).";

		$body = $message."";
		mail($to, $title, $body, $header);


			$page = $_SERVER['REQUEST_URI'];
//            header("Refresh:1; url=$page");
			header("Location: /lichnyj-kabinet");
	}

	if ($_POST["fsubmm".$counter]) {

		$input = new JInput;
		$post = $input->getArray($_POST);
		$from = $current_user->id;
		$to = $item->USER_ID1;
		$tsel = $post["tsel"];
		$date = $post["date"];
		$time = $post["time"];
		$nper = $post["nper"];
		$soglas = 1;
		$from_name = $post["from_name"];
		$from_org = $post["from_org"];
		$from_post = $post["from_post"];
		$from_tel = $post["from_tel"];
		$from_email = $post["from_email"];
		$readed = 1;
		$datetime = date('Y-m-d H:i:s');
		$from_fio = $post["id2info1"];
		$from_org1 = $post["id2info2"];
		$from_dolj = $post["id2info3"];
		$deleted = 0;
		$toemail = $item->USER_ID1_EMAIL;
		$tophone = $item->USER_ID1_PHONE;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns1 = array('USER_ID1','USER_ID2','TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'USER_ID1_FIO', 'USER_ID1_ORG', 'USER_ID1_DOLJ', 'USER_ID1_PHONE', 'USER_ID1_EMAIL', 'LK_READ', 'LK_DATETIME', 'USER_ID2_FIO', 'USER_ID2_ORG', 'USER_ID2_DOLJ', 'DELETED', 'USER_ID2_EMAIL', 'USER_ID2_PHONE'); // add more table columns here
		$values1 = array(
			$db->quote($from),
			$db->quote($to),
			$db->quote($tsel),
			$db->quote($item->LK_DATE),
			$db->quote($item->LK_TIME),
			$db->quote($item->N_PER),
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
			->insert($db->quoteName('#__lk_vstrechi'))
			->columns($db->quoteName($columns1))
			->values(implode(',', $values1));
		$db->setQuery($query1);
		$db->execute();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns1 = array('USER_ID1','USER_ID2','TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'USER_ID1_FIO', 'USER_ID1_ORG', 'USER_ID1_DOLJ', 'USER_ID1_PHONE', 'USER_ID1_EMAIL', 'LK_READ', 'LK_DATETIME', 'USER_ID2_FIO', 'USER_ID2_ORG', 'USER_ID2_DOLJ', 'DELETED', 'USER_ID2_EMAIL', 'USER_ID2_PHONE'); // add more table columns here
		$values1 = array(
			$db->quote($from),
			$db->quote($to),
			$db->quote($tsel),
			$db->quote($item->LK_DATE),
			$db->quote($item->LK_TIME),
			$db->quote($item->N_PER),
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
		$query3 = $db->getQuery(true);
		// DELETE FROM `#__lk_vstrechi` WHERE ID IN (SELECT ID FROM `#__lk_vstrechi_view` WHERE USER_ID1 = '677' OR USER_ID2 = '677' GROUP BY ID, TSEL, SOGLAS  HAVING TSEL = 'fghgj' AND SOGLAS <> "1")
		$db->setQuery($query3);
		$query31 = '(SELECT LK_DATETIME FROM `#__lk_vstrechi_view` WHERE USER_ID1 = '.$db->quote($from).' OR USER_ID2 = '.$db->quote($from).' GROUP BY LK_DATETIME, TSEL, SOGLAS HAVING TSEL = '.$db->quote($tsel).' AND SOGLAS <> "1")';
		$query3
			->delete($db->quoteName('#__lk_vstrechi'))
			->where('LK_DATETIME IN '.$query31);
		$db->execute();

		$title = "Встреча с ".$from_org." подтверждена / Meeting with ".$from_org." is confirmed";
		$from = 'p3week@p3week.ru';
		$to= $toemail;
		$header = "From: ".$from."\r\n";
		$header.= "CC: p3week@p3week.ru\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type: text/plain; charset=utf-8\r\n";
		$header.= "X-Priority: 1\r\n";
		$message = "
Уважаемый(ая) ".$from_fio."!

".$from_name." (".$from_post.", ".$from_org.") подтверждает свое участие во встрече с Вами в рамках Российской недели ГЧП.

Дата и время встречи: ".$item->LK_DATE." 2016 года в ".$item->LK_TIME."
Место встречи: Переговорная ".$item->N_PER.".
Цель встречи: ".$tsel.".
Контакты: ".$from_name."
Тел: ".$kontaktnyytelefon."
e-mail: ".$Email."

Вы можете отменить встречу в личном кабинете (http://p3week.ru/ru/lichnyj-kabinet).


Dear ".$from_fio."!

".$from_name." (".$from_post.", ".$from_org.") confirms that he/she will be participating in the meeting with you on Russian PPP Week.

Date and time of the meeting: ".$item->LK_DATE." 2016 at ".$item->LK_TIME."
Venue: Meeting Room ".$item->N_PER.".
Purpose: ".$tsel.".
Contacts: ".$from_name."
Tel: ".$kontaktnyytelefon."
e-mail: ".$Email."

You can cancel the appointment in Personal Account (http://p3week.ru/en/lichnyj-kabinet).
";

		$body = $message."";
		mail($to, $title, $body, $header);

		$title = "Встреча с ".$from_org1." подтверждена / Meeting with ".$from_org1." is confirmed";
		$from = 'p3week@p3week.ru';
		$to= $item->USER_ID2_EMAIL;
		$header = "From: ".$from."\r\n";
		$header.= "CC: p3week@p3week.ru\r\n";
		$header.= "MIME-Version: 1.0\r\n";
		$header.= "Content-Type: text/plain; charset=utf-8\r\n";
		$header.= "X-Priority: 1\r\n";
		$message = "
Уважаемый(ая) ".$from_name."!

Вы подтвердили свое участие во встрече с ".$from_org1." в рамках Российской недели ГЧП.

Дата и время встречи: ".$item->LK_DATE." 2016 года в ".$item->LK_TIME."
Место встречи: Переговорная ".$item->N_PER.".
Цель встречи: ".$tsel.".
Контакты: ".$from_fio."
Тел: ".$item->USER_ID1_PHONE."
e-mail: ".$item->USER_ID1_EMAIL."

Вы можете отменить встречу в личном кабинете (http://p3week.ru/ru/lichnyj-kabinet).


Dear ".$from_name."!

You have confirmed your participation in the meeting with ".$from_org1." during Russian PPP Week.

Date and time of the meeting: ".$item->LK_DATE." 2016 at ".$item->LK_TIME."
Venue: Meeting Room ".$item->N_PER.".
Purpose: ".$tsel.".
Contacts: ".$from_fio."
Tel: ".$item->USER_ID1_PHONE."
e-mail: ".$item->USER_ID1_EMAIL."

You can cancel the appointment in Personal Account (http://p3week.ru/en/lichnyj-kabinet).
";
		$body = $message."";
		mail($to, $title, $body, $header);


		$page = $_SERVER['REQUEST_URI'];
//        header("Refresh:1; url=$page");
		header("Location: /lichnyj-kabinet");
	}

	if ($_POST["dsubmm".$counter]) {

		$input = new JInput;
		$post = $input->getArray($_POST);
		$from = $current_user->id;
		$to = $item->USER_ID1;
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
		$readed = 1;
		$datetime = date('Y-m-d H:i:s');
		$from_fio = $post["id2info1"];
		$from_org1 = $post["id2info2"];
		$from_dolj = $post["id2info3"];
		$deleted = 1;
		$toemail = $item->USER_ID1_EMAIL;
		$tophone = $item->USER_ID1_PHONE;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns1 = array('USER_ID1','USER_ID2','TSEL', 'LK_DATE', 'LK_TIME', 'N_PER', 'SOGLAS', 'USER_ID1_FIO', 'USER_ID1_ORG', 'USER_ID1_DOLJ', 'USER_ID1_PHONE', 'USER_ID1_EMAIL', 'LK_READ', 'LK_DATETIME', 'USER_ID2_FIO', 'USER_ID2_ORG', 'USER_ID2_DOLJ', 'DELETED', 'USER_ID2_EMAIL', 'USER_ID2_PHONE'); // add more table columns here
		$values1 = array(
			$db->quote($from),
			$db->quote($to),
			$db->quote($tsel),
			$db->quote($item->LK_DATE),
			$db->quote($item->LK_TIME),
			$db->quote($item->N_PER),
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
		$query3 = $db->getQuery(true);
		// DELETE FROM `#__lk_vstrechi` WHERE ID IN (SELECT ID FROM `#__lk_vstrechi_view` WHERE USER_ID1 = '677' OR USER_ID2 = '677' GROUP BY ID, TSEL, DELETED  HAVING TSEL = 'fghgj' AND DELETED <> "1")
		$db->setQuery($query3);
		$query31 = '(SELECT LK_DATETIME FROM `#__lk_vstrechi_view` WHERE USER_ID1 = '.$db->quote($from).' OR USER_ID2 = '.$db->quote($from).' GROUP BY LK_DATETIME, TSEL, DELETED HAVING TSEL = '.$db->quote($tsel).' AND DELETED <> "1")';
		$query3
			->delete($db->quoteName('#__lk_vstrechi'))
			->where('LK_DATETIME IN '.$query31);
		$db->execute();

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
		$to= $item->USER_ID2_EMAIL;
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

		$page = $_SERVER['REQUEST_URI'];
//        header("Refresh:1; url=$page");
		header("Location: /lichnyj-kabinet");
	}

	echo "<script>tttrrr = jQuery(\".dolj:contains('".$item->TSEL."')\");</script>";
	echo "<script>ttt = jQuery(\".dolj:contains('".$item->TSEL."')\").parent().children().has('a');</script>";
	echo "<script>
	tttrrr.parent().has('.descnt').slice(1).each(function(){
		jQuery(this).children().has('a').children().eq(0).before('<b>".$uved."</b>');
		jQuery(this).children().has('a').children().has('a').remove();
	   // jQuery(this).children().has('a').parent().children('.descnt').children('a').remove();
	})
	</script>";
}

?>
</table>
<div class="class-content"></div>
<script>
jQuery(function(){
	jQuery(".cbox").colorbox({width:"800px", inline:true, href:function(){
	var elementID = jQuery(this).attr('href');
	return elementID;
}, onComplete: function() {
	jQuery('.chekonload').click();
}});
});
</script>

<?php if('en-GB' == $curlang ): ?>
	<script>
	jQuery('.item-page h1').html('Personal account');
	jQuery('.mclassuv .nn_tabs-toggle-inner').html('Notifications');
	</script>
<?php elseif('ru-RU' == $curlang ): ?>
	<script>
	jQuery('.item-page h1').html('Личный кабинет');
	</script>
<?php endif; ?>
