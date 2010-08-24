<?php /* Smarty version 2.6.18, created on 2010-08-07 21:48:37
         compiled from include/issue_field.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'include/issue_field.tpl.html', 15, false),array('block', 't', 'include/issue_field.tpl.html', 18, false),)), $this); ?>
<span>
<input type="text" id="<?php echo $this->_tpl_vars['field_name']; ?>
" name="<?php echo $this->_tpl_vars['field_name']; ?>
" value="<?php echo $this->_tpl_vars['value']; ?>
" class="default"
    onBlur="validateIssueNumberField('<?php echo $this->_tpl_vars['app_base_url']; ?>
', '<?php echo $this->_tpl_vars['form_name']; ?>
', '<?php echo $this->_tpl_vars['field_name']; ?>
', <?php echo '{'; ?>

                check_project: <?php echo ((is_array($_tmp=@$this->_tpl_vars['check_project'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
,
                exclude_issue: <?php echo ((is_array($_tmp=@$this->_tpl_vars['exclude_issue'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
,
                exclude_duplicates: <?php echo ((is_array($_tmp=@$this->_tpl_vars['exclude_duplicates'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
,
                error_message: '<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['error_message'])) ? $this->_run_mod_handler('default', true, $_tmp, "") : smarty_modifier_default($_tmp, "")); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'
            <?php echo '}'; ?>
)">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => $this->_tpl_vars['field_name'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<span id="<?php echo $this->_tpl_vars['field_name']; ?>
_error" class="<?php echo ((is_array($_tmp=@$this->_tpl_vars['span_class'])) ? $this->_run_mod_handler('default', true, $_tmp, 'default') : smarty_modifier_default($_tmp, 'default')); ?>
"></span>
</span>