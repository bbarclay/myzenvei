<?php
/**
 * @version $Id: mi_jarc.php 16 2007-07-01 12:07:07Z mic $
 * @package AEC - Account Control Expiration - Subscription component for Joomla! OS CMS
 * @subpackage Micro Integrations - jarc
 * @copyright Copyright (C) 2007, All Rights Reserved, David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.globalnerd.org
 * @license GNU/GPL v.2 http://www.gnu.org/copyleft/gpl.html
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_jarc
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_JARC;
		$info['desc'] = _AEC_MI_DESC_JARC;

		return $info;
	}

	function Settings( $params=null )
	{
		global $mainframe;

		$settings = array();
		$settings['create_affiliates']	= array( 'list_yesno' );
		$settings['log_payments']		= array( 'list_yesno' );
		$settings['log_sales']			= array( 'list_yesno' );

		return $settings;
	}

	function action( $request )
	{
		return $this->logpayment( $request->invoice );
	}

	function on_userchange_action( $request )
	{
		$database = &JFactory::getDBO();

		if ( !$this->settings['create_affiliates'] ) {
			return null;
		}

		// Only do something on registration
		if ( strcmp( $request->trace, 'registration' ) === 0 ) {
			// Make sure that we do not create a double entry
			if ( !$this->checkaffiliate( $request->row->id ) ) {
				// Create the affiliate
				return $this->createaffiliate( $request->row->id );
			} else {
				return null;
			}
		}

		return true;
	}


	function checkaffiliate( $userid )
	{
		global $mainframe;
		$database = &JFactory::getDBO();

		$query = 'SELECT affiliate_id'
				. ' FROM #__jarc_affiliate_network'
				. ' WHERE `affiliate_id` = \'' . $userid . '\''
				;
		$database->setQuery( $query );

		if ( $database->loadResult() )  {
				return true;
		} else {
				return false;
		}
	}

	function createaffiliate( $userid )
	{
		global $mainframe;
		$database = &JFactory::getDBO();
		$session = &JFactory::getSession();
		// Get affiliate ID from cookie.
		//$cookie_name   = mosMainframe::sessionCookieName() . '_JARC';
		$cookie_name   = $session->getName() . '_JARC';
		$sessioncookie = JRequest::getVar( $cookie_name, null,$_COOKIE );

		list($cookie_aid, $cookie_count) = split(':',$sessioncookie,2);
		$query = 'INSERT INTO #__jarc_affiliate_network'
		. ' SET `affiliate_id` = \'' . $userid . '\','
		. ' `parent_id` = \'' . $cookie_aid . '\''
		;
		$database->setQuery( $query );

		if ( !$database->query() )  {
				return false;
		} else {
				return true;
		}
	}

	function logpayment( $invoice )
	{
		global $mainframe;
		$database = &JFactory::getDBO();
		$session = &JFactory::getSession();
		// Get affiliate ID from cookie.
		//$cookie_name   = mosMainframe::sessionCookieName() . '_JARC';
		$cookie_name   = $session->getName() . '_JARC';
		$sessioncookie = JRequest::getVar( $cookie_name, null, $_COOKIE );
		list($cookie_aid, $cookie_count) = split(':',$sessioncookie,2);

		require_once( JPATH_BASE.DS.'components'.DS.'com_jarc'.DS.'jarc.class.php' );
		$affiliate = new jarc_affiliate($database);
		$affiliate->findById( intval($cookie_aid) );

		$query = 'INSERT INTO #__jarc_payments' .
				' SET `date` = \'' . gmstrftime ( '%Y-%m-%d %H:%M:%S', time() + $mainframe->getCfg('offset_user')*3600 ) . '\','
				. ' `user_id` = \'' . $invoice->userid . '\','
				. ' `payment_type` = \''.$invoice->method.'\','
				. ' `payment_status` = \'2\','
				. ' `amount` = \'' . $invoice->amount . '\','
				. ' `commission_id` = \'' . $affiliate->commission_id . '\','
				. ' `affiliate_id` = \'' . intval($cookie_aid) . '\''
				;
		$database->setQuery( $query );

		if ( !$database->query() ) {
				var_dump( $database );exit();
				return false;
		} else {
				return true;
		}
	}
}

?>