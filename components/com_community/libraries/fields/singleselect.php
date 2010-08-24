<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'fields'.DS.'select.php');

class CFieldsSingleSelect extends CFieldsSelect
{
	function getFieldHTML( $field , $required)
	{
		$isDropDown	= false;
		return parent::getFieldHTML($field, $required, $isDropDown);
	}

}