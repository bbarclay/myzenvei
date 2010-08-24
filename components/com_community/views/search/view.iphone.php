<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');
jimport ( 'joomla.application.component.view' );

require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'views' . DS . 'search' . DS . 'view.html.php' );

class CommunityViewIphoneSearch extends CommunityViewSearch 
{
	function browse(& $data)
	{
		parent::browse($data);
	}
}