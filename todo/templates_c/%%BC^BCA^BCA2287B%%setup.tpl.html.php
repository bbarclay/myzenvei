<?php /* Smarty version 2.6.18, created on 2010-07-29 15:52:01
         compiled from setup.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'setup.tpl.html', 10, false),array('modifier', 'default', 'setup.tpl.html', 196, false),array('modifier', 'escape', 'setup.tpl.html', 374, false),array('function', 'html_options', 'setup.tpl.html', 333, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('application_title' => 'Eventum Installation')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
<!--
function validateForm(f)
{
    if (isWhitespace(f.hostname.value)) {
        selectField(f, \'hostname\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the hostname for the server of this installation of Eventum.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (isWhitespace(f.relative_url.value)) {
        selectField(f, \'relative_url\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the relative URL of this installation of Eventum.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (isWhitespace(f.db_hostname.value)) {
        selectField(f, \'db_hostname\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the database hostname for this installation of Eventum.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (isWhitespace(f.db_name.value)) {
        selectField(f, \'db_name\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the database name for this installation of Eventum.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (isWhitespace(f.db_username.value)) {
        selectField(f, \'db_username\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the database username for this installation of Eventum.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (f.alternate_user.checked) {
        if (isWhitespace(f.eventum_user.value)) {
            selectField(f, \'eventum_user\');
            alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the alternate username for this installation of Eventum.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
            return false;
        }
    }

    var field = getFormElement(f, \'setup[smtp][from]\');
    if (isWhitespace(field.value)) {
        selectField(f, \'setup[smtp][from]\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the sender address that will be used for all outgoing notification emails.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (!isEmail(field.value)) {
        selectField(f, \'setup[smtp][from]\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter a valid email address for the sender address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    field = getFormElement(f, \'setup[smtp][host]\');
    if (isWhitespace(field.value)) {
        selectField(f, \'setup[smtp][host]\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server hostname.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    field = getFormElement(f, \'setup[smtp][port]\');
    if ((isWhitespace(field.value)) || (!isNumberOnly(field.value))) {
        selectField(f, \'setup[smtp][port]\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server port number.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    var field1 = getFormElement(f, \'setup[smtp][auth]\', 0);
    var field2 = getFormElement(f, \'setup[smtp][auth]\', 1);
    if ((!field1.checked) && (!field2.checked)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please indicate whether the SMTP server requires authentication or not.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (field1.checked) {
      field = getFormElement(f, \'setup[smtp][username]\');
      if (isWhitespace(field.value)) {
          selectField(f, \'setup[smtp][username]\');
          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server username.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
          return false;
      }
      field = getFormElement(f, \'setup[smtp][password]\');
      if (isWhitespace(field.value)) {
          selectField(f, \'setup[smtp][password]\');
          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server password.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
          return false;
      }
    }
    return true;
}
function toggleAlternateUserFields()
{
    var f = getForm(\'install_form\');
    var element = getPageElement(\'alternate_user_row\');
    if (f.alternate_user.checked) {
        element.style.display = \'\';
    } else {
        element.style.display = \'none\';
    }
}

function disableAuthFields(f, bool)
{
  if (bool) {
      var bgcolor = \'#CCCCCC\';
  } else {
      var bgcolor = \'#FFFFFF\';
  }
  var field = getFormElement(f, \'setup[smtp][username]\');
  field.disabled = bool;
  field.style.backgroundColor = bgcolor;
  field = getFormElement(f, \'setup[smtp][password]\');
  field.disabled = bool;
  field.style.backgroundColor = bgcolor;
}
//-->
</script>
'; ?>


<?php if ($this->_tpl_vars['result'] != '' && $this->_tpl_vars['result'] != 'success'): ?>
<br />
<table width="400" bgcolor="#003366" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/icons/error.gif" hspace="2" vspace="2" border="0" align="left"></td>
          <td width="100%" class="default"><span style="font-weight: bold; font-size: 160%; color: red;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An Error Was Found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="default">
            <br />
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo $this->_tpl_vars['result']; ?>
</b>
            <br /><br />
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['result'] == 'success'): ?>
<br />
<table width="400" bgcolor="#003366" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td width="100%" class="default"><span style="font-weight: bold; font-size: 160%;">Success!</span></td>
        </tr>
        <tr>
          <td class="default">
            <br />
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank You, Eventum is now properly setup and ready to be used. Open the following URL to login on it for the first time:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
            <br />
            <a class="link" href="<?php if ($_POST['is_ssl'] == 'yes'): ?>https://<?php else: ?>http://<?php endif; ?><?php echo $_POST['hostname']; ?>
<?php echo $_POST['relative_url']; ?>
"><?php if ($_POST['is_ssl'] == 'yes'): ?>https://<?php else: ?>http://<?php endif; ?><?php echo $_POST['hostname']; ?>
<?php echo $_POST['relative_url']; ?>
</a>
            <br /><br />
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: admin@example.com <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(literally)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: admin<br />
            <br />
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>NOTE: For security reasons it is highly recommended that the default password be changed as soon as possible.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <br /><br />
            <hr size="1" noshade color="#000000">
            <?php $this->_tag_stack[] = array('t', array('1' => 'setup')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remember to protect your '%1' directory (like changing its permissions) to prevent anyone else from changing your existing Eventum configuration.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <br /><br />
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In order to check if your permissions are setup correctly visit the<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a class="link" href="check_permissions.php"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Check Permissions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
            <?php if (! $this->_tpl_vars['is_imap_enabled']): ?>
            <br /><br />
            <hr size="1" noshade color="#000000">
            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>WARNING: If you want to use the email integration features to download messages saved on a IMAP/POP3 server, you will need to enable the IMAP extension in your PHP.INI configuration file. See the PHP manual for more details.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php endif; ?>
            </b>
            <br /><br />
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php else: ?>
<br />
<table width="600" bgcolor="#000000" border="0" cellspacing="0" cellpadding="1" align="center">
<form name="install_form" action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post" onSubmit="javascript:return validateForm(this);">
<input type="hidden" name="cat" value="install">
  <tr>
    <td>
      <table bgcolor="#CCCCCC" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="2" align="center">
            <h1><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Eventum Installation<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
            <hr size="1" noshade color="#000000">
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Server Hostname<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td>
            <?php $this->assign('tabindex', '1'); ?>
            <input type="text" name="hostname" value="<?php echo ((is_array($_tmp=@$_POST['hostname'])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SERVER['HTTP_HOST']) : smarty_modifier_default($_tmp, @$_SERVER['HTTP_HOST'])); ?>
" class="default" size="30" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'hostname')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <input type="checkbox" name="is_ssl" value="yes" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php if ($this->_tpl_vars['ssl_mode'] == 'enabled'): ?>checked<?php endif; ?>> <span class="default"><b><a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('install_form', 'is_ssl');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SSL Server<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></b></span>
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Eventum Relative URL<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td>
            <input type="text" name="relative_url" value="<?php echo ((is_array($_tmp=@$_POST['rel_url'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['rel_url']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['rel_url'])); ?>
" class="default" size="30" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'relative_url')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <nobr>&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>MySQL Server Hostname<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b></nobr>
          </td>
          <td>
            <input type="text" name="db_hostname" class="default" size="30" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" value="<?php echo $_POST['db_hostname']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'db_hostname')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>MySQL Database<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td>
            <input type="text" name="db_name" class="default" size="30" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" value="<?php echo $_POST['db_name']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'db_name')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <input type="checkbox" name="create_db" value="yes" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php if ($_POST['create_db'] == 'yes'): ?>checked<?php endif; ?>> <span class="default"><b><a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('install_form', 'create_db');">Create Database</a></b></span>
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>MySQL Table Prefix<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td>
            <input type="text" name="db_table_prefix" value="<?php echo ((is_array($_tmp=@$_POST['db_table_prefix'])) ? $this->_run_mod_handler('default', true, $_tmp, 'eventum_') : smarty_modifier_default($_tmp, 'eventum_')); ?>
" class="default" size="30" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="default" align="center">
            <input type="checkbox" name="drop_tables" value="yes" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php if ($_POST['drop_tables'] == 'yes'): ?>checked<?php endif; ?>> <b><a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('install_form', 'drop_tables');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Drop Tables If They Already Exist<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></b>
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>MySQL Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td>
            <input type="text" name="db_username" class="default" size="20" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" value="<?php echo $_POST['db_username']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'db_username')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <span class="small_default"><i>(<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This user requires permission to create and drop tables in the specified database.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br /><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This value is used only for these installation procedures, and is not saved if you provide a separate user below.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span>
          </td>
        </tr>
        <tr>
          <td width="180" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>MySQL Password:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td>
            <input type="password" name="db_password" class="default" size="20" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" value="<?php echo $_POST['db_password']; ?>
">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="default" align="center">
            <input type="checkbox" name="alternate_user" value="yes" onClick="javascript:toggleAlternateUserFields();"  tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php if ($_POST['alternate_user'] == 'yes'): ?>checked<?php endif; ?>> <b><a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('install_form', 'alternate_user');toggleAlternateUserFields();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use a Separate MySQL User for Normal Eventum Use<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></b>
          </td>
        </tr>
        <tr id="alternate_user_row">
          <td colspan="2" align="center">
            <table>
              <tr>
                <td>
                  <table width="300" cellpadding="1" cellspacing="0" bgcolor="white" border="0">
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#C0C0C0">
                          <tr>
                            <td colspan="2" class="default">
                              <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter the details below:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                            </td>
                          </tr>
                          <tr>
                            <td class="default" align="right">
                              <nobr>&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>&nbsp;</nobr>
                            </td>
                            <td>
                              <nobr><input type="text" class="default" name="eventum_user" size="20" value="<?php echo $_POST['eventum_user']; ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">&nbsp;</nobr>
                              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'eventum_user')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="default" align="right">
                              <nobr>&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>&nbsp;</nobr>
                            </td>
                            <td>
                              <nobr><input type="password" class="default" name="eventum_password" size="20" value="<?php echo $_POST['eventum_password']; ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">&nbsp;</nobr>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" class="default" align="center">
                              <input type="checkbox" name="create_user" value="yes" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
" <?php if ($_POST['create_user'] == 'yes'): ?>checked<?php endif; ?>> <b><a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('install_form', 'create_user');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create User and Permissions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></b>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>


        <tr>
          <td colspan="2" class="default" align="right">
            &nbsp;
          </td>
        </tr>
        <tr>
          <td class="default" align="center" colspan="2">
            <h2><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Defaults<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></h2>
            <hr size="1" noshade color="#000000">
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right" valign="top">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Timezone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="80%">
            <select class="default" name="default_timezone">
              <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['zones'],'output' => $this->_tpl_vars['zones'],'selected' => $_POST['default_timezone']), $this);?>

            </select><br/>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lookup_field.tpl.html", 'smarty_include_vars' => array('lookup_field_name' => 'search','lookup_field_target' => 'default_timezone')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Week starts on:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="80%" class="default">
            <label><input type="radio" name="default_weekday" <?php if ($_POST['default_weekday'] != '1'): ?>checked<?php endif; ?> value="0"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sunday<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;&nbsp;
            <label><input type="radio" name="default_weekday" <?php if ($_POST['default_weekday'] == '1'): ?>checked<?php endif; ?> value="1"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Monday<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
          </td>
        </tr>
        </tr>



        <tr>
          <td colspan="2" class="default" align="right">
            &nbsp;
          </td>
        </tr>
        <tr>
          <td class="default" align="center" colspan="2">
            <h2><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SMTP Configuration<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></h2>
            <hr size="1" noshade color="#000000">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="small_default" align="center">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The SMTP (outgoing mail) configuration is needed to make sure emails are properly sent when creating new users/projects.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            &nbsp;
            <hr size="1" noshade color="#000000">
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sender<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td width="80%">
            <input type="text" class="default" name="setup[smtp][from]" size="30" value="<?php echo ((is_array($_tmp=$_REQUEST['setup']['smtp']['from'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "setup[smtp][from]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <span class="small_default"><i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>must be a valid email address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span>
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hostname<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td width="80%">
            <input type="text" class="default" name="setup[smtp][host]" size="30" value="<?php echo ((is_array($_tmp=$_REQUEST['setup']['smtp']['host'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "setup[smtp][host]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Port<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: *</b>
          </td>
          <td width="80%">
            <input type="text" class="default" name="setup[smtp][port]" size="5" value="<?php echo $_REQUEST['setup']['smtp']['port']; ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "setup[smtp][port]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Requires Authentication?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;</b>
          </td>
          <td width="80%" class="default">
            <input type="radio" name="setup[smtp][auth]" value="1" <?php if ($_REQUEST['setup']['smtp']['auth'] == 1): ?>checked<?php endif; ?> onClick="javascript:disableAuthFields(this.form, false);" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('install_form', 'setup[smtp][auth]', 0);disableAuthFields(getForm('install_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
            <input type="radio" name="setup[smtp][auth]" value="0" <?php if ($_REQUEST['setup']['smtp']['auth'] != 1): ?>checked<?php endif; ?> onClick="javascript:disableAuthFields(this.form, true);" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('install_form', 'setup[smtp][auth]', 1);disableAuthFields(getForm('install_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;</b>
          </td>
          <td width="80%">
            <input type="text" class="default" name="setup[smtp][username]" size="20" value="<?php echo ((is_array($_tmp=$_REQUEST['setup']['smtp']['username'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "setup[smtp][username]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td width="100" class="default" align="right">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;</b>
          </td>
          <td width="80%">
            <input type="password" class="default" name="setup[smtp][password]" size="20" value="<?php echo ((is_array($_tmp=$_REQUEST['setup']['smtp']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "setup[smtp][password]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#666666" align="right">
            <input style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 90%;" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Start Installation<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &gt;&gt;" tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="default">
      <b>* <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Required Fields<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
    </td>
  </tr>
</form>
</table>

<?php echo '
<script type="text/javascript">
<!--
window.onload = setFocus;
function setFocus()
{
    document.install_form.hostname.focus();
    toggleAlternateUserFields();
'; ?>

    <?php if ($_REQUEST['setup']['smtp']['auth'] != 1): ?>
    disableAuthFields(getForm('install_form'), true);
    <?php endif; ?>
<?php echo '
}
//-->
</script>
'; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>