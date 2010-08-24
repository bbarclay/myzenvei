<?php /* Smarty version 2.6.18, created on 2010-08-10 11:15:07
         compiled from reports/weekly.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'reports/weekly.tpl.html', 12, false),array('function', 'html_options', 'reports/weekly.tpl.html', 37, false),array('function', 'html_select_date', 'reports/weekly.tpl.html', 46, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
" name="weekly_report">
<input type="hidden" name="cat" value="generate">
<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" colspan="3" class="default_white">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Weekly Report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
        </tr>
        <tr>
          <td width="120" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Report Type:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="200" class="default" NOWRAP>
            <input type="radio" name="report_type" value="weekly" class="default" <?php if ($this->_tpl_vars['report_type'] != 'range'): ?>checked<?php endif; ?> onClick="changeType('weekly');">
                <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:checkRadio('weekly_report', 'report_type', 0);changeType('weekly');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Weekly<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
            <input type="radio" name="report_type" value="range" <?php if ($this->_tpl_vars['report_type'] == 'range'): ?>CHECKED<?php endif; ?> onClick="changeType('range');">
                <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:checkRadio('weekly_report', 'report_type', 1);changeType('range');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date Range<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
          </td>
          <td rowspan="5">
            <input type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Generate<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut">
          </td>
        </tr>
        <tr id="week_row">
          <td width="120" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Week<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="200">
            <select class="default" name="week">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['weeks'],'selected' => $this->_tpl_vars['week']), $this);?>

            </select>
          </td>
        </tr>
        <tr id="start_row">
          <td width="120" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Start<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="200">
            <?php echo smarty_function_html_select_date(array('time' => $this->_tpl_vars['start_date'],'prefix' => "",'field_array' => 'start','start_year' => "-2",'end_year' => "+1",'field_order' => 'YMD','month_format' => "%b",'day_value_format' => "%02d",'all_extra' => "class='default'"), $this);?>

          </td>
        </tr>
        <tr id="end_row">
          <td width="120" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>End:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
          <td width="200">
            <?php echo smarty_function_html_select_date(array('time' => $this->_tpl_vars['end_date'],'prefix' => "",'field_array' => 'end','start_year' => "-2",'end_year' => "+1",'field_order' => 'YMD','month_format' => "%b",'day_value_format' => "%02d",'all_extra' => "class='default'"), $this);?>

          </td>
        </tr>
        <tr>
          <td width="120" class="default">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Developer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="200">
            <select class="default" name="developer">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users'],'selected' => $this->_tpl_vars['developer']), $this);?>

            </select>
          </td>
        </tr>
        <tr>
          <td width="120" class="default" valign="top">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Options<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
          </td>
          <td width="200" class="default">
            <input type="checkbox" name="separate_closed" value="1" class="default" <?php if ($_POST['separate_closed'] == 1): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:toggleCheckbox('weekly_report', 'separate_closed', 0)"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Separate Closed Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
            <br />
            <input type="checkbox" name="separate_status_changed" value="1" class="default" <?php if ($_POST['separate_status_changed'] == 1): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:toggleCheckbox('weekly_report', 'separate_status_changed', 0)"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Separate Only Status Changes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
            <br />
            <input type="checkbox" name="ignore_statuses" value="1" class="default" <?php if ($_POST['ignore_statuses'] == 1): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:toggleCheckbox('weekly_report', 'ignore_statuses', 0)"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Ignore Issue Status Changes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
            <br />
            <input type="checkbox" name="show_per_issue" value="1" class="default" <?php if ($_POST['show_per_issue'] == 1): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:toggleCheckbox('weekly_report', 'show_per_issue', 0)"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Times spent on issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
            <br />
            <input type="checkbox" name="show_status" value="1" class="default" <?php if ($_POST['show_status'] == 1): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:toggleCheckbox('weekly_report', 'show_status', 0)"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;
            <br />
            <input type="checkbox" name="show_priority" value="1" class="default" <?php if ($_POST['show_priority'] == 1): ?>checked<?php endif; ?>>
            <a id="link" class="link" href="javascript:void(null)"
                            onClick="javascript:toggleCheckbox('weekly_report', 'show_priority', 0)"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<script type="text/javascript">
<?php echo '
function changeType(type) {
    if (type == \'range\') {
        document.getElementById(\'week_row\').style.display = \'none\';
        document.getElementById(\'start_row\').style.display = getDisplayStyle();
        document.getElementById(\'end_row\').style.display = getDisplayStyle();
    } else {
        document.getElementById(\'week_row\').style.display = getDisplayStyle();
        document.getElementById(\'start_row\').style.display = \'none\';
        document.getElementById(\'end_row\').style.display = \'none\';
    }
}
'; ?>


changeType('<?php echo $this->_tpl_vars['report_type']; ?>
');
</script>

<?php if ($this->_tpl_vars['data'] != ''): ?>
<pre>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reports/weekly_data.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</pre>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>