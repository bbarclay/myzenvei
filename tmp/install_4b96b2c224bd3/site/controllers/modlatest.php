<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: modlatest.php 1578 2009-09-23 09:35:35Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( 'JPATH_BASE' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.application.component.controller');

class ModLatestController extends JController   {


	function __construct($config = array())
	{
		if (!isset($config['base_path'])){
			$config['base_path']=JEV_PATH;
		}
		parent::__construct($config);
		// TODO get this from config
		$this->registerDefaultTask( 'calendar' );

		$cfg = & JEVConfig::getInstance();
		$theme = ucfirst(JEV_CommonFunctions::getJEventsViewName());
		JLoader::register('JEvents'.ucfirst($theme).'View',JEV_VIEWS."/".$theme."/abstract/abstract.php");

		include_once(JEV_LIBS."/modfunctions.php");
	}

	function rss() {
				
		$modid = intval((JRequest::getVar('modid', 0)));
		if ($modid<0){
			$modid = 0;
		}
		global  $mainframe;
		$cfg = & JEVConfig::getInstance();
		
		$db	=& JFactory::getDBO();

		// setup for all required function and classes
		$file = JPATH_SITE . '/components/com_jevents/mod.defines.php';
		include_once($file);

		// load language constants
		JEVHelper::loadLanguage('modlatest');

		// Check document type
		$doc =& JFactory::getDocument();
		if ($doc->getType() != 'feed') {
			JError::raiseError('E999', 'Fatal error, document type: "' . $doc->getType() . '" not supported.');
		}
		
		$user =& JFactory::getUser();
		$query = "SELECT id, params"
		. "\n FROM #__modules AS m"
		. "\n WHERE m.published = 1"
		. "\n AND m.id = ". $modid
		. "\n AND m.access <= ". (int) $user->aid
		. "\n AND m.client_id != 1";
		$db	=& JFactory::getDBO();
		$db->setQuery( $query );
		$modules = $db->loadObjectList();
		if (count($modules)<=0){
			// fake module parameter
			$params =new JParameter('');
		} else {
			$params =new JParameter( $modules[0]->params );
		}

		// parameter intialization
		$info['link'] 			= str_replace('&', '&amp;', JURI::root(true));
		$info['imagelink'] 		= str_replace('&', '&amp;', JURI::root());
		$info['base']			= str_replace('&', '&amp;', JURI::root());
		$info['cache'] 			= $cfg->get( 'com_rss_cache', 1 );
		$info['cache_time'] 	= $cfg->get( 'com_rss_cache_time', 3600 );
		$info['count']			= $cfg->get( 'com_rss_count', 5 );

		$info['title'] 			= $cfg->get( 'com_rss_title', 'Powered by JEvents!' );
		$info['description']	= $cfg->get( 'com_rss_description', 'JEvents Syndication for Joomla' );

		// get rss title from module param if requested and defined
		$t_title = $params->get('modlatest_rss_title', null);
		if (($params->get('modlatest_useLocalParam', 0) == 1) && (!empty($t_title))) {
			$info['title'] = $t_title;
		}
		// get rss description from module param if requested and defined
		$t_description = $params->get('modlatest_rss_description', null);
		if (($params->get('modlatest_useLocalParam', 0) == 1) && (!empty($t_description))) {
			$info['description'] = $t_description;
		}
		$info['image_url']		= htmlspecialchars($cfg->get( 'com_rss_logo', JURI::root() . 'administrator/components/' . JEV_COM_COMPONENT . '/assets/images/logo.gif'));
		if ($info['image_url']=="") $info['image_url']	= htmlspecialchars( JURI::root() . 'administrator/components/' . JEV_COM_COMPONENT . '/assets/images/logo.gif');
		$info['image_alt'] 		= $info['title'];
		
		$info['limit_text']		= $cfg->get( 'com_rss_limit_text', 1 );
		$info['text_length']	= $cfg->get( 'com_rss_text_length', 20 );
		

		// setup document
		$doc->setLink($info['link']);
		$doc->setBase($info['base']);
		$doc->setTitle($info['title']);
		$doc->setDescription($info['description']);

		$docimage =new JFeedImage();
		$docimage->set('description', $info['description']);
		$docimage->set('title', $info['title']);
		$docimage->set('url', $info['image_url']);
		$docimage->set('link', $info['imagelink']);
		$doc->set('image', $docimage);

		// include the appropraite VIEW - this should be based on config and/or URL?
		$cfg = & JEVConfig::getInstance();
		$theme = JEV_CommonFunctions::getJEventsViewName();
		$viewclass = ucfirst($theme)."ModLatestView";

		jimport('joomla.application.module.helper');
		require_once(JModuleHelper::getLayoutPath('mod_jevents_latest',$theme.DS."latest"));
		$jeventCalObject = new $viewclass($params);

		$jeventCalObject->getLatestEventsData($info["count"]);
		$eventsByRelDay =& $jeventCalObject->eventsByRelDay;

		foreach ($eventsByRelDay as $relDay => $ebrd) {
			foreach ($ebrd as $row) {
				// title for particular item
				$item_title = htmlspecialchars( $row->title() );
				$item_title = html_entity_decode( $item_title );

				// url link to article
				$startDate = $row->publish_up();
				$eventDate = mktime(substr($startDate,11,2),substr($startDate,14,2), substr($startDate,17,2),
				$jeventCalObject->now_m,$jeventCalObject->now_d + $relDay,$jeventCalObject->now_Y);


				$link = $row->viewDetailLink(date("Y", $eventDate),date("m", $eventDate),date("d", $eventDate),false);
				$item_link  = JRoute::_($link.$jeventCalObject->datamodel->getCatidsOutLink());

				// removes all formating from the intro text for the description text
				$item_description = $row->content();
				$item_description = JFilterOutput::cleanText( $item_description );
				if ( $info[ 'limit_text' ] ) {
					if ( $info[ 'text_length' ] ) {
						// limits description text to x words
						$item_description_array = explode( ' ', $item_description );
						$count = count( $item_description_array );
						if ( $count > $info[ 'text_length' ] ) {
							$item_description = '';
							for ( $a = 0; $a < $info[ 'text_length' ]; $a++ ) {
								$item_description .= $item_description_array[$a]. ' ';
							}
							$item_description = trim( $item_description );
							$item_description .= '...';
						}
					} else  {
						// do not include description when text_length = 0
						$item_description = NULL;
					}
				}

				// type for particular item - category name
				$item_type = $row->getCategoryName();
				// organizer for particular item
				$item_organizer = htmlspecialchars( $row->contact_info() );
				$item_organizer = html_entity_decode( $item_organizer );
				// location for particular item
				$item_location = htmlspecialchars( $row->location() );
				$item_location = html_entity_decode( $item_location );
				// start date for particular item
				$item_startdate = htmlspecialchars( $row->publish_up());
				// end date for particular item
				$item_enddate = htmlspecialchars( $row->publish_down() );


				// load individual item creator class
				$item =new JFeedItem();
				// item info
				if ($row->alldayevent()) {
					$temptime = new JDate($eventDate);
					$item->set('title', $temptime->toFormat(JText::_('JEV_RSS_DATE')) ." : " .$item_title);
				} else {
					$temptime = new JDate($eventDate);
					$item->set('title', $temptime->toFormat(JText::_('JEV_RSS_DATETIME')) ." : " .$item_title);
				}
				$item->set('link', $item_link);
				$item->set('description', $item_description);
				$item->set('category', $item_type);
				$t_datenow = JEVHelper::getNow();
				$item->set('date', $t_datenow->toUnix(true));

				// add item info to RSS document
				$doc->addItem( $item );
			}
		}
	}

}

