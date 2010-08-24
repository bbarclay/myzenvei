<?php /* Smarty version 2.6.18, created on 2010-08-09 00:56:13
         compiled from notifications/password_confirmation.tpl.text */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'textformat', 'notifications/password_confirmation.tpl.text', 1, false),array('block', 't', 'notifications/password_confirmation.tpl.text', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('textformat', array('style' => 'email')); $_block_repeat=true;smarty_block_textformat($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => $this->_tpl_vars['app_title'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hello,

We just received a request to create a new random password for your account in %1. For security reasons we need you to confirm this request so we can finish the password creation process.

If this is not a real request from you, or if you don't need a new password anymore, please disregard this email.

However, if you would like to confirm this request, please do so by visiting the URL below:
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php echo $this->_tpl_vars['app_base_url']; ?>
confirm.php?cat=password&email=<?php echo $this->_tpl_vars['user']['usr_email']; ?>
&hash=<?php echo $this->_tpl_vars['hash']; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textformat($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>