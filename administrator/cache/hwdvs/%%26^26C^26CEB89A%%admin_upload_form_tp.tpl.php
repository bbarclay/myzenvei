<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:58
         compiled from admin_upload_form_tp.tpl */ ?>

<table width="100%" cellpadding="2" cellspacing="2" border="0">
  <tr>
    <td width="150"><?php echo @_HWDVIDS_CATEGORY; ?>
 <font class="required">*</font></td>
    <td><?php echo $this->_tpl_vars['categoryselect']; ?>
</td>
  </tr>
  <tr>
    <td colspan="2"><font class="required">*</font> <?php echo @_HWDVIDS_INFO_REQUIREDFIELDS; ?>
</td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_upload_sharingoptions.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>




