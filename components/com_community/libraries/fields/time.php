<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.utilities.date');

class CFieldsTime
{
	/**
	 * Method to format the specified value for text type
	 **/	 	
	
	function getFieldHTML( $field , $required )
	{		
		$html	= '';
				
		$hour	= '';
		$minute	= 0;
		$second	= '';		
		
		if(! empty($field->value))
		{
			$myTimeArr	= explode(' ', $field->value);
			
			if(is_array($myTimeArr) && count($myTimeArr) > 0)
			{
				$myTime	= explode(':', $myTimeArr[0]);
				
				$hour	= !empty($myTime[0]) ? $myTime[0] : '00';
				$minute	= !empty($myTime[1]) ? $myTime[1] : '00';
				$second	= !empty($myTime[2]) ? $myTime[2] : '00';								
			}
		}		
		
		$hours = array();
		for($i=0; $i<24; $i++)
		{
			$hours[] = ($i<10)? '0'.$i : $i;
		}
		
		$minutes = array();
		for($i=0; $i<60; $i++)
		{
			$minutes[] = ($i<10)? '0'.$i : $i;
		}
		
		$seconds = array();
		for($i=0; $i<60; $i++)
		{
			$seconds[] = ($i<10)? '0'.$i : $i;
		}
		CFactory::load( 'helpers' , 'string' );
        $class	= ($field->required == 1) ? ' required' : '';
		$html .= '<div class="jomTips tipRight" style="display: inline-block;" title="' . $field->name . '::' . cEscape( $field->tips ) . '">';
		$html .= '<select name="field' . $field->id . '[]" >';
		for( $i = 0; $i < count($hours); $i++)
		{
			if($hours[$i]==$hour)
			{
				$html .= '<option value="' . $hours[$i] . '" selected="selected">' . $hours[$i] . '</option>';
			}
			else
			{
				$html .= '<option value="' . $hours[$i] . '">' . $hours[$i] . '</option>';
			}
		}
		$html .= '</select> ' . JText::_('CC HOUR FORMAT') . '&nbsp;:&nbsp;';
		$html .= '<select name="field' . $field->id . '[]" >';
		for( $i = 0; $i < count($minutes); $i++)
		{
			if($minutes[$i]==$minute)
			{
				$html .= '<option value="' . $minutes[$i] . '" selected="selected">' . $minutes[$i] . '</option>';
			}
			else
			{
				$html .= '<option value="' . $minutes[$i] . '">' . $minutes[$i] . '</option>';
			}
		}
		$html .= '</select> ' . JText::_('CC MINUTE FORMAT') . '&nbsp;:&nbsp;';
		$html .= '<select name="field' . $field->id . '[]" >';
		for( $i = 0; $i < count($seconds); $i++)
		{
			if($seconds[$i]==$second)
			{
				$html .= '<option value="' . $seconds[$i] . '" selected="selected">' . $seconds[$i] . '</option>';
			}
			else
			{
				$html .= '<option value="' . $seconds[$i] . '">' . $seconds[$i] . '</option>';
			}
		}
		$html .= '</select> ' . JText::_('CC SECOND FORMAT');
		$html .= '<span id="errfield'.$field->id.'msg" style="display:none;">&nbsp;</span>';
		$html .= '</div>';
		
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
	
	function formatdata( $value )
	{	
		$finalvalue = '';		
		if(is_array($value))
		{
			if( empty( $value[0] ) || empty( $value[1] ) || empty( $value[2] ) )
			{
				$finalvalue = '';
			}
			else
			{			
				$hour 	= !empty($value[0]) ? $value[0]	: '00';
				$minute = !empty($value[1]) ? $value[1]	: '00';
				$second = !empty($value[2]) ? $value[2]	: '00';
				
				$finalvalue	= $hour . ':' . $minute . ':' . $second;
			}
		}		
		return $finalvalue;	
	}
}