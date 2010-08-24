<?php 
defined('_JEXEC') or die('Restricted access');

$this->_header();
$this->_showNavTableBar();

$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
if ($params->get("row","")!=""){
	echo $this->loadTemplate("newbody");	
}
else {
	echo $this->loadTemplate("body");
}

$this->_viewNavAdminPanel();

$this->_footer();


