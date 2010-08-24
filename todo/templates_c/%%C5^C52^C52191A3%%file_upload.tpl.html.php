<?php /* Smarty version 2.6.18, created on 2010-08-16 10:33:58
         compiled from file_upload.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'file_upload.tpl.html', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('extra_title' => "Issue #".($this->_tpl_vars['issue_id'])." - Upload File")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['viewer']): ?>
<?php if ($this->_tpl_vars['upload_file_result'] != ''): ?>
    <br />
    <center>
    <span class="default"><b>
    <?php if ($this->_tpl_vars['upload_file_result'] == -1): ?>
      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error occurred while trying to process the uploaded file.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php elseif ($this->_tpl_vars['upload_file_result'] == -2): ?>
      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The uploaded file is already attached to the current issue. Please rename the file and try again.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php elseif ($this->_tpl_vars['upload_file_result'] == 1): ?>
      <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, the uploaded file was associated with the issue below.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
    </b></span>
    </center>
    <script type="text/javascript">
    <!--
    <?php if ($this->_tpl_vars['current_user_prefs']['close_popup_windows'] == '1' && $this->_tpl_vars['upload_file_result'] == 1): ?>
    setTimeout('closeAndRefresh()', 2000);
    <?php endif; ?>
    //-->
    </script>
    <br />
    <?php if (! $this->_tpl_vars['current_user_prefs']['close_popup_windows']): ?>
    <center>
      <span class="default"><a class="link" href="javascript:void(null);" onClick="javascript:closeAndRefresh();"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Continue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
    </center>
    <?php endif; ?>
<?php else: ?>
<?php echo '
<script type="text/javascript">
<!--
function validateUpload(f)
{
    var field1 = getFormElement(f, \'attachment[]\', 0);
    var field2 = getFormElement(f, \'attachment[]\', 1);
    var field3 = getFormElement(f, \'attachment[]\', 2);
    if ((isWhitespace(field1.value)) && (isWhitespace(field2.value)) && (isWhitespace(field3.value))) {
        errors[errors.length] = new Option(\'Files\', \'attachment[]\');
        return false;
    }
    return true;
}
//-->
</script>
'; ?>

<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td width="100%">
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td colspan="2" class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add New Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b></td>
        </tr>
        <form name="attachment_form" action="file_upload.php" method="post" enctype="multipart/form-data" onSubmit="javascript:return checkFormSubmission(this, 'validateUpload');">
        <input type="hidden" name="cat" value="upload_file">
        <input type="hidden" name="issue_id" value="<?php echo $this->_tpl_vars['issue_id']; ?>
">
        <tr>
          <td colspan="2">
            <table width="100%" cellpadding="2" cellspacing="1">
              <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['customer']): ?>
              <tr>
                <td bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" class="default_white" width="120" nowrap>
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <select name="status" class="default">
                    <option value="public"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Public<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>visible to all<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</option>
                    <option value="internal"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Private<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>standard user and above only<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</option>
                  </select>
                </td>
              </tr>
              <?php else: ?>
              <input type="hidden" name="status" value="public">
              <?php endif; ?>
              <tr>
                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" width="120" nowrap>
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filenames<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <table width="100%" cellpadding="2" cellspacing="0" id="file_table">
                    <tr>
                      <td><input size="50" name="attachment[]" type="file" class="shortcut"></td>
                    </tr>
                    <tr>
                      <td><input size="50" name="attachment[]" type="file" class="shortcut"></td>
                    </tr>
                    <tr>
                      <td><input size="50" name="attachment[]" type="file" class="shortcut"></td>
                    </tr>
                    <tr>
                      <td class="small_default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Note: The current maximum allowed upload file size is<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['max_attachment_size']; ?>
</b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                <td bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" class="default_white" width="120" nowrap>
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                </td>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
                  <textarea name="file_description" rows="4" style="width: 97%"></textarea>
                </td>
              </tr>
              <tr bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                <td colspan="2" align="center">
                  <input type="submit" class="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
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
<?php endif; ?>
<?php else: ?>
<center><span class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You do not have the correct role to access this page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></center>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>