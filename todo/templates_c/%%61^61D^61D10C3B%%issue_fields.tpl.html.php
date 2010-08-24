<?php /* Smarty version 2.6.18, created on 2010-08-10 17:17:14
         compiled from include/issue_fields.tpl.html */ ?>
<?php $_from = $this->_tpl_vars['issue_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_name'] => $this->_tpl_vars['issue_field']):
?>
  <?php if ($this->_tpl_vars['field_name'] == 'custom'): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "edit_custom_fields.tpl.html", 'smarty_include_vars' => array('custom_fields' => $this->_tpl_vars['issue_field']['custom'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php else: ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/issue_fields/".($this->_tpl_vars['field_name']).".tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>