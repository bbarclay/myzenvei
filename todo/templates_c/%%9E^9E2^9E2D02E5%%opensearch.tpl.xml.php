<?php /* Smarty version 2.6.18, created on 2010-08-08 22:09:16
         compiled from opensearch.tpl.xml */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'opensearch.tpl.xml', 5, false),array('modifier', 'escape', 'opensearch.tpl.xml', 5, false),array('block', 't', 'opensearch.tpl.xml', 6, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0"<?php echo '?>'; ?>

<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
	<ShortName><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['app_setup']['tool_caption'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['application_title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['application_title'])))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</ShortName>
	<Description><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Eventum Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></Description>
	<OutputEncoding><?php echo $this->_tpl_vars['app_charset']; ?>
</OutputEncoding>
	<InputEncoding><?php echo $this->_tpl_vars['app_charset']; ?>
</InputEncoding>
	<Url type="text/html" template="<?php echo $this->_tpl_vars['app_base_url']; ?>
view.php?id=<?php echo '{'; ?>
searchTerms<?php echo '}'; ?>
" />
</OpenSearchDescription>