<?php
/**
 * AutoTweet Model for info dialog.
 * 
 * @version		1.0
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

require_once (JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'autotweetinfohelper.php');


class AutotweetModelInfo extends JModel
{
	var $_compdata	= null;
	var $_plugdata	= null;

	function __construct()
	{
		parent::__construct();
	}
	
	function getComponentInfo()
	{
		if (!$this->_compdata) {
			$this->_compdata =& AutotweetInfoHelper::getComponentInfo();
			
			if ($this->_compdata) {
				$this->setError( 'AutoTweet NG component - AutoTweet server file not found!');
			}
		}
		
		return $this->_compdata;
	}
	
	function getPluginInfo()
	{
		if (!$this->_plugdata) {
			$this->_plugdata =& AutotweetInfoHelper::getPluginInfo();
			
			if ($this->_plugdata) {
				$this->setError( 'AutoTweet NG component - AutoTweet server file not found!');
			}
		}
		
		return $this->_plugdata;
	}

}