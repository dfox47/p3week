<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 

class ModHelloWorld2Helper29
{     
	public function getItems($userCount)    
	{        
		// подключаемся к БД        
        $db = &JFactory::getDBO();
        $user =& JFactory::getUser();
        $userid = $user->get('id');
        // берем список случайных пользователей ограниченных переменной $userCount
        $query = "SELECT * FROM #__lk_vstrechi WHERE USER_ID1 = '$userid' OR USER_ID2 = '$userid' GROUP BY LK_DATETIME, SOGLAS HAVING SOGLAS = 1 ORDER BY LK_DATETIME DESC";
        $db->setQuery($query);
        $items22 = ($items22 = $db->loadObjectList()) ? $items22 : array();
        return $items22;
	} //конец функции getItems 

    public function getItems1()
    {
        // подключаемся к БД
        $db1 = &JFactory::getDBO();
        $user1 =& JFactory::getUser();
        $userid1 = $user1->get('id');
        // берем список случайных пользователей ограниченных переменной $userCount
        $query1 = "
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
            AND up32.id != '580'
            AND up32.id = '$userid1'
            AND up33.profile_key = 'profilepicture.file'
            ";
        $db1->setQuery($query1);
        $items1 = ($items1 = $db1->loadObjectList())?$items1:array();
        return $items1;
    } //конец функции getItems1
    public function getItems33($userCount)
    {
        // подключаемся к БД
        $db = &JFactory::getDBO();
        $user =& JFactory::getUser();
        $userid = $user->get('id');
        // берем список случайных пользователей ограниченных переменной $userCount
        $query = "SELECT * FROM #__lk_vstrechi WHERE USER_ID1 != '$userid' OR USER_ID2 != '$userid' GROUP BY LK_DATETIME, SOGLAS HAVING SOGLAS = 1 ORDER BY LK_DATETIME DESC";
        $db->setQuery($query);
        $items33 = ($items33 = $db->loadObjectList()) ? $items33 : array();
        return $items33;
    } //конец функции getItems
}