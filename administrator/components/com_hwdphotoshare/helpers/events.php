<?php
/**
 *    @version [ Accetto ]
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
class hwdpsEvent {

    function onAfterAlbumCreation($params)
    {
		global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename, $mainframe;
		$c = hwd_vs_Config::get_instance();

		$my = & JFactory::getUser();

		// mail admin notification
		if ($c->mailvideonotification == 1) {
			$jconfig = new jconfig();

			$mailbody = ""._HWDVIDS_MAIL_BODY0.$jconfig->sitename.".\n";
			$mailbody .= ""._HWDVIDS_MAIL_BODY1."\"".$params->title."\".\n";
			$mailbody .= "".JURI::root()."index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=viewvideo&video_id=".$params->id."\n\n";
			$mailbody .= ""._HWDVIDS_MAIL_BODY2."\n";
			$mailbody .= JURI::root()."administrator";

			JUtility::sendMail( $jconfig->mailfrom, $jconfig->fromname, $c->mailnotifyaddress, _HWDVIDS_MAIL_SUBJECT1.$jconfig->sitename.' ', $mailbody );
		}

		// perform maintenance
		include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
		hwd_vs_recount::recountVideosInCategory($params->category_id);

		if ($c->aa3v == 1) {
			$api_AUP = JPATH_SITE.DS.'components'.DS.'com_alphauserpoints'.DS.'helper.php';
			if ( file_exists($api_AUP))
			{
				require_once ($api_AUP);
				AlphaUserPointsHelper::newpoints( 'plgaup_addVideo_hwdvs' );
			}
		}

		if ($c->cbint == 2) {
			require_once( JPATH_SITE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );
			require_once( JPATH_SITE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'error.php' );

			$act = new stdClass();
			$act->cmd 	= 'video.upload';
			$act->actor 	= $my->id;
			$act->target 	= 0; // no target
			$act->content 	= '';
			$act->app 	= 'hwdvideoshare';
			$act->cid 	= 0;

			// activity stream variations
			$act->title 	= JText::_('{actor} '._HWDVIDS_JS_AS1.' {single}'._HWDVIDS_JS_AS2.' {app} '._HWDVIDS_JS_AS3.'{/single}{multiple}{count} {app} '._HWDVIDS_JS_AS4.'{/multiple}');
			$act->title 	= JText::_('{actor} '._HWDVIDS_JS_AS1.' {single}'._HWDVIDS_JS_AS2.' {app} '._HWDVIDS_JS_AS3.'{/single}{multiple}{count} {app} '._HWDVIDS_JS_AS4.'{/multiple}');
			$act->title 	= JText::_('{actor} '._HWDVIDS_JS_AS1.' {single}'._HWDVIDS_JS_AS2.' {app} '._HWDVIDS_JS_AS3.'{/single}{multiple}{count} {app} '._HWDVIDS_JS_AS4.'{/multiple}');

			CFactory::load('libraries', 'activities');
			CActivityStream::add($act);
		}

    }

}
?>