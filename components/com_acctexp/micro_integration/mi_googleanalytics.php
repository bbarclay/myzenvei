<?php
/**
 * @version $Id: mi_googleanalytics.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Google Analytics
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_googleanalytics
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_GOOGLEANALYTICS;
		$info['desc'] = _AEC_MI_DESC_GOOGLEANALYTICS;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['account_id']		= array( 'inputB' );
		return $settings;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		$text = '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">'
				. '</script>'
				. '<script type="text/javascript">'
				. '  _uacct="' . $this->settings['account_id'] . '";'
				. '  urchinTracker();'
				. '</script>'
				. '<form style="display:none;" name="utmform">'
				. '<textarea id="utmtrans">UTM:T|' . $request->invoice->invoice_number . '|' . $mainframe->getCfg( 'sitename' ) . '|' . $request->invoice->amount . '|0.00|0.00|||'
				. 'UTM:I|' . $request->invoice->invoice_number . '|' . $request->plan->id . '|' . $request->plan->name . '|subscription|' . $request->invoice->amount . '|1</textarea>'
				. '</form>'
				. '<script type="text/javascript">'
				. '__utmSetTrans();'
				. '</script>';

		$displaypipeline = new displayPipeline($database);
		$displaypipeline->create( $request->metaUser->userid, 1, 0, 0, null, 1, $text );

		return true;
	}
}
?>
