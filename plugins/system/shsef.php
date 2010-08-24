<?php
/**
 * @version		$Id: shsef.php 1114 2010-01-10 13:32:27Z silianacom-svn $
 * @package		sh404SEF
 * @copyright	Copyright (C) 2010 Yannick Gaultier. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.router'); // import base class
/**
 * sh404SEF system plugin
 *
 * @author
 */
class  plgSystemShsef extends JPlugin
{

  /**
   * Constructor
   *
   * For php4 compatability we must not use the __constructor as a constructor for plugins
   * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
   * This causes problems with cross-referencing necessary for the observer design pattern.
   *
   * @access	protected
   * @param	object	$subject The object to observe
   * @param 	array   $config  An array that holds the plugin configuration
   * @since	1.5
   */
  function plgSystemShsef(& $subject, $config) {
    parent::__construct($subject, $config);
  }

  function onAfterInitialise() {
    global $mainframe;

    if ($mainframe->isAdmin()) {
      return;
    }

    require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_sh404sef'.DS.'sh404sef.class.php');

    // for now we declare sefConfig as global, as this would break
    //too many 3rd party plugins if otherwise
    // TODO : update doc so that new plugins use new method to get config
    global $sefConfig;
    $sefConfig = & shRouter::shGetConfig();

    if (!$sefConfig->Enabled)  // go away if not enabled
    return;
     
    DEFINE ('SH404SEF_IS_RUNNING', 1);


    // setup our JPagination replacement, so as to bring
    // back # of items per page in the url, in order
    // to properly calculate pagination
    // will only work if php > 5, so test for that
    if((version_compare( phpversion(), '5.0' ) >= 0)) {
      // this register the old file, but do not load it if PHP5
      // will prevent further calls to the same jimport()
      // to actually do anything, because the 'joomla.html.pagination' key
      // is now registered statically in Jloader::import()
      jimport( 'joomla.html.pagination');
      // now we can register our own path
      JLoader::register( 'JPagination', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_sh404sef'.DS.'pagination.php');
    }

    // include more sh404SEF stuff
    require_once(JPATH_ROOT.DS.'components'.DS.'com_sh404sef'.DS.'shCache.php');
    require_once(JPATH_ROOT.DS.'components'.DS.'com_sh404sef'.DS.'shSec.php');

    // override router class with our :
    $previousRouter = & $mainframe->getRouter();

    // create an instance of our class
    $shRouter = new shRouter();

    // store the previous router
    $shRouter->jRouter = clone( $previousRouter);

    // make sure the cloned Joomla router is activated
    $shRouter->jRouter->setMode(JROUTER_MODE_SEF);

    // then override
    $previousRouter = $shRouter;

    // load plugins, as per configuration
    $this->_loadPlugins( $type = 'sh404sefcore');

    // start decoding URL + decide possible redirects
    include(JPATH_ROOT.DS.'components'.DS.'com_sh404sef'.DS.'shInit.php');
  }

  /**
   * Various operations :
   *  - performs table less output
   *  - load our plugins
   * @return unknown_type
   */
  function onAfterRoute() {
    
    global $mainframe;
    
    // hack to switch to table less output regardless of the template used
    if (!$mainframe->isAdmin()) {
      $this->setTemplate( 'beez');
    }
    
  }

  function onAfterDispatch() {
    global $mainframe;
    if (!$mainframe->isAdmin()) {
      $this->setTemplate();
      // fix base tag when using Joomfish
      if (defined( 'SH404SEF_IS_RUNNING')) {
        $document = &JFactory::getDocument();
        if (shIsMultilingual() == 'joomfish' && $document->getType() == 'html') {
          $shPageInfo = & shRouter::shPageInfo();
          $document->setBase( $shPageInfo->baseUrl);
        }
      }
    }
  }

  function setTemplate( $tpl = null) {
    static $_template;

    $sefConfig = shRouter::shGetConfig();
     
    if (!$sefConfig->shEnableTableLessOutput) { // global on/off switch
      return;
    }
     
    global $mainframe;
    if (empty($tpl)) {
      if (empty($_template)) return;
      $mainframe->setTemplate($_template);  // restore old template
    } else {
      $_template = $mainframe->getTemplate(); // save current template
      $mainframe->setTemplate( 'beez');
    }
  }

  /* page rewriting features - previously in shCustomTags module */
  function onAfterRender() {
    global $mainframe;

    if ($mainframe->isAdmin()) {
      return;
    }

    $sefConfig = shRouter::shGetConfig();
    if (!$sefConfig->Enabled || !$sefConfig->shMetaManagementActivated) {  // go away if not enabled
      return;
    }
     
    require_once(JPATH_ROOT.DS.'components'.DS.'com_sh404sef'.DS.'shPageRewrite.php');

  }

  /**
   * Load and register the plugins currently activated by webmaster
   *
   * @return none
   */
  function _loadPlugins( $type)  {

    // required joomla library
    jimport( 'joomla.plugin.helper.php');

    // import the plugin files
    $status = JPluginHelper::importPlugin( $type);

    return $status;

  }

}

/**
 * Class to create and parse routes for the site application
 *
 * @author		Johan Janssens <johan.janssens@joomla.org>
 * @package 	Joomla
 * @since		1.5
 */
class shRouter extends JRouter
{
  var $shId = 'sh404SEF for Joomla 1.5';
  var $jRouter = null;

  /**
   * Class constructor
   *
   * @access public
   */
  function __construct($options = array()) {
    parent::__construct($options);
    $this->setMode(JROUTER_MODE_SEF);  // force SEF mode
    shIncludeLanguageFile();
  }

  function &shGetMenu() {  // cache our own copy of menu system
    static $shMenu = null;

    if (empty($shMenu)) {  // JMenu may not be loaded yet
      if (!class_exists('JMenuSite'))
      require_once(JPATH_ROOT.DS.'includes'.DS.'menu.php');
      $shMenu = new JMenuSite();
    }
    return $shMenu;
  }

  function &shGetConfig() {
    static $shConfig = null;

    if (empty($shConfig)) {  // config not read yet
      $shConfig = new SEFConfig();
    }
    return $shConfig;
  }

  function &shPageInfo( $pageInfo = null) {
    static $shPageInfo = null;

    if (!empty($pageInfo)) {
      $shPageInfo = $pageInfo;
    }
    return $shPageInfo;
  }

  function parse(&$uri)
  {
    $vars = parent::parse($uri);
    return $vars;
  }

  function &build($url)
  {
    $uri =& parent::build($url);
    return $uri;
  }

  function _parseRawRoute(&$uri)
  {
    $vars   = array();

    $menu =& shRouter::shGetMenu();

    //Handle an empty URL (special case)
    if(!$uri->getVar('Itemid') && !$uri->getVar('option'))
    {
      $item = $menu->getDefault();

      //Set the information in the request
      $vars = $item->query;

      //Get the itemid
      $vars['Itemid'] = $item->id;

      // Set the active menu item
      $menu->setActive($vars['Itemid']);

      return $vars;
    }

    //Get the variables from the uri
    $this->setVars($uri->getQuery(true));

    //Get the itemid, if it hasn't been set force it to null
    $this->setVar('Itemid', JRequest::getInt('Itemid', null));

    //Only an Itemid ? Get the full information from the itemid
    if(count($this->getVars()) == 1)
    {
      $item = $menu->getItem($this->getVar('Itemid'));
      $vars = $vars + $item->query;
    }

    // Set the active menu item
    $menu->setActive($this->getVar('Itemid'));

    return $vars;
  }

  function _parseSefRoute(&$uri)
  {
    $vars   = array();
    _log( '_parseSefRoute, parsing _uri ' . $uri->_uri);
    _log( '_parseSefRoute, parsing _host ' . $uri->_host);
    _log( '_parseSefRoute, parsing _path ' . $uri->_path);
    include(JPATH_ROOT.DS.'components'.DS.'com_sh404sef'.DS.'sh404sef.inc.php');

    if ( shIsMultilingual() == 'joomfish') {
      $currentLangShortCode = $GLOBALS['shMosConfig_shortcode'];
      $conf =& JFactory::getConfig();
      $configDefaultLanguage = $conf->getValue('config.language');
      $tmp = explode( '-', str_replace( '_', '-', $configDefaultLanguage));
      $defaultLangShortCode = $tmp[0];
    } else {
      $currentLang = '';
    }

    $shMenu = null;

    // set active menu if changed
    if (!empty($vars['Itemid'])) {
      $newItemid = intval($vars['Itemid']);
      if (!empty($newItemid)) {
        $shMenu = & JSite::getMenu();
        $shMenu->setActive($newItemid);
      }
    }

    //Set the variables
    $this->setVars($vars);

    // set language again, as Joomfish may have set it according to user cookie
    if ( shIsMultilingual() == 'joomfish' && !empty($vars['lang']) && $vars['lang'] != $currentLangShortCode) {
      JRequest::setVar('lang', $vars['lang'] );
       
      // we also need to fix the main menu, as joomfish has set it to the wrong language
      if (empty( $shMenu)) {
        $shMenu = & JSite::getMenu();
      }
      $sefLang = TableJFLanguage::createByShortcode($vars['lang'], false);
      JLoader::import('helper', JPATH_ROOT.DS.'modules'.DS.'mod_jflanguageselection', 'jfmodule');
      $shMenu->_items = JFModuleHTML::getJFMenu($sefLang->code,false, $shMenu->_items);

      // and finally we can set new joomfish language
      shSetJfLanguage( $vars['lang']);
    }

    // last fix is to remove the home flag if other than default language
    if (shIsMultilingual() == 'joomfish' && !empty($vars['lang']) && $vars['lang'] != $defaultLangShortCode) {
      if (empty( $shMenu)) {
        $shMenu = & JSite::getMenu();
      }
      $defaultItem = &$shMenu->getDefault();
      $defaultItem->home = 0;
    }

    // and finally we can set new joomfish language
    if ( shIsMultilingual() == 'joomfish' && !empty($vars['lang']) && $vars['lang'] != $currentLangShortCode) {
      shSetJfLanguage( $vars['lang']);
    }
    return $vars;
  }

  function _buildRawRoute(&$uri)
  {
    if($uri->getVar('Itemid') && count($uri->getQuery(true)) == 2)
    {
      //$menu =& JSite::getMenu();
      $menu = & shRouter::shGetMenu();

      // Get the active menu item
      $itemid = $uri->getVar('Itemid');
      $item   = $menu->getItem($itemid);

      $uri->setQuery($item->query);
      $uri->setVar('Itemid', $itemid);
    }
  }

  function _buildSefRoute(&$uri)
  {
    $sefConfig = &shRouter::shGetConfig();
    $shPageInfo = &shRouter::shPageInfo();
    $menu = &shRouter::shGetMenu();
    // keep a copy of  Joomla original URI, which has article names in it (ie: 43:article-title)
    $originalUri = clone( $uri);
    shNormalizeNonSefUri( $uri, $menu);
    shNormalizeNonSefUri( $originalUri, $menu, $removeSlugs = false);
    // do our job!
    $query = $uri->getQuery(false);
    $route = shSefRelToAbs( 'index.php?'.$query, null, $uri, $originalUri);
    $route = ltrim(str_replace( $GLOBALS['shConfigLiveSite'], '',$route), '/');
    $route = $shPageInfo->base.($route == '/' ? '' : $route);
    //Set query again in the URI
    //$uri->setQuery($query); // nope : this is done inside shSefRelToAbs, would be simpler to return $query though
    $uri->setPath($route);
  }

  function _processParseRules(&$uri)
  {
    $vars = parent::_processParseRules($uri);

    return $vars;
  }

  function _processBuildRules(&$uri)
  {
    parent::_processBuildRules($uri);

    // Get the path data
    $route = $uri->getPath();

    $uri->setPath($route);
  }

  function &_createURI($url)
  {
    // prevent double Itemid param
    $itemid = shGetURLVar($url, 'Itemid');
    $i = intval($itemid);
    if (!empty($itemid) && (string)($i) != $itemid) {
      $tmp = '?Itemid='.$i;
      $url = str_replace($tmp.$tmp, $tmp, $url);
    }

    //Create the URI
    $uri =& parent::_createURI($url);

    // Get the itemid form the URI
    $itemid = $uri->getVar('Itemid');

    if(is_null($itemid))
    {
      if($option = $uri->getVar('option'))
      {
        $menu = & shRouter::shGetMenu();
        $item  = $menu->getItem($itemid);
        if(isset($item) && $item->component == $option) {
          $uri->setVar('Itemid', $item->id);
        }
      }
      else
      {
        if($option = $this->getVar('option')) {
          $uri->setVar('option', $option);
        }

        if($itemid = $this->getVar('Itemid')) {
          $uri->setVar('Itemid', $itemid);
        }
      }
    }
    else
    {
      if(!$uri->getVar('option'))
      {
        $menu = & shRouter::shGetMenu();
        $item  = $menu->getItem($itemid);
        $uri->setVar('option', $item->component);
      }
    }

    return $uri;
  }

}
