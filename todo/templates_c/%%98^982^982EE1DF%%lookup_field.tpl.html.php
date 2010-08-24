<?php /* Smarty version 2.6.18, created on 2010-07-29 15:52:01
         compiled from lookup_field.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'lookup_field.tpl.html', 3, false),)), $this); ?>

<input class="lookup_field" name="<?php echo $this->_tpl_vars['lookup_field_name']; ?>
" type="text" size="24" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"
    value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>paste or start typing here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" 
    onBlur="javascript:this.value='<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>paste or start typing here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>';" 
    onFocus="javascript:this.value='';" 
    onKeyUp="javascript:lookupField(this.form, this, '<?php echo $this->_tpl_vars['lookup_field_target']; ?>
', <?php if ($this->_tpl_vars['callbacks'] != ""): ?><?php echo $this->_tpl_vars['callbacks']; ?>
<?php else: ?>null<?php endif; ?>);">