<?php /* Smarty version 2.6.18, created on 2010-07-29 22:17:40
         compiled from view_form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'view_form.tpl.html', 59, false),array('modifier', 'escape', 'view_form.tpl.html', 232, false),array('modifier', 'replace', 'view_form.tpl.html', 246, false),array('modifier', 'default', 'view_form.tpl.html', 327, false),array('modifier', 'count', 'view_form.tpl.html', 352, false),array('modifier', 'activateLinks', 'view_form.tpl.html', 438, false),array('function', 'get_innerhtml', 'view_form.tpl.html', 430, false),array('function', 'get_display_style', 'view_form.tpl.html', 438, false),array('function', 'html_options', 'view_form.tpl.html', 515, false),)), $this); ?>

<script type="text/javascript">
<!--
var ema_id = '<?php echo $this->_tpl_vars['ema_id']; ?>
';
<?php echo '
function openHistory(issue_id)
{
    var features = \'width=520,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
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
function signupAsAuthorizedReplier(issue_id)
{
    var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'popup.php?cat=authorize_reply&iss_id=\' + issue_id, \'_authorizeReply\', features);
    popupWin.focus();
}
function selfAssign(issue_id)
{
    var features = \'width=420,height=150,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'self_assign.php?iss_id=\' + issue_id, \'_selfAssign\', features);
    popupWin.focus();
}
function unassign(issue_id)
{
    var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'popup.php?cat=unassign&iss_id=\' + issue_id, \'_unassign\', features);
    popupWin.focus();
}
function replyIssue(issue_id)
{
    var features = \'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'send.php?cat=reply&ema_id=\' + ema_id + \'&issue_id=\' + issue_id, \'_replyIssue\' + issue_id, features);
    popupWin.focus();
}
function clearDuplicateStatus(issue_id)
{
    var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'popup.php?cat=clear_duplicate&iss_id=\' + issue_id, \'_clearDuplicate\', features);
    popupWin.focus();
}
function changeIssueStatus(f, issue_id, current_status_id)
{
    var new_status = getSelectedOption(f, \'new_status\');
    if (new_status == current_status_id) {
        selectField(f, \'new_status\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select the new status for this issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
    } else {
        var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var popupWin = window.open(\'popup.php?cat=new_status&iss_id=\' + issue_id + \'&new_sta_id=\' + new_status, \'_newStatus\', features);
        popupWin.focus();
    }
}
function editIncidentRedemption(issue_id)
{
    var features = \'width=300,height=300,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'redeem_incident.php?iss_id=\' + issue_id, \'_flagIncident\', features);
    popupWin.focus();
}
function removeQuarantine(issue_id)
{
    var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'popup.php?cat=remove_quarantine&iss_id=\' + issue_id, \'_removeQuarantine\', features);
    popupWin.focus();
}
function validateForm(f)
{
    // if no emails accounts are setup, don\'t display confirmation message.
    if (('; ?>
<?php echo $this->_tpl_vars['current_role']; ?>
 < <?php echo $this->_tpl_vars['roles']['developer']; ?>
<?php echo ') && (ema_id != \'\') &&
            !confirm("'; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>NOTE: If you need to send new information regarding this issue, please use the EMAIL related buttons available at the bottom of the screen.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '")) {
        return false;
    }
    return true;
}
function collapseDescription()
{
    if (isElementVisible(getPageElement(\'description1\'))) {
        changeVisibility(\'description_hidden\', false);
    } else {
        changeVisibility(\'description_hidden\', true);
    }
}
//-->
</script>
'; ?>

<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td class="default">
      <?php if ($this->_tpl_vars['previous_issue']): ?>
      &nbsp;<a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>previous issue on your current active filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="view.php?id=<?php echo $this->_tpl_vars['previous_issue']; ?>
">&lt;&lt; <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
      <?php endif; ?>
    </td>
    <td class="default" align="right">
      <?php if ($this->_tpl_vars['next_issue']): ?>
      <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>next issue on your current active filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="view.php?id=<?php echo $this->_tpl_vars['next_issue']; ?>
"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &gt;&gt;</a>&nbsp;
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><img height="10" src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/blank.gif"></td>
  </tr>
</table>

<?php if ($this->_tpl_vars['quarantine']['iqu_status'] > 0): ?>
<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/icons/error.gif" hspace="2" vspace="2" border="0" align="left"></td>
          <td width="100%" align="center">
            <span class="default">
            <span style="font-weight: bold; font-size: 160%; color: red;">
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This Issue is Currently Quarantined<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </span>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "customer/".($this->_tpl_vars['customer_backend_name'])."/quarantine.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><br />
            <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer'] && $this->_tpl_vars['quarantine']['iqu_expiration'] != ''): ?>
                <?php $this->_tag_stack[] = array('t', array('1' => $this->_tpl_vars['quarantine']['time_till_expiration'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Quarantine expires in %1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
            <?php endif; ?>
            <?php $this->_tag_stack[] = array('t', array('1' => "faq.php",'escape' => false)); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please see the <a class="link" href="%1">FAQ</a> for information regarding quarantined issues.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </span>
            <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>
            <br /><br />
            <input class="button" type="button" name="remove_quarantine" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remove Quarantine<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="removeQuarantine(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
)">
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['project_auto_switched'] == 1): ?>
<center>
  <span class="banner_red">
    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note: Project automatically switched to '<?php echo $this->_tpl_vars['current_project_name']; ?>
' from '<?php echo $this->_tpl_vars['old_project']; ?>
'.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </span>
</center>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['issue']['iss_private'] == 1): ?>
<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td width="100%" align="center" class="default" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> :</b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This issue is marked private. Only Managers, the reporter and users assigned to the issue can view it.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />
<?php endif; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-left: 1;padding-right: 1;padding-top: 1;padding-bottom: 0">
<form method="get" action="update.php" name="view_form" onSubmit="javascript:return validateForm(this);">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="2" class="default" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issue Overview<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b> (ID: <a href="<?php echo $this->_tpl_vars['rel_url']; ?>
view.php?id=<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view issue details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="link"><?php echo $this->_tpl_vars['issue']['iss_id']; ?>
</a>)
          </td>
          <td colspan="2" align="right" class="default">
            <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
            [ <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>edit the authorized repliers list for this issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:openAuthorizedReplier(<?php echo $_GET['id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Authorized Replier List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            [ <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>edit the notification list for this issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:openNotification(<?php echo $_GET['id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Notification List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
            <?php endif; ?>
            [ <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view the full history of changes on this issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:openHistory(<?php echo $_GET['id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>History of Changes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
          </td>
        </tr>
        <?php if ($this->_tpl_vars['has_customer_integration'] && $this->_tpl_vars['issue']['iss_customer_id']): ?>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['customer_info']['customer_name']; ?>

            (<a href="#customer_details" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Complete Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
          </td>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer Contract<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Support Level<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['issue']['customer_info']['support_level']; ?>

            <?php if ($this->_tpl_vars['issue']['customer_info']['support_options']): ?>
            <br />
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Support Options<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['issue']['customer_info']['support_options']; ?>

            <?php endif; ?>
            <?php if ($this->_tpl_vars['issue']['customer_info']['is_per_incident']): ?>
              <br />
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Redeemed Incident Types<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
              <?php echo ''; ?><?php $_from = $this->_tpl_vars['issue']['redeemed_incidents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['incident_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['incident_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['incident_details']):
        $this->_foreach['incident_loop']['iteration']++;
?><?php echo ''; ?><?php if ($this->_tpl_vars['incident_details']['is_redeemed'] == 1): ?><?php echo ''; ?><?php if (! ($this->_foreach['incident_loop']['iteration'] <= 1)): ?><?php echo ', '; ?><?php endif; ?><?php echo ''; ?><?php echo $this->_tpl_vars['incident_details']['title']; ?><?php echo ''; ?><?php $this->assign('has_redeemed_incident', 1); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>

              <?php if ($this->_tpl_vars['has_redeemed_incident'] != 1): ?><i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>None<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i><?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
                    <?php if ($this->_tpl_vars['show_category'] == 1): ?>
          <td width="150" nowrap bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['prc_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

          </td>
          <?php else: ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" rowspan="2">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['issue']['status_color']; ?>
" class="default" rowspan="2">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['sta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

          </td>
          <?php endif; ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" valign="top" class="default_white" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notification List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
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
          <?php if ($this->_tpl_vars['show_category'] == 1): ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['issue']['status_color']; ?>
" class="default">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['sta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

          </td>
          <?php endif; ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submitted Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['iss_created_date']; ?>

          </td>
        </tr>
        <tr>
          <td <?php if ($this->_tpl_vars['current_role'] == $this->_tpl_vars['roles']['customer'] || $this->_tpl_vars['show_releases'] == 0): ?>rowspan="2"<?php endif; ?> width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td <?php if ($this->_tpl_vars['current_role'] == $this->_tpl_vars['roles']['customer'] || $this->_tpl_vars['show_releases'] == 0): ?>rowspan="2"<?php endif; ?> bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['pri_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

          </td>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Updated Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['iss_updated_date']; ?>

          </td>
        </tr>
        <tr>
          <?php if ($this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer'] && $this->_tpl_vars['show_releases'] == 1): ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <nobr><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Scheduled Release<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>&nbsp;</nobr>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['pre_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

          </td>
          <?php endif; ?>
          <td nowrap width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Associated Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['issue']['associated_issues_details']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <?php echo '<a href="view.php?id='; ?><?php echo $this->_tpl_vars['issue']['associated_issues_details'][$this->_sections['i']['index']]['associated_issue']; ?><?php echo '" title="'; ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'issue'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ' #'; ?><?php echo $this->_tpl_vars['issue']['associated_issues_details'][$this->_sections['i']['index']]['associated_issue']; ?><?php echo ' ('; ?><?php echo $this->_tpl_vars['issue']['associated_issues_details'][$this->_sections['i']['index']]['current_status']; ?><?php echo ') - '; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['associated_issues_details'][$this->_sections['i']['index']]['associated_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?><?php echo '" class="'; ?><?php if ($this->_tpl_vars['issue']['associated_issues_details'][$this->_sections['i']['index']]['is_closed']): ?><?php echo 'closed_'; ?><?php endif; ?><?php echo 'link">#'; ?><?php echo $this->_tpl_vars['issue']['associated_issues_details'][$this->_sections['i']['index']]['associated_issue']; ?><?php echo '</a>'; ?><?php if (! $this->_sections['i']['last']): ?><?php echo ','; ?><?php endif; ?><?php echo ''; ?>

            <?php endfor; else: ?>
              <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues associated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resolution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['iss_resolution']; ?>

          </td>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Expected Resolution Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php if ($this->_tpl_vars['issue']['iss_expected_resolution_date'] == 0): ?>
            <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No resolution date given<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
            <?php else: ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['iss_expected_resolution_date'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Percentage Complete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo ((is_array($_tmp=@$this->_tpl_vars['issue']['iss_percent_complete'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
%
          </td>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Estimated Dev. Time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['iss_dev_time']; ?>

            <?php if ($this->_tpl_vars['issue']['iss_dev_time'] != ''): ?> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
          </td>
        </tr>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reporter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" <?php if ($this->_tpl_vars['current_role'] <= $this->_tpl_vars['roles']['customer']): ?>colspan="3" <?php endif; ?>bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <a href="list.php?reporter=<?php echo $this->_tpl_vars['issue']['iss_usr_id']; ?>
&hide_closed=1" class="link"><?php echo $this->_tpl_vars['issue']['reporter']; ?>
</a>
          </td>
          <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Duplicates<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php if ($this->_tpl_vars['issue']['iss_duplicated_iss_id']): ?>
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Duplicate of<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <a href="<?php echo $this->_tpl_vars['rel_url']; ?>
view.php?id=<?php echo $this->_tpl_vars['issue']['iss_duplicated_iss_id']; ?>
" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> #<?php echo $this->_tpl_vars['issue']['iss_duplicated_iss_id']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['duplicated_issue']['current_status'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
) - <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['duplicated_issue']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="<?php if ($this->_tpl_vars['issue']['duplicated_issue']['is_closed']): ?>closed_<?php endif; ?>link">#<?php echo $this->_tpl_vars['issue']['iss_duplicated_iss_id']; ?>
</a>
            <?php endif; ?>
            <?php if (count($this->_tpl_vars['issue']['duplicates_details']) > 0): ?>
              <?php if ($this->_tpl_vars['issue']['iss_duplicated_iss_id']): ?><br /><?php endif; ?>
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Duplicated by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['issue']['duplicates_details']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <?php echo '<a href="'; ?><?php echo $this->_tpl_vars['rel_url']; ?><?php echo 'view.php?id='; ?><?php echo $this->_tpl_vars['issue']['duplicates_details'][$this->_sections['i']['index']]['issue_id']; ?><?php echo '" title="'; ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'issue'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ' #'; ?><?php echo $this->_tpl_vars['issue']['duplicates_details'][$this->_sections['i']['index']]['issue_id']; ?><?php echo ' ('; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['duplicates_details'][$this->_sections['i']['index']]['current_status'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?><?php echo ') - '; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['duplicates_details'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?><?php echo '" class="'; ?><?php if ($this->_tpl_vars['issue']['duplicates_details'][$this->_sections['i']['index']]['is_closed']): ?><?php echo 'closed_'; ?><?php endif; ?><?php echo 'link">#'; ?><?php echo $this->_tpl_vars['issue']['duplicates_details'][$this->_sections['i']['index']]['issue_id']; ?><?php echo '</a>'; ?><?php if (! $this->_sections['i']['last']): ?><?php echo ', '; ?><?php endif; ?><?php echo ''; ?>

              <?php endfor; endif; ?>
            <?php endif; ?>
          </td>
          <?php endif; ?>
        </tr>
        <tr>
          <td <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer'] && count($this->_tpl_vars['groups']) > 0): ?>rowspan="2"<?php endif; ?> width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" <?php if ($this->_tpl_vars['current_role'] <= $this->_tpl_vars['roles']['customer']): ?>colspan="3" <?php elseif (count($this->_tpl_vars['groups']) > 0): ?>rowspan="2"<?php endif; ?> bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['assignments']; ?>

          </td>
          <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" valign="top" class="default_white" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Authorized Repliers<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="50%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" valign="top" class="default">
            <?php if (count($this->_tpl_vars['issue']['authorized_repliers']['users']) > 0): ?>
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Staff<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
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
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Other<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
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
          <?php endif; ?>
        </tr>
                <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer'] && count($this->_tpl_vars['groups']) > 0): ?>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td colspan="3" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php echo $this->_tpl_vars['issue']['group']['grp_name']; ?>

          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b><img src="images/blank.gif" height="1" width="150">
          </td>
          <td colspan="3" bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
" class="default">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['iss_summary'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-left: 1;padding-right: 1;padding-top:0">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0" style="border-collapse: separate; border-spacing: 1px 0px;">
        <tr>
          <td align="left" valign="top" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" width="150">
            <center class="default_white">
            <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
            [ <a id="description_link" class="white_link" href="javascript:void(null);" onClick="javascript:toggleVisibility('description');collapseDescription();"><?php echo smarty_function_get_innerhtml(array('element_name' => 'description'), $this);?>
</a> ]
            <?php endif; ?>
            </center>
            <span class="default_white"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Initial Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b></span><br />
            <span class="small_default_white">(<a class="white_link" href="javascript:void(null);" onClick="javascript:displayFixedWidth('issue_description');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>fixed width font<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)</span><br />
            <img src="images/blank.gif" height="1" width="150">
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
" id="issue_description" class="default">
            <span id="description1" <?php echo smarty_function_get_display_style(array('element_name' => 'description'), $this);?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['issue']['iss_description'])) ? $this->_run_mod_handler('activateLinks', true, $_tmp, 'link') : Link_Filter::activateLinks($_tmp, 'link')); ?>
</span>
            <span id="description_hidden" style="display: none"><i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description is currently collapsed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <a class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('description');collapseDescription();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click to expand.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></i></span>
            <?php echo '
            <script type="text/javascript">
            collapseDescription();
            </script>
            '; ?>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-left: 1;padding-right: 1;padding-top: 0;padding-bottom: 1">
    <tr>
      <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0" style="padding-top: 0px">
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>
        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <td colspan="4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
                <td nowrap>
                  <?php if ($this->_tpl_vars['is_user_assigned'] == 1): ?>
                  <?php if ($this->_tpl_vars['allow_unassigned_issues'] == 'yes' || count($this->_tpl_vars['issue']['assigned_users']) > 1): ?>
                  <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unassign Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:unassign(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">&nbsp;
                  <?php endif; ?>
                  <?php else: ?>
                  <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assign Issue To Myself<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:selfAssign(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">&nbsp;
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <td width="100%" align="center">
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['roles']['standard_user'] && $this->_tpl_vars['app_setup']['support_email'] == 'enabled' && $this->_tpl_vars['ema_id'] != ''): ?>
                  &nbsp;<input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reply<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:replyIssue(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">
                  <?php endif; ?>
                </td>
                <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
                <td nowrap>
                  <nobr>
                  <?php if (! $this->_tpl_vars['issue']['sta_is_closed']): ?>
                    <?php if ($this->_tpl_vars['issue']['duplicates'] == ''): ?>
                      <?php if ($this->_tpl_vars['issue']['iss_duplicated_iss_id']): ?>
                      <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear Duplicate Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:clearDuplicateStatus(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">
                      <?php else: ?>
                      <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mark as Duplicate<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:window.location.href='duplicate.php?id=<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
';">
                      <?php endif; ?>
                    <?php endif; ?>
                    <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:window.location.href='close.php?id=<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
';">
                  <?php endif; ?>
                  </nobr>
                </td>
                <?php endif; ?>
              </tr>
            </table>
          </td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
        <tr bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
">
          <td colspan="4" align="right">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="50%">
                  <?php if ($this->_tpl_vars['is_user_authorized'] != 1): ?>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Signup as Authorized Replier<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onClick="javascript:signupAsAuthorizedReplier(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">
                  <?php endif; ?>
                  <?php if ($this->_tpl_vars['issue']['customer_info']['is_per_incident']): ?>
                    <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Incident Redemption<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onClick="javascript:editIncidentRedemption(<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
);">
                  <?php endif; ?>
                </td>
                <td width="50%" align="right">
                  <?php if ($this->_tpl_vars['statuses'] != ''): ?>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change Status To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &gt;" class="button" onClick="javascript:changeIssueStatus(this.form, '<?php echo $this->_tpl_vars['issue']['iss_id']; ?>
', '<?php echo $this->_tpl_vars['issue']['iss_sta_id']; ?>
');">
                  <select class="default" name="new_status">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuses'],'selected' => $this->_tpl_vars['issue']['iss_sta_id']), $this);?>

                  </select>
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
</form>
</table>
