<?php /* Smarty version 2.6.18, created on 2010-07-29 16:08:45
         compiled from current_filters.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_display_style', 'current_filters.tpl.html', 1, false),array('block', 't', 'current_filters.tpl.html', 9, false),)), $this); ?>
<div id="current_filters1" <?php echo smarty_function_get_display_style(array('element_name' => 'current_filters'), $this);?>
>
<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFAA" width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <?php echo '<td class="default">'; ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Current filters:'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '&nbsp;'; ?><?php $_from = $this->_tpl_vars['active_filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['active_filters'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['active_filters']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filter_name'] => $this->_tpl_vars['filter_value']):
        $this->_foreach['active_filters']['iteration']++;
?><?php echo '<b>'; ?><?php echo $this->_tpl_vars['filter_name']; ?><?php echo '</b>: '; ?><?php echo $this->_tpl_vars['filter_value']; ?><?php echo ''; ?><?php if (! ($this->_foreach['active_filters']['iteration'] == $this->_foreach['active_filters']['total'])): ?><?php echo '; '; ?><?php endif; ?><?php echo ''; ?><?php endforeach; else: ?><?php echo '<i>'; ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'None'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</i>'; ?><?php endif; unset($_from); ?><?php echo '</td>'; ?>

        </tr>
      </table>
    </td>
  </tr>
</table>

<br />
</div>