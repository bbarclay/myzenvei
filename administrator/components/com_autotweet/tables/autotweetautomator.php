<?php
/**
 * Table class for AutoTweet component.
 * 
 * @version		1.0
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * AutoTweet Automator Table class
 *
 */
class TableAutotweetAutomator extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	// fields
	var $lastexec = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAutotweetAutomator(& $db) {
		parent::__construct('#__autotweet_automator', 'id', $db);
	}
}