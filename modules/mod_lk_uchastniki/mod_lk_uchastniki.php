<?php
// no direct access
defined('_JEXEC') or die('Restricted access');require_once(dirname(__FILE__).DS.'helper.php'); 

// берем параметры из файла конфигурации
//$userCount = $params->get('usercount'); 
// берем items из файла helper
$items = ModHelloWorld2Helper41::getItems(); 
$items3 = ModHelloWorld2Helper41::getItems(true);
//ModHelloWorld2Helper41::changePass();
$db = &JFactory::getDBO();
/*
		for($i = 2024; $i <=2153; $i++){
			$query = "INSERT INTO #__user_profiles (`user_id`, `profile_key`, `profile_value`) VALUES ({$i}, 'profilepicture.file', 'empty.jpg');";
			$db->setQuery($query);
			$db->execute();
		}*/

// подключаем шаблон для отображения
require(JModuleHelper::getLayoutPath('mod_lk_uchastniki'));