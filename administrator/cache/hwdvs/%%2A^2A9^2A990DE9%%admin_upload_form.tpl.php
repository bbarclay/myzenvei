<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:57
         compiled from admin_upload_form.tpl */ ?>

<table width="100%" cellpadding="2" cellspacing="2" border="0">
  <tr>
    <td width="150"><?php echo @_HWDVIDS_TITLE; ?>
 <font class="required">*</font></td>
    <td><input name="title" value="" class="inputbox" size="20" maxlength="50" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td valign="top"><?php echo @_HWDVIDS_DESC; ?>
 <font class="required">*</font></td>
    <td valign="top"><textarea rows="4" cols="20" name="description" class="inputbox" style="width: 200px;"></textarea></td>
  </tr>
  <tr>
    <td><?php echo @_HWDVIDS_CATEGORY; ?>
 <font class="required">*</font></td>
    <td><?php echo $this->_tpl_vars['categoryselect']; ?>
</td>
  </tr>
  <tr>
    <td><?php echo @_HWDVIDS_TAGS; ?>
 <font class="required">*</font></td>
    <td><?php echo @_HWDVIDS_INFO_TAGS; ?>
</td>
  </tr>
  <tr>
    <td></td>
    <td><input name="tags" value="" class="inputbox" size="20" maxlength="50" style="width: 200px;" /></td>
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




