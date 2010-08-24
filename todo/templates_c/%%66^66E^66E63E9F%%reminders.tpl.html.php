<?php /* Smarty version 2.6.18, created on 2010-08-10 11:21:35
         compiled from manage/reminders.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'manage/reminders.tpl.html', 10, false),array('function', 'html_options', 'manage/reminders.tpl.html', 158, false),array('function', 'counter', 'manage/reminders.tpl.html', 188, false),array('function', 'cycle', 'manage/reminders.tpl.html', 321, false),array('modifier', 'escape', 'manage/reminders.tpl.html', 168, false),array('modifier', 'truncate', 'manage/reminders.tpl.html', 230, false),)), $this); ?>

      <table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr>
          <td>
            <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
              <tr>
                <td colspan="2">
                  <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Issue Reminders<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td align="right" class="default">
                        <b><?php if ($_GET['cat'] == 'edit'): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Updating Reminder<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> #<?php echo $_GET['id']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Creating New Reminder<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></b>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <?php if ($this->_tpl_vars['result'] != ""): ?>
              <tr>
                <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center" class="error">
                  <?php if ($_POST['cat'] == 'new'): ?>
                    <?php if ($this->_tpl_vars['result'] == -1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to add the new reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php elseif ($this->_tpl_vars['result'] == -2): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the title for this new reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the reminder was added successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php endif; ?>
                  <?php elseif ($_POST['cat'] == 'update'): ?>
                    <?php if ($this->_tpl_vars['result'] == -1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to update the reminder information.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php elseif ($this->_tpl_vars['result'] == -2): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the title for this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the reminder was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endif; ?>
              <script type="text/javascript">
              <!--
              var url = '<?php echo $_SERVER['PHP_SELF']; ?>
';
              var rem_id = '<?php echo $_GET['id']; ?>
';
              <?php echo '
              function populateIssueComboBox(f)
              {
                  if (rem_id == \'\') {
                      url += \'?prj_id=\' + getSelectedOption(f, \'project\');
                  } else {
                      url += \'?cat=edit&id=\' + rem_id + \'&prj_id=\' + getSelectedOption(f, \'project\');
                  }
                  window.location.href = url;
              }
              function toggleReminderTypeFields()
              {
                  var f = getForm(\'reminder_form\');
                  var issue_field = getFormElement(f, \'issues[]\');
                  var priority_field = getFormElement(f, \'priorities[]\');
                  var level_field = getFormElement(f, \'support_levels[]\');
                  var customer_field = getFormElement(f, \'customers[]\');

                  var next_field = 0;
                  if (level_field) {
                      var field = getFormElement(f, \'reminder_type\', 0);
                      if (field.checked) {
                          level_field.disabled = false;
                      } else {
                          level_field.disabled = true;
                      }
                      next_field++;
                  }
                  if (customer_field) {
                      var field = getFormElement(f, \'reminder_type\', next_field);
                      if (field.checked) {
                          customer_field.disabled = false;
                      } else {
                          customer_field.disabled = true;
                      }
                      next_field++;
                  }
                  var field = getFormElement(f, \'reminder_type\', next_field);
                  if (field.checked) {
                      issue_field.disabled = false;
                  } else {
                      issue_field.disabled = true;
                  }
                  field = getFormElement(f, \'check_priority\');
                  if (field.checked) {
                      priority_field.disabled = false;
                  } else {
                      priority_field.disabled = true;
                  }
              }
              function validateForm(f)
              {
                  if (hasSelected(f.project, -1)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose a project that will be associated with this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if (isWhitespace(f.title.value)) {
                      selectField(f, \'title\');
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the title for this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if (isWhitespace(f.rank.value)) {
                      selectField(f, \'rank\');
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the rank for this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  var next_field = 0;
                  var support_levels = getFormElement(f, \'support_levels[]\');
                  if (support_levels) {
                      var by_support_level = getFormElement(f, \'reminder_type\', 0);
                      next_field++;
                  }
                  var customers = getFormElement(f, \'customers[]\');
                  if (customers) {
                      var by_customers = getFormElement(f, \'reminder_type\', next_field);
                      next_field++;
                  }
                  var by_issue = getFormElement(f, \'reminder_type\', next_field);
                  if ((by_support_level.checked) && (!hasOneSelected(f, \'support_levels[]\'))) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose the support levels that will be associated with this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if ((by_customer.checked) && (!hasOneSelected(f, \'customers[]\'))) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose the customers that will be associated with this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if ((by_issue.checked) && (!hasOneSelected(f, \'issues[]\'))) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the issue IDs that will be associated with this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  if ((f.check_priority.checked) && (!hasOneSelected(f, \'priorities[]\'))) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose the priorities that will be associated with this reminder.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      return false;
                  }
                  return true;
              }
              //-->
              </script>
              '; ?>

              <form name="reminder_form" onSubmit="javascript:return validateForm(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
              <?php if ($_GET['cat'] == 'edit'): ?>
              <input type="hidden" name="cat" value="update">
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
">
              <?php else: ?>
              <input type="hidden" name="cat" value="new">
              <?php endif; ?>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td width="85%" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <select name="project" class="default" onChange="javascript:populateIssueComboBox(this.form);">
                    <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose an option<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['project_list'],'selected' => $this->_tpl_vars['info']['rem_prj_id']), $this);?>

                  </select>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'project')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <input type="text" size="50" name="title" class="default" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['info']['rem_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'title')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rank<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <input type="text" size="10" name="rank" class="default" value="<?php echo $this->_tpl_vars['info']['rem_rank']; ?>
">
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'rank')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reminder Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <table cellpadding="1" border="0">
                    <tr>
                      <?php echo smarty_function_counter(array('start' => 0,'assign' => 'next_field'), $this);?>

                      <?php if ($this->_tpl_vars['backend_uses_support_levels']): ?>
                      <td class="default">
                        <input type="radio" name="reminder_type" value="support_level" <?php if ($this->_tpl_vars['info']['type'] == 'support_level'): ?>checked<?php endif; ?> onClick="javascript:toggleReminderTypeFields();">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('reminder_form', 'reminder_type', 0);toggleReminderTypeFields();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By Support Level<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <?php echo smarty_function_counter(array(), $this);?>

                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['project_has_customer_integration']): ?>
                      <td class="default">
                        <input type="radio" name="reminder_type" value="customer" <?php if ($this->_tpl_vars['info']['type'] == 'customer'): ?>checked<?php endif; ?> onClick="javascript:toggleReminderTypeFields();">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('reminder_form', 'reminder_type', <?php echo $this->_tpl_vars['next_field']; ?>
);toggleReminderTypeFields();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By Customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <?php echo smarty_function_counter(array(), $this);?>

                      <?php endif; ?>
                      <td class="default">
                        <input type="radio" name="reminder_type" value="issue" <?php if ($this->_tpl_vars['info']['type'] == 'issue'): ?>checked<?php endif; ?> onClick="javascript:toggleReminderTypeFields();">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('reminder_form', 'reminder_type', <?php echo $this->_tpl_vars['next_field']; ?>
);toggleReminderTypeFields();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By Issue ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                      <?php echo smarty_function_counter(array(), $this);?>

                    </tr>
                    <tr>
                      <?php if ($this->_tpl_vars['backend_uses_support_levels']): ?>
                      <td>
                        <select name="support_levels[]" class="default" size="4" multiple>
                          <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['support_levels'],'selected' => $this->_tpl_vars['info']['rer_support_level_id']), $this);?>

                        </select>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['project_has_customer_integration']): ?>
                      <td>
                        <select name="customers[]" size="4" multiple class="default">
                          <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['customers'],'selected' => $this->_tpl_vars['info']['rer_customer_id']), $this);?>

                        </select>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <?php endif; ?>
                      <td>
                        <select name="issues[]" class="default" size="4" multiple>
                          <?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['issues'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 70) : smarty_modifier_truncate($_tmp, 70)),'selected' => $this->_tpl_vars['info']['rer_iss_id']), $this);?>

                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td class="default">
                        <input type="radio" name="reminder_type" value="all_issues" <?php if ($this->_tpl_vars['info']['type'] == 'ALL'): ?>checked<?php endif; ?> onClick="javascript:toggleReminderTypeFields();" <?php if ($_GET['cat'] != 'edit'): ?>checked<?php endif; ?>>
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:checkRadio('reminder_form', 'reminder_type', <?php echo $this->_tpl_vars['next_field']; ?>
);toggleReminderTypeFields();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td class="default">
                        <input type="checkbox" name="check_priority" value="yes" <?php if ($this->_tpl_vars['info']['check_priority'] == 'yes'): ?>checked<?php endif; ?> onClick="javascript:toggleReminderTypeFields();">
                        <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('reminder_form', 'check_priority');toggleReminderTypeFields();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Also Filter By Issue Priorities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>
                        <select name="priorities[]" size="4" multiple class="default">
                          <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['priorities'],'selected' => $this->_tpl_vars['info']['rer_pri_id']), $this);?>

                        </select>
                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Skip Weekends<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <input type="radio" name="skip_weekend" value="1" <?php if ($this->_tpl_vars['info']['rem_skip_weekend'] == 1): ?>CHECKED<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <input type="radio" name="skip_weekend" value="0" <?php if ($this->_tpl_vars['info']['rem_skip_weekend'] != 1): ?>CHECKED<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
                  &nbsp;<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>If yes, this reminder will not activate on weekends and time will not accumulate on the weekends.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                  <?php if ($_GET['cat'] == 'edit'): ?>
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Reminder<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <?php else: ?>
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create Reminder<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <?php endif; ?>
                  <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                </td>
              </tr>
              </form>
              <tr>
                <td colspan="2" class="default">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Existing Issue Reminders<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <?php echo '
                  <script type="text/javascript">
                  <!--
                  function checkDelete(f)
                  {
                      if (!hasOneChecked(f, \'items[]\')) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select at least one of the reminders.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          return false;
                      }
                      if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will remove the selected entries.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
                          return false;
                      } else {
                          return true;
                      }
                  }
                  //-->
                  </script>
                  '; ?>

                  <table border="0" width="100%" cellpadding="1" cellspacing="1">
                    <form onSubmit="javascript:return checkDelete(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
                    <input type="hidden" name="cat" value="delete">
                    <tr>
                      <td width="4" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" nowrap><input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'items[]');"></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>&nbsp;</td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" align="center">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rank<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>&nbsp;</td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" nowrap>&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issue Priorities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>&nbsp;</td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
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
                    <?php echo smarty_function_cycle(array('values' => $this->_tpl_vars['cycle'],'assign' => 'row_color'), $this);?>

                    <tr>
                      <td width="4" nowrap bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" align="center"><input type="checkbox" name="items[]" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_id']; ?>
"></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default" align="center"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_id']; ?>
</td>
                      <td bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default" align="center">
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?cat=change_rank&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_id']; ?>
&rank=desc"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/desc.gif" border="0"></a> <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_rank']; ?>

                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>
?cat=change_rank&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_id']; ?>
&rank=asc"><img src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/asc.gif" border="0"></a>
                      </td>
                      <td bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<a class="link" href="<?php echo $_SERVER['PHP_SELF']; ?>
?cat=edit&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_id']; ?>
" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>update this entry<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                      </td>
                      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['prj_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                      </td>
                      <td width="20%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['type'] == 'ALL'): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['type'] == 'support_level'): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By Support Level<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['type'] == 'customer'): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By Customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php elseif ($this->_tpl_vars['list'][$this->_sections['i']['index']]['type'] == 'issue'): ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By Issue ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
                      </td>
                      <td width="15%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<?php unset($this->_sections['y']);
$this->_sections['y']['name'] = 'y';
$this->_sections['y']['loop'] = is_array($_loop=$this->_tpl_vars['list'][$this->_sections['i']['index']]['priorities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['y']['show'] = true;
$this->_sections['y']['max'] = $this->_sections['y']['loop'];
$this->_sections['y']['step'] = 1;
$this->_sections['y']['start'] = $this->_sections['y']['step'] > 0 ? 0 : $this->_sections['y']['loop']-1;
if ($this->_sections['y']['show']) {
    $this->_sections['y']['total'] = $this->_sections['y']['loop'];
    if ($this->_sections['y']['total'] == 0)
        $this->_sections['y']['show'] = false;
} else
    $this->_sections['y']['total'] = 0;
if ($this->_sections['y']['show']):

            for ($this->_sections['y']['index'] = $this->_sections['y']['start'], $this->_sections['y']['iteration'] = 1;
                 $this->_sections['y']['iteration'] <= $this->_sections['y']['total'];
                 $this->_sections['y']['index'] += $this->_sections['y']['step'], $this->_sections['y']['iteration']++):
$this->_sections['y']['rownum'] = $this->_sections['y']['iteration'];
$this->_sections['y']['index_prev'] = $this->_sections['y']['index'] - $this->_sections['y']['step'];
$this->_sections['y']['index_next'] = $this->_sections['y']['index'] + $this->_sections['y']['step'];
$this->_sections['y']['first']      = ($this->_sections['y']['iteration'] == 1);
$this->_sections['y']['last']       = ($this->_sections['y']['iteration'] == $this->_sections['y']['total']);
?><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['priorities'][$this->_sections['y']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php if (! $this->_sections['y']['last']): ?>, <?php endif; ?><?php endfor; endif; ?>
                      </td>
                      <td bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<a href="reminder_actions.php?rem_id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rem_id']; ?>
" class="link"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['total_actions']; ?>
 Action<?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['total_actions'] != 1): ?>s<?php endif; ?></a>
                      </td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td colspan="8" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" align="center" class="default">
                        <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No reminders could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                      </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <td width="4" align="center" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                        <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'items[]');">
                      </td>
                      <td colspan="7" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                        <input type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button">
                      </td>
                    </tr>
                    </form>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <?php echo '
      <script type="text/javascript">
      <!--
      window.onload = toggleReminderTypeFields;
      //-->
      </script>
      '; ?>

