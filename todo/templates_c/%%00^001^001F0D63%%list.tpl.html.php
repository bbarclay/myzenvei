<?php /* Smarty version 2.6.18, created on 2010-07-29 16:08:45
         compiled from list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'list.tpl.html', 45, false),array('modifier', 'count', 'list.tpl.html', 167, false),array('modifier', 'default', 'list.tpl.html', 213, false),array('modifier', 'escape', 'list.tpl.html', 214, false),array('modifier', 'formatCustomValue', 'list.tpl.html', 251, false),array('function', 'math', 'list.tpl.html', 169, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('extra_title' => 'List of Issues')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "quick_filter_form.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "current_filters.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<script type="text/javascript">
<!--
var page_url = '<?php echo $_SERVER['PHP_SELF']; ?>
';
var current_page = <?php if ($this->_tpl_vars['list_info']['current_page'] == ''): ?>0<?php else: ?><?php echo $this->_tpl_vars['list_info']['current_page']; ?>
<?php endif; ?>;
var last_page = <?php if ($this->_tpl_vars['list_info']['last_page'] == ''): ?>0<?php else: ?><?php echo $this->_tpl_vars['list_info']['last_page']; ?>
<?php endif; ?>;
<?php echo '
// this function will display the bulk update form if any issues are selected.
// if no issues are selected it will be hidden.
function toggleBulkUpdate()
{
    var items = document.getElementsByName(\'item[]\');

    // loop through looking to see which are checked
    var show = false;
    for (var i = 0; i < items.length; i++) {
        if (items[i].checked) {
            show = true;
            break;
        }
    }
    if (show) {
        changeVisibility(\'bulk_update1\', show);
    }
}
function resetBulkUpdate()
{
    var f = getForm(\'list_form\');
    clearSelectedOptions(getFormElement(f, \'users[]\'));
    clearSelectedOptions(getFormElement(f, \'status\'));
    if (getFormElement(f, \'release\')) {
        clearSelectedOptions(getFormElement(f, \'release\'));
    }
}
function bulkUpdate()
{
    var f = getForm(\'list_form\');
    if (!hasOneChecked(f, \'item[]\')) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose which issues to update.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }

    // figure out what is changing
    var changed = new Array();
    if (hasOneSelected(f, \'users[]\')) {
        changed[changed.length] = \'Assignment\';
    }
    if (f.elements.status.selectedIndex != 0) {
        changed[changed.length] = \'Status\';
    }
    if ((f.elements.release) && (f.elements.release.selectedIndex != 0)) {
        changed[changed.length] = \'Release\';
    }
    if ((f.elements.priority) && (f.elements.priority.selectedIndex != 0)) {
        changed[changed.length] = \'Priority\';
    }
    if ((f.elements.category) && (f.elements.category.selectedIndex != 0)) {
        changed[changed.length] = \'Category\';
    }
    if ((f.elements.closed_status) && (f.elements.closed_status.selectedIndex != 0)) {
        changed[changed.length] = \'Closed Status\';
    }
    if (changed.length < 1) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose new values for the selected issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        return false;
    }
    var msg = \''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Warning: If you continue, you will change the <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\';
    for (var i = 0; i < changed.length; i++) {
        msg += changed[i];
        if ((changed.length > 1) && (i == (changed.length-2))) {
            msg += \' and \';
        } else {
            if (i != (changed.length-1)) {
                msg += \', \';
            }
        }
    }
    msg += \' '; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>for all selected issues. Are you sure you want to continue?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\';
    if (!confirm(msg)) {
        return false;
    }
    var features = \'width=420,height=200,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var popupWin = window.open(\'\', \'_popup\', features);
    popupWin.focus();
    f.action = \'popup.php\';
    f.target = \'_popup\';
    f.submit();
}
function hideClosed(f)
{
    if (f.hide_closed.checked) {
        window.location.href = page_url + "?" + replaceParam(window.location.href, \'hide_closed\', \'1\');
    } else {
        window.location.href = page_url + "?" + replaceParam(window.location.href, \'hide_closed\', \'0\');
    }
}
function resizePager(f)
{
    var pagesize = f.page_size.options[f.page_size.selectedIndex].value;
    window.location.href = page_url + "?" + replaceParam(window.location.href, \'rows\', pagesize);
}
function checkPageField(ev)
{
    // check if the user is trying to submit the form by hitting <enter>
    if (((window.event) && (window.event.keyCode == 13)) ||
            ((ev) && (ev.which == 13))) {
        return false;
    }
}
function goPage(f, new_page)
{
    if ((new_page > last_page+1) || (new_page <= 0) ||
            (new_page == current_page+1) || (!isNumberOnly(new_page))) {
        f.page.value = current_page+1;
        return false;
    }
    setPage(new_page-1);
}
function setPage(new_page)
{
    if ((new_page > last_page) || (new_page < 0) ||
            (new_page == current_page)) {
        return false;
    }
    window.location.href = page_url + "?" + replaceParam(window.location.href, \'pagerRow\', new_page);
}
function downloadCSV()
{
    var f = this.document.csv_form;
    f.submit();
    return false;
}
window.onload = disableFields;
function disableFields()
{
    var f = document.list_form;
    if (current_page == 0) {
        f.first.disabled = true;
        f.previous.disabled = true;
    }
    if ((current_page == last_page) || (last_page <= 0)) {
        f.next.disabled = true;
        f.last.disabled = true;
    }
    if ((current_page == 0) && (last_page <= 0)) {
        f.page.disabled = true;
        f.go.disabled = true;
    }
}
function updateCustomFields(issue_id)
{
    var features = \'width=560,height=460,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var customWin = window.open(\'custom_fields.php?issue_id=\' + issue_id, \'_custom_fields\', features);
    customWin.focus();
    return false;
}
//-->
</script>
'; ?>

<?php $this->assign('col_count', count($this->_tpl_vars['columns'])); ?>
<?php if (count($this->_tpl_vars['list_info']['custom_fields']) > 1): ?>
<?php echo smarty_function_math(array('assign' => 'col_count','equation' => "x+y-1",'x' => $this->_tpl_vars['col_count'],'y' => count($this->_tpl_vars['list_info']['custom_fields'])), $this);?>

<?php endif; ?>
<?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>
    <?php echo smarty_function_math(array('assign' => 'col_count','equation' => "x+1",'x' => $this->_tpl_vars['col_count']), $this);?>

<?php endif; ?>
<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <form name="list_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
  <input type="hidden" name="cat" value="bulk_update">
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="<?php echo $this->_tpl_vars['col_count']; ?>
" class="default">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tr>
                <td class="default">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Results<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo $this->_tpl_vars['list_info']['total_rows']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>issues found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if ($this->_tpl_vars['list_info']['end_offset'] > 0): ?>, <?php echo smarty_function_math(array('equation' => "x + 1",'x' => $this->_tpl_vars['list_info']['start_offset']), $this);?>
 - <?php echo $this->_tpl_vars['list_info']['end_offset']; ?>
 <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>shown<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>)</b>
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "help_link.tpl.html", 'smarty_include_vars' => array('topic' => 'list')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
                <?php if ($this->_tpl_vars['current_role'] != $this->_tpl_vars['roles']['customer']): ?>
                <td align="right" class="default" nowrap>
                  <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
                  <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hide/show<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
                  [ <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hide / show the quick search form<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:toggleVisibility('filter_form');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>quick search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
                  <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>[ <a class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hide / show the advanced search form<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:toggleVisibility('custom_filter_form');"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>advanced search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]<?php endif; ?>
                  <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>[ <a class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('current_filters');"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>current filters<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]<?php endif; ?>
                  <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>[ <a class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('bulk_update');"> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>bulk update tool<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]<?php endif; ?>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
              </tr>
            </table>
          </td>
        </tr>
        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>
          <td width="1%">
            <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');toggleBulkUpdate();">
          </td>
          <?php endif; ?>
          <?php $_from = $this->_tpl_vars['columns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_name'] => $this->_tpl_vars['column']):
?>
          <?php if ($this->_tpl_vars['field_name'] == 'custom_fields'): ?>
            <?php $_from = $this->_tpl_vars['list_info']['custom_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fld_id'] => $this->_tpl_vars['fld_title']):
?>
              <?php $this->assign('fld_name_id', "custom_field_".($this->_tpl_vars['fld_id'])); ?>
                <td align="<?php echo ((is_array($_tmp=@$this->_tpl_vars['column']['align'])) ? $this->_run_mod_handler('default', true, $_tmp, 'center') : smarty_modifier_default($_tmp, 'center')); ?>
" class="default_white" nowrap>
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['fld_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" href="<?php echo $this->_tpl_vars['sorting']['links'][$this->_tpl_vars['fld_name_id']]; ?>
" class="white_link"><?php echo ((is_array($_tmp=$this->_tpl_vars['fld_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                  <?php if ($this->_tpl_vars['sorting']['images'][$this->_tpl_vars['fld_name_id']] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['fld_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" href="<?php echo $this->_tpl_vars['sorting']['links'][$this->_tpl_vars['fld_name_id']]; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images'][$this->_tpl_vars['fld_name_id']]; ?>
"></a><?php endif; ?>
                </td>
              <?php endforeach; endif; unset($_from); ?>
          <?php else: ?>
          <td align="<?php echo ((is_array($_tmp=@$this->_tpl_vars['column']['align'])) ? $this->_run_mod_handler('default', true, $_tmp, 'center') : smarty_modifier_default($_tmp, 'center')); ?>
" class="default_white" nowrap <?php if ($this->_tpl_vars['column']['width'] != ''): ?>width="<?php echo $this->_tpl_vars['column']['width']; ?>
"<?php endif; ?>>
            <?php if ($this->_tpl_vars['field_name'] == 'iss_summary'): ?>
            <table cellspacing="0" cellpadding="1" width="100%">
              <tr>
                <td class="default_white">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['iss_summary']; ?>
" class="white_link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                  <?php if ($this->_tpl_vars['sorting']['images']['iss_summary'] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['sorting']['links']['iss_summary']; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images']['iss_summary']; ?>
"></a><?php endif; ?>
                </td>
                <td align="right">
                  <span class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Export Data:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> <input alt="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>generate excel-friendly report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" type="image" src="<?php echo $this->_tpl_vars['rel_url']; ?>
images/excel.jpg" class="shortcut" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Export to Excel<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:return downloadCSV();">
                </td>
              </tr>
            </table>
            <?php elseif ($this->_tpl_vars['sorting']['links'][$this->_tpl_vars['field_name']] != ''): ?>
              <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['column']['title']; ?>
" href="<?php echo $this->_tpl_vars['sorting']['links'][$this->_tpl_vars['field_name']]; ?>
" class="white_link"><?php echo $this->_tpl_vars['column']['title']; ?>
</a>
              <?php if ($this->_tpl_vars['sorting']['images'][$this->_tpl_vars['field_name']] != ""): ?><a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>sort by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['column']['title']; ?>
" href="<?php echo $this->_tpl_vars['sorting']['links'][$this->_tpl_vars['field_name']]; ?>
" class="white_link"><img border="0" src="<?php echo $this->_tpl_vars['sorting']['images'][$this->_tpl_vars['field_name']]; ?>
"></a><?php endif; ?>
            <?php else: ?>
              <?php echo $this->_tpl_vars['column']['title']; ?>

            <?php endif; ?>
          </td>
          <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
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
        <tr <?php if ($this->_tpl_vars['current_role'] >= $this->_tpl_vars['roles']['developer'] && $this->_tpl_vars['list'][$this->_sections['i']['index']]['iqu_status'] > 0): ?>style="text-decoration: line-through;"<?php endif; ?>>
          <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>
          <td bgcolor="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['status_color']; ?>
" width="1%" class="default" align="center"><input type="checkbox" name="item[]" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']; ?>
" onchange="toggleBulkUpdate();"></td>
          <?php endif; ?>
          <?php $_from = $this->_tpl_vars['columns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_name'] => $this->_tpl_vars['column']):
?>
          <?php if ($this->_tpl_vars['field_name'] == 'custom_fields'): ?>
            <?php $_from = $this->_tpl_vars['list'][$this->_sections['i']['index']]['custom_field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fld_id'] => $this->_tpl_vars['fld_value']):
?>
                <td bgcolor="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['status_color']; ?>
" align="<?php echo ((is_array($_tmp=@$this->_tpl_vars['column']['align'])) ? $this->_run_mod_handler('default', true, $_tmp, 'center') : smarty_modifier_default($_tmp, 'center')); ?>
" class="default custom_field" onclick="return updateCustomFields(<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']; ?>
);">
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['fld_value'])) ? $this->_run_mod_handler('formatCustomValue', true, $_tmp, $this->_tpl_vars['fld_id'], $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']) : Custom_Field::formatValue($_tmp, $this->_tpl_vars['fld_id'], $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id'])); ?>

                </td>
              <?php endforeach; endif; unset($_from); ?>
          <?php else: ?>
          <td bgcolor="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['status_color']; ?>
" align="<?php echo ((is_array($_tmp=@$this->_tpl_vars['column']['align'])) ? $this->_run_mod_handler('default', true, $_tmp, 'center') : smarty_modifier_default($_tmp, 'center')); ?>
" class="default">
            <?php if ($this->_tpl_vars['field_name'] == 'iss_id'): ?>
              <a href="view.php?id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']; ?>
" class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view issue details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']; ?>
</a>
            <?php elseif ($this->_tpl_vars['field_name'] == 'pri_rank'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['pri_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_grp_id'): ?>
              <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['group']; ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'assigned'): ?>
              <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['assigned_users']; ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'time_spent'): ?>
              <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['time_spent']; ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'prc_title'): ?>
              <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['prc_title']; ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'pre_title'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['pre_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_customer_id'): ?>
              <a href="list.php?view=customer&customer_id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_customer_id']; ?>
" class="link"
              title="View other issues from this customer">
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['customer_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
            <?php elseif ($this->_tpl_vars['field_name'] == 'support_level'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['support_level'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'sta_rank'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['sta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_created_date'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_created_date'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_dev_time'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_dev_time'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'sta_change_date'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['status_change_date'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

            <?php elseif ($this->_tpl_vars['field_name'] == 'last_action_date'): ?>
              <?php $this->_tag_stack[] = array('t', array('1' => $this->_tpl_vars['list'][$this->_sections['i']['index']]['last_action_date_label'],'2' => $this->_tpl_vars['list'][$this->_sections['i']['index']]['last_action_date_diff'])); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>%1:
%2 ago<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php elseif ($this->_tpl_vars['field_name'] == 'usr_full_name'): ?>
              <a href="list.php?view=reporter&reporter_id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_usr_id']; ?>
" class="link"
              title="View other issues from this reporter">
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['usr_full_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_percent_complete'): ?>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_percent_complete'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
%
            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_expected_resolution_date'): ?>
              <div class="inline_date_pick" id="expected_resolution_date|<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_expected_resolution_date'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&nbsp;</div>
            <?php elseif ($this->_tpl_vars['field_name'] == 'iss_summary'): ?>
              <a href="view.php?id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_id']; ?>
" class="link" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view issue details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_summary'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
              <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['redeemed']): ?>
                  [Redeemed]
              <?php endif; ?>
              <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['iss_private'] == 1): ?>
                  <b>[Private]</b>
              <?php endif; ?>
            <?php endif; ?>
          </td>
          <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php endfor; else: ?>
        <tr bgcolor="gray">
          <td colspan="<?php echo $this->_tpl_vars['col_count']; ?>
" class="default_white" align="center">
            <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
          </td>
        </tr>
        <?php endif; ?>
        <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
          <td colspan="<?php echo $this->_tpl_vars['col_count']; ?>
">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30%" nowrap>
                  <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:toggleSelectAll(this.form, 'item[]');">
                  <?php endif; ?>
                </td>
                <td width="40%" align="center" nowrap>
                  <nobr>
                  <input name="first" type="button" value="|&lt;" class="shortcut" onClick="javascript:setPage(0);">
                  <input name="previous" type="button" value="&lt;&lt;" class="shortcut" onClick="javascript:setPage(<?php echo $this->_tpl_vars['list_info']['previous_page']; ?>
);">
                  <input type="text" name="page" size="3" maxlength="3" value="<?php if ($this->_tpl_vars['list_info']['current_page'] == ''): ?>1<?php else: ?><?php echo smarty_function_math(array('equation' => "x + 1",'x' => $this->_tpl_vars['list_info']['current_page']), $this);?>
<?php endif; ?>" style="background: <?php echo $this->_tpl_vars['cell_color']; ?>
;" class="paging_input" onKeyPress="javascript:return checkPageField(event);">
                  <input name="go" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:goPage(this.form, this.form.page.value);">
                  <input name="next" type="button" value="&gt;&gt;" class="shortcut" onClick="javascript:setPage(<?php echo $this->_tpl_vars['list_info']['next_page']; ?>
);">
                  <input name="last" type="button" value="&gt;|" class="shortcut" onClick="javascript:setPage(<?php echo $this->_tpl_vars['list_info']['last_page']; ?>
);">
                  </nobr>
                </td>
                <td nowrap>
                  <span class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Rows per Page:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
                  <select name="page_size" class="default" onChange="javascript:resizePager(this.form);">
                    <option value="5" <?php if ($this->_tpl_vars['options']['rows'] == 5): ?>selected<?php endif; ?>>5</option>
                    <option value="10" <?php if ($this->_tpl_vars['options']['rows'] == 10): ?>selected<?php endif; ?>>10</option>
                    <option value="25" <?php if ($this->_tpl_vars['options']['rows'] == 25): ?>selected<?php endif; ?>>25</option>
                    <option value="50" <?php if ($this->_tpl_vars['options']['rows'] == 50): ?>selected<?php endif; ?>>50</option>
                    <option value="100" <?php if ($this->_tpl_vars['options']['rows'] == 100): ?>selected<?php endif; ?>>100</option>
                    <option value="ALL" <?php if ($this->_tpl_vars['options']['rows'] == 'ALL'): ?>selected<?php endif; ?>><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>ALL<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                  </select>
                  <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="shortcut" onClick="javascript:resizePager(this.form);">
                </td>
                <td width="30%" class="default_white" align="right">
                  <input type="checkbox" id="hide_closed" name="hide_closed" <?php if ($this->_tpl_vars['options']['hide_closed']): ?>checked<?php endif; ?> onClick="javascript:hideClosed(this.form);"> <label for="hide_closed"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hide Closed Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>&nbsp;
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['developer']): ?>
  <tr>
    <td bgcolor="#FFFFFF">
      <br />
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bulk_update.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td>
  </tr>
  <?php endif; ?>
  </form>
  <form target="_csvWindow" method="post" action="csv.php" name="csv_form">
  <input type="hidden" name="csv_data" value="<?php echo $this->_tpl_vars['csv_data']; ?>
">
  </form>
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