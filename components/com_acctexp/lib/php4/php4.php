<?php
/**
 * @version $Id: php4.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage PHP4 Compatibility Layer
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

// If we haven't got native JSON, we must include it
if ( !function_exists( 'json_decode' ) ) {
	// Make sure no other service has loaded this library somewhere else
	if ( !class_exists( "Services_JSON" ) ) {
		require_once( JPATH_SITE . '/components/com_acctexp/lib/php4/json/json.php' );
	}

	// Create dummy encoding function
	function json_encode( $value )
	{
		$JSONenc = new Services_JSON();
		return $JSONenc->encode( $value );
	}

	// Create dummy decoding function
	function json_decode( $value )
	{
		$JSONdec = new Services_JSON();
		return $JSONdec->decode( $value );
	}

}

if ( !function_exists( 'str_split' ) ) {
	function str_split( $text, $split = 1 ) {
		// place each character of the string into an array
		$array = array();
		for ( $i = 0; $i < strlen( $text ); ){
			$key = NULL;
			for ( $j = 0; $j < $split; $j++, $i++ ) {
				if ( isset( $text[$i] ) ) {
					$key .= $text[$i];
				}
			}
			array_push( $array, $key );
		}
		return $array;
	}
}

if ( !function_exists( 'property_exists' ) ) {
	function property_exists( $class, $property ) {
		if ( is_object( $class ) ) {
			$vars = get_object_vars( $class );
		} else {
			$vars = get_class_vars( $class );
		}
		return array_key_exists( $property, $vars );
	}
}

if ( !function_exists( 'scandir' ) ) {
	function scandir($dir,$listDirectories=false, $skipDots=true) {
		$dirArray = array();
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if (($file != "." && $file != "..") || $skipDots == true) {
					if($listDirectories == false) { if(is_dir($file)) { continue; } }
					array_push($dirArray,basename($file));
				}
			}
			closedir($handle);
		}
		return $dirArray;
	}
}

// Double checking for version number
// Then off to the dirty eval!
if (version_compare(phpversion(), '5.0') < 0) {
	eval('
		if(!function_exists(\'clone\')){
			function clone($object) {
				return $object;
			}
		}
	');
}
?>
