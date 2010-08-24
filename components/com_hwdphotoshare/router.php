<?php
function hwdPhotoShareBuildRoute(&$query)
{
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'config.hwdphotoshare.php');
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'initialise.php');
	hwdpsInitialise::language('plugs');

	$segments = array();

	$db =& JFactory::getDBO();
	jimport('joomla.filter.output');
	$escapeRouteChar	= array('.', '\\', '/', '@', '#', '?', '!', '^', '&', '<', '>', '\'' , '"', '*', ',' );

	if (isset($query['task'])) {
		switch ($query['task']) {

			case 'frontpage':
				$segments[] = URLSafe(_HWDPS_SEF_FP);
				unset( $query['task'] );
			break;

			case 'upload':
				$segments[] = URLSafe(_HWDPS_SEF_UPLOAD);
				unset( $query['task'] );
			break;

			case 'uploadconfirmphp':
				$segments[] = URLSafe(_HWDPS_SEF_UPLOADEDP);
				unset( $query['task'] );
			break;

			case 'albums':
				$segments[] = URLSafe(_HWDPS_SEF_ALBUMS);
				unset( $query['task'] );
			break;

			case 'createalbum':
				$segments[] = URLSafe(_HWDPS_SEF_CREATEALBUM);
				unset( $query['task'] );
			break;

			case 'editalbum':
				$segments[] = URLSafe(_HWDPS_SEF_EDITALBUM);
				unset( $query['task'] );
			break;

			case 'viewalbum':
				$segments[] = URLSafe(_HWDPS_SEF_VIEWALBUM);
				unset( $query['task'] );
				$segments[] = $query['album_id'];
				unset( $query['album_id'] );
			break;

			case 'updatealbum':
				$segments[] = URLSafe(_HWDPS_SEF_UPDATEALBUM);
				unset( $query['task'] );
			break;

			case 'reorderalbum':
				$segments[] = URLSafe(_HWDPS_SEF_REORDERALBUM);
				unset( $query['task'] );
			break;

			case 'viewslideshow':
				$segments[] = URLSafe(_HWDPS_SEF_VIEWSLIDESHOW);
				unset( $query['task'] );
			break;

			case 'albumprivacy':
				$segments[] = URLSafe(_HWDPS_SEF_ALBUMPRIVACY);
				unset( $query['task'] );
			break;

			case 'addphotos':
				$segments[] = URLSafe(_HWDPS_SEF_ADDPHOTOS);
				unset( $query['task'] );
			break;

			case 'viewphoto':
				$segments[] = URLSafe(_HWDPS_SEF_VIEWPHOTO);
				unset( $query['task'] );
				$segments[] = $query['album_id'];
				unset( $query['album_id'] );
				if (isset($query['limitstart'])) {
					$segments[] = $query['limitstart'];
					unset( $query['limitstart'] );
				}
			break;

			case 'photos':
				$segments[] = URLSafe(_HWDPS_SEF_PHOTOS);
				unset( $query['task'] );
			break;

			case 'groups':
				$segments[] = URLSafe(_HWDPS_SEF_GROUPS);
				unset( $query['task'] );
			break;

			case 'creategroup':
				$segments[] = URLSafe(_HWDPS_SEF_CREATEGROUP);
				unset( $query['task'] );
			break;

			case 'editgroup':
				$segments[] = URLSafe(_HWDPS_SEF_EDITGROUP);
				unset( $query['task'] );
			break;

			case 'viewgroup':
				$segments[] = URLSafe(_HWDPS_SEF_VIEWGROUP);
				unset( $query['task'] );
				$segments[] = $query['group_id'];
				unset( $query['group_id'] );
			break;

			case 'yourphotos':
				$segments[] = URLSafe(_HWDPS_SEF_YP);
				unset( $query['task'] );
			break;

			case 'yourfavourites':
				$segments[] = URLSafe(_HWDPS_SEF_YF);
				unset( $query['task'] );
			break;

			case 'yourgroups':
				$segments[] = URLSafe(_HWDPS_SEF_YG);
				unset( $query['task'] );
			break;

			case 'yourmemberships':
				$segments[] = URLSafe(_HWDPS_SEF_YM);
				unset( $query['task'] );
			break;

			case 'featuredgroups':
				$segments[] = URLSafe(_HWDPS_SEF_FEATUREDGROUPS);
				unset( $query['task'] );
			break;

			case 'rss':
				$segments[] = URLSafe(_HWDPS_SEF_RSS);
				unset( $query['task'] );
			break;

			case 'search':
				$segments[] = URLSafe(_HWDPS_SEF_SEARCH);
				unset( $query['task'] );
			break;

			case 'displayresults':
				$segments[] = URLSafe(_HWDPS_SEF_DR);
				unset( $query['task'] );
				$segments[] = $query['category_id'];
				unset( $query['category_id'] );
				$segments[] = $query['pattern'];
				unset( $query['pattern'] );
			break;

			case 'categories':
				$segments[] = URLSafe(_HWDPS_SEF_CATEGORIES);
				unset( $query['task'] );
			break;

			case 'viewcategory':
				$segments[] = URLSafe(_HWDPS_SEF_VIEWCATEGORY);
				unset( $query['task'] );
				$segments[] = $query['cat_id'];
				unset( $query['cat_id'] );
			break;

////
// downloadfile
// jumpupload
// savealbum
// deletealbum
// savephoto
// savealbumprivacy
// savegroup
// updategroup
// deletegroup
// joingroup
// leavegroup
// setusertemplate
// rate
// addfavourite
// removefavourite
// addphototogroup
// reportphoto
// reportgroup
// ajax_rate
// ajax_addfavourite
// ajax_removefavourite
// ajax_reportphoto
// ajax_addphototogroup

		}
	}

	return $segments;
}

function hwdPhotoShareParseRoute($segments)
{
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'config.hwdphotoshare.php');
	require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'initialise.php');
	hwdpsInitialise::language('plugs');

	$vars = array();
	switch($segments[0])
	{
		case URLSafe(_HWDPS_SEF_FP):
			$vars['task'] = 'frontpage';
		break;

		case URLSafe(_HWDPS_SEF_UPLOAD):
			$vars['task'] = 'upload';
		break;

		case URLSafe(_HWDPS_SEF_UPLOADEDP):
			$vars['task'] = 'uploadconfirmphp';
		break;

		case URLSafe(_HWDPS_SEF_ALBUMS):
			$vars['task'] = 'albums';
		break;

		case URLSafe(_HWDPS_SEF_CREATEALBUM):
			$vars['task'] = 'createalbum';
		break;

		case URLSafe(_HWDPS_SEF_EDITALBUM):
			$vars['task'] = 'editalbum';
		break;

		case URLSafe(_HWDPS_SEF_VIEWALBUM):
			$vars['task'] = 'viewalbum';
			$vars['album_id'] = $segments[1];
		break;

		case URLSafe(_HWDPS_SEF_UPDATEALBUM):
			$vars['task'] = 'updatealbum';
		break;

		case URLSafe(_HWDPS_SEF_REORDERALBUM):
			$vars['task'] = 'reorderalbum';
		break;

		case URLSafe(_HWDPS_SEF_VIEWSLIDESHOW):
			$vars['task'] = 'viewslideshow';
		break;

		case URLSafe(_HWDPS_SEF_ALBUMPRIVACY):
			$vars['task'] = 'albumprivacy';
		break;

		case URLSafe(_HWDPS_SEF_ADDPHOTOS):
			$vars['task'] = 'addphotos';
		break;

		case URLSafe(_HWDPS_SEF_VIEWPHOTO):
			$vars['task'] = 'viewphoto';
			$vars['album_id'] = $segments[1];
			$vars['limitstart'] = $segments[2];
		break;

		case URLSafe(_HWDPS_SEF_PHOTOS):
			$vars['task'] = 'photos';
		break;

		case URLSafe(_HWDPS_SEF_GROUPS):
			$vars['task'] = 'groups';
		break;

		case URLSafe(_HWDPS_SEF_CREATEGROUP):
			$vars['task'] = 'creategroup';
		break;

		case URLSafe(_HWDPS_SEF_EDITGROUP):
			$vars['task'] = 'editgroup';
		break;

		case URLSafe(_HWDPS_SEF_VIEWGROUP):
			$vars['task'] = 'viewgroup';
			$vars['group_id'] = $segments[1];
		break;

		case URLSafe(_HWDPS_SEF_YP):
			$vars['task'] = 'yourphotos';
		break;

		case URLSafe(_HWDPS_SEF_YF):
			$vars['task'] = 'yourfavourites';
		break;

		case URLSafe(_HWDPS_SEF_YG):
			$vars['task'] = 'yourgroups';
		break;

		case URLSafe(_HWDPS_SEF_YM):
			$vars['task'] = 'yourmemberships';
		break;

		case URLSafe(_HWDPS_SEF_FEATUREDGROUPS):
			$vars['task'] = 'featuredgroups';
		break;

		case URLSafe(_HWDPS_SEF_RSS):
			$vars['task'] = 'rss';
		break;

		case URLSafe(_HWDPS_SEF_SEARCH):
			$vars['task'] = 'search';
		break;

		case URLSafe(_HWDPS_SEF_DR):
			$vars['task'] = 'displayresults';
			$vars['category_id'] = $segments[1];
			$vars['pattern'] = $segments[2];
		break;

		case URLSafe(_HWDPS_SEF_CATEGORIES):
			$vars['task'] = 'categories';
		break;

		case URLSafe(_HWDPS_SEF_VIEWCATEGORY):
			$vars['task'] = 'viewcategory';
			$vars['cat_id'] = $segments[1];
		break;

		default:
			$vars['task'] = $segments[0];
		break;
	}
	return $vars;
}

if (!function_exists('URLSafe')) {
	function URLSafe($string)
	{
		jimport( 'joomla.filter.output' );
		$string = JFilterOutput::stringURLSafe($string);

		/* All your other checks */
		return $string;
	}
}

?>