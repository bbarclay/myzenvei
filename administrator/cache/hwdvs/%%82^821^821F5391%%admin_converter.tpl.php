<?php /* Smarty version 2.6.26, created on 2010-03-16 22:11:50
         compiled from admin_converter.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
  <tr>
    <td align="left">
    <div style="float:right;padding: 5px;"><?php echo $this->_tpl_vars['download_log']; ?>
</div>
    <h2><?php echo @_HWDVIDS_TITLE_HWDVCONVERTOR; ?>
</h2>
    </td>
  </tr>
  <tr>
    <td align="left"><center><iframe src ="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/index.php?option=com_hwdvideoshare&task=startconverter" frameborder="0" marginwidth="2" scrolling= "yes" height="500" width="95%" style="border:1px solid black; padding: 1px;"></iframe></center></td>
  </tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

