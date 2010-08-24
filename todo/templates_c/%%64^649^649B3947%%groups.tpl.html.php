<?php /* Smarty version 2.6.18, created on 2010-07-29 16:11:00
         compiled from manage/groups.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'manage/groups.tpl.html', 6, false),array('function', 'html_options', 'manage/groups.tpl.html', 108, false),array('function', 'cycle', 'manage/groups.tpl.html', 172, false),array('modifier', 'join', 'manage/groups.tpl.html', 187, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
function validateForm(f)
{
    if (isWhitespace(f.group_name.value)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the name of this group.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'group_name\');
        return false;
    }
    if (!hasOneSelected(f, \'projects[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please assign the appropriate projects for this group.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'projects[]\');
        return false;
    }
    if (!hasOneSelected(f, \'users[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please assign the appropriate users for this group.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'users[]\');
        return false;
    }
    if (f.manager.value == \'\') {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please assign the manager of this group.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        selectField(f, \'manager\');
        return false;
    } else {
        // make sure manager is also in users list
        for (i = 0; i < f.elements[\'users[]\'].options.length; i++) {
            if (f.elements[\'users[]\'].options[i].value == f.manager.value) {
                f.elements[\'users[]\'].options[i].selected = true;
            }
        }
    }
    return true;
}

function checkDelete(f)
{
    if (!hasOneChecked(f, \'items[]\')) {
      alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select at least one of the groups.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
      return false;
    }
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>WARNING: This action will remove the selected groups permanently.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\\n'; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please click OK to confirm.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
      return false;
    } else {
      return true;
    }
}
</script>
'; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1">
    <tr>
        <td>
            <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2">
                <form name="group_form" onSubmit="javascript:return validateForm(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
                <?php if ($_GET['cat'] == 'edit'): ?>
                <input type="hidden" name="cat" value="update">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
">
                <?php else: ?>
                <input type="hidden" name="cat" value="new">
                <?php endif; ?>
                <tr>
                    <td colspan="2" class="default">
                        <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                    </td>
                </tr>
                <?php if ($this->_tpl_vars['result'] != ""): ?>
                <tr>
                    <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center" class="error">
                    <?php if ($_POST['cat'] == 'new'): ?>
                        <?php if ($this->_tpl_vars['result'] == -1): ?>
                            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to add the new group.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                        <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the group was added successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                        <?php endif; ?>
                    <?php elseif ($_POST['cat'] == 'update'): ?>
                        <?php if ($this->_tpl_vars['result'] == -1): ?>
                            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to update the group information.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                        <?php elseif ($this->_tpl_vars['result'] == 1): ?>
                            <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the group was updated successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                        <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> *</b>
                    </td>
                    <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                        <input type="text" name="group_name" size="40" class="default" value="<?php echo $this->_tpl_vars['info']['grp_name']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'group_name')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </td>
                </tr>
                <tr>
                    <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                        <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                    </td>
                    <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                        <input type="text" name="description" size="100" class="default" value="<?php echo $this->_tpl_vars['info']['grp_description']; ?>
">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'description')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </td>
                </tr>
                <tr>
                    <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                        <nobr><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned Projects:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> *</b></nobr>
                    </td>
                    <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                        <select name="projects[]" multiple size="3" class="default">
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['project_list'],'selected' => $this->_tpl_vars['info']['project_ids']), $this);?>

                        </select>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "projects[]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </td>
                </tr>
                <tr>
                    <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                        <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Users:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> *</b>
                    </td>
                    <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" width="80%">
                        <select name="users[]" multiple size="6" class="default" onChange="javascript:showSelections('group_form', 'users[]');">
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['user_options'],'selected' => $this->_tpl_vars['info']['users']), $this);?>

                        </select>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "users[]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <div class="default" id="selection_users[]" />
                        <?php echo '
                        <script type="text/javascript">jQuery().ready(function() {
                            showSelections(\'group_form\', \'users[]\');
                        });
                        </script>
                        '; ?>

                    </td>
                </tr>
                <tr>
                    <td width="120" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">
                        <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manager:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> *</b>
                    </td>
                    <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" width="80%">
                        <select name="manager" size="1" class="default">
                            <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>-- Select One --<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['user_options'],'selected' => $this->_tpl_vars['info']['grp_manager_usr_id']), $this);?>

                        </select>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'manager')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lookup_field.tpl.html", 'smarty_include_vars' => array('lookup_field_name' => 'manager_search','lookup_field_target' => 'manager')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                        <?php if ($_GET['cat'] == 'edit'): ?>
                        <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                        <?php else: ?>
                        <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                        <?php endif; ?>
                        <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
                    </td>
                </tr>
                </form>
                <tr>
                    <td colspan="2" class="default">
                        <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Existing Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" width="100%" cellpadding="1" cellspacing="1">
                            <form name="delete_group" onSubmit="javascript:return checkDelete(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
                            <tr>
                                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" nowrap><input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'items[]');"></td>
                                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manager<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
                                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white">&nbsp;<b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></td>
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
                                    <input type="checkbox" name="items[]" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['grp_id']; ?>
" <?php if ($this->_sections['i']['total'] == 0): ?>disabled<?php endif; ?>>
                                </td>
                                <td width="20%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                                    &nbsp;<a class="link" href="<?php echo $_SERVER['PHP_SELF']; ?>
?cat=edit&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['grp_id']; ?>
" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>update this entry<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['grp_name']; ?>
</a>
                                </td>
                                <td width="20%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                                    &nbsp;<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['grp_description']; ?>

                                </td>
                                <td width="40%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                                    &nbsp;<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['manager']; ?>

                                </td>
                                <td width="20%" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" class="default">
                                    &nbsp;<?php echo ((is_array($_tmp=", ")) ? $this->_run_mod_handler('join', true, $_tmp, $this->_tpl_vars['list'][$this->_sections['i']['index']]['projects']) : join($_tmp, $this->_tpl_vars['list'][$this->_sections['i']['index']]['projects'])); ?>

                                </td>
                            </tr>
                            <?php endfor; else: ?>
                            <tr>
                                <td colspan="5" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" align="center" class="default">
                                    <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No groups could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="5" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="4" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                                                <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'items[]');">
                                                <input type="hidden" name="cat" value="delete">
                                            </td>
                                            <td colspan="4" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" align="center">
                                                <input type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button">
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
</table>