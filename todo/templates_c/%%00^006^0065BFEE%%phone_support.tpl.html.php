<?php /* Smarty version 2.6.18, created on 2010-07-29 22:17:40
         compiled from phone_support.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'phone_support.tpl.html', 7, false),array('modifier', 'count', 'phone_support.tpl.html', 33, false),array('modifier', 'capitalize', 'phone_support.tpl.html', 70, false),array('function', 'get_innerhtml', 'phone_support.tpl.html', 38, false),array('function', 'get_display_style', 'phone_support.tpl.html', 45, false),array('function', 'cycle', 'phone_support.tpl.html', 57, false),)), $this); ?>

<?php echo '
<script type="text/javascript">
<!--
function deletePhoneEntry(phone_id)
{
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will permanently delete the specified phone support entry.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    } else {
        var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var popupWin = window.open(\'popup.php?cat=delete_phone&id=\' + phone_id, \'_popup\', features);
        popupWin.focus();
    }
}
function addPhoneCall()
{
    var features = \'width=850,height=450,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    '; ?>

    var issue_id = <?php echo $_GET['id']; ?>
;
    var popupWin = window.open('phone_calls.php?iss_id=' + issue_id, 'phone_calls_' + issue_id, features);
    <?php echo '
    popupWin.focus();
}
//-->
</script>
'; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2">
        <tr>
          <td class="default">
          <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone Calls<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo count($this->_tpl_vars['phone_entries']); ?>
)</b>
        </td>
        <td align="right" class="default">
            [ <a class="link" href="#top"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Top<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
          <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
            [ <a id="phone_support_link" class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('phone_support');"><?php echo smarty_function_get_innerhtml(array('element_name' => 'phone_support','total' => count($this->_tpl_vars['phone_entries'])), $this);?>
</a> ]
            <?php endif; ?>
        </td>
        </tr>
        <tr>
          <td colspan="2">
            <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2">
              <tr id="phone_support1" <?php echo smarty_function_get_display_style(array('element_name' => 'phone_support','total' => count($this->_tpl_vars['phone_entries'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
">
                <td class="default_white" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('remote_func' => 'getPhoneSupport','ec_id' => 'phone')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td width="5" class="default_white" align="center">#</td>
                <td width="20%" class="default_white" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recorded Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="15%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Entered By<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="10%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="10%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="10%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Call Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
              </tr>
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['phone_entries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

              <tr id="phone_support<?php echo $this->_sections['i']['iteration']+1; ?>
" <?php echo smarty_function_get_display_style(array('element_name' => 'phone_support','total' => count($this->_tpl_vars['phone_entries'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                <td class="default" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('ec_id' => 'phone','list_id' => $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td class="default" nowrap><?php echo $this->_sections['i']['iteration']; ?>
</td>
                <td class="default" nowrap><?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_created_date']; ?>
</td>
                <td class="default">
                    <?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['usr_full_name']; ?>

                    <?php if ($this->_tpl_vars['current_user_id'] == $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_usr_id']): ?>
                      [ <a class="link" href="javascript:void(null);" onClick="javascript:deletePhoneEntry(<?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
                    <?php endif; ?>
                </td>
                <td class="default"><?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_call_from_lname']; ?>
, <?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_call_from_fname']; ?>
</td>
                <td class="default"><?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_call_to_lname']; ?>
, <?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_call_to_fname']; ?>
</td>
                <td class="default"><?php echo ((is_array($_tmp=$this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_type'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
                <td class="default" nowrap><?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phc_title']; ?>
</td>
                <td class="default" nowrap><?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_phone_number']; ?>
 (<?php echo $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_phone_type']; ?>
)</td>
              </tr>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/body.tpl.html", 'smarty_include_vars' => array('ec_id' => 'phone','list_id' => $this->_tpl_vars['phone_entries'][$this->_sections['i']['index']]['phs_id'],'colspan' => '9')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <?php endfor; else: ?>
              <tr id="phone_support2" <?php echo smarty_function_get_display_style(array('element_name' => 'phone_support','total' => count($this->_tpl_vars['phone_entries'])), $this);?>
>
                <td colspan="9" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default" align="center">
                  <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No phone calls recorded yet.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                </td>
              </tr>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
              <tr>
                <td colspan="9" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" align="center">
                  <input type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Phone Call<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onClick="javascript:addPhoneCall();">
                </td>
              </tr>
              <?php endif; ?>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
