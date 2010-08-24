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
    function prepareplayer($flv_url, $flv_width=427, $flv_height=340, $ui=0, $mediatype="video", $flv_path=null, $thumb_url=null)
	{
		$code = hwd_vs_videoplayer::prepareEmbeddedPlayer($flv_url, $flv_width, $flv_height, $ui, $mediatype, $flv_path, $thumb_url);
		return $code;
	}
    function prepareEmbeddedPlayer($flv_url, $flv_width=427, $flv_height=340, $ui=0, $mediatype="video", $flv_path=null, $thumb_url=null)
	{
		global $task, $smartyvs, $option, $show_longtail, $longtail_channel, $mainframe;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code=null;

		$params = $this->getMyParams('flow');

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

	    $param_height = intval($param_height+24);

		$smartyvs->assign("player_width", $param_width);
		$ui = rand(100, 999);

	    $param_accelerated = $params->get('accelerated', 0);
	    $param_autoBuffering = $params->get('autoBuffering', 1);
	    $param_autoPlay = $params->get('autoPlay', 0);
	    $param_repeat = $params->get('repeat', 0);
	    $param_bufferLength = $params->get('bufferLength', 3);
	    $param_linkUrl = $params->get('linkUrl', '');
	    $param_scaling = $params->get('scaling', 0);

		$clip_param = "";
		if ($param_accelerated == 1) {
		  $clip_param.= "accelerated: true,";
		} else if ($param_accelerated == 0) {
		  $clip_param.= "accelerated: false,";
		}
		if ($param_autoBuffering == 1) {
		  $clip_param.= "autoBuffering: true,";
		} else if ($param_autoBuffering == 0) {
		  $clip_param.= "autoBuffering: false,";
		}
		if ($param_autoPlay == 1) {
		  $clip_param.= "autoPlay: true,";
		  $autoPlay = "true";
		} else if ($param_autoPlay == 0) {
		  $clip_param.= "autoPlay: false,";
		  $autoPlay = "false";
		}
		$clip_param.= "bufferLength: ".$param_bufferLength.",";
		if (isset($param_linkUrl) && !empty($param_linkUrl)) {
			$clip_param.= "linkUrl: ".$param_linkUrl.",";

		}
		if ($param_scaling == 0) {
			$clip_param.= "scaling: \"scale\",";
		} else if ($param_scaling == 1) {
			$clip_param.= "scaling: \"fit\",";
		} else if ($param_scaling == 2) {
			$clip_param.= "scaling: \"half\",";
		} else if ($param_scaling == 3) {
			$clip_param.= "scaling: \"orig\",";
		}

		if (($c->loadmootools == "on") && (strpos(JURI::base(true), "/administrator") === false)) {
			JHTML::_('behavior.mootools');
		}

		if ($mediatype == "playlist") {

			// parse xml playlists
			require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xmlparse.class.php');
			$parser = new HWDVS_xmlParse();
			$path = 'xspf'.DS.@basename($flv_url, ".xml");
			$parsed_list = $parser->parse($path);

			if (count($parsed_list) > 0) {
				$preRoll = false;
				$flv_url = '';
				for ($i=0, $n=count($parsed_list); $i < $n; $i++)
				{
					$pos = strpos($parsed_list[$i]['location'], "http");
					if ($pos === false) {
						$vURL = 'http://'.$_SERVER['HTTP_HOST'].$parsed_list[$i]['location'];
					} else {
						$vURL = $parsed_list[$i]['location'];
					}
					$flv_url[$i] = urlencode($vURL);
				}
			} else {
				$preRoll = true;
			}

		}

		$code.='<script src="'.JURI::root().'plugins/hwdvs-videoplayer/flow/flowplayer-3.0.2.min.js"></script>
				<a
					style="display:block;width:'.$param_width.'px;height:'.$param_height.'px;"
					id="hwdvideo_'.$ui.'">
				</a>
				<script language="JavaScript">';
				//if ($c->ieoa_fix == 1) { $code.='window.addEvent(\'domready\', function(){'; } else { /* $code.='function goFlash() {'; */ }
				if ($c->ieoa_fix == 1) { $code.='window.addEvent(\'domready\', function(){'; } else { $code.='function goFlash() {'; }
		$code.='flowplayer("hwdvideo_'.$ui.'", {src: "'.JURI::root().'plugins/hwdvs-videoplayer/flow/flowplayer-3.0.2.swf", wmode: "transparent"}, {
					type: "video",';

		  if ($mediatype == "playlist" && !$preRoll) {

			$code.='plugins:  {
			          controls: {
			            playlist: true,
			          }
			        },';

		  }
		  if ($mediatype == "playlist" && $preRoll) {

			$code.='plugins: {
						controls:  {display: \'none\' }
					},';

		  }
		$code.='	clip: {
                        '.$clip_param.'
                        url: \''.$flv_url.'\'
                    },';

        $data = '';

		  if (!empty($thumb_url)) { $data.= '{url:\''.$thumb_url.'\', autoPlay: true},'; }

		  if ($mediatype == "playlist") {

			if (!empty($flv_url[0])) { $data.= '\''.$flv_url[0].'\','; }

			for ($i=1, $n=count($flv_url); $i < $n; $i++)
			{
				if (!empty($flv_url[$i])) {
					if (empty($flv_url[$i+1]) && $param_repeat == "1") {
										   $data.= '{url:\''.$flv_url[$i].'\', autoPlay: true, onStart: function() { this.getControls().show(); }, onBeforeFinish: function ()  { return false; }}';
					} else if (empty($flv_url[$i+1]) && $param_repeat == "0") {
										   $data.= '{url:\''.$flv_url[$i].'\', autoPlay: true, onStart: function() { this.getControls().show(); } }';
					} else {
										   $data.= '{url:\''.$flv_url[$i].'\', autoPlay: true, onStart: function() { this.getControls().show(); } },';
					}
				}
			}

			//if (!empty($flv_url[1])) {
			//	if (empty($flv_url[2]) && $param_repeat == "1") {
			//						   $data.= '{url:\''.$flv_url[1].'\', autoPlay: true, onStart: function() { this.getControls().show(); }, onBeforeFinish: function ()  { return false; }}';
			//	} else if (empty($flv_url[2]) && $param_repeat == "0") {
			//						   $data.= '{url:\''.$flv_url[1].'\', autoPlay: true, onStart: function() { this.getControls().show(); } }';
			//	} else {
			//						   $data.= '{url:\''.$flv_url[1].'\', autoPlay: true, onStart: function() { this.getControls().show(); } },';
			//	}
			//}
			//
			//if (!empty($flv_url[2])) { $data.= '{url:\''.$flv_url[2].'\', autoPlay: true, onBeforeFinish: function ()  { return false; }}'; }

		  } else {

			if (!empty($flv_url[1])) {
				if ( $param_repeat == "1") {
									   $data.= '{url:\''.$flv_url.'\', autoPlay: '.$autoPlay.', onBeforeFinish: function ()  { return false; }}';
				} else {
									   $data.= '{url:\''.$flv_url.'\', autoPlay: '.$autoPlay.'}';
				}
			}

		  }

		$code.='    playlist: ['.$data.']';
		$code.='});';
				//if ($c->ieoa_fix == 1) { $code.='});'; } else { /* $code.='} goFlash();'; */ }
				if ($c->ieoa_fix == 1) { $code.='});'; } else { $code.='} goFlash();'; }
		$code.='</script>';

		return $code;
	}
    function prepareEmbedCode($flv_url, $flv_width=427, $flv_height=340, $ui=0, $mediatype="video", $flv_path=null, $thumb_url=null)
	{
		global $task, $mosConfig_sitename, $option, $mainframe;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

	    $param_width = 427;
	    $param_height = $param_width*$c->var_fb;

		$code=null;

		if ($c->embedreturnlink == 1) {
			$code.='<div><center>';
		}
		$code.="<embed id=&#34;hwdvideo&#34; width=&#34;".$param_width."&#34; height=&#34;".$param_height."&#34; flashvars=&#34;config={";

		$code.="'type':'video',";
		$code.="'clip':{'url':'".$flv_url."'}";
		$code.=",'playerId':'hwdvideo','playlist':[{'url':'".$flv_url."'}]}";
		$code.="&#34; bgcolor=&#34;#000000&#34; pluginspage=&#34;http://www.adobe.com/go/getflashplayer&#34; type=&#34;application/x-shockwave-flash&#34; quality=&#34;high&#34; allowscriptaccess=&#34;always&#34; allowfullscreen=&#34;true&#34; src=&#34;".JURI::root()."plugins/hwdvs-videoplayer/flow/flowplayer-3.0.2.swf&#34;/>";

		if ($c->embedreturnlink == 1) {
			$jconfig = new jconfig();
			$code.='<br /><a href=&#34;'.JURI::root().'&#34; title=&#34;'.$jconfig->sitename.'&#34;>'.$jconfig->sitename.'</a></center></div>';
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
}
?>