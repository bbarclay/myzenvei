<?php
/**
 * @version $Id: acctexp.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Main Frontend
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

global $mainframe, $aecConfig;

define( '_AEC_FRONTEND', 1 );

require_once( $mainframe->getPath( 'class',			'com_acctexp' ) );
require_once( $mainframe->getPath( 'front_html',	'com_acctexp' ) );

if ( !defined( '_EUCA_DEBUGMODE' ) ) {
	define( '_EUCA_DEBUGMODE', $aecConfig->cfg['debugmode'] );
}

if ( _EUCA_DEBUGMODE ) {
	global $eucaDebug;

	$eucaDebug = new eucaDebug();
}

$user = &JFactory::getUser();

$task = trim( aecGetParam( 'task' ) );
//aecDebug( $task );
if ( !empty( $task ) ) {
	switch ( strtolower( $task ) ) {
		case 'heartbeat':
		case 'beat':
			// Manual Heartbeat
			$hash = aecGetParam( 'hash', 0, true, array( 'word', 'string' ) );

			aecHeartbeat::frontendping( true, $hash );
			break;

		case 'register':
			$intro = aecGetParam( 'intro', 0, true, array( 'word', 'int' ) );
			$usage = aecGetParam( 'usage', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			$group = aecGetParam( 'group', 0, true, array( 'word', 'int' ) );

			$invoicefact = new InvoiceFactory();
			$invoicefact->create( $option, $intro, $usage, $group );
			break;

		// Catch hybrid CB registration
		case 'saveregisters':
		// Catch hybrid jUser registration
		case 'saveuserregistration':
		// Catch hybrid CMS registration
		case 'saveregistration':
		case 'subscribe':
			subscribe( $option );
			break;

		case 'confirm':
			confirmSubscription($option);
			break;

		case 'addressexception':
			$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			$userid		= aecGetParam( 'userid', 0 );

			if ( !empty( $user->id ) ) {
				$userid = $user->id;
			}

			repeatInvoice( $option, $invoice, $userid );
			break;

		case 'savesubscription':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
			$usage		= aecGetParam( 'usage', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			$group		= aecGetParam( 'group', 0, true, array( 'word', 'int' ) );
			$processor	= aecGetParam( 'processor', '', true, array( 'word', 'string', 'clear_nonalnum' ) );
			$coupon		= aecGetParam( 'coupon_code', '', true, array( 'word', 'string', 'clear_nonalnum' ) );

			$invoicefact = new InvoiceFactory( $userid, $usage, $group, $processor );
			$invoicefact->save( $option, $coupon );
			break;

		case 'addtocart':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
			$usage		= aecGetParam( 'usage', '', true, array( 'word', 'string', 'clear_nonalnum' ) );

			if ( !empty( $user->id ) ) {
				$userid = $user->id;
			}

			if ( !$user->id ) {
				notAllowed( $option );
			} else {
				$invoicefact = new InvoiceFactory( $userid );
				$invoicefact->addtoCart( $option, $usage );
				$invoicefact->cart( $option );
			}
			break;

		case 'cart':
			$user = &JFactory::getUser();

			if ( !$user->id ) {
				notAllowed( $option );
			} else {
				$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );

				if ( !empty( $user->id ) ) {
					$userid = $user->id;
				}

				$invoicefact = new InvoiceFactory( $userid );
				$invoicefact->cart( $option );
			}
			break;

		case 'updatecart':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );

			if ( !empty( $user->id ) ) {
				$userid = $user->id;
			}

			if ( !$user->id ) {
				notAllowed( $option );
			} else {
				$invoicefact = new InvoiceFactory( $userid );
				$invoicefact->updateCart( $option, $_POST );
				$invoicefact->cart( $option );
			}
			break;

		case 'clearcart':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );

			if ( !empty( $user->id ) ) {
				$userid = $user->id;
			}

			if ( !$user->id ) {
				notAllowed( $option );
			} else {
				$invoicefact = new InvoiceFactory( $userid );
				$invoicefact->clearCart( $option );

				$invoicefact = new InvoiceFactory( $userid );
				$invoicefact->cart( $option );
			}
			break;

		case 'confirmcart':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
			$coupon		= aecGetParam( 'coupon_code', '', true, array( 'word', 'string', 'clear_nonalnum' ) );

			if ( !empty( $user->id ) ) {
				$userid = $user->id;
			}

			if ( !$user->id ) {
				notAllowed( $option );
			} else {
				$invoicefact = new InvoiceFactory( $userid );
				$invoicefact->confirmcart( $option, $coupon );
			}
			break;

		case 'checkout':
			$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );

			internalcheckout( $option, $invoice, $userid );
			break;

		case 'backsubscription':
			backSubscription( $option );
			break;

		case 'thanks':
			$renew		= aecGetParam( 'renew', 0, true, array( 'word', 'int' ) );
			$free		= aecGetParam( 'free', 0, true, array( 'word', 'int' ) );

			$usage		= aecGetParam( 'usage', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );

			if ( empty( $usage ) ) {
				$usage = aecGetParam( 'u', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			}

			$invoicefact = new InvoiceFactory();

			if ( !empty( $usage ) ) {
				$database = &JFactory::getDBO();

				$invoicefact->plan = new SubscriptionPlan( $database );
				$invoicefact->plan->load( $usage );
			}

			$invoicefact->thanks( $option, $renew, $free );
			break;

		case 'cancel':
			cancelPayment( $option );
			break;

		case 'errap':
			$usage		= aecGetParam( 'usage', true, array( 'word', 'string', 'clear_nonalnum' ) );
			$userid		= aecGetParam( 'userid', true, array( 'word', 'int' ) );
			$username	= aecGetParam( 'username', true, array( 'string', 'clear_nonalnum' ) );
			$name		= aecGetParam( 'name', true, array( 'string', 'clear_nonalnum' ) );
			$recurring	= aecGetParam( 'recurring', 0, true, array( 'word', 'int' ) );

			errorAP( $option, $usage, $userid, $username, $name, $recurring);
			break;

		case 'subscriptiondetails':
			$sub		= aecGetParam( 'sub', 'overview', true, array( 'word', 'string' ) );

			subscriptionDetails( $option, $sub );
			break;

		case 'renewsubscription':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
			$intro		= aecGetParam( 'intro', 0, true, array( 'word', 'int' ) );
			$usage		= aecGetParam( 'usage', 0, true, array( 'word', 'int' ) );

			$invoicefact = new InvoiceFactory( $userid );
			$invoicefact->create( $option, $intro, $usage );
			break;

		case 'expired':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
			$expiration = aecGetParam( 'expiration', 0, true, array( 'string' ) );

			expired( $option, $userid, $expiration );
			break;

		case 'hold':
			$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );

			hold( $option, $userid );
			break;

		case 'pending':
			$userid		= aecGetParam( 'userid', true, array( 'word', 'int' ) );

			pending( $option, $userid );
			break;

		case 'repeatpayment':
			$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			$userid		= aecGetParam( 'userid', 0 );
			$first		= aecGetParam( 'first', 0 );

			repeatInvoice( $option, $invoice, $userid, $first );
			break;

		case 'cancelpayment':
			$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
			$pending	= aecGetParam( 'pending', 0 );
			$userid		= aecGetParam( 'userid', 0 );

			cancelInvoice( $option, $invoice, $pending, $userid );
			break;

		case 'planaction':
			$action	= aecGetParam( 'action', 0, true, array( 'word', 'string' ) );
			$subscr	= aecGetParam( 'subscr', '', true, array( 'word', 'int' ) );

			planaction( $option, $action, $subscr );
			break;

		case 'invoiceprint':
			$invoice	= aecGetParam( 'invoice', '', true, array( 'word', 'string', 'clear_nonalnum' ) );

			InvoicePrintout( $option, $invoice );
			break;

		case 'invoiceaction':
			$action		= aecGetParam( 'action', 0, true, array( 'word', 'string' ) );
			$invoice	= aecGetParam( 'invoice', '', true, array( 'word', 'string', 'clear_nonalnum' ) );

			invoiceAction( $option, $action, $invoice );
			break;

		case 'invoicemakegift':
			InvoiceMakeGift( $option );
			break;

		case 'invoiceremovegift':
			InvoiceRemoveGift( $option );
			break;

		case 'invoiceremovegiftcart':
			InvoiceRemoveGiftCart( $option );
			break;

		case 'invoiceremovegiftconfirm':
			InvoiceRemoveGiftConfirm( $option );
			break;

		case 'invoiceaddcoupon':
			InvoiceAddCoupon( $option );
			break;

		case 'invoiceremovecoupon':
			InvoiceRemoveCoupon( $option );
			break;

		case 'invoiceaddparams':
			InvoiceAddParams( $option );
			break;

		case 'notallowed':
			notAllowed( $option );
			break;

		// Legacy - to be deprecated after thorough check
		case 'ipn': processNotification($option, "paypal"); break;
		case 'activateft': activateFT( $option ); break;

		default:
			if ( strpos( $task, 'notification' ) > 0 ) {
				$processor = str_replace( 'notification', '', $task );

				processNotification( $option, $processor );
			} else {
				$userid		= aecGetParam( 'userid', true, array( 'word', 'int' ) );
				$expiration = aecGetParam( 'expiration', true, array( 'word', 'int' ) );

				if ( !empty( $userid ) && empty( $user->id ) ) {
					expired( $option, $userid, $expiration );
				} elseif ( !empty( $user->id )) {
					subscriptionDetails( $option );
				} else {
					subscribe( $option );
				}
			}
			break;
	}
}

function hold( $option, $userid )
{
	global $mainframe;

	if ( $userid > 0 ) {
		$metaUser = new metaUser( $userid );

		$mainframe->SetPageTitle( _HOLD_TITLE );

		$frontend = new HTML_frontEnd ();
		$frontend->hold( $option, $metaUser );
	} else {
		aecRedirect( sefRelToAbs( 'index.php' ) );
	}
}

function expired( $option, $userid, $expiration )
{
	$database = &JFactory::getDBO();

	global $mainframe, $aecConfig;

	if ( $userid > 0 ) {
		$metaUser = new metaUser( $userid );

		$expired = strtotime( $metaUser->objSubscription->expiration );

		if ( $metaUser->hasSubscription ) {
			$trial = (strcmp($metaUser->objSubscription->status, 'Trial' ) === 0 );
			if (!$trial) {
				$params = $metaUser->objSubscription->params;
				if ( isset( $params['trialflag'])) {
					$trial = 1;
				}
			}
		} else {
			$trial = false;
		}

		$invoices = AECfetchfromDB::InvoiceCountbyUserID( $userid );

		if ( $invoices ) {
			$invoice = AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $userid );
		} else {
			$invoice = false;
		}

		$expiration	= strftime( $aecConfig->cfg['display_date_frontend'], $expired);

		$mainframe->SetPageTitle( _EXPIRED_TITLE );

		$continue = false;
		if ( $aecConfig->cfg['continue_button'] ) {
			$status = SubscriptionPlanHandler::PlanStatus( $metaUser->focusSubscription->plan );
			if ( !empty( $status ) ) {
				$continue = true;
			}
		}

		$frontend = new HTML_frontEnd ();
		$frontend->expired( $option, $metaUser, $expiration, $invoice, $trial, $continue );
	} else {
		aecRedirect( sefRelToAbs( 'index.php' ) );
	}
}

function pending( $option, $userid )
{
	$database = &JFactory::getDBO();

		global $mainframe;

	$reason = "";

	if ( $userid > 0 ) {
		$objUser = new JTableUser( $database );
		$objUser->load( $userid );

		$invoices = AECfetchfromDB::InvoiceCountbyUserID( $userid );

		if ( $invoices ) {
			$invoice = AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $userid );
			$objInvoice = new Invoice( $database );
			$objInvoice->loadInvoiceNumber( $invoice );
			$params = $objInvoice->params;

			if ( isset( $params['pending_reason'] ) ) {
				if ( defined( '_PENDING_REASON_' . strtoupper( $params['pending_reason'] ) ) ) {
					$reason = constant( '_PENDING_REASON_' . strtoupper( $params['pending_reason'] ) );
				} else {
					$reason = $params['pending_reason'];
				}
			} elseif ( strcmp( $objInvoice->method, 'transfer' ) === 0 ) {
				$reason = 'transfer';
			} else {
				$reason = 0;
			}
		} else {
			$invoice = 'none';
		}

		$mainframe->SetPageTitle( _PENDING_TITLE );

		$frontend = new HTML_frontEnd ();
		$frontend->pending( $option, $objUser, $invoice, $reason );
	} else {
		aecRedirect( sefRelToAbs( 'index.php' ) );
	}
}

function subscribe( $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	global $aecConfig;

	$task		= aecGetParam( 'task', 0, true, array( 'word', 'string' ) );
	$intro		= aecGetParam( 'intro', 0, true, array( 'word', 'int' ) );
	$usage		= aecGetParam( 'usage', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$group		= aecGetParam( 'group', 0, true, array( 'word', 'int' ) );
	$processor	= aecGetParam( 'processor', '', true, array( 'word', 'string', 'clear_nonalnum' ) );
	$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
	$username	= aecGetParam( 'username', '', true, array( 'string' ) );
	$email		= aecGetParam( 'email', '', true, array( 'string' ) );

	$token		= aecGetParam( 'aectoken', 0, true, array( 'string' ) );

	$forget		= aecGetParam( 'forget', '', true, array( 'string' ) );

	if ( $token ) {
		$temptoken = new aecTempToken( $database );
		$temptoken->getComposite();

		if ( !empty( $temptoken->content ) ) {
			$password = null;

			$details = array();

			if ( $forget != 'usage' ) {
				$details[] = 'usage';
				$details[] = 'processor';
				$details[] = 'recurring';
			}

			if ( $forget != 'userdetails' ) {
				$details[] = 'username';
				$details[] = 'email';
				$details[] = 'password';
			}

			foreach ( $details as $d ) {
				if ( !empty( $temptoken->content[$d] ) ) {
					$$d = $temptoken->content[$d];

					$_POST[$d] = $temptoken->content[$d];
				}
			}

			if ( !empty( $username ) ) {
				$query = 'SELECT id'
				. ' FROM #__users'
				. ' WHERE username = \'' . $username . '\''
				;
				$database->setQuery( $query );
				$id = $database->loadResult();

				if ( !empty( $id ) ) {
					$userid = $id;

					$metaUser = new metaUser( $id );
					$metaUser->setTempAuth( $password );
				}
			}
		}
	}

	$isJoomla15 = aecJoomla15check();

	if ( !empty( $username ) && $usage ) {
		$CB = ( GeneralInfoRequester::detect_component( 'anyCB' ) );
		$JS = ( GeneralInfoRequester::detect_component( 'JOMSOCIAL' ) );

		if ( $isJoomla15 && !$CB && !$JS ) {
			// Joomla 1.5 Sanity Check

			// Get required system objects
			$user 		= clone(JFactory::getUser());

			$duplicationcheck = checkDuplicateUsernameEmail( $username, $email );

			// Bind the post array to the user object
			if ( !$user->bind( JRequest::get('post'), 'usertype' ) || ( $duplicationcheck !== true ) ) {
				$binderror = $user->getError();

				if ( !empty( $binderror ) ) {
					JError::raiseError( 500, $user->getError() );
				} else {
					JError::raiseError( 500, $duplicationcheck );
				}

				unset($_POST);
				subscribe();
				return false;
			}
		} elseif ( !$isJoomla15 && !$CB ) {
			// Joomla 1.0 Sanity Check
			$row = new JTableUser( $database );

			if (!$row->bind( $_POST, 'usertype' )) {
				mosErrorAlert( $row->getError() );
			}

			$row->name		= trim( $row->name );
			$row->email		= trim( $row->email );
			$row->username	= trim( $row->username );
			$row->password	= trim( $row->password );

			mosMakeHtmlSafe($row);

			if (!$row->check()) {
				echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
				exit();
			}
		} elseif ( empty( $token ) ) {
			if ( isset( $_POST['username'] ) && isset( $_POST['email'] ) ) {
				$check = checkDuplicateUsernameEmail( $username, $email );
				if ( $check !== true ) {
					return $check;
				}
			}
		}

		$invoicefact = new InvoiceFactory( $userid, $usage, $group, $processor );
		$invoicefact->confirm( $option );
	} else {
		if ( $user->id ) {
			$userid			= $user->id;
			$passthrough	= false;
		} elseif ( !empty( $userid ) && !isset( $_POST['username'] ) ) {
			$passthrough	= false;
		} elseif ( empty( $userid ) ) {
			if ( !empty( $_POST['username'] ) && !empty( $_POST['email'] ) ) {
				$check = checkDuplicateUsernameEmail( $username, $email );
				if ( $check !== true ) {
					return $check;
				}
			}

			$nopass = array( 'option', 'task', 'intro', 'usage', 'group', 'processor', 'recurring', 'Itemid', 'submit_x', 'submit_y', 'userid', 'id', 'gid' );

			$passthrough = array();
			foreach ( $_POST as $k => $v ) {
				if ( in_array( $k, $nopass ) ) {
					unset( $_POST[$k] );
				} else {
					$passthrough[$k] = $v;
				}
			}
		}

		$invoicefact = new InvoiceFactory( $userid, $usage, $group, $processor, null, $passthrough );
		$invoicefact->create( $option, $intro, $usage, $group, $processor, 0 );
	}
}

function checkDuplicateUsernameEmail( $username, $email )
{
	global $mainframe;

	$database = &JFactory::getDBO();

	$query = 'SELECT `id`'
			. ' FROM #__users'
			. ' WHERE `username` = \'' . $username . '\''
			;
	$database->setQuery( $query );
	if ( $database->loadResult() ) {
		if ( !aecJoomla15check() ) {
			mosErrorAlert( _REGWARN_INUSE );
			return false;
		} else {
			mosErrorAlert( JText::_( 'WARNREG_INUSE' ) );
			return JText::_( 'WARNREG_INUSE' );
		}
	}

	if ( !empty( $email ) ) {
		if ( $mainframe->getCfg( 'uniquemail' ) || aecJoomla15check() ) { // J1.5 forces unique email
			// check for existing email
			$query = 'SELECT `id`'
					. ' FROM #__users'
					. ' WHERE `email` = \'' . $email . '\''
					;
			$database->setQuery( $query );
			if ( $database->loadResult() ) {
				if ( !aecJoomla15check() ) {
					mosErrorAlert( _REGWARN_EMAIL_INUSE );
					return _REGWARN_EMAIL_INUSE;
				} else {
					mosErrorAlert( JText::_( 'WARNREG_EMAIL_INUSE' ) );
					return JText::_( 'WARNREG_EMAIL_INUSE' );
				}
			}
		}
	}

	return true;
}

function confirmSubscription( $option )
{
	$user = &JFactory::getUser();

	$database = &JFactory::getDBO();

	global $mainframe, $aecConfig;

	$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
	$usage		= aecGetParam( 'usage', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$group		= aecGetParam( 'group', 0, true, array( 'word', 'int' ) );
	$processor	= aecGetParam( 'processor', '', true, array( 'word', 'string', 'clear_nonalnum' ) );
	$username	= aecGetParam( 'username', 0, true, array( 'word', 'int' ) );

	$passthrough = array();
	if ( isset( $_POST['aec_passthrough'] ) ) {
		if ( is_array( $_POST['aec_passthrough'] ) ) {
			$passthrough = $_POST['aec_passthrough'];
		} else {
			$passthrough = unserialize( base64_decode( $_POST['aec_passthrough'] ) );
		}
	}

	if ( $aecConfig->cfg['plans_first'] && !empty( $usage ) && empty( $username ) && empty( $passthrough['username'] ) && !$userid && !$user->id ) {
		if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
			// This is a CB registration, borrowing their code to register the user
			include_once( JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php' );
			include_once( JPATH_SITE . '/components/com_comprofiler/comprofiler.php' );

			registerForm( $option, $mainframe->getCfg( 'emailpass' ), null );
		} else {
			// This is a joomla registration
			joomlaregisterForm( $option, $mainframe->getCfg( 'useractivation' ) );
		}
	} else {
		if ( !empty( $usage ) ) {
			$invoicefact = new InvoiceFactory( $userid, $usage, $group, $processor );
			$invoicefact->confirm( $option );
		} else {
			subscribe( $option );
		}
	}
}

function subscriptionDetails( $option, $sub='overview' )
{
	$database = &JFactory::getDBO();
	$user = &JFactory::getUser();

	if ( !$user->id ) {
		return notAllowed( $option );
	}

	global $mainframe, $aecConfig;

	$ssl		= !empty( $aecConfig->cfg['ssl_profile'] );

	// Redirect to SSL if the config requires it
	if ( !empty( $aecConfig->cfg['ssl_profile'] ) && empty( $_SERVER['HTTPS'] ) && !$aecConfig->cfg['override_reqssl'] ) {
		aecRedirect( AECToolbox::deadsureURL( "index.php?option=" . $option . "&task=subscriptiondetails", true, false ) );
		exit();
	}

	// Load metaUser and invoice data
	$metaUser	= new metaUser( $user->id );
	$invoiceno	= AECfetchfromDB::InvoiceCountbyUserID( $metaUser->userid );
	$properties	= array();

	$properties['showcheckout'] = false;

	// Do not let the user in without a subscription or at least an invoice
	if ( !$metaUser->hasSubscription && empty( $invoiceno ) ) {
		subscribe( $option );
		return;
	} elseif ( !$metaUser->hasSubscription && !empty( $invoiceno ) ) {
		$properties['showcheckout'] = AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $metaUser->userid );
	}

	// Prepare Main Tabs
	$tabs = array();
	foreach ( array( 'overview', 'invoices' ) as $fname ) {
		$tabs[$fname] = constant( strtoupper( '_aec_subdetails_tab_' . $fname ) );
	}

	// If we have a cart, we want to link to it
	$cart = aecCartHelper::getCartbyUserid( $metaUser->userid );

	$properties['hascart']	= $cart->id;
	$properties['alert']	= $metaUser->getAlertLevel();

	// Load a couple of basic variables
	$subscriptions	= array();
	$pplist			= array();
	$excludedprocs	= array( 'free', 'error' );
	$custom			= null;
	$mi_info		= null;

	// Start off the processor list with objSubscription
	if ( !empty( $metaUser->objSubscription->type ) ) {
		$pplist = array( $metaUser->objSubscription->type );
	}

	// The upgrade button might only show on some occasions
	$properties['upgrade_button'] = true;
	if ( $aecConfig->cfg['renew_button_never'] ) {
		$properties['upgrade_button'] = false;
	} elseif ( $aecConfig->cfg['renew_button_nolifetimerecurring'] ) {
		if ( !empty( $metaUser->objSubscription->lifetime ) ) {
			if ( $metaUser->isRecurring() || $metaUser->objSubscription->lifetime ) {
				$properties['upgrade_button'] = false;
			}
		}
	}

	// Build the User Subscription List
	$subList = $metaUser->getSecondarySubscriptions();
	if ( !empty( $metaUser->objSubscription->plan ) ) {
		$subList = array_merge( array( $metaUser->objSubscription ), $subList );
	}

	// Prepare Payment Processors attached to active subscriptions
	if ( !empty( $subList ) ) {
		foreach( $subList as $usid => $subscription ) {
			if ( empty( $subscription->id ) || empty( $subscription->plan ) ) {
				unset( $subList[$usid] );
				continue;
			}

			$subList[$usid]->objPlan = new SubscriptionPlan( $database );
			$subList[$usid]->objPlan->load( $subscription->plan );

			if ( !empty( $subscription->type ) ) {
				if ( !in_array( $subscription->type, $pplist ) ) {
					$pplist[] = $subscription->type;
				}
			}
		}
	}

	$invoiceList = AECfetchfromDB::InvoiceIdList( $metaUser->userid, $invoiceno );

	$invoices = array();
	foreach ( $invoiceList as $invoiceid ) {
		$invoices[$invoiceid] = array();

		$invoice = new Invoice( $database );
		$invoice->load( $invoiceid );

		$rowstyle		= '';
		$actionsarray	= array();

		if ( !in_array( $invoice->method, $excludedprocs ) ) {
			$actionsarray[] = array( 	'task'	=> 'invoicePrint',
										'add'	=> 'invoice=' . $invoice->invoice_number,
										'text'	=> _HISTORY_ACTION_PRINT,
										'insert' => ' target="_blank" ' );
		}

		if ( ( $invoice->transaction_date == '0000-00-00 00:00:00' ) || ( $invoice->subscr_id  ) ) {
			if ( $invoice->transaction_date == '0000-00-00 00:00:00' ) {
				$actionsarray[] = array( 	'task'	=> 'repeatPayment',
											'add'	=> 'invoice=' . $invoice->invoice_number,
											'text'	=> _HISTORY_ACTION_REPEAT );

				if ( is_null( $invoice->fixed ) || !$invoice->fixed ) {
					$actionsarray[] = array('task'	=> 'cancelPayment',
											'add'	=> 'invoice=' . $invoice->invoice_number,
											'text'	=> _HISTORY_ACTION_CANCEL );
				}
			}

			$rowstyle = ' style="background-color:#fee;"';
		}

		if ( !in_array( $invoice->method, $pplist ) ) {
			$pplist[] = $invoice->method;
		}

		$invoice->formatInvoiceNumber();

		$invoices[$invoiceid]['object']				= $invoice;
		$invoices[$invoiceid]['invoice_number']		= $invoice->invoice_number;
		$invoices[$invoiceid]['amount']				= $invoice->amount;
		$invoices[$invoiceid]['currency_code']		= $invoice->currency;
		$invoices[$invoiceid]['actions']			= $actionsarray;
		$invoices[$invoiceid]['rowstyle']			= $rowstyle;
		$invoices[$invoiceid]['transactiondate']	= $invoice->getTransactionStatus();
	}

	$pps = PaymentProcessorHandler::getObjectList( $pplist, true );

	// Get the tabs information from the plan
	if ( !empty( $subList ) ) {
		foreach( $subList as $usid => $subscription ) {
			$mis = $subscription->objPlan->micro_integrations;

			if ( !count( $mis ) ) {
				continue;
			}

			foreach ( $mis as $mi_id ) {
				if ( $mi_id ) {
					$mi = new MicroIntegration( $database );
					$mi->load( $mi_id );

					if ( !$mi->callIntegration() ) {
						continue;
					}

					$info = $mi->profile_info( $metaUser );
					if ( $info !== false ) {
						$mi_info .= $info;
					}
				}

				$addtabs = $mi->registerProfileTabs();

				if ( empty( $addtabs ) ) {
					continue;
				}

				foreach ( $addtabs as $atk => $atv ) {
					$action = $mi->class_name . '_' . $atk;
					if ( isset( $subfields[$action] ) ) {
						continue;
					}

					$subfields[$action] = $atv;

					if ( $action == $sub ) {
						$custom = $mi->customProfileTab( $atk, $metaUser );
					}
				}
			}
		}
	}

	// Add Details tab for MI Stuff
	if ( !empty( $mi_info ) ) {
		$tabs['details'] = _AEC_SUBDETAILS_TAB_DETAILS;
	}

	$invoiceactionlink = 'index.php?option=' . $option . '&amp;task=%s&amp;%s';

	foreach ( $invoiceList as $invoiceid ) {
		$invoice = $invoices[$invoiceid]['object'];

		$actionsarray = $invoices[$invoiceid]['actions'];

		$pp = $pps[$invoice->method];

		if ( !empty( $pp->info['longname'] ) ) {
			$invoices[$invoiceid]['processor'] = $pp->info['longname'];
		} else {
			$invoices[$invoiceid]['processor'] = $invoice->method;
		}

		if ( !empty( $metaUser->objSubscription->status ) ) {
			$activeortrial = ( ( strcmp( $metaUser->objSubscription->status, 'Active' ) === 0 ) || ( strcmp( $metaUser->objSubscription->status, 'Trial' ) === 0 ) );
		} else {
			$activeortrial = false;
		}

		if ( !empty( $pp->info['actions'] ) && $activeortrial ) {
			$actions = $pp->getActions( $invoice, $subscription );

			foreach ( $actions as $action ) {
				$actionsarray[] = array('task'		=> 'planaction',
										'add'		=> 'action=' . $action['action'] . '&amp;subscr=' . $subscription->id,
										'insert'	=> $action['insert'],
										'text'		=> $action['action'] );
			}
		}

		if ( !empty( $actionsarray ) ) {
			foreach ( $actionsarray as $aid => $a ) {
				if ( is_array( $a ) ) {
					$link = AECToolbox::deadsureURL( sprintf( $invoiceactionlink, $a['task'], $a['add'] ), $ssl );

					$insert = '';
					if ( !empty( $a['insert'] ) ) {
						$insert = $a['insert'];
					}

					$actionsarray[$aid] = '<a href="' . $link . '"' . $insert . '>' . $a['text'] . '</a>';
				}
			}

			$actions = implode( ' | ', $actionsarray );
		} else {
			$actions = ' - - - ';
		}

		$invoices[$invoiceid]['actions']			= $actions;
	}

	// Get Custom Processor Tabs
	foreach ( $pps as $pp ) {
		$pptabs = $pp->getProfileTabs();

		foreach ( $pptabs as $tname => $tcontent ) {
			if ( $sub == $tname ) {
				$custom = $pp->customProfileTab( $sub, $metaUser );
			}

			$tabs[$tname] = $tcontent;
		}
	}

	$mainframe->SetPageTitle( _MYSUBSCRIPTION_TITLE . ' - ' . $tabs[$sub] );

	$html = new HTML_frontEnd();
	$html->subscriptionDetails( $option, $tabs, $sub, $invoices, $metaUser, $mi_info, $subscriptions, $custom, $properties );
}

function internalCheckout( $option, $invoice_number, $userid )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	// Always rewrite to session userid
	if ( !empty( $user->id ) ) {
		$userid = $user->id;
	}

	$invoiceid = AECfetchfromDB::InvoiceIDfromNumber( $invoice_number, $userid );

	// Only allow a user to access existing and own invoices
	if ( $invoiceid ) {
		$invoicefact = new InvoiceFactory( $userid );
		$invoicefact->touchInvoice( $option, $invoice_number );
		$invoicefact->internalcheckout( $option );
	} else {
		aecNotAuth();
		return;
	}
}

function repeatInvoice( $option, $invoice_number, $userid, $first=0 )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	// Always rewrite to session userid
	if ( !empty( $user->id ) ) {
		$userid = $user->id;
	} elseif ( AECToolbox::quickVerifyUserID( $userid ) === true ) {
		// This user is not expired, so he could log in...
		aecNotAuth();
		return;
	}

	$cartid = $invoiceid = null;

	if ( strpos( $invoice_number, 'c.' ) !== false ) {
		$cartid = true;
	} else {
		$invoiceid = AECfetchfromDB::InvoiceIDfromNumber( $invoice_number, $userid );
	}

	// Only allow a user to access existing and own invoices
	if ( $invoiceid ) {
		if ( !isset( $_POST['invoice'] ) ) {
			$_POST['option']	= $option;
			$_POST['task']		= 'repeatPayment';
			$_POST['invoice']	= $invoice_number;
			$_POST['userid']	= $userid;
		}

		$invoicefact = new InvoiceFactory( $userid );
		$invoicefact->touchInvoice( $option, $invoice_number );
		$invoicefact->checkout( $option, !$first );
	} elseif ( $cartid ) {
		$invoicefact = new InvoiceFactory( $userid );

		$invoicefact->usage = $invoice_number;

		$invoicefact->loadMetaUser();

		$invoicefact->puffer( $option );
		$invoicefact->checkout( $option, !$first );

		return;
	} else {
		return aecNotAuth();
	}
}

function cancelInvoice( $option, $invoice_number, $pending=0, $userid )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	if ( empty( $user->id ) ) {
		if ( $userid ) {
			if ( AECToolbox::quickVerifyUserID( $userid ) === true ) {
				// This user is not expired, so he could log in...
				return aecNotAuth();
			}
		} else {
			return aecNotAuth();
		}
	} else {
		$userid = $user->id;
	}

	$invoiceid = AECfetchfromDB::InvoiceIDfromNumber( $invoice_number, $userid );

	// Only allow a user to access existing and own invoices
	if ( $invoiceid ) {
		$objInvoice = new Invoice( $database );
		$objInvoice->load( $invoiceid );

		if ( !$objInvoice->fixed ) {
			$objInvoice->active = 0;
			$objInvoice->params = array( 'deactivated' => 'cancel' );
			$objInvoice->check();
			$objInvoice->store();

			$usage = null;
			if ( !empty( $objInvoice->usage ) ) {
				$usage = $objInvoice->usage;
			}

			if ( !empty( $usage ) ) {
				$u = explode( '.', $usage );

				switch ( strtolower( $u[0] ) ) {
					case 'c':
					case 'cart':
						// Delete Carts referenced in this Invoice as well
						$query = 'DELETE FROM #__acctexp_cart WHERE `id` = \'' . $u[1] . '\'';
						$database->setQuery( $query );
						$database->query();
						break;
				}
			}
		}
	} else {
		aecNotAuth();
		return;
	}

	if ( $pending ) {
		pending( $option, $userid );
	} else {
		subscriptionDetails( $option, 'invoices' );
	}

}

function planaction( $option, $action, $subscr )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	// Always rewrite to session userid
	if ( !empty( $user->id ) ) {
		$userid = $user->id;

		$invoicefact = new InvoiceFactory( $userid );
		$invoicefact->planprocessoraction( $action, $subscr );
	} else {
		aecNotAuth();
		return;
	}
}

function invoiceAction( $option, $action, $invoice )
{
	$user = &JFactory::getUser();

	if ( empty( $user->id ) ) {
		return aecNotAuth();
	} else {
		$invoicefact = new InvoiceFactory( $user->id );
		$invoicefact->invoiceprocessoraction( $action, $invoice );
	}
}

function InvoicePrintout( $option, $invoice )
{
	$user = &JFactory::getUser();

	if ( empty( $user->id ) ) {
		return aecNotAuth();
	} else {
		$invoicefact = new InvoiceFactory( $user->id );
		$invoicefact->invoiceprint( $option, $invoice );
	}
}

function InvoiceAddParams( $option )
{
	$database = &JFactory::getDBO();

	$invoice = aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );
	$objinvoice->savePostParams( $_POST );
	$objinvoice->check();
	$objinvoice->store();

	repeatInvoice( $option, $invoice, $objinvoice->userid );
}

function InvoiceMakeGift( $option )
{
	$database = &JFactory::getDBO();

	$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$user_ident	= aecGetParam( 'user_ident', 0, true, array( 'string', 'clear_nonemail' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );

	if ( $objinvoice->addTargetUser( strtolower( $user_ident ) ) ) {
		$objinvoice->storeload();
	}

	repeatInvoice( $option, $invoice, $objinvoice->userid );
}

function InvoiceRemoveGift( $option )
{
	$database = &JFactory::getDBO();

	$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );

	if ( $objinvoice->removeTargetUser() ) {
		$objinvoice->storeload();
	}

	repeatInvoice( $option, $invoice, $objinvoice->userid );
}

function InvoiceRemoveGiftConfirm( $option )
{
	$database = &JFactory::getDBO();

	$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );
	$usage		= aecGetParam( 'usage', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$group		= aecGetParam( 'group', 0, true, array( 'word', 'int' ) );
	$processor	= aecGetParam( 'processor', '', true, array( 'word', 'string', 'clear_nonalnum' ) );
	$username	= aecGetParam( 'username', 0, true, array( 'word', 'int' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );

	if ( $objinvoice->removeTargetUser() ) {
		$objinvoice->storeload();
	}

	$invoicefact = new InvoiceFactory( $userid, $usage, $group, $processor, $invoice );
	$invoicefact->confirm( $option, $_POST );
}

function InvoiceRemoveGiftCart( $option )
{
	$database = &JFactory::getDBO();

	$invoice	= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$userid		= aecGetParam( 'userid', 0, true, array( 'word', 'int' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );

	if ( $objinvoice->removeTargetUser() ) {
		$objinvoice->storeload();
	}

	$invoicefact = new InvoiceFactory( $userid );
	$invoicefact->cart( $option );
}

function InvoiceAddCoupon( $option )
{
	$database = &JFactory::getDBO();

	$invoice		= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$coupon_code	= aecGetParam( 'coupon_code', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );
	$objinvoice->addCoupon( $coupon_code );
	$objinvoice->computeAmount();

	repeatInvoice( $option, $invoice, $objinvoice->userid );
}

function InvoiceRemoveCoupon( $option )
{
	$database = &JFactory::getDBO();

	$invoice		= aecGetParam( 'invoice', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );
	$coupon_code	= aecGetParam( 'coupon_code', 0, true, array( 'word', 'string', 'clear_nonalnum' ) );

	$objinvoice = new Invoice( $database );
	$objinvoice->loadInvoiceNumber( $invoice );
	$objinvoice->removeCoupon( $coupon_code );
	$objinvoice->computeAmount();

	repeatInvoice( $option, $invoice, $objinvoice->userid );
}

function notAllowed( $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	global $mainframe, $aecConfig;

	if ( ( $aecConfig->cfg['customnotallowed'] != '' ) && !is_null( $aecConfig->cfg['customnotallowed'] ) ) {
		aecRedirect( $aecConfig->cfg['customnotallowed'] );
	}

	$gwnames = PaymentProcessorHandler::getInstalledNameList( true );

	if ( count( $gwnames ) && $gwnames[0] ) {
		$processors = array();
		foreach ( $gwnames as $procname ) {
			$processor = trim( $procname );
			$processors[$processor] = new PaymentProcessor();
			if ( $processors[$processor]->loadName( $processor ) ) {
				$processors[$processor]->init();
				$processors[$processor]->getInfo();
				$processors[$processor]->getSettings();
			} else {
				$short	= 'processor loading failure';
				$event	= 'When composing processor info list, tried to load processor: ' . $procname;
				$tags	= 'processor,loading,error';
				$params = array();

				$eventlog = new eventLog( $database );
				$eventlog->issue( $short, $tags, $event, 128, $params );

				unset( $processors[$processor] );
			}
		}
	} else {
		$processors = false;
	}

	$CB = ( GeneralInfoRequester::detect_component( 'anyCB' ) );

	if ( $user->id ) {
		$registerlink = AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=renewsubscription' );
		$loggedin = 1;
	} else {
		$loggedin = 0;
		if ( $CB ) {
			$registerlink = AECToolbox::deadsureURL( 'index.php?option=com_comprofiler&amp;task=registers' );
		} else {
			if ( aecJoomla15check() ) {
				$registerlink = AECToolbox::deadsureURL( 'index.php?option=com_user&amp;view=register' );
			} else {
				$registerlink = AECToolbox::deadsureURL( 'index.php?option=com_registration&amp;task=register' );
			}
		}
	}

	$mainframe->SetPageTitle( _NOT_ALLOWED_HEADLINE );

	$frontend = new HTML_frontEnd ();
	$frontend->notAllowed( $option, $processors, $registerlink, $loggedin );
}

function backSubscription( $option )
{
	$database = &JFactory::getDBO();

	$user = &JFactory::getUser();

	$acl = &JFactory::getACL();

	global $mainframe;

	// Rebuild array
	foreach ( $_POST as $key => $value ) {
		$var[$key]	= $value;
	}

	// Get other values to show in confirmForm
	$userid	= $var['userid'];
	$usage	= $var['usage'];

 	// get the payment plan
	$objplan = new SubscriptionPlan( $database );
	$objplan->load( $usage );

 	// get the user object
	$objuser = new JTableUser( $database );
	$objuser->load( $userid );

	$unset = array( 'id', 'gid', 'task', 'option', 'name', 'username', 'email', 'password', '', 'password2' );
	foreach ( $unset as $key ) {
		if ( isset($var[$key] ) ) {
			unset( $var[$key] );
		}
	}

	$mainframe->SetPageTitle( _REGISTER_TITLE );
	Payment_HTML::subscribeForm( $option, $var, $objplan, null, $objuser );
}

function processNotification( $option, $processor )
{
	$database = &JFactory::getDBO();

	// Legacy naming support
	switch ( $processor ) {
		case 'vklix':
			$processor = 'viaklix';
			break;
		case 'auth':
			$processor = 'authorize';
			break;
		case '2co':
			$processor = '2checkout';
			break;
		case 'eps':
			$processor = 'epsnetpay';
			break;
	}

	//aecDebug( "ResponseFunction:processNotification" );aecDebug( "GET:".json_encode( $_GET ) );aecDebug( "POST:".json_encode( $_POST ) );

	$response = array();
	$response['fullresponse'] = $_POST;

	// parse processor notification
	$pp = new PaymentProcessor();
	if ( $pp->loadName( $processor ) ) {
		$pp->init();
		$response = array_merge( $response, $pp->parseNotification( $_POST ) );
	} else {
		$database = &JFactory::getDBO();
		$short	= 'processor loading failure';
		$event	= 'When receiving payment notification, tried to load processor: ' . $processor;
		$tags	= 'processor,loading,error';
		$params = array();

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, $tags, $event, 128, $params );

		return;
	}

	// Get Invoice record
	if ( !empty( $response['invoice'] ) ) {
		$id = AECfetchfromDB::InvoiceIDfromNumber( $response['invoice'] );
	} else {
		$id = false;

		$response['invoice'] = 'empty';
	}

	if ( !$id ) {
		$short	= _AEC_MSG_PROC_INVOICE_FAILED_SH;

		if ( isset( $response['null'] ) ) {
				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_NULL;
				$tags	.= 'invoice,processor,payment,null';
		} else {
			$event	= sprintf( _AEC_MSG_PROC_INVOICE_FAILED_EV, $processor, $response['invoice'] )
					. ' ' . $database->getErrorMsg();
			$tags	= 'invoice,processor,payment,error';
		}

		$params = array();

		$eventlog = new eventLog( $database );

		if ( isset( $response['null'] ) ) {
			$eventlog->issue( $short, $tags, $event, 8, $params );
		} else {
			$eventlog->issue( $short, $tags, $event, 128, $params );

			$error = 'Invoice Number not found. Invoice number provided: "' . $response['invoice'] . '"';

			$pp->notificationError( $response, $error );
		}

		return;
	} else {
		$invoiceFactory = new InvoiceFactory( null, null, null, null, $response['invoice'] );
		$invoiceFactory->processorResponse( $option, $response );
	}
}

function errorAP( $option, $usage, $userid, $username, $name, $recurring )
{
	Payment_HTML::errorAP( $option, $usage, $userid, $username, $name, $recurring );
}

function cancelPayment( $option )
{
	$database = &JFactory::getDBO();

	global $aecConfig, $mainframe;

	$userid = aecGetParam( 'itemnumber', true, array( 'word', 'int' ) );
	// The user cancel the payment operation
	// But user is already created as blocked on database, so we need to delete it
	$obj = new JTableUser( $database );
	$obj->load( $userid );

	if ( $obj->id ) {
		if ( (  (strcasecmp( $obj->usertype, 'Super Administrator' ) != 0 ) || ( strcasecmp( $obj->usertype, 'superadministrator' ) != 0 ) ) && ( strcasecmp( $obj->usertype, 'Administrator' ) != 0 ) && ( $obj->block == 1 ) ) {
			// If the user is not blocked this can be a false cancel
			// So just delete user if he is blocked and is not an administrator or super admnistrator
			$obj->delete();
		}
	}

	// Look whether we have a custom Cancel page
	if ( $aecConfig->cfg['customcancel'] ) {
		aecRedirect( $aecConfig->cfg['customcancel'] );
	} else {
		$mainframe->SetPageTitle( _CANCEL_TITLE );

		HTML_Results::cancel( $option );
	}
}

function aecNotAuth()
{
	if ( aecJoomla15check() ) {
		$user =& JFactory::getUser();

		echo JText::_('ALERTNOTAUTH');
		if ( $user->get('id') < 1 ) {
			echo "<br />" . JText::_( 'You need to login.' );
		}
	} else {
		global $my;

		echo _NOT_AUTH;
		if ( $my->id < 1 ) {
			echo "<br />" . _DO_LOGIN;
		}
	}
}

?>
