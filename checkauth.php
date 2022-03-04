<?php

    /* Initialize Joomla framework */
    if (!defined('_JEXEC')) {
        define( '_JEXEC', 1 );
        define('JPATH_BASE', dirname(__FILE__) );
        define( 'DS', DIRECTORY_SEPARATOR );
        /* Required Files */
        require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
        require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
        /* To use Joomla's Database Class */
        require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
        require_once ( JPATH_LIBRARIES.DS.'import.php'); // Joomla library imports.
        /* Create the Application */
        $app = JFactory::getApplication('site')->initialise();
    }
?>
<?php
	$input = JFactory::getApplication()->input;
	$uname = $input->get( 'uname', 1, STRING );
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
		$query = "
SELECT 	up1.profile_value AS 'imya',
		up2.profile_value AS 'otchestvo',
		'' AS 'Логин', '' AS 'Пароль',
		up3.profile_value AS 'sex',
		up4.profile_value AS 'birthday',
		up5.profile_value AS 'grazhdanstvo',
		up6.profile_value AS 'mestorozhdeniyastrana',
		up7.profile_value AS 'mestorozhdeniyagorod',
		up8.profile_value AS 'kontaktnoyelitso',
		up9.profile_value AS 'kontaktnyytelefon',
		up10.profile_value AS 'Email',
		up11.profile_value AS 'organizatsiya',
		up12.profile_value AS 'organizatsionnopravovayaforma',
		up13.profile_value AS 'dolzhnost',
		up14.profile_value AS 'otraslevayaprinadlezhnost',
		up15.profile_value AS 'telefonfaks',
		up16.profile_value AS 'internetsait',
		up17.profile_value AS 'strana',
		up18.profile_value AS 'gorod',
		concat(up19.profile_value, ', ', up18.profile_value, ', ', up20.profile_value, ', дом ', up21.profile_value , ', стр. ', up22.profile_value , ', корп. ', up23.profile_value , ', кв. ', up24.profile_value ) AS 'adresorganizatsii',
		concat(up25.profile_value , ' ' , up26.profile_value) AS 'otkudavyuznaliomeropriyati',
		concat(up27.profile_value , ' ' , up28.profile_value) AS 'prichinaposeshcheniyameropriyatiya',
		up29.profile_value AS 'kommentariy',
		'' AS 'Фотография (для спикеров)',
		up30.profile_value AS 'soglasheniye',
		up31.profile_value AS 'statusuchastiya',
		up32.username AS 'username',
		up32.name AS 'name',
		up32.email AS 'email',
		up32.id AS 'id',
		up32.block AS 'block',
		up33.profile_value AS 'profilepicturefile'
FROM #__user_profiles up1
	LEFT JOIN #__user_profiles up2
		ON up2.user_id = up1.user_id
	LEFT JOIN #__user_profiles up3
		ON up3.user_id = up1.user_id
	LEFT JOIN #__user_profiles up4
		ON up4.user_id = up1.user_id
	LEFT JOIN #__user_profiles up5
		ON up5.user_id = up1.user_id
	LEFT JOIN #__user_profiles up6
		ON up6.user_id = up1.user_id
	LEFT JOIN #__user_profiles up7
		ON up7.user_id = up1.user_id
	LEFT JOIN #__user_profiles up8
		ON up8.user_id = up1.user_id
	LEFT JOIN #__user_profiles up9
		ON up9.user_id = up1.user_id
	LEFT JOIN #__user_profiles up10
		ON up10.user_id = up1.user_id
	LEFT JOIN #__user_profiles up11
		ON up11.user_id = up1.user_id
	LEFT JOIN #__user_profiles up12
		ON up12.user_id = up1.user_id
	LEFT JOIN #__user_profiles up13
		ON up13.user_id = up1.user_id
	LEFT JOIN #__user_profiles up14
		ON up14.user_id = up1.user_id
	LEFT JOIN #__user_profiles up15
		ON up15.user_id = up1.user_id
	LEFT JOIN #__user_profiles up16
		ON up16.user_id = up1.user_id
	LEFT JOIN #__user_profiles up17
		ON up17.user_id = up1.user_id
	LEFT JOIN #__user_profiles up18
		ON up18.user_id = up1.user_id
	LEFT JOIN #__user_profiles up19
		ON up19.user_id = up1.user_id
	LEFT JOIN #__user_profiles up20
		ON up20.user_id = up1.user_id
	LEFT JOIN #__user_profiles up21
		ON up21.user_id = up1.user_id
	LEFT JOIN #__user_profiles up22
		ON up22.user_id = up1.user_id
	LEFT JOIN #__user_profiles up23
		ON up23.user_id = up1.user_id
	LEFT JOIN #__user_profiles up24
		ON up24.user_id = up1.user_id
	LEFT JOIN #__user_profiles up25
		ON up25.user_id = up1.user_id
	LEFT JOIN #__user_profiles up26
		ON up26.user_id = up1.user_id
	LEFT JOIN #__user_profiles up27
		ON up27.user_id = up1.user_id
	LEFT JOIN #__user_profiles up28
		ON up28.user_id = up1.user_id
	LEFT JOIN #__user_profiles up29
		ON up29.user_id = up1.user_id
	LEFT JOIN #__user_profiles up30
		ON up30.user_id = up1.user_id
	LEFT JOIN #__user_profiles up31
		ON up31.user_id = up1.user_id
	LEFT JOIN #__users up32
		ON up32.id = up1.user_id
	LEFT JOIN #__user_profiles up33
		ON up33.user_id = up1.user_id
	WHERE
		up1.profile_key = 'hkm_profile.uniqueID47'
		AND up2.profile_key = 'hkm_profile.uniqueID48'
		AND up3.profile_key = 'hkm_profile.uniqueID65'
		AND up4.profile_key = 'hkm_profile.uniqueID6'
		AND up5.profile_key = 'hkm_profile.uniqueID7'
		AND up6.profile_key = 'hkm_profile.uniqueID9'
		AND up7.profile_key = 'hkm_profile.uniqueID10'
		AND up8.profile_key = 'hkm_profile.uniqueID20'
		AND up9.profile_key = 'hkm_profile.uniqueID21'
		AND up10.profile_key = 'hkm_profile.uniqueID22'
		AND up11.profile_key = 'hkm_profile.uniqueID23'
		AND up12.profile_key = 'hkm_profile.uniqueID26'
		AND up13.profile_key = 'hkm_profile.uniqueID24'
		AND up14.profile_key = 'hkm_profile.uniqueID27'
		AND up15.profile_key = 'hkm_profile.uniqueID25'
		AND up16.profile_key = 'hkm_profile.uniqueID28'
		AND up17.profile_key = 'hkm_profile.uniqueID30'
		AND up18.profile_key = 'hkm_profile.uniqueID31'
		AND up19.profile_key = 'hkm_profile.uniqueID34'
		AND up20.profile_key = 'hkm_profile.uniqueID35'
		AND up21.profile_key = 'hkm_profile.uniqueID32'
		AND up22.profile_key = 'hkm_profile.uniqueID33'
		AND up23.profile_key = 'hkm_profile.uniqueID36'
		AND up24.profile_key = 'hkm_profile.uniqueID37'
		AND up25.profile_key = 'hkm_profile.uniqueID38'
		AND up26.profile_key = 'hkm_profile.uniqueID40'
		AND up27.profile_key = 'hkm_profile.uniqueID39'
		AND up28.profile_key = 'hkm_profile.uniqueID41'
		AND up29.profile_key = 'hkm_profile.uniqueID46'
		AND up30.profile_key = 'hkm_profile.uniqueID44'
		AND up31.profile_key = 'hkm_profile.uniqueID66'
		AND up32.username = '$uname'
		AND up33.profile_key = 'profilepicture.file'
		";
//		$query = 'SELECT a.username, a.block FROM `#__users` AS a WHERE a.username="'.$uname.'" ORDER BY rand() LIMIT 1';         
	$db->setQuery($query);
	$db->execute();
	$items = ($items = $db->loadObjectList())?$items:array();
	foreach ($items as $items1) {

			if($items1->statusuchastiya == 'Стандарт (17-18 или 19 марта)') { $types = 'standard';}
			if($items1->statusuchastiya == 'Бизнес (17-18 или 19 марта)') { $types = 'business';}
			if($items1->statusuchastiya == 'Премиум (17-19 марта)') { $types = 'premium';}
			if($items1->statusuchastiya == 'VIP (17-20 марта)') { $types = 'vip';}
			if($items1->statusuchastiya == 'Образование (20 марта)') { $types = 'education';}
			if($items1->statusuchastiya == 'Органы власти (17-19 марта)') { $types = 'free';}
			if($items1->statusuchastiya == 'Спонсор') { $types = 'free';}
			if($items1->statusuchastiya == 'СМИ') { $types = 'free';}

		if ($items1->username == "") {
			echo "";
		}else{
			if($items1->block == 0) {echo $items1->username; echo "
				<script>
					block = '".$items1->block."';
					types = '".$types."';
					fname = '".$items1->imya."';
					lname = '".$items1->name."';
					email = '".$items1->email."';
					company = '".$items1->organizatsionnopravovayaforma." ".$items1->organizatsiya."';
				</script>";}
			if($items1->block == 1) {echo "
				<script>
					block = '".$items1->block."';
					types = '".$types."';
					fname = '".$items1->imya."';
					lname = '".$items1->name."';
					email = '".$items1->email."';
					company = '".$items1->organizatsionnopravovayaforma." ".$items1->organizatsiya."';
				</script>";}
		}
	}
?>
