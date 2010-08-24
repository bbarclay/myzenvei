<?php /* Smarty version 2.6.18, created on 2010-08-10 11:15:50
         compiled from preferences.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'preferences.tpl.html', 10, false),array('modifier', 'escape', 'preferences.tpl.html', 77, false),array('modifier', 'count', 'preferences.tpl.html', 170, false),array('function', 'math', 'preferences.tpl.html', 176, false),array('function', 'html_options', 'preferences.tpl.html', 193, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('extra_title' => 'Preferences')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
<!--
function validateName(f)
{
    if (isWhitespace(f.full_name.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter your full name.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'full_name\');
        return false;
    }
    return true;
}
function validateEmail(f)
{
    if (!isEmail(f.email.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter a valid email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'email\');
        return false;
    }
    return true;
}
function validatePassword(f)
{
    if ((isWhitespace(f.new_password.value)) || (f.new_password.value.length < 6)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter your new password with at least 6 characters.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'new_password\');
        return false;
    }
    if (f.new_password.value != f.confirm_password.value) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The two passwords do not match. Please review your information and try again.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'confirm_password\');
        return false;
    }
    return true;
}
function validateAccount(f)
{
    return true;
}
//-->
</script>
'; ?>

<table width="80%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td align="right">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'preferences')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
        <form name="update_name_form" onSubmit="javascript:return validateName(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
        <input type="hidden" name="cat" value="update_name">
        <?php if ($this->_tpl_vars['update_name_result']): ?>
        <tr>
          <td colspan="2" class="error" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <?php if ($this->_tpl_vars['update_name_result'] == -1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to run your query.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php elseif ($this->_tpl_vars['update_name_result'] == 1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, your full name was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Full Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input type="text" name="full_name" size="40" class="default" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['current_full_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'full_name')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Full Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          </td>
        </tr>
        </form>
        <form name="update_email_form" onSubmit="javascript:return validateEmail(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
        <input type="hidden" name="cat" value="update_email">
        <?php if ($this->_tpl_vars['update_email_result']): ?>
        <tr>
          <td colspan="2" class="error" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <?php if ($this->_tpl_vars['update_email_result'] == -1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to run your query.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php elseif ($this->_tpl_vars['update_email_result'] == 1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, your email address was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Login<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &amp; <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input type="text" name="email" size="40" class="default" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['current_email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'email')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Email Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          </td>
        </tr>
        </form>
        <?php endif; ?>
        <form name="update_password_form" onSubmit="javascript:return validatePassword(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
        <input type="hidden" name="cat" value="update_password">
        <?php if ($this->_tpl_vars['update_password_result']): ?>
        <tr>
          <td colspan="2" class="error" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <?php if ($this->_tpl_vars['update_password_result'] == -1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to run your query.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php elseif ($this->_tpl_vars['update_password_result'] == 1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, your password was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <table>
              <tr>
                <td class="default" align="right"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
                <td><input type="password" name="new_password" size="20" class="default"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'new_password')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
              </tr>
              <tr>
                <td class="default" align="right"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Confirm New Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
                <td><input type="password" name="confirm_password" size="20" class="default"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'confirm_password')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          </td>
        </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<br />
<table width="80%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <form name="account_prefs_form" onSubmit="javascript:return validateAccount(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cat" value="update_account">
        <tr>
          <td class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Account Preferences<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td align="right" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'preferences')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['update_account_result']): ?>
        <tr>
          <td colspan="<?php echo smarty_function_math(array('equation' => "2 + x",'x' => count($this->_tpl_vars['assigned_projects'])), $this);?>
" class="error" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <?php if ($this->_tpl_vars['update_account_result'] == -1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to run your query.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php elseif ($this->_tpl_vars['update_account_result'] == 1): ?>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, your account preferences were updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['avail_langs']): ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Available Languages<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <select class="default" name="language">
			  <option value="en_US">English</option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['avail_langs'],'selected' => $this->_tpl_vars['current_locale']), $this);?>

            </select>
          </td>
        </tr>
        <?php endif; ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Timezone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <select class="default" name="timezone">
              <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['zones'],'output' => $this->_tpl_vars['zones'],'selected' => $this->_tpl_vars['user_prefs']['timezone']), $this);?>

            </select>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lookup_field.tpl.html", 'smarty_include_vars' => array('lookup_field_name' => 'search','lookup_field_target' => 'timezone')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Week starts on:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <label><input type="radio" name="week_firstday" <?php if ($this->_tpl_vars['user_prefs']['week_firstday'] != '1'): ?>checked<?php endif; ?> value="0"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sunday<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;&nbsp;
            <label><input type="radio" name="week_firstday" <?php if ($this->_tpl_vars['user_prefs']['week_firstday'] == '1'): ?>checked<?php endif; ?> value="1"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Monday<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically close confirmation popup windows?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <label><input type="radio" name="close_popup_windows" <?php if ($this->_tpl_vars['user_prefs']['close_popup_windows'] == '1'): ?>checked<?php endif; ?> value="1"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;&nbsp;
            <label><input type="radio" name="close_popup_windows" <?php if ($this->_tpl_vars['user_prefs']['close_popup_windows'] != '1'): ?>checked<?php endif; ?> value="0"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
          </td>
        </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            &nbsp;
          </td>
          <?php $_from = $this->_tpl_vars['assigned_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prj_id'] => $this->_tpl_vars['project_info']):
?>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            &nbsp;<b><?php echo $this->_tpl_vars['project_info']['prj_title']; ?>
</b>
          </td>
          <?php endforeach; endif; unset($_from); ?>
        </tr>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Receive emails when all issues are created?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <?php $_from = $this->_tpl_vars['assigned_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prj_id'] => $this->_tpl_vars['project_info']):
?>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            &nbsp;<input type="radio" name="receive_new_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]" <?php if ($this->_tpl_vars['user_prefs']['receive_new_emails'][$this->_tpl_vars['prj_id']]): ?>checked<?php endif; ?> value="1"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('account_prefs_form', 'receive_new_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
            <input type="radio" name="receive_new_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]" <?php if (! $this->_tpl_vars['user_prefs']['receive_new_emails'][$this->_tpl_vars['prj_id']]): ?>checked<?php endif; ?> value="0"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('account_prefs_form', 'receive_new_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
          <?php endforeach; endif; unset($_from); ?>
        </tr>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Receive emails when new issues are assigned to you?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <?php $_from = $this->_tpl_vars['assigned_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prj_id'] => $this->_tpl_vars['project_info']):
?>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            &nbsp;<input type="radio" name="receive_assigned_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]" <?php if ($this->_tpl_vars['user_prefs']['receive_assigned_emails'][$this->_tpl_vars['prj_id']]): ?>checked<?php endif; ?> value="1"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('account_prefs_form', 'receive_assigned_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
            <input type="radio" name="receive_assigned_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]" <?php if (! $this->_tpl_vars['user_prefs']['receive_assigned_emails'][$this->_tpl_vars['prj_id']]): ?>checked<?php endif; ?> value="0"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('account_prefs_form', 'receive_assigned_emails[<?php echo $this->_tpl_vars['prj_id']; ?>
]', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
          <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php else: ?>
        <input type="hidden" name="close_popup_windows" value="0">
        <input type="hidden" name="receive_assigned_emails" value="0">
        <input type="hidden" name="receive_new_emails" value="0">
        <?php endif; ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Refresh Rate for Issue Listing Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <input type="text" size="10" class="default" name="list_refresh_rate" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_prefs']['list_refresh_rate'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <span class="small_default"><i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in minutes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Refresh Rate for Email Listing Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <input type="text" size="10" class="default" name="emails_refresh_rate" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_prefs']['emails_refresh_rate'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <span class="small_default"><i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in minutes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span>
          </td>
        </tr>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Signature<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <table border="0" width="100%">
              <tr>
                <td class="default" colspan="2">
                  <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Signature<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:<br />
                  <textarea name="signature" style="width: 97%" rows="10"><?php echo $this->_tpl_vars['user_prefs']['email_signature']; ?>
</textarea>
                </td>
              </tr>
              <tr>
                <td class="default" width="140" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload New Signature<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
                <td><input size="40" type="file" name="file_signature" class="default"></td>
              </tr>
              <tr>
                <td class="default" colspan="2">
                  <input type="checkbox" name="auto_append_sig" value="yes" <?php if ($this->_tpl_vars['user_prefs']['auto_append_sig'] == 'yes'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('account_prefs_form', 'auto_append_sig');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically append email signature when composing web based emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br />
                  <input type="checkbox" name="auto_append_note_sig" value="yes" <?php if ($this->_tpl_vars['user_prefs']['auto_append_note_sig'] == 'yes'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('account_prefs_form', 'auto_append_note_sig');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically append email signature when composing internal notes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="190" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SMS Email Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="<?php echo count($this->_tpl_vars['assigned_projects']); ?>
">
            <input type="text" size="40" class="default" name="sms_email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user_prefs']['sms_email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
            <span class="small_default"><i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>only used for automatic issue reminders<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span>
          </td>
        </tr>
        <?php else: ?>
        <input type="hidden" name="emails_refresh_rate" value="10">
        <?php endif; ?>
        <tr>
          <td colspan="<?php echo smarty_function_math(array('equation' => "2 + x",'x' => count($this->_tpl_vars['assigned_projects'])), $this);?>
" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Preferences<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          </td>
        </tr>
        </form>
      </table>
    </td>
  </tr>
</table>

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