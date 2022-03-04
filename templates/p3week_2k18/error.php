<?php defined('_JEXEC') or die;

if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

// Get language and direction
$doc				= JFactory::getDocument();
$app				= JFactory::getApplication();
$this->language		= $doc->language;
$this->direction	= $doc->direction;

/*
if (($this->error->getCode()) == '404') {
	header('Location: /error404');
	exit;
}
*/

if($this->error->getCode()=='404') {
	header("HTTP/1.0 404 Not Found");
	$url = JURI::root()."/error404";
	$data = file_get_contents($url) or die("Cannot open URL");
	echo $data;
} ?>
