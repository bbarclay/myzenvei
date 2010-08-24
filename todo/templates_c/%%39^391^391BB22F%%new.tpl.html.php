<?php /* Smarty version 2.6.18, created on 2010-07-29 16:16:01
         compiled from new.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'new.tpl.html', 9, false),array('modifier', 'count', 'new.tpl.html', 24, false),array('modifier', 'escape', 'new.tpl.html', 293, false),array('function', 'html_options', 'new.tpl.html', 207, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['error_msg'] == 1): ?>
    <table align="center" width="80%">
        <tr>
            <td>
                <div style="font-size: 24; color: red; border: thin solid Red;" align="center">
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There was an error creating your issue.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </div>
            </td>
        </tr>
    </table>
    <br />
<?php endif; ?>

<?php if ($this->_tpl_vars['new_issue_id'] != "" && $_POST['report_stays'] != 'yes'): ?>
<table width="500" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td class="default">
            <?php if (count($this->_tpl_vars['errors']) == 0): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the new issue was created successfully. Please choose from one of the options below<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
            <?php else: ?>
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the new issue was created successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <br />
                <span style="color: red"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>However, the following errors were encountered:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <ul>
                <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['errors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['errors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['error']):
        $this->_foreach['errors']['iteration']++;
?>
                    <li><?php echo $this->_tpl_vars['error']; ?>
</li>
                <?php endforeach; endif; unset($_from); ?>
                </ul>
                </span>
                <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose from one of the options below:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php endif; ?>
            <ul>
              <li><a href="view.php?id=<?php echo $this->_tpl_vars['new_issue_id']; ?>
" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open the Issue Details Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
              <li><a href="list.php" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open the Issue Listing Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
              <?php if ($this->_tpl_vars['app_setup']['support_email'] == 'enabled' && $this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
              <li><a href="emails.php" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open the Emails Listing Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
              <?php endif; ?>
              <li><a href="new.php" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Report a New Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
            </ul>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Otherwise, you will be automatically redirected to the Issue Details Page in 5 seconds.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['quarantine_status'] > 0): ?>
        <tr>
            <td align="center" class="default" colspan="2">
                <br />
                <b><span style="color: red"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Warning: your issue is currently quarantined.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
                <?php $this->_tag_stack[] = array('t', array('1' => "faq.php",'escape' => false)); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please see the <a href="%1">FAQ</a> for information regarding quarantined issues.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </b>
                <br /><br />
                </span>
            </td>
        </tr>
        <?php endif; ?>
      </table>
    </td>
  </tr>
</table>
<?php echo '
<script type="text/javascript">
<!--
setTimeout(\'openDetailPage()\', 5000);
function openDetailPage()
{
'; ?>

    window.location.href = 'view.php?id=<?php echo $this->_tpl_vars['new_issue_id']; ?>
';
<?php echo '
}
//-->
</script>
'; ?>

<?php else: ?>
<?php echo '
<script type="text/javascript">
<!--
function validateForm(f)
{
'; ?>

    // disable the main submit button to avoid double-clicks
    f.main_submit_button.disabled = true;

    <?php if (count($this->_tpl_vars['cats']) > 0 && $this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['category']): ?>
    <?php echo '
    if (hasSelected(f.category, -1)) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'category\');
    }
    '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['priority']): ?>
    <?php echo '
    if (hasSelected(f.priority, -1)) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'priority\');
    }
    '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['allow_unassigned_issues'] != 'yes' && $this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['assignment']): ?>
    <?php echo '
    if (!hasOneSelected(f, \'users[]\')) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'users[]\');
    }
    '; ?>

    <?php endif; ?>
    <?php echo '
    if (isWhitespace(f.summary.value)) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'summary\');
    }

    // replace special characters in description
    replaceSpecialCharacters(f.description);

    if (isWhitespace(f.description.value)) {
        errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Initial Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'description\');
    }
    '; ?>

    <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['estimated_dev_time']): ?>
    <?php echo '
    if (!isWhitespace(f.estimated_dev_time.value)) {
        if (!isFloat(f.estimated_dev_time.value)) {
            errors[errors.length] = new Option(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Estimated Dev. Time (only numbers)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', \'estimated_dev_time\');
        }
    }
    '; ?>

    <?php endif; ?>
    <?php echo '
    checkCustomFields(f);

    // check customer fields (if function exists
    if (window.validateCustomer) {
        validateCustomer(f);
    }
    if (errors.length > 0 || errors_extra.length > 0) {
        f.main_submit_button.disabled = false;
    }
}
//-->
</script>
'; ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/dynamic_custom_field.js.php?form_type=report_form"></script>
<?php if ($this->_tpl_vars['message'] != ''): ?>
<table align="center" border="0" cellspacing="0" cellpadding="1" bgcolor="red">
  <tr>
    <td>
        <table align="center" width="500" bgcolor="#FFFFFF">
            <tr>
                <td class="default" align="center">
                    <?php echo $this->_tpl_vars['message']; ?>

                </td>
            </tr>
        </table>
    </td>
  </tr>
</table>
<br />
<?php endif; ?>

<form id="report_form" name="report_form" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post" enctype="multipart/form-data" onSubmit="javascript:return checkFormSubmission(this, 'validateForm');">
<input type="hidden" name="cat" value="report">
<input type="hidden" name="prj_id" value="<?php echo $this->_tpl_vars['current_project']; ?>
">
<input type="hidden" name="customer" value="<?php echo $this->_tpl_vars['customer_id']; ?>
" id="customer_id">
<input type="hidden" name="contact" value="<?php echo $this->_tpl_vars['contact_id']; ?>
">
<input type="hidden" name="attached_emails" value="<?php echo $this->_tpl_vars['attached_emails']; ?>
">
<?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['field_display_settings']['assignment']): ?>
    <input type="hidden" name="assignment[]" value="">
<?php endif; ?>
<?php if (count($this->_tpl_vars['releases']) < 1 || $this->_tpl_vars['current_role'] < $this->_tpl_vars['field_display_settings']['release']): ?>
        <input type="hidden" name="release" value="">
<?php endif; ?>
<?php if (count($this->_tpl_vars['cats']) < 1 || $this->_tpl_vars['current_role'] < $this->_tpl_vars['field_display_settings']['category']): ?>
    <input type="hidden" name="category" value="">
<?php endif; ?>
<?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['field_display_settings']['priority']): ?>
    <input type="hidden" name="priority" value="">
<?php endif; ?>
<?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['field_display_settings']['estimated_dev_time']): ?>
    <input type="hidden" name="estimated_dev_time" value="">
<?php endif; ?>
<?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['field_display_settings']['private']): ?>
    <input type="hidden" name="private" value="0">
<?php endif; ?>
<table width="80%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
<?php $this->assign('tabindex', 1); ?>
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create New Issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td align="right" class="default">
            (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Current Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['current_project_name']; ?>
)
          </td>
        </tr>
        <?php if (count($this->_tpl_vars['cats']) > 0 && $this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['category']): ?>
        <tr>
          <td width="150" bgcolor="<?php if ($this->_tpl_vars['field_display_settings']['category'] > $this->_tpl_vars['roles']['customer']): ?><?php echo $this->_tpl_vars['internal_color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['cell_color']; ?>
<?php endif; ?>" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_category')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <select id="category" name="category" class="default" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
              <option value="-1"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose a category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cats'],'selected' => $_POST['category']), $this);?>

            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'category')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['priority']): ?>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_priority')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                        <?php if ($_POST['priority'] != '' && $this->_tpl_vars['new_issue_id'] == ''): ?>
              <?php $this->assign('priority', $_POST['priority']); ?>
            <?php else: ?>
              <?php $this->assign('priority', 3); ?>
            <?php endif; ?>
            <select id="priority" name="priority" class="default" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
              <option value="-1"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose a priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['priorities'],'selected' => $this->_tpl_vars['priority']), $this);?>

            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'priority')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['assignment']): ?>
        <tr>
          <td width="150" bgcolor="<?php if ($this->_tpl_vars['field_display_settings']['assignment'] > $this->_tpl_vars['roles']['customer']): ?><?php echo $this->_tpl_vars['internal_color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['cell_color']; ?>
<?php endif; ?>" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php if ($this->_tpl_vars['allow_unassigned_issues'] != 'yes'): ?>*<?php endif; ?></b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_assignment')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['new_issue_id'] == ''): ?>
                <?php $this->assign('selected_users', $_POST['users']); ?>
            <?php endif; ?>
            <select id="assignment" name="users[]" multiple size="3" class="default" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users'],'selected' => $this->_tpl_vars['selected_users']), $this);?>

            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "users[]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <script type="text/javascript">selectOnlyValidOption(document.forms['report_form'].elements['users[]']);</script>
          </td>
        </tr>
        <?php endif; ?>
        <?php if (count($this->_tpl_vars['groups']) > 0 && $this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['group']): ?>
        <tr>
          <td width="150" bgcolor="<?php if ($this->_tpl_vars['field_display_settings']['assignment'] > $this->_tpl_vars['roles']['customer']): ?><?php echo $this->_tpl_vars['internal_color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['cell_color']; ?>
<?php endif; ?>" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: </b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['new_issue_id'] == ''): ?>
                <?php $this->assign('selected_group', $_POST['group']); ?>
            <?php endif; ?>
            <select class="default" name="group" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groups'],'selected' => $this->_tpl_vars['selected_group']), $this);?>

            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'group')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php endif; ?>
        <?php if (count($this->_tpl_vars['releases']) > 0 && $this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['release']): ?>
        <tr>
          <td width="150" bgcolor="<?php if ($this->_tpl_vars['field_display_settings']['release'] > $this->_tpl_vars['roles']['customer']): ?><?php echo $this->_tpl_vars['internal_color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['cell_color']; ?>
<?php endif; ?>" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Scheduled Release<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_release')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['new_issue_id'] == ''): ?>
                <?php $this->assign('selected_release', $_POST['release']); ?>
            <?php endif; ?>
            <select name="release" class="default" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
              <option value="0"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>un-scheduled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['releases'],'selected' => $this->_tpl_vars['selected_release']), $this);?>

            </select>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_summary')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['new_issue_id'] != ''): ?>
                <?php $this->assign('issue_summary', ''); ?>
            <?php elseif ($this->_tpl_vars['issue_summary'] == ''): ?>
                <?php $this->assign('issue_summary', $_REQUEST['summary']); ?>
            <?php endif; ?>
            <input type="text" name="summary" class="default" size="50" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['issue_summary'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'summary')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Initial Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_description')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['new_issue_id'] != ''): ?>
                <?php $this->assign('issue_description', ''); ?>
            <?php elseif ($this->_tpl_vars['issue_description'] == ''): ?>
                <?php $this->assign('issue_description', $_POST['description']); ?>
            <?php endif; ?>
            <textarea name="description" rows="10" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
" style="width: 97%"><?php echo $this->_tpl_vars['issue_description']; ?>
</textarea>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'description')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['estimated_dev_time']): ?>
        <tr>
          <td width="150" bgcolor="<?php if ($this->_tpl_vars['field_display_settings']['estimated_dev_time'] > $this->_tpl_vars['roles']['customer']): ?><?php echo $this->_tpl_vars['internal_color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['cell_color']; ?>
<?php endif; ?>" class="default_white">
            <nobr><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Estimated Dev. Time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'report_estimated_dev_time')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;</nobr>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <?php if ($this->_tpl_vars['new_issue_id'] == ''): ?>
                <?php $this->assign('estimated_dev_time', $_POST['estimated_dev_time']); ?>
            <?php endif; ?>
            <input type="text" name="estimated_dev_time" class="default" size="10" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
" value="<?php echo $this->_tpl_vars['estimated_dev_time']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'estimated_dev_time')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <span class="default">(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</span>
          </td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['private']): ?>
        <tr>
          <td width="150" bgcolor="<?php if ($this->_tpl_vars['field_display_settings']['private'] > $this->_tpl_vars['roles']['customer']): ?><?php echo $this->_tpl_vars['internal_color']; ?>
<?php else: ?><?php echo $this->_tpl_vars['cell_color']; ?>
<?php endif; ?>" class="default_white">
            <nobr><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Private<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b> &nbsp;</nobr>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <input type="radio" name="private" value="1" <?php if ($_POST['private']): ?>checked<?php endif; ?> tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('report_form', 'private', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <input type="radio" name="private" value="0" <?php if (! $_POST['private']): ?>checked<?php endif; ?> tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('report_form', 'private', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'private')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php endif; ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "edit_custom_fields.tpl.html", 'smarty_include_vars' => array('custom_fields' => $this->_tpl_vars['custom_fields'],'form_type' => 'report')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $this->assign('tabindex', $this->_tpl_vars['tabindex']+50); ?>
        <?php if ($this->_tpl_vars['has_customer_integration']): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "customer/".($this->_tpl_vars['customer_backend_name'])."/report_form_fields.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                <?php $this->assign('tabindex', $this->_tpl_vars['tabindex']+30); ?>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['field_display_settings']['file']): ?>
        <tr>
          <td colspan="2" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
        </tr>
        <tr>
          <td width="150" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <table width="100%" cellpadding="2" cellspacing="0" id="file_table">
              <tr>
                <td>
                  <input id="file[]_1" type="file" name="file[]" size="40" class="shortcut" onChange="javascript:addFileRow('file_table', 'file[]');">
                </td>
              </tr>
            </table>
            <span class="small_default"><i><?php $this->_tag_stack[] = array('t', array('1' => $this->_tpl_vars['max_attachment_size'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note: The current maximum allowed upload file size is %1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i></span>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td width="30%" nowrap class="default_white">
                  <nobr>
                  <input type="checkbox" name="report_stays" value="yes" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
" <?php if ($_POST['report_stays'] == 'yes'): ?>CHECKED<?php endif; ?>> <b><a id="white_link" class="white_link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('report_form', 'report_stays');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Keep form open to report another issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></b>
                  </nobr>
                </td>
                <td width="40%" align="center">
                  <input name="main_submit_button" class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">&nbsp;&nbsp;
                  <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" tabindex="<?php echo $this->_tpl_vars['tabindex']++; ?>
">
                </td>
                <td width="30%" nowrap class="default_white">
                  &nbsp;
                </td>
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

<?php if ($this->_tpl_vars['emails'] != ""): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "attached_emails.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
</form>

<?php echo '
<script type="text/javascript">
<!--
window.onload = setFocus;
function setFocus()
{
    var f = getForm(\'report_form\');
    var field = getFormElement(f, \'category\');
    if ((field != null) && (field.type != \'hidden\') && (field.options.length > 1)) {
        field.focus();
    } else {
        var field = getFormElement(f, \'priority\');
        if ((field != null) && (field.type != \'hidden\')) {
            field.focus();
        } else {
            var field = getFormElement(f, \'summary\');
            field.focus();
        }
    }
}
//-->
</script>
'; ?>

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