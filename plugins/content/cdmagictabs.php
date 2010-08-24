<?php
/**
 * Core Design Magic Tabs plugin for Joomla! 1.5
 * @author      Daniel Rataj, <info@greatjoomla.com>
 * @package     Joomla
 * @subpackage	Content
 * @category    Plugin
 * @version     1.0.9
 * @copyright	Copyright (C) 2007 - 2010 Great Joomla!, http://www.greatjoomla.com
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL 3
 * 
 * This file is part of Great Joomla! extension.   
 * This extension is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This extension is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Import library dependencies
jimport('joomla.plugin.plugin');

class plgContentCdMagicTabs extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param object $subject The object to observe
	 * @param object $params  The object that holds the plugin parameters
	 * @since 1.5
	 */
	function plgContentCdMagicTabs(&$subject)
	{
		parent::__construct($subject);

		// load plugin parameters
		$this->plugin = &JPluginHelper::getPlugin('content', 'cdmagictabs');
		$this->params = new JParameter($this->plugin->params);
		
		// define language
		JPlugin::loadLanguage('plg_content_cdmagictabs', JPATH_ADMINISTRATOR);
	}

	/**
	 * Call the Magic Tabs function
	 *
	 * Method is called by the view
	 *
	 * @param 	object		The article object.  Note $article->text is also available
	 * @param 	object		The article params
	 * @param 	int			The 'page' number
	 */
	function onPrepareContent(&$article, &$params, $limitstart=0)
	{
		// regular expression
		$regex = "#{magictabs(?:\s?(.*?)?)?}(.*?){/magictabs}#is";

		if (!preg_match($regex, $article->text)) return false;
		
		// Scriptegrator check
		if (!class_exists('JScriptegrator')) {
			JError::raiseNotice('', JText::_('CDMT_ENABLE_SCRIPTEGRATOR'));
			return false;
		} else {
			$message = JScriptegrator::check('1.3.8', 'jquery', 'site');
			if ($message)  {
			   JError::raiseNotice('', $message);
			   return false;
      		}
		}

		$document = &JFactory::getDocument(); // set document for next usage
		
		$live_path = JURI::base(true) . '/'; // define live site
		
		// add general stylesheet
		$document->addStyleSheet($live_path . 'plugins/content/cdmagictabs/css/cdmagictabs.css', 'text/css');

		JScriptegrator::importUI('ui.tabs');
		
		// Explication:
		// $match[1]	-> parameters
		// $match[2]	-> text to tabs

		// replacement regular expression
		$article->text = preg_replace_callback($regex, array($this, 'replacer'), $article->text);
	}

	/**
	 * Plugin replacer
	 *
	 * @return string
	 */
	function replacer(&$match)
	{
		$document = &JFactory::getDocument();

		$default_tabstyle = $this->params->get('default_tabstyle', 'smoothness');
		if ($default_tabstyle == '-1') $default_tabstyle = 'smoothness';

		$default_animated = $this->params->get('default_animated', 'both');
		$tabwidth = $this->params->get('default_tabwidth', '80px');
		$default_boxwidth = $this->params->get('default_boxwidth', '0');
		$default_tabalign = $this->params->get('default_tabalign', 'left');
		$default_taboffset = $this->params->get('default_taboffset', '0px');
		$default_tabrotate = (int)$this->params->get('default_tabrotate', 0);
		$default_tabevent = $this->params->get('default_tabevent', 'click');
		$def_navigation = $this->params->get('navigation', 0);
		$readmore = $this->params->get('readmore', 0);

		$process_plugins = (int)$this->params->get('plugins', 0);

		// define regex parameters
		$tabs_settings = ( isset($match[1]) ? $match[1] : '' );
		$tabs_text = ( isset($match[2]) ? $match[2] : '' );

		unset($match);

		// Mode
		preg_match("#^[0-9:]*?$#", $tabs_text, $mode);
		$mode = (isset($mode[0]) ? 'id' : 'manually');
		
		// tab id
		preg_match('#id\s?=\s?"([0-9a-zA-Z]{1,})"#', $tabs_settings, $tab_id);
		$tab_id = (isset($tab_id[1]) ? $tab_id[1] : $this->random(5));

		// style
		$files = implode('|', JScriptegrator::themeList());
		preg_match('#theme\s?=\s?"(' . $files . ')?"#', $tabs_settings, $tab_style);
		$tab_style = ( isset($tab_style[1]) ? $tab_style[1] : $default_tabstyle);
		
		if ($tab_style) JScriptegrator::importUITheme($tab_style, 'ui.tabs');
		
		// tab animated
		preg_match('#animation\s?=\s?"(both|slide|fade|none)"#', $tabs_settings, $animation);
		$animation = ( isset($animation[1]) ? $animation[1] : $default_animated);
		
		switch ($animation)
		{
			case 'none':
				$animation = null;
				break;
			case 'both':
				$animation = 'fx: { height: \'toggle\', opacity: \'toggle\' }';
				break;
			case 'slide':
				$animation = 'fx: { height: \'toggle\' }';
				break;
			case 'fade':
				$animation = 'fx: { opacity: \'toggle\' }';
				break;
			default:
				$animation = null;
				break;
		}
		// end


		// box width
		preg_match('#boxwidth\s?=\s?"([0-9empx%.]{1,})"#', $tabs_settings, $tab_boxwidth);
		$tab_boxwidth = (isset($tab_boxwidth[1]) ? $tab_boxwidth[1] : $default_boxwidth);
		
		// tab align (float - left, right)
		preg_match('#tabalign\s?=\s?"(left|right)"#', $tabs_settings, $tab_align);
		$tab_align = (isset($tab_align[1]) ? $tab_align[1] : $default_tabalign);
		
		switch ($tab_align)
		{
			case 'left':
				$tab_align = 'left';
				break;
			case 'right':
				$tab_align = 'right';
				break;
			default:
				break;
		}
		// end

		// tab offset (padding-left)
		preg_match('#offset\s?=\s?"([0-9empx%.]{1,})"#', $tabs_settings, $tab_offset);
		$tab_offset = (isset($tab_offset[1]) ? $tab_offset[1] : $default_taboffset);
		
		// tab select
		preg_match('#select\s?=\s?"([1-9]{1,})"#', $tabs_settings, $tab_select);
		$tab_select = (isset($tab_select[1]) ? 'selected: ' . --$tab_select[1] : null);
		
		// event
		preg_match('#event\s?=\s?"(click|mouseover)"#', $tabs_settings, $tab_event);
		$tab_event = (isset($tab_event[1]) ? $tab_event[1] : $default_tabevent);
		
		switch ($tab_event)
		{
			case 'click':
				$tab_event = 'click';
				break;
			case 'mouseover':
				$tab_event = 'mouseover';
				break;
			default:
				$tab_event = 'click';
				break;
		}

		$tab_event = "event: '$tab_event'";
		// end

		if ($tab_event and $animation and $tab_select)
		{
			$settings = $tab_event . ', ' . $animation . ', ' . $tab_select;
		} elseif ($tab_event and $animation)
		{
			$settings = $tab_event . ', ' . $animation;
		} elseif ($tab_event and $tab_select)
		{
			$settings = $tab_event . ', ' . $tab_select;
		} else
		{
			$settings = $tab_event;
		}

                // tab rotate
		preg_match('#rotate\s?=\s?"([0-9]{1,})"#', $tabs_settings, $tab_rotate);
		$tab_rotate = (isset($tab_rotate[1]) ? $tab_rotate[1] : $default_tabrotate);

		if ($tab_rotate) {
			$tab_rotate = '.tabs(\'rotate\', ' . $tab_rotate . ')';
		} else {
			$tab_rotate = '';
		}
		
		// tab navigation
		preg_match('#navigation\s?=\s?"(yes|no)"#', $tabs_settings, $navigation);
		$navigation = ( isset($navigation[1]) ? $navigation[1] : '');
		
		if ($navigation) {
			$navigation = ($navigation == 'yes' ? 1 : 0);
		} else {
			$navigation = $def_navigation;
		}
		
		$custom_setting_js = "
		<!--
		jQuery(function($) {
			// tabs element
			var tab_instance = $('#magictabs_$tab_id');
			
			// create tabs instance
			tab_instance.tabs({ $settings })$tab_rotate;
		";
		
		// prev next links script
		if ($navigation) {
			$custom_setting_js .= "
			// prev - next buttons
			$('#magictabs_$tab_id').find('div.buttons a').each(function(n, el) {
				$(this).click(function (){
					var selected = tab_instance.tabs('option', 'selected');
					" . ($tab_align == "left" ? "var count = selected + 1;" : "var count = selected - 1;") . "
					" . ($tab_align == "left" ? "if ($(el).hasClass('prev')) count = selected - 1;" : "if ($(el).hasClass('prev')) count = selected + 1;") . "
					tab_instance.tabs('select', count);
					return false;
				});
			});
			";
		}
		
		$custom_setting_js .= "
		});
		//-->
		";
		
		$document->addScriptDeclaration($custom_setting_js);

		$this->customScript($tab_id, $tab_style, $tab_boxwidth, $tab_align, $tab_offset); // load custom CSS

		// end

		$tabed_text = '';
		$tabed_bullet_text = '<ul>'; // open <ul> tag
		
		switch ($mode)
		{

			case 'id':
					
				$tabs_text = trim(strip_tags($tabs_text)); // prevent HTML characters in article ids
					
				if (explode(':', $tabs_text))
				{
					$set_articles = explode(':', $tabs_text);
				} else
				{
					return;
				}

				foreach ($set_articles as $key => $article_id)
				{
					if ($article_id) {
						$article = $this->renderItem($article_id);
							
						if ($article->text) {
							$user		=& JFactory::getUser();
							$aid	= $user->get('aid');

							if ($article->access <= $aid) {
								$title = strip_tags($article->title);
								$fulltext = $article->fulltext;
								$text = $article->text;
									
								if ($fulltext and $readmore)
								{
									$text = $text . $article->link;
								} else
								{
									$text = $text . '';
								}
									
								$tab_name = ( $title ? $title : '' );
								$text = ( $text ? $text : '' );
								$ahref = 'magictabs_' . $tab_id . '_' . ++$key;
									
								$tabed_bullet_text .= '<li><a href="#' . $ahref . '">' . $tab_name .
			                    '</a></li>';
									
								// process plugins
									
								$text = ($process_plugins ? JHTML::_('content.prepare', $text) : $text);
								
								$prevlink = '<a href="#magictabs_' . $tab_id . '_' . ($key - 1) . '" class="ui-icon ui-icon-circle-arrow-w prev" title="' . JText::_('CDMT_PREVIOUS') . '"></a>';
								$nextlink = '<a href="#magictabs_' . $tab_id . '_' . ($key + 1) . '" class="ui-icon ui-icon-circle-arrow-e next" title="' . JText::_('CDAMT_NEXT') . '"></a>';
								
								$links = '<div class="buttons">';
					
								if ($tab_align == 'left') {
									if ($key + 1 <= count($set_articles)) $links .= $nextlink;
									$links .= ' ';
									if ($key - 1 !== 0) $links .= $prevlink;
									
								} else {
									// right
									$key = count($set_articles) - $key + 1;
									if ($key + 1 <= count($set_articles)) $links .= $nextlink;
									$links .= ' ';
									if ($key - 1 !== 0) $links .= $prevlink;
								}
								
								$links .= '</div>'; 
								$tabed_text .= '<div id="' . $ahref . '">' . $text . ($navigation ? $links : '' ) . '</div>';
							}
						}
					}
				}

				break;

			case 'manually':
					
				if (preg_split('#\|\|\|\|#', $tabs_text, -1, PREG_SPLIT_NO_EMPTY))
				{
					$tabs_text_array = preg_split('#\|\|\|\|#', $tabs_text, -1, PREG_SPLIT_NO_EMPTY);
				} else
				{
					return '';
				}

				foreach ($tabs_text_array as $key => $text)
				{
					$tabs_array = explode('::', $text);

					$tab_name = ( isset($tabs_array[0]) ? trim(strip_tags($tabs_array[0])) : '' );
					$text = ( isset($tabs_array[1]) ? $tabs_array[1] : '' );
					$ahref = 'magictabs_' . $tab_id . '_' . ++$key;
					$tabed_bullet_text .= '<li><a href="#' . $ahref . '">' . $tab_name .
                    '</a></li>';
					
					$prevlink = '<a href="#magictabs_' . $tab_id . '_' . ($key - 1) . '" class="ui-icon ui-icon-circle-arrow-w prev" title="' . JText::_('CDMT_PREVIOUS') . '"></a>';
					$nextlink = '<a href="#magictabs_' . $tab_id . '_' . ($key + 1) . '" class="ui-icon ui-icon-circle-arrow-e next" title="' . JText::_('CDAMT_NEXT') . '"></a>';
					
					$links = '<div class="buttons">';
					
					if ($tab_align == 'left') {
						if ($key + 1 <= count($tabs_text_array)) $links .= $nextlink;
						$links .= ' ';
						if ($key - 1 !== 0) $links .= $prevlink;
						
					} else {
						// right
						$key = count($tabs_text_array) - $key + 1;
						if ($key + 1 <= count($tabs_text_array)) $links .= $nextlink;
						$links .= ' ';
						if ($key - 1 !== 0) $links .= $prevlink;
					}
					
					$links .= '</div>'; 
					$tabed_text .= '<div id="' . $ahref . '">' . $text . ($navigation ? $links : '' ) . '</div>';
				}
					

				break;
			default: return; break;
		}

		$tabed_bullet_text .= '</ul>'; // close </ul> tag
		
		
		$html = '
	<div class="' . $tab_style . '">
		<div id="magictabs_' . $tab_id . '">
			' . $tabed_bullet_text . $tabed_text . '
		</div>
	</div>
	';

		return $html;

	}

	/**
	 * Create a Random String
	 *
	 * @param $length
	 * @return string		Generated hash.
	 */
	function random($length = 5)
	{
		$alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$var_random = '';
		mt_srand(10000000 * (double)microtime());
		for ($i = 0; $i < (int)$length; $i++)
		$var_random .= $alphanum[mt_rand(0, 61)];
		return $var_random;
	}

	/**
	 * Create custom script and style
	 *
	 * @param $set_id
	 * @param $tab_style
	 * @param $boxwidth
	 * @param $tab_align
	 * @param $offset
	 * @return void
	 */
	function customScript($set_id, $tab_style = 'smoothness', $boxwidth = '0', $tab_align =
        'left', $offset = '0px') {

		$document = &JFactory::getDocument();
		$tab_offset = '';
		switch ($tab_align)
		{
			case 'left':
				$tab_offset = '';
				break;
			case 'right':
				$tab_offset = "$('#magictabs_$set_id > ul').css({ \"padding-right\" : \"$offset\" });";
				break;
			default:
				break;
		}
	
		$custom_css = "	#magictabs_$set_id .ui-tabs-nav li { float: $tab_align; }";
	
		$document->addStyleDeclaration($custom_css);
		
		if ($boxwidth) {
			$boxwidth = "$(\"#magictabs_$set_id\").css({ \"width\" : \"$boxwidth\" });";
		} else {
			$boxwidth = '';
		}
	
		if ($tab_offset or $boxwidth) {
			$js = "
			<!--
			jQuery(document).ready(function($){
				$tab_offset $boxwidth
			});
			//-->";
					
			$document->addScriptDeclaration($js);
		}
     }
     
     
     	/**
         * Load and render article
         * 
         * @param $id
         * @return object
         */
        function renderItem($id = 0)
        {
        	// Create and load the content table row
        	$item = & JTable::getInstance('content');
        	$item->load($id);

        	require_once (JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php'); // article routing

        	$item->text = $item->introtext;
        	$item->readmore = (trim($item->fulltext) != '');
        	$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid, $item->sectionid));

        	if (isset($item->link) && $item->readmore)
        	{
        		$item->link = '<div class="readmore"><a class="readmore" href="' . $item->link .
                '" title="' . JText::_('CDMT_READ_MORE_LINK') . '">' . JText::_('CDMT_READ_MORE_LINK') .
                '</a></div>';
        	} else
        	{
        		$item->link = '';
        	}

        	return $item;
        } 

}


?>
