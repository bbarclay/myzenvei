<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CFieldsTextarea
{
	function getFieldHTML( $field , $required )
	{
		// If maximum is not set, we define it to a default
		$field->max	= empty( $field->max ) ? 200 : $field->max;
	 
		$class	= ($field->required == 1) ? ' required' : '';
		CFactory::load( 'helpers' , 'string' );
		$html	= '<textarea id="field' . $field->id . '" name="field' . $field->id . '" class="jomTips tipRight inputbox textarea' . $class . '" title="' . $field->name . '::' . cEscape( $field->tips ) . '">' . $field->value . '</textarea>';
		$html   .= '<span id="errfield'.$field->id.'msg" style="display:none;">&nbsp;</span>';
		
		return $html;
	}
	
	function isValid( $value , $required )
	{
		if( $required && empty($value))
		{
			return false;
		}		
		return true;
	}
}
