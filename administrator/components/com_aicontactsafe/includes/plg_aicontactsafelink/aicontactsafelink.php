<?php
/**
 * @version     $Id$ 1.0.4 0
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 *
 * 1.0.1 - fixed the problem with the profile of the form to which the is link is generating
 * 1.0.2 - fixed the problem with the language
 * 1.0.3 - fixed the problem with the link on IE6
 *       - added a new parameter "action" to let the user specify a SEF URL
 * 1.0.4 - added the action to href
 *       - added return false; to javascript code so it will work on all browsers
 *       - added a random number to the id of the link form so the link can be used more then once on a page
 *
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.plugin.plugin' );

class plgContentAiContactSafeLink extends JPlugin {
	function plgContentAiContactSafeLink( &$subject, $params ) {
		parent::__construct( $subject, $params );
	}

	function onPrepareContent( &$article, &$params, $limitstart ) {
		// get all the mentioning of {aicontactsafelink in the article
		$links = explode('{aicontactsafelink',$article->text);
		// count the links
		$no_links = count($links);
		// if the code that is activating the plugin appears at least once start the link generation
		if ($no_links>1) {
			for($i=1;$i<$no_links;$i++) {
				// get the parameters for the link
				$current_link = explode('}',$links[$i]);
				$current_link = $current_link[0];
				// generate the text to replace
				$initial_text = '{aicontactsafelink'.$current_link.'}';

				$current_link_parameters = explode('|',$current_link);
				// put the parameters in an array so they can be easily accessed
				$parameters = array();
				foreach($current_link_parameters as $parameter) {
					$start_value = strpos($parameter,'=');
					if ( $start_value !== false) {
						$parameters[trim(substr($parameter,0,$start_value))] = trim(substr($parameter,$start_value+1));
					}
				}
				// if the selected profile is valid
				if ( $this->checkProfile($parameters['pf']) ) {
					// generate the code to replace the plugin initial text
					$uri =& JURI::getInstance();
					$baseUrl = $uri->base();
					$currentUrl = $uri->toString( array('scheme', 'host', 'port', 'path', 'query', 'fragment'));

					// if no action is set use the default one
					if(!array_key_exists('action',$parameters)) {
						$parameters['action'] = $baseUrl.'index.php?option=com_aicontactsafe&sTask=message&task=message&pf='.$parameters['pf'];
					}

					$plugin_link = '';
					// generate a random number to be able to use more then one link in a page
					$rnd_id = mt_rand();
					// the link has to be in a form
					$plugin_link .= '<form name="aiContactSafeCall_'.$parameters['pf'].'_'.$rnd_id.'" id="aiContactSafeCall_'.$parameters['pf'].'_'.$rnd_id.'" action="'.$parameters['action'].'" method="post">';
					// this is the link
					$plugin_link .= '<a class="aiContactSafeLink" href="'.$parameters['action'].'" onclick="document.aiContactSafeCall_'.$parameters['pf'].'_'.$rnd_id.'.submit();return false;">'.$parameters['text'].'</a>';
					// this will make aiContactSafe to read the information from post
					$plugin_link .= '<input type="hidden" name="dt" id="dt" value="1" />';
					// activate the back button
					$plugin_link .= '<input type="hidden" name="back_button" id="back_button" value="1" />';
					// language
					$lang = JRequest::getCmd('lang', 'en');
					$plugin_link .= '<input type="hidden" name="lang" id="lang" value="'.$lang.'" />';
					// variables identifier
					$plugin_link .= '<input type="hidden" name="r_id" id="r_id" value="'.mt_rand().'" />';
					if (!array_key_exists('return_to', $parameters)) {
						// set the return link to the current url in case other is not defined
						$plugin_link .= '<input type="hidden" name="return_to" id="return_to" value="'.$currentUrl.'" />';
					}
					// add all parameters to send them to the contact form ( except the text used as link )
					foreach($parameters as $key=>$value) {
						if ( $key != 'text' ) {
							$plugin_link .= '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$value.'" />';
						}
					}
					// add the token
					$plugin_link .= JHTML::_( 'form.token' );
					// close the form
					$plugin_link .= '</form>';
				} else {
					// generate the code to replace the plugin initial text
					$plugin_form = JText::_( 'The selected profile is invalid !' ) . ' ( ' . $parameters['pf'] . ' )';
				}

				// replace the plugin initial text with the generated form
				$article->text = substr_replace($article->text, $plugin_link, strpos($article->text,$initial_text), strlen($initial_text));
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
}

