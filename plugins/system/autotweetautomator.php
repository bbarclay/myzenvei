<?php
/**
 * @version	1.2
 * @author	Ulli Storck
 * @license	GPL 2.1
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.error.error' );

// check for component
if (!JComponentHelper::getComponent('com_autotweet', true)->enabled) {
	JError::raiseWarning('5', 'AutoTweet NG Automator-Plugin - AutoTweet NG Component is not installed or not enabled.');
	return;
}

require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'helpers' . DS . 'autotweetposthelper.php');

JTable::addIncludePath(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'tables');


class plgSystemAutotweetAutomator extends JPlugin
{
	protected $max_posts	= 5;
	protected $interval		= 180;	

	
	function plgSystemAutotweetAutomator( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	
		$plugin			=& JPluginHelper::getPlugin('system', 'autotweetautomator');
		$pluginParams	= new JParameter($plugin->params);
		
		$this->max_posts	= (int)$pluginParams->get('max_posts', 5);
		$this->interval		= (int)$pluginParams->get('interval', 180);
		
		// correct value if value is under the minimum
		if ($this->interval < 120) { $this->interval = 120; }
	}

	function onAfterRoute()
	{
		$id = 1;			// table has only 1 row with this id
		
		$automat =& JTable::getInstance('AutotweetAutomator', 'Table');
		
		if ($automat) {
			$loaded = $automat->load($id);
		}
		else {
			$loaded = false;
		}
		
		if ($loaded) {
			$last = JFactory::getDate($automat->lastexec);
		}
		else {
			$last = JFactory::getDate('0000-00-00 00:00:00');
		}
					
		$now = JFactory::getDate();
		$diff = $now->toUnix() - $last->toUnix();
	
		if ($diff > $this->interval) {
			if ($loaded) {
				$entry = array (
					'id'				=> $id,
					'lastexec'			=> $now->toMySQL()
				);
				
				$automat->bind($entry);
				$automat->store();
			}
			
			$helper =& AutotweetPostHelper::getInstance();
			$helper->postAll(AutotweetPostHelper::POST_PENDING, true, $this->max_posts);
		}
	}

}

?>
