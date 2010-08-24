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

jimport('joomla.application.component.controller');

/**
 * hwdVideoShare Component Controller
 *
 * @package		hwdVideoShare
 */
class UserController extends JController
{
	function frontpage()
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'core.php');
		hwd_ps_core::frontpage();
	}

	function downloadfile()
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
		hwd_ps_photos::downloadFile($option);
	}

	function upload() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'uploads.php');
        hwd_ps_uploads::uploadMedia();
        return;
	}

	function uploadconfirmphp() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'uploads.php');
        hwd_ps_uploads::uploadConfirmPhp();
        return;
	}

	function jumpupload() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'uploads.php');
        hwd_ps_uploads::jumpUpload();
        return;
	}

	function albums() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::albums();
        return;
	}

	function createalbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::createAlbum();
        return;
	}

	function editalbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::editAlbum();
        return;
	}

	function savealbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::saveAlbum();
        return;
	}

	function deletealbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::deleteAlbum();
        return;
	}

	function viewalbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::viewAlbum();
        return;
	}

	function updatealbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::updateAlbumInfo();
        return;
	}

	function reorderalbum() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::reorderAlbum();
        return;
	}

	function viewslideshow() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::viewSlideshow();
        return;
	}

	function albumprivacy() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::albumPrivacy();
        return;
	}

	function savealbumprivacy() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        hwd_ps_albums::saveAlbumPrivacy();
        return;
	}

	function addphotos() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        hwd_ps_photos::addPhotos();
        return;
	}

	function savephoto() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        hwd_ps_photos::savePhoto();
        return;
	}

	function viewphoto() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        hwd_ps_photos::viewPhoto();
        return;
	}

	function photos() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        hwd_ps_photos::photos();
        return;
	}

	function groups() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::groups();
        return;
	}

	function creategroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::createGroup();
        return;
	}

	function editgroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::editGroup();
        return;
	}

	function savegroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::saveGroup();
        return;
	}

	function updategroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::updateGroup();
        return;
	}

	function deletegroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::deleteGroup();
        return;
	}

	function viewgroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::viewGroup();
        return;
	}

	function joingroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::joinGroup();
        return;
	}

	function leavegroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
        hwd_ps_groups::leaveGroup();
        return;
	}

	function yourphotos() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'usrfunc.php');
        hwd_ps_usrfunc::yourPhotos();
        return;
	}

	function yourfavourites() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'usrfunc.php');
        hwd_ps_usrfunc::yourFavourites();
        return;
	}

	function yourgroups() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'usrfunc.php');
        hwd_ps_usrfunc::yourGroups();
        return;
	}

	function yourmemberships() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'usrfunc.php');
        hwd_ps_usrfunc::yourMemberships();
        return;
	}

	function featuredgroups() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'usrfunc.php');
        hwd_ps_usrfunc::featuredGroups();
        return;
	}

	function setusertemplate() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'usrfunc.php');
        hwd_ps_usrfunc::setUserTemplate();
        return;
	}

	function rate() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'standardsuite.php');
        hwd_ps_standard::rate();
        return;
	}

	function addfavourite() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'standardsuite.php');
        hwd_ps_standard::addFavourite();
        return;
	}

	function removefavourite() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'standardsuite.php');
        hwd_ps_standard::removeFavourite();
        return;
	}

	function addphototogroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'standardsuite.php');
        hwd_ps_standard::addPhotoToGroup();
        return;
	}

	function reportphoto() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'standardsuite.php');
        hwd_ps_standard::reportPhoto();
        return;
	}

	function reportgroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'standardsuite.php');
        hwd_ps_standard::reportGroup();
        return;
	}

	function ajax_rate() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'ajaxsuite.php');
        hwd_ps_ajax::rate();
        return;
	}

	function ajax_addfavourite() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'ajaxsuite.php');
        hwd_ps_ajax::addToFavourites();
        return;
	}

	function ajax_removefavourite() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'ajaxsuite.php');
        hwd_ps_ajax::removeFromFavourites();
        return;
	}

	function ajax_reportphoto() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'ajaxsuite.php');
        hwd_ps_ajax::reportPhoto();
        return;
	}

	function ajax_addphototogroup() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'ajaxsuite.php');
        hwd_ps_ajax::addPhotoToGroup();
        return;
	}

	function rss() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'rss.php');
        hwd_ps_rss::feeds();
        return;
	}

	function search() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'core.php');
        hwd_ps_core::search();
        return;
	}

	function displayresults() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'core.php');
        hwd_ps_core::displayResults();
        return;
	}

	function categories() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'core.php');
        hwd_ps_core::categories();
        return;
	}

	function viewcategory() {
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'core.php');
        hwd_ps_core::viewCategory();
        return;
	}

}

?>
