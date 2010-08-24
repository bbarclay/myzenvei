<?php /* Smarty version 2.6.18, created on 2010-08-07 16:02:15
         compiled from reports/index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'reports/index.tpl.html', 3, false),)), $this); ?>
<html>
<head>
<title><?php echo ((is_array($_tmp=@$this->_tpl_vars['app_setup']['tool_caption'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['application_title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['application_title'])); ?>
</title>
</head>

<frameset rows="60,*" frameborder="1" border="1" framespacing="1" bordercolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
  <frame name="_topframe" src="top.php" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" framespacing="0">
  <frameset cols="225,*" frameborder="1" framespacing="6" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" border="8" bordercolor="<?php echo $this->_tpl_vars['light_color']; ?>
">
    <frame name="_treeframe" src="tree.php" scrolling="no" topmargin="10" leftmargin="10" marginheight="10" marginwidth="10" frameborder="1" border="0">
    <frame name="basefrm" src="<?php echo $this->_tpl_vars['rel_url']; ?>
misc/blank.html" scrolling="auto" topmargin="15" leftmargin="15" marginheight="15" marginwidth="15" frameborder="1" border="0">
  </frameset>
</frameset>

</html>