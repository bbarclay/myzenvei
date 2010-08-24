<?php
/**
 * @version $Id: admin.acctexp.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Main Backend
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// no direct access
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Restricted access' );

global $aecConfig;

require_once( $mainframe->getPath( 'class' ) );
require_once( $mainframe->getPath( 'admin_html' ) );

if ( aecJoomla15check() ) {
	JLoader::register('JPaneTabs',  JPATH_LIBRARIES.DS.'joomla'.DS.'html'.DS.'pane.php');
}

if ( !defined( '_EUCA_DEBUGMODE' ) ) {
	define( '_EUCA_DEBUGMODE', $aecConfig->cfg['debugmode'] );
}

if ( _EUCA_DEBUGMODE ) {
	global $eucaDebug;

	$eucaDebug = new eucaDebug();
}

$user = &JFactory::getUser();

$acl = &JFactory::getACL();

if ( aecJoomla15check() ) {
	$acl->addACL( 'administration', 'config', 'users', 'super administrator' );
}

$acpermission = $acl->acl_check( 'administration', 'config', 'users', $user->usertype );

if ( !$acpermission ) {
	if (
		!( ( strcmp( $user->usertype, 'Administrator' ) === 0 ) && $aecConfig->cfg['adminaccess'] )
		&& !( ( strcmp( $user->usertype, 'Manager' ) === 0 ) && $aecConfig->cfg['manageraccess'] )
	 ) {
		if ( aecJoomla15check() ) {
			global $mainframe;

			$mainframe->redirect( 'index2.php', _NOT_AUTH );
		} else {
			aecRedirect( 'index2.php', _NOT_AUTH );
		}
	}
}

$langPathBE = JPATH_SITE . '/administrator/components/com_acctexp/lang/';
if ( file_exists( $langPathBE . $GLOBALS['mosConfig_lang'] . '.php' ) ) {
	include_once( $langPathBE . $GLOBALS['mosConfig_lang'] . '.php' );
} else {
	include_once( $langPathBE . 'english.php' );
}

$langPathPROC = JPATH_SITE . '/components/com_acctexp/processors/lang/';
if ( file_exists( $langPathPROC . $GLOBALS['mosConfig_lang']. '.php' ) ) {
	include_once( $langPathPROC . $GLOBALS['mosConfig_lang'] . '.php' );
} else {
	include_once( $langPathPROC . 'english.php' );
}

include_once( $langPathBE . 'general.php' );

$task			= trim( aecGetParam( 'task', null ) );
$returnTask 	= trim( aecGetParam( 'returnTask', null ) );
$userid			= aecGetParam( 'userid', null );
$subscriptionid	= aecGetParam( 'subscriptionid', null );
$id				= aecGetParam( 'id', null );

if ( !is_null( $id ) ) {
	if ( !is_array( $id ) ) {
		$savid = $id;
		$id = array();
		$id[0] = $savid;
	}
}

$database = &JFactory::getDBO();

// Auto Heartbeat renew every one hour to make sure that the admin gets a view as recent as possible
$heartbeat = new aecHeartbeat( $database );
$heartbeat->backendping();

switch( strtolower( $task ) ) {
	case 'heartbeat':
	case 'beat':
		// Manual Heartbeat
		aecHeartbeat::beat();
		echo "wolves teeth";
		break;

	case 'edit':
		if ( !empty( $userid ) && !is_array( $userid ) ) {
			$temp = $userid;
			$userid = array( 0 => $temp );
		}

		if ( !empty( $subscriptionid ) ) {
			if ( !is_array( $subscriptionid ) ) {
				$sid = $subscriptionid;
				$subscriptionid = array( 0 => $sid );
			}

			$userid[0] = AECfetchfromDB::UserIDfromSubscriptionID( $subscriptionid[0] );
		}

		editUser( $option, $userid, $subscriptionid, $returnTask );
		break;

	case 'save':
		saveUser( $option );
		break;

	case 'apply':
		saveUser( $option, 1 );
		break;

	case 'cancel':
		cancel( $option );
		break;

	case 'showcentral':
		aecCentral( $option );
		break;

	case 'clearpayment':
		$invoice	= trim( aecGetParam( 'invoice', '' ) );
		$applyplan	= trim( aecGetParam( 'applyplan', '0' ) );

		clearInvoice( $option, $invoice, $applyplan, $returnTask );
		break;

	case 'cancelpayment':
		$invoice	= trim( aecGetParam( 'invoice', '' ) );

		cancelInvoice( $option, $invoice, $returnTask );
		break;

	case 'removeclosed':
		removeClosedSubscription( $userid, $option );
		break;

	case 'removeuser':
		removeUser( $userid, $option );
		break;

	case 'removepending':
		removePendingSubscription( $userid, $option );
		break;

	case 'activatepending':
		activatePendingSubscription( $userid, $option, 0 );
		break;

	case 'renewoffline':
		activatePendingSubscription( $userid, $option, 1 );
		break;

	case 'closeactive':
		closeActiveSubscription( $userid, $option, $returnTask );
		break;

	case 'showsubscriptions':
		$planid	= trim( aecGetParam( 'plan', null ) );

		listSubscriptions( $option, 'active', $subscriptionid, $userid, $planid );
		break;

	case 'showallsubscriptions':
		$planid	= trim( aecGetParam( 'plan', null ) );

		$groups = array( 'active', 'expired', 'pending', 'cancelled', 'hold', 'closed' );

		listSubscriptions( $option, $groups, $subscriptionid, $userid, $planid );
		break;

	case 'showexcluded':
		listSubscriptions( $option, 'excluded', $subscriptionid, $userid );
		break;

	case 'showactive':
		listSubscriptions( $option, 'active', $subscriptionid, $userid );
		break;

	case 'showexpired':
		$planid	= trim( aecGetParam( 'plan', null ) );

		listSubscriptions( $option, 'expired', $subscriptionid, $userid, $planid );
		break;

	case 'showpending':
		listSubscriptions( $option, 'pending', $subscriptionid, $userid );
		break;

	case 'showcancelled':
		listSubscriptions( $option, 'cancelled', $subscriptionid, $userid );
		break;

	case 'showhold':
		listSubscriptions( $option, 'hold', $subscriptionid, $userid );
		break;

	case 'showclosed':
		listSubscriptions( $option, 'closed', $subscriptionid, $userid );
		break;

	case 'showmanual':
		listSubscriptions( $option, 'notconfig', $subscriptionid, $userid );
		break;

	case 'showsettings':
		editSettings( $option );
		break;

	case 'savesettings':
		saveSettings( $option );
		break;

	case 'applysettings':
		saveSettings( $option, 1 );
		break;

	case 'cancelsettings':
		cancelSettings( $option );
		break;

	case 'showprocessors':
		listProcessors( $option );
		break;

	case 'newprocessor':
		editProcessor( 0, $option );
		break;

	case 'editprocessor':
		editProcessor( $id[0], $option );
		break;

	case 'saveprocessor':
		saveProcessor( $option );
		break;

	case 'applyprocessor':
		saveProcessor( $option, 1 );
		break;

	case 'cancelprocessor':
		cancelProcessor( $option );
		break;

	case 'publishprocessor':
		changeProcessor( $id, 1, 'active', $option );
		break;

	case 'unpublishprocessor':
		changeProcessor( $id, 0, 'active', $option );
		break;

	case 'showsubscriptionplans':
		listSubscriptionPlans( $option );
		break;

	case 'newsubscriptionplan':
		editSubscriptionPlan( 0, $option );
		break;

	case 'editsubscriptionplan':
		editSubscriptionPlan( $id[0], $option );
		break;

	case 'copysubscriptionplan':
			$database = &JFactory::getDBO();

			if ( is_array( $id ) ) {
				foreach ( $id as $pid ) {
					$row = new SubscriptionPlan( $database );
					$row->load( $pid );
					$row->id = 0;
					$row->storeload();

					$parents = ItemGroupHandler::parentGroups( $pid, 'item' );

					foreach ( $parents as $parentid ) {
						ItemGroupHandler::setChild( $row->id, $parentid, 'item' );
					}
				}
			}

			aecRedirect( 'index2.php?option='. $option . '&task=showSubscriptionPlans' );
		break;

	case 'savesubscriptionplan':
		saveSubscriptionPlan( $option );
		break;

	case 'applysubscriptionplan':
		saveSubscriptionPlan( $option, 1 );
		break;

	case 'publishsubscriptionplan':
		changeSubscriptionPlan( $id, 1, 'active', $option );
		break;

	case 'unpublishsubscriptionplan':
		changeSubscriptionPlan( $id, 0, 'active', $option );
		break;

	case 'visiblesubscriptionplan':
		changeSubscriptionPlan( $id, 1, 'visible', $option );
		break;

	case 'invisiblesubscriptionplan':
		changeSubscriptionPlan( $id, 0, 'visible', $option );
		break;

	case 'removesubscriptionplan':
		removeSubscriptionPlan( $id, $option, $returnTask );
		break;

	case 'cancelsubscriptionplan':
		cancelSubscriptionPlan( $option );
		break;

		case 'orderplanup':
			$database = &JFactory::getDBO();
			$row = new SubscriptionPlan( $database );
			$row->load( $id[0] );
			$row->move( -1 );

			aecRedirect( 'index2.php?option='. $option . '&task=showSubscriptionPlans' );

			break;

		case 'orderplandown':
			$database = &JFactory::getDBO();
			$row = new SubscriptionPlan( $database );
			$row->load( $id[0] );
			$row->move( 1 );

			aecRedirect( 'index2.php?option='. $option . '&task=showSubscriptionPlans' );
			break;

	case 'showitemgroups':
		listItemGroups( $option );
		break;

	case 'newitemgroup':
		editItemGroup( 0, $option );
		break;

	case 'edititemgroup':
		editItemGroup( $id[0], $option );
		break;

	case 'copyitemgroup':
			$database = &JFactory::getDBO();

			if ( is_array( $id ) ) {
				foreach ( $id as $pid ) {
					$row = new ItemGroup( $database );
					$row->load( $pid );
					$row->id = 0;
					$row->storeload();

					$parents = ItemGroupHandler::parentGroups( $pid, 'group' );

					foreach ( $parents as $parentid ) {
						ItemGroupHandler::setChild( $row->id, $parentid, 'group' );
					}
				}
			}

			aecRedirect( 'index2.php?option='. $option . '&task=showItemGroups' );
		break;

	case 'saveitemgroup':
		saveItemGroup( $option );
		break;

	case 'applyitemgroup':
		saveItemGroup( $option, 1 );
		break;

	case 'publishitemgroup':
		changeItemGroup( $id, 1, 'active', $option );
		break;

	case 'unpublishitemgroup':
		changeItemGroup( $id, 0, 'active', $option );
		break;

	case 'visibleitemgroup':
		changeItemGroup( $id, 1, 'visible', $option );
		break;

	case 'invisibleitemgroup':
		changeItemGroup( $id, 0, 'visible', $option );
		break;

	case 'removeitemgroup':
		removeItemGroup( $id, $option, $returnTask );
		break;

	case 'cancelitemgroup':
		cancelItemGroup( $option );
		break;

		case 'ordergroupup':
			$database = &JFactory::getDBO();
			$row = new ItemGroup( $database );
			$row->load( $id[0] );
			$row->move( -1 );

			aecRedirect( 'index2.php?option='. $option . '&task=showItemGroups' );
			break;

		case 'ordergroupdown':
			$database = &JFactory::getDBO();
			$row = new ItemGroup( $database );
			$row->load( $id[0] );
			$row->move( 1 );

			aecRedirect( 'index2.php?option='. $option . '&task=showItemGroups' );
			break;

	case 'showmicrointegrations':
		listMicroIntegrations( $option );
		break;

	case 'newmicrointegration':
		editMicroIntegration( 0, $option );
		break;

	case 'editmicrointegration':
		editMicroIntegration( $id[0], $option );
		break;

	case 'savemicrointegration':
		saveMicroIntegration( $option );
		break;

	case 'applymicrointegration':
		saveMicroIntegration( $option, 1 );
		break;

	case 'copymicrointegration':
			$database = &JFactory::getDBO();

			if ( is_array( $id ) ) {
				foreach ( $id as $pid ) {
				$row = new microIntegration( $database );
				$row->load( $pid );
				$row->id = 0;
				$row->check();
				$row->store();
				}
			}

			aecRedirect( 'index2.php?option='. $option . '&task=showMicroIntegrations' );
		break;

	case 'publishmicrointegration':
		changeMicroIntegration( $id, 1, $option );
		break;

	case 'unpublishmicrointegration':
		changeMicroIntegration( $id, 0, $option );
		break;

	case 'removemicrointegration':
		removeMicroIntegration( $id, $option, $returnTask );
		break;

	case 'cancelmicrointegration':
		cancelMicroIntegration( $option );
		break;

		case 'ordermiup':
			$database = &JFactory::getDBO();
			$row = new microIntegration( $database );
			$row->load( $id[0] );
			$row->move( -1 );

			if ( aecJoomla15check() ) {
				global $mainframe;

				$mainframe->redirect( 'index2.php?option='. $option . '&task=showMicroIntegrations' );
			} else {
				aecRedirect( 'index2.php?option='. $option . '&task=showMicroIntegrations' );
			}

			break;

		case 'ordermidown':
			$database = &JFactory::getDBO();
			$row = new microIntegration( $database );
			$row->load( $id[0] );
			$row->move( 1 );

			if ( aecJoomla15check() ) {
				global $mainframe;

				$mainframe->redirect( 'index2.php?option='. $option . '&task=showMicroIntegrations' );
			} else {
				aecRedirect( 'index2.php?option='. $option . '&task=showMicroIntegrations' );
			}

			break;

	case 'showcoupons':
		listCoupons( $option, 0);
		break;

	case 'copycoupon':
			$database = &JFactory::getDBO();

			if ( is_array( $id ) ) {
				foreach ( $id as $pid ) {
				$row = new Coupon( $database, 0 );
				$row->load( $pid );
				$row->id = 0;
				$row->coupon_code = $row->generateCouponCode();
				$row->check();
				$row->store();
				}
			}

			aecRedirect( 'index2.php?option='. $option . '&task=showCoupons' );
		break;

	case 'newcoupon':
		editCoupon( 0, $option, 1, 0 );
		break;

	case 'editcoupon':
		editCoupon( $id[0], $option, 0, 0 );
		break;

	case 'savecoupon':
		saveCoupon( $option, 0 );
		break;

	case 'applycoupon':
		saveCoupon( $option, 0, 1 );
		break;

	case 'publishcoupon':
		changeCoupon( $id, 1, $option, 0 );
		break;

	case 'unpublishcoupon':
		changeCoupon( $id, 0, $option, 0 );
		break;

	case 'removecoupon':
		removeCoupon( $id, $option, $returnTask, 0 );
		break;

	case 'cancelcoupon':
		cancelCoupon( $option, 0 );
		break;

	case 'showcouponsstatic':
		listCoupons( $option, 1);
		break;

	case 'copycouponstatic':
		$database = &JFactory::getDBO();

		if ( is_array( $id ) ) {
			foreach ( $id as $pid ) {
			$row = new Coupon( $database, 1 );
			$row->load( $pid );
			$row->id = 0;
			$row->coupon_code = $row->generateCouponCode();
			$row->check();
			$row->store();
			}
		}

		if ( aecJoomla15check() ) {
			global $mainframe;

			$mainframe->redirect( 'index2.php?option='. $option . '&task=showCouponsStatic' );
		} else {
			aecRedirect( 'index2.php?option='. $option . '&task=showCouponsStatic' );
		}

		break;

	case 'newcouponstatic':
		editCoupon( 0, $option, 1, 1 );
		break;

	case 'editcouponstatic':
		editCoupon( $id[0], $option, 0, 1 );
		break;

	case 'savecouponstatic':
		saveCoupon( $option, 1 );
		break;

	case 'applycouponstatic':
		saveCoupon( $option, 1, 1 );
		break;

	case 'publishcouponstatic':
		changeCoupon( $id, 1, $option, 1 );
		break;

	case 'unpublishcouponstatic':
		changeCoupon( $id, 0, $option, 1 );
		break;

	case 'removecouponstatic':
		removeCoupon( $id, $option, $returnTask, 1 );
		break;

	case 'cancelcouponstatic':
		cancelCoupon( $option, 1 );
		break;

		case 'ordercouponup':
			$database = &JFactory::getDBO();
			$row = new coupon( $database, 0 );
			$row->load( $id[0] );
			$row->move( -1 );

			if ( aecJoomla15check() ) {
				global $mainframe;

				$mainframe->redirect( 'index2.php?option='. $option . '&task=showCoupons' );
			} else {
				aecRedirect( 'index2.php?option='. $option . '&task=showCoupons' );
			}

				break;

		case 'ordercoupondown':
			$database = &JFactory::getDBO();
			$row = new coupon( $database, 0 );
			$row->load( $id[0] );
			$row->move( 1 );

			if ( aecJoomla15check() ) {
				global $mainframe;

				$mainframe->redirect( 'index2.php?option='. $option . '&task=showCoupons' );
			} else {
				aecRedirect( 'index2.php?option='. $option . '&task=showCoupons' );
			}

				break;

		case 'ordercouponstaticup':
			$database = &JFactory::getDBO();
			$row = new coupon( $database, 1 );
			$row->load( $id[0] );
			$row->move( -1 );

			if ( aecJoomla15check() ) {
				global $mainframe;

				$mainframe->redirect( 'index2.php?option='. $option . '&task=showCouponsStatic' );
			} else {
				aecRedirect( 'index2.php?option='. $option . '&task=showCouponsStatic' );
			}

				break;

		case 'ordercouponstaticdown':
			$database = &JFactory::getDBO();
			$row = new coupon( $database, 1 );
			$row->load( $id[0] );
			$row->move( 1 );

			if ( aecJoomla15check() ) {
				global $mainframe;

				$mainframe->redirect( 'index2.php?option='. $option . '&task=showCouponsStatic' );
			} else {
				aecRedirect( 'index2.php?option='. $option . '&task=showCouponsStatic' );
			}

				break;

	case 'editcss':
		editCSS( $option );
		break;

	case 'savecss':
		saveCSS( $option );
		break;

	case 'cancelcss':
		cancelCSS( $option );
		break;

		case 'about':
		about( );
		break;

		case 'hacks':
		$undohack	= aecGetParam( 'undohack', 0 );
		$filename	= aecGetParam( 'filename', 0 );
		$check_hack	= $filename ? 0 : 1;

		hackcorefile( $option, $filename, $check_hack, $undohack );

		HTML_AcctExp::hacks( $option, hackcorefile( $option, 0, 1, 0 ) );
		break;

		case 'help':
		help( $option );
		break;

	case 'invoices':
		invoices( $option );
		break;

	case 'history':
		history( $option );
		break;

	case 'eventlog':
		eventlog( $option );
		break;

	case 'readout':
		readout( $option );
		break;

	case 'export':
		exportData( $option );
		break;

	case 'loadexport':
		exportData( $option, 'load' );
		break;

	case 'applyexport':
		exportData( $option, 'apply' );
		break;

	case 'exportexport':
		exportData( $option, 'export' );
		break;

	case 'saveexport':
		exportData( $option, 'save' );
		break;

	case 'import':
		importData( $option );
		break;

	case 'credits':
		HTML_AcctExp::credits();
		break;

	case 'migrate':
		migrate( $option );
		break;

	case 'quicklookup':
		$return = quicklookup( $option );

		if ( is_array( $return ) ) {
			aecCentral( $option, $return['return'], $return['search'] );
		} elseif ( strpos( $return, '</a>' ) || strpos( $return, '</div>' ) ) {
			aecCentral( $option, $return );
		} elseif ( !empty( $return ) ) {
			aecRedirect( 'index2.php?option=' . $option . '&task=edit&userid=' . $return, _AEC_QUICKSEARCH_THANKS );
		} else {
			aecRedirect( 'index2.php?option=' . $option . '&task=showcentral', _AEC_QUICKSEARCH_NOTFOUND );
		}
		break;

	case 'readnotice':
		$database = &JFactory::getDBO();

		$query = 'UPDATE #__acctexp_eventlog'
				. ' SET `notify` = \'0\''
				. ' WHERE `id` = \'' . $id[0] . '\''
				;
		$database->setQuery( $query	);
		$database->query();

		aecCentral( $option );
		break;

	case 'readallnotices':
		$database = &JFactory::getDBO();

		$query = 'UPDATE #__acctexp_eventlog'
				. ' SET `notify` = \'0\''
				. ' WHERE `notify` = \'1\''
				;
		$database->setQuery( $query	);
		$database->query();

		aecCentral( $option );
		break;

	case 'recallinstall':
		include_once( JPATH_SITE . '/administrator/components/com_acctexp/install/install.acctexp.php' );
		com_install();
		break;

	case 'add': editUser( null, $userid, $option, 'notconfig' ); break;

	default:
		aecCentral( $option );
		break;
}

/**
* Central Page
*/
function aecCentral( $option, $searchresult=null, $searchcontent=null )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$query = 'SELECT *'
			. ' FROM #__acctexp_eventlog'
			. ' WHERE `notify` = \'1\''
			. ' ORDER BY `datetime` DESC'
			. ' LIMIT 0, 10'
			;
	$database->setQuery( $query	);
	$notices = $database->loadObjectList();

 	HTML_AcctExp::central( $searchresult, $notices, $searchcontent );
}

/**
* Cancels an edit operation
*/
function cancel( $option )
{
	$database = &JFactory::getDBO();

	global $mainframe;

 	$limit		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart = $mainframe->getUserStateFromRequest( "viewnotconf{$option}limitstart", 'limitstart', 0 );
	$nexttask	= aecGetParam( 'nexttask', 'config' ) ;

	if ( aecJoomla15check() ) {
		$mainframe->redirect( 'index2.php?option=' . $option . '&task=' . $nexttask, _CANCELED );
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=' . $nexttask, _CANCELED );
	}
}

function help( $option )
{
	$database = &JFactory::getDBO();

	global $mainframe, $aecConfig;

	// diagnostic is the overall array that stores relational data that either gets transferred directly into the
	// diagnose array or that is used in the process of that
	$diagonstic = array();

	// Check for correct Global Settings:
	$diagnostic['reachable']			= ( substr_count( JURI::root(), 'http://' ) || substr_count( JURI::root(), 'https://' ) );
	$diagnostic['offline']				= $mainframe->getCfg( 'offline' );
	$diagnostic['user_registration']	= $mainframe->getCfg( 'allowUserRegistration' );
	$diagnostic['login_possible']		= $mainframe->getCfg( 'frontend_login' );

	$paypal = new PaymentProcessor();
	$paypal->loadName( 'paypal' );
	if ( $paypal->id ) {
		$paypal->init();
		$paypal->getSettings();

		$diagnostic['paypal']			= 1;
		$diagnostic['pp_checkbusiness'] = $paypal->settings['checkbusiness'];
	}

	$hacks = hackcorefile( $option, 0, 1, 0 );

	if ( isset( $_SERVER['SERVER_SOFTWARE'] ) ) {
		$diagnostic['server_software']	= $_SERVER['SERVER_SOFTWARE'];
	}

	// Test for Components to be integrated
	$diagnostic['cb']					= GeneralInfoRequester::detect_component( 'CB' );
	$diagnostic['cbe']					= GeneralInfoRequester::detect_component( 'CBE' );
	$diagnostic['jacl']					= GeneralInfoRequester::detect_component( 'JACL' );
	// general
	$diagnostic['permission_problem'] 	= 0;
	$diagnostic['hacks_legacy']			= 0;

	// Test for file permissions
	foreach ( $hacks as $hack_name => $hack_content ) {
		$diagnostic['hack_' . $hack_name] = ( !empty( $hack_content['status'] ) && $hack_content['status'] > 0 ) ? 1 : 0;

		if ( !empty( $hack_content['legacy'] ) && ( $hack_content['status'] != 0 ) ) {
			$diagnostic['hacks_legacy'] = 1;
		}
		if ( isset( $hack_content['fileinfo']['gecos'] ) ) {
			$diagnostic['hack_' . $hack_name . '_permission'] = ( strpos( $hack_content['fileinfo']['gecos'], 'apache' ) ) ? 1 : 0;
			if ( !$diagnostic['hack_' . $hack_name] ) {
				if ( !$diagnostic['hack_' . $hack_name . '_permission'] && ( $hack_content['status'] == 0 ) ) {
					$diagnostic['permission_problem']++;
				} else {
					$diagnostic['no_permission_problem']++;
				}
			}
		} elseif ( $hack_content['status'] == 0 ) {
			$diagnostic['no_permission_problem']++;
		}
	}

	$diagnostic['posix_getpwuid_available'] = function_exists( 'posix_getpwuid' );

	$objentry	= null;

	$query = 'SELECT *'
			. ' FROM #__acctexp_plans'
		 	. ' WHERE `active` = \'1\''
		 	;
 	$database->setQuery( $query );
	if ( aecJoomla15check() ) {
		$objentry = $database->loadObject();
	} else {
		$database->loadObject($objentry);
	}

 	if ( $objentry ) {
 		$diagnostic['no_plan'] = 0;
 	} else {
 		$diagnostic['no_plan'] = 1;
 	}

 	if ( !empty( $aecConfig->cfg['entry_plan'] ) ) {
 		$diagnostic['global_entry'] = 1;
 	} else {
 		$diagnostic['global_entry'] = 0;
 	}

	// Check for Modules and whether they are enabled
	$modules = array();
	$modules[] = array( 'mod_comprofilermoderator',	'cb_comprofilermoderator', 'cb_comprofilermoderator_enabled' );

	$mod_check = null;
	for( $i = 0; $i < count( $modules ); $i++ ) {
		$result = null;
		$module = $modules[$i][0];

		$query = 'SELECT `published`'
				. ' FROM #__modules'
				. ' WHERE `module` = \'' . $module . '\''
				;
		$database->setQuery( $query );
		$result = $database->loadResult();

		if ( $result == 1 ) {
			$diagnostic[$modules[$i][1]] = 1;
			$diagnostic[$modules[$i][2]] = 1;
		} elseif ( $result == 0 ) {
			$diagnostic[$modules[$i][1]] = 1;
			$diagnostic[$modules[$i][2]] = 0;
		} elseif ( $result == null ) {
			$diagnostic[$modules[$i][1]] = 0;
			$diagnostic[$modules[$i][2]] = 0;
		}
	}

	/**
	 * Diagnose Helper
	 * Syntax:
	 * 1. Name
	 * 2. Status
	 * 3. Importance (1 - Low | 2 - Recommended | 3 - Critical)
	 * 4. Explaination
	 * 5. Advice
	 * 6. Detect Only (0:No, 1:Yes -Don't display if Status=0)
	 */
	$pdfPath = JURI::root() . 'administrator/components/com_acctexp/manual/';
	if ( file_exists( JPATH_SITE . '/administrator/components/com_acctexp/manual/AEC_Quickstart.' . _AEC_LANGUAGE . '.pdf' ) ) {
		$pdfHelp = $pdfPath . 'AEC_Quickstart.' . _AEC_LANGUAGE . '.pdf';
	} else {
		$pdfHelp = $pdfPath . 'AEC_Quickstart.pdf';
	}

	$diagnose	= array();
	//$diagnose[]	= array( _AEC_HELP_QS_HEADER, 1, 1, aecHTML::Icon( 'page_white_acrobat.png' ) . sprintf( _AEC_HELP_QS_DESC, '<a href="' . $pdfHelp . '" target="_blank" title="' . _AEC_HELP_QS_DESC_LTEXT . '">' . _AEC_HELP_QS_DESC_LTEXT . '</a>' ), '', 0 );

/*
	$diagnose[]	= array("AEC Version", $diagnostic['AEC_stable'], 1, "You are running the most recent stable Version of the AEC", 0, 1);
	$diagnose[]	= array("AEC Version", !$diagnostic['AEC_stable'], 3, "There appears to be a more recent Version of the AEC available on <a href=\"http://www.valanx.org\">www.valanx.org</a>", 0, 1);
*/
	// Apache related file permission problems
	if ( substr_count( $diagnostic['server_software'], 'Apache' ) && !$diagnostic['no_permission_problem'] ) {
		if ( $diagnostic['posix_getpwuid_available'] ) {
			$diagnose[]	= array( _AEC_HELP_SER_SW_DIAG1, $diagnostic['permission_problem'], 3, _AEC_HELP_SER_SW_DIAG1_DESC, _AEC_HELP_SER_SW_DIAG1_DESC2, 1 );
			$diagnose[]	= array( _AEC_HELP_SER_SW_DIAG2, !@$diagnostic['hack_joomlaphp_permission'], 3, _AEC_HELP_SER_SW_DIAG2_DESC, _AEC_HELP_SER_SW_DIAG2_DESC2, 1 );
			$diagnose[]	= array( _AEC_HELP_SER_SW_DIAG3, $diagnostic['hacks_legacy'], 3, _AEC_HELP_SER_SW_DIAG3_DESC, _AEC_HELP_SER_SW_DIAG3_DESC2, 1 );
		} else {
			$diagnose[]	= array( _AEC_HELP_SER_SW_DIAG4, !$diagnostic['posix_getpwuid_available'], 3, _AEC_HELP_SER_SW_DIAG4_DESC, _AEC_HELP_SER_SW_DIAG4_DESC2, 1 );
		}
	}

	// generic CMS changes
	if ( !aecJoomla15check() ) {
		$diagnose[]	= array( _AEC_HELP_DIAG_CMN1, $diagnostic['hack_joomlaphp4'], 3, _AEC_HELP_DIAG_CMN1_DESC, _AEC_HELP_DIAG_CMN1_DESC2, 0 );
	}

	// menu entry
	$diagnose[]	= array( _AEC_HELP_DIAG_CMN2, $diagnostic['hack_menuentry'], 2, _AEC_HELP_DIAG_CMN2_DESC, _AEC_HELP_DIAG_CMN2_DESC2, 0 );

	// no active plan
	$diagnose[]	= array( _AEC_HELP_DIAG_NO_PAY_PLAN, $diagnostic['no_plan'], 3, _AEC_HELP_DIAG_NO_PAY_PLAN_DESC, 0, 1 );

	// global entry plan
	$diagnose[]	= array( _AEC_HELP_DIAG_GLOBAL_PLAN, $diagnostic['global_entry'], 1, _AEC_HELP_DIAG_GLOBAL_PLAN_DESC, 0, 1 );

	// server is not reachable
	$diagnose[]	= array( _AEC_HELP_DIAG_SERVER_NOT_REACHABLE, !$diagnostic['reachable'], 3, _AEC_HELP_DIAG_SERVER_NOT_REACHABLE_DESC, 0, 1 );

	// site offline
	$diagnose[]	= array( _AEC_HELP_DIAG_SITE_OFFLINE, $diagnostic['offline'], 3, _AEC_HELP_DIAG_SITE_OFFLINE_DESC, 0, 1 );

	if ( !aecJoomla15check() ) {
		// disabled registration
		$diagnose[]	= array( _AEC_HELP_DIAG_REG_DISABLED, !$diagnostic['user_registration'], 2, _AEC_HELP_DIAG_REG_DISABLED_DESC, 0, 1 );

		// login disabled
		$diagnose[]	= array( _AEC_HELP_DIAG_LOGIN_DISABLED, !$diagnostic['login_possible'], 2, _AEC_HELP_DIAG_LOGIN_DISABLED_DESC, 0, 1 );
	}

	// check JACL
	$diagnose[]	= array( _AEC_HELP_DIAG_CMN3, !$diagnostic['jacl'], 1, _AEC_HELP_DIAG_CMN3_DESC, 0, 1 );

	if ( !empty( $diagnostic['paypal'] ) ) {
		$diagnose[]	= array( _AEC_HELP_DIAG_PAYPAL_BUSS_ID, $diagnostic['pp_checkbusiness'], 2, _AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC, _AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC1, 1 );
	}

	HTML_AcctExp::help( $option, $diagnose ) ;
}

function editUser(  $option, $userid, $subscriptionid, $task )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	if ( !empty( $subscriptionid[0] ) ) {
		$sid = $subscriptionid[0];
	} else {
		$sid = 0;
	}

	$lists = array();

	$metaUser = new metaUser( $userid[0] );

	if ( !empty( $sid ) ) {
		$metaUser->moveFocus( $sid );
	} else {
		if ( $metaUser->hasSubscription ) {
			$sid = $metaUser->focusSubscription->id;
		}
	}

	if ( $metaUser->loadSubscriptions() && !empty( $sid ) ) {
		foreach ( $metaUser->allSubscriptions as $s_id => $s_c ) {
			if ( $s_c->id == $sid ) {
				$metaUser->allSubscriptions[$s_id]->current_focus = true;
				continue;
			}
		}
	}

	$invoices_limit	= 15;	// Returns last 15 payments

 	// get payments of user
 	$query = 'SELECT `id`'
		 	. ' FROM #__acctexp_invoices'
		 	. ' WHERE `userid` = \'' . $userid[0] . '\''
		 	. ' ORDER BY `transaction_date` DESC'
		 	;
 	$database->setQuery( $query );
 	$invoice_ids = $database->loadResultArray();
 	if ( $database->getErrorNum() ) {
 		echo $database->stderr();
 		return false;
 	}

	$group_selection = array();
	$group_selection[] = mosHTML::makeOption( '',			_EXPIRE_SET );
	$group_selection[] = mosHTML::makeOption( 'now',		_EXPIRE_NOW );
	$group_selection[] = mosHTML::makeOption( 'exclude',	_EXPIRE_EXCLUDE );
	$group_selection[] = mosHTML::makeOption( 'include',	_EXPIRE_INCLUDE );
	$group_selection[] = mosHTML::makeOption( 'close',		_EXPIRE_CLOSE );
	$group_selection[] = mosHTML::makeOption( 'hold',		_EXPIRE_HOLD );

	$lists['set_status'] = mosHTML::selectList( $group_selection, 'set_status', 'class="inputbox" size="1"', 'value', 'text', '' );

	$invoices = array();
	$couponsh = array();
	$invoice_counter = 0;

	foreach ( $invoice_ids as $inv_id ) {
		$invoice = new Invoice( $database );
		$invoice->load ($inv_id );

		if ( !empty( $invoice->coupons ) ) {
			foreach( $invoice->coupons as $coupon_code ) {
				if ( !isset( $couponsh[$coupon_code] ) ) {
					$couponsh[$coupon_code] = couponHandler::idFromCode( $coupon_code );
				}

				$couponsh[$coupon_code]['invoices'][] = $invoice->invoice_number;
			}
		}

		if ( $invoice_counter >= $invoices_limit && ( strcmp( $invoice->transaction_date, '0000-00-00 00:00:00' ) !== 0 ) ) {
			continue;
		} else {
			$invoice_counter++;
		}

		$status = 'uncleared';

		if ( isset( $invoice->params['deactivated'] ) ) {
			$status = 'deactivated';
		} elseif ( isset( $invoice->params['pending_reason'] ) ) {
			if (  defined( '_PAYMENT_PENDING_REASON_' . strtoupper( $invoice->params['pending_reason'] ) ) ) {
				$status = constant( '_PAYMENT_PENDING_REASON_' . strtoupper($invoice->params['pending_reason'] ) );
			} else {
				$status = $invoice->params['pending_reason'];
			}
		}

		if ( strcmp( $invoice->transaction_date, '0000-00-00 00:00:00' ) === 0 ) {
			$actions = '<a href="'
			. AECToolbox::deadsureURL( 'index.php?option=' . $option . '&task=repeatPayment&invoice='
			. $invoice->invoice_number ) . '">'
			. aecHTML::Icon( 'arrow_redo.png' ) . "&nbsp;"
			. _USERINVOICE_ACTION_REPEAT . '</a>'
			. '<br />'
			. '<a href="'
			. AECToolbox::deadsureURL( 'administrator/index2.php?option=' . $option . '&task=cancelpayment&invoice='
			. $invoice->invoice_number . '&returnTask=edit&userid=' . $metaUser->userid ) . '">'
			. aecHTML::Icon( 'delete.png' ) . '&nbsp;'
			. _USERINVOICE_ACTION_CANCEL . '</a>'
			. '<br />'
			. '<a href="'
			. AECToolbox::deadsureURL( 'administrator/index2.php?option=' . $option . '&task=clearpayment&invoice='
			. $invoice->invoice_number . '&returnTask=edit&userid=' . $metaUser->userid ) . '">'
			. aecHTML::Icon( 'coins.png' ) . '&nbsp;'
			. _USERINVOICE_ACTION_CLEAR . '</a>'
			. '<br />'
			. '<a href="'
			. AECToolbox::deadsureURL( 'administrator/index2.php?option=' . $option . '&task=clearpayment&invoice='
			. $invoice->invoice_number . '&applyplan=1&returnTask=edit&userid=' . $metaUser->userid ) . '">'
			. aecHTML::Icon( 'coins_add.png' ) . '&nbsp;'
			. _USERINVOICE_ACTION_CLEAR_APPLY . '</a>'
			. '<br />';
			$rowstyle = ' style="background-color:#fee;"';
		} else {
			$status		= $invoice->transaction_date;
			$actions	= '- - -';
			$rowstyle	= '';
		}

		$non_formatted = $invoice->invoice_number;
		$invoice->formatInvoiceNumber();
		$is_formatted = $invoice->invoice_number;

		if ( $non_formatted != $is_formatted ) {
			$is_formatted = $non_formatted . "\n" . '(' . $is_formatted . ')';
		}

		$invoices[$inv_id] = array();
		$invoices[$inv_id]['rowstyle']			= $rowstyle;
		$invoices[$inv_id]['invoice_number']	= $is_formatted;
		$invoices[$inv_id]['amount']			= $invoice->amount . '&nbsp;' . $invoice->currency;
		$invoices[$inv_id]['status']			= $status;
		$invoices[$inv_id]['processor']			= $invoice->method;
		$invoices[$inv_id]['usage']				= $invoice->usage;
		$invoices[$inv_id]['actions']			= $actions;
	}

	$coupons = array();

	$coupon_counter = 0;
	foreach ( $couponsh as $coupon_code => $coupon ) {
		if ( $coupon_counter >= 10 ) {
			continue;
		} else {
			$coupon_counter++;
		}

		$cc = array();
		$cc['coupon_code']	= '<a href="index2.php?option=com_acctexp&amp;task=' . ( $coupon['type'] ? 'editcouponstatic' : 'editcoupon' ) . '&amp;id=' . $coupon['id'] . '">' . $coupon_code . '</a>';
		$cc['invoices']		= implode( ", ", $coupon['invoices'] );

		$coupons[] = $cc;
	}

	// get available plans
	$available_plans	= array();
	$available_plans[]	= mosHTML::makeOption( '0', _PAYPLAN_NOPLAN );

	$query = 'SELECT `id` AS value, `name` AS text'
			. ' FROM #__acctexp_plans'
			. ' WHERE `active` = \'1\''
			;
	$database->setQuery( $query	);

	$dbaplans = $database->loadObjectList();

	if ( is_array( $dbaplans ) ) {
 		$available_plans	= array_merge( $available_plans, $database->loadObjectList() );
	}
	$total_plans		= count( $available_plans ) + 1;

	$selected_plan = isset( $row->fallback ) ? $row->fallback : '';

	$lists['assignto_plan'] = mosHTML::selectList( $available_plans, 'assignto_plan', 'size="5"', 'value', 'text', 0 );

	$mi = array();

	$userMIs = $metaUser->getUserMIs();

	$mi['profile']		= array();
	$mi['admin']		= array();
	$mi['profile_form']	= array();
	$mi['admin_form']	= array();

	foreach ( $userMIs as $m ) {
		$pref = 'mi_'.$m->id.'_';

		$ui = $m->profile_info( $metaUser );
		if ( !empty( $ui ) ) {
			$mi['profile'][] = array( 'name' => $m->info['name'] . ' - ' . $m->name, 'info' => $ui );
		}

		$uf = $m->profile_form( $metaUser );
		if ( !empty( $uf ) ) {
			foreach ( $uf as $k => $v ) {
				$mi['profile_form'][] = $pref.$k;
				$params[$pref.$k] = $v;
			}
		}

		$ai = $m->admin_info( $metaUser );
		if ( !empty( $ai ) ) {
			$mi['admin'][] = array( 'name' => $m->info['name'] . ' - ' . $m->name, 'info' => $ai );
		}

		$af = $m->admin_form( $metaUser );
		if ( !empty( $af ) ) {
			foreach ( $af as $k => $v ) {
				$mi['admin_form'][] = $pref.$k;
				$params[$pref.$k] = $v;
			}
		}
	}

	if ( !empty( $params ) ) {
		$settings = new aecSettings ( 'userForm', 'mi' );
		$settings->fullSettingsArray( $params, array(), $lists ) ;

		// Call HTML Class
		$aecHTML = new aecHTML( $settings->settings, $settings->lists );
	} else {
		$aecHTML = false;
	}

	HTML_AcctExp::userForm( $option, $metaUser, $invoices, $coupons, $mi, $lists, $task, $aecHTML );
}

function saveUser( $option, $apply=0 )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$metaUser = new metaUser( $_POST['userid'] );
	$established = false;

	if ( $metaUser->hasSubscription && !empty( $_POST['id'] ) ) {
		$metaUser->moveFocus( $_POST['id'] );
	}

	$ck_primary = aecGetParam( 'ck_primary', 'off' );

	if ( ( strcmp( $ck_primary, 'on' ) == 0 ) && !$metaUser->focusSubscription->primary ) {
		$metaUser->focusSubscription->makePrimary();
	}

	if ( !empty( $_POST['assignto_plan'] ) ) {
		$plan = new SubscriptionPlan( $database );
		$plan->load( $_POST['assignto_plan'] );

		$metaUser->establishFocus( $plan );

		$metaUser->focusSubscription->applyUsage( $_POST['assignto_plan'], 'none', 1 );

		// We have to reload the metaUser object because of the changes
		$metaUser = new metaUser( $_POST['userid'] );

		$established = true;
	}

	$ck_lifetime = aecGetParam( 'ck_lifetime', 'off' );

	if( $metaUser->focusSubscription == NULL )
	{
		echo "<script> alert('"._AEC_ERR_NO_SUBSCRIPTION."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( strcmp( $ck_lifetime, 'on' ) == 0 ) {
		$metaUser->focusSubscription->expiration	= '9999-12-31 00:00:00';
		$metaUser->focusSubscription->status		= 'Active';
		$metaUser->focusSubscription->lifetime	= 1;
	} elseif ( !empty( $_POST['expiration'] ) ) {
		if ( $_POST['expiration'] != $_POST['expiration_check'] ) {
			if ( strpos( $_POST, ':' ) === false ) {
				$metaUser->focusSubscription->expiration = $_POST['expiration'] . ' 00:00:00';
			} else {
				$metaUser->focusSubscription->expiration = $_POST['expiration'];
			}
			$metaUser->focusSubscription->status = 'Active';
			$metaUser->focusSubscription->lifetime = 0;
		}
	}

	$set_status = trim( aecGetParam( 'set_status', null ) );

	if ( !is_null( $set_status ) ) {
		if ( strcmp( $set_status, 'now' ) === 0 ) {
			$metaUser->focusSubscription->expire();
		} else {
			$statusstatus = array( 'exclude' => 'Excluded', 'Closed' => 'Closed', 'include' => 'Active', 'hold' => 'Hold' );

			if ( isset( $statusstatus[$set_status] ) ) {
				$metaUser->focusSubscription->setStatus( $statusstatus[$set_status] );
			}
		}
	}

	if ( !empty( $_POST['notes'] ) ) {
		$metaUser->focusSubscription->customparams['notes'] = $_POST['notes'];
	}

	$userMIs = $metaUser->getUserMIs();

	if ( !empty( $userMIs ) ) {
		foreach ( $userMIs as $m ) {
			$params = array();

			$pref = 'mi_'.$m->id.'_';

			$uf = $m->profile_form( $metaUser );
			if ( !empty( $uf ) ) {
				foreach ( $uf as $k => $v ) {
					if ( isset( $_POST[$pref.$k] ) ) {
						$params[$k] = $_POST[$pref.$k];
					}
				}

				$m->profile_form_save( $metaUser );
			}

			$af = $m->admin_form( $metaUser );
			if ( !empty( $af ) ) {
				foreach ( $af as $k => $v ) {
					if ( isset( $_POST[$pref.$k] ) ) {
						$params[$k] = $_POST[$pref.$k];
					}
				}

				$m->admin_form_save( $metaUser );
			}

			if ( empty( $params ) ) {
				continue;
			}

			$metaUser->meta->setMIParams( $m->id, null, $params, true );
		}

		$metaUser->meta->storeload();
	}

	if ( $metaUser->hasSubscription || $established ) {
		$metaUser->focusSubscription->storeload();
	}

 	$limit		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart	= $mainframe->getUserStateFromRequest( "viewnotconf{$option}limitstart", 'limitstart', 0 );

	$nexttask	= aecGetParam( 'nexttask', 'config' ) ;
	if ( $apply ) {
		$subID = !empty($_POST['id']) ? $_POST['id'] : $metaUser->focusSubscription->id;
		aecRedirect( 'index2.php?option=' . $option . '&task=edit&subscriptionid=' . $subID, _AEC_MSG_SUCESSFULLY_SAVED );
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=' . $nexttask, _SAVED );
	}
}

function removeUser( $userid, $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	// $userid contains values corresponding to id field of #__acctexp table
		if ( !is_array( $userid ) || count( $userid ) < 1 ) {
			echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
			exit;
		}

	$userids	= implode( ',', $userid );
	$msg		= _REMOVED;

	if ( count( $userid ) ) {
		$obj = new JTableUser( $database );
		foreach ( $userid as $id ) {
			// Get REAL UserID
			$query = 'SELECT userid'
					. ' FROM #__acctexp'
					. ' WHERE `id` = ' . $id
					;
			$uid = null;
			$database->setQuery( $query );
			$uid = $database->loadResult();

			if ( $uid ) {
				// check for a super admin ... can't delete them
				$groups		= $acl->get_object_groups( 'users', $uid, 'ARO' );
				$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );

				if ( $this_group == 'super administrator' ) {
					$msg = _AEC_MSG_NODELETE_SUPERADMIN;
				} elseif ( $uid == $user->id ){
					$msg = _AEC_MSG_NODELETE_YOURSELF;
				} elseif ( ( $this_group == 'administrator' ) && ( $user->gid == 24 ) ){
					$msg = _AEC_MSG_NODELETE_EXCEPT_SUPERADMIN;
				} else {
					$query = 'DELETE FROM #__acctexp'
					. ' WHERE userid = ' . $uid
					;
				 	$database->setQuery( $query );
					if (!$database->query()) {
						echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
					}
					if ( !$obj->delete( $uid ) ) {
						$msg = $obj->getError();
					}
				}
			}
		}
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=showManual', $msg );
}

function removeClosedSubscription( $userid, $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	global $mainframe;

	// $userid contains values corresponding to id field of #__acctexp table
		if ( !is_array( $userid ) || count( $userid ) < 1 ) {
			echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
			exit;
		}

	$userids = implode(',', $userid);
	$query  = 'DELETE FROM #__acctexp'
			. ' WHERE `userid` IN (' . $userids . ')'
			;
 	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	// Delete from the payment history
	$query = 'DELETE FROM #__acctexp_log_history'
			. ' WHERE `user_id` IN (' . $userids . ')'
			;
 	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	// CB&CBE Integration
	$tables	= array();
	$tables	= $database->getTableList();

	if ( GeneralInfoRequester::detect_component('CB') && GeneralInfoRequester::detect_component('CBE') ) {
		$query = 'DELETE FROM #__comprofiler'
				. ' WHERE `id` IN (' . $userids . ')'
				;
		$database->setQuery($query);
		$database->query();
	}

	$msg = _REMOVED;
	if ( count( $userid ) ) {
		$obj = new JTableUser( $database );
		foreach ( $userid as $id ) {
			// check for a super admin ... can't delete them
			$groups		= $acl->get_object_groups( 'users', $id, 'ARO' );
			$this_group	= strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );

			if ( $this_group == 'super administrator' ) {
				$msg = _AEC_MSG_NODELETE_SUPERADMIN;
			} else if ( $id == $user->id ) {
				$msg = _AEC_MSG_NODELETE_YOURSELF;
			} else if ( ( $this_group == 'administrator' ) && ( $user->gid == 24 ) ) {
				$msg = _AEC_MSG_NODELETE_EXCEPT_SUPERADMIN;
			} else {
				if ( !$obj->delete( $id ) ) {
					$msg = $obj->getError();
				}
			}
		}
	}

	$query = 'DELETE FROM #__acctexp_subscr'
			. ' WHERE `userid` IN (' . $userids . ')'
			;
 	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=showClosed', $msg );

}

function activateClosedSubscription( $userid, $option )
{}

function removePendingSubscription( $userid, $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	global $mainframe;

	// $userid contains values corresponding to id field of #__acctexp table
		if ( !is_array( $userid ) || count( $userid ) < 1 ) {
			echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
			exit;
		}

	$userids = implode(',', $userid);

	$query = 'DELETE FROM #__acctexp'
			. ' WHERE `userid` IN (' . $userids . ')'
			;
 	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	$query = 'DELETE FROM #__acctexp_log_history'
			. ' WHERE `user_id` IN (' . $userids . ')'
			;
 	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	// CB&CBE Integration
	$tables	= array();
	$tables	= $database->getTableList();

	if ( GeneralInfoRequester::detect_component( 'CB' ) && GeneralInfoRequester::detect_component( 'CBE' ) ) {
		$query = 'DELETE FROM #__comprofiler'
				. ' WHERE `id` IN (' . $userids . ')'
				;
		$database->setQuery( $query );
		$database->query();
	}

	$msg = _REMOVED;
	if ( count( $userid ) ) {
		$obj = new JTableUser( $database );
		foreach ($userid as $id) {
			// check for a super admin ... can't delete them
			$groups         = $acl->get_object_groups( 'users', $id, 'ARO' );
			$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) );
			if ( $this_group == 'super administrator' ) {
				$msg = _AEC_MSG_NODELETE_SUPERADMIN;
			} else if ( $id == $user->id ) {
				$msg = _AEC_MSG_NODELETE_YOURSELF;
			} else if ( ( $this_group == 'administrator' ) && ( $user->gid == 24 ) ) {
				$msg = _AEC_MSG_NODELETE_EXCEPT_SUPERADMIN;
			} else {
				if ( !$obj->delete( $id ) ) {
					$msg = $obj->getError();
				}
			}
		}
	}

	$query = 'DELETE FROM #__acctexp_subscr'
			. ' WHERE `userid` IN (' . $userids . ')'
			;
 	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=showPending', $msg );

}

function activatePendingSubscription( $userid, $option, $renew )
{
	$database = &JFactory::getDBO();

		if (!is_array( $userid ) || count( $userid ) < 1) {
			echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
			exit;
		}

	$n = 0;

	foreach ( $userid as $id ) {
		$n++;

		$user_subscription = new Subscription( $database );

		if ( $userid ) {
			$user_subscription->loadUserID( $id );
		} else {
			return;
		}

		$invoiceid = AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $id );

		if ( $invoiceid ) {
			$invoice = new Invoice( $database );
			$invoice->load( $invoiceid );
			$plan = $invoice->usage;
			$invoice->setTransactionDate();
		} else {
			$plan = $user_subscription->plan;
		}

		$renew = $user_subscription->applyUsage( $plan, 'none', 1 );
	}
	if ( $renew ) {
		// Admin confirmed an offline payment for a renew
		// He is working on the Active queue
		$msg = $n . ' ' . _AEC_MSG_SUBS_RENEWED;
		aecRedirect( 'index2.php?option=' . $option . '&task=showActive', $msg );
	} else {
		// Admin confirmed an offline payment for a new subscription
		// He is working on the Pending queue
		$msg = $n . ' ' . _AEC_MSG_SUBS_ACTIVATED;
		aecRedirect( 'index2.php?option=' . $option . '&task=showPending', $msg );
	}
}

function listSubscriptions( $option, $set_group, $subscriptionid, $userid=array(), $planid=null )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$limit			= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart		= $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );

	$orderby		= $mainframe->getUserStateFromRequest( "orderby_subscr{$option}", 'orderby_subscr', 'name ASC' );
	$search			= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search			= $database->getEscaped( trim( strtolower( $search ) ) );

	if ( empty( $planid ) ) {
		$filter_planid	= intval( $mainframe->getUserStateFromRequest( "filter_planid{$option}", 'filter_planid', 0 ) );
	} else {
		$filter_planid	= $planid;
	}

	if ( !empty( $orderby ) ) {
		$forder = array(	'expiration ASC', 'expiration DESC', 'lastpay_date ASC', 'lastpay_date DESC',
							'name ASC', 'name DESC', 'lastname ASC', 'lastname DESC', 'username ASC', 'username DESC',
							'signup_date ASC', 'signup_date DESC', 'lastpay_date ASC', 'lastpay_date DESC',
							'plan_name ASC', 'plan_name DESC', 'status ASC', 'status DESC', 'type ASC', 'type DESC'
							);

		if ( !in_array( $orderby, $forder ) ) {
			$orderby = 'name ASC';
		}
	}

	if ( !empty( $_REQUEST['groups'] ) ) {
		if ( is_array($_REQUEST['groups'] ) ) {
			$groups 	= $_REQUEST['groups'];
			$set_group	= $_REQUEST['groups'][0];
		}
	} else {
		if ( is_array( $set_group ) ) {
			$groups		= $set_group;
			$set_group	= $groups[0];
		} else {
			$groups		= array();
			$groups[]	= $set_group;
		}
	}

	// define displaying at html
	$action = array();
	switch( $set_group ){
		case 'active':
			$action[0]	= 'active';
			$action[1]	= _AEC_HEAD_ACTIVE_SUBS;
			break;

		case 'excluded':
			$action[0]	= 'excluded';
			$action[1]	= _AEC_HEAD_EXCLUDED_SUBS;
			break;

		case 'expired':
			$action[0]	= 'expired';
			$action[1]	= _AEC_HEAD_EXPIRED_SUBS;
			break;

		case 'pending':
			$action[0]	= 'pending';
			$action[1]	= _AEC_HEAD_PENDING_SUBS;
			break;

		case 'cancelled':
			$action[0]	= 'cancelled';
			$action[1]	= _AEC_HEAD_CANCELLED_SUBS;
			break;

		case 'hold':
			$action[0]	= 'hold';
			$action[1]	= _AEC_HEAD_HOLD_SUBS;
			break;

		case 'closed':
			$action[0]	= 'closed';
			$action[1]	= _AEC_HEAD_CLOSED_SUBS;
		break;

		case 'notconfig':
			$action[0]	= 'manual';
			$action[1]	= _AEC_HEAD_MANUAL_SUBS;
			break;
	}

	$filter		= '';
	$where		= array();
	$where_or	= array();
	$notconfig	= false;

	$planid = trim( aecGetParam( 'assign_planid', null ) );

	$users_selected = ( ( is_array( $subscriptionid ) && count( $subscriptionid ) ) || ( is_array( $userid ) && count( $userid ) ) );

	if ( !empty( $planid ) && $users_selected ) {
		$plan = new SubscriptionPlan( $database );
		$plan->load( $planid );

		if ( !empty( $subscriptionid ) ) {
			foreach ( $subscriptionid as $sid ) {
				$metaUser = new metaUser( false, $sid );

				$metaUser->establishFocus( $plan );

				$metaUser->focusSubscription->applyUsage( $planid, 'none', 1 );
			}
		}

		if ( !empty( $userid ) ) {
			foreach ( $userid as $uid ) {
				$metaUser = new metaUser( $uid );

				$metaUser->establishFocus( $plan );

				$metaUser->focusSubscription->applyUsage( $planid, 'none', 1 );

				$subscriptionid[] = $metaUser->focusSubscription->id;
			}
		}

		// Also show active users now
		if ( !in_array( 'active', $groups ) ) {
			$groups[] = 'active';
		}
	}

	$expire = trim( aecGetParam( 'set_expiration', null ) );
	if ( !is_null( $expire ) && is_array( $subscriptionid ) && count( $subscriptionid ) > 0 ) {
		foreach ( $subscriptionid as $k ) {
			$subscriptionHandler = new Subscription( $database );

			if ( !empty( $k ) ) {
				$subscriptionHandler->load( $k );
			} else {
				$subscriptionHandler->createNew( $k, '', 1 );
			}

			if ( strcmp( $expire, 'now' ) === 0) {
				$subscriptionHandler->expire();

				if ( !in_array( 'expired', $groups ) ) {
					$groups[] = 'expired';
				}
			} elseif ( strcmp( $expire, 'exclude' ) === 0 ) {
				$subscriptionHandler->setStatus( 'Excluded' );

				if ( !in_array( 'excluded', $groups ) ) {
					$groups[] = 'excluded';
				}
			} elseif ( strcmp( $expire, 'close' ) === 0 ) {
				$subscriptionHandler->setStatus( 'Closed' );

				if ( !in_array( 'closed', $groups ) ) {
					$groups[] = 'closed';
				}
			} elseif ( strcmp( $expire, 'hold' ) === 0 ) {
				$subscriptionHandler->setStatus( 'Hold' );

				if ( !in_array( 'hold', $groups ) ) {
					$groups[] = 'hold';
				}
			} elseif ( strcmp( $expire, 'include' ) === 0 ) {
				$subscriptionHandler->setStatus( 'Active' );

				if ( !in_array( 'active', $groups ) ) {
					$groups[] = 'active';
				}
			} elseif ( strpos( $expire, 'set' ) === 0 ) {
				$subscriptionHandler->setExpiration( 'M', substr( $expire, 4 ), 0 );

				$subscriptionHandler->lifetime = 0;
				$subscriptionHandler->setStatus( 'Active' );

				if ( !in_array( 'active', $groups ) ) {
					$groups[] = 'active';
				}
			} elseif ( strpos( $expire, 'add' ) === 0 ) {
				if ( $subscriptionHandler->lifetime) {
					$subscriptionHandler->setExpiration( 'M', substr( $expire, 4 ), 0 );
				} else {
					$subscriptionHandler->setExpiration( 'M', substr( $expire, 4 ), 1 );
				}

				$subscriptionHandler->lifetime = 0;
				$subscriptionHandler->setStatus( 'Active' );

				if ( !in_array( 'active', $groups ) ) {
					$groups[] = 'active';
				}
			}
		}
	}

	if ( is_array(  $groups ) ) {
		if ( in_array( 'notconfig', $groups ) ) {
 			$notconfig = true;
 			$groups = array( 'notconfig' );
		} else {
			if ( in_array( 'excluded', $groups ) ) {
				$where_or[] = "a.status = 'Excluded'";
			}
			if ( in_array( 'expired', $groups ) ) {
				$where_or[] = "a.status = 'Expired'";
			}
			if ( in_array( 'active', $groups ) ) {
				$where_or[] = "(a.status = 'Active' || a.status = 'Trial')";
			}
			if ( in_array( 'pending', $groups ) ) {
				$where_or[] = "a.status = 'Pending'";
			}
			if ( in_array( 'cancelled', $groups ) ) {
				$where_or[] = "a.status = 'Cancelled'";
			}
			if ( in_array( 'hold', $groups ) ) {
				$where_or[] = "a.status = 'Hold'";
			}
			if ( in_array( 'closed', $groups ) ) {
	 			$where_or[] = "a.status = 'Closed'";
			}
		}
	}

	if ( isset( $search ) && $search!= '' ) {
		if ( $notconfig ) {
			$where[] = "(username LIKE '%$search%' OR name LIKE '%$search%')";
		} else {
			$where[] = "(b.username LIKE '%$search%' OR b.name LIKE '%$search%')";
		}
	}

	if ( isset( $filter_planid ) && $filter_planid > 0 ) {
		if ( !$notconfig ) {
			$where[] = "(a.plan='$filter_planid')";
		}
	}

	// get the total number of records
	if ( $notconfig ) {
		$query	= 'SELECT `userid`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` != \'\''
				;
		$database->setQuery( $query );
		$userarray = $database->loadResultArray();

		$query = 'SELECT count(*)'
				. ' FROM #__users'
				;
		if ( count( $userarray ) > 0 ) {
			$where[] = 'id NOT IN (' . implode(',', $userarray) . ')';
		}

		$query .= (count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	} else {
		$query = 'SELECT count(*)'
				. ' FROM #__acctexp_subscr AS a'
				. ' INNER JOIN #__users AS b ON a.userid = b.id'
				;

		if ( count( $where_or ) ) {
			$where[] = ( count( $where_or ) ? '(' . implode( ' OR ', $where_or ) . ')' : '' );
		}

		$query .= (count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	}

	$database->setQuery( $query );
	$total = $database->loadResult();

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

	// get the subset (based on limits) of required records
	if ( $notconfig ) {
		$forder = array(	'name ASC', 'name DESC', 'lastname ASC', 'lastname DESC', 'username ASC', 'username DESC',
							'signup_date ASC', 'signup_date DESC' );

		if ( !in_array( $orderby, $forder ) ) {
			$orderby = 'name ASC';
		}

		if ( strpos( $orderby, 'lastname' ) !== false ) {
			$orderby = str_replace( 'lastname', 'SUBSTRING_INDEX(name, \' \', -1)', $orderby );
		}

		$query = 'SELECT `userid`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` != \'\''
				;
		$database->setQuery( $query );
		$userarray = $database->loadResultArray();

			foreach ( $userarray as $i => $v ) {
					if ( empty( $v ) ){
						unset( $userarray[$i] );
					}
			}

		$query = 'SELECT `id`, `name`, `username`, `email`, `usertype`, `block`, `gid`, `registerDate` as signup_date, `lastvisitDate`'
				. ' FROM #__users'
				;
		if ( count( $userarray ) > 0 ) {
			$where[] = 'id NOT IN (' . implode(',', $userarray) . ')';
		}

		$query .= (count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

 		if ( $orderby == 'signup_date ASC' ) {
			$query .= ' ORDER BY ' . 'registerDate ASC';
		} elseif ( $orderby == 'signup_date DESC' ) {
			$query .= ' ORDER BY ' . 'registerDate DESC';
		} else {
			$query .= ' ORDER BY ' . $orderby;
		}

		$query .=	' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit;

		if ( strpos( $orderby, 'SUBSTRING_INDEX' ) !== false ) {
			$orderby = str_replace( 'SUBSTRING_INDEX(name, \' \', -1)', 'lastname', $orderby );
		}
	} else {
		if ( strpos( $orderby, 'lastname' ) !== false ) {
			$orderby = str_replace( 'lastname', 'SUBSTRING_INDEX(b.name, \' \', -1)', $orderby );
		}

		$query = 'SELECT a.*, b.name, b.username, b.email, c.name AS plan_name'
				. ' FROM #__acctexp_subscr AS a'
				. ' INNER JOIN #__users AS b ON a.userid = b.id'
				. ' LEFT JOIN #__acctexp_plans AS c ON a.plan = c.id'
				. ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' )
				. ' ORDER BY ' . $orderby
				. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit
				;

		if ( strpos( $orderby, 'SUBSTRING_INDEX' ) !== false ) {
			$orderby = str_replace( 'SUBSTRING_INDEX(b.name, \' \', -1)', 'lastname', $orderby );
		}
	}

	$database->setQuery( 'SET SQL_BIG_SELECTS=1');
	$database->query();

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}

	$database->setQuery( 'SET SQL_BIG_SELECTS=0');
	$database->query();

	$sel = array();
	$sel[] = mosHTML::makeOption( 'expiration ASC',		_EXP_ASC );
	$sel[] = mosHTML::makeOption( 'expiration DESC',	_EXP_DESC );
	$sel[] = mosHTML::makeOption( 'name ASC',			_NAME_ASC );
	$sel[] = mosHTML::makeOption( 'name DESC',			_NAME_DESC );
	$sel[] = mosHTML::makeOption( 'lastname ASC',		_LASTNAME_ASC );
	$sel[] = mosHTML::makeOption( 'lastname DESC',		_LASTNAME_DESC );
	$sel[] = mosHTML::makeOption( 'username ASC',		_LOGIN_ASC );
	$sel[] = mosHTML::makeOption( 'username DESC',		_LOGIN_DESC );
	$sel[] = mosHTML::makeOption( 'signup_date ASC',	_SIGNUP_ASC );
	$sel[] = mosHTML::makeOption( 'signup_date DESC',	_SIGNUP_DESC );
	$sel[] = mosHTML::makeOption( 'lastpay_date ASC',	_LASTPAY_ASC );
	$sel[] = mosHTML::makeOption( 'lastpay_date DESC',	_LASTPAY_DESC );
	$sel[] = mosHTML::makeOption( 'plan_name ASC',		_PLAN_ASC );
	$sel[] = mosHTML::makeOption( 'plan_name DESC',		_PLAN_DESC );
	$sel[] = mosHTML::makeOption( 'status ASC',			_STATUS_ASC );
	$sel[] = mosHTML::makeOption( 'status DESC',		_STATUS_DESC );
	$sel[] = mosHTML::makeOption( 'type ASC',			_TYPE_ASC );
	$sel[] = mosHTML::makeOption( 'type DESC',			_TYPE_DESC );

	$lists['orderNav'] = mosHTML::selectList( $sel, 'orderby_subscr', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $orderby );

	// Get list of plans for filter
	$query = 'SELECT `id`, `name`'
			. ' FROM #__acctexp_plans'
			. ' ORDER BY `ordering`'
			;
	$database->setQuery( $query );
	$db_plans = $database->loadObjectList();

	$plans[] = mosHTML::makeOption( '0', _FILTER_PLAN, 'id', 'name' );
	if ( is_array( $db_plans ) ) {
		$plans = array_merge( $plans, $db_plans );
	}
	$lists['filterplanid']	= mosHTML::selectList( $plans, 'filter_planid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'id', 'name', $filter_planid );

	$plans2[] = mosHTML::makeOption( '0', _BIND_USER, 'id', 'name' );
	if ( is_array( $db_plans ) ) {
		$plans2 = array_merge( $plans2, $db_plans );
	}
	$lists['planid']	= mosHTML::selectList( $plans2, 'assign_planid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'id', 'name', 0 );

	$group_selection = array();
	$group_selection[] = mosHTML::makeOption( 'excluded',	_AEC_SEL_EXCLUDED );
	$group_selection[] = mosHTML::makeOption( 'pending',	_AEC_SEL_PENDING );
	$group_selection[] = mosHTML::makeOption( 'active',		_AEC_SEL_ACTIVE );
	$group_selection[] = mosHTML::makeOption( 'expired',	_AEC_SEL_EXPIRED );
	$group_selection[] = mosHTML::makeOption( 'closed',		_AEC_SEL_CLOSED );
	$group_selection[] = mosHTML::makeOption( 'cancelled',	_AEC_SEL_CANCELLED );
	$group_selection[] = mosHTML::makeOption( 'hold',		_AEC_SEL_HOLD );
	$group_selection[] = mosHTML::makeOption( 'notconfig',	_AEC_SEL_NOT_CONFIGURED );

	$selected_groups = array();
	if ( is_array( $groups ) ) {
		foreach ($groups as $name ) {
			$selected_groups[] = mosHTML::makeOption( $name, $name );
		}
	}

	$lists['groups'] = mosHTML::selectList($group_selection, 'groups[]', 'size="5" multiple="multiple"', 'value', 'text', $selected_groups);

	$group_selection = array();
	$group_selection[] = mosHTML::makeOption( '',			_EXPIRE_SET );
	$group_selection[] = mosHTML::makeOption( 'now',		_EXPIRE_NOW );
	$group_selection[] = mosHTML::makeOption( 'exclude',	_EXPIRE_EXCLUDE );
	$group_selection[] = mosHTML::makeOption( 'include',	_EXPIRE_INCLUDE );
	$group_selection[] = mosHTML::makeOption( 'close',		_EXPIRE_CLOSE );
	$group_selection[] = mosHTML::makeOption( 'hold',		_EXPIRE_HOLD );
	$group_selection[] = mosHTML::makeOption( 'add_1',		_EXPIRE_ADD01MONTH );
	$group_selection[] = mosHTML::makeOption( 'add_3',		_EXPIRE_ADD03MONTH );
	$group_selection[] = mosHTML::makeOption( 'add_12',	_EXPIRE_ADD12MONTH );
	$group_selection[] = mosHTML::makeOption( 'set_1',		_EXPIRE_01MONTH );
	$group_selection[] = mosHTML::makeOption( 'set_3',		_EXPIRE_03MONTH );
	$group_selection[] = mosHTML::makeOption( 'set_12',	_EXPIRE_12MONTH );

	$lists['set_expiration'] = mosHTML::selectList($group_selection, 'set_expiration', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', "");

	HTML_AcctExp::listSubscriptions( $rows, $pageNav, $search, $option, $lists, $subscriptionid, $action );
}

function editSettings( $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	global $aecConfig;

	// See whether we have a duplication
	if ( $aecConfig->RowDuplicationCheck() ) {
		// Clean out duplication and reload settings
		$aecConfig->CleanDuplicatedRows();
		$aecConfig = new Config_General( $database );
	}

	$lists = array();

	$currency_code_list	= AECToolbox::aecCurrencyField( true, true, true );
	$lists['currency_code_general'] = mosHTML::selectList( $currency_code_list, ( 'currency_code_general' ), 'size="10"', 'value', 'text', ( !empty( $aecConfig->cfg['currency_code_general'] ) ? $aecConfig->cfg['currency_code_general'] : '' ) );

	$available_plans	= SubscriptionPlanHandler::getActivePlanList();

	$selected_plan = isset($aecConfig->cfg['entry_plan']) ? $aecConfig->cfg['entry_plan'] : '0';

	$lists['entry_plan'] = mosHTML::selectList($available_plans, 'entry_plan', 'size="' . min( 10, count( $available_plans ) + 2 ) . '"', 'value', 'text', $selected_plan);

	$gtree = $acl->get_group_children_tree( null, 'USERS', true );

	$ex_groups = array( 28, 29, 30 );

	// remove users 'above' me
	$i = 0;
	while ( $i < count( $gtree ) ) {
		if ( in_array( $gtree[$i]->value, $ex_groups ) ) {
			array_splice( $gtree, $i, 1 );
		} else {
			$i++;
		}
	}

	// Create GID related Lists
	$lists['checkout_as_gift_access'] 		= mosHTML::selectList( $gtree, 'checkout_as_gift_access', 'size="6"', 'value', 'text', $aecConfig->cfg['checkout_as_gift_access'] );

	$tab_data = array();

	$params[] = array( 'userinfobox', 32 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_ACCESS );
	$params['require_subscription']			= array( 'list_yesno', 0 );
	$params['adminaccess']					= array( 'list_yesno', 0 );
	$params['manageraccess']				= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_SYSTEM );
	$params['heartbeat_cycle']				= array( 'inputA', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_EMAIL );
	$params['noemails']						= array( 'list_yesno', 0 );
	$params['nojoomlaregemails']			= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_DEBUG );
	$params['curl_default']					= array( 'list_yesno', 0 );
	$params['simpleurls']					= array( 'list_yesno', 0 );
	$params['error_notification_level']		= array( 'list', 0 );
	$params['email_notification_level']		= array( 'list', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	$params[] = array( 'userinfobox', 33 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_REGFLOW );
	$params['plans_first']					= array( 'list_yesno', 0 );
	$params['integrate_registration']		= array( 'list_yesno', 0 );
	$params['skip_confirmation']			= array( 'list_yesno', 0 );
	$params['displayccinfo']				= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_CONFIRMATION );
	$params['tos']							= array( 'inputC', '' );
	$params['tos_iframe']					= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_CHECKOUT );
	$params['enable_coupons']				= array( 'list_yesno', 0 );
	$params['checkout_display_descriptions']	= array( 'list_yesno', '' );
	$params['checkout_as_gift']				= array( 'list_yesno', '' );
	$params['checkout_as_gift_access']		= array( 'list', '' );
	$params['confirm_as_gift']				= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	$params[] = array( 'userinfobox', 32 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_PLANS );
	$params['root_group']					= array( 'list', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', 'Shopping Cart' );
	$params['enable_shoppingcart']			= array( 'list_yesno', '' );
	$params['customlink_continueshopping']	= array( 'inputC', '' );
	$params['additem_stayonpage']			= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_PROCESSORS );
	$params['gwlist']						= array( 'list', 0 );
	$params['standard_currency']			= array( 'list_currency', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	@end( $params );
	$tab_data[] = array( _CFG_TAB1_TITLE, key( $params ), '<h2>' . _CFG_TAB1_SUBTITLE . '</h2>' );

	$params[] = array( 'userinfobox', 48 );
	$params[] = array( 'userinfobox_sub', 'AEC' );
	$params['quicksearch_top']					= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_PROXY );
	$params['use_proxy']						= array( 'list_yesno', '' );
	$params['proxy']							= array( 'inputC', '' );
	$params['proxy_port']						= array( 'inputC', '' );
	$params['proxy_username']					= array( 'inputC', '' );
	$params['proxy_password']					= array( 'inputC', '' );
	$params['gethostbyaddr']					= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_BUTTONS_SUB );
	$params['renew_button_never']				= array( 'list_yesno', '' );
	$params['renew_button_nolifetimerecurring']	= array( 'list_yesno', '' );
	$params['continue_button']					= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	$params[] = array( 'userinfobox', 48 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_FORMAT_DATE );
	$params['display_date_frontend']			= array( 'inputC', '%a, %d %b %Y %T %Z' );
	$params['display_date_backend']				= array( 'inputC', '%a, %d %b %Y %T %Z' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_FORMAT_PRICE );
	$params['amount_currency_symbol']			= array( 'list_yesno', 0 );
	$params['amount_currency_symbolfirst']		= array( 'list_yesno', 0 );
	$params['amount_use_comma']					= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_FORMAT_INUM );
	$params['invoicenum_doformat']				= array( 'list_yesno', '' );
	$params['invoicenum_formatting']			= array( 'inputD', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_CAPTCHA );
	$params['use_recaptcha']					= array( 'list_yesno', '' );
	$params['recaptcha_privatekey']				= array( 'inputC', '' );
	$params['recaptcha_publickey']				= array( 'inputC', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	@end( $params );
	$tab_data[] = array( _CFG_TAB_CUSTOMIZATION_TITLE, key( $params ), '<h2>' . _CFG_TAB_CUSTOMIZATION_SUBTITLE . '</h2>' );

	$params = AECToolbox::rewriteEngineInfo( array(), $params );

	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_INVOICE_PRINTOUT_DETAILS );
	$params[] = array( 'accordion_start', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_HEADER_NAME );
	$params['invoice_page_title']				= array( 'inputD', '' );
	$params['invoice_header']					= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_AFTER_HEADER_NAME );
	$params['invoice_after_header']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_ADDRESS_NAME );
	$params['invoice_address_allow_edit']		= array( 'list_yesno', '' );
	$params['invoice_address']					= array( 'inputD', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_BEFORE_CONTENT_NAME );
	$params['invoice_before_content']			= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_AFTER_CONTENT_NAME );
	$params['invoice_after_content']			= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_BEFORE_FOOTER_NAME );
	$params['invoice_before_footer']			= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_FOOTER_NAME );
	$params['invoice_footer']					= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_INVOICE_AFTER_FOOTER_NAME );
	$params['invoice_after_footer']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	@end( $params );
	$tab_data[] = array( _CFG_TAB_CUSTOMINVOICE_TITLE, key( $params ), '<h2>' . _CFG_TAB_CUSTOMINVOICE_SUBTITLE . '</h2>' );

	$params[] = array( 'userinfobox', 100 );
	$params[] = array( 'userinfobox_sub', _CFG_CUSTOMIZATION_SUB_CREDIRECT );
	$params['customintro']						= array( 'inputC', '' );
	$params['customintro_userid']				= array( 'list_yesno', '' );
	$params['customintro_always']				= array( 'list_yesno', '' );
	$params['customthanks']						= array( 'inputC', '' );
	$params['customcancel']						= array( 'inputC', '' );
	$params['customnotallowed']					= array( 'inputC', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'div_end', 0 );

	$rewriteswitches							= array( 'cms', 'invoice' );
	$params = AECToolbox::rewriteEngineInfo( $rewriteswitches, $params );

	$params[] = array( 'accordion_start', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_PLANS_NAME );
	$params['customtext_plans']					= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_CONFIRM_NAME );
	$params['customtext_confirm_keeporiginal']	= array( 'list_yesno', '' );
	$params['custom_confirm_userdetails']		= array( 'editor', '' );
	$params['customtext_confirm']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_CHECKOUT_NAME );
	$params['customtext_checkout_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_checkout']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_EXCEPTION_NAME );
	$params['customtext_exception_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_exception']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_NAME );
	$params['customtext_notallowed_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_notallowed']			= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_PENDING_NAME );
	$params['customtext_pending_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_pending']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_HOLD_NAME );
	$params['customtext_hold_keeporiginal']		= array( 'list_yesno', '' );
	$params['customtext_hold']					= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_EXPIRED_NAME );
	$params['customtext_expired_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_expired']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_THANKS_NAME );
	$params['customtext_thanks_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_thanks']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'accordion_itemstart', _CFG_GENERAL_CUSTOMTEXT_CANCEL_NAME );
	$params['customtext_cancel_keeporiginal']	= array( 'list_yesno', '' );
	$params['customtext_cancel']				= array( 'editor', '' );
	$params[] = array( 'div_end', '' );
	$params[] = array( 'div_end', '' );

	@end( $params );
	$tab_data[] = array( _CFG_TAB_CUSTOMPAGES_TITLE, key( $params ), '<h2>' . _CFG_TAB_CUSTOMPAGES_SUBTITLE . '</h2>' );

	$params[] = array( 'userinfobox', 32 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_SYSTEM );
	$params['alertlevel2']					= array( 'inputA', 0 );
	$params['alertlevel1']					= array( 'inputA', 0 );
	$params['expiration_cushion']			= array( 'inputA', 0 );
	$params['invoice_cushion']				= array( 'inputA', 0 );
	$params['heartbeat_cycle_backend']		= array( 'inputA', 0 );
	$params['allow_frontend_heartbeat']		= array( 'list_yesno', 0 );
	$params['disable_regular_heartbeat']	= array( 'list_yesno', 0 );
	$params['custom_heartbeat_securehash']	= array( 'inputC', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_DEBUG );
	$params['bypassintegration']			= array( 'inputC', '' );

	if ( !aecJoomla15check() && !$aecConfig->cfg['overrideJ15'] ) {
		$params['overrideJ15']					= array( 'list_yesno', 0 );
	}

	$params['breakon_mi_error']				= array( 'list_yesno', 0 );
	$params['debugmode']					= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	$params[] = array( 'userinfobox', 33 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_REGFLOW );
	$params['show_fixeddecision']			= array( 'list_yesno', 0 );
	$params['temp_auth_exp']				= array( 'inputC', '' );
	$params['confirmation_coupons']			= array( 'list_yesno', 0 );
	$params['intro_expired']				= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_CONFIRMATION );
	$params['confirmation_changeusername']	= array( 'list_yesno', '' );
	$params['confirmation_changeusage']		= array( 'list_yesno', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_PLANS );
	$params['root_group_rw']				= array( 'inputD', 0 );
	$params['entry_plan']					= array( 'list', 0 );
	$params['per_plan_mis']					= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	$params[] = array( 'userinfobox', 32 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_SECURITY );
	$params['ssl_signup']					= array( 'list_yesno', 0 );
	$params['ssl_profile']					= array( 'list_yesno', 0 );
	$params['override_reqssl']				= array( 'list_yesno', 0 );
	$params['altsslurl']					= array( 'inputC', '' );
	$params['ssl_verifypeer']				= array( 'list_yesno', 0 );
	$params['ssl_verifyhost']				= array( 'inputC', '' );
	$params['ssl_cainfo']					= array( 'inputC', '' );
	$params['ssl_capath']					= array( 'inputC', '' );
	$params[] = array( 'div_end', 0 );
	$params[] = array( 'userinfobox_sub', _CFG_GENERAL_SUB_UNINSTALL );
	$params['delete_tables']				= array( 'list_yesno', 0 );
	$params['delete_tables_sure']			= array( 'list_yesno', 0 );
	$params[] = array( 'div_end', 0 );
	$params[] = array( '2div_end', 0 );

	@end( $params );
	$tab_data[] = array( _CFG_TAB_EXPERT_TITLE, key( $params ), '<h2>' . _CFG_TAB_EXPERT_SUBTITLE . '</h2>' );

	$error_reporting_notices[] = mosHTML::makeOption( 512, _AEC_NOTICE_NUMBER_512 );
	$error_reporting_notices[] = mosHTML::makeOption( 128, _AEC_NOTICE_NUMBER_128 );
	$error_reporting_notices[] = mosHTML::makeOption( 32, _AEC_NOTICE_NUMBER_32 );
	$error_reporting_notices[] = mosHTML::makeOption( 8, _AEC_NOTICE_NUMBER_8 );
	$error_reporting_notices[] = mosHTML::makeOption( 2, _AEC_NOTICE_NUMBER_2 );
	$lists['error_notification_level']			= mosHTML::selectList($error_reporting_notices, 'error_notification_level', 'size="5"', 'value', 'text', $aecConfig->cfg['error_notification_level'] );
	$lists['email_notification_level']			= mosHTML::selectList($error_reporting_notices, 'email_notification_level', 'size="5"', 'value', 'text', $aecConfig->cfg['email_notification_level'] );

	$pph					= new PaymentProcessorHandler();
	$gwlist					= $pph->getProcessorList();

	$gw_list_enabled		= array();
	$gw_list_enabled_html	= array();
	$gw_list_enabled_html[] = mosHTML::makeOption( 'none', _AEC_CMN_NONE_SELECTED );

	// Display Processor descriptions?
	if ( !empty( $aecConfig->cfg['gwlist'] ) ) {
		$desc_list = $aecConfig->cfg['gwlist'];
	} else {
		$desc_list = array();
	}

	$gwlist_selected = array();

	asort($gwlist);

	$ppsettings = array();

	foreach ( $gwlist as $gwname ) {
		$pp = new PaymentProcessor();
		if ( $pp->loadName( $gwname ) ) {
			$pp->getInfo();

			if ( $pp->processor->active ) {
				// Add to Active List
				$gw_list_enabled[]->value = $gwname;

				// Add to selected Description List if existing in db entry
				if ( !empty( $desc_list ) ) {
					if ( in_array( $gwname, $desc_list ) ) {
						$gwlist_selected[]->value = $gwname;
					}
				}

				// Add to Description List
				$gw_list_enabled_html[] = mosHTML::makeOption( $gwname, $pp->info['longname'] );

			}
		}
	}

	$lists['gwlist']			= mosHTML::selectList($gw_list_enabled_html, 'gwlist[]', 'size="' . max(min(count($gw_list_enabled), 12), 3) . '" multiple="multiple"', 'value', 'text', $gwlist_selected);

	$grouplist = ItemGroupHandler::getTree();

	$glist = array();

	foreach ( $grouplist as $id => $glisti ) {
		$glist[] = mosHTML::makeOption( $glisti[0], $glisti[1] );
	}

	$lists['root_group'] 		= mosHTML::selectList( $glist, 'root_group', 'size="' . min(6,count($glist)+1) . '"', 'value', 'text', $aecConfig->cfg['root_group'] );

	$editors = array();
	foreach ( $tab_data as $tab ) {
		foreach ( $tab as $st_content ) {
			if ( strcmp( $st_content[0], 'editor' ) === 0 ) {
				$editors[] = $st_content[4];
			}
		}
	}

	$settings = new aecSettings ( 'cfg', 'general' );
	$settingsparams = array_merge( $aecConfig->cfg, $ppsettings );
	$settings->fullSettingsArray( $params, $settingsparams, $lists ) ;

	// Call HTML Class
	$aecHTML = new aecHTML( $settings->settings, $settings->lists );
	if ( !empty( $customparamsarray ) ) {
		$aecHTML->customparams = $customparamsarray;
	}

	HTML_AcctExp::Settings( $option, $aecHTML, $tab_data, $editors );
}

/**
* Cancels an configure operation
*/
function cancelSettings( $option )
{
	aecRedirect( 'index2.php?option=' . $option . '&task=showCentral', _AEC_CONFIG_CANCELLED );
}


function saveSettings( $option, $return=0 )
{
	$db		= &JFactory::getDBO();
	$user	= &JFactory::getUser();
	$acl	= &JFactory::getACL();

	global $mainframe, $aecConfig;

	unset( $_POST['id'] );
	unset( $_POST['task'] );
	unset( $_POST['option'] );

	if ( GeneralInfoRequester::detect_component( 'anyCB' ) && !aecJoomla15check() ) {
		$ch = hackcorefile( $option, 'comprofilerhtml2', true, false, true );

		if ( ( !$ch && $_POST['plans_first'] ) || ( $ch && !$_POST['plans_first'] ) ) {
			$short	= 'AEC Settings Error';

			if ( !$ch && $_POST['plans_first'] ) {
				$_POST['plans_first'] = 0;

				$event	= 'Cannot set Plans First to yes if comprofiler.php ' . _AEC_HACK_HACK . ' #2 is not applied';
			} elseif ( $ch && !$_POST['plans_first'] ) {
				$_POST['plans_first'] = 1;

				$event	= 'Cannot set Plans First to no if comprofiler.php ' . _AEC_HACK_HACK . ' #2 is still applied';
			}

			$tags	= 'settings,system';
			$params = array();

			$eventlog = new eventLog( $db );
			$eventlog->issue( $short, $tags, $event, 128, $params, 1 );
		}
	}

	$general_settings = array();
	foreach ( $_POST as $name => $value ) {
		$general_settings[$name] = $value;
	}

	$diff = $aecConfig->diffParams($general_settings, 'settings');
	$difference = '';

	if ( is_array( $diff ) ) {
		$newdiff = array();
		foreach ( $diff as $value => $change ) {
			$newdiff[] = $value . '(' . implode( ' -> ', $change ) . ')';
		}
		$difference = implode( ',', $newdiff );
	} else {
		$difference = 'none';
	}

	$aecConfig->cfg = $general_settings;
	$aecConfig->saveSettings();

	$ip = AECToolbox::aecIP();

	$short	= _AEC_LOG_SH_SETT_SAVED;
	$event	= _AEC_LOG_LO_SETT_SAVED . ' ' . $difference;
	$tags	= 'settings,system';
	$params = array(	'userid' => $user->id,
						'ip' => $ip['ip'],
						'isp' => $ip['isp'] );

	$eventlog = new eventLog( $db );
	$eventlog->issue( $short, $tags, $event, 2, $params );

	if ( !empty( $aecConfig->cfg['entry_plan'] ) ) {
		$plan = new SubscriptionPlan( $db );
		$plan->load( $aecConfig->cfg['entry_plan'] );

		$terms = $plan->getTerms();

		if ( !$terms->checkFree() ) {
			$short	= "Settings Warning";
			$event	= "You have selected a non-free plan as Entry Plan."
						. " Please keep in mind that this means that users"
						. " will be getting it for free when they log in"
						. " without having any membership";
			$tags	= 'settings,system';
			$params = array(	'userid' => $user->id,
								'ip' => $ip['ip'],
								'isp' => $ip['isp'] );

			$eventlog = new eventLog( $db );
			$eventlog->issue( $short, $tags, $event, 32, $params );
		}
	}

	if ( $return ) {
		aecRedirect( 'index2.php?option=' . $option . '&task=showSettings', _AEC_CONFIG_SAVED );
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=showCentral', _AEC_CONFIG_SAVED );
	}
}

function listProcessors( $option )
{
 	$database = &JFactory::getDBO();

	global $mainframe;

 	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart = $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );

 	// get the total number of records
 	$query = 'SELECT count(*)'
		 	. ' FROM #__acctexp_config_processors'
		 	;
 	$database->setQuery( $query );
 	$total = $database->loadResult();

 	if ( $limit > $total ) {
 		$limitstart = 0;
 	}

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

 	// get the subset (based on limits) of records
 	$query = 'SELECT name'
		 	. ' FROM #__acctexp_config_processors'
		 	. ' GROUP BY `id`'
		 	//. ' ORDER BY `ordering`'
		 	. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit
		 	;
	$database->setQuery( $query );
	$names = $database->loadResultArray();

	$rows = array();
	foreach ( $names as $name ) {
		$pp = new PaymentProcessor( $database );
		$pp->loadName( $name );

		if ( $pp->fullInit() ) {
			$rows[] = $pp;
		}
	}

 	HTML_AcctExp::listProcessors( $rows, $pageNav, $option );
 }

function editProcessor( $id, $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	if ( $id ) {
		$pp = new PaymentProcessor();

		if ( !$pp->loadId( $id ) ) {
			return false;
		}

		// Init Info and Settings
		$pp->fullInit();

		// Get Backend Settings
		$settings_array		= $pp->getBackendSettings();
		$original_settings	= $pp->processor->settings();

		if ( isset( $settings_array['lists'] ) ) {
			foreach ( $settings_array['lists'] as $lname => $lvalue ) {
				$lists[$pp->processor_name . '_' . $lname] = $lvalue;
			}
			unset( $settings_array['lists'] );
		}

		$available_plans = SubscriptionPlanHandler::getActivePlanList();
		$total_plans = count( $available_plans );

		// Iterate through settings form assigning the db settings
		foreach ( $settings_array as $name => $values ) {
			$setting_name = $pp->processor_name . '_' . $name;

			switch( $settings_array[$name][0] ) {
				case 'list_currency':
					// Get currency list
					if ( is_array( $pp->info['currencies'] ) ) {
						$currency_array	= $pp->info['currencies'];
					} else {
						$currency_array	= explode( ',', $pp->info['currencies'] );
					}

					// Transform currencies into OptionArray
					$currency_code_list = array();
					foreach ( $currency_array as $currency ) {
						if ( defined( '_CURRENCY_' . $currency )) {
							$currency_code_list[] = mosHTML::makeOption( $currency, constant( '_CURRENCY_' . $currency ) );
						}
					}

					// Create list
					$lists[$setting_name] = mosHTML::selectList( $currency_code_list, $setting_name, 'size="10"', 'value', 'text', $pp->settings[$name] );
					$settings_array[$name][0] = 'list';
					break;
				case 'list_language':
					// Get language list
					if ( is_array( $pp->info['languages'] ) ) {
						$language_array	= $pp->info['languages'];
					} else {
						$language_array	= explode( ',', $pp->info['languages'] );
					}

					// Transform languages into OptionArray
					$language_code_list = array();
					foreach ( $language_array as $language ) {
						$language_code_list[] = mosHTML::makeOption( $language, ( defined( '_AEC_LANG_' . $language  ) ? constant( '_AEC_LANG_' . $language ) : $language ) );
					}
					// Create list
					$lists[$setting_name] = mosHTML::selectList( $language_code_list, $setting_name, 'size="10"', 'value', 'text', $pp->settings[$name] );
					$settings_array[$name][0] = 'list';
					break;
				case 'list_plan':
					// Create list
					$lists[$setting_name] = mosHTML::selectList($available_plans, $setting_name, 'size="' . $total_plans . '"', 'value', 'text', $pp->settings[$name] );
					$settings_array[$name][0] = 'list';
					break;
				default:
					break;
			}

			if ( !isset( $settings_array[$name][1] ) ) {
				// Create constant names
				$constantname = '_CFG_' . strtoupper( $pp->processor_name ) . '_' . strtoupper($name) . '_NAME';
				$constantdesc = '_CFG_' . strtoupper( $pp->processor_name ) . '_' . strtoupper($name) . '_DESC';

				// If the constantname does not exists, try a generic name or insert an error
				if ( defined( $constantname ) ) {
					$settings_array[$name][1] = constant( $constantname );
				} else {
					$genericname = '_CFG_PROCESSOR_' . strtoupper($name) . '_NAME';
					if ( defined( $genericname ) ) {
						$settings_array[$name][1] = constant( $genericname );
					} else {
						$settings_array[$name][1] = sprintf( _AEC_CMN_LANG_CONSTANT_IS_MISSING, $constantname );
					}
				}

				// If the constantname does not exists, try a generic name or insert an error
				if ( defined( $constantdesc ) ) {
					$settings_array[$name][2] = constant( $constantdesc );
				} else {
					$genericdesc = '_CFG_PROCESSOR_' . strtoupper($name) . '_DESC';
					if ( defined( $genericname ) ) {
						$settings_array[$name][2] = constant( $genericdesc );
					} else {
						$settings_array[$name][2] = sprintf( _AEC_CMN_LANG_CONSTANT_IS_MISSING, $constantdesc );
					}
				}
			}

			// It might be that the processor has got some new properties, so we need to double check here
			if ( isset( $pp->settings[$name] ) ) {
				$content = $pp->settings[$name];
			} elseif ( isset( $original_settings[$name] ) ) {
				$content = $original_settings[$name];
			} else {
				$content = null;
			}

			// Set the settings value
			$settings_array[$setting_name] = array_merge( (array) $settings_array[$name], array( $content ) );

			// unload the original value
			unset( $settings_array[$name] );
		}

		$longname = $pp->processor_name . '_info_longname';
		$description = $pp->processor_name . '_info_description';

		$settingsparams = $pp->settings;

		$params = array();
		$params[$pp->processor_name.'_active'] = array( 'list_yesno', _PP_GENERAL_ACTIVE_NAME, _PP_GENERAL_ACTIVE_DESC, $pp->processor->active);

		if ( is_array( $settings_array ) && !empty( $settings_array ) ) {
			$params = array_merge( $params, $settings_array );
		}

		$params[$longname] = array( 'inputC', _CFG_PROCESSOR_NAME_NAME, _CFG_PROCESSOR_NAME_DESC, $pp->info['longname'], $longname);
		$params[$description] = array( 'editor', _CFG_PROCESSOR_DESC_NAME, _CFG_PROCESSOR_DESC_DESC, $pp->info['description'], $description);
	} else {
		// Create Processor Selection Screen
		$pph					= new PaymentProcessorHandler();
		$pplist					= $pph->getProcessorList();
		$pp_installed_list		= $pph->getInstalledObjectList( false, true );

		$pp_list_html			= array();

		asort($pplist);

		foreach ( $pplist as $ppname ) {
			if ( in_array( $ppname, $pp_installed_list ) ) {
				continue;
			}

			$readppname = ucwords( str_replace( '_', ' ', strtolower( $ppname ) ) );

			// Load Payment Processor
			$pp = new PaymentProcessor();
			if ( $pp->loadName( $ppname ) ) {
				$pp->getInfo();

				// Add to general PP List
				$pp_list_html[] = mosHTML::makeOption( $ppname, $readppname );
			}
		}

		$lists['processor']	= mosHTML::selectList( $pp_list_html, 'processor', 'size="' . max(min(count($pplist), 24), 2) . '"', 'value', 'text' );

		$params['processor'] = array( 'list' );
		$settingsparams = array();

		$pp = null;
	}

	$settings = new aecSettings ( 'pp', 'general' );
	$settings->fullSettingsArray( $params, $settingsparams, $lists ) ;

	// Call HTML Class
	$aecHTML = new aecHTML( $settings->settings, $settings->lists );
	if ( !empty( $customparamsarray ) ) {
		$aecHTML->customparams = $customparamsarray;
	}

	$aecHTML->pp = $pp;

	HTML_AcctExp::editProcessor( $option, $aecHTML );
}

/**
* Cancels an configure operation
*/
function cancelProcessor( $option )
{
	aecRedirect( 'index2.php?option=' . $option . '&task=showProcessors', _AEC_CONFIG_CANCELLED );
}

function changeProcessor( $cid=null, $state=0, $type, $option )
{
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
		exit;
	}

	$total	= count( $cid );
	$cids	= implode( ',', $cid );

	$query = 'UPDATE #__acctexp_config_processors'
			. ' SET `' . $type . '` = \'' . $state . '\''
			. ' WHERE `id` IN (' . $cids . ')'
			;
	$database->setQuery( $query );

	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( $state == '1' ) {
		$msg = ( ( strcmp( $type, 'active' ) === 0 ) ? _AEC_CMN_PUBLISHED : _AEC_CMN_MADE_VISIBLE );
	} elseif ( $state == '0' ) {
		$msg = ( ( strcmp( $type, 'active' ) === 0 ) ? _AEC_CMN_NOT_PUBLISHED : _AEC_CMN_MADE_INVISIBLE );
	}

	$msg = sprintf( _AEC_MSG_ITEMS_SUCESSFULLY, $total ) . ' ' . $msg;

	aecRedirect( 'index2.php?option=' . $option . '&task=showProcessors', $msg );
}

function saveProcessor( $option, $return=0 )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	$pp = new PaymentProcessor();

	if ( !empty( $_POST['id'] ) ) {
		$pp->loadId( $_POST['id'] );

		if ( empty( $pp->id ) ) {
			cancel();
		}

		$procname = $pp->processor_name;
	} elseif ( isset( $_POST['processor'] ) ) {
		$pp->loadName( $_POST['processor'] );

		$procname = $_POST['processor'];
	}

	$pp->fullInit();

	$pp->storeload();

	$active			= $procname . '_active';
	$longname		= $procname . '_info_longname';
	$description	= $procname . '_info_description';

	if ( isset( $_POST[$longname] ) ) {
		$pp->info['longname'] = $_POST[$longname];
		unset( $_POST[$longname] );
	}

	if ( isset( $_POST[$description] ) ) {
		$pp->info['description'] = $_POST[$description];
		unset( $_POST[$description] );
	}

	if ( isset( $_POST[$active] ) ) {
		$pp->processor->active = $_POST[$active];
		unset( $_POST[$active] );
	}

	$settings = $pp->getBackendSettings();

	if ( is_int( $pp->is_recurring() ) ) {
		$settings['recurring'] = 2;
	}

	foreach ( $settings as $name => $value ) {
		if ( $name == 'lists' ) {
			continue;
		}

		$postname = $procname  . '_' . $name;

		if ( isset( $_POST[$postname] ) ) {
			$val = $_POST[$postname];

			if ( empty( $val ) ) {
				switch( $name ) {
					case 'currency':
						$val = 'USD';
						break;
					default:
						break;
				}
			}

			$pp->settings[$name] = $_POST[$postname];
			unset( $_POST[$postname] );
		}
	}

	$pp->storeload();

	if ( $return ) {
		aecRedirect( 'index2.php?option=' . $option . '&task=editProcessor&id=' . $pp->id, _AEC_CONFIG_SAVED );
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=showProcessors', _AEC_CONFIG_SAVED );
	}
}

function listSubscriptionPlans( $option )
{
 	$database = &JFactory::getDBO();

	global $mainframe;

 	$limit			= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart		= $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );
	$filter_group	= $mainframe->getUserStateFromRequest( "filter_group", 'filter_group', array() );

	if ( !empty( $filter_group ) ) {
		$subselect = ItemGroupHandler::getChildren( $filter_group, 'item' );
	} else {
		$subselect = array();
	}

 	// get the total number of records
 	$query = 'SELECT count(*)'
		 	. ' FROM #__acctexp_plans'
		 	. ( empty( $subselect ) ? '' : ' WHERE id IN (' . implode( ',', $subselect ) . ')' )
		 	;
 	$database->setQuery( $query );
 	$total = $database->loadResult();

 	if ( $limit > $total ) {
 		$limitstart = 0;
 	}

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

 	// get the subset (based on limits) of records
	$rows = SubscriptionPlanHandler::getFullPlanList( $pageNav->limitstart, $pageNav->limit, $subselect );

	$gcolors = array();

	foreach ( $rows as $n => $row ) {
		$query = 'SELECT count(*)'
				. 'FROM #__users AS a'
				. ' LEFT JOIN #__acctexp_subscr AS b ON a.id = b.userid'
				. ' WHERE b.plan = ' . $row->id
				. ' AND (b.status = \'Active\' OR b.status = \'Trial\')'
				;
		$database->setQuery( $query	);

	 	$rows[$n]->usercount = $database->loadResult();
	 	if ( $database->getErrorNum() ) {
	 		echo $database->stderr();
	 		return false;
	 	}

	 	$query = 'SELECT count(*)'
				. ' FROM #__users AS a'
				. ' LEFT JOIN #__acctexp_subscr AS b ON a.id = b.userid'
				. ' WHERE b.plan = ' . $row->id
				. ' AND (b.status = \'Expired\')'
				;
		$database->setQuery( $query	);

	 	$rows[$n]->expiredcount = $database->loadResult();
	 	if ( $database->getErrorNum() ) {
	 		echo $database->stderr();
	 		return false;
	 	}

	 	$query = 'SELECT group_id'
				. ' FROM #__acctexp_itemxgroup'
				. ' WHERE type = \'item\''
				. ' AND item_id = \'' . $rows[$n]->id . '\''
				;
		$database->setQuery( $query	);
		$g = (int) $database->loadResult();

		$group = empty( $g ) ? 0 : $g;

		if ( !isset( $gcolors[$group] ) ) {
			$gcolors[$group] = array();
			$gcolors[$group]['color'] = ItemGroupHandler::groupColor( $group );
			$gcolors[$group]['icon'] = ItemGroupHandler::groupIcon( $group ) . '.png';
		}

		$rows[$n]->group = aecHTML::Icon( $gcolors[$group]['icon'], $group ) . '<strong>' . $group . '</strong>';
		$rows[$n]->color = $gcolors[$group]['color'];
	}


	$grouplist = ItemGroupHandler::getTree();

	$glist		= array();
	$sel_groups	= array();

	$glist[] = mosHTML::makeOption( 0, '- - - - - -' );

	if ( empty( $filter_group ) ) {
		$sel_groups[] = mosHTML::makeOption( 0, '- - - - - -' );
	}

	foreach ( $grouplist as $id => $glisti ) {
		$glist[] = mosHTML::makeOption( $glisti[0], $glisti[1] );
		if ( !empty( $filter_group ) ) {
			if ( in_array( $glisti[0], $filter_group ) ) {
				$sel_groups[] = mosHTML::makeOption( $glisti[0], $glisti[1] );
			}
		}
	}

	$lists['filter_group'] = mosHTML::selectList( $glist, 'filter_group[]', 'size="' . min(8,count($glist)+1) . '" multiple="multiple"', 'value', 'text', $sel_groups );

 	HTML_AcctExp::listSubscriptionPlans( $rows, $lists, $pageNav, $option );
 }

function editSubscriptionPlan( $id, $option )
{
	global $aecConfig;

	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	$lists = array();
	$params_values = array();
	$restrictions_values = array();
	$customparams_values = array();

	$customparamsarray = new stdClass();

	$row = new SubscriptionPlan( $database );
	$row->load( $id );

	$restrictionHelper = new aecRestrictionHelper();

	if ( !$row->id ) {
		$row->ordering	= 9999;
		$hasrecusers	= false;

		$params_values['active']	= 1;
		$params_values['visible']	= 0;
		$params_values['processors'] = 0;

		$restrictions_values['gid_enabled']	= 1;
		$restrictions_values['gid']			= 18;
	} else {
		$params_values = $row->params;
		$restrictions_values = $row->restrictions;

		// Clean up custom params
		if ( !empty( $row->customparams ) ) {
			foreach ( $row->customparams as $n => $v ) {
				if ( isset( $params_values[$n] ) || isset( $restrictions_values[$n] ) ) {
					unset( $row->customparams[$n] );
				}
			}
		}

		$customparams_values = $row->custom_params;

		// We need to convert the values that are set as object properties
		$params_values['active']				= $row->active;
		$params_values['visible']				= $row->visible;
		$params_values['email_desc']			= $row->getProperty( 'email_desc' );
		$params_values['name']					= $row->getProperty( 'name' );
		$params_values['desc']					= $row->getProperty( 'desc' );
		$params_values['micro_integrations']	= $row->micro_integrations;
		$params_values['processors']			= $row->params['processors'];

		// Checking if there is already a user, which disables certain actions
		$query  = 'SELECT count(*)'
				. ' FROM #__users AS a'
				. ' LEFT JOIN #__acctexp_subscr AS b ON a.id = b.userid'
				. ' WHERE b.plan = ' . $row->id
				. ' AND (b.status = \'Active\' OR b.status = \'Trial\')'
				. ' AND b.recurring =\'1\''
				;
		$database->setQuery( $query );
		$hasrecusers = ( $database->loadResult() > 0 ) ? true : false;
	}

	$stdformat = '{aecjson}{"cmd":"condition","vars":[{"cmd":"data","vars":"payment.freetrial"},'
				.'{"cmd":"concat","vars":[{"cmd":"constant","vars":"_CONFIRM_FREETRIAL"},"&nbsp;",{"cmd":"data","vars":"payment.method_name"}]},'
				.'{"cmd":"concat","vars":[{"cmd":"data","vars":"payment.amount"},{"cmd":"data","vars":"payment.currency_symbol"},"&nbsp;",{"cmd":"data","vars":"payment.method_name"}]}'
				.']}{/aecjson}'
				;

	// params and their type values
	$params['active']					= array( 'list_yesno', 1 );
	$params['visible']					= array( 'list_yesno', 1 );

	$params['name']						= array( 'inputC', '' );
	$params['desc']						= array( 'editor', '' );
	$params['customamountformat']		= array( 'inputD', $stdformat );
	$params['customthanks']				= array( 'inputC', '' );
	$params['customtext_thanks_keeporiginal']	= array( 'list_yesno', 1 );
	$params['customtext_thanks']		= array( 'editor', '' );
	$params['email_desc']				= array( 'inputD', '' );
	$params['micro_integrations_inherited']		= array( 'list', '' );
	$params['micro_integrations']		= array( 'list', '' );
	$params['micro_integrations_plan']	= array( 'list', '' );

	$params['params_remap']				= array( 'subarea_change', 'groups' );

	$groups = ItemGroupHandler::parentGroups( $row->id, 'item' );

	if ( !empty( $groups ) ) {
		$gs = array();
		foreach ( $groups as $groupid ) {
			$params['group_delete_'.$groupid] = array( 'checkbox', '', '', '' );

			$group = new ItemGroup( $database );
			$group->load( $groupid );

			$g = array();
			$g['name']	= $group->getProperty('name');
			$g['color']	= $group->params['color'];
			$g['icon']	= $group->params['icon'].'.png';

			$g['group']	= aecHTML::Icon( $g['icon'], $groupid ) . '<strong>' . $groupid . '</strong>';

			$gs[$groupid] = $g;
		}


		$customparamsarray->groups = $gs;
	} else {
		$customparamsarray->groups = null;
	}

	$grouplist = ItemGroupHandler::getTree();

	$glist = array();

	$glist[] = mosHTML::makeOption( 0, '- - - - - -' );
	foreach ( $grouplist as $id => $glisti ) {
		$glist[] = mosHTML::makeOption( $glisti[0], $glisti[1] );
	}

	$lists['add_group'] 			= mosHTML::selectList( $glist, 'add_group', 'size="' . min(6,count($glist)+1) . '"', 'value', 'text', ( ( $row->id ) ? 0 : 1 ) );

	$params['add_group']			= array( 'list', '', '', ( ( $row->id ) ? 0 : 1 ) );

	$params['params_remap']			= array( 'subarea_change', 'params' );

	$params['override_activation']	= array( 'list_yesno', 0 );
	$params['override_regmail']		= array( 'list_yesno', 0 );

	$params['full_free']			= array( 'list_yesno', '' );
	$params['full_amount']			= array( 'inputB', '' );
	$params['full_period']			= array( 'inputB', '' );
	$params['full_periodunit']		= array( 'list', 'D' );
	$params['trial_free']			= array( 'list_yesno', '' );
	$params['trial_amount']			= array( 'inputB', '' );
	$params['trial_period']			= array( 'inputB', '' );
	$params['trial_periodunit']		= array( 'list', 'D' );

	$params['gid_enabled']			= array( 'list_yesno', 1 );
	$params['gid']					= array( 'list', 18 );
	$params['lifetime']				= array( 'list_yesno', 0 );
	$params['processors']			= array( 'list', '' );
	$params['standard_parent']		= array( 'list', '' );
	$params['fallback']				= array( 'list', '' );
	$params['make_active']			= array( 'list_yesno', 1 );
	$params['make_primary']			= array( 'list_yesno', 1 );
	$params['update_existing']		= array( 'list_yesno', 1 );

	$params['similarplans']			= array( 'list', '' );
	$params['equalplans']			= array( 'list', '' );

	$params['notauth_redirect']		= array( 'inputC', '' );

	$params['restr_remap']			= array( 'subarea_change', 'restrictions' );

	$params = array_merge( $params, $restrictionHelper->getParams() );

	$rewriteswitches				= array( 'cms', 'user' );
	$params['rewriteInfo']			= array( 'fieldset', '', AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

	// ensure user can't add group higher than themselves
	$my_groups = $acl->get_object_groups( 'users', $user->id, 'ARO' );
	if ( is_array( $my_groups ) && count( $my_groups ) > 0) {
		$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
	} else {
		$ex_groups = array();
	}

	$gtree = $acl->get_group_children_tree( null, 'USERS', true );

	$ex_groups[] = 28;
	$ex_groups[] = 29;
	$ex_groups[] = 30;

	// remove users 'above' me
	$i = 0;
	while ( $i < count( $gtree ) ) {
		if ( in_array( $gtree[$i]->value, $ex_groups ) ) {
			array_splice( $gtree, $i, 1 );
		} else {
			$i++;
		}
	}

	// make the select list for first trial period units
	$perunit[] = mosHTML::makeOption( 'D', _PAYPLAN_PERUNIT1 );
	$perunit[] = mosHTML::makeOption( 'W', _PAYPLAN_PERUNIT2 );
	$perunit[] = mosHTML::makeOption( 'M', _PAYPLAN_PERUNIT3 );
	$perunit[] = mosHTML::makeOption( 'Y', _PAYPLAN_PERUNIT4 );

	$lists['trial_periodunit'] = mosHTML::selectList( $perunit, 'trial_periodunit', 'size="4"', 'value', 'text', arrayValueDefault($params_values, 'trial_periodunit', "D") );
	$lists['full_periodunit'] = mosHTML::selectList( $perunit, 'full_periodunit', 'size="4"', 'value', 'text', arrayValueDefault($params_values, 'full_periodunit', "D") );

	$params['processors_remap'] = array("subarea_change", "plan_params");

	$pps = PaymentProcessorHandler::getInstalledObjectList( 1 );

	if ( empty( $params_values['processors'] ) ) {
		$plan_procs = array();
	} else {
		$plan_procs = $params_values['processors'];
	}

	$firstarray = array();
	$secndarray = array();
	foreach ( $pps as $ppo ) {
		if ( in_array( $ppo->id, $plan_procs ) && !empty( $customparams_values[$ppo->id . '_aec_overwrite_settings'] ) ) {
			$firstarray[] = $ppo;
		} else {
			$secndarray[] = $ppo;
		}
	}

	$pps = array_merge( $firstarray, $secndarray );

	$selected_gw = array();
	$custompar = array();
	foreach ( $pps as $ppobj ) {
		if ( !$ppobj->active ) {
			continue;
		}

		$pp = null;
		$pp = new PaymentProcessor();

		if ( !$pp->loadName( $ppobj->name ) ) {
			continue;
		}

		$pp->init();
		$pp->getInfo();

		$custompar[$pp->id] = array();
		$custompar[$pp->id]['handle'] = $ppobj->name;
		$custompar[$pp->id]['name'] = $pp->info['longname'];
		$custompar[$pp->id]['params'] = array();

		$params['processor_' . $pp->id] = array( 'checkbox', _PAYPLAN_PROCESSORS_ACTIVATE_NAME, _PAYPLAN_PROCESSORS_ACTIVATE_DESC  );
		$custompar[$pp->id]['params'][] = 'processor_' . $pp->id;

		$params[$pp->id . '_aec_overwrite_settings'] = array( 'checkbox', _PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_NAME, _PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_DESC );
		$custompar[$pp->id]['params'][] = $pp->id . '_aec_overwrite_settings';

		$customparams = $pp->getCustomPlanParams();

		if ( is_array( $customparams ) ) {
			foreach ( $customparams as $customparam => $cpcontent ) {
				// Write the params field
				if ( defined( strtoupper( "_CFG_processor_plan_params_" . $customparam . "_name" ) ) ) {
					$cp_name = constant( strtoupper( "_CFG_processor_plan_params_" . $customparam . "_name" ) );
					$cp_desc = constant( strtoupper( "_CFG_processor_plan_params_" . $customparam . "_desc" ) );
				} else {
					$cp_name = constant( strtoupper( "_CFG_" . $pp->processor_name . "_plan_params_" . $customparam . "_name" ) );
					$cp_desc = constant( strtoupper( "_CFG_" . $pp->processor_name . "_plan_params_" . $customparam . "_desc" ) );
				}

				$shortname = $pp->id . "_" . $customparam;
				$params[$shortname] = array_merge( $cpcontent, array( $cp_name, $cp_desc ) );
				$custompar[$pp->id]['params'][] = $shortname;
			}
		}

		if ( empty( $plan_procs ) ) {
			continue;
		}

		if ( !in_array( $pp->id, $plan_procs ) ) {
			continue;
		}

		$params_values['processor_' . $pp->id] = 1;

		if ( isset( $customparams_values[$pp->id . '_aec_overwrite_settings'] ) ) {
			if ( !$customparams_values[$pp->id . '_aec_overwrite_settings'] ) {
				continue;
			}
		} else {
			continue;
		}

		$settings_array = $pp->getBackendSettings();

		if ( isset( $settings_array['lists'] ) ) {
			foreach ( $settings_array['lists'] as $listname => $listcontent ) {
				$lists[$pp->id . '_' . $listname] = $listcontent;
			}

			unset( $settings_array['lists'] );
		}

		// Iterate through settings form to...
		foreach ( $settings_array as $name => $values ) {
			$setting_name = $pp->id . '_' . $name;

			if ( isset( $customparams_values[$setting_name] ) ) {
				$value = $customparams_values[$setting_name];
			} elseif ( isset( $pp->settings[$name] ) ) {
				$value = $pp->settings[$name];
			} else {
				$value = '';
			}

			// ...assign new list fields
			switch( $settings_array[$name][0] ) {
				case 'list_yesno':
					$lists[$setting_name] = mosHTML::yesnoSelectList( $setting_name, '', $value );

					$settings_array[$name][0] = 'list';
					break;

				case 'list_currency':
					// Get currency list
					$currency_array	= explode( ',', $pp->info['currencies'] );

					// Transform currencies into OptionArray
					$currency_code_list = array();
					foreach ( $currency_array as $currency ) {
						if ( defined( '_CURRENCY_' . $currency )) {
							$currency_code_list[] = mosHTML::makeOption( $currency, constant( '_CURRENCY_' . $currency ) );
						}
					}

					// Create list
					$lists[$setting_name] = mosHTML::selectList( $currency_code_list, $setting_name, 'size="10"', 'value', 'text', $value );
					$settings_array[$name][0] = 'list';
					break;

				case 'list_language':
					// Get language list
					$language_array	= explode( ',', $pp->info['languages'] );

					// Transform languages into OptionArray
					$language_code_list = array();
					foreach ( $language_array as $language ) {
						$language_code_list[] = mosHTML::makeOption( $language, ( defined( '_AEC_LANG_' . $language  ) ? constant( '_AEC_LANG_' . $language ) : $language ) );
					}
					// Create list
					$lists[$setting_name] = mosHTML::selectList( $language_code_list, $setting_name, 'size="10"', 'value', 'text', $value );
					$settings_array[$name][0] = 'list';
					break;

				case 'list_plan':
					unset( $settings_array[$name] );
					break;

				default:
					break;
			}

			// ...put in missing language fields
			if ( !isset( $settings_array[$name][1] ) ) {
				// Create constant names
				$constantname = '_CFG_' . strtoupper( $ppobj->name ) . '_' . strtoupper($name) . '_NAME';
				$constantdesc = '_CFG_' . strtoupper( $ppobj->name ) . '_' . strtoupper($name) . '_DESC';

				// If the constantname does not exists, try a generic name or insert an error
				if ( defined( $constantname ) ) {
					$settings_array[$name][1] = constant( $constantname );
				} else {
					$genericname = '_CFG_PROCESSOR_' . strtoupper($name) . '_NAME';
					if ( defined( $genericname ) ) {
						$settings_array[$name][1] = constant( $genericname );
					} else {
						$settings_array[$name][1] = sprintf( _AEC_CMN_LANG_CONSTANT_IS_MISSING, $constantname );
					}
				}

				// If the constantname does not exists, try a generic name or insert an error
				if ( defined( $constantdesc ) ) {
					$settings_array[$name][2] = constant( $constantdesc );
				} else {
					$genericdesc = '_CFG_PROCESSOR_' . strtoupper($name) . '_DESC';
					if ( defined( $genericname ) ) {
						$settings_array[$name][2] = constant( $genericdesc );
					} else {
						$settings_array[$name][2] = sprintf( _AEC_CMN_LANG_CONSTANT_IS_MISSING, $constantdesc );
					}
				}
			}

			$params[$pp->id . '_' . $name] = $settings_array[$name];
			$custompar[$pp->id]['params'][] = $pp->id . '_' . $name;
		}
	}

	$customparamsarray->pp = $custompar;

	// get available active plans
	$available_plans = array();
	$available_plans[] = mosHTML::makeOption( '0', _PAYPLAN_NOPLAN );

	$query = 'SELECT `id` AS value, `name` AS text'
			. ' FROM #__acctexp_plans'
			. ' WHERE `active` = 1'
			. ' AND `id` != \'' . $row->id . '\'';
			;
	$database->setQuery( $query );
	$payment_plans = $database->loadObjectList();

 	if ( is_array( $payment_plans ) ) {
 		$active_plans	= array_merge( $available_plans, $payment_plans );
 	}
	$total_plans	= min( max( (count( $active_plans ) + 1 ), 4 ), 20 );

	$lists['fallback'] = mosHTML::selectList($active_plans, 'fallback', 'size="' . $total_plans . '"', 'value', 'text', arrayValueDefault($params_values, 'fallback', 0));
	$lists['standard_parent'] = mosHTML::selectList($active_plans, 'standard_parent', 'size="' . $total_plans . '"', 'value', 'text', arrayValueDefault($params_values, 'standard_parent', 0));

	// get similar plans
	if ( !empty( $params_values['similarplans'] ) ) {
		$query = 'SELECT `id` AS value, `name` As text'
				. ' FROM #__acctexp_plans'
				. ' WHERE `id` IN (' . implode( ',', $params_values['similarplans'] ) .')'
				;
		$database->setQuery( $query );

	 	$sel_similar_plans = $database->loadObjectList();
	} else {
		$sel_similar_plans = 0;
	}

	$lists['similarplans'] = mosHTML::selectList($payment_plans, 'similarplans[]', 'size="' . $total_plans . '" multiple="multiple"', 'value', 'text', $sel_similar_plans);

	// get equal plans
	if ( !empty( $params_values['equalplans'] ) ) {
		$query = 'SELECT `id` AS value, `name` AS text'
				. ' FROM #__acctexp_plans'
				. ' WHERE `id` IN (' . implode( ',', $params_values['equalplans'] ) .')'
				;
		$database->setQuery( $query );

	 	$sel_equal_plans = $database->loadObjectList();
	} else {
		$sel_equal_plans = 0;
	}

	$lists['equalplans'] = mosHTML::selectList($payment_plans, 'equalplans[]', 'size="' . $total_plans . '" multiple="multiple"', 'value', 'text', $sel_equal_plans);

	$lists = array_merge( $lists, $restrictionHelper->getLists( $params_values, $restrictions_values ) );

	// get available micro integrations
	$query = 'SELECT `id` AS value, CONCAT(`name`, " - ", `desc`) AS text'
			. ' FROM #__acctexp_microintegrations'
			. ' WHERE `active` = 1'
		 	. ' AND `hidden` = \'0\''
			. ' ORDER BY ordering'
			;
	$database->setQuery( $query );
	$mi_list = $database->loadObjectList();

	if ( !empty( $row->micro_integrations ) ) {
		$query = 'SELECT `id` AS value, CONCAT(`name`, " - ", `desc`) AS text'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `id` IN (' . implode( ',', $row->micro_integrations ) . ')'
		 		. ' AND `hidden` = \'0\''
				;
	 	$database->setQuery( $query );
		$selected_mi = $database->loadObjectList();
	} else {
		$selected_mi = array();
	}

	$lists['micro_integrations'] = mosHTML::selectList($mi_list, 'micro_integrations[]', 'size="' . min((count( $mi_list ) + 1), 25) . '" multiple="multiple"', 'value', 'text', $selected_mi);

	$inherited = $row->getMicroIntegrations( true );

	$inherited_list = array();

	if ( !empty( $inherited ) ) {
		foreach ( $mi_list as $miobj ) {
			if ( in_array( $miobj->value, $inherited ) ) {
				$inherited_list[] = $miobj;
			}
		}
	}

	$lists['micro_integrations_inherited'] = mosHTML::selectList($inherited_list, 'micro_integrations_inherited[]', 'size="' . min((count( $inherited_list ) + 1), 25) . '" disabled="disabled"', 'value', 'text', array());

	$mi_handler = new microIntegrationHandler();
	$mi_list = $mi_handler->getIntegrationList();

	$mi_htmllist = array();
	$mi_htmllist[]	= mosHTML::makeOption( '', _AEC_CMN_NONE_SELECTED );

	foreach ( $mi_list as $name ) {
		$mi = new microIntegration( $database );
		$mi->class_name = $name;
		if ( $mi->callIntegration() ){
			$len = 30 - AECToolbox::visualstrlen( trim( $mi->name ) );
			$fullname = str_replace( '#', '&nbsp;', str_pad( $mi->name, $len, '#' ) ) . ' - ' . substr($mi->desc, 0, 120);
			$mi_htmllist[] = mosHTML::makeOption( $name, $fullname );
		}
	}

	if ( !empty( $row->micro_integrations ) && is_array( $row->micro_integrations ) ) {
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `id` IN (' . implode( ',', $row->micro_integrations ) . ')'
		 		. ' AND `hidden` = \'1\''
				;
	 	$database->setQuery( $query );
		$hidden_mi = $database->loadObjectList();
	} else {
		$hidden_mi = array();
	}

	$customparamsarray->hasperplanmi = false;

	if ( !empty( $aecConfig->cfg['per_plan_mis'] ) || !empty( $hidden_mi ) ) {
		$customparamsarray->hasperplanmi = true;

		$lists['micro_integrations_plan'] = mosHTML::selectList( $mi_htmllist, 'micro_integrations_plan[]', 'size="' . min( ( count( $mi_list ) + 1 ), 25 ) . '" multiple="multiple"', 'value', 'text', array() );

		$custompar = array();

		$hidden_mi_list = array();
		if ( !empty( $hidden_mi ) ) {
			foreach ( $hidden_mi as $miobj ) {
				$hidden_mi_list[] = $miobj->id;
			}
		}

		$params['micro_integrations_hidden']		= array( 'hidden', '' );
		$params_values['micro_integrations_hidden']		= $hidden_mi_list;

		if ( !empty( $hidden_mi ) ) {
			foreach ( $hidden_mi as $miobj ) {
				$mi = new microIntegration( $database );

				if ( !$mi->load( $miobj->id ) ) {
					continue;
				}

				if ( !$mi->callIntegration( 1 ) ) {
					continue;
				}

				$custompar[$mi->id] = array();
				$custompar[$mi->id]['name'] = $mi->name;
				$custompar[$mi->id]['params'] = array();

				$prefix = 'MI_' . $mi->id . '_';

				$params[] = array( 'area_change', 'MI' );
				$params[] = array( 'subarea_change', 'E' );
				$params[] = array( 'add_prefix', $prefix );
				$params[] = array( 'userinfobox_sub', _MI_E_TITLE );

				$generalsettings = $mi->getGeneralSettings();

				foreach ( $generalsettings as $name => $value ) {
					$params[$prefix . $name] = $value;
					$custompar[$mi->id]['params'][] = $prefix . $name;

					if ( isset( $mi->$name ) ) {
						$params_values[$prefix.$name] = $mi->$name;
					} else {
						$params_values[$prefix.$name] = '';
					}
				}

				$params[]	= array( 'div_end', 0 );

				$misettings = $mi->getSettings();

				if ( isset( $misettings['lists'] ) ) {
					foreach ( $misettings['lists'] as $listname => $listcontent ) {
						$lists[$prefix . $listname] = str_replace( 'name="', 'name="'.$prefix, $listcontent );
					}

					unset( $misettings['lists'] );
				}

				$params[] = array( 'area_change', 'MI' );
				$params[] = array( 'subarea_change', $mi->class_name );
				$params[] = array( 'add_prefix', $prefix );
				$params[] = array( 'userinfobox_sub', _MI_E_SETTINGS );

				foreach ( $misettings as $name => $value ) {
					$params[$prefix . $name] = $value;
					$custompar[$mi->id]['params'][] = $prefix . $name;
				}

				$params[]	= array( 'div_end', 0 );
			}
		}

		if ( !empty( $custompar ) ) {
			$customparamsarray->mi = $custompar;
		}
	}

	$settings = new aecSettings ( 'payplan', 'general' );

	if ( is_array( $customparams_values ) ) {
		$settingsparams = array_merge( $params_values, $customparams_values, $restrictions_values );
	} else {
		$settingsparams = array_merge( $params_values, $restrictions_values );
	}

	$settings->fullSettingsArray( $params, $settingsparams, $lists ) ;

	// Call HTML Class
	$aecHTML = new aecHTML( $settings->settings, $settings->lists );

	if ( !empty( $customparamsarray ) ) {
		$aecHTML->customparams = $customparamsarray;
	}

	HTML_AcctExp::editSubscriptionPlan( $option, $aecHTML, $row, $hasrecusers );
}

function saveSubscriptionPlan( $option, $apply=0 )
{
	$database = &JFactory::getDBO();

	$row = new SubscriptionPlan( $database );
	$row->load( $_POST['id'] );

	$post = AECToolbox::cleanPOST( $_POST, false );

	$row->savePOSTsettings( $post );

	$row->storeload();

	if ( $_POST['id'] ) {
		$id = $_POST['id'];
	} else {
		$id = $row->getMax();
	}

	if ( !empty( $row->params['lifetime'] ) && !empty( $row->params['full_period'] ) ) {
		$short	= "Plan Warning";
		$event	= "You have selected a regular period for a plan that"
					. " already has the 'lifetime' (i.e. 'non expiring') flag set."
					. " The period you have set will be overridden by"
					. " that setting.";
		$tags	= 'settings,plan';
		$params = array();

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, $tags, $event, 32, $params );
	}

	$terms = $row->getTerms();

	if ( !$terms->checkFree() && empty( $row->params['processors'] ) ) {
		$short	= "Plan Warning";
		$event	= "You have set a plan to be non-free, yet did not select a payment processor."
					. " Without a processor assigned, the plan will not show up on the frontend.";
		$tags	= 'settings,plan';
		$params = array();

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, $tags, $event, 32, $params );
	}

	if ( !empty( $row->params['lifetime'] ) && !empty( $row->params['processors'] ) ) {
		$fcount	= 0;
		$found	= 0;

		foreach ( $row->params['processors'] as $procid ) {
			$fcount++;

			if ( isset( $row->custom_params[$procid.'_recurring'] ) ) {
				if ( ( 0 < $row->custom_params[$procid.'_recurring'] ) && ( $row->custom_params[$procid.'_recurring'] < 2 ) ) {
					$found++;
				} elseif ( $row->custom_params[$procid.'_recurring'] == 2 ) {
					$fcount++;
				}
			} else {
				$pp = new PaymentProcessor( $database );
				if ( ( 0 < $pp->is_recurring() ) && ( $pp->is_recurring() < 2 ) ) {
					$found++;
				} elseif ( $pp->is_recurring() == 2 ) {
					$fcount++;
				}
			}
		}

		if ( $found ) {
			if ( ( $found < $fcount ) && ( $fcount > 1 ) ) {
				$event	= "You have selected one or more processors that only support recurring payments"
						. ", yet the plan is set to a lifetime period."
						. " This is not possible and the processors will not be displayed as options.";
			} else {
				$event	= "You have selected a processor that only supports recurring payments"
						. ", yet the plan is set to a lifetime period."
						. " This is not possible and the plan will not be displayed.";
			}

			$short	= "Plan Warning";
			$tags	= 'settings,plan';
			$params = array();

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 32, $params );
		}
	}

	if ( $apply ) {
		aecRedirect( 'index2.php?option=' . $option . '&task=editSubscriptionPlan&id=' . $id, _AEC_MSG_SUCESSFULLY_SAVED );
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=showSubscriptionPlans' );
	}
}

function removeSubscriptionPlan( $id, $option )
{
	$database = &JFactory::getDBO();

	$ids = implode( ',', $id );

	$query = 'SELECT count(*)'
			. ' FROM #__acctexp_plans'
			. ' WHERE `id` IN (' . $ids . ')'
			;
	$database->setQuery( $query );
	$total = $database->loadResult();

	if ( $total == 0 ) {
		echo "<script> alert('" . html_entity_decode( _AEC_MSG_NO_ITEMS_TO_DELETE ) . "'); window.history.go(-1);</script>\n";
		exit;
	}

	// See if we have registered users on this plan.
	// If we have it, the plan(s) cannot be removed
	$query = 'SELECT count(*)'
			. ' FROM #__users AS a'
			. ' LEFT JOIN #__acctexp_subscr AS b ON a.id = b.userid'
			. ' WHERE b.plan = ' . $row->id
			. ' AND (b.status = \'Active\' OR b.status = \'Trial\')'
			;
	$database->setQuery( $query );
	$subscribers = $database->loadResult();

	if ( $subscribers > 0 ) {
		$msg = _AEC_MSG_NO_DEL_W_ACTIVE_SUBSCRIBER;
	} else {
		// Delete plans
		$query = 'DELETE FROM #__acctexp_plans'
				. ' WHERE `id` IN (' . $ids . ')'
				;
		$database->setQuery( $query );
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		ItemGroupHandler::removeChildren( $id, false, 'item' );

		$msg = $total . ' ' . _AEC_MSG_ITEMS_DELETED;
	}
	aecRedirect( 'index2.php?option=' . $option . '&task=showSubscriptionPlans', $msg );
}

function cancelSubscriptionPlan( $option )
{
	aecRedirect( 'index2.php?option=' . $option . '&task=showSubscriptionPlans', _AEC_CMN_EDIT_CANCELLED );
}

function changeSubscriptionPlan( $cid=null, $state=0, $type, $option )
{
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
		exit;
	}

	$total	= count( $cid );
	$cids	= implode( ',', $cid );

	$query = 'UPDATE #__acctexp_plans'
			. ' SET `' . $type . '` = \'' . $state . '\''
			. ' WHERE `id` IN (' . $cids . ')'
			;
	$database->setQuery( $query );

	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( $state == '1' ) {
		$msg = ( ( strcmp( $type, 'active' ) === 0 ) ? _AEC_CMN_PUBLISHED : _AEC_CMN_MADE_VISIBLE );
	} elseif ( $state == '0' ) {
		$msg = ( ( strcmp( $type, 'active' ) === 0 ) ? _AEC_CMN_NOT_PUBLISHED : _AEC_CMN_MADE_INVISIBLE );
	}

	$msg = sprintf( _AEC_MSG_ITEMS_SUCESSFULLY, $total ) . ' ' . $msg;

	aecRedirect( 'index2.php?option=' . $option . '&task=showSubscriptionPlans', $msg );
}

function listItemGroups( $option )
{
 	$database = &JFactory::getDBO();

	global $mainframe;

 	$limit		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart = $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );

 	// get the total number of records
 	$query = 'SELECT count(*)'
		 	. ' FROM #__acctexp_itemgroups'
		 	;
 	$database->setQuery( $query );
 	$total = $database->loadResult();
 	echo $database->getErrorMsg();

 	if ( $limit > $total ) {
 		$limitstart = 0;
 	}

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

 	// get the subset (based on limits) of records
 	$query = 'SELECT *'
		 	. ' FROM #__acctexp_itemgroups'
		 	. ' GROUP BY `id`'
		 	. ' ORDER BY `ordering`'
		 	. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit
		 	;
	$database->setQuery( $query );

 	$rows = $database->loadObjectList();
 	if ( $database->getErrorNum() ) {
 		echo $database->stderr();
 		return false;
 	}

	$gcolors = array();

	foreach ( $rows as $n => $row ) {
		$query = 'SELECT count(*)'
				. 'FROM #__users AS a'
				. ' LEFT JOIN #__acctexp_subscr AS b ON a.id = b.userid'
				. ' WHERE b.plan = ' . $row->id
				. ' AND (b.status = \'Active\' OR b.status = \'Trial\')'
				;
		$database->setQuery( $query	);

	 	$rows[$n]->usercount = $database->loadResult();
	 	if ( $database->getErrorNum() ) {
	 		echo $database->stderr();
	 		return false;
	 	}

	 	$query = 'SELECT count(*)'
				. ' FROM #__users AS a'
				. ' LEFT JOIN #__acctexp_subscr AS b ON a.id = b.userid'
				. ' WHERE b.plan = ' . $row->id
				. ' AND (b.status = \'Expired\')'
				;
		$database->setQuery( $query	);

	 	$rows[$n]->expiredcount = $database->loadResult();
	 	if ( $database->getErrorNum() ) {
	 		echo $database->stderr();
	 		return false;
	 	}

		$group = $rows[$n]->id;

		if ( !isset( $gcolors[$group] ) ) {
			$gcolors[$group] = array();
			$gcolors[$group]['color'] = ItemGroupHandler::groupColor( $group );
			$gcolors[$group]['icon'] = ItemGroupHandler::groupIcon( $group ) . '.png';
		}

		$rows[$n]->group = aecHTML::Icon( $gcolors[$group]['icon'], $group );
		$rows[$n]->color = $gcolors[$group]['color'];
	}

 	HTML_AcctExp::listItemGroups( $rows, $pageNav, $option );
 }

function editItemGroup( $id, $option )
{
	$database = &JFactory::getDBO();

	$lists = array();
	$params_values = array();
	$restrictions_values = array();
	$customparams_values = array();

	$row = new ItemGroup( $database );
	$row->load( $id );

	$restrictionHelper = new aecRestrictionHelper();

	if ( !$row->id ) {
		$row->ordering	= 9999;

		$params_values['active']	= 1;
		$params_values['visible']	= 0;

		$restrictions_values['gid_enabled']	= 1;
		$restrictions_values['gid']			= 18;
	} else {
		$params_values = $row->params;
		$restrictions_values = $row->restrictions;
		$customparams_values = $row->custom_params;

		// We need to convert the values that are set as object properties
		$params_values['active']				= $row->active;
		$params_values['visible']				= $row->visible;
		$params_values['name']					= $row->getProperty( 'name' );
		$params_values['desc']					= $row->getProperty( 'desc' );
	}

	// params and their type values
	$params['active']					= array( 'list_yesno', 1 );
	$params['visible']					= array( 'list_yesno', 0 );

	$params['name']						= array( 'inputC', '' );
	$params['desc']						= array( 'editor', '' );

	$params['color']					= array( 'list', '' );
	$params['icon']						= array( 'list', '' );

	$params['reveal_child_items']		= array( 'list_yesno', 0 );
	$params['symlink']					= array( 'inputC', '' );

	$params['notauth_redirect']			= array( 'inputD', '' );

	$params['micro_integrations']		= array( 'list', '' );

	$params['params_remap']				= array( 'subarea_change', 'groups' );

	$groups = ItemGroupHandler::parentGroups( $row->id, 'group' );

	if ( !empty( $groups ) ) {
		$gs = array();
		foreach ( $groups as $groupid ) {
			$params['group_delete_'.$groupid] = array( 'checkbox', '', '', '' );

			$group = new ItemGroup( $database );
			$group->load( $groupid );

			$g = array();
			$g['name']	= $group->getProperty('name');
			$g['color']	= $group->params['color'];
			$g['icon']	= $group->params['icon'].'.png';

			$g['group']	= aecHTML::Icon( $g['icon'], $groupid ) . '<strong>' . $groupid . '</strong>';

			$gs[$groupid] = $g;
		}


		$customparamsarray->groups = $gs;
	} else {
		$customparamsarray->groups = null;
	}

	$grouplist = ItemGroupHandler::getTree();

	$glist = array();

	$glist[] = mosHTML::makeOption( 0, '- - - - - -' );
	foreach ( $grouplist as $id => $glisti ) {
		$glist[] = mosHTML::makeOption( $glisti[0], $glisti[1] );
	}

	$lists['add_group'] 	= mosHTML::selectList( $glist, 'add_group', 'size="' . min(6,count($glist)+1) . '"', 'value', 'text', ( ( $row->id ) ? 0 : 1 ) );

	$params['add_group']	= array( 'list', '', '', ( ( $row->id ) ? 0 : 1 ) );

	$params['restr_remap']	= array( 'subarea_change', 'restrictions' );

	$params = array_merge( $params, $restrictionHelper->getParams() );

	$rewriteswitches		= array( 'cms', 'user' );
	$params['rewriteInfo']	= array( 'fieldset', '', AECToolbox::rewriteEngineInfo( $rewriteswitches ) );


	// light blue, another blue, brown, green, another green, reddish gray, yellowish, purpleish, red
	$colors = array( 'BBDDFF', '5F8BC4', 'A2BE72', 'DDFF99', 'D07C30', 'C43C42', 'AA89BB', 'B7B7B7', '808080' );

	$colorlist = array();
	foreach ( $colors as $color ) {
		$obj = new stdClass;
		$obj->value = $color;
		$obj->text = '- - ' . $color . ' - -';
		$obj->id = 'aec_colorlist_'.$color;

		$colorlist[] = $obj;
	}

	$lists['color'] = mosHTML::selectList($colorlist, 'color', 'size="1"', 'value', 'text', arrayValueDefault($params_values, 'color', 'BBDDFF'));

	$icons = array( 'blue', 'green', 'orange', 'pink', 'purple', 'red', 'yellow' );

	$iconlist = array();
	foreach ( $icons as $iconname ) {
		$obj = new stdClass;
		$obj->value = 'flag_'.$iconname;
		$obj->text = $iconname.' '.'flag';
		$obj->id = 'aec_iconlist_flag_'.$iconname;

		$iconlist[] = $obj;
	}

	$lists['icon'] = mosHTML::selectList($iconlist, 'icon', 'size="1"', 'value', 'text', arrayValueDefault($params_values, 'icon', 'blue'));

	// get available micro integrations
	$query = 'SELECT `id` AS value, CONCAT(`name`, " - ", `desc`) AS text'
			. ' FROM #__acctexp_microintegrations'
			. ' WHERE `active` = 1'
		 	. ' AND `hidden` = \'0\''
			. ' ORDER BY ordering'
			;
	$database->setQuery( $query );
	$mi_list = $database->loadObjectList();

	if ( !empty( $row->params['micro_integrations'] ) ) {
		$query = 'SELECT `id` AS value, CONCAT(`name`, " - ", `desc`) AS text'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `id` IN (' . implode( ',', $row->params['micro_integrations'] ) . ')'
		 		. ' AND `hidden` = \'0\''
				;
	 	$database->setQuery( $query );
		$selected_mi = $database->loadObjectList();
	} else {
		$selected_mi = array();
	}

	$lists['micro_integrations'] = mosHTML::selectList($mi_list, 'micro_integrations[]', 'size="' . min((count( $mi_list ) + 1), 25) . '" multiple="multiple"', 'value', 'text', $selected_mi);

	$settings = new aecSettings ( 'itemgroup', 'general' );
	if ( is_array( $customparams_values ) ) {
		$settingsparams = array_merge( $params_values, $customparams_values, $restrictions_values );
	} elseif( is_array( $restrictions_values ) ){
		$settingsparams = array_merge( $params_values, $restrictions_values );
	}
	else {
		$settingsparams = $params_values;
	}

	$lists = array_merge( $lists, $restrictionHelper->getLists( $params_values, $restrictions_values ) );

	$settings->fullSettingsArray( $params, $settingsparams, $lists ) ;

	// Call HTML Class
	$aecHTML = new aecHTML( $settings->settings, $settings->lists );
	if ( !empty( $customparamsarray ) ) {
		$aecHTML->customparams = $customparamsarray;
	}

	HTML_AcctExp::editItemGroup( $option, $aecHTML, $row );
}

function saveItemGroup( $option, $apply=0 )
{
	$database = &JFactory::getDBO();

	$row = new ItemGroup( $database );
	$row->load( $_POST['id'] );

	$post = AECToolbox::cleanPOST( $_POST, false );

	$row->savePOSTsettings( $post );

	if ( !$row->check() ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}
	if ( !$row->store() ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-2); </script>\n";
		exit();
	}

	$row->reorder();

	if ( $_POST['id'] ) {
		$id = $_POST['id'];
	} else {
		$id = $row->getMax();
	}

	if ( $apply ) {
		aecRedirect( 'index2.php?option=' . $option . '&task=editItemGroup&id=' . $id, _AEC_MSG_SUCESSFULLY_SAVED );
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=showItemGroups' );
	}
}

function removeItemGroup( $id, $option )
{
	$database = &JFactory::getDBO();

	$ids = implode( ',', $id );

	$query = 'SELECT count(*)'
			. ' FROM #__acctexp_itemgroups'
			. ' WHERE `id` IN (' . $ids . ')'
			;
	$database->setQuery( $query );
	$total = $database->loadResult();

	if ( $total == 0 ) {
		echo "<script> alert('" . html_entity_decode( _AEC_MSG_NO_ITEMS_TO_DELETE ) . "'); window.history.go(-1);</script>\n";
		exit;
	}

	$total = 0;

	foreach ( $id as $i ) {
		$ig = new ItemGroup( $database );
		$ig->load( $i );

		if ( $ig->delete() !== false ) {
			ItemGroupHandler::removeChildren( $i, false, 'group' );

			$total++;
		}
	}

	if ( $total == 0 ) {
		echo "<script> alert('" . html_entity_decode( _AEC_MSG_NO_ITEMS_TO_DELETE ) . "'); window.history.go(-1);</script>\n";
		exit;
	} else {
		$msg = $total . ' ' . _AEC_MSG_ITEMS_DELETED;

		aecRedirect( 'index2.php?option=' . $option . '&task=showItemGroups', $msg );
	}
}

function cancelItemGroup( $option )
{
	aecRedirect( 'index2.php?option=' . $option . '&task=showItemGroups', _AEC_CMN_EDIT_CANCELLED );
}

function changeItemGroup( $cid=null, $state=0, $type, $option )
{
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		echo "<script> alert('" . _AEC_ALERT_SELECT_FIRST . "'); window.history.go(-1);</script>\n";
		exit;
	}

	$total	= count( $cid );
	$cids	= implode( ',', $cid );

	$query = 'UPDATE #__acctexp_itemgroups'
			. ' SET `' . $type . '` = \'' . $state . '\''
			. ' WHERE `id` IN (' . $cids . ')'
			;
	$database->setQuery( $query );

	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( $state == '1' ) {
		$msg = ( ( strcmp( $type, 'active' ) === 0 ) ? _AEC_CMN_PUBLISHED : _AEC_CMN_MADE_VISIBLE );
	} elseif ( $state == '0' ) {
		$msg = ( ( strcmp( $type, 'active' ) === 0 ) ? _AEC_CMN_NOT_PUBLISHED : _AEC_CMN_MADE_INVISIBLE );
	}

	$msg = sprintf( _AEC_MSG_ITEMS_SUCESSFULLY, $total ) . ' ' . $msg;

	aecRedirect( 'index2.php?option=' . $option . '&task=showItemGroups', $msg );
}

function listMicroIntegrations( $option )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$limit		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart	= $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );

	$orderby		= $mainframe->getUserStateFromRequest( "orderby_mi{$option}", 'orderby_mi', 'ordering ASC' );
	$search			= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search			= $database->getEscaped( trim( strtolower( $search ) ) );

	$filter_planid	= intval( $mainframe->getUserStateFromRequest( "filter_planid{$option}", 'filter_planid', 0 ) );

	$ordering = false;

	if ( strpos( $orderby, 'ordering' ) !== false ) {
		$ordering = true;
	}

	// get the total number of records
	$query = 'SELECT count(*)'
		 	. ' FROM #__acctexp_microintegrations'
		 	. ' WHERE `hidden` = \'0\''
		 	;
	$database->setQuery( $query );
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	if ( $limit > $total ) {
		$limitstart = 0;
	}

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

	$where = array();
	$where[] = '`hidden` = \'0\'';

	if ( isset( $search ) && $search!= '' ) {
		$where[] = "(name LIKE '%$search%' OR class_name LIKE '%$search%')";
	}

	if ( isset( $filter_planid ) && $filter_planid > 0 ) {
		$mis = microIntegrationHandler::getMIsbyPlan( $filter_planid );

		if ( !empty( $mis ) ) {
			$where[] = "(id IN (" . implode( ',', $mis ) . "))";
		} else {
			$filter_planid = "";
		}
	}

	// get the subset (based on limits) of required records
	$query = 'SELECT * FROM #__acctexp_microintegrations';

	$query .= (count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

	$query .= ' ORDER BY ' . $orderby;
	$query .= ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit;

	$database->setQuery( $query );

	$rows = $database->loadObjectList();
	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}

	$sel = array();
	$sel[] = mosHTML::makeOption( 'ordering ASC',		_ORDERING_ASC );
	$sel[] = mosHTML::makeOption( 'ordering DESC',		_ORDERING_DESC );
	$sel[] = mosHTML::makeOption( 'id ASC',				_ID_ASC );
	$sel[] = mosHTML::makeOption( 'id DESC',			_ID_DESC );
	$sel[] = mosHTML::makeOption( 'name ASC',			_NAME_ASC );
	$sel[] = mosHTML::makeOption( 'name DESC',			_NAME_DESC );
	$sel[] = mosHTML::makeOption( 'class_name ASC',		_CLASSNAME_ASC );
	$sel[] = mosHTML::makeOption( 'class_name DESC',	_CLASSNAME_DESC );

	$lists['orderNav'] = mosHTML::selectList( $sel, 'orderby_mi', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $orderby );

	// Get list of plans for filter
	$query = 'SELECT `id`, `name`'
			. ' FROM #__acctexp_plans'
			. ' ORDER BY `ordering`'
			;
	$database->setQuery( $query );
	$db_plans = $database->loadObjectList();

	$plans[] = mosHTML::makeOption( '0', _FILTER_PLAN, 'id', 'name' );
	if ( is_array( $db_plans ) ) {
		$plans = array_merge( $plans, $db_plans );
	}
	$lists['filterplanid']	= mosHTML::selectList( $plans, 'filter_planid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'id', 'name', $filter_planid );

	HTML_AcctExp::listMicroIntegrations( $rows, $pageNav, $option, $lists, $search, $ordering );
}

function editMicroIntegration ( $id, $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	$lists	= array();
	$mi		= new microIntegration( $database );
	$mi->load( $id );

	$aecHTML = null;

	$mi_gsettings = $mi->getGeneralSettings();

	if ( !$mi->id ) {
		// Create MI Selection List
		$mi_handler = new microIntegrationHandler();
		$mi_list = $mi_handler->getIntegrationList();

		$mi_htmllist	= array();
		if ( count( $mi_list ) > 0 ) {
			foreach ( $mi_list as $name ) {
				$mi_item = new microIntegration( $database );
				$mi_item->class_name = $name;
				if ( $mi_item->callIntegration() ) {
					$len = 30 - AECToolbox::visualstrlen( trim( $mi->name ) );
					$fullname = str_replace( '#', '&nbsp;', str_pad( $mi_item->name, $len, '#' ) )
					. ' - ' . $mi_item->desc;
					$mi_htmllist[] = mosHTML::makeOption( $name, $fullname );
				}
			}

			$lists['class_name'] = mosHTML::selectList( $mi_htmllist, 'class_name', 'size="' . min( ( count( $mi_list ) + 1 ), 25 ) . '"', 'value', 'text', '' );
		} else {
			$lists['class_name'] = '';
		}
	}

	if ( $mi->id ) {
		// Call MI (override active check) and Settings
		if ( $mi->callIntegration( true ) ) {
			$set = array();
			foreach ( $mi_gsettings as $n => $v ) {
				if ( !isset( $mi->$n ) ) {
					if (  isset( $mi->settings[$n] ) ) {
						$set[$n] = $mi->settings[$n];
					} else {
						$set[$n] = null;
					}
				} else {
					$set[$n] = $mi->$n;
				}
			}

			$mi_gsettings[$mi->id.'remap']	= array( 'area_change', 'MI' );
			$mi_gsettings[$mi->id.'remaps']	= array( 'subarea_change', $mi->class_name );

			$mi_settings = $mi->getSettings();

			// Get lists supplied by the MI
			if ( !empty( $mi_settings['lists'] ) ) {
				$lists = array_merge( $lists, $mi_settings['lists'] );
				unset( $mi_settings['lists'] );
			}

			$settings = new aecSettings( 'MI', 'E' );
			$settings->fullSettingsArray( array_merge( $mi_gsettings, $mi_settings ), $set, $lists );

			// Call HTML Class
			$aecHTML = new aecHTML( $settings->settings, $settings->lists );

			$aecHTML->hasSettings = false;

			$aecHTML->customparams = array();
			foreach ( $mi_settings as $n => $v ) {
				$aecHTML->customparams[] = $n;
			}

			$aecHTML->hasSettings = true;
		} else {
			$short	= 'microIntegration loading failure';
			$event	= 'When trying to load microIntegration: ' . $mi->id . ', callIntegration failed';
			$tags	= 'microintegration,loading,error';
			$params = array();

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 128, $params );
		}
	} else {
		$settings = new aecSettings( 'MI', 'E' );
		$settings->fullSettingsArray( $mi_gsettings, array(), $lists );

		// Call HTML Class
		$aecHTML = new aecHTML( $settings->settings, $settings->lists );

		$aecHTML->hasSettings = false;
	}

	HTML_AcctExp::editMicroIntegration( $option, $mi, $lists, $aecHTML );
}

function saveMicroIntegration( $option, $apply=0 )
{
	$database = &JFactory::getDBO();

	unset( $_POST['option'] );
	unset( $_POST['task'] );

	$id = $_POST['id'] ? $_POST['id'] : 0;

	$mi = new microIntegration( $database );
	$mi->load( $id );

	if ( !empty( $_POST['class_name'] ) ) {
		$load = $mi->callDry( $_POST['class_name'] );
	} else {
		$load = $mi->callIntegration( 1 );
	}

	if ( $load ) {
		$mi->savePostParams( $_POST );

		$mi->storeload();
	} else {
		$short	= 'microIntegration storing failure';
		if ( !empty( $_POST['class_name'] ) ) {
			$event	= 'When trying to store microIntegration: ' . $_POST['class_name'] . ', callIntegration failed';
		} else {
			$event	= 'When trying to store microIntegration: ' . $mi->id . ', callIntegration failed';
		}
		$tags	= 'microintegration,loading,error';
		$params = array();

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, $tags, $event, 128, $params );
	}

	$mi->reorder();

	if ( $id ) {
		if ( $apply ) {
			aecRedirect( 'index2.php?option=' . $option . '&task=editMicroIntegration&id=' . $id, _AEC_MSG_SUCESSFULLY_SAVED );
		} else {
			aecRedirect( 'index2.php?option=' . $option . '&task=showMicroIntegrations', _AEC_MSG_SUCESSFULLY_SAVED );
		}
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=editMicroIntegration&id=' . $mi->id , _AEC_MSG_SUCESSFULLY_SAVED );
	}

}

function removeMicroIntegration( $id, $option )
{
	$database = &JFactory::getDBO();

	$ids = implode( ',', $id );

	$query = 'SELECT count(*)'
			. ' FROM #__acctexp_microintegrations'
			. ' WHERE `id` IN (' . $ids . ')'
			;
	$database->setQuery( $query );
	$total = $database->loadResult();

	if ( $total==0 ) {
		echo "<script> alert('" . html_entity_decode( _AEC_MSG_NO_ITEMS_TO_DELETE ) . "'); window.history.go(-1);</script>\n";
		exit;
	}

	// Call On-Deletion function
	foreach ( $id as $k ) {
		$mi = new microIntegration($database);
		$mi->load($k);
		if ( $mi->callIntegration() ) {
			$mi->delete();
		}
	}

	// Micro Integrations from table
	$query = 'DELETE FROM #__acctexp_microintegrations'
			. ' WHERE `id` IN (' . $ids . ')'
			;
	$database->setQuery( $query	);

	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$msg = $total . ' ' . _AEC_MSG_ITEMS_DELETED;

	aecRedirect( 'index2.php?option=' . $option . '&task=showMicroIntegrations', $msg );
}

function cancelMicroIntegration( $option )
{
	aecRedirect( 'index2.php?option=' . $option . '&task=showMicroIntegrations', _AEC_CMN_EDIT_CANCELLED );
}

// Changes the state of one or more content pages
// @param array An array of unique plan id numbers
// @param integer 0 if unpublishing, 1 if publishing
//

function changeMicroIntegration( $cid=null, $state=0, $option )
{
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $state == 1 ? _AEC_CMN_TOPUBLISH: _AEC_CMN_TOUNPUBLISH;
		echo "<script> alert('" . sprintf( html_entity_decode( _AEC_ALERT_SELECT_FIRST_TO ), $action ) . "'); window.history.go(-1);</script>\n";
		exit;
	}

	$total = count( $cid );
	$cids = implode( ',', $cid );

	$query = 'UPDATE #__acctexp_microintegrations'
			. ' SET `active` = \'' . $state . '\''
			. ' WHERE `id` IN (' . $cids . ')'
			;
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( $state == '1' ) {
		$msg = $total . ' ' . _AEC_MSG_ITEMS_SUCC_PUBLISHED;
	} elseif ( $state == '0' ) {
		$msg = $total . ' ' . _AEC_MSG_ITEMS_SUCC_UNPUBLISHED;
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=showMicroIntegrations', $msg );
}

function listCoupons( $option, $type )
{
 	$database = &JFactory::getDBO();

	global $mainframe;

 	$limit		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) );
	$limitstart = $mainframe->getUserStateFromRequest( "viewconf{$option}limitstart", 'limitstart', 0 );

	$total = 0;

	if ( !$type ) {
	 	$table = '#__acctexp_coupons';
	} else {
	 	$table = '#__acctexp_coupons_static';
	}

	$query = 'SELECT count(*)'
			. ' FROM ' . $table
			;
 	$database->setQuery( $query );
 	$total = $database->loadResult();

 	if ( $limit > $total ) {
 		$limitstart = 0;
 	}

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

 	// get the subset (based on limits) of required records
 	$query = 'SELECT *'
		 	. ' FROM ' . $table
		 	. ' GROUP BY `id`'
		 	. ' ORDER BY `ordering`'
		 	. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit
		 	;
 	$database->setQuery( $query	);

 	$rows = $database->loadObjectList();
 	if ( $database->getErrorNum() ) {
 		echo $database->stderr();
 		return false;
 	}

	HTML_AcctExp::listCoupons( $rows, $pageNav, $option, $type );
 }

function editCoupon( $id, $option, $new, $type )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	global $mainframe;

	$lists					= array();
	$params_values			= array();
	$restrictions_values	= array();

	$cph = new couponHandler();

	if ( !$new ) {
		$cph->coupon = new Coupon( $database, $type );
		$cph->coupon->load( $id );

		$params_values			= $cph->coupon->params;
		$discount_values		= $cph->coupon->discount;
		$restrictions_values	= $cph->coupon->restrictions;
	} else {
		$cph->coupon = new Coupon( $database, 1 );
		$cph->coupon->createNew();

		$discount_values		= array();
		$restrictions_values	= array();
	}

	// We need to convert the values that are set as object properties
	$params_values['active']				= $cph->coupon->active;
	$params_values['type']					= $type;
	$params_values['name']					= $cph->coupon->name;
	$params_values['desc']					= $cph->coupon->desc;
	$params_values['coupon_code']			= $cph->coupon->coupon_code;
	$params_values['usecount']				= $cph->coupon->usecount;
	$params_values['micro_integrations']	= $cph->coupon->micro_integrations;

	// params and their type values
	$params['active']						= array( 'list_yesno',		1 );
	$params['type']							= array( 'list_yesno',		1 );
	$params['name']							= array( 'inputC',			'' );
	$params['desc']							= array( 'inputE',			'' );
	$params['coupon_code']					= array( 'inputC',			'' );
	$params['micro_integrations']			= array( 'list',			'' );

	$params['params_remap']					= array( 'subarea_change',	'params' );

	$params['amount_use']					= array( 'list_yesno',		'' );
	$params['amount']						= array( 'inputB',			'' );
	$params['amount_percent_use']			= array( 'list_yesno',		'' );
	$params['amount_percent']				= array( 'inputB',			'' );
	$params['percent_first']				= array( 'list_yesno',		'' );
	$params['useon_trial']					= array( 'list_yesno',		'' );
	$params['useon_full']					= array( 'list_yesno',		'' );
	$params['useon_full_all']				= array( 'list_yesno',		'' );

	$params['has_start_date']				= array( 'list_yesno',		1 );
	$params['start_date']					= array( 'list_date',		date( 'Y-m-d', time() + $mainframe->getCfg( 'offset' ) *3600 ) );
	$params['has_expiration']				= array( 'list_yesno',		0);
	$params['expiration']					= array( 'list_date',		date( 'Y-m-d', time() + $mainframe->getCfg( 'offset' ) *3600 ) );
	$params['has_max_reuse']				= array( 'list_yesno',		1 );
	$params['max_reuse']					= array( 'inputB',			1 );
	$params['has_max_peruser_reuse']		= array( 'list_yesno',		1 );
	$params['max_peruser_reuse']			= array( 'inputB',			1 );
	$params['usecount']						= array( 'inputB',			0 );

	$params['usage_plans_enabled']			= array( 'list_yesno',		0 );
	$params['usage_plans']					= array( 'list',			0 );

	$params['usage_cart_full']				= array( 'list_yesno',		0 );
	$params['cart_multiple_items']			= array( 'list_yesno',		0 );
	$params['cart_multiple_items_amount']	= array( 'inputB',			'' );

	$params['restr_remap']					= array( 'subarea_change',	'restrictions' );

	$params['depend_on_subscr_id']			= array( 'list_yesno',		0 );
	$params['subscr_id_dependency']			= array( 'inputB',			'' );
	$params['allow_trial_depend_subscr']	= array( 'list_yesno',		0 );

	$params['restrict_combination']			= array( 'list_yesno',		0 );
	$params['bad_combinations']				= array( 'list',			'' );

	$params['allow_combination']			= array( 'list_yesno',		0 );
	$params['good_combinations']			= array( 'list',			'' );

	$params['restrict_combination_cart']	= array( 'list_yesno',		0 );
	$params['bad_combinations_cart']		= array( 'list',			'' );

	$params['allow_combination_cart']		= array( 'list_yesno',		0 );
	$params['good_combinations_cart']		= array( 'list',			'' );

	$restrictionHelper = new aecRestrictionHelper();
	$params = array_merge( $params, $restrictionHelper->getParams() );

	// get available plans
	$available_plans = array();
	$available_plans[]			= mosHTML::makeOption( '0', _PAYPLAN_NOPLAN );

	$query = 'SELECT `id` as value, `name` as text'
			. ' FROM #__acctexp_plans'
			;
	$database->setQuery( $query );
	$plans = $database->loadObjectList();

 	if ( is_array( $plans ) ) {
 		$all_plans					= array_merge( $available_plans, $plans );
 	} else {
 		$all_plans					= $available_plans;
 	}
	$total_all_plans			= min( max( ( count( $all_plans ) + 1 ), 4 ), 20 );

	// get usages
	if ( !empty( $restrictions_values['usage_plans'] ) ) {
		$query = 'SELECT `id` AS value, `name` as text'
				. ' FROM #__acctexp_plans'
				. ' WHERE `id` IN (' . implode( ',', $restrictions_values['usage_plans'] ) . ')'
				;
		$database->setQuery( $query );

	 	$sel_usage_plans = $database->loadObjectList();
	} else {
		$sel_usage_plans = 0;
	}

	$lists['usage_plans']		= mosHTML::selectList($all_plans, 'usage_plans[]', 'size="' . $total_all_plans . '" multiple="multiple"',
									'value', 'text', $sel_usage_plans);


	// get available micro integrations
	$available_mi = array();

	$query = 'SELECT `id` AS value, CONCAT(`name`, " - ", `desc`) AS text'
			. ' FROM #__acctexp_microintegrations'
			. ' WHERE `active` = 1'
			. ' ORDER BY `ordering`'
			;
	$database->setQuery( $query );
	$mi_list = $database->loadObjectList();

	$mis = array();
	if ( !empty( $mi_list ) && !empty( $params_values['micro_integrations'] ) ) {
		foreach ( $mi_list as $mi_item ) {
			if ( in_array( $mi_item->value, $params_values['micro_integrations'] ) ) {
				$mis[] = $mi_item->value;
			}
		}
	}

 	if ( !empty( $mis ) ) {
	 	$query = 'SELECT `id` AS value, CONCAT(`name`, " - ", `desc`) AS text'
			 	. ' FROM #__acctexp_microintegrations'
			 	. ( !empty( $mis ) ? ' WHERE `id` IN (' . implode( ',', $mis ) . ')' : '' )
			 	;
	 	$database->setQuery( $query );
		$selected_mi = $database->loadObjectList();
 	} else {
 		$selected_mi = array();
 	}

	$lists['micro_integrations'] = mosHTML::selectList( $mi_list, 'micro_integrations[]', 'size="' . min((count( $mi_list ) + 1), 25) . '" multiple="multiple"', 'value', 'text', $selected_mi );

	$query = 'SELECT `coupon_code` as value, `coupon_code` as text'
			. ' FROM #__acctexp_coupons'
			. ' WHERE `coupon_code` != \'' . $cph->coupon->coupon_code . '\''
			;
	$database->setQuery( $query );
	$coupons = $database->loadObjectList();

	$query = 'SELECT `coupon_code` as value, `coupon_code` as text'
			. ' FROM #__acctexp_coupons_static'
			. ' WHERE `coupon_code` != \'' . $cph->coupon->coupon_code . '\''
			;
	$database->setQuery( $query );
	$coupons = array_merge( $database->loadObjectList(), $coupons );

	$cpl = array( 'bad_combinations', 'good_combinations', 'bad_combinations_cart', 'good_combinations_cart' );

	foreach ( $cpl as $cpn ) {
		$cur = array();

		if ( !empty( $restrictions_values[$cpn] ) ) {
			$query = 'SELECT `coupon_code` as value, `coupon_code` as text'
					. ' FROM #__acctexp_coupons'
					. ' WHERE `coupon_code` IN (\'' . implode( '\',\'', $restrictions_values[$cpn] ) . '\')'
					;
			$database->setQuery( $query );
			$cur = $database->loadObjectList();

			$query = 'SELECT `coupon_code` as value, `coupon_code` as text'
					. ' FROM #__acctexp_coupons_static'
					. ' WHERE `coupon_code` IN (\'' . implode( '\',\'', $restrictions_values[$cpn] ) . '\')'
					;
			$database->setQuery( $query );
			$nc = $database->loadObjectList();

			if ( !empty( $nc ) ) {
				$cur = array_merge( $nc, $cur );
			}
		}

		$lists[$cpn] = mosHTML::selectList($coupons, $cpn.'[]', 'size="' . min((count( $coupons ) + 1), 25) . '" multiple="multiple"', 'value', 'text', $cur);
	}

	$lists = array_merge( $lists, $restrictionHelper->getLists( $params_values, $restrictions_values ) );

	$settings = new aecSettings( 'coupon', 'general' );

	$settingsparams = array_merge( $params_values, $discount_values, $restrictions_values );

	$settings->fullSettingsArray( $params, $settingsparams, $lists );

	// Call HTML Class
	$aecHTML = new aecHTML( $settings->settings, $settings->lists );

	HTML_AcctExp::editCoupon( $option, $aecHTML, $cph->coupon, $type );
}

function saveCoupon( $option, $type, $apply=0 )
{
	$database = &JFactory::getDBO();

	$new = 0;
	$type = $_POST['type'];

	if ( $_POST['coupon_code'] != '' ) {

		$cph = new couponHandler();

		if ( !empty( $_POST['id'] ) ) {
			$cph->coupon = new Coupon( $database, $type );
			$cph->coupon->load( $_POST['id'] );
			$cph->type = $type;
			if ( empty( $cph->coupon->id ) ) {
				$cph->coupon = new Coupon( $database, !$type );
				$cph->coupon->load( $_POST['id'] );
				$cph->type = !$type;
			}
			if ( $cph->coupon->id ) {
				$cph->status = 1;
			}
		} else {
			$cph->load( $_POST['coupon_code'] );
		}

		if ( !$cph->status ) {
			$cph->coupon = new coupon( $database, $type );
			$cph->coupon->createNew( $_POST['coupon_code'] );
			$cph->status = true;
			$new = 1;
		}

		if ( $cph->status ) {
			if ( !$new ) {
				if ( $cph->type != $_POST['type'] ) {
					$cph->switchType();
				}
			}

			unset( $_POST['type'] );
			unset( $_POST['id'] );
			$post = AECToolbox::cleanPOST( $_POST, false );

			$cph->coupon->savePOSTsettings( $post );

			$cph->coupon->storeload();
		} else {
			$short	= 'coupon store failure';
			$event	= 'When trying to store coupon';
			$tags	= 'coupon,loading,error';
			$params = array();

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 128, $params );
		}

		$cph->coupon->reorder();

		if ( $cph->coupon->id ) {
			$id = $cph->coupon->id;
		} else {
			$id = $cph->coupon->getMax();
		}

		if ( $apply ) {
			aecRedirect( 'index2.php?option=' . $option . '&task=editCoupon' . ( $type ? 'Static' : '' ) . '&id=' . $id, _AEC_MSG_SUCESSFULLY_SAVED );
		} else {
			aecRedirect( 'index2.php?option=' . $option . '&task=showCoupons' . ( $type ? 'Static' : '' ), _AEC_MSG_SUCESSFULLY_SAVED );
		}
	} else {
		aecRedirect( 'index2.php?option=' . $option . '&task=showCoupons' . ( $type ? 'Static' : '' ), _AEC_MSG_NO_COUPON_CODE );
	}

}

function removeCoupon( $id, $option, $returnTask, $type )
{
	$database = &JFactory::getDBO();

	$ids = implode( ',', $id );

	// Delete Coupons from table
	$query = 'DELETE FROM #__acctexp_coupons'
			. ( $type ? '_static' : '' )
			. ' WHERE `id` IN (' . $ids . ')'
			;
	$database->setQuery( $query	);

	if ( !$database->query() ) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$msg = _AEC_MSG_ITEMS_DELETED;

	aecRedirect( 'index2.php?option=' . $option . '&task=showCoupons' . ( $type ? 'Static' : '' ), $msg );
}

function cancelCoupon( $option, $type )
{
	aecRedirect( 'index2.php?option=' . $option . '&task=showCoupons' . ($type ? 'Static' : '' ), _AEC_CMN_EDIT_CANCELLED );
}

function changeCoupon( $cid=null, $state=0, $option, $type )
{
	$database = &JFactory::getDBO();

	if ( count( $cid ) < 1 ) {
		$action = $state == 1 ? _AEC_CMN_TOPUBLISH : _AEC_CMN_TOUNPUBLISH;
		echo "<script> alert('" . sprintf( html_entity_decode( _AEC_ALERT_SELECT_FIRST_TO ) ), $action . "'); window.history.go(-1);</script>\n";
		exit;
	}

	$total	= count( $cid );
	$cids	= implode( ',', $cid );

	$query = 'UPDATE #__acctexp_coupons' . ( $type ? '_static' : '' )
			. ' SET `active` = \'' . $state . '\''
			. ' WHERE `id` IN (' . $cids . ')'
			;
	$database->setQuery( $query	);
	$database->query();

	if ( $state ) {
		$msg = $total . ' ' . _AEC_MSG_ITEMS_SUCC_PUBLISHED;
	} else {
		$msg = $total . ' ' . _AEC_MSG_ITEMS_SUCC_UNPUBLISHED;
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=showCoupons' . ( $type ? 'Static' : '' ), $msg );
}

function editCSS( $option ) {
	$file = JPATH_SITE . '/media/' . $option . '/css/site.css';

	if ( $fp = fopen( $file, 'r' ) ) {
		$content = fread( $fp, filesize( $file ) );
		$content = htmlspecialchars( $content );
		General_css::editCSSSource( $content, $option );
	} else {
		aecRedirect( 'index2.php?option='. $option .'&task=editCSS', sprintf( _AEC_MSG_OP_FAILED, $file ) );
	}
}

function saveCSS( $option )
{
	$filecontent = aecGetParam( 'filecontent' );

	if ( !$filecontent ) {
		aecRedirect( 'index2.php?option='. $option .'&task=editCSS', _AEC_MSG_OP_FAILED_EMPTY );
	}

	$file			= JPATH_SITE .'/media/' . $option . '/css/site.css';
	$enable_write	= aecGetParam( 'enable_write', 0 );
	$oldperms		= fileperms( $file );

	if ( $enable_write ) {
		@chmod( $file, $oldperms | 0222 );
	}

	clearstatcache();
	if ( is_writable( $file ) == false ) {
		aecRedirect( 'index2.php?option='. $option .'&task=editCSS', _AEC_MSG_OP_FAILED_NOT_WRITEABLE );
	}

	if ( $fp = fopen ($file, 'wb') ) {
		fputs( $fp, stripslashes( $filecontent ) );
		fclose( $fp );
		if ( $enable_write ) {
			@chmod( $file, $oldperms );
		} elseif ( aecGetParam( 'disable_write', 0 ) ) {
			@chmod( $file, $oldperms & 0777555 );
		}
		aecRedirect( 'index2.php?option='. $option .'&task=editCSS', _AEC_CMN_FILE_SAVED );
	} elseif ( $enable_write ) {
		@chmod($file, $oldperms);
		aecRedirect( 'index2.php?option='. $option .'&task=editCSS', _AEC_MSG_OP_FAILED_NO_WRITE );
	}

}

function cancelCSS ( $option )
{
	aecRedirect( 'index2.php?option='. $option );
}

function invoices( $option )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}_invoices", 'search', '' );

	if ( $search ) {
		$unformatted = $database->getEscaped( trim( strtolower( $search ) ) );

		$where = 'LOWER(`invoice_number`) LIKE \'%' . $unformatted . '%\''
				. ' OR LOWER(`secondary_ident`) LIKE \'%' . $unformatted . '%\''
				. ' OR `id` LIKE \'%' . $unformatted . '%\''
				. ' OR LOWER(`invoice_number_format`) LIKE \'%' . $unformatted . '%\''
				;
	}

	// get the total number of records
	$query = 'SELECT count(*)'
			. ' FROM #__acctexp_invoices'
			;
	$database->setQuery( $query );
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

	// Lets grab the data and fill it in.
	$query = 'SELECT *'
			. ' FROM #__acctexp_invoices'
			. ( !empty( $where ) ? ( ' WHERE ' . $where . ' ' ) : '' )
			. ' ORDER BY `created_date` DESC'
			. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit;
			;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}

	$cclist = array();
	foreach ( $rows as $id => $row ) {
		$in_formatted = Invoice::formatInvoiceNumber( $row );

		if ( $in_formatted != $row->invoice_number ) {
			$rows[$id]->invoice_number = $row->invoice_number . "\n" . '(' . $in_formatted . ')';
		}

		if ( !empty( $row->coupons ) ) {
			$coupons = unserialize( base64_decode( $row->coupons ) );
		} else {
			$coupons = null;
		}

		if ( !empty( $coupons ) ) {
			$rows[$id]->coupons = "";

			$couponslist = array();
			foreach ( $coupons as $coupon_code ) {
				if ( !isset( $cclist[$coupon_code] ) ) {
					$cclist[$coupon_code] = couponHandler::idFromCode( $coupon_code );
				}

				if ( !empty( $cclist[$coupon_code]['id'] ) ) {
					$couponslist[] = '<a href="index2.php?option=com_acctexp&amp;task=' . ( $cclist[$coupon_code]['type'] ? 'editcouponstatic' : 'editcoupon' ) . '&amp;id=' . $cclist[$coupon_code]['id'] . '">' . $coupon_code . '</a>';
				}
			}

			$rows[$id]->coupons = implode( ", ", $couponslist );
		} else {
			$rows[$id]->coupons = null;
		}

		$query = 'SELECT username'
				. ' FROM #__users'
				. ' WHERE `id` = \'' . $row->userid . '\''
				;
		$database->setQuery( $query );
		$username = $database->loadResult();

		$rows[$id]->username = '<a href="index2.php?option=com_acctexp&amp;task=edit&userid=' . $row->userid . '">';

		if ( !empty( $username ) ) {
			$rows[$id]->username .= $username . '</a>';
		} else {
			$rows[$id]->username .= $row->userid;
		}

		$rows[$id]->username .= '</a>';
	}

	HTML_AcctExp::viewinvoices( $option, $rows, $search, $pageNav );
}

function clearInvoice( $option, $invoice_number, $applyplan, $task )
{
	$database = &JFactory::getDBO();

	$invoiceid = AECfetchfromDB::InvoiceIDfromNumber( $invoice_number, 0, true );

	if ( $invoiceid ) {
		$database = &JFactory::getDBO();

		$objInvoice = new Invoice( $database );
		$objInvoice->load( $invoiceid );

		if ( $applyplan ) {
			$objInvoice->pay();
		} else {
			$objInvoice->setTransactionDate();
		}

		if ( strcmp( $task, 'edit' ) == 0) {
			$userid = '&userid=' . $objInvoice->userid;
		} else {
			$userid = '';
		}
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=' . $task . $userid, _AEC_MSG_INVOICE_CLEARED );
}

function cancelInvoice( $option, $invoice_number, $task )
{
	$database = &JFactory::getDBO();

	$invoiceid = AECfetchfromDB::InvoiceIDfromNumber( $invoice_number, 0, true );

	if ( $invoiceid ) {
		$objInvoice = new Invoice( $database );
		$objInvoice->load( $invoiceid );
		$uid = $objInvoice->userid;

		$objInvoice->delete();

		if ( strcmp( $task, 'edit' ) == 0 ) {
			$userid = '&userid=' . $uid;
		} else {
			$userid = '';
		}
	}

	aecRedirect( 'index2.php?option=' . $option . '&task=' . $task . $userid, _REMOVED );
}

function history( $option )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}_log_history", 'search', '' );

	$where = array();
	if ( $search ) {
		$where[] = 'LOWER(`user_name`) LIKE \'%' . $database->getEscaped( trim( strtolower( $search ) ) ) . '%\'';
	}

	// get the total number of records
	$query = 'SELECT count(*)'
			. '  FROM #__acctexp_log_history'
			;
	$database->setQuery( $query );
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

	// Lets grab the data and fill it in.
	$query = 'SELECT *'
			. ' FROM #__acctexp_log_history'
			. ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' )
			. ' GROUP BY `transaction_date`'
			. ' ORDER BY `transaction_date` DESC'
			. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit
			;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}

	HTML_AcctExp::viewhistory( $option, $rows, $search, $pageNav );
}

function eventlog( $option )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mainframe->getCfg( 'list_limit' ) ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}_invoices", 'search', '' );

	$where = array();
	if ( $search ) {
		$where[] = 'LOWER(`event`) LIKE \'%' . $database->getEscaped( trim( strtolower( $search ) ) ) . '%\'';
	}

	$tags = ( !empty( $_REQUEST['tags'] ) ? $_REQUEST['tags'] : null );

	if ( is_array( $tags ) ) {
		foreach ( $tags as $tag ) {
			$where[] = 'LOWER(`tags`) LIKE \'%' . trim( strtolower( $tag ) ) . '%\'';
		}
	}

	// get the total number of records
	$query = 'SELECT count(*)'
			. ' FROM #__acctexp_eventlog'
			;
	$database->setQuery( $query );
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	if ( aecJoomla15check() ) {
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	} else {
	 	require_once( JPATH_SITE . '/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	}

	// Lets grab the data and fill it in.
	$query = 'SELECT id'
			. ' FROM #__acctexp_eventlog'
			. ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' )
			. ' ORDER BY `id` DESC'
			. ' LIMIT ' . $pageNav->limitstart . ',' . $pageNav->limit
			;
	$database->setQuery( $query );
	$rows = $database->loadResultArray();

	if ( $database->getErrorNum() ) {
		echo $database->stderr();
		return false;
	}

	$events = array();
	foreach ( $rows as $id ) {
		$row = new EventLog( $database );
		$row->load( $id );

		$events[$id]->id		= $row->id;
		$events[$id]->datetime	= $row->datetime;
		$events[$id]->short		= $row->short;
		$events[$id]->tags		= implode( ', ', explode( ',', $row->tags ) );
		$events[$id]->event		= $row->event;
		$events[$id]->level		= $row->level;
		$events[$id]->notify	= $row->notify;

		$params = array();
		if ( !empty( $row->params ) && is_array( $row->params ) ) {
			foreach ( $row->params as $key => $value ) {
				switch ( $key ) {
					case 'userid':
						$content = '<a href="index2.php?option=com_acctexp&amp;task=edit&userid=' . $value . '">' . $value . '</a>';
						break;
					case 'invoice_number':
						$content = '<a href="index2.php?option=com_acctexp&amp;task=quicklookup&search=' . $value . '">' . $value . '</a>';
						break;
					default:
						$content = $value;
						break;
				}
				$params[] = $key . '(' . $content . ')';
			}
		}
		$events[$id]->params = implode( ', ', $params );
	}

	HTML_AcctExp::eventlog( $option, $events, $search, $pageNav );
}

function migrate( $option )
{
	$database = &JFactory::getDBO();

	$query = 'SELECT `userid`'
			. ' FROM #__acctexp_subscr'
			. ' WHERE LOWER( `status` ) = \'active\''
			. ' AND `plan` != \'23\''
			;
	$database->setQuery( $query );
	$rows = $database->loadResultArray();

	foreach ( $rows as $userid ) {

		$metaUser = new metaUser($userid);
		if ( $metaUser->hasSubscription ) {
			if ($metaUser->objSubscription->plan != 23) {
				$metaUser->instantGIDchange(19);
			}
		}
	}
		exit();
/*
		$JTableUser = new JTableUser( $database );
		$JTableUser->load( $userid );


		// Fixing mosLock broken user accounts
		// it sometimes seems to forget setting the usertype
		if ( $JTableUser->usertype == '' ) {
			$JTableUser->usertype = 'Registered';
			$JTableUser->check();
			$JTableUser->store();
		}

		// If subscription control was previously done by blocking,
		// unblock users
		if ( $JTableUser->block == 1 ) {
			$JTableUser->block = 0;
			$JTableUser->check();
			$JTableUser->store();
		}

		// Create dummy active subscription entry
		$subscriptionid	= AECfetchfromDB::SubscriptionIDfromUserID( $userid );
		$expirationid	= AECfetchfromDB::ExpirationIDfromUserID( $userid );

		$subscriptionHandler = new mosSubscription( $database );

		if ( !$subscriptionid ) {
			$subscriptionHandler->load( 0 );

			$subscriptionHandler->plan			= 1;
			$subscriptionHandler->signup_date	= $JTableUser->registerDate;

			$subscriptionHandler->check();
			$subscriptionHandler->store();
		}

		// Set Expiration date one year after registration
		$expirationHandler = new mosAcctExp( $database );

		if ( !$expirationid ) {
			$expirationHandler->load(0);
			$expirationHandler->userid = $userid;

			$timestamp			= strtotime( $JTableUser->registerDate );
			$registrationdate	= date( 'Y-m-d H:i:s', $timestamp );

			$expirationHandler->expiration = $registrationdate;
			$expirationHandler->setexpiration( 'Y', 1, 1 );

			$expirationHandler->check();
			$expirationHandler->store();
		}*/

// Fix JACLplus associations after uninstall/reinstall
$query = 'SELECT id'
. ' FROM #__users'
. ' WHERE gid = \'31\''
;
$database->setQuery( $query );
$rows = $database->loadResultArray();

foreach ( $rows as $userid ){
	$user = new JTableUser($database);
	$user->load(1);
	print_r($user);
}
/*
	$database = &JFactory::getDBO();

	$query = 'SELECT `id`, `introtext`, `fulltext`'
			. ' FROM #__content'
			;
	$database->setQuery( $query );
	$articles = $database->loadObjectList();

	foreach ( $articles as $article ) {
		$article->introtext = str_replace( "/images/stories/", "images/stories/", $article->introtext );
		$article->fulltext = str_replace( "/images/stories/", "images/stories/", $article->fulltext );
		$article->introtext = str_replace( "..images/stories/", "images/stories/", $article->introtext );
		$article->fulltext = str_replace( "..images/stories/", "images/stories/", $article->fulltext );

		$query = 'UPDATE #__content'
				. ' SET `introtext` = \'' . $database->getEscaped( $article->introtext ) . '\','
				. ' `fulltext` = \'' . $database->getEscaped( $article->fulltext ) . '\''
				. ' WHERE `id` = \'' . $article->id . '\''
				;
		$database->setQuery( $query );
		$database->query();
	}
*/
}

function quicklookup( $option )
{
	$database = &JFactory::getDBO();

	$searcc	= trim( aecGetParam( 'search', 0 ) );
	$search = $database->getEscaped( strtolower( $searcc ) );

	$userid = 0;
	$k = 0;

	if ( strpos( $search, 'supercommand:' ) !== false ) {
		$supercommand = new aecSuperCommand();

		if ( $supercommand->parseString( $search ) ) {
			if ( strpos( $search, '!' ) === 0 ) {
				$armed = true;
			} else {
				$armed = false;
			}

			$return = $supercommand->query( $armed );

			if ( $return > 1 ) {
				$multiple = true;
			} else {
				$multiple = false;
			}

			if ( ( $return != false ) && !$armed ) {
				$r['search'] = "!" . $search;

				$r['return'] = '<div style="font-size:110%;border: 2px solid #da5;padding:16px;">This supercommand would affect ' . $return . " user" . ($multiple ? "s":"") . ". Click the search button again to carry out the query.</div>";
			} elseif ( $return != false ) {
				$r['search'] = "";
				$r['return'] = '<div style="font-size:110%;border: 2px solid #da5;padding:16px;">If you\'re so clever, you tell us what <strong>colour</strong> it should be!? (Everything went fine. Really! It affected ' . $return . " user" . ($multiple ? "s":"") . ")</div>";
			} else {
				$r['search'] = "";
				$r['return'] = '<div style="font-size:110%;border: 2px solid #da5;padding:16px;">Something went wrong. No users found.</div>';
			}

			return $r;
		}

		return "I think you ought to know I'm feeling very depressed. (Something was wrong with your query.)";
	}

	// Try username and name
	$queries[$k] = 'FROM #__users'
				. ' WHERE LOWER( `username` ) LIKE \'%' . $search . '%\' OR LOWER( `name` ) LIKE \'%' . $search . '%\''
				;
	$qfields[$k] = 'id';
	$k++;

	// If its not that, how about the user email?
	$queries[$k] = 'FROM #__users'
				. ' WHERE LOWER( `email` ) = \'' . $search . '\''
				;
	$qfields[$k] = 'id';
	$k++;

	// Try to find this as a userid
	$queries[$k] = 'FROM #__users'
				. ' WHERE `id` = \'' . $search . '\''
				;
	$qfields[$k] = 'id';
	$k++;

	// Or maybe its an invoice number?
	$queries[$k] = 'FROM #__acctexp_invoices'
				. ' WHERE LOWER( `invoice_number` ) = \'' . $search . '\''
				. ' OR LOWER( `secondary_ident` ) = \'' . $search . '\''
				;
	$qfields[$k] = 'userid';
	$k++;

	foreach ( $queries as $qid => $base_query ) {
		$query = 'SELECT count(*) ' . $base_query;
		$database->setQuery( $query );
		$existing = $database->loadResult();

		if ( $existing ) {
			$query = 'SELECT `' . $qfields[$qid] . '` ' . $base_query;
			$database->setQuery( $query );

			if ( $existing > 1 ) {
				$users = $database->loadResultArray();

				$return = array();
				foreach ( $users as $user ) {
					$JTableUser = new JTableUser( $database );
					$JTableUser->load( $user );
					$userlink = '<a href="';
					$userlink .= JURI::base() . 'index2.php?option=com_acctexp&amp;task=edit&amp;userid=' . $JTableUser->id;
					$userlink .= '">';
					$userlink .= $JTableUser->name . ' (' . $JTableUser->username . ')';
					$userlink .= '</a>';

					$return[] = $userlink;
				}

				return implode( ', ', $return );
			} else {
				return $database->loadResult();
			}
		}
	}

	if ( strpos( $search, 'jsonserialencode' ) === 0 ) {
		$s = trim( substr( $searcc, 16 ) );
		if ( !empty( $s ) ) {
			$return = base64_encode( serialize( jsoonHandler::decode( $s ) ) );
			return '<div style="text-align:left;">' . $return . '</div>';
		}
	}

	if ( strpos( $search, 'serialdecodejson' ) === 0 ) {
		$s = trim( substr( $searcc, 16 ) );
		if ( !empty( $s ) ) {
			$return = jsoonHandler::encode( unserialize( base64_decode( $s ) ) );
			return '<div style="text-align:left;">' . $return . '</div>';
		}
	}

	if ( strpos( $search, 'serialdecode' ) === 0 ) {
		$s = trim( substr( $searcc, 12 ) );
		if ( !empty( $s ) ) {
			$return = unserialize( base64_decode( $s ) );
			return '<div style="text-align:left;">' . obsafe_print_r( $return, true, true ) . '</div>';
		}
	}

	if ( strpos( $search, 'unserialize' ) === 0 ) {
		$s = trim( substr( $searcc, 11 ) );
		if ( !empty( $s ) ) {
			$return = unserialize( $s );
			return '<div style="text-align:left;">' . obsafe_print_r( $return, true, true ) . '</div>';
		}
	}

	$maybe = array( '?', '??', '???', '????', 'what to do', 'need strategy', 'help', 'help me', 'huh?', 'AAAAH!' );

	if ( in_array( $search, $maybe ) ) {
		include_once( JPATH_SITE . '/components/com_acctexp/lib/eucalib/eucalib.add.php' );

		return '<div class="usernote" style="width:200px; padding-top: 40px; padding-bottom: 40px; float: right;">'
				. ${'edition_0' . ( rand( 1, 4 ) )}['quote_' . str_pad( rand( 1, ( count( ${'edition_0' . ( rand( 1, 4 ) )} ) + 1 ) ), 2, '0' )]
				. '</div>';
	}

	if ( strpos( $search, 'logthis:' ) === 0 ) {
		$eventlog = new eventLog( $database );
		$eventlog->issue( 'debug', 'debug', 'debug entry: '.str_replace( 'logthis:', '', $search ), 128 );
	}

	return false;
}

function obsafe_print_r($var, $return = false, $html = false, $level = 0) {
    $spaces = "";
    $space = $html ? "&nbsp;" : " ";
    $newline = $html ? "<br />\n" : "\n";
    for ($i = 1; $i <= 6; $i++) {
        $spaces .= $space;
    }
    $tabs = $spaces;
    for ($i = 1; $i <= $level; $i++) {
        $tabs .= $spaces;
    }
    if (is_array($var)) {
        $title = "Array";
    } elseif (is_object($var)) {
        $title = get_class($var)." Object";
    }
    $output = $title . $newline . $newline;
    if ( !empty( $var ) ) {
	    foreach($var as $key => $value) {
	        if (is_array($value) || is_object($value)) {
	            $level++;
	            $value = obsafe_print_r($value, true, $html, $level);
	            $level--;
	        }
	        $output .= $tabs . "[" . $key . "] => " . $value . $newline;
	    }
    }
    if ($return) return $output;
      else echo $output;
}

function hackcorefile( $option, $filename, $check_hack, $undohack, $checkonly=false )
{
	$database = &JFactory::getDBO();

	global $mainframe;

	if ( !defined( '_AEC_LANG_INCLUDED_MI' ) ) {
		$langPathMI = JPATH_SITE . '/components/com_acctexp/micro_integration/lang/';
		if ( file_exists( $langPathMI . $mainframe->getCfg( 'lang' ) . '.php' ) ) {
			include_once( $langPathMI . $mainframe->getCfg( 'lang' ) . '.php' );
		} else {
			include_once( $langPathMI . 'english.php' );
		}

	}

	$cmsname = strtolower( GeneralInfoRequester::getCMSName() );

	$v15 = aecJoomla15check();

	$aec_hack_start				= "// AEC HACK %s START" . "\n";
	$aec_hack_end				= "// AEC HACK %s END" . "\n";

	if ( $v15 ) {
		$aec_condition_start		= 'if (file_exists( JPATH_ROOT.DS."components".DS."com_acctexp".DS."acctexp.class.php" )) {' . "\n";
	} else {
		$aec_condition_start		= 'if (file_exists( $mosConfig_absolute_path . "/components/com_acctexp/acctexp.class.php")) {' . "\n";
	}

	$aec_condition_end			= '}' . "\n";

	if ( $v15 ) {
		$aec_include_class			= 'include_once(JPATH_SITE . "/components/com_acctexp/acctexp.class.php");' . "\n";
	} else {
		$aec_include_class			= 'include_once($mosConfig_absolute_path . "/components/com_acctexp/acctexp.class.php");' . "\n";
	}

	$aec_verification_check		= "AECToolBox::VerifyUsername( %s );" . "\n";
	$aec_userchange_clause		= '$mih = new microIntegrationHandler();' . "\n" . '$mih->userchange($row, $_POST, \'%s\');' . "\n";
	$aec_userchange_clauseCB12	= '$mih = new microIntegrationHandler();' . "\n" . '$mih->userchange($userComplete, $_POST, \'%s\');' . "\n";
	$aec_userchange_clause15	= '$mih = new microIntegrationHandler();' . "\n" . '$mih->userchange($userid, $post, \'%s\');' . "\n";
	$aec_userregchange_clause15	= '$mih = new microIntegrationHandler();' . "\n" . '$mih->userchange($user, $post, \'%s\');' . "\n";

	if ( $v15 ) {
		$aec_global_call			= "\n";
	} else {
		$aec_global_call			= 'global $mosConfig_live_site, $mosConfig_absolute_path;' . "\n";
	}

	$aec_redirect_notallowed	= 'aecRedirect( $mosConfig_live_site . "index.php?option=com_acctexp&task=NotAllowed" );' . "\n";
	$aec_redirect_notallowed15	= 'global $mainframe;' . "\n" . '$mainframe->redirect( "index.php?option=com_acctexp&task=NotAllowed" );' . "\n";

	if ( $v15 ) {
		$aec_redirect_subscribe		= 'aecRedirect( JURI::root() . \'index.php?option=com_acctexp&task=subscribe\' );' . "\n";
	} else {
		$aec_redirect_subscribe		= 'aecRedirect( $mosConfig_live_site . "index.php?option=com_acctexp&task=subscribe" );' . "\n";
	}

	$aec_normal_hack = $aec_hack_start
					. $aec_global_call
					. $aec_condition_start
					. $aec_redirect_notallowed
					. $aec_condition_end
					. $aec_hack_end;

	$aec_jhack1 = $aec_hack_start
					. 'function mosNotAuth($override=false) {' . "\n"
					. $aec_global_call
					. $aec_condition_start
					. 'if (!$override) {' . "\n"
					. $aec_redirect_notallowed
					. $aec_condition_end
					. $aec_condition_end
					. $aec_hack_end;

	$aec_jhack2 = $aec_hack_start
					. $aec_global_call
					. $aec_condition_start
					. $aec_redirect_notallowed
					. $aec_condition_end
					. $aec_hack_end;

	$aec_jhack3 = $aec_hack_start
					. $aec_global_call
					. $aec_condition_start
					. $aec_include_class
					. sprintf( $aec_verification_check, ( $v15 ? '$credentials[\'username\']' : '$row->username' ) )
					. $aec_condition_end
					. $aec_hack_end;

	$aec_cbmhack =	$aec_hack_start
					. "mosNotAuth(true);" . "\n"
					. $aec_hack_end;

	$aec_uchangehack =	$aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. $aec_include_class
						. $aec_userchange_clause
						. $aec_condition_end
						. $aec_hack_end;

	$aec_uchangehackCB12 = str_replace( '$row', '$userComplete', $aec_uchangehack );
	$aec_uchangehackCB12x = str_replace( '$row', '$this', $aec_uchangehack );

	$aec_uchangehackCB12 =	$aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. $aec_include_class
						. $aec_userchange_clauseCB12
						. $aec_condition_end
						. $aec_hack_end;

	$aec_uchangehack15 =	$aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. $aec_include_class
						. $aec_userregchange_clause15
						. $aec_condition_end
						. $aec_hack_end;

	$aec_uchangereghack15 =	$aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. $aec_include_class
						. $aec_userchange_clause15
						. $aec_condition_end
						. $aec_hack_end;

	$aec_rhackbefore =	$aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. 'if (!isset($_POST[\'planid\'])) {' . "\n"
						. $aec_include_class
						. 'aecRedirect(JURI::root() . "index.php?option=com_acctexp&amp;task=subscribe");' . "\n"
						. $aec_condition_end
						. $aec_condition_end
						. $aec_hack_end;

	$aec_rhackbefore_fix = str_replace("planid", "usage", $aec_rhackbefore);

	$aec_rhackbefore2 =	$aec_hack_start
						. $aec_global_call . 'global $mainframe;' . "\n"
						. $aec_condition_start
						. 'if (!isset($_POST[\'usage\'])) {' . "\n"
						. $aec_include_class
						. 'aecRedirect(JURI::root() . "index.php?option=com_acctexp&amp;task=subscribe");' . "\n"
						. $aec_condition_end
						. $aec_condition_end
						. $aec_hack_end;

	$aec_optionhack =	$aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. '$option = "com_acctexp";' . "\n"
						. $aec_condition_end
						. $aec_hack_end;

	$aec_regvarshack =	'<?php' . "\n"
						. $aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. '?>' . "\n"
						. '<input type="hidden" name="planid" value="<?php echo $_POST[\'planid\'];?>" />' . "\n"
						. '<input type="hidden" name="processor" value="<?php echo $_POST[\'processor\'];?>" />' . "\n"
						. '<?php' . "\n"
						. 'if ( isset( $_POST[\'recurring\'] ) ) {'
						. '?>' . "\n"
						. '<input type="hidden" name="recurring" value="<?php echo $_POST[\'recurring\'];?>" />' . "\n"
						. '<?php' . "\n"
						. '}' . "\n"
						. $aec_condition_end
						. $aec_hack_end
						. '?>' . "\n";

	$aec_regvarshack_fix = str_replace( 'planid', 'usage', $aec_regvarshack);

	$aec_regvarshack_fixcb = $aec_hack_start
						. $aec_global_call
						. $aec_condition_start
						. 'if ( isset( $_POST[\'usage\'] ) ) {' . "\n"
						. '$regFormTag .= \'<input type="hidden" name="usage" value="\' . $_POST[\'usage\'] . \'" />\';' . "\n"
						. '}' . "\n"
						. 'if ( isset( $_POST[\'processor\'] ) ) {' . "\n"
						. '$regFormTag .= \'<input type="hidden" name="processor" value="\' . $_POST[\'processor\'] . \'" />\';' . "\n"
						. '}' . "\n"
						. 'if ( isset( $_POST[\'recurring\'] ) ) {' . "\n"
						. '$regFormTag .= \'<input type="hidden" name="recurring" value="\' . $_POST[\'recurring\'] . \'" />\';' . "\n"
						. '}' . "\n"
						. $aec_condition_end
						. $aec_hack_end
						;

	$aec_regredirect = $aec_hack_start
					. $aec_global_call
					. $aec_condition_start
					. $aec_redirect_subscribe
					. $aec_condition_end
					. $aec_hack_end;

	$juser_blind = $aec_hack_start
					. 'case \'blind\':'. "\n"
					. 'break;'. "\n"
					. $aec_hack_end;

	$aec_j15hack1 =  $aec_hack_start
					. 'if ( $error->message == JText::_("ALERTNOTAUTH") ) {'
					. $aec_condition_start
					. $aec_redirect_notallowed15
					. $aec_condition_end
					. $aec_condition_end
					. $aec_hack_end;

	// menu entry
	$n = 'menuentry';
	$hacks[$n]['name'] =	_AEC_HACKS_MENU_ENTRY;
	$hacks[$n]['desc'] =	_AEC_HACKS_MENU_ENTRY_DESC;
	$hacks[$n]['type'] =	'menuentry';

	if ( !$v15 ) {
		// general section - checks core files
		// joomla-/mambo.php
		$n = 'joomlaphp';
		$hacks[$n]['name']				=	$cmsname . '.php';
		$hacks[$n]['desc']				=	_AEC_HACKS_LEGACY;
		$hacks[$n]['type']				=	'file';
		$hacks[$n]['filename']			=	JPATH_SITE . '/includes/' . $cmsname . '.php';
		$hacks[$n]['read']				=	'echo _NOT_AUTH;';
		$hacks[$n]['insert']			=	sprintf($aec_normal_hack, $n, $n) .	$hacks[$n]['read'];
		$hacks[$n]['legacy']			=	1;
		$hacks[$n]['important']			=	1;
	}


	if ( ( strcmp($cmsname, "joomla") === 0 ) && !$v15 ) {
		$n = 'joomlaphp1';
		$hacks[$n]['name']			=	$cmsname . '.php ' . _AEC_HACK_HACK . ' #1';
		$hacks[$n]['desc']			=	_AEC_HACKS_NOTAUTH;
		$hacks[$n]['uncondition']	=	'joomlaphp';
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/includes/' . $cmsname . '.php';
		$hacks[$n]['read']			=	"function mosNotAuth() {";
		$hacks[$n]['insert']		=	sprintf( $aec_jhack1, $n, $n );
//		$hacks[$n]['legacy']		=	1;

		$n = 'joomlaphp2';
		$hacks[$n]['name']			=	$cmsname . '.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_NOTAUTH;
		$hacks[$n]['uncondition']	=	'joomlaphp';
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/includes/' . $cmsname . '.php';
		$hacks[$n]['read']			=	'function notAllowed( $name ) {';
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf( $aec_jhack2, $n, $n );
//		$hacks[$n]['legacy']		=	1;
	} else {
		$n = 'errorphp';
		$hacks[$n]['name']			=	'error.php ' . _AEC_HACK_HACK . ' #1';
		$hacks[$n]['desc']			=	_AEC_HACKS_NOTAUTH;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/libraries/joomla/error/error.php';
		$hacks[$n]['read']			=	'// Initialize variables';
		$hacks[$n]['insert']		=	sprintf( $aec_j15hack1, $n, $n ) . "\n" . $hacks[$n]['read'];
		$hacks[$n]['legacy']		=	1;
	}

	if ( !$v15 ) {
		$n = 'joomlaphp3';
		$hacks[$n]['name']				=	$cmsname . '.php ' . _AEC_HACK_HACK . ' #3';
		$hacks[$n]['desc']				=	_AEC_HACKS_LEGACY;
		$hacks[$n]['uncondition']		=	'joomlaphp';
		$hacks[$n]['type']				=	'file';
		$hacks[$n]['filename']			=	JPATH_SITE . '/includes/' . $cmsname . '.php';
		$hacks[$n]['read']				=	'if ($row->block == 1) {';
		$hacks[$n]['insert']			=	sprintf( $aec_jhack3, $n, $n ) . "\n" . $hacks[$n]['read'];
		$hacks[$n]['legacy']			=	1;
	}

	$n = 'joomlaphp4';
	$hacks[$n]['name']				=	$v15 ? ( 'authentication.php' ) : ( $cmsname . '.php ' . _AEC_HACK_HACK . ' #4' );
	$hacks[$n]['desc']				=	$v15 ? _AEC_HACKS_LEGACY_PLUGIN : _AEC_HACKS_SUB_REQUIRED;
	$hacks[$n]['uncondition']		=	'joomlaphp';
	$hacks[$n]['type']				=	'file';

	switch( $cmsname ) {
		case 'mambo':
			$hacks[$n]['filename']	=	JPATH_SITE . '/includes/authenticator.php';
			$hacks[$n]['read']		=	'// fudge the group stuff';
			break;
		case 'joomla':
		default:
			$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/libraries/joomla/user/authentication.php' ) : ( JPATH_SITE . '/includes/' . $cmsname . '.php' );
			$hacks[$n]['read'] 		=	$v15 ? 'if(empty($response->username)) {' : '// initialize session data';
			break;
	}

	$hacks[$n]['insert']			=	sprintf($aec_jhack3, $n, $n) . "\n" . $hacks[$n]['read'];
	$hacks[$n]['important']			=	$v15 ? 0 : 1;
	$hacks[$n]['legacy']			=	1;

	// registration.php
	if ( !$v15 ) {
		$message = ( strcmp( $cmsname, 'mambo' ) === 0 ) ? 'Direct Access to this location is not allowed.' : 'Restricted access';
		$n = 'registrationphp';
		$hacks[$n]['name']				=	'registration.php';
		$hacks[$n]['desc']				=	_AEC_HACKS_LEGACY;
		$hacks[$n]['type']				=	'file';
		$hacks[$n]['filename']			=	JPATH_SITE . '/components/com_registration/registration.php';
		$hacks[$n]['read']				=	'defined( \'_VALID_MOS\' ) or die( \'' . $message . '\' );';
		$hacks[$n]['insert']			=	$hacks[$n]['read'] . "\n" . sprintf( $aec_normal_hack, $n, $n );
		$hacks[$n]['legacy']			=	1;
		$hacks[$n]['important']			=	1;
	}

	if ( GeneralInfoRequester::detect_component( 'UHP2' ) ) {
		$n = 'uhp2menuentry';
		$hacks[$n]['name']			=	_AEC_HACKS_UHP2;
		$hacks[$n]['desc']			=	_AEC_HACKS_UHP2_DESC;
		$hacks[$n]['uncondition']	=	'uhp2managephp';
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/modules/mod_uhp2_manage.php';
		$hacks[$n]['read']			=	'<?php echo "$settings"; ?></a>';
		$hacks[$n]['insert']		=	sprintf( $hacks[$n]['read'] . "\n</li>\n<?php " . $aec_hack_start . '?>'
		. '<li class="latest<?php echo $moduleclass_sfx; ?>">'
		. '<a href="index.php?option=com_acctexp&task=subscriptionDetails" class="latest<?php echo $moduleclass_sfx; ?>">'
		. _AEC_SPEC_MENU_ENTRY . '</a>'."\n<?php ".$aec_hack_end."?>", $n, $n );
	}

	if ( GeneralInfoRequester::detect_component( 'CB1.2' ) ) {
		$n = 'comprofilerphp2';
		$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
		$hacks[$n]['read']			=	'function registerForm( $option, $emailpass, $regErrorMSG = null ) {';
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_optionhack, $n, $n);
		$hacks[$n]['legacy']		=	1;

		$n = 'comprofilerphp6';
		$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #6';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB6;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
		$hacks[$n]['read']			=	'HTML_comprofiler::registerForm( $option, $emailpass, $userComplete, $regErrorMSG );';
		$hacks[$n]['insert']		=	sprintf($aec_rhackbefore_fix, $n, $n) . "\n" . $hacks[$n]['read'];
		$hacks[$n]['legacy']		=	1;

		$n = 'comprofilerhtml2';
		$hacks[$n]['name']			=	'comprofiler.html.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB_HTML2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php';
		$hacks[$n]['read']			=	'echo HTML_comprofiler::_cbTemplateRender( $user, \'RegisterForm\'';
		$hacks[$n]['insert']		=	sprintf($aec_regvarshack_fixcb, $n, $n) . "\n" . $hacks[$n]['read'];

		if ( $v15 ) {
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['legacy']		=	1;
		}

	} elseif ( GeneralInfoRequester::detect_component( 'CB' ) ) {
		$n = 'comprofilerphp2';
		$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
		$hacks[$n]['read']			=	'if ($regErrorMSG===null) {';
		$hacks[$n]['insert']		=	sprintf($aec_optionhack, $n, $n) . "\n" . $hacks[$n]['read'];

		if ( !$v15 ) {
			$n = 'comprofilerphp3';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #3';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['condition']		=	'comprofilerphp2';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
			$hacks[$n]['read']			=	'HTML_comprofiler::registerForm';
			$hacks[$n]['insert']		=	sprintf($aec_rhackbefore, $n, $n) . "\n" . $hacks[$n]['read'];
			$hacks[$n]['legacy']		=	1;
		}

		$n = 'comprofilerphp6';
		$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #6';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB6;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['condition']		=	'comprofilerphp2';
		$hacks[$n]['uncondition']	=	'comprofilerphp3';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
		$hacks[$n]['read']			=	'HTML_comprofiler::registerForm';
		$hacks[$n]['insert']		=	sprintf($aec_rhackbefore_fix, $n, $n) . "\n" . $hacks[$n]['read'];

		if ( !$v15 ) {
			$n = 'comprofilerhtml';
			$hacks[$n]['name']			=	'comprofiler.html.php ' . _AEC_HACK_HACK . ' #1';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['condition']		=	'comprofilerphp3';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php';
			$hacks[$n]['read']			=	'<input type="hidden" name="task" value="saveregisters" />';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regvarshack, $n, $n);
			$hacks[$n]['legacy']		=	1;
		}

		$n = 'comprofilerhtml2';
		$hacks[$n]['name']			=	'comprofiler.html.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB_HTML2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['uncondition']	=	'comprofilerhtml';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php';
		$hacks[$n]['read']			=	'<input type="hidden" name="task" value="saveregisters" />';
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regvarshack_fix, $n, $n);

	} elseif ( GeneralInfoRequester::detect_component( 'CBE' ) ) {
		$n = 'comprofilerphp2';
		$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
		$hacks[$n]['read']			=	'$rowFieldValues=array();';
		$hacks[$n]['insert']		=	sprintf($aec_optionhack, $n, $n) . "\n" . $hacks[$n]['read'];

		if ( !$v15 ) {
			$n = 'comprofilerphp3';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #3';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['condition']		=	'comprofilerphp2';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
			$hacks[$n]['read']			=	'HTML_comprofiler::registerForm';
			$hacks[$n]['insert']		=	sprintf($aec_rhackbefore, $n, $n) . "\n" . $hacks[$n]['read'];
			$hacks[$n]['legacy']		=	1;
		}

		$n = 'comprofilerphp6';
		$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #6';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB6;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['condition']		=	'comprofilerphp2';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
		$hacks[$n]['read']			=	'HTML_comprofiler::registerForm';
		$hacks[$n]['insert']		=	sprintf($aec_rhackbefore2, $n, $n) . "\n" . $hacks[$n]['read'];

		if ( !$v15 ) {
			$n = 'comprofilerhtml';
			$hacks[$n]['name']			=	'comprofiler.html.php ' . _AEC_HACK_HACK . ' #1';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['condition']		=	'comprofilerphp6';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php';
			$hacks[$n]['read']			=	'<input type="hidden" name="task" value="saveRegistration" />';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regvarshack, $n, $n);
			$hacks[$n]['legacy']		=	1;
		}

		$n = 'comprofilerhtml2';
		$hacks[$n]['name']			=	'comprofiler.html.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_CB_HTML2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['uncondition']	=	'comprofilerhtml';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php';
		$hacks[$n]['read']			=	'<input type="hidden" name="task" value="saveRegistration" />';
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regvarshack_fix, $n, $n);
	} elseif ( GeneralInfoRequester::detect_component( 'JUSER' ) ) {
		$n = 'juserhtml1';
		$hacks[$n]['name']			=	'juser.html.php ' . _AEC_HACK_HACK . ' #1';
		$hacks[$n]['desc']			=	_AEC_HACKS_JUSER_HTML1;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_juser/juser.html.php';
		$hacks[$n]['read']			=	'<input type="hidden" name="option" value="com_juser" />';
		$hacks[$n]['insert']		=	sprintf($aec_regvarshack_fix, $n, $n) . "\n" . '<input type="hidden" name="option" value="com_acctexp" />';

		$n = 'juserphp1';
		$hacks[$n]['name']			=	'juser.php ' . _AEC_HACK_HACK . ' #1';
		$hacks[$n]['desc']			=	_AEC_HACKS_JUSER_PHP1;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_juser/juser.php';
		$hacks[$n]['read']			=	'HTML_JUser::userEdit( $row, $option, $params, $ext_row, \'saveUserRegistration\' );';
		$hacks[$n]['insert']		=	sprintf($aec_rhackbefore_fix, $n, $n) . "\n" . $hacks[$n]['read'];

		$n = 'juserphp2';
		$hacks[$n]['name']			=	'juser.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_JUSER_PHP2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_juser/juser.php';
		$hacks[$n]['read']			=	'default:';
		$hacks[$n]['insert']		=	sprintf($juser_blind, $n, $n) . "\n" . $hacks[$n]['read'];
	} else {
		if ( !$v15 ) {
			$n = 'registrationphp2';
			$hacks[$n]['name']			=	'registration.php ' . _AEC_HACK_HACK . ' #2';
			$hacks[$n]['desc']			=	_AEC_HACKS_REG2;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/components/com_user/controller.php' ) : ( JPATH_SITE . '/components/com_registration/registration.php' );
			$hacks[$n]['read']			=	$v15 ? ( 'JRequest::setVar(\'view\', \'register\');' ) : ( '$mainframe->SetPageTitle(_REGISTER_TITLE);' );
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf( $aec_optionhack, $n, $n );
			$hacks[$n]['legacy']		=	1;

			$n = 'registrationphp3';
			$hacks[$n]['name']			=	'registration.php ' . _AEC_HACK_HACK . ' #3';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY_MAMBOT;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['condition']		=	'registrationphp3';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_registration/registration.php';
			$hacks[$n]['read']			=	'HTML_registration::registerForm';
			$hacks[$n]['insert']		=	sprintf($aec_rhackbefore, $n, $n) . "\n" . $hacks[$n]['read'];
			$hacks[$n]['legacy']		=	1;

			$n = 'registrationhtml';
			$hacks[$n]['name']			=	'registration.html.php ' . _AEC_HACK_HACK . ' #1';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY_MAMBOT;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['condition']		=	'registrationhtml';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_registration/registration.html.php';
			$hacks[$n]['read']			=	'<input type="hidden" name="task" value="saveRegistration" />';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regvarshack, $n, $n);
			$hacks[$n]['legacy']		=	1;
		}

		$n = 'registrationhtml2';
		$hacks[$n]['name']			=	'registration.html.php ' . _AEC_HACK_HACK . ' #2';
		$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['uncondition']	=	'registrationhtml';
		$hacks[$n]['condition']		=	'registrationphp2';
		$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/components/com_user/views/register/tmpl/default.php' ) : ( JPATH_SITE . '/components/com_registration/registration.html.php' );
		$hacks[$n]['read']			=	$v15 ? ( '<input type="hidden" name="task" value="register_save" />' ) : ( '<input type="hidden" name="task" value="saveRegistration" />' );
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regvarshack_fix, $n, $n);
		$hacks[$n]['important']		=	1;
		$hacks[$n]['legacy']		=	1;

		if ( !$v15 ) {
			$n = 'registrationphp5';
			$hacks[$n]['name']			=	'registration.php ' . _AEC_HACK_HACK . ' #5';
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_registration/registration.php';
			$hacks[$n]['read']			=	'// no direct access';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regredirect, $n, $n);
			$hacks[$n]['legacy']		=	1;
		}

		$n = 'registrationphp6';
		$hacks[$n]['name']			=	$v15 ? 'user.php' : ( 'registration.php ' . _AEC_HACK_HACK . ' #6' );
		$hacks[$n]['desc']			=	_AEC_HACKS_REG5;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['uncondition']	=	'registrationphp5';
		$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/components/com_user/controller.php' ) : ( JPATH_SITE . '/components/com_registration/registration.php' );
		$hacks[$n]['read']			=	$v15 ? ( 'JRequest::setVar(\'view\', \'register\');' ) : ( 'case \'register\':' );
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_regredirect, $n, $n);
		$hacks[$n]['legacy']		=	1;
	}

	if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
		if ( GeneralInfoRequester::detect_component( 'CB1.2' ) ) {
			$n = 'comprofilerphp7';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #7';
			$hacks[$n]['desc']			=	_AEC_HACKS_MI1;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
			$hacks[$n]['read']			=	'$_PLUGINS->trigger( \'onAfterUserRegistrationMailsSent\',';
			$hacks[$n]['insert']		=	sprintf( $aec_uchangehackCB12, $n, 'registration', $n ) . "\n" . $hacks[$n]['read'];
			$hacks[$n]['legacy']		=	1;

			$n = 'comprofilerphp8';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #8';
			$hacks[$n]['desc']			=	_AEC_HACKS_MI1;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . '/administrator/components/com_comprofiler/library/cb/cb.tables.php';
			$hacks[$n]['read']			=	'$_PLUGINS->trigger( \'onAfterUserUpdate\', array( &$this, &$this, true ) );';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf( $aec_uchangehackCB12x, $n, 'user', $n );
			$hacks[$n]['legacy']		=	1;
		} else {
			$n = 'comprofilerphp4';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #4';
			$hacks[$n]['desc']			=	_AEC_HACKS_MI1;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . "/components/com_comprofiler/comprofiler.php";
			$hacks[$n]['read']			=	'$_PLUGINS->trigger( \'onAfterUserRegistrationMailsSent\',';
			$hacks[$n]['insert']		=	sprintf($aec_uchangehack, $n, "user", $n) . "\n" . $hacks[$n]['read'];
			$hacks[$n]['legacy']		=	1;

			$n = 'comprofilerphp5';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #5';
			$hacks[$n]['desc']			=	_AEC_HACKS_MI2;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . "/components/com_comprofiler/comprofiler.php";
			$hacks[$n]['read']			=	'$_PLUGINS->trigger( \'onAfterUserUpdate\', array($row, $rowExtras, true));';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_uchangehack, $n, "registration",$n);
			$hacks[$n]['legacy']		=	1;

			$n = 'comprofilerphp7';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #7';
			$hacks[$n]['desc']			=	_AEC_HACKS_MI1;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['uncondition']	=	'comprofilerphp4';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
			$hacks[$n]['read']			=	'$_PLUGINS->trigger( \'onAfterUserRegistrationMailsSent\',';
			$hacks[$n]['insert']		=	sprintf( $aec_uchangehack, $n, 'registration', $n ) . "\n" . $hacks[$n]['read'];

			$n = 'comprofilerphp8';
			$hacks[$n]['name']			=	'comprofiler.php ' . _AEC_HACK_HACK . ' #8';
			$hacks[$n]['desc']			=	_AEC_HACKS_MI1;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['uncondition']	=	'comprofilerphp5';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
			$hacks[$n]['read']			=	'$_PLUGINS->trigger( \'onAfterUserUpdate\', array($row, $rowExtras, true));';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf( $aec_uchangehack, $n, 'user', $n );
		}
	} else {
		$n = 'userphp';
		$hacks[$n]['name']			=	'user.php';
		$hacks[$n]['desc']			=	$v15 ? _AEC_HACKS_LEGACY : _AEC_HACKS_MI1;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/components/com_user/controller.php' ) : ( JPATH_SITE . '/components/com_user/user.php' );
		$hacks[$n]['read']			=	$v15 ? ( 'if ($model->store($post)) {' ) : ( '// check if username has been changed' );
		$hacks[$n]['insert']		=	sprintf( ( $v15 ? $aec_uchangehack15 : $aec_uchangehack ), $n, "user", $n ) . "\n" . $hacks[$n]['read'];
		$hacks[$n]['legacy']		=	1;

		$n = 'registrationphp1';
		$hacks[$n]['name']			=	'registration.php ' . _AEC_HACK_HACK . ' #1';
		$hacks[$n]['desc']			=	$v15 ? _AEC_HACKS_LEGACY : _AEC_HACKS_MI2;
		$hacks[$n]['type']			=	'file';
		$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/components/com_user/controller.php' ) : ( JPATH_SITE . '/components/com_registration/registration.php' );
		$hacks[$n]['read']			=	$v15 ? 'UserController::_sendMail($user, $password);' : '$row->checkin();';
		$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf( ( $v15 ? $aec_uchangereghack15 : $aec_uchangehack ), $n, "registration", $n );
		$hacks[$n]['legacy']		=	1;
	}

	$n = 'adminuserphp';
	$hacks[$n]['name']			=	'admin.user.php';
	$hacks[$n]['desc']			=	$v15 ? _AEC_HACKS_LEGACY : _AEC_HACKS_MI3;
	$hacks[$n]['type']			=	'file';
	$hacks[$n]['filename']		=	$v15 ? ( JPATH_SITE . '/administrator/components/com_users/controller.php' ) : ( JPATH_SITE . '/administrator/components/com_users/admin.users.php' );
	$hacks[$n]['read']			=	$v15 ? 'if (!$user->save())' : '$row->checkin();';
	$hacks[$n]['insert']		=	sprintf( ( $v15 ? $aec_uchangehack15 : $aec_uchangehack ), $n, 'adminuser', $n ) . "\n" . $hacks[$n]['read'];
	if ( $v15 ) {
		$hacks[$n]['legacy']	=	1;
	}

	if ( !$v15 ) {
		if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
			$n = 'comprofilerphp';
			$hacks[$n]['name']			=	"comprofiler.php";
			$hacks[$n]['desc']			=	_AEC_HACKS_LEGACY;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . '/components/com_comprofiler/comprofiler.php';
			$hacks[$n]['read']			=	'case "registers":';
			$hacks[$n]['insert']		=	$hacks[$n]['read'] . "\n" . sprintf($aec_normal_hack, $n, $n);
			$hacks[$n]['legacy']		=	1;
			$hacks[$n]['important']		=	1;
		}
	}

	if ( GeneralInfoRequester::detect_component( 'CBM' ) ) {
		if ( !GeneralInfoRequester::detect_component( 'CB1.2' ) ) {
			$n = 'comprofilermoderator';
			$hacks[$n]['name']			=	'comprofilermoderator.php';
			$hacks[$n]['desc']			=	_AEC_HACKS_CBM;
			$hacks[$n]['type']			=	'file';
			$hacks[$n]['filename']		=	JPATH_SITE . '/modules/mod_comprofilermoderator.php';
			$hacks[$n]['read']			=	'mosNotAuth();';
			$hacks[$n]['insert']		=	sprintf( $aec_cbmhack, $n, $n );
		}
	}

	$mih = new microIntegrationHandler();
	$new_hacks = $mih->getHacks();

	if ( is_array( $new_hacks ) ) {
		$hacks = array_merge( $hacks, $new_hacks );
	}

	// Receive the status for the hacks
	foreach ( $hacks as $name => $hack ) {

		$hacks[$name]['status'] = 0;

		if ( !empty( $hack['filename'] ) ) {
			if ( !file_exists( $hack['filename'] ) ) {
				continue;
			}
		}

		if ( $hack['type'] ) {
			switch( $hack['type'] ) {
				case 'file':
					if ( $hack['filename'] != 'UNKNOWN' ) {
						$originalFileHandle = fopen( $hack['filename'], 'r' );
						$oldData			= fread( $originalFileHandle, filesize($hack['filename'] ) );
						fclose( $originalFileHandle );

						if ( strpos( $oldData, 'AEC HACK START' ) || strpos( $oldData, 'AEC CHANGE START' )) {
							$hacks[$name]['status'] = 'legacy';
						} else {
							if ( ( strpos( $oldData, 'AEC HACK ' . $name . ' START' ) > 0 ) || ( strpos( $oldData, 'AEC CHANGE ' . $name . ' START' ) > 0 )) {
								$hacks[$name]['status'] = 1;
							}
						}

						if ( function_exists( 'posix_getpwuid' ) ) {
							$hacks[$name]['fileinfo'] = posix_getpwuid( fileowner( $hack['filename'] ) );
						}
					}
					break;

				case 'menuentry':
					$count = 0;
					$query = 'SELECT COUNT(*)'
							. ' FROM #__menu'
							. ' WHERE `link` = \'' . JURI::root()  . '/index.php?option=com_acctexp&task=subscriptionDetails\''
							;
					$database->setQuery( $query );
					$count = $database->loadResult();

					if ( $count ) {
						$hacks[$name]['status'] = 1;
					}
					break;
			}
		}
	}

	if ( $checkonly ) {
		return $hacks[$filename]['status'];
	}

	// Commit the hacks
	if ( !$check_hack ) {

		switch( $hacks[$filename]['type'] ) {
			case 'file':
				// mic: fix if CMS is not Joomla or Mambo
				if ( $hack['filename'] != 'UNKNOWN' ) {
					$originalFileHandle = fopen( $hacks[$filename]['filename'], 'r' ) or die ("Cannot open $originalFile<br>");
					// Transfer File into variable $oldData
					$oldData = fread( $originalFileHandle, filesize( $hacks[$filename]['filename'] ) );
					fclose( $originalFileHandle );

					if ( !$undohack ) { // hack
						$newData			= str_replace( $hacks[$filename]['read'], $hacks[$filename]['insert'], $oldData );

							//make a backup
							if ( !backupFile( $hacks[$filename]['filename'], $hacks[$filename]['filename'] . '.aec-backup' ) ) {
							// Echo error message
							}

					} else { // undo hack
						if ( strcmp( $hacks[$filename]['status'], 'legacy' ) === 0 ) {
							$newData = preg_replace( '/\/\/.AEC.(HACK|CHANGE).START\\n.*\/\/.AEC.(HACK|CHANGE).END\\n/s', $hacks[$filename]['read'], $oldData );
						} else {
							if ( strpos( $oldData, $hacks[$filename]['insert'] ) ) {
								if ( isset( $hacks[$filename]['oldread'] ) && isset( $hacks[$filename]['oldinsert'] ) ) {
									$newData = str_replace( $hacks[$filename]['oldinsert'], $hacks[$filename]['oldread'], $oldData );
								}

								$newData = str_replace( $hacks[$filename]['insert'], $hacks[$filename]['read'], $oldData );
							} else {
								$newData = preg_replace( '/\/\/.AEC.(HACK|CHANGE).' . $filename . '.START\\n.*\/\/.AEC.(HACK|CHANGE).' . $filename . '.END\\n/s', $hacks[$filename]['read'], $oldData );
							}
						}
					}

						$oldperms = fileperms( $hacks[$filename]['filename'] );
						chmod( $hacks[$filename]['filename'], $oldperms | 0222 );

						if ( $fp = fopen( $hacks[$filename]['filename'], 'wb' ) ) {
								fwrite( $fp, $newData, strlen( $newData ) );
								fclose( $fp );
								chmod( $hacks[$filename]['filename'], $oldperms );
						}
				}
				break;

			case 'menuentry':
				if ( !$undohack ) { // Create menu entry
					if ( aecJoomla15check() ) {
						$query = 'INSERT INTO #__menu'
								. ' VALUES (\'\', \'usermenu\', \'' . _AEC_SPEC_MENU_ENTRY . '\', \'' . strtolower( _AEC_SPEC_MENU_ENTRY ) . '\', \'' . JURI::root()  . '/index.php?option=com_acctexp&task=subscriptionDetails\', \'url\', 1, 0, 0, 6, 0, 0, \'0000-00-00 00:00:00\', 0, 0, 1, 0, \'menu_image=-1\', 0, 0, 0)'
								;
					} else {
						$query = 'INSERT INTO #__menu'
								. ' VALUES (\'\', \'usermenu\', \'' . _AEC_SPEC_MENU_ENTRY . '\', \'' . JURI::root()  . 'index.php?option=com_acctexp&task=subscriptionDetails\', \'url\', 1, 0, 0, 0, 6, 0, \'0000-00-00 00:00:00\', 0, 0, 1, 0, \'menu_image=-1\')'
								;
					}
				} else { // Remove menu entry
					$query = 'DELETE'
							. ' FROM #__menu'
							. ' WHERE `link` LIKE \'%/index.php?option=com_acctexp&task=subscriptionDetails%\''
							;
				}

				$database->setQuery( $query );
				$res = $database->query();
				break;
		}
	}

	return $hacks;
}

function backupFile( $file, $file_new )
{
		if ( !copy( $file, $file_new ) ) {
				return false;
		}
		return true;
}

function readout( $option )
{
	$database = &JFactory::getDBO();

	$optionlist = array(
							'show_settings' => 0,
							'show_extsettings' => 0,
							'show_processors' => 0,
							'show_plans' => 1,
							'show_mi_relations' => 1,
							'show_mis' => 1,
							'truncation_length' => 42,
							'noformat_newlines' => 0,
							'use_ordering' => 0,
							'column_headers' => 20,
							'export_csv' => 0,
							'store_settings' => 1
						);

	if ( isset( $_POST['display'] ) ) {
		if ( !empty( $_POST['export_csv'] ) ) {
			$method = "csv";
		} else {
			$method = "html";
		}

		$r = array();
		$readout = new aecReadout( $optionlist, $method );

		foreach ( $optionlist as $opt => $odefault ) {
			if ( !isset( $_POST[$opt] ) ) {
				continue;
			}

			switch ( $opt ) {
				case 'show_settings':
					$s = $readout->readSettings();
					break;
				case 'show_processors':
					$s = $readout->readProcessors();
					break;
				case 'show_plans':
					$s = $readout->readPlans();
					break;
				case 'show_mi_relations':
					$s = $readout->readPlanMIrel();
					break;
				case 'show_mis':
					$s = $readout->readMIs();
					break;
				case 'store_settings':
					$user = &JFactory::getUser();

					$settings = array();
					foreach ( $optionlist as $opt => $optdefault ) {
						if ( !empty( $_POST[$opt] ) ) {
							$settings[$opt] = $_POST[$opt];
						} else {
							$settings[$opt] = 0;
						}
					}

					$metaUser = new metaUser( $user->id );
					$metaUser->meta->addCustomParams( array( 'aecadmin_readout' => $settings ) );
					$metaUser->meta->storeload();
					continue 2;
					break;
				default:
					continue 2;
					break;
			}

			if ( isset( $s['def'] ) ) {
				$r[] = $s;
			} elseif ( is_array( $s ) ) {
				foreach ( $s as $i => $x ) {
					$r[] = $x;
				}
			}
		}

		if ( !empty( $_POST['export_csv'] ) ) {
			HTML_AcctExp::readoutCSV( $option, $r );
		} else {
			HTML_AcctExp::readout( $option, $r );
		}
	} else {
		$user = &JFactory::getUser();

		$metaUser = new metaUser( $user->id );
		if ( isset( $metaUser->meta->custom_params['aecadmin_readout'] ) ) {
			$prefs = $metaUser->meta->custom_params['aecadmin_readout'];
		} else {
			$prefs = array();
		}

		foreach ( $optionlist as $opt => $optdefault ) {
			if ( isset( $prefs[$opt] ) ) {
				$optval = $prefs[$opt];
			} else {
				$optval = $optdefault;
			}

			if ( ( $optdefault == 1 ) || ( $optdefault == 0 ) ) {
				$params[$opt] = array( 'checkbox', $optval );
			} else {
				$params[$opt] = array( 'inputB', $optval );
			}
		}

		$settings = new aecSettings ( 'readout', 'general' );

		$settings->fullSettingsArray( $params, $prefs, array() ) ;

		// Call HTML Class
		$aecHTML = new aecHTML( $settings->settings, $settings->lists );

		HTML_AcctExp::readoutSetup( $option, $aecHTML );
	}
}

function importData()
{
	// File Selected?
	// No -> Show only file selection&upload dialog
	// Yes:
	// Preparse File (show 2 sample lines of data)
	// Preset Dialog
	// Prepare Settings Object
	// Preset selected?
	// YES -> Load Preset
	// No -> Load Defaults
	//
}

function exportData( $option, $cmd=null )
{
	$database = &JFactory::getDBO();

	$cmd_save = ( strcmp( 'save', $cmd ) === 0 );
	$cmd_apply = ( strcmp( 'apply', $cmd ) === 0 );
	$cmd_load = ( strcmp( 'load', $cmd ) === 0 );
	$cmd_export = ( strcmp( 'export', $cmd ) === 0 );
	$use_original = 0;

	$system_values = array();
	$filter_values = array();
	$options_values = array();
	$params_values = array();

	$getpost = array(	'system' => array( 'selected_export', 'delete', 'save', 'save_name' ),
						'filter' => array( 'planid', 'status', 'orderby' ),
						'options' => array( 'rewrite_rule' ),
						'params' => array( 'export_method' )
					);

	$postfields = 0;
	foreach( $getpost as $name => $array ) {
		$field = $name . '_values';
		$$field = new stdClass();
		foreach( $array as $vname ) {
			 $$field->$vname = aecGetParam( $vname, '' );
			 if ( !( $$field->$vname == '' ) ) {
			 	$postfields++;
			 }
		}
	}

	$lists = array();

	if ( !empty( $system_values->selected_export ) || $cmd_save || $cmd_apply ) {
		$row = new aecExport( $database );
		if ( isset( $system_values->selected_export ) ) {
			$row->load( $system_values->selected_export );
		} else {
			$row->load(0);
		}

		if ( !empty( $system_values->delete ) ) {
			// User wants to delete the entry
			$row->delete();
		} elseif ( ( $cmd_save || $cmd_apply ) && ( !empty( $system_values->selected_export ) || !empty( $system_values->save_name ) ) ) {
			// User wants to save an entry
			if ( $system_values->save == 'on' ) {
				// But as a copy of another entry
				$row->load( 0 );
			}
			$row->save( $system_values->save_name, $filter_values, $options_values, $params_values );

			if ( $system_values->save == 'on' ) {
				$system_values->selected_export = $row->getMax();
			}
		} elseif ( ( $cmd_save || $cmd_apply ) && ( empty( $system_values->selected_export ) && !empty( $system_values->save_name ) && ( $system_values->save == 'on' ) ) ) {
			// User wants to save a new entry
			$row->save( $system_values->save_name, $filter_values, $options_values, $params_values );
		}  elseif ( $cmd_load || ( ( $postfields <= 5 ) && $cmd_export )  ) {
			// User wants to load an entry
			$filter_values = $row->filter;
			$options_values = $row->options;
			$params_values = $row->params;
			$pname = $row->name;
			$use_original = 1;
		}
	}

	if ( !isset( $pname ) ) {
		$pname = $system_values->save_name;
	}

	// Always store the last ten calls, but only if something is happening
	if ( $cmd_save || $cmd_apply || $cmd_export ) {
		$autorow = new aecExport( $database );
		$autorow->load(0);
		$autorow->save( 'Autosave', $filter_values, $options_values, $params_values, true );

		if ( ( $autorow->filter == $row->filter ) && ( $autorow->options == $row->options ) && ( $autorow->params == $row->params ) ) {
			$use_original = 1;
		}
	}

	// Create Parameters

	$params[] = array( 'userinfobox', 100 );
	$params['selected_export']	= array( 'list', '' );
	$params['delete']			= array( 'checkbox', 0 );
	$params[] = array( '2div_end', '' );

	$params[] = array( 'userinfobox', 20 );
	$params['params_remap']	= array( 'subarea_change', 'filter' );
	$params['planid']			= array( 'list', '' );
	$params['status']			= array( 'list', '' );
	$params['orderby']			= array( 'list', '' );
	$params[] = array( '2div_end', '' );

	$params[] = array( 'userinfobox', 50 );
	$params['params_remap']	= array( 'subarea_change', 'options' );
	$params['rewrite_rule']	= array( 'inputD', '' );
	$rewriteswitches			= array( 'cms', 'user', 'subscription', 'plan' );
	$params = AECToolbox::rewriteEngineInfo( $rewriteswitches, $params );
	$params[] = array( '2div_end', '' );

	$params[] = array( 'userinfobox', 20 );
	$params['params_remap']	= array( 'subarea_change', 'params' );
	$params['save']			= array( 'checkbox', 0 );
	$params['save_name']		= array( 'inputB', $pname );
	$params['export_method']	= array( 'list', '' );
	$params[] = array( '2div_end', '' );

	// Create a list of export options
	// First, only the non-autosaved entries
	$query = 'SELECT `id`, `name`, `created_date`, `lastused_date`'
			. ' FROM #__acctexp_export'
			. ' WHERE `system` = \''
			;
	$database->setQuery( $query . '0\'' );
	$user_exports = $database->loadObjectList();

	// Then the autosaved entries
	$database->setQuery( $query . '1\'' );
	$system_exports = $database->loadObjectList();

	$entries = count( $user_exports ) + count( $system_exports );

	if ( $entries > 0 ) {
		$listitems = array();

		$user = false;
		for ( $i=0; $i < $entries; $i++ ) {
			if ( ( $i >= count( $user_exports ) ) && ( $user === false ) ) {
				$user = $i;
			}

			if ( $user === false ) {
				$listitems[] = mosHTML::makeOption( $user_exports[$i]->id, substr( $user_exports[$i]->name, 0, 64 ) . ' - ' . 'last used: ' . $user_exports[$i]->lastused_date . ', created: ' . $user_exports[$i]->created_date );
			} else {
				$ix = $i - $user;
				$listitems[] = mosHTML::makeOption( $system_exports[$ix]->id, substr( $system_exports[$ix]->name, 0, 64 ) . ' - ' . 'last used: ' . $system_exports[$ix]->lastused_date . ', created: ' . $system_exports[$ix]->created_date );
			}
		}
	} else {
		$listitems[] = mosHTML::makeOption( 0, " --- No saved Preset available --- " );
	}

	$lists['selected_export'] = mosHTML::selectList($listitems, 'selected_export', 'size="' . max( 10, min( 20, $entries ) ) . '"', 'value', 'text', arrayValueDefault($system_values, 'selected_export', '') );

	// Get list of plans for filter
	$query = 'SELECT `id`, `name`'
			. ' FROM #__acctexp_plans'
			. ' ORDER BY `ordering`'
			;
	$database->setQuery( $query );
	$db_plans = $database->loadObjectList();

	$selected_plans = array();
	$plans = array();
	foreach ( $db_plans as $dbplan ) {
		$plans[] = mosHTML::makeOption( $dbplan->id, $dbplan->name );

		if ( !empty( $filter_values->planid ) ) {
			if ( in_array( $dbplan->id, $filter_values->planid ) ) {
				$selected_plans[] = mosHTML::makeOption( $dbplan->id, $dbplan->name );
			}
		}
	}

	$lists['planid']	= mosHTML::selectList( $plans, 'planid[]', 'class="inputbox" size="' . min( 20, count( $plans ) ) . '" multiple="multiple"', 'value', 'text', $selected_plans );

	// Statusfilter
	$group_selection = array();
	$group_selection[] = mosHTML::makeOption( 'excluded',	_AEC_SEL_EXCLUDED );
	$group_selection[] = mosHTML::makeOption( 'pending',	_AEC_SEL_PENDING );
	$group_selection[] = mosHTML::makeOption( 'trial',		_AEC_SEL_TRIAL );
	$group_selection[] = mosHTML::makeOption( 'active',		_AEC_SEL_ACTIVE );
	$group_selection[] = mosHTML::makeOption( 'expired',	_AEC_SEL_EXPIRED );
	$group_selection[] = mosHTML::makeOption( 'closed',		_AEC_SEL_CLOSED );
	$group_selection[] = mosHTML::makeOption( 'cancelled',	_AEC_SEL_CANCELLED );

	$selected_status = array();
	if ( !empty( $filter_values->status ) ) {
		foreach ( $filter_values->status as $name ) {
			$selected_status[] = mosHTML::makeOption( $name, $name );
		}
	}

	$lists['status'] = mosHTML::selectList($group_selection, 'status[]', 'size="6" multiple="multiple"', 'value', 'text', $selected_status);

	// Ordering
	$sel = array();
	$sel[] = mosHTML::makeOption( 'expiration ASC',		_EXP_ASC );
	$sel[] = mosHTML::makeOption( 'expiration DESC',		_EXP_DESC );
	$sel[] = mosHTML::makeOption( 'name ASC',				_NAME_ASC );
	$sel[] = mosHTML::makeOption( 'name DESC',				_NAME_DESC );
	$sel[] = mosHTML::makeOption( 'username ASC',			_LOGIN_ASC );
	$sel[] = mosHTML::makeOption( 'username DESC',		_LOGIN_DESC );
	$sel[] = mosHTML::makeOption( 'signup_date ASC',		_SIGNUP_ASC );
	$sel[] = mosHTML::makeOption( 'signup_date DESC',	_SIGNUP_DESC );
	$sel[] = mosHTML::makeOption( 'lastpay_date ASC',	_LASTPAY_ASC );
	$sel[] = mosHTML::makeOption( 'lastpay_date DESC',	_LASTPAY_DESC );
	$sel[] = mosHTML::makeOption( 'plan_name ASC',		_PLAN_ASC );
	$sel[] = mosHTML::makeOption( 'plan_name DESC',		_PLAN_DESC );
	$sel[] = mosHTML::makeOption( 'status ASC',			_STATUS_ASC );
	$sel[] = mosHTML::makeOption( 'status DESC',			_STATUS_DESC );
	$sel[] = mosHTML::makeOption( 'type ASC',				_TYPE_ASC );
	$sel[] = mosHTML::makeOption( 'type DESC',				_TYPE_DESC );

	$lists['orderby'] = mosHTML::selectList( $sel, 'orderby', 'class="inputbox" size="10"', 'value', 'text', arrayValueDefault($filter_values, 'orderby', '') );

	// Export Method
	$sel = array();
	$sel[] = mosHTML::makeOption( 'csv', 'csv' );

	$lists['export_method'] = mosHTML::selectList( $sel, 'export_method', 'class="inputbox" size="4"', 'value', 'text', 'csv' );

	$settings = new aecSettings ( 'export', 'general' );

	// Repackage the objects as array
	foreach( $getpost as $name => $array ) {
		$field = $name . '_values';
		foreach( $array as $vname ) {
			if ( !empty( $$field->$name ) ) {
				$settingsparams[$name] = $$field->$name;
			} else {
				$settingsparams[$name] = "";
			}
		}
	}

	$settingsparams = array_merge( get_object_vars( $filter_values ), get_object_vars( $options_values ), get_object_vars( $params_values ) );

	$settings->fullSettingsArray( $params, $settingsparams, $lists ) ;

	// Call HTML Class
	$aecHTML = new aecHTML( $settings->settings, $settings->lists );

	if ( $cmd_export && !empty( $params_values->export_method ) ) {
		if ( $use_original ) {
			$row->useExport();
		} else {
			$autorow->useExport();
		}
	}

	if ( $cmd_save ) {
		aecRedirect( 'index2.php?option=' . $option . '&task=showCentral' );
	} else {
		HTML_AcctExp::export( $option, $aecHTML );
	}
}

function arrayValueDefault( $array, $name, $default )
{
	if ( is_object( $array ) ) {
		if ( isset( $array->$name ) ) {
			return $array->$name;
		} else {
			return $default;
		}
	}

	if ( isset( $array[$name] ) ) {
		if ( is_array( $array[$name] ) ) {
			$selected = array();
			foreach ( $array[$name] as $value ) {
				$selected[]->value = $value;
			}

			return $selected;
		} elseif ( strpos( $array[$name], ';' ) !== false ) {
			$list = explode( ';', $array[$name] );

			$selected = array();
			foreach ( $list as $value ) {
				$selected[]->value = $value;
			}

			return $selected;
		} else {
			return $array[$name];
		}
	} else {
		return $default;
	}
}

?>