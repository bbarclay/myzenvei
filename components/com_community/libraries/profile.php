<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CProfileLibrary
{
	function getFieldData( $fieldType , $value )
	{
		$fieldType	= strtolower( $fieldType );
		
		CFactory::load( 'libraries' . DS . 'fields' , $fieldType );
		
		$class		= 'CFields' . ucfirst( $fieldType );
		
		if( class_exists( $class ) )
		{
			$object		= new $class();
			
			if( method_exists( $object , 'getFieldData' ) )
			{
				return $object->getFieldData( $value );
			}
		}
		if($fieldType == 'select' || $fieldType == 'singleselect' || $fieldType == 'radio')
		{
			return JText::_( $value );
		}
		else if($fieldType == 'textarea')
		{
			return nl2br($value);
		}
		else
		{		
			return $value;
		}
	}
	
	/**
	 * Method to get the HTML output for specific fields
	 **/	 	
	function getFieldHTML( $field , $showRequired = '&nbsp; *' )
	{
		$fieldType	= strtolower( $field->type);
		
		if(is_array($field))
		{
			jimport( 'joomla.utilities.arrayhelper');
			$field = JArrayHelper::toObject($field);
		}
		
		CFactory::load( 'libraries' . DS . 'fields' , $fieldType );

		$class	= 'CFields' . ucfirst( $fieldType );

		if(is_object($field->options))
		{
			$field->options = JArrayHelper::fromObject($field->options);
		}
		
		// Clean the options
		if( !empty( $field->options ) && !is_array( $field->options ) )
		{
			array_walk( $field->options , array( 'JString' , 'trim' ) );
		}


		if( !isset($field->value) )
		{
			$field->value	= '';
		}

		if( class_exists( $class ) )
		{
			$object	= new $class();
			
			if( method_exists( $object, 'getFieldHTML' ) )
			{
				$html	= $object->getFieldHTML( $field , $showRequired );
				return $html;
			}
		}
		return JText::sprintf('CC UNKNOWN USER PROFILE TYPE' , $class , $fieldType );
	}

	/**
	 * Method to validate any custom field in PHP. Javascript validation is not sufficient enough.
	 * We also need to validate fields in PHP since if the user knows how to send POST data, then they
	 * will bypass javascript validations.
	 **/	 	 	 	
	function validateField( $fieldType , $value , $required )
	{
		$fieldType	= strtolower( $fieldType );
				
		CFactory::load( 'libraries' . DS . 'fields' , $fieldType );

		$class	= 'CFields' . ucfirst( $fieldType );

		if( class_exists( $class ) )
		{
			$object	= new $class();
			
			if( method_exists( $object, 'isValid' ) )
			{
				return $object->isValid( $value , $required );
			}
		}
		// Assuming there is no need for validation in these subclasses.
		return true;
	}

	function formatData( $fieldType , $value )
	{
		$fieldType	= strtolower( $fieldType );
				
		CFactory::load( 'libraries' . DS . 'fields' , $fieldType );

		$class	= 'CFields' . ucfirst( $fieldType );

		if( class_exists( $class ) )
		{
			$object	= new $class();
			
			if( method_exists( $object, 'formatData' ) )
			{
				return $object->formatData( $value );
			}
		}
		// Assuming there is no need for formatting in subclasses.
		return $value;
	}
}
