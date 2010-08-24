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
 * AutoTweet Table class
 *
 */
class TableAutotweet extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	// fields
	var $postdate	= null;
	var $publish_up	= null;
	var $message	= null;
	var $url		= null;
	var $articleid	= null;
	var $attempts	= null;
	var $published	= null;
	var $pubstate	= null;
	var $resultmsg	= null;
	var $source		= null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAutotweet(& $db) {
		parent::__construct('#__autotweet', 'id', $db);
	}
}