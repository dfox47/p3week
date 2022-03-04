<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 

class ModHelloWorld2Helper41
{     
	public function getItems($current_user = false)    
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
		up7.profile_value AS 'profilepicturefile',
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
	LEFT JOIN #__user_profiles up7 
		ON up7.user_id = up1.user_id
	LEFT JOIN #__users u
		ON u.id = up1.user_id
	WHERE
		up1.profile_key = 'hkm_profile.uniqueID10' 
		AND up2.profile_key = 'hkm_profile.uniqueID20'
		AND up3.profile_key = 'hkm_profile.uniqueID6'
		AND up4.profile_key = 'hkm_profile.uniqueID23'
		AND up5.profile_key = 'hkm_profile.uniqueID24'
		AND up6.profile_key = 'hkm_profile.uniqueID21'
		AND up7.profile_key = 'profilepicture.file'
		AND {$and} 
		AND u.block != 1
		ORDER BY name
		";
		$db->setQuery($query);
		$items = ($items = $db->loadObjectList()) ? $items : array();
		return $items;    
	}
	
	public function changePass(){
		$db = &JFactory::getDBO();
		$query = "SELECT id, name FROM #__users WHERE password = '202cb962ac59075b964b07152d234b70'";
		$db->setQuery($query);
		$users = $db->loadObjectList();
		foreach($users as $user){
			$new_pass = md5($user->name);
			$query = "UPDATE #__users SET password='{$new_pass}' WHERE id={$user->id}";
			$db->setQuery($query);
			$db->execute();
		}
	}
}