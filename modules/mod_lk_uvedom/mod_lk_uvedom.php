<?php
// no direct access
defined('_JEXEC') or die('Restricted access');require_once(dirname(__FILE__).DS.'helper.php'); 

// берем параметры из файла конфигурации
$userCount = $params->get('usercount'); 

// берем items из файла helper
$items = ModHelloWorld2Helper42::getItems($userCount); 
$items1 = ModHelloWorld2Helper42::getItems1(true);
$items2 = ModHelloWorld2Helper42::getItems2();

// подключаем шаблон для отображения
require(JModuleHelper::getLayoutPath('mod_lk_uvedom'));