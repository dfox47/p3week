<?php
/**
* @id			$Id$
* @author 		Sherza (sherza.web@gmail.com)
* @package  	HKM Profile
* @copyright 	Copyright (C) 2011 - 2012 Hekima.ru. http://hekima.ru  All rights reserved.
* @license  	GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/
 
 defined('JPATH_BASE') or die;
 
  /**
   * An example custom profile plugin.
   *
   * @package        Joomla.Plugins
   * @subpackage    user.profile
   * @version        1.6
   */
  class plgUserHkm_profile extends JPlugin
  {
    /**
     * @param    string    The context for the data
     * @param    int        The user id
     * @param    object
     * @return    boolean
     * @since    1.6
     */
    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }    
    function onContentPrepareData($context, $data)
    {
        // Check we are manipulating a valid form.
        if (!in_array($context, array('com_users.profile','com_users.registration','com_users.user','com_admin.profile'))){
            return true;
        }
 
        $userId = isset($data->id) ? $data->id : 0;
 
        // Load the profile data from the database.
        $db = &JFactory::getDbo();
        $db->setQuery(
            'SELECT profile_key, profile_value FROM #__user_profiles' .
            ' WHERE user_id = '.(int) $userId .
            ' AND profile_key LIKE \'hkm_profile.%\'' .
            ' ORDER BY ordering'
        );
        $results = $db->loadRowList();
 
        // Check for a database error.
        if ($db->getErrorNum()) {
            $this->_subject->setError($db->getErrorMsg());
            return false;
        }
 
        // Merge the profile data.
        $data->hkm_profile = array();
        foreach ($results as $v) {
            $k = str_replace('hkm_profile.', '', $v[0]);
            $v1arr=(JRequest::getVar('layout')=='edit')? explode("\n", $v[1]) : str_replace("\n", ", " ,$v[1]);
            $data->hkm_profile[$k] = (!empty($v1arr)&& isset($v1arr[1]))? $v1arr : $v[1];
        }
 
        return true;
    }
 
    /**
     * @param    JForm    The form to be altered.
     * @param    array    The associated data for the form.
     * @return    boolean
     * @since    1.6
     */
    function onContentPrepareForm($form, $data)
    {

        // Load user_profile plugin language
        $lang = JFactory::getLanguage();
        $lang->load('plg_user_hkm_profile', JPATH_ADMINISTRATOR);
 
        if (!($form instanceof JForm)) {
            $this->_subject->setError('JERROR_NOT_A_FORM');
            return false;
        }
        // Check we are manipulating a valid form.
        if (!in_array($form->getName(), array('com_users.profile', 'com_users.registration','com_users.user','com_admin.profile'))) {
            return true;
        }
        if ($form->getName()=='com_users.profile')
        {
            // Add the profile fields to the form.
            //JForm::addFormPath(dirname(__FILE__).'/profiles');
            //$form->loadFile('profile', false);

            $formXMLGen = $this->getUserdataParams();
            $form->load($formXMLGen);


            $userinfo = $this->params->get('userinfo');

            foreach($userinfo->fieldName as $fieldNum=>$fname){

                $fieldReq=is_array($userinfo->fieldRequiredProfile)? 
                $userinfo->fieldRequiredProfile[$fieldNum]: 
                $userinfo->fieldRequiredProfile->$fieldNum;

                if ($fieldReq > 0) {
                    $form->setFieldAttribute($fname, 'required', $fieldReq == 2, 'hkm_profile');
                } else {
                    $form->removeField($fname, 'hkm_profile');
                }

            }            
        }
 
        //In this example, we treat the frontend registration and the back end user create or edit as the same. 
        elseif ($form->getName()=='com_users.registration' || $form->getName()=='com_users.user' )
        {       

            // Add the registration fields to the form.
            //JForm::addFormPath(dirname(__FILE__).'/profiles');
            //$form->loadFile('profile', false);

//
            $formXMLGen = $this->getUserdataParams();
	        $form->load($formXMLGen);


            $userinfo = $this->params->get('userinfo');

            foreach($userinfo->fieldName as $fieldNum=>$fname){

                $fieldReq=is_array($userinfo->fieldRequiredRegistration)? 
                $userinfo->fieldRequiredRegistration[$fieldNum]: 
                $userinfo->fieldRequiredRegistration->$fieldNum;

                if ($fieldReq > 0) {
                    $form->setFieldAttribute($fname, 'required', $fieldReq == 2, 'hkm_profile');
                } else {
                    $form->removeField($fname, 'hkm_profile');
                }

            }
        }            
    }

    function getUserdataParams(){

        $userinfo = $this->params->get('userinfo');
        $html ='<form>
        <fields name="hkm_profile">
        <fieldset name="hkm_profile"
            label="PLG_USER_hkm_profile_SLIDER_LABEL"
        >';
        $showOptionsVariants=array('list', 'radio');

        foreach($userinfo->fieldName as $fieldNum=>$fname){
            if($fname!='uniqueID0'){
                $type=(is_array($userinfo->fieldType))? $userinfo->fieldType[$fieldNum] : $userinfo->fieldType->$fieldNum;
                $fieldParams=(is_array($userinfo->fieldParams))? $userinfo->fieldParams[$fieldNum] : $userinfo->fieldParams->$fieldNum;
                $fieldFilter=(is_array($userinfo->fieldFilter))? $userinfo->fieldFilter[$fieldNum] : $userinfo->fieldFilter->$fieldNum;

                $fieldDescription=(is_array($userinfo->fieldDescription))? $userinfo->fieldDescription[$fieldNum] : $userinfo->fieldDescription->$fieldNum;
                $code=(is_array($userinfo->code))? $userinfo->code[$fieldNum] : $userinfo->code->$fieldNum;
                $fieldMessage=(is_array($userinfo->fieldMessage))? $userinfo->fieldMessage[$fieldNum] : $userinfo->fieldMessage->$fieldNum;
                $fieldDefaultValue=(is_array($userinfo->fieldDefaultValue))? $userinfo->fieldDefaultValue[$fieldNum] : $userinfo->fieldDefaultValue->$fieldNum;


                if($fieldFilter) $fieldParams.=' filter="'.$fieldFilter.'" ';      


                switch ($type) {
                    case 'multiselect':     
                        $fieldParams.=' multiple="true" ';               
                    case 'select':
                        $type='list';
                        break;
                    case 'Checkboxes':
					 $type='Checkboxes'; 
					
                        break;
                    case 'date':
                        $type='calendar';

                         break;
                  
                    default:
                        # code...
                        break;
                }
                $html .='<field
                        name="'.$fname.'"
                        type="'.$type.'"
                        id="'.$fname.'"
                        description="'.($fieldDescription).'"
                        label="'.($code).'"
                        message="'.($fieldMessage).'"
                        default="'.($fieldDefaultValue).'"
                        '.$fieldParams;
                    if(in_array($type, $showOptionsVariants) && is_array($userinfo->fieldOptions_value) && isset($userinfo->fieldOptions_value[$fieldNum]) && !empty($userinfo->fieldOptions_value[$fieldNum])){
                        $html .='>';

                        $fieldOptions_text=is_array($userinfo->fieldOptions_text)?
                        $userinfo->fieldOptions_text[$fieldNum] :
                        $userinfo->fieldOptions_text->$fieldNum;  

                        foreach($userinfo->fieldOptions_value[$fieldNum] as $optNum=>$optVal){                              

                                $optText=is_array($fieldOptions_text)?
                                $fieldOptions_text[$optNum] :
                                $fieldOptions_text->$optNum;
                                $html .='<option value="'.$optVal.'">'.$optText.'</option>';                                

                        }
                        $html .='</field>';
                    }else if(in_array($type, $showOptionsVariants) && is_object($userinfo->fieldOptions_value) && isset($userinfo->fieldOptions_value->$fieldNum) && !empty($userinfo->fieldOptions_value->$fieldNum)){
                        $html .='>';

                        $fieldOptions_text=is_array($userinfo->fieldOptions_text)?
                        $userinfo->fieldOptions_text[$fieldNum] :
                        $userinfo->fieldOptions_text->$fieldNum;  

                        foreach($userinfo->fieldOptions_value->$fieldNum as $optNum=>$optVal){                              

                                $optText=is_array($fieldOptions_text)?
                                $fieldOptions_text[$optNum] :
                                $fieldOptions_text->$optNum;
                                $html .='<option value="'.$optVal.'">'.$optText.'</option>';

                        }
                        $html .='</field>';

                    }else $html .='/>';
            }

        }
        $html .= '</fieldset>
    </fields>
</form>';
        return $html;

    }
 
    function onUserAfterSave($data, $isNew, $result, $error)
    {
        $userId    = JArrayHelper::getValue($data, 'id', 0, 'int');
 
        if ($userId && $result && isset($data['hkm_profile']) && (count($data['hkm_profile'])))
        {
            try
            {
                $db = &JFactory::getDbo();
                $db->setQuery('DELETE FROM #__user_profiles WHERE user_id = '.$userId.' AND profile_key LIKE \'hkm_profile.%\'');
                if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
                }
 
                $tuples = array();
                $order    = 1;
                foreach ($data['hkm_profile'] as $k => $v) {
                    $v = (is_array($v))? implode("\n", $v) : $v;
                    $tuples[] = '('.$userId.', '.$db->quote('hkm_profile.'.$k).', '.$db->quote($v).', '.$order++.')';
                }
 
                $db->setQuery('INSERT INTO #__user_profiles VALUES '.implode(', ', $tuples));
                if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
                }
            }
            catch (JException $e) {
                $this->_subject->setError($e->getMessage());
                return false;
            }
        }
 
        return true;
    }
 
    /**
     * Remove all user profile information for the given user ID
     *
     * Method is called after user data is deleted from the database
     *
     * @param    array        $user        Holds the user data
     * @param    boolean        $success    True if user was succesfully stored in the database
     * @param    string        $msg        Message
     */
    function onUserAfterDelete($user, $success, $msg)
    {
        if (!$success) {
            return false;
        }
 
        $userId    = JArrayHelper::getValue($user, 'id', 0, 'int');
 
        if ($userId)
        {
            try
            {
                $db = JFactory::getDbo();
                $db->setQuery(
                    'DELETE FROM #__user_profiles WHERE user_id = '.$userId .
                    " AND profile_key LIKE 'hkm_profile.%'"
                );
 
                if (!$db->query()) {
                    throw new Exception($db->getErrorMsg());
                }
            }
            catch (JException $e)
            {
                $this->_subject->setError($e->getMessage());
                return false;
            }
        }
 
        return true;
    }
 
 
 }


