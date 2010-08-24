<?php /* Smarty version 2.6.18, created on 2010-07-29 22:17:40
         compiled from support_emails.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'support_emails.tpl.html', 8, false),array('modifier', 'is_array', 'support_emails.tpl.html', 56, false),array('modifier', 'count', 'support_emails.tpl.html', 56, false),array('modifier', 'escape', 'support_emails.tpl.html', 98, false),array('modifier', 'default', 'support_emails.tpl.html', 112, false),array('function', 'get_innerhtml', 'support_emails.tpl.html', 64, false),array('function', 'get_display_style', 'support_emails.tpl.html', 71, false),array('function', 'cycle', 'support_emails.tpl.html', 84, false),)), $this); ?>

<?php echo '
<script type="text/javascript">
<!--
function removeEmails(f)
{
    if (!hasOneChecked(f, \'item[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose which entries need to be disassociated with the current issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will remove the association of the selected entries to the current issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    } else {
        var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var popupWin = window.open(\'\', \'_removeEmails\', features);
        popupWin.focus();
        return true;
    }
}
function viewEmail(account_id, email_id)
{
    var features = \'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var emailWin = window.open(\'view_email.php?ema_id=\' + account_id + \'&id=\' + email_id, \'_email\' + email_id, features);
    emailWin.focus();
}
function reply(account_id, email_id)
{
'; ?>

    var features = 'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no';
    var emailWin = window.open('send.php?issue_id=<?php echo $_GET['id']; ?>
&ema_id=' + account_id + '&id=' + email_id, '_emailReply' + email_id, features);
    emailWin.focus();
<?php echo '
}
function sendEmail(account_id, issue_id)
{
    var features = \'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var emailWin = window.open(\'send.php?issue_id=\' + issue_id + \'&ema_id=\' + account_id, \'_email\', features);
    emailWin.focus();
}
//-->
</script>
'; ?>

<?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer']): ?>
    <?php $this->assign('email_col_count', '8'); ?>
<?php else: ?>
    <?php $this->assign('email_col_count', '7'); ?>
<?php endif; ?>
<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<form onSubmit="javascript:return removeEmails(this);" target="_removeEmails" action="popup.php" method="post">
<input type="hidden" name="cat" value="remove_support_email">
  <tr>
    <td width="100%">
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td class="default" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Associated Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php if (is_array($this->_tpl_vars['emails'])): ?><?php echo count($this->_tpl_vars['emails']); ?>
<?php else: ?>0<?php endif; ?>)</b>
          </td>
          <td align="right" class="default">
            [ <a class="link" href="#top"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Top<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['standard_user']): ?>
            [ <a href="mail_queue.php?iss_id=<?php echo $_GET['id']; ?>
" class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view the history of sent emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mail Queue Log<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            <?php endif; ?>
            <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
            [ <a id="support_emails_link" class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('support_emails');"><?php echo smarty_function_get_innerhtml(array('element_name' => 'support_emails','total' => count($this->_tpl_vars['emails'])), $this);?>
</a> ]
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" cellpadding="2" cellspacing="1">
              <tr id="support_emails1" <?php echo smarty_function_get_display_style(array('element_name' => 'support_emails','total' => count($this->_tpl_vars['emails'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                <?php if ($this->_tpl_vars['emails'] != "" && $this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer'] && $this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
                <td width="5"><input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');"></td>
                <?php endif; ?>
                <td class="default_white" align="center" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('ec_id' => 'email','remote_func' => 'getEmail')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td width="5" class="default_white" align="center">#</td>
                <td width="5" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reply<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="15%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recipients<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="15%" class="default_white" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Received<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="50%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
              </tr>
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['emails']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

              <tr id="support_emails<?php echo $this->_sections['i']['iteration']+1; ?>
" <?php echo smarty_function_get_display_style(array('element_name' => 'support_emails','total' => count($this->_tpl_vars['emails'])), $this);?>
>
                <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer'] && $this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
                <td align="center" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                  <input type="checkbox" name="item[]" value="<?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_id']; ?>
">
                </td>
                <?php endif; ?>
                <td align="center" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" NOWRAP align="center">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('ec_id' => 'email','list_id' => $this->_tpl_vars['emails'][$this->_sections['i']['index']]['composite_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
                <td class="default" align="center" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo $this->_sections['i']['iteration']; ?>
</td>
                <td align="center" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>reply to this email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:reply(<?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_ema_id']; ?>
, <?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_id']; ?>
);" class="link"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/icons/reply.gif" border="0"></a>
                </td>
                <td class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_from'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                <td class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                  <?php if ($this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_to'] == ""): ?>
                  <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sent to notification list<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                  <?php else: ?>
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_to'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                  <?php endif; ?>
                  <?php if ($this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_cc'] != ""): ?>
                  <br/>
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_cc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                  <?php endif; ?>
                </td>
                <td class="default" nowrap bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_date']; ?>
</td>
                <td class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view email details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:viewEmail(<?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_ema_id']; ?>
, <?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_id']; ?>
);" class="link"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_subject'])) ? $this->_run_mod_handler('default', true, $_tmp, "<Empty Subject Header>") : smarty_modifier_default($_tmp, "<Empty Subject Header>")))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                  <?php if ($this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_has_attachment']): ?>
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view email details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:viewEmail(<?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_ema_id']; ?>
, <?php echo $this->_tpl_vars['emails'][$this->_sections['i']['index']]['sup_id']; ?>
);" class="link"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/attachment.gif" border="0"></a>
                  <?php endif; ?>
                </td>
              </tr>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/body.tpl.html", 'smarty_include_vars' => array('ec_id' => 'email','list_id' => $this->_tpl_vars['emails'][$this->_sections['i']['index']]['composite_id'],'colspan' => $this->_tpl_vars['email_col_count'],'row_color' => $this->_tpl_vars['row_color'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <?php endfor; else: ?>
              <tr id="support_emails2" <?php echo smarty_function_get_display_style(array('element_name' => 'support_emails','total' => count($this->_tpl_vars['emails'])), $this);?>
>
                <td colspan="<?php echo $this->_tpl_vars['email_col_count']; ?>
" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default" align="center">
                  <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No associated emails could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                </td>
              </tr>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer']): ?>
              <tr>
                <td colspan="<?php echo $this->_tpl_vars['email_col_count']; ?>
" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td nowrap width="10">
                        <nobr>
                        <?php if ($this->_tpl_vars['emails'] != "" && $this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
                        <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');">
                        <input type="submit" class="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disassociate Selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                        <?php endif; ?>
                        </nobr>
                      </td>
                      <td align="center">
                        <?php if ($this->_tpl_vars['ema_id'] != ""): ?>
                        <input type="button" class="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:sendEmail(<?php echo $this->_tpl_vars['ema_id']; ?>
, <?php echo $_GET['id']; ?>
);">
                        <?php endif; ?>
                      </td>
                    </tr>
                  </table>
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
