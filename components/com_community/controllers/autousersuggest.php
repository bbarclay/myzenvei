<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CommunityAutoUserSuggestController extends CommunityBaseController
{
	function ajaxAutoUserSuggest()
	{
		$config			= CFactory::getConfig();
		$displayName	= $config->get('displayname');
		$html 			= '';
		
		$searchModel =& CFactory::getModel( 'Search' );
		$searchName = JRequest::getVar('q', '');
		
		$suggestions = $searchModel->getAutoUserSuggest($searchName, $displayName);
		
		if(!empty($suggestions))
		{
			$names="";
			foreach( $suggestions as $row ){
				$user 	= CFactory::getUser( $row->id );
				$avatar = $user->getAvatar();
				$names .= $row->username."|".$row->id."|".$avatar."|\n";
			}
			
			echo $names;
		}
		exit ();
	}
}
