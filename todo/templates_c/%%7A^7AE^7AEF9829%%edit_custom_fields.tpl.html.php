<?php /* Smarty version 2.6.18, created on 2010-07-29 16:16:01
         compiled from edit_custom_fields.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'edit_custom_fields.tpl.html', 30, false),array('modifier', 'count', 'edit_custom_fields.tpl.html', 50, false),array('modifier', 'escape', 'edit_custom_fields.tpl.html', 72, false),array('block', 't', 'edit_custom_fields.tpl.html', 58, false),array('function', 'html_options', 'edit_custom_fields.tpl.html', 59, false),)), $this); ?>
<script type="text/javascript">
<?php echo '
var custom_fields_info = new Array();
'; ?>

</script>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['custom_fields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<?php $this->assign('fld_id', $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']); ?>
<?php $this->assign('custom_field_id', $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']); ?>
<?php if ($this->_tpl_vars['form_type'] == 'report'): ?>
  <?php $this->assign('cf_required', $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_report_form_required']); ?>
<?php elseif ($this->_tpl_vars['form_type'] == 'anonymous'): ?>
  <?php $this->assign('cf_required', $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_anonymous_form_required']); ?>
<?php elseif ($this->_tpl_vars['form_type'] == 'close'): ?>
  <?php $this->assign('cf_required', $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_close_form_required']); ?>
<?php endif; ?>
<tr>
  <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
    <b><?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_title']; ?>
:<?php if ($this->_tpl_vars['cf_required']): ?> *<?php endif; ?></b>
    <script type="text/javascript">
    <!--
    fld_id = <?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
;
    <?php echo '
    custom_fields_info[custom_fields_info.length] = {
        id: fld_id,
        type: \''; ?>
<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type']; ?>
<?php echo '\',
        title: \''; ?>
<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_title']; ?>
<?php echo '\',
        required: \''; ?>
<?php echo $this->_tpl_vars['cf_required']; ?>
<?php echo '\',
        validation_js: '; ?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['validation_js'])) ? $this->_run_mod_handler('default', true, $_tmp, "''") : smarty_modifier_default($_tmp, "''")); ?>
<?php echo '
        }

    '; ?>

    //-->
    </script>
  </td>
  <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
    <?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'text'): ?>
    <input id="custom_field_<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
" class="default" type="text" name="custom_fields[<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
]" maxlength="255" size="50" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_REQUEST['custom_fields'][$this->_tpl_vars['fld_id']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value'])))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value'])); ?>
">
    <?php elseif ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'integer'): ?>
    <input id="custom_field_<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
" class="default" type="text" name="custom_fields[<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
]" maxlength="255" size="10" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_REQUEST['custom_fields'][$this->_tpl_vars['fld_id']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value'])))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value'])); ?>
">
    <?php elseif ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'textarea'): ?>
    <textarea id="custom_field_<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
" name="custom_fields[<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
]" rows="10" cols="60" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=@$_REQUEST['custom_fields'][$this->_tpl_vars['fld_id']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value'])))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value'])); ?>
</textarea>
    <?php elseif ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'date'): ?>
    <input type="text" id="custom_field_<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
" name="custom_fields[<?php echo $this->_tpl_vars['custom_field_id']; ?>
]" size="12" class="date_picker" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['value'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value'])); ?>
">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "custom_fields[".($this->_tpl_vars['custom_field_id'])."]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php else: ?>
    <select id="custom_field_<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
"
        <?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'multiple'): ?>
          <?php if (count($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['field_options']) > 10): ?>
            multiple size="10"
          <?php else: ?>
            multiple size="<?php echo count($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['field_options']); ?>
"
          <?php endif; ?>
        <?php endif; ?>
      class="default" name="custom_fields[<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
]<?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'multiple'): ?>[]<?php endif; ?>" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">

      <?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] != 'multiple'): ?><option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose an option<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option><?php endif; ?>
      <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['field_options'],'selected' => ((is_array($_tmp=((is_array($_tmp=@$_REQUEST['custom_fields'][$this->_tpl_vars['fld_id']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['selected_cfo_id']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['selected_cfo_id'])))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['default_value']))), $this);?>

    </select>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['lookup_method'] != '' && count($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['field_options']) < 1): ?>
    <script type="text/javascript">custom_field_init_dynamic_options(<?php echo $this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_id']; ?>
);</script>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_type'] == 'multiple'): ?>
      <?php $this->assign('custom_field_sufix', "[]"); ?>
    <?php else: ?>
      <?php $this->assign('custom_field_sufix', ""); ?>
    <?php endif; ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "custom_fields[".($this->_tpl_vars['custom_field_id'])."]".($this->_tpl_vars['custom_field_sufix']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php if ($this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_description'] != ""): ?>
    <span class="small_default">(<?php echo ((is_array($_tmp=$this->_tpl_vars['custom_fields'][$this->_sections['i']['index']]['fld_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
)</span>
    <?php endif; ?>
  </td>
</tr>
<?php endfor; endif; ?>