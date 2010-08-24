<?php defined( '_JEXEC' ) or die( '=;)' ); 
//$document =& JFactory::getDocument();
$document =& JFactory::getDocument();
//--Add javascript to document
/*
$js = "
var assetsBase = '".JURI::root()."components/com_jafilia/assets';
var _LOADING_ = '".JText::_('Loading')."';
";
$document->addScriptDeclaration( $js );
*/
$document->addScript( JURI::root(true).'/components/com_jafilia/assets/js/SpryAssets/SpryValidationTextField.js' );
$document->addScript( JURI::root(true).'/components/com_jafilia/assets/js/SpryAssets/SpryValidationCheckbox.js' );
$document->addScript( JURI::root(true).'/components/com_jafilia/assets/js/jafilia.js' );
//--Add css
$document->addStyleSheet('components/com_jafilia/assets/js/SpryAssets/SpryValidationTextField.css');
$document->addStyleSheet('components/com_jafilia/assets/js/SpryAssets/SpryValidationCheckbox.css');
$document->addStyleSheet('components/com_jafilia/templates/default/style.css'); // to do
?>
<!--- NAME: registerForm.tpl --->
<div id="mpa_registration">
<form action="index.php?option=com_jafilia&task=save" method="post" name="registerForm" >
    <fieldset class="fieldset">
    <legend><?php echo JText::_('JAF_REGISTRATION'); ?></legend>
    <div id="firstname"><span id="sprytextfield1">
      <label for="firstnamed"><span class="title"><?php echo JText::_('JAF_FIRSTNAME'); ?>:*</span>
      <input name="firstname" type="text" size="20" value="<?php echo $FNAME; ?>"/>
      </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="lastname"><span id="sprytextfield2">
	  <label><span class="title"><?php echo JText::_('JAF_NAME'); ?>:*</span>
	  <input name="lastname" type="text" size="20" value="<?php echo $LNAME; ?>"/>
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="street"><span id="sprytextfield3">
	  <label><span class="title"><?php echo JText::_('JAF_STREET'); ?>:*</span>
	  <input name="street" type="text" size="20" value="<?php echo $STREET; ?>"/>
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="zipcode"><span id="sprytextfield4">
	  <label><span class="title"><?php echo JText::_('JAF_ZIP'); ?>:*</span>
	  <input name="zipcode" type="text" size="20" value="<?php echo $ZIP; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="location"><span id="sprytextfield5">
	  <label><span class="title"><?php echo JText::_('JAF_LOCATION'); ?>:*</span>
	  <input name="location" type="text" value="<?php echo $CITY; ?>" />
	  </label><br />
	<div id="federal">
	  <label><span class="title"><?php echo JText::_('JAF_FEDERAL'); ?>:</span>
	  <input name="state" type="text" value="<?php echo $STATE; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="mail"><span id="sprytextfield6">
	  <label><span class="title"><?php echo JText::_('JAF_EMAIL'); ?>:*</span>
	  <input name="mail" type="text" size="20" value="<?php echo $EMAIL; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="fon"><span id="sprytextfield7">
	  <label><span class="title"><?php echo JText::_('JAF_FON'); ?>:*</span>
	  <input name="fon" type="text" size="20" value="<?php echo $FON; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="url"><span id="sprytextfield8">
	  <label><span class="title"><?php echo JText::_('JAF_URL'); ?>:*</span>
	  <input name="url" type="text" size="20" />
	  </label><br />
	<div id="paypal">
	  <label><span class="title"><?php echo JText::_('JAF_PAYPAL'); ?>:</span>
	  <input name="paypal" type="text" size="20" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="bank"><span id="sprytextfield9">
	  <label><span class="title"><?php echo JText::_('JAF_BANK'); ?>:*</span>
	  <input name="bank" type="text" size="20" value="<?php echo $BNAME; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="blz"><span id="sprytextfield10">
	  <label><span class="title"><?php echo JText::_('JAF_BLZ'); ?>:*</span>
	  <input name="blz" type="text" size="20" value="<?php echo $BLZ; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="konto"><span id="sprytextfield11">
	  <label><span class="title"><?php echo JText::_('JAF_KONTO'); ?>:*</span>
	  <input name="konto" type="text" size="20" value="<?php echo $BACCOUNT; ?>" />
	  </label><br />
    <span class="textfieldRequiredMsg"><?php echo JText::_('JAF_TEXT_REQUIRED'); ?></span></span></div>
	<div id="confirm">
	<span id="sprycheckbox1">
	<label><span class="title"><?php 
	JHTML::_('behavior.modal', 'a.popup');
	echo JText::_('JAF_TERMS'); 
	?>:*</span>
	<input name="confirm" type="checkbox" value="" />
<?php echo JText::_('JAF_TERMSREAD'); ?>
<input name="uid" type="hidden" value="<?php echo $UID; ?>" />
	</label><br />
	<span class="checkboxRequiredMsg"><?php echo JText::_('JAF_NOT_CHECKED'); ?></span></span>
	<center><div><label><input name="submit" type="submit" value="<?php echo JText::_('JAF_SEND'); ?>" /><input type="button" value="Reset" onclick="registerForm.reset(); return false" /></label></div></center>
</fieldset>
</form>
</div>
<!--- END: registerForm.tpl --->

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
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
//-->
</script>
