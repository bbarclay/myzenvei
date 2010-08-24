<?php /* Smarty version 2.6.18, created on 2010-08-10 17:17:14
         compiled from post_note.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'post_note.tpl.html', 8, false),array('modifier', 'replace', 'post_note.tpl.html', 58, false),array('modifier', 'escape', 'post_note.tpl.html', 89, false),array('modifier', 'count', 'post_note.tpl.html', 124, false),array('function', 'html_options', 'post_note.tpl.html', 130, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['post_result'] != ''): ?>
<br />
<center>
<?php if ($this->_tpl_vars['post_result'] == -1): ?>
  <span class="default">
  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to run your query<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
  </span>
<?php else: ?>
  <span class="default">
  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the internal note was posted successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
  </span>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "app_messages.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
</center>
<script type="text/javascript">
<!--
<?php if ($this->_tpl_vars['current_user_prefs']['close_popup_windows']): ?>
setTimeout('closeAndRefresh()', 2000);
<?php endif; ?>
//-->
</script>
<br />
  <?php if (! $this->_tpl_vars['current_user_prefs']['close_popup_windows']): ?>
  <center>
    <span class="default"><a class="link" href="javascript:void(null);" onClick="javascript:closeAndRefresh();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Continue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
  </center>
  <?php endif; ?>
<?php else: ?>
<?php echo '
<script type="text/javascript">
<!--
function validate(f)
{
    if (isWhitespace(f.title.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the title of this note.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'title\');
        return false;
    }
    if (isWhitespace(f.note.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the message body of this note.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'note\');
        return false;
    }
    return true;
}
function clearExtraRecipients()
{
    var f = getForm(\'post_note_form\');
    f.elements[\'note_cc[]\'].selectedIndex = -1;
    showSelections(\'post_note_form\', \'note_cc[]\');
}
var old_message = \'\';
function setSignature(f)
{
'; ?>

    var signature = "<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['current_user_prefs']['email_signature'])) ? $this->_run_mod_handler('replace', true, $_tmp, '"', '\"') : smarty_modifier_replace($_tmp, '"', '\"')))) ? $this->_run_mod_handler('replace', true, $_tmp, "\r", "") : smarty_modifier_replace($_tmp, "\r", "")))) ? $this->_run_mod_handler('replace', true, $_tmp, "\n", '\n') : smarty_modifier_replace($_tmp, "\n", '\n')); ?>
";
<?php echo '
    if (f.add_email_signature.checked) {
        old_message = f.note.value;
        f.note.value += "\\n";
        f.note.value += signature;
    } else {
        f.note.value = old_message;
    }
}
//-->
</script>
'; ?>

<form onSubmit="javascript:return validate(this);" name="post_note_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
<input type="hidden" name="cat" value="post_note">
<input type="hidden" name="parent_id" value="<?php echo $this->_tpl_vars['parent_note_id']; ?>
">
<input type="hidden" name="issue_id" value="<?php echo $this->_tpl_vars['issue_id']; ?>
">
<table align="center" width="100%" cellpadding="3">
  <tr>
    <td>
      <table width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="2" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post New Internal Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
        </tr>
        <tr>
          <td width="140" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <b><?php echo ((is_array($_tmp=$this->_tpl_vars['from'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</b>
          </td>
        </tr>
        <tr>
          <td width="140" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recipients:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            Issue #<?php echo $this->_tpl_vars['issue_id']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notification List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (Members: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['subscribers']['staff'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<", "&lt;") : smarty_modifier_replace($_tmp, "<", "&lt;")))) ? $this->_run_mod_handler('replace', true, $_tmp, ">", "&gt;") : smarty_modifier_replace($_tmp, ">", "&gt;")); ?>
)
          </td>
        </tr>
        <tr>
          <td width="140" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> *</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input type="text" name="title" class="default" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['reply_subject'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'title')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="2">
            <textarea name="note" rows="16" style="width: 97%"><?php echo ((is_array($_tmp=$this->_tpl_vars['note']['not_body'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php if ($this->_tpl_vars['current_user_prefs']['auto_append_note_sig'] == 'yes'): ?>


<?php echo ((is_array($_tmp=$this->_tpl_vars['current_user_prefs']['email_signature'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?></textarea>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="140" class="default_white" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" valign="top">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Extra Note Recipients:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select class="default"
              <?php if (count($this->_tpl_vars['users']) > 10): ?>
                size="10"
              <?php else: ?>
                size="<?php echo count($this->_tpl_vars['users']); ?>
"
              <?php endif; ?>
              multiple name="note_cc[]" onChange="javascript:showSelections('post_note_form', 'note_cc[]');">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users']), $this);?>

            </select><input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear Selections<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:clearExtraRecipients();"><br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lookup_field.tpl.html", 'smarty_include_vars' => array('lookup_field_name' => 'search','lookup_field_target' => "note_cc[]",'callbacks' => "new Array('showSelections(\'post_note_form\', \'note_cc[]\')')")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="default" id="selection_note_cc[]"></div>
          </td>
        </tr>
        <tr>
          <td width="140" class="default_white" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Extra Recipients To Notification List?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <input type="radio" name="add_extra_recipients" value="yes"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('post_note_form', 'add_extra_recipients', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
            <input type="radio" name="add_extra_recipients" value="no" checked> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('post_note_form', 'add_extra_recipients', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
        </tr>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Status for Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> #<?php echo $this->_tpl_vars['issue_id']; ?>
:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select name="new_status" class="default">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuses'],'selected' => $this->_tpl_vars['current_issue_status']), $this);?>

            </select>
          </td>
        </tr>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time Spent:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input type="text" size="5" name="time_spent" class="default">
            <select name="time_category" class="default">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['time_categories'],'selected' => $this->_tpl_vars['note_category_id']), $this);?>

            </select>
            <span class="small_default"><i>(in minutes)</i></span>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'time_spent')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/issue_fields.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <tr>
          <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td align="center">
                  <input name="main_submit_button" class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Internal Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cancel<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:window.close();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <?php if ($this->_tpl_vars['current_user_prefs']['email_signature'] != "" && $this->_tpl_vars['current_user_prefs']['auto_append_note_sig'] != 'yes'): ?>
                <td align="right" class="default_white" width="10%">
                  <nobr>
                  <input type="checkbox" name="add_email_signature" value="yes" onClick="javascript:setSignature(this.form);">
                  <a id="white_link" class="white_link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('post_note_form', 'add_email_signature');setSignature(getForm('post_note_form'));"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Email Signature<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                  &nbsp;&nbsp;
                  </nobr>
                </td>
                <?php endif; ?>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="default">
            <b>* <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Required fields<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php if ($this->_tpl_vars['parent_note_id'] || $_GET['cat'] == 'reply'): ?>
<?php echo '
<script type="text/javascript">
<!--
window.onload = focusMessageBox;
function focusMessageBox()
{
    var f = getForm(\'post_note_form\');
    f.note.focus();
}
//-->
</script>
'; ?>

<?php endif; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>