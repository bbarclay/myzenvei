<?php /* Smarty version 2.6.18, created on 2010-08-07 16:03:17
         compiled from adv_search.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'adv_search.tpl.html', 1, false),array('modifier', 'escape', 'adv_search.tpl.html', 204, false),array('modifier', 'count', 'adv_search.tpl.html', 222, false),array('function', 'html_options', 'adv_search.tpl.html', 219, false),array('function', 'html_select_date', 'adv_search.tpl.html', 345, false),)), $this); ?>
<?php ob_start(); ?><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Advanced Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_smarty_vars['capture']['extra_title'] = ob_get_contents();  $this->assign('extra_title', ob_get_contents());ob_end_clean(); ?>
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

<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/dynCalendar.js?c=8885"></script>
<?php echo '
<script type="text/javascript">
<!--
function saveCustomFilter(f)
{
    if (isWhitespace(f.title.value)) {
        selectField(f, \'title\');
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please enter the title for this saved search.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'\', \'_customFilter\', features);
    popupWin.focus();
    f.target = \'_customFilter\';
    f.method = \'post\';
    f.action = \'popup.php\';
    f.cat.value = \'save_filter\';
    f.submit();
}
function validateRemove(f)
{
    if (!hasOneChecked(f, \'item[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose which entries need to be removed.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    if (!confirm(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This action will permanently delete the selected entries.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\')) {
        return false;
    } else {
        var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
        var popupWin = window.open(\'\', \'_removeFilter\', features);
        popupWin.focus();
        return true;
    }
}
function toggleDateFields(f, field_name)
{
    var checkbox = getFormElement(f, \'filter[\' + field_name + \']\');
    var filter_type = getFormElement(f, field_name + \'[filter_type]\');
    var month_field = getFormElement(f, field_name + \'[Month]\');
    var day_field = getFormElement(f, field_name + \'[Day]\');
    var year_field = getFormElement(f, field_name + \'[Year]\');
    var month_end_field = getFormElement(f, field_name + \'_end[Month]\');
    var day_end_field = getFormElement(f, field_name + \'_end[Day]\');
    var year_end_field = getFormElement(f, field_name + \'_end[Year]\');
    var time_period_field = getFormElement(f, field_name + \'[time_period]\');
    if (checkbox.checked) {
        var bool = false;
    } else {
        var bool = true;
    }
    filter_type.disabled = bool;
    month_field.disabled = bool;
    day_field.disabled = bool;
    year_field.disabled = bool;
    month_end_field.disabled = bool;
    day_end_field.disabled = bool;
    year_end_field.disabled = bool;
    time_period_field.disabled = bool;

    getPageElement(field_name + \'_hidden\').disabled = !bool;
}
function checkDateFilterType(f, type_field)
{
    var option = getSelectedOption(f, type_field.name);
    var element_name = type_field.name.substring(0, type_field.name.indexOf(\'[\'));
    var element = getPageElement(element_name);

    if (option == \'between\') {
        changeVisibility(element_name + \'1\', true, true);
        changeVisibility(element_name + \'2\', true, true);
        changeVisibility(element_name + \'_last\', false, true);
    } else if (option == \'in_past\') {
        changeVisibility(element_name + \'1\', false, true);
        changeVisibility(element_name + \'2\', false, true);
        changeVisibility(element_name + \'_last\', true, true);
    } else {
        changeVisibility(element_name + \'1\', true, true);
        changeVisibility(element_name + \'2\', false, true);
        changeVisibility(element_name + \'_last\', false, true);
    }
}
function selectDateOptions(field_prefix, date_str)
{
    if (date_str.length != 10) {
        return false;
    } else {
        var year = date_str.substring(0, date_str.indexOf(\'-\'));
        var month = date_str.substring(date_str.indexOf(\'-\')+1, date_str.lastIndexOf(\'-\'));
        var day = date_str.substring(date_str.lastIndexOf(\'-\')+1);
        selectDateField(field_prefix, day, month, year);
    }
}
function selectDateField(field_name, day, month, year)
{
    selectOption(this.document.custom_filter_form, field_name + \'[Day]\', day);
    selectOption(this.document.custom_filter_form, field_name + \'[Month]\', month);
    selectOption(this.document.custom_filter_form, field_name + \'[Year]\', year);
}
function calendarCallback_created(day, month, year) { selectDateField(\'created_date\', day, month, year); }
function calendarCallback_created_end(day, month, year) { selectDateField(\'created_date_end\', day, month, year); }
function calendarCallback_updated(day, month, year) { selectDateField(\'updated_date\', day, month, year); }
function calendarCallback_updated_end(day, month, year) { selectDateField(\'updated_date_end\', day, month, year); }
function calendarCallback_last_response(day, month, year) { selectDateField(\'last_response_date\', day, month, year); }
function calendarCallback_last_response_end(day, month, year) { selectDateField(\'last_response_date_end\', day, month, year); }
function calendarCallback_first_response(day, month, year) { selectDateField(\'first_response_date\', day, month, year); }
function calendarCallback_first_response_end(day, month, year) { selectDateField(\'first_response_date_end\', day, month, year); }
function calendarCallback_closed(day, month, year) { selectDateField(\'closed_date\', day, month, year); }
function calendarCallback_closed_end(day, month, year) { selectDateField(\'closed_date_end\', day, month, year); }
function validateForm(f)
{
    // need to hack this value in the query string so the saved search options don\'t override this one
    if (!f.hide_closed.checked) {
        var field = getFormElement(f, \'hidden1\');
        field.name = \'hide_closed\';
        field.value = \'0\';
    }
    if (!f.show_authorized_issues.checked) {
        var field = getFormElement(f, \'hidden2\');
        field.name = \'show_authorized_issues\';
        field.value = \'\';
    }
    if (!f.show_notification_list_issues.checked) {
        var field = getFormElement(f, \'hidden3\');
        field.name = \'show_notification_list_issues\';
        field.value = \'\';
    }
    return true;
}

function changeDateFieldsVisibility(display)
{

    var elements_to_hide = new Array(\'created_date\', \'updated_date\', \'first_response_date\', \'last_response_date\', \'closed_date\');
    for (var i = 0; i < elements_to_hide.length; i++) {
        element_name = \'date_field_row_\' + i;

        changeVisibility(element_name, display, true);

        if ((display == false) || ((display == true) && (getPageElement(\'filter[\' + elements_to_hide[i] + \']\').checked == true))) {
            var selects = getPageElement(element_name).getElementsByTagName(\'select\');
            for (var j = 0; j < selects.length; j++) {
                selects[j].disabled = !display;
            }
        }
        var inputs = getPageElement(element_name).getElementsByTagName(\'input\');
        for (var j = 0; j < inputs.length; j++) {
            inputs[j].disabled = !display;
        }
    }
}


function disableCustomFields(disable)
{
    var selects = getPageElement(\'custom_fields_row\').getElementsByTagName(\'select\');
    for (var i = 0; i < selects.length; i++) {
        selects[i].disabled = disable;
    }
    var inputs = getPageElement(\'custom_fields_row\').getElementsByTagName(\'input\');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = disable;
    }

    // enable/disable hidden field
    getPageElement(\'custom_field_hidden\').disabled = !disable;
}
//-->
</script>
'; ?>

<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      &nbsp;
    </td>
    <td>
      <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td colspan="4" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Advanced Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" align="right">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'adv_search')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
        <form name="custom_filter_form" method="get" action="list.php" onSubmit="javascript:return validateForm(this);">
        <input type="hidden" name="cat" value="search">
        <input type="hidden" name="hidden1" value="">
        <input type="hidden" name="hidden2" value="">
        <input type="hidden" name="hidden3" value="">
        <input id="custom_field_hidden" type="hidden" name="custom_field" value="">
        <input id="created_date_hidden" type="hidden" name="created_date" value="">
        <input id="updated_date_hidden" type="hidden" name="updated_date" value="">
        <input id="first_response_date_hidden" type="hidden" name="first_response_date" value="">
        <input id="last_response_date_hidden" type="hidden" name="last_response_date" value="">
        <input id="closed_date_hidden" type="hidden" name="closed_date" value="">
        <tr>
          <td nowrap colspan="1">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Keyword(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <input class="default" type="text" name="keywords" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['options']['cst_keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="40">
          </td>
          <td colspan="3">
            <?php if ($this->_tpl_vars['has_customer_integration']): ?>
            <input class="default" type="radio" name="search_type" value="customer" id="search_type_customer" <?php if ($this->_tpl_vars['options']['cst_search_type'] != 'all_text'): ?>checked<?php endif; ?>> <label for="search_type_customer" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer Identity (e.g. "Example Inc.", "johndoe@example.com", 12345)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label><br />
            <input class="default" type="radio" name="search_type" value="all_text" id="search_type_all_text" <?php if ($this->_tpl_vars['options']['cst_search_type'] == 'all_text'): ?>checked<?php endif; ?>> <label for="search_type_all_text" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Text (emails, notes, etc)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            <?php else: ?>
            <input type="hidden" name="search_type" value="all_text">
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td valign="top">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="users" class="default">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users'],'selected' => $this->_tpl_vars['options']['cst_users']), $this);?>

            </select>
          </td>
          <?php if (count($this->_tpl_vars['cats']) > 0): ?>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="category" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prc_id'] => $this->_tpl_vars['prc_title']):
?>
              <option value="<?php echo $this->_tpl_vars['prc_id']; ?>
" <?php if ($this->_tpl_vars['prc_id'] == $this->_tpl_vars['options']['cst_iss_prc_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['prc_title']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </td>
          <?php endif; ?>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="priority" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['priorities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <option value="<?php echo $this->_tpl_vars['priorities'][$this->_sections['i']['index']]['pri_id']; ?>
" <?php if ($this->_tpl_vars['priorities'][$this->_sections['i']['index']]['pri_id'] == $this->_tpl_vars['options']['cst_iss_pri_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['priorities'][$this->_sections['i']['index']]['pri_title']; ?>
</option>
              <?php endfor; endif; ?>
            </select>
          </td>
          <td valign="top">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="status" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sta_id'] => $this->_tpl_vars['sta_title']):
?>
              <option value="<?php echo $this->_tpl_vars['sta_id']; ?>
" <?php if ($this->_tpl_vars['sta_id'] == $this->_tpl_vars['options']['cst_iss_sta_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['sta_title']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reporter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="reporter" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['reporters'],'selected' => $this->_tpl_vars['options']['cst_reporter']), $this);?>

            </select>
          </td>
          <?php if (count($this->_tpl_vars['releases']) > 0): ?>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Release<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="release" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php $_from = $this->_tpl_vars['releases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pre_id'] => $this->_tpl_vars['pre_title']):
?>
              <option value="<?php echo $this->_tpl_vars['pre_id']; ?>
" <?php if ($this->_tpl_vars['pre_id'] == $this->_tpl_vars['options']['cst_iss_pre_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['pre_title']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </td>
          <?php endif; ?>
        </tr>
        <tr>
          <td align="center" class="default">
            <input type="checkbox" name="hide_closed" value="1" <?php if ($this->_tpl_vars['options']['cst_hide_closed'] == 1): ?>checked<?php endif; ?>> <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('custom_filter_form', 'hide_closed');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hide Closed Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rows Per Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="rows" class="default">
              <option value="100" <?php if ($this->_tpl_vars['options']['cst_rows'] == 100): ?>selected<?php endif; ?>>100</option>
              <option value="50" <?php if ($this->_tpl_vars['options']['cst_rows'] == 50): ?>selected<?php endif; ?>>50</option>
              <option value="25" <?php if ($this->_tpl_vars['options']['cst_rows'] == 25): ?>selected<?php endif; ?>>25</option>
              <option value="10" <?php if ($this->_tpl_vars['options']['cst_rows'] == 10): ?>selected<?php endif; ?>>10</option>
              <option value="5" <?php if ($this->_tpl_vars['options']['cst_rows'] == 5): ?>selected<?php endif; ?>>5</option>
              <option value="ALL" <?php if ($this->_tpl_vars['options']['cst_rows'] == 'ALL'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ALL<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            </select>
          </td>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sort By<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="sort_by" class="default">
              <option value="last_action_date" <?php if ($this->_tpl_vars['options']['cst_sort_by'] == 'last_action_date'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Action Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <option value="iss_pri_id" <?php if ($this->_tpl_vars['options']['cst_sort_by'] == 'iss_pri_id'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <option value="iss_id" <?php if ($this->_tpl_vars['options']['cst_sort_by'] == 'iss_id'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issue ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <option value="sta_rank" <?php if ($this->_tpl_vars['options']['cst_sort_by'] == 'sta_rank'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <option value="iss_summary" <?php if ($this->_tpl_vars['options']['cst_sort_by'] == 'iss_summary'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            </select>
          </td>
          <td colspan="2">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sort Order<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="sort_order" class="default">
              <option value="desc" <?php if ($this->_tpl_vars['options']['cst_sort_order'] == 'desc'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>descending<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <option value="asc" <?php if ($this->_tpl_vars['options']['cst_sort_order'] == 'asc'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ascending<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            </select>
          </td>
        </tr>
	<?php if (! $this->_tpl_vars['is_anon_user']): ?>
        <tr>
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap class="default">
                  <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Issues in Which I Am<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:&nbsp;
                </td>
                <td width="80%" class="default">
                  <input type="checkbox" name="show_authorized_issues" value="yes" <?php if ($this->_tpl_vars['options']['cst_show_authorized'] == 'yes'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('custom_filter_form', 'show_authorized_issues');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Authorized to Send Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                  <input type="checkbox" name="show_notification_list_issues" value="yes" <?php if ($this->_tpl_vars['options']['cst_show_notification_list'] == 'yes'): ?>checked<?php endif; ?>>
                  <a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('custom_filter_form', 'show_notification_list_issues');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Notification List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
	<?php endif; ?>
        <tr>
          <td colspan="5">
          <hr>
            <input id="show_date_fields_checkbox" type="checkbox" name="show_date_fields" value="1" class="default" onClick="changeDateFieldsVisibility(this.checked)">
            <label for="show_date_fields_checkbox" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show date fields to search by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
          </td>
        </tr>
        <tr id="date_field_row_0" style="display: none">
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap width="60%">
                  <input <?php if ($this->_tpl_vars['options']['cst_created_date_filter_type'] != ""): ?>checked<?php endif; ?> type="checkbox" id="filter[created_date]" name="filter[created_date]" value="yes" onClick="javascript:toggleDateFields(this.form, 'created_date');">
                  <span class="default"><label for="filter[created_date]"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Created<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label></span><br />
                  <select name="created_date[filter_type]" class="default" onChange="javascript:checkDateFilterType(this.form, this);">
                    <option <?php if ($this->_tpl_vars['options']['cst_created_date_filter_type'] == 'greater'): ?>selected<?php endif; ?> value="greater"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_created_date_filter_type'] == 'less'): ?>selected<?php endif; ?> value="less"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_created_date_filter_type'] == 'between'): ?>selected<?php endif; ?> value="between"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_created_date_filter_type'] == 'in_past'): ?>selected<?php endif; ?> value="in_past"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Past<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>&nbsp;
                  <span id="created_date1">
                  <?php echo smarty_function_html_select_date(array('field_array' => 'created_date','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar = new dynCalendar('tCalendar', 'calendarCallback_created', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar.setMonthCombo(false);
                  tCalendar.setYearCombo(false);
                  //-->
                  </script>&nbsp;&nbsp;
                  </span>
                  <span id="created_date_last">
                  <input type="text" name="created_date[time_period]" size="3" class="default" value="<?php echo $this->_tpl_vars['options']['cst_created_date_time_period']; ?>
"> <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  &nbsp;&nbsp;
                  </span>
                </td>
                <td nowrap id="created_date2" width="40%" valign="bottom">
                  <span class="default">Created: <i>(End date)</i></span><br />
                  <?php echo smarty_function_html_select_date(array('field_array' => 'created_date_end','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar2 = new dynCalendar('tCalendar2', 'calendarCallback_created_end', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar2.setMonthCombo(false);
                  tCalendar2.setYearCombo(false);
                  //-->
                  </script>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr id="date_field_row_1" style="display: none">
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap width="60%">
                  <input <?php if ($this->_tpl_vars['options']['cst_updated_date_filter_type'] != ""): ?>checked<?php endif; ?> type="checkbox" id="filter[updated_date]" name="filter[updated_date]" value="yes" onClick="javascript:toggleDateFields(this.form, 'updated_date');">
                  <span class="default"><label for="filter[updated_date]"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Updated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label></span><br />
                  <select name="updated_date[filter_type]" class="default" onChange="javascript:checkDateFilterType(this.form, this);">
                    <option <?php if ($this->_tpl_vars['options']['cst_updated_date_filter_type'] == 'greater'): ?>selected<?php endif; ?> value="greater"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_updated_date_filter_type'] == 'less'): ?>selected<?php endif; ?> value="less"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_updated_date_filter_type'] == 'between'): ?>selected<?php endif; ?> value="between"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_updated_date_filter_type'] == 'null'): ?>selected<?php endif; ?> value="null"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Is Null<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_updated_date_filter_type'] == 'in_past'): ?>selected<?php endif; ?> value="in_past"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Past<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>&nbsp;
                  <span id="updated_date1">
                  <?php echo smarty_function_html_select_date(array('field_array' => 'updated_date','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar3 = new dynCalendar('tCalendar3', 'calendarCallback_updated', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar3.setMonthCombo(false);
                  tCalendar3.setYearCombo(false);
                  //-->
                  </script>&nbsp;&nbsp;
                  </span>
                  <span id="updated_date_last">
                  <input type="text" name="updated_date[time_period]" size="3" class="default" value="<?php echo $this->_tpl_vars['options']['cst_updated_date_time_period']; ?>
"> <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  &nbsp;&nbsp;
                  </span>
                </td>
                <td nowrap id="updated_date2" width="40%" valign="bottom">
                  <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Updated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>End date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span><br />
                  <?php echo smarty_function_html_select_date(array('field_array' => 'updated_date_end','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar4 = new dynCalendar('tCalendar4', 'calendarCallback_updated_end', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar4.setMonthCombo(false);
                  tCalendar4.setYearCombo(false);
                  //-->
                  </script>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr id="date_field_row_2" style="display: none">
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap width="60%">
                  <input <?php if ($this->_tpl_vars['options']['cst_first_response_date_filter_type'] != ""): ?>checked<?php endif; ?> type="checkbox" id="filter[first_response_date]" name="filter[first_response_date]" value="yes" onClick="javascript:toggleDateFields(this.form, 'first_response_date');">
                  <span class="default"><label for="filter[first_response_date]"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First Response by Staff<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label></span><br />
                  <select name="first_response_date[filter_type]" class="default" onChange="javascript:checkDateFilterType(this.form, this);">
                    <option <?php if ($this->_tpl_vars['options']['cst_first_response_date_filter_type'] == 'greater'): ?>selected<?php endif; ?> value="greater"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_first_response_date_filter_type'] == 'less'): ?>selected<?php endif; ?> value="less"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_first_response_date_filter_type'] == 'between'): ?>selected<?php endif; ?> value="between"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_first_response_date_filter_type'] == 'null'): ?>selected<?php endif; ?> value="null"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Is Null<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_first_response_date_filter_type'] == 'in_past'): ?>selected<?php endif; ?> value="in_past"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Past<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>&nbsp;
                  <span id="first_response_date1">
                  <?php echo smarty_function_html_select_date(array('field_array' => 'first_response_date','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar7 = new dynCalendar('tCalendar7', 'calendarCallback_first_response', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar7.setMonthCombo(false);
                  tCalendar7.setYearCombo(false);
                  //-->
                  </script>&nbsp;&nbsp;
                  </span>
                  <span id="first_response_date_last">
                  <input type="text" name="first_response_date[time_period]" size="3" class="default" value="<?php echo $this->_tpl_vars['options']['cst_first_response_date_time_period']; ?>
"> <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  &nbsp;&nbsp;
                  </span>
                </td>
                <td nowrap id="first_response_date2" width="40%" valign="bottom">
                  <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First Response By Staff<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>End date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span><br />
                  <?php echo smarty_function_html_select_date(array('field_array' => 'first_response_date_end','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar8 = new dynCalendar('tCalendar8', 'calendarCallback_first_response_end', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar8.setMonthCombo(false);
                  tCalendar8.setYearCombo(false);
                  //-->
                  </script>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr id="date_field_row_3" style="display: none">
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap width="60%">
                  <input <?php if ($this->_tpl_vars['options']['cst_last_response_date_filter_type'] != ""): ?>checked<?php endif; ?> type="checkbox" id="filter[last_response_date]" name="filter[last_response_date]" value="yes" onClick="javascript:toggleDateFields(this.form, 'last_response_date');">
                  <span class="default"><label for="filter[last_response_date]"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Response by Staff<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label></span><br />
                  <select name="last_response_date[filter_type]" class="default" onChange="javascript:checkDateFilterType(this.form, this);">
                    <option <?php if ($this->_tpl_vars['options']['cst_last_response_date_filter_type'] == 'greater'): ?>selected<?php endif; ?> value="greater"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_last_response_date_filter_type'] == 'less'): ?>selected<?php endif; ?> value="less"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_last_response_date_filter_type'] == 'between'): ?>selected<?php endif; ?> value="between"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_last_response_date_filter_type'] == 'null'): ?>selected<?php endif; ?> value="null"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Is Null<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_last_response_date_filter_type'] == 'in_past'): ?>selected<?php endif; ?> value="in_past"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Past<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>&nbsp;
                  <span id="last_response_date1">
                  <?php echo smarty_function_html_select_date(array('field_array' => 'last_response_date','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar5 = new dynCalendar('tCalendar5', 'calendarCallback_last_response', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar5.setMonthCombo(false);
                  tCalendar5.setYearCombo(false);
                  //-->
                  </script>&nbsp;&nbsp;
                  </span>
                  <span id="last_response_date_last">
                  <input type="text" name="last_response_date[time_period]" size="3" class="default" value="<?php echo $this->_tpl_vars['options']['cst_last_response_date_time_period']; ?>
"> <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  &nbsp;&nbsp;
                  </span>
                </td>
                <td nowrap id="last_response_date2" width="40%" valign="bottom">
                  <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Response by Staff<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>End date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span><br />
                  <?php echo smarty_function_html_select_date(array('field_array' => 'last_response_date_end','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar6 = new dynCalendar('tCalendar6', 'calendarCallback_last_response_end', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar6.setMonthCombo(false);
                  tCalendar6.setYearCombo(false);
                  //-->
                  </script>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr id="date_field_row_4" style="display: none">
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap width="60%">
                  <input <?php if ($this->_tpl_vars['options']['cst_closed_date_filter_type'] != ""): ?>checked<?php endif; ?> type="checkbox" id="filter[closed_date]" name="filter[closed_date]" value="yes" onClick="javascript:toggleDateFields(this.form, 'closed_date');">
                  <span class="default"><label for="filter[closed_date]"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status Closed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label></span><br />
                  <select name="closed_date[filter_type]" class="default" onChange="javascript:checkDateFilterType(this.form, this);">
                    <option <?php if ($this->_tpl_vars['options']['cst_closed_date_filter_type'] == 'greater'): ?>selected<?php endif; ?> value="greater"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_closed_date_filter_type'] == 'less'): ?>selected<?php endif; ?> value="less"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_closed_date_filter_type'] == 'between'): ?>selected<?php endif; ?> value="between"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_closed_date_filter_type'] == 'null'): ?>selected<?php endif; ?> value="null"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Is Null<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['cst_closed_date_filter_type'] == 'in_past'): ?>selected<?php endif; ?> value="in_past"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>In Past<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>&nbsp;
                  <span id="closed_date1">
                  <?php echo smarty_function_html_select_date(array('field_array' => 'closed_date','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar9 = new dynCalendar('tCalendar9', 'calendarCallback_closed', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar9.setMonthCombo(false);
                  tCalendar9.setYearCombo(false);
                  //-->
                  </script>&nbsp;&nbsp;
                  </span>
                  <span id="closed_date_last">
                  <input type="text" name="closed_date[time_period]" size="3" class="default" value="<?php echo $this->_tpl_vars['options']['cst_closed_date_time_period']; ?>
"> <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hours<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  &nbsp;&nbsp;
                  </span>
                  </span>
                </td>
                <td nowrap id="closed_date2" width="40%" valign="bottom">
                  <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status Closed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>End date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span><br />
                  <?php echo smarty_function_html_select_date(array('field_array' => 'closed_date_end','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar10 = new dynCalendar('tCalendar10', 'calendarCallback_closed_end', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar10.setMonthCombo(false);
                  tCalendar10.setYearCombo(false);
                  //-->
                  </script>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?php if ($this->_tpl_vars['custom_fields'] != ''): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "adv_search_custom_fields.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
        <tr>
          <td colspan="5" align="center">
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Run Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <input class="button" type="reset" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          </td>
        </tr>
	<?php if (! $this->_tpl_vars['is_anon_user']): ?>
        <tr>
          <td colspan="5" align="center" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span>
            <input type="text" name="title" class="default" value="<?php echo $this->_tpl_vars['options']['cst_title']; ?>
">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'title')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['roles']['manager']): ?>
            <input type="checkbox" id="is_global" name="is_global" value="1" <?php if ($this->_tpl_vars['options']['cst_is_global']): ?>checked<?php endif; ?>>
            <span class="default"><label for="is_global"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Global Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label></span>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td colspan="5" align="center" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
            <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:saveCustomFilter(this.form);">
          </td>
        </tr>
	<?php endif; ?>
        </form>
      </table>
    </td>
    <td>
      &nbsp;
    </td>
  </tr>
</table>
<?php if (! $this->_tpl_vars['is_anon_user']): ?>
<br />
<table width="450" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="2">
        <form onSubmit="javascript:return validateRemove(this);" method="post" action="popup.php" target="_removeFilter">
        <input type="hidden" name="cat" value="delete_filter">
        <tr>
          <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" colspan="3">
            <span class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b></span>
          </td>
        </tr>
        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['custom']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <tr>
          <td width="2">
            <input type="checkbox" name="item[]" value="<?php echo $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_id']; ?>
" <?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['roles']['manager'] && $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_is_global']): ?>disabled<?php endif; ?>>
          </td>
          <td width="100%">
            <span class="default">
            <?php if ($this->_tpl_vars['current_role'] < $this->_tpl_vars['roles']['manager'] && $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_is_global']): ?>
            <?php echo $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_title']; ?>

            <?php else: ?>
            <a href="adv_search.php?custom_id=<?php echo $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_id']; ?>
" class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>edit this custom search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_title']; ?>
</a>
            <?php endif; ?>
            </span>
            <?php if ($this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_is_global']): ?><span class="small_default"><i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>global filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span><?php endif; ?>
          </td>
          <td>
            <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>RSS feed for this custom search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="rss.php?custom_id=<?php echo $this->_tpl_vars['custom'][$this->_sections['i']['index']]['cst_id']; ?>
"><img src="images/icons/rss.gif" border="0"></a>
          </td>
        </tr>
        <?php if ($this->_sections['i']['last'] && $this->_sections['i']['total'] > 0): ?>
        <tr bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
          <td colspan="3">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');">
                </td>
                <td align="right">
                  <input type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remove Selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button">
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?php endif; ?>
        <?php endfor; else: ?>
        <tr>
          <td class="default" colspan="3" align="center">
            <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No custom searches could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
          </td>
        </tr>
        <?php endif; ?>
        </form>
      </table>
    </td>
  </tr>
</table>
<?php endif; ?>

<script type="text/javascript">
<!--
var f = getForm('custom_filter_form');

var date_fields = new Array();
date_fields[date_fields.length] = new Option('created_date', '<?php echo $this->_tpl_vars['options']['cst_created_date']; ?>
');
date_fields[date_fields.length] = new Option('created_date_end', '<?php echo $this->_tpl_vars['options']['cst_created_date_end']; ?>
');
date_fields[date_fields.length] = new Option('updated_date', '<?php echo $this->_tpl_vars['options']['cst_updated_date']; ?>
');
date_fields[date_fields.length] = new Option('updated_date_end', '<?php echo $this->_tpl_vars['options']['cst_updated_date_end']; ?>
');
date_fields[date_fields.length] = new Option('last_response_date', '<?php echo $this->_tpl_vars['options']['cst_last_response_date']; ?>
');
date_fields[date_fields.length] = new Option('last_response_date_end', '<?php echo $this->_tpl_vars['options']['cst_last_response_date_end']; ?>
');
date_fields[date_fields.length] = new Option('first_response_date', '<?php echo $this->_tpl_vars['options']['cst_first_response_date']; ?>
');
date_fields[date_fields.length] = new Option('first_response_date_end', '<?php echo $this->_tpl_vars['options']['cst_first_response_date_end']; ?>
');
date_fields[date_fields.length] = new Option('closed_date', '<?php echo $this->_tpl_vars['options']['cst_closed_date']; ?>
');
date_fields[date_fields.length] = new Option('closed_date_end', '<?php echo $this->_tpl_vars['options']['cst_closed_date_end']; ?>
');

<?php echo '
var elements_to_hide = new Array(\'created_date\', \'updated_date\', \'first_response_date\', \'last_response_date\', \'closed_date\');
for (var i = 0; i < elements_to_hide.length; i++) {
    toggleVisibility(elements_to_hide[i], false, true);
    toggleDateFields(f, elements_to_hide[i]);
    var filter_type = getFormElement(f, elements_to_hide[i] + \'[filter_type]\');
    checkDateFilterType(f, filter_type);
}

for (var i = 0; i < date_fields.length; i++) {
    if (!isWhitespace(date_fields[i].value)) {
        selectDateOptions(date_fields[i].text, date_fields[i].value);
    }
}
'; ?>


<?php if ($this->_tpl_vars['options']['cst_created_date_filter_type'] != "" || $this->_tpl_vars['options']['cst_updated_date_filter_type'] != "" || $this->_tpl_vars['options']['cst_first_response_date_filter_type'] != "" || $this->_tpl_vars['options']['cst_last_response_date_filter_type'] != "" || $this->_tpl_vars['options']['cst_closed_date_filter_type'] != ""): ?>
    changeDateFieldsVisibility(true);
    getPageElement('show_date_fields_checkbox').checked = true;
<?php endif; ?>

// determine if the custom fields section should be displayed
<?php $this->assign('custom_field_has_value', '0'); ?>
<?php $_from = $this->_tpl_vars['custom_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['custom_fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['custom_fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['custom_fields']['iteration']++;
?>
  <?php if ($this->_tpl_vars['options']['cst_custom_field'][$this->_tpl_vars['field']['fld_id']] != '' && $this->_tpl_vars['custom_field_has_value'] != 1): ?>
    changeVisibility('custom_fields_row', true);
    getPageElement('show_custom_fields_checkbox').checked = true;
    disableCustomFields(false);
    <?php $this->assign('custom_field_has_value', '1'); ?>
  <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
//-->
</script>

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