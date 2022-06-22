<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Class Module Helper
 * @author Aleks.Denezh
 */
class modAjaxchecklkformHelper
{

	/**
	 * getData method
	 * @param $params
	 * @return array
	 */
	static function getData( $params )
	{

		return array();
	}

	static function getAjax()
	{
		$input = JFactory::getApplication()->input;
		$id = $input->getInt( 'id', 0 );
		$db = JFactory::getDbo();
		$query = $db->getQuery( true );
		$query->select( 'id, title' )->from( '#__content' )->where( 'id=' . $id );
		$row = $db->setQuery( $query )->loadObject();
		if ( !empty( $row->id ) ) {
			echo 'Запись с ID ' . $id . ' имеет заголовок: ' . $row->title;
		} else {
			echo 'Запись с ID ' . $id . ' не найдена: ';
		}
	}

}