<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

/*
 * Check whether the string is a phone number or not.
 * Supported US phone number format : 
 * 1-234-567-8901
 * 1-234-567-8901 x1234
 * 1-234-567-8901 ext1234
 * 1 (234) 567-8901
 * 1.234.567.8901
 * 1/234/567/8901
 * 12345678901 
 *
 */
function cValidatePhone($phone)
{	
	$regex = '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/i';
	if (preg_match($regex, JString::trim($phone), $matches)) { 
		return array($matches[1], $matches[2]); 
	} else { 
		return false; 
	}
}
