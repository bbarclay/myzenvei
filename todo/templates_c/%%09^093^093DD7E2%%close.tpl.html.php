<?php /* Smarty version 2.6.18, created on 2010-08-10 15:04:55
         compiled from close.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'close.tpl.html', 9, false),array('modifier', 'count', 'close.tpl.html', 27, false),array('modifier', 'escape', 'close.tpl.html', 31, false),array('modifier', 'replace', 'close.tpl.html', 111, false),array('modifier', 'default', 'close.tpl.html', 182, false),array('function', 'html_options', 'close.tpl.html', 144, false),array('function', 'cycle', 'close.tpl.html', 209, false),)), $this); ?>
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

<br />
<?php if ($this->_tpl_vars['no_issue']): ?>
  <table width="400" align="center">
    <tr>
      <td>
        &nbsp;<span class="default"><b><?php $this->_tag_stack[] = array('t', array('1' => $_GET['id'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Error: The issue #%1 could not be found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</b>
        <br /><br />
        &nbsp;<a class="link" href="javascript:history.go(-1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
      </td>
    </tr>
  </table>
<?php elseif ($this->_tpl_vars['close_result'] != ""): ?>
<table width="500" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td class="default">
            <?php if ($this->_tpl_vars['close_result'] == -1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sorry, an error happened while trying to run your query<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</b>
            <?php elseif ($this->_tpl_vars['close_result'] == 1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the issue was closed successfully<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</b><br/>

            <?php if (count($this->_tpl_vars['notify_list']) > 0): ?>
            <br/>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>E-mail about issue update was sent to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b><br />
            <?php $_from = $this->_tpl_vars['notify_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['email_address']):
?>
            &nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['email_address'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<br />
            <?php endforeach; endif; unset($_from); ?>
            <br />
            <?php endif; ?>

            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose from one of the options below<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
            <ul>
              <li><a href="view.php?id=<?php echo $this->_tpl_vars['issue_id']; ?>
" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open the Issue Details Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
              <li><a href="list.php" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open the Issue Listing Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
              <?php if ($this->_tpl_vars['app_setup']['support_email'] == 'enabled' && $this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer']): ?>
              <li><a href="emails.php" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open the Emails Listing Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
              <?php endif; ?>
            </ul>
            <?php endif; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php else: ?>
<?php echo '
<script type="text/javascript">
<!--
var has_per_incident_contract = false;

function validateForm(f)
{
    if (getSelectedOption(f, \'status\') == -1) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'status\');
    }
    if (isWhitespace(f.reason.value)) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reason to close<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'reason\');
    }

    if (!isWhitespace(f.time_spent.value)) {
        if (!isNumberOnly(f.time_spent.value)) {
            errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter integers (or floating point numbers) on the time spent field.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'time_spent\');
        }
        if (f.category.options[f.category.selectedIndex].value == \'\') {
            errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time tracking category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'category\');
        }
    }

    checkCustomFields(f);

    if ((errors.length < 1) && (has_per_incident_contract)) {
        elements = getForm(\'close_form\');
        has_checked_incident = false;
        for (i = 0; i < elements.length; i++) {
            if (elements[i].name.substr(0, 6) == \'redeem\') {
                if (elements[i].checked == true) {
                    has_checked_incident = true;
                }
            }
        }
        if (has_checked_incident == false) {
            return confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This customer has a per incident contract. You have chosen not to redeem any incidents. Press \'OK\' to confirm or \'Cancel\' to revise.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        }
    }
    return true;
}

function toggleNotificationList()
{
    var f = getForm(\'close_form\');

    var cell = getPageElement(\'reason_cell\');

    if (f.notification_list[1].checked) {
        cell.style.background = "'; ?>
<?php echo $this->_tpl_vars['cell_color']; ?>
<?php echo '";
    } else {
        cell.style.background = "'; ?>
<?php echo $this->_tpl_vars['internal_color']; ?>
<?php echo '";
    }
}

var old_reason = \'\';
function setSignature(f)
{
'; ?>

    var signature = "<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['current_user_prefs']['email_signature'])) ? $this->_run_mod_handler('replace', true, $_tmp, '"', '\"') : smarty_modifier_replace($_tmp, '"', '\"')))) ? $this->_run_mod_handler('replace', true, $_tmp, "\r", "") : smarty_modifier_replace($_tmp, "\r", "")))) ? $this->_run_mod_handler('replace', true, $_tmp, "\n", '\n') : smarty_modifier_replace($_tmp, "\n", '\n')); ?>
";
<?php echo '
    if (f.add_email_signature.checked) {
        old_reason = f.reason.value;
        f.reason.value += "\\n";
        f.reason.value += signature;
    } else {
        f.reason.value = old_reason;
    }
}

//-->
</script>
'; ?>

<table width="80%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<form name="close_form" onSubmit="javascript:return checkFormSubmission(this, 'validateForm');" method="post" action="close.php">
<input type="hidden" name="cat" value="close">
<input type="hidden" name="issue_id" value="<?php echo $this->_tpl_vars['issue_id']; ?>
">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="2" class="default" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b> (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issue ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['issue_id']; ?>
)
          </td>
        </tr>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select class="default" name="status" id="status">
              <option value="-1"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose a status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statuses']), $this);?>

            </select>
            <script type="text/javascript">selectOnlyValidOption(document.forms['close_form'].elements['status']);</script>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'status')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php if (count($this->_tpl_vars['resolutions']) > 0): ?>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resolution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select class="default" name="resolution">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['resolutions']), $this);?>

            </select>
          </td>
        </tr>
        <?php else: ?>
            <input type="hidden" name="resolution" value="">
        <?php endif; ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "edit_custom_fields.tpl.html", 'smarty_include_vars' => array('custom_fields' => $this->_tpl_vars['custom_fields'],'form_type' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Notification About Issue Being Closed?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <input type="radio" name="send_notification" checked value="1">
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('close_form', 'send_notification', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
            <input type="radio" name="send_notification" value="0">
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('close_form', 'send_notification', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
        </tr>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Notification To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <input id="notification_internal" type="radio" name="notification_list" checked value="internal" onchange="toggleNotificationList()">
            <label for="notification_internal"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Internal Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo ((is_array($_tmp=@$this->_tpl_vars['notification_list_internal'])) ? $this->_run_mod_handler('default', true, $_tmp, "<i>None</i>") : smarty_modifier_default($_tmp, "<i>None</i>")); ?>
) (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Will save as a note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</label><br />
            <input id="notification_all" type="radio" name="notification_list" value="all" onchange="toggleNotificationList()">
            <label for="notification_all"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo ((is_array($_tmp=@$this->_tpl_vars['notification_list_all'])) ? $this->_run_mod_handler('default', true, $_tmp, "<i>None</i>") : smarty_modifier_default($_tmp, "<i>None</i>")); ?>
) (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Will save as email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</label>
          </td>
        </tr>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white" id="reason_cell">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reason for closing issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <textarea name="reason" rows="8" style="width: 97%"><?php if ($this->_tpl_vars['current_user_prefs']['auto_append_sig'] == 'yes'): ?>


<?php echo ((is_array($_tmp=$this->_tpl_vars['current_user_prefs']['email_signature'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?></textarea>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'reason')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php if (count($this->_tpl_vars['incident_details']) > 0): ?>
        <script type="text/javascript">
        has_per_incident_contract = true;
        </script>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Incident Types to Redeem<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <?php $_from = $this->_tpl_vars['incident_details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type_id'] => $this->_tpl_vars['type_details']):
?>
              <?php echo smarty_function_cycle(array('values' => $this->_tpl_vars['cycle'],'assign' => 'row_color'), $this);?>

              <?php if ($this->_tpl_vars['res'] == ''): ?><input type="checkbox" name="redeem[<?php echo $this->_tpl_vars['type_id']; ?>
]" value="1" <?php if ($this->_tpl_vars['redeemed'][$this->_tpl_vars['type_id']]['is_redeemed'] == 1): ?>checked<?php endif; ?>><?php endif; ?>
              <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('close_form', 'redeem[<?php echo $this->_tpl_vars['type_id']; ?>
]', 0);"><?php echo $this->_tpl_vars['type_details']['title']; ?>
 (Total: <?php echo $this->_tpl_vars['type_details']['total']; ?>
; Left: <?php echo $this->_tpl_vars['type_details']['total']-$this->_tpl_vars['type_details']['redeemed']; ?>
)</a><br />
            <?php endforeach; endif; unset($_from); ?>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time Spent<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input class="default" type="text" size="5" name="time_spent" class="default"> <span class="default">(in minutes)</span><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'time_spent')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="160" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Time Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </b><br />
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select name="category" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose a category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['time_categories']), $this);?>

            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'category')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <td colspan="2">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <tr>
                <td><input class="button" type="button" value="&lt;&lt; <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:history.go(-1);"></td>
                <td width="100%" align="center"><input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"></td>
                <?php if ($this->_tpl_vars['current_user_prefs']['email_signature'] != "" && $this->_tpl_vars['current_user_prefs']['auto_append_sig'] != 'yes'): ?>
                <td class="default_white" align="right" width="150">
                  <nobr>
                  <input type="checkbox" name="add_email_signature" value="yes" onClick="javascript:setSignature(this.form);">
                  <a id="white_link" class="white_link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('close_form', 'add_email_signature');setSignature(getForm('close_form'));">Add Email Signature</a>
                  &nbsp;&nbsp;
                  </nobr>
                </td>
                <?php endif; ?>
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
<br />

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