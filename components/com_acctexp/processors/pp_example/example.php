<?php
// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_[namehere]
{
	function info()
	{
		$info = array();
		$info['longname'] = "PayPal";
		$info['statement'] = "Make payments with PayPal - it's fast, free and secure!";
		$info['description'] = "description";
		$info['currencies'] = "USD,AUD,CAD,EUR,GBP,JPY,NZD,CHF,HKD,SGD,SEK,DKK,PLN,NOK,HUF,CZK";
		$info['languages'] = "AU,DE,FR,IT,GB,ES,US";
		$info['cc_list'] = "visa,mastercard,discover,americanexpress,echeck,giropay";

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['variable'] = "default value";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['variable'] = array("type", "name", "description");

		return $settings;
	}

	function createGatewayLink( $int_var, $cfg, $metaUser, $new_subscription )
	{
		$var['post_url']	= "https://www.sandbox.paypal.com/cgi-bin/webscr";

		return $var;
	}

	function parseNotification( $post, $cfg )
	{
		$response = array();
		$response['invoice'] = "";
		$response['valid'] = 0;

		return $response;
	}

}

?>
