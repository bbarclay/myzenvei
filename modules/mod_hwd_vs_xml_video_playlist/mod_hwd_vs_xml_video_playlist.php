<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $mainframe, $option, $smartyvs;

if (!file_exists(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS)) {
	echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">The hwdVideoShare component is not installed, you can not use this module.</div>"; return;
}

$db =& JFactory::getDBO();
$my = & JFactory::getUser();
require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'initialise.php');
hwdvsInitialise::coreRequire();
hwdvsInitialise::language();
hwdvsInitialise::template();
hwdvsInitialise::mysqlQuery();
hwdvsInitialise::definitions();

if (@_HWD_VS_PLUGIN_COMPS !== 214) {
	echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">This module is not compatible with your version of hwdVideoShare.</div>"; return;
}

$c = hwd_vs_Config::get_instance();
$video_id = JRequest::getInt( 'video_id', null );

/* Security Note: These values are auto-sanitized by mosGetParam() */
$hwdvids_params['playlist']		= $params->get( 'playlist', 'mostviewed_alltime');
$hwdvids_params['single_id']	= (int)$params->get( 'single_id', '0');
$hwdvids_params['width'] 		= (int)$params->get( 'width', '320');
$hwdvids_params['height'] 		= (int)$params->get( 'height', '240');
$hwdvids_params['autostart'] 	= (int)$params->get( 'autostart', '1');
$hwdvids_params['extended'] 	= (int)$params->get( 'extended', '1');

$hwdvids_params['thumb_width'] 		= (int)$params->get( 'thumb_width', '60');
$hwdvids_params['mod_hwd_itemid'] 	= (int)$params->get( 'mod_hwd_itemid', '0');
$hwdvids_params['trunc_title'] 		= (int)$params->get( 'trunc_title', '');
$hwdvids_params['trunc_descr'] 		= (int)$params->get( 'trunc_descr', '');
$hwdvids_params['showtt'] 		    = (int)$params->get( 'showtt', '0');

if ($hwdvids_params['mod_hwd_itemid'] == 0) {
	$hwdvids_params['mod_hwd_itemid'] = hwd_vs_tools::generateValidItemid();
}

if ($hwdvids_params['showtt'] == 0) {
	$tooltip = false;
} else {
	$tooltip = true;
}

if ($hwdvids_params['playlist'] == "single") {
	// get video details
	$query = 'SELECT *'
			. ' FROM #__hwdvidsvideos'
			. ' WHERE id = '.$hwdvids_params['single_id']
			. ' AND published = 1'
			. ' AND approved = "yes"'
			;
	$db->SetQuery( $query );
	$row = $db->loadObject();

	if (empty($row->id)) {
		echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">This video (ID ".$hwdvids_params['single_id'].") can not be played. Check that it exists and is published and approved.</div>"; return;
	}
	$video_player = hwd_vs_tools::generateVideoPlayer( $row, $hwdvids_params['width'], $hwdvids_params['height'], $hwdvids_params['autostart'] );
} else if ($hwdvids_params['playlist'] == "random") {
	// get video details
	$query = 'SELECT *'
			. ' FROM #__hwdvidsvideos'
			. ' WHERE published = 1'
			. ' AND approved = "yes"'
			. ' ORDER BY rand()'
			. ' LIMIT 0, 1'
			;
	$db->SetQuery( $query );
	$row = $db->loadObject();

	if (empty($row->id)) {
		echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">This video (ID ".$hwdvids_params['single_id'].") can not be played. Check that it exists and is published and approved.</div>"; return;
	}
	$video_player = hwd_vs_tools::generateVideoPlayer( $row, $hwdvids_params['width'], $hwdvids_params['height'], $hwdvids_params['autostart'] );
} else {
	// parse xml playlists
	require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xmlparse.class.php');
	$parser = new HWDVS_xmlParse();
	$parsed_list = $parser->parse($hwdvids_params['playlist']);

	if (count($parsed_list) > 0) {
		$row->video_id = "";
		$row->video_type = "playlist";
		$row->playlist = JURI::base( true )."/components/com_hwdvideoshare/xml/xspf/".$hwdvids_params['playlist'].".xml";
		$video_player = hwd_vs_tools::generateVideoPlayer( $row, $hwdvids_params['width'], $hwdvids_params['height'], $hwdvids_params['autostart'] );

		if ($hwdvids_params['extended'] == 1) {
			$smartyvs->assign("print_extended", 1);
			$random = rand();
			$smartyvs->assign("random", $random);
			$list = hwd_vs_tools::generateVideoListFromXml($parsed_list, $hwdvids_params['thumb_width'], $hwdvids_params['mod_hwd_itemid'], $tooltip, $hwdvids_params['trunc_title'], $hwdvids_params['trunc_descr'], "hwdvs_insert_playlist_video");
			$smartyvs->assign("list", $list);

			$hwdvs_ajax_video_js = "<script language=\"javascript\" type=\"text/javascript\">
						<!--
						//Browser Support Code
						function hwdvs_insert_playlist_video(video_id){

							var ajaxRequest;  // The variable that makes Ajax possible!

							document.getElementById('hwdvs_player_container".$random."').style.padding = \"0\";
							document.getElementById('hwdvs_player_container".$random."').style.margin = \"0\";
							document.getElementById('hwdvs_player_container".$random."').innerHTML = '<div style=\"padding:5px;\">Loading...<br /><img src=\"".JURI::root( true )."/plugins/community/hwdvideoshare/loading.gif\"></div>';

							try{
								// Opera 8.0+, Firefox, Safari
								ajaxRequest = new XMLHttpRequest();
							} catch (e){
								// Internet Explorer Browsers
								try{
									ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
								} catch (e) {
									try{
										ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
									} catch (e){
										// Something went wrong
										alert(\"Your browser broke!\");
										return false;
									}
								}
							}
							// Create a function that will receive data sent from the server
							ajaxRequest.onreadystatechange = function(){
								if(ajaxRequest.readyState == 4){
									document.getElementById('hwdvs_player_container".$random."').style.padding = \"0\";
									document.getElementById('hwdvs_player_container".$random."').style.margin = \"0\";
									document.getElementById('hwdvs_player_container".$random."').innerHTML = ajaxRequest.responseText;

									var theInnerHTML = ajaxRequest.responseText;
									var theID = 'hwdvs_player_container".$random."';
									setAndExecute(theID,theInnerHTML);
								}
							}
							ajaxRequest.open(\"GET\", \"".JURI::root( true )."/index.php?option=com_hwdvideoshare&task=grabajaxplayer&Itemid=".$hwdvids_params['mod_hwd_itemid']."&template=mod_hwd_vs_video_playlist_container&video_id=\" + video_id, true);
							ajaxRequest.send(null);

							function setAndExecute(divId, innerHTML)
							{
								var div = document.getElementById(divId);
								div.innerHTML = innerHTML;
								var x = div.getElementsByTagName(\"script\");
								for(var i=0;i<x.length;i++)
								{
									eval(x[i].text);
								}
							}
						}

						//-->
					 </script>";
			$mainframe->addCustomHeadTag($hwdvs_ajax_video_js);
		}
	} else {
		echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">There are no videos in this playlist (".$hwdvids_params['playlist'].")</div>"; return;
	}
}

$smartyvs->assign("hwdvids_params", $hwdvids_params);
$smartyvs->assign("video_player", $video_player);
$smartyvs->display('mod_hwd_vs_video_playlist.tpl');
return;
?>
