<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Jom Social Table Model
 */
class CommunityTableReportsActions extends JTable
{
	var $id				= null;
	var $reportid		= null;
	var $label			= null;
	var $method			= null;
	var $parameters		= null;
	var $defaultaction	= null;

	function __construct(&$db)
	{
		parent::__construct('#__community_reports_actions','id', $db);
	}
}