<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once( dirname( __FILE__ ) . '/helper.php' );
$data = modAjaxchecklkformHelper::getData( $params );
$moduleclass_sfx = htmlspecialchars( $params->get( 'moduleclass_sfx' ) );
require( JModuleHelper::getLayoutPath( 'mod_ajax_checklkform', $params->get( 'layout', 'default' ) ) );