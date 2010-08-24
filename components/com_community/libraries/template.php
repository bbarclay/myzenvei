<?php
/**
 * @package		JomSocial
 * @subpackage	Core 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */



(defined('_VALID_MOS') or defined('_JEXEC')) or die('Direct Access to this location is not allowed.');


/**
 * Templating system for JomSocial
 */ 
class CTemplate {
    var $vars; /// Holds all the template variables
    
    function renderModules($position, $attribs = array())
    {
    	jimport( 'joomla.application.module.helper' );
    	
		$modules 	= JModuleHelper::getModules( $position );
		$modulehtml = '';
		
		foreach($modules as $module)
		{
			$params 			= new JParameter( $module->params );
			$moduleClassSuffix 	= $params->get('moduleclass_sfx', '');
			
			$modulehtml .= '<div class="moduletable'.$moduleClassSuffix.'">';
			$modulehtml .= JModuleHelper::renderModule($module, $attribs);
			$modulehtml .= '</div>';
		}
		
		echo $modulehtml;
    }

    /**
     * Constructor
     *
     * @param $file string the file name you want to load
     */
    function CTemplate($file = null) {
        $this->file = $file;
        @ini_set('short_open_tag', 'On');
        $this->set('dummy', true);
    }
    
    
    /**
     * Get the template full path name, given a templaet name code
     */	     
    function _getTemplateFullpath($file)
    {
    	$cfg	=& CFactory::getConfig();
    	if(!JString::strpos($file, '.php'))
    	{
    		$filename	= $file;
    		
    		// Test if template override exists in joomla's template folder
    		$mainframe		=& JFactory::getApplication();
			
    		$overridePath	= JPATH_ROOT . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html';
    		$overrideExists	= JFolder::exists( $overridePath . DS . 'com_community' );
			$template		= COMMUNITY_COM_PATH . DS . 'templates' . DS . $cfg->get('template') . DS . $filename . '.php';
   
    		// Test override path first
    		if( JFile::exists( $overridePath . DS . 'com_community' . DS . $filename . '.php') )
    		{
    			// Load the override template.
				$file	= $overridePath . DS . 'com_community' . DS . $filename . '.php';
			}
    		else if( JFile::exists( $template ) && !$overrideExists )
    		{
	   			// If override fails try the template set in config
				$file	= $template;
    		}
    		else
    		{
    			// We assume to use the default template
    			$file	= COMMUNITY_COM_PATH . DS . 'templates' . DS . 'default' . DS . $filename . '.php';																    			    			
			}
    	}
    	
    	return $file;
	}

    /**
     * Set a template variable.
     */
    function set($name, $value) {
        $this->vars[$name] = $value; //is_object($value) ? $value->fetch() : $value;
    }
    
    /**
     * Set a template variable by reference
     */
    function setRef($name, &$value) {
        $this->vars[$name] =& $value; //is_object($value) ? $value->fetch() : $value;
    }

	function addStylesheet( $file )
	{
		$mainframe	=& JFactory::getApplication();  
		$cfg		=& CFactory::getConfig();
    	
		if(!JString::strpos($file, '.css'))
		{
    		$filename	= $file;
    		
			jimport( 'joomla.filesystem.file' );
			jimport( 'joomla.filesystem.folder' );
			
    		// Test if template override exists in joomla's template folder
    		$overridePath	= JPATH_ROOT . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html';
    		$overrideExists	= JFolder::exists( $overridePath . DS . 'com_community' );
			$template		= COMMUNITY_COM_PATH . DS . 'templates' . DS . $cfg->get('template') . DS . 'css' . DS . $filename . '.css';
			
    		// Test override path first
    		if( JFile::exists( $overridePath . DS . 'com_community' . DS . 'css' . DS . $filename . '.css') )
    		{
    			// Load the override template.
    			$file	= '/templates/' . $mainframe->getTemplate() . '/html/com_community/css/' . $filename . '.css';
			}
    		else if( JFile::exists( $template ) && !$overrideExists )
    		{
	   			// If override fails try the template set in config
				$file	=  '/components/com_community/templates/' . $cfg->get('template') . '/css/' . $filename . '.css';
    		}
    		else
    		{	
    			// We assume to use the default template
    			$file	= '/components/com_community/templates/default/css/' . $filename . '.css';
			}
    	}

    	CAssets::attach( $file , 'css' , rtrim( JURI::root() , '/' ) );
	}
	
	/***
	 * Allow a template to include other template and inherit all the variable
	 */	 	
	function load($file)
	{
		if($this->vars)
        	extract($this->vars, EXTR_REFS); 
        	
		$file = $this->_getTemplateFullpath($file);
		include($file);
		return $this;
	}
	
	
    /**
     * Open, parse, and return the template file.
     *
     * @param $file string the template file name
     */
    function fetch($file = null)
	{
		
		if( JRequest::getVar('format') == 'iphone' )
		{				
			$file	.= '.iphone';
		}   	    
		
		$file = $this->_getTemplateFullpath( $file );
    	
        if(!$file) $file = $this->file;
        
        if((JRequest::getVar('format') == 'iphone') && (!JFile::exists($file)))
        {
        	//if we detected the format was iphone and the template file was not there, return empty content.
        	return '';
        }

		// @rule: always add jomsocial config object in the template scope so we don't really need
		// to always set it.
		if( !isset( $this->vars['config'] ) && empty($this->vars['config']) )
		{
			$this->vars['config']	= CFactory::getConfig();
		}
		
		if($this->vars)
        	extract($this->vars, EXTR_REFS);          // Extract the vars to local namespace

        ob_start();                    // Start output buffering
        require($file);                // Include the file
        $contents = ob_get_contents(); // Get the contents of the buffer
        ob_end_clean();                // End buffering and discard
        return $contents;              // Return the contents
    }
    
    function object_to_array($obj) {
       $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
       $arr = array();
       foreach ($_arr as $key => $val) {
               $val = (is_array($val) || is_object($val)) ? $this->object_to_array($val) : $val;
               $arr[$key] = $val;
       }
       return $arr;
	}
}

// 
// class CCachedTemplate extends CTemplate {
//     var $cache_id;
//     var $expire;
//     var $cached;
//     var $file;
// 
//     /**
//      * Constructor.
//      *
//      * @param $cache_id string unique cache identifier
//      * @param $expire int number of seconds the cache will live
//      */
//     function CCachedTemplate($cache_id = "", $cache_timeout = 10000) {
//         $this->CTemplate();
//         $this->cache_id = AZ_CACHE_PATH . "/cache__". md5($cache_id);
//         $this->cached = false;
//         $this->expire = $cache_timeout;
//     }
// 
//     /**
//      * Test to see whether the currently loaded cache_id has a valid
//      * corrosponding cache file.
//      */
//     function is_cached() {
//     	//return false;
//         if($this->cached) return true;
// 
//         // Passed a cache_id?
//         if(!$this->cache_id) return false;
// 
//         // Cache file exists?
//         if(!file_exists($this->cache_id)) return false;
// 
//         // Can get the time of the file?
//         if(!($mtime = filemtime($this->cache_id))) return false;
// 
//         // Cache expired?
//         // Implemented as 'never-expires' cache, so, the data need to change
//         // for the cache to be modified
//         if(($mtime + $this->expire) < time()) {
//             @unlink($this->cache_id);
//             return false;
//         }
// 
//         else {
//             /**
//              * Cache the results of this is_cached() call.  Why?  So
//              * we don't have to double the overhead for each template.
//              * If we didn't cache, it would be hitting the file system
//              * twice as much (file_exists() & filemtime() [twice each]).
//              */
//             $this->cached = true; 
//             return true;
//         }
//     }
// 
//     /**
//      * This function returns a cached copy of a template (if it exists),
//      * otherwise, it parses it as normal and caches the content.
//      *
//      * @param $file string the template file
//      */
//     function fetch_cache($file, $processFunc = null) {
//     	// Get the configuration object.
// 		$config	=& CFactory::getConfig();
// 
//     	$contents	= "";
// 		$file = COMMUNITY_COM_PATH .DS. 'templates'.DS.$config->get('template').DS.$file . '.php';
// 		
//         if($this->is_cached()) {
//             $fp = @fopen($this->cache_id, 'r');
//             if($fp){
//             	$filesize = filesize($this->cache_id);
//             	if($filesize > 0){
//             		$contents = fread($fp, $filesize);
//             	}
//             	fclose($fp);
//             } else {
//             	$contents = $this->fetch($file);
// 			}
//         }
//         else {
//             $contents = $this->fetch($file);
//             
//             // Check if caller wants to process contents with another function
// 			if($processFunc)
//                 $contents = $processFunc($contents);
// 
// 			if(!empty($contents)){
// 			
// 	            // Write the cache, only if there is some data
// 	            if($fp = @fopen($this->cache_id, 'w')) {
// 	                fwrite($fp, $contents);
// 	                fclose($fp);
// 	            }
// 	            else {
// 	                //die('Unable to write cache.');
// 	            }
//             }
// 
//            
//         }
//         
//          return $contents;
//     }
// }

