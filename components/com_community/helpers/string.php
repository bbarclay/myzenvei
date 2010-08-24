<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

function cIsPlural($num){
	return !cIsSingular($num);
}

function cIsSingular($num){
	$config =& CFactory::getConfig();
	$singularnumbers = $config->get('singularnumber');
	$singularnumbers = explode(',', $singularnumbers);
	
	return in_array($num, $singularnumbers);
}

function cEscape($var, $function='htmlspecialchars')
{
	if (in_array($function, array('htmlspecialchars', 'htmlentities')))
	{
		return call_user_func($function, $var, ENT_COMPAT, 'UTF-8');
	}
	return call_user_func($function, $var);
}

function cCleanString($string)
{
	// Replace other special chars  
	$specialCharacters = array(
		'§' => '',
		'\\' => '',
		'/' => '',
		'’' => "'",
		'"' => '',
	);
	foreach( $specialCharacters as $character => $replacement )
	{
		$string	= JString::str_ireplace( $character , $replacement , $string );
	}
	
	return $string;
}

function cReplaceThumbnails( $data )
{
	// Replace matches for {user:thumbnail:ID} so that this can be fixed even if the caching is enabled.
	$html	= preg_replace_callback('/\{user:thumbnail:(.*)\}/', '_replaceThumbnail' , $data );
	
	return $html;
}

function _replaceThumbnail(  $matches )
{
	static	$data = array();
	
	if( !isset($data[$matches[1]]) )
	{
		$user	= CFactory::getUser( $matches[1] );
		$data[ $matches[1] ]	= $user->getThumbAvatar();
	}
	
	return $data[ $matches[1] ];
}	

function cTrimString( $value , $length )
{
	if( JString::strlen($value) > $length )
	{
		return JString::substr( $value , 0 , $length ) . '<span>...</span>';
	}
	return $value;
}