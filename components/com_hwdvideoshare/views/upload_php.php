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

$allowedft = "";
if ($c->requiredins == 1) {
	$allowedft = "";
	$tag = null;
	if ($c->ft_mpg == "on") {$allowedft .= "\".mpg\"";$tag = 1;}
	if ($c->ft_mpeg == "on" && $tag = 1) {$allowedft .= ", \".mpeg\"";} else if ($c->ft_mpeg == "on" && $tag = null) {$allowedft .= "\".mpeg\"";$tag = 1;}
	if ($c->ft_avi == "on" && $tag = 1) {$allowedft .=  ", \".avi\"";} else if ($c->ft_avi == "on" && $tag = null) {$allowedft .= "\".avi\"";$tag = 1;}
	if ($c->ft_divx == "on" && $tag = 1) {$allowedft .=  ", \".divx\"";} else if ($c->ft_divx == "on" && $tag = null) {$allowedft .= "\".divx\"";$tag = 1;}
	if ($c->ft_mp4 == "on" && $tag = 1) {$allowedft .=  ", \".mp4\"";} else if ($c->ft_mp4 == "on" && $tag = null) {$allowedft .= "\".mp4\"";$tag = 1;}
	if ($c->ft_flv == "on" && $tag = 1) {$allowedft .=  ", \".flv\"";} else if ($c->ft_flv == "on" && $tag = null) {$allowedft .= "\".flv\"";$tag = 1;}
	if ($c->ft_wmv == "on" && $tag = 1) {$allowedft .=  ", \".wmv\"";} else if ($c->ft_wmv == "on" && $tag = null) {$allowedft .= "\".wmv\"";$tag = 1;}
	if ($c->ft_rm == "on" && $tag = 1) {$allowedft .=  ", \".rm\"";} else if ($c->ft_rm == "on" && $tag = null) {$allowedft .= "\".rm\"";$tag = 1;}
	if ($c->ft_mov == "on" && $tag = 1) {$allowedft .=  ", \".mov\"";} else if ($c->ft_mov == "on" && $tag = null) {$allowedft .= "\".mov\"";$tag = 1;}
	if ($c->ft_moov == "on" && $tag = 1) {$allowedft .=  ", \".moov\"";} else if ($c->ft_moov == "on" && $tag = null) {$allowedft .= "\".moov\"";$tag = 1;}
	if ($c->ft_asf == "on" && $tag = 1) {$allowedft .=  ", \".asf\"";} else if ($c->ft_asf == "on" && $tag = null) {$allowedft .= "\".asf\"";$tag = 1;}
	if ($c->ft_swf == "on" && $tag = 1) {$allowedft .=  ", \".swf\"";} else if ($c->ft_swf == "on" && $tag = null) {$allowedft .= "\".swf\"";$tag = 1;}
	if ($c->ft_vob == "on" && $tag = 1) {$allowedft .=  ", \".vob\"";} else if ($c->ft_vob == "on" && $tag = null) {$allowedft .= "\".vob\"";$tag = 1;}

	$oformats = explode(",", $c->oformats);
	for ($i = 0, $n = count($oformats); $i < $n; $i++)
	{
		$oformat = $oformats[$i];
		$oformat = preg_replace("/[^a-zA-Z0-9s]/", "", $oformat);
		if ($tag = 1) {
			$allowedft .=  ", \".".$oformat."\"";
		} else if ($tag = null) {
			$allowedft .= "\".".$oformat."\"";
			$tag = 1;
		}
	}

} else {
	$allowedft =  "\".flv\"";
}

$PHPFORMURL = JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=uploadconfirmphp");

$PHPHIDDENINPUTS = "<input type=\"hidden\" name=\"videotype\" value=\"".stripslashes($videotype)."\" />
                    <input type=\"hidden\" name=\"title\" value=\"".stripslashes($title)."\" />
                    <input type=\"hidden\" name=\"description\" value=\"".stripslashes($description)."\" />
                    <input type=\"hidden\" name=\"category_id\" value=\"".stripslashes($category_id)."\" />
                    <input type=\"hidden\" name=\"tags\" value=\"".stripslashes($tags)."\" />
                    <input type=\"hidden\" name=\"public_private\" value=\"".stripslashes($public_private)."\" />
                    <input type=\"hidden\" name=\"allow_comments\" value=\"".stripslashes($allow_comments)."\" />
                    <input type=\"hidden\" name=\"allow_embedding\" value=\"".stripslashes($allow_embedding)."\" />
                    <input type=\"hidden\" name=\"allow_ratings\" value=\"".stripslashes($allow_ratings)."\" />";

$smartyvs->assign("allowedft", $allowedft);
$smartyvs->assign("PHPFORMURL", $PHPFORMURL);
$smartyvs->assign("PHPHIDDENINPUTS", $PHPHIDDENINPUTS);
