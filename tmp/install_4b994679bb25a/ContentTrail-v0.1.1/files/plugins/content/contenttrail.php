<?php
/**
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
require (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_contenttrail'.DS.'helper.php');

/**
*
*/
class plgContentContenttrail extends JPlugin
{

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param object $subject The object to observe
	 * @param object $params  The object that holds the plugin parameters
	 * @since 1.5
	 */
	function plgContentContenttrail( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	
	function onAfterDispatch()
	{
		// Get Plugin info
		$plugin	=& JPluginHelper::getPlugin('content', 'contenttrail');
		$pluginParams = new JParameter( $plugin->params );
		
		global $mainframe;
		$pathway =& $mainframe->getPathway();
		
		$items = comContentTrailHelper::getList($pluginParams);
		if(count($items) && $pluginParams->get('override', 1)) {
			$pathway->setPathway($items);
		}
		JRequest::setVar('contenttrail-breadcrumbs', $items);
		
		return true;
	}
}
