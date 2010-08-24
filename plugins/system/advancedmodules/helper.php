<?php
/**
 * Plugin Helper File
 *
 * @package     Advanced Module Manager
 * @version     1.7.0
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Plugin that gives advanced features for modules
*/
class plgSystemAdvancedModulesHelper
{
	/*
	 * Place slider with active modules for given Itemid
	 */
	function showModulesByItemid( $id )
	{
		$document =& JFactory::getDocument();

		if (
			!isset( $document->_buffer ) ||
			!isset( $document->_buffer['component'] ) ||
			!is_array( $document->_buffer['component'] ) ||
			!count( $document->_buffer['component'] )
		) {
			return;
		}

		$lang =& JFactory::getLanguage();
		// load plugin language file
		$lang->load( 'plg_system_advancedmodules', JPATH_ADMINISTRATOR );

		jimport( 'joomla.html.pane' );
		$slider =& JPane::getInstance( 'sliders', array( 'allowAllClose' => true ) );

		$pane = $slider->startPanel( JText :: _( 'Active Modules' ), "advancedmodules-page" );
		$pane .= $this->getModulesTable( $id );
		$pane .= $slider->endPanel();

		$s = '(<div [^>]*id="menu-pane"[^>]*>.*)(<\/div>.*<\/td>.*<\/table>.*<\/form>)';
		$r = '\1'.$pane.'\2';

		foreach( $document->_buffer['component'] as $i => $buffer ) {
			$document->_buffer['component'][$i] = preg_replace( '#'.$s.'#si', $r, $buffer );
		}
	}

	function getModulesTable( $id )
	{
		JHTML::_( 'behavior.modal' );

		$user =& JFactory::getUser();
		$modules = $this->getAdvancedModules( $id );

		if ( !count( $modules ) ) {
			return '<p style="text-align:center;">'.JText::_( 'No active modules' ).'</p>';
		}

		$table = '
			<table class="adminlist" cellspacing="1">
				<thead>
					<tr>
						<th>'.JText::_( 'Module Name' ).'</th>
						<th>'.JText::_( 'Position' ).'</th>
						<th>'.JText::_( 'Type' ).'</th>
						<th>'.JText::_( 'Access' ).'</th>
						<th>'.JText::_( 'ID' ).'</th>
					</tr>
				</thead>
				<tbody>';
		foreach ( $modules as $module ) {
			$access = JHTML::_('grid.access', $module, NULL, 1 );
			if (  JTable::isCheckedOut( $user->get( 'id' ), $module->checked_out ) ) {
				$title = $module->title;
			} else {
				$link = JRoute::_( 'index.php?option=com_advancedmodules&client=0&task=edit&tmpl=component&cid[]='. $module->id );
				$title = '
					<span class="editlinktip hasTip" title="'.JText::_( 'Edit Module' ).'::'.$module->title.'">
						<a href="'.$link.'" class="modal" rel="{handler: \'iframe\', size: {x: 700, y: 550}}">'.$module->title.'</a>
					</span>';
			}
			$table .= '
					<tr>
						<td>'.$title.'</td>
						<td>'.$module->position.'</td>
						<td>'.$module->module.'</td>
						<td>'.$access.'</td>
						<td>'.$module->id.'</td>
					</tr>';
		}
		$table .= '
				</tbody>
			</table>';

		return $table;

	}

	function getAdvancedModules( $Itemid )
	{
		require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'parameters.php';
		$parameters =& NNePparameters::getParameters();

		$db =& JFactory::getDBO();

		$query = 'SELECT m.id, m.title, m.module, m.position, m.checked_out, m.access,'
			.' am.params as adv_params,'
			.' g.name AS groupname'
			.' FROM #__modules AS m'
			.' LEFT JOIN #__advancedmodules AS am ON am.moduleid = m.id'
			.' LEFT JOIN #__groups AS g ON g.id = m.access'
			.' WHERE m.published = 1'
			.' AND m.client_id = 0'
			.' GROUP BY m.id'
			.' ORDER BY m.position, m.ordering, m.id';

		$db->setQuery( $query );

		if ( null === ( $modules = $db->loadObjectList( 'id' ) ) ) {
			JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'Error Loading Modules' ) . $db->getErrorMsg() );
			return false;
		}

		require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'assignments.php';
		$assignments = new NoNumberElementsAssignmentsHelper;
		$assignments->_params->Itemid = $Itemid;
		$xmlfile = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_advancedmodules'.DS.'assignments.xml';

		$ordered = array();

		foreach( $modules as $id => $module ) {
			$module->adv_params = $parameters->getParams( $module->adv_params, $xmlfile );

			if ( $module->adv_params->assignto_menuitems ) {
				$params = null;
				$params->assignment = $module->adv_params->assignto_menuitems;
				$params->selection = $module->adv_params->assignto_menuitems_selection;
				$params->params = null;
				$params->params->inc_children = $module->adv_params->assignto_menuitems_inc_children;
				$params->params->inc_noItemid = $module->adv_params->assignto_menuitems_inc_noitemid;

				$assignments->initParams( $params, 'MenuItem' );
				$pass = $assignments->passMenuItem( $params->params, $params->selection, $params->assignment );

				if ( !$pass ) {
					continue;
				}
			}
			$ordered[] = $modules[$id];
		}
		unset( $modules );
		return $ordered;
	}

	/*
	 * Replace links to com_modules with com_advancedmodules
	 */
	function replaceComponentLinks()
	{
		JResponse::setBody( preg_replace( '#(option=com_)(modules[^a-z-_])#', '\1advanced\2', JResponse::getBody() ) );
	}
}