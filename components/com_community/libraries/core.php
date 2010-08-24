<?php
/**
 * @category 	Library
 * @package		JomSocial
 * @subpackage	Core 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.plugin.plugin' );

include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'defines.community.php');
include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'error.php');
require_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'apps.php' );

class CFactory
{
	
	/**
	 * Function to allow caller to get a user object while
	 * it is not authenticated provided that it has a proper tokenid
	 **/	 
	function getUserFromTokenId( $tokenId , $userId )
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT COUNT(*) '
				. 'FROM ' . $db->nameQuote( '#__community_photos_tokens') . ' ' 
				. 'WHERE ' . $db->nameQuote( 'token') . '=' . $db->Quote( $tokenId ) . ' '
				. 'AND ' . $db->nameQuote( 'userid') . '=' . $db->Quote( $userId );

		$db->setQuery( $query );
		
		$count	= $db->loadResult();
		
		// We can assume that the user parsed in correct token and userid. So,
		// we return them the proper user object.

		if( $count >= 1 )
		{
			$user	= CFactory::getUser( $userId );
			
			return $user;			
		}

		// If it doesn't bypass our tokens, we assume they are really trying
		// to hack or got in here somehow.
		$user	= CFactory::getUser( null );
		
		return $user;
	}
	
	// Load multiple users at the same time
	function loadUsers($userIds){
		if(empty($userIds))
			return;
		
		$ids = implode(",", $userIds);
		$db		=& JFactory::getDBO();
		$query  = "SELECT  "
				. "	a.`userid` as _userid , "
				. "	a.`status` as _status , "
				. "	a.`points`	as _points, "
				. "	a.`posted_on` as _posted_on, " 	
				. "	a.`avatar`	as _avatar , "
				. "	a.`thumb`	as _thumb , "
				. "	a.`invite`	as _invite, "
				. "	a.`params`	as _cparams,  "
				. "	a.`view`	as _view, "
				. " a.`friendcount` as _friendcount, "
				. "s.`userid` as _isonline, u.* "
				. " FROM #__community_users as a "
				. " LEFT JOIN #__users u "
	 			. " ON u.`id`=a.`userid` "
				. " LEFT OUTER JOIN #__session s "
	 			. " ON s.`userid`=a.`userid` "
				. "WHERE a.`userid` IN ($ids)";
				
		$db->setQuery($query);
		$objs = $db->loadObjectList();
		
		foreach($objs as $obj){
		
			$user 			= new CUser($obj->_userid);
			$isNewUser		= $user->init($obj);
			$user->getThumbAvatar();
			
			// technically, we should not fetch any new user here
			if( $isNewUser )
			{
				// New user added to jomSocial database
				// trigger event onProfileInit
				$appsLib	= CAppPlugins::getInstance();
				$appsLib->loadApplications();
				
				$args 	= array();
				$args[] = $user;
				$appsLib->triggerEvent( 'onProfileCreate' , $args );
			}
			
			CFactory::getUser($obj->_userid, $user);
		}
	}
	
	/**
	 * Return CUser Object
	 */	 	
	function getUser($id=null, $obj = null)
	{
		static $instances = array();
		
		
		if($id != 0 && !is_null($obj)){
			$instances[$id] = $obj;
			//print_r($instances[$id]); exit;
			return;
		}
		
		if($id === 0)
		{
			$user =& JFactory::getUser(0);
			$id = $user->id;
		}
		else
		{
			if($id == null)
			{
				$user =& JFactory::getUser();
				$id = $user->id;
			}
			
			if($id != null && !is_numeric($id)) 
			{
				$db		=& JFactory::getDBO();
				$query ="SELECT id FROM #__users WHERE UCASE(`username`) like UCASE(".$db->Quote($id).")";
				$db->setQuery($query);
				$id = $db->loadResult();
			}
		}
			
		if( empty($instances[$id]) )
		{
			if( !is_numeric($id) && !is_null($id)) 
			{
				JError::raiseError( 500, JText::sprintf('CC CANNOT LOAD USER', $id) );
			}
			
			$instances[$id] = new CUser($id);
			$isNewUser		= $instances[$id]->init();
			$instances[$id]->getThumbAvatar();
			
			if( $isNewUser )
			{
				// New user added to jomSocial database
				// trigger event onProfileInit
				$appsLib	= CAppPlugins::getInstance();
				$appsLib->loadApplications();
				
				$args 	= array();
				$args[] = $instances[$id];
				$appsLib->triggerEvent( 'onProfileCreate' , $args );
			}
			
			// Guess need to have avatar as well.
			if($id == 0)
			{
				$lang =& JFactory::getLanguage();
				$lang->load('com_community');

				$instances[$id]->name = JText::_('CC ACTIVITIES GUEST');
				$instances[$id]->username = JText::_('CC ACTIVITIES GUEST');
				$instances[$id]->_avatar 	= 'components/com_community/assets/default.jpg';
				$instances[$id]->_thumb 	= 'components/com_community/assets/default_thumb.jpg';
			}
		}
		
		return $instances[$id];
	}
	
	
	/**
	 * Return JomSocial configuration object
	 * 	 
	 * @return	object		JParams object	 
	 */
	function getConfig()
	{
		return CConfig::getInstance();
	}
	
	
	/**
	 * Return the model object, responsible for all db manipulation. Singleton
	 * 	 
	 * @param	string		model name
	 * @param	string		any class prefix
	 * @return	object		model object	 
	 */	 	
	function getModel( $name = '', $prefix = '', $config = array() )
	{
		static $modelInstances = null;
		
		if(!isset($modelInstances)){
			$modelInstances = array();
			include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'error.php');
		}
		
		if(!isset($modelInstances[$name.$prefix]))
		{
			include_once( JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'models'.DS.'models.php');
			
			include_once( JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'models'.DS. strtolower( $name ) .'.php');
			$classname = $prefix.'CommunityModel'.$name;
			$modelInstances[$name.$prefix] = new $classname;
		}
		
		return $modelInstances[$name.$prefix];
	}

	// @getBookmarks deprecated.
	// since 1.5
	function getBookmarks( $uri )
	{
		static $bookmark = null;
		
		if( is_null($bookmark) )
		{
			CFactory::load( 'libraries' , 'bookmarks' );
			$bookmark	= new CBookmarks( $uri );
		}
		return $bookmark;
	}
	
	function getToolbar()
	{
		static $toolbar = null ;
		
		if( is_null( $toolbar ) )
		{
			CFactory::load( 'libraries' , 'toolbar' );
			
			$toolbar = new CToolbar();
			
		}
		return $toolbar;
	}
	/**
	 * Return the view object, responsible for all db manipulation. Singleton
	 * 	 
	 * @param	string		model name
	 * @param	string		any class prefix
	 * @return	object		model object	 
	 */	 	
	function getView( $name = '', $prefix = '',$viewType = '')
	{
		static $viewInstances = null;
		
		if(!isset($viewInstances)){
			$viewInstances = array();
			include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'error.php');
		}
		$viewType = JRequest::getVar('format', 'html', 'REQUEST');
 
		if(empty($viewType)){
			$viewType = JRequest::getVar('format', 'html', 'REQUEST');
		}
		
		if($viewType == 'json')
			$viewType	= 'html';
	
		if(!isset($viewInstances[$name.$prefix.$viewType]))
		{
			jimport( 'joomla.filesystem.file' );
			
			$viewFile	= JPATH_COMPONENT . DS . 'views' . DS . $name . DS . 'view.' . $viewType . '.php';
			if( JFile::exists($viewFile) )
			{
				include_once( $viewFile );
			}
			else
			{
				//@rule: when feed is not available, we include the main view file.
				if( $viewType == 'feed' )
				{
					include_once( JPATH_COMPONENT . DS . 'views' . DS . $name . DS . 'view.html.php' );
				}
			}
			
			if( $viewType == 'iphone' )
			{
				$classname = $prefix.'CommunityViewIphone' . ucfirst($name);
			}
			else
			{
				$classname = $prefix.'CommunityView'. ucfirst($name);
			}
			$viewInstances[$name.$prefix.$viewType] = new $classname;
		}
		
		return $viewInstances[$name.$prefix.$viewType];
	}
		
	/**
	 * return the currently viewed user profile object, 
	 * for now, just return an object with username, id, email
	 * @deprecated
	 */	 	
	function getActiveProfile(){

		$my = & JFactory::getUser();
		$uid = JRequest::getVar('userid', 0, 'REQUEST');
			
		if($uid == 0)
		{
			$uid = JRequest::getVar('activeProfile', null, 'COOKIE');
		}
		
		$obj = CFactory::getUser($uid);

		return $obj;
	}
	
	/**
	 * Return the current user requested via JRequest::getVar . 'userid' should
	 * be part of the request parameter	 
	 */	 	
	function getRequestUser()
	{
		$id = JRequest::getVar('userid', '');

		return CFactory::getUser($id);
	}
	
	/**
	 * Set current active profile
	 * @param	integer id	Current user id
	 */	 	
	function setActiveProfile($id = '')
	{	
		if( empty($id) )
		{
			$my = CFactory::getUser();
			$id = $my->id;
		}
		$jConfig	=& JFactory::getConfig();
		$lifetime	= $jConfig->getValue('lifetime');
			
		setcookie('activeProfile', $id, time() + ($lifetime * 60) , '/');
	}

	function unsetActiveProfile()
	{
		$jConfig	=& JFactory::getConfig();
		$lifetime	= $jConfig->getValue('lifetime');
		
		setcookie('activeProfile', false , time() + ($lifetime * 60 ), '/');
	}
		
	function setCurrentURI()
	{
		$uri 		=& JFactory::getURI();
		$current	= $uri->toString();

		setcookie( 'currentURI' , $current , time() + 60 * 60 * 24 , '/' );
	}
	
	function getLastURI()
	{
		$uri	= JRequest::getVar( 'currentURI' , null , 'COOKIE' );
		
		if( is_null( $uri ) )
		{
			$uri	= JURI::root();
		}
		return $uri;
	}
	
	/**
	 * Return the view object, responsible for all db manipulation. Singleton
	 * 	 
	 * @param	string		type	libraries/helper
	 * @param	string		name 	class prefix
	 */	 	
	function load( $type, $name )
	{
		include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'error.php');
		
		include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.$type.DS. strtolower($name) .'.php');
		
		// If it is a library, we call the object and call the 'load' method
		if( $type == 'libraries' )
		{
			$classname = 'C'.$name ;
			if(	class_exists($classname) ) {
				// @todo
			}
		}
	}
		
}

/**
 * Global Asset manager
 */
class CAssets 
{
	/**
	 * Centralized location to attach asset to any page. It avoids duplicate 
	 * attachement
	 */
	function attach( $path, $type , $assetPath = ''){
		
		$document =& JFactory::getDocument();
		if($document->getType() != 'html')
			return;
		
		// For compatibility with 3rd party templates like Morph, we need to know when we shouldn't load jquery
		if( !defined( 'C_ASSET_JQUERY' ) && !defined('MORPH_JQUERY') )
		{ 
			
			// JQuery has to be added manually since no conflict call must follow
			// immediately
			
			/* When using addCustomTag(), jquery gets appended after addScript().
			   Logically, jQuery should be loaded before other js files in the asset folder.
			   To use addScript, I appended the noConflict() line to the jquery.js file.  
			   (need this to get future versions of gallery.js working).
			*/
			
			$js  = JURI::root().'components/com_community/assets/jquery-1.3.2.pack.js';
			$document->addScript($js);
			define( 'C_ASSET_JQUERY', 1);
		}

		if( !empty($assetPath) )
		{
			$path = $assetPath . $path;
		}
		else
		{		
			$path = JURI::root(). 'components/com_community'.$path;
		}

		if( !defined( 'C_ASSET_' . md5($path) ) ) 
		{
			define( 'C_ASSET_' . md5($path), 1 );
			
			switch( $type )
			{
				case 'js':
					$document->addScript($path);
					break;
					
				case 'css':
					$document->addStyleSheet($path);
			}
		}
	}	 
}	

/**
 * Provide global access to JomSocial configuration and paramaters
 */ 
class CConfig extends JParameter
{
	var $_defaultParam;
	
	/**
	 * Return reference to global config object
	 * 	 
	 * @return	object		JParams object	 
	 */
	function &getInstance()
	{
		static $instance = null;
		if(!$instance)
		{
			jimport('joomla.filesystem.file');
			
			// First we need to load the default INI file so that new configuration,
			// will not cause any errors.
			$ini	= JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_community' . DS . 'default.ini';
			$data	= JFile::read($ini);
			
			$instance = new CConfig($data);
			JTable::addIncludePath( JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_community' . DS . 'tables' );
			$config	=& JTable::getInstance( 'configuration' , 'CommunityTable' );
			$config->load( 'config' );
			
			$instance->bind( $config->params );

			// call trigger to allow configuration override
			$appsLib	= CAppPlugins::getInstance();
			$appsLib->loadApplications();
			
			$args 	= array();
			$args[]	= $instance;
			$appsLib->triggerEvent( 'onAfterConfigCreate' , $args );
			
		}
		
		return $instance;
	}
	
	/**
	 * Get a value
	 *
	 * @access	public
	 * @param	string The name of the param
	 * @param	mixed The default value if not found
	 * @return	string
	 */
	function get($key, $default = '', $group = '_default')
	{
		$value = parent::get($key, $default, $group);
		return $value;
	}
	
	function getString($key, $default = '', $group = '_default')
	{
		$value = $this->get($key, $default, $group);
		return (string) $value;
	}
	
	function getBool($key, $default = '', $group = '_default')
	{
		$value = $this->get($key, $default, $group);
		return (bool) $value;
	}
	
	function getInt($key, $default = '', $group = '_default')
	{
		$value = $this->get($key, $default, $group);
		return (int) $value;
	}
}



class CApplications extends JPlugin
{
	//@todo: Do some stuff so the childs get inheritance?
	var $params	= '';

	function CApplications(& $subject, $config = null)
	{
		// Set the params for the current object
		parent::__construct($subject, $config);
		//$this->_getUserParams(  );
	}

	/**
	 * Function is Deprecated.
	 * -	 Should only be used in profile area.
	 **/	 	
	function loadUserParams()
	{
		$model	=& CFactory::getModel( 'apps' );
		
		$my		= CFactory::getUser();
		$userid	= JRequest::getVar('userid', $my->id);
		$user	= CFactory::getUser($userid);
		
		//$user	=& CFactory::getActiveProfile();
		$appName = $this->_name;

		$params	= $model->getUserAppParams( $model->getUserApplicationId( $appName , $user->id ) );

		$this->userparams	= new JParameter( $params );
	}
}

class CUser extends JUser {
	
	var $_userid	= 0;
	var $_status = '';
	var $_cparams		= null;
	var $_tooltip		= null;
	var $_points		= 0;
	var $_init			= false;
	var $_thumb			= '';
	var $_avatar		= '';
	var $_isonline		= false;
	var $_view			= 0;
	var $_posted_on		= null;
	var $_invite		= 0;
	var $_friendcount	= 0;
	
	/**
	 * Constructor.
	 * Perform a shallow copy of JUser object	 
	 */	 	
	function CUser($id){
		
		if($id == null) {
			$user =& JFactory::getUser($id);
			$id = $user->id;
		}
			
		$this->id = $id;	
	}
	
	/**
	 * Method to set the property when the properties are already
	 * assigned
	 * 
	 * @param property	The property value that needs to be changed
	 * @param value		The value that needs to be set
	 * 	 	 	 	 	 
	 **/	 	 	
	function set( $property , $value )
	{
		CError::assert( $property , '' , '!empty' , __FILE__ , __LINE__ );
		$this->$property	= $value;
	}
	
	function delete()
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'DELETE FROM ' . $db->nameQuote( '#__community_users' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'userid' ) . '=' . $db->Quote( $this->id );
		$db->setQuery( $query );
		$db->query();
		
		return parent::delete();
	}

	function getAppParams( $appName )
	{
		$model	=& CFactory::getModel( 'apps' );
		$params	= $model->getUserAppParams( $model->getUserApplicationId( $appName , $this->id ) );
		$params	= new JParameter( $params );
		
		return $params;
	}
	
	/**
	 * Inititalize the user JUser object
	 * return true if the user is a new 	 
	 */	 	
	function init($initObj = null) {
		$isNewUser = false;
		
		if(!$this->_init) {
			$db		=& JFactory::getDBO();
			$obj = $initObj;
			
			if($initObj == null ){
				$query  = "SELECT  "
						. "	a.`userid` as _userid , "
						. "	a.`status` as _status , "
						. "	a.`points`	as _points, "
						. "	a.`posted_on` as _posted_on, " 	
						. "	a.`avatar`	as _avatar , "
						. "	a.`thumb`	as _thumb , "
						. "	a.`invite`	as _invite, "
						. "	a.`params`	as _cparams,  "
						. "	a.`view`	as _view, "
						. " a.`friendcount` as _friendcount, "
						. "s.`userid` as _isonline, u.* "
						. " FROM #__community_users as a "
						. " LEFT JOIN #__users u "
			 			. " ON u.`id`=a.`userid` "
						. " LEFT OUTER JOIN #__session s "
			 			. " ON s.`userid`=a.`userid` "
			 			. " AND s.client_id !='1'"
						. "WHERE a.`userid`='{$this->id}'";
						
				$db->setQuery($query);
				$obj = $db->loadObject();
			} 

			// Initialise new user
			if(empty($obj))
			{
				if( !$obj && ($this->id != 0) )
				{
					// @rule: ensure that the id given is correct and exists in #__users
					$existQuery	= 'SELECT COUNT(1) FROM ' . $db->nameQuote( '#__users' ) . ' '
								. 'WHERE ' . $db->nameQuote( 'id' ) . '=' . $db->Quote( $this->id );
							
					$db->setQuery( $existQuery );

					$isValid	= $db->loadResult() > 0 ? true : false;
					
					if( $isValid )
					{
						// We need to create a new record for this specific user first.
						$config	=& CFactory::getConfig();
						
						$obj = new stdClass();
						
						// @todo: get all the values from $default values;
						$obj->userid	= $this->id;
						$obj->points	= $this->_points;
						$obj->thumb		= $this->_getMediumAvatar();
						$obj->avatar	= $this->_getLargeAvatar();
						
						// Load default params				
						$obj->params = "notifyEmailSystem=" . $config->get('privacyemail') . "\n"
									 . "privacyProfileView=" . $config->get('privacyprofile') . "\n"
									 . "privacyPhotoView=" . $config->get('privacyphotos') . "\n"
									 . "privacyFriendsView=" . $config->get('privacyfriends') . "\n"
									 . "privacyVideoView=1\n"
									 . "notifyEmailMessage=" . $config->get('privacyemailpm') . "\n"
									 . "notifyEmailApps=" . $config->get('privacyapps') . "\n"
									 . "notifyWallComment=" . $config->get('privacywallcomment') . "\n";
						
						$db->insertObject( '#__community_users' , $obj );
		
						if($db->getErrorNum())
						{
							JError::raiseError( 500, $db->stderr());
					    }
					    
					    // Reload the object
						$db->setQuery($query);
						$obj = $db->loadObject();
						
						$isNewUser = true;
						
					}
					
				}
			}


			if($obj) {
				$thisVars = get_object_vars($this);
				// load cparams
				$this->_cparams = new JParameter($obj->_cparams);
				unset($obj->_cparams);
				
				// load user params
				$this->_params = new JParameter($obj->params);
				unset($obj->params);
				
				foreach( $thisVars as $key=>$val ) {
					// @todo: if null, we should load default values
					
					if( isset($obj->$key) ) {
						$this->$key = $obj->$key ;
					} 				
				}
			} else {
				// this is a visitor, we still have to create params object for them
				$this->_cparams = new JParameter('');
				$this->_params  = new JParameter('');
			}
				
			$this->_init = true;
		}
		
		return $isNewUser;

	}
	
	/**
	 * Return current user status
	 * @return	string	user status	 
	 */	 	
	function getStatus($user = null)
	{
		jimport( 'joomla.filesystem.file' );
		
		if(JFile::Exists(JPATH_ROOT.DS.'plugins'.DS.'community'.DS.'wordfilter.php') && JPluginHelper::isEnabled('community', 'wordfilter'))
		{
			require_once( JPATH_ROOT.DS.'plugins'.DS.'community'.DS.'wordfilter.php' );
			if(class_exists('plgCommunityWordfilter'))
			{
				$dispatcher = & JDispatcher::getInstance();
				$plugin 	=& JPluginHelper::getPlugin('community', 'wordfilter');
				$instance 	= new plgCommunityWordfilter($dispatcher, (array)($plugin));
			}
			
			return $instance->_censor($this->_status);
		}
		
		return $this->_status;
	}
	
	function getViewCount(){
		return $this->_view;
	}
	
	/**
	 * Return the html formatted tooltip
	 */	 	
	function getTooltip()
	{
		if(!$this->_tooltip)
		{
			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'tooltip.php' );
			$this->_tooltip =  cAvatarTooltip($this);
		}
		return $this->_tooltip;
	}
	
	/**
	 *
	 */	 	
	function getKarmaPoint() {
		return $this->_points;
	} 
	
	/**
	 * Return the the name for display, either username of name based on backend config
	 */	 	
	function getDisplayName() {
		$config =& CFactory::getConfig();
		$nameField = $config->getString('displayname'); 
		return $this->$nameField;
	}

	/**
	 * Return the count of the friends
	 **/	 	
	function getFriendCount()
	{
		return $this->_friendcount;
	}
	
	/**
	 * @todo: wrap the get functions for both the image types since they are quite identical
	 **/
	function _getImage()
	{
	}
		 	
	/**
	 * Return path to avatar image
	 **/
	function getAvatar()
	{
		return JURI::root() . $this->_avatar;	
	}
	
	/**
	 * Return the custom profile data based on the given field code
	 *
	 * @param	string	$fieldCode	The field code that is given for the specific field.
	 */	 	
	function getInfo( $fieldCode )
	{
		// Run Query to return 1 value
		$db =& JFactory::getDBO();

		$query	= 'SELECT b.value FROM ' . $db->nameQuote( '#__community_fields' ) . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote( '#__community_fields_values' ) . ' AS b '
				. 'ON b.field_id=a.id '
				. 'AND b.user_id=' . $db->Quote( $this->id ) . ' '
				. 'WHERE a.fieldcode=' . $db->Quote( $fieldCode );
		
		$db->setQuery( $query );
		
		$value	= $db->loadResult();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
		return $value;
	}
	
		/**
	 * Return path to avatar image
	 **/
	function _getLargeAvatar()
	{
		//@compatibility: For older releases
		// can be removed at a later time.
		if( empty( $this->_avatar ) && ($this->id != 0) )
		{
			//@todo: when this code is removed, we should test if $this->_avatar is empty, then use
			// default guest image.
			
			// Copy old data.
			$model	=& CFactory::getModel( 'avatar' );

			// Save new data.
			$this->_avatar	= $model->getLargeImg( $this->id );

			// We only want the relative path , specific fix for http://dev.jomsocial.com
			$this->_avatar	= str_ireplace( JURI::base() , '' , $this->_avatar );
			
			// Test if this is default image as we dont want to save default image
			if( stristr( $this->_avatar , 'default.jpg' ) === FALSE )
			{
				$userModel	=& CFactory::getModel( 'user' );

				// Fix the .jpg_thumb for older release
				$userModel->setImage( $this->id , $this->_avatar , 'avatar' );
			}
			else
			{
				return $this->_avatar;
			}
		}
		
		return $this->_avatar;		
	}
		 
		 
	/**
	 * Return path to thumb image
	 */
	function getThumbAvatar()
	{
		return JURI::root() . $this->_thumb;
	}
	
	
	function _getMediumAvatar()
	{
		//@compatibility: For older releases
		// can be removed at a later time.
		if( empty( $this->_thumb ) && ($this->id != 0) )
		{
			//@todo: when this code is removed, we should test if $this->_avatar is empty, then use
			// default guest image.
			
			// Copy old data.
			$model	=& CFactory::getModel( 'avatar' );

			// Save new data.
			$this->_thumb	= $model->getSmallImg( $this->id );

			// We only want the relative path , specific fix for http://dev.jomsocial.com
			$this->_thumb	= str_ireplace( JURI::base() , '' , $this->_thumb );

			// Test if this is default image as we dont want to save default image
			if( stristr( $this->_thumb , 'default_thumb.jpg' ) === FALSE )
			{
				$userModel	=& CFactory::getModel( 'user' );

				// Fix the .jpg_thumb for older release
				$userModel->setImage( $this->id , $this->_thumb , 'thumb' );
			}

		}
		
		return $this->_thumb;
	}
	/**
	 * Return the combined params of JUser and CUser
	 * @return	JParameter	 
	 */	 	
	function &getParams()
	{
		return $this->_cparams;
	}
	
	function isOnline() {
		return ($this->_isonline != null);
	} 

	/**
	 * Check if the user is blocked
	 *
	 * @param	null
	 * return	boolean True user is blocked
	 */	 
	function isBlocked()
	{
		return ( $this->block == '1' );
	}	
	/**
	 * Increment view count. 
	 * Only increment the view count if the view is from a different session	 
	 */	 	
	function viewHit(){
		
		$session =& JFactory::getSession();
		if( $session->get('view-'. $this->id, false) == false ) {
			
			$db		=& JFactory::getDBO();
			$query = 'UPDATE `#__community_users`'
			. ' SET `view` = ( `view` + 1 )'
			. ' WHERE `userid`=' . $this->id;
			$db->setQuery( $query );
			$db->query();
			$this->_view++;
		}
		
		$session->set('view-'. $this->id, true);
	}
	
	/**
	 * Store the user data.
	 * @params	string group	If specified, jus save the params for the given
	 * 							group								 	 
	 */	 	
	function save( $group ='' )
	{
		parent::save();
		
		// Store our own data
		$obj = new stdClass();
		
		$obj->userid    = $this->id;
		$obj->status    = $this->_status;
		$obj->points    = $this->_points;
		$obj->posted_on = $this->_posted_on;
		$obj->avatar    = $this->_avatar;
		$obj->thumb     = $this->_thumb;
		$obj->invite    = $this->_invite;
		$obj->params	= $this->_cparams->toString();
		
		$model =& CFactory::getModel('user');
		return $model->updateUser($obj);
	}

	
	/**
	 * Sets the status for the current user
	 **/
	function setStatus( $status = '' )
	{
		if( $this->id != 0 )
		{
			$this->set( '_status' , $status );
			$this->save();
		}
	}
}

class CRoute 
{
	var $menuname = 'mainmenu';

	/**
	 * Method to wrap around getting the correct links within the email
	 * DEPRECATED since 1.5
	 */
	function emailLink( $url , $xhtml = false )
	{
		return CRoute::getExternalURL( $url , $xhtml );
	}

	/**
	 * Method to wrap around getting the correct links within the email
	 * 
	 * @return string $url
	 * @param string $url
	 * @param boolean $xhtml
	 */	
	function getExternalURL( $url , $xhtml = false )
	{
		$uri	=& JURI::getInstance();
		$base	= $uri->toString( array('scheme', 'host', 'port'));
		
		return $base . CRoute::_( $url , $xhtml );
	}
	
	function getURI( $xhtml = true )
	{
		$url		= '';
		
		// In the worst case scenario, QUERY_STRING is not defined at all.
		$url		.= 'index.php?';
		$segments	=& $_GET;
			
		$i			= 0;
		$total		= count( $segments );
		foreach( $segments as $key => $value )
		{
			++$i;
			$url	.= $key . '=' . $value;
			
			if( $i != $total )
			{
				$url	.= '&';
			}					
		}

		// @rule: clean url
		$url	= urldecode( $url );
		$url 	= str_replace('"', '&quot;',$url);
		$url 	= str_replace('<', '&lt;',$url);
		$url	= str_replace('>', '&gt;',$url);
		$url	= preg_replace('/eval\((.*)\)/', '', $url);
		$url 	= preg_replace('/[\\\"\\\'][\\s]*javascript:(.*)[\\\"\\\']/', '""', $url);
		$url	= preg_replace( '/&Itemid=[0-9]*/' , '' , $url );

		return CRoute::_( $url , $xhtml );
	}
	
	/**
	 * Wrapper to JRoute to handle itemid
	 * We need to try and capture the correct itemid for different view	 
	 */	 	
	function _($url, $xhtml = true, $ssl = null) 
	{
		
		static $itemid = array();

		parse_str($url);
		if(empty($view))
			$view = 'frontpage';
		
		if(empty($itemid[$view])) {
			global $Itemid;
			$isValid = false;
			
			// If the current Itemid match the expected Itemid based on view
			// we'll just use it 
			$db		=& JFactory::getDBO();
			$viewId =CRoute::_getViewItemid($view);
			if($viewId === $Itemid && !is_null($viewId)) {
				$itemid[$view] = $Itemid;
				$isValid = true;
			} else if($viewId !== 0 && !is_null($viewId)){
				$itemid[$view] = $viewId;
				$isValid = true;
			}
			
			
			if(!$isValid){
				$id = CRoute::_getDefaultItemid();
				if($id !== 0 && !is_null($id)) {
					$itemid[$view] =$id;
				}
				$isValid = true;
			}
			
			// Search the mainmenu for the 1st itemid of jomsocial we can find
			if(!$isValid){
				$query  = "SELECT `id` FROM #__menu WHERE "
					." `link` LIKE '%option=com_community%' "
					." AND `published`='1' "
					." AND `menutype`='{CRoute::menuname}' ";					
				$db->setQuery($query);
				$isValid = $db->loadResult();
				if(!empty($isValid))
					$itemid[$view] = $isValid;
			}			
			
			// If not in mainmenu, seach in any menu
			if(!$isValid){
				$query  = "SELECT `id` FROM #__menu WHERE "
					." `link` LIKE '%option=com_community%' "
					." AND `published`='1' ";					
				$db->setQuery($query);
				$isValid = $db->loadResult();	
				if(!empty($isValid))
					$itemid[$view] = $isValid;
			}
			
			
		}
		
		$pos = strpos($url, '#');
		if ($pos === false)
		{
			if( isset( $itemid[$view] ) )
				$url .= '&Itemid='.$itemid[$view];
		}
		else 
		{
			if( isset( $itemid[$view] ) )
				$url = str_ireplace('#', '&Itemid='.$itemid[$view].'#', $url);
		}		
		
		return JRoute::_($url, $xhtml, $ssl); 
	}
	
	/**
	 * Return the Itemid specific for the given view. 
	 */	 	
	function _getViewItemid($view) {
		static $itemid = array();
		
		if(empty($itemid[$view])){
			$db		=& JFactory::getDBO();
			
			$url = $db->quote('%option=com_community&view=' . $view . '%');
			
			$query  = 'SELECT id FROM #__menu WHERE `link` LIKE ' . $url . ' AND `published`=1';					
			$db->setQuery($query);
			$val = $db->loadResult();
			$itemid[$view] = $val;
		} else{
			$val = $itemid[$view];
		}
		return $val;
	}
	
	/**
	 * Retrieve the Itemid of JomSocial's menu. If you are creating a link to JomSocial, you
	 * will need to retrieve the Itemid.
	 **/	 	
	function getItemId()
	{
		return CRoute::_getDefaultItemid();
	}
	
	/**
	 * Return the Itemid for default view, frontpage
	 */	 	
	function _getDefaultItemid()
	{
		static $defaultId = null ;
		
		if($defaultId != null)
			return $defaultId;
			
		$db		=& JFactory::getDBO();
		
		$url = $db->quote("index.php?option=com_community&view=frontpage");
		
		$query  = "SELECT id FROM #__menu WHERE `link` = {$url} AND `published`=1";					
		$db->setQuery($query);
		$val = $db->loadResult();
		
		if(!$val)
		{
			$url = $db->quote("%option=com_community%");
			
			$query  = "SELECT id FROM #__menu WHERE `link` LIKE {$url} AND `published`=1";					
			$db->setQuery($query);
			$val = $db->loadResult();
		}
		
		$defaultId = $val;
		return $val;
	}
}
