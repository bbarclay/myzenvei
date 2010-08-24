<?php
/**
 * @version $Id: english.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Language - MicroIntegrations - English
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Not really ....' );

// Load Identifier
define( '_AEC_LANG_INCLUDED_MI', 1);

// acajoom
define( '_AEC_MI_NAME_ACAJOOM',		'Acajoom' );
define( '_AEC_MI_DESC_ACAJOOM',		'Includes the newsletter Acajoom' );
define( '_MI_MI_ACAJOOM_LIST_NAME',		'Set List' );
define( '_MI_MI_ACAJOOM_LIST_DESC',		'Which Mailing list do you want to assign this user to?' );
define( '_MI_MI_ACAJOOM_LIST_EXP_NAME',		'Set Expiration List' );
define( '_MI_MI_ACAJOOM_LIST_EXP_DESC',		'Which Mailing list do you want to assign this user to after expiration?' );
define( '_MI_MI_ACAJOOM_CUSTOMINFO_NAME',		'Custom Info' );
define( '_MI_MI_ACAJOOM_CUSTOMINFO_DESC',		'AEC normally displays the text "Do you want to subscribe to our newsletter?" on confirmation above checkbox. If you want it to say something else, enter your text here.' );
define( '_MI_MI_ACAJOOM_USER_CHECKBOX_NAME',		'User Checkbox' );
define( '_MI_MI_ACAJOOM_USER_CHECKBOX_DESC',		'Display a Checkbox to let the user decide whether he or she wants a newsletter.' );
define( '_MI_MI_ACAJOOM_DEFAULT_NOTICE',		'Do you want to subscribe to our newsletter?' );

// htaccess
define( '_AEC_MI_NAME_HTACCESS',	'.htaccess' );
define( '_AEC_MI_DESC_HTACCESS',	'Protect a folder with a .htaccess file and only allow users of this subscription to access it with their joomla account details.' );
define( '_MI_MI_HTACCESS_MI_FOLDER_NAME',			'Folder' );
define( '_MI_MI_HTACCESS_MI_FOLDER_DESC',			'Your protected folder name. Following keywords will be replaced:<br />[cmsroot] -> %s<br />Remember that this has no trailing slash! Your foldername should have none as well!' );
define( '_MI_MI_HTACCESS_MI_PASSWORDFOLDER_NAME',	'Password Folder' );
define( '_MI_MI_HTACCESS_MI_PASSWORDFOLDER_DESC',	'A place where you want to store the password file. This should be a directory which is not web-accessible. Use [abovecmsroot] to put in the directory above the cms root directory - this is recommended.' );
define( '_MI_MI_HTACCESS_MI_NAME_NAME',				'Area Name' );
define( '_MI_MI_HTACCESS_MI_NAME_DESC',				'The name of the protected Area' );
define( '_MI_MI_HTACCESS_USE_MD5_NAME',				'use md5' );
define( '_MI_MI_HTACCESS_USE_MD5_DESC',				'<strong>Important!</strong> If you want to use this MI to restrict folders with apache, you have to use crypt - so just leave this at NO. If you want to use a different software which uses htaccess/htuser files (like an icecast server for instance), set this to yes and it will use standard md5 encryption.' );
define( '_MI_MI_HTACCESS_USE_APACHEMD5_NAME',		'use Apache md5' );
define( '_MI_MI_HTACCESS_USE_APACHEMD5_DESC',		'When using a recent version of Apache, it is most likely that they use their own md5 encryption algorythm. This setting will emulate this behavior.' );
define( '_MI_MI_HTACCESS_REBUILD_NAME',				'Rebuild htaccess' );
define( '_MI_MI_HTACCESS_REBUILD_DESC',				'If you changed something important or lost your htaccess file, this option will rebuild your whole htaccess files by looking for each plan that has this MI applied and then add each user that uses one of these plans to the file.' );

//affiliate PRO
define( '_AEC_MI_NAME_AFFPRO',		'AffiliatePRO' );
define( '_AEC_MI_DESC_AFFPRO',		'Connect your AEC sales to AffiliatePRO' );
define( '_MI_MI_AFFILIATEPRO_URL_NAME',				'Affiliate PRO URL' );
define( '_MI_MI_AFFILIATEPRO_URL_DESC',				'Enter the AffiliatePRO Url that points to your AffiliatePRO sale.js (It should look like this: "http://www.demo.qualityunit.com/postaffiliatepro3/scripts/sale.js").' );

// docman
define( '_AEC_MI_NAME_DOCMAN',		'DocMan' );
define( '_AEC_MI_DESC_DOCMAN',		'Choose the amount of files a user can download and what DocMan group should be assigned to the user account' );
define( '_MI_MI_DOCMAN_SET_DOWNLOADS_NAME',			'Set Downloads' );
define( '_MI_MI_DOCMAN_SET_DOWNLOADS_DESC',			'SET this amount of downloads granted to the user - OVERRIDES THE >>ADD<< Setting! (does NOT reset the amount of downloads a user has already used!)' );
define( '_MI_MI_DOCMAN_ADD_DOWNLOADS_NAME',			'Add Downloads' );
define( '_MI_MI_DOCMAN_ADD_DOWNLOADS_DESC',			'Add this amount of downloads to the total granted amount of downloads for this user. Will be overridden by SET if you put a value for that as well!.' );
define( '_MI_MI_DOCMAN_SET_UNLIMITED_NAME',			'Set Unlimited' );
define( '_MI_MI_DOCMAN_SET_UNLIMITED_DESC',			'Grant the user unlimited downloads.' );
define( '_MI_MI_DOCMAN_SET_GROUP_NAME',				'Set DocMan Group' );
define( '_MI_MI_DOCMAN_SET_GROUP_DESC',				'Choose Yes if you want this MI to set the DocMan Group when it is called.' );
define( '_MI_MI_DOCMAN_GROUP_NAME',					'DocMan Group' );
define( '_MI_MI_DOCMAN_GROUP_DESC',					'The DocMan group that you want the user to be in.' );
define( '_MI_MI_DOCMAN_GROUP_EXP_NAME',				'Set DocMan Group expiration' );
define( '_MI_MI_DOCMAN_GROUP_EXP_DESC',				'Choose Yes if you want this MI to set the DocMan Group when the calling payment plan expires.' );
define( '_MI_MI_DOCMAN_SET_GROUP_EXP_NAME',			'Expiration group' );
define( '_MI_MI_DOCMAN_SET_GROUP_EXP_DESC',			'The DocMan group that you want the user to be in when the subscription runs out.' );
define( '_MI_MI_DOCMAN_REBUILD_NAME',				'Rebuild' );
define( '_MI_MI_DOCMAN_REBUILD_DESC',				'Attempt to rebuild the list of users assigned to the usergroup - >Set DocMan Group< and >DocMan Group< have to both be set for this.' );
define( '_AEC_MI_HACK1_DOCMAN',						'Build in a downloads restriction for DocMan, to be used with Micro Integrations. <b>Note:</b> This is an optional hack which adds the ability to restrict number of file downloads.  It should ONLY be applied if this is desired.' );
define( '_AEC_MI_DOCMAN_NOCREDIT',					'We are terribly sorry: You have no downloads left.' );
define( '_MI_MI_DOCMAN_DELETE_ON_EXP_NAME', 		'Action for existing groups when account expires:' );
define( '_MI_MI_DOCMAN_DELETE_ON_EXP_DESC',			'Choose what action you want to happen to already defined DocMan groups when the user expires.' );
define( '_MI_MI_DOCMAN_REMOVE_NAME', 				'Remove: ' );
define( '_MI_MI_DOCMAN_REMOVE_DESC',			'Carry out the expiration action for all users with an active plan attached to this micro-integration' );
define( '_AEC_MI_DIV1_DOCMAN_USED',		'You have used <strong>%s</strong> downloads.' );
define( '_AEC_MI_DIV1_DOCMAN_REMAINING',	'You have <strong>%s</strong> downloads remaining.' );
define( '_AEC_MI_DIV1_DOCMAN_UNLIMITED', 	'unlimited' );
define( '_MI_MI_DOCMAN_UNSET_UNLIMITED_NAME',			'Unset Unlimited on Expiration: ' );
define( '_MI_MI_DOCMAN_UNSET_UNLIMITED_DESC',			'Remove unlimited downloads when user expires.' );

// email
define( '_AEC_MI_NAME_EMAIL',		'Email' );
define( '_AEC_MI_DESC_EMAIL',		'Send an Email to one or more addresses on application or expiration of the subscription' );
define( '_MI_MI_EMAIL_SENDER_NAME',					'Sender E-Mail' );
define( '_MI_MI_EMAIL_SENDER_DESC',					'Sender E-Mail Address' );
define( '_MI_MI_EMAIL_SENDER_NAME_NAME',			'Sender Name' );
define( '_MI_MI_EMAIL_SENDER_NAME_DESC',			'The displayed name of the Sender' );
define( '_MI_MI_EMAIL_RECIPIENT_NAME',				'Recipient(s)' );
define( '_MI_MI_EMAIL_RECIPIENT_DESC',				'Who is to receive this E-Mail? Separate with comma. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_SUBJECT_NAME',				'Subject' );
define( '_MI_MI_EMAIL_SUBJECT_DESC',				'Subject of this email (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_EMAIL_TEXT_HTML_NAME',				'HTML Encoding' );
define( '_MI_MI_EMAIL_TEXT_HTML_DESC',				'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_MI_MI_EMAIL_TEXT_NAME',					'Text' );
define( '_MI_MI_EMAIL_TEXT_DESC',					'Text to be sent when the plan is purchased. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_SUBJECT_FIRST_NAME',			'Subject (New)' );
define( '_MI_MI_EMAIL_SUBJECT_FIRST_DESC',			'Subject of this email only when a user first signs up (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_EMAIL_TEXT_FIRST_HTML_NAME',		'HTML Encoding (New)' );
define( '_MI_MI_EMAIL_TEXT_FIRST_HTML_DESC',		'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_MI_MI_EMAIL_TEXT_FIRST_NAME',				'Text' );
define( '_MI_MI_EMAIL_TEXT_FIRST_DESC',				'Text to be sent when the plan is purchased and only when a user first signs up. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_SUBJECT_EXP_NAME',			'Expiration Subject' );
define( '_MI_MI_EMAIL_SUBJECT_EXP_DESC',			'Expiration Subject (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_EMAIL_TEXT_EXP_HTML_NAME',			'HTML Encoding (Expiration)' );
define( '_MI_MI_EMAIL_TEXT_EXP_HTML_DESC',			'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_MI_MI_EMAIL_TEXT_EXP_NAME',				'Expiration Text' );
define( '_MI_MI_EMAIL_TEXT_EXP_DESC',				'Text to be sent when the plan expires. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_SUBJECT_PRE_EXP_NAME',		'Subject' );
define( '_MI_MI_EMAIL_SUBJECT_PRE_EXP_DESC',		'Pre Expiration Subject (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_EMAIL_TEXT_PRE_EXP_HTML_NAME',		'HTML Encoding (Pre-Expiration)' );
define( '_MI_MI_EMAIL_TEXT_PRE_EXP_HTML_DESC',		'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_MI_MI_EMAIL_TEXT_PRE_EXP_NAME',			'Pre Expiration Text' );
define( '_MI_MI_EMAIL_TEXT_PRE_EXP_DESC',			'Text to be sent when the plan is about to expire (specify when on the previous tab). The rewriting routines explained below will work for this field.' );
define( '_AEC_MI_SET11_EMAIL',		'Rewriting Info' );

// iDevAffiliate
define( '_AEC_MI_NAME_IDEV',		'iDevAffiliate' );
define( '_AEC_MI_DESC_IDEV',		'Connect your sales to the iDevAffiliate Component' );
define( '_MI_MI_IDEVAFFILIATE_SETUPINFO_NAME',		'Important Information' );
define( '_MI_MI_IDEVAFFILIATE_SETUPINFO_DESC',		'Since you surely don\'t have your sale.php in your root directory, you must specify it otherwise, please do so in the directory setting below. You may leave out the root url that joomla sits in as that will be filled automatically. If you do put in a full path (since you might have your joomla in a completely different directory as iDev), the MI will understand that and NOT prefix any root url.' );
define( '_MI_MI_IDEVAFFILIATE_PROFILE_NAME',		'Profile' );
define( '_MI_MI_IDEVAFFILIATE_PROFILE_DESC',		'The Profile identification within iDevAffiliate' );
define( '_MI_MI_IDEVAFFILIATE_DIRECTORY_NAME',		'iDev Directory' );
define( '_MI_MI_IDEVAFFILIATE_DIRECTORY_DESC',		'Specify a subdirectory if iDevAffiliate does not rest in the directory as explained in the above box.' );
define( '_MI_MI_IDEVAFFILIATE_USE_CURL_NAME',		'Use CURL' );
define( '_MI_MI_IDEVAFFILIATE_USE_CURL_DESC',		'Normally, this MI will write to the DisplayPipeline (a module is required and the tracking code will be displayed to the user), but you can also do the tracking internally - the Payment Data and IP Address of the user will be transmitted directly when the payment arrives andd this MI is triggered.' );
define( '_MI_MI_IDEVAFFILIATE_ONLYCUSTOMPARAMS_NAME',		'Only Custom Parameters' );
define( '_MI_MI_IDEVAFFILIATE_ONLYCUSTOMPARAMS_DESC',		'Only transmit the custom parameters as specified below (instead of transmitting the regular - invoice number and amount - and the profile id if set).' );
define( '_MI_MI_IDEVAFFILIATE_CUSTOMPARAMS_NAME',		'Custom Parameters' );
define( '_MI_MI_IDEVAFFILIATE_CUSTOMPARAMS_DESC',		'If you want to transmit custom parameters instead of or additional to the regular parameters, please put them in here. Separated by linebreaks in the form of "parameter_name=parameter_value". The RewriteEngine works as specified below.' );

// MosetsTree
define( '_AEC_MI_NAME_MOSETS',		'MosetsTree' );
define( '_AEC_MI_DESC_MOSETS',		'Restrict the amount of listings a user can publish' );
define( '_MI_MI_MOSETS_TREE_SET_LISTINGS_NAME',		'Set listings' );
define( '_MI_MI_MOSETS_TREE_SET_LISTINGS_DESC',		'Input the amount of listings you want as an overwriting set for this call' );
define( '_MI_MI_MOSETS_TREE_ADD_LISTINGS_NAME',		'Add listings' );
define( '_MI_MI_MOSETS_TREE_ADD_LISTINGS_DESC',		'Input the amount of listings you want to add with this call' );
define( '_MI_MI_MOSETS_TREE_PUBLISH_ALL_NAME',		'Publish listings' );
define( '_MI_MI_MOSETS_TREE_PUBLISH_ALL_DESC',		'(Re-) Publish all listings of this user on action' );
define( '_MI_MI_MOSETS_TREE_UNPUBLISH_ALL_NAME',	'Unpublish listings' );
define( '_MI_MI_MOSETS_TREE_UNPUBLISH_ALL_DESC',	'Unpublish all listings of this user on expiration' );
define( '_MI_MI_MOSETS_TREE_FEATURE_ALL_NAME',		'Feature listings' );
define( '_MI_MI_MOSETS_TREE_FEATURE_ALL_DESC',		'(Re-) Feature all listings of this user on action' );
define( '_MI_MI_MOSETS_TREE_UNFEATURE_ALL_NAME',	'Unfeature listings' );
define( '_MI_MI_MOSETS_TREE_UNFEATURE_ALL_DESC',	'Unfeature all listings of this user on expiration' );
define( '_AEC_MI_HACK1_MOSETS',		'No Listings left' );
define( '_AEC_MI_HACK2_MOSETS',		'Registration and correct Subscription Required!' );
define( '_AEC_MI_HACK3_MOSETS',		'Prevent user from creating a new listing if he or she has run out of granted listings' );
define( '_AEC_MI_HACK4_MOSETS',		'Prevent user from saving a new listing if he or she has run out of granted listings. Also use a listing if the user has one left and it does not need to be approved - if it does, his listings count will be updated on the following hack.' );
define( '_AEC_MI_HACK5_MOSETS',		'Check for allowed listings and update the Used Listings counter when approving listings in the backend (see above for reference).' );
define( '_AEC_MI_DIV1_MOSETS',		'You can create <strong>%s</strong> more listings in our directory.' );

// MySQL Query
define( '_AEC_MI_NAME_MYSQL',		'mySQL Query' );
define( '_AEC_MI_DESC_MYSQL',		'Specify a mySQL query that should be carried out with this subscription or on its expiration' );
define( '_MI_MI_MYSQL_QUERY_QUERY_NAME',			'Query' );
define( '_MI_MI_MYSQL_QUERY_QUERY_DESC',			'MySQL query to be carried out when this MI is called.' );
define( '_MI_MI_MYSQL_QUERY_QUERY_EXP_NAME',		'Expiration Query' );
define( '_MI_MI_MYSQL_QUERY_QUERY_EXP_DESC',		'MySQL query to be carried out when this MI is called on expiration.' );
define( '_MI_MI_MYSQL_QUERY_QUERY_PRE_EXP_NAME',	'Pre Expiration Query' );
define( '_MI_MI_MYSQL_QUERY_QUERY_PRE_EXP_DESC',	'MySQL query to be carried out when this MI is called before expiration (specify when on the first tab)' );
define( '_AEC_MI_SET4_MYSQL',		'Rewriting Info' );

// reMOSitory
define( '_AEC_MI_NAME_REMOS',		'reMOSitory' );
define( '_AEC_MI_DESC_REMOS',		'Choose the amount of files a user can download and what reMOSitory group should be assigned to the user account' );
define( '_MI_MI_REMOSITORY_ADD_DOWNLOADS_NAME',		'Add Downloads' );
define( '_MI_MI_REMOSITORY_ADD_DOWNLOADS_DESC',		'Input the amount of downloads you want added to the users account for this call' );
define( '_MI_MI_REMOSITORY_SET_DOWNLOADS_NAME',		'Set Downloads' );
define( '_MI_MI_REMOSITORY_SET_DOWNLOADS_DESC',		'Input the amount of listings you want as a overwriting set for this call' );
define( '_MI_MI_REMOSITORY_SET_UNLIMITED_NAME',		'Set Unlimited' );
define( '_MI_MI_REMOSITORY_SET_UNLIMITED_DESC',		'Grant the user unlimited downloads.' );
define( '_MI_MI_REMOSITORY_SET_GROUP_NAME',			'Set group' );
define( '_MI_MI_REMOSITORY_SET_GROUP_DESC',			'Choose Yes if you want this MI to set the ReMOSitory Group when the calling payment plan expires' );
define( '_MI_MI_REMOSITORY_GROUP_NAME',				'Group' );
define( '_MI_MI_REMOSITORY_GROUP_DESC',				'The ReMOSitory group that you want the user to be in.' );
define( '_MI_MI_REMOSITORY_SET_GROUP_EXP_NAME',		'Set group Expiration' );
define( '_MI_MI_REMOSITORY_SET_GROUP_EXP_DESC',		'Choose Yes if you want this MI to set the ReMOSitory Group when the calling payment plan expires' );
define( '_MI_MI_REMOSITORY_GROUP_EXP_NAME',			'Expiration group' );
define( '_MI_MI_REMOSITORY_GROUP_EXP_DESC',			'The ReMOSitory group that you want the user to be in when the subscription runs out.' );
define( '_AEC_MI_HACK1_REMOS',		'No Credits' );
define( '_AEC_MI_HACK2_REMOS',		'Build in a downloads restriction for reMOSitory, to be used with Micro Integrations.' );
define( '_MI_MI_REMOSITORY_DELETE_ON_EXP_NAME', 			'Action for existing groups when account expires:' );
define( '_MI_MI_REMOSITORY_DELETE_ON_EXP_DESC',			'Choose what action you want to happen to already defined ReMOSitory groups when the user expires.' );
define( '_MI_MI_REMOSITORY_DELETERULES_NO',			'Just apply group(s) below.' );
define( '_MI_MI_REMOSITORY_DELETERULES_ALL',			'Delete ALL, then apply group(s) below.' );
define( '_MI_MI_REMOSITORY_DELETERULES_SET',			'Delete Group Set on Application, then apply group(s) below.' );

// VirtueMart
define( '_AEC_MI_NAME_VIRTM',		'VirtueMart' );
define( '_AEC_MI_DESC_VIRTM',		'Choose the VM usergroup this user should be applied to' );
define( '_MI_MI_VIRTUEMART_SET_SHOPPER_GROUP_NAME',	'Set Shopper group' );
define( '_MI_MI_VIRTUEMART_SET_SHOPPER_GROUP_DESC',	'Choose Yes if you want this MI to set the Shopper Group when it is called.' );
define( '_MI_MI_VIRTUEMART_SHOPPER_GROUP_NAME',		'Shopper group' );
define( '_MI_MI_VIRTUEMART_SHOPPER_GROUP_DESC',		'The VirtueMart Shopper group that you want the user to be in.' );
define( '_MI_MI_VIRTUEMART_SET_SHOPPER_GROUP_EXP_NAME',		'Set group Expiration' );
define( '_MI_MI_VIRTUEMART_SET_SHOPPER_GROUP_EXP_DESC',		'Choose Yes if you want this MI to set the Shopper Group when the calling payment plan expires.' );
define( '_MI_MI_VIRTUEMART_SHOPPER_GROUP_EXP_NAME',	'Expiration Shopper group' );
define( '_MI_MI_VIRTUEMART_SHOPPER_GROUP_EXP_DESC',	'The VirtueMart Shopper group that you want the user to be in when the subscription runs out.' );
define( '_MI_MI_VIRTUEMART_CREATE_ACCOUNT_NAME',	'Auto Create Account' );
define( '_MI_MI_VIRTUEMART_CREATE_ACCOUNT_DESC',	'Select "Yes" if you want this MI to also create a new VirtueMart account if there is none for the user.' );
define( '_MI_MI_VIRTUEMART_REBUILD_NAME',	'Rebuild' );
define( '_MI_MI_VIRTUEMART_REBUILD_DESC',	'Attempt to rebuild the list of users assigned to the usergroup according to their relationship to a plan that holds this MI.' );
define( '_MI_MI_VIRTUEMART_REMOVE_NAME', 				'Remove: ' );
define( '_MI_MI_VIRTUEMART_REMOVE_DESC',				'Carry out the expiration action for all users with an active plan attached to this micro-integration' );

// Joomlauser
define( '_AEC_MI_NAME_JOOMLAUSER',		'Joomla User' );
define( '_AEC_MI_DESC_JOOMLAUSER',		'Actions that affect the joomla user account' );
define( '_MI_MI_JOOMLAUSER_ACTIVATE_NAME',			'Activate' );
define( '_MI_MI_JOOMLAUSER_ACTIVATE_DESC',			'Setting this to "Yes" will unblock a user and clean the activation code' );
define( '_MI_MI_JOOMLAUSER_USERNAME_NAME',			'Username' );
define( '_MI_MI_JOOMLAUSER_USERNAME_DESC',			'Automatically set a username (ReWrite-Engine applies)' );
define( '_MI_MI_JOOMLAUSER_USERNAME_RAND_NAME',		'Random Username' );
define( '_MI_MI_JOOMLAUSER_USERNAME_RAND_DESC',		'Automatically set a random username - please provide a number of characters (ReWrite-Engine does not apply)' );
define( '_MI_MI_JOOMLAUSER_PASSWORD_NAME',			'Password' );
define( '_MI_MI_JOOMLAUSER_PASSWORD_DESC',			'Automatically set a password (ReWrite-Engine applies)' );

// CommunityBuilder
define( '_AEC_MI_NAME_COMMUNITYBUILDER',				'Community Builder' );
define( '_AEC_MI_DESC_COMMUNITYBUILDER',				'Actions that affect the Community Builder user account' );
define( '_MI_MI_COMMUNITYBUILDER_APPROVE_NAME',			'Approve' );
define( '_MI_MI_COMMUNITYBUILDER_APPROVE_DESC',			'Carry out an Admin Approval when this MI is triggered.' );
define( '_MI_MI_COMMUNITYBUILDER_UNAPPROVE_EXP_NAME',	'Reset Approval' );
define( '_MI_MI_COMMUNITYBUILDER_UNAPPROVE_EXP_DESC',	'Set the Admin Approval of a user to "No" when expired.' );
define( '_MI_MI_COMMUNITYBUILDER_SET_FIELDS_NAME',		'Set Fields' );
define( '_MI_MI_COMMUNITYBUILDER_SET_FIELDS_DESC',		'Automatically set the fields (which are not marked with "(expiration)" when the plan is paid for.' );
define( '_MI_MI_COMMUNITYBUILDER_SET_FIELDS_EXP_NAME',	'Set Fields Expiration' );
define( '_MI_MI_COMMUNITYBUILDER_SET_FIELDS_EXP_DESC',	'Automatically set the fields (which are marked with "(expiration)" when the plan is paid for.' );
define( '_MI_MI_COMMUNITYBUILDER_EXPMARKER',			'(expiration)' );

// JUGA
define( '_AEC_MI_NAME_JUGA',		'JUGA' );
define( '_AEC_MI_DESC_JUGA',		'Set JUGA groups on application or expiration of a plan' );
define( '_MI_MI_JUGA_SET_ENROLL_GROUP_NAME',		'Add to Group' );
define( '_MI_MI_JUGA_SET_ENROLL_GROUP_DESC',		'Set to yes, and pick groups below to enroll the user in on application of plan? (Multiple select allowed)' );
define( '_MI_MI_JUGA_ENROLL_GROUP_NAME',			'JUGA Group' );
define( '_MI_MI_JUGA_ENROLL_GROUP_DESC',			'Select a plan to enroll the user in on application of plan:' );
define( '_MI_MI_JUGA_SET_REMOVE_GROUP_NAME',		'Remove Groups' );
define( '_MI_MI_JUGA_SET_REMOVE_GROUP_DESC',		'Set to yes, to delete all groups for this user before the groups below are applied, otherwise these groups will be added to existing groups.' );
define( '_MI_MI_JUGA_SET_ENROLL_GROUP_EXP_NAME',	'Add to Group Exp' );
define( '_MI_MI_JUGA_SET_ENROLL_GROUP_EXP_DESC',	'Set to yes, and pick groups below to enroll the user in on expiration of plan? (Multiple select allowed)' );
define( '_MI_MI_JUGA_ENROLL_GROUP_EXP_NAME',		'JUGA Group Exp' );
define( '_MI_MI_JUGA_ENROLL_GROUP_EXP_DESC',		'Select a plan to enroll the user in on expiration of plan:' );
define( '_MI_MI_JUGA_SET_REMOVE_GROUP_EXP_NAME',	'Remove Groups Exp' );
define( '_MI_MI_JUGA_SET_REMOVE_GROUP_EXP_DESC',	'Set to yes, to delete all groups for this user before the groups below are applied, otherwise these groups will be added to existing groups.' );
define( '_MI_MI_JUGA_REBUILD_NAME',					'Rebuild' );
define( '_MI_MI_JUGA_REBUILD_DESC',					'Select YES to rebuild the groups relations after saving this' );
define( '_MI_MI_JUGA_REMOVE_NAME', 					'Remove: ' );
define( '_MI_MI_JUGA_REMOVE_DESC',					'Carry out the expiration action for all users with an active plan attached to this micro-integration' );

// DisplayPipeline
define( '_AEC_MI_NAME_DISPLAYPIPELINE',		'DisplayPipeline' );
define( '_AEC_MI_DESC_DISPLAYPIPELINE',		'Display Text on the AEC Module' );
define( '_MI_MI_DISPLAYPIPELINE_ONLY_USER_NAME',		'Only to User' );
define( '_MI_MI_DISPLAYPIPELINE_ONLY_USER_DESC',		'Only display this text to the user who issued this request' );
define( '_MI_MI_DISPLAYPIPELINE_ONCE_PER_USER_NAME',	'Once per User' );
define( '_MI_MI_DISPLAYPIPELINE_ONCE_PER_USER_DESC',	'Only display this text once to a user. This will be set to no automatically if you set the above switch to save ressources.' );
define( '_MI_MI_DISPLAYPIPELINE_EXPIRE_NAME',			'Expire' );
define( '_MI_MI_DISPLAYPIPELINE_EXPIRE_DESC',			'Do not display after a certain date.' );
define( '_MI_MI_DISPLAYPIPELINE_EXPIRATION_NAME',		'Expiration' );
define( '_MI_MI_DISPLAYPIPELINE_EXPIRATION_DESC',		'Set this as Expiration. Refer to the php.net manual on the strtotime function to see what you can use as input here.' );
define( '_MI_MI_DISPLAYPIPELINE_DISPLAYMAX_NAME',		'Display Max' );
define( '_MI_MI_DISPLAYPIPELINE_DISPLAYMAX_DESC',		'Set amount of times this can be displayed' );
define( '_MI_MI_DISPLAYPIPELINE_TEXT_NAME',				'Text' );
define( '_MI_MI_DISPLAYPIPELINE_TEXT_DESC',				'Text that is displayed to the user. You can use the rewrite strings explained below to insert dynamic data.' );

// GoogleAnalytics
define( '_AEC_MI_NAME_GOOGLEANALYTICS',		'Google Analytics' );
define( '_AEC_MI_DESC_GOOGLEANALYTICS',		'With this, you can attach Google Analytics e-commerce tracking code to the DisplayPipeline.' );
define( '_MI_MI_GOOGLEANALYTICS_ACCOUNT_ID_NAME',		'Google Account ID' );
define( '_MI_MI_GOOGLEANALYTICS_ACCOUNT_ID_DESC',		'Your Google Account id, it should look like this: UA-xxxx-x' );

// Fireboard
define( '_AEC_MI_NAME_FIREBOARD','Fireboard Micro Integration' );
define( '_AEC_MI_DESC_FIREBOARD','Will automate addition of a user to a group in FireBoard' );
define( '_MI_MI_FIREBOARD_SET_GROUP_NAME','Set group on plan application' );
define( '_MI_MI_FIREBOARD_SET_GROUP_DESC','Choose Yes if you wish a fireboard group to be applied when the plan is applied' );
define( '_MI_MI_FIREBOARD_GROUP_NAME','Fireboard group to apply member to on application' );
define( '_MI_MI_FIREBOARD_GROUP_DESC','The group you wish applied - if you chose yes. Manually create groups in table jos_fb_groups' );
define( '_MI_MI_FIREBOARD_SET_GROUP_EXP_NAME','Set group on expiration of plan' );
define( '_MI_MI_FIREBOARD_SET_GROUP_EXP_DESC','Choose Yes if you wish the fireboard group to be changed when the plan expires' );
define( '_MI_MI_FIREBOARD_GROUP_EXP_NAME','Fireboard group to apply member to on expiration of plan.' );
define( '_MI_MI_FIREBOARD_GROUP_EXP_DESC','The group you wish to use if the plan expires.  Manually add groups to the table jos_fb_groups' );
define( '_MI_MI_FIREBOARD_REBUILD_NAME',				'Rebuild Groups' );
define( '_MI_MI_FIREBOARD_REBUILD_DESC',				'This option will rebuild your whole Fireboard group assignment by looking for each plan that has this MI applied and then add each user that uses one of these plans to the file.' );
define( '_MI_MI_FIREBOARD_REMOVE_NAME', 				'Remove: ' );
define( '_MI_MI_FIREBOARD_REMOVE_DESC',					'Carry out the expiration action for all users with an active plan attached to this micro-integration' );

// Coupon
define( '_AEC_MI_NAME_COUPON', 'Coupons' );
define( '_AEC_MI_DESC_COUPON', 'Create and send out coupons' );
define( '_MI_MI_COUPON_MASTER_COUPON_NAME', 'Master Coupon' );
define( '_MI_MI_COUPON_MASTER_COUPON_DESC', 'Which Master Coupon should these be copied from?' );
define( '_MI_MI_COUPON_SWITCH_TYPE_NAME', 'Switch Type' );
define( '_MI_MI_COUPON_SWITCH_TYPE_DESC', 'If the master coupon is static, make this a regular coupon and vice versa.' );
define( '_MI_MI_COUPON_BIND_SUBSCRIPTION_NAME', 'Bind to Subscription' );
define( '_MI_MI_COUPON_BIND_SUBSCRIPTION_DESC', 'If activated, the coupons will only be usable if the subscription they have been created with is still active as well' );
define( '_MI_MI_COUPON_CREATE_NEW_COUPONS_NAME', 'Amount' );
define( '_MI_MI_COUPON_CREATE_NEW_COUPONS_DESC', 'The amount of coupons that should be created' );
define( '_MI_MI_COUPON_MAX_REUSE_NAME', 'Max Reuse Coupons' );
define( '_MI_MI_COUPON_MAX_REUSE_DESC', 'The amount of times these coupons can be used' );
define( '_MI_MI_COUPON_MAIL_OUT_COUPONS_NAME', 'Mail out Coupons' );
define( '_MI_MI_COUPON_MAIL_OUT_COUPONS_DESC', 'This will send the coupons in an email to the address specified below' );
define( '_MI_MI_COUPON_ALWAYS_NEW_COUPONS_NAME', 'Always new ones?' );
define( '_MI_MI_COUPON_ALWAYS_NEW_COUPONS_DESC', 'Always create new coupons (Yes) if the MI is triggered or only on the first time (No)?' );
define( '_MI_MI_COUPON_INC_OLD_COUPONS_NAME', 'Increment Old Coupons' );
define( '_MI_MI_COUPON_INC_OLD_COUPONS_DESC', 'Will increment the uses of old coupons by the given amount, so that they can be used again after the subscription has been renewed' );
define( '_MI_MI_COUPON_SENDER_NAME',				'Sender E-Mail' );
define( '_MI_MI_COUPON_SENDER_DESC',				'Sender E-Mail Address' );
define( '_MI_MI_COUPON_SENDER_NAME_NAME',			'Sender Name' );
define( '_MI_MI_COUPON_SENDER_NAME_DESC',			'The displayed name of the Sender' );
define( '_MI_MI_COUPON_RECIPIENT_NAME',				'Recipient(s)' );
define( '_MI_MI_COUPON_RECIPIENT_DESC',				'Who is to receive this E-Mail? Separate with comma. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_COUPON_SUBJECT_NAME',				'Subject' );
define( '_MI_MI_COUPON_SUBJECT_DESC',				'Subject of this email (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_COUPON_TEXT_HTML_NAME',				'HTML Encoding' );
define( '_MI_MI_COUPON_TEXT_HTML_DESC',				'Do you want this email to be HTML encoded? (Make sure that there are no tags in it if you do not want this)' );
define( '_MI_MI_COUPON_TEXT_NAME',					'Text' );
define( '_MI_MI_COUPON_TEXT_DESC',					'Text to be sent when the coupons are created. The rewriting routines explained below will work for this field. Mark the point where the coupon codes are displayed with "%s"!' );

// Attend Events
define( '_AEC_MI_NAME_ATTEND_EVENTS',		'Attend Events' );
define( '_AEC_MI_DESC_ATTEND_EVENTS',		'Dummy MicroIntegration - for now only links payments from AE to AEC' );

// HTTP QUERY
define( '_AEC_MI_NAME_HTTP_QUERY',		'HTTP Query' );
define( '_AEC_MI_DESC_HTTP_QUERY',		'Sends out a HTTP request to an url, including GET variables' );
define( '_MI_MI_HTTP_QUERY_URL_NAME',			'URL' );
define( '_MI_MI_HTTP_QUERY_URL_DESC',			'The URL that this Request should go to.' );
define( '_MI_MI_HTTP_QUERY_QUERY_NAME',			'Query Variables' );
define( '_MI_MI_HTTP_QUERY_QUERY_DESC',			'Transmit these variables via HTTP GET when calling the URL. Separated by linebreaks in the form of "parameter_name=parameter_value". The RewriteEngine works as specified below.' );
define( '_MI_MI_HTTP_QUERY_URL_EXP_NAME',			'URL (Expiration)' );
define( '_MI_MI_HTTP_QUERY_URL_EXP_DESC',			'The URL that this Request should go to when the plan is expired.' );
define( '_MI_MI_HTTP_QUERY_QUERY_EXP_NAME',			'Query Variables' );
define( '_MI_MI_HTTP_QUERY_QUERY_EXP_DESC',			'Transmit these variables via HTTP GET when calling the URL. Separated by linebreaks in the form of "parameter_name=parameter_value". The RewriteEngine works as specified below.' );
define( '_MI_MI_HTTP_QUERY_URL_PRE_EXP_NAME',			'URL (Before Expiration)' );
define( '_MI_MI_HTTP_QUERY_URL_PRE_EXP_DESC',			'The URL that this Request should go to before the plan is expired.' );
define( '_MI_MI_HTTP_QUERY_QUERY_PRE_EXP_NAME',			'Query Variables' );
define( '_MI_MI_HTTP_QUERY_QUERY_PRE_EXP_DESC',			'Transmit these variables via HTTP GET when calling the URL. Separated by linebreaks in the form of "parameter_name=parameter_value". The RewriteEngine works as specified below.' );

// MySMS
define( '_AEC_MI_NAME_MYSMS', 'MySMS Micro Integration' );
define( '_AEC_MI_DESC_MYSMS', 'Will automate enable a user to send sms via MySMS, and add x credits to the account.' );
define( '_MI_MI_MYSMS_ADD_CREDITS_NAME', 'Add credits' );
define( '_MI_MI_MYSMS_ADD_CREDITS_DESC', 'Add this amount of credits.' );
define( '_MI_MI_MYSMS_DISABLE_EXP_NAME', 'Disable Account (Expiration)' );
define( '_MI_MI_MYSMS_DISABLE_EXP_DESC', 'Disable the user account on expiration.' );

// ACL
define( '_AEC_MI_NAME_ACL', 'Usergroup MI (ACL)' );
define( '_AEC_MI_DESC_ACL', 'Set the usergroup for the user account.' );
define( '_MI_MI_ACL_CHANGE_SESSION_NAME', 'Change Session' );
define( '_MI_MI_ACL_CHANGE_SESSION_DESC', 'Do a direct write on the Session data, so that the user account is immediately changed and not just on the next login.' );
define( '_MI_MI_ACL_SET_GID_NAME', 'Set GID?' );
define( '_MI_MI_ACL_SET_GID_DESC', 'Activate setting of a GID when applying the plan' );
define( '_MI_MI_ACL_GID_NAME', 'GID' );
define( '_MI_MI_ACL_GID_DESC', 'Set this Usergroup for the Account.' );
define( '_MI_MI_ACL_SET_GID_EXP_NAME', 'Set on Expir.?' );
define( '_MI_MI_ACL_SET_GID_EXP_DESC', 'Activate setting of a GID on Expiration' );
define( '_MI_MI_ACL_GID_EXP_NAME', 'Expir. GID' );
define( '_MI_MI_ACL_GID_EXP_DESC', 'Set this Usergroup for the Account when it expires.' );
define( '_MI_MI_ACL_SET_GID_PRE_EXP_NAME', 'Set PreExpir.?' );
define( '_MI_MI_ACL_SET_GID_PRE_EXP_DESC', 'Activate setting of a GID before expiration' );
define( '_MI_MI_ACL_GID_PRE_EXP_NAME', 'PreExpir. GID' );
define( '_MI_MI_ACL_GID_PRE_EXP_DESC', 'Set this Usergroup for the Account when before expires' );
define( '_MI_MI_ACL_JACLPLUSPRO_NAME', 'Use JACLplus PRO' );
define( '_MI_MI_ACL_JACLPLUSPRO_DESC', 'With JACLplus PRO, you can use a few other ACL features specified below' );
define( '_MI_MI_ACL_DELETE_SUBGROUPS_NAME', 'Clear Subgroups' );
define( '_MI_MI_ACL_DELETE_SUBGROUPS_DESC', 'Always delete all Subgroups that the user holds before applying new ones' );
define( '_MI_MI_ACL_SUB_SET_GID_NAME', 'Set Subgroups' );
define( '_MI_MI_ACL_SUB_SET_GID_DESC', 'Activate setting of Subgroups when applying the plan' );
define( '_MI_MI_ACL_SUB_GID_DEL_NAME', 'Delete Subgroups' );
define( '_MI_MI_ACL_SUB_GID_DEL_DESC', 'Delete these Subgroups if the user holds them (CTRL+click to select multiple)' );
define( '_MI_MI_ACL_SUB_GID_NAME', 'Add Subgroups' );
define( '_MI_MI_ACL_SUB_GID_DESC', 'Add these Subgroups (CTRL+click to select multiple)' );
define( '_MI_MI_ACL_SUB_SET_GID_EXP_NAME', 'Set Subgroups Expiration' );
define( '_MI_MI_ACL_SUB_SET_GID_EXP_DESC', 'Activate setting of Subgroups when the plan expires' );
define( '_MI_MI_ACL_SUB_GID_EXP_DEL_NAME', 'Delete Subgroups' );
define( '_MI_MI_ACL_SUB_GID_EXP_DEL_DESC', 'Delete these Subgroups if the user holds them (CTRL+click to select multiple)' );
define( '_MI_MI_ACL_SUB_GID_EXP_NAME', 'Add Subgroups' );
define( '_MI_MI_ACL_SUB_GID_EXP_DESC', 'Add these Subgroups (CTRL+click to select multiple)' );
define( '_MI_MI_ACL_SUB_SET_GID_PRE_EXP_NAME', 'Set Subgroups PreExpiration' );
define( '_MI_MI_ACL_SUB_SET_GID_PRE_EXP_DESC', 'Activate setting of Subgroups before the plan expires' );
define( '_MI_MI_ACL_SUB_GID_PRE_EXP_DEL_NAME', 'Delete Subgroups' );
define( '_MI_MI_ACL_SUB_GID_PRE_EXP_DEL_DESC', 'Delete these Subgroups if the user holds them (CTRL+click to select multiple)' );
define( '_MI_MI_ACL_SUB_GID_PRE_EXP_NAME', 'Add Subgroups' );
define( '_MI_MI_ACL_SUB_GID_PRE_EXP_DESC', 'Add these Subgroups (CTRL+click to select multiple)' );

// eventlog
define( '_AEC_MI_EVENTLOG_NAME', 'Eventlog' );
define( '_AEC_MI_EVENTLOG_DESC', 'Make entries into the Eventlog' );
define( '_MI_MI_EVENTLOG_SHORT_NAME', 'Short' );
define( '_MI_MI_EVENTLOG_SHORT_DESC', 'The short explanation or title of the entry.' );

define( '_MI_MI_EVENTLOG_TAGS_NAME', 'Tags' );
define( '_MI_MI_EVENTLOG_TAGS_DESC', 'Tags for this entry' );
define( '_MI_MI_EVENTLOG_TEXT_NAME', 'Text' );
define( '_MI_MI_EVENTLOG_TEXT_DESC', 'Text or long explanation of the entry.' );
define( '_MI_MI_EVENTLOG_LEVEL_NAME', 'Level' );
define( '_MI_MI_EVENTLOG_LEVEL_DESC', 'Importance Level of the entry' );
define( '_MI_MI_EVENTLOG_FORCE_NOTIFY_NAME', 'Force Notification' );
define( '_MI_MI_EVENTLOG_FORCE_NOTIFY_DESC', 'Force appearance of this entry on the central page, regardless of the settings for notification.' );
define( '_MI_MI_EVENTLOG_FORCE_EMAIL_NAME', 'Force E-Mail' );
define( '_MI_MI_EVENTLOG_FORCE_EMAIL_DESC', 'Force emailing of this entry, regardless of the settings for notification.' );
define( '_MI_MI_EVENTLOG_SHORT_EXP_NAME', 'Short (Expiration)' );
define( '_MI_MI_EVENTLOG_SHORT_EXP_DESC', 'The short explanation or title of the entry.' );
define( '_MI_MI_EVENTLOG_TAGS_EXP_NAME', 'Tags (Expiration)' );
define( '_MI_MI_EVENTLOG_TAGS_EXP_DESC', 'Tags for this entry' );
define( '_MI_MI_EVENTLOG_TEXT_EXP_NAME', 'Text (Expiration)' );
define( '_MI_MI_EVENTLOG_TEXT_EXP_DESC', 'Text or long explanation of the entry.' );
define( '_MI_MI_EVENTLOG_LEVEL_EXP_NAME', 'Level (Expiration)' );
define( '_MI_MI_EVENTLOG_LEVEL_EXP_DESC', 'Importance Level of the entry' );
define( '_MI_MI_EVENTLOG_FORCE_NOTIFY_EXP_NAME', 'Force Notification (Expiration)' );
define( '_MI_MI_EVENTLOG_FORCE_NOTIFY_EXP_DESC', 'Force appearance of this entry on the central page, regardless of the settings for notification.' );
define( '_MI_MI_EVENTLOG_FORCE_EMAIL_EXP_NAME', 'Force E-Mail (Expiration)' );
define( '_MI_MI_EVENTLOG_FORCE_EMAIL_EXP_DESC', 'Force emailing of this entry, regardless of the settings for notification.' );
define( '_MI_MI_EVENTLOG_SHORT_PRE_EXP_NAME', 'Short (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_SHORT_PRE_EXP_DESC', 'The short explanation or title of the entry.' );
define( '_MI_MI_EVENTLOG_TAGS_PRE_EXP_NAME', 'Tags (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_TAGS_PRE_EXP_DESC', 'Tags for this entry' );
define( '_MI_MI_EVENTLOG_TEXT_PRE_EXP_NAME', 'Text (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_TEXT_PRE_EXP_DESC', 'Text or long explanation of the entry.' );
define( '_MI_MI_EVENTLOG_LEVEL_PRE_EXP_NAME', 'Level (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_LEVEL_PRE_EXP_DESC', 'Importance Level of the entry' );
define( '_MI_MI_EVENTLOG_FORCE_NOTIFY_PRE_EXP_NAME', 'Force Notification (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_FORCE_NOTIFY_PRE_EXP_DESC', 'Force appearance of this entry on the central page, regardless of the settings for notification.' );
define( '_MI_MI_EVENTLOG_FORCE_EMAIL_PRE_EXP_NAME', 'Force E-Mail (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_FORCE_EMAIL_PRE_EXP_DESC', 'Force emailing of this entry, regardless of the settings for notification.' );
define( '_MI_MI_EVENTLOG_PARAMS_NAME', 'Params' );
define( '_MI_MI_EVENTLOG_PARAMS_DESC', 'Parameters for this entry.' );
define( '_MI_MI_EVENTLOG_PARAMS_EXP_NAME', 'Params (Expiration)' );
define( '_MI_MI_EVENTLOG_PARAMS_EXP_DESC', 'Parameters for this entry on the expiration event.' );
define( '_MI_MI_EVENTLOG_PARAMS_PRE_EXP_NAME', 'Params (Pre-Expiration)' );
define( '_MI_MI_EVENTLOG_PARAMS_PRE_EXP_DESC', 'Parameters for this entry on the pre-expiration event.' );

// JARC
define( '_AEC_MI_NAME_JARC', 'JARC' );
define( '_AEC_MI_DESC_JARC', 'Create affililates and track payments in JARC' );
define( '_MI_MI_JARC_CREATE_AFFILIATES_NAME', 'Create Affiliates' );
define( '_MI_MI_JARC_CREATE_AFFILIATES_DESC', 'Create new affiliate accounts when the user is just registering at your site.' );
define( '_MI_MI_JARC_LOG_PAYMENTS_NAME', 'Log Payments' );
define( '_MI_MI_JARC_LOG_PAYMENTS_DESC', 'Log transactions in JARC.' );
define( '_MI_MI_JARC_LOG_SALES_NAME', 'Log Sales' );
define( '_MI_MI_JARC_LOG_SALES_DESC', 'Log Sales in JARC.' );

// APC
define( '_AEC_MI_NAME_APC', 'APC' );
define( '_AEC_MI_DESC_APC', 'Manage Advanced Profile Control access groups' );
define( '_MI_MI_APC_SET_GROUP_NAME',		'Set APC Group' );
define( '_MI_MI_APC_SET_GROUP_DESC',		'Choose Yes if you want this MI to set the APC Group when it is called.' );
define( '_MI_MI_APC_SET_DEFAULT_NAME',		'Set Default' );
define( '_MI_MI_APC_SET_DEFAULT_DESC',		'Disregard the group setting below and apply the default group.' );
define( '_MI_MI_APC_GROUP_NAME',			'APC Group' );
define( '_MI_MI_APC_GROUP_DESC',			'The APC group that you want the user to be in.' );
define( '_MI_MI_APC_SET_GROUP_EXP_NAME',	'Expiration group' );
define( '_MI_MI_APC_SET_GROUP_EXP_DESC',	'The APC group that you want the user to be in when the subscription runs out.' );
define( '_MI_MI_APC_SET_DEFAULT_EXP_NAME',	'Set Default (exp)' );
define( '_MI_MI_APC_SET_DEFAULT_EXP_DESC',	'Disregard the group setting below and apply the default group.' );
define( '_MI_MI_APC_GROUP_EXP_NAME',		'Set APC Group expiration' );
define( '_MI_MI_APC_GROUP_EXP_DESC',		'Choose Yes if you want this MI to set the APC Group when the calling payment plan expires.' );
define( '_MI_MI_APC_REBUILD_NAME',			'Rebuild' );
define( '_MI_MI_APC_REBUILD_DESC',			'Attempt to rebuild the list of users assigned to the usergroup - >Set APC Group< and >APC Group< have to both be set for this.' );
define( '_MI_MI_APC_REMOVE_NAME', 				'Remove: ' );
define( '_MI_MI_APC_REMOVE_DESC',			'Carry out the expiration action for all users with an active plan attached to this micro-integration' );

// Hot Property
define( '_AEC_MI_HOTPROPERTY_NAME', 'Hot Property' );
define( '_AEC_MI_HOTPROPERTY_DESC', 'Create and change Agents and Companies with this MI' );
define( '_MI_MI_HOTPROPERTY_CREATE_AGENT_NAME',		'Create Agent' );
define( '_MI_MI_HOTPROPERTY_CREATE_AGENT_DESC',		'Choose Yes if you want this MI to create an agent on Subscription (if there is none yet for this user).' );
define( '_MI_MI_HOTPROPERTY_AGENT_FIELDS_NAME',		'Agent Fields' );
define( '_MI_MI_HOTPROPERTY_AGENT_FIELDS_DESC',		'Tell the AEC which fields should be associated in setting up the agent account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AGENT_NAME',		'Update Agent' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AGENT_DESC',		'Choose Yes if you want this MI to update the agent related to this user on Subscription.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AFIELDS_NAME',		'Update Agent Fields' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AFIELDS_DESC',		'Tell the AEC which fields should be associated in changing up the agent account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_CREATE_COMPANY_NAME',	'Create Company' );
define( '_MI_MI_HOTPROPERTY_CREATE_COMPANY_DESC',	'Choose Yes if you want this MI to create a company on Subscription (if there is none yet for this user).' );
define( '_MI_MI_HOTPROPERTY_COMPANY_FIELDS_NAME',	'Company Fields' );
define( '_MI_MI_HOTPROPERTY_COMPANY_FIELDS_DESC',	'Tell the AEC which fields should be associated in setting up the company account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_COMPANY_NAME',		'Update Company' );
define( '_MI_MI_HOTPROPERTY_UPDATE_COMPANY_DESC',		'Choose Yes if you want this MI to update the agent related to this user on Subscription.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_CFIELDS_NAME',		'Update Company Fields' );
define( '_MI_MI_HOTPROPERTY_UPDATE_CFIELDS_DESC',		'Tell the AEC which fields should be associated in changing up the company account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_PUBLISH_ALL_NAME',		'Publish properties' );
define( '_MI_MI_HOTPROPERTY_PUBLISH_ALL_DESC',		'(Re-) Publish all properties of this user on action' );
define( '_MI_MI_HOTPROPERTY_UNPUBLISH_ALL_NAME',	'Unpublish properties' );
define( '_MI_MI_HOTPROPERTY_UNPUBLISH_ALL_DESC',	'Unpublish all properties of this user on action' );

define( '_MI_MI_HOTPROPERTY_CREATE_AGENT_EXP_NAME',		'Create Agent (Expiration)' );
define( '_MI_MI_HOTPROPERTY_CREATE_AGENT_EXP_DESC',		'Choose Yes if you want this MI to create an agent on Expiration (if there is none yet for this user).' );
define( '_MI_MI_HOTPROPERTY_AGENT_FIELDS_EXP_NAME',		'Agent Fields (Expiration)' );
define( '_MI_MI_HOTPROPERTY_AGENT_FIELDS_EXP_DESC',		'Tell the AEC which fields should be associated in setting up the agent account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AGENT_EXP_NAME',		'Update Agent (Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AGENT_EXP_DESC',		'Choose Yes if you want this MI to update the agent related to this user on Expiration.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AFIELDS_EXP_NAME',		'Update Agent Fields (Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AFIELDS_EXP_DESC',		'Tell the AEC which fields should be associated in changing up the agent account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_CREATE_COMPANY_EXP_NAME',	'Create Company (Expiration)' );
define( '_MI_MI_HOTPROPERTY_CREATE_COMPANY_EXP_DESC',	'Choose Yes if you want this MI to create a company on Expiration (if there is none yet for this user).' );
define( '_MI_MI_HOTPROPERTY_COMPANY_FIELDS_EXP_NAME',	'Company Fields (Expiration)' );
define( '_MI_MI_HOTPROPERTY_COMPANY_FIELDS_EXP_DESC',	'Tell the AEC which fields should be associated in setting up the company account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_COMPANY_EXP_NAME',		'Update Company (Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_COMPANY_EXP_DESC',		'Choose Yes if you want this MI to update the agent related to this user on Expiration.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_CFIELDS_EXP_NAME',		'Update Company Fields (Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_CFIELDS_EXP_DESC',		'Tell the AEC which fields should be associated in changing up the company account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_PUBLISH_ALL_EXP_NAME',		'Publish properties (Expiration)' );
define( '_MI_MI_HOTPROPERTY_PUBLISH_ALL_EXP_DESC',		'(Re-) Publish all properties of this user on expiration' );
define( '_MI_MI_HOTPROPERTY_UNPUBLISH_ALL_EXP_NAME',	'Unpublish properties (Expiration)' );
define( '_MI_MI_HOTPROPERTY_UNPUBLISH_ALL_EXP_DESC',	'Unpublish all properties of this user on expiration' );

define( '_MI_MI_HOTPROPERTY_CREATE_AGENT_PRE_EXP_NAME',		'Create Agent (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_CREATE_AGENT_PRE_EXP_DESC',		'Choose Yes if you want this MI to create an agent before Expiration (if there is none yet for this user).' );
define( '_MI_MI_HOTPROPERTY_AGENT_FIELDS_PRE_EXP_NAME',		'Agent Fields (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_AGENT_FIELDS_PRE_EXP_DESC',		'Tell the AEC which fields should be associated in setting up the agent account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AGENT_PRE_EXP_NAME',		'Update Agent (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AGENT_PRE_EXP_DESC',		'Choose Yes if you want this MI to update the agent related to this user before Expiration.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AFIELDS_PRE_EXP_NAME',		'Update Agent Fields (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_AFIELDS_PRE_EXP_DESC',		'Tell the AEC which fields should be associated in changing up the agent account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_CREATE_COMPANY_PRE_EXP_NAME',	'Create Company (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_CREATE_COMPANY_PRE_EXP_DESC',	'Choose Yes if you want this MI to create a company before Expiration (if there is none yet for this user).' );
define( '_MI_MI_HOTPROPERTY_COMPANY_FIELDS_PRE_EXP_NAME',	'Company Fields (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_COMPANY_FIELDS_PRE_EXP_DESC',	'Tell the AEC which fields should be associated in setting up the company account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_COMPANY_PRE_EXP_NAME',		'Update Company (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_COMPANY_PRE_EXP_DESC',		'Choose Yes if you want this MI to update the agent related to this user before Expiration.' );
define( '_MI_MI_HOTPROPERTY_UPDATE_CFIELDS_PRE_EXP_NAME',		'Update Company Fields (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_UPDATE_CFIELDS_PRE_EXP_DESC',		'Tell the AEC which fields should be associated in changing up the company account. As seen in the example, part individual columns with a newline break and for each column, make it look like this: "fieldname=content". You can use the RewriteEngine as mentioned below.' );
define( '_MI_MI_HOTPROPERTY_PUBLISH_ALL_PRE_EXP_NAME',		'Publish properties (Pre Expiration' );
define( '_MI_MI_HOTPROPERTY_PUBLISH_ALL_PRE_EXP_DESC',		'(Re-) Publish all properties of this user before Expiration' );
define( '_MI_MI_HOTPROPERTY_UNPUBLISH_ALL_PRE_EXP_NAME',	'Unpublish properties (Pre Expiration' );
define( '_MI_MI_HOTPROPERTY_UNPUBLISH_ALL_PRE_EXP_DESC',	'Unpublish all properties of this user before Expiration' );

define( '_MI_MI_HOTPROPERTY_SET_LISTINGS_NAME',		'Set listings' );
define( '_MI_MI_HOTPROPERTY_SET_LISTINGS_DESC',		'Input the amount of listings you want as an overwriting set for this call' );
define( '_MI_MI_HOTPROPERTY_ADD_LISTINGS_NAME',		'Add listings' );
define( '_MI_MI_HOTPROPERTY_ADD_LISTINGS_DESC',		'Input the amount of listings you want to add with this call' );
define( '_MI_MI_HOTPROPERTY_SET_LISTINGS_EXP_NAME',		'Set listings (Expiration)' );
define( '_MI_MI_HOTPROPERTY_SET_LISTINGS_EXP_DESC',		'Input the amount of listings you want as an overwriting set on expiration' );
define( '_MI_MI_HOTPROPERTY_ADD_LISTINGS_EXP_NAME',		'Add listings (Expiration)' );
define( '_MI_MI_HOTPROPERTY_ADD_LISTINGS_EXP_DESC',		'Input the amount of listings you want to add with on expiration' );
define( '_MI_MI_HOTPROPERTY_SET_LISTINGS_PRE_EXP_NAME',		'Set listings (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_SET_LISTINGS_PRE_EXP_DESC',		'Input the amount of listings you want as an overwriting set before expiration' );
define( '_MI_MI_HOTPROPERTY_ADD_LISTINGS_PRE_EXP_NAME',		'Add listings (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_ADD_LISTINGS_PRE_EXP_DESC',		'Input the amount of listings you want to add before expiration' );

define( '_MI_MI_HOTPROPERTY_SET_UNLIMITED_NAME',		'Set unlimited' );
define( '_MI_MI_HOTPROPERTY_SET_UNLIMITED_DESC',		'Grant unlimited downloads on application' );
define( '_MI_MI_HOTPROPERTY_SET_UNLIMITED_EXP_NAME',		'Set unlimited (Expiration)' );
define( '_MI_MI_HOTPROPERTY_SET_UNLIMITED_EXP_DESC',		'Grant unlimited downloads on expiration' );
define( '_MI_MI_HOTPROPERTY_SET_UNLIMITED_PRE_EXP_NAME',		'Set unlimited (Pre Expiration)' );
define( '_MI_MI_HOTPROPERTY_SET_UNLIMITED_PRE_EXP_DESC',		'Grant unlimited downloads before expiration' );

define( '_MI_MI_HOTPROPERTY_ASSOC_COMPANY_NAME',	'Associate Company' );
define( '_MI_MI_HOTPROPERTY_ASSOC_COMPANY_DESC',	'Automatically associate the new user account with the new company account.' );
define( '_MI_MI_HOTPROPERTY_REBUILD_NAME',	'Rebuild' );
define( '_MI_MI_HOTPROPERTY_REBUILD_DESC',	'Attempt to rebuild the effect this MI has on the users who are in a plan that has this MI assigned.' );
define( '_MI_MI_HOTPROPERTY_REMOVE_NAME',	'Remove' );
define( '_MI_MI_HOTPROPERTY_REMOVE_DESC',	'Attempt to remove the effect this MI has on the users who are in a plan that has this MI assigned.' );

define( '_MI_MI_HOTPROPERTY_ADD_LIST_USERCHOICE_NAME',	'Listings Userchoice' );
define( '_MI_MI_HOTPROPERTY_ADD_LIST_USERCHOICE_DESC',	'Select whether you want the user to select the amount of listings' );
define( '_MI_MI_HOTPROPERTY_ADD_LIST_USERCHOICE_AMT_NAME',	'Userchoice' );
define( '_MI_MI_HOTPROPERTY_ADD_LIST_USERCHOICE_AMT_DESC',	'Semicolon-separated list of choices (eg "2;4;6"). You can insert custom text for the frontend like so: "2,only two listings;4,4 listings;6,six listings".' );
define( '_MI_MI_HOTPROPERTY_ADD_LIST_CUSTOMPRICE_NAME',	'Custom Price' );
define( '_MI_MI_HOTPROPERTY_ADD_LIST_CUSTOMPRICE_DESC',	'Modify the Membership price with coupons like this: "2,COUPONCODE2;4,COUPONCODE4;6,COUPONCODE6".' );

define( '_AEC_MI_HACK1_HOTPROPERTY',		'No Listings left' );
define( '_AEC_MI_HACK2_HOTPROPERTY',		'Registration and correct Subscription Required!' );
define( '_AEC_MI_HACK3_HOTPROPERTY',		'Prevent user from creating a new listing if he or she has run out of granted listings' );
define( '_AEC_MI_HACK4_HOTPROPERTY',		'Prevent user from saving a new listing if he or she has run out of granted listings. Also use a listing if the user has one left and it does not need to be approved - if it does, his listings count will be updated on the following hack.' );
define( '_AEC_MI_HACK5_HOTPROPERTY',		'Check for allowed listings and update the Used Listings counter when approving listings in the backend (see above for reference).' );
define( '_AEC_MI_DIV1_HOTPROPERTY',		'You can create <strong>%s</strong> more listings in our directory.' );

define( '_MI_MI_HOTPROPERTY_USERSELECT_ADDAMOUNT_NAME',		'Select Amount of Listings' );
define( '_MI_MI_HOTPROPERTY_USERSELECT_ADDAMOUNT_DESC',		'Select Amount of Listings' );

define( '_MI_MI_HOTPROPERTY_EASY_LIST_USERCHOICE_NAME',		'Easy Custom Price' );
define( '_MI_MI_HOTPROPERTY_EASY_LIST_USERCHOICE_DESC',		'Set a custom price in an easy fashion' );
define( '_MI_MI_HOTPROPERTY_EASY_LIST_USERCHOICE_N_NAME',		'Easy Custom Fields' );
define( '_MI_MI_HOTPROPERTY_EASY_LIST_USERCHOICE_N_DESC',		'The amount of conditional fields you want to put in' );

define( '_AEC_MI_HOTPROPERTY_EASYLIST_OP_NAME',		'Condition: Selection:' );
define( '_AEC_MI_HOTPROPERTY_EASYLIST_OP_DESC',		'Choose the conditional operator' );
define( '_AEC_MI_HOTPROPERTY_EASYLIST_NO_NAME',		'Condition: ...Number:' );
define( '_AEC_MI_HOTPROPERTY_EASYLIST_NO_DESC',		'The number you want to compare to' );
define( '_AEC_MI_HOTPROPERTY_EASYLIST_CH_NAME',		'Sets it to Price:' );
define( '_AEC_MI_HOTPROPERTY_EASYLIST_CH_DESC',		'Change the price to this' );

// Directory
define( '_AEC_MI_NAME_DIRECTORY', 'Directory' );
define( '_AEC_MI_DESC_DIRECTORY', 'Create Directories with this MI' );
define( '_MI_MI_DIRECTORY_MKDIR_NAME',		'Create Directory' );
define( '_MI_MI_DIRECTORY_MKDIR_DESC',		'Create a directory with this path' );
define( '_MI_MI_DIRECTORY_MKDIR_MODE_NAME',		'Directory Mode' );
define( '_MI_MI_DIRECTORY_MKDIR_MODE_DESC',		'The octal mode number (always 4 characters!) for access restriction. Default is 0644.' );
define( '_MI_MI_DIRECTORY_MKDIR_EXP_NAME',		'Create Directory (Exp)' );
define( '_MI_MI_DIRECTORY_MKDIR_EXP_DESC',		'Create a directory with this path on Expiration' );
define( '_MI_MI_DIRECTORY_MKDIR_MODE_EXP_NAME',		'Directory Mode' );
define( '_MI_MI_DIRECTORY_MKDIR_MODE_EXP_DESC',		'The octal mode number (always 4 characters!) for access restriction on Expiration. Default is 0644.' );
define( '_MI_MI_DIRECTORY_MKDIR_PRE_EXP_NAME',		'Create Directory (Pre Exp)' );
define( '_MI_MI_DIRECTORY_MKDIR_PRE_EXP_DESC',		'Create a directory with this path before Expiration' );
define( '_MI_MI_DIRECTORY_MKDIR_MODE_PRE_EXP_NAME',		'Directory Mode (Pre Exp)' );
define( '_MI_MI_DIRECTORY_MKDIR_MODE_PRE_EXP_DESC',		'The octal mode number (always 4 characters!) for access restriction before Expiration. Default is 0644.' );

// Gallery2
define( '_AEC_MI_NAME_G2', 'Gallery2' );
define( '_AEC_MI_DESC_G2', 'Manage Gallery2 users and their permissions' );
define( '_MI_MI_G2_SET_GROUPS_NAME',		'Set Gallerys' );
define( '_MI_MI_G2_SET_GROUPS_DESC',		'Global Setting - add the user to groups' );
define( '_MI_MI_G2_GROUPS_NAME',			'Gallerys' );
define( '_MI_MI_G2_GROUPS_DESC',			'Which groups should the user be added to?' );
define( '_MI_MI_G2_SET_GROUPS_USER_NAME',		'Set Gallerys (User Selection)' );
define( '_MI_MI_G2_SET_GROUPS_USER_DESC',		'Allow the user to select groups.' );
define( '_MI_MI_G2_GROUPS_SEL_AMT_NAME',		'Gallery Amount' );
define( '_MI_MI_G2_GROUPS_SEL_AMT_DESC',		'How many groups can the user select' );
define( '_MI_MI_G2_GROUPS_SEL_SCOPE_NAME',		'Gallery Scope' );
define( '_MI_MI_G2_GROUPS_SEL_SCOPE_DESC',		'From which groups can the user choose?' );
define( '_MI_MI_G2_DEL_GROUPS_EXP_NAME',		'Delete Gallerys (Expiration)' );
define( '_MI_MI_G2_DEL_GROUPS_EXP_DESC',		'Remove the user from the previously assigned groups on expiration' );
define( '_MI_MI_G2_USERSELECT_GROUP_NAME',		'Select Gallery' );
define( '_MI_MI_G2_USERSELECT_GROUP_DESC',		'Please select a Gallery' );

// RSgallery2
define( '_AEC_MI_RSGALLERY2_NAME', 'RSgallery2' );
define( '_AEC_MI_RSGALLERY2_DESC', 'Create User galleries and manage gallery publication status' );
define( '_MI_MI_RSGALLERY2_CREATE_GALLERIES_NAME',		'Create Galleries' );
define( '_MI_MI_RSGALLERY2_CREATE_GALLERIES_DESC',		'General switch for whether or not galleries will be created' );
define( '_MI_MI_RSGALLERY2_GALLERIES_NAME_NAME',		'Gallery Name' );
define( '_MI_MI_RSGALLERY2_GALLERIES_NAME_DESC',		'How will the new gallery/ies be named?' );
define( '_MI_MI_RSGALLERY2_GALLERIES_DESC_NAME',		'Gallery Description' );
define( '_MI_MI_RSGALLERY2_GALLERIES_DESC_DESC',		'Enter a description for the new gallery/ies' );
define( '_MI_MI_RSGALLERY2_SET_GALLERIES_NAME',			'Set Galleries' );
define( '_MI_MI_RSGALLERY2_SET_GALLERIES_DESC',			'Add the user to galleries' );
define( '_MI_MI_RSGALLERY2_GALLERIES_NAME',				'Galleries' );
define( '_MI_MI_RSGALLERY2_GALLERIES_DESC',				'In which galleries will the user get his/her own?' );
define( '_MI_MI_RSGALLERY2_SET_GALLERIES_USER_NAME',	'Set Galleries (User Selection)' );
define( '_MI_MI_RSGALLERY2_SET_GALLERIES_USER_DESC',	'Allow the user to select galleries in which a personal gallery will be granted.' );
define( '_MI_MI_RSGALLERY2_GALLERY_SEL_AMT_NAME',		'Gallery Amount' );
define( '_MI_MI_RSGALLERY2_GALLERY_SEL_AMT_DESC',		'How many galleries can the user select' );
define( '_MI_MI_RSGALLERY2_GALLERY_SEL_SCOPE_NAME',		'Gallery Scope' );
define( '_MI_MI_RSGALLERY2_GALLERY_SEL_SCOPE_DESC',		'From which galleries can the user choose?' );
define( '_MI_MI_RSGALLERY2_PUBLISH_ALL_NAME',			'Publish Galleries' );
define( '_MI_MI_RSGALLERY2_PUBLISH_ALL_DESC',			'Automatically publish the user-galleries on plan application (if they were previously unpublished)' );
define( '_MI_MI_RSGALLERY2_UNPUBLISH_ALL_NAME',			'Unpublish Galleries (Expiration)' );
define( '_MI_MI_RSGALLERY2_UNPUBLISH_ALL_DESC',			'Unpublish the user-galleries on expiration' );
define( '_MI_MI_RSGALLERY2_GALLERY_USERSELECT_NAME',	'Select Gallery' );
define( '_MI_MI_RSGALLERY2_GALLERY_USERSELECT_DESC',	'Please select a Gallery' );

// AEC Plan MI
define( '_AEC_MI_AECPLAN_NAME', 'AEC Plan Application' );
define( '_AEC_MI_AECPLAN_DESC', 'Apply a payment plan to a user' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_NAME',		'Apply Plan' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_DESC',		'Apply this payment plan (for free) when the MI is carried out' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_EXP_NAME',		'Apply Plan (Expiration)' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_EXP_DESC',		'Apply this payment plan (for free) when the MI is carried out on expiration' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_PRE_EXP_NAME',		'Apply Plan (Before Expiration)' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_PRE_EXP_DESC',		'Apply this payment plan (for free) when the MI is carried out before expiration' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_FIRST_NAME',		'Apply Plan (First Subscription)' );
define( '_MI_MI_AECPLAN_PLAN_APPLY_FIRST_DESC',		'Apply this payment plan (for free) when the MI is carried out. Only apply if it is the first membership of the user.' );
define( '_MI_MI_AECPLAN_FIRST_PLAN_NOT_MEMBERSHIP_NAME',		'First Plan of type' );
define( '_MI_MI_AECPLAN_FIRST_PLAN_NOT_MEMBERSHIP_DESC',		'If a plan is selected for the "First Subscription", this option will extend the scope - from only being applied on the first ever plan for a membership, to the first plan ever of the type that the MI is attached to.' );

// Raffle MI
define( '_AEC_MI_RAFFLE_NAME', 'Raffle' );
define( '_AEC_MI_RAFFLE_DESC', 'A very basic raffle setup' );
define( '_MI_MI_RAFFLE_LIST_GROUP_NAME',		'List Group' );
define( '_MI_MI_RAFFLE_LIST_GROUP_DESC',		'If you want to have separate drawing cycles, use a different group number here.' );
define( '_MI_MI_RAFFLE_DRAW_RANGE_NAME',		'Draw Range' );
define( '_MI_MI_RAFFLE_DRAW_RANGE_DESC',		'This sets the number of spots in one drawing cycle that have to be handed out before a winner is chosen by random.' );
define( '_MI_MI_RAFFLE_MAX_PARTICIPATIONS_NAME','Max Participations' );
define( '_MI_MI_RAFFLE_MAX_PARTICIPATIONS_DESC','Maximum amount of times a user can take part in a raffle.' );
define( '_MI_MI_RAFFLE_MAX_WINS_NAME',			'Max Wins' );
define( '_MI_MI_RAFFLE_MAX_WINS_DESC',			'Maximum amount of times a user can win a raffle before being excluded from further raffles.' );
define( '_MI_MI_RAFFLE_COL_RECIPIENT_NAME',		'Result Recipient Email' );
define( '_MI_MI_RAFFLE_COL_RECIPIENT_DESC',		'To whom should the results of the raffle be sent? (includes winner and participants with their username and email)' );

// SOBI
define( '_AEC_MI_SOBI_NAME',		'SOBI' );
define( '_AEC_MI_SOBI_DESC',		'Publish or unpublish listings in Joomla\'s Sigsiu Online Business Index component' );
define( '_MI_MI_SOBI_PUBLISH_ALL_NAME',			'Publish All: ' );
define( '_MI_MI_SOBI_PUBLISH_ALL_DESC',			'Choose yes to publish all SOBI listings for this user on activation of the MI' );
define( '_MI_MI_SOBI_PUBLISH_ALL_EXP_NAME',			'Publish All on Expiration: ' );
define( '_MI_MI_SOBI_PUBLISH_ALL_EXP_DESC',			'Choose yes to publish all SOBI listings for this user on activation of the MI' );
define( '_MI_MI_SOBI_PUBLISH_ALL_PRE_EXP_NAME',			'Publish All on Pre-Expiration:' );
define( '_MI_MI_SOBI_PUBLISH_ALL_PRE_EXP_DESC',			'Choose yes to publish all SOBI listings for this user when a pre-expiration action occurs for this MI' );

define( '_MI_MI_SOBI_UNPUBLISH_ALL_NAME',			'Unpublish All: ' );
define( '_MI_MI_SOBI_UNPUBLISH_ALL_DESC',			'Choose yes to unpublish all SOBI listings for this user on activation of the MI' );
define( '_MI_MI_SOBI_UNPUBLISH_ALL_EXP_NAME',			'Unpublish All on Expiration: ' );
define( '_MI_MI_SOBI_UNPUBLISH_ALL_EXP_DESC',			'Choose yes to unpublish all SOBI listings for this user on activation of the MI' );
define( '_MI_MI_SOBI_UNPUBLISH_ALL_PRE_EXP_NAME',			'Unpublish All on Pre-Expiration:' );
define( '_MI_MI_SOBI_UNPUBLISH_ALL_PRE_EXP_DESC',			'Choose yes to unpublish all SOBI listings for this user when a pre-expiration action occurs for this MI' );

define( '_MI_MI_SOBI_REBUILD_NAME',			'Rebuild: ' );
define( '_MI_MI_SOBI_REBUILD_DESC',			'Choose yes and then save the MI to recreate the actions fo all users with this MI on a currently active plan.' );
define( '_MI_MI_SOBI_REMOVE_NAME',			'Remove: ' );
define( '_MI_MI_SOBI_REMOVE_DESC',			'Choose yes and then save the MI to carry out the expiration action for all users with this MI on a currently active plan.' );

// phpbb3
define( '_AEC_MI_NAME_PHPBB3','PHPBB3 Integration' );
define( '_AEC_MI_DESC_PHPBB3','will set the users group in phpbb on subscription/expiration' );
define( '_MI_MI_PHPBB3_SET_GROUP_NAME','Set Group' );
define( '_MI_MI_PHPBB3_SET_GROUP_DESC','Choose Yes if you wish a phpBB3 group to be applied when the plan is applied' );
define( '_MI_MI_PHPBB3_GROUP_NAME','Group' );
define( '_MI_MI_PHPBB3_GROUP_DESC','The group you wish applied - if you chose yes.' );
define( '_MI_MI_PHPBB3_SET_GROUP_EXP_NAME','Set Group (Expiration)' );
define( '_MI_MI_PHPBB3_SET_GROUP_EXP_DESC','Choose Yes if you wish the phpBB3 group to be changed when the plan expires' );
define( '_MI_MI_PHPBB3_GROUP_EXP_NAME','Group (Expiration)' );
define( '_MI_MI_PHPBB3_GROUP_EXP_DESC','The group you wish to use if the plan expires.' );
define( '_MI_MI_PHPBB3_SET_GROUPS_EXCLUDE_NAME',	'Exclude Groups?' );
define( '_MI_MI_PHPBB3_SET_GROUPS_EXCLUDE_DESC',	'If set to Yes, all groups that a user belongs to will be checked for exclusion (primary and secondary groups).  Set to No and only primary groups will be checked against the exclude list' );
define( '_MI_MI_PHPBB3_SET_CLEAR_GROUPS_NAME',		'Clear Groups' );
define( '_MI_MI_PHPBB3_SET_CLEAR_GROUPS_DESC',		'If set to Yes, all secondary groups will be cleared from the user record as expiration group is applied as primary.  NOTE: You must have expiration groups set for this to function and exclusions will be checked BEFORE this function is executed' );
define( '_MI_MI_PHPBB3_GROUPS_EXCLUDE_NAME',		'Exclude Exclude' );
define( '_MI_MI_PHPBB3_GROUPS_EXCLUDE_DESC',		'Select all groups that will NOT be changed upon apply or expire (whether this is checked against primary or all user\'s groups will depend upon settings below' );
define( '_MI_MI_PHPBB3_REBUILD_NAME',				'Rebuild: ' );
define( '_MI_MI_PHPBB3_REBUILD_DESC',				'Choose yes and then save the MI to recreate the actions fo all users with this MI on a currently active plan.' );
define( '_MI_MI_PHPBB3_REMOVE_NAME',				'Remove: ' );
define( '_MI_MI_PHPBB3_REMOVE_DESC',				'Choose yes and then save the MI to carry out the expiration action for all users with this MI on a currently active plan.' );

define( '_MI_MI_PHPBB3_APPLY_COLOUR_NAME','Apply Group Color' );
define( '_MI_MI_PHPBB3_APPLY_COLOUR_DESC','Choose yes to apply a group color (only check if possible).' );
define( '_MI_MI_PHPBB3_GROUP_COLOUR_NAME','Group Color' );
define( '_MI_MI_PHPBB3_GROUP_COLOUR_DESC','The group color you wish applied - if you chose yes.' );
define( '_MI_MI_PHPBB3_APPLY_COLOUR_EXP_NAME','Apply Group Color (Expiration)' );
define( '_MI_MI_PHPBB3_APPLY_COLOUR_EXP_DESC','Choose yes to apply a group color on expiration (only check if possible).' );
define( '_MI_MI_PHPBB3_GROUP_COLOUR_EXP_NAME','Group Color (Expiration)' );
define( '_MI_MI_PHPBB3_GROUP_COLOUR_EXP_DESC','The group color you wish applied on expiration- if you chose yes.' );

define( '_MI_MI_PHPBB3_USE_ALTDB_NAME','Different Database' );
define( '_MI_MI_PHPBB3_USE_ALTDB_DESC','If your phpbb3 forum uses a different database than joomla, you can set this option to Yes and provide details below.' );
define( '_MI_MI_PHPBB3_DBMS_NAME','Database Type' );
define( '_MI_MI_PHPBB3_DBMS_DESC','Typically mysql or mysqli' );
define( '_MI_MI_PHPBB3_DBHOST_NAME','Database Host' );
define( '_MI_MI_PHPBB3_DBHOST_DESC','Typically localhost - or the IP an external DB' );
define( '_MI_MI_PHPBB3_DBUSER_NAME','Database Username' );
define( '_MI_MI_PHPBB3_DBUSER_DESC','Your Database Access Username' );
define( '_MI_MI_PHPBB3_DBPASSWD_NAME','Database Password' );
define( '_MI_MI_PHPBB3_DBPASSWD_DESC','Your Database Access Password' );
define( '_MI_MI_PHPBB3_DBNAME_NAME','Database Name' );
define( '_MI_MI_PHPBB3_DBNAME_DESC','The Name of the database' );
define( '_MI_MI_PHPBB3_TABLE_PREFIX_NAME','Table Prefix' );
define( '_MI_MI_PHPBB3_TABLE_PREFIX_DESC','Typically phpbb_ or phpbb3_' );

// uddeim
define( '_AEC_MI_NAME_UDDEIM',		'UddeIM' );
define( '_AEC_MI_DESC_UDDEIM',		'Choose the amount of PMs a user can send.' );
define( '_MI_MI_UDDEIM_SET_MESSAGES_NAME',			'Set Messages' );
define( '_MI_MI_UDDEIM_SET_MESSAGES_DESC',			'SET this amount of download,essages granted to the user - OVERRIDES THE >>ADD<< Setting! (does NOT reset the amount of messages a user has already used!)' );
define( '_MI_MI_UDDEIM_ADD_MESSAGES_NAME',			'Add Messages' );
define( '_MI_MI_UDDEIM_ADD_MESSAGES_DESC',			'Add this amount of messages to the total granted amount of messages for this user. Will be overridden by SET if you put a value for that as well!.' );
define( '_MI_MI_UDDEIM_SET_UNLIMITED_NAME',			'Set Unlimited' );
define( '_MI_MI_UDDEIM_SET_UNLIMITED_DESC',			'Grant the user unlimited messages.' );
define( '_MI_MI_UDDEIM_UNSET_UNLIMITED_NAME',			'Unset Unlimited on Expiration: ' );
define( '_MI_MI_UDDEIM_UNSET_UNLIMITED_DESC',			'Remove unlimited downloads when user expires.' );
define( '_MI_MI_UDDEIM_REMOVE_NAME', 				'Remove: ' );
define( '_MI_MI_UDDEIM_REMOVE_DESC',			'Carry out the expiration action for all users with an active plan attached to this micro-integration' );
define( '_MI_MI_UDDEIM_MSG_NAME',			'Send Message' );
define( '_MI_MI_UDDEIM_MSG_DESC',			'Trigger sending a message' );
define( '_MI_MI_UDDEIM_MSG_TEXT_NAME',			'Message' );
define( '_MI_MI_UDDEIM_MSG_TEXT_DESC',			'Text of your message' );
define( '_MI_MI_UDDEIM_MSG_SENDER_NAME',			'Sender ID' );
define( '_MI_MI_UDDEIM_MSG_SENDER_DESC',			'Userid of the user sending the message' );
define( '_MI_MI_UDDEIM_MSG_RECIPIENT_NAME',			'Recipient ID' );
define( '_MI_MI_UDDEIM_MSG_RECIPIENT_DESC',			'Userid of message recipient' );
define( '_MI_MI_UDDEIM_MSG_EXP_NAME',			'Send Message (Expiration)' );
define( '_MI_MI_UDDEIM_MSG_EXP_DESC',			'Trigger sending a message on expiration' );
define( '_MI_MI_UDDEIM_MSG_EXP_TEXT_NAME',			'Message (Expiration)' );
define( '_MI_MI_UDDEIM_MSG_EXP_TEXT_DESC',			'Text of your message on expiration' );
define( '_MI_MI_UDDEIM_MSG_EXP_SENDER_NAME',			'Sender ID (Expiration)' );
define( '_MI_MI_UDDEIM_MSG_EXP_SENDER_DESC',			'Userid of the user sending the message on expiration' );
define( '_MI_MI_UDDEIM_MSG_EXP_RECIPIENT_NAME',			'Recipient ID (Expiration)' );
define( '_MI_MI_UDDEIM_MSG_EXP_RECIPIENT_DESC',			'Userid of message recipient on expiration' );
define( '_AEC_MI_HACK1_UDDEIM',						'Create a message restriction for the UddeIM component, to be used with Micro Integrations. <b>Note:</b> This is an optional hack which adds the ability to restrict number of message sent by the user.  It should ONLY be applied if this is desired.' );
define( '_AEC_MI_HACK2_UDDEIM',						'Create a message restriction for the UddeIM CB Plugin, to be used with Micro Integrations. <b>Note:</b> This is an optional hack which adds the ability to restrict number of message sent by the user.  It should ONLY be applied if this is desired.' );
define( '_AEC_MI_UDDEIM_NOCREDIT',					'We are terribly sorry: You have no messages left.' );
define( '_AEC_MI_DIV1_UDDEIM_USED',		'You have used <strong>%s</strong> messages.' );
define( '_AEC_MI_DIV1_UDDEIM_REMAINING',	'You have <strong>%s</strong> messages remaining.' );
define( '_AEC_MI_DIV1_UDDEIM_UNLIMITED', 	'unlimited' );

// PROMA
define( '_AEC_MI_NAME_PROMA', 'PROMA' );
define( '_AEC_MI_DESC_PROMA', 'Manage PROMA Profile Manager access groups' );
define( '_MI_MI_PROMA_SET_GROUP_NAME',		'Set PROMA Group' );
define( '_MI_MI_PROMA_SET_GROUP_DESC',		'Choose Yes if you want this MI to set the PROMA Group when it is called.' );
define( '_MI_MI_PROMA_SET_DEFAULT_NAME',		'Set Default' );
define( '_MI_MI_PROMA_SET_DEFAULT_DESC',		'Disregard the group setting below and apply the default group.' );
define( '_MI_MI_PROMA_GROUP_NAME',			'PROMA Group' );
define( '_MI_MI_PROMA_GROUP_DESC',			'The PROMA group that you want the user to be in.' );
define( '_MI_MI_PROMA_SET_GROUP_EXP_NAME',	'Expiration group' );
define( '_MI_MI_PROMA_SET_GROUP_EXP_DESC',	'The PROMA group that you want the user to be in when the subscription runs out.' );
define( '_MI_MI_PROMA_SET_DEFAULT_EXP_NAME',	'Set Default (exp)' );
define( '_MI_MI_PROMA_SET_DEFAULT_EXP_DESC',	'Disregard the group setting below and apply the default group.' );
define( '_MI_MI_PROMA_GROUP_EXP_NAME',		'Set PROMA Group expiration' );
define( '_MI_MI_PROMA_GROUP_EXP_DESC',		'Choose Yes if you want this MI to set the PROMA Group when the calling payment plan expires.' );
define( '_MI_MI_PROMA_REBUILD_NAME',			'Rebuild' );
define( '_MI_MI_PROMA_REBUILD_DESC',			'Attempt to rebuild the list of users assigned to the usergroup - >Set PROMA Group< and >PROMA Group< have to both be set for this.' );
define( '_MI_MI_PROMA_REMOVE_NAME',			'Remove' );
define( '_MI_MI_PROMA_REMOVE_DESC',			'Attempt to remove the effect of this MI to the users who hold a plan it has been assigned to.' );

// email files
define( '_AEC_MI_NAME_EMAIL_FILES',		'Email Files' );
define( '_AEC_MI_DESC_EMAIL_FILES',		'Send an Email with attached files to one or more addresses on application of the subscription' );
define( '_MI_MI_EMAIL_FILES_SENDER_NAME',		'Sender E-Mail' );
define( '_MI_MI_EMAIL_FILES_SENDER_DESC',		'Sender E-Mail Address' );
define( '_MI_MI_EMAIL_FILES_SENDER_NAME_NAME',	'Sender Name' );
define( '_MI_MI_EMAIL_FILES_SENDER_NAME_DESC',	'The displayed name of the Sender' );
define( '_MI_MI_EMAIL_FILES_RECIPIENT_NAME',	'Recipient(s)' );
define( '_MI_MI_EMAIL_FILES_RECIPIENT_DESC',	'Who is to receive this E-Mail? Separate with comma. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_FILES_SUBJECT_NAME',		'Subject' );
define( '_MI_MI_EMAIL_FILES_SUBJECT_DESC',		'Subject of this email (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_EMAIL_FILES_TEXT_HTML_NAME',	'HTML Encoding' );
define( '_MI_MI_EMAIL_FILES_TEXT_HTML_DESC',	'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_MI_MI_EMAIL_FILES_TEXT_NAME',			'Text' );
define( '_MI_MI_EMAIL_FILES_TEXT_DESC',			'Text to be sent when the plan is purchased. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_FILES_BASE_PATH_NAME',	'Base Path' );
define( '_MI_MI_EMAIL_FILES_BASE_PATH_DESC',	'Base Path of the files you want to attach.' );
define( '_MI_MI_EMAIL_FILES_FILE_LIST_NAME',	'File List' );
define( '_MI_MI_EMAIL_FILES_FILE_LIST_DESC',	'List of your files - separate by new lines.' );
define( '_MI_MI_EMAIL_FILES_DESC_LIST_NAME',	'Description List' );
define( '_MI_MI_EMAIL_FILES_DESC_LIST_DESC',	'List of your files that the user will see on frontend - separate by new lines. Leave empty to not show a user selection' );
define( '_MI_MI_EMAIL_FILES_MAX_CHOICES_NAME',	'Max Choices' );
define( '_MI_MI_EMAIL_FILES_MAX_CHOICES_DESC',	'How many items may the user select?' );
define( '_MI_MI_EMAIL_FILES_MIN_CHOICES_NAME',	'Min Choices' );
define( '_MI_MI_EMAIL_FILES_MIN_CHOICES_DESC',	'How many items must the user select?' );
define( '_MI_MI_USER_CHOICE_FILES_NAME',	'Please select' );
define( '_MI_MI_USER_CHOICE_FILES_DESC',	'Download Delivery Option' );

// AEC Donate MI
define( '_AEC_MI_AECDONATE_NAME', 'AEC Donate' );
define( '_AEC_MI_AECDONATE_DESC', 'Let the user pay whatever he likes (with minimum and maximum) for a plan' );
define( '_MI_MI_AECDONATE_MIN_NAME',		'Min' );
define( '_MI_MI_AECDONATE_MIN_DESC',		'The minimum amount you want the user to pay' );
define( '_MI_MI_AECDONATE_REC_NAME',		'Recommended' );
define( '_MI_MI_AECDONATE_REC_DESC',		'The recommended Donation amount, automatically filled in the form' );
define( '_MI_MI_AECDONATE_MAX_NAME',		'Max' );
define( '_MI_MI_AECDONATE_MAX_DESC',		'The maximum amount you want the user to pay' );
define( '_MI_MI_AECDONATE_USERSELECT_AMT_NAME',		'Amount you want to pay' );
define( '_MI_MI_AECDONATE_USERSELECT_AMT_DESC',		'Your amount for this payment plan' );

// Age Restriction MI
define( '_AEC_MI_AGE_RESTRICTION_NAME', 'Age Restriction' );
define( '_AEC_MI_AGE_RESTRICTION_DESC', 'Require the user to submit a birthdate and allow checking out a plan based on that.' );
define( '_MI_MI_AGE_RESTRICTION_MIN_AGE_NAME',		'Min Age' );
define( '_MI_MI_AGE_RESTRICTION_MIN_AGE_DESC',		'The minimum age a user must have to get the plan this MI is attached to. Leave empty for no limit.' );
define( '_MI_MI_AGE_RESTRICTION_MAX_AGE_NAME',		'Max Age' );
define( '_MI_MI_AGE_RESTRICTION_MAX_AGE_DESC',		'The maximum age a user can have to get the plan this MI is attached to. Leave empty for no limit.' );
define( '_MI_MI_AGE_RESTRICTION_RESTRICT_CALENDAR_NAME',		'Restrict Calendar' );
define( '_MI_MI_AGE_RESTRICTION_RESTRICT_CALENDAR_DESC',		'Restrict the dates a user can select in the calendar to the age range (if provided).' );
define( '_MI_MI_AGE_RESTRICTION_USERSELECT_BIRTHDAY_NAME',		'Birthday' );
define( '_MI_MI_AGE_RESTRICTION_USERSELECT_BIRTHDAY_DESC',		'Your birthday' );

define( '_AEC_MI_NAME_AECMODIFYEXPIRATION', 'Modify Expiration Date');
define( '_AEC_MI_DESC_AECMODIFYEXPIRATION', 'Dynamically resets the Expiration Date of the subscription it is applied to');
define( '_MI_MI_AECMODIFYEXPIRATION_TIME_MOD_NAME', 'Time Modification' );
define( '_MI_MI_AECMODIFYEXPIRATION_TIME_MOD_DESC', 'Plain English modification (according to PHP manual on the strtotime() function, e.g. "+1 week 2 days 4 hours 2 seconds", "10 September 2000" or "last Monday")');
define( '_MI_MI_AECMODIFYEXPIRATION_TIMESTAMP_NAME', 'Base Timestamp' );
define( '_MI_MI_AECMODIFYEXPIRATION_TIMESTAMP_DESC', 'The point in time from which the modification is made. Defaults to the current time, but you can use the rewrite engine to, for instance, use the original expiration date.');

// Multi Emails
define( '_AEC_MI_NAME_EMAIL_MULTI',		'Multiple Emails' );
define( '_AEC_MI_DESC_EMAIL_MULTI',		'Send multiple Emails at once on application of the subscription' );
define( '_MI_MI_EMAIL_MULTI_SENDER_NAME',		'Sender E-Mail' );
define( '_MI_MI_EMAIL_MULTI_SENDER_DESC',		'Sender E-Mail Address' );
define( '_MI_MI_EMAIL_MULTI_SENDER_NAME_NAME',	'Sender Name' );
define( '_MI_MI_EMAIL_MULTI_SENDER_NAME_DESC',	'The displayed name of the Sender' );
define( '_MI_MI_EMAIL_MULTI_EMAILS_COUNT_NAME',		'Email Count' );
define( '_MI_MI_EMAIL_MULTI_EMAILS_COUNT_DESC',		'How many emails do you want to send out? After saving, there will be further settings for each email individually.' );

define( '_MI_MI_EMAIL_MULTI_TIMING_NAME',		'#%s: Timing' );
define( '_MI_MI_EMAIL_MULTI_TIMING_DESC',		'At what point in time do you want this email to be sent out? Consult PHP Manual on strtotime for details on what values are possible. Use negative values to have the counter go back starting from the expiration date.' );
define( '_MI_MI_EMAIL_MULTI_RECIPIENT_NAME',	'#%s: Recipient(s)' );
define( '_MI_MI_EMAIL_MULTI_RECIPIENT_DESC',	'Who is to receive this E-Mail? Separate with comma. The rewriting routines explained below will work for this field.' );
define( '_MI_MI_EMAIL_MULTI_SUBJECT_NAME',		'#%s: Subject' );
define( '_MI_MI_EMAIL_MULTI_SUBJECT_DESC',		'Subject of this email (Uses RewriteEngine explained below as well)' );
define( '_MI_MI_EMAIL_MULTI_TEXT_HTML_NAME',	'#%s: HTML Encoding' );
define( '_MI_MI_EMAIL_MULTI_TEXT_HTML_DESC',	'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_MI_MI_EMAIL_MULTI_TEXT_NAME',			'#%s: Text' );
define( '_MI_MI_EMAIL_MULTI_TEXT_DESC',			'Text to be sent when the plan is purchased. The rewriting routines explained below will work for this field.' );

// Custom User Details
define( '_AEC_MI_NAME_AECUSERDETAILS',		'Custom User Details' );
define( '_AEC_MI_DESC_AECUSERDETAILS',		'Request additional user details on Confirmation' );
define( '_MI_MI_AECUSERDETAILS_SETTINGS_NAME',		'Settings' );
define( '_MI_MI_AECUSERDETAILS_SETTINGS_DESC',		'How many details do you want the user to set?' );

define( '_MI_MI_AECUSERDETAILS_SET_SHORT_NAME',		'#%s: Short Name' );
define( '_MI_MI_AECUSERDETAILS_SET_SHORT_DESC',		'A technical/internal handle for the setting. i.e.: "telephone_number" or "pool_size" - no spaces or funny characters' );
define( '_MI_MI_AECUSERDETAILS_SET_NAME_NAME',	'#%s: Name' );
define( '_MI_MI_AECUSERDETAILS_SET_NAME_DESC',	'What the user will see to know what to put into the field.' );
define( '_MI_MI_AECUSERDETAILS_SET_MANDATORY_NAME',	'#%s: Mandatory?' );
define( '_MI_MI_AECUSERDETAILS_SET_MANDATORY_DESC',	'Whether the user HAS to have this field filled out, of set to no, the field is optional.' );
define( '_MI_MI_AECUSERDETAILS_SET_DESC_NAME',		'#%s: Description' );
define( '_MI_MI_AECUSERDETAILS_SET_DESC_DESC',		'Description of the setting' );
define( '_MI_MI_AECUSERDETAILS_SET_TYPE_NAME',	'#%s: Type' );
define( '_MI_MI_AECUSERDETAILS_SET_TYPE_DESC',	'Type of Input' );
define( '_MI_MI_AECUSERDETAILS_SET_DEFAULT_NAME',			'#%s: Default' );
define( '_MI_MI_AECUSERDETAILS_SET_DEFAULT_DESC',			'An automatically provided value - may be left blank.' );

// Google Adsense Conversion
define( '_AEC_MI_NAME_GOOGLEADSENSECONVERSION',		'Google Adsense Conversion' );
define( '_AEC_MI_DESC_GOOGLEADSENSECONVERSION',		'With this, you can attach Google Adsense Conversion tracking code to the DisplayPipeline.' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_CONVERSION_ID_NAME',		'Conversion ID' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_CONVERSION_ID_DESC',		'The Conversion ID you want to use' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_LANGUAGE_NAME',		'Language' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_LANGUAGE_DESC',		'The language you want to use' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_FORMAT_NAME',		'Format' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_FORMAT_DESC',		'The format you want to use' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_COLOR_NAME',		'Color' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_COLOR_DESC',		'The color you want to use' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_LABEL_NAME',		'Label' );
define( '_MI_MI_GOOGLEADSENSECONVERSION_LABEL_DESC',		'The label you want to use' );

// Share A Sale
define( '_AEC_MI_NAME_SHAREASALE',		'Share A Sale' );
define( '_AEC_MI_DESC_SHAREASALE',		'Connect your sales to Share A Sale' );
define( '_MI_MI_SHAREASALE_MERCHANTID_NAME',		'Merchant ID' );
define( '_MI_MI_SHAREASALE_MERCHANTID_DESC',		'Your Share A Sale Merchant ID' );
define( '_MI_MI_SHAREASALE_ONLYCUSTOMPARAMS_NAME',		'Only Custom Parameters' );
define( '_MI_MI_SHAREASALE_ONLYCUSTOMPARAMS_DESC',		'Only transmit the custom parameters as specified below (instead of transmitting the regular - invoice number and amount - and the profile id if set).' );
define( '_MI_MI_SHAREASALE_CUSTOMPARAMS_NAME',		'Custom Parameters' );
define( '_MI_MI_SHAREASALE_CUSTOMPARAMS_DESC',		'If you want to transmit custom parameters instead of or additional to the regular parameters, please put them in here. Separated by linebreaks in the form of "parameter_name=parameter_value". The RewriteEngine works as specified below.' );

// Joomla Plugin
define( '_AEC_MI_NAME_JOOMLAPLUGIN',		'Joomla Plugin' );
define( '_AEC_MI_DESC_JOOMLAPLUGIN',		'Call a Joomla Plugin (only Authentication for now)' );
define( '_MI_MI_JOOMLAPLUGIN_PLUGIN_NAME',			'Plugin' );
define( '_MI_MI_JOOMLAPLUGIN_PLUGIN_DESC',			'Select the plugin to be called' );

// K2
define( '_AEC_MI_NAME_K2',		'K2' );
define( '_AEC_MI_DESC_K2',		'Assign users to K2 usergroups' );
define( '_MI_MI_K2_SET_GROUP_NAME',				'Set K2 Group' );
define( '_MI_MI_K2_SET_GROUP_DESC',				'Choose Yes if you want this MI to set the K2 Group when it is called.' );
define( '_MI_MI_K2_GROUP_NAME',					'K2 Group' );
define( '_MI_MI_K2_GROUP_DESC',					'The K2 group that you want the user to be in.' );
define( '_MI_MI_K2_GROUP_EXP_NAME',				'K2 Group (expiration)' );
define( '_MI_MI_K2_GROUP_EXP_DESC',				'Choose Yes if you want this MI to set the K2 Group when the calling payment plan expires.' );
define( '_MI_MI_K2_SET_GROUP_EXP_NAME',			'Expiration group' );
define( '_MI_MI_K2_SET_GROUP_EXP_DESC',			'The K2 group that you want the user to be in when the subscription runs out.' );
define( '_MI_MI_K2_REBUILD_NAME',				'Rebuild' );
define( '_MI_MI_K2_REBUILD_DESC',				'Attempt to rebuild the list of users assigned to the usergroup - >Set K2 Group< and >K2 Group< have to both be set for this.' );
define( '_AEC_MI_HACK1_K2',						'Build in a downloads restriction for K2, to be used with Micro Integrations. <b>Note:</b> This is an optional hack which adds the ability to restrict number of file downloads.  It should ONLY be applied if this is desired.' );
define( '_MI_MI_K2_REMOVE_NAME', 				'Remove: ' );
define( '_MI_MI_K2_REMOVE_DESC',			'Carry out the expiration action for all users with an active plan attached to this micro-integration' );

// Quotestream
define( '_AEC_MI_NAME_QUOTESTREAM',		'Quotestream' );
define( '_AEC_MI_DESC_QUOTESTREAM',		'Authenticate Users with Quotestream' );
define( '_MI_MI_QUOTESTREAM_LOGIN_NAME',			'Quotestream Login' );
define( '_MI_MI_QUOTESTREAM_LOGIN_DESC',			'Your Login with Quotestream' );
define( '_MI_MI_QUOTESTREAM_PASSWORD_NAME',			'Quotestream Password' );
define( '_MI_MI_QUOTESTREAM_PASSWORD_DESC',			'Your Password with Quotestream' );
define( '_MI_MI_QUOTESTREAM_PRODUCTS_NAME',			'Products' );
define( '_MI_MI_QUOTESTREAM_PRODUCTS_DESC',			'List of Products to assign the user to, should normally load a list from Quotestream, otherwise provide a comma-separated list on your own' );
define( '_MI_MI_QUOTESTREAM_PROID_NAME',			'ProId' );
define( '_MI_MI_QUOTESTREAM_PROID_DESC',			'The ProId if specified by Quotestream (leave blank if you do not know what this is)' );
define( '_MI_MI_QUOTESTREAM_CLIENTGROUPID_NAME',	'Client Group Id' );
define( '_MI_MI_QUOTESTREAM_CLIENTGROUPID_DESC',	'The ClientGroupId that will be transferred on authentication (leave blank if this does not apply)' );

// Amigos
define( '_AEC_MI_NAME_AMIGOS',		'Amigos' );
define( '_AEC_MI_DESC_AMIGOS',		'Amigos is an Affiliate Tracking Extension for Joomla from Dioscouri.com' );
define( '_MI_MI_AMIGOS_AMIGOS_DOMAIN_NAME',			'Domain' );
define( '_MI_MI_AMIGOS_AMIGOS_DOMAIN_DESC',			'The Domain (and subfolder, if applicable) where Amigos is Installed. Include http:// but not the trailing /.  Example: http://www.dioscouri.com/affiliates' );
define( '_MI_MI_AMIGOS_AMIGOS_CURL_NAME',			'Use Curl?' );
define( '_MI_MI_AMIGOS_AMIGOS_CURL_DESC',			'Use Curl instead of javascript tracking in the AEC module (must be published if you decide to NOT use curl)' );

// Invoice Print Mod
define( '_AEC_MI_NAME_AECINVOICEPRINTMOD',		'Customize Invoice Printout' );
define( '_AEC_MI_DESC_AECINVOICEPRINTMOD',		'Change the Information that is displayed when printing the invoice for a plan that has this MI attached' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_HEADER_MODE_NAME',		'Text Mode (Before Header)' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_HEADER_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_HEADER_NAME',		'Before Header' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_HEADER_DESC',		'Modify the text that is displayed before the header' );
define( '_MI_MI_AECINVOICEPRINTMOD_HEADER_MODE_NAME',		'Text Mode (Header)' );
define( '_MI_MI_AECINVOICEPRINTMOD_HEADER_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_HEADER_NAME',		'Header' );
define( '_MI_MI_AECINVOICEPRINTMOD_HEADER_DESC',		'Modify the text that is displayed as the header' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_HEADER_MODE_NAME',		'Text Mode (After Header)' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_HEADER_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_HEADER_NAME',		'After Header' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_HEADER_DESC',		'Modify the text that is displayed after the header' );

define( '_MI_MI_AECINVOICEPRINTMOD_ADDRESS_MODE_NAME',		'Text Mode (Address)' );
define( '_MI_MI_AECINVOICEPRINTMOD_ADDRESS_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_ADDRESS_NAME',		'Address' );
define( '_MI_MI_AECINVOICEPRINTMOD_ADDRESS_DESC',		'Modify the text that is displayed in the address field' );

define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_CONTENT_MODE_NAME',		'Text Mode (Before Content)' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_CONTENT_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_CONTENT_NAME',		'Before Content' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_CONTENT_DESC',		'Modify the text that is displayed before the content' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_CONTENT_MODE_NAME',		'Text Mode (After Content)' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_CONTENT_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_CONTENT_NAME',		'After Content' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_CONTENT_DESC',		'Modify the text that is displayed after the content' );

define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_FOOTER_MODE_NAME',		'Text Mode (Before Footer)' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_FOOTER_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_FOOTER_NAME',		'Before Footer' );
define( '_MI_MI_AECINVOICEPRINTMOD_BEFORE_FOOTER_DESC',		'Modify the text that is displayed before the footer' );
define( '_MI_MI_AECINVOICEPRINTMOD_FOOTER_MODE_NAME',		'Text Mode (Footer)' );
define( '_MI_MI_AECINVOICEPRINTMOD_FOOTER_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_FOOTER_NAME',		'Footer' );
define( '_MI_MI_AECINVOICEPRINTMOD_FOOTER_DESC',		'Modify the text that is displayed as the footer' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_FOOTER_MODE_NAME',		'Text Mode (After Footer)' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_FOOTER_MODE_DESC',		'Define what to do with the original text' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_FOOTER_NAME',		'After Footer' );
define( '_MI_MI_AECINVOICEPRINTMOD_AFTER_FOOTER_DESC',		'Modify the text that is displayed after the footer' );

define( 'AEC_TEXTMODE_NONE',		'None - Leave the original text as it was' );
define( 'AEC_TEXTMODE_BEFORE',		'Before - Place the text in the editor before the original text' );
define( 'AEC_TEXTMODE_AFTER',		'After - Place the text in the editor after the original text' );
define( 'AEC_TEXTMODE_REPLACE',		'Replace - Replace the original text with the text in the editor' );
define( 'AEC_TEXTMODE_DELETE',		'Delete - Delete the original text' );

// RStickets
define( '_AEC_MI_NAME_RSTICKETS',		'RStickets' );
define( '_AEC_MI_DESC_RSTICKETS',		'Change the Information that is displayed when printing the invoice for a plan that has this MI attached' );
define( '_MI_MI_RSTICKETS_USERID_NAME',		'Userid' );
define( '_MI_MI_RSTICKETS_USERID_DESC',		'The Userid - use the RWengine for dynamic userid.' );
define( '_MI_MI_RSTICKETS_EMAIL_NAME',		'Email' );
define( '_MI_MI_RSTICKETS_EMAIL_DESC',		'The Email - use the RWengine for dynamic email address.' );
define( '_MI_MI_RSTICKETS_DEPARTMENT_NAME',		'Department' );
define( '_MI_MI_RSTICKETS_DEPARTMENT_DESC',		'The Department that the ticket will be assigned to.' );
define( '_MI_MI_RSTICKETS_SUBJECT_NAME',		'Subject' );
define( '_MI_MI_RSTICKETS_SUBJECT_DESC',		'The Ticket Subject line.' );
define( '_MI_MI_RSTICKETS_TEXT_NAME',		'Text' );
define( '_MI_MI_RSTICKETS_TEXT_DESC',		'The Ticket Text.' );
define( '_MI_MI_RSTICKETS_PRIORITY_NAME',		'Priority' );
define( '_MI_MI_RSTICKETS_PRIORITY_DESC',		'The Ticket Priority.' );

// JomSocial
define( '_AEC_MI_NAME_JOMSOCIAL',				'JomSocial' );
define( '_AEC_MI_DESC_JOMSOCIAL',				'Actions that affect the JomSocial user account' );
define( '_MI_MI_JOMSOCIAL_OVERWRITE_EXISTING_NAME',		'Overwrite Existing' );
define( '_MI_MI_JOMSOCIAL_OVERWRITE_EXISTING_DESC',		'Should AEC overwrite existing entries for fields (Set to Yes)? Or just fill in blanks (Set to No)?' );
define( '_MI_MI_JOMSOCIAL_SET_FIELDS_NAME',		'Set Fields' );
define( '_MI_MI_JOMSOCIAL_SET_FIELDS_DESC',		'Automatically set the fields (which are not marked with "(expiration)" when the plan is paid for.' );
define( '_MI_MI_JOMSOCIAL_SET_FIELDS_EXP_NAME',	'Set Fields Expiration' );
define( '_MI_MI_JOMSOCIAL_SET_FIELDS_EXP_DESC',	'Automatically set the fields (which are marked with "(expiration)" when the plan is paid for.' );
define( '_MI_MI_JOMSOCIAL_EXPMARKER',			'(expiration)' );

// Tax Helper
define( '_AEC_MI_NAME_AECTAX',		'Tax Helper' );
define( '_AEC_MI_DESC_AECTAX',		'Specify tax for this item - affects Confirmation&amp;Checkout screen, Item cost and Invoice printout' );
define( '_MI_MI_AECTAX_LOCATIONS_NAME',		'Locations' );
define( '_MI_MI_AECTAX_LOCATIONS_DESC',		'Enter a list of Tax Options. It should look like this:<br /><br />1|European Union|19|19% VAT<br />2|Rest of the World|0<br /><br />The syntax is ID|Display Name|Tax Percentage|Tax Description - always separate by newlines!' );
define( '_MI_MI_AECTAX_CUSTOMINFO_NAME',		'Custom Info' );
define( '_MI_MI_AECTAX_CUSTOMINFO_DESC',		'AEC normally displays the text "Please select your location:" on confirmation above the location selector. If you want it to say something else, enter your text here.' );
define( '_MI_MI_AECTAX_DEFAULT_NOTICE',		'Please select your location:' );

// File
define( '_AEC_MI_FILE_NAME',		'File' );
define( '_AEC_MI_FILE_DESC',		'Create and Modify files on your server' );
define( '_MI_MI_FILE_PATH_NAME',		'Path' );
define( '_MI_MI_FILE_PATH_DESC',		'Full System path to the file you want to create or modify.' );
define( '_MI_MI_FILE_APPEND_NAME',		'Append' );
define( '_MI_MI_FILE_APPEND_DESC',		'Append new content to existing text (if exists).' );
define( '_MI_MI_FILE_CONTENT_NAME',		'Content' );
define( '_MI_MI_FILE_CONTENT_DESC',		'The text that you want to put into the file.' );
define( '_MI_MI_FILE_PATH_EXP_NAME',		'Path (expiration)' );
define( '_MI_MI_FILE_PATH_EXP_DESC',		'Full System path to the file you want to create or modify on expiration.' );
define( '_MI_MI_FILE_APPEND_EXP_NAME',		'Append (expiration)' );
define( '_MI_MI_FILE_APPEND_EXP_DESC',		'Append new content to existing text (if exists) on expiration.' );
define( '_MI_MI_FILE_CONTENT_EXP_NAME',		'Content (expiration)' );
define( '_MI_MI_FILE_CONTENT_EXP_DESC',		'The text that you want to put into the file on expiration.' );
define( '_MI_MI_FILE_PATH_PRE_EXP_NAME',		'Path (pre-expiration)' );
define( '_MI_MI_FILE_PATH_PRE_EXP_DESC',		'Full System path to the file you want to create or modify before expiration.' );
define( '_MI_MI_FILE_APPEND_PRE_EXP_NAME',		'Append (pre-expiration)' );
define( '_MI_MI_FILE_APPEND_PRE_EXP_DESC',		'Append new content to existing text (if exists) before expiration.' );
define( '_MI_MI_FILE_CONTENT_PRE_EXP_NAME',		'Content (pre-expiration)' );
define( '_MI_MI_FILE_CONTENT_PRE_EXP_DESC',		'The text that you want to put into the file before expiration.' );

// Admin-User-Access
define( '_AEC_MI_NAME_ADMINUSERACCESS','Admin-User-Access' );
define( '_AEC_MI_DESC_ADMINUSERACCESS','Will automate addition of a user to a Admin-User-Access group in Admin-User-Access' );
define( '_MI_MI_ADMINUSERACCESS_SET_GROUP_NAME','Set group' );
define( '_MI_MI_ADMINUSERACCESS_SET_GROUP_DESC','Choose Yes if you wish a Admin-User-Access group to be applied when the plan is applied' );
define( '_MI_MI_ADMINUSERACCESS_GROUP_NAME','Group' );
define( '_MI_MI_ADMINUSERACCESS_GROUP_DESC','The Admin-User-Access group you wish applied - if you choose yes.' );
define( '_MI_MI_ADMINUSERACCESS_SET_GROUP_EXP_NAME','Set group (expiration)' );
define( '_MI_MI_ADMINUSERACCESS_SET_GROUP_EXP_DESC','Choose Yes if you wish the Admin-User-Access group to be changed when the plan expires. Otherwise, the group assignment is left untouched.' );
define( '_MI_MI_ADMINUSERACCESS_GROUP_EXP_NAME','Group (expiration)' );
define( '_MI_MI_ADMINUSERACCESS_GROUP_EXP_DESC','The Admin-User-Access group you wish to use if the plan expires' );
define( '_MI_MI_ADMINUSERACCESS_REBUILD_NAME','Rebuild' );
define( '_MI_MI_ADMINUSERACCESS_REBUILD_DESC','This option will rebuild your whole Admin-User-Access group assignment by looking for each plan that has this MI applied and then add each user that uses one of these plans to the file.' );
define( '_MI_MI_ADMINUSERACCESS_REMOVE_NAME','Remove' );
define( '_MI_MI_ADMINUSERACCESS_REMOVE_DESC','Carry out the expiration action for all users with an active plan attached to this micro-integration' );

// Frontend-User-Access
define( '_AEC_MI_NAME_FRONTENDUSERACCESS','Frontend-User-Access' );
define( '_AEC_MI_DESC_FRONTENDUSERACCESS','Will automate addition of a user to a Frontend-User-Access group in Frontend-User-Access' );
define( '_MI_MI_FRONTENDUSERACCESS_SET_GROUP_NAME','Set group' );
define( '_MI_MI_FRONTENDUSERACCESS_SET_GROUP_DESC','Choose Yes if you wish a Frontend-User-Access group to be applied when the plan is applied' );
define( '_MI_MI_FRONTENDUSERACCESS_GROUP_NAME','Group' );
define( '_MI_MI_FRONTENDUSERACCESS_GROUP_DESC','The Frontend-User-Access group you wish applied - if you choose yes.' );
define( '_MI_MI_FRONTENDUSERACCESS_SET_GROUP_EXP_NAME','Set group (expiration)' );
define( '_MI_MI_FRONTENDUSERACCESS_SET_GROUP_EXP_DESC','Choose Yes if you wish the Frontend-User-Access group to be changed when the plan expires. Otherwise, the group assignment is left untouched.' );
define( '_MI_MI_FRONTENDUSERACCESS_GROUP_EXP_NAME','Group (expiration)' );
define( '_MI_MI_FRONTENDUSERACCESS_GROUP_EXP_DESC','The Frontend-User-Access group you wish to use if the plan expires' );
define( '_MI_MI_FRONTENDUSERACCESS_REBUILD_NAME','Rebuild' );
define( '_MI_MI_FRONTENDUSERACCESS_REBUILD_DESC','This option will rebuild your whole Frontend-User-Access group assignment by looking for each plan that has this MI applied and then add each user that uses one of these plans to the file.' );
define( '_MI_MI_FRONTENDUSERACCESS_REMOVE_NAME','Remove' );
define( '_MI_MI_FRONTENDUSERACCESS_REMOVE_DESC','Carry out the expiration action for all users with an active plan attached to this micro-integration' );

?>