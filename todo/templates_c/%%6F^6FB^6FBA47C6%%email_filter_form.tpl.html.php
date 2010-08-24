<?php /* Smarty version 2.6.18, created on 2010-08-07 16:02:23
         compiled from email_filter_form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_display_style', 'email_filter_form.tpl.html', 92, false),array('function', 'html_options', 'email_filter_form.tpl.html', 118, false),array('function', 'html_select_date', 'email_filter_form.tpl.html', 138, false),array('block', 't', 'email_filter_form.tpl.html', 103, false),array('modifier', 'escape', 'email_filter_form.tpl.html', 104, false),)), $this); ?>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/dynCalendar.js?c=8885"></script>
<?php echo '
<script type="text/javascript">
<!--
function clearFilters(f)
{
    f.keywords.value = \'\';
    f.sender.value = \'\';
    f.to.value = \'\';
    f.ema_id.selectedIndex = 0;
    var field = getFormElement(f, \'filter[arrival_date]\');
    field.checked = false;
    toggleDateFields(f, \'arrival_date\');
    var checkbox = getFormElement(f, \'filter[arrival_date]\');
    // need to hack this value in the query string so the saved search options don\'t override this one
    if (!checkbox.checked) {
        var field = getFormElement(f, \'hidden1\');
        field.name = \'filter[arrival_date]\';
        field.value = \'no\';
    }
    f.submit();
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
    selectOption(getForm(\'email_filter_form\'), field_name + \'[Day]\', day);
    selectOption(getForm(\'email_filter_form\'), field_name + \'[Month]\', month);
    selectOption(getForm(\'email_filter_form\'), field_name + \'[Year]\', year);
}
function checkDateFilterType(f, type_field)
{
    var option = getSelectedOption(f, type_field.name);
    var element_name = type_field.name.substring(0, type_field.name.indexOf(\'[\'));
    var element = getPageElement(element_name + 1);
    if ((option == \'between\') && (!isElementVisible(element))) {
        toggleVisibility(element_name, false);
    } else if ((option != \'between\') && (isElementVisible(element))) {
        toggleVisibility(element_name, false);
    }
}
function calendarCallback_arrival(day, month, year) { selectDateField(\'arrival_date\', day, month, year); }
function calendarCallback_arrival_end(day, month, year) { selectDateField(\'arrival_date_end\', day, month, year); }
function validateForm(f)
{
    var checkbox = getFormElement(f, \'filter[arrival_date]\');
    // need to hack this value in the query string so the saved search options don\'t override this one
    if (!checkbox.checked) {
        var field = getFormElement(f, \'hidden1\');
        field.name = \'filter[arrival_date]\';
        field.value = \'no\';
    }
    return true;
}
//-->
</script>
'; ?>

<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr id="filter_form1" <?php echo smarty_function_get_display_style(array('element_name' => 'filter_form'), $this);?>
>
    <td>
      &nbsp;
    </td>
    <td>
      <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="4">
        <form action="emails.php" method="get" name="email_filter_form" onSubmit="javascript:return validateForm(this);">
        <input type="hidden" name="cat" value="search">
        <input type="hidden" name="hidden1" value="">
        <tr>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject/Body:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
            <input class="default" type="text" name="keywords" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['options']['keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
          </td>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sender:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
            <input class="default" type="text" name="sender" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['options']['sender'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
          </td>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>To:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
            <input class="default" type="text" name="to" size="20" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['options']['to'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
          </td>
          <td>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email Account:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
            <select name="ema_id" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['accounts'],'selected' => $this->_tpl_vars['options']['ema_id']), $this);?>

            </select>
          </td>
          <td>
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:clearFilters(this.form);">
          </td>
        </tr>
        <tr>
          <td colspan="5">
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
              <tr>
                <td nowrap width="50%">
                  <input <?php if ($this->_tpl_vars['options']['filter']['arrival_date'] == 'yes'): ?>checked<?php endif; ?> type="checkbox" name="filter[arrival_date]" value="yes" onClick="javascript:toggleDateFields(this.form, 'arrival_date');">
                  <span class="default"><a id="link" class="link" href="javascript:void(null);" onClick="javascript:toggleCheckbox('email_filter_form', 'filter[arrival_date]');toggleDateFields(getForm('email_filter_form'), 'arrival_date');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter by Arrival Date:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span><br />
                  <select name="arrival_date[filter_type]" class="default" onChange="javascript:checkDateFilterType(this.form, this);">
                    <option <?php if ($this->_tpl_vars['options']['arrival_date']['filter_type'] == 'greater'): ?>selected<?php endif; ?> value="greater"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Greater Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['arrival_date']['filter_type'] == 'less'): ?>selected<?php endif; ?> value="less"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Less Than<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                    <option <?php if ($this->_tpl_vars['options']['arrival_date']['filter_type'] == 'between'): ?>selected<?php endif; ?> value="between"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Between<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>&nbsp;
                  <?php echo smarty_function_html_select_date(array('field_array' => 'arrival_date','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar7 = new dynCalendar('tCalendar7', 'calendarCallback_arrival', '<?php echo $this->_tpl_vars['rel_url']; ?>
images/');
                  tCalendar7.setMonthCombo(false);
                  tCalendar7.setYearCombo(false);
                  //-->
                  </script>&nbsp;&nbsp;
                </td>
                <td nowrap id="arrival_date1" width="50%" valign="bottom">
                  <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Arrival Date:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <i>(<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>End date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</i></span><br />
                  <?php echo smarty_function_html_select_date(array('field_array' => 'arrival_date_end','prefix' => "",'start_year' => "-10",'end_year' => "+10",'all_extra' => 'class="default"'), $this);?>

                  <script type="text/javascript" type="text/javascript">
                  <!--
                  tCalendar8 = new dynCalendar('tCalendar8', 'calendarCallback_arrival_end', '<?php echo $this->_tpl_vars['rel_url']; ?>
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
        </form>
      </table>
    </td>
    <td>
      &nbsp;
    </td>
  </tr>
</table>

<br />

<?php echo '
<script type="text/javascript">
<!--
var f = getForm(\'email_filter_form\');

'; ?>

var date_fields = new Array();
date_fields[date_fields.length] = new Option('arrival_date', '<?php echo $this->_tpl_vars['options']['arrival_date']['start']; ?>
');
date_fields[date_fields.length] = new Option('arrival_date_end', '<?php echo $this->_tpl_vars['options']['arrival_date']['end']; ?>
');
<?php echo '

var elements_to_hide = new Array(\'arrival_date\');
for (var i = 0; i < elements_to_hide.length; i++) {
    toggleVisibility(elements_to_hide[i]);
    toggleDateFields(f, elements_to_hide[i]);
    var filter_type = getFormElement(f, elements_to_hide[i] + \'[filter_type]\');
    checkDateFilterType(f, filter_type);
}

for (var i = 0; i < date_fields.length; i++) {
    if (!isWhitespace(date_fields[i].value)) {
        selectDateOptions(date_fields[i].text, date_fields[i].value);
    }
}
//-->
</script>
'; ?>
