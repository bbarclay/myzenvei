<?php /* Smarty version 2.6.18, created on 2010-07-29 22:17:40
         compiled from notes.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'notes.tpl.html', 6, false),array('modifier', 'count', 'notes.tpl.html', 52, false),array('modifier', 'escape', 'notes.tpl.html', 82, false),array('modifier', 'default', 'notes.tpl.html', 86, false),array('function', 'get_innerhtml', 'notes.tpl.html', 57, false),array('function', 'get_display_style', 'notes.tpl.html', 64, false),array('function', 'cycle', 'notes.tpl.html', 73, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
<!--
function deleteNote(note_id)
{
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will permanently delete the specified note.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    }

    var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'popup.php?cat=delete_note&id=\' + note_id, \'_popup_\' + note_id, features);
    popupWin.focus();
}
function convertNote(note_id)
{
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This note will be deleted & converted to an email, one either sent immediately or saved as a draft.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    }

    var features = \'width=420,height=180,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'convert_note.php?id=\' + note_id, \'_convertNote_\'+note_id, features);
    popupWin.focus();
}
function viewNote(note_id)
{
    var features = \'width=560,height=500,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var noteWin = window.open(\'view_note.php?id=\' + note_id, \'_note_\' + note_id, features);
    noteWin.focus();
}
function postInternalNote(issue_id)
{
    var features = \'width=560,height=600,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var noteWin = window.open(\'post_note.php?issue_id=\' + issue_id, \'_postNote_\' + issue_id, features);
    noteWin.focus();
}
function replyNote(note_id, issue_id)
{
    var features = \'width=560,height=500,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var noteWin = window.open(\'post_note.php?cat=reply&id=\' + note_id + \'&issue_id=\' + issue_id, \'_postNote_\'+ issue_id, features);
    noteWin.focus();
}
//-->
</script>
'; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<form name="add_note_form" target="_notes" method="post">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2">
        <tr>
          <td class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Internal Notes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo count($this->_tpl_vars['notes']); ?>
)</b>
          </td>
          <td align="right" class="default">
            [ <a class="link" href="#top"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Top<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
            [ <a id="notes_link" class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('notes');"><?php echo smarty_function_get_innerhtml(array('element_name' => 'notes','total' => count($this->_tpl_vars['notes'])), $this);?>
</a> ]
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" cellpadding="2" cellspacing="1">
              <tr id="notes1" <?php echo smarty_function_get_display_style(array('element_name' => 'notes','total' => count($this->_tpl_vars['notes'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
">
                <td class="default_white" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('remote_func' => 'getNote','ec_id' => 'note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td class="default_white" align="center">#</td>
                <td class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reply<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Posted Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="60%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
              </tr>
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['notes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

              <tr id="notes<?php echo $this->_sections['i']['iteration']+1; ?>
" <?php echo smarty_function_get_display_style(array('element_name' => 'notes','total' => count($this->_tpl_vars['notes'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                <td class="default" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('ec_id' => 'note','list_id' => $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td class="default" align="center"><?php echo $this->_sections['i']['iteration']; ?>
</td>
                <td align="center">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>reply to this note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:replyNote(<?php echo $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id']; ?>
, <?php echo $_GET['id']; ?>
);" class="link"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/icons/reply.gif" border="0"></a>
                </td>
                <td class="default"><?php echo $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_created_date']; ?>
</td>
                <td class="default">
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['notes'][$this->_sections['i']['index']]['usr_full_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                  <?php if ($this->_tpl_vars['current_user_id'] == $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_usr_id'] || $this->_tpl_vars['current_role'] >= $this->_tpl_vars['roles']['manager']): ?>[ <a class="link" href="javascript:void(null);" onClick="javascript:deleteNote(<?php echo $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]<?php endif; ?>
                </td>
                <td class="default">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view note details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:viewNote(<?php echo $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id']; ?>
);" class="link"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_title'])) ? $this->_run_mod_handler('default', true, $_tmp, "<Empty Title>") : smarty_modifier_default($_tmp, "<Empty Title>")))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                  <?php if ($this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_has_attachment']): ?>
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view note details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:viewNote(<?php echo $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id']; ?>
);" class="link"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/attachment.gif" border="0"></a>
                  <?php endif; ?>
                  <?php if ($this->_tpl_vars['notes'][$this->_sections['i']['index']]['has_blocked_message']): ?> (<a href="javascript:void(null);" onClick="javascript:convertNote(<?php echo $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id']; ?>
);" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>convert note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)<?php endif; ?>
                </td>
              </tr>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/body.tpl.html", 'smarty_include_vars' => array('ec_id' => 'note','list_id' => $this->_tpl_vars['notes'][$this->_sections['i']['index']]['not_id'],'colspan' => '6')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <?php endfor; else: ?>
              <tr id="notes2" <?php echo smarty_function_get_display_style(array('element_name' => 'notes','total' => count($this->_tpl_vars['notes'])), $this);?>
>
                <td colspan="6" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" align="center" class="default">
                  <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No internal notes could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                </td>
              </tr>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>
              <tr>
                <td colspan="6" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" align="center">
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Internal Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onClick="javascript:postInternalNote(<?php echo $_GET['id']; ?>
);">
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
