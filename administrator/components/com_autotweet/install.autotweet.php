<?php
/**
 * php install file for AutoTweet NG.
 * Does some version checking.
 *
 * @version	1.0
 * @author	Ulli Storck
 * @license	GPL 2.0
 *
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.version' );
jimport('joomla.installer.installer');


function com_install()
{
	$result = true;

	echo '<pre>';
	if (!fm_checkPHP5()) {
		$result = false;
		echo JText::_('PHP5 is required. - Installation aborted!');
	}

	if (!fm_checkJoomla('1.5.4')) {
		$result = false;
		echo JText::_('Joomla 1.5.4 or above is required. - Installation aborted!');
		
	}

	if (!fm_checkCURL()) {
		$result = false;
		echo JText::_('CURL extension is not installed or not loaded. - Installation aborted!');
		
	}
	
	echo '</pre>';
	
	if ($result) {
		echo '<p><strong>' . JText::_('AutoTweet NG Component has been successfully installed/updated.') . '</strong></p>';
		echo '<hr/>';

		//
		// install and enable plugins
		//
		$plugins = array();
			
		$plugin_path = JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_autotweet' . DS;
		$plugins['autotweetcontent']	= $plugin_path . 'plg_autotweetngcontent.zip';
		$plugins['autotweetautomator']	= $plugin_path . 'plg_autotweetngautomator.zip';
		
		$inst = new JInstaller();	// do not use the component installer (getInstance); own installer object is needed	
		foreach ($plugins as $key => $value) {
			$package = JInstallerHelper::unpack($value);
			$inst_result = $inst->install($package['dir']);
			
			if(!$inst_result) {
				echo '<p>Plugin installation failed for ' . $key . '. Please install plugin manually!</p>';
			}
			else {
				if ('autotweetautomator' == $key) {
					// enable automator plugin (only)
					$db =& JFactory::getDBO();
					$query = 'UPDATE ' . $db->NameQuote('#__plugins') . ' SET ' . $db->NameQuote('published') . ' = 1'
						. ' WHERE ' . $db->NameQuote('element') . ' = ' . $db->Quote($key);
					$db->setQuery($query);
					$db->query();
				}
				
				echo '<p>Plugin ' . $key . ' has been successfully installed/updated.</p>';
			}

			JInstallerHelper::cleanupInstall($value, $package['dir']);
		}

		echo '<hr/>';
		echo '<p>' . JText::_('The AutoTweet product series posts the title and url for new Joomla articles, forum posts etc. automatically as status messages (tweets) to a twitter account (Twitter, Facebook, ...). This is the free version of the AutoTweet NG Component.') . '</p>';
		echo '<p>' . JText::_('AutoTweet NG Pro consists of a (main) component and several plugins. With the component you can manage the posted messages, including error und pending messages. The component provides also the basic services for the plugins. The AutoTweet NG Extension-Plugins handles the message posting for the different extensions like Kunena, K2 etc.') . '</p>';
		echo '<p>&nbsp;</p>';
		echo '<p><strong>' . JText::_('Do not forget to customize AutoTweet NG Component in the component parameters window. Also you should check the plugin options.') . '</strong></p>';
		echo '<p>&nbsp;</p>';
	}
	
	return $result;
}


//
// helper functions
//
function fm_checkPHP5()
{
	$result = true;
	
	if (version_compare('5', phpversion()) > 0) {
		$result = false;
	}
	
	return $result;
}

function fm_checkJoomla($version)
{
	$result = true;
	$obj = new JVersion();

	// -1, 0 ==> ok; 1 ==> version not compatible
	if (version_compare($version, $obj->getShortVersion()) > 0) {
		$result = false;
	}
	
	return $result;
}

function fm_checkCURL()
{
	return extension_loaded('curl');
} 	

	
?>
