<!---. NAME: header.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<?php 
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jafilia/templates/'.$jaftpl.'/style.css'); // to do
$document->addScript( JURI::root(true).'/components/com_jafilia/templates/'.$jaftpl.'/js/rounded_corners.inc.js' );
?>
<center><h1><?php echo JText::_('JAF_COM_TITLE'); ?></h1></center>

<!--- END: header.tpl --->
