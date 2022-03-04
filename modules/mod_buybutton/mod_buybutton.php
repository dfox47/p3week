<?php
// no direct access
defined('_JEXEC') or die('Restricted access');require_once(dirname(__FILE__).DS.'helper.php'); 

// берем параметры из файла конфигурации
$userCount = $params->get('usercount'); 

// берем items из файла helper
$items = ModHelloWorld2Helper566::getItems($userCount); 

// подключаем шаблон для отображения
require(JModuleHelper::getLayoutPath('mod_buybutton'));