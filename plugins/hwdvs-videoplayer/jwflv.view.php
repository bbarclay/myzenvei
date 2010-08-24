<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC3.5
 */
class hwd_vs_videoplayer {
    /**
     * Prepares the code to insert the third party video
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $flv_width  the video width
     * @param int    $flv_height  the video height
     * @return       $code   the third party embed code
     */
    function prepareplayer($flv_url, $flv_width=427, $flv_height=340, $ui=0, $mediatype="video", $flv_path=null, $thumb_url=null, $autostart=null, $video_id=null)
	{
		global $task, $smartyvs, $option, $show_longtail, $longtail_c, $longtail_d, $longtail_s, $mainframe;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code=null;

		$getFlashVars = hwd_vs_videoplayer::getFlashVars($flv_url, $flv_width, $flv_height, $ui, $mediatype, $flv_path, $thumb_url, $autostart);
		$flashvars15 = $getFlashVars->flashvars15;
		$flashvars21 = $getFlashVars->flashvars21;

		if (!defined( '_HWD_VS_SWFOFLAG' )) {
			define( '_HWD_VS_SWFOFLAG', 1 );

			if ($c->swfobject == 1) {
				$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdvideoshare/assets/js/swfobject1.5.js"></script>');
			} else {
				$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdvideoshare/assets/js/swfobject2.1.js"></script>');
			}

			if (($c->loadmootools == "on") && (strpos(JURI::base(true), "/administrator") === false)) {
				JHTML::_('behavior.mootools');
			}

		}
		if ($show_longtail && !defined( '_HWD_VS_LTFLAG' )) {
			$divid="mediaspace";
		} else {
			$divid="flashcontent_".$ui;
		}

		if ($c->swfobject == 1) {

			$code.="<div id=\"".$divid."\" name=\"".$divid."\" style=\"text-align:inherit;height:100%;width:100%;\">"._HWDVIDS_INFO_ENABLEJAVA."</div>
					<script type=\"text/javascript\">";
					if ($c->ieoa_fix == 1) { $code.='window.addEvent(\'domready\', function(){'; }
			$code.="					   var so_".$ui." = new SWFObject(\"".JURI::root()."plugins/hwdvs-videoplayer/jwflv/mediaplayer.swf?".rand()."\", \"hwdvideo_".$ui."\", \"".$getFlashVars->param_width."\", \"".$getFlashVars->param_height."\", \"8\", \"#".$getFlashVars->param_bgcolor."\");
										   so_".$ui.".addVariable(\"width\",\"".$getFlashVars->param_width."\");
										   so_".$ui.".addVariable(\"height\",\"".$getFlashVars->param_height."\");
										   so_".$ui.".addParam(\"allowfullscreen\", \"true\");
										   so_".$ui.".addParam(\"allowscriptaccess\", \"never\");
										   so_".$ui.".addParam(\"quality\", \"high\");
										   so_".$ui.".addParam(\"wmode\", \"transparent\");
										   so_".$ui.".addParam(\"flashvars\",\"".$flashvars15."\");";
			if ($show_longtail && !defined( '_HWD_VS_LTFLAG' )) {
				$code.="                   so_".$ui.".addVariable(\"ltas.cc\", \"".$longtail_c."\");
                                           so_".$ui.".addVariable(\"plugins\", \"ltas\");";
			}
			$code.="					   so_".$ui.".write(\"".$divid."\");";
					if ($c->ieoa_fix == 1) { $code.='});'; }
			$code.="</script>";

			if ($show_longtail && !defined( '_HWD_VS_LTFLAG' )) {
				$code.='<script type="text/javascript" src="http://www.ltassrv.com/AdSrv/js/?cc='.$longtail_c.'"></script>';
				define( '_HWD_VS_LTFLAG', 1 );
			}

		} else {

			$dynamicheader = '<script type="text/javascript">

									var flashvars = {
									  '.$flashvars21.'
									};
									var params = {
									  menu: "false",
									  allowfullscreen: "true",
									  allowscriptaccess: "never",
									  quality: "high",
									  wmode: "transparent"
									};

									swfobject.embedSWF("'.JURI::root().'plugins/hwdvs-videoplayer/jwflv/mediaplayer.swf?'.rand().'", "'.$divid.'", "'.$getFlashVars->param_width.'", "'.$getFlashVars->param_height.'", "9.0.0","expressInstall.swf", flashvars, params);

							  </script>';

			$mainframe->addCustomHeadTag($dynamicheader);

    		$code.="<div id=\"".$divid."\" name=\"".$divid."\" style=\"text-align:inherit;height:100%;width:100%;\">"._HWDVIDS_INFO_ENABLEJAVA."</div>";

		}

		return $code;
	}

    function prepareEmbeddedPlayer($flv_url, $flv_width=427, $flv_height=340, $ui=0, $mediatype="video", $flv_path=null, $thumb_url=null, $autostart=null, $video_id=null)
	{
		global $task, $smartyvs, $option, $show_longtail, $longtail_c, $longtail_d, $longtail_s, $mainframe, $Itemid;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code=null;

		$getFlashVars = hwd_vs_videoplayer::getFlashVars($flv_url, $flv_width, $flv_height, $ui, $mediatype, $flv_path, $thumb_url, $autostart);
		$flashvars15 = $getFlashVars->flashvars15;

		if ($show_longtail && !defined( '_HWD_VS_LTFLAG' )) {
			$flashvars15.= '&plugins=ltas&ltas.cc='.$longtail_c;
		}

		$code.='<div';
    	if ($show_longtail && !defined( '_HWD_VS_LTFLAG' )) {
			$code.=' name="mediaspace" id="mediaspace"';
		}
		$code.=' style="text-align:inherit;height:100%;width:100%;">';
		$code.='<embed src="'.JURI::root().'plugins/hwdvs-videoplayer/jwflv/mediaplayer.swf" width="'.$getFlashVars->param_width.'" height="'.$getFlashVars->param_height.'" allowscriptaccess="never" wmode="transparent" allowfullscreen="true" flashvars="'.$flashvars15.'" />';
		$code.='</div>';
		if ($show_longtail && !defined( '_HWD_VS_LTFLAG' )) {
			$code.='<script type="text/javascript" src="http://www.ltassrv.com/AdSrv/js/?cc='.$longtail_c.'"></script>';
			define( '_HWD_VS_LTFLAG', 1 );
		}
		return $code;
	}
    function prepareEmbedCode($flv_url, $flv_width=427, $flv_height=340, $ui=0, $mediatype="video", $flv_path=null, $thumb_url=null, $autostart=null, $video_id=null)
	{
		global $Itemid, $task, $mosConfig_sitename, $option, $mainframe;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code=null;

		$getFlashVars = hwd_vs_videoplayer::getFlashVars($flv_url, $flv_width, $flv_height, $ui, $mediatype, $flv_path, $thumb_url, $autostart, 1, $video_id);
		$flashvars15 = $getFlashVars->flashvars15;

		$getFlashVars->param_width = 427;
	    $getFlashVars->param_height = intval($getFlashVars->param_width*$c->var_fb);

		if ($c->embedreturnlink == 1) {
			$code.='<div><center>';
		}
		$code.='<embed src=&#34;'.JURI::root().'plugins/hwdvs-videoplayer/jwflv/mediaplayer.swf&#34; width=&#34;'.$getFlashVars->param_width.'&#34; height=&#34;'.$getFlashVars->param_height.'&#34; allowscriptaccess=&#34;always&#34; allowfullscreen=&#34;true&#34; flashvars=&#34;'.$flashvars15.'&#34; />';
		if ($c->embedreturnlink == 1) {
			$jconfig = new jconfig();
			$code.='<br /><a href=&#34;'.JURI::root().'index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&#34; title=&#34;'.$jconfig->sitename.'&#34;>'.$jconfig->sitename.'</a></center></div>';
		}
		return $code;
	}
	/**
	* Compiles information to add or edit a plugin
	* @param string The current GET/POST option
	* @param integer The unique id of the record to edit
	*/
	function getMyParams($element) {

		$plugin =& JPluginHelper::getPlugin('hwdvs-videoplayer', $element);
		$pluginParams = new JParameter( $plugin->params );
		return $pluginParams;

	}
	/**
	* Compiles information to add or edit a plugin
	* @param string The current GET/POST option
	* @param integer The unique id of the record to edit
	*/
	function getFlashVars($flv_url, $flv_width, $flv_height, $ui, $mediatype, $flv_path, $thumb_url, $autostart, $embed=0, $video_id=null)
	{
		global $smartyvs, $option, $Itemid, $show_longtail, $longtail_c, $longtail_d, $longtail_s, $mainframe;

		$c = hwd_vs_Config::get_instance();

		$params = hwd_vs_videoplayer::getMyParams('jwflv');

		if (isset($flv_width) && !empty($flv_width)) {
			$param_width = $flv_width;
		} else {
			$param_width = $c->flvplay_width;
		}
		if (isset($flv_height) && !empty($flv_height)) {
			$param_height = $flv_height;
		} else {
			$param_height = $param_width*$c->var_fb;
		}

		$param_height = intval($param_height+19);

		$param_bgcolor = $params->get('bgcolor', '333333');
		$param_fgcolor = $params->get('fgcolor', 'cccccc');
		$param_lightcolor = $params->get('lightcolor', 'ffffff');
		$param_screencolor = $params->get('screencolor', '000000');
		$param_link = urlencode($params->get('link', null));
		$param_start = $params->get('start', null);
		$param_controlbar = $params->get('controlbar', 'bottom');
		$param_logo = $params->get('logo', null);
		$param_skin = $params->get('skin', null);
		$param_autostart = $params->get('autostart', null);
		$param_bufferlength = $params->get('bufferlength', '5');
		$param_displayclick = $params->get('displayclick', 'play');
		$param_fullscreen = $params->get('fullscreen', 'true');
		$param_mute = $params->get('mute', 'false');
		$param_quality = $params->get('quality', 'true');
		$param_repeat = $params->get('repeat', 'false');
		$param_stretching = $params->get('stretching', 'uniform');
		$param_volume = $params->get('volume', '60');
		$param_abouttext = $params->get('abouttext', '');
		$param_aboutlink = $params->get('aboutlink', '');
		$param_linktarget = $params->get('linktarget', '0');

		$flashvars15 = "&file=".$flv_url;
		$flashvars21 = "file:\"".$flv_url."\"";
		if ($param_linktarget == 0) {
		  $flashvars15.= "&linktarget=_blank";
		  $flashvars21.= ",linktarget:\"_blank\"";
		} else if ($param_linktarget == 1) {
		  $flashvars15.= "&linktarget=_self";
		  $flashvars21.= ",linktarget:\"_self\"";
		} else if ($param_linktarget == 2) {
		  $flashvars15.= "&linktarget=_parent";
		  $flashvars21.= ",linktarget:\"_parent\"";
		} else if ($param_linktarget == 3) {
		  $flashvars15.= "&linktarget=_top";
		  $flashvars21.= ",linktarget:\"_top\"";
		}
		if ($embed == 1) {
		  $link = urlencode(JURI::root()."index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=viewvideo&video_id=".$video_id);
		  $flashvars15.= "&link=".$link;
		  $flashvars21.= ",link:\"".$link."\"";
		} else if (isset($param_link) && !empty($param_link)) {
		  $flashvars15.= "&link=".$param_link;
		  $flashvars21.= ",link:\"".$param_link."\"";
		}
		if (isset($param_start) && !empty($param_start)) {
		  $flashvars15.= "&start=".$param_start;
		  $flashvars21.= ",start:\"".$param_start."\"";
		}
		if (isset($param_logo) && !empty($param_logo)) {
		  $flashvars15.= "&logo=".$param_logo;
		  $flashvars21.= ",logo:\"".$param_logo."\"";
		}
		if (isset($param_skin) && !empty($param_skin)) {
		  $flashvars15.= "&skin=".$param_skin;
		  $flashvars21.= ",skin:\"".$param_skin."\"";
		}
		if (isset($param_bufferlength) && !empty($param_bufferlength)) {
		  $flashvars15.= "&bufferlength=".$param_bufferlength;
		  $flashvars21.= ",bufferlength:\"".$param_bufferlength."\"";
		}
		if (isset($param_volume) && !empty($param_volume)) {
		  $flashvars15.= "&volume=".$param_volume;
		  $flashvars21.= ",volume:\"".$param_volume."\"";
		}
		if ($param_controlbar == 1) {
		  $flashvars15.= "&controlbar=over";
		  $flashvars21.= ",controlbar:\"over\"";
		} else if ($param_controlbar == 2) {
		  $flashvars15.= "&controlbar=none";
		  $flashvars21.= ",controlbar:\"none\"";
		}
		if ($embed == 1) {
		  $flashvars15.= "&autostart=false";
		  $flashvars21.= ",autostart:\"false\"";
		} else if (isset($autostart) && $autostart == "0") {
		  $flashvars15.= "&autostart=false";
		  $flashvars21.= ",autostart:\"false\"";
		} else if ($param_autostart == 1 || (isset($autostart) && $autostart == "1")) {
		  $flashvars15.= "&autostart=true";
		  $flashvars21.= ",autostart:\"true\"";
		}
		if ($embed == 1) {
		  $flashvars15.= "&displayclick=link";
		  $flashvars21.= ",displayclick:\"link\"";
		} else if ($param_displayclick == 1) {
		  $flashvars15.= "&displayclick=link";
		  $flashvars21.= ",displayclick:\"link\"";
		} else if ($param_displayclick == 2) {
		  $flashvars15.= "&displayclick=fullscreen";
		  $flashvars21.= ",displayclick:\"fullscreen\"";
		} else if ($param_displayclick == 3) {
		  $flashvars15.= "&displayclick=mute";
		  $flashvars21.= ",displayclick:\"mute\"";
		} else if ($param_displayclick == 4) {
		  $flashvars15.= "&displayclick=next";
		  $flashvars21.= ",displayclick:\"next\"";
		} else if ($param_displayclick == 5) {
		  $flashvars15.= "&displayclick=none";
		  $flashvars21.= ",audisplayclick:\"none\"";
		}
		if ($param_fullscreen == 0) {
		  $flashvars15.= "&fullscreen=false";
		  $flashvars21.= ",fullscreen:\"false\"";
		}
		if ($param_mute == 1) {
		  $flashvars15.= "&mute=true";
		  $flashvars21.= ",mute:\"true\"";
		}
		if ($param_quality == 0) {
		  $flashvars15.= "&quality=high";
		  $flashvars21.= ",quality:\"high\"";
		}
		if ($param_repeat == 1) {
		  $flashvars15.= "&repeat=always";
		  $flashvars21.= ",repeat:\"always\"";
		} else if ($mediatype == "playlist") {
		  $flashvars15.= "&repeat=list";
		  $flashvars21.= ",repeat:\"list\"";
		}
		if ($param_stretching == 1) {
		  $flashvars15.= "&stretching=fill";
		  $flashvars21.= ",stretching:\"fill\"";
		} else if ($param_stretching == 2) {
		  $flashvars15.= "&stretching=exactfit";
		  $flashvars21.= ",stretching:\"exactfit\"";
		} else if ($param_stretching == 3) {
		  $flashvars15.= "&stretching=none";
		  $flashvars21.= ",stretching:\"none\"";
		}
		if (isset($param_abouttext) && !empty($param_abouttext)) {
		  $flashvars15.= "&abouttext=".$param_abouttext;
		  $flashvars21.= ",abouttext:\"".$param_abouttext."\"";
		}
		if (isset($param_aboutlink) && !empty($param_aboutlink)) {
		  $flashvars15.= "&aboutlink=".$param_aboutlink;
		  $flashvars21.= ",aboutlink:\"".$param_aboutlink."\"";
		}
		$flashvars15.= "&backcolor=".$param_bgcolor;
		$flashvars21.= ",backcolor:\"".$param_bgcolor."\"";
		$flashvars15.= "&frontcolor=".$param_fgcolor;
		$flashvars21.= ",frontcolor:\"".$param_fgcolor."\"";
		$flashvars15.= "&lightcolor=".$param_lightcolor;
		$flashvars21.= ",lightcolor:\"".$param_lightcolor."\"";
		$flashvars15.= "&screencolor=".$param_screencolor;
		$flashvars21.= ",screencolor:\"".$param_screencolor."\"";
		if ($mediatype == "remote" || $mediatype == "video") {
			$flashvars15.= "&type=video";
			$flashvars21.= ",type:\"video\"";
		}
		if (($mediatype !== "playlist") && !empty($thumb_url)) {
			$flashvars15.= "&image=".urlencode($thumb_url);
			$flashvars21.= ",image:\"".urlencode($thumb_url)."\"";
		}

		$smartyvs->assign("player_width", $param_width);

		$code->flashvars15 = $flashvars15;
		$code->flashvars21 = $flashvars21;
		$code->param_width = $param_width;
		$code->param_height = $param_height;
		$code->param_bgcolor = $param_bgcolor;

		return $code;

	}
}
?>