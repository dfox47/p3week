<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
require_once __DIR__ . '/helper.php';
$helper = new ModUserImportHelper();

if($file = $_FILES['import'])
{
	$data = $helper->readExelFile($file['tmp_name']); 
	unset($data[0]);
	//$password = md5('123');
	foreach($data as $d){
		$user = new stdClass();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select(array('id'))
			->from($db->quoteName('#__users'))
			->where($db->quoteName('email') .'='.$db->quote($d[4]));
		$db->setQuery($query);

		if($row = $db->loadRow()){
			$object = new stdClass();
			$object->id = $row['id'];
			$object->block = 0;
			JFactory::getDbo()->updateObject('#__users', $object, 'id');			
		}else{
			// Фамилия
			$user->name = $d[0];
			$user->username = $user->email = $d[4];
			$user->password = md5($d[0]);
			$user->registerDate = date("Y-m-d H:i:s");
			JFactory::getDbo()->insertObject('#__users', $user);
			if($user_id = JFactory::getDbo()->insertid())
			{
				// Фамилия
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID6', $d[0]);
				// Имя
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID10', $d[1]);
				// Отчество
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID20', $d[2]);
				// Телефон
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID21', $d[5]);
				// Организация
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID23', $d[6]);
				// Должность
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID24', $d[7]);
				// Адрес
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID31', $d[10]);
				// Сайт
				$helper->saveProfile($user_id, 'hkm_profile.uniqueID28', $d[11]);		
				// Фото
				$helper->saveProfile($user_id, 'profilepicture.file', '');	
			}	
		}	
	}	
}


// подключаем шаблон для отображения
require(JModuleHelper::getLayoutPath('mod_user_import'));