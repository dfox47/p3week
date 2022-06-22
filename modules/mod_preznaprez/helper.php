<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 

class ModHelloWorld2Helper583
{     
	public function getItems($userCount)    
	{        
		// подключаемся к БД        
		$db = &JFactory::getDBO();         
		// берем список случайных пользователей ограниченных переменной $userCount        
		$query = 'SELECT a.name FROM `#__users` AS a ORDER BY rand() LIMIT ' . $userCount  . '';         
		$db->setQuery($query);        
		$items = ($items = $db->loadObjectList())?$items:array();         
		return $items;    
	} //конец функции getItems 
}