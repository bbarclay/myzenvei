<?php /* Smarty version 2.6.18, created on 2010-07-29 16:08:45
         compiled from quick_filter_form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'quick_filter_form.tpl.html', 60, false),array('function', 'get_display_style', 'quick_filter_form.tpl.html', 72, false),array('function', 'html_options', 'quick_filter_form.tpl.html', 132, false),array('modifier', 'serialize', 'quick_filter_form.tpl.html', 103, false),array('modifier', 'urlencode', 'quick_filter_form.tpl.html', 103, false),array('modifier', 'count', 'quick_filter_form.tpl.html', 106, false),array('modifier', 'escape', 'quick_filter_form.tpl.html', 113, false),)), $this); ?>

<?php echo '
<script type="text/javascript">
<!--
function clearFilters(f)
{
    f.keywords.value = \'\';
    f.users.selectedIndex = 0;
    f.category.selectedIndex = 0;
    f.status.selectedIndex = 0;
    f.priority.selectedIndex = 0;
    '; ?>

    <?php if ($this->_tpl_vars['has_customer_integration']): ?>
    document.getElementById('search_type_customer').checked = true;
    <?php else: ?>
    document.getElementById('search_type').value = 'all_text';
    <?php endif; ?>
    <?php echo '
    // now for the fields that are only available through the advanced search page
    setHiddenFieldValue(f, \'created_date[Year]\', \'\');
    setHiddenFieldValue(f, \'created_date[Month]\', \'\');
    setHiddenFieldValue(f, \'created_date[Day]\', \'\');
    setHiddenFieldValue(f, \'created_date[filter_type]\', \'\');
    setHiddenFieldValue(f, \'updated_date[Year]\', \'\');
    setHiddenFieldValue(f, \'updated_date[Month]\', \'\');
    setHiddenFieldValue(f, \'updated_date[Day]\', \'\');
    setHiddenFieldValue(f, \'updated_date[filter_type]\', \'\');
    setHiddenFieldValue(f, \'last_response_date[Year]\', \'\');
    setHiddenFieldValue(f, \'last_response_date[Month]\', \'\');
    setHiddenFieldValue(f, \'last_response_date[Day]\', \'\');
    setHiddenFieldValue(f, \'last_response_date[filter_type]\', \'\');
    setHiddenFieldValue(f, \'first_response_date[Year]\', \'\');
    setHiddenFieldValue(f, \'first_response_date[Month]\', \'\');
    setHiddenFieldValue(f, \'first_response_date[Day]\', \'\');
    setHiddenFieldValue(f, \'first_response_date[filter_type]\', \'\');
    setHiddenFieldValue(f, \'closed_date[Year]\', \'\');
    setHiddenFieldValue(f, \'closed_date[Month]\', \'\');
    setHiddenFieldValue(f, \'closed_date[Day]\', \'\');
    setHiddenFieldValue(f, \'closed_date[filter_type]\', \'\');
    setHiddenFieldValue(f, \'show_authorized_issues\', \'\');
    setHiddenFieldValue(f, \'show_notification_list_issues\', \'\');
    setHiddenFieldValue(f, \'reporter\', \'\');
    setHiddenFieldValue(f, \'customer_id\', \'\');
    //other fields
    setHiddenFieldValue(f, \'release\', \'\');
    setHiddenFieldValue(f, \'custom_field\', \'\');

    f.submit();
}
'; ?>

var get_urls = new Array();
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['csts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
get_urls[<?php echo $this->_tpl_vars['csts'][$this->_sections['i']['index']]['cst_id']; ?>
] = '<?php echo $this->_tpl_vars['csts'][$this->_sections['i']['index']]['url']; ?>
';
<?php endfor; endif; ?>
<?php echo '
function runCustomFilter(f)
{
    var cst_id = getSelectedOption(f, \'custom_filter\');
    if (isWhitespace(cst_id)) {
        alert(\''; ?>
<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please select the custom filter to search against.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
        f.custom_filter.focus();
        return false;
    }
    f.action = \'list.php?cat=search&\' + get_urls[cst_id];
    location.href = f.action;
    return false;
}
//-->
</script>
'; ?>

<table bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center" id="quick_filter">
  <tr id="filter_form1" <?php echo smarty_function_get_display_style(array('element_name' => 'filter_form'), $this);?>
>
    <td>
      &nbsp;
    </td>
    <td>
      <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="4">
        <form action="list.php" method="get">
        <input type="hidden" name="cat" value="search">
        <input type="hidden" name="pagerRow" value="0">
        <input type="hidden" name="created_date[Year]" value="<?php echo $this->_tpl_vars['options']['created_date']['Year']; ?>
">
        <input type="hidden" name="created_date[Month]" value="<?php echo $this->_tpl_vars['options']['created_date']['Month']; ?>
">
        <input type="hidden" name="created_date[Day]" value="<?php echo $this->_tpl_vars['options']['created_date']['Day']; ?>
">
        <input type="hidden" name="created_date[filter_type]" value="<?php echo $this->_tpl_vars['options']['created_date']['filter_type']; ?>
">
        <input type="hidden" name="updated_date[Year]" value="<?php echo $this->_tpl_vars['options']['updated_date']['Year']; ?>
">
        <input type="hidden" name="updated_date[Month]" value="<?php echo $this->_tpl_vars['options']['updated_date']['Month']; ?>
">
        <input type="hidden" name="updated_date[Day]" value="<?php echo $this->_tpl_vars['options']['updated_date']['Day']; ?>
">
        <input type="hidden" name="updated_date[filter_type]" value="<?php echo $this->_tpl_vars['options']['updated_date']['filter_type']; ?>
">
        <input type="hidden" name="last_response_date[Year]" value="<?php echo $this->_tpl_vars['options']['last_response_date']['Year']; ?>
">
        <input type="hidden" name="last_response_date[Month]" value="<?php echo $this->_tpl_vars['options']['last_response_date']['Month']; ?>
">
        <input type="hidden" name="last_response_date[Day]" value="<?php echo $this->_tpl_vars['options']['last_response_date']['Day']; ?>
">
        <input type="hidden" name="last_response_date[filter_type]" value="<?php echo $this->_tpl_vars['options']['last_response_date']['filter_type']; ?>
">
        <input type="hidden" name="first_response_date[Year]" value="<?php echo $this->_tpl_vars['options']['first_response_date']['Year']; ?>
">
        <input type="hidden" name="first_response_date[Month]" value="<?php echo $this->_tpl_vars['options']['first_response_date']['Month']; ?>
">
        <input type="hidden" name="first_response_date[Day]" value="<?php echo $this->_tpl_vars['options']['first_response_date']['Day']; ?>
">
        <input type="hidden" name="first_response_date[filter_type]" value="<?php echo $this->_tpl_vars['options']['first_response_date']['filter_type']; ?>
">
        <input type="hidden" name="closed_date[Year]" value="<?php echo $this->_tpl_vars['options']['closed_date']['Year']; ?>
">
        <input type="hidden" name="closed_date[Month]" value="<?php echo $this->_tpl_vars['options']['closed_date']['Month']; ?>
">
        <input type="hidden" name="closed_date[Day]" value="<?php echo $this->_tpl_vars['options']['closed_date']['Day']; ?>
">
        <input type="hidden" name="closed_date[filter_type]" value="<?php echo $this->_tpl_vars['options']['closed_date']['filter_type']; ?>
">
        <input type="hidden" name="show_authorized_issues" value="<?php echo $this->_tpl_vars['options']['show_authorized_issues']; ?>
">
        <input type="hidden" name="show_notification_list_issues" value="<?php echo $this->_tpl_vars['options']['show_notification_list_issues']; ?>
">
        <input type="hidden" name="custom_field" value="<?php echo ((is_array($_tmp=serialize($this->_tpl_vars['options']['custom_field']))) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
">
        <input type="hidden" name="reporter" value="<?php echo $this->_tpl_vars['options']['reporter']; ?>
">
        <input type="hidden" name="customer_id" value="<?php echo $this->_tpl_vars['options']['customer_id']; ?>
">
        <?php if (count($this->_tpl_vars['categories']) < 1): ?>
        <input type="hidden" name="category" value="">
        <?php endif; ?>
        <input type="hidden" name="release" value="<?php echo $this->_tpl_vars['options']['release']; ?>
">
        <tr>
          <td nowrap>
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Keyword(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <input class="default" type="text" name="keywords" size="40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['options']['keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
          </td>
          <td nowrap colspan="<?php if (count($this->_tpl_vars['categories']) > 0): ?>3<?php else: ?>2<?php endif; ?>">
            <?php if ($this->_tpl_vars['has_customer_integration']): ?>
            <input class="default" type="radio" name="search_type" value="customer" id="search_type_customer" <?php if ($this->_tpl_vars['options']['search_type'] != 'all_text'): ?>checked<?php endif; ?>> <label for="search_type_customer" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer Identity (e.g. "Example Inc.", "johndoe@example.com", 12345)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label><br />
            <input class="default" type="radio" name="search_type" value="all_text" id="search_type_all_text" <?php if ($this->_tpl_vars['options']['search_type'] == 'all_text'): ?>checked<?php endif; ?>> <label for="search_type_all_text" class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Text (emails, notes, etc)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            <?php else: ?>
            <input type="hidden" name="search_type" value="all_text" id="search_type">
            <?php endif; ?>
          </td>
          <td rowspan="2" align="center" width="100">
            <input class="button" type="submit" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><br /><br />
            <input class="button" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear Filters<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onClick="javascript:clearFilters(this.form);">
          </td>
        </tr>
        <tr>
          <td valign="top">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="users" class="default">
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['assign_options'],'selected' => $this->_tpl_vars['options']['users']), $this);?>

            </select>
          </td>
          <?php if (count($this->_tpl_vars['categories']) > 0): ?>
          <td valign="top">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="category" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['options']['category']), $this);?>

            </select>
          </td>
          <?php endif; ?>
          <td valign="top">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span><br />
            <select name="priority" class="default">
              <option value=""><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['priorities'],'selected' => $this->_tpl_vars['options']['priority']), $this);?>

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
" <?php if ($this->_tpl_vars['sta_id'] == $this->_tpl_vars['options']['status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['sta_title']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </td>
        </tr>
        </form>
      </table>
    </td>
    <td>
      &nbsp;
    </td>
  </tr>
  <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>
  <tr id="custom_filter_form1" <?php echo smarty_function_get_display_style(array('element_name' => 'custom_filter_form'), $this);?>
>
    <td>
      &nbsp;
    </td>
    <td>
      <table bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" width="100%" border="0" cellspacing="0" cellpadding="4">
        <form action="list.php" method="get">
        <tr>
          <?php if ($this->_tpl_vars['browser']['ie5up']): ?>
          <td class="default">
            [ <a class="link" href="javascript:void(open('<?php echo $this->_tpl_vars['rel_url']; ?>
searchbar.php', '_search'));"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>quick search bar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
          </td>
          <?php endif; ?>
          <td class="default" align="center">
            <a target="_top" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>create advanced searches<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="<?php echo $this->_tpl_vars['rel_url']; ?>
adv_search.php" class="link"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Advanced Search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
          </td>
          <td align="right">
            <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span>
            <select name="custom_filter" class="default" onChange="javascript:runCustomFilter(this.form);">
              <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
              <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['custom']), $this);?>

            </select>
          </td>
        </tr>
        </form>
      </table>
    </td>
    <td>
      &nbsp;
    </td>
  </tr>
  <?php endif; ?>
</table>

<br />
