<?php /* Smarty version 2.6.18, created on 2010-07-29 15:52:01
         compiled from header.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'header.tpl.html', 3, false),array('modifier', 'default', 'header.tpl.html', 3, false),array('block', 't', 'header.tpl.html', 7, false),)), $this); ?>
<html>
<head>
<title><?php if ($this->_tpl_vars['extra_title'] != ""): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['extra_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 - <?php endif; ?><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['app_setup']['tool_caption'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['application_title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['application_title'])))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</title>
<link rel="icon" href="<?php echo $this->_tpl_vars['rel_url']; ?>
favicon.ico" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['rel_url']; ?>
css/style.css?c=a0dd" type="text/css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['rel_url']; ?>
js/jquery/ui.datepicker.css?c=5096">
<link rel="search" type="application/opensearchdescription+xml" href="<?php echo $this->_tpl_vars['rel_url']; ?>
opensearch.php" title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Eventum Issues search<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
<script type="text/javascript">
<!--
var user_prefs = {
<?php if ($this->_tpl_vars['user_prefs']): ?>
	week_firstday : '<?php echo $this->_tpl_vars['user_prefs']['week_firstday']; ?>
' == '1' ? 1 : 0
<?php endif; ?>
};
//-->
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/jquery/jquery.js?c=8e19"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/jquery/form.js?c=9984"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/jquery/blockui.js?c=eb13"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/jquery/ui.datepicker.js?c=a911"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/validation.js?c=901a"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/browserSniffer.js?c=c046"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/global.js?c=42a4"></script>
<?php if ($this->_tpl_vars['refresh_rate']): ?>
<meta http-equiv="Refresh" content="<?php echo $this->_tpl_vars['refresh_rate']; ?>
;URL=<?php echo $this->_tpl_vars['rel_url']; ?>
<?php echo $this->_tpl_vars['refresh_page']; ?>
">
<?php endif; ?>
</head>

<body bgcolor="<?php if ($this->_tpl_vars['bgcolor']): ?><?php echo $this->_tpl_vars['bgcolor']; ?>
<?php else: ?>#FFFFFF<?php endif; ?>" marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" onBeforeUnload="return handleClose()">