<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.'); 
jimport('phpexcel.library.PHPExcel');

class ModUserImportHelper
{
	public function readExelFile($filepath)
	{
		$inputFileType = PHPExcel_IOFactory::identify($filepath);  
		$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
		$objPHPExcel = $objReader->load($filepath); 
		$array = $objPHPExcel->getActiveSheet()->toArray();
		return $array;
	}
	
	public function saveProfile($user_id, $key, $value){
		$profile = new stdClass();
		$profile->user_id = $user_id;
		$profile->profile_key = $key;
		$profile->profile_value = $value;
		JFactory::getDbo()->insertObject('#__user_profiles', $profile);
	}
}
