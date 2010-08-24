<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class hwdps_BE_cats
{
   /**
	* show categories
	*/
	function showcategories()
	{
		global $option, $mainframe, $limit, $limitstart;
		$db =& JFactory::getDBO();

		$search 		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search 		= addslashes( trim( strtolower( $search ) ) );

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpscategories AS a"
							. "\nWHERE a.published 	>= 0"
							);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$where = array(
		"a.published 	>= 0",
		);

		if ($search) {
			$where[] = "LOWER(a.category_name) LIKE '%$search%'";
				$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpscategories AS a"
							. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
							);
				$total = $db->loadResult();
				echo $db->getErrorMsg();
		}

		$query = "SELECT a.*"
				. "\nFROM #__hwdpscategories AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
    			. "\n GROUP BY a.id"
    			. "\n ORDER BY a.ordering, a.category_name"
    			;
		$db->SetQuery( $query );
		$rows = $db->loadObjectList();


		// establish the hierarchy of the categories
		$children = array ();

		// first pass - collect children
		foreach ($rows as $v)
		{
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array ();
			array_push($list, $v);
			$children[$pt] = $list;
		}

		// second pass - get an indent list of the items
		$list = hwdps_BE_cats::fbTreeRecurse(0, '', array (), $children, '9999');
		$total = count($list);
		require_once (JPATH_SITE . '/administrator/includes/pageNavigation.php');
		$pageNav = new mosPageNav($total, $limitstart, $limit);
		// perform adjustment to pagenav
		$pageNav = new mosPageNav( count($list), $limitstart, $limit );
		// slice out elements based on limits
		$list = array_slice($list, $pageNav->limitstart, $pageNav->limit);



		hwd_ps_HTML::showcategories($list, $pageNav, $search);
	}
function fbTreeRecurse( $id, $indent, $list, &$children, $maxlevel=9999, $level=0, $type=1 ) {

    if (@$children[$id] && $level <= $maxlevel) {
        foreach ($children[$id] as $v) {
            $id = $v->id;
            if ( $type ) {
                $pre     = '&nbsp;';
                $spacer = '...';
            } else {
                $pre     = '- ';
                $spacer = '&nbsp;&nbsp;';
            }

            if ( $v->parent == 0 ) {
                $txt     = $v->category_name;
            } else {
                $txt     = $pre . $v->category_name;
            }
            $pt = $v->parent;
            $list[$id] = $v;
            $list[$id]->treename = "$indent$txt";
            $list[$id]->children = count( @$children[$id] );

            $list = hwdps_BE_cats::fbTreeRecurse( $id, $indent . $spacer, $list, $children, $maxlevel, $level+1, $type );
        }
    }
    return $list;
}


function orderForum($uid, $inc)
{
  	global $mainframe;
  	$db =& JFactory::getDBO();

    $row = new hwdps_cats($db);
    $row->load($uid);
    $row->move($inc, "parent='$row->parent'");

	for ($j=0, $m=20; $j < $m; $j++) {
		$query = 'SELECT id, ordering'
				. ' FROM #__hwdpscategories'
				. ' WHERE parent='.$j
				. ' ORDER BY ordering ASC'
				;

		$db->SetQuery($query);
		$rows = $db->loadObjectList();

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$cid = (int)$rows[$i]->id;

			// update ordering
			$db->SetQuery("UPDATE #__hwdpscategories SET ordering = $i WHERE id = $cid");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
	}

	$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=categories' );
}

function catTreeRecurse($id, $indent = "&nbsp;&nbsp;&nbsp;", $list, &$children, $maxlevel = 9999, $level = 0, $seperator = " >> ")
{
    if (@$children[$id] && $level <= $maxlevel)
    {
        foreach ($children[$id] as $v)
        {
            $id = $v->id;
            $txt = $v->category_name;
            $pt = $v->parent;
            $list[$id] = $v;
            $list[$id]->treename = "$indent$txt";
            $list[$id]->children = count(@$children[$id]);
            $list = hwdps_BE_cats::catTreeRecurse($id, "$indent$txt$seperator", $list, $children, $maxlevel, $level + 1);
        //$list = hwdps_BE_cats::catTreeRecurse( $id, "*", $list, $children, $maxlevel, $level+1 );
        }
    }

    return $list;
}
   /**
	* edit categories
	*/
	function editcategories($cid)
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		$row = new hwdps_cats( $db );
		$row->load( $cid );

		// fail if checked out not by 'me'
		if ($row->isCheckedOut( $my->id )) {
			//BUMP needs change for multilanguage support
			mosRedirect( 'index.php?option='.$option.'&task=categories', 'The categorie $row->catname is currently being edited by another administrator.' );
		}

		$db->SetQuery("SELECT * FROM #__hwdpscategories"
							. "\nWHERE id = $cid");
		$db->loadObject($row);

		if ($cid) {
			$row->checkout( $my->id );
		} else {
			$row->published = 1;
		}

		$gtree=array();
		$gtree[] = JHTML::_('select.option', -2 , '- ' ._HWDPS_SELECT_EVERYONE . ' -');	// '- Everybody -'
		$gtree[] = JHTML::_('select.option', -1, '- ' . _HWDPS_SELECT_ALLREGUSER . ' -'); // '- All Registered Users -'
		$gtree = array_merge( $gtree, $acl->get_group_children_tree( null, 'USERS', false ));

    	$categoryList = hwd_ps_tools::categoryList(_HWDPS_SELECT_NOPAR, $row->parent, _HWDPS_SELECT_NOCATS, 0, "parent", 0);

		hwd_ps_HTML::editcategories($row, $gtree, $categoryList);
	}
	/**
	 * save categories
	 */
	function savecategories()
	{
		global $mainframe;
		$db = & JFactory::getDBO();

		$access_lev_u = Jrequest::getVar( 'access_lev_u', '0' );
		$access_lev_v = Jrequest::getVar( 'access_lev_v', '0' );

		$row = new hwdps_cats($db);

		if (intval($_POST['id']) !== 0 && (intval($_POST['id']) == intval($_POST['parent']))) {
			$mainframe->enqueueMessage(_HWDVIDS_ALERT_PARENTNOTSELF);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=categories' );
		}

		$_POST['category_name'] = Jrequest::getVar( 'category_name', 'no name supplied' );
		$_POST['category_description'] = Jrequest::getVar( 'category_description', 'no name supplied' );
		$_POST['access_lev_u'] = @implode(",", $access_lev_u);
		$_POST['access_lev_v'] = @implode(",", $access_lev_v);

		// bind it to the table
		if (!$row -> bind($_POST)) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		if(empty($row->category_name)) {
			mosRedirect("index.php?option=$option&task=categories", _HWDPS_ALERT_NOCNAME." "); }

		// store it in the db
		if (!$row -> store()) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		$row->checkin();

		// perform maintenance
		include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
		hwd_ps_recount::recountSubcatsInCategory();

		$mainframe->enqueueMessage(_HWDPS_ALERT_CATSAVED);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=categories' );
	}
	/**
	 * cancel categories
	 */
	function cancelcat()
	{
		global $mainframe;
  		$db =& JFactory::getDBO();
		$row = new hwdps_cats( $db );
		$row->bind( $_POST );
		$row->checkin();

		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=categories' );
	}
	/**
	 * delete categories
	 */
	function deletecategories($cid)
	{
		global $mainframe;
		$db = & JFactory::getDBO();

		$total = count( $cid );
		$catego = join(",", $cid);

		//Check for videos in the category
		$db->setQuery("SELECT category_id FROM #__hwdpsphotos");
		$result = $db->Query();
		while($row = mysql_fetch_assoc($result)) {
		if ($row['category_id'] == $catego) {
			mosRedirect("index.php?option=$option&task=categories", _HWDPS_ALERT_CATCONTAINSVIDS." "); }
		}

		//If no videos in category proceed to delete the category
		$db->SetQuery("DELETE FROM #__hwdpscategories WHERE id IN ($catego)");
		$db->Query();

		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = $total ._HWDPS_ALERT_ADMIN_CATDEL." ";

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=categories' );
	}
	/**
	 * publish/unpublish categories
	 */
	function publishcategory( $cid=null, $publishcat=1 ) {
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (!is_array( $cid ) || count( $cid ) < 1) {
			$action = $publishcat ? 'publishcat' : 'unpublishcat';
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}
		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpscategories"
						. "\nSET published =". intval( $publishcat )
						. "\nWHERE id IN ( $cids )"
						. "\nAND ( checked_out = 0 OR ( checked_out = $my->id ) )"
						);

		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		switch ( $publishcat ) {
			case 1:
				$msg = $total ._HWDPS_ALERT_ADMIN_CATPUB." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDPS_ALERT_ADMIN_CATUNPUB." ";
				break;
		}

		if (count( $cid ) == 1) {
			$row = new hwdps_cats( $db );
			$row->checkin( $cid[0] );
		}
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=categories' );
	}
}
?>