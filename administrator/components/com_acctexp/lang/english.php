<?php
/**
* @version $Id: english.php
* @package AEC - Account Control Expiration - Membership Manager
* @subpackage Language - Backend - English
* @copyright 2006-2008 Copyright (C) David Deutsch
* @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
* @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
*/

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

define( '_AEC_LANGUAGE',						'en' ); // DO NOT CHANGE!!
define( '_CFG_GENERAL_ACTIVATE_PAID_NAME',		'Activate Paid Subscriptions' );
define( '_CFG_GENERAL_ACTIVATE_PAID_DESC',		'Always activate Subscriptions that are paid for automatically instead of requiring an activation code' );

// hacks/install >> ATTENTION: MUST BE HERE AT THIS POSITION, needed later!
define( '_AEC_SPEC_MENU_ENTRY',					'My Subscription' );

// common
define( '_DESCRIPTION_PAYSIGNET',				'mic: Description Paysignet - CHECK! -');
define( '_AEC_CONFIG_SAVED',					'Configuration saved' );
define( '_AEC_CONFIG_CANCELLED',				'Configuration cancelled' );
define( '_AEC_TIP_NO_GROUP_PF_PB',				'Public Frontend is NOT a usergroup - and neither is "Public Backend' );
define( '_AEC_CGF_LINK_ABO_FRONTEND',			'Direct Frontend link' );
define( '_AEC_CGF_LINK_CART_FRONTEND',			'Direct Add To Cart link' );
define( '_AEC_NOT_SET',							'Not set' );
define( '_AEC_COUPON',							'Coupon' );
define( '_AEC_CMN_NEW',							'New' );
define( '_AEC_CMN_CLICK_TO_EDIT',				'Click to edit' );
define( '_AEC_CMN_LIFETIME',					'Lifetime' );
define( '_AEC_CMN_UNKOWN',						'Unknown' );
define( '_AEC_CMN_EDIT_CANCELLED',				'Changes cancelled' );
define( '_AEC_CMN_PUBLISHED',					'Published' );
define( '_AEC_CMN_NOT_PUBLISHED',				'Not Published' );
define( '_AEC_CMN_CLICK_TO_CHANGE',				'Click on icon to toggle state' );
define( '_AEC_CMN_NONE_SELECTED',				'None Selected' );
define( '_AEC_CMN_MADE_VISIBLE',				'made visible' );
define( '_AEC_CMN_MADE_INVISIBLE',				'made invisible' );
define( '_AEC_CMN_TOPUBLISH',					'publish' ); // to ...
define( '_AEC_CMN_TOUNPUBLISH',					'unpublish' ); // to ...
define( '_AEC_CMN_FILE_SAVED',					'File saved' );
define( '_AEC_CMN_ID',							'ID' );
define( '_AEC_CMN_DATE',						'Date' );
define( '_AEC_CMN_EVENT',						'Event' );
define( '_AEC_CMN_TAGS',						'Tags' );
define( '_AEC_CMN_ACTION',						'Action' );
define( '_AEC_CMN_PARAMETER',					'Parameter' );
define( '_AEC_CMN_NONE',						'None' );
define( '_AEC_CMN_WRITEABLE',					'Writeable' );
define( '_AEC_CMN_UNWRITEABLE',					'Unwriteable!' );
define( '_AEC_CMN_UNWRITE_AFTER_SAVE',			'Make unwriteable after saving' );
define( '_AEC_CMN_OVERRIDE_WRITE_PROT',			'Override write protection while saving' );
define( '_AEC_CMN_NOT_SET',						'Not set' );
define( '_AEC_CMN_SEARCH',						'Search' );
define( '_AEC_CMN_APPLY',						'Apply' );
define( '_AEC_CMN_STATUS',						'Status' );
define( '_AEC_FEATURE_NOT_ACTIVE',				'This feature is not active yet' );
define( '_AEC_CMN_YES',							'Yes' );
define( '_AEC_CMN_NO',							'No' );
define( '_AEC_CMN_INHERIT',						'Inherit' );
define( '_AEC_CMN_LANG_CONSTANT_IS_MISSING',	'Language constant <strong>%s</strong> is missing' );
define( '_AEC_CMN_VISIBLE',						'Visible' );
define( '_AEC_CMN_INVISIBLE',					'Invisible' );
define( '_AEC_CMN_EXCLUDED',					'Excluded' );
define( '_AEC_CMN_PENDING',						'Pending' );
define( '_AEC_CMN_ACTIVE',						'Active' );
define( '_AEC_CMN_TRIAL',						'Trial' );
define( '_AEC_CMN_CANCEL',						'Cancelled' );
define( '_AEC_CMN_HOLD',						'Hold' );
define( '_AEC_CMN_EXPIRED',						'Expired' );
define( '_AEC_CMN_CLOSED',						'Closed' );

// user(info)
define( '_AEC_USER_USER_INFO',					'User Info' );
define( '_AEC_USER_USERID',						'UserID' );
define( '_AEC_USER_STATUS',						'Status' );
define( '_AEC_USER_ACTIVE',						'Active' );
define( '_AEC_USER_BLOCKED',					'Blocked' );
define( '_AEC_USER_ACTIVE_LINK',				'Activation Link' );
define( '_AEC_USER_PROFILE',					'Profile' );
define( '_AEC_USER_PROFILE_LINK',				'View Profile' );
define( '_AEC_USER_USERNAME',					'Username' );
define( '_AEC_USER_NAME',						'Name' );
define( '_AEC_USER_EMAIL',						'E-Mail' );
define( '_AEC_USER_SEND_MAIL',					'send email' );
define( '_AEC_USER_TYPE',						'Usertype' );
define( '_AEC_USER_REGISTERED',					'Registered' );
define( '_AEC_USER_LAST_VISIT',					'Last Visit' );
define( '_AEC_USER_EXPIRATION',					'Expiration' );
define( '_AEC_USER_CURR_EXPIRE_DATE',			'Current Expiration Date' );
define( '_AEC_USER_LIFETIME',					'Lifetime' );
define( '_AEC_USER_RESET_EXP_DATE',				'Reset Expiration Date' );
define( '_AEC_USER_RESET_STATUS',				'Reset Status' );
define( '_AEC_USER_SUBSCRIPTION',				'Subscription' );
define( '_AEC_USER_PAYMENT_PROC',				'Payment Processor' );
define( '_AEC_USER_CURR_SUBSCR_PLAN',			'Current Subscription Plan' );
define( '_AEC_USER_PREV_SUBSCR_PLAN',			'Previous Subscription Plan' );
define( '_AEC_USER_USED_PLANS',					'Used Subscription Plans' );
define( '_AEC_USER_NO_PREV_PLANS',				'No Subscriptions yet' );
define( '_AEC_USER_ASSIGN_TO_PLAN',				'Assign to Plan' );
define( '_AEC_USER_TIME',							'time' );
define( '_AEC_USER_TIMES',						'times' );
define( '_AEC_USER_INVOICES',					'Invoices' );
define( '_AEC_USER_NO_INVOICES',				'No invoices yet' );
define( '_AEC_USER_INVOICE_FACTORY',			'Invoice Factory' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS',			'All Subscriptions by this User' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS_NOPE',	'This is the only subscription this user currently holds.' );
define( '_AEC_USER_SUBSCRIPTIONS_ID',			'ID' );
define( '_AEC_USER_SUBSCRIPTIONS_STATUS',		'Status' );
define( '_AEC_USER_SUBSCRIPTIONS_PROCESSOR',	'Processor' );
define( '_AEC_USER_SUBSCRIPTIONS_SINGUP',		'Signup' );
define( '_AEC_USER_SUBSCRIPTIONS_EXPIRATION',	'Expiration' );
define( '_AEC_USER_SUBSCRIPTIONS_PRIMARY',		'primary' );
define( '_AEC_USER_CURR_SUBSCR_PLAN_PRIMARY',	'Primary' );
define( '_AEC_USER_COUPONS',					'Coupons' );
define( '_HISTORY_COL_COUPON_CODE',				'Coupon Code' );
define( '_AEC_USER_NO_COUPONS',					'No coupon use in records' );
define( '_AEC_USER_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_USER_MICRO_INTEGRATION_USER',		'Frontend' );
define( '_AEC_USER_MICRO_INTEGRATION_ADMIN',	'Backend' );
define( '_AEC_USER_MICRO_INTEGRATION_DB',		'Database Readout' );

// new (additional)
define( '_AEC_MSG_MIS_NOT_DEFINED',				'You have not defined any integrations - see config' );

// headers
define( '_AEC_HEAD_SETTINGS',					'Settings' );
define( '_AEC_HEAD_HACKS',						'Hacks' );
define( '_AEC_HEAD_PLAN_INFO',					'Subscriptions' );
define( '_AEC_HEAD_LOG',						'Events Log' );
define( '_AEC_HEAD_CSS_EDITOR',					'CSS Editor' );
define( '_AEC_HEAD_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_HEAD_ACTIVE_SUBS',				'Active Subscriber' );
define( '_AEC_HEAD_EXCLUDED_SUBS',				'Excluded Subscriber' );
define( '_AEC_HEAD_EXPIRED_SUBS',				'Expired Subscriber' );
define( '_AEC_HEAD_PENDING_SUBS',				'Pending Subscriber' );
define( '_AEC_HEAD_CANCELLED_SUBS',				'Cancelled Subscriber' );
define( '_AEC_HEAD_HOLD_SUBS',					'Subscriber on Hold' );
define( '_AEC_HEAD_CLOSED_SUBS',				'Closed Subscriber' );
define( '_AEC_HEAD_MANUAL_SUBS',				'Manual Subscriber' );
define( '_AEC_HEAD_SUBCRIBER',					'Subscriber' );

// hacks
define( '_AEC_HACK_HACK',						'Hack' );
define( '_AEC_HACKS_ISHACKED',					'is hacked' );
define( '_AEC_HACKS_NOTHACKED',					'is not hacked!' );
define( '_AEC_HACKS_UNDO',						'undo now' );
define( '_AEC_HACKS_COMMIT',					'commit' );
define( '_AEC_HACKS_FILE',						'File' );
define( '_AEC_HACKS_LOOKS_FOR',					'The Hack will look for this' );
define( '_AEC_HACKS_REPLACE_WITH',				'... and replace it with this' );

define( '_AEC_HACKS_NOTICE',					'IMPORTANT NOTICE' );
define( '_AEC_HACKS_NOTICE_DESC',				'In some cases, you need apply hacks to some files. To do so, please click the "hack file now" links for these files. You may also Add a link to your User Menu so that your Users can have a look at their Subscription Record.' );
define( '_AEC_HACKS_NOTICE_DESC2',				'<strong>All functionally important hacks are marked with an arrow and an exclamation mark.</strong>' );
define( '_AEC_HACKS_NOTICE_DESC3',				'These hacks are <strong>not necessarily in a correct numerical order</strong> - so don\'t wonder if they go #1, #3, #6 - the missing numbers are most likely legacy hacks that you would only see if you had them (incorrectly) applied.' );
define( '_AEC_HACKS_NOTICE_JACL',				'JACL NOTICE' );
define( '_AEC_HACKS_NOTICE_JACL_DESC',			'In case you plan to install the JACLplus component, please make sure that the hacks are <strong>not commited</strong> when installing it. JACL also commits hacks to the core files and it is important that our hacks are committed after the JACL ones.' );

define( '_AEC_HACKS_MENU_ENTRY',				'Menu Entry' );
define( '_AEC_HACKS_MENU_ENTRY_DESC',			'Adds a <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> menu entry to the Usermenu. With this, a user can manage his invoices and upgrade/renew his or her subscription.' );
define( '_AEC_HACKS_LEGACY',					'<strong>This is a Legacy Hack, please undo!</strong>' );
define( '_AEC_HACKS_LEGACY_MAMBOT',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.0 Mambot, please undo and use the "Hacks Mambot" instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Plugin, please undo and use the Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ERROR',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Error Plugin, please undo and use the AEC Error Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_USER',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 User Plugin, please undo and use the AEC User Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ACCESS',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Access Plugin, please undo and use the AEC Access Plugin instead!</strong>' );
define( '_AEC_HACKS_NOTAUTH',					'This will correctly link your users to the NotAllowed page with information about your subscriptions' );
define( '_AEC_HACKS_SUB_REQUIRED',				'This will make sure a user has a subscription in order to log in.<br /><strong>Remember to also set [ Require Subscription ] in the AEC Settings!</strong>' );
define( '_AEC_HACKS_REG2',						'This will redirect a registering user to the payment plans after filling out the registration form. Leave this alone to have plan selection only on login (if \'Require Subscription\' is active), or completely voluntary (without requiring a subscription).' );
define( '_AEC_HACKS_REG3',						'This will redirect the user to the payment plans page when he or she has not made that selection yet.' );
define( '_AEC_HACKS_REG4',						'This Hack will transmit the AEC variables from the user details form.' );
define( '_AEC_HACKS_REG5',						'This Hack will make the Plans First feature possible - you need to set the switch for this in the settings as well!' );
define( '_AEC_HACKS_MI1',						'Some Micro Integrations rely on receiving a cleartext password for each user. This hack will make sure that the Micro Integrations will be notified when a user changes his/her account.' );
define( '_AEC_HACKS_MI2',						'Some Micro Integrations rely on receiving a cleartext password for each user. This hack will make sure that the Micro Integrations will be notified when a user registers an account.' );
define( '_AEC_HACKS_MI3',						'Some Micro Integrations rely on receiving a cleartext password for each user. This hack will make sure that the Micro Integrations will be notified when an admin changes a user-account.' );
define( '_AEC_HACKS_CB2',						'This will redirect a registering user to the payment plans after filling out the registration form in CB. Leave this alone to have plan selection only on login (if \'Require Subscription\' is active), or completely voluntary (without requiring a subscription). <strong>Please note that there are two hacks following this, once you have committed it! If you want to have the plans before the user details, these are required as well.</strong>' );
define( '_AEC_HACKS_CB6',						'This will redirect the user to the payment plans page when he or she has not made that selection yet.' );
define( '_AEC_HACKS_CB_HTML2',					'This Hack will transmit the AEC variables from the user details form. <strong>In order to make this work, set \'Plans First\' in the AEC Settings.</strong>' );
define( '_AEC_HACKS_UHP2',						'UHP2 Menu Entry' );
define( '_AEC_HACKS_UHP2_DESC',					'Adds a <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> menu entry to the UHP2 Usermenu. With this, a user can manage his invoices and upgrade/renew his or her subscription.' );
define( '_AEC_HACKS_CBM',						'If you are using the Comprofiler Moderator Module, you have to hack it in order to prevent an infinite loops issue.' );

define( '_AEC_HACKS_JUSER_HTML1',				'This will redirect a registering user to the payment plans after filling out the registration form in JUser. Leave this alone to have plan selection only on login (if \'Require Subscription\' is active), or completely voluntary (without requiring a subscription). <strong>Please note that there are two hacks following this, once you have committed it! If you want to have the plans before the user details, these are required as well.</strong>' );
define( '_AEC_HACKS_JUSER_PHP1',				'This will redirect the user to the payment plans page when he or she has not made that selection yet.' );
define( '_AEC_HACKS_JUSER_PHP2',				'This is a bugfix which allows the AEC to load the JUser functions without forcing it to react to the POST data.' );

// log
	// settings
define( '_AEC_LOG_SH_SETT_SAVED',				'settings change' );
define( '_AEC_LOG_LO_SETT_SAVED',				'The Settings for AEC have been saved, changes:' );
	// heartbeat
define( '_AEC_LOG_SH_HEARTBEAT',				'Heartbeat' );
define( '_AEC_LOG_LO_HEARTBEAT',				'Heartbeat carried out:' );
define( '_AEC_LOG_AD_HEARTBEAT_DO_NOTHING',		'does nothing' );
	// install
define( '_AEC_LOG_SH_INST',						'AEC install' );
define( '_AEC_LOG_LO_INST',						'The AEC Version %s has been installed. Welcome to your new version of the Account Expiration Control Component!' );

// install texts
define( '_AEC_INST_NOTE_IMPORTANT',				'Important Notice' );
define( '_AEC_INST_NOTE_SECURITY',				'For certain features, you may need to apply hacks to other components. For your convenience, we have included an autohacking feature that does just that with the click of a link' );
define( '_AEC_INST_APPLY_HACKS',				'In order to commit these hacks right now, go to the %s. (You can also access this page later on from the AEC central view or menu)' );
define( '_AEC_INST_APPLY_HACKS_LTEXT',			'hacks page' );
define( '_AEC_INST_NOTE_UPGRADE',				'<strong>If you are upgrading, make sure to check the hacks page anyways, since there are changes from time to time!!!</strong>' );
define( '_AEC_INST_NOTE_HELP',					'To help you along with frequently encountered problems, we have created a %s that will help you ship around the most common setup problems (access is also available from the AEC central).' );
define( '_AEC_INST_NOTE_HELP_LTEXT',			'help function' );
define( '_AEC_INST_HINTS',						'Hints' );
define( '_AEC_INST_HINT1',						'We encourage you to visit the <a href="%s" target="_blank">valanx.org forums</a> and to <strong>participate in the discussion there</strong>. Chances are, that other users have found the same bugs and it is equally likely that there is at least a fix to hack in or even a new version.' );
define( '_AEC_INST_HINT2',						'In any case (and especially if you use this on a live site): <strong>go through your settings and make a test subscription</strong> to see whether everything is working to your satisfaction! Although we try our best to make upgrading as flawless as possible, some fundamental changes to our program may not be possible to cushion for all users.</p><p><strong>Thank you for choosing the AEC Component!</strong></p>' );
define( '_AEC_INST_ATTENTION',					'No need to use the old logins!' );
define( '_AEC_INST_ATTENTION1',					'If you still have the old AEC login modules installed, please uninstall it (no matter which one, regular or CB) and use the normal joomla or CB login module. There is no need to use these old modules anymore.' );
define( '_AEC_INST_MAIN_COMP_ENTRY',			'AEC Subscription Manager' );
define( '_AEC_INST_ERRORS',						'<strong>Attention</strong><br />AEC could not be installed completely, following errors occured during the install process:<br />' );

define( '_AEC_INST_ROOT_GROUP_NAME',			'Root' );
define( '_AEC_INST_ROOT_GROUP_DESC',			'Root Group. This entry cannot be deleted, modification is limited.' );

// help
define( '_AEC_CMN_HELP',						'Help' );
define( '_AEC_HELP_DESC',						'On this page, the AEC takes a look at its own configuration and tells you whenever it finds errors that need to be adressed.' );
define( '_AEC_HELP_GREEN',						'Green</strong> items indicate trivial problems or notifications, or problems that have already been solved.' );
define( '_AEC_HELP_YELLOW',						'Yellow</strong> items are mostly of cosmetical importance (like additions to the user frontend), but also issues that are most likely a deliberate choice of the administrator.' );
define( '_AEC_HELP_RED',						'Red</strong> items are of high importance to either the way the AEC works or the security of your System.' );
define( '_AEC_HELP_GEN',						'Please note that even though we try to cover as many errors and problems as possible, this page can only point at the most obvious ones and is by far not completed yet (beta&trade;)' );
define( '_AEC_HELP_QS_HEADER',					'AEC Quickstart Manual' );
define( '_AEC_HELP_QS_DESC',					'Before doing anything about the below issues, please read our %s!' );
define( '_AEC_HELP_QS_DESC_LTEXT',				'Quickstart Manual' );
define( '_AEC_HELP_SER_SW_DIAG1',				'File Permissions Problems' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC',			'AEC has detected that you are using an Apache Webserver - To be able to hack files on such a server, those files have to be owned by the webserver user, which apparently is not so for at least one of the neccessary files. <strong>If the hacks already worked just fine, you can ignore this!</strong>' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC2',			'We recommend that you temporarily change the file permissions to 777, then commit the hacks and change it back after that. <strong>Contact your server host or administrator for the possibly quickest response when experiencing problems.</strong> This is the same for the file permission related suggestion(s) below.' );
define( '_AEC_HELP_SER_SW_DIAG2',				'joomla.php/mambo.php File Permissions' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC',			'The AEC has detected that your joomla.php is not owned by the webserver.' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC2',			'Access your webserver via ssh and go to the directory \"<yoursiteroot>/includes\". There, type in this command: \"chown wwwrun joomla.php\" (or \"chown wwwrun mambo.php\" in case you are using mambo). <strong>If the hacks already worked just fine, you can ignore this!</strong>' );
define( '_AEC_HELP_SER_SW_DIAG3',				'Legacy Hacks Detected!' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC',			'You appear to have old Hacks commited to your System.' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC2',			'In Order for the AEC to function correctly, please review the Hacks page and follow the steps presented there.' );
define( '_AEC_HELP_SER_SW_DIAG4',				'File Permissions Problems' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC',			'AEC can not detect the write permission status of the files it wants to hack as it appears that your installation of php has been compiled with the option \"--disable-posix\". <strong>You can still try to commit the hacks - if it does not work, its most likely a file permission problem</strong>. <strong>If the hacks already worked just fine, you can ignore this!</strong>' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC2',			'We recommend that you either recompile your php version with the said option left out or contact your webserver administrator on this matter.' );
define( '_AEC_HELP_DIAG_CMN1',					'joomla.php/mambo.php Hack' );
define( '_AEC_HELP_DIAG_CMN1_DESC',				'In order for the AEC to function, this hack is required to redirect users to the AEC Verification Routines on Login.' );
define( '_AEC_HELP_DIAG_CMN1_DESC2',			'Go to the Hacks page and commit the hack' );
define( '_AEC_HELP_DIAG_CMN2',					'"My Subscription" Menu Entry' );
define( '_AEC_HELP_DIAG_CMN2_DESC',				'A link to a MySubscription page for your users makes it easy for them to track their subscription.' );
define( '_AEC_HELP_DIAG_CMN2_DESC2',			'Go to the Hacks page and create the link.' );
define( '_AEC_HELP_DIAG_CMN3',					'JACL not installed' );
define( '_AEC_HELP_DIAG_CMN3_DESC',				'If you plan to install JACLplus in your joomla!/mambo system, please make sure that the AEC hacks are not committed when doing so. If you have already committed them, you can easily undo them in our hacks page.' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN',			'No Active Payment Plan!' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN_DESC',		'There seems to be no Payment Plan published yet - The AEC needs at least one active plan to function' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN',			'Global Entry Plan' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN_DESC',		'There is a Global Entry Plan active in your configuration. If you are not sure what this is, you should probably disable it - Its an entry plan that each new user will be assigned to without having a choice.' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE',	'Server Apparantly Not Reachable' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE_DESC',	'It seems that you have installed the AEC on a local machine. In order to retrieve notifications (and thus to have the component work correctly), you need to install it on a server that is reachable by a fixed IP or Domain!' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE',			'Site Offline' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE_DESC',		'You have decided to take your site offline - please note that this can have an effect on notification processes and thus on your payment workflow.' );
define( '_AEC_HELP_DIAG_REG_DISABLED',			'User Registration Disabled' );
define( '_AEC_HELP_DIAG_REG_DISABLED_DESC',		'Your User Registration is disabled. This way, no new customer can subscribe to your website.' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED',		'User Login Disabled' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED_DESC',	'Your have disabled the Frontend Login functionality. Because of this, none of your customers can use your website.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID',		'Paypal Check Business ID' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC',	'This routine checks for a matching paypal business ID to enhance security with Paypal Transactions.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC1',	'Please disable this setting in case you encounter problems where you receive payments correctly, but without users being enabled. Disable the Setting in general in case you are using multiple e-mail addresses with your Paypal account.' );

// micro integration
	// general
define( '_AEC_MI_REWRITING_INFO',				'Rewriting Info' );
define( '_AEC_MI_SET1_INAME',					'Subscription at %s - User: %s (%s)' );
	// htaccess
define( '_AEC_MI_HTACCESS_INFO_DESC',			'Protect a folder with a .htaccess file and only allow users of this subscription to access it with their joomla account details.' );
	// email
define( '_AEC_MI_EMAIL_INFO_DESC',				'Send an Email to one or more addresses on application or expiration of the subscription' );
	// idev
define( '_AEC_MI_IDEV_DESC',					'Connect your sales to iDevAffiliate' );
	// mosetstree
define( '_AEC_MI_MOSETSTREE_DESC',				'Restrict the amount of listings a user can publish' );
	// mysql-query
define( '_AEC_MI_MYSQL_DESC',					'Specify a mySQL query that should be carried out with this subscription or on its expiration' );
	// remository
define( '_AEC_MI_REMOSITORY_DESC',				'Choose the amount of files a user can download and what reMOSitory group should be assigned to the user account' );
	// VirtueMart
define( '_AEC_MI_VIRTUEMART_DESC',				'Choose the VirtueMart usergroup this user should be applied to' );

// central
define( '_AEC_CENTR_CENTRAL',					'AEC Central' );
define( '_AEC_CENTR_EXCLUDED',					'Excluded' );
define( '_AEC_CENTR_PLANS',						'Plans' );
define( '_AEC_CENTR_PENDING',					'Pending' );
define( '_AEC_CENTR_ACTIVE',					'Active' );
define( '_AEC_CENTR_EXPIRED',					'Expired' );
define( '_AEC_CENTR_CANCELLED',					'Cancelled' );
define( '_AEC_CENTR_HOLD',						'On Hold' );
define( '_AEC_CENTR_CLOSED',					'Closed' );
define( '_AEC_CENTR_PROCESSORS',				'Processors' );
define( '_AEC_CENTR_SETTINGS',					'Settings' );
define( '_AEC_CENTR_EDIT_CSS',					'Edit CSS' );
define( '_AEC_CENTR_V_INVOICES',				'View Invoices' );
define( '_AEC_CENTR_COUPONS',					'Coupons' );
define( '_AEC_CENTR_COUPONS_STATIC',			'Static Coupons' );
define( '_AEC_CENTR_VIEW_HISTORY',				'View History' );
define( '_AEC_CENTR_HACKS',						'Hacks' );
define( '_AEC_CENTR_M_INTEGRATION',				'Micro Integr.' );
define( '_AEC_CENTR_HELP',						'Help' );
define( '_AEC_CENTR_LOG',						'EventLog' );
define( '_AEC_CENTR_MANUAL',					'Manual' );
define( '_AEC_CENTR_EXPORT',					'Export' );
define( '_AEC_CENTR_IMPORT',					'Import' );
define( '_AEC_CENTR_GROUPS',					'Groups' );
define( '_AEC_CENTR_AREA_MEMBERSHIPS',			'Memberships' );
define( '_AEC_CENTR_AREA_PAYMENT',				'Payment Plans &amp; related functionality' );
define( '_AEC_CENTR_AREA_SETTINGS',				'Settings, Logs &amp; special functionality' );
define( '_AEC_QUICKSEARCH',						'Quick Search' );
define( '_AEC_QUICKSEARCH_DESC',				'Put in a users name, username, email address, userid or an invoice number to get directly linked to the users profile. If there are more than one result, they will be shown below.' );
define( '_AEC_QUICKSEARCH_MULTIRES',			'Multiple Results!' );
define( '_AEC_QUICKSEARCH_MULTIRES_DESC',		'Please pick one of the following users:' );
define( '_AEC_QUICKSEARCH_THANKS',				'Thank you for making a simple function very happy.' );
define( '_AEC_QUICKSEARCH_NOTFOUND',			'User not found' );

define( '_AEC_NOTICES_FOUND',					'Eventlog Notices' );
define( '_AEC_NOTICES_FOUND_DESC',				'The following entries in the Eventlog deserve your attention. You can mark them read if you want them to disappear. You can also change the types of notices that show up here in the Settings.' );
define( '_AEC_NOTICE_MARK_READ',				'mark read' );
define( '_AEC_NOTICE_MARK_ALL_READ',			'Mark all Notices read' );
define( '_AEC_NOTICE_NUMBER_1',					'Event' );
define( '_AEC_NOTICE_NUMBER_2',					'Event' );
define( '_AEC_NOTICE_NUMBER_8',					'Notice' );
define( '_AEC_NOTICE_NUMBER_32',				'Warning' );
define( '_AEC_NOTICE_NUMBER_128',				'Error' );
define( '_AEC_NOTICE_NUMBER_512',				'None' );

// select lists
define( '_AEC_SEL_EXCLUDED',					'Excluded' );
define( '_AEC_SEL_PENDING',						'Pending' );
define( '_AEC_SEL_TRIAL',						'Trial' );
define( '_AEC_SEL_ACTIVE',						'Active' );
define( '_AEC_SEL_EXPIRED',						'Expired' );
define( '_AEC_SEL_CLOSED',						'Closed' );
define( '_AEC_SEL_CANCELLED',					'Cancelled' );
define( '_AEC_SEL_HOLD',						'Hold' );
define( '_AEC_SEL_NOT_CONFIGURED',				'Not Configured' );

// footer
define( '_AEC_FOOT_TX_CHOOSING',				'Thank you for choosing the Account Expiration Control Component!' );
define( '_AEC_FOOT_TX_GPL',						'This Joomla component was developed and released under the <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU/GPL</a> license by David Deutsch & Team AEC from <a href="http://www.valanx.org" target="_blank">valanx.org</a>' );
define( '_AEC_FOOT_TX_SUBSCRIBE',				'If you want more features, professional service, updates, manuals and online help for this component, you can subscribe to our services at the above link. It helps us a lot in our development!' );
define( '_AEC_FOOT_CREDIT',						'Please read our %s' );
define( '_AEC_FOOT_CREDIT_LTEXT',				'full credits' );
define( '_AEC_FOOT_VERSION_CHECK',				'Check for latest Version' );
define( '_AEC_FOOT_MEMBERSHIP',					'Get a membership with documentation and support' );

// alerts
define( '_AEC_ALERT_SELECT_FIRST',				'Select an item to configure' );
define( '_AEC_ALERT_SELECT_FIRST_TO',			'Please select first an item to' );

// messages
define( '_AEC_MSG_NODELETE_SUPERADMIN',			'You cannot delete a Super Administrator' );
define( '_AEC_MSG_NODELETE_YOURSELF',			'You cannot delete Yourself!' );
define( '_AEC_MSG_NODELETE_EXCEPT_SUPERADMIN',	'Only Superadmins can perform this action!' );
define( '_AEC_MSG_SUBS_RENEWED',				'subscription(s) renewed' );
define( '_AEC_MSG_SUBS_ACTIVATED',				'subscription(s) activated' );
define( '_AEC_MSG_NO_ITEMS_TO_DELETE',			'No item found to delete' );
define( '_AEC_MSG_NO_DEL_W_ACTIVE_SUBSCRIBER',	'You cannot delete plans with active subscribers' );
define( '_AEC_MSG_ITEMS_DELETED',				'Item(s) deleted' );
define( '_AEC_MSG_ITEMS_SUCESSFULLY',			'%s Item(s) successfully' );
define( '_AEC_MSG_SUCESSFULLY_SAVED',			'Changes successfully saved' );
define( '_AEC_MSG_ITEMS_SUCC_PUBLISHED',		'Item(s) successfully Published' );
define( '_AEC_MSG_ITEMS_SUCC_UNPUBLISHED',		'Item(s) successfully Unpublished' );
define( '_AEC_MSG_NO_COUPON_CODE',				'You must specify a coupon code!' );
define( '_AEC_MSG_OP_FAILED',					'Operation Failed: Could not open %s' );
define( '_AEC_MSG_OP_FAILED_EMPTY',				'Operation failed: Content empty' );
define( '_AEC_MSG_OP_FAILED_NOT_WRITEABLE',		'Operation failed: The file is not writable.' );
define( '_AEC_MSG_OP_FAILED_NO_WRITE',			'Operation failed: Failed to open file for writing' );
define( '_AEC_MSG_INVOICE_CLEARED',				'Invoice cleared' );

// ISO 3166 Two-Character Country Codes
define( '_AEC_LANG_AD', 'Andorra' );
define( '_AEC_LANG_AE', 'United Arab Emirates' );
define( '_AEC_LANG_AF', 'Afghanistan' );
define( '_AEC_LANG_AG', 'Antigua and Barbuda' );
define( '_AEC_LANG_AI', 'Anguilla' );
define( '_AEC_LANG_AL', 'Albania' );
define( '_AEC_LANG_AM', 'Armenia' );
define( '_AEC_LANG_AN', 'Netherlands Antilles' );
define( '_AEC_LANG_AO', 'Angola' );
define( '_AEC_LANG_AQ', 'Antarctica' );
define( '_AEC_LANG_AR', 'Argentina' );
define( '_AEC_LANG_AS', 'American Samoa' );
define( '_AEC_LANG_AT', 'Austria' );
define( '_AEC_LANG_AU', 'Australia' );
define( '_AEC_LANG_AW', 'Aruba' );
define( '_AEC_LANG_AX', 'Aland Islands &#65279;land Island\'s' );
define( '_AEC_LANG_AZ', 'Azerbaijan' );
define( '_AEC_LANG_BA', 'Bosnia and Herzegovina' );
define( '_AEC_LANG_BB', 'Barbados' );
define( '_AEC_LANG_BD', 'Bangladesh' );
define( '_AEC_LANG_BE', 'Belgium' );
define( '_AEC_LANG_BF', 'Burkina Faso' );
define( '_AEC_LANG_BG', 'Bulgaria' );
define( '_AEC_LANG_BH', 'Bahrain' );
define( '_AEC_LANG_BI', 'Burundi' );
define( '_AEC_LANG_BJ', 'Benin' );
define( '_AEC_LANG_BL', 'Saint Barth&eacute;lemy' );
define( '_AEC_LANG_BM', 'Bermuda' );
define( '_AEC_LANG_BN', 'Brunei Darussalam' );
define( '_AEC_LANG_BO', 'Bolivia, Plurinational State of' );
define( '_AEC_LANG_BR', 'Brazil' );
define( '_AEC_LANG_BS', 'Bahamas' );
define( '_AEC_LANG_BT', 'Bhutan' );
define( '_AEC_LANG_BV', 'Bouvet Island' );
define( '_AEC_LANG_BW', 'Botswana' );
define( '_AEC_LANG_BY', 'Belarus' );
define( '_AEC_LANG_BZ', 'Belize' );
define( '_AEC_LANG_CA', 'Canada' );
define( '_AEC_LANG_CC', 'Cocos (Keeling) Islands' );
define( '_AEC_LANG_CD', 'Congo, the Democratic Republic of the' );
define( '_AEC_LANG_CF', 'Central African Republic' );
define( '_AEC_LANG_CG', 'Congo' );
define( '_AEC_LANG_CH', 'Switzerland' );
define( '_AEC_LANG_CI', 'Cote d\'Ivoire' );
define( '_AEC_LANG_CK', 'Cook Islands' );
define( '_AEC_LANG_CL', 'Chile' );
define( '_AEC_LANG_CM', 'Cameroon' );
define( '_AEC_LANG_CN', 'China' );
define( '_AEC_LANG_CO', 'Colombia' );
define( '_AEC_LANG_CR', 'Costa Rica' );
define( '_AEC_LANG_CU', 'Cuba' );
define( '_AEC_LANG_CV', 'Cape Verde' );
define( '_AEC_LANG_CX', 'Christmas Island' );
define( '_AEC_LANG_CY', 'Cyprus' );
define( '_AEC_LANG_CZ', 'Czech Republic' );
define( '_AEC_LANG_DE', 'Germany' );
define( '_AEC_LANG_DJ', 'Djibouti' );
define( '_AEC_LANG_DK', 'Denmark' );
define( '_AEC_LANG_DM', 'Dominica' );
define( '_AEC_LANG_DO', 'Dominican Republic' );
define( '_AEC_LANG_DZ', 'Algeria' );
define( '_AEC_LANG_EC', 'Ecuador' );
define( '_AEC_LANG_EE', 'Estonia' );
define( '_AEC_LANG_EG', 'Egypt' );
define( '_AEC_LANG_EH', 'Western Sahara' );
define( '_AEC_LANG_ER', 'Eritrea' );
define( '_AEC_LANG_ES', 'Spain' );
define( '_AEC_LANG_ET', 'Ethiopia' );
define( '_AEC_LANG_FI', 'Finland' );
define( '_AEC_LANG_FJ', 'Fiji' );
define( '_AEC_LANG_FK', 'Falkland Islands (Malvinas)' );
define( '_AEC_LANG_FM', 'Micronesia, Federated States of' );
define( '_AEC_LANG_FO', 'Faroe Islands' );
define( '_AEC_LANG_FR', 'France' );
define( '_AEC_LANG_GA', 'Gabon' );
define( '_AEC_LANG_GB', 'United Kingdom' );
define( '_AEC_LANG_GD', 'Grenada' );
define( '_AEC_LANG_GE', 'Georgia' );
define( '_AEC_LANG_GF', 'French Guiana' );
define( '_AEC_LANG_GG', 'Guernsey' );
define( '_AEC_LANG_GH', 'Ghana' );
define( '_AEC_LANG_GI', 'Gibraltar' );
define( '_AEC_LANG_GL', 'Greenland' );
define( '_AEC_LANG_GM', 'Gambia' );
define( '_AEC_LANG_GN', 'Guinea' );
define( '_AEC_LANG_GP', 'Guadeloupe' );
define( '_AEC_LANG_GQ', 'Equatorial Guinea' );
define( '_AEC_LANG_GR', 'Greece' );
define( '_AEC_LANG_GS', 'South Georgia and the South Sandwich Islands' );
define( '_AEC_LANG_GT', 'Guatemala' );
define( '_AEC_LANG_GU', 'Guam' );
define( '_AEC_LANG_GW', 'Guinea-Bissau' );
define( '_AEC_LANG_GY', 'Guyana' );
define( '_AEC_LANG_HK', 'Hong Kong' );
define( '_AEC_LANG_HM', 'Heard Island and McDonald Islands' );
define( '_AEC_LANG_HN', 'Honduras' );
define( '_AEC_LANG_HR', 'Croatia' );
define( '_AEC_LANG_HT', 'Haiti' );
define( '_AEC_LANG_HU', 'Hungary' );
define( '_AEC_LANG_ID', 'Indonesia' );
define( '_AEC_LANG_IE', 'Ireland' );
define( '_AEC_LANG_IL', 'Israel' );
define( '_AEC_LANG_IM', 'Isle of Man' );
define( '_AEC_LANG_IN', 'India' );
define( '_AEC_LANG_IO', 'British Indian Ocean Territory' );
define( '_AEC_LANG_IQ', 'Iraq' );
define( '_AEC_LANG_IR', 'Iran, Islamic Republic of' );
define( '_AEC_LANG_IS', 'Iceland' );
define( '_AEC_LANG_IT', 'Italy' );
define( '_AEC_LANG_JE', 'Jersey' );
define( '_AEC_LANG_JM', 'Jamaica' );
define( '_AEC_LANG_JO', 'Jordan' );
define( '_AEC_LANG_JP', 'Japan' );
define( '_AEC_LANG_KE', 'Kenya' );
define( '_AEC_LANG_KG', 'Kyrgyzstan' );
define( '_AEC_LANG_KH', 'Cambodia' );
define( '_AEC_LANG_KI', 'Kiribati' );
define( '_AEC_LANG_KM', 'Comoros' );
define( '_AEC_LANG_KN', 'Saint Kitts and Nevis' );
define( '_AEC_LANG_KP', 'Korea, Democratic People\'s Republic of' );
define( '_AEC_LANG_KR', 'Korea, Republic of' );
define( '_AEC_LANG_KW', 'Kuwait' );
define( '_AEC_LANG_KY', 'Cayman Islands' );
define( '_AEC_LANG_KZ', 'Kazakhstan' );
define( '_AEC_LANG_LA', 'Lao People\'s Democratic Republic' );
define( '_AEC_LANG_LB', 'Lebanon' );
define( '_AEC_LANG_LC', 'Saint Lucia' );
define( '_AEC_LANG_LI', 'Liechtenstein' );
define( '_AEC_LANG_LK', 'Sri Lanka' );
define( '_AEC_LANG_LR', 'Liberia' );
define( '_AEC_LANG_LS', 'Lesotho' );
define( '_AEC_LANG_LT', 'Lithuania' );
define( '_AEC_LANG_LU', 'Luxembourg' );
define( '_AEC_LANG_LV', 'Latvia' );
define( '_AEC_LANG_LY', 'Libyan Arab Jamahiriya' );
define( '_AEC_LANG_MA', 'Morocco' );
define( '_AEC_LANG_MC', 'Monaco' );
define( '_AEC_LANG_MD', 'Moldova, Republic of' );
define( '_AEC_LANG_ME', 'Montenegro' );
define( '_AEC_LANG_MF', 'Saint Martin (French part)' );
define( '_AEC_LANG_MG', 'Madagascar' );
define( '_AEC_LANG_MH', 'Marshall Islands' );
define( '_AEC_LANG_MK', 'Macedonia, the former Yugoslav Republic of' );
define( '_AEC_LANG_ML', 'Mali' );
define( '_AEC_LANG_MM', 'Myanmar' );
define( '_AEC_LANG_MN', 'Mongolia' );
define( '_AEC_LANG_MO', 'Macao' );
define( '_AEC_LANG_MP', 'Northern Mariana Islands' );
define( '_AEC_LANG_MQ', 'Martinique' );
define( '_AEC_LANG_MR', 'Mauritania' );
define( '_AEC_LANG_MS', 'Montserrat' );
define( '_AEC_LANG_MT', 'Malta' );
define( '_AEC_LANG_MU', 'Mauritius' );
define( '_AEC_LANG_MV', 'Maldives' );
define( '_AEC_LANG_MW', 'Malawi' );
define( '_AEC_LANG_MX', 'Mexico' );
define( '_AEC_LANG_MY', 'Malaysia' );
define( '_AEC_LANG_MZ', 'Mozambique' );
define( '_AEC_LANG_NA', 'Namibia' );
define( '_AEC_LANG_NC', 'New Caledonia' );
define( '_AEC_LANG_NE', 'Niger' );
define( '_AEC_LANG_NF', 'Norfolk Island' );
define( '_AEC_LANG_NG', 'Nigeria' );
define( '_AEC_LANG_NI', 'Nicaragua' );
define( '_AEC_LANG_NL', 'Netherlands' );
define( '_AEC_LANG_NO', 'Norway' );
define( '_AEC_LANG_NP', 'Nepal' );
define( '_AEC_LANG_NR', 'Nauru' );
define( '_AEC_LANG_NU', 'Niue' );
define( '_AEC_LANG_NZ', 'New Zealand' );
define( '_AEC_LANG_OM', 'Oman' );
define( '_AEC_LANG_PA', 'Panama' );
define( '_AEC_LANG_PE', 'Peru' );
define( '_AEC_LANG_PF', 'French Polynesia' );
define( '_AEC_LANG_PG', 'Papua New Guinea' );
define( '_AEC_LANG_PH', 'Philippines' );
define( '_AEC_LANG_PK', 'Pakistan' );
define( '_AEC_LANG_PL', 'Poland' );
define( '_AEC_LANG_PM', 'Saint Pierre and Miquelon' );
define( '_AEC_LANG_PN', 'Pitcairn' );
define( '_AEC_LANG_PR', 'Puerto Rico' );
define( '_AEC_LANG_PS', 'Palestinian Territory, Occupied' );
define( '_AEC_LANG_PT', 'Portugal' );
define( '_AEC_LANG_PW', 'Palau' );
define( '_AEC_LANG_PY', 'Paraguay' );
define( '_AEC_LANG_QA', 'Qatar' );
define( '_AEC_LANG_RE', 'Reunion' );
define( '_AEC_LANG_RO', 'Romania' );
define( '_AEC_LANG_RS', 'Serbia' );
define( '_AEC_LANG_RU', 'Russian Federation' );
define( '_AEC_LANG_RW', 'Rwanda' );
define( '_AEC_LANG_SA', 'Saudi Arabia' );
define( '_AEC_LANG_SB', 'Solomon Islands' );
define( '_AEC_LANG_SC', 'Seychelles' );
define( '_AEC_LANG_SD', 'Sudan' );
define( '_AEC_LANG_SE', 'Sweden' );
define( '_AEC_LANG_SG', 'Singapore' );
define( '_AEC_LANG_SH', 'Saint Helena' );
define( '_AEC_LANG_SI', 'Slovenia' );
define( '_AEC_LANG_SJ', 'Svalbard and Jan Mayen' );
define( '_AEC_LANG_SK', 'Slovakia' );
define( '_AEC_LANG_SL', 'Sierra Leone' );
define( '_AEC_LANG_SM', 'San Marino' );
define( '_AEC_LANG_SN', 'Senegal' );
define( '_AEC_LANG_SO', 'Somalia' );
define( '_AEC_LANG_SR', 'Suriname' );
define( '_AEC_LANG_ST', 'Sao Tome and Principe' );
define( '_AEC_LANG_SV', 'El Salvador' );
define( '_AEC_LANG_SY', 'Syrian Arab Republic' );
define( '_AEC_LANG_SZ', 'Swaziland' );
define( '_AEC_LANG_TC', 'Turks and Caicos Islands' );
define( '_AEC_LANG_TD', 'Chad' );
define( '_AEC_LANG_TF', 'French Southern Territories' );
define( '_AEC_LANG_TG', 'Togo' );
define( '_AEC_LANG_TH', 'Thailand' );
define( '_AEC_LANG_TJ', 'Tajikistan' );
define( '_AEC_LANG_TK', 'Tokelau' );
define( '_AEC_LANG_TL', 'Timor-Leste' );
define( '_AEC_LANG_TM', 'Turkmenistan' );
define( '_AEC_LANG_TN', 'Tunisia' );
define( '_AEC_LANG_TO', 'Tonga' );
define( '_AEC_LANG_TR', 'Turkey' );
define( '_AEC_LANG_TT', 'Trinidad and Tobago' );
define( '_AEC_LANG_TV', 'Tuvalu' );
define( '_AEC_LANG_TW', 'Taiwan, Province of Republic of China' );
define( '_AEC_LANG_TZ', 'Tanzania, United Republic of' );
define( '_AEC_LANG_UA', 'Ukraine' );
define( '_AEC_LANG_UG', 'Uganda' );
define( '_AEC_LANG_UM', 'United States Minor Outlying Islands' );
define( '_AEC_LANG_US', 'United States' );
define( '_AEC_LANG_UY', 'Uruguay' );
define( '_AEC_LANG_UZ', 'Uzbekistan' );
define( '_AEC_LANG_VA', 'Holy See (Vatican City State)' );
define( '_AEC_LANG_VC', 'Saint Vincent and the Grenadines' );
define( '_AEC_LANG_VE', 'Venezuela, Bolivarian Republic of' );
define( '_AEC_LANG_VG', 'Virgin Islands, British' );
define( '_AEC_LANG_VI', 'Virgin Islands, U.S.' );
define( '_AEC_LANG_VN', 'Viet Nam' );
define( '_AEC_LANG_VU', 'Vanuatu' );
define( '_AEC_LANG_WF', 'Wallis and Futuna' );
define( '_AEC_LANG_WS', 'Samoa' );
define( '_AEC_LANG_YE', 'Yemen' );
define( '_AEC_LANG_YT', 'Mayotte' );
define( '_AEC_LANG_ZA', 'South Africa' );
define( '_AEC_LANG_ZM', 'Zambia' );
define( '_AEC_LANG_ZW', 'Zimbabwe' );

// --== BACKEND TOOLBAR ==--
define( '_EXPIRE_SET','Set Expiration:');
define( '_EXPIRE_NOW','Expire');
define( '_EXPIRE_EXCLUDE','Exclude');
define( '_EXPIRE_INCLUDE','Include');
define( '_EXPIRE_CLOSE','Close');
define( '_EXPIRE_HOLD','Hold');
define( '_EXPIRE_01MONTH','set 1 Month');
define( '_EXPIRE_03MONTH','set 3 Months');
define( '_EXPIRE_12MONTH','set 12 Months');
define( '_EXPIRE_ADD01MONTH','add 1 Month');
define( '_EXPIRE_ADD03MONTH','add 3 Months');
define( '_EXPIRE_ADD12MONTH','add 12 Months');
define( '_CONFIGURE','Configure');
define( '_REMOVE','Exclude');
define( '_CNAME','Name');
define( '_USERLOGIN','Login');
define( '_EXPIRATION','Expiration');
define( '_USERS','Users');
define( '_DISPLAY','Display');
define( '_NOTSET','Excluded');
define( '_SAVE','Save');
define( '_CANCEL','Cancel');
define( '_EXP_ASC','Expiration Asc');
define( '_EXP_DESC','Expiration Desc');
define( '_NAME_ASC','Name Asc');
define( '_NAME_DESC','Name Desc');
define( '_LASTNAME_ASC','Last Name Asc');
define( '_LASTNAME_DESC','Last Name Desc');
define( '_LOGIN_ASC','Login Asc');
define( '_LOGIN_DESC','Login Desc');
define( '_SIGNUP_ASC','Signup Date Asc');
define( '_SIGNUP_DESC','Signup Date Desc');
define( '_LASTPAY_ASC','Last Payment Asc');
define( '_LASTPAY_DESC','Last Payment Desc');
define( '_PLAN_ASC','Plan Asc');
define( '_PLAN_DESC','Plan Desc');
define( '_STATUS_ASC','Status Asc');
define( '_STATUS_DESC','Status Desc');
define( '_TYPE_ASC','Payment Type Asc');
define( '_TYPE_DESC','Payment Type Desc');
define( '_ORDERING_ASC','Ordering Asc');
define( '_ORDERING_DESC','Ordering Desc');
define( '_ID_ASC','ID Asc');
define( '_ID_DESC','ID Desc');
define( '_CLASSNAME_ASC','Function Name Asc');
define( '_CLASSNAME_DESC','Function Desc');
define( '_ORDER_BY','Order by:');
define( '_SAVED', 'Saved.');
define( '_CANCELED', 'Canceled.');
define( '_CONFIGURED', 'Item configured.');
define( '_REMOVED', 'Item removed from list.');
define( '_EOT_TITLE', 'Closed Subscriptions');
define( '_EOT_DESC', 'This list does not include manually set subscriptions, only Gateway processed. When you delete an entry, the user is removed from the database and all related activity is erased from the history.');
define( '_EOT_DATE', 'End of Term Date');
define( '_EOT_CAUSE', 'Cause');
define( '_EOT_CAUSE_FAIL', 'Payment failure');
define( '_EOT_CAUSE_BUYER', 'Cancelled by user');
define( '_EOT_CAUSE_FORCED', 'Cancelled by administrator');
define( '_REMOVE_CLOSED', 'Delete');
define( '_FORCE_CLOSE', 'Close Now');
define( '_PUBLISH_PAYPLAN', 'Publish');
define( '_UNPUBLISH_PAYPLAN', 'Unpublish');
define( '_NEW_PAYPLAN', 'New');
define( '_COPY_PAYPLAN', 'Copy');
define( '_APPLY_PAYPLAN', 'Apply');
define( '_EDIT_PAYPLAN', 'Edit');
define( '_REMOVE_PAYPLAN', 'Delete');
define( '_SAVE_PAYPLAN', 'Save');
define( '_CANCEL_PAYPLAN', 'Cancel');
define( '_PAYPLANS_TITLE', 'Payment Plans Manager');
define( '_PAYPLANS_MAINDESC', 'Published plans will be options for the user on frontend. These plans are only valid for Gateway payments.');
define( '_PAYPLAN_GROUP', 'Group');
define( '_PAYPLAN_NOGROUP', 'No Group');
define( '_PAYPLAN_NAME', 'Name');
define( '_PAYPLAN_DESC', 'Description (first 50 chars)');
define( '_PAYPLAN_ACTIVE', 'Published');
define( '_PAYPLAN_VISIBLE', 'Visible');
define( '_PAYPLAN_A3', 'Rate');
define( '_PAYPLAN_P3', 'Period');
define( '_PAYPLAN_T3', 'Period Unit');
define( '_PAYPLAN_USERCOUNT', 'Subscribers');
define( '_PAYPLAN_EXPIREDCOUNT', 'Expired');
define( '_PAYPLAN_TOTALCOUNT', 'Total');
define( '_PAYPLAN_REORDER', 'Reorder');
define( '_PAYPLAN_DETAIL', 'Settings');
define( '_ALTERNATIVE_PAYMENT', 'Bank Transfer');
define( '_SUBSCR_DATE', 'Sign Up Date');
define( '_ACTIVE_TITLE', 'Active Subscriptions');
define( '_ACTIVE_DESC', 'This list does not include manually set subscriptions, only Gateway processed.');
define( '_LASTPAY_DATE', 'Last Payment Date');
define( '_USERPLAN', 'Plan');
define( '_CANCELLED_TITLE', 'Cancelled Subscriptions');
define( '_CANCELLED_DESC', 'This list does not include manually set subscriptions, only Gateway processed. These are the subscriptions cancelled by users but that do not reach the end of terms.');
define( '_CANCEL_DATE', 'Cancel Date');
define( '_MANUAL_DESC', 'When you delete an entry, the user is completely removed from databases.');
define( '_REPEND_ACTIVE', 'Re-Pend');
define( '_FILTER_PLAN', '- Select Plan -');
define( '_BIND_USER', 'Assign To:');
define( '_PLAN_FILTER','Filter by Plan:');
define( '_CENTRAL_PAGE','Central');

// --== USER FORM ==--
define( '_HISTORY_COL_INVOICE', 'Invoice');
define( '_HISTORY_COL_AMOUNT', 'Amount');
define( '_HISTORY_COL_DATE', 'Payment Date');
define( '_HISTORY_COL_METHOD', 'Method');
define( '_HISTORY_COL_ACTION', 'Action');
define( '_HISTORY_COL_PLAN', 'Plan');
define( '_USERINVOICE_ACTION_REPEAT','repeat&nbsp;Link');
define( '_USERINVOICE_ACTION_CANCEL','cancel');
define( '_USERINVOICE_ACTION_CLEAR','mark&nbsp;cleared');
define( '_USERINVOICE_ACTION_CLEAR_APPLY','clear&nbsp;&amp;&nbsp;apply&nbsp;Plan');

// --== BACKEND SETTINGS ==--

// TAB 1 - Global AEC Settings
define( '_CFG_TAB1_TITLE', 'Global');
define( '_CFG_TAB1_SUBTITLE', 'General Configuration');

define( '_CFG_GENERAL_SUB_ACCESS', 'Access');
define( '_CFG_GENERAL_SUB_SYSTEM', 'System');
define( '_CFG_GENERAL_SUB_EMAIL', 'Email');
define( '_CFG_GENERAL_SUB_DEBUG', 'Debug');
define( '_CFG_GENERAL_SUB_REGFLOW', 'Registration Flow');
define( '_CFG_GENERAL_SUB_PLANS', 'Subscription Plans');
define( '_CFG_GENERAL_SUB_CONFIRMATION', 'Confirmation Page');
define( '_CFG_GENERAL_SUB_CHECKOUT', 'Checkout Page');
define( '_CFG_GENERAL_SUB_PROCESSORS', 'Payment Processors');
define( '_CFG_GENERAL_SUB_SECURITY', 'Security');

define( '_CFG_GENERAL_ALERTLEVEL2_NAME', 'Alert Level 2:');
define( '_CFG_GENERAL_ALERTLEVEL2_DESC', 'In days. This is the first threshold to start warning user that his subscription is about to expire. <strong>This does not send out an email!</strong>');
define( '_CFG_GENERAL_ALERTLEVEL1_NAME', 'Alert Level 1:');
define( '_CFG_GENERAL_ALERTLEVEL1_DESC', 'In days. This is the final threshold to alert user that his subscription is about to expire. This should be the closest interval to expiration. <strong>This does not send out an email!</strong>');
define( '_CFG_GENERAL_ENTRY_PLAN_NAME', 'Grant Entry Plan:');
define( '_CFG_GENERAL_ENTRY_PLAN_DESC', 'Every user will be subscribed to this plan (no payment!) when the user has no subscription yet');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_NAME', 'Require Subscription:');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_DESC', 'When enabled, a user MUST have a subscription. If disabled, users will be able to log in without one.');

define( '_CFG_GENERAL_GWLIST_NAME', 'Gateway Descriptions:');
define( '_CFG_GENERAL_GWLIST_DESC', 'List the Gateways you want to explain on the NotAllowed page (which your customers see when trying to access a page that they are not allowed to by their payment plan).');
define( '_CFG_GENERAL_GWLIST_ENABLED_NAME', 'Activated Gateways:');
define( '_CFG_GENERAL_GWLIST_ENABLED_DESC', 'Select the gateways you want to be activated (use the CTRL key to select more than one). After saving, the settings tabs for these gateways will show up. Deactivating a gateway will not erase its settings.');

define( '_CFG_GENERAL_BYPASSINTEGRATION_NAME', 'Disable Integration:');
define( '_CFG_GENERAL_BYPASSINTEGRATION_DESC', 'Provide one name or a list of names (seperated by a whitespace) of integrations that you want to have disabled. Currently supporting the strings: <strong>CB,CBE,CBM,JACL,SMF,UE,UHP2,VM</strong>. This can be helpful when you have uninstalled CB but not deleted its tables (in which case the AEC would still recognize it as being installed).');
define( '_CFG_GENERAL_SIMPLEURLS_NAME', 'Simple URLs:');
define( '_CFG_GENERAL_SIMPLEURLS_DESC', 'Disable the use of Joomla/Mambo SEF Routines for Urls. With some setups using these will result in 404 Errors due to wrong rewriting. Try this option if you encounter any problems with redirects.');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_NAME', 'Expiration Cushion:');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_DESC', 'Number of hours that the AEC takes as cushion when determining expiration. Take a generous amount since payments arive later than the actual expiration (with Paypal about 6-8 hours later).');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_NAME', 'Heartbeat Cycle:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_DESC', 'Number of hours that the AEC waits until understanding a login as a trigger for sending out Emails or doing other actions that you chose to be performed periodically.');
define( '_CFG_GENERAL_ROOT_GROUP_NAME', 'Root Group:');
define( '_CFG_GENERAL_ROOT_GROUP_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page without any preset variable.');
define( '_CFG_GENERAL_ROOT_GROUP_RW_NAME', 'Root Group ReWrite:');
define( '_CFG_GENERAL_ROOT_GROUP_RW_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page by returning a group number or an array of groups with the ReWriteEngine functionality. This will fall back to the general option (above) if the results are empty.');
define( '_CFG_GENERAL_PLANS_FIRST_NAME', 'Plans First:');
define( '_CFG_GENERAL_PLANS_FIRST_DESC', 'If you have commited all three hacks to have an integrated Registration with direct Subscription, this switch will activate this behavior. Don\'t use it if you don\'t want that behavior or only commited the first hack (which means that the plans come after the user has put in his or her details) .');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_NAME', 'Integrate Registration');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_DESC', 'With this switch, you can make the AEC Mambot/Plugin intercept registration calls and redirect them into the AEC subscription system. Having this option disabled means that the users would freely register and, if a subscription is required, subscribe on their first login. If both this option and "require subscription" are disabled, subscription is completely voluntary.');

define( '_CFG_TAB_CUSTOMIZATION_TITLE', 'Customize');
define( '_CFG_TAB_CUSTOMIZATION_SUBTITLE', 'Customization');

define( '_CFG_CUSTOMIZATION_SUB_CREDIRECT', 'Custom Redirects');
define( '_CFG_CUSTOMIZATION_SUB_PROXY', 'Proxy');
define( '_CFG_CUSTOMIZATION_SUB_BUTTONS_SUB', 'Subscribed Member Buttons');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_DATE', 'Date Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_PRICE', 'Price Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_INUM', 'Invoice Number Format');
define( '_CFG_CUSTOMIZATION_SUB_CAPTCHA', 'ReCAPTACHA');

define( '_CFG_GENERAL_CUSTOMINTRO_NAME', 'Custom intro page link:');
define( '_CFG_GENERAL_CUSTOMINTRO_DESC', 'Provide a full link (including http://) that leads to your custom intro page. That page has to contain a link like this: http://www.yourdomain.com/index.php?option=com_acctexp&task=subscribe&intro=1 which bypasses the intro and correctly forwards the user to the payment plans or registration details page. Leave this field blank if you don\'t want this at all.');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_NAME', 'Pass Userid');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_DESC', 'Pass Userid via a Joomla notification. This can be helpful for flexible custom signup pages that need to function even if the user is not logged in. You can use Javascript to modify your signup links according to the passed userid.');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_NAME', 'Always Show Intro');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_DESC', 'Display the Intro regardless of whether the user is already registered.');
define( '_CFG_GENERAL_CUSTOMTHANKS_NAME', 'Custom thanks page link:');
define( '_CFG_GENERAL_CUSTOMTHANKS_DESC', 'Provide a full link (including http://) that leads to your custom thanks page. Leave this field blank if you don\'t want this at all.');
define( '_CFG_GENERAL_CUSTOMCANCEL_NAME', 'Custom cancel page link:');
define( '_CFG_GENERAL_CUSTOMCANCEL_DESC', 'Provide a full link (including http://) that leads to your custom cancel page. Leave this field blank if you don\'t want this at all.');
define( '_CFG_GENERAL_TOS_NAME', 'Terms of Service:');
define( '_CFG_GENERAL_TOS_DESC', 'Enter a URL to your Terms of Service. The user will have to select a checkbox when confirming his account. If left blank, nothing will show up.');
define( '_CFG_GENERAL_TOS_IFRAME_NAME', 'ToS Iframe:');
define( '_CFG_GENERAL_TOS_IFRAME_DESC', 'Display the Terms of Service (as specified above) in an iframe on confirmation');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_NAME', 'Custom NotAllowed link:');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_DESC', 'Provide a full link (including http://) that leads to your custom NotAllowed page. Leave this field blank if you don\'t want this at all.');

define( '_CFG_CUSTOMIZATION_INVOICE_PRINTOUT', 'Invoice Printout');
define( '_CFG_CUSTOMIZATION_INVOICE_PRINTOUT_DETAILS', 'Invoice Printout Details');

define( '_CFG_TAB_CUSTOMINVOICE_TITLE', 'Invoice Customization');
define( '_CFG_TAB_CUSTOMINVOICE_SUBTITLE', 'Invoice Customization');
define( '_CFG_TAB_CUSTOMPAGES_TITLE', 'Page Customization');
define( '_CFG_TAB_CUSTOMPAGES_SUBTITLE', 'Page Customization');
define( '_CFG_TAB_EXPERT_TITLE', 'Expert');
define( '_CFG_TAB_EXPERT_SUBTITLE', 'Expert Settings');

define( '_AEC_CUSTOM_INVOICE_PAGE_TITLE', 'Invoice');
define( '_AEC_CUSTOM_INVOICE_HEADER', 'Invoice');
define( '_AEC_CUSTOM_INVOICE_BEFORE_CONTENT', 'Invoice/Receipt for:');
define( '_AEC_CUSTOM_INVOICE_AFTER_CONTENT', 'Thank you very much for choosing our service!');
define( '_AEC_CUSTOM_INVOICE_FOOTER', ' - Add your company information here - ');

define( '_CFG_GENERAL_INVOICE_PAGE_TITLE', 'Invoice');
define( '_CFG_GENERAL_INVOICE_PAGE_TITLE_NAME', 'Page Title');
define( '_CFG_GENERAL_INVOICE_PAGE_TITLE_DESC', 'Page Title for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_HEADER_NAME', 'Invoice Header');
define( '_CFG_GENERAL_INVOICE_HEADER_DESC', 'Header Text for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_AFTER_HEADER_NAME', 'Invoice After Header');
define( '_CFG_GENERAL_INVOICE_AFTER_HEADER_DESC', 'Text after Header for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_ADDRESS_NAME', 'Invoice Address Field');
define( '_CFG_GENERAL_INVOICE_ADDRESS_DESC', 'Text in the Address Field of the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_ADDRESS_ALLOW_EDIT_NAME', 'Allow User Editing');
define( '_CFG_GENERAL_INVOICE_ADDRESS_ALLOW_EDIT_DESC', 'This gives your users the opportunity to edit the address field right on the printout.');
define( '_CFG_GENERAL_INVOICE_BEFORE_CONTENT_NAME', 'Invoice Before Content');
define( '_CFG_GENERAL_INVOICE_BEFORE_CONTENT_DESC', 'Text before Invoice Content for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_AFTER_CONTENT_NAME', 'Invoice After Content');
define( '_CFG_GENERAL_INVOICE_AFTER_CONTENT_DESC', 'Text after Invoice Content for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_BEFORE_FOOTER_NAME', 'Invoice Before Footer');
define( '_CFG_GENERAL_INVOICE_BEFORE_FOOTER_DESC', 'Text before Footer for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_FOOTER_NAME', 'Invoice Footer');
define( '_CFG_GENERAL_INVOICE_FOOTER_DESC', 'Footer Text for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_AFTER_FOOTER_NAME', 'Invoice After Footer');
define( '_CFG_GENERAL_INVOICE_AFTER_FOOTER_DESC', 'Text after Footer for the Invoice Printout');

define( '_CFG_GENERAL_CHECKOUT_DISPLAY_DESCRIPTIONS_NAME', 'Display Descriptions:');
define( '_CFG_GENERAL_CHECKOUT_DISPLAY_DESCRIPTIONS_DESC', 'If you have multiple plans on checkout, or skipped the confirmation, it might be helpful to show the plan description again. This switch does just that.');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_NAME', 'Allow Gift Checkout:');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_DESC', 'With this option, users can gift a checkout to another user - all the plans and attached functionality is then carried out on the recipients user account.');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_ACCESS_NAME', 'Gifts Access:');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_ACCESS_DESC', 'What user group is required (minimum) to can make a checkout into a gift?');
define( '_CFG_GENERAL_CONFIRM_AS_GIFT_NAME', 'Allow Gift on Confirmation:');
define( '_CFG_GENERAL_CONFIRM_AS_GIFT_DESC', 'Offer the same gift option on the confirmation page as well.');

define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_NAME', 'Frontend Date Format');
define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_DESC', 'Specify the way a date is displayed on the frontend. Refer to <a href="http://www.php.net/manual/en/function.strftime.php">the php manual</a> for the correct syntax.');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_NAME', 'Backend Date Format');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_DESC', 'Specify the way a date is displayed on the backend. Refer to <a href="http://www.php.net/manual/en/function.strftime.php">the php manual</a> for the correct syntax.');

define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_NAME', 'Format Invoice Number');
define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_DESC', 'Display a formatted string instead of the original InvoiceNumber to the user. Must provide a formatting rule below.');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_NAME', 'Formatting');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_DESC', 'The Formatting - You can use the RewriteEngine as specified below');

define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_NAME', 'Custom Text Plans Page');
define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_DESC', 'Text that will be displayed on the Plans Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_NAME', 'Custom Text Confirm Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_DESC', 'Text that will be displayed on the Confirmation Page');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_NAME', 'Custom Text Confirm Userdetails');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_DESC', 'Customize what the Userdetails field will show on Confirmation');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_NAME', 'Custom Text Checkout Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_DESC', 'Text that will be displayed on the Checkout Page');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_NAME', 'Custom Text NotAllowed Page');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_DESC', 'Text that will be displayed on the NotAllowed Page');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_NAME', 'Custom Text Pending Page');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_DESC', 'Text that will be displayed on the Pending Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_NAME', 'Custom Text Expired Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_DESC', 'Text that will be displayed on the Expired Page');

define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Confirmation Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Checkout Page');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the NotAllowed Page');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Pending Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Expired Page');

define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the ThankYou Page');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_NAME', 'Custom Text ThankYou Page');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Text that will be displayed on the ThankYou Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Cancel Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_NAME', 'Custom Text Cancel Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_DESC', 'Text that will be displayed on the Cancel Page');

define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Hold Page');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_NAME', 'Custom Text Hold Page');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_DESC', 'Text that will be displayed on the Hold Page');

define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Exception Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_NAME', 'Custom Text Exception Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_DESC', 'Text that will be displayed on the Exception Page (typically showing up when a user has to specify which payment processor to use for a shopping cart, or what item a coupon should be applied to).');

define( '_CFG_GENERAL_USE_RECAPTCHA_NAME', 'Use ReCAPTCHA');
define( '_CFG_GENERAL_USE_RECAPTCHA_DESC', 'If you have an account for <a href="http://recaptcha.net/">ReCAPTCHA</a>, you can activate this option. Do NOT forget to put in the keys below.');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_NAME', 'Private ReCAPTCHA Key');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_DESC', 'Your Private ReCAPTCHA Key.');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_NAME', 'Public ReCAPTCHA Key');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_DESC', 'Your Public ReCAPTCHA Key.');

define( '_CFG_GENERAL_TEMP_AUTH_EXP_NAME', 'Logged-out Invoice Access');
define( '_CFG_GENERAL_TEMP_AUTH_EXP_DESC', 'The time (in minutes) that a user is able to access an invoice only by referencing the userid. When that period expires, a password is prompted before allowing access for the same period again.');

define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_NAME', 'Heartbeat Cycle Backend:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_DESC', 'Number of hours that the AEC waits until understanding a backend access as heartbeat trigger.');
define( '_CFG_GENERAL_ENABLE_COUPONS_NAME', 'Enable Coupons:');
define( '_CFG_GENERAL_ENABLE_COUPONS_DESC', 'Enable the usage of coupons for your subscriptions.');
define( '_CFG_GENERAL_DISPLAYCCINFO_NAME', 'Enable CC Display:');
define( '_CFG_GENERAL_DISPLAYCCINFO_DESC', 'Enable the display of CreditCard icons for each payment processor.');
define( '_CFG_GENERAL_ADMINACCESS_NAME', 'Administrator Access:');
define( '_CFG_GENERAL_ADMINACCESS_DESC', 'Grant Access to the AEC not only to Super Administrators, but regular Administrators as well.');
define( '_CFG_GENERAL_NOEMAILS_NAME', 'No Emails');
define( '_CFG_GENERAL_NOEMAILS_DESC', 'Set this to prevent AEC System Emails (to the user in events of invoices paid or alike) from being sent out. This does not affect emails being sent from MicroIntegrations.');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_NAME', 'No Joomla Emails');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_DESC', 'Set this to prevent Joomla Registration Confirmation emails from being sent out.');
define( '_CFG_GENERAL_DEBUGMODE_NAME', 'Debug Mode');
define( '_CFG_GENERAL_DEBUGMODE_DESC', 'Activates the display of debug information.');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_NAME', 'Override SSL Requirement');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_DESC', 'Some payment processors require an SSL secured connection to the user - for example when sensitive information (like CreditCard data) is required on the frontend.');
define( '_CFG_GENERAL_ALTSSLURL_NAME', 'Alternative SSL Url');
define( '_CFG_GENERAL_ALTSSLURL_DESC', 'Use this URL instead of the base url that is configured in Joomla! when routing through SSL.');
define( '_CFG_GENERAL_OVERRIDEJ15_NAME', 'Override Joomla 1.5 Integration');
define( '_CFG_GENERAL_OVERRIDEJ15_DESC', 'Some Addons trick a 1.0 Joomla into believing it really is 1.5 (you know who you are! stop it!) - which AEC follows and fails. This makes a permanent switch forcing 1.0 mode.');
define( '_CFG_GENERAL_SSL_SIGNUP_NAME', 'SSL Signup');
define( '_CFG_GENERAL_SSL_SIGNUP_DESC', 'Use SSL Encryption on all links that have to do with the user singing up within the AEC.');
define( '_CFG_GENERAL_SSL_PROFILE_NAME', 'SSL Profile');
define( '_CFG_GENERAL_SSL_PROFILE_DESC', 'Use SSL Encryption on all links that have to do with the user accessing the profile (MySubscription page).');
define( '_CFG_GENERAL_SSL_VERIFYPEER_NAME', 'SSL Peer Verification');
define( '_CFG_GENERAL_SSL_VERIFYPEER_DESC', 'When using cURL, make it verify the peer\'s certificate. Alternate certificates to verify against can be specified with the options below');
define( '_CFG_GENERAL_SSL_VERIFYHOST_NAME', 'SSL Host Verification');
define( '_CFG_GENERAL_SSL_VERIFYHOST_DESC', 'Defines what kind of verification against the peer\'s certificate you want.');
define( '_CFG_GENERAL_SSL_CAINFO_NAME', 'Certificate File');
define( '_CFG_GENERAL_SSL_CAINFO_DESC', 'The name of a file holding one or more certificates to verify the peer with. This only makes sense when used in combination with Peer Verification.');
define( '_CFG_GENERAL_SSL_CAPATH_NAME', 'Certificate Directory');
define( '_CFG_GENERAL_SSL_CAPATH_DESC', 'A directory that holds multiple CA certificates. Use this option alongside Peer Verification.');
define( '_CFG_GENERAL_USE_PROXY_NAME', 'Use Proxy');
define( '_CFG_GENERAL_USE_PROXY_DESC', 'Use a proxy server for all outgoing requests.');
define( '_CFG_GENERAL_PROXY_NAME', 'Proxy Address');
define( '_CFG_GENERAL_PROXY_DESC', 'Specify the proxy server that you want to connect to.');
define( '_CFG_GENERAL_PROXY_PORT_NAME', 'Proxy Port');
define( '_CFG_GENERAL_PROXY_PORT_DESC', 'Specify the proxy server port that you want to connect to.');
define( '_CFG_GENERAL_PROXY_USERNAME_NAME', 'Proxy Username');
define( '_CFG_GENERAL_PROXY_USERNAME_DESC', 'If your proxy needs a custom login, put the username here.');
define( '_CFG_GENERAL_PROXY_PASSWORD_NAME', 'Proxy Password');
define( '_CFG_GENERAL_PROXY_PASSWORD_DESC', 'If your proxy needs a custom login, put the password here.');
define( '_CFG_GENERAL_GETHOSTBYADDR_NAME', 'Log Host with IP');
define( '_CFG_GENERAL_GETHOSTBYADDR_DESC', 'On logging Events that store an IP address, this option will also store the internet host name as well. In some hosting situations, this can take over a minute and thus should be disabled.');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_NAME', 'No Renew Button');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_DESC', 'Select "Yes" to never show the renew/upgrade button on the MySubscription page.');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_NAME', 'Restricted Renew Button');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_DESC', 'Only show the renew button if it makes sense in a one-subscription setup (recurring payments or a lifetime make the button disappear).');
define( '_CFG_GENERAL_CONTINUE_BUTTON_NAME', 'Continue Button');
define( '_CFG_GENERAL_CONTINUE_BUTTON_DESC', 'If the user has had a membership before, this button will show up on the expiration screen and link directly to the previous plan, so that the user is quicker to continue the membership as it was before');

define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_NAME', 'Notification Level');
define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_DESC', 'Select which level of entries to the EventLog is required to make it appear on the central page for your convenience.');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_NAME', 'Email Notification Level');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_DESC', 'Select which level of entries to the EventLog is required to make the AEC send them as an E-Mail to all Administrators.');

define( '_CFG_GENERAL_SKIP_CONFIRMATION_NAME', 'Skip Confirmation');
define( '_CFG_GENERAL_SKIP_CONFIRMATION_DESC', 'Do not display a Confirmation screen before checkout (which lets the user revisit the current decision).');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_NAME', 'Show Fixed Decisions');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_DESC', 'The AEC normally skips the payment plans page if there is no decision to be made (one payment plan with only one processor). With this option, you can force it to display the page.');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_NAME', 'Coupons on Confirmation');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_DESC', 'Offer to provide coupon codes when clicking the Confirm Button on the Confirmation page');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_NAME', 'Break on MI Error');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_DESC', 'Stop plan application if one of its attached MIs encounters an error (there will be trace in the eventlog either way)');

define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_NAME', 'Enable Shopping Cart');
define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_DESC', 'Handle purchases via shopping cart. Available only for logged-in users.');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_NAME', 'Custom Continue Shopping Link');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_DESC', 'Instead of routing a user to the standard subscription page, route here.');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_NAME', 'Stay on Page');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_DESC', 'Instead of moving to the shopping cart after selecting an item, stay on the same page.');

define( '_CFG_GENERAL_CURL_DEFAULT_NAME', 'Use cURL');
define( '_CFG_GENERAL_CURL_DEFAULT_DESC', 'Use cURL instead of fsockopen as default (will fall back to the other one if the first choice fails)');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_NAME', 'Currency Symbol');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_DESC', 'Display a currency symbol (if one exists) instead of the ISO abbreviation');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_NAME', 'Currency first');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_DESC', 'Display the currency in front of the amount');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_NAME', 'Use Comma');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_DESC', 'Use a comma instead of a dot in amounts');
define( '_CFG_GENERAL_ALLOW_FRONTEND_HEARTBEAT_NAME', 'Allow Custom Frontend Heartbeat');
define( '_CFG_GENERAL_ALLOW_FRONTEND_HEARTBEAT_DESC', 'Trigger a custom heartbeat from the frontend (via the link index.php?option=com_acctexp&task=heartbeat) - for example with a Cronjob');
define( '_CFG_GENERAL_DISABLE_REGULAR_HEARTBEAT_NAME', 'Disable Automatic Heartbeat');
define( '_CFG_GENERAL_DISABLE_REGULAR_HEARTBEAT_DESC', 'If you only want to trigger custom heartbeats, you can disable the automatic ones here.');
define( '_CFG_GENERAL_CUSTOM_HEARTBEAT_SECUREHASH_NAME', 'Custom Frontend Heartbeat Securehash');
define( '_CFG_GENERAL_CUSTOM_HEARTBEAT_SECUREHASH_DESC', 'A code that has to be passed on custom Frontend Heartbeat (with the option &hash=YOURHASHCODE) - if one is set, but not passed, the AEC will not trigger the heartbeat.');
define( '_CFG_GENERAL_QUICKSEARCH_TOP_NAME', 'Quicksearch on top');
define( '_CFG_GENERAL_QUICKSEARCH_TOP_DESC', 'This is the setting for all you quicksearch junkies - it will switch it to be above the main icons on the central page');

define( '_CFG_GENERAL_SUB_UNINSTALL', 'Uninstall');
define( '_CFG_GENERAL_DELETE_TABLES_NAME', 'Delete Tables');
define( '_CFG_GENERAL_DELETE_TABLES_DESC', 'Do you want to delete the AEC tables when uninstalling the software?');
define( '_CFG_GENERAL_DELETE_TABLES_SURE_NAME', 'Really?');
define( '_CFG_GENERAL_DELETE_TABLES_SURE_DESC', 'Security switch - when deleting the AEC tables, ALL YOUR MEMBERSHIP DATA WILL BE GONE!');
define( '_CFG_GENERAL_STANDARD_CURRENCY_NAME', 'Standard Currency');
define( '_CFG_GENERAL_STANDARD_CURRENCY_DESC', 'Which currency should the AEC use if no information is available (for example, if a plan is free, it will have no processor attached to it and get its currency information from here)');

define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSERNAME_NAME', 'Option: Change Username');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSERNAME_DESC', 'Give new users the possibility to go back to the registration screen from confirmation (in case they made an error)');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSAGE_NAME', 'Option: Change Item');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSAGE_DESC', 'Give new users the possibility to go back to the plan selection screen from confirmation (in case they made an error)');

define( '_CFG_GENERAL_MANAGERACCESS_NAME', 'Manager Access:');
define( '_CFG_GENERAL_MANAGERACCESS_DESC', 'Grant Access to the AEC not only to Administrators, but to Managers as well.');
define( '_CFG_GENERAL_PER_PLAN_MIS_NAME', 'Per Plan MIs:');
define( '_CFG_GENERAL_PER_PLAN_MIS_DESC', 'Shows per-plan MIs that are only editable from within payment plans and are only attached to the one plan they were created in.');
define( '_CFG_GENERAL_INTRO_EXPIRED_NAME', 'Intro for Expired');
define( '_CFG_GENERAL_INTRO_EXPIRED_DESC', 'AEC normally does not show the intro page (which you may or may not have set) when users whose subscriptions have expired want to sign up for a new one. This setting overrides the behavior.');

define( '_CFG_GENERAL_INVOICE_CUSHION_NAME', 'Invoice Cushion');
define( '_CFG_GENERAL_INVOICE_CUSHION_DESC', 'The cushion period in which AEC does not accept new notifications for an invoice that was already paid.');

// Global Authentication Settins
define( '_CFG_TAB_AUTHENTICATION_TITLE', 'Authentication');
define( '_CFG_TAB_AUTHENTICATION_SUBTITLE', 'Authentication Plugins');
define( '_CFG_AUTH_AUTHLIST_NAME', 'Active Authentication Plugins');
define( '_CFG_AUTH_AUTHLIST_DESC', 'Select which Authentication (as in: at least one of them has to be successful for the login to pass) Plugins will be used. AECaeccss Plugin must be the only Authentication Plugin enabled in the Joomla Plugin Manager.');
define( '_CFG_AUTH_AUTHORIZATION_LIST_NAME', 'Active Authorization Plugins');
define( '_CFG_AUTH_AUTHORIZATION_LIST_DESC', 'Select which Authorization (as in: all of them have to be successful for the login to pass) Plugins will be used. AECaeccss Plugin must be the only Authentication Plugin enabled in the Joomla Plugin Manager.');

//Invoice settings
define( '_CFG_GENERAL_SENDINVOICE_NAME', 'Send an invoice email');
define( '_CFG_GENERAL_SENDINVOICE_DESC', 'Send and invoice/purchase order email (for tax reasons)');
define( '_CFG_GENERAL_INVOICETMPL_NAME', 'Invoice Template');
define( '_CFG_GENERAL_INVOICETMPL_DESC', 'Template for invoices/purchase orders');

// --== Processors PAGE ==--

define( '_PROCESSORS_TITLE', 'Processors');
define( '_PROCESSOR_NAME', 'Name');
define( '_PROCESSOR_DESC', 'Description (first 50 chars)');
define( '_PROCESSOR_ACTIVE', 'Published');
define( '_PROCESSOR_VISIBLE', 'Visible');
define( '_PROCESSOR_REORDER', 'Reorder');
define( '_PROCESSOR_INFO', 'Information');

define( '_PUBLISH_PROCESSOR', 'Publish');
define( '_UNPUBLISH_PROCESSOR', 'Unpublish');
define( '_NEW_PROCESSOR', 'New');
define( '_COPY_PROCESSOR', 'Copy');
define( '_APPLY_PROCESSOR', 'Apply');
define( '_EDIT_PROCESSOR', 'Edit');
define( '_REMOVE_PROCESSOR', 'Delete');
define( '_SAVE_PROCESSOR', 'Save');
define( '_CANCEL_PROCESSOR', 'Cancel');

define( '_PP_GENERAL_PROCESSOR_NAME', 'Payment Processor');
define( '_PP_GENERAL_PROCESSOR_DESC', 'Select which payment processor you want to use.');
define( '_PP_GENERAL_ACTIVE_NAME', 'Active');
define( '_PP_GENERAL_ACTIVE_DESC', 'Select whether this processor is currently active (and thus can carry out its function and be available to your users)');
define( '_PP_GENERAL_PLEASE_NOTE', 'Please note');
define( '_PP_GENERAL_EXPERIMENTAL', 'This payment processor is still not 100% complete - it has either been added to the codebase very recently (and is thus not fully tested) or was partly abandoned due to a customer suddenly not being interested in having us finish it anymore. If you want to use it, we would be very thankful for any kind of helping hand you can give us - either with further information on the integration, with bugreports or fixes, or with sponsorship.');

// --== PAYMENT PLAN PAGE ==--

define( '_PAYPLAN_PERUNIT1', 'Days');
define( '_PAYPLAN_PERUNIT2', 'Weeks');
define( '_PAYPLAN_PERUNIT3', 'Months');
define( '_PAYPLAN_PERUNIT4', 'Years');

// General Params

define( '_PAYPLAN_DETAIL_TITLE', 'Plan');
define( '_PAYPLAN_GENERAL_NAME_NAME', 'Name:');
define( '_PAYPLAN_GENERAL_NAME_DESC', 'Name or title for this plan. Max.: 40 characters.');
define( '_PAYPLAN_GENERAL_DESC_NAME', 'Description:');
define( '_PAYPLAN_GENERAL_DESC_DESC', 'Full description of plan as you want to be presented to user. Max.: 255 characters.');
define( '_PAYPLAN_GENERAL_ACTIVE_NAME', 'Published:');
define( '_PAYPLAN_GENERAL_ACTIVE_DESC', 'A published plan will be available to the user on frontend.');
define( '_PAYPLAN_GENERAL_VISIBLE_NAME', 'Visible:');
define( '_PAYPLAN_GENERAL_VISIBLE_DESC', 'Visible Plans will show on the frontend. Invisible plans will not show and thus only be available to automatic application (like Fallbacks or Entry Plans).');

define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_NAME', 'Custom amount formatting:');
define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_DESC', 'Please use a aecJSON string like the one already filled in to modify how the cost of this plan are displayed.');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_NAME', 'Custom thanks page link:');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_DESC', 'Provide a full link (including http://) that leads to your custom thanks page. Leave this field blank if you don\'t want this at all.');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the ThankYou Page');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_NAME', 'Custom Text ThankYou Page');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Text that will be displayed on the ThankYou Page');

define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_NAME', 'Override Activation');
define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_DESC', 'Override the requirement for a user to activate the account (via email activation code) in case this payment plan is used with a registration.');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_NAME', 'Override Registration Email');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_DESC', 'Do not send out any Registration Email (makes sense for paid plans which do not need activation and where an email would be sent out when the payment arrives - with the email MI).');

define( '_PAYPLAN_PARAMS_GID_ENABLED_NAME', 'Enable usergroup');
define( '_PAYPLAN_PARAMS_GID_ENABLED_DESC', 'Switch this to Yes if you want users to be assigned the selected usergroup.');
define( '_PAYPLAN_PARAMS_GID_NAME', 'Add User to Group:');
define( '_PAYPLAN_PARAMS_GID_DESC', 'Users will be associated to this usergroup when the plan is applied.');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_NAME', 'Make Active:');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_DESC', 'Set this to >No< if you want to manually activate a user after he or she has paid.');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_NAME', 'Primary:');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_DESC', 'Set this to "yes" to make this the primary subscription plan for the user. The primary subscription is the one which governs overal site expiration.');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_NAME', 'Update Existing:');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_DESC', 'If not a primary plan, should this plan update other existing non-primary subscriptions of the user? This can be helpful for secondary subscriptions of which the user should have only one at a time.');

define( '_PAYPLAN_TEXT_TITLE', 'Plan Text');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_NAME', 'Email Description:');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_DESC', 'Text that should be added into the email that the user receives when a plan is activated for him');
define( '_PAYPLAN_GENERAL_FALLBACK_NAME', 'Plan Fallback:');
define( '_PAYPLAN_GENERAL_FALLBACK_DESC', 'When a user subscription expires - make them a member of the following plan');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_NAME', 'Standard Parent Plan');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_DESC', 'Currently assigns this plan as the users root membership in case he or she signs up only for a secondary plan.');

define( '_PAYPLAN_GENERAL_PROCESSORS_NAME', 'Payment Gateways:');
define( '_PAYPLAN_NOPLAN', 'No Plan');
define( '_PAYPLAN_NOGW', 'No Gateway');
define( '_PAYPLAN_GENERAL_PROCESSORS_DESC', 'Select the payment gateways you want to be available to this plan. Hold Control or Shift key to select multiple options. Selecting ' . _PAYPLAN_NOPLAN . ' all other selected options will be ignored. If you see only ' . _PAYPLAN_NOPLAN . ' here this means you have no payment processor enabled on your config settings.');
define( '_PAYPLAN_PARAMS_LIFETIME_NAME', 'Lifetime:');
define( '_PAYPLAN_PARAMS_LIFETIME_DESC', 'Make this a lifetime subscription which never expires.');

define( '_PAYPLAN_AMOUNT_NOTICE', 'Notice on Periods');
define( '_PAYPLAN_AMOUNT_NOTICE_TEXT', 'For Paypal Subscriptions, there is a limit on the maximum amount of that you can enter for the period. If you want to use Paypal Subscriptions, <strong>please limit days to 90, weeks to 52, months to 24 and years to 5 at maximum</strong>.');
define( '_PAYPLAN_AMOUNT_EDITABLE_NOTICE', 'There is one or more users using recurring payments for this plan, so it would be wise not to change the terms until these are cancelled.');

define( '_PAYPLAN_REGULAR_TITLE', 'Normal Subscription');
define( '_PAYPLAN_PARAMS_FULL_FREE_NAME', 'Free:');
define( '_PAYPLAN_PARAMS_FULL_FREE_DESC', 'Set this to yes if you want to offer this plan for free');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_NAME', 'Regular Rate:');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_DESC', 'The price of the subscription. If there are subscribers to this plan this field can not be changed. If you want to replace this plan, unpublish it and create a new one.');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_NAME', 'Period:');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_DESC', 'This is the length of the billing cycle. The number is modified by the regular billing cycle unit (below).  If there are subscribers to this plan this field can not be changed. If you want to replace this plan, unpublish it and create a new one.');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_NAME', 'Period Unit:');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_DESC', 'This is the units of the regular billing cycle (above). If there are subscribers to this plan this field can not be changed. If you want to replace this plan, unpublish it and create a new one.');

define( '_PAYPLAN_TRIAL_TITLE', 'Trial Period');
define( '_PAYPLAN_TRIAL', '(Optional)');
define( '_PAYPLAN_TRIAL_DESC', 'Skip this section if you do not want to offer Trial periods with your subscriptions. <strong>Trials only work automatically with PayPal Subscriptions!</strong>');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_NAME', 'Free:');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_DESC', 'Set this to yes if you want to offer this trial for free');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_NAME', 'Trial Rate:');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_DESC', 'Enter the amount to immediately bill the subscriber.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_NAME', 'Trial Period:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_DESC', 'This is the length of the trial period. The number is modified by the relugar billing cycle unit (below).  If there are subscribers to this plan this field can not be changed. If you want to replace this plan, unpublish it and create a new one.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_NAME', 'Trial Period Unit:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_DESC', 'This is the units of the trial period (above). If there are subscribers to this plan this field can not be changed. If you want to replace this plan, unpublish it and create a new one.');

define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');

// Payplan Relations

define( '_PAYPLAN_RELATIONS_TITLE', 'Relations');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_NAME', 'Similar Plans:');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_DESC', 'Select which plans are similar to this one. A user is not allowed to use a Trial period when buying a plan that he or she has purchased before and this will also be the same for similar plans.');
define( '_PAYPLAN_PARAMS_EQUALPLANS_NAME', 'Equal Plans:');
define( '_PAYPLAN_PARAMS_EQUALPLANS_DESC', 'Select which plans are equal to this one. A user switching between equal plans will have his or her period extended instead of reset. Trials are also not permitted (see similar plans info).');

// Payplan Restrictions

define( '_PAYPLAN_RESTRICTIONS_TITLE', 'Restrictions');

define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_NAME', 'Enable Min GID:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user is shown this plan by a minimum usergroup.');
define( '_PAYPLAN_RESTRICTIONS_MINGID_NAME', 'Visibility Group:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_DESC', 'The minimum user level required to see this plan when building the payment plans page. New users will always see the plans with the lowest gid available.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Enable Fixed GID:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Enable this setting if you want to restrict this plan to one usergroup.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_NAME', 'Set Group:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_DESC', 'Only users with this usergroup can view this plan.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Enable Max GID:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user is shown this plan by a maximum usergroup.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_NAME', 'Maximum Group:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_DESC', 'The maximum user level a user can have to see this plan when building the payment plans page.');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Required Prev. Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Enable checking for previous payment plan');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'A user will only see this plan if he or she used the selected plan before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Required Curr. Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'A user will only see this plan if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Required Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'A user will only see this plan if he or she has used the selected plan once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who had the selected plan as their previous payment plan');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she used the selected plan before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have the selected plan as their currently present payment plan');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have used the selected plan before');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she has used the selected plan once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Min Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a specified payment plan in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the selected plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_DESC', 'The payment plan that the user has to have used the specified number of times at least');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Max Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your consumers have subscribed to a specified payment plan in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'The maximum amount a user can have used the selected plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_DESC', 'The payment plan that the user has to have used the specified number of times at most');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Required Prev. Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Enable checking for previous payment plan in this group');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'A user will only see this plan if he or she used a plan in this group before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Required Curr. Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan in this group');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'A user will only see this plan if he or she is currently assigned to, or has just expired from a plan in this group selected here');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Required Used Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan in this group');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'A user will only see this plan if he or she has used the selected plan in this group once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who had a plan in this group as their previous payment plan');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she used a plan in this group before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have a plan in this group as their currently present payment plan');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she is currently assigned to, or has just expired from a plan in this group');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have used the a plan in this group before');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she has used a plan in this group once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Min Used Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a payment plan in this group in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the a plan in this group');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_DESC', 'The group that the user has to have used a plan from - the specified number of times at least');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Max Used Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your users have subscribed to a payment plan in this group in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'The maximum amount a user can have used a plan in this group');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_DESC', 'The group that the user has to have used a plan from - the specified number of times at most');

define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'Use Custom Restrictions:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Enable the use of the below specified restrictions');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Custom Restrictions:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'Use RewriteEngine fields to check for specific strings in this form:<br />[[user_id]] >= 1500<br />[[parametername]] = value<br />(Create separate rules by entering a new line).<br />You can use =, <=, >=, <, >, <> as comparing elements. You MUST use spaces between parameters, values and comparators!');

define( '_PAYPLAN_PROCESSORS_TITLE', 'Processors');
define( '_PAYPLAN_PROCESSORS_TITLE_LONG', 'Payment Processors');

define( '_PAYPLAN_PROCESSORS_ACTIVATE_NAME', 'Active');
define( '_PAYPLAN_PROCESSORS_ACTIVATE_DESC', 'Offer this Payment Processor for this Payment Plan.');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_NAME', 'Overwrite Global Settings');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_DESC', 'If you want to, you can check this box and after saving the plan edit every setting from the global configuration to be different for this plan individually.');

define( '_PAYPLAN_MI', 'Micro Integr.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integrations:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_DESC', 'Select the Micro Integrations that you want to apply to the user with the plan.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_NAME', 'Local Micro Integrations:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_DESC', 'Select the Micro Integrations that you want to apply to the user with the plan. Instead of global instances, these MIs will be specific only to this payment plan.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_NAME', 'Inherited:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_DESC', 'Shows which Micro Integrations are inherited from parent groups that this plan is a member of.');

define( '_PAYPLAN_CURRENCY', 'Currency');

// --== Group PAGE ==--

define( '_ITEMGROUPS_TITLE', 'Groups');
define( '_ITEMGROUP_NAME', 'Name');
define( '_ITEMGROUP_DESC', 'Description (first 50 chars)');
define( '_ITEMGROUP_ACTIVE', 'Published');
define( '_ITEMGROUP_VISIBLE', 'Visible');
define( '_ITEMGROUP_REORDER', 'Reorder');

define( '_PUBLISH_ITEMGROUP', 'Publish');
define( '_UNPUBLISH_ITEMGROUP', 'Unpublish');
define( '_NEW_ITEMGROUP', 'New');
define( '_COPY_ITEMGROUP', 'Copy');
define( '_APPLY_ITEMGROUP', 'Apply');
define( '_EDIT_ITEMGROUP', 'Edit');
define( '_REMOVE_ITEMGROUP', 'Delete');
define( '_SAVE_ITEMGROUP', 'Save');
define( '_CANCEL_ITEMGROUP', 'Cancel');

define( '_ITEMGROUP_DETAIL_TITLE', 'Group');
define( '_AEC_HEAD_ITEMGROUP_INFO', 'Group' );
define( '_ITEMGROUP_GENERAL_NAME_NAME', 'Name:');
define( '_ITEMGROUP_GENERAL_NAME_DESC', 'Name or title for this group. Max.: 40 characters.');
define( '_ITEMGROUP_GENERAL_DESC_NAME', 'Description:');
define( '_ITEMGROUP_GENERAL_DESC_DESC', 'Full description of group. Max.: 255 characters.');
define( '_ITEMGROUP_GENERAL_ACTIVE_NAME', 'Published:');
define( '_ITEMGROUP_GENERAL_ACTIVE_DESC', 'A published group will be available to the user on frontend.');
define( '_ITEMGROUP_GENERAL_VISIBLE_NAME', 'Visible:');
define( '_ITEMGROUP_GENERAL_VISIBLE_DESC', 'Visible Groups will show on the frontend.');
define( '_ITEMGROUP_GENERAL_COLOR_NAME', 'Color:');
define( '_ITEMGROUP_GENERAL_COLOR_DESC', 'The color marking of this group.');
define( '_ITEMGROUP_GENERAL_ICON_NAME', 'Icon:');
define( '_ITEMGROUP_GENERAL_ICON_DESC', 'The icon marking of this group.');

define( '_ITEMGROUP_GENERAL_REVEAL_CHILD_ITEMS_NAME', 'Reveal Child Items');
define( '_ITEMGROUP_GENERAL_REVEAL_CHILD_ITEMS_DESC', 'If you set this switch to "yes", the AEC will not show a group button (linking the user on to this contents of the group), but directly display the contents of this group in any parent group.');
define( '_ITEMGROUP_GENERAL_SYMLINK_NAME', 'Group Symlink');
define( '_ITEMGROUP_GENERAL_SYMLINK_DESC', 'Entering a link here will redirect a user to this link when selecting this group in the plans selection page. Overrides any linking to contents of this group!');

define( '_ITEMGROUP_GENERAL_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_ITEMGROUP_GENERAL_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');
define( '_ITEMGROUP_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integrations');
define( '_ITEMGROUP_GENERAL_MICRO_INTEGRATIONS_DESC', 'Select which Micro Integrations you want to be attached to all child elements of this group.');

// Group Restrictions

define( '_ITEMGROUP_RESTRICTIONS_TITLE', 'Restrictions');

define( '_ITEMGROUP_RESTRICTIONS_MINGID_ENABLED_NAME', 'Enable Min GID:');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user is shown this group by a minimum usergroup.');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_NAME', 'Visibility Group:');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_DESC', 'The minimum user level required to see this group when building the payment plans page. New users will always see the group with the lowest gid available.');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Enable Fixed GID:');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Enable this setting if you want to restrict this group to one usergroup.');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_NAME', 'Set Group:');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_DESC', 'Only users with this usergroup can view this group.');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Enable Max GID:');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user is shown this grroup by a maximum usergroup.');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_NAME', 'Maximum Group:');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_DESC', 'The maximum user level a user can have to see this group when building the payment plans page.');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Required Prev. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Enable checking for previous payment plan');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'A user will only see this group if he or she used the selected plan before the one currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Required Curr. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'A user will only see this group if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Required Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'A user will only see this plan if he or she has used the selected plan once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who had the selected plan as their previous payment plan');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she used the selected plan before the one currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have the selected plan as their currently present payment plan');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have used the selected plan before');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she has used the selected plan once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Min Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a specified payment plan in order to see this group');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the selected plan');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_DESC', 'The payment plan that the user has to have used the specified number of times at least');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Max Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your consumers have subscribed to a specified payment plan in order to see this group');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'The maximum amount a user can have used the selected plan');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_DESC', 'The payment plan that the user has to have used the specified number of times at most');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Required Prev. Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Enable checking for a previous payment plan in this group');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'A user will only see this group if he or she used a plan in the selected group before the plan currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Required Curr. Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan in this group');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'A user will only see this group if he or she is currently assigned to, or has just expired from a plan in the group selected here');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Required Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan in this group');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'A user will only see this group if he or she has used a plan in the selected group once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who had a plan in the selected group as their previous payment plan');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she used a plan in the selected group before the one currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have a plan in the selected group as their currently present payment plan');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she is currently assigned to, or has just expired from a plan in the selected group');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have used the a plan in the selected group before');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she has used a plan in the selected group once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Min Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your users have subscribed to a payment plan in the selected group in order to see THIS group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the a plan in the selected group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_DESC', 'The group that the user has to have used a plan from - the specified number of times at least');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Max Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your users may have subscribed to a payment plan in the selected group in order to see THIS group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'The maximum amount a user can have used a plan in the selected group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_DESC', 'The group that the user has to have used a plan from - the specified number of times at most');

define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'Use Custom Restrictions:');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Enable the use of the below specified restrictions');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Custom Restrictions:');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'Use RewriteEngine fields to check for specific strings in this form:<br />[[user_id]] >= 1500<br />[[parametername]] = value<br />(Create separate rules by entering a new line).<br />You can use =, <=, >=, <, >, <> as comparing elements. You MUST use spaces between parameters, values and comparators!');

// Group Relations

define( '_ITEMGROUP_RELATIONS_TITLE', 'Relations');
define( '_ITEMGROUP_PARAMS_SIMILARITEMGROUPS_NAME', 'Similar Groups:');
define( '_ITEMGROUP_PARAMS_SIMILARITEMGROUPS_DESC', 'Select which groups are similar to this one. A user is not allowed to use a Trial period when buying a plan that he or she has purchased before and this will also be the same for similar plans (or plans in similar groups).');
define( '_ITEMGROUP_PARAMS_EQUALITEMGROUPS_NAME', 'Equal Groups:');
define( '_ITEMGROUP_PARAMS_EQUALITEMGROUPS_DESC', 'Select which groups are equal to this one. A user switching between equal plans (or plans in equal groups) will have his or her period extended instead of reset. Trials are also not permitted (see similar groups info).');

// Currencies

define( '_CURRENCY_AFA', 'Afghani');
define( '_CURRENCY_ALL', 'Lek');
define( '_CURRENCY_DZD', 'Algerian Dinar');
define( '_CURRENCY_ADP', 'Andorran Peseta');
define( '_CURRENCY_AON', 'New Kwanza');
define( '_CURRENCY_ARS', 'Argentine Peso');
define( '_CURRENCY_AMD', 'Armenian Dram');
define( '_CURRENCY_AWG', 'Aruban Guilder');
define( '_CURRENCY_AUD', 'Australian Dollar');
define( '_CURRENCY_AZM', 'Azerbaijanian Manat ');
define( '_CURRENCY_EUR', 'Euro');
define( '_CURRENCY_BSD', 'Bahamian Dollar');
define( '_CURRENCY_BHD', 'Bahraini Dinar');
define( '_CURRENCY_BDT', 'Taka');
define( '_CURRENCY_BBD', 'Barbados Dollar');
define( '_CURRENCY_BYB', 'Belarussian Ruble');
define( '_CURRENCY_BEF', 'Belgian Franc');
define( '_CURRENCY_BZD', 'Belize Dollar');
define( '_CURRENCY_BMD', 'Bermudian Dollar');
define( '_CURRENCY_BOB', 'Boliviano');
define( '_CURRENCY_BAD', 'Bosnian Dinar');
define( '_CURRENCY_BWP', 'Pula');
define( '_CURRENCY_BRL', 'Real');
define( '_CURRENCY_BND', 'Brunei Dollar');
define( '_CURRENCY_BGL', 'Lev');
define( '_CURRENCY_BGN', 'Lev');
define( '_CURRENCY_XOF', 'CFA Franc BCEAO');
define( '_CURRENCY_BIF', 'Burundi Franc');
define( '_CURRENCY_KHR', 'Cambodia Riel');
define( '_CURRENCY_XAF', 'CFA Franc BEAC');
define( '_CURRENCY_CAD', 'Canadian Dollar');
define( '_CURRENCY_CVE', 'Cape Verde Escudo');
define( '_CURRENCY_KYD', 'Cayman Islands Dollar');
define( '_CURRENCY_CLP', 'Chilean Peso');
define( '_CURRENCY_CNY', 'Yuan Renminbi');
define( '_CURRENCY_COP', 'Colombian Peso');
define( '_CURRENCY_KMF', 'Comoro Franc');
define( '_CURRENCY_BAM', 'Convertible Marks');
define( '_CURRENCY_CRC', 'Costa Rican Colon');
define( '_CURRENCY_HRK', 'Croatian Kuna');
define( '_CURRENCY_CUP', 'Cuban Peso');
define( '_CURRENCY_CYP', 'Cyprus Pound');
define( '_CURRENCY_CZK', 'Czech Koruna');
define( '_CURRENCY_DKK', 'Danish Krone');
define( '_CURRENCY_DEM', 'Deutsche Mark');
define( '_CURRENCY_DJF', 'Djibouti Franc');
define( '_CURRENCY_XCD', 'East Caribbean Dollar');
define( '_CURRENCY_DOP', 'Dominican Peso');
define( '_CURRENCY_GRD', 'Drachma');
define( '_CURRENCY_TPE', 'Timor Escudo');
define( '_CURRENCY_ECS', 'Ecuador Sucre');
define( '_CURRENCY_EGP', 'Egyptian Pound');
define( '_CURRENCY_SVC', 'El Salvador Colon');
define( '_CURRENCY_EEK', 'Kroon');
define( '_CURRENCY_ETB', 'Ethiopian Birr');
define( '_CURRENCY_FKP', 'Falkland Islands Pound');
define( '_CURRENCY_FJD', 'Fiji Dollar');
define( '_CURRENCY_XPF', 'CFP Franc');
define( '_CURRENCY_FRF', 'Franc');
define( '_CURRENCY_CDF', 'Franc Congolais');
define( '_CURRENCY_GMD', 'Dalasi');
define( '_CURRENCY_GHC', 'Cedi');
define( '_CURRENCY_GIP', 'Gibraltar Pound');
define( '_CURRENCY_GTQ', 'Quetzal');
define( '_CURRENCY_GNF', 'Guinea Franc');
define( '_CURRENCY_GWP', 'Guinea - Bissau Peso');
define( '_CURRENCY_GYD', 'Guyana Dollar');
define( '_CURRENCY_HTG', 'Gourde');
define( '_CURRENCY_XAU', 'Gold');
define( '_CURRENCY_HNL', 'Lempira');
define( '_CURRENCY_HKD', 'Hong Kong Dollar');
define( '_CURRENCY_HUF', 'Forint');
define( '_CURRENCY_ISK', 'Iceland Krona');
define( '_CURRENCY_INR', 'Indian Rupee');
define( '_CURRENCY_IDR', 'Rupiah');
define( '_CURRENCY_IRR', 'Iranian Rial');
define( '_CURRENCY_IQD', 'Iraqi Dinar');
define( '_CURRENCY_IEP', 'Irish Pound');
define( '_CURRENCY_ITL', 'Italian Lira');
define( '_CURRENCY_ILS', 'Shekel');
define( '_CURRENCY_JMD', 'Jamaican Dollar');
define( '_CURRENCY_JPY', 'Japan Yen');
define( '_CURRENCY_JOD', 'Jordanian Dinar');
define( '_CURRENCY_KZT', 'Tenge');
define( '_CURRENCY_KES', 'Kenyan Shilling');
define( '_CURRENCY_KRW', 'Won');
define( '_CURRENCY_KPW', 'North Korean Won');
define( '_CURRENCY_KWD', 'Kuwaiti Dinar');
define( '_CURRENCY_KGS', 'Som');
define( '_CURRENCY_LAK', 'Kip');
define( '_CURRENCY_GEL', 'Lari');
define( '_CURRENCY_LVL', 'Latvian Lats');
define( '_CURRENCY_LBP', 'Lebanese Pound');
define( '_CURRENCY_LSL', 'Loti');
define( '_CURRENCY_LRD', 'Liberian Dollar');
define( '_CURRENCY_LYD', 'Libyan Dinar');
define( '_CURRENCY_LTL', 'Lithuanian Litas');
define( '_CURRENCY_LUF', 'Luxembourg Franc');
define( '_CURRENCY_AOR', 'Kwanza Reajustado');
define( '_CURRENCY_MOP', 'Pataca');
define( '_CURRENCY_MKD', 'Denar');
define( '_CURRENCY_MGF', 'Malagasy Franc');
define( '_CURRENCY_MWK', 'Kwacha');
define( '_CURRENCY_MYR', 'Malaysian Ringitt');
define( '_CURRENCY_MVR', 'Rufiyaa');
define( '_CURRENCY_MTL', 'Maltese Lira');
define( '_CURRENCY_MRO', 'Ouguiya');
define( '_CURRENCY_TMM', 'Manat');
define( '_CURRENCY_FIM', 'Markka');
define( '_CURRENCY_MUR', 'Mauritius Rupee');
define( '_CURRENCY_MXN', 'Mexico Peso');
define( '_CURRENCY_MXV', 'Mexican Unidad de Inversion');
define( '_CURRENCY_MNT', 'Mongolia Tugrik');
define( '_CURRENCY_MAD', 'Moroccan Dirham');
define( '_CURRENCY_MDL', 'Moldovan Leu');
define( '_CURRENCY_MZM', 'Metical');
define( '_CURRENCY_BOV', 'Mvdol');
define( '_CURRENCY_MMK', 'Myanmar Kyat');
define( '_CURRENCY_ERN', 'Nakfa');
define( '_CURRENCY_NAD', 'Namibian Dollar');
define( '_CURRENCY_NPR', 'Nepalese Rupee');
define( '_CURRENCY_ANG', 'Netherlands Antilles Guilder');
define( '_CURRENCY_NLG', 'Netherlands Guilder');
define( '_CURRENCY_NZD', 'New Zealand Dollar');
define( '_CURRENCY_NIO', 'Cordoba Oro');
define( '_CURRENCY_NGN', 'Naira');
define( '_CURRENCY_BTN', 'Ngultrum');
define( '_CURRENCY_NOK', 'Norwegian Krone');
define( '_CURRENCY_OMR', 'Rial Omani');
define( '_CURRENCY_PKR', 'Pakistan Rupee');
define( '_CURRENCY_PAB', 'Balboa');
define( '_CURRENCY_PGK', 'New Guinea Kina');
define( '_CURRENCY_PYG', 'Guarani');
define( '_CURRENCY_PEN', 'Nuevo Sol');
define( '_CURRENCY_XPD', 'Palladium');
define( '_CURRENCY_PHP', 'Philippine Peso');
define( '_CURRENCY_XPT', 'Platinum');
define( '_CURRENCY_PTE', 'Portuguese Escudo');
define( '_CURRENCY_PLN', 'New Zloty');
define( '_CURRENCY_QAR', 'Qatari Rial');
define( '_CURRENCY_ROL', 'Romanian Leu');
define( '_CURRENCY_RON', 'New Romanian Leu');
define( '_CURRENCY_RSD', 'Serbian dinar');
define( '_CURRENCY_RUB', 'Russian Ruble');
define( '_CURRENCY_RWF', 'Rwanda Franc');
define( '_CURRENCY_WST', 'Tala');
define( '_CURRENCY_STD', 'Dobra');
define( '_CURRENCY_SAR', 'Saudi Riyal');
define( '_CURRENCY_SCR', 'Seychelles Rupee');
define( '_CURRENCY_SLL', 'Leone');
define( '_CURRENCY_SGD', 'Singapore Dollar');
define( '_CURRENCY_SKK', 'Slovak Koruna');
define( '_CURRENCY_SIT', 'Tolar');
define( '_CURRENCY_SBD', 'Solomon Islands Dollar');
define( '_CURRENCY_SOS', 'Somalia Shilling');
define( '_CURRENCY_ZAL', 'Rand (Financial)');
define( '_CURRENCY_ZAR', 'Rand (South Africa)');
define( '_CURRENCY_RUR', 'Russian Ruble');
define( '_CURRENCY_ATS', 'Schilling');
define( '_CURRENCY_XAG', 'Silver');
define( '_CURRENCY_ESP', 'Spanish Peseta');
define( '_CURRENCY_LKR', 'Sri Lanka Rupee');
define( '_CURRENCY_SHP', 'St Helena Pound');
define( '_CURRENCY_SDP', 'Sudanese Pound');
define( '_CURRENCY_SDD', 'Sudanese Dinar');
define( '_CURRENCY_SRG', 'Suriname Guilder');
define( '_CURRENCY_SZL', 'Swaziland Lilangeni');
define( '_CURRENCY_SEK', 'Sweden Krona');
define( '_CURRENCY_CHF', 'Swiss Franc');
define( '_CURRENCY_SYP', 'Syrian Pound');
define( '_CURRENCY_TWD', 'New Taiwan Dollar');
define( '_CURRENCY_TJR', 'Tajik Ruble');
define( '_CURRENCY_TZS', 'Tanzanian Shilling');
define( '_CURRENCY_TRL', 'Turkish Lira');
define( '_CURRENCY_THB', 'Baht');
define( '_CURRENCY_TOP', 'Tonga Pa\'anga');
define( '_CURRENCY_TTD', 'Trinidad &amp; Tobago Dollar');
define( '_CURRENCY_TND', 'Tunisian Dinar');
define( '_CURRENCY_TRY', 'Turkish Lira');
define( '_CURRENCY_UGX', 'Uganda Shilling');
define( '_CURRENCY_UAH', 'Ukrainian Hryvnia');
define( '_CURRENCY_ECV', 'Unidad de Valor Constante');
define( '_CURRENCY_CLF', 'Unidades de fomento');
define( '_CURRENCY_AED', 'United Arab Emirates Dirham');
define( '_CURRENCY_GBP', 'Pounds Sterling');
define( '_CURRENCY_USD', 'US Dollar');
define( '_CURRENCY_UYU', 'Uruguayan Peso');
define( '_CURRENCY_UZS', 'Uzbekistan Sum');
define( '_CURRENCY_VUV', 'Vanuatu Vatu');
define( '_CURRENCY_VEB', 'Venezuela Bolivar');
define( '_CURRENCY_VND', 'Viet Nam Dong');
define( '_CURRENCY_YER', 'Yemeni Rial');
define( '_CURRENCY_YUM', 'Yugoslavian New Dinar');
define( '_CURRENCY_ZRN', 'New Zaire');
define( '_CURRENCY_ZMK', 'Zambian Kwacha');
define( '_CURRENCY_ZWD', 'Zimbabwe Dollar');
define( '_CURRENCY_USN', 'US Dollar (Next day)');
define( '_CURRENCY_USS', 'US Dollar (Same day)');

// --== MICRO INTEGRATION OVERVIEW ==--
define( '_MI_TITLE', 'Micro Integrations');
define( '_MI_NAME', 'Name');
define( '_MI_DESC', 'Description');
define( '_MI_ACTIVE', 'Active');
define( '_MI_REORDER', 'Order');
define( '_MI_FUNCTION', 'Function Name');

// --== MICRO INTEGRATION EDIT ==--
define( '_MI_E_TITLE', 'MI');
define( '_MI_E_TITLE_LONG', 'Micro Integration');
define( '_MI_E_SETTINGS', 'Settings');
define( '_MI_E_NAME_NAME', 'Name');
define( '_MI_E_NAME_DESC', 'Choose a name for this Micro Integration');
define( '_MI_E_DESC_NAME', 'Description');
define( '_MI_E_DESC_DESC', 'Briefly Describe the Integration');
define( '_MI_E_ACTIVE_NAME', 'Active');
define( '_MI_E_ACTIVE_DESC', 'Set the Integration to active');
define( '_MI_E_AUTO_CHECK_NAME', 'Expiration Action');
define( '_MI_E_AUTO_CHECK_DESC', 'If the function allows this, you can enable expiration features: actions that have to be carried out when a user expires (if supported by the MI).');
define( '_MI_E_ON_USERCHANGE_NAME', 'User Account Update Action');
define( '_MI_E_ON_USERCHANGE_DESC', 'If the function allows this, you can enable actions that happen when a user account is being changed (if supported by the MI).');
define( '_MI_E_PRE_EXP_CHECK_NAME', 'Pre Expiration');
define( '_MI_E_PRE_EXP_CHECK_DESC', 'Set the amount of days before expiration when a pre-expiration action should be triggered (if supported by the MI).');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_NAME', 'Expire all instances');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_DESC', 'Trigger the expiration action even if the user has another payment plan with this MI attached. The standard behavior is to call the expiration action on an MI only when it really is the last MI instance that this user has in all payment plans.');
define( '_MI_E_FUNCTION_NAME', 'Function Name');
define( '_MI_E_FUNCTION_DESC', 'Please choose which of these integrations should be used');
define( '_MI_E_FUNCTION_EXPLANATION', 'Before you can setup the Micro Integration, you have to select which of the integration files we should use for this. Make a selection and save the Micro Integration. When you edit it again, you will be able to set the parameters. Note also, that the function name cannot be changed once its set.');

// --== REWRITE EXPLANATION ==--
define( '_REWRITE_AREA_USER', 'User Account Related');
define( '_REWRITE_KEY_USER_ID', 'User Account ID');
define( '_REWRITE_KEY_USER_USERNAME', 'Username');
define( '_REWRITE_KEY_USER_NAME', 'Name');
define( '_REWRITE_KEY_USER_FIRST_NAME', 'First Name');
define( '_REWRITE_KEY_USER_FIRST_FIRST_NAME', 'First First Name');
define( '_REWRITE_KEY_USER_LAST_NAME', 'Last Name');
define( '_REWRITE_KEY_USER_EMAIL', 'E-Mail Address');
define( '_REWRITE_KEY_USER_ACTIVATIONCODE', 'Activation Code');
define( '_REWRITE_KEY_USER_ACTIVATIONLINK', 'Activation Link');

define( '_REWRITE_AREA_SUBSCRIPTION', 'User Subscription Related');
define( '_REWRITE_KEY_SUBSCRIPTION_TYPE', 'Payment Processor');
define( '_REWRITE_KEY_SUBSCRIPTION_STATUS', 'Subscription Status');
define( '_REWRITE_KEY_SUBSCRIPTION_SIGNUP_DATE', 'Date this Subscription was established');
define( '_REWRITE_KEY_SUBSCRIPTION_LASTPAY_DATE', 'Last Payment Date');
define( '_REWRITE_KEY_SUBSCRIPTION_PLAN', 'Payment Plan ID');
define( '_REWRITE_KEY_SUBSCRIPTION_PREVIOUS_PLAN', 'Previous Payment Plan ID');
define( '_REWRITE_KEY_SUBSCRIPTION_RECURRING', 'Recurring Payment Flag');
define( '_REWRITE_KEY_SUBSCRIPTION_LIFETIME', 'Lifetime Subscription Flag');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE', 'Expiration Date (Frontend Formatting)');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE_BACKEND', 'Expiration Date (Backend Formatting)');

define( '_REWRITE_AREA_PLAN', 'Payment Plan Related');
define( '_REWRITE_KEY_PLAN_NAME', 'Name');
define( '_REWRITE_KEY_PLAN_DESC', 'Description');

define( '_REWRITE_AREA_CMS', 'CMS Related');
define( '_REWRITE_KEY_CMS_ABSOLUTE_PATH', 'Absolute path to cms directory');
define( '_REWRITE_KEY_CMS_LIVE_SITE', 'Your Site URL');

define( '_REWRITE_AREA_SYSTEM', 'System Related');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP', 'Timestamp (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP_BACKEND', 'Timestamp (Backend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP', 'Server Timestamp (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP_BACKEND', 'Server Timestamp (Backend Formatting)');

define( '_REWRITE_AREA_INVOICE', 'Invoice Related');
define( '_REWRITE_KEY_INVOICE_ID', 'Invoice ID');
define( '_REWRITE_KEY_INVOICE_NUMBER', 'Invoice Number');
define( '_REWRITE_KEY_INVOICE_NUMBER_FORMAT', 'Invoice Number (formatted)');
define( '_REWRITE_KEY_INVOICE_CREATED_DATE', 'Date of Creation');
define( '_REWRITE_KEY_INVOICE_TRANSACTION_DATE', 'Date of Transaction');
define( '_REWRITE_KEY_INVOICE_METHOD', 'Payment Method');
define( '_REWRITE_KEY_INVOICE_AMOUNT', 'Amount Paid');
define( '_REWRITE_KEY_INVOICE_CURRENCY', 'Currency');
define( '_REWRITE_KEY_INVOICE_COUPONS', 'List of Coupons');

define( '_REWRITE_ENGINE_TITLE', 'Rewrite Engine');
define( '_REWRITE_ENGINE_DESC', 'To create dynamic text, you can add these wiki-style tags in RWengine-enabled fields. Flick through the togglers below to see which tags are available');
define( '_REWRITE_ENGINE_AECJSON_TITLE', 'aecJSON');
define( '_REWRITE_ENGINE_AECJSON_DESC', 'You can also use functions encoded in JSON markup, like this:<br />{aecjson} { "cmd":"date", "vars": [ "Y", { "cmd":"rw_constant", "vars":"invoice_created_date" } ] } {/aecjson}<br />It returns only the Year of a date. Refer to the manual and forums for further instructions!');

// --== COUPONS OVERVIEW ==--
define( '_COUPON_TITLE', 'Coupons');
define( '_COUPON_TITLE_STATIC', 'Static Coupons');
define( '_COUPON_NAME', 'Name');
define( '_COUPON_DESC', 'Description (first 50 chars)');
define( '_COUPON_CODE', 'Coupon Code');
define( '_COUPON_ACTIVE', 'Published');
define( '_COUPON_REORDER', 'Reorder');
define( '_COUPON_USECOUNT', 'Use Count');

// --== COUPON EDIT ==--
define( '_COUPON_DETAIL_TITLE', 'Coupon');
define( '_COUPON_RESTRICTIONS_TITLE', 'Restrict.');
define( '_COUPON_RESTRICTIONS_TITLE_FULL', 'Restrictions');
define( '_COUPON_MI', 'Micro Int.');
define( '_COUPON_MI_FULL', 'Micro Integrations');

define( '_COUPON_GENERAL_NAME_NAME', 'Name');
define( '_COUPON_GENERAL_NAME_DESC', 'Enter the (internal&amp;external) name for this coupon');
define( '_COUPON_GENERAL_COUPON_CODE_NAME', 'Coupon Code');
define( '_COUPON_GENERAL_COUPON_CODE_DESC', 'Enter the Coupon Code for this coupon - the randomly generated coupon code is checked to be unique within the system');
define( '_COUPON_GENERAL_DESC_NAME', 'Description');
define( '_COUPON_GENERAL_DESC_DESC', 'Enter the (internal) description for this coupon');
define( '_COUPON_GENERAL_ACTIVE_NAME', 'Active');
define( '_COUPON_GENERAL_ACTIVE_DESC', 'Set whether this coupon is active (can be used)');
define( '_COUPON_GENERAL_TYPE_NAME', 'Static');
define( '_COUPON_GENERAL_TYPE_DESC', 'Select whether you want this to be a static coupon. These are stored in a separate table for quicker access, the general distinction being that static coupons are coupons that are used by a lot of users while non-static coupons are for one user.');

define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integrations');
define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_DESC', 'Select the Micro Integration(s) which you want to be called when this coupon is used');

define( '_COUPON_PARAMS_AMOUNT_USE_NAME', 'Use Amount');
define( '_COUPON_PARAMS_AMOUNT_USE_DESC', 'Select whether you want to use a direct discount amount');
define( '_COUPON_PARAMS_AMOUNT_NAME', 'Discount Amount');
define( '_COUPON_PARAMS_AMOUNT_DESC', 'Enter the Amount that you want to deduct from the next amount');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_NAME', 'Use Percentage');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_DESC', 'Select whether you want a percentage deducted from the actual amount');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_NAME', 'Discount Percentage');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_DESC', 'Enter the percentage that you want deducted from the amount');
define( '_COUPON_PARAMS_PERCENT_FIRST_NAME', 'Percent First');
define( '_COUPON_PARAMS_PERCENT_FIRST_DESC', 'If you combine percentage and amount, do you want the percentage to be deducted first?');
define( '_COUPON_PARAMS_USEON_TRIAL_NAME', 'Use On Trial?');
define( '_COUPON_PARAMS_USEON_TRIAL_DESC', 'Do you want to let the user apply this discount to a trial amount?');
define( '_COUPON_PARAMS_USEON_FULL_NAME', 'Use On Full?');
define( '_COUPON_PARAMS_USEON_FULL_DESC', 'Do you want to let the user apply this discount to the actual amount? (With recurring billing: to the first regular payment)');
define( '_COUPON_PARAMS_USEON_FULL_ALL_NAME', 'Every Full?');
define( '_COUPON_PARAMS_USEON_FULL_ALL_DESC', 'If the user is using recurring payments, do you want to grant this discount for each subsequent payment? (Or just for the first, if that applies - then select no)');

define( '_COUPON_PARAMS_HAS_START_DATE_NAME', 'Use Start Date');
define( '_COUPON_PARAMS_HAS_START_DATE_DESC', 'Do you want to allow your users to use this coupon from a certain date on?');
define( '_COUPON_PARAMS_START_DATE_NAME', 'Start Date');
define( '_COUPON_PARAMS_START_DATE_DESC', 'Select the date at which you want to start allowing the usage of this coupon');
define( '_COUPON_PARAMS_HAS_EXPIRATION_NAME', 'Use Expiration Date');
define( '_COUPON_PARAMS_HAS_EXPIRATION_DESC', 'Do you want to restrict the usage of this coupon to a certain date?');
define( '_COUPON_PARAMS_EXPIRATION_NAME', 'Expiration Date');
define( '_COUPON_PARAMS_EXPIRATION_DESC', 'Select the date at which you want to stop allowing the usage of this coupon');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_NAME', 'Restrict Reuse?');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_DESC', 'Do you want to restrict the number of times this coupon may be used?');
define( '_COUPON_PARAMS_MAX_REUSE_NAME', 'Max Uses');
define( '_COUPON_PARAMS_MAX_REUSE_DESC', 'Choose the number of times this coupon can be used');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_NAME', 'Restrict Reuse per User?');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_DESC', 'Do you want to restrict the number of times every user is allowed to use this coupon?');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_NAME', 'Max Uses per User');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_DESC', 'Choose the number of times this coupon can be used by each user');

define( '_COUPON_PARAMS_USECOUNT_NAME', 'Use Count');
define( '_COUPON_PARAMS_USECOUNT_DESC', 'Reset the number of times this Coupon has been used');

define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_NAME', 'Set Plan');
define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_DESC', 'Do you want to allow this coupon only for certain plans?');
define( '_COUPON_PARAMS_USAGE_PLANS_NAME', 'Plans');
define( '_COUPON_PARAMS_USAGE_PLANS_DESC', 'Choose which plans this coupon can be used for');
define( '_COUPON_PARAMS_USAGE_CART_FULL_NAME', 'Use on Cart');
define( '_COUPON_PARAMS_USAGE_CART_FULL_DESC', 'Allow Application to a full shopping card');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_NAME', 'Multiple Items');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_DESC', 'Let the user apply the coupon to multiple items of a shopping cart, if overall restrictions permit it');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_NAME', 'Multiple Items Amount');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_DESC', 'Set a limit for application to multiple items of one shopping cart');

define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_NAME', 'Enable Min GID:');
define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user can use this coupon by a minimum usergroup.');
define( '_COUPON_RESTRICTIONS_MINGID_NAME', 'Visibility Group:');
define( '_COUPON_RESTRICTIONS_MINGID_DESC', 'The minimum user level required to use this coupon.');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Enable Fixed GID:');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Enable this setting if you want to restrict this coupon to one usergroup.');
define( '_COUPON_RESTRICTIONS_FIXGID_NAME', 'Set Group:');
define( '_COUPON_RESTRICTIONS_FIXGID_DESC', 'Only users with this usergroup can use this coupon.');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Enable Max GID:');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user use this coupon by a maximum usergroup.');
define( '_COUPON_RESTRICTIONS_MAXGID_NAME', 'Maximum Group:');
define( '_COUPON_RESTRICTIONS_MAXGID_DESC', 'The maximum user level a user can have to use this coupon.');

define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Required Prev. Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Enable checking for previous payment plan');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'A user will only be able to use this coupon if he or she used the selected plan before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Required Curr. Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'A user will only be able to use this coupon if he or she is currently assigned to, or has expired from the plan selected here');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Required Used Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'A user will only be able to use this coupon if he or she has used the selected plan once, no matter when');

define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Min Used Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a specified payment plan in order to be able to use this coupon');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the selected plan');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_DESC', 'The payment plan that the user has to have used the specified number of times at least');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Max Used Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your consumers have subscribed to a specified payment plan in order to be able to use this coupon');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'The maximum amount a user can have used the selected plan');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_DESC', 'The payment plan that the user has to have used the specified number of times at most');

define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who had the selected plan as their previous payment plan');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'A user will only be able to use the coupon if he or she used the selected plan before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who have the selected plan as their currently present payment plan');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'A user will only be able to use the coupon if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who have used the selected plan before');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'A user will only be able to use the coupon if he or she has used the selected plan once, no matter when');

define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Required Prev. Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Enable checking for previous payment plan in this group');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'A user will only be able to use the coupon if he or she used a plan in this group before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Required Curr. Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan in this group');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'A user will only be able to use the coupon if he or she is currently assigned to, or has just expired from a plan in this group selected here');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Required Used Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan in this group');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'A user will only be able to use the coupon if he or she has used the selected plan in this group once, no matter when');

define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who had a plan in this group as their previous payment plan');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'A user will not be able to use the coupon if he or she used a plan in this group before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who have a plan in this group as their currently present payment plan');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'A user will not be able to use the coupon if he or she is currently assigned to, or has just expired from a plan in this group');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who have used the a plan in this group before');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'A user will not be able to use the coupon if he or she has used a plan in this group once, no matter when');

define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Min Used Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a payment plan in this group in order to be able to use the coupon');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the a plan in this group');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_DESC', 'The group that the user has to have used a plan from - the specified number of times at least');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Max Used Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your users have subscribed to a payment plan in this group in order to be able to use the coupon');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'The maximum amount a user can have used a plan in this group');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_DESC', 'The group that the user has to have used a plan from - the specified number of times at most');

define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_NAME', 'Restrict Combination:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_DESC', 'Choose to not let your users combine this coupon with one of the following');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_DESC', 'Make a selection which coupons this one is not to be used with');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_NAME', 'Depend on Subscription:');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_DESC', 'Make the coupon depend on a certain subscription to be functional.');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_NAME', 'Subscription ID');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_DESC', 'The Subscription ID that the coupon will depend on.');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_NAME', 'Allow Trial Subscriptions:');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_DESC', 'Allow the use of the coupon when depending on a subscription that is still a trial.');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_CART_NAME', 'Restrict Combination Cart:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_CART_DESC', 'Choose to not let your users combine this coupon with one of the following when applied to a cart');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_CART_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_CART_DESC', 'Make a selection which coupons this one is not to be used with');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_NAME', 'Allow Combination:');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_DESC', 'Choose to let your users combine this coupon with only with the following. Select none to disallow any combination.');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_DESC', 'Make a selection which coupons this one can to be used with');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_CART_NAME', 'Allow Combination Cart:');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_CART_DESC', 'Choose to let your users combine this coupon with only with the following in a cart. Select none to disallow any combination.');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_CART_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_CART_DESC', 'Make a selection which coupons this one can to be used with in a cart');

// --== INVOICE OVERVIEW ==--
define( '_INVOICE_TITLE', 'Invoices');
define( '_INVOICE_SEARCH', 'Search');
define( '_INVOICE_USERID', 'User Name');
define( '_INVOICE_INVOICE_NUMBER', 'Invoice Number');
define( '_INVOICE_SECONDARY_IDENT', 'Secondary Identification');
define( '_INVOICE_TRANSACTION_DATE', 'Transaction Date');
define( '_INVOICE_CREATED_DATE', 'Created Date');
define( '_INVOICE_METHOD', 'Method');
define( '_INVOICE_AMOUNT', 'Amount');
define( '_INVOICE_CURRENCY', 'Currency');
define( '_INVOICE_COUPONS', 'Coupons');

// --== PAYMENT HISTORY OVERVIEW ==--
define( '_HISTORY_TITLE2', 'Your Current Transaction History');
define( '_HISTORY_SEARCH', 'Search');
define( '_HISTORY_USERID', 'User Name');
define( '_HISTORY_INVOICE_NUMBER', 'Invoice Number');
define( '_HISTORY_PLAN_NAME', 'Plan Subscribed To');
define( '_HISTORY_TRANSACTION_DATE', 'Transaction Date');
define( '_HISTORY_METHOD', 'Invoice Method');
define( '_HISTORY_AMOUNT', 'Invoice Amount');
define( '_HISTORY_RESPONSE', 'Server Response');

// --== ALL USER RELATED PAGES ==--
define( '_METHOD', 'Method');

// --== PENDING PAGE ==--
define( '_PEND_DATE', 'Pending Since');
define( '_PEND_TITLE', 'Pending Subscriptions');
define( '_PEND_DESC', 'Subscriptions that does not complete the process. This state is common for a short time while system waits for the payment.');
define( '_ACTIVATE', 'Activate');
define( '_ACTIVATED', 'User activated.');

// --== EXPORT ==--
define( '_AEC_HEAD_EXPORT', 'Export');
define( '_EXPORT_LOAD', 'Load');
define( '_EXPORT_APPLY', 'Apply');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_NAME', 'Export Preset');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_DESC', 'Select a preset (or an automatically saved previous export) instead of making the selections below. You can also click apply on the upper right and preview the preset.');
define( '_EXPORT_GENERAL_DELETE_NAME', 'Delete');
define( '_EXPORT_GENERAL_DELETE_DESC', 'Delete this Preset (on apply)');
define( '_EXPORT_PARAMS_PLANID_NAME', 'Payment Plan');
define( '_EXPORT_PARAMS_PLANID_DESC', 'Filter out subscriptions with this Payment Plan');
define( '_EXPORT_PARAMS_STATUS_NAME', 'Status');
define( '_EXPORT_PARAMS_STATUS_DESC', 'Only export subscriptions with this status');
define( '_EXPORT_PARAMS_ORDERBY_NAME', 'Order by');
define( '_EXPORT_PARAMS_ORDERBY_DESC', 'Order by one of the following');
define( '_EXPORT_PARAMS_REWRITE_RULE_NAME', 'Fields');
define( '_EXPORT_PARAMS_REWRITE_RULE_DESC', 'Put in the ReWrite Engine fields, separated by semicolons, that you want each exported item to hold.');
define( '_EXPORT_PARAMS_SAVE_NAME', 'Save as New?');
define( '_EXPORT_PARAMS_SAVE_DESC', 'Check this box to save your settings as a new preset');
define( '_EXPORT_PARAMS_SAVE_NAME_NAME', 'Save Name');
define( '_EXPORT_PARAMS_SAVE_NAME_DESC', 'Save new preset under this name');
define( '_EXPORT_PARAMS_EXPORT_METHOD_NAME', 'Exporting Method');
define( '_EXPORT_PARAMS_EXPORT_METHOD_DESC', 'The filetype you want to export to');

// --== READOUT ==--
define( '_AEC_READOUT', 'AEC Readout');
define( '_READOUT_GENERAL_SHOW_SETTINGS_NAME', 'Settings');
define( '_READOUT_GENERAL_SHOW_SETTINGS_DESC', 'Display AEC System Settings on the Readout');
define( '_READOUT_GENERAL_SHOW_EXTSETTINGS_NAME', 'Extended Settings');
define( '_READOUT_GENERAL_SHOW_EXTSETTINGS_DESC', 'Display extended AEC System Settings on the Readout');
define( '_READOUT_GENERAL_SHOW_PROCESSORS_NAME', 'Processor Settings');
define( '_READOUT_GENERAL_SHOW_PROCESSORS_DESC', 'Display Processor Settings on the Readout');
define( '_READOUT_GENERAL_SHOW_PLANS_NAME', 'Plans');
define( '_READOUT_GENERAL_SHOW_PLANS_DESC', 'Display Plans on the Readout');
define( '_READOUT_GENERAL_SHOW_MI_RELATIONS_NAME', 'Plan -> MI Relations');
define( '_READOUT_GENERAL_SHOW_MI_RELATIONS_DESC', 'Display Plan -> MI Relations on the Readout');
define( '_READOUT_GENERAL_SHOW_MIS_NAME', 'Micro Integrations');
define( '_READOUT_GENERAL_SHOW_MIS_DESC', 'Display Micro Integrations and their Settings on the Readout');
define( '_READOUT_GENERAL_STORE_SETTINGS_NAME', 'Remember Settings');
define( '_READOUT_GENERAL_STORE_SETTINGS_DESC', 'Remember Settings on this page for your admin account');
define( '_READOUT_GENERAL_TRUNCATION_LENGTH_NAME', 'Truncation Length');
define( '_READOUT_GENERAL_TRUNCATION_LENGTH_DESC', 'Reduce content of fields to this length where appropriate');
define( '_READOUT_GENERAL_USE_ORDERING_NAME', 'Use Ordering');
define( '_READOUT_GENERAL_USE_ORDERING_DESC', 'Instead of showing entries by their database order, show them by their set ordering - if applicable');
define( '_READOUT_GENERAL_COLUMN_HEADERS_NAME', 'Column Headers');
define( '_READOUT_GENERAL_COLUMN_HEADERS_DESC', 'Show Column Headers every X rows');
define( '_READOUT_GENERAL_NOFORMAT_NEWLINES_NAME', 'Format: no linebreaks');
define( '_READOUT_GENERAL_NOFORMAT_NEWLINES_DESC', 'Multiple entries for a table cell are normally displayed in separate lines, with this option, these entries are just displayed in a single block of text.');
define( '_READOUT_GENERAL_EXPORT_CSV_NAME', 'Export as .csv');
define( '_READOUT_GENERAL_EXPORT_CSV_DESC', 'Export data as a comma separated file that can be loaded in a spreadsheet application.');

// new for errors
define( '_AEC_ERR_NO_SUBSCRIPTION', 'The user has no Subscription');
?>
