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
 * Process character encoding
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpsCarousel {

    function setupSlider($iCID, $params)
    {

		global $mainframe;
        $c = hwd_ps_Config::get_instance();

		$width_m = '100%';
		$height_m = $params['isize']+$c->resize_thumb+20;
		$height_m = $height_m.'px';

		$width_f = intval((($params['novtd'])*$c->resize_thumb)+(10*$params['novtd']));
		$width_f = $width_f."px";
		$margin_f = $params['isize']+20;
		$margin_f = $margin_f.'px';

		$margin = 0;
		//$margin = ((($params['novtd'])*$c->resize_thumb)+(10*$params['novtd']))/2;
        //$margin = intval($margin-($c->resize_thumb/2)+8);
		$margin = -($params['isize']/2)-6;
		$margin = $margin."px";

		$size = $params['isize']+10;

        $js =  '<script type="text/javascript">

				window.addEvent("domready", function() {
					var ex6Carousel = new iCarousel("'.$iCID.'_content", {
						idPrevious: "'.$iCID.'_previous",
						idNext: "'.$iCID.'_next",
						idToggle: "undefined",
						item: {
							klass: "'.$iCID.'_item",
							size: '.$size.'
						},
						animation: {
							type: "scroll",
							duration: 1000,
							amount: 1
						}
					});
		';
					for ($i=0, $n=$params['novtd']; $i < $n; $i++) {

        				$js.=  '$("thumb'.$i.'").addEvent("click", function(event){new Event(event).stop();ex6Carousel.goTo('.$i.')});';

					}

        $js.=  '});

				</script>';

		$css = '<style type="text/css">
					#'.$iCID.' {
					  position: relative;
					  overflow: hidden;
					  width: '.$width_m.';
					  /* height: '.$height_m.'; */
					  /* border: 1px solid #000; */
					  margin: 0 auto;
					}

					#community-wrap #'.$iCID.'_content {
					  margin-left: '.$margin.'!important;
					  padding-left: 50%!important;
					  position: absolute;
					  overflow: hidden;
					}

					#'.$iCID.'_content {
					  margin-left: '.$margin.'!important;
					  padding-left: 50%!important;
					  position: absolute;
					  overflow: hidden;
					}

					#'.$iCID.'_content
					#'.$iCID.'_content li {
					  list-style: none;
					}

					#'.$iCID.'_content {
				      width: 13440px;
					}

					#'.$iCID.' ul li {
				      display: block;
					  float: left;
					  margin: 0!important;
					  padding: 0 5px!important;
					  border: none;
					  background: none!important;
					}

					#'.$iCID.' ul li img {
					  display: block;
					  vertical-align: middle!important;
					  max-width: 400px;
					  max-height: 400px;
					}

					#'.$iCID.'_frame {
					  position: relative;
					  margin: '.$margin_f.' auto 5px auto;
					  width: '.$width_f.';
					}

					#'.$iCID.'_frame ul {
					  margin: 0!important;
					  padding: 0!important;
					}

					#'.$iCID.'_frame ul li {
					  margin: 0 2px!important;
					  padding: 0!important;
					}

					#'.$iCID.'_frame ul li img{
					  border: 1px solid #ccc;
					  padding: 2px;
					}

					#'.$iCID.'_frame ul li img:hover {border: 1px solid #000;}

				</style>';

		$mainframe->addCustomHeadTag($js);
		$mainframe->addCustomHeadTag($css);

    }
    function setupScroller($iCID, $params)
    {

		global $mainframe;
        $c = hwd_ps_Config::get_instance();

		$width = (intval($params['novtd'])*$c->resize_thumb)+(intval($params['novtd'])*18);
		$width = $width."px";
		$height = ($c->resize_thumb)+6;
		$height = intval($height)."px";
		$margin = '-5'; // offset padding
		$margin = $margin."px";
		$size = ($c->resize_thumb)+18;

        $js =  '<script type="text/javascript">

				  window.addEvent("domready", function() {
					  new iCarousel("'.$iCID.'_content", {
						  idPrevious: "'.$iCID.'_prev",
						  idNext: "'.$iCID.'_next",
						  idToggle: "undefined",
						  item: {
							  klass: "'.$iCID.'_item",
							  size: '.$size.'
						  },
						  animation: {
							  type: "fadeNscroll",
							  direction: "left",
							  amount: 1,
							  transition: Fx.Transitions.Cubic.easeInOut,
							  duration: 500,
							  rotate: {
								type: "auto",
								interval: 5000,
								onMouseOver: "stop"
							  }
						  }
					  });
				  });

				</script>';

		$css = '<style type="text/css">
					#'.$iCID.' {
					  position: relative; /* important */
					  overflow: hidden; /* important */
					  width: '.$width.'; /* important */
					  height: '.$height.'; /* important */
					  margin: 0 auto;
					}

					#'.$iCID.'_frame {position: relative}

					#'.$iCID.'_prev {float: right;}

					#'.$iCID.'_next {float: right;}

					#'.$iCID.'_content {
					  position: absolute;
					  top: 0;
					  margin: 0 0 0 '.$margin.'!important;
					  padding: 5px;
					}

					#'.$iCID.'_content
					#'.$iCID.'_content li {
					  list-style: none;
					  margin: 0;
					}

					#'.$iCID.'_content {
						  width: 5418px;
					}

					#'.$iCID.' ul li {
						  display: block;
						  float: left;
						  margin: 3px!important;
						  padding: 3px!important;
						  background: none!important;
					}

					#'.$iCID.' ul li img {
					  border: 1px solid #ccc;
					  padding: 2px;
					}
									</style>';

		$mainframe->addCustomHeadTag($js);
		$mainframe->addCustomHeadTag($css);

    }
}
?>