<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CAppPlugins extends JObject {
	var $name;
	var $triggerCount = 0;
	
	function __construct($name){
		$this->name = $name;
		parent::__construct($name);
	}
	
	private function CAppPlugins($name){
		$this->__construct($name);
	}
	
	function &getInstance(){
		static $instance;
		if(!$instance){
			$instance = new CAppPlugins('CAppPlugins');
		}
		return $instance;
	}
	
	/**
	 * Used to include specific applications that are enabled on specific users.
	 * So that the page will be optimized because files will not be included.	 
	 **/	 	
	function loadApplications()
	{
		static $loaded = false;
		// Although JPluginHelper will load it only once, we need to track it to
		// enable a trigger to our plugins
		if( !$loaded ){
			JPluginHelper::importPlugin('community');
			$this->triggerEvent('onAfterAppsLoad', null);
		} 
		return true;
	}
	
	
	function _getPlgFromDispatcher($appName){
		$dispatcher = & JDispatcher::getInstance();
		
		foreach( $dispatcher->_observers as $key => $val) {
			$obj =& $dispatcher->_observers[$key];
			if( is_object($obj) ) {
				if((JString::strtolower($obj->_name) == JString::strtolower($appName)) 
					&& $obj->_type == 'community' ) {
					
					return $obj;
				}
			}
		}
		
		return null;
	}
	
	
	/**
	 * Used to trigger profile display event
	 * @param	string	eventName (will always be 'onProfileDisplay')
	 * @param	array	params to pass to the function
	 * 
	 * returns	array of content string 	 	 	 	 
	 **/
	function _triggerOnProfileDisplay($event='onProfileDisplay', $arrayParams = null )
	{
		$mainframe  =& JFactory::getApplication();
		$dispatcher = & JDispatcher::getInstance();
		$content = '';
		// @todo: Fix ordering so we only load according to user ordering or site wide plugin ordering.
		// as we cannot use the mainframe to trigger because all the data are already outputed, no way to manipulate it.
		if($event == 'onProfileDisplay')
		{
			$appsModel =& CFactory::getModel('apps');
			
			// Get the current viewed user
			$userid			= JRequest::getVar( 'userid' , '' );
			$user			= CFactory::getUser($userid);
			$applications	= $appsModel->getUserApps( $user->id );
			
			// Just in case the apps are returning data to the view, we need to return them
			$content		= array();
			
			// Load Core applications		
			for( $i = 0; $i < count($dispatcher->_observers); $i++ )
			{
				$plgObj = $dispatcher->_observers[$i];
				if( is_object($plgObj) )
				{
					if( $plgObj->_type == 'community'
					    && ($plgObj->params != null) 
						&& ($plgObj->params->get('coreapp', 0) == 1) 
						&& method_exists($plgObj, 'onProfileDisplay' ))
					{
						// Format the applications with proper heading
						$obj			= new stdclass();
						$obj->title		= JText::_( $appsModel->getAppTitle( $plgObj->_name ) );
						$obj->name		= $plgObj->_name;
						$obj->data		= $plgObj->onProfileDisplay( $arrayParams );
						$obj->core		= true;
 		
// 						if ( JFile::exists( JPATH_ROOT . DS . 'plugins' . DS . 'community' . DS . $application->name . DS . 'avatar.png' ) )  {
// 							$obj->avatar 	= '<img src="'.rtrim(JURI::root(),'/').'/plugins/community/'.$application->name.'/avatar.png" alt="'.$obj->title.'" />';
// 						}
// 						else {
// 							$obj->avatar 	= '<img src="'.rtrim(JURI::root(),'/').'/components/com_community/assets/app_avatar.png" alt="'.$application->title.'" />';
// 						}
						// Add the obj data to the array so the caller should know what to do with it.
						$content[]	= $obj;
					}
				}
			}				
			
			// Load user application
			$appCount = count($applications);
			for( $i = 0; $i < $appCount; $i++)
			{
				$application =& $applications[$i]; 
				$plgObj 	 = $this->_getPlgFromDispatcher($application->apps);
				//print_r($application);
				// Don't load core apps
				if( $plgObj != null && $plgObj->params->get('coreapp' , 0) != 1 )
				{
					// Don't load core applications
					if( method_exists($plgObj, 'onProfileDisplay' ) )
					{
						// Format the applications with proper heading
						
						$obj		= new stdclass();
						$obj->title	= JText::_( $appsModel->getAppTitle( $plgObj->_name ) );
						$obj->name	= $application->apps;
						$obj->data	= $plgObj->onProfileDisplay( $arrayParams );
						$obj->core	= false;
						// Add the obj data to the array so the caller should know what to do with it.
						$content[]	= $obj;
					}
				}
			}

			
		}
		
		return $content;
	}
	
	/**
	 * Used to trigger applications
	 * @param	string	eventName
	 * @param	array	params to pass to the function
	 * @param	bool	do we need to use custom user ordering ?
	 * 
	 * returns	Array	An array of object that the caller can then manipulate later.	 	 	 	 
	 **/	 	
	function triggerEvent( $event , $arrayParams = null , $needOrdering = false )
	{
		$mainframe  =& JFactory::getApplication();
		$dispatcher =& JDispatcher::getInstance();
		$content = array();
		
		// @todo: Fix ordering so we only load according to user ordering or site wide plugin ordering.
		// as we cannot use the mainframe to trigger because all the data are already outputed, no way to manipulate it.
		if($event == 'onProfileDisplay')
		{
			$content = $this->_triggerOnProfileDisplay($event , $arrayParams);			
		} else {
		
			//$dispatcher->trigger( $event , $arrayParams );
			for( $i = 0; $i < count($dispatcher->_observers); $i++ )
			{
				$plgObj = $dispatcher->_observers[$i];
				if( is_object($plgObj) )
				{
					if( $plgObj->_type == 'community' && method_exists($plgObj, $event ))
					{
						// Format the applications with proper heading
						$content[] = call_user_func_array(array(&$plgObj, $event), $arrayParams);
					}
				}
			}
			
		}
		
		$this->triggerCount++;
		return $content;
	}
	
	/**
	 * Method to include the ajax function names
	 **/
	function loadAjaxPlugins()
	{
		//@todo: need to fetch plugins from database.

		$ajaxCall	= JRequest::getVar('func');
		
		$func		= explode(',', $ajaxCall);
		
		// We expect the second argument is the plugin name so we use it as the plugin name.
		$func		= JString::trim($func[1]);

		$jaxFile	= JPATH_PLUGINS . DS . 'community' . DS . $func . DS . 'jax.' . $func . '.php';
		
		// Ajax file definitions should all be in JOOMLA/plugins/community/APPLICATION/jax.APPLICATION.php
		if( file_exists( $jaxFile ) )
		{
			require_once( $jaxFile );
		}
		else
		{
			// @todo: log any plugin not exists for debugging purposes?
		}
		
	}
	/**
	 * Calls the plugins AJAX methods
	 * 
	 * @param none
	 **/	 	 	 	
	function ajax()
	{
		
	}
	
	/**
	 * Return the plugin object
	 * @param	string	app name
	 * @param	int		unique app id, unique per user	 	 
	 */
	function &get($pluginsName= '', $id=0, $params=array())
	{
		static $pluginInstances;
		
		if(!$pluginInstances)
		{
			$pluginInstances = array();
		}
		
		if(empty($pluginsName))
		{
			$appModel =& CFactory::getModel('apps');
			$pluginsName = $appModel->getAppName($id); 
		}
		
		if(!isset($pluginInstances[$pluginsName.$id]))
		{
			// Load applications since this is an ajax request, we need to load them.
			$this->loadApplications();
			
			// Try to get the plugin from the dispatcher
			$plg		= $this->_getPlgFromDispatcher($pluginsName);

			$pluginInstances[ $pluginsName . $id ]	= $plg;
		}
		return $pluginInstances[$pluginsName.$id];
	}
	
	/**
	 *
	 */
	function showAbout($appName)
	{
		$app	=& CFactory::getModel('apps');
		$appObj = $app->getAppInfo($appName);
		
		$tmpl	= new CTemplate();
		
		$tmpl->set( 'app' , $appObj );
		return $tmpl->fetch( 'apps.about' );
	}
	
	/**
	 *
	 */
	function removeApp($userid, $appName){
		$app =& CFactory::getModel('apps');
		$html = $app->deleteApp($userid, $appName);
		return;
	}
	
	/*
	 * Retrieves HTML output for privacy settings 
	 */
	function showPrivacy($appName)
	{
		$app	=& CFactory::getModel('apps');
		$my		=& JFactory::getUser();

		$selected	= $app->getPrivacy( $my->id , $appName );

		$showCheck0 = ( $selected == 0 ) ? ' checked="checked"' : '' ;
		$showCheck1 = ( $selected == 10 ) ? ' checked="checked"' : '' ;
		$showCheck2 = ( $selected == 20 ) ? ' checked="checked"' : '' ;

		$tmpl		= new CTemplate();
		
		$tmpl->set( 'showCheck0' , $showCheck0 );
		$tmpl->set( 'showCheck1' , $showCheck1 );
		$tmpl->set( 'showCheck2' , $showCheck2 );
		$tmpl->set( 'appName'	, $appName );
		
		return $tmpl->fetch( 'apps.privacy' );
	}
	
	/**
	 * Get config html from the xml file
	 */	
	function showConfig($pluginsName, $params=array()){
	}
	
	
	/**
	 * Load and return the $param object for the given plugin
	 */
	function loadConfig($pluginsName, $params=array()){
	}
	
	/**
	 * Return true if the apps is already installed by the  given user
	 */	 	
	function isInstalled($userid, $appname){
		$app =& CFactory::getModel('apps');
		
	}
}
