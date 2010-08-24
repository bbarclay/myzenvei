<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	author		string
 * @param	$results	An array of user objects for the search result
 */
 
defined('_JEXEC') or die();
?>
<script type="text/JavaScript">

jsAdvanceSearch = {
			action: {
				keynum : 0,
				dateFormatDesc : '<?php echo JText::_("CC DATE FORMAT DESCRIPTION"); ?>',
				addCriteria: function ( ) {
					var criteria = "";
					var keynum = jsAdvanceSearch.action.keynum;
					
					criteria +='<div id="criteria'+keynum+'" style="margin: 0 0 10px 0;">';
						criteria +='<div id="removelink'+keynum+'"  style="float:left; margin:0 6px 0 2px; padding-top:5px;">';
							criteria +='<a class="remove-left" href="javascript:void(0);" onclick="jsAdvanceSearch.action.removeCriteria(\''+keynum+'\');">';
								criteria +='<?php echo JText::_('CC HIDE CRITERIA');?>';
							criteria +='</a>';
						criteria +='</div>';
						criteria +='<div id="selectfield'+keynum+'"  style="float:left; margin-right:10px;">';
							criteria +='<select class="inputbox" name="field'+keynum+'" id="field'+keynum+'" onchange="jsAdvanceSearch.action.changeField(\''+keynum+'\');" style="width:150px;">';
								<?php 
								foreach($fields as $label=>$data)
								{
									if($data->published && $data->visible)
									{
								?>
										criteria +='<optgroup label="<?php echo addslashes( JText::_($label) );?>">';
											<?php
											foreach($data->fields as $key=>$field)
											{
												if($field->published && $field->visible)
												{
													$selected = "";
													if($field->fieldcode == 'username')
													{
														$selected = "SELECTED";
													}
											?>
													criteria +='<option value="<?php echo addslashes($field->fieldcode); ?>" <?php echo $selected; ?>><?php echo JText::_(addslashes(JString::trim($field->name)));?></option>';
											<?php
												}
											}
											?>
										criteria +='</optgroup>';
								<?php
									}
								}
								?>
							criteria +='</select>';
						criteria +='</div>';
						criteria +='<div id="selectcondition'+keynum+'" style="float:left; margin-right:10px;">';
							criteria +='<select class="inputbox" name="condition'+keynum+'" id="condition'+keynum+'" style="width:150px;">';
								criteria +='<option value=""></option>';
							criteria +='</select>';
						criteria +='</div>';
						criteria +='<div id="valueinput'+keynum+'" style="margin-right:10px;">';
							criteria +='<input class="inputbox" type="text" name="value'+keynum+'" id="value'+keynum+'" style="width:145px;"/>';
						criteria +='</div>';
						criteria +='<div id="valueinput'+keynum+'_2" style="float:left; margin-right:-10px;">';
						criteria +='</div>';
						criteria +='<div id="typeinput'+keynum+'" style="float:left; margin-right:10px; display:none;">';
							criteria +='<input class="inputbox" type="hidden" name="fieldType'+keynum+'" id="fieldType'+keynum+'" value="" style="width:150px;"/>';
						criteria +='</div>';
						criteria +='<div style="clear:both"></div>';
					criteria +='</div>';
							
					var comma = '';
					if(jQuery('#key-list').val()!="")
					{
						var comma = ',';
					}
					jQuery('#key-list').val(jQuery('#key-list').val()+comma+keynum);		
					
					
					
					jQuery('#criteriaContainer').append(criteria);
					jsAdvanceSearch.action.changeField(keynum);
					jsAdvanceSearch.action.keynum++;
				},
				removeCriteria: function ( id ) {
					var inputs = [];
					var _id, _id2;
					_id = jQuery('#key-list').val();
					_id2 = _id.split(',');
					
					jQuery(_id2).each(function() {
						if ( this != id && this != "") {
							// re-populate
							inputs.push(this);								
						}
					});
					
					jQuery("#criteria"+id).remove();
					jQuery('#key-list').val(inputs.join(','));
				},
				getFieldType: function ( fieldcode ) {
					var type;	
					switch(fieldcode)
					{
						<?php
						foreach($fields as $label=>$data)
						{
							if($data->published && $data->visible)
							{
								foreach($data->fields as $key=>$field)
								{
									if($field->published && $field->visible)
									{
								?>		
										case "<?php echo $field->fieldcode; ?>":
											type = "<?php echo $field->type; ?>";
											break;
								<?php
									}
								}						
							}
						}
						?>
						default :
							type = "default";
					}	
					return type;
				},
				getListValue: function ( id, fieldcode ) {
					var list;	
					switch(fieldcode)
					{
						<?php
						foreach($fields as $label=>$data)
						{
							if($data->published && $data->visible)
							{
								foreach($data->fields as $key=>$field)
								{
									if($field->published && $field->visible)
									{
										if(!empty($field->options))
										{
									?>		
											case "<?php echo $field->fieldcode; ?>":
												<?php if ($field->type == 'checkbox') { ?>
													list	= '<div class="clr"></div>';
													list	+= '<div style="padding: 0px; margin-left: 20px; margin-top: 5px;" class="inputbox">';
													<?php
													foreach($field->options as $data)
													{
													?>
														list += '<div style="padding:0 10px 0 0;float: left;"><input type="checkbox" class="inputbox" name="value'+id+'[]" value="<?php echo addslashes($data); ?>"><?php echo JText::_(addslashes(JString::trim($data))); ?></input></div>';	
													<?php
													}
													?>
													list	+= '<div class="clr"></div>';													
													list	+= '</div>'
												<?php } else { ?>
													list = '<select class="inputbox" name="value'+id+'" id="value'+id+'" style="width:157px;">';
													<?php
													foreach($field->options as $data)
													{
													?>			
														list +='<option value="<?php echo addslashes($data); ?>"><?php echo JText::_(addslashes(JString::trim($data))); ?></option>';
													<?php
													}
													?>
													list +='</select>';
													
												<?php } ?> 
												break;
									<?php
										}
									}
								}						
							}
						}
						?>
						default :
							list = '<input class="inputbox" type="text" name="value'+id+'" id="value'+id+'" style="width:145px;"/>';
					}	
					return list;
				},
				changeField: function ( id ) {
					var value, type, condHTML, listValue;
					var cond = [];
					var conditions = new Array();
					conditions['contain']			= "<?php echo addslashes(JString::trim(JText::_('CC CONTAIN'))); ?>";
					conditions['between']			= "<?php echo addslashes(JString::trim(JText::_('CC BETWEEN'))); ?>";
					conditions['equal']				= "<?php echo addslashes(JString::trim(JText::_('CC EQUAL'))); ?>";
					conditions['notequal']			= "<?php echo addslashes(JString::trim(JText::_('CC NOT EQUAL'))); ?>";
					conditions['lessthanorequal']	= "<?php echo addslashes(JString::trim(JText::_('CC LESS THAN OR EQUAL'))); ?>";
					conditions['greaterthanorequal']	= "<?php echo addslashes(JString::trim(JText::_('CC GREATER THAN OR EQUAL'))); ?>";
					
					value	= jQuery('#field'+id).val();
					type 	= jsAdvanceSearch.action.getFieldType(value);
					this.changeFieldType(type, id);
								
					switch(type)
					{			
						case 'date'		:
							cond		= ['between', 'equal', 'notequal', 'lessthanorequal', 'greaterthanorequal'];
							listValue	= 0;
							break;
						case 'checkbox'	:
						case 'radio'	:
						case 'singleselect'	:
						case 'select'	:
						case 'list'		:
							cond	  = ['equal', 'notequal'];
							listValue = this.getListValue(id, value);
							break;
						case 'email'	:
							cond	  = ['equal'];
							listValue = 0;
							break;								
						case 'textarea'	:						
						case 'text'		:
						default			:																			
							if(value == 'useremail')
							{								
								cond	= ['equal'];							
							}
							else
							{
								cond	= ['contain', 'equal', 'notequal'];								
							}							
							listValue = 0;
							break;
					}
			
					condHTML = '<select class="inputbox" name="condition'+id+'" id="condition'+id+'" style="width:150px;" onchange="jsAdvanceSearch.action.changeCondition('+id+');">';
					jQuery(cond).each(function(){
						condHTML +='<option value="'+this+'">'+conditions[this]+'</option>';
					});
					condHTML +='</select>';
					
					jQuery('#selectcondition'+id).html(condHTML);
					jsAdvanceSearch.action.changeCondition(id);
					jsAdvanceSearch.action.calendar(type, id);
					if(listValue!=0){
						jQuery('#valueinput'+id).html(listValue);
					}
				},
				addAltInputField: function(type, id) {
					var cond = jQuery('#condition'+id).val();
					var inputField;
					if(cond == "between"){
						if(type=='date'){
							inputField  = '<input class="inputbox" type="text" name="value'+id+'_2" id="value'+id+'_2" style="width:125px; margin-right:4px" value="" title="'+this.dateFormatDesc+'"/>';
							inputField += '<a href="javascript:void(0)" onclick="return showCalendar(\'value'+id+'_2\', \'dd/mm/y\');" title="'+this.dateFormatDesc+'"><img src="<?php echo rtrim( JURI::root(), "/"); ?>/components/com_community/assets/calendar.png"></a>';
						}else{
							inputField  = '<input type="text" name="value'+id+'_2" id="value'+id+'_2" style="width:125px; margin-right:4px" value=""/>';
						}
					}else{
						inputField = '';
					}
					jQuery('#valueinput'+id+'_2').html(inputField);
				},
				calendar: function(type, id) {
					var inputField;
					if(type=='date'){
						inputField  = '<input class="inputbox" type="text" name="value'+id+'" id="value'+id+'" style="width:125px; margin-right:4px" value="" title="'+this.dateFormatDesc+'"/>';
						inputField += '<a href="javascript:void(0)" onclick="return showCalendar(\'value'+id+'\', \'dd/mm/y\');" title="'+this.dateFormatDesc+'"><img src="<?php echo rtrim( JURI::root(), "/"); ?>/components/com_community/assets/calendar.png"></a>';
					}else{
						inputField  = '<input class="inputbox" type="text" name="value'+id+'" id="value'+id+'" style="width:145px;"/>';
					}
					jQuery('#valueinput'+id).html(inputField);
				},
				changeFieldType: function(type, id) {
					jQuery('#fieldType'+id).val(type);
				},
				changeCondition: function(id) {
					var type = jQuery('#fieldType'+id).val();							
					this.addAltInputField(type, id);
				}
			}
		}
			
	jQuery(document).ready( function() {
		var searchHistory, operator;
	<?php if(!empty($filterJson)){?>
		searchHistory = eval(<?php echo $filterJson; ?>);
	<?php }else{?>
		searchHistory = '';
	<?php }?>
		if(searchHistory != ''){
			var keylist = searchHistory['key-list'].split(',');
			var num;
			
			jQuery(keylist).each(function(){
				num = jsAdvanceSearch.action.keynum;
				jsAdvanceSearch.action.addCriteria();
				jQuery('#field'+num).val(searchHistory['field'+this]);
				jsAdvanceSearch.action.changeField(num);
				jQuery('#condition'+num).val(searchHistory['condition'+this]);
				jsAdvanceSearch.action.changeCondition(num);
				
				if(searchHistory['fieldType'+this] == 'checkbox')
				{
					var myVal	= searchHistory['value'+this];
					if(jQuery.isArray(myVal))
					{
						jQuery.each(myVal, function(i, chkVal) {
							jQuery('input[name=value'+num+'[]]').each(function() {
								if(this.value == chkVal)
								{
									this.checked = "checked";
								}
							});
						});
						
					}
				}
				else
				{
					jQuery('#value'+num).val(searchHistory['value'+this]);
				}
				
				if(searchHistory['condition'+this] == 'between'){
					jQuery('#value'+num+'_2').val(searchHistory['value'+this+'_2']);
				}
			})
			
			if(searchHistory.operator == 'and'){
				operator = 'operator_all';
			}else{
				operator = 'operator_any';
			}
		}else{
			operator = 'operator_all';
			jsAdvanceSearch.action.addCriteria();
		}
		jQuery('#'+operator).attr("checked", true);
	});
	
</script>
<div class="cModule">
<form action="" method="GET">
	<h3>
		<?php echo JText::_("CC CRITERIA"); ?>
	</h3>
	<div id="criteriaContainer">
	</div>	
	<div id="optionContainer">
		<div>
			<a class="add" style="padding: 0 0 0 20px; display: inline; text-indent: 0px;" href="javascript:void(0);" onclick="jsAdvanceSearch.action.addCriteria();"><?php echo JText::_("CC ADD CRITERIA"); ?></a>
		</div>
		<div class="news-separator"></div>
		<div style="">
			<label class="lblradio" style="padding-right: 20px;"><input type="radio" name="operator" id="operator_all" value="and" class="radio"> <?php echo JText::_("CC MATCH ALL CRITERIA"); ?></label>
			<label class="lblradio" style="padding-right: 20px;"><input type="radio" name="operator" id="operator_any" value="or" class="radio"> <?php echo JText::_("CC MATCH ANY CRITERIA"); ?></label>
			<input type="submit" class="button" value="<?php echo JText::_("CC BUTTON SEARCH");?>" style="margin-left:5px;">
			<input type="hidden" id="key-list" name="key-list" value="" />
			<input type="hidden" name="option" value="com_community" />
			<input type="hidden" name="view" value="search" />
			<input type="hidden" name="task" value="advancesearch" />
			<input type="hidden" name="Itemid" value="<?php echo CRoute::getItemId(); ?>" />
		</div>
	</div>
	<div id="criteriaList"></div>
</form></div>
<br />