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
class CommunityTableVideosCategories extends JTable
{
	var $id				= null;
	var $name			= null;
	var $description	= null;
	var $published      = null;

	
	function __construct(&$db)
	{
		parent::__construct('#__community_videos_category','id', $db);
	}
	
	function delete( $id )
	{
		$db	=& JFactory::getDBO();
		
		// Check if any groups are assigned into this category
		$query		= 'SELECT COUNT(*) FROM ' . $db->nameQuote('#__community_videos') . ' '
					. 'WHERE ' . $db->nameQuote('category_id') . '=' . $db->Quote($id);
		$db->setQuery( $query );
		$count		= $db->loadResult();
	
		if($count <= 0)
		{
			// Only delete if no groups are assigned to this category.
			parent::delete( $id );
			return true;
		}
		
		return false;
	}
}
