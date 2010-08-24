<!--- NAME: userdetails.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); 
$document =& JFactory::getDocument();
$document->addScript( JURI::root(true).'/components/com_jafilia/assets/js/SpryAssets/SpryValidationTextField.js' );
$document->addScript( JURI::root(true).'/components/com_jafilia/assets/js/SpryAssets/SpryValidationCheckbox.js' );
$document->addScript( JURI::root(true).'/components/com_jafilia/assets/js/jafilia.js' );
//--Add css
$document->addStyleSheet('components/com_jafilia/assets/js/SpryAssets/SpryValidationTextField.css');
$document->addStyleSheet('components/com_jafilia/assets/js/SpryAssets/SpryValidationCheckbox.css');
$document->addStyleSheet('components/com_jafilia/templates/default_blue/style.css'); // to do
?>
<div id="registration">
<form action="index.php?option=com_jafilia&task=userdetails" method="post" >
    <fieldset class="fieldset">
    <legend><?php echo JText::_('JAF_DETAILS'); ?></legend>
	<div id="street"><span id="sprytextfield1">
	  <label><span class="title"><?php echo JText::_('JAF_STREET'); ?>:*</span>
	  <input name="street" type="text" size="20" value="<?php echo $STREET; ?>" />
	  </label>
	  <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="zipcode"><span id="sprytextfield2">
	  <label><span class="title"><?php echo JText::_('JAF_ZIP'); ?>:*</span>
	  <input name="zipcode" type="text" size="20" value="<?php echo $ZIP; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="location"><span id="sprytextfield3">
	  <label><span class="title"><?php echo JText::_('JAF_LOCATION'); ?>:*</span>
	  <input name="location" type="text" value="<?php echo $LOCAT; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="state">
	  <label><span class="title"><?php echo JText::_('JAF_FEDERAL'); ?>:</span>
	  <input name="state" type="text" value="<?php echo $STATE; ?>" />
	  </label></div>
	<div id="mail"><span id="sprytextfield4">
	  <label><span class="title"><?php echo JText::_('JAF_EMAIL'); ?>:*</span>
	  <input name="mail" type="text" size="20" value="<?php echo $MAIL; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="fon"><span id="sprytextfield5">
	  <label><span class="title"><?php echo JText::_('JAF_FON'); ?>:*</span>
	  <input name="fon" type="text" size="20" value="<?php echo $FON; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="url"><span id="sprytextfield6">
	  <label><span class="title"><?php echo JText::_('JAF_URL'); ?>:*</span>
	  <input name="url" type="text" size="20" value="<?php echo $WEB; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="paypal">
	  <label><span class="title"><?php echo JText::_('JAF_PAYPAL'); ?>:</span>
	  <input name="paypal" type="text" size="20" value="<?php echo $PAYPAL; ?>" />
	  </label></div>
	<div id="bank"><span id="sprytextfield7">
	  <label><span class="title"><?php echo JText::_('JAF_BANK'); ?>:*</span>
	  <input name="bank" type="text" size="20" value="<?php echo $BANK; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="blz"><span id="sprytextfield8">
	  <label><span class="title"><?php echo JText::_('JAF_BLZ'); ?>:*</span>
	  <input name="blz" type="text" size="20" value="<?php echo $BLZ; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<div id="konto"><span id="sprytextfield9">
	  <label><span class="title"><?php echo JText::_('JAF_KONTO'); ?>:*</span>
	  <input name="konto" type="text" size="20" value="<?php echo $KONTO; ?>" />
      <input name="uid" type="hidden" value="<?php echo $UID; ?>" />
      <input name="id" type="hidden" value="<?php echo $ID; ?>" />
	  </label><span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span>
	  </div>
	<center><div><label><input name="submit" type="submit" value="<?php echo JText::_('JAF_SEND'); ?>" /></label></div></center>
</fieldset>
</form>
</div>

<!--- END: userdetaisl.tpl --->

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
//-->
</script>