<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'views' . DS . 'frontpage' . DS . 'view.html.php' );

class CommunityViewIphoneFrontpage extends CommunityViewFrontpage
{

	function display()
	{
		$document =& JFactory::getDocument();
		$document->addStylesheet( JURI::root() . 'components/com_community/templates/default/css/style.iphone.css' );

		parent::display();
	}
}

