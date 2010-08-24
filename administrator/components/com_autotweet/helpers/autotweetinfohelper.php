<?php
/**
 *  helper functions for 1stMover AutoTweet extensions.
 *
 * @version	1.3
 * @author	Ulli Storck
 * @license	GPL 2.0
 *
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'helpers' . DS . 'fmregistryhelper.php');

/**
 * Helper to get some infos about installed AutoTweet extensions.
 *
  */
class AutotweetInfoHelper
{
	const EXT_NOTINSTALLED	= 'not installed';
	const EXT_DISABLED		= 'disabled';
	const EXT_ENABLED		= 'enabled';

	const SERVER_INI_FILE	= 'autotweetng.ini';
	const SERVER_INI_PATH	= 'http://www.1st-movers.com/download/';
	
	const COMP_INSTALL_FILE	= 'autotweet.xml';
	const NAMESPACE			= 'autotweetini';
	const KEY_COMP			= 'component';
	
	private static $compinfo	= null;
	private static $pluginfo	= null;
	
	//
	// no public access (static class)
	//
	private function AutotweetInfoHelper()
	{
		// static class
	}
	
	public function getComponentInfo()
	{
		self::loadINI();
		return self::$compinfo;
	}
	
	public function getPluginInfo()
	{
		self::loadINI();
		return self::$pluginfo;
	}
	
	protected function loadINI()
	{
		if (!self::$compinfo || !self::$pluginfo) {
			// get component parameter
			$params =& JComponentHelper::getParams('com_autotweet');
			$version_check =  (int)$params->get('version_check', 1);
			
			if ($version_check) {
				$file = self::SERVER_INI_PATH . self::SERVER_INI_FILE;
			}
			else {
				$file = JURI::base() . 'components' . DS . 'com_autotweet' . DS . 'helpers' . DS . self::SERVER_INI_FILE;
			}
			
			$file_data = FmRegistryHelper::getFileContent($file);

			if (!$file_data){
				JError::raiseWarning('3', 'AutoTweet - error reading INI file ' . $file);
			}
			else {
				self::$pluginfo = array();
				
				$ns = self::NAMESPACE;
				$registry =& JFactory::getConfig();
				FmRegistryHelper::loadIniFile($registry, $file_data, $ns);
				$ini = $registry->toArray($ns);
			
				// get component info and remove from array
				$data = JApplicationHelper::parseXMLInstallFile(JPATH_COMPONENT_ADMINISTRATOR . DS . self::COMP_INSTALL_FILE);
				self::$compinfo = array(
					'id'					=> $ini[self::KEY_COMP]->id,
					'name'					=> $ini[self::KEY_COMP]->name,
					'server_freeversion'	=> $ini[self::KEY_COMP]->freeversion,
					'server_proversion'		=> $ini[self::KEY_COMP]->proversion,
					'client_version'		=> $data['version'],
					'home'					=> $ini[self::KEY_COMP]->home,
					'faq'					=> $ini[self::KEY_COMP]->faq,
					'download'				=> $ini[self::KEY_COMP]->download,
					'support'				=> $ini[self::KEY_COMP]->support,
					'products'				=> $ini[self::KEY_COMP]->products,
					'twitter'				=> $ini[self::KEY_COMP]->twitter,
					'freemessage'			=> $ini[self::KEY_COMP]->freemessage,
					'promessage'			=> $ini[self::KEY_COMP]->promessage,
					'news'			=> $ini[self::KEY_COMP]->news
				);
				unset($ini[self::KEY_COMP]);
				
				foreach ($ini as $extension) {
					$state			= self::EXT_NOTINSTALLED;
					$config			= '';
					$client_version	= '';
					$type			= $extension->type;
					$id				= $extension->id;
					
					if ('module' == $type) {
						$path = JPATH_ROOT . DS . 'administrator' . DS . 'modules' . DS . $id . DS . $id . '.xml';
					}
					else {
						$path = JPATH_ROOT . DS . 'plugins' . DS  . $type . DS . $id . '.xml';					
					}
					$data = JApplicationHelper::parseXMLInstallFile($path);
					
					if (!empty($data)) {
						$client_version = $data['version'];

						$db = &JFactory::getDBO();				
						
						if ('module' == $type) {
							$enabled = JModuleHelper::isEnabled($id);
							
							// get the module id and set url for config
							$query = 'SELECT * FROM ' . $db->NameQuote('#__modules')
								. ' WHERE ' . $db->NameQuote('module') . ' = ' . $db->Quote($id);
							$db->setQuery($query);
							$row = $db->loadObject();	
							$config = 'index.php?option=com_modules&client=1&task=edit&cid[]=' . $row->id;
						}
						else {
							$enabled = JPluginHelper::isEnabled($type, $id);
							
							// get the plugin id and set url for config
							$query = 'SELECT * FROM ' . $db->NameQuote('#__plugins')
								. ' WHERE ' . $db->NameQuote('element') . ' = ' . $db->Quote($id);

							$db->setQuery($query);
							$row = $db->loadObject();	
							
							$config = 'index.php?option=com_plugins&view=plugin&client=site&task=edit&cid[]=' . $row->id;
						}
							
						if ($enabled) {
							$state = self::EXT_ENABLED;
						}
						else {
							$state = self::EXT_DISABLED;				
						}
					}
				
					// append plugin state to result array
					self::$pluginfo[] = array (
						'id'				=> $id,
						'name'				=> $extension->name,
						'state'				=> $state,
						'client_version'	=> $client_version,
						'server_version'	=> $extension->version,
						'message'			=> $extension->message,
						'config'			=> $config
					);
				}
			}
		}
	}
}
	
?>
