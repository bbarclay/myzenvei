<?php
/**
 * @version     $Id$ 1.0.9 0
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 *
 * 1.0.1 - fixed the problem with the redirect link
 * 1.0.2 - fixed the problem with the language
 * 1.0.3 - fixed the problem with the calendar image from a date field
 * 1.0.4 - replaced JHTMLBehavior::calendar(); with JHTML::_('behavior.calendar');
 * 1.0.5 - calendar setup has to be done based on profile id
 * 1.0.6 - moved CSS to media folder
 * 1.0.7 - added the loading of mootools
 * 1.0.8 - replaced domready with load
 * 1.0.9 - added plugin parameters into the session
 *
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.plugin.plugin' );

class plgContentAiContactSafeForm extends JPlugin {
	function plgContentAiContactSafeForm( &$subject, $params ) {
		parent::__construct( $subject, $params );
	}

	function onPrepareContent( &$article, &$params, $limitstart ) {
		// get all the mentioning of {aicontactsafeform in the article
		$forms = explode('{aicontactsafeform',$article->text);
		// count the forms
		$no_forms = count($forms);
		// if the code that is activating the plugin appears at least once start the form generation
		if ($no_forms>1) {
			// load the mootools javascript library
			JHTML::_('behavior.mootools');
			// load the calendar javascript and style
			JHTML::_('behavior.calendar');

			$document =& JFactory::getDocument();
			for($i=1;$i<$no_forms;$i++) {
				// get the parameters for the form
				$current_form = explode('}',$forms[$i]);
				$current_form = $current_form[0];
				// generate the text to replace
				$initial_text = '{aicontactsafeform'.$current_form.'}';

				$current_form_parameters = explode('|',$current_form);
				// put the parameters in an array so they can be easily accessed
				$parameters = array();
				foreach($current_form_parameters as $parameter) {
					$start_value = strpos($parameter,'=');
					if ( $start_value !== false) {
						$parameters[trim(substr($parameter,0,$start_value))] = trim(substr($parameter,$start_value+1));
					}
				}

				// if the selected profile is valid
				if ( $this->checkProfile($parameters['pf']) ) {
					// if the css code is activated load the profile css
					if ($parameters['use_css']) {
						// generate the css file name based on the profile
						$css_file = 'profile_css_'.$parameters['pf'].'.css';
					
						$nameCssGeneral = JURI::root().'components/com_aicontactsafe/includes/css/aicontactsafe_general.css';
						$document->addStyleSheet($nameCssGeneral);
					
						// import joomla clases to manage file system
						jimport('joomla.filesystem.file');
						// determine if to use the css from the template or from the component
						$app = & JFactory::getApplication();
						$template_name = $app->getTemplate();
						$tPath = JPATH_ROOT.DS.'templates'.DS.$template_name.DS.'html'.DS.'com_aicontactsafe'.DS.$css_file;
					
						// if the css is not defined in the template use the one from the component
						if (JFile::exists($tPath)) {
							$nameCssFile = JURI::root().'templates/'.$template_name.'/html/com_aicontactsafe/'.$css_file;
						} else {
							$nameCssFile = JURI::root().'media/aicontactsafe/cssprofiles/'.$css_file;
						}
						$document->addStyleSheet($nameCssFile);
					}

					$r_id = mt_rand();
					$postData = array();
					$postData['dt'] = 1;
					JRequest::setVar('dt', 1, 'post');
					$postData['r_id'] = $r_id;
					// add all parameters to send them to the contact form ( except the text used as link )
					foreach($parameters as $key=>$value) {
						$postData[$key] = $value;
					}
					if (!array_key_exists('current_url', $parameters)) {
						// get the current url
						$uri =& JURI::getInstance();
						$currentUrl = $uri->toString( array('scheme', 'host', 'port', 'path', 'query', 'fragment'));
						// set the return link to the current url in case other is not defined
						$postData['current_url'] = $currentUrl;
					}
					if (!array_key_exists('return_to', $parameters)) {
						// set the return link to the current url or the one set into the profile
						$postData['return_to'] = $this->getProfileReturnTo($parameters['pf']);
					}
					$postData[JUtility::getToken()] = 1;
					$session =& JFactory::getSession();
					$session->set( 'postData:message_' . $r_id, $postData );
					$session->set( 'parameters:message_' . $r_id, $postData );
					$session->set( 'isOK:message', false );
	
					// load the javascript functions
					require_once( JPATH_ROOT.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'js'.DS.'aicontactsafe.js.php' );
					
					// generate the url for ajax
					$lang = JRequest::getCmd('lang', 'en');
					$urlAiContactSafe = JURI::base().'index.php?option=com_aicontactsafe&sTask=message&task=message&pf='.$parameters['pf'].'&r_id='.$r_id.'&use_ajax=1&format=raw&lang='.$lang;
					// generate the script for ajax
					$script = "
						//<![CDATA[
						<!--
						function getAiContactForm_".$parameters['pf']."() {
							if (document.getElementById('aiContactSafe_form_".$parameters['pf']."')) {
								var url = '".$urlAiContactSafe."';
								new Ajax(url, {
									method: 'get',
									onRequest: function(){ 
															$('aiContactSafe_form_".$parameters['pf']."').setHTML('".JText::_( 'Please wait ...' )."');
														},
									onComplete: function() { 
															$('aiContactSafe_form_".$parameters['pf']."').setHTML( this.response.text );
															setupCalendars(".$parameters['pf'].");
															changeCaptcha(".$parameters['pf'].",0);
															resetSubmit(".$parameters['pf'].");
														}
								}).request();
							}
						}
						window.addEvent('load', function() {
							getAiContactForm_".$parameters['pf']."();
						});
						//-->
						//]]>
					";
					
					$document->addScriptDeclaration($script);
					
					// generate the code to replace the plugin initial text
					$plugin_form = '<div id="aiContactSafe_form_'.$parameters['pf'].'">...</div>';
				} else {
					// generate the code to replace the plugin initial text
					$plugin_form = JText::_( 'The selected profile is invalid !' ) . ' ( ' . $parameters['pf'] . ' )';
				}

				// replace the plugin initial text with the div that will be filled by ajax response
				$article->text = str_replace($initial_text, $plugin_form, $article->text);
			}
		}
	}

	function checkProfile( $pf = 0 ) {
		// initialize the response
		$validProfile = false;
		// initialize the database
		$db = &JFactory::getDBO();
		// test if the profile with the selected id is published and exists in the database
		$query = 'SELECT id FROM #__aicontactsafe_profiles WHERE id = ' . $pf . ' and published = 1';
		$db->setQuery( $query );
		$selected_profile = $db->loadResult();
		if ( $selected_profile == $pf ) {
			$validProfile = true;
		}
		return $validProfile;
	}

	function getProfileReturnTo( $pf = 0 ) {
		// get the current url
		$uri =& JURI::getInstance();
		$currentUrl = $uri->toString( array('scheme', 'host', 'port', 'path', 'query', 'fragment'));
		// initialize the database
		$db = &JFactory::getDBO();
		// test if the profile with the selected id is published and exists in the database
		$query = 'SELECT redirect_on_success FROM #__aicontactsafe_profiles WHERE id = ' . $pf;
		$db->setQuery( $query );
		$redirect_on_success = $db->loadResult();
		if (strlen(trim($redirect_on_success)) == 0) {
			$return_to = $currentUrl;
		} else {
			$return_to = $redirect_on_success;
		}
		return $return_to;
	}
}

