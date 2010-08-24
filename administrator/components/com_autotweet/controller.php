<?php
/**
 * AutoTweet default controller
 * 
 * @version	1.1
 * @license	GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * AutoTweet Component Controller
 *
 */
class AutotweetController extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
	}

	
	/**
	* handle tasks
	*/
	
	function remove()
	{
		$model = $this->getModel('autotweet');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or more messages could not be deleted.' );
		} else {
			$msg = JText::_( 'Message(s) deleted.' );
		}

		$this->setRedirect( 'index.php?option=com_autotweet', $msg );
	}

	/*
	function removeOlderThan()
	{
		$msg = '';
		
		$params =& JComponentHelper::getParams('com_autotweet');
		$cleanup_enabled	= (int)$params->get('cleanup_enabled', 1);
		$cleanup_days		= (int)$params->get('cleanup_days', 1);
	
		if ($cleanup_enabled) {
			switch ($cleanup_days) {
				case 1:
					$days = '5';
					break;
				case 2:
					$days = '10';
					break;
				case 3:
					$days = '15';
					break;
				case 4:
					$days = '20';
					break;
				default:
					$days = '5';
					break;
			}

			$model = $this->getModel('autotweet');
			if(!$model->deleteOlderThan($days)) {
				$msg = JText::_( 'Error: Automatic message/database cleanup failed.' );
			} else {
				$msg = JText::_( 'Automatic message/database cleanup successfully.' );
			}
		}

		$this->setRedirect( 'index.php?option=com_autotweet', $msg );
	}
*/
	
	function publish()
	{
		$model = $this->getModel('autotweet');
		if(!$model->publish()) {
			$msg = JText::_( 'Error: One or more messages could not be published.' );
		} else {
			$msg = JText::_( 'Message(s) published.' );
		}

		$this->setRedirect( 'index.php?option=com_autotweet', $msg );
	}
	
	function unpublish()
	{
		$model = $this->getModel('autotweet');
		$model->unpublish();

		$msg = JText::_( 'Message(s) unpublished.' );
		$this->setRedirect( 'index.php?option=com_autotweet', $msg );
	}
	
	function publishall()
	{
		$model = $this->getModel('autotweet');
		if(!$model->publishall()) {
			$msg = JText::_( 'Error: One or more messages could not be published.' );
		} else {
			$msg = JText::_( 'Message(s) published.' );
		}

		$this->setRedirect( 'index.php?option=com_autotweet', $msg );
	}

}