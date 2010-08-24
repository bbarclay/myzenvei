<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

function cGetUserId( $username )
{
	$db		=& JFactory::getDBO();
	$query	= 'SELECT ' . $db->nameQuote( 'id' ) . ' '
			. 'FROM ' . $db->nameQuote( '#__users' ) . ' '
			. 'WHERE ' . $db->nameQuote( 'username' ) . '=' . $db->Quote( $username );

	$db->setQuery( $query );
	
	$id		= $db->loadResult();

	return $id;
}

function cGetUserThumb( $userId , $imageClass = '' , $anchorClass = '' )
{
	$user	= CFactory::getUser( $userId );
	
	$imageClass		= (!empty( $imageClass ) ) ? ' class="' . $imageClass . '"' : '';
	$anchorClass	= ( !empty( $anchorClass ) ) ? ' class="' . $anchorClass . '"' : '';
	
	$data	= '<a href="' . CRoute::_('index.php?option=com_community&view=profile&userid=' . $user->id ) . '"' . $anchorClass . '>';
	$data	.= '<img src="{user:thumbnail:' . $userId . '}" alt="' . $user->getDisplayName() . '"' . $imageClass . ' />';
	$data	.= '</a>';
	
	return $data;
}

function cValidUsername( $username )
{
	return (!preg_match( "/[<>\"'%;()&]/i" , $username ) && JString::strlen( $username )  > 2 );
}