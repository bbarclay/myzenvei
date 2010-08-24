<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');
jimport ( 'joomla.application.component.view' );

class CommunityViewFacebook extends CommunityView
{
	function receiver()
	{
		$tmpl	= new CTemplate();
		
		echo $tmpl->fetch( 'facebook.receiver' );
	}
}
