<?php /* Smarty version 2.6.18, created on 2010-07-29 22:17:40
         compiled from time_tracking.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'time_tracking.tpl.html', 6, false),array('modifier', 'count', 'time_tracking.tpl.html', 33, false),array('function', 'get_innerhtml', 'time_tracking.tpl.html', 38, false),array('function', 'get_display_style', 'time_tracking.tpl.html', 45, false),array('function', 'cycle', 'time_tracking.tpl.html', 54, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
<!--
function deleteTimeEntry(time_id)
{
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will permanently delete the specified time tracking entry.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    } else {
        var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var popupWin = window.open(\'popup.php?cat=delete_time&id=\' + time_id, \'_popup\', features);
        popupWin.focus();
    }
}
function addTimeEntry()
{
    var features = \'width=550,height=250,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    '; ?>

    var issue_id = <?php echo $_GET['id']; ?>
;
    var popupWin = window.open('time_tracking.php?iss_id=' + issue_id, 'time_tracking_' + issue_id, features);
    <?php echo '
    popupWin.focus();
}
//-->
</script>
'; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<form name="add_time_form" method="post" action="#">
  <tr>
    <td width="100%">
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2">
        <tr>
          <td class="default" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time Tracking<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo count($this->_tpl_vars['time_entries']); ?>
)</b>
          </td>
          <td align="right" class="default">
          [ <a class="link" href="#top"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Top<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
            [ <a id="time_tracker_link" class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('time_tracker');"><?php echo smarty_function_get_innerhtml(array('element_name' => 'time_tracker','total' => count($this->_tpl_vars['time_entries'])), $this);?>
</a> ]
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="default" width="100%">
            <table width="100%" cellpadding="2" cellspacing="1">
              <tr id="time_tracker1" <?php echo smarty_function_get_display_style(array('element_name' => 'time_tracker','total' => count($this->_tpl_vars['time_entries'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
">
                <td class="default_white" align="center" width="5">#</td>
                <td class="default_white" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date of Work<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td class="default_white" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time Spent<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="50%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
              </tr>
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['time_entries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

              <tr id="time_tracker<?php echo $this->_sections['i']['iteration']+1; ?>
" <?php echo smarty_function_get_display_style(array('element_name' => 'time_tracker','total' => count($this->_tpl_vars['time_entries'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                <td class="default" align="center"><?php echo $this->_sections['i']['iteration']; ?>
</td>
                <td class="default" nowrap><?php echo $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['ttr_created_date']; ?>
</td>
                <td class="default" nowrap>
                  <?php echo $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['usr_full_name']; ?>

                  <?php if ($this->_tpl_vars['current_user_id'] == $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['ttr_usr_id']): ?>[ <a class="link" href="javascript:void(null);" onClick="javascript:deleteTimeEntry(<?php echo $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['ttr_id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]<?php endif; ?>
                </td>
                <td class="default"><?php echo $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['formatted_time']; ?>
</td>
                <td class="default" nowrap><?php echo $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['ttc_title']; ?>
</td>
                <td class="default"><?php echo $this->_tpl_vars['time_entries'][$this->_sections['i']['index']]['ttr_summary']; ?>
</td>
              </tr>
              <?php if ($this->_sections['i']['last']): ?>
              <tr>
                <td bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" colspan="3" class="default_white" align="right" width="30%"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Time Spent<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
                <td bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
" colspan="3" class="default" width="70%"><?php echo $this->_tpl_vars['total_time_spent']; ?>
</td>
              </tr>
              <?php endif; ?>
              <?php endfor; else: ?>
              <tr id="time_tracker2" <?php echo smarty_function_get_display_style(array('element_name' => 'time_tracker','total' => count($this->_tpl_vars['time_entries'])), $this);?>
>
                <td colspan="6" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" align="center" class="default">
                  <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No time tracking entries could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                </td>
              </tr>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer']): ?>
              <tr>
                <td colspan="6" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" align="center" width="100%" nowrap>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Time Entry<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onClick="addTimeEntry()">
                </td>
              </tr>
              <?php endif; ?>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</form>
</table>