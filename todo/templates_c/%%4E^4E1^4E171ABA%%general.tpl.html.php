<?php /* Smarty version 2.6.18, created on 2010-07-29 16:08:00
         compiled from manage/general.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'manage/general.tpl.html', 13, false),array('modifier', 'escape', 'manage/general.tpl.html', 299, false),array('function', 'html_options', 'manage/general.tpl.html', 404, false),)), $this); ?>

      <table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr>
          <td>
            <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
              <?php echo '
              <script type="text/javascript">
              <!--
              function validateForm(f)
              {
                  var field = getFormElement(f, \'smtp[from]\');
                  if (isWhitespace(field.value)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the sender address that will be used for all outgoing notification emails.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'smtp[from]\');
                      return false;
                  }
                  field = getFormElement(f, \'smtp[host]\');
                  if (isWhitespace(field.value)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server hostname.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'smtp[host]\');
                      return false;
                  }
                  field = getFormElement(f, \'smtp[port]\');
                  if ((isWhitespace(field.value)) || (!isNumberOnly(field.value))) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server port number.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'smtp[port]\');
                      return false;
                  }
                  var field1 = getFormElement(f, \'smtp[auth]\', 0);
                  var field2 = getFormElement(f, \'smtp[auth]\', 1);
                  if ((!field1.checked) && (!field2.checked)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please indicate whether the SMTP server requires authentication or not.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if (field1.checked) {
                      field = getFormElement(f, \'smtp[username]\');
                      if (isWhitespace(field.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server username.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'smtp[username]\');
                          return false;
                      }
                      field = getFormElement(f, \'smtp[password]\');
                      if (isWhitespace(field.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the SMTP server password.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'smtp[password]\');
                          return false;
                      }
                  }
                  var field1 = getFormElement(f, \'smtp[save_outgoing_email]\', 0);
                  var field2 = getFormElement(f, \'smtp[save_address]\');
                  if ((field1.checked) && (!isEmail(field2.value))) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the email address of where copies of outgoing emails should be sent to.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'smtp[save_address]\');
                      return false;
                  }
                  if ((!f.open_signup[0].checked) && (!f.open_signup[1].checked))  {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose whether the system should allow visitors to signup for new accounts or not.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if (f.open_signup[0].checked) {
                      field = getFormElement(f, \'accounts_projects[]\');
                      if (!hasOneSelected(f, \'accounts_projects[]\')) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select the assigned projects for users that create their own accounts.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'accounts_projects[]\');
                          return false;
                      }
                  }
                  field1 = getFormElement(f, \'email_routing[status]\', 0);
                  if (field1.checked) {
                      field1 = getFormElement(f, \'email_routing[address_prefix]\');
                      if (isWhitespace(field1.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the email address prefix for the email routing interface.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'email_routing[address_prefix]\');
                          return false;
                      }
                      field1 = getFormElement(f, \'email_routing[address_host]\');
                      if (isWhitespace(field1.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the email address hostname for the email routing interface.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'email_routing[address_host]\');
                          return false;
                      }
                  }
                  if ((!f.scm_integration[0].checked) && (!f.scm_integration[1].checked))  {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose whether the SCM integration feature should be enabled or not.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if (f.scm_integration[0].checked) {
                      field = getFormElement(f, \'checkout_url\');
                      if (isWhitespace(field.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the checkout page URL for your SCM integration tool.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'checkout_url\');
                          return false;
                      }
                      field = getFormElement(f, \'diff_url\');
                      if (isWhitespace(field.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the diff page URL for your SCM integration tool.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'diff_url\');
                          return false;
                      }
                      field = getFormElement(f, \'scm_log_url\');
                      if (isWhitespace(field.value)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the log page URL for your SCM integration tool.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'scm_log_url\');
                          return false;
                      }
                  }
                  if ((!f.support_email[0].checked) && (!f.support_email[1].checked))  {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose whether the email integration feature should be enabled or not.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if ((!f.daily_tips[0].checked) && (!f.daily_tips[1].checked))  {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose whether the daily tips feature should be enabled or not.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  return true;
              }
              function disableAuthFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'smtp[username]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'smtp[password]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function checkDebugField(f)
              {
                  var field = getFormElement(f, \'smtp[save_outgoing_email]\');
                  if (field.checked) {
                      var bool = false;
                  } else {
                      var bool = true;
                  }
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  field = getFormElement(f, \'smtp[save_address]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function disableSCMFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'checkout_url\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'diff_url\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function disableSignupFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'accounts_projects[]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'accounts_role\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function disableEmailRoutingFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }

                  var field = getFormElement(f, \'email_routing[address_prefix]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'email_routing[address_host]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'email_routing[host_alias]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'email_routing[warning][status]\', 0);
                  field.disabled = bool;
                  field = getFormElement(f, \'email_routing[warning][status]\', 1);
                  field.disabled = bool;
              }
              function disableNoteRoutingFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'note_routing[address_prefix]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'note_routing[address_host]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function disableDraftRoutingFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'draft_routing[address_prefix]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
                  field = getFormElement(f, \'draft_routing[address_host]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function disableErrorEmailFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'email_error[addresses]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function disableReminderEmailFields(f, bool)
              {
                  if (bool) {
                      var bgcolor = \'#CCCCCC\';
                  } else {
                      var bgcolor = \'#FFFFFF\';
                  }
                  var field = getFormElement(f, \'email_reminder[addresses]\');
                  field.disabled = bool;
                  field.style.backgroundColor = bgcolor;
              }
              function toggleSubjectBasedRouting(f, enabled)
              {

                  var email_routing_enabled = getFormElement(f, \'email_routing[status]\', 0);
                  email_routing_enabled.disabled = enabled;
                  if ((enabled != true) && (email_routing_enabled.checked != true)) {
                      disableEmailRoutingFields(f, true);
                  } else {
                      disableEmailRoutingFields(f, enabled);
                  }
                  getFormElement(f, \'email_routing[status]\', 1).disabled = enabled;

                  var note_routing_enabled = getFormElement(f, \'note_routing[status]\', 0);
                  note_routing_enabled.disabled = enabled;
                  if ((enabled != true) && (note_routing_enabled.checked != true)) {
                      disableNoteRoutingFields(f, true);
                  } else {
                      disableNoteRoutingFields(f, enabled);
                  }
                  getFormElement(f, \'note_routing[status]\', 1).disabled = enabled;
              }
              //-->
              </script>
              '; ?>

              <form name="general_setup_form" onSubmit="javascript:return validateForm(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
              <input type="hidden" name="cat" value="update">
              <tr>
                <td colspan="2" class="default">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>General Setup<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
              </tr>
              <?php if ($this->_tpl_vars['result'] != ""): ?>
              <tr>
                <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center" class="error">
                  <?php if ($this->_tpl_vars['result'] == -1): ?>
                    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ERROR: The system doesn't have the appropriate permissions to create the configuration file in the setup directory<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    (<?php echo $this->_tpl_vars['app_config_path']; ?>
). <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please contact your local system administrator and ask for write privileges on the provided path.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php elseif ($this->_tpl_vars['result'] == -2): ?>
                    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ERROR: The system doesn't have the appropriate permissions to update the configuration file in the setup directory<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    (<?php echo $this->_tpl_vars['app_setup_file']; ?>
). <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please contact your local system administrator and ask for write privileges on the provided filename.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the setup information was saved successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endif; ?>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tool Caption:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <input type="text" class="default" name="tool_caption" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['tool_caption'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SMTP (Outgoing Email) Settings:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sender Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="smtp[from]" size="30" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['smtp']['from'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "smtp[from]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('1' => "eventum@example.com",'2' => "Eventum <eventum@example.com>")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(This MUST contain a real email address, e.g. "%1" or "%2")<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hostname:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="smtp[host]" size="30" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['smtp']['host'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "smtp[host]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Port<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="smtp[port]" size="5" value="<?php echo $this->_tpl_vars['setup']['smtp']['port']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "smtp[port]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Requires Authentication?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%" class="default">
                        <input type="radio" name="smtp[auth]" value="1" <?php if ($this->_tpl_vars['setup']['smtp']['auth']): ?>checked<?php endif; ?> onClick="javascript:disableAuthFields(this.form, false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'smtp[auth]', 0);disableAuthFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="smtp[auth]" value="0" <?php if (! $this->_tpl_vars['setup']['smtp']['auth']): ?>checked<?php endif; ?> onClick="javascript:disableAuthFields(this.form, true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'smtp[auth]', 1);disableAuthFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="smtp[username]" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['smtp']['username'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "smtp[username]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;
                      </td>
                      <td width="80%">
                        <input type="password" class="default" name="smtp[password]" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['smtp']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "smtp[password]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="default">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="smtp[save_outgoing_email]" value="yes" <?php if ($this->_tpl_vars['setup']['smtp']['save_outgoing_email'] == 'yes'): ?>checked<?php endif; ?> onClick="javascript:checkDebugField(this.form);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('general_setup_form', 'smtp[save_outgoing_email]');checkDebugField(getForm('general_setup_form'));"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save a Copy of Every Outgoing Issue Notification Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address to Send Saved Messages:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="smtp[save_address]" class="default" size="30" value="<?php echo $this->_tpl_vars['setup']['smtp']['save_address']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "smtp[save_address]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open Account Signup:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="open_signup" value="enabled" <?php if ($this->_tpl_vars['setup']['open_signup'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableSignupFields(this.form, false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'open_signup', 0);disableSignupFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="open_signup" value="disabled" <?php if (! $this->_tpl_vars['setup']['open_signup'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableSignupFields(this.form, true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'open_signup', 1);disableSignupFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned Projects:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <select name="accounts_projects[]" multiple size="3" class="default">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['project_list'],'selected' => $this->_tpl_vars['setup']['accounts_projects']), $this);?>

                        </select>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "accounts_projects[]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned Role:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <select name="accounts_role" class="default">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['user_roles'],'selected' => $this->_tpl_vars['setup']['accounts_role']), $this);?>

                        </select>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'accounts_role')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject Based Routing:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td>
                        <input id="subject_based_routing_enabled" type="radio" name="subject_based_routing[status]" value="enabled" <?php if ($this->_tpl_vars['setup']['subject_based_routing']['status'] == 'enabled'): ?>checked<?php endif; ?> onChange="javascript:toggleSubjectBasedRouting(this.form, true);">
                        <label for="subject_based_routing_enabled" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;&nbsp;
                        <input id="subject_based_routing_disabled" type="radio" name="subject_based_routing[status]" value="disabled" <?php if ($this->_tpl_vars['setup']['subject_based_routing']['status'] != 'enabled'): ?>checked<?php endif; ?> onClick="javascript:toggleSubjectBasedRouting(this.form, false);">
                        <label for="subject_based_routing_disabled" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label><br />
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>If enabled, Eventum will look in the subject line of incoming notes/emails to determine which issue they should be associated with.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
                      </td>
                    </tr>
                  </td>
                </table>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Recipient Type Flag:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recipient Type Flag:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td>
                        <input class="default" type="text" name="email_routing[recipient_type_flag]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['email_routing']['recipient_type_flag'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(This will be included in the From address of all emails sent by Eventum)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
                        <span class="default">
                        <input type="radio" name="email_routing[flag_location]" value="before" <?php if ($this->_tpl_vars['setup']['email_routing']['flag_location'] == 'before'): ?>checked<?php endif; ?>>
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_routing[flag_location]', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Before Sender Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="email_routing[flag_location]" value="after" <?php if ($this->_tpl_vars['setup']['email_routing']['flag_location'] != 'before'): ?>checked<?php endif; ?>>
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_routing[flag_location]', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>After Sender Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                        </span>
                      </td>
                    </tr>
                  </td>
                </table>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Routing Interface:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="email_routing[status]" value="enabled" <?php if ($this->_tpl_vars['setup']['email_routing']['status'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableEmailRoutingFields(this.form, false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_routing[status]', 0);disableEmailRoutingFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="email_routing[status]" value="disabled" <?php if ($this->_tpl_vars['setup']['email_routing']['status'] != 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableEmailRoutingFields(this.form, true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_routing[status]', 1);disableEmailRoutingFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address Prefix:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="email_routing[address_prefix]" value="<?php if ($this->_tpl_vars['setup']['email_routing']['address_prefix']): ?><?php echo $this->_tpl_vars['setup']['email_routing']['address_prefix']; ?>
<?php else: ?>issue_<?php endif; ?>" class="default">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "email_routing[address_prefix]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => "<b>issue_</b>51@example.com")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(e.g. %1)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Address Hostname:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="email_routing[address_host]" class="default" value="<?php echo $this->_tpl_vars['setup']['email_routing']['address_host']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "email_routing[address_host]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => "issue_51@<b>example.com</b>")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(e.g. %1)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Host Alias:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="email_routing[host_alias]" class="default" value="<?php echo $this->_tpl_vars['setup']['email_routing']['host_alias']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "email_routing[host_alias]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(Alternate domains that point to 'Address Hostname')<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Warn Users Whether They Can Send Emails to Issue:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%" class="default">
                        <label><input type="radio" name="email_routing[warning][status]" value="enabled" <?php if ($this->_tpl_vars['setup']['email_routing']['warning']['status'] == 'enabled'): ?>checked<?php endif; ?>>
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;&nbsp;
                        <label><input type="radio" name="email_routing[warning][status]" value="disabled" <?php if ($this->_tpl_vars['setup']['email_routing']['warning']['status'] != 'enabled'): ?>checked<?php endif; ?>>
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note Recipient Type Flag:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recipient Type Flag:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td>
                        <input class="default" type="text" name="note_routing[recipient_type_flag]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['note_routing']['recipient_type_flag'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(This will be included in the From address of all notes sent by Eventum)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
                        <span class="default">
                        <input type="radio" name="note_routing[flag_location]" value="before" <?php if ($this->_tpl_vars['setup']['note_routing']['flag_location'] == 'before'): ?>checked<?php endif; ?>>
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'note_routing[flag_location]', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Before Sender Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="note_routing[flag_location]" value="after" <?php if ($this->_tpl_vars['setup']['note_routing']['flag_location'] != 'before'): ?>checked<?php endif; ?>>
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'note_routing[flag_location]', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>After Sender Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                        </span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Internal Note Routing Interface:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="note_routing[status]" value="enabled" <?php if ($this->_tpl_vars['setup']['note_routing']['status'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableNoteRoutingFields(this.form, false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'note_routing[status]', 0);disableNoteRoutingFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="note_routing[status]" value="disabled" <?php if ($this->_tpl_vars['setup']['note_routing']['status'] != 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableNoteRoutingFields(this.form, true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'note_routing[status]', 1);disableNoteRoutingFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note Address Prefix:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="note_routing[address_prefix]" value="<?php if ($this->_tpl_vars['setup']['note_routing']['address_prefix']): ?><?php echo $this->_tpl_vars['setup']['note_routing']['address_prefix']; ?>
<?php else: ?>note_<?php endif; ?>" class="default">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "note_routing[address_prefix]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => "<b>note_</b>51@example.com")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(e.g. %1)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Address Hostname:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="note_routing[address_host]" class="default" value="<?php echo $this->_tpl_vars['setup']['note_routing']['address_host']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "note_routing[address_host]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => "note_51@<b>example.com</b>")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(e.g. %1)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Draft Interface:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="draft_routing[status]" value="enabled" <?php if ($this->_tpl_vars['setup']['draft_routing']['status'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableDraftRoutingFields(this.form, false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'draft_routing[status]', 0);disableDraftRoutingFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="draft_routing[status]" value="disabled" <?php if ($this->_tpl_vars['setup']['draft_routing']['status'] != 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableDraftRoutingFields(this.form, true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'draft_routing[status]', 1);disableDraftRoutingFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Draft Address Prefix:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="draft_routing[address_prefix]" value="<?php if ($this->_tpl_vars['setup']['draft_routing']['address_prefix']): ?><?php echo $this->_tpl_vars['setup']['draft_routing']['address_prefix']; ?>
<?php else: ?>draft_<?php endif; ?>" class="default">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "draft_routing[address_prefix]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => "<b>draft_</b>51@example.com")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(e.g. %1)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Address Hostname:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" name="draft_routing[address_host]" class="default" value="<?php echo $this->_tpl_vars['setup']['draft_routing']['address_host']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "draft_routing[address_host]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => "draft_51@<b>example.com</b>")); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(e.g. %1)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array('escape' => false)); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>SCM <br />Integration:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'scm_integration')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="scm_integration" value="enabled" <?php if ($this->_tpl_vars['setup']['scm_integration'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableSCMFields(this.form, false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'scm_integration', 0);disableSCMFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="scm_integration" value="disabled" <?php if (! $this->_tpl_vars['setup']['scm_integration'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableSCMFields(this.form, true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'scm_integration', 1);disableSCMFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Checkout Page:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="checkout_url" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['checkout_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'checkout_url')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Diff Page:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="diff_url" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['diff_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'diff_url')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Log Page:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input type="text" class="default" name="scm_log_url" size="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['scm_log_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'scm_log_url')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Integration Feature:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <input type="radio" name="support_email" value="enabled" <?php if ($this->_tpl_vars['setup']['support_email'] == 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'support_email', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                  <input type="radio" name="support_email" value="disabled" <?php if ($this->_tpl_vars['setup']['support_email'] != 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'support_email', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Daily Tips:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <input type="radio" name="daily_tips" value="enabled" <?php if ($this->_tpl_vars['setup']['daily_tips'] == 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'daily_tips', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                  <input type="radio" name="daily_tips" value="disabled" <?php if ($this->_tpl_vars['setup']['daily_tips'] != 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'daily_tips', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Spell Checker:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <span class="default">
                  <input type="radio" name="spell_checker" value="enabled" <?php if ($this->_tpl_vars['setup']['spell_checker'] == 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'spell_checker', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                  <input type="radio" name="spell_checker" value="disabled" <?php if ($this->_tpl_vars['setup']['spell_checker'] != 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'spell_checker', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
                  &nbsp;&nbsp;<span class="small_default"><?php $this->_tag_stack[] = array('t', array('escape' => false,'1' => '<a target="_blank" class="link" href="http://aspell.sourceforge.net/">aspell</a>')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(requires %1 installed in your server)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>IRC Notifications:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <input type="radio" name="irc_notification" value="enabled" <?php if ($this->_tpl_vars['setup']['irc_notification'] == 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'irc_notification', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                  <input type="radio" name="irc_notification" value="disabled" <?php if ($this->_tpl_vars['setup']['irc_notification'] != 'enabled'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'irc_notification', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Allow Un-Assigned Issues?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <input type="radio" name="allow_unassigned_issues" value="yes" <?php if ($this->_tpl_vars['setup']['allow_unassigned_issues'] == 'yes'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'allow_unassigned_issues', 0);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                  <input type="radio" name="allow_unassigned_issues" value="no" <?php if ($this->_tpl_vars['setup']['allow_unassigned_issues'] != 'yes'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'allow_unassigned_issues', 1);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Default Options for Notifications:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <input type="checkbox" name="update" <?php if ($this->_tpl_vars['setup']['update']): ?>checked<?php endif; ?> value="1"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('general_setup_form', 'update');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues are Updated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br />
                  <input type="checkbox" name="closed" <?php if ($this->_tpl_vars['setup']['closed']): ?>checked<?php endif; ?> value="1"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('general_setup_form', 'closed');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues are Closed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br />
                  <input type="checkbox" name="emails" <?php if ($this->_tpl_vars['setup']['emails']): ?>checked<?php endif; ?> value="1"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('general_setup_form', 'emails');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Emails are Associated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br />
                  <input type="checkbox" name="files" <?php if ($this->_tpl_vars['setup']['files']): ?>checked<?php endif; ?> value="1"> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('general_setup_form', 'files');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Files are Attached<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Reminder System Status Information:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="email_reminder[status]" value="enabled" <?php if ($this->_tpl_vars['setup']['email_reminder']['status'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableReminderEmailFields(getForm('general_setup_form'), false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_reminder[status]', 0);disableReminderEmailFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="email_reminder[status]" value="disabled" <?php if ($this->_tpl_vars['setup']['email_reminder']['status'] != 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableReminderEmailFields(getForm('general_setup_form'), true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_reminder[status]', 1);disableReminderEmailFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Addresses To Send Information To:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input class="default" type="text" name="email_reminder[addresses]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['email_reminder']['addresses'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="50">
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(separate multiple addresses with commas)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Error Logging System:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <table>
                    <tr>
                      <td colspan="2" class="default_white">
                        <input type="radio" name="email_error[status]" value="enabled" <?php if ($this->_tpl_vars['setup']['email_error']['status'] == 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableErrorEmailFields(getForm('general_setup_form'), false);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_error[status]', 0);disableErrorEmailFields(getForm('general_setup_form'), false);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;
                        <input type="radio" name="email_error[status]" value="disabled" <?php if ($this->_tpl_vars['setup']['email_error']['status'] != 'enabled'): ?>checked<?php endif; ?> onClick="javascript:disableErrorEmailFields(getForm('general_setup_form'), true);">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('general_setup_form', 'email_error[status]', 1);disableErrorEmailFields(getForm('general_setup_form'), true);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td width="100" class="default" align="right">
                        <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Addresses To Send Errors To:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
                      </td>
                      <td width="80%">
                        <input class="default" type="text" name="email_error[addresses]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['setup']['email_error']['addresses'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="50">
                        <span class="small_default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(separate multiple addresses with commas)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Setup<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                </td>
              </tr>
              </form>
            </table>
          </td>
        </tr>
      </table>
      <?php echo '
      <script type="text/javascript">
      <!--
      window.onload = setDisabledFields;
      function setDisabledFields()
      {
          var f = getForm(\'general_setup_form\');
          var field1 = getFormElement(f, \'smtp[auth]\', 0);
          if (field1.checked) {
              disableAuthFields(f, false);
          } else {
              disableAuthFields(f, true);
          }
          checkDebugField(f);
          if (f.scm_integration[0].checked) {
              disableSCMFields(f, false);
          } else {
              f.scm_integration[1].checked = true;
              disableSCMFields(f, true);
          }
          if (f.open_signup[0].checked) {
              disableSignupFields(f, false);
          } else {
              f.open_signup[1].checked = true;
              disableSignupFields(f, true);
          }
          field1 = getFormElement(f, \'email_routing[status]\', 0);
          var field2 = getFormElement(f, \'email_routing[status]\', 1);
          if (field1.checked) {
              disableEmailRoutingFields(f, false);
          } else {
              field2.checked = true;
              disableEmailRoutingFields(f, true);
          }
          field1 = getFormElement(f, \'note_routing[status]\', 0);
          field2 = getFormElement(f, \'note_routing[status]\', 1);
          if (field1.checked) {
              disableNoteRoutingFields(f, false);
          } else {
              field2.checked = true;
              disableNoteRoutingFields(f, true);
          }
          field1 = getFormElement(f, \'draft_routing[status]\', 0);
          field2 = getFormElement(f, \'draft_routing[status]\', 1);
          if (field1.checked) {
              disableDraftRoutingFields(f, false);
          } else {
              field2.checked = true;
              disableDraftRoutingFields(f, true);
          }
          field1 = getFormElement(f, \'email_reminder[status]\', 0);
          field2 = getFormElement(f, \'email_reminder[status]\', 1);
          if (field1.checked) {
              disableReminderEmailFields(f, false);
          } else {
              field2.checked = true;
              disableReminderEmailFields(f, true);
          }
          field1 = getFormElement(f, \'email_error[status]\', 0);
          field2 = getFormElement(f, \'email_error[status]\', 1);
          if (field1.checked) {
              disableErrorEmailFields(f, false);
          } else {
              field2.checked = true;
              disableErrorEmailFields(f, true);
          }
          toggleSubjectBasedRouting(f, getFormElement(f, \'subject_based_routing[status]\', 0).checked);
      }
      //-->
      </script>
      '; ?>

