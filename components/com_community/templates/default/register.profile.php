<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	applications	An array of applications object
 * @param	pagination		JPagination object 
 */
defined('_JEXEC') or die();
?>
<?php
if( $fields )
{
	$required	= false;
?>
	<form action="<?php echo CRoute::getURI(); ?>" method="post" id="jomsForm" name="jomsForm" class="community-form-validate">
<?php
	foreach( $fields as $group )
	{
		$fieldName	= $group->name == 'ungrouped' ? '' : $group->name;
?>
		<div class="ctitle">
			<h2><?php echo JText::_( $fieldName ); ?></h2>
		</div>		
		<table class="formtable" cellspacing="1" cellpadding="0" style="width: 98%;">
		<tbody>
<?php
		foreach($group->fields as $field )
		{
			if( !$required && $field->required == 1 )
				$required	= true;
	
// 			if( $field->type == 'date' )
// 			{
// 				$day	= 0;
// 				$month	= 0;
// 				$year	= 0;
// 
// 				if(! empty($field->value))
// 				{
// 					$day	= intval($field->value[0]);
// 					$month	= intval($field->value[1]);
// 					$year	= intval($field->value[2]);
// 				}
// 				$day 	= !empty($day) 		? $day 		: 1;
// 				$month 	= !empty($month) 	? $month 	: 1;
// 				$year 	= !empty($year) 	? $year 	: 1970;
// 								
// 				$myDate = new JDate($year.'-'.$month.'-'.$day. ' 23:59:59');				
// 				$field->value = $myDate->toMySQL();
// 			}
			$html = CProfileLibrary::getFieldHTML($field);
?>
				<tr>
					<td class="key" valign="top"><label id="lblfield<?php echo $field->id;?>" for="field<?php echo $field->id;?>" class="label"><?php if($field->required == 1) echo '*'; ?><?php echo JText::_($field->name); ?></label></td>
					<td class="value"><?php echo $html; ?></td>					
				</tr>	
<?php
		}
?>
		</tbody>
		</table>
<?php
	}
?>    
	<table class="ccontentTable" cellspacing="3" cellpadding="0">
	<tbody>	
<?php
	if( $required )
	{
?>	
		<tr>
			<td class="listkey" >&nbsp;</td>
			<td class="listvalue"><?php echo JText::_( 'CC_REG_REQUIRED_FILEDS' ); ?></td>					
		</tr>
<?php
	}
?>				
		<tr>
			<td class="listkey" >&nbsp;</td>
			<td class="listvalue">
				<div id="cwin-wait" style="display:none;"></div>
				<input class="button validateSubmit" type="submit" id="btnSubmit" value="<?php echo JText::_('CC REGISTER'); ?>" name="submit">
			</td>					
		</tr>
	</tbody>
	</table>
	
	<input type="hidden" name="task" value="registerUpdateProfile" />	
	<input type="hidden" id="authenticate" name="authenticate" value="0" />	
	<input type="hidden" id="authkey" name="authkey" value="" />
	</form>
	<script type="text/javascript">
	    cvalidate.init();
	    cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("CC REQUIRED ENTRY MISSING")); ?>');
	    
		jQuery( '#jomsForm' ).submit( function() {
		    jQuery('#btnSubmit').hide();
			jQuery('#cwin-wait').show();
			
			if(jQuery('#authenticate').val() != '1')
			{
				joms.registrations.authenticateAssign();
				return false;			
			}						
		});
	</script>	
<?php
}
else
{
?>
	<div><?php echo JText::_('CC NO CUSTOM PROFILE CREATED YET');?></div>
<?php
}
?>