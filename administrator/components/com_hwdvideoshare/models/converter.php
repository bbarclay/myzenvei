<?php
/**
 *    @version [ Dannevirke ]
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

class hwdvids_BE_converter
{
   /**
	* show converter
	*/
	function converter()
	{
		global $database, $mainframe, $limit, $limitstart;
		hwdvids_HTML::converter();
	}
   /**
	* start converter
	*/
	function startconverter()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved = \"queuedforconversion\""
							);
		$total1 = $db->loadResult();
		echo $db->getErrorMsg();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved = \"queuedforthumbnail\""
							);
		$total2 = $db->loadResult();
		echo $db->getErrorMsg();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved LIKE \"converting%\""
							);
		$total3 = $db->loadResult();
		echo $db->getErrorMsg();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved = \"queuedforswf\""
							);
		$total4 = $db->loadResult();
		echo $db->getErrorMsg();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved = \"queuedformp4\""
							);
		$total5 = $db->loadResult();
		echo $db->getErrorMsg();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved = \"re-generate_thumb\""
							);
		$total6 = $db->loadResult();
		echo $db->getErrorMsg();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsvideos AS a"
							. "\nWHERE a.approved = \"re-calculate_duration\""
							);
		$total7 = $db->loadResult();
		echo $db->getErrorMsg();

		hwdvids_HTML::startconverter($total1, $total2, $total3, $total4, $total5, $total6, $total7);
	}
   /**
	* reset failed conversions
	*/
	function resetfconv()
	{
		global $option, $mainframe, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$video_id = Jrequest::getInt( 'video_id', '' );
		$new_status = Jrequest::getVar( 'new_status', '' );

		if (!empty($video_id) && !empty($new_status)) {

			$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = '".$new_status."' WHERE id = ".$video_id);
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdvideoshare&task=videos' );
			exit();

		}

		$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = 'queuedforconversion' WHERE approved LIKE 'converting_queuedforcon%'");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = 'queuedforthumbnail' WHERE approved LIKE 'converting_queuedforthu%'");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = 'queuedforswf' WHERE approved LIKE 'converting_queuedforswf%'");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = 'queuedformp4' WHERE approved LIKE 'converting_queuedformp4%'");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = 're-calculate_duration' WHERE approved LIKE 'converting_re-calculate_duration%'");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("UPDATE #__hwdvidsvideos SET approved = 're-generate_thumb' WHERE approved LIKE 'converting_re-generate_thumb%'");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=startconverter' );
		exit();
	}

   /**
	* start converter
	*/
	function ajaxReconvertFLV()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();
		echo "<div><b>Still under development.</b></div>";
		exit;

	}
   /**
	* start converter
	*/
	function ajaxReconvertMP4()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();
		echo "<div><b>Still under development.</b></div>";
		exit;

	}

   /**
	* start converter
	*/
	function ajaxMoveMoovAtom()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$video_id = Jrequest::getInt( 'cid', '' );

        $db->SetQuery( 'SELECT video_id FROM #__hwdvidsvideos WHERE id = '.$video_id );
        $video_id = $db->loadResult();

		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__ConversionTools.php");
		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__MoveMoovAtom.php");

		$path_mp4 = JPATH_SITE."/hwdvideos/uploads/".$video_id.".mp4";

		$MoveMoovAtom = hwd_vs_MoovAtom::move($path_mp4);

		print $MoveMoovAtom[3];

		exit;

	}

   /**
	* start converter
	*/
	function ajaxRecalculateDuration()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$video_id = Jrequest::getInt( 'cid', '' );

        $db->SetQuery( 'SELECT video_id, thumb_snap FROM #__hwdvidsvideos WHERE id = '.$video_id );
        $row = $db->loadObject();

		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__ConversionTools.php");
		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__ExtractDuration.php");

		$path_new_flv = JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".flv";

		$ExtractDuration = hwd_vs_ExtractDuration::extract($path_new_flv, '');

		print $ExtractDuration[3];

		exit;

	}

   /**
	* start converter
	*/
	function ajaxRegenerateImage()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$video_id = Jrequest::getInt( 'cid', '' );

        $db->SetQuery( 'SELECT video_id, thumb_snap FROM #__hwdvidsvideos WHERE id = '.$video_id );
        $row = $db->loadObject();

		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__ConversionTools.php");
		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__GenerateThumbnail.php");

		$path_base  = JPATH_SITE."/hwdvideos";
		$path_new_flv = JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".flv";
		$filename_noext = $row->video_id;
		$filename_ext = '';

		$GenerateThumbnail = hwd_vs_GenerateThumbnail::draw($path_base, $path_new_flv, $filename_noext, $filename_ext, $row->thumb_snap);

		print $GenerateThumbnail[9];

		exit;

	}

   /**
	* start converter
	*/
	function ajaxReinsertMetaFLV()
	{
		global $database, $mainframe, $mosConfig_live_site, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$video_id = Jrequest::getInt( 'cid', '' );

        $db->SetQuery( 'SELECT video_id FROM #__hwdvidsvideos WHERE id = '.$video_id );
        $video_id = $db->loadResult();

		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__ConversionTools.php");
		include_once(JPATH_SITE."/components/com_hwdvideoshare/converters/__InjectMetaData.php");

		$path_new_flv = JPATH_SITE."/hwdvideos/uploads/".$video_id.".flv";
		$filename_ext = '';

		$InjectMetaData = hwd_vs_InjectMetaData::inject($path_new_flv);

		print $InjectMetaData[4];

		exit;

	}

}
?>