<?php

    /* Initialize Joomla framework */
    if (!defined('_JEXEC')) {
        define( '_JEXEC', 1 );
        define('JPATH_BASE', dirname(__FILE__) );
        define( 'DS', DIRECTORY_SEPARATOR );
        /* Required Files */
        require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
        require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
        /* To use Joomla's Database Class */
        require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
        require_once ( JPATH_LIBRARIES.DS.'import.php'); // Joomla library imports.
        /* Create the Application */
        $app = JFactory::getApplication('site')->initialise();
    }
?>
<?php
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query = 'SELECT a.email FROM `#__users` AS a WHERE a.email="'.$_POST["buyer"]["email"].'" ORDER BY rand() LIMIT 3';         
	$db->setQuery($query);
	$db->execute();
	$items = ($items = $db->loadObjectList())?$items:array();
	foreach ($items as $items1) {
		echo $items->email;
		$db1 = JFactory::getDbo();
		$query1 = $db1->getQuery(true);
		$query1 = 'UPDATE `#__users` AS a SET a.block="0", a.activation="" WHERE a.email="'.$_POST["buyer"]["email"].'"';         
		$db1->setQuery($query1);
		$db1->execute();
		echo "ok";
	}
?>
