<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 

class ModHelloWorld2Helper42
{
    public function getItems($userCount)
    {
        // подключаемся к БД
        $db = &JFactory::getDBO();
        $user =& JFactory::getUser();
        $userid = $user->get('id');
        // берем список случайных пользователей ограниченных переменной $userCount
        $query = "SELECT * FROM #__lk_vstrechi_view WHERE USER_ID1 = '$userid' OR USER_ID2 = '$userid' ORDER BY LK_DATETIME DESC";
        $db->setQuery($query);
        $items = ($items = $db->loadObjectList()) ? $items : array();
        return $items;
    } //конец функции getItems
    	public function getItems1($current_user = false)    
	{        
		// подключаемся к БД        
		$db = &JFactory::getDBO();
		$user =& JFactory::getUser();
		$userid = $user->get('id'); 

	$and = ($current_user) ?	"up1.user_id = {$userid}" : "up1.user_id >= '1968'";
	
	$query = "SELECT 	
		up1.profile_value AS 'imya', 
		up2.profile_value AS 'otchestvo',	
		up3.profile_value AS 'name',		
		up4.profile_value AS 'organizatsiya', 		
		up5.profile_value AS 'dolzhnost',
		up6.profile_value AS 'kontaktnyytelefon',
		u.username AS 'username',		
		u.email AS 'email',
		u.id AS 'id'
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
	LEFT JOIN #__users u
		ON u.id = up1.user_id
	WHERE
		up1.profile_key = 'hkm_profile.uniqueID10' 
		AND up2.profile_key = 'hkm_profile.uniqueID20'
		AND up3.profile_key = 'hkm_profile.uniqueID6'
		AND up4.profile_key = 'hkm_profile.uniqueID23'
		AND up5.profile_key = 'hkm_profile.uniqueID24'
		AND up6.profile_key = 'hkm_profile.uniqueID21'
		AND {$and} 
		ORDER BY up1.user_id
		";
		$db->setQuery($query);        
		$items = ($items = $db->loadObjectList()) ? $items : array();
		return $items;    
	} //конец функции getItems1
    public function getItems2()
    {
        // подключаемся к БД
        $db2 = &JFactory::getDBO();
        $user2 =& JFactory::getUser();
        $userid2 = $user2->get('id');
        // берем список случайных пользователей ограниченных переменной $userCount
        $query2 = "SELECT * FROM #__lk_vstrechi_view WHERE USER_ID1 = '$userid2' XOR USER_ID2 = '$userid2' GROUP by TSEL HAVING count(*)>1";
        $db2->setQuery($query2);
        $items2 = ($items2 = $db2->loadObjectList()) ? $items2 : array();
        return $items2;
    } //конец функции getItems2
}
