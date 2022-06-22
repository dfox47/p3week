<?php
// no direct access
defined('_JEXEC') or die('Restricted access');require_once(dirname(__FILE__).DS.'helper.php'); 

// берем параметры из файла конфигурации
//$username = '';
$username = 'test';

// берем items из файла helper
$items = ModHelloWorld2Helper568::getItems($username);

// подключаем шаблон для отображения
require(JModuleHelper::getLayoutPath('mod_buybutton-check'));