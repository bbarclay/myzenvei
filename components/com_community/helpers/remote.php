<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

// Return true if Curl library is installed
function cIsCurlExists()
{
	return function_exists('curl_init');
}

// Return content of the given url
function cRemoteGetContent($url)
{
	
	if (!$url)
		return false;
	
	if (function_exists('curl_init'))
	{
		$ch			= curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$response	= curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	// CURL unavailable on this install
	return false;
}

// Return result of a POST
function cRemotePost($url, $data)
{
	if (!$url && !$data)
		return false;

	$response = '';
	if (function_exists('curl_init'))
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded;charset=UTF-8'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$response = curl_exec($ch);
		$response_code = curl_getinfo ($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	}
	else
	{
		$dataLength	= JString::strlen(implode('&', $data));
		$parsedUrl	= parse_url( $url );
		$fp			= fsockopen( $parsedUrl['host'], 80, $errno, $errstr, 30);

		if (!$fp)
		{
			return false; // Error
		}
		else
		{
			$out	 = 'POST ' . (isset($parsedUrl['path']) ? $parsedUrl['path'] : '/')
					. (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '')
					. ' HTTP/1.0' . "\r\n";
			$out	.= 'Host: ' . $parsedUrl['host'] . "\r\n";
			$out	.= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out	.= 'Content-Length: ' . $dataLength . "\r\n";
			$out	.= 'Accept-Charset: UTF-8' . "\r\n";
			$out	.= 'Connection: Close' . "\r\n\r\n";
			$out	.= $data;
			fwrite($fp, $out);
			while(!feof($fp)) {
				$response .= fgets($fp, 128);
			}
			fclose($fp);
			if( $contents ) {
				list($headers, $content) = explode( "\r\n\r\n", $contents, 2 );
				$response_code = strpos( $headers, '200 OK' );
			}
		}
	}
	return $response;
}
