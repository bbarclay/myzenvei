<?php
/**
 * @version $Id: j15.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Joomla 1.0->1.5 Compatibility Layer
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

if ( !defined('_JEXEC') ) {
	if ( defined( '_JLEGACY' ) ) {
		if ( _JLEGACY == '1.0' ) {
			return;
		}
	}

	if ( !defined( 'JPATH_SITE' ) ) {
		global $mosConfig_absolute_path;

		define( 'JPATH_SITE', $mosConfig_absolute_path );
	}

	if ( !class_exists( 'JURI' ) ) {
		class JURI
		{
		    function base( $pathonly=false ) {
		        global $mosConfig_live_site;

				if ( $pathonly ) {
					return $mosConfig_live_site;
				} else {
					return $mosConfig_live_site . '/administrator/';
				}
		    }

		    function root( $pathonly=false, $path=null ) {
		        global $mosConfig_live_site;

				return $mosConfig_live_site . '/';
		    }
		}
	}

	// Check whether we are on 1.5, otherwise load in some classes
	if ( !class_exists( 'JObject' ) ) {
		//require_once( JPATH_SITE . '/components/com_acctexp/lib/j15/general.php' );
		require_once( JPATH_SITE . '/components/com_acctexp/lib/j15/object.php' );
	}

	if ( !class_exists( 'JTable' ) && class_exists( 'mosDBTable' ) ) {
		class JTable extends mosDBTable
		{
		    function __construct( $table, $key, &$database ) {
		        $this->mosDBTable( $table, $key, $database );
		    }

		    function reorder( $where='' ) {
				return $this->updateOrder();
		    }
		}
	}

	if ( !function_exists( 'loadoverlib' ) ) {
		function loadoverlib()
		{
			return mosCommonHTML::loadoverlib();
		}
	}

	if ( !class_exists( 'JFactory' ) ) {
		class dummyLangClass
		{
		    function load()
		    {
				return true;
		    }
		}

		class JFactory
		{
		    function getDBO()
		    {
		        global $database;

				return $database;
		    }

			function getUser()
			{
				global $my;

				return $my;
			}

			function getACL()
			{
				global $acl;

				return $acl;
			}

			function getLanguage()
			{
				$lang = new dummyLangClass();

				return $lang;
			}
		}
	}

	if ( !class_exists( 'JDatabase' ) ) {
		class JDatabase
		{
		    function getInstance( $options )
		    {
				return new database( $options['dbhost'], $options['dbuser'], $options['dbpasswd'], $options['dbname'], $options['table_prefix'] );;
		    }
		}
	}

	if ( !class_exists( 'JToolBarHelper' ) ) {
		if ( !class_exists( 'mosMenuBar' ) ) {
			global $mosConfig_absolute_path;

			require_once( $mosConfig_absolute_path . '/administrator/includes/menubar.html.php' );
		}

		class JToolBarHelper extends mosMenuBar
		{}
	}

	if ( !class_exists( 'JTableUser' ) && class_exists( 'mosUser' ) ) {
		class JTableUser extends mosUser
		{}
	}

	if ( !class_exists( 'JParameter' ) ) {
		class JParameter extends mosParameters
		{}
	}

	if ( !class_exists( 'JPaneTabs' ) ) {
		class JPaneTabs extends mosTabs
		{
			var $useCookies = false;

			function __construct( $useCookies, $xhtml = null) {
				parent::__construct( array('useCookies' => $useCookies) );
			}

			function startPanel( $tabText, $paneid ) {
				echo $this->startTab( $tabText, $paneid);
			}

			function endPanel() {
				echo $this->endTab();
			}
		}
	}

} else {
	// Replace sefRelToAbs the other way round
	if ( !function_exists( 'sefRelToAbs' ) ) {
		function sefRelToAbs($value)
		{
			// Replace all &amp; with & as the router doesn't understand &amp;
			$url = str_replace('&amp;', '&', $value);
			if(substr(strtolower($url),0,9) != "index.php") return $url;
			$uri    = JURI::getInstance();
			$prefix = $uri->toString(array('scheme', 'host', 'port'));
			return $prefix.JRoute::_($url);
		}
	}

	JLoader::register('JTableUser', JPATH_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table'.DS.'user.php');

	$lang =& JFactory::getLanguage();
	$GLOBALS['mosConfig_lang']          = $lang->getBackwardLang();

	if ( !function_exists( 'loadoverlib' ) ) {
		function loadOverlib() {
			JHTML::_('behavior.tooltip');
		}
	}

	if ( !function_exists( 'mosErrorAlert' ) ) {
		function mosErrorAlert( $text, $action='window.history.go(-1);', $mode=1 )
		{
			global $mainframe;

			$text = strip_tags( addslashes( nl2br( $text ) ) );

			switch ( $mode ) {
				case 2:
					echo "<script>$action</script> \n";
					break;

				case 1:
				default:
					echo "<script>alert('$text'); $action</script> \n";
					echo '<noscript>';
					echo "$text\n";
					echo '</noscript>';
					break;
			}

			$mainframe->close();
		}
	}


	if ( !function_exists( 'editorArea' ) ) {
		function editorArea($name, $content, $hiddenField, $width, $height, $col, $row)
		{
			jimport( 'joomla.html.editor' );
			$editor =& JFactory::getEditor();
			echo $editor->display($hiddenField, $content, $width, $height, $col, $row);
		}
	}

	if ( !function_exists( 'getEditorContents' ) ) {
		function getEditorContents($editorArea, $hiddenField)
		{
			jimport( 'joomla.html.editor' );
			$editor =& JFactory::getEditor();
			echo $editor->save( $hiddenField );
		}
	}

	if ( !class_exists( 'mosHTML' ) ) {
		/**
		 * Legacy class, use {@link JHTML} instead
		 *
		 * @deprecated	As of version 1.5
		 * @package	Joomla.Legacy
		 * @subpackage	1.5
		 */
		class mosHTML
		{
			/**
		 	 * Legacy function, use {@link JHTML::_('select.option')} instead
		 	 *
		 	 * @deprecated	As of version 1.5
		 	 */
			function makeOption( $value, $text='', $value_name='value', $text_name='text' )
			{
				return JHTML::_('select.option', $value, $text, $value_name, $text_name);
			}

			/**
		 	 * Legacy function, use {@link JHTML::_('select.genericlist')} instead
		 	 *
		 	 * @deprecated	As of version 1.5
		 	 */
			function selectList( &$arr, $tag_name, $tag_attribs, $key, $text, $selected=NULL, $idtag=false, $flag=false )
			{
				return JHTML::_('select.genericlist', $arr, $tag_name, $tag_attribs, $key, $text, $selected, $idtag, $flag );
			}

			/**
		 	 * Legacy function, use {@link JHTML::_('select.radiolist')} instead
		 	 *
		 	 * @deprecated	As of version 1.5
		 	 */
			function radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text', $idtag=false )
			{
				return JHTML::_('select.radiolist', $arr, $tag_name, $tag_attribs, $key, $text,  $selected, $idtag) ;
			}

			/**
		 	 * Legacy function, deprecated
		 	 *
		 	 * @deprecated	As of version 1.5
		 	 */
			function treeSelectList( &$src_list, $src_id, $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected )
			{

				// establish the hierarchy of the menu
				$children = array();
				// first pass - collect children
				foreach ($src_list as $v ) {
					$pt = $v->parent;
					$list = @$children[$pt] ? $children[$pt] : array();
					array_push( $list, $v );
					$children[$pt] = $list;
				}
				// second pass - get an indent list of the items
				$ilist = JHTML::_('menu.treerecurse', 0, '', array(), $children );

				// assemble menu items to the array
				$this_treename = '';
				foreach ($ilist as $item) {
					if ($this_treename) {
						if ($item->id != $src_id && strpos( $item->treename, $this_treename ) === false) {
							$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
						}
					} else {
						if ($item->id != $src_id) {
							$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
						} else {
							$this_treename = "$item->treename/";
						}
					}
				}
				// build the html select list
				return mosHTML::selectList( $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected );
			}

			/**
		 	 * Legacy function, deprecated
		 	 *
		 	 * @deprecated	As of version 1.5
		 	 */
			function yesnoSelectList( $tag_name, $tag_attribs, $selected, $yes='yes', $no='no' )
			{
				$arr = array(
					mosHTML::makeOption( 0, JText::_( $no ) ),
					mosHTML::makeOption( 1, JText::_( $yes ) ),
				);

				return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', (int) $selected );
			}

			/**
		 	 * Legacy function, use {@link JHTML::_('grid.id')} instead
		 	 *
		 	 * @deprecated	As of version 1.5
		 	 */
			function idBox( $rowNum, $recId, $checkedOut=false, $name='cid' )
			{
				return JHTML::_('grid.id', $rowNum, $recId, $checkedOut, $name);
			}
		}
	}
}

?>
