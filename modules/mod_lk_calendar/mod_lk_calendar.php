<?php
// no direct access
defined('_JEXEC') or die('Restricted access');require_once(dirname(__FILE__).DS.'helper.php'); 

// берем параметры из файла конфигурации
$userCount = $params->get('usercount'); 

// берем items из файла helper
$items22 = ModHelloWorld2Helper29::getItems($userCount);

$items1 = ModHelloWorld2Helper29::getItems1($userCount);
$items33 = ModHelloWorld2Helper29::getItems33($userCount);

// подключаем шаблон для отображения
require(JModuleHelper::getLayoutPath('mod_lk_calendar'));