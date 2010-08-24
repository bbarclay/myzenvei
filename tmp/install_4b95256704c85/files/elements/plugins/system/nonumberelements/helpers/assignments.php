<?php
/**
 * NoNumber! Elements Helper File: Assignments
 *
 * @package     NoNumber! Elements
 * @version     1.2.12
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Assignments
* $assignment = no / include / exclude / none
*/
class NoNumberElementsAssignmentsHelper
{
	var $_db = null;
	var $_params = null;
	var $_types = array();

	function NoNumberElementsAssignmentsHelper()
	{
		$this->_db =& JFactory::getDBO();
		
		$this->_types = array(
			'MenuItem',
			'SecsCats',
			'Categories_K2',
			'Articles',
			'Components',
			'URL',
			'Date',
			'UserGroupLevels',
			'Users',
			'Languages',
			'Templates',
			'PHP'
		);

		$this->_params->option = JRequest::getCmd( 'option' );
		$this->_params->view = JRequest::getCmd( 'view' );
		$this->_params->task = JRequest::getCmd( 'task' );
		$this->_params->id = JRequest::getInt( 'id' );
		$this->_params->Itemid = JRequest::getInt( 'Itemid' );
	}

	function initParams( &$params, $type = '' )
	{
		if ( !isset( $params->assignment ) ) {
			$params->assignment = 'all';
		}
		if ( !isset( $params->selection ) || ( !is_array( $params->selection ) && trim( $params->selection ) == null ) ) {
			$params->selection = array();
		} else if ( !is_array( $params->selection ) ) {
			$params->selection = array_map( 'trim', array_map( 'strtolower', explode( ',', trim( $params->selection ) ) ) );
		}
		if ( !isset( $params->params ) ) {
			$params->params = null;
		}
		switch ( $type ) {
			case 'MenuItem':
				if ( !isset( $params->params->inc_children ) ) {
					$params->params->inc_children = 0;
				}
				if ( !isset( $params->params->inc_noItemid ) ) {
					$params->params->inc_noItemid = 0;
				}
				break;
			case 'SecsCats':
				if ( !isset( $params->params->inc_children ) ) {
					$params->params->inc_children = 1;
				}
				if ( !isset( $params->params->inc_sections ) ) {
					$params->params->inc_sections = 1;
				}
				if ( !isset( $params->params->inc_categories ) ) {
					$params->params->inc_categories = 1;
				}
				if ( !isset( $params->params->inc_articles ) ) {
					$params->params->inc_articles = 1;
				}
				if ( !isset( $params->params->inc_others ) ) {
					$params->params->inc_others = 0;
				}
				break;
			case 'Categories_K2':
				if ( !isset( $params->params->inc_children ) ) {
					$params->params->inc_children = 0;
				}
				if ( !isset( $params->params->inc_categories ) ) {
					$params->params->inc_categories = 1;
				}
				if ( !isset( $params->params->inc_items ) ) {
					$params->params->inc_items = 1;
				}
				break;
			case 'Date':
				if ( !isset( $params->params->publish_up ) ) {
					$params->params->publish_up = 0;
				}
				if ( !isset( $params->params->publish_down ) ) {
					$params->params->publish_down = 0;
				}
				break;

		}
	}

	function passAll( &$params, $match_method = 'and', $article = 0 )
	{
		if ( empty( $params ) ) {
			return 1;
		}

		// if no id is found, check if menuitem exists to get view and id
		if ( !$this->_params->option || !$this->_params->id ) {
			$menu =& JSite::getMenu();
			if ( empty( $this->_params->Itemid ) ) {
				$menuItem =& $menu->getActive();
			} else {
				$menuItem =& $menu->getItem( $this->_params->Itemid );
			}
			$this->_params->option = ( empty( $menuItem->query['option'] ) ) ? null : $menuItem->query['option'];
			$this->_params->view = ( empty( $menuItem->query['view'] ) ) ? null : $menuItem->query['view'];
			$this->_params->task = ( empty( $menuItem->query['task'] ) ) ? null : $menuItem->query['task'];
			$this->_params->id = ( empty( $menuItem->query['id'] ) ) ? null : $menuItem->query['id'];
			unset( $menuItem );
		}

		$pass = ( $match_method == 'and' ) ? 1 : 0;
		foreach ( $this->_types as $type ) {
			if ( isset( $params[$type] ) ) {
				$this->initParams( $params[$type], $type );
				$func = 'pass'.$type;
				if ( ( $pass && $match_method == 'and' ) || ( !$pass && $match_method == 'or' ) ) {
					$pass = $this->$func( $params[$type]->params, $params[$type]->selection, $params[$type]->assignment, $article );
				}
			}
		}
		return ( $pass ) ? 1 : 0;
	}

	/**
	 * passSimple
	 * @param <string> $value
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passSimple( $values = '', $selection = array(), $assignment = 'all' )
	{
		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		if ( !is_array ( $values ) ) {
			$values = explode( ',', $values );
		}
		if ( !is_array ( $selection ) ) {
			$selection = explode( ',', $selection );
		}

		$pass = 0;
		foreach ( $values as $value ) {
			if ( in_array( $value, $selection ) ) {
				$pass = 1;
				break;
			}
		}

		if ( $pass ) {
			return ( $assignment == 'include' );
		} else {
			return ( $assignment == 'exclude' );
		}
	}

	/**
	 * passMenuItems
	 * @param <object> $params
	 * inc_children
	 * inc_noItemid
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passMenuItem( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$pass = 0;
		if ( $this->_params->Itemid ) {
			$pass = in_array( $this->_params->Itemid, $selection );
			if ( !$pass && $params->inc_children ) {
				$parentids = $this->getMenuItemParentIds( $this->_params->Itemid );
				foreach ( $parentids as $parent ) {
					if ( in_array( $parent, $selection ) ) {
						$pass = 1;
						break;
					}
				}
				unset( $parentids );
			}
		} else if ( $params->inc_noItemid ) {
			$pass = 1;
		}

		if ( $pass ) {
			return ( $assignment == 'include' );
		} else {
			return ( $assignment == 'exclude' );
		}

	}

	/**
	 * passSecsCats
	 * @param <object> $params
	 * inc_children
	 * inc_sections
	 * inc_categories
	 * inc_articles
	 * inc_others
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passSecsCats( &$params, $selection = array(), $assignment = 'all', $article = 0 )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		// components that use the com_content secs/cats
		$components = array( 'com_content' );
		if ( !in_array( $this->_params->option, $components ) ) {
			return 0;
		}

		if ( !is_array( $selection ) ) {
			$selection = explode( ',', $selection );
		}

		if ( empty( $selection ) ) {
			return ( $assignment == 'exclude' );
		}

		$inc = (
				( $params->inc_sections && $this->_params->option == 'com_content' && $this->_params->view == 'section' )
			||	( $params->inc_categories && $this->_params->option == 'com_content' && $this->_params->view == 'category' )
			||	( $params->inc_articles && $this->_params->option == 'com_content' && $this->_params->view == 'article' )
			||	( $params->inc_others && !( $this->_params->option == 'com_content' && ( $this->_params->view == 'section' || $this->_params->view == 'category' || $this->_params->view == 'article' ) ) )
		);

		$pass = 0;
		if ( $inc ) {
			$cats_lookup_all = array();
			$cats_lookup = array();
			$secs = array();
			$cats = array();
			foreach ( $selection as $seccat ) {
				$seccat = explode( '.', $seccat );
				if ( count( $seccat ) > 1 ) {
					// category
					$cats[] = $seccat['1'];
				} else {
					// section
					$secs[] = $seccat['0'];
					if ( $params->inc_children ) {
						$query = 'SELECT id'
							.' FROM #__categories'
							.' WHERE section = '.(int) $seccat['0'];
						$this->_db->setQuery( $query );
						$categories = $this->_db->loadResultArray();
						if ( !is_array( $categories ) ) {
							$categories = array();
						}
						$cats = array_merge( $cats, $categories );
					}
				}
			}

			if ( $params->inc_others && !( $this->_params->option == 'com_content' && ( $this->_params->view == 'section' || $this->_params->view == 'category' || $this->_params->view == 'article' ) ) ) {
				if ( $article ) {
					if ( !isset( $article->id ) ) {
						if ( isset( $article->slug ) ) {
							$article->id = (int) $article->slug;
						}
					}
					if ( !isset( $article->catid ) ) {
						if ( isset( $article->catslug ) ) {
							$article->catid = (int) $article->catslug;
						}
					}
					$this->_params->id = $article->id;
					$this->_params->view = 'article';
				}
			}

			switch( $this->_params->view ) {
				case 'section':
					$pass = in_array( $this->_params->id, $secs );
					break;
				case 'category':
					$pass = in_array( $this->_params->id, $cats );
					break;
				case 'article':
					if ( !$article ) {
						$article =& JTable::getInstance( 'content' );
						$article->load( $this->_params->id );
					}
					if ( $article->catid ) {
						$pass = in_array( $article->catid, $cats );
					} else {
						$catid					= JRequest::getInt( 'catid' );
						$filter_sectionid		= JRequest::getInt( 'filter_sectionid' );
						if ( $catid && $catid !== -1 ) {
							$pass = in_array( $catid, $cats );
						} else if ( $filter_sectionid !== '' &&  $filter_sectionid !== -1 ) {
							$pass = in_array( $filter_sectionid, $secs );
						}
					}
					break;
			}
		}

		if ( $pass ) {
			return ( $assignment == 'include' );
		} else {
			return ( $assignment == 'exclude' );
		}
	}

	/**
	 * passSecsCats
	 * @param <object> $params
	 * inc_children
	 * inc_categories
	 * inc_items
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passCategories_K2( &$params, $selection = array(), $assignment = 'all', $article = 0 )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		if ( $this->_params->option != 'com_k2' ) {
			return ( $assignment == 'exclude' );
		}

		if ( !is_array( $selection ) ) {
			$selection = explode( ',', $selection );
		}

		$pass = (
				( $params->inc_categories && $this->_params->view == 'itemlist' && $this->_params->task == 'category' )
			||	( $params->inc_items && $this->_params->view == 'item' )
		);

		if ( !$pass ) {
			return ( $assignment == 'include' );
		}

		if ( $article && isset( $article->catid ) ) {
			$cats = $article->catid;
		} else {
			switch ( $this->_params->view ) {
				case 'itemlist':
					$cats = $this->_params->id;
					break;
				case 'item':
				default:
					$query = 'SELECT catid'
						.' FROM #__k2_items'
						.' WHERE id = '.(int) $this->_params->id
						.' LIMIT 1';
					$this->_db->setQuery( $query );
					$cats = $this->_db->loadResult();
					break;
			}
		}

		if ( $params->inc_children && $cats ) {
			$cats = array_merge( array( $cats ), $this->getK2CatParentIds( $cats ) );
		}

		return $this->passSimple( $cats, $selection, $assignment );
	}

	/**
	 * passArticles
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passArticles( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $this->_params->option != 'com_content' && $this->_params->view != 'article' && !$this->_params->id ) {
			return 1;
		}

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		if ( !is_array ( $selection ) ) {
			$selection = explode( ',', $selection );
		}
		if ( !count( $selection ) ) {
			return ( $assignment == 'exclude' );
		}

		if ( in_array( $this->_params->id, $selection ) ) {
			return ( $assignment == 'include' );
		} else {
			return ( $assignment == 'exclude' );
		}
	}

	/**
	 * passComponents
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passComponents( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		return $this->passSimple( $this->_params->option, $selection, $assignment );
	}

	/**
	 * passURL
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passURL( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$url = JFactory::getURI();
		$url = $url->_uri;

		$pass = 0;
		foreach ( $selection as $url_part ) {
			if ( $url_part !== '' ) {
				$url_part = str_replace( '&amp;', '(&amp;|&)', $url_part );
				if ( preg_match( '#'.$url_part.'#si', $url ) ) {
					$pass = 1;
					break;
				}
			}
		}

		if ( $pass ) {
			return ( $assignment == 'include' );
		} else {
			return ( $assignment == 'exclude' );
		}
	}

	/**
	 * passDate
	 * @param <object> $params
	 * publish_up
	 * publish_down
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passDate( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		if ( $params->publish_up || $params->publish_down ) {
			$now =& JFactory::getDate();
			$now = $now->toFormat();
			if ( $publish_up ) {
				$publish_up =& JFactory::getDate($publish_up);
				$publish_up = $publish_up->toFormat();
				if ( $publish_up > $now ) {
					// outside date range
					return ( $assignment == 'exclude' );
				}
			}
			if ( $params->publish_down ) {
				$params->publish_down =& JFactory::getDate($publish_down);
				$params->publish_down = $params->publish_down->toFormat();
				if ( $publish_down < $now ) {
					// outside date range
					return ( $assignment == 'exclude' );
				}
			}
		}
		// no date range set
		return ( $assignment == 'exclude' );
	}

	/**
	 * passUserGroupLevels
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passUserGroupLevels( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$user =& JFactory::getUser();

		if ( in_array( 29, $selection ) ) {
			$selection[] = 18;
			$selection[] = 19;
			$selection[] = 20;
			$selection[] = 21;
		}
		if ( in_array( 30, $selection ) ) {
			$selection[] = 23;
			$selection[] = 24;
			$selection[] = 25;
		}

		return $this->passSimple( $user->get( 'gid' ), $selection, $assignment );
	}

	/**
	 * passUsers
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passUsers( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$user =& JFactory::getUser();

		return $this->passSimple( $user->get( 'id' ), $selection, $assignment );
	}

	/**
	 * passLanguages
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passLanguages( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$lang = JFactory::getLanguage();
		$lang = array( $lang->_lang, strtolower( $lang->_lang ) );

		return $this->passSimple( $lang, $selection, $assignment );
	}

	/**
	 * passTemplates
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passTemplates( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$mainframe =& JFactory::getApplication();
		$template =& $mainframe->getTemplate();

		return $this->passSimple( $template, $selection, $assignment );
	}

	/**
	 * passPHP
	 * @param <object> $params
	 * @param <array> $selection
	 * @param <string> $assignment
	 * @return <bool>
	 */
	function passPHP( &$params, $selection = array(), $assignment = 'all' )
	{
		$this->getAssignmentState( $assignment );

		if ( $assignment == 'all' ) {
			return 1;
		} else if ( $assignment == 'none' ) {
			return 0;
		}

		$pass = 0;
		foreach ( $selection as $php ) {
			$php = '$temp_PHP_Val = create_function( \'\', \''.str_replace( "'", "\'", str_replace( "\\", "\\\\", $php ) ).'\' );';
			$php .= ' $pass = ( $temp_PHP_Val() ) ? 1 : 0; unset( $temp_PHP_Val );';
			@eval( $php );
			if ( $pass ) {
				break;
			}
		}

		if ( $pass ) {
			return ( $assignment == 'include' );
		} else {
			return ( $assignment == 'exclude' );
		}
	}

	/**
	 * getAssignmentState
	 * @param <string> $assignment
	 */
	function getAssignmentState( &$assignment )
	{
		switch ( $assignment ) {
			case 1:
			case 'include':
				$assignment = 'include';
				break;
			case 2:
			case 'exclude':
				$assignment = 'exclude';
				break;
			case 3:
			case -1:
			case 'none':
				$assignment = 'none';
				break;
			default:
				$assignment = 'all';
				break;
		}
	}

	function getMenuItemParentIds( $menu_id = 0 )
	{
		$parent_ids = array();

		if ( !$menu_id ) {
			return $parent_ids;
		}

		while ( $menu_id ) {
			$query = 'SELECT parent'
				.' FROM #__menu'
				.' WHERE id = '. (int) $menu_id
				.' LIMIT 1';
			$this->_db->setQuery( $query );
			$menu_id = $this->_db->loadResult();
			if ( $menu_id ) {
				$parent_ids[] = $menu_id;
			}
		}
		return $parent_ids;
	}

	function getK2CatParentIds( $cat_id = 0 )
	{
		$parent_ids = array();

		if ( !$cat_id ) {
			return $parent_ids;
		}

		while ( $cat_id ) {
			$query = 'SELECT parent'
				.' FROM #__k2_categories'
				.' WHERE id = '. (int) $cat_id
				.' LIMIT 1';
			$this->_db->setQuery( $query );
			$cat_id = $this->_db->loadResult();
			if ( $cat_id ) {
				$parent_ids[] = $cat_id;
			}
		}
		return $parent_ids;
	}
}