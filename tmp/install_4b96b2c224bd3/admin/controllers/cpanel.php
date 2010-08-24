<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: cpanel.php 1603 2009-10-12 08:59:30Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( 'JPATH_BASE' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

class AdminCpanelController extends JController {
	/**
	 * Controler for the Control Panel
	 * @param array		configuration
	 */
	function __construct($config = array())
	{
		parent::__construct($config);
		$this->registerTask( 'show',  'cpanel' );
		$this->registerDefaultTask("cpanel");
	}

	function cpanel( )
	{
		// check DB
		// check the latest column addition or change
		// do this in a way that supports mysql 4 
		$db =& JFactory::getDBO();
		
		$sql = "SHOW COLUMNS FROM `#__jev_users`";
		$db->setQuery( $sql );
		$cols = $db->loadObjectList();
		if (is_null($cols) ){
			$this->setRedirect(JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=config.dbsetup",false),JText::_("Database Table Setup Was Required"));
			$this->redirect();
			//return;			
		}
		$uptodate = false;		
		foreach ($cols as $col) {
			if ($col->Field=="created"){
				$uptodate = true;
				break;
			}
		}
		if (!$uptodate){
			$this->setRedirect(JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=config.dbsetup",false),JText::_("Database Table Update Was Required"));
			$this->redirect();
			//return;			
		}
		
		$sql = "SHOW COLUMNS FROM `#__jevents_exception`";
		$db->setQuery( $sql );
		
		$cols = $db->loadObjectList('Field');
		if (!isset($cols['startrepeat']) ){
			$this->setRedirect(JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=config.dbsetup",false),JText::_("Database Table Setup Was Required"));
			$this->redirect();
			//return;			
		}

		// are config values setup correctyl
		$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
		$jevadmin = $params->getValue("jevadmin",-1);
		if ($jevadmin==-1){
			$this->setRedirect(JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=params.edit",false),JText::_("Please check configuration and save"));
			$this->redirect();
		}
		
		// Make sure jevlayout is copied and up to date
		if ($params->getValue("installlayouts",0)){
			if (!file_exists(JPATH_SITE."/libraries/joomla/installer/adapters/jevlayout.php") ||
			md5_file(JEV_ADMINLIBS."jevlayout.php") != md5_file(JPATH_SITE."/libraries/joomla/installer/adapters/jevlayout.php")){
				jimport('joomla.filesystem.file');
				JFile::copy(JEV_ADMINLIBS."jevlayout.php",JPATH_SITE."/libraries/joomla/installer/adapters/jevlayout.php");
			}
		}
		
		// get the view
		$this->view = & $this->getView("cpanel","html");

		$sql = 'SHOW TABLES LIKE "'.$db->_table_prefix.'events"';
		$db->setQuery( $sql );
		$tables = $db->loadObjectList();
		if (count($tables)>0){
			$this->view->assign('migrated'   , 1);
		}
		else {
			$this->view->assign('migrated'   , 0);
		}

		
		// get all the raw native calendars
		$this->dataModel = new JEventsDataModel("JEventsAdminDBModel");
		$nativeCals = $this->dataModel->queryModel->getNativeIcalendars();
		if (is_null($nativeCals) || count($nativeCals)==0){
			$this->view->assign("warning",JText::_("Calendars not setup properly"));
		}
		
		// Set the layout
		$this->view->setLayout('cpanel');
		$this->view->assign('title'   , JText::_("Control Panel"));

		$this->view->display();
	}


}
