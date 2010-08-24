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

/**
 * Process character encoding
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvsCarousel {

    function setup($iCID, $params)
    {

		global $mainframe, $hwdvsTemplateOverride;
        $c = hwd_vs_Config::get_instance();

		if (isset($params['thumb_width']) && $params['thumb_width'] !== '') {
			$car_thumbwidth = $params['thumb_width'];
		} else {
			$car_thumbwidth = $c->thumbwidth;
		}

		$width = (intval($params['novtd'])*$car_thumbwidth)+(intval($params['novtd'])*18);
		$width = $width+3;
		$width = $width."px";

		$height = ($car_thumbwidth*$c->tar_fb)+15;
        if (isset($params['showtitle']) && $params['showtitle'] == 1) { $height = $height + 45; }
        if (isset($params['showcategory']) && $params['showcategory'] == 1) { $height = $height + 20; }
        if (isset($params['showdescription']) && $params['showdescription'] == 1) { $height = $height + 60; }
        if (isset($params['showrating']) && $params['showrating'] == 1) { $height = $height + 20; }
        if (isset($params['shownov']) && $params['shownov'] == 1) { $height = $height + 20; }
        if (isset($params['showduration']) && $params['showduration'] == 1) { $height = $height + 20; }
        if (isset($params['showuser']) && $params['showuser'] == 1) { $height = $height + 20; }
        if (isset($params['showtime']) && $params['showtime'] == 1) { $height = $height + 20; }
		$height = $height."px";

		$margin = $car_thumbwidth-27;
		$margin = $margin."px";
		$size = ($car_thumbwidth)+19;
		$width_ul = $car_thumbwidth+7;
		$width_ul = $width_ul."px";

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
								type: "'.$c->scroll_au.'",
								interval: '.$c->scroll_as.',
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
					  margin-left: '.$margin.';
					}

					#'.$iCID.'_content
					#'.$iCID.'_content li {
					  list-style: none;
					  margin: 0;
					  padding: 0;
					}

					#'.$iCID.'_content {
						  width: 10000px;
					}

					#'.$iCID.' ul {
						  margin: 0!important;
						  padding: 0!important;
					}

					#'.$iCID.' ul li {
						  display: block;
						  float: left;
						  margin: 0 6px!important;
						  padding: 0;
						  width: '.$width_ul.';
						  background-image: none;
					}

					#'.$iCID.' ul li img {
					  display: block;
					}
									</style>';

		$mainframe->addCustomHeadTag($js);
		$mainframe->addCustomHeadTag($css);

    }

}
?>