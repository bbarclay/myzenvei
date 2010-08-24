<?php
/**
 * php uninstall file for AutoTweet NG.
  *
 * @version	1.0
 * @author	Ulli Storck
 * @license	GPL 2.0
 *
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.installer.installer');


function com_uninstall()
{
	echo '<p><strong>' . JText::_('AutoTweet NG Component uninstall procedure.') . '</strong></p>';
	echo '<p>' . JText::_('Note: To prevent loss of data the AutoTweet database tables are not removed automatically.') . '</p>';
	echo '<hr/>';

	//
	// uninstall  plugins
	//
	$db =& JFactory::getDBO();
	$query = 'SELECT ' . $db->NameQuote('id') . ', ' . $db->NameQuote('name') . ' FROM ' . $db->NameQuote('#__plugins')
		. ' WHERE ' . $db->NameQuote('element') . ' like ' . $db->Quote('autotweet%');
	$db->setQuery($query);
	$plugs = $db->loadAssocList();
			
	$inst = new JInstaller();	// do not use the component installer (getInstance); own installer object is needed	
	foreach ($plugs as $plug) {
		$inst_result = $inst->uninstall('plugin', $plug['id']);
		
		if(!$inst_result) {
			echo '<p>Plugin uninstallation failed for ' . $plug['name'] . '. Please uninstall plugin manually!</p>';
		}
		else {
			echo '<p>Plugin ' . $plug['name'] . ' has been successfully uninstalled.</p>';
		}
	}

	echo '<hr/>';
	echo '<p><strong>' . JText::_('AutoTweet removed.') . '</strong></p>';
	echo '<p>&nbsp;</p>';

	return true;
}
	
?>
