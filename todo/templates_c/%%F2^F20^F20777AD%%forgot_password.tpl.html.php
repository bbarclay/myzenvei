<?php /* Smarty version 2.6.18, created on 2010-08-09 00:56:03
         compiled from forgot_password.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'forgot_password.tpl.html', 10, false),array('modifier', 'default', 'forgot_password.tpl.html', 60, false),array('modifier', 'escape', 'forgot_password.tpl.html', 60, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('extra_title' => 'Request a Password')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br /><br />
<?php echo '
<script type="text/javascript">
<!--
function validateForm(f)
{
    if (isWhitespace(f.email.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter your account email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'email\');
        return false;
    }
    return true;
}
//-->
</script>
'; ?>

<?php if (! $this->_tpl_vars['result']): ?>
<?php ob_start(); ?>
<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note: Please enter your email address below and a new random password will be created and assigned to your account. For security purposes a confirmation message will be sent to your email address and after confirming it the new password will be then activated and sent to you.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('note_message', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "yellow_note.tpl.html", 'smarty_include_vars' => array('content' => $this->_tpl_vars['note_message'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<br />
<form name="email_form" onSubmit="javascript:return validateForm(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
<input type="hidden" name="cat" value="reset_password">
<table align="center" width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#000000">
  <tr>
    <td>
      <table bgcolor="#006486" width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td colspan="2" align="center">
            <h2 style="color: white;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Request a Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
            <hr size="1" noshade color="white">
          </td>
        </tr>
        <?php if ($this->_tpl_vars['result'] != 0): ?>
        <tr>
          <td colspan="2" align="center" class="error">
            <b>
            <?php if ($this->_tpl_vars['result'] == -1): ?>
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Error: An error occurred while trying to run your query.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php elseif ($this->_tpl_vars['result'] == 1): ?>
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, a confirmation message was just emailed to you. Please follow the instructions available in this message to confirm your password creation request.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php elseif ($this->_tpl_vars['result'] == 3): ?>
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Error: Your user status is currently set as inactive. Please contact your local system administrator for further information.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php elseif ($this->_tpl_vars['result'] == 4): ?>
             <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Error: Please provide your email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php elseif ($this->_tpl_vars['result'] == 5): ?>
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Error: No user account was found matching the entered email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php endif; ?>
            </b>
          </td>
        </tr>
        <?php else: ?>
        <tr>
          <td align="right" width="40%" class="default_white"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
          <td width="60%">
            <input accessKey="e" class="default" type="text" name="email" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['email'])) ? $this->_run_mod_handler('default', true, $_tmp, @$_GET['email']) : smarty_modifier_default($_tmp, @$_GET['email'])))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="30" maxlength="100">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'email')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr align="center">
          <td colspan="2">
            <input type="submit" name="Submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send New Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button">
          </td>
        </tr>
        <?php endif; ?>
        <tr align="center">
          <td colspan="2" class="default_white">
            <a class="white_link" href="index.php"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Login Form<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php echo '
<script type="text/javascript">
<!--
window.onload = setFocus;
function setFocus()
{
    if (document.email_form.email) {
        document.email_form.email.focus();
    }
}
//-->
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>