<?php
/**
 * Plugin Helper File
 *
 * @package     Better Preview
 * @version     1.6.0
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Plugin that replaces Sourcerer code with its HTML / CSS / JavaScript / PHP equivalent
*/
class plgSystemBetterPreviewHelper
{
	function init( &$params ) {
		$this->params = plgSystemBetterPreviewHelper::getParamValues( $params );
	}

	function prePreviewArticle()
	{
		$lang =& JFactory::getLanguage();
		$lang->load( 'plg_system_betterpreview', JPATH_ADMINISTRATOR );

		$editor =& JFactory::getEditor();
		?>
			<html>
				<body onload="sendForm()">

					<form method="post" id="adminForm">
						<input type="hidden" name="show" value="1">
						<input type="hidden" name="title" id="title" value="1">
						<input type="hidden" name="text" id="text" value="1">
					</form>
					
					<center><?php echo JText::_( 'Loading' ); ?></center>

					<script type="text/javascript">
						function sendForm() {
							var form = window.top.document.adminForm
							var title = form.title.value;
							
							var alltext = window.top.<?php echo $editor->getContent( 'text' ); ?>;
							alltext = alltext.replace( /<hr\s+id=(\"|\')system-readmore(\"|\')\s\/*>/i, '' );

							document.getElementById('title').value = title;
							document.getElementById('text').value = alltext;
							document.getElementById('adminForm').submit();
						}
					</script>
				</body>
			</html>
		<?php
		exit;
	}

	function previewArticle( &$article )
	{
		$db =& JFactory::getDBO();

		$id = JRequest::getInt( 'bid' );
		$query = 'SELECT a.*, u.name AS author, u.usertype, cc.title AS category, s.title AS section,' .
				' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
				' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug,'.
				' g.name AS groups, s.published AS sec_pub, cc.published AS cat_pub, s.access AS sec_access, cc.access AS cat_access '.
				' FROM #__content AS a' .
				' LEFT JOIN #__categories AS cc ON cc.id = a.catid' .
				' LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = "content"' .
				' LEFT JOIN #__users AS u ON u.id = a.created_by' .
				' LEFT JOIN #__groups AS g ON a.access = g.id'.
				' WHERE a.id = '.(int) $id;
		$db->setQuery( $query );
		$article = $db->loadObject();
		$article->parameters = new JParameter( $article->attribs );

		$article->title = stripslashes( $_POST[ 'title' ] );
		$article->text = stripslashes( $_POST[ 'text' ] );

		// run all onPrepareContent plugins again that have been handled before BetterPreview
		$dispatcher = clone( JDispatcher::getInstance() );
		$unset = 0;
		foreach( $dispatcher->_observers as $i => $observer ) {
			if ( !is_array( $observer ) && $observer->_name == 'betterpreview' ) {
				$unset = 1;
			}
			if ( $unset ) {
				unset( $dispatcher->_observers[$i] );
			}
		}
		$dispatcher->trigger( 'onPrepareContent', array( $article, $article->parameters ) );
	}

	function addScripts()
	{
		$mainframe =& JFactory::getApplication();
		if ( !$mainframe->isAdmin() ) {
			return;
		}

		JHTML::_('behavior.tooltip');

		$document =& JFactory::getDocument();

		$document->addStyleSheet( JURI::root( true ).'/plugins/system/betterpreview/css/betterpreview.css' );
		$script = "
			window.addEvent( 'domready', function() {
				var betterpreview_preview = $( 'betterpreview_preview' );
				if ( betterpreview_preview ) {
					betterpreview_preview.addEvent( 'mouseenter', betterpreview_resize_tooltip );
					betterpreview_preview.addEvent( 'mouseleave', betterpreview_deresize_tooltip );
				}
			} );
			var betterpreview_timer = 0;
			var betterpreview_resize_tooltip = function() {
				$$( 'div.tool-tip' ).each( function( el ) {
					betterpreview_timer = \$clear( betterpreview_timer );
					el.setStyle( 'max-width', 500 );
				} );
			};
			var betterpreview_deresize_tooltip = function() {
				$$( 'div.tool-tip' ).each( function( el ) {
					betterpreview_timer = ( function(){ el.setStyle( 'max-width', '' ) } ).delay( 100 );
				} );
			};
		";
		$document->addScriptDeclaration( $script );
		if ( $this->params->show_copy_icon ) {
			$document->addScript( JURI::root( true ).'/plugins/system/betterpreview/js/ZeroClipboard.js' );
			$script = "
				window.addEvent( 'domready', function() {
					var betterpreview_clip_text = $( 'betterpreview_clip_text' );
					if ( betterpreview_clip_text ) {
						ZeroClipboard.setMoviePath( '".JURI::root( true )."/plugins/system/betterpreview/js/ZeroClipboard.swf' );
						var betterpreview_clip = null;
						betterpreview_clip = new ZeroClipboard.Client();
						betterpreview_clip.setHandCursor( true );
						betterpreview_clip.setText( betterpreview_clip_text.value );
						betterpreview_clip.addEventListener( 'onComplete', betterpreview_show_complete );
						betterpreview_clip.glue( 'betterpreview_clip' );
						new Element( 'span', {
							'id': 'betterpreview_clip_msg',
						    'styles': { 'opacity': 0 }
						} ).setText( '".JText::_( 'URL copied to clipboard' )."' ).injectInside( document.body );
					}
				} );
				var betterpreview_show_complete = function() {
					$( 'betterpreview_clip_msg' ).addClass( 'visible' ).effect( 'opacity', { duration: 400 } ).start( 0, 0.8 );
					( function(){ $( 'betterpreview_clip_msg' ).effect( 'opacity', { duration: 1600 } ).start( 0.8, 0 ) } ).delay( 3000 );
				};
			";
			$document->addScriptDeclaration( $script );
		}
	}

	function updateBody()
	{
		$mainframe =& JFactory::getApplication();
		$action = JRequest::getCmd( 'action' );

		$body = JResponse::getBody();

		if ( $mainframe->isAdmin() ) {
			$this->updateLinks( $body );
		} else if ( $action == 'betterpreview' ) {
			$this->protectIconLinks( $body );
		}
		
		JResponse::setBody( $body );
	}
	
	function protectIconLinks( &$body )
	{
		$lang =& JFactory::getLanguage();
		$lang->load( 'plg_system_betterpreview', JPATH_ADMINISTRATOR );

		$regex = '#(<td [^>]*class="buttonheading"[^>]*>)\s*<a [^>]*>\s*(<img [^>]*>)\s*</a>\s*(</td>)#si';
		$replace = '\1<a href="javascript:alert(\''.JText::_( 'Disabled in preview mode' ).'\');" title="'.JText::_( 'Disabled in preview mode' ).'">\2</a>\3';
		$body = preg_replace( $regex, $replace, $body );
	}

	function updateLinks( &$body )
	{
		// correct large article preview link in tool bar
		$regex = '#(href="[^"]*)administrator/(index\.php\?option=com_content)([^"]*)&id=([^"]*tmpl=component)&task=preview"#si';
		preg_match( $regex, $body, $match );
		if ( !empty( $match ) ) {
			$db =& JFactory::getDBO();

			$jnow		=& JFactory::getDate();
			$now		= $jnow->toMySQL();
			$nullDate	= $db->getNullDate();

			$query = 'SELECT a.id'
				.' FROM #__content AS a'
				.' LEFT JOIN #__categories AS c ON c.id = a.catid'
				.' LEFT JOIN #__sections AS s ON s.id = c.section AND s.scope = "content"'
				.' WHERE a.state = 1 AND a.access = 0'
				.' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
				.' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
				.' AND s.published = 1 AND s.access = 0'
				.' AND c.published = 1 AND c.access = 0';
			$db->setQuery( $query );
			$dummyid = $db->loadResult();
			if ( $dummyid ) {
				$replace = '\1\2&view=article\3&bid=\4&id='.$dummyid.'&action=betterpreview"';
				$body = preg_replace( $regex, $replace, $body );
			}
		}

		// correct preview link in status bar
		$regex = '#(?:<span class="preview"><a [^>]*href="[^"]*"[^>]*>)(.*?)</a>#si';
		preg_match( $regex, $body, $match );

		// if preview link is found, try ap2
		if ( empty( $match ) ) {
			$regex = '#(?:<span id="Preview"><a [^>]*href="[^"]*"[^>]*>)(.*?)</a>#si';
			preg_match( $regex, $body, $match );
		}

		// if preview link is found,
		if ( empty( $match ) ) {
			return;
		}

		$link = $this->getNewLink();
		$classes = array();
		$classes[] = 'preview';
		$text = $match['1'];

		if ( $this->params->display_link == 'text' ) {
			$classes[] = 'no_icon';
		} else {
			if ( $this->params->show_icon == 1 ) {
				if ( $link->url ) {
					$classes[] = 'active';
				} else {
					$classes[] = 'inactive';
				}
			}
			if ( $this->params->display_link == 'icon' ) {
				$text = '&nbsp;';
				$classes[] = 'no_text';
			}
		}


		// Translates an internal Joomla URL to a humanly readible URL.
		$link->url = JRoute::_( $link->url, true );

		if ( $this->params->show_tooltip ) {
			$tooltip = '';
			// if title is set
			if ( $link->title ) {
				$tooltip .= '<span class=\'betterpreview_title\'>'.htmlspecialchars( $link->title, ENT_QUOTES ).'</span><br /><br />';
			}
			// if link is empty
			if ( $link->url ) {
				$tooltip .= '<span class=\'betterpreview_url\'>'.htmlspecialchars( $link->url, ENT_QUOTES ).'</span>';
			} else {
				$tooltip .= JText::_( 'URL' ).': '.JText::_( 'Home page' );
				$link->url = $this->params->homepage;
				$this->params->show_copy_icon = 0;
			}
			if ( $link->menu ) {
				$tooltip .= '<br /><br /><strong>'.JText::_( 'Active Menu Item' ).':</strong> '.$link->menu;
			}
			if ( count( $link->notice ) ) {
				$tooltip .= '<br /><br /><strong>'.JText::_( 'Notice' ).':</strong>';
				$tooltip .= '<br />'.implode( '<br />', $link->notice );
			}
			if ( $this->params->show_copy_icon ) {
				$tooltip .= '<br /><br /><em>'.JText::_( 'Click on the icon to copy url to clipboard' ).'</em>';
			}
			$tooltip .= '<div class=\'ol-textfont\' style=\'text-align:right;padding-top:5px;\'>Better Preview</div>';
		}
		$link->tag = '<a href="'.JURI::root().$link->url.'" target="_blank" onfocus="this.blur();" id="betterpreview_link"><span class="'.implode( ' ', $classes ).'">'.$text.'</span></a>';

		if ( $this->params->show_tooltip ) {
			$link->tag = '<label class="hasTip" title="'.$tooltip.'">'.$link->tag.'</label>';
		}

		if ( $this->params->show_copy_icon ) {
			$link->tag .= '<div id="betterpreview_clip"><img src="'.JURI::root( true ).'/plugins/system/betterpreview/images/copy.png" width="12" height="12" /></div>';
			$link->tag .= '<input type="hidden" id="betterpreview_clip_text" value="'.$link->url.'"/>';
		}
		$link->tag = '<span id="betterpreview">'.$link->tag.'</span>';

		$body = str_replace( $match['0'], $link->tag, $body );
	}


	function getNewLink()
	{
		$mainframe =& JFactory::getApplication();
		$option = JRequest::getCmd( 'option' );

		$components = $this->params->components;
		if ( !is_array( $components ) ) { $components = explode( ',', $components ); }
		// if component is disabled for Better Preview, return
		if ( in_array( $option, $components ) ) {
			$link = $this->initLink();
			$link->notice[] =
				JText::_( 'Component' ).' ('.str_replace( 'com_', '', $option ).'): '.JText::_( 'Disabled' ).
				'<br /><em>('.JText::_( 'See Better Preview plugin settings' ).')</em>';
			return $link;
		}
		$db   =& JFactory::getDBO();

		$cid = JRequest::getVar( 'cid', array( 0 ), 'method', 'array' );
		$cid = array( (int) $cid['0'] );
		$id = $cid['0'];

		switch ( $option ) {
			case 'com_sections':
				$option = 'com_content';
				$view = 'section';
				break;
			case 'com_categories':
				$option = 'com_content';
				$view = 'category';
				break;
			case 'com_content':
				$option = 'com_content';
				$view = 'article';
				break;
		}

		if ( $option == 'com_menus' ) {
			// Menu items
			$link = $this->getLinkFromMenu( $id );
		} else if ( $option == 'com_content' ) {
			// Content
			$link = $this->getLinkByContent( $id, $view );
		} else  if ( $option == 'com_resource' ) {
			// JS Resource items
			$link = $this->getLinkByJSResouceContent( $id );
		} else  if ( $option == 'com_joomfish' ) {
			// Other component
			$link = $this->getLinkByJoomFish();
		} else {
			// Other component
			$link = $this->getLinkFromMenuByComponent( $option );
		}
		return $link;
	}

	function initLink()
	{
		$link = '';
		$link->title = '';
		$link->url = '';
		$link->notice = array();
		$link->menu = '';

		return $link;
	}

	function getMenuItemById( $id )
	{
		// if no id is found, return
		if ( !$id ) { return; }

		$db   =& JFactory::getDBO();
		$query = 'SELECT id, link, name, menutype'.
			' FROM #__menu'.
			' WHERE id = '.(int) $id.
			' LIMIT 1';
		$db->setQuery( $query );
		$menuitem = $db->loadObject();

		return $menuitem;
	}

	function getLinkFromMenu( $id, $lang = '' )
	{
		$link = $this->initLink();

		$menuitem = $this->getMenuItemById( $id );

		if ( isset( $menuitem->link ) ) {
			$link->url = $menuitem->link;
			if ( $link->url ) {
				$link->title = JText::_( 'Menu item' ).': '.$menuitem->name;
				$link->url .= '&Itemid='.(int) $menuitem->id;
				$link->menu .= $menuitem->name.' ('.$menuitem->menutype.')';
			}
		}

		if ( $lang != '' ) {
			$link->url .= '&lang='.$lang;
		}

		return $link;
	}

	function getLinkByContent( $id, $view = 'article', $lang = '' )
	{
		$mainframe =& JFactory::getApplication();

		$link = $this->initLink();

		// if no id is found, try to find the selected category or section in the list view
		if ( !$id ) {
			$catid = JRequest::getVar( 'catid', 0 );
			if ( $view == 'article' ) {
				$catid = $mainframe->getUserStateFromRequest( 'com_content.viewcontentcatid', 'catid', $catid, 'int' );
			}
			if ( $catid ) {
				$view = 'category';
				$id = $catid;
			} else {
				$sectionid = JRequest::getVar( 'sectionid', 0 );
				if ( $view == 'article' || $view == 'category' ) {
					$sectionid = $mainframe->getUserStateFromRequest( 'com_content.viewcontentfilter_sectionid', 'filter_sectionid', $sectionid, 'int' );
				}
				if ( $sectionid ) {
					$view = 'section';
					$id = $sectionid;
				}
			}
		}

		// if no id is found, return
		if ( !$id || $id == -1 ) {
			return $link;
		}

		$db  		=& JFactory::getDBO();
		$jnow		=& JFactory::getDate();
		$now		= $jnow->toMySQL();
		$nullDate	= $db->getNullDate();

		// Check if content is published
		if ( $view == 'article' ) {
			$query = 'SELECT a.*,'.
				' cc.title as cattitle,'.
				' cc.published as catpub,'.
				' s.title as sectitle,'.
				' s.published as secpub'.
				' FROM #__content AS a'.
				' LEFT JOIN #__categories AS cc ON cc.id = a.catid' .
				' LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = "content"' .
				' WHERE a.id = '.(int) $id.
				' LIMIT 1';
			$db->setQuery( $query );
			$article = $db->loadObject();

			$link->title = JText::_( 'Article' ).': '.$article->title;

			if ( !$article->secpub && $article->sectionid ) {
				// Section is not published so return
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Home' ).
					' ('.JText::_( 'Section' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$link->title = '';
				return $link;
			} else if ( !$article->catpub && $article->catid ) {
				// Category is not published so try section
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Section' ).
					' ('.JText::_( 'Category' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$view = 'section';
				$id = $article->sectionid;
				$link->title = JText::_( 'Section' ).': '.$article->sectitle;
			} else if ( !(
				(
					$article->state == 1 &&
					( $article->publish_up == $nullDate || $article->publish_up <= $now ) &&
					( $article->publish_down == $nullDate || $article->publish_down >= $now )
				) ||
				( $article->state == -1 )
			) ) {
				// Article is not published so try category
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Category' ).
					' ('.JText::_( 'Article' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$view = 'category';
				$id = $article->catid;
				$link->title = JText::_( 'Category' ).': '.$article->cattitle;
			}
		} else if ( $view == 'category' ) {
			$query = 'SELECT cc.*,'.
				' s.title as sectitle,'.
				' s.published as secpub'.
				' FROM #__categories as cc'.
				' LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = "content"' .
				' WHERE cc.id = '.(int) $id.
				' LIMIT 1';
			$db->setQuery( $query );
			$category = $db->loadObject();

			$link->title = JText::_( 'Category' ).': '.$category->title;

			if ( !$category->secpub ) {
				// Section is not published so return
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Home' ).
					' ('.JText::_( 'Section' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$link->title = '';
				return $link;
			} else if ( !$category->published ) {
				// Category is not published so try section
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Section' ).
					' ('.JText::_( 'Category' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$view = 'section';
				$link->title = JText::_( 'Section' ).': '.$category->sectitle;
				$id = $category->section;
			}
		} else if ( $view == 'section' ) {
			$query = 'SELECT *'.
				' FROM #__sections'.
				' WHERE id = '.(int) $id.
				' LIMIT 1';
			$db->setQuery( $query );
			$section = $db->loadObject();

			$link->title = JText::_( 'Section' ).': '.$section->title;

			if ( !$section->published ) {
				// section is not published so return
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Home' ).
					' ('.JText::_( 'Section' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$link->title = '';
				return $link;
			}
		}

		$query = 'SELECT id, link, name, menutype'.
			' FROM #__menu'.
			' WHERE CONCAT( link, "&" ) REGEXP "[^[:alnum:]]option=com_content[^[:alnum:]]"'.
			' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]view='.$view.'[^[:alnum:]]"'.
			' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]id='.(int) $id.'[^[:digit:]]"'.
			' AND published = 1'.
			' LIMIT 1';
		$db->setQuery( $query );
		$menuitem = $db->loadObject();

		if ( isset( $menuitem->id ) ) {
			$link->url = $menuitem->link;
			$link->menu .= $menuitem->name.' ('.$menuitem->menutype.')';
			$Itemid = $menuitem->id;
		} else {
			$menu_view = $view;
			$menu_id = $id;
			$Itemid = 0;
			while ( !$Itemid ) {
				if ( $menu_view == 'section' ) { break; }
				if ( $menu_view == 'article' ) {
					$menu_view = 'category';
					$query = 'SELECT catid'.
						' FROM #__content'.
						' WHERE id = '.$menu_id.
						' LIMIT 1';
				} else {
					$menu_view = 'section';
					$query = 'SELECT section'.
						' FROM  #__categories'.
						' WHERE id = '.$menu_id.
						' LIMIT 1';
				}
				$db->setQuery( $query );
				$menu_id = $db->loadResult();

				$query = 'SELECT id, name, menutype'.
					' FROM #__menu'.
					' WHERE CONCAT( link, "&" ) REGEXP "[^[:alnum:]]option=com_content[^[:alnum:]]"'.
					' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]view='.$menu_view.'[^[:alnum:]]"'.
					' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]id='.$menu_id.'[^[:digit:]]"'.
					' AND published = 1'.
					' LIMIT 1';
				$db->setQuery( $query );
				$menuitem = $db->loadObject();

				if ( isset( $menuitem->id ) ) {
					$Itemid = $menuitem->id;
				}

				if ( $Itemid && !$link->menu ) {
					$link->menu .= $menuitem->name.' ('.$menuitem->menutype.')';
					$link->menu .= '<br /><em>'.JText::_( 'No matching menu item found' ).', '.JText::_( 'but the Itemid of this menu item will be used' ).':</em>';
				}
			}

			$link->url = 'index.php?option=com_content&view='.$view;
			if ( $view != 'article' ) {
				$layout = ( $this->params->open_as_list ) ? 'list' : 'blog';
				$link->url .= '&layout='.$layout;
			}
			$link->url .= '&id='.(int) $id;
		}

		if ( $Itemid ) {
			$link->url .= '&Itemid='.$Itemid;
		}

		if ( $lang != '' ) {
			$link->url .= '&lang='.$lang;
		}

		return $link;
	}

	function getLinkByJSResouceContent( $id )
	{
		$mainframe =& JFactory::getApplication();

		$link = $this->initLink();

		$view = JRequest::getCmd( 'view' );
		$controler = JRequest::getCmd( 'controler' );
		if ( $view == 'record' ) {
			$view = 'article';
		}
		if ( $controler == 'category' ) {
			$view = 'category';
		}

		if ( $view != 'article' && $view != 'category' ) {
			return $link;
		}

		// if no id is found, try to find the selected category or section in the list view
		if ( !$id ) {
			if ( $view == 'article' ) {
				$id = $mainframe->getUserStateFromRequest( 'com_resourcecategory.filter_catid', 'filter_catid', '', 'int' );
				$view = 'category';
			} else {
				$id = JRequest::getCmd( 'filter_catid' );
			}
		}

		// if no id is found, return
		if ( !$id || $id == -1 ) {
			return $link;
		}

		$db  		=& JFactory::getDBO();
		$jnow		=& JFactory::getDate();
		$now		= $jnow->toMySQL();
		$nullDate	= $db->getNullDate();

		// Check if content is published
		if ( $view == 'article' ) {
			$query = 'SELECT a.*,'.
				' cc.published as catpub, cc.title as cattitle,'.
				' x.catid'.
				' FROM #__js_res_record AS a'.
				' LEFT JOIN #__js_res_record_category AS x ON x.record_id = a.id'.
				' LEFT JOIN #__js_res_category AS cc ON cc.id = x.catid'.
				' WHERE a.id = '.(int) $id.
				' LIMIT 1';
			$db->setQuery( $query );
			$article = $db->loadObject();
			unset( $article->params );
			$id = $article->id;

			$link->title = JText::_( 'Article' ).': '.$article->title;

			if ( !(
				$article->published == 1 &&
				( $article->extime == $nullDate || $article->extime >= $now )
			) ) {
				// Article is not published so try category
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Category' ).
					' ('.JText::_( 'Article' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				$view = 'category';
				$cat = $this->getPublishedParent( $article->catid );
				$id = $cat->id;

				$link->title = JText::_( 'Category' ).': '.$article->cattitle;

				if( !$cat->published || !$id ) {
					$link->notice[] =
						JText::_( 'URL' ).' => '.JText::_( 'Home' ).
						' ('.JText::_( 'Section' ).' '.strtolower( JText::_( 'Not published' ) ).')';
						$link->title = '';
					return $link;
				} else if( !$cat->section_id ) {
					$link->notice[] =
						JText::_( 'URL' ).' => '.JText::_( 'Section' ).
						' ('.JText::_( 'Category' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				} else if ( $article->catid != $id ) {
					$link->notice[] =
						JText::_( 'URL' ).' => '.JText::_( 'Category' ).
						' ('.JText::_( 'Category' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				}
			}
		} else {
			$cat = $this->getPublishedParent( $id );
			if( !$cat->published || !$cat->id ) {
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Home' ).
					' ('.JText::_( 'Section' ).' '.strtolower( JText::_( 'Not published' ) ).')';
				return $link;
			} else if( !$cat->section_id ) {
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Section' ).
					' ('.JText::_( 'Category' ).' '.strtolower( JText::_( 'Not published' ) ).')';
			} else if ( $id != $cat->id ) {
				$link->notice[] =
					JText::_( 'URL' ).' => '.JText::_( 'Category' ).
					' ('.JText::_( 'Current' ).' '.JText::_( 'Category' ).' '.strtolower( JText::_( 'Not published' ) ).')';
			}
			$id = $cat->id;
		}

		$s1 = 'view=article';
		$s2 = 'article='.(int) $id;
		if ( $view == 'category' ) {
			$s1 = 'view=list';
			$s2 = 'category_id='.(int) $id;
		}
		$query = 'SELECT id, link, name, menutype'.
			' FROM #__menu'.
			' WHERE CONCAT( link, "&" ) REGEXP "[^[:alnum:]]option=com_resource[^[:alnum:]]"'.
			' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]'.$s1.'[^[:alnum:]]"'.
			' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]'.$s2.'[^[:digit:]]"'.
			' AND published = 1'.
			' LIMIT 1';
		$db->setQuery( $query );
		$menuitem = $db->loadObject();

		if ( isset( $menuitem->id ) ) {
			$link->url = $menuitem->link;
			$link->menu .= $menuitem->name.' ('.$menuitem->menutype.')';
			$Itemid = $menuitem->id;
		} else {
			$menu_view = $view;
			$menu_id = $id;
			$Itemid = 0;
			while ( !$Itemid ) {
				if ( $menu_view == 'article' ) {
					$menu_view = 'category';
					$query = 'SELECT x.catid'.
						' FROM #__js_res_record AS a'.
						' LEFT JOIN #__js_res_record_category AS x ON x.record_id = a.id'.
						' WHERE a.id = '.(int) $menu_id.
						' LIMIT 1';
				} else {
					$query = 'SELECT parent'.
						' FROM #__js_res_category'.
						' WHERE id = '.(int) $menu_id.
						' LIMIT 1';
				}

				$db->setQuery( $query );
				$menu_id = $db->loadResult();

				if ( !$menu_id ) { break; }

				$query = 'SELECT id, name, menutype'.
					' FROM #__menu'.
					' WHERE CONCAT( link, "&" ) REGEXP "[^[:alnum:]]option=com_resource[^[:alnum:]]"'.
					' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]view=list[^[:alnum:]]"'.
					' AND CONCAT( link, "&" ) REGEXP "[^[:alnum:]]category_id='.( int ) $menu_id.'[^[:digit:]]"'.
					' AND published = 1'.
					' LIMIT 1';
				$db->setQuery( $query );
				$menuitem = $db->loadObject();

				if ( isset( $menuitem->id ) ) {
					$Itemid = $menuitem->id;
				}

				if ( $Itemid && !$link->menu ) {
					$link->menu .= $menuitem->name.' ('.$menuitem->menutype.')';
					$link->menu .= '<br /><em>'.JText::_( 'No matching menu item found' ).', '.JText::_( 'but the Itemid of this menu item will be used' ).':</em>';
				}
			}

			if ( $view == 'article' ) {
				$link->url = 'index.php?option=com_resource&view=article&article='.(int) $id;
			} else {
				$link->url = 'index.php?option=com_resource&view=list&category_id='.(int) $id;
			}
		}

		if ( $Itemid  ) $link->url .= '&Itemid='.$Itemid;

		return $link;
	}
	function getLinkByJoomFish()
	{
		$link = $this->initLink();
		
		$type = JRequest::getVar( 'catid' );

		$view = 0;
		switch ( $type ) {
			case 'sections':
				$view = 'section';
				break;
			case 'categories':
				$view = 'category';
				break;
			case 'content':
				$view = 'article';
				break;
			case 'menu':
				$view = 'menu';
				break;
		}

		if ( !$view ) {
			return $link;
		}
		
		$cid = JRequest::getVar( 'cid', array(0) );
		if( strpos( $cid[0], '|' ) === false ) {
			return $link;
		}

		list( $translationid, $id, $langid ) = explode( '|', $cid[0] );

		$db =& JFactory::getDBO();
		$langActive=null;

		$sql = 'SELECT shortcode FROM #__languages'
			.' WHERE active = 1'
			.' AND id = '.(int) $langid;

		$db->setQuery(  $sql );
		$lang = $db->loadResult();

		if ( $view == 'menu' ) {
			$link = $this->getLinkFromMenu( $id, $lang );
		} else {
			$link = $this->getLinkByContent( $id, $view, $lang );
		}

		return $link;

	}
	function getPublishedParent ( $catid )
	{
		$db =& JFactory::getDBO();

		$itemset = 0;
		$item = '';
		$item->id = $catid;
		$item->published = 0;
		$item->parent = $catid;
		$sql_item = $item;

		while ( $sql_item->parent != 0 ) {
			$query = 'SELECT *'.
				' FROM #__js_res_category'.
				' WHERE id = '.(int) $sql_item->parent.
				' LIMIT 1';
			$db->setQuery( $query );
			$sql_item = $db->loadObject();
			unset( $sql_item->params );
			if ( !$item->published && $sql_item->published ) {
				$item = $sql_item;
			}
			if ( !$sql_item->published ) {
				$item = '';
				$item->published = 0;
			}
		}
		return $item;
	}

	function getLinkFromMenuByComponent( $component )
	{
		$link = $this->initLink();

		// Only check for menuitem on components in both admin and frontend
		$components = $this->getComponentsArray();
		if ( in_array( $component, $components ) ) {
			$db   =& JFactory::getDBO();
			$query = 'SELECT id, link, name, menutype'.
				' FROM #__menu'.
				' WHERE link LIKE "%option='.$component.'%"'.
				' AND published = 1'.
				' LIMIT 1';
			$db->setQuery( $query );
			$menuitem = $db->loadObject();
			if ( isset( $menuitem->id ) ) {
				$query = 'SELECT name'.
					' FROM #__components'.
					' WHERE `option` = "'.$component.'"'.
					' LIMIT 1';
				$db->setQuery( $query );
				$comp = $db->loadResult();
				$link->title = $comp;
				$link->url = $menuitem->link.'&Itemid='.$menuitem->id;
				$link->menu .= $menuitem->name.' ('.$menuitem->menutype.')';
			} else {
				$link->notice[] = JText::_( 'No matching menu item found' );
			}
		}
		return $link;
	}


	function getComponents( $frontend = 1, $admin = 1, $show_content = 0 )
	{
		$db   =& JFactory::getDBO();

		if ( !$frontend && !$admin ) {
			$query = 'SELECT '.$db->NameQuote( 'option' ).', name'.
				' FROM #__components'.
				' WHERE enabled = 1'.
				' AND parent = 0';
				if ( !$show_content ) {
					$query .= ' AND '.$db->NameQuote( 'option' ).' <> "com_content"';
				}
				$query .= ' ORDER BY name';
			$db->setQuery( $query );
			$components = $db->loadObjectList();
		} else {
			if ( $frontend ) {
				// component subs
				$query = 'SELECT parent'.
					' FROM #__components'.
					' WHERE enabled = 1'.
					' AND parent != 0';
					' AND link != ""';
					' ORDER BY ordering, name';
				$db->setQuery( $query );
				$subcomponents = $db->loadResultArray();
				$subcomponents = array_unique( $subcomponents );

				// main components
				$query = 'SELECT id'.
					' FROM #__components'.
					' WHERE enabled = 1'.
					' AND parent = 0'.
					' AND ( link != ""';
					if ( count( $subcomponents ) ) {
						$query .= ' OR id IN ( '.implode( ',', $subcomponents ).' )';
					}
				$query .= ' )';
				$query .= ' ORDER BY ordering, name';
				$db->setQuery( $query );
				$component_ids = $db->loadResultArray();
			}

			if ( $admin ) {
				// component subs
				$query = 'SELECT parent'.
					' FROM #__components'.
					' WHERE enabled = 1'.
					' AND parent != 0';
					' AND admin_menu_link != ""';
				$db->setQuery( $query );
				$subcomponents = $db->loadResultArray();
				$subcomponents = array_unique( $subcomponents );

				// main components
				$query = 'SELECT id'.
					' FROM #__components'.
					' WHERE enabled = 1'.
					' AND parent = 0'.
					' AND ( admin_menu_link != ""';
					if ( count( $subcomponents ) ) {
						$query .= ' OR id IN ( '.implode( ',', $subcomponents ).' )';
					}
				$query .= ' )';
				$db->setQuery( $query );
				if ( $frontend ) {
					$component_ids = array_intersect( $component_ids, $db->loadResultArray() );
				} else {
					$component_ids = $db->loadResultArray();
				}
			}

			$component_ids = array_unique( $component_ids );
			$query = 'SELECT '.$db->NameQuote( 'option' ).', name' .
				' FROM #__components' .
				' WHERE enabled = 1' .
				' AND parent = 0';
				if ( count( $component_ids ) ) {
					$query .= ' AND id IN ( '.implode( ',', $component_ids ).' )';
				}
				if ( !$show_content ) {
					$query .= ' AND '.$db->NameQuote( 'option' ).' <> "com_content"';
				}
			$query .= ' ORDER BY name';
			$db->setQuery( $query );
			$components = $db->loadObjectList();
		}

		return $components;
	}

	function getComponentsArray( $frontend = 1, $admin = 1, $show_content = 0 )
	{
		$components = $this->getComponents( $frontend, $admin, $show_content );
		$components = array();
		foreach ( $components as $component ) {
			$components[] = $component->option;
		}
		return $components;
	}

	function getParamValues( &$params )
	{
		$values = '';
		if ( isset( $params->_xml ) ) {
			foreach ( $params->_xml as $xml_group ) {
				foreach ( $xml_group->children() as $xml_child ) {
					$key = $xml_child->attributes('name');
					if ( !empty( $key ) && $key['0'] != '@' ) {
						$val = $params->get( $key );
						if ( !is_array( $val ) && !strlen( $val ) ) {
							$val = $xml_child->attributes('default');
							if ( $xml_child->attributes('type') == 'textarea' ) {
								$val = str_replace( '<br />', "\n", $val );
							}
						}
						$values->$key = $val;
					}
				}
			}
		}

		return $values;
	}

}

// PHP4 compatiblility for cloning objects
if ( phpversion() < '5.0.0' && !function_exists( 'clone' ) ) {
	eval('
		function clone( $object ) {
			return $object;
		}
	');
}