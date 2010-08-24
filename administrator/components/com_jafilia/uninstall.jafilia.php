<?php
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */

//--No direct access
defined( '_JEXEC' ) or die( '=;)' );

define( 'WIPEDB', 1 );	//1 - delete #__jafilia_ database tables; 0 - do nothing

/*
 * This part is taken from the Joomla Tags component, courtesy of
 * joomlatags.org (GPL'd)
 */

jimport('joomla.application.helper');

$status = new JObject();
//$status->modules = array();
$status->plugins = array();

/* ---------------------------------------------------------------------------------------------
 * MODULE REMOVAL SECTION
 * ---------------------------------------------------------------------------------------------*/
/*
$modules = &$this->manifest->getElementByPath( 'modules' );
if( is_a( $modules, 'JSimpleXMLElement' ) && count( $modules->children() ) ) {

	foreach( $modules->children() as $module )
	{
		$mname = $module->attributes( 'module' );
		$mclient = JApplicationHelper::getClientInfo( $module->attributes( 'client' ), true );
		$mposition = $module->attributes( 'position' );

		// Set the installation path
		if( !empty ( $mname ) ) {
			$this->parent->setPath( 'extension_root', $mclient->path.DS.'modules'.DS.$mname );
		} else {
			$this->parent->abort( JText::_( 'Module' ).' '.JText::_( 'Install' ).': '.JText::_( 'No module file specified' ) );
			return false;
		}

		$db = &JFactory::getDBO();

		// Lets delete all the module copies for the type we are uninstalling
		$query = 'SELECT `id`' .
                                ' FROM `#__modules`' .
                                ' WHERE module = '.$db->Quote( $mname ) .
                                ' AND client_id = '.(int)$mclient->id;
		$db->setQuery( $query );
		$modules = $db->loadResultArray();

		// Do we have any module copies?
		if(count( $modules ) ) {
			JArrayHelper::toInteger( $modules );
			$modID = implode( ',', $modules );
			$query = 'DELETE' .
                                        ' FROM #__modules_menu' .
                                        ' WHERE moduleid IN ('.$modID.')';
			$db->setQuery( $query );
			if( !$db->query() ) {
				JError::raiseWarning( 100, JText::_( 'Module' ).' '.JText::_( 'Uninstall' ).': '.$db->stderr( true ) );
				$retval = false;
			}
		}

		// Delete the modules in the #__modules table
		$query = 'DELETE FROM #__modules WHERE module = '.$db->Quote( $mname );
		$db->setQuery( $query );
		if( !$db->query() ) {
			JError::raiseWarning( 100, JText::_( 'Plugin' ).' '.JText::_( 'Uninstall' ).': '.$db->stderr( true ) );
			$retval = false;
		}

		// Remove all necessary files
		$element = &$module->getElementByPath( 'files' );
		if( is_a( $element, 'JSimpleXMLElement' ) && count( $element->children() ) ) {
			$this->parent->removeFiles( $element, -1 );
		}

		// Remove all necessary files
		$element = &$module->getElementByPath( 'media' );
		if(is_a( $element, 'JSimpleXMLElement' ) && count( $element->children() ) ) {
			$this->parent->removeFiles( $element, -1 );
		}

		$element = &$module->getElementByPath( 'languages' );
		if( is_a( $element, 'JSimpleXMLElement' ) && count( $element->children() ) ) {
			$this->parent->removeFiles( $element, $mclient->id );
		}

		// Remove the installation folder
		if( !JFolder::delete( $this->parent->getPath( 'extension_root' ) ) ) {
		}

		$status->modules[] = array( 'name'=>$mname, 'client'=>$mclient->name );
	}
}
*/
/***********************************************************************************************
 * ---------------------------------------------------------------------------------------------
 * PLUGIN REMOVAL SECTION
 * ---------------------------------------------------------------------------------------------
 ***********************************************************************************************/

$plugins = &$this->manifest->getElementByPath( 'plugins' );
if( is_a( $plugins, 'JSimpleXMLElement' ) && count( $plugins->children() ) )
{
	foreach( $plugins->children() as $plugin )
	{
		$pname = $plugin->attributes( 'plugin' );
		$pgroup = $plugin->attributes( 'group' );

		// Set the installation path
		if( !empty( $pname ) && !empty( $pgroup ) ) {
			$this->parent->setPath( 'extension_root', JPATH_ROOT.DS.'plugins'.DS.$pgroup );
		} else {
			$this->parent->abort( JText::_( 'Plugin' ).' '.JText::_( 'Uninstall' ).': '.JText::_( 'No plugin file specified' ) );
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Database Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */
		$db = &JFactory::getDBO();

		// Delete the plugins in the #__plugins table
		$query = 'DELETE FROM #__plugins WHERE element = '.$db->Quote( $pname ).' AND folder = '.$db->Quote( $pgroup );
		$db->setQuery( $query );
		if( !$db->query() ) {
			JError::raiseWarning( 100, JText::_( 'Plugin' ).' '.JText::_( 'Uninstall' ).': '.$db->stderr( true ) );
			$retval = false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Filesystem Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Remove all necessary files
		$element = &$plugin->getElementByPath( 'files' );
		if( is_a( $element, 'JSimpleXMLElement' ) && count( $element->children() ) ) {
			$this->parent->removeFiles( $element, -1 );
		}

		$element = &$plugin->getElementByPath( 'languages' );
		if( is_a( $element, 'JSimpleXMLElement' ) && count( $element->children() ) ) {
			$this->parent->removeFiles( $element, 1 );
		}

		// If the folder is empty, let's delete it
		$files = JFolder::files( $this->parent->getPath( 'extension_root' ) );
		if( !count( $files ) ) {
			JFolder::delete( $this->parent->getPath( 'extension_root' ) );
		}

		$status->plugins[] = array( 'name'=>$pname, 'group'=>$pgroup );
	}
}


/*
 * end code from joomlatags
 */
/*
foreach( $status->modules as $mstatus )
{
	JError::raiseNotice( 200, 'com_jcollection::uninstallModules: '.$mstatus['name'].' uninstalled' );
}
*/
foreach( $status->plugins as $pstatus )
{
	//JError::raiseNotice( 200, 'com_jcollection::uninstallPlugins: '.$pstatus['name'].' uninstalled from group '.$pstatus['group'] );
	JError::raiseNotice( 200, JText::_( 'Uninstall' ).' '.JText::_( 'Plugin' ).' Success: '.$pstatus['name'].' uninstalled from group '.$pstatus['group'] );
}

/**
 * The main uninstaller function
 */
function com_uninstall()
{
	$errors = FALSE;
	if( WIPEDB > 0 )
	{	
		//-- common images
		$img_OK = '<img src="images/publish_g.png" />';
		$img_WARN = '<img src="images/publish_y.png" />';
		$img_ERROR = '<img src="images/publish_r.png" />';
		$BR = '<br />';

		//--uninstall...

		$db = & JFactory::getDBO();

		$query = "DROP TABLE IF EXISTS `#__jafilia`;";
		$db->setQuery($query);
		if( ! $db->query() )
		{
			echo $img_ERROR.JText::_('Unable to delete table').$BR;
			echo $db->getErrorMsg();
			return FALSE;
		}

		if( $errors )
		{
			return FALSE;
		}
		
		
			/*
			$database = &JFactory::getDBO();

			$query = "DROP TABLE IF EXISTS #__trackback;";
			$database->setQuery($query);
			$database->query();
			if ($database->getErrorNum()) {
				JError::raiseError( 500, $database->stderr());
			*/
	}	
	return TRUE;
}// function
