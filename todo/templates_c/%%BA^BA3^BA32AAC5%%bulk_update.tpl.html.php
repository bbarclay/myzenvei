<?php /* Smarty version 2.6.18, created on 2010-07-29 16:08:45
         compiled from bulk_update.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_display_style', 'bulk_update.tpl.html', 1, false),array('function', 'html_options', 'bulk_update.tpl.html', 31, false),array('block', 't', 'bulk_update.tpl.html', 7, false),array('modifier', 'count', 'bulk_update.tpl.html', 14, false),)), $this); ?>
<table id="bulk_update1" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center" <?php echo smarty_function_get_display_style(array('element_name' => 'bulk_update'), $this);?>
>
  <tr>
    <td>
      <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr>
          <td bgcolor="#FFFFFF" class="default" colspan="3">
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Bulk Update Tool<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
          </td>
        </tr>
        <tr>
          <?php $this->assign('colspan', 3); ?>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          <?php if (count($this->_tpl_vars['releases']) > 0): ?>
          <?php $this->assign('colspan', $this->_tpl_vars['colspan']+1); ?>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Release<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          <?php endif; ?>
          <?php if (count($this->_tpl_vars['priorities']) > 0): ?>
          <?php $this->assign('colspan', $this->_tpl_vars['colspan']+1); ?>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          <?php endif; ?>
          <?php if (count($this->_tpl_vars['categories']) > 0): ?>
          <?php $this->assign('colspan', $this->_tpl_vars['colspan']+1); ?>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
          <?php endif; ?>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
        </tr>
        <tr>
          <td>
              <select name="users[]" class="default" size="5" multiple>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users']), $this);?>

              </select>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => "users[]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <td>
              <select name="status" class="default">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['open_status']), $this);?>

              </select>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'status')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <?php if (count($this->_tpl_vars['releases']) > 0): ?>
          <td>
              <select name="release" class="default">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['available_releases']), $this);?>

              </select>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'release')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <?php endif; ?>
          <?php if (count($this->_tpl_vars['priorities']) > 0): ?>
          <td>
              <select name="priority" class="default">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['priorities']), $this);?>

              </select>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'priority')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <?php endif; ?>
          <?php if (count($this->_tpl_vars['categories']) > 0): ?>
          <td>
              <select name="category" class="default">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categories']), $this);?>

              </select>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "error_icon.tpl.html", 'smarty_include_vars' => array('field' => 'category')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
          <?php endif; ?>
          <td>
              <span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select closed status to close issue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><br />
              <select name="closed_status" class="default">
                <option value=""></option>
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['closed_status']), $this);?>

              </select>
              <br />
              <a class="link default" id="bulk_set_closed_message" href="#"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Close Message<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
              <br />
              <span class="default">
              <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send Notification To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:<br />
              <input id="notification_internal" type="radio" name="notification_list" checked value="internal">
              <label for="notification_internal"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Internal Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Will save as a note<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</label><br />
              <input id="notification_all" type="radio" name="notification_list" value="all">
              <label for="notification_all"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
              <input type="hidden" name="closed_message" value="" id="closed_message">
              </span>
              
              <div id="close_message_popup" style="display: none">
                  <label for="closed_message"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Closed Message<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label><br />
                  <textarea id="closed_message_popup" name="closed_message_popup" rows="8" cols="80">Issue Bulk closed</textarea>
                  <br />
                  <input id="closed_set_message" type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Message<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
              </div>
          </td>
        </tr>
        <tr>
          <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" align="center">
            <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Bulk Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" onclick="bulkUpdate()" class="button">
            <input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="resetBulkUpdate()">
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<script type="text/javascript">
<?php echo '
jQuery("#bulk_set_closed_message").bind("click", function (e) {
    jQuery.blockUI({ 
                message: jQuery("#close_message_popup"),
                css: {
                    width: \'600px\'
                }
                });
});
jQuery("#closed_set_message").bind("click", function () {
    jQuery("#closed_message").val(jQuery("#closed_message_popup").val());
    jQuery.unblockUI();
});
'; ?>

</script>