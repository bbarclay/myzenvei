<?php /* Smarty version 2.6.18, created on 2010-07-29 16:09:11
         compiled from manage/users.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'manage/users.tpl.html', 12, false),array('modifier', 'count', 'manage/users.tpl.html', 40, false),array('modifier', 'escape', 'manage/users.tpl.html', 185, false),array('modifier', 'capitalize', 'manage/users.tpl.html', 265, false),array('function', 'html_options', 'manage/users.tpl.html', 131, false),array('function', 'cycle', 'manage/users.tpl.html', 245, false),)), $this); ?>

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
                  if (isWhitespace(f.email.value)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the email of this user.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'email\');
                      return false;
                  }
                  if (!isEmail(f.email.value)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter a valid email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'email\');
                      return false;
                  }
                  if (f.cat.value == \'update\') {
                      if ((!isWhitespace(f.password.value)) && (f.password.value.length < 6)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter a password of at least 6 characters.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'password\');
                          return false;
                      }
                  } else {
                      if ((isWhitespace(f.password.value)) || (f.password.value.length < 6)) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter a password of at least 6 characters.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          selectField(f, \'password\');
                          return false;
                      }
                  }
                  if (isWhitespace(f.full_name.value)) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the full name of this user.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'full_name\');
                      return false;
                  }
                  var has_project_selected = false;
                  var projects = new Array('; ?>
<?php echo count($this->_tpl_vars['project_list']); ?>
<?php echo ');
                  '; ?>

                  <?php $_from = $this->_tpl_vars['project_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['projects'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['projects']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prj_id'] => $this->_tpl_vars['prj_title']):
        $this->_foreach['projects']['iteration']++;
?>
                  projects[<?php echo $this->_foreach['projects']['iteration']-1; ?>
] = <?php echo $this->_tpl_vars['prj_id']; ?>
;
                  <?php endforeach; endif; unset($_from); ?>
                  <?php echo '
                  for (i = 0; i < projects.length; i++) {
                    if ((getFormElement(getForm(\'user_form\'), \'role[\' + projects[i] + \']\').selectedIndex > 0) ||
                        (getFormElement(getForm(\'user_form\'), \'role[\' + projects[i] + \']\').type == \'hidden\' &&
                        getFormElement(getForm(\'user_form\'), \'role[\' + projects[i] + \']\').value != \'\')) {
                        has_project_selected = true;
                    }
                  }
                  if (!has_project_selected) {
                      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please assign the appropriate projects for this user.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                      selectField(f, \'projects[]\');
                      return false;
                  }
                  return true;
              }
              //-->
              </script>
              '; ?>

              <form name="user_form" onSubmit="javascript:return validateForm(this);" method="post" action="<?php echo $this->_tpl_vars['rel_url']; ?>
manage/users.php">
              <?php if ($_GET['cat'] == 'edit'): ?>
              <input type="hidden" name="cat" value="update">
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
">
              <?php else: ?>
              <input type="hidden" name="cat" value="new">
              <?php endif; ?>
              <tr>
                <td colspan="2" class="default">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                </td>
              </tr>
              <?php if ($this->_tpl_vars['result'] != ""): ?>
              <tr>
                <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center" class="error">
                  <?php if ($_POST['cat'] == 'new'): ?>
                    <?php if ($this->_tpl_vars['result'] == -1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to add the new user.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the user was added successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php endif; ?>
                  <?php elseif ($_POST['cat'] == 'update'): ?>
                    <?php if ($this->_tpl_vars['result'] == -1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to update the user information.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the user was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endif; ?>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <input type="text" name="email" size="40" class="default" value="<?php echo $this->_tpl_vars['info']['usr_email']; ?>
">
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'email')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <input type="password" name="password" size="20" class="default">
                  <?php if ($_GET['cat'] == 'edit'): ?>
                  <span class="default">(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>leave empty to keep the current password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</span>
                  <?php endif; ?>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'password')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Full Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <input type="text" name="full_name" size="40" class="default" value="<?php echo $this->_tpl_vars['info']['usr_full_name']; ?>
">
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'full_name')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
              <tr>
                  <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                      <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                  </td>
                  <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" width="80%">
                      <select name="grp_id" size="1" class="default">
                          <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>-- Select One --<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                          <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['group_list'],'selected' => $this->_tpl_vars['info']['usr_grp_id']), $this);?>

                      </select>
                      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'grp_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                  </td>
              </tr>
              <tr>
                <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                  <nobr><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned Projects and Roles<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b></nobr>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <table border="0">
                    <?php $_from = $this->_tpl_vars['project_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prj_id'] => $this->_tpl_vars['prj_name']):
?>
                    <tr>
                      <td class="default"><?php echo $this->_tpl_vars['prj_name']; ?>
:</td>
                      <td>
                        <?php if ($this->_tpl_vars['info']['roles'][$this->_tpl_vars['prj_id']]['pru_role'] == $this->_tpl_vars['roles']['customer']): ?>
                        <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                        <input type="hidden" name="role[<?php echo $this->_tpl_vars['prj_id']; ?>
]" value="<?php echo $this->_tpl_vars['roles']['customer']; ?>
">
                        <?php else: ?>
                        <select name="role[<?php echo $this->_tpl_vars['prj_id']; ?>
]" class="default"  <?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['info']['roles'][$this->_tpl_vars['prj_id']]['pru_role']): ?>disabled<?php endif; ?>>
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['project_roles'][$this->_tpl_vars['prj_id']],'selected' => $this->_tpl_vars['info']['roles'][$this->_tpl_vars['prj_id']]['pru_role']), $this);?>

                        </select>
                        <?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['info']['roles'][$this->_tpl_vars['prj_id']]['pru_role']): ?><input type="hidden" name="role[<?php echo $this->_tpl_vars['prj_id']; ?>
]" value="<?php echo $this->_tpl_vars['info']['roles'][$this->_tpl_vars['prj_id']]['pru_role']; ?>
"><?php endif; ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "role[".($this->_tpl_vars['prj_id'])."]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                  <?php if ($_GET['cat'] == 'edit'): ?>
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <?php else: ?>
                  <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                  <?php endif; ?>
                  <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                </td>
              </tr>
              </form>
              <tr>
                <td colspan="2" class="default">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Existing Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <script type="text/javascript">
                  <!--
                  var active_users = new Array();
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
                  <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_status'] == 'active'): ?>
                  active_users[<?php echo $this->_sections['i']['index']; ?>
] = '<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';
                  <?php endif; ?>
                  <?php endfor; endif; ?>
                  var page_url = '<?php echo $_SERVER['PHP_SELF']; ?>
';
                  <?php echo '
                  function checkDelete(f)
                  {
                      var total_selected = getTotalCheckboxesChecked(f, \'items[]\');
                      var total = getTotalCheckboxes(f, \'items[]\');
                      if (getSelectedOption(f, \'status\') == \'inactive\') {
                          if (active_users.length < 2) {
                              alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You cannot change the status of the only active user left in the system.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                              return false;
                          }
                          if (total == total_selected) {
                              alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You cannot inactivate all of the users in the system.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                              return false;
                          }
                      }
                      if (!hasOneChecked(f, \'items[]\')) {
                          alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select at least one of the users.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
                          return false;
                      }
                      if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will change the status of the selected users.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
                          return false;
                      } else {
                          return true;
                      }
                  }
                  function showCustomerUsers(f)
                  {
                      var field = getFormElement(f, \'show_customers\', 0);
                      if (field.checked) {
                          window.location.href = page_url + "?" + replaceParam(window.location.href, \'show_customers\', \'1\');
                      } else {
                          window.location.href = page_url + "?" + replaceParam(window.location.href, \'show_customers\', \'0\');
                      }
                  }
                  function openAliasList(id)
				  {
    				var features = \'width=560,height=460,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    				var aliasEmailWin = window.open(\'email_alias.php?id=\' + id, \'_EmailAlias\', features);
    				aliasEmailWin.focus();
					}
                  //-->
                  </script>
                  '; ?>

                  <table border="0" width="100%" cellpadding="1" cellspacing="1">
                    <form name="change_status_form" onSubmit="javascript:return checkDelete(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
                    <input type="hidden" name="cat" value="change_status">
                    <tr>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" nowrap><input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> " class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'items[]');"></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Full Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Alias<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                      <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
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
" align="center">
                        <input type="checkbox" name="items[]" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_id']; ?>
" <?php if ($this->_sections['i']['total'] == 0): ?>disabled<?php endif; ?>>
                      </td>
                      <td width="15%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<a class="link" href="<?php echo $this->_tpl_vars['rel_url']; ?>
manage/users.php?cat=edit&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_id']; ?>
" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>update this entry<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_full_name']; ?>
</a>
                      </td>
                      <td width="15%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default" nowrap>
                        <?php $_from = $this->_tpl_vars['list'][$this->_sections['i']['index']]['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['role_data']):
?>
                          &nbsp;<?php echo $this->_tpl_vars['role_data']['prj_title']; ?>
: <?php echo $this->_tpl_vars['role_data']['role']; ?>
<br />
                        <?php endforeach; endif; unset($_from); ?>
                      </td>
                      <td width="30%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<a href="mailto:<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_email']; ?>
" class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>send email to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_email']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_email']; ?>
</a>
                      </td>
                      <td width="10%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>list all email aliases<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="link" href="javascript:void(null);" onClick="javascript:openAliasList(<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_id']; ?>
);"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>manage alias<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                      </td>
                      <td width="10%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_status'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>

                      </td>
                      <td width="20%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                        &nbsp;<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['group_name']; ?>

                      </td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td colspan="7" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" align="center" class="default">
                        <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No users could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                      </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <td colspan="7" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td>
                              <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'items[]');">
                              <input type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &gt;&gt;" class="button">
                              <select name="status" class="default">
                                <option value="active"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                                <option value="inactive"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Inactive<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                              </select>
                            </td>
                            <td align="right" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                              <input type="checkbox" id="show_customers" name="show_customers" value="yes" <?php if ($_GET['show_customers'] == 1): ?>checked<?php endif; ?> onClick="javascript:showCustomerUsers(this.form);">
                              <label for="show_customers"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Customers<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;
                            </td>
                          </tr>
                        </table>
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