<!--- NAME: noAccount.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<center>
<div style="width:90%">
<div><?php echo JText::_('JAF_NOACCOUNT'); ?></div>
</div>
<div style="margin:10px"><input name="anmelden" type="button" value="<?php echo JText::_('JAF_REGISTER'); ?>" class="button" onclick="location.href='index.php?option=com_jafilia&task=register'" />
</div>
</center>
<!--- END: noAccount.tpl --->