<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<!--- NAME: notAuth.tpl   -->
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>
    	<p><?php echo $SHORTDESC; ?></p><p><?php echo JText::_('JAF_NOACCOUNT'); ?></p>
        <center><div style="margin:10px"><input name="anmelden" type="button" value="<?php echo JText::_('JAF_REGISTER'); ?>" class="button" onclick="location.href='<?php echo $REGLINK; ?>'" /></div></center>
     </td>
  </tr>
</table>

<!--- END: notAuth.tpl   -->
