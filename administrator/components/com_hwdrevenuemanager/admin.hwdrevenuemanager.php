<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $limit, $limitstart, $mainframe, $limitstart, $task, $c;

define( 'HWDRM_ADMIN_PATH', dirname(__FILE__) );

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

require_once(HWDRM_ADMIN_PATH.'/config.vs.hwdrevenuemanager.php');
require_once(HWDRM_ADMIN_PATH.'/config.ps.hwdrevenuemanager.php');
require_once(HWDRM_ADMIN_PATH.'/config.lt.hwdrevenuemanager.php');
require_once(HWDRM_ADMIN_PATH.'/../../includes/pageNavigation.php');
$c_v = hwd_rm_vs_Config::get_instance();
$c_p = hwd_rm_ps_Config::get_instance();

if (file_exists(HWDRM_ADMIN_PATH.'/languages/'.$mainframe->getCfg('lang').'.php')) {
	include(HWDRM_ADMIN_PATH.'/languages/'.$mainframe->getCfg('lang').'.php');
} else {
	include(HWDRM_ADMIN_PATH.'/languages/english.php');
}

$compatibility = compatibility();

	$request_array = JRequest::get( 'request' );
	@$cid 	= $request_array['cid'];

  	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', 10);
 	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	$task 	= JRequest::getCmd( 'task' );

		switch($task)
		{
			/** general */
			case 'homepage':
				homepage($option, $compatibility);
				break;
			case "hwdvideoshare":
				showvssettings($option, $compatibility);
				break;
			case "hwdphotoshare":
				showpssettings($option, $compatibility);
				break;
			case "savevssettings":
				savevssettings($option);
				break;
			case "savepssettings":
				savepssettings($option);
				break;
			case "saveltsettings":
				saveltsettings($option);
				break;
			case "videoads":
				videoads($option, $compatibility);
				break;
			case "newvad":
				editvad($option, $compatibility, 0);
				break;
			case "editvad":
				editvad($option, $compatibility, $cid);
				break;
			case "savevad":
				savevad($option, $compatibility);
				break;
			case "deletevads":
				deletevads($option, $cid);
				break;
			case "publish":
				publish($cid, 1, $option);
				break;
			case "unpublish":
				publish($cid, 0, $option);
				break;
			case "longtail":
				longtail($option, $compatibility);
				break;

			/** default */
			default:
			homepage($option, $compatibility);
			break;
		}

    /**
     * Generates frontpage PHP
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function homepage($option, $compatibility)
	{
		hwd_rm_html::homepage($option, $compatibility);
	}
    /**
     * Generates hwdVideoShare revenue settings
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
    function showvssettings($option, $compatibility)
	{
		drawVSconfig(false);
		hwd_rm_html::showvssettings($option, $compatibility);
	}
    /**
     * Generates hwdPhotoShare revenue settings
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function showpssettings($option, $compatibility)
	{
		drawPSconfig(false);
		hwd_rm_html::showpssettings($option, $compatibility);
	}
    /**
     * Generates hwdPhotoShare revenue settings
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function videoads($option, $compatibility)
	{
		global $database, $mainframe, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdrm_vads AS a"
							. "\nWHERE a.published 	>= 0"
							);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$where = array(
		"a.published 	>= 0",
		);

		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		$query = "SELECT a.*"
				. "\nFROM #__hwdrm_vads AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. " ORDER BY type ASC, published DESC, priority DESC"
				;
		$db->SetQuery( $query, $pageNav->limitstart, $pageNav->limit );
		$rows = $db->loadObjectList();

		hwd_rm_html::videoads($option, $compatibility, $rows, $pageNav);
	}
    /**
     * Generates hwdPhotoShare revenue settings
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function editvad($option, $compatibility, $cid)
	{
		global $database, $acl, $my;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdrm_vads( $db );
		$row->load( $cid );

		$db->SetQuery("SELECT * FROM #__hwdrm_vads"
							. "\nWHERE id = $cid");
		$db->loadObject($row);

		hwd_rm_html::editvad($option, $compatibility, $row);
	}
	/**
     * Generates hwdPhotoShare revenue settings
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function longtail($option, $compatibility)
	{
		hwd_rm_html::longtail($option, $compatibility);
	}

    /**
     * Saves hwdVideoShare configuration
     *
     * @return       Nothing
     */
	function savevssettings($option)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		//register globals = off
		if (!empty($_POST)) {
			extract($_POST);
		}

		$ad1custom = addslashes($ad1custom);
		$ad2custom = addslashes($ad2custom);
		$ad3custom = addslashes($ad3custom);
		$ad4custom = addslashes($ad4custom);
		$ad5custom = addslashes($ad5custom);
		$ad6custom = addslashes($ad6custom);
		$ad7custom = addslashes($ad7custom);
		$ad8custom = addslashes($ad8custom);

		// update server settings db
		$HWDSS['updates'][0] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1show' WHERE setting = 'ad1show'";
		$HWDSS['updates'][1] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_ad_client' WHERE setting = 'ad1_ad_client'";
		$HWDSS['updates'][2] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_ad_channel' WHERE setting = 'ad1_ad_channel'";
		$HWDSS['updates'][3] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_ad_type' WHERE setting = 'ad1_ad_type'";
		$HWDSS['updates'][4] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_ad_uifeatures' WHERE setting = 'ad1_ad_uifeatures'";
		$HWDSS['updates'][5] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_ad_format' WHERE setting = 'ad1_ad_format'";
		$HWDSS['updates'][6] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_color_border1' WHERE setting = 'ad1_color_border1'";
		$HWDSS['updates'][7] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_color_bg1' WHERE setting = 'ad1_color_bg1'";
		$HWDSS['updates'][8] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_color_link1' WHERE setting = 'ad1_color_link1'";
		$HWDSS['updates'][9] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_color_text1' WHERE setting = 'ad1_color_text1'";
		$HWDSS['updates'][10] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1_color_url1' WHERE setting = 'ad1_color_url1'";
		$HWDSS['updates'][11] = "UPDATE #__hwdrm_vs_settings SET value = '$ad1custom' WHERE setting = 'ad1custom'";
		$HWDSS['updates'][12] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2show' WHERE setting = 'ad2show'";
		$HWDSS['updates'][13] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_ad_client' WHERE setting = 'ad2_ad_client'";
		$HWDSS['updates'][14] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_ad_channel' WHERE setting = 'ad2_ad_channel'";
		$HWDSS['updates'][15] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_ad_type' WHERE setting = 'ad2_ad_type'";
		$HWDSS['updates'][16] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_ad_uifeatures' WHERE setting = 'ad2_ad_uifeatures'";
		$HWDSS['updates'][17] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_ad_format' WHERE setting = 'ad2_ad_format'";
		$HWDSS['updates'][18] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_color_border1' WHERE setting = 'ad2_color_border1'";
		$HWDSS['updates'][19] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_color_bg1' WHERE setting = 'ad2_color_bg1'";
		$HWDSS['updates'][20] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_color_link1' WHERE setting = 'ad2_color_link1'";
		$HWDSS['updates'][21] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_color_text1' WHERE setting = 'ad2_color_text1'";
		$HWDSS['updates'][22] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2_color_url1' WHERE setting = 'ad2_color_url1'";
		$HWDSS['updates'][23] = "UPDATE #__hwdrm_vs_settings SET value = '$ad2custom' WHERE setting = 'ad2custom'";
		$HWDSS['updates'][24] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3show' WHERE setting = 'ad3show'";
		$HWDSS['updates'][25] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_ad_client' WHERE setting = 'ad3_ad_client'";
		$HWDSS['updates'][26] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_ad_channel' WHERE setting = 'ad3_ad_channel'";
		$HWDSS['updates'][27] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_ad_type' WHERE setting = 'ad3_ad_type'";
		$HWDSS['updates'][28] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_ad_uifeatures' WHERE setting = 'ad3_ad_uifeatures'";
		$HWDSS['updates'][29] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_ad_format' WHERE setting = 'ad3_ad_format'";
		$HWDSS['updates'][30] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_color_border1' WHERE setting = 'ad3_color_border1'";
		$HWDSS['updates'][31] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_color_bg1' WHERE setting = 'ad3_color_bg1'";
		$HWDSS['updates'][32] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_color_link1' WHERE setting = 'ad3_color_link1'";
		$HWDSS['updates'][33] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_color_text1' WHERE setting = 'ad3_color_text1'";
		$HWDSS['updates'][34] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3_color_url1' WHERE setting = 'ad3_color_url1'";
		$HWDSS['updates'][35] = "UPDATE #__hwdrm_vs_settings SET value = '$ad3custom' WHERE setting = 'ad3custom'";
		$HWDSS['updates'][36] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4show' WHERE setting = 'ad4show'";
		$HWDSS['updates'][37] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_ad_client' WHERE setting = 'ad4_ad_client'";
		$HWDSS['updates'][38] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_ad_channel' WHERE setting = 'ad4_ad_channel'";
		$HWDSS['updates'][39] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_ad_type' WHERE setting = 'ad4_ad_type'";
		$HWDSS['updates'][40] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_ad_uifeatures' WHERE setting = 'ad4_ad_uifeatures'";
		$HWDSS['updates'][41] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_ad_format' WHERE setting = 'ad4_ad_format'";
		$HWDSS['updates'][42] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_color_border1' WHERE setting = 'ad4_color_border1'";
		$HWDSS['updates'][43] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_color_bg1' WHERE setting = 'ad4_color_bg1'";
		$HWDSS['updates'][44] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_color_link1' WHERE setting = 'ad4_color_link1'";
		$HWDSS['updates'][45] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_color_text1' WHERE setting = 'ad4_color_text1'";
		$HWDSS['updates'][46] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4_color_url1' WHERE setting = 'ad4_color_url1'";
		$HWDSS['updates'][47] = "UPDATE #__hwdrm_vs_settings SET value = '$ad4custom' WHERE setting = 'ad4custom'";
		$HWDSS['updates'][48] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5show' WHERE setting = 'ad5show'";
		$HWDSS['updates'][49] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_ad_client' WHERE setting = 'ad5_ad_client'";
		$HWDSS['updates'][50] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_ad_channel' WHERE setting = 'ad5_ad_channel'";
		$HWDSS['updates'][51] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_ad_type' WHERE setting = 'ad5_ad_type'";
		$HWDSS['updates'][52] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_ad_uifeatures' WHERE setting = 'ad5_ad_uifeatures'";
		$HWDSS['updates'][53] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_ad_format' WHERE setting = 'ad5_ad_format'";
		$HWDSS['updates'][54] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_color_border1' WHERE setting = 'ad5_color_border1'";
		$HWDSS['updates'][55] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_color_bg1' WHERE setting = 'ad5_color_bg1'";
		$HWDSS['updates'][56] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_color_link1' WHERE setting = 'ad5_color_link1'";
		$HWDSS['updates'][57] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_color_text1' WHERE setting = 'ad5_color_text1'";
		$HWDSS['updates'][58] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5_color_url1' WHERE setting = 'ad5_color_url1'";
		$HWDSS['updates'][59] = "UPDATE #__hwdrm_vs_settings SET value = '$ad5custom' WHERE setting = 'ad5custom'";
		$HWDSS['updates'][60] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6show' WHERE setting = 'ad6show'";
		$HWDSS['updates'][61] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_ad_client' WHERE setting = 'ad6_ad_client'";
		$HWDSS['updates'][62] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_ad_channel' WHERE setting = 'ad6_ad_channel'";
		$HWDSS['updates'][63] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_ad_type' WHERE setting = 'ad6_ad_type'";
		$HWDSS['updates'][64] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_ad_uifeatures' WHERE setting = 'ad6_ad_uifeatures'";
		$HWDSS['updates'][65] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_ad_format' WHERE setting = 'ad6_ad_format'";
		$HWDSS['updates'][66] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_color_border1' WHERE setting = 'ad6_color_border1'";
		$HWDSS['updates'][67] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_color_bg1' WHERE setting = 'ad6_color_bg1'";
		$HWDSS['updates'][68] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_color_link1' WHERE setting = 'ad6_color_link1'";
		$HWDSS['updates'][69] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_color_text1' WHERE setting = 'ad6_color_text1'";
		$HWDSS['updates'][70] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6_color_url1' WHERE setting = 'ad6_color_url1'";
		$HWDSS['updates'][71] = "UPDATE #__hwdrm_vs_settings SET value = '$ad6custom' WHERE setting = 'ad6custom'";
		$HWDSS['updates'][72] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7show' WHERE setting = 'ad7show'";
		$HWDSS['updates'][73] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_ad_client' WHERE setting = 'ad7_ad_client'";
		$HWDSS['updates'][74] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_ad_channel' WHERE setting = 'ad7_ad_channel'";
		$HWDSS['updates'][75] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_ad_type' WHERE setting = 'ad7_ad_type'";
		$HWDSS['updates'][76] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_ad_uifeatures' WHERE setting = 'ad7_ad_uifeatures'";
		$HWDSS['updates'][77] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_ad_format' WHERE setting = 'ad7_ad_format'";
		$HWDSS['updates'][78] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_color_border1' WHERE setting = 'ad7_color_border1'";
		$HWDSS['updates'][79] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_color_bg1' WHERE setting = 'ad7_color_bg1'";
		$HWDSS['updates'][80] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_color_link1' WHERE setting = 'ad7_color_link1'";
		$HWDSS['updates'][81] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_color_text1' WHERE setting = 'ad7_color_text1'";
		$HWDSS['updates'][82] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7_color_url1' WHERE setting = 'ad7_color_url1'";
		$HWDSS['updates'][83] = "UPDATE #__hwdrm_vs_settings SET value = '$ad7custom' WHERE setting = 'ad7custom'";
		$HWDSS['updates'][84] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8show' WHERE setting = 'ad8show'";
		$HWDSS['updates'][85] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_ad_client' WHERE setting = 'ad8_ad_client'";
		$HWDSS['updates'][86] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_ad_channel' WHERE setting = 'ad8_ad_channel'";
		$HWDSS['updates'][87] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_ad_type' WHERE setting = 'ad8_ad_type'";
		$HWDSS['updates'][88] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_ad_uifeatures' WHERE setting = 'ad8_ad_uifeatures'";
		$HWDSS['updates'][89] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_ad_format' WHERE setting = 'ad8_ad_format'";
		$HWDSS['updates'][90] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_color_border1' WHERE setting = 'ad8_color_border1'";
		$HWDSS['updates'][91] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_color_bg1' WHERE setting = 'ad8_color_bg1'";
		$HWDSS['updates'][92] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_color_link1' WHERE setting = 'ad8_color_link1'";
		$HWDSS['updates'][93] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_color_text1' WHERE setting = 'ad8_color_text1'";
		$HWDSS['updates'][94] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8_color_url1' WHERE setting = 'ad8_color_url1'";
		$HWDSS['updates'][95] = "UPDATE #__hwdrm_vs_settings SET value = '$ad8custom' WHERE setting = 'ad8custom'";
		$HWDSS['updates'][96] = "UPDATE #__hwdrm_vs_settings SET value = '$preroll_url' WHERE setting = 'preroll_url'";
		$HWDSS['updates'][97] = "UPDATE #__hwdrm_vs_settings SET value = '$postroll_url' WHERE setting = 'postroll_url'";
		$HWDSS['updates'][98] = "UPDATE #__hwdrm_vs_settings SET value = '$preroll_show' WHERE setting = 'preroll_show'";
		$HWDSS['updates'][99] = "UPDATE #__hwdrm_vs_settings SET value = '$postroll_show' WHERE setting = 'postroll_show'";

		$HWDSS['message'] = "Saving settings to database";

		// apply
		foreach($HWDSS['updates'] as $UPDT) {
			$db->setQuery($UPDT);
			if(!$db->query()) {
				//Save failed
				print("<font color=red>".$HWDSS['message']." failed! SQL error:" . $db->stderr(true)."</font><br />");
				return;
			}
		}

		$updt_config = drawVSconfig();
		if ($updt_config) {

			// query SQL for today's data
			// $db->SetQuery('SELECT * FROM #__hwdvidsvideos');
			// $rows = $db->loadObjectList();

			// for ($i=0, $n=count($rows); $i < $n; $i++) {
			//  	$row = $rows[$i];
			//  	require_once('redrawplaylist.class.php');
			//  	hwd_rm_playlist::writeFile($row);
			// }

			$mainframe->enqueueMessage(_HWDRM_SAVED);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=hwdvideoshare' );
		} else {
			$mainframe->enqueueMessage(_HWDRM_NOSAVED);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=hwdvideoshare' );
		}
	}
    /**
     * Saves hwdPhotoShare configuration
     *
     * @return       Nothing
     */
	function savepssettings($option)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		//register globals = off
		if (!empty($_POST)) {
			extract($_POST);
		}

		$ad1custom = addslashes($ad1custom);
		$ad2custom = addslashes($ad2custom);
		$ad3custom = addslashes($ad3custom);
		$ad4custom = addslashes($ad4custom);
		$ad5custom = addslashes($ad5custom);
		$ad6custom = addslashes($ad6custom);
		$ad7custom = addslashes($ad7custom);
		$ad8custom = addslashes($ad8custom);

		// update server settings db
		$HWDSS['updates'][0] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1show' WHERE setting = 'ad1show'";
		$HWDSS['updates'][1] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_ad_client' WHERE setting = 'ad1_ad_client'";
		$HWDSS['updates'][2] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_ad_channel' WHERE setting = 'ad1_ad_channel'";
		$HWDSS['updates'][3] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_ad_type' WHERE setting = 'ad1_ad_type'";
		$HWDSS['updates'][4] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_ad_uifeatures' WHERE setting = 'ad1_ad_uifeatures'";
		$HWDSS['updates'][5] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_ad_format' WHERE setting = 'ad1_ad_format'";
		$HWDSS['updates'][6] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_color_border1' WHERE setting = 'ad1_color_border1'";
		$HWDSS['updates'][7] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_color_bg1' WHERE setting = 'ad1_color_bg1'";
		$HWDSS['updates'][8] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_color_link1' WHERE setting = 'ad1_color_link1'";
		$HWDSS['updates'][9] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_color_text1' WHERE setting = 'ad1_color_text1'";
		$HWDSS['updates'][10] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1_color_url1' WHERE setting = 'ad1_color_url1'";
		$HWDSS['updates'][11] = "UPDATE #__hwdrm_ps_settings SET value = '$ad1custom' WHERE setting = 'ad1custom'";
		$HWDSS['updates'][12] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2show' WHERE setting = 'ad2show'";
		$HWDSS['updates'][13] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_ad_client' WHERE setting = 'ad2_ad_client'";
		$HWDSS['updates'][14] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_ad_channel' WHERE setting = 'ad2_ad_channel'";
		$HWDSS['updates'][15] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_ad_type' WHERE setting = 'ad2_ad_type'";
		$HWDSS['updates'][16] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_ad_uifeatures' WHERE setting = 'ad2_ad_uifeatures'";
		$HWDSS['updates'][17] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_ad_format' WHERE setting = 'ad2_ad_format'";
		$HWDSS['updates'][18] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_color_border1' WHERE setting = 'ad2_color_border1'";
		$HWDSS['updates'][19] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_color_bg1' WHERE setting = 'ad2_color_bg1'";
		$HWDSS['updates'][20] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_color_link1' WHERE setting = 'ad2_color_link1'";
		$HWDSS['updates'][21] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_color_text1' WHERE setting = 'ad2_color_text1'";
		$HWDSS['updates'][22] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2_color_url1' WHERE setting = 'ad2_color_url1'";
		$HWDSS['updates'][23] = "UPDATE #__hwdrm_ps_settings SET value = '$ad2custom' WHERE setting = 'ad2custom'";
		$HWDSS['updates'][24] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3show' WHERE setting = 'ad3show'";
		$HWDSS['updates'][25] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_ad_client' WHERE setting = 'ad3_ad_client'";
		$HWDSS['updates'][26] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_ad_channel' WHERE setting = 'ad3_ad_channel'";
		$HWDSS['updates'][27] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_ad_type' WHERE setting = 'ad3_ad_type'";
		$HWDSS['updates'][28] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_ad_uifeatures' WHERE setting = 'ad3_ad_uifeatures'";
		$HWDSS['updates'][29] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_ad_format' WHERE setting = 'ad3_ad_format'";
		$HWDSS['updates'][30] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_color_border1' WHERE setting = 'ad3_color_border1'";
		$HWDSS['updates'][31] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_color_bg1' WHERE setting = 'ad3_color_bg1'";
		$HWDSS['updates'][32] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_color_link1' WHERE setting = 'ad3_color_link1'";
		$HWDSS['updates'][33] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_color_text1' WHERE setting = 'ad3_color_text1'";
		$HWDSS['updates'][34] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3_color_url1' WHERE setting = 'ad3_color_url1'";
		$HWDSS['updates'][35] = "UPDATE #__hwdrm_ps_settings SET value = '$ad3custom' WHERE setting = 'ad3custom'";
		$HWDSS['updates'][36] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4show' WHERE setting = 'ad4show'";
		$HWDSS['updates'][37] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_ad_client' WHERE setting = 'ad4_ad_client'";
		$HWDSS['updates'][38] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_ad_channel' WHERE setting = 'ad4_ad_channel'";
		$HWDSS['updates'][39] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_ad_type' WHERE setting = 'ad4_ad_type'";
		$HWDSS['updates'][40] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_ad_uifeatures' WHERE setting = 'ad4_ad_uifeatures'";
		$HWDSS['updates'][41] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_ad_format' WHERE setting = 'ad4_ad_format'";
		$HWDSS['updates'][42] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_color_border1' WHERE setting = 'ad4_color_border1'";
		$HWDSS['updates'][43] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_color_bg1' WHERE setting = 'ad4_color_bg1'";
		$HWDSS['updates'][44] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_color_link1' WHERE setting = 'ad4_color_link1'";
		$HWDSS['updates'][45] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_color_text1' WHERE setting = 'ad4_color_text1'";
		$HWDSS['updates'][46] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4_color_url1' WHERE setting = 'ad4_color_url1'";
		$HWDSS['updates'][47] = "UPDATE #__hwdrm_ps_settings SET value = '$ad4custom' WHERE setting = 'ad4custom'";
		$HWDSS['updates'][48] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5show' WHERE setting = 'ad5show'";
		$HWDSS['updates'][49] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_ad_client' WHERE setting = 'ad5_ad_client'";
		$HWDSS['updates'][50] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_ad_channel' WHERE setting = 'ad5_ad_channel'";
		$HWDSS['updates'][51] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_ad_type' WHERE setting = 'ad5_ad_type'";
		$HWDSS['updates'][52] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_ad_uifeatures' WHERE setting = 'ad5_ad_uifeatures'";
		$HWDSS['updates'][53] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_ad_format' WHERE setting = 'ad5_ad_format'";
		$HWDSS['updates'][54] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_color_border1' WHERE setting = 'ad5_color_border1'";
		$HWDSS['updates'][55] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_color_bg1' WHERE setting = 'ad5_color_bg1'";
		$HWDSS['updates'][56] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_color_link1' WHERE setting = 'ad5_color_link1'";
		$HWDSS['updates'][57] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_color_text1' WHERE setting = 'ad5_color_text1'";
		$HWDSS['updates'][58] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5_color_url1' WHERE setting = 'ad5_color_url1'";
		$HWDSS['updates'][59] = "UPDATE #__hwdrm_ps_settings SET value = '$ad5custom' WHERE setting = 'ad5custom'";
		$HWDSS['updates'][60] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6show' WHERE setting = 'ad6show'";
		$HWDSS['updates'][61] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_ad_client' WHERE setting = 'ad6_ad_client'";
		$HWDSS['updates'][62] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_ad_channel' WHERE setting = 'ad6_ad_channel'";
		$HWDSS['updates'][63] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_ad_type' WHERE setting = 'ad6_ad_type'";
		$HWDSS['updates'][64] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_ad_uifeatures' WHERE setting = 'ad6_ad_uifeatures'";
		$HWDSS['updates'][65] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_ad_format' WHERE setting = 'ad6_ad_format'";
		$HWDSS['updates'][66] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_color_border1' WHERE setting = 'ad6_color_border1'";
		$HWDSS['updates'][67] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_color_bg1' WHERE setting = 'ad6_color_bg1'";
		$HWDSS['updates'][68] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_color_link1' WHERE setting = 'ad6_color_link1'";
		$HWDSS['updates'][69] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_color_text1' WHERE setting = 'ad6_color_text1'";
		$HWDSS['updates'][70] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6_color_url1' WHERE setting = 'ad6_color_url1'";
		$HWDSS['updates'][71] = "UPDATE #__hwdrm_ps_settings SET value = '$ad6custom' WHERE setting = 'ad6custom'";
		$HWDSS['updates'][72] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7show' WHERE setting = 'ad7show'";
		$HWDSS['updates'][73] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_ad_client' WHERE setting = 'ad7_ad_client'";
		$HWDSS['updates'][74] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_ad_channel' WHERE setting = 'ad7_ad_channel'";
		$HWDSS['updates'][75] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_ad_type' WHERE setting = 'ad7_ad_type'";
		$HWDSS['updates'][76] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_ad_uifeatures' WHERE setting = 'ad7_ad_uifeatures'";
		$HWDSS['updates'][77] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_ad_format' WHERE setting = 'ad7_ad_format'";
		$HWDSS['updates'][78] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_color_border1' WHERE setting = 'ad7_color_border1'";
		$HWDSS['updates'][79] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_color_bg1' WHERE setting = 'ad7_color_bg1'";
		$HWDSS['updates'][80] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_color_link1' WHERE setting = 'ad7_color_link1'";
		$HWDSS['updates'][81] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_color_text1' WHERE setting = 'ad7_color_text1'";
		$HWDSS['updates'][82] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7_color_url1' WHERE setting = 'ad7_color_url1'";
		$HWDSS['updates'][83] = "UPDATE #__hwdrm_ps_settings SET value = '$ad7custom' WHERE setting = 'ad7custom'";
		$HWDSS['updates'][84] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8show' WHERE setting = 'ad8show'";
		$HWDSS['updates'][85] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_ad_client' WHERE setting = 'ad8_ad_client'";
		$HWDSS['updates'][86] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_ad_channel' WHERE setting = 'ad8_ad_channel'";
		$HWDSS['updates'][87] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_ad_type' WHERE setting = 'ad8_ad_type'";
		$HWDSS['updates'][88] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_ad_uifeatures' WHERE setting = 'ad8_ad_uifeatures'";
		$HWDSS['updates'][89] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_ad_format' WHERE setting = 'ad8_ad_format'";
		$HWDSS['updates'][90] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_color_border1' WHERE setting = 'ad8_color_border1'";
		$HWDSS['updates'][91] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_color_bg1' WHERE setting = 'ad8_color_bg1'";
		$HWDSS['updates'][92] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_color_link1' WHERE setting = 'ad8_color_link1'";
		$HWDSS['updates'][93] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_color_text1' WHERE setting = 'ad8_color_text1'";
		$HWDSS['updates'][94] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8_color_url1' WHERE setting = 'ad8_color_url1'";
		$HWDSS['updates'][95] = "UPDATE #__hwdrm_ps_settings SET value = '$ad8custom' WHERE setting = 'ad8custom'";
		$HWDSS['updates'][96] = "UPDATE #__hwdrm_ps_settings SET value = '$preroll_url' WHERE setting = 'preroll_url'";
		$HWDSS['updates'][97] = "UPDATE #__hwdrm_ps_settings SET value = '$postroll_url' WHERE setting = 'postroll_url'";
		$HWDSS['updates'][98] = "UPDATE #__hwdrm_ps_settings SET value = '$preroll_show' WHERE setting = 'preroll_show'";
		$HWDSS['updates'][99] = "UPDATE #__hwdrm_ps_settings SET value = '$postroll_show' WHERE setting = 'postroll_show'";

		$HWDSS['message'] = "Saving settings to database";

		// apply
		foreach($HWDSS['updates'] as $UPDT) {
			$db->setQuery($UPDT);
			if(!$db->query()) {
				//Save failed
				print("<font color=red>".$HWDSS['message']." failed! SQL error:" . $db->stderr(true)."</font><br />");
				return;
			}
		}

		$updt_config = drawPSconfig();
		if ($updt_config) {

			// query SQL for today's data
			$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE video_type = "local" AND approved = "yes"');
			$rows = $db->loadObjectList();

			for ($i=0, $n=count($rows); $i < $n; $i++) {
				$row = $rows[$i];
				require_once('redrawplaylist.class.php');
				hwd_rm_playlist::writeFile($row);
			}
			$mainframe->enqueueMessage(_HWDRM_SAVED);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=hwdphotoshare' );
		} else {
			$mainframe->enqueueMessage(_HWDRM_NOSAVED);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=hwdphotoshare' );
		}
	}
    /**
     * Saves hwdVideoShare configuration
     *
     * @return       Nothing
     */
	function saveltsettings($option)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		//register globals = off
		if (!empty($_POST)) {
			extract($_POST);
		}

		$enable_longtail = intval($enable_longtail);
		$longtail_channel_default = preg_replace("/[^a-zA-Z0-9s_-]/", "", $longtail_channel_default);
		$longtail_d = intval($longtail_d);
		$longtail_s = intval($longtail_s);

		// update server settings db
		$HWDSS['updates'][0] = "UPDATE #__hwdrm_vs_settings SET value = '$enable_longtail' WHERE setting = 'enable_longtail'";
		$HWDSS['updates'][1] = "UPDATE #__hwdrm_vs_settings SET value = '$longtail_channel_default' WHERE setting = 'longtail_channel_default'";
		$HWDSS['updates'][2] = "UPDATE #__hwdrm_vs_settings SET value = '$longtail_d' WHERE setting = 'longtail_d'";
		$HWDSS['updates'][3] = "UPDATE #__hwdrm_vs_settings SET value = '$longtail_s' WHERE setting = 'longtail_s'";

		$HWDSS['message'] = "Saving settings to database";

		// apply
		foreach($HWDSS['updates'] as $UPDT) {
			$db->setQuery($UPDT);
			if(!$db->query()) {
				//Save failed
				print("<font color=red>".$HWDSS['message']." failed! SQL error:" . $db->stderr(true)."</font><br />");
				return;
			}
		}

		$updt_config = drawLTconfig();
		if ($updt_config) {
			$mainframe->enqueueMessage(_HWDRM_SAVED);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=longtail' );
		} else {
			$mainframe->enqueueMessage(_HWDRM_NOSAVED);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=longtail' );
		}
	}
   /**
	* publish/unpublish videos
	*/
	function publish( $cid=null, $publish=1,  $option ) {
		global $database, $mainframe, $task;
  		$db =& JFactory::getDBO();
		$my = &JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'publish' : ($publish == -1 ? 'archive' : 'unpublish');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdrm_vads"
						. "\nSET published =" . intval( $publish )
						. "\n WHERE id IN ( $cids )"
						. "\n AND ( checked_out = 0 OR ( checked_out = $my->id ) )"
						);
		if (!$db->query()) {
		echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
		}

		switch ( $publish ) {
			case 1:
				$msg = $total ._HWDVIDS_ALERT_ADMIN_VIDPUB." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDVIDS_ALERT_ADMIN_VIDUNPUB." ";
				break;
		}

		if (count( $cid ) == 1) {
			$row = new hwdrm_vads( $db );
			$row->checkin( $cid[0] );
		}
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=videoads' );
	}
   /**
	* publish/unpublish videos
	*/
	function savevad( $option, $compatibility ) {
		global $mainframe;
		$db = & JFactory::getDBO();
		$row = new hwdrm_vads($db);

		$type               = Jrequest::getInt( 'type' );
		$url                = Jrequest::getVar( 'url', '' );
		$priority           = Jrequest::getInt( 'priority' );
		$date_activate      = Jrequest::getVar( 'date_activate', '0000-00-00 00:00:00' );
		$date_deactivate    = Jrequest::getVar( 'date_deactivate', '3000-00-00 00:00:00' );
		$impression_limit   = Jrequest::getInt( 'impression_limit', '1000000' );

		if (empty($date_deactivate)) { $date_deactivate = "2020-00-00 00:00:00"; }
		if (empty($impression_limit)) { $impression_limit = "1000000"; }

		$_POST['type'] 	           = $type;
		$_POST['url'] 		       = $url;
		$_POST['priority'] 		   = $priority;
		$_POST['date_activate']    = $date_activate;
		$_POST['date_deactivate']  = $date_deactivate;
		$_POST['impression_limit'] = $impression_limit;

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

		$row->checkin();

		$mainframe->enqueueMessage(_HWDRM_SAVED);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdrevenuemanager&task=videoads' );
	}
   /**
	* delete videos
	*/
	function deletevads($option, $cid)
	{
		global $mainframe;
  		$db =& JFactory::getDBO();

		$total = count( $cid );

			$ads = join(",", $cid);
			$db->SetQuery("DELETE FROM #__hwdrm_vads WHERE id IN ($ads)");

		$db->Query();

		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}


		$msg = $total ._HWDVIDS_ALERT_ADMIN_VIDDEL." ";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='. $option.'&task=videoads' );
	}
	/**
     * Generates copyright information
     *
     * @return       Nothing
     */
	function copyright()
	{
		include_once('version.php');
		$version = new hwdRevenueManagerVersion();
		$LongVersion = $version->getLongVersion();
		echo "<div>".$LongVersion."<br />hwdMediaShare is created by <a href=\"http://hwdmediashare.co.uk\" target=\"_blank\">Highwood Design</a></div>";
	}
    /**
     * Generates configuration file
     *
     * @return       Nothing
     */
	function drawVSconfig($redirect=true)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$configfile = "components/com_hwdrevenuemanager/config.vs.hwdrevenuemanager.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission && $redirect) {
			$mainframe->enqueueMessage(_HWDRM_NOWRITE);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=hwdvideoshare' );
		}

		$config = "<?php\n";
		$config .= "class hwd_rm_vs_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdrm_vs_settings'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$row->value = stripslashes($row->value);
			$row->value = stripslashes($row->value);
			$row->value = addslashes($row->value);

			$config .= "  var \$".$row->setting." = '".$row->value."';\n";
		}
		$config .= "\n/**\n";
		$config .= "  * get_instance\n";
		$config .= "  *	Description:\n";
		$config .= "  *		This function is used to instantiate the object\n";
		$config .= "  * 		and ensure only one of this type exists at any\n";
		$config .= "  *		time. It returns a reference to the only Config\n";
		$config .= "  *		instance.\n";
		$config .= "  *	Parameters:\n";
		$config .= "  *		none\n";
		$config .= "  *	Returns:\n";
		$config .= "  *		Config\n";
		$config .= "  **/\n\n";
		$config .= "  function get_instance(){\n";
		$config .= "    \$instanceConfig = new hwd_rm_vs_Config;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = @fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}
    /**
     * Generates configuration file
     *
     * @return       Nothing
     */
	function drawPSconfig($redirect=true)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$configfile = "components/com_hwdrevenuemanager/config.ps.hwdrevenuemanager.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission && $redirect) {
			$mainframe->enqueueMessage(_HWDRM_NOWRITE);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=hwdphotoshare' );
		}

		$config = "<?php\n";
		$config .= "class hwd_rm_ps_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdrm_ps_settings'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$row->value = stripslashes($row->value);
			$row->value = stripslashes($row->value);
			$row->value = addslashes($row->value);

			$config .= "  var \$".$row->setting." = '".$row->value."';\n";
		}
		$config .= "\n/**\n";
		$config .= "  * get_instance\n";
		$config .= "  *	Description:\n";
		$config .= "  *		This function is used to instantiate the object\n";
		$config .= "  * 		and ensure only one of this type exists at any\n";
		$config .= "  *		time. It returns a reference to the only Config\n";
		$config .= "  *		instance.\n";
		$config .= "  *	Parameters:\n";
		$config .= "  *		none\n";
		$config .= "  *	Returns:\n";
		$config .= "  *		Config\n";
		$config .= "  **/\n\n";
		$config .= "  function get_instance(){\n";
		$config .= "    \$instanceConfig = new hwd_rm_ps_Config;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = @fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}
    /**
     * Generates configuration file
     *
     * @return       Nothing
     */
	function drawLTconfig($redirect=true)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$configfile = "components/com_hwdrevenuemanager/config.lt.hwdrevenuemanager.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission && $redirect) {
			$mainframe->enqueueMessage(_HWDRM_NOWRITE);
			$mainframe->redirect( JURI::base() . 'index.php?option=com_hwdrevenuemanager&task=longtail' );
		}

		$config = "<?php\n";
		$config .= "class hwd_rm_lt_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$cids = "101,102, 103, 104";

		$query  = 'SELECT *'
				. ' FROM #__hwdrm_vs_settings'
				. ' WHERE id IN ( '.$cids.' )'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$row->value = stripslashes($row->value);
			$row->value = stripslashes($row->value);
			$row->value = addslashes($row->value);

			$config .= "  var \$".$row->setting." = '".$row->value."';\n";
		}
		$config .= "\n/**\n";
		$config .= "  * get_instance\n";
		$config .= "  *	Description:\n";
		$config .= "  *		This function is used to instantiate the object\n";
		$config .= "  * 		and ensure only one of this type exists at any\n";
		$config .= "  *		time. It returns a reference to the only Config\n";
		$config .= "  *		instance.\n";
		$config .= "  *	Parameters:\n";
		$config .= "  *		none\n";
		$config .= "  *	Returns:\n";
		$config .= "  *		Config\n";
		$config .= "  **/\n\n";
		$config .= "  function get_instance(){\n";
		$config .= "    \$instanceConfig = new hwd_rm_lt_Config;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = @fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}
	/**
     * Checks version compatibility
     *
     * @return       Nothing
     */
	function compatibility()
	{
		global $mosConfig_live_site, $database;

  		if (file_exists(HWDRM_ADMIN_PATH.'/../com_hwdvideoshare/')) {
			if (@include(HWDRM_ADMIN_PATH.'/../com_hwdvideoshare/version.php')) {
				$version = new hwdVideoShareVersion();
				$LongVersion = $version->getLongVersion();
				if (@isset($LongVersion)) {
					$compatibility[0] = 1;
					$compatibility[1] = "<span style=\"color:#458B00;\">".$LongVersion."</span>";
				} else {
					$compatibility[0] = 0;
					$compatibility[1] = "<span style=\"color:#cc3300;\">"._HWDRM_INFO_CONFIGF8."</span>";
				}
   			} else {
 				$compatibility[0] = 0;
 				$compatibility[1] = "<span style=\"color:#cc3300;\">"._HWDRM_INFO_CONFIGF7."</span>";
  			}
  		} else {
			$compatibility[0] = 0;
  			$compatibility[1] = "<span style=\"color:#cc3300;\">"._HWDRM_INFO_CONFIGF6."</span>";
  		}

  		if (file_exists(HWDRM_ADMIN_PATH.'/../com_hwdphotoshare/')) {
			if (@include(HWDRM_ADMIN_PATH.'/../com_hwdphotoshare/version.php')) {
				$version = new hwdPhotoShareVersion();
				$LongVersion = $version->getLongVersion();
				if (@isset($LongVersion)) {
					$compatibility[2] = 1;
					$compatibility[3] = "<span style=\"color:#458B00;\">".$LongVersion."</span>";
				} else {
					$compatibility[2] = 0;
					$compatibility[3] = "<span style=\"color:#cc3300;\">"._HWDRM_INFO_CONFIGF8."</span>";
				}
   			} else {
 				$compatibility[2] = 0;
 				$compatibility[3] = "<span style=\"color:#cc3300;\">"._HWDRM_INFO_CONFIGF7."</span>";
  			}
  		} else {
			$compatibility[2] = 0;
  			$compatibility[3] = "<span style=\"color:#cc3300;\">"._HWDRM_INFO_CONFIGF6."</span>";
  		}

  		return $compatibility;

	}
?>