<?php
/**
 * @package     Advanced Module Manager
 * @version     1.7.0
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

/**
 * BASE ON JOOMLA CORE FILE:
 * /libraries/joomla/application/module/helper.php
 */

/**
* @version		$Id: helper.php 10707 2008-08-21 09:52:47Z eddieajau $
* @package		Joomla.Framework
* @subpackage	Application
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is within the rest of the framework
defined( 'JPATH_BASE' ) or die();

// Import library dependencies
jimport( 'joomla.application.component.helper' );

require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'parameters.php';

/**
 * Module helper class
 *
 * @static
 * @package		Joomla.Framework
 * @subpackage	Application
 * @since		1.5
 */
class JModuleHelper
{
	/**
	 * Get module by name (real, eg 'Breadcrumbs' or folder, eg 'mod_breadcrumbs' )
	 *
	 * @access	public
	 * @param	string 	$name	The name of the module
	 * @param	string	$title	The title of the module, optional
	 * @return	object	The Module object
	 */
	function &getModule( $name, $title = null )
	{
		$result		= null;
		$modules	=& JModuleHelper::_load();
		$total		= count( $modules );
		for ( $i = 0; $i < $total; $i++ )
		{
			// Match the name of the module
			if ( $modules[$i]->name == $name )
			{
				// Match the title if we're looking for a specific instance of the module
				if ( ! $title || $modules[$i]->title == $title )
				{
					$result =& $modules[$i];
					break;	// Found it
				}
			}
		}
		
		// if we didn't find it, and the name is mod_something, create a dummy object
		if ( is_null( $result ) && substr( $name, 0, 4 ) == 'mod_' )
		{
			$result				= new stdClass;
			$result->id			= 0;
			$result->title		= '';
			$result->module		= $name;
			$result->position	= '';
			$result->content	= '';
			$result->showtitle	= 0;
			$result->control	= '';
			$result->params		= null;
			$result->user		= 0;
		}

		return $result;
	}

	/**
	 * Get modules by position
	 *
	 * @access public
	 * @param string 	$position	The position of the module
	 * @return array	An array of module objects
	 */
	function &getModules( $position )
	{
		$position	= strtolower( $position );
		$result		= array();

		$modules =& JModuleHelper::_load();

		$total = count( $modules );
		for( $i = 0; $i < $total; $i++ ) {
			if( $modules[$i]->position == $position ) {
				$result[] =& $modules[$i];
			}
		}
		unset( $modules );
		
		if( count( $result ) == 0 ) {
			if( JRequest::getBool( 'tp' ) ) {
				$result['0'] = JModuleHelper::getModule( 'mod_'.$position );
				$result['0']->title = $position;
				$result['0']->content = $position;
				$result['0']->position = $position;
			}
		}

		return $result;
	}

	/**
	 * Checks if a module is enabled
	 *
	 * @access	public
	 * @param   string 	$module	The module name
	 * @return	boolean
	 */
	function isEnabled( $module )
	{
		$result =& JModuleHelper::getModule( $module );
		return ( !is_null( $result ) );
	}

	function renderModule( $module, $attribs = array() )
	{
		static $chrome;
		
		$mainframe =& JFactory::getApplication();
		$option	= JRequest::getCmd( 'option' );

		$scope = $mainframe->scope; //record the scope
		$mainframe->scope = $module->module;  //set scope to component name

		// Handle legacy globals if enabled
		if ( $mainframe->getCfg( 'legacy' ) )
		{
			// Include legacy globals
			global $my, $database, $acl, $mosConfig_absolute_path;

			// Get the task variable for local scope
			$task = JRequest::getString( 'task' );

			// For backwards compatibility extract the config vars as globals
			$registry =& JFactory::getConfig();
			foreach ( get_object_vars( $registry->toObject() ) as $k => $v ) {
				$name = 'mosConfig_'.$k;
				$$name = $v;
			}
			$contentConfig =& JComponentHelper::getParams( 'com_content' );
			foreach ( get_object_vars( $contentConfig->toObject() ) as $k => $v )
			{
				$name = 'mosConfig_'.$k;
				$$name = $v;
			}
			$usersConfig =& JComponentHelper::getParams( 'com_users' );
			foreach ( get_object_vars( $usersConfig->toObject() ) as $k => $v )
			{
				$name = 'mosConfig_'.$k;
				$$name = $v;
			}
		}

		// Get module parameters
		$params = new JParameter( $module->params );

		// Get module path
		$module->module = preg_replace( '/[^A-Z0-9_\.-]/i', '', $module->module );
		$path = JPATH_BASE.DS.'modules'.DS.$module->module.DS.$module->module.'.php';

		// Load the module
		if ( !$module->user && file_exists( $path ) && empty( $module->content ) )
		{
			$lang =& JFactory::getLanguage();
			$lang->load( $module->module );

			$content = '';
			ob_start();
			require $path;
			$module->content = ob_get_contents().$content;
			ob_end_clean();
		}

		// Load the module chrome functions
		if ( !$chrome ) {
			$chrome = array();
		}

		require_once JPATH_BASE.DS.'templates'.DS.'system'.DS.'html'.DS.'modules.php';
		$chromePath = JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'modules.php';
		if ( !isset( $chrome[$chromePath] ) )
		{
			if ( file_exists( $chromePath ) ) {
				require_once $chromePath;
			}
			$chrome[$chromePath] = true;
		}

		//make sure a style is set
		if( !isset( $attribs['style'] ) ) {
			$attribs['style'] = 'none';
		}

		//dynamically add outline style
		if( JRequest::getBool( 'tp' ) ) {
			$attribs['style'] .= ' outline';
		}

		if ( $module->content == '' ) {
			$parameters =& NNePparameters::getParameters();

			$xmlfile = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'advancedmodules.xml';
			$plugin = JPluginHelper::getPlugin( 'system', 'advancedmodules' );
			$plugin_params = $parameters->getParams( $plugin->params, $xmlfile );
			
			if ( $plugin_params->show_hideempty ) {
				$db =& JFactory::getDBO();
				$query = 'SELECT params'
					.' FROM #__advancedmodules'
					.' WHERE moduleid = '.(int) $module->id
					;
				$db->setQuery( $query );
				$adv_params = $parameters->getParams( $db->loadResult() );
				if ( $adv_params && isset( $adv_params->hideempty ) && $adv_params->hideempty ) {
					return '';
				}
			}
		}

		foreach( explode( ' ', $attribs['style'] ) as $style )
		{
			$chromeMethod = 'modChrome_'.$style;

			// Apply chrome and render module
			if ( function_exists( $chromeMethod ) )
			{
				$module->style = $attribs['style'];

				ob_start();
				$chromeMethod( $module, $params, $attribs );
				$module->content = ob_get_contents();
				ob_end_clean();
			}
		}

		$mainframe->scope = $scope; //revert the scope

		return $module->content;
	}

	/**
	 * Get the path to a layout for a module
	 *
	 * @static
	 * @param	string	$module	The name of the module
	 * @param	string	$layout	The name of the module layout
	 * @return	string	The path to the module layout
	 * @since	1.5
	 */
	function getLayoutPath( $module, $layout = 'default' )
	{
		$mainframe =& JFactory::getApplication();

		// Build the template and base path for the layout
		$tPath = JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$module.DS.$layout.'.php';
		$bPath = JPATH_BASE.DS.'modules'.DS.$module.DS.'tmpl'.DS.$layout.'.php';

		// If the template has a layout override use it
		if ( file_exists( $tPath ) ) {
			return $tPath;
		} else {
			return $bPath;
		}
	}

	/**
	 * Load published modules
	 *
	 * @access	private
	 * @return	array
	 */

	function &_load()
	{
		$mainframe =& JFactory::getApplication();
		$Itemid	= JRequest::getInt( 'Itemid' );

		static $modules;

		if ( isset( $modules ) ) {
			return $modules;
		}

		$user	=& JFactory::getUser();
		$db		=& JFactory::getDBO();

		$aid	= $user->get( 'aid', 0 );

		$modules	= array();

		$select = 'm.*';
		$join = '';
		if ( $mainframe->getClientId() == 0 ) {
			$select .= ', am.params as adv_params';
			$join = ' LEFT JOIN #__advancedmodules as am'
				.' ON am.moduleid = m.id';
		}
		$query = 'SELECT '.$select
			.' FROM #__modules as m'
			.$join
			.' WHERE published = 1'
			.' AND m.access '.( defined( '_JACL' ) ? 'IN ( '.$user->get( 'jaclplus', '0' ).' )' : '<= '. (int) $aid )
			.' AND m.client_id = '. (int) $mainframe->getClientId()
			.' ORDER BY m.ordering, m.id';
		$db->setQuery( $query );

		if ( null === ( $modules = $db->loadObjectList( 'id' ) ) ) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'Error Loading Modules' ) . $db->getErrorMsg() );
			return false;
		}

		if ( $mainframe->getClientId() == 0 ) {
			jimport( 'joomla.filesystem.file' );
			
			$parameters =& NNePparameters::getParameters();

			require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'assignments.php';
			$assignments = new NoNumberElementsAssignmentsHelper;

			$xmlfile_adv = JPATH_SITE.DS.'plugins'.DS.'system'.DS.'advancedmodules.xml';
			$xmlfile_assignments = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_advancedmodules'.DS.'assignments.xml';

			$plugin = JPluginHelper::getPlugin( 'system', 'advancedmodules' );
			$plugin_params = $parameters->getParams( $plugin->params, $xmlfile_adv );

			// set params for all loaded modules first
			foreach ( $modules as $id => $module ) {
				if ( !$module->adv_params || strpos( $module->adv_params, 'assignto_menuitems=' ) === false ) {
					$modules->adv_params = JModuleHelper::updateParams( $module->id, $module->adv_params );
				}

				$modules[$id]->adv_params = $parameters->getParams( $module->adv_params, $xmlfile_assignments );
			}

			foreach ( $modules as $id => $module ) {
				// Check if module should mirror another modules assignment settings
				if ( $plugin_params->show_mirror_module ) {
					$count = 0;

					while ( $count++ < 10 && $module->adv_params->mirror_module ) {
						$mirror_moduleid = $module->adv_params->mirror_moduleid;
						$module->adv_params = null;
						if ( $mirror_moduleid && $mirror_moduleid != $id ) {
							if ( isset( $modules[$mirror_moduleid] ) ) {
								$module->adv_params = $modules[$mirror_moduleid]->adv_params;
							} else {
								$query = 'SELECT params'
									.' FROM #__advancedmodules'
									.' WHERE moduleid = '. (int) $mirror_moduleid
									.' LIMIT 1';
								$db->setQuery( $query );
								$module->adv_params = $parameters->getParams( $db->loadResult(), $xmlfile_assignments );
							}
						}
					}
				}

				$params = array();
				if ( $module->adv_params->assignto_menuitems ) {
					$params['MenuItem'] = null;
					$params['MenuItem']->assignment = $module->adv_params->assignto_menuitems;
					$params['MenuItem']->selection = $module->adv_params->assignto_menuitems_selection;
					$params['MenuItem']->params = null;
					$params['MenuItem']->params->inc_children = $module->adv_params->assignto_menuitems_inc_children;
					$params['MenuItem']->params->inc_noItemid = $module->adv_params->assignto_menuitems_inc_noitemid;
				}
				if ( $plugin_params->show_assignto_secscats && $module->adv_params->assignto_secscats ) {
					$params['SecsCats'] = null;
					$params['SecsCats']->assignment = $module->adv_params->assignto_secscats;
					$params['SecsCats']->selection = $module->adv_params->assignto_secscats_selection;
					$params['SecsCats']->params = null;
					$incs = $module->adv_params->assignto_secscats_inc;
					if ( !is_array( $incs ) ) {
						$incs = explode( ',', $incs );
					}
					$params['SecsCats']->params->inc_sections = in_array( 'inc_secs', $incs );
					$params['SecsCats']->params->inc_categories = in_array( 'inc_cats', $incs );
					$params['SecsCats']->params->inc_articles = in_array( 'inc_arts', $incs );
					$params['SecsCats']->params->inc_others = in_array( 'inc_others', $incs );
				}
				if ( $plugin_params->show_assignto_k2cats && $module->adv_params->assignto_k2cats && JFile::exists( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'admin.k2.php' ) ) {
					$params['Categories_K2'] = null;
					$params['Categories_K2']->assignment = $module->adv_params->assignto_k2cats;
					$params['Categories_K2']->selection = $module->adv_params->assignto_k2cats_selection;
					$params['Categories_K2']->params = null;
					$params['Categories_K2']->params->inc_children = $module->adv_params->assignto_k2cats_inc_children;
					$incs = $module->adv_params->assignto_k2cats_inc;
					if ( !is_array( $incs ) ) {
						$incs = explode( ',', $incs );
					}
					$params['Categories_K2']->params->inc_categories = in_array( 'inc_cats', $incs );
					$params['Categories_K2']->params->inc_items = in_array( 'inc_items', $incs );
				}
				if ( $plugin_params->show_assignto_articles && $module->adv_params->assignto_articles ) {
					$params['Articles'] = null;
					$params['Articles']->assignment = $module->adv_params->assignto_articles;
					$params['Articles']->selection = $module->adv_params->assignto_articles_selection;
				}
				if ( $plugin_params->show_assignto_components && $module->adv_params->assignto_components ) {
					$params['Components'] = null;
					$params['Components']->assignment = $module->adv_params->assignto_components;
					$params['Components']->selection = $module->adv_params->assignto_components_selection;
				}
				if ( $plugin_params->show_assignto_urls && $module->adv_params->assignto_urls ) {
					$params['URL'] = null;
					$params['URL']->assignment = $module->adv_params->assignto_urls;
					$params['URL']->selection = explode( "\n", $module->adv_params->assignto_urls_selection );
				}
				if ( $plugin_params->show_assignto_date && $module->adv_params->assignto_date ) {
					$params['Date'] = null;
					$params['Date']->assignment = $module->adv_params->assignto_date;
					$params['Date']->params = null;
					$params['Date']->params->publish_up = $module->adv_params->assignto_date_publish_up;
					$params['Date']->params->publish_ = $module->adv_params->assignto_date_publish_down;
				}
				if ( $plugin_params->show_assignto_usergrouplevels && $module->adv_params->assignto_usergrouplevels ) {
					$params['UserGroupLevels'] = null;
					$params['UserGroupLevels']->assignment = $module->adv_params->assignto_usergrouplevels;
					$params['UserGroupLevels']->selection = $module->adv_params->assignto_usergrouplevels_selection;
				}
				if ( $plugin_params->show_assignto_users && $module->adv_params->assignto_users ) {
					$params['Users'] = null;
					$params['Users']->assignment = $module->adv_params->assignto_users;
					$params['Users']->selection = $module->adv_params->assignto_users_selection;
				}
				if ( $plugin_params->show_assignto_languages && $module->adv_params->assignto_languages ) {
					$params['Languages'] = null;
					$params['Languages']->assignment = $module->adv_params->assignto_languages;
					$params['Languages']->selection = $module->adv_params->assignto_languages_selection;
				}
				if ( $plugin_params->show_assignto_templates && $module->adv_params->assignto_templates ) {
					$params['Templates'] = null;
					$params['Templates']->assignment = $module->adv_params->assignto_templates;
					$params['Templates']->selection = $module->adv_params->assignto_templates_selection;
				}
				if ( $plugin_params->show_assignto_php && $module->adv_params->assignto_php ) {
					$params['PHP'] = null;
					$params['PHP']->assignment = $module->adv_params->assignto_php;
					$params['PHP']->selection = $module->adv_params->assignto_php_selection;
				}

				$pass = $assignments->passAll( $params, $module->adv_params->match_method );

				if ( !$pass ) {
					unset( $modules[$id] );
				}
			}
		}

		$modules = array_values( $modules );

		$total = count( $modules );
		for( $i = 0; $i < $total; $i++ )
		{
			//determine if this is a custom module
			$file					= $modules[$i]->module;
			$custom 				= substr( $file, 0, 4 ) == 'mod_' ?  0 : 1;
			$modules[$i]->user  	= $custom;
			// CHECK: custom module name is given by the title field, otherwise it's just 'om' ??
			$modules[$i]->name		= $custom ? $modules[$i]->title : substr( $file, 4 );
			$modules[$i]->style		= null;
			$modules[$i]->position	= strtolower( $modules[$i]->position );
		}

		return $modules;
	}
	
	function updateParams( $id, $params )
	{
		$db =& JFactory::getDBO();

		$assignto_menuitems = 1;
		$selection = array();

		if( $params ) {
			if ( strpos( $params, 'assignto_' ) === false ) {
				$params = str_replace( 'limit_', 'assignto_', $params ); // fix old param names

				$query = 'UPDATE #__advancedmodules'
					.' SET params = '.$db->quote( $params )
					.' WHERE moduleid = '.(int) $id
					;
				$db->setQuery( $query );
				$db->query();
			}

			$db->setQuery( 'show tables like \''.$db->_table_prefix.'advancedmodules_menu\'' );
			$exists = $db->loadResult();
			if ( $exists ) {
				$assignto_menuitems = 2;
				$query = 'SELECT menuid AS value'
					.' FROM #__advancedmodules_menu'
					.' WHERE moduleid = '.(int) $row->id
					;
				$db->setQuery( $query );
				$selection = $db->loadResultArray();
			}
		}

		if ( empty( $selection ) ) {
			$assignto_menuitems = 1;
			$query = 'SELECT menuid AS value'
				.' FROM #__modules_menu'
				.' WHERE moduleid = '.(int) $id
				;
			$db->setQuery( $query );
			$selection = $db->loadResultArray();
			if ( !empty( $selection ) == 1 && $selection['0'] == 0 ) {
				$assignto_menuitems = 0;
			}
		}

		$params .= "\nassignto_menuitems=".$assignto_menuitems."\nassignto_menuitems_selection=".implode( '|', $selection );
		$query = 'REPLACE INTO #__advancedmodules'
			.' ( `id`, `moduleid`, `params` ) VALUES'
			.' ( NULL, '.(int ) $id.', '.$db->quote( trim( $params ) ).' )'
			;
		$db->setQuery( $query );
		$db->query();

		return trim( $params );
	}
}