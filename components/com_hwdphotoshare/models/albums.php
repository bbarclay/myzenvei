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

/**
 * This class is the HTML generator for hwdphotoshare frontend
 *
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_albums
{
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function albums()
  {
    global $mainframe, $limitstart, $hwdps_selecta, $hwdps_joina;
    $c = hwd_ps_Config::get_instance();
    $my = & JFactory::getUser();
      $db =& JFactory::getDBO();

    $limit   = intval($c->app);

    $where = ' WHERE album.published = 1';
    $where .= ' AND album.approved = "yes"';
    if (!$my->id) {
    $where .= ' AND album.privacy = "public"';
    }

	$sort = JRequest::getWord( 'sort' );
	// switch for task function
	switch ($sort)
	{
	  /** upload functions */
	  case 'featured':
		$order = ' ORDER BY album.date_modified DESC';
		break;

	  case 'recent':
		$order = ' ORDER BY album.date_created DESC';
		break;

	  case 'updated':
		$order = ' ORDER BY album.date_modified DESC';
		break;

	  case 'biggest':
		$order = ' ORDER BY album.number_of_photos DESC';
		break;

	  default:
		$order = ' ORDER BY album.date_modified DESC';
		break;
	}

    $db->SetQuery( 'SELECT count(*)'
              . ' FROM #__hwdpsalbums AS album'
              . $where
              );
    $total = $db->loadResult();
    echo $db->getErrorMsg();

	$pageNav = new JPagination( $total, $limitstart, $limit );

    //Groups that are published
    $query = 'SELECT'.$hwdps_selecta
        . ' FROM #__hwdpsalbums AS album'
        . $hwdps_joina
        . $where
        . $order
        ;

    $db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
    $rows = $db->loadObjectList();

    hwd_ps_html::albums($rows, $pageNav, $total, $sort);
  }
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
  function createAlbum()
  {
    global $database, $my, $mosConfig_live_site, $Itemid, $acl;
    $my = & JFactory::getUser();
    $c = hwd_ps_Config::get_instance();

    if (!$my->id) {
          hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_LOG2ADDA, "exclamation.png", 0);
      return;
    }

    hwd_ps_html::createAlbum();
  }
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
  function deleteAlbum()
  {
    global $database, $my, $mainframe, $Itemid, $acl;
    $c = hwd_ps_Config::get_instance();
      $db =& JFactory::getDBO();
    $my = & JFactory::getUser();

    $uid = JRequest::getInt( 'uid', 0 );
    $aid = JRequest::getInt( 'aid', 0 );

    if (intval($uid) !== intval($my->id)) {
      $msg = _HWDPS_ALERT_LOG2REMG;
      mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdphotoshare&task=groups&Itemid=".$Itemid, $msg );
    }

    $query = ' SELECT *'
        .' FROM #__hwdpsphotos'
        .' WHERE album_id = '.$aid
        ;
    $db->SetQuery($query);
      $rows = $db->loadObjectList();


    for ($i=0, $n=count($rows); $i < $n; $i++) {
      $row = $rows[$i];

      hwd_ps_tools::deletePhotoFiles($row);
    }

    $db->SetQuery("DELETE FROM #__hwdpsalbums WHERE id = $aid AND user_id = $my->id");
    $db->Query();
    if ( !$db->query() ) {
      echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
    exit();
    }

    $db->SetQuery("DELETE FROM #__hwdpsphotos WHERE album_id = $aid");
    $db->Query();
    if ( !$db->query() ) {
      echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
    exit();
    }



    //$db->SetQuery("DELETE FROM #__hwdpsgroup_membership WHERE groupid = $groupid");
    //$db->Query();
    //if ( !$db->query() ) {
    //  echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
    //exit();
    //}

    //$db->SetQuery("DELETE FROM #__hwdpsgroup_photos WHERE groupid = $groupid");
    //$db->Query();
    //if ( !$db->query() ) {
    //  echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
    //exit();
    //}

    $msg = _HWDPS_ALERT_AREMOVED;
    $mainframe->enqueueMessage($msg);
    $mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=yourphotos&Itemid='.$Itemid );
  }
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
  function viewAlbum()
  {
    global $database, $mainframe, $mosConfig_live_site, $limitstart, $my, $Itemid, $hwdps_selecta, $hwdps_joina, $hwdps_selectp, $hwdps_joinp;
      $db =& JFactory::getDBO();
    $my = & JFactory::getUser();
    $c = hwd_ps_Config::get_instance();

    $album_id = JRequest::getInt( 'album_id', 0 );

    $limit   = intval($c->ppp);

    $where = ' WHERE album.published = 1';
    $where .= ' AND album.approved = "yes"';
    $where .= ' AND album.id = '.(int)$album_id;
    if (!$my->id) {
    $where .= ' AND album.privacy = "public"';
    }

    //Check album exists and get details
    $db->SetQuery( 'SELECT'.$hwdps_selecta
            . ' FROM #__hwdpsalbums AS album'
            . $hwdps_joina
            . $where
              );

    $albumdetails = $db->loadObject();

    if ( count($albumdetails)==0 ) {
		echo "This album does not exist";
		return;
    }

    $where = ' WHERE published = 1';
    $where.= ' AND approved = "pending"';
    $where.= ' AND album_id = '.$album_id;

    $db->SetQuery( 'SELECT count(*)'
              . ' FROM #__hwdpsphotos'
              . $where
              );
    $total_pending = $db->loadResult();
    echo $db->getErrorMsg();

    $where = ' WHERE published = 1';
    $where .= ' AND approved = "yes"';
    $where .= ' AND album_id = '.$album_id;

    $db->SetQuery( 'SELECT count(*)'
              . ' FROM #__hwdpsphotos'
              . $where
              );
    $total = $db->loadResult();
    echo $db->getErrorMsg();

	$pageNav = new hwdpsPageNav( $total, $limitstart, $limit );

    $where = ' WHERE photo.published = 1';
    $where .= ' AND photo.approved = "yes"';
    $where .= ' AND photo.album_id = '.$album_id;

    //Videos that are approved(converted) and published in this group
    $query = 'SELECT'.$hwdps_selectp
        . ' FROM #__hwdpsphotos AS photo'
        . $hwdps_joinp
        . $where
        . ' ORDER BY ordering ASC'
        ;

    $db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
    $rows = $db->loadObjectList();

    hwd_ps_html::viewAlbum($rows, $pageNav, $total, $albumdetails, $total_pending);
  }
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function saveAlbum()
  {
    global $option, $mainframe, $params, $Itemid, $mosConfig_absolute_path, $database, $my, $acl, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $mosConfig_sitename;
    $c = hwd_ps_Config::get_instance();


    if ($c->disablecaptcha == "0") {

		$security_code = JRequest::getCmd( 'security_code' );

		$sessid = session_id();
		if (empty($sessid)) {
			session_start();
		}

		if(($_SESSION['security_code'] == $security_code) && (!empty($_SESSION['security_code'])) ) {
			hwd_ps_albums::bindNewAlbum($option);
			unset($_SESSION['security_code']);
		} else {
			hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_ALBUMFAIL, _HWDPS_ALERT_ERRSC, "exclamation.png", 0);
			return;
		}

    } else {

       hwd_ps_albums::bindNewAlbum();

    }
  }
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function bindNewAlbum()
  {
    global $option, $mainframe, $params, $Itemid, $mosConfig_absolute_path, $database, $my, $acl, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $mosConfig_sitename;
    $c = hwd_ps_Config::get_instance();
      $db =& JFactory::getDBO();
    $my = & JFactory::getUser();

      $album_name     = Jrequest::getVar( 'album_name', 'no name supplied', 'request' );
      $album_description  = Jrequest::getVar( 'album_description', 'no name supplied', 'request' );
      $category_id     = JRequest::getInt( 'category_id', 0, 'post' );
      $privacy       = JRequest::getWord( 'privacy' );
      $allow_comments   = JRequest::getInt( 'allow_comments', 0, 'post' );
      $allow_ratings     = JRequest::getInt( 'allow_ratings', 0, 'post' );
      $featured      = 0;
      $adminid            = $my->id;
      if ($c->aag == 1) {
        $published = 1;
      } else {
        $published = 0;
      }

      $checkform = hwd_ps_tools::checkAlbumFormComplete( $album_name, $album_description, $allow_comments );
      if (!$checkform) { return; }

      $row = new hwdpsalbums($db);

      $_POST['title']           = $album_name;
      $_POST['description']     = $album_description;
      $_POST['category_id']     = $category_id;
      $_POST['allow_comments']  = $allow_comments;
      $_POST['privacy']         = $privacy;
      $_POST['user_id']         = $my->id;
      $_POST['date_created']    = date('Y-m-d H:i:s');
      $_POST['date_modified']   = date('Y-m-d H:i:s');
      $_POST['featured']        = 0;
      $_POST['published']       = $published;

      if ($c->aaa == 1) {
        $_POST['approved'] = "yes";
      } else {
        $_POST['approved'] = "pending";
      }

      // bind it to the table
      if (!$row -> bind($_POST)) {
        echo "<script> alert('"
          .$row -> getError()
          ."'); window.history.go(-1); </script>\n";
        exit();
      }

      // store it in the db
      if (!$row -> store()) {
        echo "<script> alert('"
          .$row -> getError()
          ."'); window.history.go(-1); </script>\n";
        exit();
      }

      // mail admin notification
      if ($c->mailalbumnotification == 1) {
		$jconfig = new jconfig();
        $mailbody = ""._HWDPS_MAIL_BODY0.$jconfig->sitename.".\n";
        $mailbody .= ""._HWDPS_MAIL_BODY1."\"".stripslashes($album_name)."\".\n";
        if (isset($row->id)) {
          $mailbody .= "".JURI::root()."index.php?option=com_hwdphotoshare&task=viewalbum&Itemid=".$Itemid."&album_id=".$row->id."\n";
        }
        $mailbody .= "\n"._HWDPS_MAIL_BODY2."\n";
        $mailbody .= JURI::root()."administrator";

        JUtility::sendMail( $jconfig->mailfrom, $jconfig->fromname, $c->mailnotifyaddress, _HWDPS_MAIL_SUBJECT1.$jconfig->sitename.' ', $mailbody );
      }

      if ($c->aag == 1) {
        $msg = _HWDPS_ALERT_ASAVED;
      } else {
        $msg = _HWDPS_ALERT_APENDING;
      }

    // perform maintenance
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
    hwd_ps_recount::recountAlbumsInCategory($row->category_id);

    $msg = _HWDPS_ALERT_ASAVED;
    $mainframe->enqueueMessage($msg);
    $mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=yourphotos&Itemid='.$Itemid );
  }
    function editAlbum()
  {
    global $mainframe, $mosConfig_live_site, $Itemid, $my;
      $db =& JFactory::getDBO();
    $my = & JFactory::getUser();
    $album_id  = JRequest::getInt( 'album_id', 0 );

    $row = new hwdpsalbums($db);
    $row->load( $album_id );

    // fail if checked out not by user
    if ($row->isCheckedOut( $my->id )) {
      mosRedirect( $mosConfig_live_site.'/index.php?option=com_hwdphotoshare&Itemid=', _HWDPS_ALERTCO1.' '.$row->title.' '. _HWDPS_ALERTCO2 );
    }

    //check valid user
    if ($row->user_id != $my->id) {
      $msg = _HWDPS_ALERT_NOPERM;
      $mainframe->enqueueMessage($msg);
      $mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare" );
    }

    //
    $query = 'SELECT *'
        . ' FROM #__hwdpsphotos'
            . ' WHERE album_id = '.$row->id
        . ' ORDER BY ordering ASC'
        ;

    $db->SetQuery($query);
    $albumphotos = $db->loadObjectList();

    hwd_ps_html::editAlbumInfo($album_id, $row, $albumphotos);
    }
   /**
    * Save editted video details
    */
  function updateAlbumInfo()
  {
    global $database, $my, $Itemid, $mainframe;
      $db =& JFactory::getDBO();
    $my = & JFactory::getUser();

    $row = new hwdpsalbums($db);

    $aid = JRequest::getInt( 'aid', 0, 'post' );
    $row->load( $aid );

    if ($row->user_id != $my->id) {
      $msg = _HWDPS_ALERT_NOPERM;
      mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdvideoshare&Itemid=".$Itemid, $msg );
    }

    $_POST['title']       = Jrequest::getVar( 'title', 'no name supplied', 'request' );;
    $_POST['description']     = Jrequest::getVar( 'description', 'no name supplied', 'request' );
    $_POST['category_id']     = JRequest::getInt( 'category_id', 0, 'post' );
    $_POST['tags']         = Jrequest::getVar( 'tags', 'no name supplied', 'request' );
    $_POST['location']       = Jrequest::getVar( 'location', 'no name supplied', 'request' );

    // bind it to the table
    if (!$row->bind($_POST)) {
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
      exit();
    }

    // Make sure the record is valid
       if (!$row->check()) {
          $this->setError($this->_db->getErrorMsg());
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
      exit();
      }

    // store it in the db
    if (!$row->store()) {
      echo "<script> alert('".$row -> getError()."'); window.history.go(-1); </script>\n";
      exit();
    }

    $row->checkin();

    // perform maintenance
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
    //hwd_ps_recount::recountAlbumsInCategory($row->album_id);
    require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'xmloutput.class.php');
    hwd_ps_xmlOutput::prepareSlideshowXML($row->album_id);

    $msg = _HWDPS_ALERT_ASAVED;
    $mainframe->enqueueMessage($msg);
    $mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=yourphotos&Itemid='.$Itemid );
  }
   /**
    * Save editted video details
    */
  function reorderAlbum()
  {
    global $Itemid, $mainframe;
    $db =& JFactory::getDBO();
    $my = & JFactory::getUser();

    $album_id  = JRequest::getInt( 'album_id', 0 );
    $orderdata = JRequest::getVar( 'orderdata' );
    $neworder = explode("_", $orderdata);

    for ($i=0, $n=count($neworder)-1; $i < $n; $i++) {
      $orderslot = explode("--", $neworder[$i]);
      $order = intval(preg_replace("/[^0-9]/", "", $orderslot[0]));
      $pid = intval(preg_replace("/[^0-9]/", "", $orderslot[1]));

      // update ordering
      $db->SetQuery("UPDATE #__hwdpsphotos SET ordering = $i WHERE id = $pid");
      $db->Query();
      if ( !$db->query() ) {
        echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
      }
    }

    // perform maintenance
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
    hwd_ps_tools::setAlbumModifiedDate($album_id);
    include_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'xmloutput.class.php');
    hwd_ps_xmlOutput::prepareSlideshowXML($album_id);

    $msg = _HWDPS_ALERT_AREORGANISED;
    $mainframe->enqueueMessage($msg);
    $mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=editalbum&album_id='.$album_id.'&Itemid='.$Itemid );
  }
   /**
    * Save editted video details
    */
  function viewSlideshow()
  {
    global $database, $my, $Itemid, $mosConfig_live_site, $smartyps;

    $c = hwd_ps_Config::get_instance();
    include_once(JPATH_SITE.DS.'plugins'.DS.$c->hwdps_slideshow_path.DS.$c->hwdps_slideshow_file.'.php');
    include_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'xmloutput.class.php');

    $album_id = JRequest::getInt( 'album_id', 0 );

	hwd_ps_xmlOutput::prepareSlideshowXML($album_id);
    $smartyps->assign("album_id", $album_id);
    $smartyps->assign("slideshow_folder", $c->hwdps_slideshow_file);
    $smartyps->display('slideshow_autoviewer.tpl');
    exit;
  }
   /**
    * Save editted video details
    */
    function albumPrivacy()
  {
    global $mainframe, $mosConfig_live_site, $Itemid, $my;
      $db =& JFactory::getDBO();

    $my = & JFactory::getUser();

    //check valid user
    if (!$my->id) {
      $msg = _HWDPS_ALERT_LOGFORPRIVACY;
      $mainframe->enqueueMessage($msg);
      $mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare" );
    }

    $query = 'SELECT *'
        . ' FROM #__hwdpsalbums'
        . ' WHERE user_id = '.$my->id
        . ' AND approved = "yes"'
        . ' ORDER BY date_created DESC'
        ;

    $db->SetQuery($query);
    $rows = $db->loadObjectList();

    hwd_ps_html::albumPrivacy($rows);
    }
   /**
    * Save editted video details
    */
    function saveAlbumPrivacy()
  {
    global $mainframe, $mosConfig_live_site, $Itemid, $my;
      $db =& JFactory::getDBO();
    $my = & JFactory::getUser();

    $row = new hwdpsalbums($db);

    $album_id = JRequest::getInt( 'album_id', 0 );
    $row->load( $album_id );

    if ($row->user_id != $my->id) {
      $msg = _HWDPS_ALERT_NOPERM;
      mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdvideoshare&Itemid=".$Itemid, $msg );
    }

    $_POST['privacy'] =  JRequest::getWord( 'privacy' );

    // bind it to the table
    if (!$row->bind($_POST)) {
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
      exit();
    }

    // Make sure the record is valid
       if (!$row->check()) {
          $this->setError($this->_db->getErrorMsg());
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
      exit();
      }

    // store it in the db
    if (!$row->store()) {
      echo "<script> alert('".$row -> getError()."'); window.history.go(-1); </script>\n";
      exit();
    }

    $row->checkin();

    $msg = _HWDPS_ALERT_PRIVACYSAVED;
    $mainframe->enqueueMessage($msg);
    $mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=albumprivacy&Itemid='.$Itemid );
    }
}
?>