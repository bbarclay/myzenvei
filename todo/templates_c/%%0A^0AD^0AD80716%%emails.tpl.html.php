<?php /* Smarty version 2.6.18, created on 2010-08-07 16:02:23
         compiled from emails.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'emails.tpl.html', 1, false),array('function', 'math', 'emails.tpl.html', 159, false),array('modifier', 'escape', 'emails.tpl.html', 196, false),array('modifier', 'replace', 'emails.tpl.html', 201, false),array('modifier', 'default', 'emails.tpl.html', 211, false),)), $this); ?>
<?php ob_start(); ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Associate Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('extra_title', ob_get_contents());ob_end_clean(); ?>
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

<?php if ($this->_tpl_vars['app_setup']['support_email'] != 'enabled'): ?>
  <table width="300" align="center">
    <tr>
      <td>
        &nbsp;<span class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sorry, but this feature has been disabled by the administrator.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
        <br /><br />
        &nbsp;<a class="link" href="javascript:history.go(-1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
        <br /><br />
      </td>
    </tr>
  </table>
<?php elseif ($this->_tpl_vars['no_access'] == 1): ?>
  <table width="300" align="center">
    <tr>
      <td>
        &nbsp;<span class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sorry, but you do not have access to this page.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
        <br /><br />
        &nbsp;<a class="link" href="javascript:history.go(-1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
        <br /><br />
      </td>
    </tr>
  </table>
<?php else: ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "email_filter_form.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/overlib_mini.js?c=d23a"></script>
<script type="text/javascript">
<!--
var page_url = '<?php echo $_SERVER['PHP_SELF']; ?>
';
var current_page = <?php echo $this->_tpl_vars['list_info']['current_page']; ?>
;
var last_page = <?php echo $this->_tpl_vars['list_info']['last_page']; ?>
;
<?php echo '
function viewEmail(account_id, email_id)
{
    var features = \'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var emailWin = window.open(\'view_email.php?cat=list_emails&ema_id=\' + account_id + \'&id=\' + email_id, \'_email_\' + email_id, features);
    emailWin.focus();
}
function goPage(f, new_page)
{
    if ((new_page > last_page+1) || (new_page <= 0) ||
            (new_page == current_page+1) || (!isNumberOnly(new_page))) {
        f.page.value = current_page+1;
        return false;
    }
    setPage(new_page-1);
}
function setPage(new_page)
{
    if ((new_page > last_page) || (new_page < 0) ||
            (new_page == current_page)) {
        return false;
    }
    window.location.href = page_url + "?" + replaceParam(window.location.href, \'pagerRow\', new_page);
}
function hideAssociated(f)
{
    if (f.hide_associated.checked) {
        window.location.href = page_url + "?" + replaceParam(window.location.href, \'hide_associated\', \'1\');
    } else {
        window.location.href = page_url + "?" + replaceParam(window.location.href, \'hide_associated\', \'0\');
    }
}
function resizePager(f)
{
    var pagesize = f.page_size.options[f.page_size.selectedIndex].value;
    window.location.href = page_url + "?" + replaceParam(window.location.href, \'rows\', pagesize);
}
window.onload = disableFields;
function disableFields()
{
    var f = document.email_list_form;
    if (current_page == 0) {
        f.first.disabled = true;
        f.previous.disabled = true;
    }
    if (current_page == last_page) {
        f.next.disabled = true;
        f.last.disabled = true;
    }
    if ((current_page == 0) && (current_page == last_page)) {
        f.page.disabled = true;
        f.go.disabled = true;
    }
}
function openRemovedList()
{
    var features = \'width=560,height=460,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var removedEmailWin = window.open(\'removed_emails.php\', \'_removedEmail\', features);
    removedEmailWin.focus();
}
function associateEmails(f)
{
    if (!hasOneChecked(f, \'item[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose which emails need to be associated.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (f.issue.options[f.issue.selectedIndex].value == \'new\') {
        f.target = \'\';
        f.action = \'new.php\';
    } else {
        var issue_id = jQuery(\'#issue_id\').fieldValue();
        if (issue_id == \'\') {
            alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter an issue to associate these emails with.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
            return false;
        }
        var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var window_name = \'_associateEmail_\' + issue_id;
        f.target = window_name;
        var popupWin = window.open(\'\', window_name, features);
        popupWin.focus();
    }
    f.submit();
}
function removeEmails(f)
{
    if (!hasOneChecked(f, \'item[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose which emails need to be marked as deleted.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will mark the selected email messages as deleted.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    } else {
        var features = \'width=420,height=400,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var popupWin = window.open(\'\', \'_popup\', features);
        f.cat.value = \'remove_email\';
        f.method = \'post\';
        f.action = \'popup.php\';
        f.submit();
        popupWin.focus();
    }
}
function toggleIssueField()
{
    var new_existing = jQuery(\'#new_existing\');
    var issue_field_span = jQuery(\'#issue_id\').parent();
    if (new_existing.fieldValue() == \'new\') {
        issue_field_span.hide();
    } else {
        issue_field_span.show();
    }
}
jQuery(function() { toggleIssueField(); });
//-->
</script>
'; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<form name="email_list_form" target="_popup" method="get" action="associate.php">
<input type="hidden" name="cat" value="associate">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="<?php if ($this->_tpl_vars['has_customer_integration']): ?>7<?php else: ?>6<?php endif; ?>" class="default">
            <?php echo smarty_function_math(array('equation' => "x + 1",'x' => $this->_tpl_vars['list_info']['start_offset'],'assign' => 'start_offset_plus_one'), $this);?>

            <b><?php $this->_tag_stack[] = array('t', array('count' => $this->_tpl_vars['list_info']['end_offset'],'1' => $this->_tpl_vars['list_info']['total_rows'],'2' => $this->_tpl_vars['start_offset_plus_one'],'3' => $this->_tpl_vars['list_info']['end_offset'],'plural' => "Viewing Emails (%1 emails found, %2 - %3 shown)")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Viewing Emails (%1 email found)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'support_emails')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <td width="1%"><?php if ($this->_tpl_vars['list']): ?><input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');"><?php endif; ?></td>
          <td align="center" class="default_white">
            <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by sender<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_from']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sender<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php if ($this->_tpl_vars['sorting']['images']['sup_from'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by sender<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_from']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['sup_from']; ?>
"></a><?php endif; ?>
          </td>
          <?php if ($this->_tpl_vars['has_customer_integration']): ?>
          <td align="center" class="default_white" nowrap>
            <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_customer_id']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php if ($this->_tpl_vars['sorting']['images']['sup_customer_id'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_customer_id']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['sup_customer_id']; ?>
"></a><?php endif; ?>
          </td>
          <?php endif; ?>
          <td align="center" class="default_white">
            <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_date']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php if ($this->_tpl_vars['sorting']['images']['sup_date'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_date']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['sup_date']; ?>
"></a><?php endif; ?>
          </td>
          <td align="center" class="default_white">
            <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by recipient<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_to']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php if ($this->_tpl_vars['sorting']['images']['sup_to'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by recipient<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_to']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['sup_to']; ?>
"></a><?php endif; ?>
          </td>
          <td align="center" class="default_white" nowrap>
            <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_iss_id']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php if ($this->_tpl_vars['sorting']['images']['sup_iss_id'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_iss_id']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['sup_iss_id']; ?>
"></a><?php endif; ?>
          </td>
          <td class="default_white" width="45%">
            &nbsp;<a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by subject<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_subject']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php if ($this->_tpl_vars['sorting']['images']['sup_subject'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by subject<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['sup_subject']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['sup_subject']; ?>
"></a><?php endif; ?>
          </td>
        </tr>
        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <tr bgcolor="<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_iss_id'] != 0): ?><?php echo $this->_tpl_vars['light_color']; ?>
<?php else: ?>#99CCFF<?php endif; ?>">
          <td align="center" width="1%" class="default"><input type="checkbox" name="item[]" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_id']; ?>
" <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_iss_id'] != 0): ?>disabled<?php endif; ?>></td>
          <td class="default"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_from'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
          <?php if ($this->_tpl_vars['has_customer_integration']): ?>
          <td class="default" nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['customer_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
          <?php endif; ?>
          <td align="center" class="default" nowrap><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_date']; ?>
</td>
          <td class="default"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_to'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ' ') : smarty_modifier_replace($_tmp, ",", ' ')); ?>
</td>
          <td align="center" class="default" nowrap>
            <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_iss_id'] != 0): ?>
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>associated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view issue details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="view.php?id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_iss_id']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_iss_id']; ?>
</a>)
            <?php else: ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>pending<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php endif; ?>
          </td>
          <td class="default" width="45%">
            <?php ob_start(); ?><<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Empty Subject Header<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('default_subject', ob_get_contents());ob_end_clean(); ?>
            &nbsp;<a href="javascript:void(null);" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view email details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:viewEmail(<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_ema_id']; ?>
, <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_id']; ?>
);" class="link"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_subject'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['default_subject']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['default_subject'])))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
            <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_has_attachment']): ?>
            <a href="javascript:void(null);" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view email details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:viewEmail(<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_ema_id']; ?>
, <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sup_id']; ?>
);" class="link"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/attachment.gif" border="0"></a
            <?php endif; ?>
          </td>
        </tr>
        <?php endfor; else: ?>
        <tr bgcolor="gray">
          <td colspan="<?php if ($this->_tpl_vars['has_customer_integration']): ?>7<?php else: ?>6<?php endif; ?>" class="default_white" align="center">
            <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No emails could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
          </td>
        </tr>
        <?php endif; ?>
        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <td colspan="<?php if ($this->_tpl_vars['has_customer_integration']): ?>7<?php else: ?>6<?php endif; ?>">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="35%">
                  <?php if ($this->_tpl_vars['list']): ?>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');">
                  <select name="issue" class="default" onchange="toggleIssueField()" id="new_existing">
                    <option value="new"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option value="existing"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Existing Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/issue_field.tpl.html", 'smarty_include_vars' => array('field_name' => 'issue_id','form_name' => 'email_list_form','span_class' => 'default_white')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Associate<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &gt;" class="shortcut" onClick="javascript:associateEmails(this.form);">
                  <?php endif; ?>
                </td>
                <td width="40%" align="center">
                  <input name="first" type="button" value="|&lt;" class="shortcut" onClick="javascript:setPage(0);">
                  <input name="previous" type="button" value="&lt;&lt;" class="shortcut" onClick="javascript:setPage(<?php echo $this->_tpl_vars['list_info']['previous_page']; ?>
);">
                  <input type="text" name="page" size="3" maxlength="3" value="<?php echo smarty_function_math(array('equation' => "x + 1",'x' => $this->_tpl_vars['list_info']['current_page']), $this);?>
" style="background: <?php echo $this->_tpl_vars['cell_color']; ?>
;" class="paging_input">
                  <input name="go" type="button" value="Go" class="shortcut" onClick="javascript:goPage(this.form, this.form.page.value);">
                  <input name="next" type="button" value="&gt;&gt;" class="shortcut" onClick="javascript:setPage(<?php echo $this->_tpl_vars['list_info']['next_page']; ?>
);">
                  <input name="last" type="button" value="&gt;|" class="shortcut" onClick="javascript:setPage(<?php echo $this->_tpl_vars['list_info']['last_page']; ?>
);">
                </td>
                <td nowrap align="center">
                  <span class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rows per Page:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  <select name="page_size" class="default" onChange="javascript:resizePager(this.form);">
                    <option value="5" <?php if ($this->_tpl_vars['options']['rows'] == 5): ?>selected<?php endif; ?>>5</option>
                    <option value="10" <?php if ($this->_tpl_vars['options']['rows'] == 10): ?>selected<?php endif; ?>>10</option>
                    <option value="25" <?php if ($this->_tpl_vars['options']['rows'] == 25): ?>selected<?php endif; ?>>25</option>
                    <option value="50" <?php if ($this->_tpl_vars['options']['rows'] == 50): ?>selected<?php endif; ?>>50</option>
                    <option value="100" <?php if ($this->_tpl_vars['options']['rows'] == 100): ?>selected<?php endif; ?>>100</option>
                    <option value="ALL" <?php if ($this->_tpl_vars['options']['rows'] == 'ALL'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ALL<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:resizePager(this.form);">
                </td>
                <td width="25%" class="default_white" align="right">
                  <input type="checkbox" id="hide_associated" name="hide_associated" <?php if ($this->_tpl_vars['options']['hide_associated']): ?>checked<?php endif; ?> onClick="javascript:hideAssociated(this.form);"> <label for="hide_associated"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hide Associated Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr bgcolor="<?php echo $this->_tpl_vars['dark_color']; ?>
">
          <td colspan="<?php if ($this->_tpl_vars['has_customer_integration']): ?>7<?php else: ?>6<?php endif; ?>">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="3">
                  <?php if ($this->_tpl_vars['list']): ?>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remove Selected Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:removeEmails(this.form);">
                  <?php endif; ?>
                </td>
                <td align="right" class="default">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>list all removed emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="link" href="javascript:void(null);" onClick="javascript:openRemovedList();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List Removed Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
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