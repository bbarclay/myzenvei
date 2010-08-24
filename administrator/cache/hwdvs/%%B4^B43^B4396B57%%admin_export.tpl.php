<?php /* Smarty version 2.6.26, created on 2010-02-27 16:11:51
         compiled from admin_export.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
  <tr>
    <td align="left"><h2><?php echo @_HWDVIDS_EXPORT_TITLE; ?>
</h2></td>
  </tr>
  <tr>
    <td align="left">
      <table width="100%">
        <tr>
          <td width="200"><span onmouseover="return overlib('<?php echo @_HWDVIDS_EXPORT_TOEMAIL_TT; ?>
', CAPTION, '<?php echo @_HWDVIDS_EXPORT_TOEMAIL; ?>
', BELOW, RIGHT);" onmouseout="return nd();" ><?php echo @_HWDVIDS_EXPORT_TOEMAIL; ?>
</span></td>
          <td><input type="text" name="recipient" value="<?php echo $this->_tpl_vars['mosConfig_mailfrom']; ?>
" class="text_area" size="40" /></td>
        </tr>
        <tr>
          <td><span onmouseover="return overlib('<?php echo @_HWDVIDS_EXPORT_SUBJECT_TT; ?>
', CAPTION, '<?php echo @_HWDVIDS_EXPORT_SUBJECT; ?>
', BELOW, RIGHT);" onmouseout="return nd();" ><?php echo @_HWDVIDS_EXPORT_SUBJECT; ?>
</span></td>
          <td><input type="text" name="subject" value="<?php echo @_HWDVIDS_EXPORT_SUBJECT_DEFAULT; ?>
" class="text_area" size="40" /></td>
        </tr>
        <tr>
          <td><span onmouseover="return overlib('<?php echo @_HWDVIDS_EXPORT_BODY_TT; ?>
', CAPTION, '<?php echo @_HWDVIDS_EXPORT_BODY; ?>
', BELOW, RIGHT);" onmouseout="return nd();" ><?php echo @_HWDVIDS_EXPORT_BODY; ?>
</span></td>
          <td><input type="text" name="body" value="<?php echo @_HWDVIDS_EXPORT_BODY_DEFAULT; ?>
" class="text_area" size="40" /></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>