<?php
/**
 * @version $Id: mi_mysql_query.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - MySQL Query
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_http_query
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_HTTP_QUERY;
		$info['desc'] = _AEC_MI_DESC_HTTP_QUERY;

		return $info;
	}

	function Settings()
	{
        $settings = array();
        $settings['url']			= array( 'inputE' );
        $settings['query']			= array( 'inputD' );
        $settings['url_exp']		= array( 'inputE' );
        $settings['query_exp']		= array( 'inputD' );
        $settings['url_pre_exp']	= array( 'inputE' );
        $settings['query_pre_exp']	= array( 'inputD' );
		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']	= array( 'fieldset', _AEC_MI_SET4_MYSQL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function relayAction( $request )
	{
		if ( !isset( $this->settings['url'.$request->area] ) ) {
			return null;
		}

		$url = AECToolbox::rewriteEngineRQ( $this->settings['url'.$request->area], $request );
		$query = AECToolbox::rewriteEngineRQ( $this->settings['query'.$request->area], $request );

		return $this->fetchURL( $this->createURL( $url, $query ) );
	}

	function createURL( $url, $query ) {
		$urlsplit = explode( '?', $url );

		$p = explode( "\n", $query );

		if ( !empty( $urlsplit[1] ) ) {
			$p2 = explode( '&', $urlsplit[1] );

			if ( !empty( $p2 ) ) {
				$p = array_merge( $p2, $p );
			}
		}

		$fullp = array();
		foreach ( $p as $entry ) {
			$e = explode( '=', $entry );

			if ( !empty( $e[0] ) && !empty( $e[1] ) ) {
				$fullp[] = urlencode( trim($e[0]) ) . '=' . urlencode( trim($e[1]) );
			}
		}

		return $urlsplit[0] . '?' . implode( '&', $fullp );
	}

	function fetchURL( $url )
	{
		global $aecConfig;

		if ( strpos( $url, '://' ) === false ) {
			$purl = 'http://' . $url;
		} else {
			$purl = $url;
		}

		$url_parsed = parse_url( $purl );

		$host = $url_parsed["host"];

		if ( empty( $url_parsed["port"] ) ) {
			$port = 80;
		} else {
			$port = $url_parsed["port"];
		}

		$path = $url_parsed["path"];

		//if url is http://example.com without final "/"
		//I was getting a 400 error
		if ( empty( $path ) ) {
			$path="/";
		}

		if ( $url_parsed["query"] != "" ) {
			$path .= "?".$url_parsed["query"];
		}

		if ( $aecConfig->cfg['curl_default'] ) {
			$response = processor::doTheCurl( $url, '' );
			if ( $response === false ) {
				// If curl doesn't work try using fsockopen
				$response = processor::doTheHttp( $url, $path, '', $port );
			}
		} else {
			$response = processor::doTheHttp( $url, $path, '', $port );
			if ( $response === false ) {
				// If fsockopen doesn't work try using curl
				$response = processor::doTheCurl( $url, '' );
			}
		}

		return $response;
	}
}
?>
