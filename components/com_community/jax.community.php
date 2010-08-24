<?php
/**
 * @package		JomSocial
 * @subpackage	Library 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

defined('_JEXEC') or die('Restricted access');

global $jaxFuncNames;
	if (!isset($jaxFuncNames) or !is_array($jaxFuncNames)) $jaxFuncNames = array();



$jaxFuncNames['community_entry'] = "";

$jaxFuncNames[] = 'system,ajaxReport';
$jaxFuncNames[] = 'system,ajaxSendReport';


$jaxFuncNames[] = "status,ajaxUpdate";
$jaxFuncNames[] = "status,test";
$jaxFuncNames[] = "frontpage,ajaxTest";

/** apps **/
$jaxFuncNames[] = 'apps,ajaxShowAbout';
$jaxFuncNames[] = 'apps,ajaxShowPrivacy';
$jaxFuncNames[] = 'apps,ajaxRemove';
$jaxFuncNames[] = 'apps,ajaxAdd';
$jaxFuncNames[] = 'apps,ajaxShowSettings';
$jaxFuncNames[] = 'apps,ajaxSaveSettings';
$jaxFuncNames[] = 'apps,ajaxSavePrivacy';
$jaxFuncNames[] = 'apps,ajaxSaveOrder';

/** inbox **/
$jaxFuncNames[] = 'inbox,ajaxAddReply';
$jaxFuncNames[] = 'inbox,ajaxCompose';
$jaxFuncNames[] = 'inbox,ajaxRemoveMessage';
$jaxFuncNames[] = 'inbox,ajaxRemoveFullMessages';
$jaxFuncNames[] = 'inbox,ajaxRemoveSentMessages';
$jaxFuncNames[] = 'inbox,ajaxMarkMessageAsRead';
$jaxFuncNames[] = 'inbox,ajaxMarkMessageAsUnread';
$jaxFuncNames[]	= 'inbox,ajaxIphoneInbox';
$jaxFuncNames[] = 'inbox,ajaxSend';

/** friends**/
$jaxFuncNames[] = 'friends,ajaxFriendTagSave';
$jaxFuncNames[] = 'friends,ajaxAssignTag';
$jaxFuncNames[]	= 'friends,ajaxIphoneFriends';
//$jaxFuncNames[] = 'friends,ajaxAddGroup';
$jaxFuncNames[] = 'friends,ajaxAdd';
$jaxFuncNames[] = 'friends,ajaxSaveFriend';
$jaxFuncNames[] = 'friends,ajaxConnect';
$jaxFuncNames[]	= 'friends,ajaxCancelRequest';
$jaxFuncNames[]	= 'friends,ajaxApproveRequest';
$jaxFuncNames[]	= 'friends,ajaxRejectRequest';

/** groups **/
$jaxFuncNames[]	= 'groups,ajaxSaveWall';
$jaxFuncNames[]	= 'groups,ajaxSaveDiscussionWall';
$jaxFuncNames[]	= 'groups,ajaxRemoveWall';
$jaxFuncNames[]	= 'groups,ajaxAddNews';
$jaxFuncNames[]	= 'groups,ajaxSaveNews';
$jaxFuncNames[]	= 'groups,ajaxShowJoinGroup';
$jaxFuncNames[]	= 'groups,ajaxSaveJoinGroup';
$jaxFuncNames[]	= 'groups,ajaxShowLeaveGroup';
$jaxFuncNames[]	= 'groups,ajaxLeaveGroup';
$jaxFuncNames[]	= 'groups,ajaxRemoveMember';
$jaxFuncNames[]	= 'groups,ajaxRemoveReply';
$jaxFuncNames[]	= 'groups,ajaxApproveMember';
$jaxFuncNames[]	= 'groups,ajaxUnpublishGroup';
$jaxFuncNames[]	= 'groups,ajaxShowRemoveDiscussion';
$jaxFuncNames[]	= 'groups,ajaxShowRemoveBulletin';
$jaxFuncNames[]	= 'groups,ajaxAddAdmin';
$jaxFuncNames[]	= 'groups,ajaxRemoveAdmin';
$jaxFuncNames[]	= 'groups,ajaxDeleteGroup';
$jaxFuncNames[]	= 'groups,ajaxWarnGroupDeletion';
$jaxFuncNames[]	= 'groups,ajaxAddFeatured';
$jaxFuncNames[]	= 'groups,ajaxRemoveFeatured';

/** photos **/
$jaxFuncNames[]	= 'photos,ajaxShowWall';
$jaxFuncNames[]	= 'photos,ajaxSaveWall';
$jaxFuncNames[]	= 'photos,ajaxRemoveWall';
$jaxFuncNames[]	= 'photos,ajaxShowWallContents';
$jaxFuncNames[]	= 'photos,ajaxSaveCaption';
$jaxFuncNames[]	= 'photos,ajaxRemovePhoto';
$jaxFuncNames[]	= 'photos,ajaxSetDefaultPhoto';
$jaxFuncNames[]	= 'photos,ajaxPagination';
$jaxFuncNames[] = 'photos,ajaxRemoveAlbum';
$jaxFuncNames[]	= 'photos,ajaxSwitchPhotoTrigger';
$jaxFuncNames[]	= 'photos,ajaxAddFeatured';
$jaxFuncNames[]	= 'photos,ajaxRemoveFeatured';
$jaxFuncNames[]	= 'photos,ajaxAddPhotoTag';
$jaxFuncNames[]	= 'photos,ajaxRemovePhotoTag';
$jaxFuncNames[]	= 'photos,ajaxDisplayCreator';


/** register **/
$jaxFuncNames[] = 'register,ajaxShowTnc';
$jaxFuncNames[] = 'register,ajaxSetMessage';
$jaxFuncNames[] = 'register,ajaxCheckUserName';
$jaxFuncNames[] = 'register,ajaxCheckEmail';
$jaxFuncNames[] = 'register,ajaxGenerateAuthKey';
$jaxFuncNames[] = 'register,ajaxAssignAuthKey';

/** comment **/
$jaxFuncNames[]	= 'comment,ajaxAdd';

/** profile **/
$jaxFuncNames[] = 'profile,ajaxErrorFileUpload';
$jaxFuncNames[]	= 'profile,ajaxBlockUser';
$jaxFuncNames[]	= 'profile,ajaxRemovePicture';
$jaxFuncNames[]	= 'profile,ajaxIphoneProfile';

/** activities **/
$jaxFuncNames[]	= 'activities,ajaxHideActivity';
$jaxFuncNames[]	= 'activities,ajaxAddComment';
$jaxFuncNames[]	= 'activities,ajaxGetContent';

/** frontpage **/
$jaxFuncNames[]	= 'frontpage,ajaxGetNewestMember';
$jaxFuncNames[]	= 'frontpage,ajaxGetActiveMember';
$jaxFuncNames[]	= 'frontpage,ajaxGetPopularMember';
$jaxFuncNames[]	= 'frontpage,ajaxGetActivities';
$jaxFuncNames[]	= 'frontpage,ajaxGetFeaturedMember';
$jaxFuncNames[]	= 'frontpage,ajaxIphoneFrontpage';
$jaxFuncNames[]	= 'frontpage,ajaxGetNewestVideos';
$jaxFuncNames[]	= 'frontpage,ajaxGetFeaturedVideos';
$jaxFuncNames[]	= 'frontpage,ajaxGetPopularVideos';

/** notification **/
$jaxFuncNames[]	= 'notification,ajaxGetNotification';
$jaxFuncNames[]	= 'notification,ajaxRejectRequest';
$jaxFuncNames[]	= 'notification,ajaxApproveRequest';

/** connect **/
$jaxFuncNames[]	= 'connect,ajaxImportData';
$jaxFuncNames[]	= 'connect,ajaxUpdateEmail';
$jaxFuncNames[]	= 'connect,ajaxUpdate';
$jaxFuncNames[]	= 'connect,ajaxMergeNotice';
$jaxFuncNames[]	= 'connect,ajaxMerge';
$jaxFuncNames[]	= 'connect,ajaxCreateNewAccount';
$jaxFuncNames[]	= 'connect,ajaxCheckEmail';
$jaxFuncNames[]	= 'connect,ajaxCheckUsername';
$jaxFuncNames[]	= 'connect,ajaxCheckName';
$jaxFuncNames[]	= 'connect,ajaxValidateLogin';
$jaxFuncNames[] = 'connect,ajaxShowNewUserForm';
$jaxFuncNames[] = 'connect,ajaxShowExistingUserForm';

/** Bookmarks **/
$jaxFuncNames[]	= 'bookmarks,ajaxShowBookmarks';
$jaxFuncNames[]	= 'bookmarks,ajaxEmailPage';

/** Backend **/
$jaxFuncNames[]	= 'admin,profiles,ajaxEditField';
$jaxFuncNames[]	= 'admin,profiles,ajaxTogglePublish';
$jaxFuncNames[]	= 'admin,profiles,ajaxSaveField';
$jaxFuncNames[]	= 'admin,groups,ajaxTogglePublish';
$jaxFuncNames[]	= 'admin,groupcategories,ajaxEditCategory';
$jaxFuncNames[]	= 'admin,groupcategories,ajaxSaveCategory';
$jaxFuncNames[]	= 'admin,videoscategories,ajaxTogglePublish';
$jaxFuncNames[]	= 'admin,videoscategories,ajaxEditCategory';
$jaxFuncNames[]	= 'admin,videoscategories,ajaxSaveCategory';
$jaxFuncNames[]	= 'admin,templates,ajaxChangeTemplate';
$jaxFuncNames[]	= 'admin,templates,ajaxLoadTemplateFile';
$jaxFuncNames[]	= 'admin,templates,ajaxSaveTemplateFile';
$jaxFuncNames[]	= 'admin,about,ajaxCheckVersion';
$jaxFuncNames[]	= 'admin,groups,ajaxEditGroup';
$jaxFuncNames[]	= 'admin,groups,ajaxChangeGroupOwner';
$jaxFuncNames[]	= 'admin,maintenance,ajaxPatch';
$jaxFuncNames[]	= 'admin,maintenance,ajaxPatchGroup';
$jaxFuncNames[]	= 'admin,maintenance,ajaxPatchTable';
$jaxFuncNames[]	= 'admin,maintenance,ajaxPatchFriendTable';
$jaxFuncNames[]	= 'admin,maintenance,ajaxPatchFriend';
$jaxFuncNames[]	= 'admin,maintenance,ajaxPatchPrivacy';
$jaxFuncNames[]	= 'admin,reports,ajaxPerformAction';
$jaxFuncNames[]	= 'admin,userpoints,ajaxRuleScan';
$jaxFuncNames[]	= 'admin,userpoints,ajaxTogglePublish';
$jaxFuncNames[]	= 'admin,userpoints,ajaxEditRule';
$jaxFuncNames[]	= 'admin,userpoints,ajaxSaveRule';
$jaxFuncNames[]	= 'admin,users,ajaxTogglePublish';
$jaxFuncNames[]	= 'admin,messaging,ajaxSendMessage';
$jaxFuncNames[]	= 'admin,users,ajaxRemoveAvatar';
$jaxFuncNames[]	= 'admin,profiles,ajaxEditGroup';
$jaxFuncNames[]	= 'admin,profiles,ajaxSaveGroup';
$jaxFuncNames[]	= 'admin,groups,ajaxAssignGroup';
$jaxFuncNames[]	= 'admin,profiles,ajaxGroupTogglePublish';

/** search **/
$jaxFuncNames[]	= 'search,ajaxGetFieldCondition';
$jaxFuncNames[]	= 'search,ajaxAddFeatured';
$jaxFuncNames[]	= 'search,ajaxRemoveFeatured';

/** video **/
$jaxFuncNames[]	= 'videos,ajaxShowWallContents';
$jaxFuncNames[]	= 'videos,ajaxSaveWall';
$jaxFuncNames[]	= 'videos,ajaxRemoveWall';
$jaxFuncNames[]	= 'videos,ajaxRemoveVideo';
$jaxFuncNames[]	= 'videos,ajaxEditVideo';
$jaxFuncNames[]	= 'videos,ajaxAddVideo';
$jaxFuncNames[] = 'videos,ajaxLinkVideo';
$jaxFuncNames[] = 'videos,ajaxUploadVideo';
$jaxFuncNames[]	= 'videos,ajaxAddFeatured';
$jaxFuncNames[]	= 'videos,ajaxRemoveFeatured';
$jaxFuncNames[]	= 'videos,ajaxFetchThumbnail';

$jaxFuncNames[]	= 'autousersuggest,ajaxAutoUserSuggest';

// Dont process other plugin ajax definitions for back end
if(!JString::stristr(JPATH_COMPONENT, 'administrator' . DS . 'components' . DS . 'com_community' ))
{
	// Include CAppPlugins library
	require_once( JPATH_COMPONENT . DS . 'libraries' . DS . 'apps.php');

	// Load Ajax plugins jax file.
	CAppPlugins::loadAjaxPlugins();
}