<?php
/**
 *    @version 2.1.3 Build 21301 Alpha [ Plimmerton ]
 *    @package hwdVideoShare
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
 * This class is the HTML generator for hwdVideoShare frontend
 *
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_rss
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
    function feeds()
	{
	global $mainframe, $Itemid;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();

		$feed = JRequest::getCmd( 'feed' );

		// switch for feed function
		switch ($feed)
		{
			case 'recent':
				hwd_ps_rss::recent();
			break;

			default:
				hwd_ps_rss::recent();
			break;
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
    function recent()
	{
	global $joinv, $joing, $select, $Itemid;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$jconfig = new jconfig();
		$my = & JFactory::getUser();

        // sql search filters
        $where = ' WHERE a.published = 1';
        $where .= ' AND a.approved = "yes"';
        if (!$my->id) {
        $where .= ' AND a.privacy = "public"';
        }

        // get videos
        $query = 'SELECT a.*'
                . ' FROM #__hwdpsphotos AS a'
                . $where
                . ' ORDER BY a.date_uploaded DESC'
                . ' LIMIT 0, 50'
                ;
        $db->SetQuery($query);
        $rows = $db->loadObjectList();

echo '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
  <channel>

    <title>'.$jconfig->sitename.'</title>
    <link>'.JURI::root().'</link>
    <description>Recent Photos</description>
    <category>Photo</category>
    ';

	for ($i=0, $n=count($rows); $i < $n; $i++) {
		$row = $rows[$i];
		$title = stripslashes($row->title);
		$caption = stripslashes($row->caption);
		$category = hwd_ps_tools::generateCategory($row->category_id);
		$link = JURI::root()."index.php?option=com_hwdphotoshare&task=viewphoto&Itemid=".$Itemid."&album_id=".$row->album_id."&limitstart=".$row->ordering;
		$thumbnailURL = hwd_ps_tools::generateThumbnailURL( $row->id, $row->photo_id, $row->photo_type, $row->original_type );
		$downloadURL = hwd_ps_tools::generateThumbnailURL( $row->id, $row->photo_id, $row->photo_type, $row->original_type );
		$downloadSIZE = "0000";

echo '<item>
      <title><![CDATA['.stripslashes($title).']]></title>
      <link><![CDATA['.$link.']]></link>
      <description><![CDATA[<img src="'.$thumbnailURL.'" style="float:right;padding:10px;" />&#160;'.stripslashes($caption).']]></description>
      <category><![CDATA['.stripslashes($category).']]></category>
      <pubDate><![CDATA['.stripslashes($row->date_uploaded).']]></pubDate>
      <guid><![CDATA['.stripslashes($row->id).']]></guid>
      <enclosure url="http://'.$_SERVER['HTTP_HOST'].$downloadURL.'" length="'.$downloadSIZE.'" type="image/jpeg" />
    </item>
    ';

	}

echo '
  </channel>
</rss>';
		exit;
	}
}
?>