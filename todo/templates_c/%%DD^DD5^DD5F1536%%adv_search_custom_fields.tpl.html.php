<?php /* Smarty version 2.6.18, created on 2010-08-07 16:03:17
         compiled from adv_search_custom_fields.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'adv_search_custom_fields.tpl.html', 5, false),array('modifier', 'count', 'adv_search_custom_fields.tpl.html', 35, false),array('function', 'html_options', 'adv_search_custom_fields.tpl.html', 41, false),array('function', 'html_select_date', 'adv_search_custom_fields.tpl.html', 44, false),)), $this); ?>
<tr>
  <td colspan="5">
  <hr>
    <input id="show_custom_fields_checkbox" type="checkbox" name="show_custom_fields" value="1" class="default" onClick="changeVisibility('custom_fields_row', this.checked);disableCustomFields(!this.checked)">
    <label for="show_custom_fields_checkbox" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show additional fields to search by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
  </td>
</tr>
<tr id="custom_fields_row" style="display: none;">
  <td colspan="5">
    <br />
    <table width="100%" cellspacing="0" border="0" cellpadding="0">
      <?php $_from = $this->_tpl_vars['custom_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['custom_fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['custom_fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['custom_fields']['iteration']++;
?>
      <?php $this->assign('custom_field_id', $this->_tpl_vars['field']['fld_id']); ?>
      <?php if ($this->_foreach['custom_fields']['iteration'] % 2 == 1): ?>
      <tr>
      <?php endif; ?>
        <td nowrap width="15%" class="default" height="30" align="right" valign="top">
          <?php echo $this->_tpl_vars['field']['fld_title']; ?>
:&nbsp;
        </td>
        <td width="35%" align="left" valign="top">
          <?php if ($this->_tpl_vars['field']['fld_type'] == 'text' || $this->_tpl_vars['field']['fld_type'] == 'textarea'): ?>
          <input type="text" name="custom_field[<?php echo $this->_tpl_vars['field']['fld_id']; ?>
]" class="default" value="<?php echo $this->_tpl_vars['options']['cst_custom_field'][$this->_tpl_vars['field']['fld_id']]; ?>
" disabled>
          <?php elseif ($this->_tpl_vars['field']['fld_type'] == 'integer'): ?>
          <?php $this->assign('cmp', $this->_tpl_vars['options']['cst_custom_field'][$this->_tpl_vars['field']['fld_id']]['filter_type']); ?>
          <select name="custom_field[<?php echo $this->_tpl_vars['field']['fld_id']; ?>
][filter_type]" class="default">
            <option value="eq" <?php if ($this->_tpl_vars['cmp'] == 'eq'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Equals<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            <option value="ge" <?php if ($this->_tpl_vars['cmp'] == 'ge'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater or Equal<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            <option value="le" <?php if ($this->_tpl_vars['cmp'] == 'le'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less or Equal<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            <option value="gt" <?php if ($this->_tpl_vars['cmp'] == 'gt'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            <option value="lt" <?php if ($this->_tpl_vars['cmp'] == 'lt'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          </select>
          <input type="text" size="8" name="custom_field[<?php echo $this->_tpl_vars['field']['fld_id']; ?>
][value]" class="default" value="<?php echo $this->_tpl_vars['options']['cst_custom_field'][$this->_tpl_vars['field']['fld_id']]['value']; ?>
" disabled>
          <?php elseif ($this->_tpl_vars['field']['fld_type'] == 'combo' || $this->_tpl_vars['field']['fld_type'] == 'multiple'): ?>
          <select name="custom_field[<?php echo $this->_tpl_vars['field']['fld_id']; ?>
][]" class="default" multiple
            <?php if (count($this->_tpl_vars['field']['field_options']) > 10): ?>
              size="10"
            <?php else: ?>
              size="<?php echo count($this->_tpl_vars['field']['field_options']); ?>
"
            <?php endif; ?>
            disabled>
            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['field']['field_options'],'selected' => $this->_tpl_vars['options']['cst_custom_field'][$this->_tpl_vars['field']['fld_id']]), $this);?>

          </select>
          <?php elseif ($this->_tpl_vars['field']['fld_type'] == 'date'): ?>
            <?php echo smarty_function_html_select_date(array('field_array' => "custom_field[".($this->_tpl_vars['custom_field_id'])."]",'prefix' => '','all_extra' => "class=\"default\"",'month_empty' => '','time' => '--','display_years' => false,'display_days' => false,'month_extra' => "id=\"custom_field_".($this->_tpl_vars['custom_field_id'])."_month\" tabindex=\"".($this->_tpl_vars['tabindex']++)."\""), $this);?>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "custom_field[".($this->_tpl_vars['custom_field_id'])."][Month]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php echo smarty_function_html_select_date(array('field_array' => "custom_field[".($this->_tpl_vars['custom_field_id'])."]",'prefix' => '','all_extra' => "class=\"default\"",'day_empty' => '','time' => '--','display_months' => false,'display_years' => false,'day_value_format' => "%02d",'day_extra' => "id=\"custom_field_".($this->_tpl_vars['custom_field_id'])."_day\" tabindex=\"".($this->_tpl_vars['tabindex']++)."\""), $this);?>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "custom_field[".($this->_tpl_vars['custom_field_id'])."][Day]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php echo smarty_function_html_select_date(array('field_array' => "custom_field[".($this->_tpl_vars['custom_field_id'])."]",'prefix' => '','all_extra' => "class=\"default\"",'year_empty' => '','time' => '--','display_months' => false,'display_days' => false,'start_year' => -1,'end_year' => "+2",'year_extra' => "id=\"custom_field_".($this->_tpl_vars['custom_field_id'])."_year\" tabindex=\"".($this->_tpl_vars['tabindex']++)."\""), $this);?>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "custom_field[".($this->_tpl_vars['custom_field_id'])."][Year]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php endif; ?>
        </td>
      <?php if ($this->_foreach['custom_fields']['iteration'] % 2 != 1): ?>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    </table>
  </td>
</tr>