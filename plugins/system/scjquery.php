<?php
/**
* @version		0.0.4
* @package		snellcode
* @copyright	Copyright (C) 2009 snellcode. All rights reserved.
* @license		GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

/**
* snellcode SC jQuery Plugin
*
* @package 		snellcode
* @subpackage	sc jquery
*/
class plgSystemSCjQuery extends JPlugin
{

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param	object		$subject The object to observe
	 * @param 	array  		$config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function plgSystemSCjQuery(&$subject, $config)  {
		parent::__construct($subject, $config);
	}

	/**
     * load jQuery library, and execute noConflict() method.
     */
	function onAfterRoute() {
		$app =& JFactory::getApplication();
		
		// has somebody already loaded jquery?  if so, skip all...
		if( $app->get('jquery') === true ) {
			return false;
		}
		
		// get parameters, or assign defaults
		$ui =  (int) $this->params->get( 'ui', 0 );
		$ui_theme =  $this->params->get( 'ui_theme', 'ui-lightness' );
		$code = trim( $this->params->get( 'code', '' ) );
		$enable_site = (int) $this->params->get( 'enable_site',  1 );
		$enable_admin = (int) $this->params->get( 'enable_admin', 0 );
		
		// set up enabled rules for frontend / backend
		if( $app->isAdmin() ) {
			// in admin view, so quit if not enabled.
			if( $enable_admin === 0 ) {
				return false;
			}
		} else {
			// in site view, so quit if not enabled.
			if( $enable_site === 0 ) {
				return false;
			}
		}
		
		// initialize environment variables
		$file_path = JPATH_ROOT . DS . 'plugins' . DS . 'system' . DS . 'scjquery' . DS;
		$url_path = JURI::root( true ) . '/plugins/system/scjquery/';
		
		if ( file_exists( $file_path . 'js' . DS . 'jquery-1.3.2.min.js' ) 
			&& file_exists( $file_path . 'js' . DS . 'jquery.no.conflict.js' ) ) {
			
			// add scripts as required
			$doc =& JFactory::getDocument();
			
			// jquery core, and no conflict directly after
			$doc->addScript( $url_path . 'js/jquery-1.3.2.min.js' );
			$doc->addScript( $url_path . 'js/jquery.no.conflict.js' );
				
			// if ui libraries should be loaded..
			if( $ui === 1 ) {
				if ( file_exists( $file_path . 'js' . DS . 'jquery-ui-1.7.2.custom.min.js' ) 
					&& file_exists( $file_path . 'css' .DS . 'ui-lightness' . DS . 'jquery-ui-1.7.2.custom.css' ) ) {
					
					$doc->addStylesheet( $url_path . 'css/' . $ui_theme . '/jquery-ui-1.7.2.custom.css' );
					$doc->addScript( $url_path . 'js/jquery-ui-1.7.2.custom.min.js' );
				}
			}
		
			// if some custom code was supplied, output it in a protected function
			if( $code ) {
				$doc->addScriptDeclaration("jQuery(function($){\n$code\n});");
			}
		
			// flag that jquery is loaded
			// other extensions can use this to check
			// eg. if( $app->get('jquery') ) ...
			$app->set( 'jquery', true );
		}
	}
	
}
