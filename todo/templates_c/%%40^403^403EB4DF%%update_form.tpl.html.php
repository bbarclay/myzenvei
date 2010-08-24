<?php /* Smarty version 2.6.18, created on 2010-08-07 21:48:37
         compiled from update_form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'update_form.tpl.html', 12, false),array('modifier', 'count', 'update_form.tpl.html', 23, false),array('modifier', 'escape', 'update_form.tpl.html', 46, false),array('modifier', 'replace', 'update_form.tpl.html', 193, false),array('modifier', 'join', 'update_form.tpl.html', 238, false),array('function', 'html_options', 'update_form.tpl.html', 155, false),)), $this); ?>

<?php if ($this->_tpl_vars['update_result']): ?>
<br />
<table width="500" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td>
            <?php if ($this->_tpl_vars['update_result'] == -1): ?>
              <div align="center">
                <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sorry, an error happened while trying to run your query.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
              </div>
            <?php elseif ($this->_tpl_vars['update_result'] == 1): ?>
              <span class="default">
              <div align="center">
                <b><?php $this->_tag_stack[] = array('t', array('1' => $_POST['issue_id'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, issue #%1 was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
              </div>
              <?php if ($this->_tpl_vars['has_duplicates'] == 'yes'): ?>
                <br /><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Also, all issues that are marked as duplicates from this one were updated as well.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php endif; ?>

              <?php if (count($this->_tpl_vars['errors']) > 0): ?>
              <br />However, there are some warnings you should be aware of:<br />
              <ul>
              <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section'] => $this->_tpl_vars['sub_errors']):
?>
                <li><?php echo $this->_tpl_vars['section']; ?>
<br />
                  <?php $_from = $this->_tpl_vars['sub_errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['msg']; ?>
<br />
                  <?php endforeach; endif; unset($_from); ?>
                </li>
              <?php endforeach; endif; unset($_from); ?>
              </ul>
              <?php else: ?>
                <br />
              <?php endif; ?>
              </span>

              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "app_messages.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

              <span class="default">
              <?php if (count($this->_tpl_vars['notify_list']) > 0): ?>
                <div align="center">
                <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>E-mail about issue update was sent to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b><br />
                <?php $_from = $this->_tpl_vars['notify_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['email_address']):
?>
                  &nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['email_address'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<br />
                <?php endforeach; endif; unset($_from); ?>
                </div>
                <br />
              <?php endif; ?>

              <div align="center">
                <b>
                  <a href="view.php?id=<?php echo $_POST['issue_id']; ?>
" class="link"><?php $this->_tag_stack[] = array('t', array('1' => $_POST['issue_id'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Return to Issue #%1 Details Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br />
                  <a href="update.php?id=<?php echo $_POST['issue_id']; ?>
" class="link"><?php $this->_tag_stack[] = array('t', array('1' => $_POST['issue_id'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Issue #%1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </b>
              </div>
              </span>
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php else: ?>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/overlib_mini.js?c=d23a"></script>
<script type="text/javascript">
<?php echo '
<!--
function openHistory(issue_id)
{
    var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'history.php?iss_id=\' + issue_id, \'_impact\', features);
    popupWin.focus();
}
function openNotification(issue_id)
{
    var features = \'width=440,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'notification.php?iss_id=\' + issue_id, \'_notification\', features);
    popupWin.focus();
}
function openAuthorizedReplier(issue_id)
{
    var features = \'width=440,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'authorized_replier.php?iss_id=\' + issue_id, \'_replier\', features);
    popupWin.focus();
}
function validateForm(f)
{
    if (isWhitespace(f.summary.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the summary for this issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'summary\');
        return false;
    }
    if (isWhitespace(f.description.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the description for this issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'description\');
        return false;
    }
    if ((f.percent_complete.value != \'\') && ((f.percent_complete.value < 0) || (f.percent_complete.value > 100))) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Percentage complete should be between 0 and 100<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'percent_complete\');
        return false;
    }
    '; ?>

    <?php if ($this->_tpl_vars['allow_unassigned_issues'] != 'yes' && $this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
    <?php echo '
    if (!hasOneSelected(f, \'assignments[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select an assignment for this issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'assignments[]\');
        return false;
    }
    '; ?>

    <?php endif; ?>
    <?php echo '
    return true;
}

function closeIssue(issue_id)
{
    if (confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Warning: All changes to this issue will be lost if you continue and close this issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        window.location.href=\'close.php?id=\' + issue_id;
    }
}
//-->
'; ?>

</script>

<?php if ($this->_tpl_vars['project_auto_switched'] == 1): ?>
<center>
  <span class="banner_red">
    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('t', array('1' => $this->_tpl_vars['current_project_name'],'2' => $this->_tpl_vars['old_project'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project automatically switched to '%1' from '%2'.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </span>
</center>
<br />
<?php endif; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<form onSubmit="javascript:return validateForm(this);" name="update_form" method="post" action="update.php">
<input type="hidden" name="cat" value="update">
<input type="hidden" name="issue_id" value="<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
">
<input type="hidden" name="resolution" value="<?php echo $this->_tpl_vars['issue']['iss_res_id']; ?>
">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="2" class="default" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Issue Overview<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b> (ID: <a href="<?php echo $this->_tpl_vars['rel_url']; ?>
view.php?id=<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
" class="link"><?php echo $this->_tpl_vars['issue']['iss_id']; ?>
</a>)

            <?php if ($this->_tpl_vars['usr_role_id'] >= $this->_tpl_vars['roles']['developer']): ?>
            &nbsp;<b>Project:</b>
            <select name="new_prj" class="shortcut" style="font-size: 90%">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['active_projects'],'selected' => $this->_tpl_vars['current_project']), $this);?>

            </select>
            <input type="submit" class="shortcut" name="move_issue" style="font-size: 90%" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <?php endif; ?>
          </td>
          <td colspan="2" align="right" class="default">
            <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
            [ <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>edit the authorized repliers list for this issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:openAuthorizedReplier(<?php echo $_GET['id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Authorized Replier List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            [ <a class="link" href="javascript:void(null);" onClick="javascript:openNotification(<?php echo $_GET['id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Notification List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            <?php endif; ?>
            [ <a class="link" href="javascript:void(null);" onClick="javascript:openHistory(<?php echo $_GET['id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>History of Changes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
          </td>
        </tr>
        <tr>
          <?php if (count($this->_tpl_vars['categories']) > 0): ?>
          <td width="120" nowrap bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select class="default" name="category">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['issue']['iss_prc_id']), $this);?>

            </select>
          </td>
          <?php else: ?>
          <input type="hidden" name="category" value="<?php echo $this->_tpl_vars['issue']['iss_prc_id']; ?>
">
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" rowspan="2">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['issue']['status_color']; ?>
" rowspan="2">
            <select class="default" name="status">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['status'],'selected' => $this->_tpl_vars['issue']['iss_sta_id']), $this);?>

            </select>
          </td>
          <?php endif; ?>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" valign="top" class="default_white" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notification List:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" valign="top" class="default">
            <?php if ($this->_tpl_vars['subscribers']['staff'] != ''): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Staff<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['subscribers']['staff'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<", "&lt;") : smarty_modifier_replace($_tmp, "<", "&lt;")))) ? $this->_run_mod_handler('replace', true, $_tmp, ">", "&gt;") : smarty_modifier_replace($_tmp, ">", "&gt;")); ?>
<?php endif; ?>
            <?php if ($this->_tpl_vars['subscribers']['staff'] != '' && $this->_tpl_vars['subscribers']['customers'] != ''): ?><br /><?php endif; ?>
            <?php if ($this->_tpl_vars['subscribers']['customers'] != ''): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Other<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['subscribers']['customers'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<", "&lt;") : smarty_modifier_replace($_tmp, "<", "&lt;")))) ? $this->_run_mod_handler('replace', true, $_tmp, ">", "&gt;") : smarty_modifier_replace($_tmp, ">", "&gt;")); ?>
<?php endif; ?>
          </td>
        </tr>
        <tr>
          <?php if (count($this->_tpl_vars['categories']) > 0): ?>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['issue']['status_color']; ?>
">
            <select class="default" name="status">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['status'],'selected' => $this->_tpl_vars['issue']['iss_sta_id']), $this);?>

            </select>
          </td>
          <?php endif; ?>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submitted Date:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['iss_created_date']; ?>

          </td>
        </tr>
        <tr>
          <td <?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['roles']['standard_user']): ?>rowspan="2"<?php endif; ?> width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td <?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['roles']['standard_user']): ?>rowspan="2"<?php endif; ?> bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select class="default" name="priority">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['priorities'],'selected' => $this->_tpl_vars['issue']['iss_pri_id']), $this);?>

            </select>
          </td>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Date:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['iss_updated_date']; ?>

          </td>
        </tr>
        <tr>
          <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <nobr><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Associated Issues:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></nobr>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/issue_field.tpl.html", 'smarty_include_vars' => array('field_name' => 'associated_issues','form_name' => 'update_form','value' => ((is_array($_tmp=", ")) ? $this->_run_mod_handler('join', true, $_tmp, $this->_tpl_vars['issue']['associated_issues']) : join($_tmp, $this->_tpl_vars['issue']['associated_issues'])))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <?php endif; ?>
          <td nowrap width="130" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reporter:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['reporter']; ?>

          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Expected Resolution Date:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" <?php if (count($this->_tpl_vars['releases']) == 0): ?>colspan="3"<?php endif; ?>>
            <input type="text" name="expected_resolution_date" id="expected_resolution" value="<?php echo $this->_tpl_vars['issue']['iss_expected_resolution_date']; ?>
" class="date_picker">
          </td>
          <?php if (count($this->_tpl_vars['releases']) > 0): ?>
          <td nowrap width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Scheduled Release:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select name="release" class="default">
              <option value="0"></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['releases'],'selected' => $this->_tpl_vars['issue']['iss_pre_id']), $this);?>

            </select>
          </td>
          <?php endif; ?>
        </tr>
        <tr>
          <td width="120" nowrap bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Percentage Complete:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input type="text" name="percent_complete" value="<?php echo $this->_tpl_vars['issue']['iss_percent_complete']; ?>
" size="2" class="default">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'percent_complete')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <span class="default">(0 - 100)</span>
          </td>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Estimated Dev. Time:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" valign="top">
           <input type="text" name="estimated_dev_time" value="<?php echo $this->_tpl_vars['issue']['iss_dev_time']; ?>
" size="4" class="default">
           <span class="default">(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</span>
          </td>
        </tr>
        <tr>
          <td <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer'] && count($this->_tpl_vars['groups']) > 0): ?>rowspan="2" <?php endif; ?>width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignment:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php if ($this->_tpl_vars['allow_unassigned_issues'] != 'yes'): ?>*<?php endif; ?></b>
          </td>
          <td <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer'] && count($this->_tpl_vars['groups']) > 0): ?>rowspan="2" <?php endif; ?>bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['issue']['has_inactive_users']): ?>
            <span class="default"><input type="radio" name="keep_assignments" checked value="yes"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('update_form', 'keep_assignments', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Keep Current Assignments:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['issue']['assignments']; ?>
</a>
            <br />
            <input type="radio" name="keep_assignments" value="no"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('update_form', 'keep_assignments', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change Assignments:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> </span><br />
            <?php else: ?>
            <input type="hidden" name="keep_assignments" value="no">
            <?php endif; ?>
            <select size="<?php if ($this->_tpl_vars['issue']['has_inactive_users']): ?>3<?php else: ?>4<?php endif; ?>" multiple class="default" name="assignments[]" onChange="javascript:showSelections('update_form', 'assignments[]');">
              <?php if ($this->_tpl_vars['issue']['has_inactive_users']): ?>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users']), $this);?>

              <?php else: ?>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users'],'selected' => $this->_tpl_vars['issue']['assigned_users']), $this);?>

              <?php endif; ?>
            </select><input type="button" class="shortcut" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear Selections<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:clearSelectedOptions(getFormElement(this.form, 'assignments[]'));showSelections('update_form', 'assignments[]');"><br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lookup_field.tpl.html", 'smarty_include_vars' => array('lookup_field_name' => 'search','lookup_field_target' => "assignments[]",'callbacks' => "new Array('showSelections(\'update_form\', \'assignments[]\')')")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="default" id="selection_assignments[]"><?php if ($this->_tpl_vars['issue']['assignments']): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Current Selections:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['issue']['assignments']; ?>
<?php endif; ?></div>
          </td>
          <td width="140" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" valign="top" class="default_white" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Authorized Repliers:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" valign="top" class="default">
            <?php if (count($this->_tpl_vars['issue']['authorized_repliers']['users']) > 0): ?>
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Staff:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php unset($this->_sections['replier']);
$this->_sections['replier']['name'] = 'replier';
$this->_sections['replier']['loop'] = is_array($_loop=$this->_tpl_vars['issue']['authorized_repliers']['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['replier']['show'] = true;
$this->_sections['replier']['max'] = $this->_sections['replier']['loop'];
$this->_sections['replier']['step'] = 1;
$this->_sections['replier']['start'] = $this->_sections['replier']['step'] > 0 ? 0 : $this->_sections['replier']['loop']-1;
if ($this->_sections['replier']['show']) {
    $this->_sections['replier']['total'] = $this->_sections['replier']['loop'];
    if ($this->_sections['replier']['total'] == 0)
        $this->_sections['replier']['show'] = false;
} else
    $this->_sections['replier']['total'] = 0;
if ($this->_sections['replier']['show']):

            for ($this->_sections['replier']['index'] = $this->_sections['replier']['start'], $this->_sections['replier']['iteration'] = 1;
                 $this->_sections['replier']['iteration'] <= $this->_sections['replier']['total'];
                 $this->_sections['replier']['index'] += $this->_sections['replier']['step'], $this->_sections['replier']['iteration']++):
$this->_sections['replier']['rownum'] = $this->_sections['replier']['iteration'];
$this->_sections['replier']['index_prev'] = $this->_sections['replier']['index'] - $this->_sections['replier']['step'];
$this->_sections['replier']['index_next'] = $this->_sections['replier']['index'] + $this->_sections['replier']['step'];
$this->_sections['replier']['first']      = ($this->_sections['replier']['iteration'] == 1);
$this->_sections['replier']['last']       = ($this->_sections['replier']['iteration'] == $this->_sections['replier']['total']);
?>
                    <?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['issue']['authorized_repliers']['users'][$this->_sections['replier']['index']]['replier'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<", "&lt;") : smarty_modifier_replace($_tmp, "<", "&lt;")))) ? $this->_run_mod_handler('replace', true, $_tmp, ">", "&gt;") : smarty_modifier_replace($_tmp, ">", "&gt;")); ?><?php echo ''; ?><?php if ($this->_sections['replier']['last'] != 1): ?><?php echo ',&nbsp;'; ?><?php endif; ?><?php echo ''; ?>

                <?php endfor; endif; ?>
                <br />
            <?php endif; ?>
            <?php if (count($this->_tpl_vars['issue']['authorized_repliers']['other']) > 0): ?>
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Other:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <?php unset($this->_sections['replier']);
$this->_sections['replier']['name'] = 'replier';
$this->_sections['replier']['loop'] = is_array($_loop=$this->_tpl_vars['issue']['authorized_repliers']['other']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['replier']['show'] = true;
$this->_sections['replier']['max'] = $this->_sections['replier']['loop'];
$this->_sections['replier']['step'] = 1;
$this->_sections['replier']['start'] = $this->_sections['replier']['step'] > 0 ? 0 : $this->_sections['replier']['loop']-1;
if ($this->_sections['replier']['show']) {
    $this->_sections['replier']['total'] = $this->_sections['replier']['loop'];
    if ($this->_sections['replier']['total'] == 0)
        $this->_sections['replier']['show'] = false;
} else
    $this->_sections['replier']['total'] = 0;
if ($this->_sections['replier']['show']):

            for ($this->_sections['replier']['index'] = $this->_sections['replier']['start'], $this->_sections['replier']['iteration'] = 1;
                 $this->_sections['replier']['iteration'] <= $this->_sections['replier']['total'];
                 $this->_sections['replier']['index'] += $this->_sections['replier']['step'], $this->_sections['replier']['iteration']++):
$this->_sections['replier']['rownum'] = $this->_sections['replier']['iteration'];
$this->_sections['replier']['index_prev'] = $this->_sections['replier']['index'] - $this->_sections['replier']['step'];
$this->_sections['replier']['index_next'] = $this->_sections['replier']['index'] + $this->_sections['replier']['step'];
$this->_sections['replier']['first']      = ($this->_sections['replier']['iteration'] == 1);
$this->_sections['replier']['last']       = ($this->_sections['replier']['iteration'] == $this->_sections['replier']['total']);
?>
                    <?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['issue']['authorized_repliers']['other'][$this->_sections['replier']['index']]['replier'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<", "&lt;") : smarty_modifier_replace($_tmp, "<", "&lt;")))) ? $this->_run_mod_handler('replace', true, $_tmp, ">", "&gt;") : smarty_modifier_replace($_tmp, ">", "&gt;")); ?><?php echo ''; ?><?php if ($this->_sections['replier']['last'] != 1): ?><?php echo ',&nbsp;'; ?><?php endif; ?><?php echo ''; ?>

                <?php endfor; endif; ?>
            <?php endif; ?>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer'] && count($this->_tpl_vars['groups']) > 0): ?>
        <tr>
            <td width="140" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" valign="middle" class="default_white" nowrap >
                <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            </td>
            <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" valign="middle" >
                <select class="default" name="group">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groups'],'selected' => $this->_tpl_vars['issue']['iss_grp_id']), $this);?>

                </select>
            </td>
        </tr>
        <?php else: ?>
            <input type="hidden" name="group" value="<?php echo $this->_tpl_vars['issue']['iss_grp_id']; ?>
">
        <?php endif; ?>
        <?php else: ?>
        <input type="hidden" name="keep_assignments" value="yes">
        <?php $_from = $this->_tpl_vars['issue']['associated_issues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_issue_id'] => $this->_tpl_vars['_issue_summary']):
?>
        <input type="hidden" name="associated_issues[]" value="<?php echo $this->_tpl_vars['_issue_id']; ?>
">
        <?php endforeach; endif; unset($_from); ?>
        <input type="hidden" name="estimated_dev_time" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['iss_dev_time'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
        <input type="hidden" name="release" value="<?php echo $this->_tpl_vars['issue']['iss_pre_id']; ?>
">
        <input type="hidden" name="group" value="<?php echo $this->_tpl_vars['issue']['iss_grp_id']; ?>
">
        <?php endif; ?>
        <?php if (count($this->_tpl_vars['releases']) < 1): ?>
            <input type="hidden" name="release" value="<?php echo $this->_tpl_vars['issue']['iss_pre_id']; ?>
">
        <?php endif; ?>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td colspan="3" bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
">
            <input type="text" class="default" size="60" name="summary" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['iss_summary'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'summary')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td colspan="3" bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
" class="default">
            <textarea name="description" rows="20" style="width: 97%"><?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['iss_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'description')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['roles']['developer']): ?>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Private:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td colspan="3" bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
" class="default">
            <input type="radio" name="private" value="1" <?php if ($this->_tpl_vars['issue']['iss_private']): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('update_form', 'private', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <input type="radio" name="private" value="0" <?php if (! $this->_tpl_vars['issue']['iss_private']): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('update_form', 'private', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
        </tr>
        <?php else: ?>
        <input type="hidden" name="trigger_reminders" value="<?php echo $this->_tpl_vars['issue']['iss_trigger_reminders']; ?>
">
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['standard_user']): ?>
        <tr>
          <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Trigger Reminders:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td colspan="3" bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
" class="default">
            <input type="radio" name="trigger_reminders" value="1" <?php if ($this->_tpl_vars['issue']['iss_trigger_reminders']): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('update_form', 'trigger_reminders', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <input type="radio" name="trigger_reminders" value="0" <?php if (! $this->_tpl_vars['issue']['iss_trigger_reminders']): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('update_form', 'trigger_reminders', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
        </tr>
        <?php else: ?>
        <input type="hidden" name="trigger_reminders" value="<?php echo $this->_tpl_vars['issue']['iss_trigger_reminders']; ?>
">
        <?php endif; ?>

        <?php if ($this->_tpl_vars['has_customer_integration']): ?>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "customer/".($this->_tpl_vars['customer_backend_name'])."/update_report_form_fields.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>

        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <td colspan="4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">&nbsp;
                  <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cancel Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:history.go(-1);">&nbsp;
                  <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <?php if (( ! $this->_tpl_vars['issue']['sta_is_closed'] ) && $this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
                  &nbsp;<input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:closeIssue(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</form>
</table>
<?php endif; ?>



