<?php /* Smarty version 2.6.18, created on 2010-08-02 00:24:25
         compiled from clock_status.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'clock_status.tpl.html', 7, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br />
<center>
  <span class="default">
  <?php if ($this->_tpl_vars['result'] == 1): ?>
  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you, your account clocked-in status was changed successfully.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
  <?php elseif ($this->_tpl_vars['result'] == -1): ?>
  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An error was found while trying to change your account clocked-in status.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
  <?php endif; ?>
  </span>
</center>

<script type="text/javascript">
<!--
<?php if ($_GET['is_frame'] == 'yes'): ?>
var url = opener.parent.location.href;
<?php else: ?>
var url = opener.location.href;
<?php endif; ?>

var email_list_page = '/emails.php';
<?php echo '
if (url.indexOf(email_list_page + \'?\') != -1) {
    url = url.substring(0, url.indexOf(email_list_page + \'?\') + email_list_page.length);
}
'; ?>


var list_page = '/list.php';
<?php echo '
if (url.indexOf(list_page + \'?\') != -1) {
    url = url.substring(0, url.indexOf(list_page + \'?\') + list_page.length);
}
'; ?>


<?php if ($_GET['is_frame'] == 'yes'): ?>
opener.parent.location.href = url;
<?php else: ?>
opener.location.href = url;
<?php endif; ?>
setTimeout('window.close()', 2000);
//-->
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>