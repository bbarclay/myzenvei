<?php
/**
 * @version $Id: mi_affiliatepro.php 16 2007-07-01 12:07:07Z mic $
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - AffiliatePRO
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_affiliatepro
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_AFFPRO;
		$info['desc'] = _AEC_MI_DESC_AFFPRO;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['url']		= array( 'inputC' );

		return $settings;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		$text = '<script id="pap_x2s6df8d" src="' . $this->settings['url'] . '" type="text/javascript"></script>'
				. '<script type="text/javascript">'
				;

		if ( !empty( $request->cart ) ) {
			$sid = 0;
			foreach ( $request->cart as $ciid => $ci ) {
				if ( !empty( $ci['is_total'] ) ) {
					continue;
				}

				$sid++;

				if ( $sid == 1 ) {
					$no = '';
				} else {
					$no = $sid;
				}

				$text .= 'var sale'.$no.' = PostAffTracker.createSale();'
					. "sale".$no.".setTotalCost('" . $ci['cost_total'] . "');"
					. "sale".$no.".setOrderID('" . $request->invoice->invoice_number . "');"
					. "sale".$no.".setProductID('" . $ci['obj']->id . "');"
					. "sale".$no.".setStatus('A');"
					;
			}
		} else {
			$text .= 'var sale = PostAffTracker.createSale();'
				. "sale.setTotalCost('" . $request->invoice->amount . "');"
				. "sale.setOrderID('" . $request->invoice->invoice_number . "');"
				. "sale.setProductID('" . $request->plan->id . "');"
				. "sale.setStatus('A');"
				;
		}


		$text .= 'PostAffTracker.register();'
				. '</script>';
// TODO:
// sale.setAffiliateID('testaff'); - force Affiliate ID
// sale.setCampaignID('11111111'); - campaign
// sale.setCustomCommission('10.23'); - force Custom Commission

// PostAffTracker.setChannel('testchannel'); - force channel
// PostAffTracker.setCookieValue('testchannel'); - force to register commission with this cookie value. The cookie value saves affiliate ID and campaign ID. It is in format AFFILIATEID_CAMPAIGNID, for example e2r48sv3_d3425s9f.
		$displaypipeline = new displayPipeline( $database );
		$displaypipeline->create( $request->metaUser->userid, 1, 0, 0, null, 1, $text );

		return true;
	}
}
?>
