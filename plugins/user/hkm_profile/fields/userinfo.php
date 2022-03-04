<?php

/**
* @id			$Id$
* @author 		Sherza (sherza.web@gmail.com)
* @package  	HKM Profile
* @copyright 	Copyright (C) 2011 - 2012 Hekima.ru. http://hekima.ru  All rights reserved.
* @license  	GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/

defined('JPATH_BASE') or die;

class JFormFieldUserinfo extends JFormField
{

	protected $type = 'userinfo';

	public function __construct()
	{
		parent::__construct();

		if(defined('ZE_USERINFO_JUST_ADDED')) return;
		define('ZE_USERINFO_JUST_ADDED', true);
		JHtml::_('behavior.framework');

		$doc = JFactory::getDocument();
		$doc->addStyleSheet(JURI::root().'plugins/user/hkm_profile/fields/userinfo.css');
		$doc->addScript(JURI::root().'plugins/user/hkm_profile/fields/drag.js');
		//$doc->addStyleSheet(JURI::root().'plugins/user/hkm_profile/fields/drag.css');
		
		$version = new JVersion();
		$Jversion = (int)substr($version->getHelpVersion(),1);
		$Jversion = (($Jversion>=30)? 30 : (($Jversion>=16)?  16 : 15));

		$disabled_options = $this->disabled_options();
		$disabledJS=array();
		foreach($disabled_options as $name=>$value){
			if(is_string($value)){
				$disabledJS[]=$name.': "'.$value.'"';
			}else{
				$disabledJSC=$name.': {';
				foreach($value as $k=>$val){
					if($k) $disabledJSC.=', ';

					$disabledJSC.=$val.': true';
				}
				$disabledJSC.='}';
				$disabledJS[]=$disabledJSC; 				
			}
		}
		$disabledJSString='var ZEdisabledJS = {'.implode(', ', $disabledJS).'}; ';

		$addSelectCorrection='';
		if($Jversion == 30){
			$addSelectCorrection = '

				newTab.getElements("select").setStyles({"display":"block"});
				newTab.getElements(".chzn-container").destroy();

				$("select", newTab).removeClass("chzn-done").chosen({
						disable_search_threshold : 10,
						allow_single_deselect : true
					});';
		}

		$doc->addScriptDeclaration($disabledJSString. '
			window.addEvent("domready", function() {
				prop={};

				var wrapperLis=$(".userinfo_wrapper")[0].getParent().getParent().getChildren("li");

				wrapperLis.each(function(el, i){
					if(!el.getChildren(".userinfo_wrapper")[0]){
						oddEven=(i%2)? "odd" : "even";
						el.addClass("zeLiWrap "+oddEven);
						var zdiv=document.createElement("div");
						zdiv.className="zeClear";
						el.appendChild(zdiv);
					}
				});


		      list2 = document.getElementById("userinfo_tab_ul_userinfo");
		      if(list2){
			      ZDragDrop.makeListContainer( list2 );
			      list2.onZDragOver = function() { this.style["border"] = "1px dashed #8E0B8C"; this.style["background"] = "#FFF"; };
			      list2.onZDragOut = function() {this.style["border"] = "1px solid transparent"; this.style["background"] = "none";};
		      }

			});
			function zeOpenClose(e, self){
				var target = e.srcElement || e.target;
				target = $(target);
				self = $(self);
				if(!target.hasClass("zeOpenCloseSpan") && !target.hasClass("userinfo_tab_head")) return;

				if(self.hasClass("zeOpened")){
					self.removeClass("zeOpened");
				}else{
					self.addClass("zeOpened");
				}
			}
			function zeFieldCheck(self, checkedEl){
				fieldname=self.getAttribute("rel");

				$(".zeFieldCheck_"+fieldname).removeClass("checked");
				if(self.hasClass("checked")){
					self.removeClass("checked");
				}else{
					self.addClass("checked");
				}
				$("jform_params_"+fieldname+"activeTab").value=checkedEl;
			}
			function zeRemove(self){
				self.parentNode.parentNode.destroy();
			}

			var ZE_NUM_ALL=[];
			function zeAddNew(fieldname){
				ZE_NUM=ZE_NUM_ALL[fieldname];

				var newTab = document.createElement("li");
				newTab.id="userinfo_tab_"+fieldname+"_"+ZE_NUM;
				newTab.className="userinfo_tab";
				var inner = $("userinfo_tab_"+fieldname+"_0").innerHTML;

				inner = inner.replace(/_ze_new_set_label_/g, ZE_NUM);

				inner = inner.replace(/jform\[params\]\[(\w*)\]\[(\w*)\]\[0\]/g, "jform[params][$1][$2]["+ZE_NUM+"]");
				inner = inner.replace(/jform\[params\]\[(\w*)\]\[(\w*)\]\[(\w*)\]\[0\]/g, "jform[params][$1][$2][$3]["+ZE_NUM+"]");
				inner = inner.replace(/jform_params_(\w*)0/g, "jform_params_$1"+ZE_NUM);
				inner = inner.replace(/jformparams(\w*)0/g, "jformparams$1"+ZE_NUM);

				inner = inner.replace(/value=\"uniqueID0\"/g, \'value="uniqueID\'+ZE_NUM+\'"\');
				inner = inner.replace(/value=\"'.JText::_('PLG_USER_HKM_PROFILE_ADD_NEW_FIELD').'0\"/g, \'value="'.JText::_('PLG_USER_HKM_PROFILE_ADD_NEW_FIELD').'\'+ZE_NUM+\'"\');

				inner = inner.replace(/zeUniqueIdLabel(\w*)0/g, "zeUniqueIdLabel$1"+ZE_NUM);

				//inner = inner.replace(/onclick=\"zeFieldCheck\(this, 0\)\"/g, "onclick=\"zeFieldCheck(this, "+ZE_NUM+")\"");
				inner = inner.replace(/onchange=\"ze_show_hide_block_types\(this, \'(\w*)\', \'(\w*)\', 0\)\"/g, "onchange=\"ze_show_hide_block_types(this, \'$1\', \'$2\', "+ZE_NUM+")\"");

				inner = inner.replace(/onclick=\"zeAllowDisableColor\(this, \'(\w*)\', \'(\w*)\', 0\)\"/g, "onclick=\"zeAllowDisableColor(this, \'$1\', \'$2\', "+ZE_NUM+")\"");

				inner = inner.replace(/ze_block_show_hide(\w*)0/g, "ze_block_show_hide$1"+ZE_NUM);

				//inner = inner.replace(/zeFieldCheck_(\w*)0/g, "zeFieldCheck_$1"+ZE_NUM);

				inner = inner.replace(/userinfo_tab_0/g, "userinfo_tab_"+ZE_NUM);

				inner = inner.replace(/zeShowHideSelectOptions\(this, \'0\'/g, "zeShowHideSelectOptions(this, \'"+ZE_NUM+"\'");
				inner = inner.replace(/sh_addField\(this, \'0\'/g, "sh_addField(this, \'"+ZE_NUM+"\'");

				inner = inner.replace(/zeShowHideSelectOptions\(this, \'0\'/g, "zeShowHideSelectOptions(this, \'"+ZE_NUM+"\'");

				inner = inner.replace(/id=\"zeLiParam(\w*)0\"/g, "id=\"zeLiParam$1"+ZE_NUM+"\"");


				newTab.innerHTML=inner;
				$("userinfo_tab_ul_"+fieldname).appendChild(newTab);


				var labelTooltip=$("zeUniqueIdLabel"+fieldname+ZE_NUM);
				var parts = labelTooltip.get("title").split("::", 2);
				labelTooltip.store("tip:title", parts[0]);
				labelTooltip.store("tip:text", parts[1]);
				new Tips(labelTooltip, { maxTitleChars: 50, fixed: false});

				/*var labelTooltip2=$("zeFieldCheck_"+fieldname+ZE_NUM);
				var parts = labelTooltip2.get("title").split("::", 2);
				labelTooltip2.store("tip:title", parts[0]);
				labelTooltip2.store("tip:text", parts[1]);
				new Tips(labelTooltip2, { maxTitleChars: 50, fixed: false});*/

				ZE_NUM++; ZE_NUM_ALL[fieldname]=ZE_NUM;

				ZDragDrop.makeItemZDragable(newTab);

				'.$addSelectCorrection.'
			}

			function ze_show_hide_block_types(self, fieldname, name, num){

				$(".ze_block_show_hide"+fieldname+name+num).hide();
				$("jformparams"+fieldname+name+self.value+num).show();

				Object.each(ZEdisabledJS, function(type, elemName){
					if(type == self.value || ((typeof(type)=="object") && (self.value in type))){
						$("zeLiParam"+fieldname+elemName+num).hide();
					}else{
						$("zeLiParam"+fieldname+elemName+num).show();
					}
				});
			}
			function zeAllowDisableColor(self, fieldname, name, num){
				$("jform_params_"+fieldname+name+num).readOnly = (self.checked)? false : true;
			}
			function sh_addField(self, num, fieldname, name){

				    wrapdiv=document.createElement("div"); 
				    wrapdiv.innerHTML=\'<div><input type="text" name="jform[params][\'+fieldname+\'][\'+name+\'_value][\'+num+\'][]" value="" /><input type="text" name="jform[params][\'+fieldname+\'][\'+name+\'_text][\'+num+\'][]" value="" /><input type="button" class="button buttonminus btn btn-danger" onclick="this.parentNode.parentNode.removeChild(this.parentNode)" value="-"></div>\'; 
				    document.getElementById("shfield_multitext_wrapper_jform_params_"+fieldname+name+num).appendChild(wrapdiv); 
			}
			function zeShowHideSelectOptions(self, num, fieldname, name){
				document.getElementById("zeLiParam"+fieldname+"fieldOptions"+num).style.display = 
				(self.value=="select" || self.value=="multiselect" || self.value=="radio" || self.value=="checkbox") ? "block" : "none"; 
			}
		');

	}
	protected function getLabel()
	{
		return '';
	}

	protected function disabled_options(){

		$disabled_options=array(
			'yandex_font_size'=>'fixed',
			'yandex_font_family'=>'fixed',
			'yandex_direct_border_type'=>'fixed',
			'yandex_direct_header_position'=>array('vertical', 'horizontal', 'flat'),
			'yandex_direct_border_type'=>'fixed'
		);
		return $disabled_options;
	}

	protected function getInput()
	{

		if(!empty($this->value['fieldName'])){
			
			$codeKeys=array();
			$count=0;
			foreach($this->value['fieldName'] as $key=>$codeVal){
				$codeKeys[$key]=$count;
				$count++;
			}

			$newValue=array();
			foreach($this->value as $vtypeName=>$vtype){
				if(!empty($vtype)){
					if(is_string($vtype)){
						$newValue[$vtypeName]=$vtype;
					}else{
						$newValue[$vtypeName]=array();
						foreach($vtype as $valName=>$val){
							if(!is_array($val) && !is_object($val)){
								$newValue[$vtypeName][$valName]=$val;
							}else{
								$newValue[$vtypeName][$valName]=array();
								foreach($val as $vc=>$v){
									//$newValue[$vtypeName][$valName][$codeKeys[$vc]]=$v;
									$newValue[$vtypeName][$valName][]=$v;
								}
							}
						}
					}
				}
			}


			$this->value = $newValue;

		}

		$disabled_options = $this->disabled_options();

		$doc = JFactory::getDocument();

		//$CountAll=(isset($this->value['fieldName']))? sizeof($this->value['fieldName']) : 1;
		$lastValue=(!empty($codeKeys))? (max(array_keys($codeKeys))+1) : 1;
		$doc->addScriptDeclaration('
			ZE_NUM_ALL["'.$this->fieldname.'"] = '.$lastValue.';
		');

		$html='<div style="clear:both"></div>';

		$html.='<div class="userinfo_wrapper" id="userinfo_wrapper_'.$this->fieldname.'">';

		$label = $this->element['label'] ? (string) $this->element['label'] : (string) $this->element['name'];

		$html.='<div class="userinfo_head" id="userinfo_head_'.$this->fieldname.'">';
		$html.=JText::_($label).':<a href="javascript:void(null)" onclick="zeAddNew(\''.$this->fieldname.'\')">'.JText::_('PLG_USER_HKM_PROFILE_ADD_NEW_FIELD').'</a>';
		$html.='</div><ul id="userinfo_tab_ul_'.$this->fieldname.'" class="sortable">';


		$activeTabVal=(isset($this->value['activeTab']) && $this->value['activeTab'])? $this->value['activeTab'] : '';

		if(!isset($this->value['code'][0])) $this->value['code'][0]=true;

		/*$FieldNamesNums=array();
		foreach($this->value['code'] as $num=>$codeUniqueID){
			$valueFieldName=($num>0 && isset($this->value['fieldName'][$num]))? $this->value['fieldName'][$num] : '';
			if($valueFieldName) $FieldNamesNums[$valueFieldName] = $num;
		}*/

		foreach($this->value['code'] as $num=>$codeUniqueID){
			//$params=$this->getParams($num);

			$html.='<li class="userinfo_tab userinfo_tab_'.$num.'" id="userinfo_tab_'.$this->fieldname.'_'.$num.'">';

			$html.='<div onclick="zeOpenClose(event, this.parentNode)" class="userinfo_tab_head">';

			/* @TODO: turn on-off fields */

			$uniqueIDVal=($num>0 && isset($this->value['code'][$num]) && $this->value['code'][$num])? $this->value['code'][$num] : JText::_('PLG_USER_HKM_PROFILE_ADD_NEW_FIELD').$num;

			$labelClass=($num)? ' class="hasTip" ' : '';
			$html.='<span class="zeFieldLabel">
					<input type="text" name="jform[params]['.$this->fieldname.'][code]['.$num.']" 
						class="zeUniqueIdClass" id="jform_params_'.$this->fieldname.'code'.$num.'" 
						rel="code" value="'.$uniqueIDVal.'"/> 
					<span '.$labelClass.' id="zeUniqueIdLabel'.$this->fieldname.$num.'" 
					title="'.JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDLABEL').'::'.JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDLABEL_DESCRIPTION').'">'.
						JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDLABEL').'
					</span>
				</span>';


			$html.='<span class="zeOpenCloseSpan"></span>';


			$html.='<span onclick="zeRemove(this)" class="zeRemoveSpan"></span>';

			$html.='</div>';

			$html.='<div class="userinfo_tab_content"><ul class="userinfo_ul">';

			$params = array();
			$params[] = array(
				'name' => 'fieldName',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDNAME'),
				'type' => 'input'
			);
			$params[] = array(
				'name' => 'fieldDescription',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDDESCRIPTION'),
				'type' => 'input'
			);
			$params[] = array(
				'name' => 'fieldMessage',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDMESSAGE'),
				'type' => 'input'
			);
			$params[] = array(
				'name' => 'fieldType',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDTYPE'),
				'type' => 'list',
				'options'=>array('text'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_TEXT'), 
					'textarea'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_TEXTAREA'), 
					'select'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_SELECT'), 
					'multiselect'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_MULTISELECT'), 
					'radio'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_RADIO'), 
					'date'=> JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_DATE'),
					'file'=> 'Поле файл')
			);
			$params[] = array(
			  'name' => 'fieldmyparams',
			  'label' => 'Мои параметры (fieldtype=avatar&)',
			  'type' => 'textarea'
			);
			$params[] = array(
				'name' => 'fieldOptions',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDLOPTIONS'),
				'type' => 'multitext'
			);
			$params[] = array(
				'name' => 'fieldFilter',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDFILTER'),
				'type' => 'list',
				'options'=>array(''=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_NOFILTER'), 'safehtml'=>'SafeHtml', 'string'=>'String', 'raw'=>'Raw')
			);
			$params[] = array(
				'name' => 'fieldParams',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDPARAMS'),
				'type' => 'textarea'
			);
			$params[] = array(
				'name' => 'fieldDefaultValue',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDDEFAULTVALUE'),
				'type' => 'input'
			);
			$params[] = array(
				'name' => 'fieldRequiredProfile',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDREQUIREDPROFILE'),
				'type' => 'list',
				'options'=>array(
					'2'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_REQUIRED'), 
					'1'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_OPTIONAL'), 
					'0'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_DISABLED'))
			);
			$params[] = array(
				'name' => 'fieldRequiredRegistration',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDREQUIREDREGISTRATION'),
				'type' => 'list',
				'options'=>array(
					'2'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_REQUIRED'), 
					'1'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_OPTIONAL'), 
					'0'=>JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_OPTION_DISABLED'))
			);
			/*$params[] = array(
				'name' => 'fieldOrdering',
				'label' => JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELDORDERING'),
				'type' => 'hidden'
			);*/

			$fieldTypeValue='';
			$showOptionsVariants=array('select', 'multiselect', 'radio');
			foreach($params as $param){
	
				$value=($num>0 && isset($this->value[$param['name']][$num]))? $this->value[$param['name']][$num] : '';
	
				$thisHidden = ($param['type']=='hidden'|| ($param['type']=='multitext' && !in_array($fieldTypeValue, $showOptionsVariants)) )? 'style="display:none"': '';

				$html.='<li class="zeLiParam'.$this->fieldname.$param['name'].'" id="zeLiParam'.$this->fieldname.$param['name'].$num.'" '.$thisHidden.'>'.$param['label'];

				switch($param['type']){

					case 'list':
						$options = array();
						foreach($param['options'] as $optionVal=>$optionLabel){
							$options[] = JHtml::_( 'select.option', $optionVal, $optionLabel);
						}
						$onchange='';
						if($param['name']=='fieldType'){
							$onchange=' onchange="zeShowHideSelectOptions(this, \''.$num.'\', \''.$this->fieldname.'\', \''.$param['name'].'\')"; ';
							$fieldTypeValue=$value;
						}
						$html.= JHTML::_('select.genericlist', $options, 'jform[params]['.$this->fieldname.']['.$param['name'].']['.$num.']', 'class = "zeinputbox"'.$onchange, 'value', 'text', $value );

					break;
					case 'textarea':

						$html.='<textarea type="text" name="jform[params]['.$this->fieldname.']['.$param['name'].']['.$num.']" id="jform_params_'.$this->fieldname.$param['name'].$num.'" rel="'.$param['name'].'" value="'.$value.'" class = "zeinputbox" />'.$value.'</textarea>';
					break;

					case 'multitext':

						$value_value=($num>0 && isset($this->value[$param['name'].'_value'][$num]))? $this->value[$param['name'].'_value'][$num] : '';
						$value_text=($num>0 && isset($this->value[$param['name'].'_text'][$num]))? $this->value[$param['name'].'_text'][$num] : '';

						$fid = 'jform_params_'.$this->fieldname.$param['name'].$num;
						$multitext='<div id="shfield_multitext_wrapper_'.$fid.'" class="shfield_multitext_wrapper">
								
							      <input type="button" class="button buttonplus btn btn-success" 
								onclick="sh_addField(this, \''.$num.'\', \''.$this->fieldname.'\', \''.$param['name'].'\')" value="+ '.JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_ADDFIELD').'">

								<div class="zeLabelsOpts4Sels"><input readonly="readonly" value="'.JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_FIELDVALUE').'"><input readonly="readonly" value="'.JText::_('PLG_USER_HKM_PROFILE_FIELDGROUP_FIELD_FIELDTEXT').'"></div>';
						if(!empty($value_value)){
						    foreach($value_value as $valNum=>$val){
						      $multitext.='<div><input type="text" name="jform[params]['.$this->fieldname.']['.$param['name'].'_value]['.$num.'][]" value="'.$val.'" /><input type="text" name="jform[params]['.$this->fieldname.']['.$param['name'].'_text]['.$num.'][]" value="'.$value_text[$valNum].'" /><input type="button" class="button buttonminus btn btn-danger" onclick="this.parentNode.parentNode.removeChild(this.parentNode)" value="-"></div>';
						    }
						}	
						$multitext.='</div>';
						$html.=$multitext;
					break;
					case 'input':
					case 'hidden':
					default:

						if($param['name'] == 'fieldName' && !$value) $value='uniqueID'.$num;
						$html.='<input type="text" name="jform[params]['.$this->fieldname.']['.$param['name'].']['.$num.']" id="jform_params_'.$this->fieldname.$param['name'].$num.'" rel="'.$param['name'].'" value="'.$value.'" class = "jform_params_'.$this->fieldname.$param['name'].' zeinputbox" />';
					break;
				}			
			
				$html.='<div style="clear:both"></div>
				</li>';

			}

			$html.='</ul></div>';

			$html.='</li>';

		}
		$html.='<li></div>';

		//$html.='<input type="hidden" name="jform[params]['.$this->fieldname.'][activeTab]" id="jform_params_'.$this->fieldname.'activeTab" rel="activeTab" value="'.$activeTabVal.'"/>';

		$orderingVal=(isset($this->value['ordering']) && $this->value['ordering'])? $this->value['ordering'] : '';
		$html.='<input type="hidden" name="jform[params]['.$this->fieldname.'][ordering]" id="jform_params_'.$this->fieldname.'ordering" rel="ordering" value="'.$orderingVal.'"/>';

		return $html;
	}
}
