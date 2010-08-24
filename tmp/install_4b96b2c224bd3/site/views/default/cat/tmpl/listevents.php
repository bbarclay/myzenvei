<?php 
defined('_JEXEC') or die('Restricted access');

$this->_header();
$this->_showNavTableBar();

$this->viewNavCatText( $this->catids, JEV_COM_COMPONENT, 'cat.listevents', $this->Itemid );

echo $this->loadTemplate("body");

$this->_viewNavAdminPanel();

$this->_footer();


