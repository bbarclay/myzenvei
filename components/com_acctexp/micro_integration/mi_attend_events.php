<?php
/**
 * @version $Id: mi_attend_events.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Attend Events
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_attend_events
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_ATTEND_EVENTS;
		$info['desc'] = _AEC_MI_DESC_ATTEND_EVENTS;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		return $settings;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		include_once( JPATH_SITE . '/components/com_attend_events/attend_events.class.php' );

		$database->setQuery("SELECT transaction_id FROM #__events_transactions WHERE ( registration_id = '" . $this->settings['registration_id'] . "' )");
		$transaction_id = $database->loadResult();

		// mark ae invoice as cleared
		$transaction = new comAETransaction( $database );
		$transaction->load( $transaction_id );
		$transaction->bind( $_POST );
		$transaction->gateway = 'Cybermut';
		$transaction->check();
		$transaction->store();

		return true;
	}
}
?>
