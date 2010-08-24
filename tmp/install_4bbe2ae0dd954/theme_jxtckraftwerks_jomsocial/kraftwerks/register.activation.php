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
<script language="javascript" type="text/javascript">
jQuery.noConflict();

function submitbutton() {	
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");
	
	//hide all the error messsage span 1st
	jQuery('#jsemail').removeClass('invalid');
	jQuery('#errjsemailmsg').hide();
	jQuery('#errjsemailmsg').html('&nbsp');
	
	// do field validation
	var isValid	= true;	
	
	if(jQuery('#jsemail').val() !=  jQuery('#email').val())
	{
		regex=/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
	   	isValid = regex.test(jQuery('#jsemail').val());
	   	
		var fieldname = jQuery('#jsemail').attr('name');;			       
		if(isValid == false){
			jQuery('#jsemail').addClass('invalid');
			cvalidate.setMessage(fieldname, '', 'CC INVALID EMAIL');
		}	   	
   	}

	if(! isValid) {
	    jQuery('#btnSubmit').show();
		jQuery('#cwin-wait').hide();
 	}
	   	   		
	return isValid;	
}
</script>


<div class="app-box-header">
<div class="app-box-header">
	<h2 class="app-box-title"><?php echo JText::_('CC ACTIVATION ENTER EMAIL'); ?></h2>
</div>
</div>
<div class="app-box-content">

<form action="" method="post" id="jomsForm" name="jomsForm" class="community-form-validate">
<table class="ccontentTable" cellspacing="3" cellpadding="0">
<tbody>
	<tr>						
		<td class="paramlist_key">
			<label id="jsemailmsg" for="jsemail">*<?php echo JText::_( 'CC EMAIL' ); ?></label>
		</td>
		<td class="paramlist_value">				
			<input class="inputbox required" type="text" id="jsemail" name="jsemail" size="50">
			<span id="errjsemailmsg" style="display:none;">&nbsp;</span>
		</td>					
	</tr>		
	<tr>
		<td class="listkey" >&nbsp;</td>
		<td class="listvalue">
			<div id="cwin-wait" style="display:none;"></div>
			<input class="button validateSubmit" type="submit" id="btnSubmit" value="<?php echo JText::_('CC SEND'); ?>" name="submit">
		</td>					
	</tr>
</tbody>
</table>
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="view" value="register" />
<input type="hidden" name="task" value="activationResend" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>
</div>
<div class="app-box-footer"><div class="app-box-footer"></div></div>

<script type="text/javascript">
    cvalidate.init();
    cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("CC REQUIRED ENTRY MISSING")); ?>');
    
	jQuery( '#jomsForm' ).submit( function() {
	    jQuery('#btnSubmit').hide();
		jQuery('#cwin-wait').show();
		
		return submitbutton();
	});
</script>