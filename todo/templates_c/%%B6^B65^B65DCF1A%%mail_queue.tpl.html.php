<?php /* Smarty version 2.6.18, created on 2010-08-10 20:51:18
         compiled from mail_queue.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'mail_queue.tpl.html', 5, false),array('function', 'cycle', 'mail_queue.tpl.html', 27, false),array('modifier', 'escape', 'mail_queue.tpl.html', 30, false),)), $this); ?>
<?php ob_start(); ?>Mail Queue<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('extra_title', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('extra_title' => $this->_tpl_vars['extra_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['denied'] == 1): ?>
    <div class="default" align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sorry, you do not have permission to view this page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
<?php else: ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/httpclient.js?c=aee4"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/expandable_cell.js?c=a049"></script>
<form>
  <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
    <tr>
      <td class="default" nowrap>
        <b><?php $this->_tag_stack[] = array('t', array('1' => $this->_tpl_vars['issue_id'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mail Queue for Issue #%1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%" cellpadding="2" cellspacing="1">
          <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
            <td class="default_white" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('remote_func' => 'getMailQueue','ec_id' => 'mailqueue')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
            <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recipient<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
            <td width="20%" class="default_white" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Queued Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
            <td width="10%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
            <td width="50%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          </tr>
          <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          <?php echo smarty_function_cycle(array('values' => $this->_tpl_vars['cycle'],'assign' => 'row_color'), $this);?>

          <tr>
            <td class="default" NOWRAP bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('ec_id' => 'mailqueue','list_id' => $this->_tpl_vars['data'][$this->_sections['i']['index']]['maq_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
            <td width="20%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['i']['index']]['maq_recipient'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
            <td width="20%" class="default" nowrap bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['maq_queued_date']; ?>
</td>
            <td width="10%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo $this->_tpl_vars['data'][$this->_sections['i']['index']]['maq_status']; ?>
</td>
            <td width="50%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['i']['index']]['maq_subject'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
          </tr>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/body.tpl.html", 'smarty_include_vars' => array('ec_id' => 'mailqueue','list_id' => $this->_tpl_vars['data'][$this->_sections['i']['index']]['maq_id'],'colspan' => '5')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php endfor; else: ?>
          <tr>
            <td colspan="5" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default" align="center">
              <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No mail queue could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
            </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td colspan="5" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
              <input class="button" type="button" value="&lt;&lt; Back" onClick="javascript:location.href='<?php echo $this->_tpl_vars['rel_url']; ?>
view.php?id=<?php echo $this->_tpl_vars['issue_id']; ?>
';">
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "app_info.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>