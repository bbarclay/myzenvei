<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
//
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

define( 'COMMUNITY_ASSETS_PATH' 	, JPATH_COMPONENT . DS . 'assets' );
define( 'COMMUNITY_ASSETS_URL' 		, JURI::base() . 'components/com_community/assets' );
define( 'COMMUNITY_BASE_PATH'		, dirname( JPATH_BASE ) . DS . 'components' . DS . 'com_community' );
define( 'COMMUNITY_BASE_ASSETS_PATH', JPATH_BASE . DS . 'components' . DS . 'com_community' . DS . 'assets' );
define( 'COMMUNITY_BASE_ASSETS_URL'	, JURI::root() . 'components/com_community/assets' );
define( 'COMMUNITY_CONTROLLERS' , JPATH_COMPONENT . DS . 'controllers' );
