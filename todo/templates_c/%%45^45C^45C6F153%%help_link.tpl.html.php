<?php /* Smarty version 2.6.18, created on 2010-07-29 16:07:46
         compiled from help_link.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'help_link.tpl.html', 1, false),)), $this); ?>
<a class="help" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>get context sensitive help<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:openHelp('<?php echo $this->_tpl_vars['rel_url']; ?>
', '<?php echo $this->_tpl_vars['topic']; ?>
');"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/help.gif" width="12" height="13" border="0"></a>