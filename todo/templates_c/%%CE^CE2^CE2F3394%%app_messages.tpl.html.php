<?php /* Smarty version 2.6.18, created on 2010-08-07 21:59:43
         compiled from app_messages.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'app_messages.tpl.html', 1, false),)), $this); ?>
<?php if (count($this->_tpl_vars['app_messages']) > 0): ?>
<div class="app_messages" align="center">
<?php $_from = $this->_tpl_vars['app_messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['app_message']):
?>
<?php echo $this->_tpl_vars['app_message']; ?>
<br />
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>