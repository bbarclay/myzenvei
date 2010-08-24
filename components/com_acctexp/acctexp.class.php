<?php
/**
 * @version $Id: acctexp.class.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Core Class
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

//error_reporting(E_ALL);

global $aecConfig;

if ( !defined( 'JPATH_SITE' ) ) {
	global $mosConfig_absolute_path;

	define( 'JPATH_SITE', $mosConfig_absolute_path );
}

// Make sure we are compatible with php4
include_once( JPATH_SITE . '/components/com_acctexp/lib/php4/php4.php' );

// Make sure we are compatible with joomla1.0
include_once( JPATH_SITE . '/components/com_acctexp/lib/j15/j15.php' );

if ( !defined ( 'AEC_FRONTEND' ) && !defined( '_AEC_LANG' ) ) {
	$langPath = JPATH_SITE . '/administrator/components/com_acctexp/lang/';
	if ( file_exists( $langPath . $GLOBALS['mosConfig_lang'] . '.php' ) ) {
		include_once( $langPath . $GLOBALS['mosConfig_lang'] . '.php' );
	} else {
		include_once( $langPath. 'english.php' );
	}
	include_once( $langPath . 'general.php' );
}

if ( !defined( '_AEC_LANG' ) ) {
	$langPath = JPATH_SITE . '/components/com_acctexp/lang/';
	if ( file_exists( $langPath . $GLOBALS['mosConfig_lang'] . '.php' ) ) {
		include_once( $langPath . $GLOBALS['mosConfig_lang'] . '.php' );
	} else {
		include_once( $langPath . 'english.php' );
	}
	define( '_AEC_LANG', 1 );
}

include_once( JPATH_SITE . '/administrator/components/com_acctexp/lang/general.php' );

if ( !class_exists( 'paramDBTable' ) ) {
	include_once( JPATH_SITE . '/components/com_acctexp/lib/eucalib/eucalib.php' );
}

include_once( JPATH_SITE . '/components/com_acctexp/lib/mammontini/mammontini.php' );

// Catch all debug function
function aecDebug( $text, $level = 128 )
{
	$database = &JFactory::getDBO();

	$eventlog = new eventLog( $database );
	if ( !is_string( $text ) ) {
		$eventlog->issue( 'debug', 'debug', json_encode( $text ), $level );
	} else {
		$eventlog->issue( 'debug', 'debug', $text, $level );
	}
}

if ( !function_exists( 'aecJoomla15check' ) ) {
	function aecJoomla15check()
	{
		if ( !defined( 'AECJOOMLA15CHECK' ) ) {
			global $aecConfig;

			if ( !empty( $aecConfig->cfg['overrideJ15'] ) ) {
				define( 'AECJOOMLA15CHECK', false );
			} else {
				define( 'AECJOOMLA15CHECK', defined( '_JEXEC' ) );
			}
		}

		return AECJOOMLA15CHECK;
	}
}

function aecGetParam( $name, $default='', $safe=false, $safe_params=array() )
{
	if ( aecJoomla15check() ) {
		$return = JArrayHelper::getValue( $_REQUEST, $name, $default );
	} else {
		$return = mosGetParam( $_REQUEST, $name, $default, 0x0002 );
	}

	if ( !isset( $_REQUEST[$name] ) ) {
		return $default;
	}

	if ( !is_array( $return ) ) {
		$return = trim( $return );
	}

	if ( !empty( $_POST[$name] ) ) {
		if ( is_array( $_POST[$name] ) && !is_array( $return ) ) {
			$return = $_POST[$name];
		}
	}

	if ( empty( $return ) && !empty( $_REQUEST[$name] ) ) {
		$return = $_REQUEST[$name];
	}

	if ( $safe ) {
		if ( is_array( $return ) ) {
			foreach ( $return as $k => $v ) {
				$return[$k] = aecEscape( $v, $safe_params );
			}
		} else {
			$return = aecEscape( $return, $safe_params );
		}

	}

	return $return;
}

function aecEscape( $value, $safe_params )
{
	$database = &JFactory::getDBO();

	$regex = "#{aecjson}(.*?){/aecjson}#s";

	// find all instances of json code
	$matches = array();
	preg_match_all( $regex, $value, $matches, PREG_SET_ORDER );

	if ( count( $matches ) ) {
		$value = str_replace( $matches, array(''), $value );
	}

	if ( get_magic_quotes_gpc() ) {
		$return = stripslashes( $value );
	} else {
		$return = $value;
	}

	if ( in_array( 'clear_nonemail', $safe_params ) ) {
		if ( strpos( $value, '@' ) === false ) {
			if ( !in_array( 'clear_nonalnum', $safe_params ) ) {
				// This is not a valid email adress to begin with, so strip everything hazardous
				$safe_params[] = 'clear_nonalnum';
			}
		} else {
			$array = explode('@', $value, 2);

			$username = preg_replace( '/[^a-z0-9._+-]+/i', '', $username );
			$domain = preg_replace( '/[^a-z0-9.-]+/i', '', $domain );

			$value = $username.'@'.$domain;
		}
	}

	if ( in_array( 'clear_nonalnum', $safe_params ) ) {
		$value = preg_replace( "/[^a-z \d]/i", "", $value );
	}

	if ( !empty( $safe_params ) ) {
		foreach ( $safe_params as $param ) {
			switch ( $param ) {
				case 'word':
					$e = strpos( $return, ' ' );
					if ( $e !== false ) {
						$r = substr( $return, 0, $e );
					} else {
						$r = $return;
					}
					break;
				case 'badchars':
					for ( $n=0; $n<strlen($return); $n++ ) {
						if ( eregi( "[\<|\>|\"|\'|\%|\;|\(|\)]", $return[$n] ) ) {
							 $r = substr( $return, 0, $n );
							 continue;
						}
					}
					break;
				case 'int':
					$r = (int) $return;
					break;
				case 'string':
					$r = (string) $return;
					break;
				case 'float':
					$r = (float) $return;
					break;
			}

			$return = $r;
		}

	}

	return $database->getEscaped( $return );
}

function aecPostParamClear( $array, $safe=false, $safe_params=array( 'string', 'badchars' ) )
{
	$cleararray = array();
	foreach ( $array as $key => $value ) {
		$cleararray[$key] = aecGetParam( $key, $safe, $safe_params );
	}

	return $cleararray;
}

function aecRedirect( $url, $msg, $class=null )
{
	if ( aecJoomla15check() ) {
		global $mainframe;

		$mainframe->redirect( $url, $msg, $class );
	} else {
		if ( !empty( $class ) ) {
			$msg = "<div class=\"" . $class . "\">".$msg."</div>";
		}

		mosRedirect( $url, $msg );
	}
}

class metaUser
{
	/** @var int */
	var $userid				= null;
	/** @var object */
	var $cmsUser			= null;
	/** @var object */
	var $objSubscription	= null;
	/** @var int */
	var $hasSubscription	= null;

	function metaUser( $userid, $subscriptionid=null )
	{
		$database = &JFactory::getDBO();

		if ( empty( $userid ) && !empty( $subscriptionid ) ) {
			$userid = AECfetchfromDB::UserIDfromSubscriptionID( $subscriptionid );
		}

		$this->meta = new metaUserDB( $database );
		$this->meta->loadUserid( $userid );

		$this->cmsUser = false;
		$this->hasCBprofile = false;
		$this->hasJSprofile = false;
		$this->userid = 0;

		$this->hasSubscription = 0;
		$this->objSubscription = null;
		$this->focusSubscription = null;

		if ( $userid ) {
			$this->cmsUser = new JTableUser( $database );
			$this->cmsUser->load( $userid );

			$this->userid = $userid;

			if ( !empty( $subscriptionid ) ) {
				$aecid = $subscriptionid;
			} else {
				$aecid = AECfetchfromDB::SubscriptionIDfromUserID( $userid );
			}

			if ( $aecid ) {
				$this->objSubscription = new Subscription( $database );
				$this->objSubscription->load( $aecid );
				$this->focusSubscription = new Subscription( $database );
				$this->focusSubscription->load( $aecid );
				$this->hasSubscription = 1;
				$this->temporaryRFIX();
			}
		}
	}

	function temporaryRFIX()
	{
		if ( !empty( $this->meta->plan_history->used_plans ) ) {
			$used_plans= $this->meta->plan_history->used_plans;
		} else {
			$used_plans = array();
		}

		$previous_plan = $this->meta->getPreviousPlan();

		$this->focusSubscription->used_plans = $used_plans;
		$this->focusSubscription->previous_plan = $previous_plan;
		$this->objSubscription->used_plans = $used_plans;
		$this->objSubscription->previous_plan = $previous_plan;
	}

	function getCMSparams( $name )
	{
		$userParams =& new JParameter( $this->cmsUser->params );

		if ( is_array( $name ) ) {
			$array = array();

			foreach ( $name as $n ) {
				$array[$n] = $userParams->get( $n );
			}

			return $array;
		} else {
			return (int) $userParams->get( $name );
		}
	}

	function setCMSparams( $array )
	{
		$database = &JFactory::getDBO();

		$params = explode( "\n", $this->cmsUser->params );

		$oldarray = array();
		foreach ( $params as $chunk ) {
			$k = explode( '=', $chunk, 2 );
			if ( !empty( $k[0] ) ) {
				// Strip slashes, but preserve special characters
				$oldarray[$k[0]] = stripslashes( str_replace( array( '\n', '\t', '\r' ), array( "\n", "\t", "\r" ), $k[1] ) );
			}
			unset( $k );
		}

		foreach ( $array as $n => $v  ) {
			$oldarray[$n] = $v;
		}

		$params = array();
		foreach ( $array as $key => $value ) {
			if ( !is_null( $key ) ) {
				if ( is_array( $value ) ) {
					$temp = implode( ';', $value );
					$value = $temp;
				}

				if ( get_magic_quotes_gpc() ) {
					$value = stripslashes( $value );
				}

				$value = $database->getEscaped( $value );

				$params[] = $key . '=' . $value;
			}
		}

		$this->cmsUser->params = implode( "\n", $params );

		$this->cmsUser->check();
		return $this->cmsUser->store();
	}

	function getTempAuth()
	{
		$return = false;

		// Only authorize if user IP is matching and the grant is not expired
		if ( isset( $this->meta->custom_params['tempauth_exptime'] ) && isset( $this->meta->custom_params['tempauth_ip'] ) ) {
			if ( ( $this->meta->custom_params['tempauth_ip'] == $_SERVER['REMOTE_ADDR'] ) && ( $this->meta->custom_params['tempauth_exptime'] >= time() ) ) {
				return true;
			}
		}

		return false;
	}

	function setTempAuth( $password=false )
	{
		global $aecConfig;

		if ( !empty( $this->cmsUser->password ) ) {
			// Make sure we catch traditional and new joomla passwords
			if ( ( $password !== false ) ) {
				if ( strpos( $this->cmsUser->password, ':') === false ) {
					if ( $this->cmsUser->password != md5( $password ) ) {
						return false;
					}
				} else {
					list( $hash, $salt ) = explode(':', $this->cmsUser->password);
					$cryptpass = md5( $password . $salt );
					if ( $hash != $cryptpass ) {
						return false;
					}
				}
			}
		}

		// Set params
		$params = array();
		$params['tempauth_ip'] = $_SERVER['REMOTE_ADDR'];
		$params['tempauth_exptime'] = strtotime( '+' . max( 10, $aecConfig->cfg['temp_auth_exp'] ) . ' minutes', time() );

		// Save params either to subscription or to _user entry
		$this->meta->addCustomParams( $params );
		$this->meta->storeload();

		return true;
	}

	function getAllSubscriptions()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $this->userid . '\''
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function getAllCurrentSubscriptions()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $this->userid . '\''
				. ' AND `status` != \'Expired\''
				. ' AND `status` != \'Closed\''
				. ' AND `status` != \'Hold\''
				. ' ORDER BY `lastpay_date` DESC'
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function getAllCurrentSubscriptionPlans()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `plan`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $this->userid . '\''
				. ' AND `status` != \'Expired\''
				. ' AND `status` != \'Closed\''
				. ' AND `status` != \'Hold\''
				. ' ORDER BY `lastpay_date` DESC'
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function getSecondarySubscriptions( $simple=false )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`' . ( $simple ? '' : ', `plan`, `type`' )
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $this->userid . '\''
				. ' AND `primary` = \'0\''
				. ' ORDER BY `lastpay_date` DESC'
				;
		$database->setQuery( $query );
		if ( $simple ) {
			return $database->loadResultArray();
		} else {
			return $database->loadObjectList();
		}
	}

	function getMIlist()
	{
		$plans = $this->getAllCurrentSubscriptionPlans();

		$milist = array();
		foreach ( $plans as $plan_id ) {
			$mis = microIntegrationHandler::getMIsbyPlan( $plan_id );

			if ( !empty( $mis ) ) {
				foreach ( $mis as $mi ) {
					if ( array_key_exists( $mi, $milist ) ) {
						$milist[$mi]++;
					} else {
						$milist[$mi] = 1;
					}
				}
			}
		}

		return $milist;
	}

	function getMIcount( $mi_id )
	{
		$plans = $this->getAllCurrentSubscriptionPlans();

		$count = 0;
		foreach ( $plans as $plan_id ) {
			$mis = microIntegrationHandler::getMIsbyPlan( $plan_id );

			if ( !empty( $mis ) ) {
				foreach ( $mis as $mi ) {
					if ( $mi == $mi_id ) {
						$count++;
					}
				}
			}
		}

		return $count;
	}

	function procTriggerCreate( $user, $payment, $usage )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		// Create a new cmsUser from user details - only allowing basic details so far
		// Try different types of usernames to make sure we have a unique one
		$usernames = array( $user['username'],
							$user['username'] . substr( md5( $user['name'] ), 0, 3 ),
							$user['username'] . substr( md5( ( $user['name'] . time() ) ), 0, 3 )
							);

		// Iterate through semi-random and pseudo-random usernames until a non-existing is found
		$id = 1;
		$k = 0;
		while ( $id ) {
			$username = $usernames[min( $k, ( count( $usernames ) - 1 ) )];

			$query = 'SELECT `id`'
					. ' FROM #__users'
					. ' WHERE `username` = \'' . $username . '\''
					;
			$database->setQuery( $query );

			$id = $database->loadResult();
			$k++;
		}

		$var['id'] 			= 0;
		$var['gid'] 		= 0;
		$var['username']	= $username;
		$var['name']		= $user['name'];
		$var['email']		= $user['email'];
		$var['password']	= $user['password'];

		$userid = AECToolbox::saveUserRegistration( 'com_acctexp', $var, true );

		// Create a new invoice with $invoiceid as secondary ident
		$invoice = new Invoice( $database );
		$invoice->create( $userid, $usage, $payment['processor'], $payment['secondary_ident'] );

		// return nothing, the invoice will be handled by the second ident anyways
		return;
	}

	function establishFocus( $payment_plan, $processor='none', $silent=false, $bias=null )
	{
		$database = &JFactory::getDBO();

		if ( !is_object( $payment_plan ) ) {
			$planid = $payment_plan;

			$payment_plan = new SubscriptionPlan( $database );
			$payment_plan->load( $planid );

			if ( empty( $payment_plan->id ) ) {
				return false;
			}
		}

		if ( is_object( $this->focusSubscription ) ) {
			if ( $this->focusSubscription->plan == $payment_plan->id ) {
				return 'existing';
			}
		}

		$plan_params = $payment_plan->params;

		if ( !isset( $plan_params['make_primary'] ) ) {
			$plan_params['make_primary'] = 1;
		}

		$existing_record = 0;
		$existing_status = false;

		// Check whether a record exists
		if ( $this->hasSubscription ) {
			$existing_record = $this->focusSubscription->getSubscriptionID( $this->userid, $payment_plan->id, $plan_params['make_primary'], false, $bias );

			if ( !empty( $existing_record ) ) {
				$query = 'SELECT `status`'
						. ' FROM #__acctexp_subscr'
						. ' WHERE `id` = \'' . (int) $existing_record . '\''
						;
				$database->setQuery( $query );
				$existing_status = $database->loadResult();
			}
		} else {
			$existing_record = 0;
		}

		$return = false;

		// To be failsafe, a new subscription may have to be added in here
		if ( empty( $this->hasSubscription ) || !$plan_params['make_primary'] ) {
			if ( !empty( $existing_record ) && ( ( $existing_status == 'Pending' ) || $plan_params['update_existing'] || $plan_params['make_primary'] ) ) {
				// Update existing non-primary subscription
				$this->focusSubscription = new Subscription( $database );
				$this->focusSubscription->load( $existing_record );
				$return = 'existing';
			} else {
				if ( !empty( $this->hasSubscription ) ) {
					$existing_parent = $this->focusSubscription->getSubscriptionID( $this->userid, $plan_params['standard_parent'], null );
				} else {
					$existing_parent = false;
				}

				// Create a root new subscription
				if ( empty( $this->hasSubscription ) && !$plan_params['make_primary'] && !empty( $plan_params['standard_parent'] ) && empty( $existing_parent ) ) {
					$this->objSubscription = new Subscription( $database );
					$this->objSubscription->load( 0 );
					$this->objSubscription->createNew( $this->userid, 'none', 1, 1, $plan_params['standard_parent'] );
					$this->objSubscription->applyUsage( $plan_params['standard_parent'], 'none', $silent, 0 );
				}

				// Create new subscription
				$this->focusSubscription = new Subscription( $database );
				$this->focusSubscription->load( 0 );
				$this->focusSubscription->createNew( $this->userid, $processor, 1, $plan_params['make_primary'], $payment_plan->id );
				$this->hasSubscription = 1;

				if ( $plan_params['make_primary'] ) {
					$this->objSubscription = $this->focusSubscription;
				}

				$return = 'new';
			}

		}

		if ( empty( $this->objSubscription ) && !empty( $this->focusSubscription ) ) {
			$this->objSubscription = $this->focusSubscription;
		}

		$this->temporaryRFIX();

		return $return;
	}

	function moveFocus( $subscrid )
	{
		$database = &JFactory::getDBO();

		$subscription = new Subscription( $database );
		$subscription->load( $subscrid );

		// If Subscription exists, move the focus to that one
		if ( $subscription->id ) {
			if ( $subscription->userid == $this->userid ) {
				$this->focusSubscription = $subscription;
				$this->temporaryRFIX();
				return true;
			} else {
				// This subscription does not belong to the user!
				return false;
			}
		} else {
			// This subscription does not exist
			return false;
		}
	}

	function loadSubscriptions()
	{
		$database = &JFactory::getDBO();

		// Get all the users subscriptions
		$query = 'SELECT id'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $this->userid . '\''
				;
		$database->setQuery( $query );
		$subscrids = $database->loadResultArray();

		if ( count( $subscrids ) > 1 ) {
			$this->allSubscriptions = array();

			foreach ( $subscrids as $subscrid ) {
				$subscription = new Subscription( $database );
				$subscription->load( $subscrid );

				$this->allSubscriptions[] = $subscription;
			}

			return true;
		} else {
			// There is only the one that is probably already loaded
			$this->allSubscriptions = false;
			return false;
		}
	}

	function instantGIDchange( $gid, $session=true )
	{
		$database = &JFactory::getDBO();

		$acl = &JFactory::getACL();

		// Always protect last administrator
		if ( ( $this->cmsUser->gid == 24 ) || ( $this->cmsUser->gid == 25 ) ) {
			$query = 'SELECT count(*)'
					. ' FROM #__core_acl_groups_aro_map'
					. ' WHERE `group_id` = \'25\''
					;
			$database->setQuery( $query );
			if ( $database->loadResult() <= 1) {
				return false;
			}

			$query = 'SELECT count(*)'
					. ' FROM #__core_acl_groups_aro_map'
					. ' WHERE `group_id` = \'24\''
					;
			$database->setQuery( $query );
			if ( $database->loadResult() <= 1) {
				return false;
			}
		}

		// Get ARO ID for user
		$query = 'SELECT `' . ( aecJoomla15check() ? 'id' : 'aro_id' )  . '`'
				. ' FROM #__core_acl_aro'
				. ' WHERE `value` = \'' . (int) $this->userid . '\''
				;
		$database->setQuery( $query );
		$aro_id = $database->loadResult();

		// If we have no aro id, something went wrong and we need to create it
		if ( empty( $aro_id ) ) {
			$query2 = 'INSERT INTO #__core_acl_aro'
					. ' (`section_value`, `value`, `order_value`, `name`, `hidden` )'
					. ' VALUES ( \'users\', \'' . $this->userid . '\', \'0\', \'' . $this->cmsUser->name . '\', \'0\' )'
					;
			$database->setQuery( $query2 );
			$database->query();

			$database->setQuery( $query );
			$aro_id = $database->loadResult();
		}

		// Carry out ARO ID -> ACL group mapping
		$query = 'UPDATE #__core_acl_groups_aro_map'
				. ' SET `group_id` = \'' . (int) $gid . '\''
				. ' WHERE `aro_id` = \'' . $aro_id . '\''
				;
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		// Moxie Mod - updated to add usertype to users table and update session table for immediate access to usertype features
		$gid_name = $acl->get_group_name( $gid, 'ARO' );

		// Set GID and usertype
		$query = 'UPDATE #__users'
				. ' SET `gid` = \'' .  (int) $gid . '\', `usertype` = \'' . $gid_name . '\''
				. ' WHERE `id` = \''  . (int) $this->userid . '\''
				;
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );

		if ( $session ) {
			// Update Session
			if ( aecJoomla15check() ) {
				$query = 'SELECT data'
				. ' FROM #__session'
				. ' WHERE `userid` = \'' . (int) $this->userid . '\''
				;
				$database->setQuery( $query );
				$data = $database->loadResult();

				if ( !empty( $data ) ) {
					$se = $this->joomunserializesession( $data );

					$keys = array_keys( $se );

					$key = array_pop( $keys );

					if ( isset( $se[$key]['user'] ) ) {
						$se[$key]['user']->gid		= $gid;
						$se[$key]['user']->usertype	= $gid_name;

						$sdata = $this->joomserializesession( $se );
					} else {
						$sdata = $data;
					}

					$query = 'UPDATE #__session'
							. ' SET `gid` = \'' .  (int) $gid . '\', `usertype` = \'' . $gid_name . '\', `data` = \'' . $sdata . '\''
							. ' WHERE `userid` = \'' . (int) $this->userid . '\''
							;
					$database->setQuery( $query );
					$database->query() or die( $database->stderr() );
				}
			} else {
				$query = 'UPDATE #__session'
						. ' SET `gid` = \'' .  (int) $gid . '\', `usertype` = \'' . $gid_name . '\''
						. ' WHERE `userid` = \'' . (int) $this->userid . '\''
						;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			}
		}
	}

	function unserializesession( $data )
	{
		$vars = preg_split('/([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff^|]*)\|/', $data, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );

		for ( $i=0; $vars[$i]; $i++ ) {
			$result[$vars[$i++]] = unserialize( $vars[$i] );
		}

		return $result;
	}

	function joomunserializesession( $data )
	{
		$se = explode( "|", $data );
		$se[1] = unserialize( $se[1] );

		return array( $se[0] => $se[1] );
	}

	function joomserializesession( $data )
	{
		$key = array_pop( array_keys( $data ) );

		return $key . "|" . serialize( $data[$key] );
	}

	function is_renewing()
	{
		if ( !empty( $this->meta ) ) {
			return ( $this->meta->is_renewing() ? 1 : 0 );
		} else {
			return 0;
		}
	}

	function loadCBuser()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT *'
			. ' FROM #__users u, #__comprofiler ue'
			. ' WHERE `user_id` = \'' . (int) $this->userid . '\' AND u.id = ue.id';
		$database->setQuery( $query );
		if ( aecJoomla15check() ) {
			$this->cbUser = $database->loadObject();
		} else {
			$database->loadObject($this->cbUser);
		}

		if ( is_object( $this->cbUser ) ) {
			$this->hasCBprofile = true;
		}
	}

	function loadJSuser()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__community_fields'
				. ' WHERE `type` != \'group\''
				;
		$database->setQuery( $query );
		$ids = $database->loadResultArray();

		$query = 'SELECT `field_id`, `value`'
				. ' FROM #__community_fields_values'
					. ' WHERE `field_id` IN (' . implode( ',', $ids ) . ')'
					. ' AND `user_id` = \'' . (int) $this->userid . '\'';
				;
		$database->setQuery( $query );
		$fields = $database->loadObjectList();

		$this->jsUser = $fields;

		if ( !empty( $this->jsUser ) ) {
			$this->hasJSprofile = true;
		}
	}

	function CustomRestrictionResponse( $restrictions )
	{
		$s = array();
		$n = 0;
		foreach ( $restrictions as $restriction ) {
			$check1 = AECToolbox::rewriteEngine( $restriction[0], $this );
			$check2 = AECToolbox::rewriteEngine( $restriction[2], $this );
			$eval = $restriction[1];

			if ( ( $check1 === $restriction[0] ) && ( reWriteEngine::isRWEstring( $restriction[0] ) ) ) {
				$check1 = null;
			}

			if ( ( $check2 === $restriction[2] ) && ( reWriteEngine::isRWEstring( $restriction[2] ) ) ) {
				$check2 = null;
			}

			$s['customchecker'.$n] = AECToolbox::compare( $eval, $check1, $check2 );
			$n++;
		}

		return $s;
	}

	function permissionResponse( $restrictions )
	{
		if ( is_array( $restrictions ) ) {
			$return = array();
			foreach ( $restrictions as $name => $value ) {
				// Might be zero, so do an expensive check
				if ( !is_null( $value ) && !( $value === "" ) ) {
					// Switch flag for inverted call
					if ( strpos( $name, '_excluded' ) !== false ) {
						$invert = true;
						$name = str_replace( '_excluded', '', $name );
					} else {
						$invert = false;
					}

					// Convert values to array or explode to array if none
					if ( !is_array( $value ) ) {
						if ( strpos( $value, ';' ) !== false ) {
							$check = explode( ';', $value );
						} else {
							$check = array( (int) $value );
						}
					} else {
						$check = $value;
					}

					$status = false;

					switch ( $name ) {
						// Check for set userid
						case 'userid':
							if ( is_object( $this->cmsUser ) ) {
								if ( $this->cmsUser->id === $value ) {
									$status = true;
								}
							}
							break;
						// Check for a certain GID
						case 'fixgid':
							if ( is_object( $this->cmsUser ) ) {
								if ( (int) $value === (int) $this->cmsUser->gid ) {
									$status = true;
								}
							}
							break;
						// Check for Minimum GID
						case 'mingid':
							if ( is_object( $this->cmsUser ) ) {
								$groups = GeneralInfoRequester::getLowerACLGroup( (int) $this->cmsUser->gid );
								if ( in_array( (int) $value, (array) $groups ) ) {
									$status = true;
								}
							}
							break;
						// Check for Maximum GID
						case 'maxgid':
							if ( is_object( $this->cmsUser ) ) {
								$groups = GeneralInfoRequester::getLowerACLGroup( $value );
								if ( in_array( (int) $this->cmsUser->gid, (array) $groups) ) {
									$status = true;
								}
							} else {
								// New user, so will always pass a max GID test
								$status = true;
							}
							break;
						// Check whether the user is currently in the right plan
						case 'plan_present':
							if ( $this->hasSubscription ) {
								$subs = $this->getAllCurrentSubscriptionPlans();

								foreach ( $subs as $subid ) {
									if ( in_array( (int) $subid, $check ) ) {
										$status = true;
									}
								}
							} else {
								if ( in_array( 0, $check ) ) {
									// "None" chosen, so will always pass if new user
									$status = true;
								}
							}
							break;
						// Check whether the user was in the correct plan before
						case 'plan_previous':
							if ( $this->hasSubscription ) {
								$previous = (int) $this->meta->getPreviousPlan();

								if (
									( in_array( $previous, $check ) )
									|| ( ( in_array( 0, $check ) ) && is_null( $previous ) )
									) {
									$status = true;
								}
							} else {
								if ( in_array( 0, $check ) ) {
									// "None" chosen, so will always pass if new user
									$status = true;
								}
							}
							break;
						// Check whether the user has used the right plan before
						case 'plan_overall':
							if ( $this->hasSubscription ) {
								$subs = $this->getAllCurrentSubscriptionPlans();

								$array = $this->meta->getUsedPlans();
								foreach ( $check as $v ) {
									if ( ( !empty( $array[(int) $v] ) || in_array( $v, $subs ) ) ) {
										$status = true;
									}
								}
							} else {
								if ( in_array( 0, $check ) ) {
									// "None" chosen, so will always pass if new user
									$status = true;
								}
							}
							break;
						// Check whether the user has used the plan at least a certain number of times
						case 'plan_amount_min':
							if ( $this->hasSubscription ) {
								$subs = $this->getAllCurrentSubscriptionPlans();

								$usage = $this->meta->getUsedPlans();

								if ( !is_array( $value ) ) {
									$check = array( $value );
								}

								foreach ( $check as $v ) {
									$c = explode( ',', $v );

									// We have to add one here if the user is currently in the plan
									if ( in_array( $c[0], $subs ) ) {
										if ( isset( $usage[(int) $c[0]] ) ) {
											$usage[(int) $c[0]] += 1;
										} else {
											$usage[(int) $c[0]] = 1;
										}
									}

									if ( isset( $usage[(int) $c[0]] ) ) {
										if ( $usage[(int) $c[0]] >= (int) $c[1] ) {
											$status = true;
										}
									}
								}
							}
							break;
						// Check whether the user has used the plan at max a certain number of times
						case 'plan_amount_max':
							if ( $this->hasSubscription ) {
								$subs = $this->getAllCurrentSubscriptionPlans();

								$usage = $this->meta->getUsedPlans();

								if ( !is_array( $value ) ) {
									$check = array( $value );
								}

								foreach ( $check as $v ) {
									$c = explode( ',', $v );

									// We have to add one here if the user is currently in the plan
									if ( in_array( $c[0], $subs ) ) {
										if ( isset( $usage[(int) $c[0]] ) ) {
											$usage[(int) $c[0]] += 1;
										} else {
											$usage[(int) $c[0]] = 1;
										}
									}

									if ( isset( $usage[(int) $c[0]] ) ) {
										if ( $usage[(int) $c[0]] <= (int) $c[1] ) {
											$status = true;
										}
									}
								}
							} else {
								// New user will always pass max plan amount test
								$status = true;
							}
							break;
						default:
							// If it's not there, it's super OK!
							$status = true;
							break;
					}
				}

				// Swap if inverted and reestablish name
				if ( $invert ) {
					$name .= '_excluded';
					$return[$name] = !$status;
				} else {
					$return[$name] = $status;
				}
			}
			return $return;
		} else {
			return false;
		}
	}

	function usedCoupon ( $couponid, $type )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `usecount`'
				. ' FROM #__acctexp_couponsxuser'
				. ' WHERE `userid` = \'' . $this->userid . '\''
				. ' AND `coupon_id` = \'' . $couponid . '\''
				. ' AND `coupon_type` = \'' . $type . '\''
				;
		$database->setQuery( $query );
		$usecount = $database->loadResult();

		if ( $usecount ) {
			return $usecount;
		} else {
			return false;
		}
	}

	function getProperty( $key )
	{
		return AECToolbox::getObjectProperty( $this, $key );
	}

	function getUserMIs(){
		$database = &JFactory::getDBO();

		$return = array();
		if ( !empty( $this->objSubscription->plan ) ) {
			$selected_plan = new SubscriptionPlan( $database );
			$selected_plan->load( $this->objSubscription->plan );

			$mis = $selected_plan->micro_integrations;

			if ( empty( $mis ) ) {
				$mis = array();
			}

			$sec = $this->getSecondarySubscriptions( true );

			if ( !empty( $sec ) ) {
				foreach ( $sec as $pid ) {
					$selected_plan = new SubscriptionPlan( $database );
					$selected_plan->load( $this->objSubscription->plan );

					if ( !empty( $selected_plan->micro_integrations ) ) {
						$mis = array_merge( $mis, $selected_plan->micro_integrations );
					}
				}
			}

			if ( count( $mis ) ) {
				array_unique( $mis );

				foreach ( $mis as $mi_id ) {
					if ( $mi_id ) {
						$mi = new MicroIntegration( $database );
						$mi->load( $mi_id );

						if ( !$mi->callIntegration() ) {
							continue;
						}

						$return[] = $mi;
					}
				}
			}
		}

		return $return;
	}

	function getAlertLevel()
	{
		$alert = array();

		if ( !empty( $this->objSubscription->status ) ) {
			if ( strcmp( $this->objSubscription->status, 'Excluded' ) === 0 ) {
				$alert['level']		= 3;
				$alert['daysleft']	= 'excluded';
			} elseif ( !empty( $this->objSubscription->lifetime ) ) {
				$alert['level']		= 3;
				$alert['daysleft']	= 'infinite';
			} else {
				$alert = $this->objSubscription->GetAlertLevel();
			}
		}

		return $alert;
	}

	function isRecurring()
	{
		if ( !empty( $this->objSubscription->status ) ) {
			if ( strcmp( $this->objSubscription->status, 'Cancelled' ) != 0 ) {
				return $this->objSubscription->recurring;
			}
		}

		return false;
	}

	function delete()
	{
		$subids = $this->getAllSubscriptions();

		foreach ( $subids as $id ) {
			$subscription = new Subscription();
			$subscription->load( $id );

			$subscription->delete();
		}

		$this->meta->delete();
	}
}

class metaUserDB extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $userid				= null;
	/** @var datetime */
	var $created_date		= null;
	/** @var datetime */
	var $modified_date		= null;
	/** @var serialized object */
	var $plan_history		= null;
	/** @var serialized object */
	var $processor_params	= null;
	/** @var serialized object */
	var $plan_params		= null;
	/** @var serialized object */
	var $params 			= null;
	/** @var serialized object */
	var $custom_params		= null;

	/**
	* @param database A database connector object
	*/
	function metaUserDB( &$db )
	{
		parent::__construct( '#__acctexp_metauser', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'plan_history', 'processor_params', 'plan_params', 'params', 'custom_params' );
	}

	/**
	 * loads specified user
	 *
	 * @param int $userid
	 */
	function loadUserid( $userid )
	{
		$id = $this->getIDbyUserid( $userid );

		if ( $id ) {
			$this->load( $id );
		} else {
			$this->createNew( $userid );
		}
	}

	function getIDbyUserid( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_metauser'
				. ' WHERE `userid` = \'' . $userid . '\''
				;
		$database->setQuery( $query );

		return $database->loadResult();
	}

	function createNew( $userid )
	{
		global $mainframe;

		$this->userid			= $userid;
		$this->created_date		= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->modified_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );

		$this->storeload();

	}

	function getProcessorParams( $processorid )
	{
		if ( isset( $this->processor_params[$processorid] ) ) {
			return $this->processor_params[$processorid];
		} else {
			return false;
		}
	}

	function setProcessorParams( $processorid, $params )
	{
		global $mainframe;

		if ( empty( $this->processor_params ) ) {
			$this->processor_params = array();
		}

		if ( !is_array( $this->processor_params[$processorid] ) ) {
			$this->processor_params[$processorid] = array();
		}

		$this->processor_params[$processorid] = $params;

		$this->modified_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );

		$this->storeload();
	}

	function getMIParams( $miid, $usageid=false, $strict=true )
	{
		if ( $usageid ) {
			if ( is_object( $this->plan_params ) ) {
				$this->plan_params = array();
			}

			if ( isset( $this->plan_params[$usageid] ) ) {
				if ( isset( $this->plan_params[$usageid][$miid] ) ) {
					return $this->plan_params[$usageid][$miid];
				}
			} elseif ( !$strict ) {
				$this->getMIParams( $miid );
			}
		} else {
			if ( isset( $this->params->mi[$miid] ) ) {
				return $this->params->mi[$miid];
			}
		}

		return array();
	}

	function setMIParams( $miid, $usageid=false, $params, $replace=false )
	{
		global $mainframe;

		if ( $usageid ) {
			if ( is_object( $this->plan_params ) ) {
				$this->plan_params = array();
			}

			if ( isset( $this->plan_params[$usageid] ) ) {
				if ( isset( $this->plan_params[$usageid][$miid] ) && !$replace ) {
					$this->plan_params[$usageid][$miid] = $this->mergeParams( $this->plan_params[$usageid][$miid], $params );
				} else {
					$this->plan_params[$usageid][$miid] = $params;
				}
			} else {
				$this->plan_params[$usageid][$miid] = $params;
			}
		}

		if ( isset( $this->params->mi[$miid] ) && !$replace ) {
			$this->params->mi[$miid] = $this->mergeParams( $this->params->mi[$miid], $params );
		} else {
			$this->params->mi[$miid] = $params;
		}

		$this->modified_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' )*3600 );

		return true;
	}

	function addCustomParams( $params )
	{
		global $mainframe;

		$this->addParams( $params, 'custom_params' );

		$this->modified_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' )*3600 );
	}

	function addPreparedMIParams( $plan_mi, $mi=false )
	{
		global $mainframe;

		$this->addParams( $plan_mi, 'plan_params' );

		if ( $mi === false ) {
			// TODO: Write function that recreates pure MI data from plan_mi construct
		}

		if ( !empty( $mi ) ) {
			if ( isset( $this->params->mi ) ) {
				$this->params->mi = $this->mergeParams( $this->params->mi, $mi );
			} else {
				$this->params->mi = $mi;
			}
		}

		$this->modified_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' )*3600 );

		$this->storeload();
	}

	function addPlanID( $id )
	{
		global $mainframe;

		$this->plan_history->plan_history[] = $id;

		if ( isset( $this->plan_history->used_plans[$id] ) ) {
			$this->plan_history->used_plans[$id]++;
		} else {
			$this->plan_history->used_plans[$id] = 1;
		}

		$this->modified_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' )*3600 );

		$this->storeload();

		return true;
	}
	function is_renewing()
	{
		if ( isset( $this->plan_history->used_plans ) ) {
			return count( $this->plan_history->used_plans );
		} else {
			return false;
		}
	}
	function getUsedPlans()
	{
		if ( isset( $this->plan_history->used_plans ) ) {
			return $this->plan_history->used_plans;
		} else {
			return array();
		}
	}

	function getPreviousPlan()
	{
		if ( empty( $this->plan_history ) ) {
			return null;
		}

		$last = count( $this->plan_history->plan_history ) - 2;

		if ( $last < 0 ) {
			return null;
		} elseif ( isset( $this->plan_history->plan_history[$last] ) ) {
			return $this->plan_history->plan_history[$last];
		} else {
			return null;
		}
	}
}

class Config_General extends serialParamDBTable
{
	/** @var int Primary key */
	var $id 				= null;
	/** @var text */
	var $settings 			= null;

	function Config_General( &$db )
	{
		parent::__construct( '#__acctexp_config', 'id', $db );

		$this->load(1);

		// If we have no settings, init them
		if ( empty( $this->settings ) ) {
			$this->initParams();
		}
	}

	function declareParamFields()
	{
		return array( 'settings' );
	}

	function load( $id )
	{
		parent::load( $id );

		$this->cfg =& $this->settings;
	}

	function check( $fields=array() )
	{
		unset( $this->cfg );

		return parent::check();
	}

	function paramsList()
	{
		$def = array();
		$def['require_subscription']			= 0;
		$def['alertlevel2']						= 7;
		$def['alertlevel1']						= 3;
		$def['expiration_cushion']				= 12;
		$def['heartbeat_cycle']					= 24;
		$def['heartbeat_cycle_backend']			= 1;
		$def['plans_first']						= 0;
		$def['simpleurls']						= 0;
		$def['display_date_frontend']			= "%d %b %Y";
		$def['display_date_backend']			= "%a, %d %b %Y %T %Z";
		//$def['enable_mimeta']					= 0;
		$def['enable_coupons']					= 0;
		$def['displayccinfo']					= 1;
		$def['customtext_confirm_keeporiginal']	= 1;
		$def['customtext_checkout_keeporiginal']	= 1;
		$def['customtext_notallowed_keeporiginal']	= 1;
		$def['customtext_pending_keeporiginal']	= 1;
		$def['customtext_expired_keeporiginal']	= 1;
		// new 0.12.4
		$def['bypassintegration']				= '';
		$def['customintro']						= '';
		$def['customthanks']					= '';
		$def['customcancel']					= '';
		$def['customnotallowed']				= '';
		$def['tos']								= '';
		$def['customtext_plans']				= '';
		$def['customtext_confirm']				= '';
		$def['customtext_checkout']				= '';
		$def['customtext_notallowed']			= '';
		$def['customtext_pending']				= '';
		$def['customtext_expired']				= '';
		// new 0.12.4.2
		$def['adminaccess']						= 1;
		$def['noemails']						= 0;
		$def['nojoomlaregemails']				= 0;
		// new 0.12.4.10
		$def['debugmode']						= 0;
		// new 0.12.4.12
		$def['override_reqssl']					= 0;
		// new 0.12.4.16
		$def['invoicenum_doformat']				= 0;
		$def['invoicenum_formatting']			= '{aecjson}{"cmd":"concat","vars":[{"cmd":"date","vars":["Y",{"cmd":"rw_constant",'
													. '"vars":"invoice_created_date"}]},"-",{"cmd":"rw_constant","vars":"invoice_id"}]}'
													.'{/aecjson}';
		$def['use_recaptcha']					= 0;
		$def['recaptcha_privatekey']			= '';
		$def['recaptcha_publickey']				= '';
		$def['ssl_signup']						= 0;
		$def['error_notification_level']		= 32;
		$def['email_notification_level']		= 128;
		$def['temp_auth_exp']					= 15;
		$def['skip_confirmation']				= 0;
		$def['show_fixeddecision']				= 0;
		$def['confirmation_coupons']			= 0;
		$def['breakon_mi_error']				= 0;
		$def['curl_default']					= 1;
		$def['amount_currency_symbol']			= 0;
		$def['amount_currency_symbolfirst']		= 0;
		$def['amount_use_comma']				= 0;
		$def['tos_iframe']						= 0;
		$def['use_proxy']						= 0;
		$def['proxy']							= '';
		$def['proxy_port']						= '';
		$def['ssl_profile']						= 0;
		$def['customtext_thanks_keeporiginal']	= 1;
		$def['customtext_thanks']				= '';
		$def['customtext_cancel_keeporiginal']	= 1;
		$def['customtext_cancel']				= '';
		$def['renew_button_never']				= 0;
		$def['renew_button_nolifetimerecurring']= 1;
		$def['continue_button']					= 1;
		// new 0.12.6
		$def['overrideJ15']						= 0;
		$def['customtext_hold_keeporiginal']	= 1;
		$def['customtext_hold']					= '';
		$def['proxy_username']					= '';
		$def['proxy_password']					= '';
		$def['gethostbyaddr']					= 1;
		$def['root_group']						= 1;
		$def['root_group_rw']					= '';
		// TODO: $def['show_groups_first']						= 1;
		// TODO: $def['show_empty_groups']						= 1;
		$def['integrate_registration']			= 1;
		$def['customintro_userid']				= 0;
		$def['enable_shoppingcart']				= 0;
		$def['customlink_continueshopping']		= '';
		$def['additem_stayonpage']				= '';
		$def['customintro_always']				= 1;
		$def['customtext_exception_keeporiginal']	= 1;
		$def['customtext_exception']			= '';
		$def['gwlist']							= array();
		$def['checkout_display_descriptions']	= 0;
		$def['altsslurl']						= '';
		$def['checkout_as_gift']				= 0;
		$def['checkout_as_gift_access']			= 23;
		$def['invoice_cushion']					= 10; //Minutes
		$def['allow_frontend_heartbeat']		= 0;
		$def['disable_regular_heartbeat']		= 0;
		$def['custom_heartbeat_securehash']		= "";
		$def['quicksearch_top']					= 0;
		$def['invoice_page_title']				= _AEC_CUSTOM_INVOICE_PAGE_TITLE;
		$def['invoice_before_header']			= "";
		$def['invoice_header']					= _AEC_CUSTOM_INVOICE_HEADER;
		$def['invoice_after_header']			= "";
		$def['invoice_before_content']			= _AEC_CUSTOM_INVOICE_BEFORE_CONTENT;
		$def['invoice_after_content']			= _AEC_CUSTOM_INVOICE_AFTER_CONTENT;
		$def['invoice_before_footer']			= "";
		$def['invoice_footer']					= _AEC_CUSTOM_INVOICE_FOOTER;
		$def['invoice_address']					= _INVOICEPRINT_ADDRESSFIELD;
		$def['invoice_address_allow_edit']		= 1;
		$def['invoice_after_footer']			= "";
		$def['delete_tables']					= "";
		$def['delete_tables_sure']				= "";
		$def['standard_currency']				= "USD";
		$def['confirmation_changeusername']		= 1;
		$def['confirmation_changeusage']		= 1;
		$def['manageraccess']					= 0;
		$def['per_plan_mis']					= 0;
		$def['intro_expired']					= 0;
		$def['custom_confirm_userdetails']		= "";

		return $def;
	}

	function initParams()
	{
		// Insert a new entry if there is none yet
		if ( empty( $this->settings ) ) {
			$database = &JFactory::getDBO();

			$query = 'SELECT * FROM #__acctexp_config'
			. ' WHERE `id` = \'1\''
			;
			$database->setQuery( $query );

			if ( !$database->loadResult() ) {
				$query = 'INSERT INTO #__acctexp_config'
				. ' VALUES( \'1\', \'\' )'
				;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			}

			$this->id = 1;
			$this->settings = '';
		}

		// Write to Params, do not overwrite existing data
		$this->addParams( $this->paramsList(), 'settings', false );

		$this->storeload();

		return true;
	}

	function saveSettings()
	{
		// Extra check for duplicated rows
		if ( $this->RowDuplicationCheck() ) {
			$this->CleanDuplicatedRows();
			$this->load(1);
		}

		$this->cfg['aec_version'] = _AEC_VERSION;

		$this->storeload();
	}

	function RowDuplicationCheck()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT count(*)'
				. ' FROM #__acctexp_config'
				;
		$database->setQuery( $query );
		$rows = $database->loadResult();

		if ( $rows > 1 ) {
			return true;
		} else {
			return false;
		}
	}

	function CleanDuplicatedRows()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT max(id)'
				. ' FROM #__acctexp_config'
				;
		$database->setQuery( $query );
		$database->query();
		$max = $database->loadResult();

		$query = 'DELETE'
				. ' FROM #__acctexp_config'
				. ' WHERE `id` != \'' . $max . '\''
				;
		$database->setQuery( $query );
		$database->query();

		if ( !( $max == 1 ) ) {
			$query = 'UPDATE #__acctexp_config'
					. ' SET `id` = \'1\''
					. ' WHERE `id` =\'' . $max . '\''
					;
			$database->setQuery( $query );
			$database->query();
		}
	}
}

if ( !is_object( $aecConfig ) ) {
	$database = &JFactory::getDBO();

		global $aecConfig;

	$aecConfig = new Config_General( $database );
}

class aecHeartbeat extends JTable
{
 	/** @var int Primary key */
	var $id				= null;
 	/** @var datetime */
	var $last_beat 		= null;

	/**
	 * @param database A database connector object
	 */
	function aecHeartbeat( &$db )
	{
	 	parent::__construct( '#__acctexp_heartbeat', 'id', $db );
	 	$this->load(1);

		if ( empty( $this->last_beat ) ) {
			global $aecConfig;

			$query = 'INSERT INTO #__acctexp_heartbeat'
			. ' VALUES( \'1\', \'' . date( 'Y-m-d H:i:s', ( time() - $aecConfig->cfg['heartbeat_cycle'] * 3600 ) ) . '\' )'
			;
			$this->_db->setQuery( $query );
			$this->_db->query() or die( $this->_db->stderr() );
		}
	}

	function frontendping( $custom=false, $hash=null )
	{
		global $aecConfig;

		if ( !empty( $aecConfig->cfg['disable_regular_heartbeat'] ) && empty( $custom ) ) {
			return;
		}

		if ( empty( $aecConfig->cfg['allow_frontend_heartbeat'] ) && !empty( $custom ) ) {
			return;
		}

		if ( !empty( $custom ) && !empty( $aecConfig->cfg['custom_heartbeat_securehash'] ) ) {
			if ( empty( $hash ) ) {
				return;
			} elseif( $hash != $aecConfig->cfg['custom_heartbeat_securehash'] ) {
				$database = &JFactory::getDBO();
				$short	= 'custom heartbeat failure';
				$event	= 'Custom Frontend Heartbeat attempted, but faile due to false hashcode: "' . $hash . '"';
				$tags	= 'heartbeat, failure';
				$params = array();

				$eventlog = new eventLog( $database );
				$eventlog->issue( $short, $tags, $event, 128, $params );

				return;
			}
		}

		if ( !empty( $aecConfig->cfg['allow_frontend_heartbeat'] ) && !empty( $custom ) ) {
			aecHeartbeat::ping( 0 );
		} elseif ( !empty( $aecConfig->cfg['heartbeat_cycle'] ) ) {
			aecHeartbeat::ping( $aecConfig->cfg['heartbeat_cycle'] );
		}
	}

	function backendping()
	{
		global $aecConfig;

		if ( !empty( $aecConfig->cfg['heartbeat_cycle_backend'] ) ) {
			$this->ping( $aecConfig->cfg['heartbeat_cycle_backend'] );
		}
	}

	function ping( $configCycle )
	{
		global $mainframe;

		if ( empty( $this->last_beat ) ) {
			$this->load(1);
		}

		if ( empty( $configCycle ) ) {
			$ping = 0;
		} elseif ( $this->last_beat ) {
			$ping	= strtotime( $this->last_beat ) + $configCycle*3600;
		} else {
			$ping = 0;
		}

		if ( ( $ping - time() ) <= 0 ) {
			$this->last_beat = date( 'Y-m-d H:i:s', time() );
			$this->check();
			$this->store();
			$this->load(1);

			$this->beat();
		} else {
			// sleep, mechanical Hound, but do not sleep
			// kept awake with
			// wolves teeth
		}
	}

	function beat()
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		// Delete old token entries
		$query = 'DELETE'
				. ' FROM #__acctexp_temptoken'
				. ' WHERE `created_date` <= \'' . AECToolbox::computeExpiration( "-3", 'H', time() ) . '\''
				;
		$database->setQuery( $query );
		$database->query();

		// Receive maximum pre expiration time
		$query = 'SELECT MAX(pre_exp_check)'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `active` = \'1\''
				;
		$database->setQuery( $query );
		$pre_expiration = $database->loadResult();

		if ( $pre_expiration ) {
			// pre-expiration found, search limit set to the maximum pre-expiration time
			$expiration_limit = AECToolbox::computeExpiration( ( $pre_expiration + 1 ), 'D', time() );
		} else {
			// No pre-expiration actions found, limiting search to all users who expire until tomorrow (just to be safe)
			$pre_expiration		= false;
			$expiration_limit	= AECToolbox::computeExpiration( 1, 'D', time() );
		}

		// Select all the users that are Active and have an expiration date
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `expiration` <= \'' . $expiration_limit . '\''
				. ' AND `status` != \'Expired\''
				. ' AND `status` != \'Closed\''
				. ' AND `status` != \'Excluded\''
				. ' ORDER BY `expiration`'
				;
		$database->setQuery( $query );
		$subscription_list = $database->loadResultArray();

		$expired_users		= array();
		$pre_expired_users	= array();
		$found_expired		= 1;
		$e					= 0;
		$pe					= 0;
		$exp_actions		= 0;
		$exp_users			= 0;
		$pps				= array();

		// Efficient way to check for expired users without checking on each one
		if ( !empty( $subscription_list ) ) {
			foreach ( $subscription_list as $sub_id ) {
				$subscription = new Subscription($database);
				$subscription->load( $sub_id );

				$query = 'SELECT `username`'
						. ' FROM #__users'
						. ' WHERE `id` = \'' . $subscription->userid . '\''
						;
				$database->setQuery( $query );
				$username = $database->loadResult();

				if ( empty( $username ) ) {
					continue;
				}

				if ( $found_expired ) {
					// Check whether this user really is expired
					// If this check fails, this user and all following users will be put into pre expiration check
					$found_expired = $subscription->is_expired();

					if ( $found_expired ) {
						// We may need to carry out processor functions
						if ( !isset( $pps[$subscription->type] ) ) {
							// Load payment processor into overall array
							$pps[$subscription->type] = new PaymentProcessor();
							if ( $pps[$subscription->type]->loadName( $subscription->type ) ) {
								$pps[$subscription->type]->init();

								// Load prepare validation function
								$prepval = $pps[$subscription->type]->prepareValidation( $subscription_list );
								if ( $prepval === null ) {
									// This Processor has no such function, set to false to ignore later calls
									$pps[$subscription->type] = false;
								} elseif ( $prepval === false ) {
									// Break - we have a problem with one processor
									$eventlog = new eventLog( $database );
									$eventlog->issue( 'heartbeat failed - processor', 'heartbeat, failure,'.$subscription->type, 'The payment processor failed to respond to validation request - waiting for next turn', 128 );
									return;
								}
							} else {
								// Processor does not exist
								$pps[$subscription->type] = false;
							}
						}

						// Carry out validation if possible
						if ( !empty( $pps[$subscription->type] ) ) {
							$validation = $pps[$subscription->type]->validateSubscription( $sub_id, $subscription_list );
						} else {
							$validation = false;
						}

						// Validation failed or was not possible for this processor - expire
						if ( empty( $validation ) ) {
							if ( $subscription->expire() ) {
								$e++;
							}
						}
					} elseif( $subscription->is_lifetime() ) {
						$found_expired = 1;
					}
				}

				// If we have found all expired users, put all others into pre expiration
				if ( !$found_expired && !in_array( $subscription->id, $pre_expired_users ) ) {
					if ( $pre_expiration ) {
						$pre_expired_users[] = $subscription->id;
					}
				}
			}

			// Only go for pre expiration action if we have at least one user for it
			if ( $pre_expiration && !empty( $pre_expired_users ) ) {
				// Get all the MIs which have a pre expiration check
				$query = 'SELECT `id`'
						. ' FROM #__acctexp_microintegrations'
						. ' WHERE `pre_exp_check` > 0'
						;
				$database->setQuery( $query );
				$mi_pexp = $database->loadResultArray();

				// Get all the plans which have MIs
				$query = 'SELECT `id`'
						. ' FROM #__acctexp_plans'
						. ' WHERE `micro_integrations` IS NOT NULL'
						;
				$database->setQuery( $query );
				$plans_mi = $database->loadResultArray();

				// Filter out plans which have not got the right MIs applied
				$expmi_plans = array();
				foreach ( $plans_mi as $plan_id ) {
					$query = 'SELECT `micro_integrations`'
							. ' FROM #__acctexp_plans'
							. ' WHERE `id` = \'' . $plan_id . '\''
							;
					$database->setQuery( $query );
					$plan_mis = unserialize( base64_decode( $database->loadResult() ) );

					if ( is_array( $plan_mis ) && !empty( $plan_mis ) ) {
						$pexp_mis = array_intersect( $plan_mis, $mi_pexp );

						if ( count( $pexp_mis ) ) {
							$expmi_plans[] = $plan_id;
						}
					}
				}

				// Filter out the users which dont have the correct plan
				$query = 'SELECT `id`, `userid`'
						. ' FROM #__acctexp_subscr'
						. ' WHERE `id` IN (' . implode( ',', $pre_expired_users ) . ')'
						. ' AND `plan` IN (' . implode( ',', $expmi_plans) . ')'
						;
				$database->setQuery( $query );
				$sub_list = $database->loadObjectList();

				if ( !empty( $sub_list ) ) {
					foreach ( $sub_list as $sl ) {
						$metaUser = new metaUser( $sl->userid );
						$metaUser->moveFocus( $sl->id );

						// Two double checks here, just to be sure
						if ( !( strcmp( $metaUser->focusSubscription->status, 'Expired' ) === 0 ) && !$metaUser->focusSubscription->recurring ) {
							if ( in_array( $metaUser->focusSubscription->plan, $expmi_plans ) ) {
								// Its ok - load the plan
								$subscription_plan = new SubscriptionPlan( $database );
								$subscription_plan->load( $metaUser->focusSubscription->plan );
								$userplan_mis = $subscription_plan->micro_integrations;

								// Double check whether we have the MIs
								if ( empty( $userplan_mis ) ) {
									continue;
								}

								// Get the right MIs
								$user_pexpmis = array_intersect( $userplan_mis, $mi_pexp );

								// loop through MIs and apply pre exp action
								$check_actions = $exp_actions;

								foreach ( $user_pexpmis as $mi_id ) {
									$mi = new microIntegration( $database );
									$mi->load( $mi_id );

									if ( $mi->callIntegration() ) {
										// Do the actual pre expiration check on this MI
										if ( $metaUser->focusSubscription->is_expired( $mi->pre_exp_check ) ) {
											$result = $mi->pre_expiration_action( $metaUser, $subscription_plan );
											if ( $result ) {
												$exp_actions++;
											}
										}
									}
								}

								if ( $exp_actions > $check_actions ) {
									$exp_users++;
								}
							}
						}
					}
				}
			}
		}

		aecEventHandler::pingEvents();

		$short	= _AEC_LOG_SH_HEARTBEAT;
		$event	= _AEC_LOG_LO_HEARTBEAT . ' ';
		$tags	= array( 'heartbeat' );

		if ( $e ) {
			if ( $e > 1 ) {
				$event .= 'Expires ' . $e . ' users';
			} else {
				$event .= 'Expires 1 user';
			}
			$tags[] = 'expiration';
			if ( $exp_actions ) {
				$event .= ', ';
			}
		}
		if ( $exp_actions ) {
			$event .= $exp_actions . ' Pre-expiration action';
			$event .= ( $exp_actions > 1 ) ? 's' : '';
			$event .= ' for ' . $exp_users . ' user';
			$event .= ( $exp_users > 1 ) ? 's' : '';
			$tags[] = 'pre-expiration';
		}

		if ( strcmp( _AEC_LOG_LO_HEARTBEAT . ' ', $event ) === 0 ) {
			$event .= _AEC_LOG_AD_HEARTBEAT_DO_NOTHING;
		}

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, implode( ',', $tags ), $event, 2 );

	}

}

class displayPipelineHandler
{
	function displayPipelineHandler()
	{

	}

	function getUserPipelineEvents( $userid )
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		// Entries for this user only
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_displaypipeline'
				. ' WHERE `userid` = \'' . $userid . '\' AND `only_user` = \'1\''
				;
		$database->setQuery( $query );
		$events = $database->loadResultArray();

		// Entries for all users
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_displaypipeline'
				. ' WHERE `only_user` = \'0\''
				;
		$database->setQuery( $query );
		$events = array_merge( $events, $database->loadResultArray() );

		$return = '';
		if ( empty( $events ) ) {
			return $return;
		}

		foreach ( $events as $eventid ) {
			$displayPipeline = new displayPipeline( $database );
			$displayPipeline->load( $eventid );
			if ( $displayPipeline->id ) {

				// If expire & expired -> delete
				if ( $displayPipeline->expire ) {
					$expstamp = strtotime( $displayPipeline->expstamp );
					if ( ( $expstamp - ( time() + $mainframe->getCfg( 'offset' )*3600 ) ) < 0 ) {
						$displayPipeline->delete();
						continue;
					}
				}

				// If displaymax exceeded -> delete
				$displayremain = $displayPipeline->displaymax - $displayPipeline->displaycount;
				if ( $displayremain <= 0 ) {
					$displayPipeline->delete();
					continue;
				}

				// If this can only be displayed once per user, prevent it from being displayed again
				if ( $displayPipeline->once_per_user ) {
					$params = $displayPipeline->params;

					if ( isset( $displayPipeline->params['displayedto'] ) ) {
						$users = $displayPipeline->params['displayedto'];
						if ( in_array( $userid, $users ) ) {
							continue;
						} else {
							$users[] = $userid;
							$displayPipeline->params['displayedto'] = $users;
						}
					}
				}

				// Ok, now append text
				$return .= stripslashes( $displayPipeline->displaytext );

				// Update display if at least one display would remain
				if ( $displayremain > 1 ) {
					$displayPipeline->displaycount = $displayPipeline->displaycount + 1;
					$displayPipeline->check();
					$displayPipeline->store();
				} else {
					$displayPipeline->delete();
				}
			}
		}

		// Return the string
		return $return;
	}
}

class displayPipeline extends serialParamDBTable
{
	/** @var int Primary key */
	var $id				= null;
	/** @var int */
	var $userid			= null;
	/** @var int */
	var $only_user		= null;
	/** @var int */
	var $once_per_user	= null;
	/** @var datetime */
	var $timestamp		= null;
	/** @var int */
	var $expire			= null;
	/** @var datetime */
	var $expstamp 		= null;
	/** @var int */
	var $displaycount	= null;
	/** @var int */
	var $displaymax		= null;
	/** @var text */
	var $displaytext	= null;
	/** @var text */
	var $params			= null;

	/**
	 * @param database A database connector object
	 */
	function displayPipeline( &$db )
	{
	 	parent::__construct( '#__acctexp_displaypipeline', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'params' );
	}

	function create( $userid, $only_user, $once_per_user, $expire, $expiration, $displaymax, $displaytext, $params=null )
	{
		global $mainframe;

		$this->id				= 0;
		$this->userid			= $userid;
		$this->only_user		= $only_user;
		$this->once_per_user	= $once_per_user;
		$this->timestamp		= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->expire			= $expire ? 1 : 0;
		if ( $expire ) {
			$this->expstamp			= date( 'Y-m-d H:i:s', strtotime( $expiration ) + $mainframe->getCfg( 'offset' ) *3600 );
		}
		$this->displaycount		= 0;
		$this->displaymax		= $displaymax;

		if ( !get_magic_quotes_gpc() ) {
			$this->displaytext	= addslashes( $displaytext );
		} else {
			$this->displaytext	= $displaytext;
		}

		if ( is_array( $params ) ) {
			$this->params = $params;
		}

		$this->check();

		if ( $this->store() ) {
			return true;
		} else {
			return false;
		}
	}
}

class eventLog extends serialParamDBTable
{
	/** @var int Primary key */
	var $id			= null;
	/** @var datetime */
	var $datetime	= null;
	/** @var string */
	var $short 		= null;
	/** @var text */
	var $tags 		= null;
	/** @var text */
	var $event 		= null;
	/** @var int */
	var $level		= null;
	/** @var int */
	var $notify		= null;
	/** @var text */
	var $params		= null;

	/**
	 * @param database A database connector object
	 */
	function eventLog( &$db )
	{
	 	parent::__construct( '#__acctexp_eventlog', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'params' );
	}

	function issue( $short, $tags, $text, $level = 2, $params = null, $force_notify = 0, $force_email = 0 )
	{
		global $mainframe, $aecConfig;

		$legal_levels = array( 2, 8, 32, 128 );

		if ( !in_array( (int) $level, $legal_levels ) ) {
			$level = $legal_levels[0];
		}

		$this->datetime	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->short	= $short;
		$this->tags		= $tags;
		$this->event	= $text;
		$this->level	= (int) $level;

		// Create a notification link if this matches the desired level
		if ( $this->level >= $aecConfig->cfg['error_notification_level'] ) {
			$this->notify	= 1;
		} else {
			$this->notify	= $force_notify ? 1 : 0;
		}

		// Mail out notification to all admins if this matches the desired level
		if ( ( $this->level >= $aecConfig->cfg['email_notification_level'] ) || $force_email ) {
			$database = &JFactory::getDBO();

			// check if Global Config `mailfrom` and `fromname` values exist
			if ( $mainframe->getCfg( 'mailfrom' ) != '' && $mainframe->getCfg( 'fromname' ) != '' ) {
				$adminName2 	= $mainframe->getCfg( 'fromname' );
				$adminEmail2 	= $mainframe->getCfg( 'mailfrom' );
			} else {
				// use email address and name of first superadmin for use in email sent to user
				$query = 'SELECT `name`, `email`'
						. ' FROM #__users'
						. ' WHERE LOWER( usertype ) = \'superadministrator\''
						. ' OR LOWER( usertype ) = \'super administrator\''
						;
				$database->setQuery( $query );
				$rows = $database->loadObjectList();

				$adminName2 	= $rows[0]->name;
				$adminEmail2 	= $rows[0]->email;
			}

			if ( !defined( "_AEC_NOTICE_NUMBER_" . $this->level ) ) {
				$langPath = JPATH_SITE . '/administrator/components/com_acctexp/lang/';
				if ( file_exists( $langPath . $GLOBALS['mosConfig_lang'] . '.php' ) ) {
					include_once( $langPath . $GLOBALS['mosConfig_lang'] . '.php' );
				} else {
					include_once( $langPath. 'english.php' );
				}
			}

			// Send notification to all administrators
			$subject2	= sprintf( _AEC_ASEND_NOTICE, constant( "_AEC_NOTICE_NUMBER_" . $this->level ), $this->short, $mainframe->getCfg( 'sitename' ) );
			$message2	= sprintf( _AEC_ASEND_NOTICE_MSG, $this->event  );

			$subject2	= html_entity_decode( $subject2, ENT_QUOTES );
			$message2	= html_entity_decode( $message2, ENT_QUOTES );

			// get email addresses of all admins and superadmins set to recieve system emails
			$query = 'SELECT `email`'
					. ' FROM #__users'
					. ' WHERE ( `gid` = 24 OR `gid` = 25 )'
					. ' AND `sendEmail` = 1'
					. ' AND `block` = 0'
					;
			$database->setQuery( $query );
			$admins = $database->loadObjectList();

			foreach ( $admins as $admin ) {
				// send email to admin & super admin set to recieve system emails
				if ( aecJoomla15check() ) {
					JUTility::sendMail( $adminEmail2, $adminEmail2, $admin->email, $subject2, $message2 );
				} else {
					mosMail( $adminEmail2, $adminName2, $admin->email, $subject2, $message2 );
				}
			}
		}

		if ( !empty( $params ) && is_array( $params ) ) {
			$this->params = $params;
		}

		$this->check();
		$this->store();
	}

}

class aecEventHandler
{
	function pingEvents()
	{
		$database = &JFactory::getDBO();

		// Load all events happening now or before now
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_event'
				. ' WHERE `due_date` <= \'' . date( 'Y-m-d H:i:s' ) . '\''
	 			. ' AND `status` = \'waiting\''
				;
		$database->setQuery( $query );
		$events = $database->loadResultArray();

		// Call each event individually
		foreach ( $events as $evid ) {
			$event = new aecEvent( $database );
			$event->load( $evid );
			$event->trigger();
		}
	}

	// TODO: Finish function that, according to setting, cleans out old entries (like more than two weeks old default)
	function deleteOldEvents()
	{
		$database = &JFactory::getDBO();

		// Load all events happening now or before now
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_event'
				. ' WHERE `due_date` <= \'' . date( 'Y-m-d H:i:s' ) . '\''
	 			. ' AND `status` = \'waiting\''
				;
		$database->setQuery( $query );
		$events = $database->loadResultArray();

		// Call each event individually
		foreach ( $events as $evid ) {
			$event = new aecEvent( $database );
			$event->load( $evid );
			$event->trigger();
		}
	}
}

class aecEvent extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $userid				= null;
	/** @var int */
	var $status				= null;
	/** @var string */
	var $type		 		= null;
	/** @var string */
	var $subtype	 		= null;
	/** @var int */
	var $appid				= null;
	/** @var string */
	var $event		 		= null;
	/** @var datetime */
	var $created_date		= null;
	/** @var datetime */
	var $due_date			= null;
	/** @var text */
	var $context 			= array();
	/** @var text */
	var $params 			= array();
	/** @var text */
	var $customparams		= array();

	/**
	* @param database A database connector object
	*/
	function aecEvent( &$db )
	{
		parent::__construct( '#__acctexp_event', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'context', 'params', 'customparams' );
	}

	function issue( $type, $subtype, $appid, $event, $userid, $due_date, $context=array(), $params=array(), $customparams=array() )
	{
		global $mainframe;

		$this->userid			= $userid;
		$this->status			= 'waiting';

		$this->type				= $type;
		$this->subtype			= $subtype;
		$this->appid			= $appid;
		$this->event			= $event;
		$this->created_date 	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );;
		$this->due_date 		= $due_date;

		$this->context			= $context;
		$this->params			= $params;
		$this->customparams		= $customparams;

		$this->storeload();

		return $this->id;
	}

	function trigger()
	{
		$database = &JFactory::getDBO();

		if ( empty( $this->type ) ) {
			return null;
		}

		if ( empty( $this->event ) ) {
			return null;
		}

		$obj = null;

		switch ( $this->type ) {
			case 'mi':
				$obj = new microIntegration( $database );
				$obj->load( $this->appid );
				break;
		}

		if ( !empty( $obj ) ) {
			$return = $obj->aecEventHook( $this );

			if ( !is_array( $return ) ) {
				$this->status = 'done';
			} else {
				if ( isset( $return['reset_due_date'] ) ) {
					$this->status	= 'waiting';
					$this->due_date	= $return['reset_due_date'];
				}
			}

			return $this->storeload();
		}
	}
}

class PaymentProcessorHandler
{

	function PaymentProcessorHandler()
	{
		$this->pp_dir = JPATH_SITE . '/components/com_acctexp/processors';
	}

	function getProcessorList()
	{
		$list = AECToolbox::getFileArray( $this->pp_dir, 'php', false, true );

		$pp_list = array();
		foreach ( $list as $name ) {
			$parts		= explode( '.', $name );
			$pp_list[] = $parts[0];
		}

		return $pp_list;
	}

	function getProcessorIdfromName( $name )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_config_processors'
				. ' WHERE `name` = \'' . $database->getEscaped( $name ) . '\'';
		$database->setQuery( $query );

		return $database->loadResult();
	}

	function getProcessorNamefromId( $id )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `name`'
				. ' FROM #__acctexp_config_processors'
				. ' WHERE `id` = \'' . $database->getEscaped( $id ) . '\'';
		$database->setQuery( $query );

		return $database->loadResult();
	}

	function getProcessorNameListbyId( $idlist )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`, `name`'
				. ' FROM #__acctexp_config_processors';
		$database->setQuery( $query );
		$res = $database->loadObjectList();

		$return = array();
		foreach ( $res as $pobj ) {
			if ( in_array( $pobj->id, $idlist ) || in_array( $pobj->id.'_recurring', $idlist ) ) {
				$return[$pobj->id] = $pobj->name;
			}
		}

		return $return;
	}

	/**
	 * gets installed and active processors
	 *
	 * @param bool	$active		get only active objects
	 * @return array of (active) payment processors
	 */
	function getInstalledObjectList( $active = false, $simple = false )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `name`' . ( $simple ? '' : ', `active`, `id`' )
				. ' FROM #__acctexp_config_processors'
				;
		if ( $active ) {
			$query .= ' WHERE `active` = \'1\'';
		}
		$database->setQuery( $query );

		if ( $simple ) {
			return $database->loadResultArray();
		} else {
			return $database->loadObjectList();
		}
	}

	function getInstalledNameList($active=false)
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `name`'
				. ' FROM #__acctexp_config_processors'
				;
		if ( $active !== false ) {
			$query .= ' WHERE `active` = \'' . $active . '\'';
		}
		$database->setQuery( $query );

		return $database->loadResultArray();
	}

	function getObjectList( $array, $getinfo=false, $getsettings=false )
	{
		$excluded = array( 'free', 'none', 'transfer' );

		$list = array();
		foreach ( $array as $ppname ) {
			if ( empty( $ppname ) || in_array( $ppname, $excluded ) ) {
				continue;
			}

			$pp = new PaymentProcessor();

			if ( $pp->loadName( $ppname ) ) {
				$pp->init();

				if ( $getinfo ) {
					$pp->getInfo();
				}

				if ( $getsettings ) {
					$pp->getSettings();
				}
			}

			$list[$ppname] = $pp;
		}

		return $list;
	}
}

class PaymentProcessor
{
	/** var object **/
	var $pph = null;
	/** var int **/
	var $id = null;
	/** var string **/
	var $processor_name = null;
	/** var object **/
	var $processor = null;
	/** var array **/
	var $settings = null;
	/** var array **/
	var $info = null;

	function PaymentProcessor()
	{
		// Init Payment Processor Handler
		$this->pph = new PaymentProcessorHandler ();
	}

	function loadName( $name )
	{
		$database = &JFactory::getDBO();

		// Set Name
		$this->processor_name = strtolower( $name );

		$res = null;

		// See if the processor is installed & set id
		$query = 'SELECT id, active'
				. ' FROM #__acctexp_config_processors'
				. ' WHERE `name` = \'' . $this->processor_name . '\''
				;
		$database->setQuery( $query );
		if ( aecJoomla15check() ) {
			$res = $database->loadObject();
		} else {
			$database->loadObject($res);
		}

		if ( !empty( $res ) && is_object( $res ) ) {
			$this->id = $res->id ? $res->id : 0;
		}

		$file = $this->pph->pp_dir . '/' . $this->processor_name . '.php';

		// Check whether processor exists
		if ( file_exists( $file ) ) {
			if ( !defined( '_AEC_LANG_PROCESSOR' ) ) {
				$langPath = $this->pph->pp_dir . '/lang/';
				// Include language files for processors
				if ( file_exists( $langPath . $GLOBALS['mosConfig_lang'] . '.php' ) ) {
					include_once( $langPath . $GLOBALS['mosConfig_lang'] . '.php' );
				} else {
					include_once( $langPath . 'english.php' );
				}
			}

			// Call Integration file
			include_once $this->pph->pp_dir . '/' . $this->processor_name . '.php';

			// Initiate Payment Processor Class
			$class_name = 'processor_' . $this->processor_name;
			$this->processor = new $class_name( $database );
			$this->processor->id = $this->id;

			if ( is_object( $res ) ) {
				$this->processor->active = $res->active;
			} else {
				$this->processor->active = 0;
			}

			return true;
		} else {
			return false;
		}
	}

	function getNameById( $ppid )
	{
		$database = &JFactory::getDBO();

		// Fetch name from db and load processor
		$query = 'SELECT `name`'
				. ' FROM #__acctexp_config_processors'
				. ' WHERE `id` = \'' . $ppid . '\''
				;
		$database->setQuery( $query );
		$name = $database->loadResult();

		if ( $name ) {
			return $name;
		} else {
			return false;
		}
	}

	function loadId( $ppid )
	{
		$name = $this->getNameById( $ppid );

		if ( $name ) {
			return $this->loadName( $name );
		} else {
			return false;
		}
	}

	function fullInit()
	{
		if ( $this->init() ) {
			$this->getInfo();
			$this->getSettings();

			return true;
		} else {
			return false;
		}
	}

	function init()
	{
		if ( !$this->id ) {
			// Install and recurse
			$this->install();
			$this->init();
		} else {
			// Initiate processor from db
			if ( is_object( $this->processor ) ) {
				return $this->processor->load( $this->id );
			} else {
				return false;
			}
		}
	}

	function install()
	{
		$database = &JFactory::getDBO();

		// Create new db entry
		$this->processor->load( 0 );

		// Call default values for Info and Settings
		$this->getInfo();
		$this->getSettings();

		// Set name and activate
		$this->processor->name		= $this->processor_name;
		$this->processor->active	= 1;

		// Set values from defaults and store
		$this->processor->info = $this->info;
		$this->processor->settings = $this->settings;
		$this->processor->storeload();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_config_processors'
				. ' WHERE `name` = \'' . $database->getEscaped( $this->processor_name ) . '\''
				;
		$database->setQuery( $query );
		$result = $database->loadResult();

		$this->id = $result ? $result : 0;
	}

	function getInfo()
	{
		if ( !is_object( $this->processor ) ) {
			return false;
		}

		$this->info	=& $this->processor->info;
		$original	= $this->processor->info();

		foreach ( $original as $name => $var ) {
			if ( !isset( $this->info[$name] ) ) {
				$this->info[$name] = $var;
			}
		}
	}

	function getSettings()
	{
		if ( !is_object( $this->processor ) ) {
			return false;
		}

		$this->settings	=& $this->processor->settings;
		$original		= $this->processor->settings();

		if ( !is_array( $this->settings ) ) {
			$this->settings = $original;
		}

		if ( !isset( $this->settings['recurring'] ) && is_int( $this->is_recurring() ) ) {
			$original['recurring'] = 1;
		}

		foreach ( $original as $name => $var ) {
			if ( !isset( $this->settings[$name] ) ) {
				$this->settings[$name] = $var;
			}
		}
	}

	function exchangeSettings( $exchange )
	{
		 if ( !empty( $exchange ) ) {
			 foreach ( $exchange as $key => $value ) {
				if( is_string( $value ) ) {
					if ( strcmp( $value, '[[SET_TO_NULL]]' ) === 0 ) {
						// Exception for NULL case
						$this->settings[$key] = null;
					} else {
						if ( !empty( $value ) ) {
							$this->settings[$key] = $value;
						}
					}
				} else {
					$this->settings[$key] = $value;
				}
			 }
		 }
	}

	function setSettings()
	{
		$this->processor->storeload();
	}

	function exchangeSettingsByPlan( $plan, $plan_params=null )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( empty( $plan_params ) ) {
			$plan_params = $plan->getProcessorParameters( $this->id );
		}

		if ( isset( $plan_params['aec_overwrite_settings'] ) ) {
			unset( $plan_params['aec_overwrite_settings'] );
		}

		$this->exchangeSettings( $plan_params );
	}

	function is_recurring( $choice=null, $test=false )
	{
		// Warning: Here be Voodoo

		if ( isset( $this->is_recurring ) && !$test ) {
			return $this->is_recurring;
		}

		// Check for bogus choice
		if ( empty( $choice ) && ( $choice !== 0 ) && ( $choice !== '0' ) ) {
			$choice = null;
		}

		$return = false;

		// Load Info if not loaded yet
		if ( !isset( $this->info ) ) {
			$this->getInfo();
		}

		if ( !isset( $this->info['recurring'] ) ) {
			// Keep false
		} elseif ( $this->info['recurring'] > 1 ) {
			if ( empty( $this->settings ) ) {
				$this->getSettings();
			}

			// If recurring = 2, the processor can
			// set this property on a per-plan basis
			if ( isset( $this->settings['recurring'] ) ) {
				$return = (int) $this->settings['recurring'];
			} else {
				$return = (int) $this->info['recurring'];
			}

			if ( ( !is_null( $choice ) ) && ( $return > 1 ) ) {
				$return = (int) $choice;
			}
		} elseif ( !empty( $this->info['recurring'] ) ) {
			$return = true;
		}

		$this->is_recurring = $return;

		return $return;
	}

	function setInfo()
	{
		$this->processor->storeload();
	}

	function storeload()
	{
		if ( $this->id ) {
			$this->processor->storeload();
		} else {
			$this->id = $this->getMax();
			$this->processor->storeload();
		}
	}

	function getBackendSettings()
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( $this->info['recurring'] == 2 ) {
			$settings = array_merge( array( 'recurring' => array( 'list_recurring' ) ), $this->processor->backend_settings() );
		} else {
			$settings = $this->processor->backend_settings();
		}

		$settings['generic_buttons']	= array( 'list_yesno' );

		if ( isset( $settings['aec_experimental'] ) ) {
			$settings['aec_experimental'] = "p";
			$this->settings['aec_experimental'] = '<div class="aec_processor_experimentalnote"><h1>' . _PP_GENERAL_PLEASE_NOTE . '</h1><p>' . _PP_GENERAL_EXPERIMENTAL . '</p></div>';
		}

		if ( !isset( $this->info ) ) {
			$this->getInfo();
		}

		if ( !empty( $this->info['cc_list'] ) ) {
			$settings['cc_icons']			= array( 'list' );

			$cc_array = explode( ',', $this->info['cc_list'] );

			if ( isset( $this->settings['cc_icons'] ) ) {
				$set = $this->settings['cc_icons'];
			} else {
				$set = $cc_array;
			}

			$cc = array();
			$ccs = array();
			foreach ( $cc_array as $ccname ) {
				$cc[] = mosHTML::makeOption( $ccname, $ccname );

				if ( in_array( $ccname, $set ) ) {
					$ccs[] = mosHTML::makeOption( $ccname, $ccname );
				}
			}

			$settings['lists']['cc_icons'] = mosHTML::selectList( $cc, $this->processor_name.'_cc_icons[]', 'size="4" multiple="multiple"', 'value', 'text', $ccs );
		}

		return $settings;
	}

	function checkoutAction( $int_var=null, $metaUser=null, $plan=null, $invoice=null, $cart=null )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( isset( $int_var['planparams']['aec_overwrite_settings'] ) ) {
			if ( !empty( $int_var['planparams']['aec_overwrite_settings'] ) ) {
				$this->exchangeSettingsByPlan( null, $int_var['planparams'] );
			}
		}

		if ( empty( $plan ) && !empty( $cart ) ) {
			$plan = aecCartHelper::getFirstCartItemObject( $cart );
		}

		$request = new stdClass();
		$request->parent			=& $this;
		$request->int_var			=& $int_var;
		$request->metaUser			=& $metaUser;
		$request->plan				=& $plan;
		$request->invoice			=& $invoice;
		$request->cart				=& $cart;

		return $this->processor->checkoutAction( $request );
	}

	function checkoutProcess( $int_var=null, $metaUser=null, $plan=null, $invoice=null, $cart=null )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( isset( $int_var['planparams']['aec_overwrite_settings'] ) ) {
			if ( !empty( $int_var['planparams']['aec_overwrite_settings'] ) ) {
				$this->exchangeSettingsByPlan( null, $int_var['planparams'] );
			}
		}

		if ( empty( $plan ) && !empty( $cart ) ) {
			$plan = aecCartHelper::getFirstCartItemObject( $cart );
		}

		$request = new stdClass();
		$request->parent			=& $this;
		$request->int_var			=& $int_var;
		$request->metaUser			=& $metaUser;
		$request->plan				=& $plan;
		$request->invoice			=& $invoice;
		$request->cart				=& $cart;

		return $this->processor->checkoutProcess( $request );
	}

	function customAction( $action, $invoice, $metaUser )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		$method = 'customaction_' . $action;

		if ( method_exists( $this->processor, $method ) ) {
			$request = new stdClass();
			$request->parent			=& $this;
			$request->metaUser			=& $metaUser;
			$request->invoice			=& $invoice;
			$request->plan				=& $invoice->getObjUsage();

			return $this->processor->$method( $request );
		} else {
			return false;
		}
	}

	function customProfileTab( $action, $metaUser )
	{
		$s = $this->processor_name . '_';
		if ( strpos( $action, $s ) !== false ) {
			$action = str_replace( $s, '', $action );
		}

		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		$method = 'customtab_' . $action;

		if ( method_exists( $this->processor, $method ) ) {
			$database = &JFactory::getDBO();

			$request = new stdClass();
			$request->parent			=& $this;
			$request->metaUser			=& $metaUser;

			$invoice = new Invoice( $database );
			$invoice->loadbySubscriptionId( $metaUser->objSubscription->id );

			$request->invoice			=& $invoice;


			return $this->processor->$method( $request );
		} else {
			return false;
		}
	}

	function getParamsHTML( $params, $values )
	{
		$return = false;
		if ( !empty( $values['params'] ) ) {
			if ( is_array( $values['params'] ) ) {
				if ( isset( $values['params']['lists'] ) ) {
					$lists = $values['params']['lists'];
					unset( $values['params']['lists'] );
				} else {
					$lists = null;
				}

				if ( count( $params['params'] ) > 2 ) {
					$table = 1;
					$return .= '<table>';
				} else {
					$table = 0;
				}

				foreach ( $values['params'] as $name => $entry ) {
					if ( !is_null( $name ) && !( $name == '' ) ) {
						$return .= aecHTML::createFormParticle( $name, $entry, $lists, $table ) . "\n";
					}
				}

				$return .= $table ? '</table>' : '';

				unset( $values['params'] );
			}
		}

		return $return;
	}

	function getParams( $params )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( method_exists( $this->processor, 'Params' ) ) {
			return $this->processor->Params( $params );
		} else {
			return false;
		}
	}

	function getCustomPlanParams()
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( $this->info['recurring'] == 2 ) {
			$settings = array_merge( array( 'recurring' => array( 'list_recurring' ) ), $this->processor->backend_settings() );
		} else {
			$settings = $this->processor->backend_settings();
		}

		$params = array();

		if ( $this->info['recurring'] == 2 ) {
			$params = array_merge( array( 'recurring' => array( 'list_recurring' ) ), $params );
		}

		if ( method_exists( $this->processor, 'CustomPlanParams' ) ) {
			$params = array_merge( $params, $this->processor->CustomPlanParams() );
		}

		if ( !empty( $params ) ) {
			return $params;
		} else {
			return false;
		}
	}

	function invoiceCreationAction( $objinvoice )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( method_exists( $this->processor, 'invoiceCreationAction' ) ) {
			$this->processor->invoiceCreationAction( $objinvoice );
		} else {
			return false;
		}
	}

	function parseNotification( $post )
	{
		$database = &JFactory::getDBO();

		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		$return = $this->processor->parseNotification( $post );

		// Check whether this is an ad-hoc notification
		if ( !empty( $return['_aec_createuser'] ) && empty( $return['invoice'] ) ) {
			// Identify usage
			$usage = 1;

			// Create new user account and fetch id
			$userid = AECToolbox::saveUserRegistration( 'com_acctexp', $return['_aec_createuser'], true, true, false );

			// Create Invoice
			$invoice = new Invoice( $database );
			$invoice->create( $userid, $usage, $this->processor_name );
			$invoice->computeAmount();

			// Set new return variable - we now know what invoice this is
			$return['invoice'] = $invoice->invoice_number;
		}

		// Always amend secondary ident codes
		if ( !empty( $return['secondary_ident'] )&& !empty( $return['invoice'] ) ) {

			$invoice = new Invoice( $database );
			$invoice->loadInvoiceNumber( $return['invoice'] );
			$invoice->secondary_ident = $return['secondary_ident'];
			$invoice->storeload();
		}

		if ( !empty( $return['_aec_createuser'] ) ) {
			unset( $return['_aec_createuser'] );
		}

		return $return;
	}

	function notificationError( $response, $error )
	{
		if ( method_exists( $this->processor, 'notificationError' ) ) {
			$this->processor->notificationError( $response, $error );
		}
	}

	function notificationSuccess( $response )
	{
		if ( method_exists( $this->processor, 'notificationSuccess' ) ) {
			$this->processor->notificationSuccess( $response );
		}
	}

	function validateNotification( $response, $post, $invoice )
	{
		if ( method_exists( $this->processor, 'validateNotification' ) ) {
			$response = $this->processor->validateNotification( $response, $post, $invoice );
		}

		return $response;
	}

	function instantvalidateNotification( $response, $post, $invoice )
	{
		if ( method_exists( $this->processor, 'instantvalidateNotification' ) ) {
			$response = $this->processor->instantvalidateNotification( $response, $post, $invoice );
		}

		return $response;
	}

	function prepareValidation( $subscription_list )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( method_exists( $this->processor, 'prepareValidation' ) ) {
			$response = $this->processor->prepareValidation( $subscription_list );
		} else {
			$response = null;
		}

		return $response;
	}

	function validateSubscription( $subscription_id )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		if ( method_exists( $this->processor, 'validateSubscription' ) ) {
			$response = $this->processor->validateSubscription( $subscription_id );
		} else {
			$response = false;
		}

		return $response;
	}

	function registerProfileTabs()
	{
		if ( method_exists( $this->processor, 'registerProfileTabs' ) ) {
			$response = $this->processor->registerProfileTabs();
		} else {
			$response = null;
		}

		return $response;
	}

	function getProfileTabs()
	{
		$addtabs = $this->registerProfileTabs();

		if ( empty( $addtabs ) ) {
			return array();
		}

		foreach ( $addtabs as $atk => $atv ) {
			$action = $this->processor_name . '_' . $atk;
			if ( isset( $tabs[$action] ) ) {
				continue;
			}

			$tabs[$action] = $atv;
		}

		return $tabs;
	}

	function getActions( $invoice, $subscription )
	{
		$actions = array();

		$actionarray = $this->processor->getActions( $invoice, $subscription );

		if ( !empty( $actionarray ) ) {
			foreach ( $actionarray as $action => $aoptions ) {
				$action = array( 'action' => $action, 'insert' => '' );

				if ( !empty( $aoptions ) ) {
					foreach ( $aoptions as $opt ) {
						switch ( $opt ) {
							case 'confirm':
								$action['insert'] .= ' onclick="return show_confirm(\'' . _AEC_YOUSURE . '\')" ';
								break;
							default:
								break;
						}
					}
				}
			}

			$actions[] = $action;
		}

		return $actions;
	}
}

class processor extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $name				= null;
	/** @var int */
	var $active				= null;
	/** @var text */
	var $info				= null;
	/** @var text */
	var $settings			= null;
	/** @var text */
	var $params				= null;

	/**
	* @param database A database connector object
	*/
	function processor( &$db )
	{
		parent::__construct( '#__acctexp_config_processors', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'info', 'settings', 'params' );
	}

	function loadName( $name )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_config_processors'
				. ' WHERE `name` = \'' . $database->getEscaped( $name ) . '\''
				;
		$database->setQuery( $query );
		$this->load( $database->loadResult() );
	}

	function createNew( $name, $info, $settings )
	{
		$this->id		= 0;
		$this->name		= $name;
		$this->active	= 1;
		$this->info		= $info;
		$this->settings	= $settings;

		$this->storeload();
	}

	function checkoutAction( $request )
	{
		return '<p>' . $this->settings['info'] . '</p>';
	}

	function exchangeSettings( $settings, $exchange )
	{
		 if ( !empty( $exchange ) ) {
			 foreach ( $exchange as $key => $value ) {
				if ( !is_null( $value ) && ( $value != '' ) ) {
					if( is_string( $value ) ) {
						if ( strcmp( $value, '[[SET_TO_NULL]]' ) === 0 ) {
							// Exception for NULL case
							$settings[$key] = null;
						} else {
							$settings[$key] = $value;
						}
					} else {
						$settings[$key] = $value;
					}
				}
			 }
		 }

		return $settings;
	}

	function getActions( $invoice, $subscription )
	{
		if ( !empty( $this->info['actions'] ) ) {
			return $this->info['actions'];
		} else {
			return array();
		}
	}

	function customParams( $custom, $var, $request )
	{
		if ( !empty( $custom ) ) {
			$rw_params = AECToolbox::rewriteEngineRQ( $custom, $request );

			$params = explode( "\n", $rw_params );

			foreach ( $params as $custom ) {
				$paramsarray = explode( '=', $custom, 2 );

				if ( !empty( $paramsarray[0] ) && isset( $paramsarray[1] ) ) {
					$var[$paramsarray[0]] = $paramsarray[1];
				}
			}
		}

		return $var;
	}

	function transmitRequest( $url, $path, $content, $port=443, $curlextra=null )
	{
		global $aecConfig;

		$response = null;

		if ( $aecConfig->cfg['curl_default'] ) {
			$response = $this->doTheCurl( $url, $content, $curlextra );
			if ( $response === false ) {
				// If curl doesn't work try using fsockopen
				$response = $this->doTheHttp( $url, $path, $content, $port );
			}
		} else {
			$response = $this->doTheHttp( $url, $path, $content, $port );
			if ( $response === false ) {
				// If fsockopen doesn't work try using curl
				$response = $this->doTheCurl( $url, $content, $curlextra );
			}
		}

		return $response;
	}

	function doTheHttp( $url, $path, $content, $port=443 )
	{
		global $aecConfig;

		if ( strpos( $url, '://' ) === false ) {
			if ( $port == 443 ) {
				$purl = 'https://' . $url;
			} else {
				$purl = 'http://' . $url;
			}
		} else {
			$purl = $url;
		}

		$url_info = parse_url( $purl );

				if ( empty( $url_info ) ) {
						return false;
				}

				switch ( $url_info['scheme'] ) {
						case 'https':
								$scheme = 'ssl://';
								$port = 443;
								break;
						case 'http':
						default:
								$scheme = '';
								$port = 80;
								break;
				}

		$url = $scheme . $url_info['host'];

		if ( !empty( $aecConfig->cfg['use_proxy'] ) && !empty( $aecConfig->cfg['proxy'] ) ) {
			if ( !empty( $aecConfig->cfg['proxy_port'] ) ) {
				$port = $aecConfig->cfg['proxy_port'];
			}

			$connection = fsockopen( $aecConfig->cfg['proxy'], $port, $errno, $errstr, 30 );
		} else {
			$connection = fsockopen( $url, $port, $errno, $errstr, 30 );
		}

		if ( $connection === false ) {
			$database = &JFactory::getDBO();

			if ( $errno == 0 ) {
				$errstr .= " This is usually an SSL error.  Check if your server supports fsocket open via SSL.";
			}

			$short	= 'fsockopen failure';
			$event	= 'Trying to establish connection with ' . $url . ' failed with Error #' . $errno . ' ( "' . $errstr . '" ) - will try cURL instead. If Error persists and cURL works, please permanently switch to using that!';
			$tags	= 'processor,payment,phperror';
			$params = array();

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 128, $params );

			return false;
		} else {
			$header  =	"Host: " . $url  . "\r\n"
						. "User-Agent: PHP Script\r\n"
						. "Content-Type: text/xml\r\n"
						. "Content-Length: " . strlen( $content ) . "\r\n\r\n"
						. "Connection: close\r\n\r\n";
						;

			fwrite( $connection, "POST " . $path . " HTTP/1.1\r\n" );
			fwrite( $connection, $header . $content );

			while ( !feof( $connection ) ) {
				$res = fgets( $connection, 1024 );
			}

			fclose( $connection );

			return $res;
		}
	}

	function doTheCurl( $url, $content, $curlextra=null )
	{
		global $aecConfig;

		if ( !function_exists( 'curl_init' ) ) {
			$response = false;

			$database = &JFactory::getDBO();
			$short	= 'cURL failure';
			$event	= 'Trying to establish connection with ' . $url . ' failed - curl_init is not available - will try fsockopen instead. If Error persists and fsockopen works, please permanently switch to using that!';
			$tags	= 'processor,payment,phperror';
			$params = array();

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 128, $params );
			return false;
		}

		if ( empty( $curlextra ) ) {
			$curlextra = array();
		}

		// Preparing cURL variables as array, to possibly overwrite them with custom settings by the processor
		$curl_calls = array();
		$curl_calls[CURLOPT_URL]			= $url;
		$curl_calls[CURLOPT_RETURNTRANSFER]	= true;
		$curl_calls[CURLOPT_HTTPHEADER]		= array( 'Content-Type: text/xml' );
		$curl_calls[CURLOPT_HEADER]			= false;
		$curl_calls[CURLOPT_POST]			= true;
		$curl_calls[CURLOPT_POSTFIELDS]		= $content;

		if ( !empty( $aecConfig->cfg['ssl_verifypeer'] ) ) {
			$curl_calls[CURLOPT_SSL_VERIFYPEER]	= $aecConfig->cfg['ssl_verifypeer'];
		} else {
			$curl_calls[CURLOPT_SSL_VERIFYPEER]	= false;
		}

		if ( !empty( $aecConfig->cfg['ssl_verifyhost'] ) ) {
			$curl_calls[CURLOPT_SSL_VERIFYHOST]	= $aecConfig->cfg['ssl_verifyhost'];
		} else {
			$curl_calls[CURLOPT_SSL_VERIFYHOST]	= false;
		}

		if ( !empty( $aecConfig->cfg['use_proxy'] ) && !empty( $aecConfig->cfg['proxy'] ) ) {
			$curl_calls[CURLOPT_HTTPPROXYTUNNEL]	= true;
			$curl_calls[CURLOPT_PROXY]				= $aecConfig->cfg['proxy'];

			if ( !empty( $aecConfig->cfg['proxy_port'] ) ) {
				$curl_calls[CURLOPT_PROXYPORT]		= $aecConfig->cfg['proxy_port'];
			}

			if ( !empty( $aecConfig->cfg['proxy_username'] ) && !empty( $aecConfig->cfg['proxy_password'] ) ) {
				$curl_calls[CURLOPT_PROXYUSERPWD]	= $aecConfig->cfg['proxy_username'].":".$aecConfig->cfg['proxy_password'];
			}
		}

		// Set or replace cURL params
		if ( !empty( $curlextra ) ) {
			foreach( $curlextra as $name => $value ) {
				if ( $value == '[[unset]]' ) {
					if ( isset( $curl_calls[$name] ) ) {
						unset( $curl_calls[$name] );
					}
				} else {
					$curl_calls[$name] = $value;
				}
			}
		}

		// Set cURL params
		$ch = curl_init();
		foreach ( $curl_calls as $name => $value ) {
			curl_setopt( $ch, $name, $value );
		}

		$response = curl_exec( $ch );

		if ( $response === false ) {
			$database = &JFactory::getDBO();

			$short	= 'cURL failure';
			$event	= 'Trying to establish connection with ' . $url . ' failed with Error #' . curl_errno( $ch ) . ' ( "' . curl_error( $ch ) . '" ) - will try fsockopen instead. If Error persists and fsockopen works, please permanently switch to using that!';
			$tags	= 'processor,payment,phperror';
			$params = array();

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 128, $params );
		}

		curl_close( $ch );

		return $response;
	}

}

class XMLprocessor extends processor
{
	function checkoutAction( $request )
	{
		$var = $this->checkoutform( $request );

		// TODO:  onclick="javascript:document.getElementById(\'aec_checkout_btn\').disabled=true"

		$return = '<form action="' . AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=checkout', $this->info['secure'] ) . '" method="post">' . "\n";
		$return .= $this->getParamsHTML( $var ) . '<br /><br />';
		$return .= '<input type="hidden" name="invoice" value="' . $request->int_var['invoice'] . '" />' . "\n";
		$return .= '<input type="hidden" name="userid" value="' . $request->metaUser->userid . '" />' . "\n";
		$return .= '<input type="hidden" name="task" value="checkout" />' . "\n";
		$return .= '<input type="submit" class="button" id="aec_checkout_btn" value="' . _BUTTON_CHECKOUT . '" /><br /><br />' . "\n";
		$return .= '</form>' . "\n";

		return $return;
	}

	function getParamsHTML( $params )
	{
		$return = '';
		if ( !empty( $params['params'] ) ) {
			if ( is_array( $params['params'] ) ) {
				if ( isset( $params['params']['lists'] ) ) {
					$lists = $params['params']['lists'];
					unset( $params['params']['lists'] );
				} else {
					$lists = null;
				}

				if ( count( $params['params'] ) > 2 ) {
					$table = 1;
					$return .= '<table id="aec_checkout_params">';
				} else {
					$table = 0;
				}

				foreach ( $params['params'] as $name => $entry ) {
					if ( !empty( $name ) || ( $name === 0 ) ) {
						$return .= aecHTML::createFormParticle( $name, $entry, $lists, $table ) . "\n";
					}
				}

				$return .= $table ? '</table>' : '';

				unset( $params['params'] );
			}
		}

		return $return;
	}

	function getMULTIPAYform( $var, $array )
	{
		global $mainframe;

		// Include Mootools tabber
		$mainframe->addCustomHeadTag( '<script type="text/javascript" src="' . JURI::root() . 'components/com_acctexp/lib/mootools/mootools.js"></script>' );
		$mainframe->addCustomHeadTag( '<script type="text/javascript" src="' . JURI::root() . 'components/com_acctexp/lib/mootools/mootabs.js"></script>' );
		$mainframe->addCustomHeadTag( '<script type="text/javascript" charset="utf-8">window.addEvent(\'domready\', init);function init() {myTabs1 = new mootabs(\'myTabs\');}</script>' );

		$nlist	= array();
		$prefix	= array();
		$main	= array();

		// We need to separate two blocks - prefix tabberstart generation and put the content inside
		$prefix[] = array( 'tabberstart', '', '', '' );
		$prefix[] = array( 'tabregisterstart', '', '', '' );

		foreach ( $array as $name => $content ) {
			$nu = strtoupper( $name );

			$fname = 'get'.$nu.'form';

			// Only allow to pass if std function exists
			if ( function_exists( 'XMLprocessor::'.$fname ) ) {
				$nl = strtolower( $name );

				// Register tab in prefix
				$prefix[] = array( 'tabregister', $nl.'details', constant( '_AEC_'.$nu.'FORM_TABNAME' ), true );

				// Actual tab code
				$main[] = array( 'tabstart', $nl.'details', true, '' );
				$main = $this->$fname( $main, $content['values'], $content['vcontent'] );
				$main[] = array( 'tabend', '', '', '' );
			}
		}

		$prefix[] = array( 'tabregisterend', '', '', '' );

		$var['params'] = array_merge( $var['params'], $prefix );
		$var['params'] = array_merge( $var['params'], $main );

		$var['params'][] = array( 'tabberend', '', '', '' );

		return $var;
	}

	function getCCform( $var=array(), $values=null, $content=null )
	{
		if ( empty( $values ) ) {
			$values = array( 'card_number', 'card_exp_month', 'card_exp_year' );
		}

		foreach ( $values as $value ) {
			if ( isset( $content[$value] ) ) {
				$vcontent = $content[$value];
			} else {
				$vcontent = '';
			}

			switch ( strtolower( $value ) ) {
				case 'card_type':
					$cctlist = array(	'visa' => 'Visa',
										'mastercard' => 'MasterCard',
										'discover' => 'Discover',
										'amex' => 'American Express'
										);

					$options = array();
					foreach ( $cctlist as $ccname => $cclongname ) {
						$options[] = mosHTML::makeOption( $ccname, $cclongname );
					}

					$var['params']['lists']['cardType'] = mosHTML::selectList( $options, 'cardType', 'size="1" style="width:120px;"', 'value', 'text', $vcontent );
					$var['params']['cardType'] = array( 'list', _AEC_CCFORM_CARDTYPE_NAME, $vcontent );
					break;
				case 'card_number':
					// Request the Card number
					$var['params']['cardNumber'] = array( 'inputC', _AEC_CCFORM_CARDNUMBER_NAME, _AEC_CCFORM_CARDNUMBER_DESC, $vcontent );
					break;
				case 'card_exp_month':
					// Create a selection box with 12 months
					$months = array();
					for( $i = 1; $i < 13; $i++ ){
						$month = str_pad( $i, 2, "0", STR_PAD_LEFT );
						$months[] = mosHTML::makeOption( $month, $month );
					}

					$var['params']['lists']['expirationMonth'] = mosHTML::selectList( $months, 'expirationMonth', 'size="1" style="width:50px;"', 'value', 'text', $vcontent );
					$var['params']['expirationMonth'] = array( 'list', _AEC_CCFORM_EXPIRATIONMONTH_NAME, _AEC_CCFORM_EXPIRATIONMONTH_DESC, $vcontent );
					break;
				case 'card_exp_year':
					// Create a selection box with the next 10 years
					$year = date('Y');
					$years = array();
					for( $i = $year; $i < $year + 15; $i++ ) {
						$years[] = mosHTML::makeOption( $i, $i );
					}

					$var['params']['lists']['expirationYear'] = mosHTML::selectList( $years, 'expirationYear', 'size="1" style="width:70px;"', 'value', 'text', $vcontent );
					$var['params']['expirationYear'] = array( 'list', _AEC_CCFORM_EXPIRATIONYEAR_NAME, _AEC_CCFORM_EXPIRATIONYEAR_DESC, $vcontent );
					break;
				case 'card_cvv2':
					$var['params']['cardVV2'] = array( 'inputC', _AEC_CCFORM_CARDVV2_NAME, _AEC_CCFORM_CARDVV2_DESC, $vcontent );
					break;
			}
		}

		return $var;
	}

	function getECHECKform( $var=array(), $values=null, $content=null )
	{
		if ( empty( $values ) ) {
			$values = array( 'routing_no', 'account_no', 'account_name', 'bank_name' );
		}

		foreach ( $values as $value ) {
			if ( isset( $content[$value] ) ) {
				$vcontent = $content[$value];
			} else {
				$vcontent = '';
			}

			switch ( strtolower( $value ) ) {
				case 'routing_no':
					$var['params']['routing_no'] = array( 'inputC', _AEC_ECHECKFORM_ROUTING_NO_NAME, _AEC_ECHECKFORM_ROUTING_NO_DESC, $vcontent );
					break;
				case 'account_no':
					$var['params']['account_no'] = array( 'inputC', _AEC_ECHECKFORM_ACCOUNT_NO_NAME, _AEC_ECHECKFORM_ACCOUNT_NO_DESC, $vcontent );
					break;
				case 'account_name':
					$var['params']['account_name'] = array( 'inputC', _AEC_ECHECKFORM_ACCOUNT_NAME_NAME, _AEC_ECHECKFORM_ACCOUNT_NAME_DESC, $vcontent );
					break;
				case 'bank_name':
					$var['params']['bank_name'] = array( 'inputC', _AEC_ECHECKFORM_BANK_NAME_NAME, _AEC_ECHECKFORM_BANK_NAME_DESC, $vcontent );
					break;
			}
		}

		return $var;
	}

	function getUserform( $var=array(), $values=null, $metaUser=null, $content=array() )
	{
		if ( empty( $values ) ) {
			$values = array( 'firstname', 'lastname' );
		}

		$name = array( '', '' );

		if ( is_object( $metaUser ) ) {
			if ( isset( $metaUser->cmsUser->name ) ) {
				$name = explode( ' ', $metaUser->cmsUser->name );

				if ( empty( $vcontent['firstname'] ) ) {
					$vcontent['firstname'] = $name[0];
				}

				if ( empty( $vcontent['lastname'] ) && isset( $name[1] ) ) {
					$vcontent['lastname'] = $name[1];
				}
			}
		}

		foreach ( $values as $value ) {
			if ( isset( $content[$value] ) ) {
				$vcontent = $content[$value];
			} else {
				$vcontent = '';
			}

			switch ( strtolower( $value ) ) {
				case 'firstname':
					$var['params']['billFirstName'] = array( 'inputC', _AEC_USERFORM_BILLFIRSTNAME_NAME, _AEC_USERFORM_BILLFIRSTNAME_NAME, $vcontent );
					break;
				case 'lastname':
					$var['params']['billLastName'] = array( 'inputC', _AEC_USERFORM_BILLLASTNAME_NAME, _AEC_USERFORM_BILLLASTNAME_NAME, $vcontent );
					break;
				case 'address':
					$var['params']['billAddress'] = array( 'inputC', _AEC_USERFORM_BILLADDRESS_NAME, _AEC_USERFORM_BILLCOMPANY_NAME, $vcontent );
					break;
				case 'address2':
					$var['params']['billAddress2'] = array( 'inputC', _AEC_USERFORM_BILLADDRESS2_NAME, _AEC_USERFORM_BILLADDRESS2_NAME, $vcontent );
					break;
				case 'city':
					$var['params']['billCity'] = array( 'inputC', _AEC_USERFORM_BILLCITY_NAME, _AEC_USERFORM_BILLCITY_NAME, $vcontent );
					break;
				case 'nonus':
					$var['params']['billNonUs'] = array( 'checkbox', _AEC_USERFORM_BILLNONUS_NAME, 1, $vcontent, _AEC_USERFORM_BILLNONUS_NAME );
					break;
				case 'state':
					$var['params']['billState'] = array( 'inputC', _AEC_USERFORM_BILLSTATE_NAME, _AEC_USERFORM_BILLSTATE_NAME, $vcontent );
					break;
				case 'state_us':
					$states = array( '', '--- United States ---', 'AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA', 'HI',
										'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME',
										'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ',
										'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD',
										'TN', 'TX', 'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY', 'AA',
										'AE', 'AP', 'AS', 'FM', 'GU', 'MH', 'MP', 'PR', 'PW', 'VI'
										);

					$statelist = array();
					foreach ( $states as $state ) {
						if ( strpos( $state, '---' ) !== false ) {
							$statelist[] = mosHTML::makeOption( '" disabled="disabled', $state );
						} else {
							$statelist[] = mosHTML::makeOption( $state, $state );
						}
					}

					$var['params']['lists']['billState'] = mosHTML::selectList( $statelist, 'billState', 'size="1"', 'value', 'text', $vcontent );
					$var['params']['billState'] = array( 'list', _AEC_USERFORM_BILLSTATE_NAME, $vcontent );
					break;
				case 'state_usca':
					$states = array( '', '--- United States ---', 'AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA', 'HI',
										'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME',
										'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ',
										'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD',
										'TN', 'TX', 'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY', 'AA',
										'AE', 'AP', 'AS', 'FM', 'GU', 'MH', 'MP', 'PR', 'PW', 'VI',
										'--- Canada ---','BC','MB','NB','NL','NT','NS','NU','ON','PE','QC','SK','YT'
										);

					$statelist = array();
					foreach ( $states as $state ) {
						if ( strpos( $state, '---' ) !== false ) {
							$statelist[] = mosHTML::makeOption( '" disabled="disabled', $state );
						} else {
							$statelist[] = mosHTML::makeOption( $state, $state );
						}
					}

					$var['params']['lists']['billState'] = mosHTML::selectList( $statelist, 'billState', 'size="1"', 'value', 'text', $vcontent );
					$var['params']['billState'] = array( 'list', _AEC_USERFORM_BILLSTATEPROV_NAME, $vcontent );
					break;
				case 'zip':
					$var['params']['billZip'] = array( 'inputC', _AEC_USERFORM_BILLZIP_NAME, _AEC_USERFORM_BILLZIP_NAME, $vcontent );
					break;
				case 'country_list':
					$countries = array(  'US', 'AL', 'DZ', 'AD', 'AO', 'AI', 'AG', 'AR', 'AM', 'AW',
										'AU', 'AT', 'AZ', 'BS', 'BH', 'BB', 'BE', 'BZ', 'BJ', 'BM',
										'BT', 'BO', 'BA', 'BW', 'BR', 'VG', 'BN', 'BG', 'BF', 'BI',
										'KH', 'CA', 'CV', 'KY', 'TD', 'CL', 'C2', 'CO', 'KM', 'CK',
										'CR', 'HR', 'CY', 'CZ', 'CD', 'DK', 'DJ', 'DM', 'DO', 'EC',
										'SV', 'ER', 'EE', 'ET', 'FK', 'FO', 'FM', 'FJ', 'FI', 'FR',
										'GF', 'PF', 'GA', 'GM', 'DE', 'GI', 'GR', 'GL', 'GD', 'GP',
										'GT', 'GN', 'GW', 'GY', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID',
										'IE', 'IL', 'IT', 'JM', 'JP', 'JO', 'KZ', 'KE', 'KI', 'KW',
										'KG', 'LA', 'LV', 'LS', 'LI', 'LT', 'LU', 'MG', 'MW', 'MY',
										'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'MN',
										'MS', 'MA', 'MZ', 'NA', 'NR', 'NP', 'NL', 'AN', 'NC', 'NZ',
										'NI', 'NE', 'NU', 'NF', 'NO', 'OM', 'PW', 'PA', 'PG', 'PE',
										'PH', 'PN', 'PL', 'PT', 'QA', 'CG', 'RE', 'RO', 'RU', 'RW',
										'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'SC', 'SL', 'SG', 'SK',
										'SI', 'SB', 'SO', 'ZA', 'KR', 'ES', 'LK', 'SH', 'KN', 'LC',
										'PM', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'TW', 'TJ', 'TZ', 'TH',
										'TG', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA',
										'AE', 'GB', 'UY', 'VU', 'VA', 'VE', 'VN', 'WF', 'YE', 'ZM'
										);

					$countrylist[] = mosHTML::makeOption( '" disabled="disabled', COUNTRYCODE_SELECT );

					$countrylist = array();
					foreach ( $countries as $country ) {
						$cname = constant( 'COUNTRYCODE_' . $country );

						if ( $vcontent == $cname ) {
							$vcontent = $country;
						}

						$countrylist[] = mosHTML::makeOption( $country, $cname );
					}

					$var['params']['lists']['billCountry'] = mosHTML::selectList( $countrylist, 'billCountry', 'size="1"', 'value', 'text', $vcontent );
					$var['params']['billCountry'] = array( 'list', _AEC_USERFORM_BILLCOUNTRY_NAME, $vcontent );
					break;
				case 'country':
					$var['params']['billCountry'] = array( 'inputC', _AEC_USERFORM_BILLCOUNTRY_NAME, _AEC_USERFORM_BILLCOUNTRY_NAME, $vcontent );
					break;
				case 'phone':
					$var['params']['billPhone'] = array( 'inputC', _AEC_USERFORM_BILLPHONE_NAME, _AEC_USERFORM_BILLPHONE_NAME, $vcontent );
					break;
				case 'fax':
					$var['params']['billFax'] = array( 'inputC', _AEC_USERFORM_BILLFAX_NAME, _AEC_USERFORM_BILLPHONE_NAME, $vcontent );
					break;
				case 'company':
					$var['params']['billCompany'] = array( 'inputC', _AEC_USERFORM_BILLCOMPANY_NAME, _AEC_USERFORM_BILLCOMPANY_NAME, $vcontent );
					break;
			}
		}

		return $var;
	}

	function sanitizeRequest( &$request )
	{
		if ( isset( $request->int_var['params']['cardNumber'] ) ) {
			$pfx = "";
			if ( strpos( $request->int_var['params']['cardNumber'], 'XXXX' ) !== false ) {
				$pfx = "XXX";
			}

			$request->int_var['params']['cardNumber'] = $pfx . preg_replace( '/[^0-9]+/i', '', $request->int_var['params']['cardNumber'] );
		}

		return true;
	}

	function checkoutProcess( $request )
	{
		$database = &JFactory::getDBO();

		$this->sanitizeRequest( $request );

		// Create the xml string
		$xml = $this->createRequestXML( $request );

		// Transmit xml to server
		$response = $this->transmitRequestXML( $xml, $request );

		if ( empty( $response['invoice'] ) ) {
			$response['invoice'] = $request->invoice->invoice_number;
		}

		if ( $request->invoice->invoice_number != $response['invoice'] ) {
			$request->invoice = new Invoice( $database );
			$request->invoice->loadInvoiceNumber( $response['invoice'] );
		}

		return $this->checkoutResponse( $request, $response );
	}

	function checkoutResponse( $request, $response )
	{
		if ( !empty( $response['error'] ) ) {
			return $response;
		}

		if ( $response != false ) {
			$resp = array();
			if ( isset( $response['raw'] ) ) {
				if ( is_array( $response['raw'] ) ) {
					$resp = $response['raw'];
				} else {
					$resp['response'] = $response['raw'];
				}
				unset( $response['raw'] );
			}

			$request->invoice->processorResponse( $request->parent, $response, $resp, true );
		} else {
			return false;
		}
	}

	function XMLtoArray( $xml )
	{
		if (!($xml->children())) {
			return (string) $xml;
		}

		foreach ( $xml->children() as $child ) {
			$name = $child->getName();

			if ( count( $xml->$name ) == 1 ) {
				$element[$name] = $this->XMLtoArray( $child );
			} else {
				$element[][$name] = $this->XMLtoArray( $child );
			}
		}

		return $element;
	}

}

class SOAPprocessor extends XMLprocessor
{
	function transmitRequest( $url, $path, $command, $content, $headers=null, $options=null )
	{
		global $aecConfig;

		require_once( JPATH_SITE . '/components/com_acctexp/lib/nusoap/nusoap.php');

		if ( class_exists( 'SoapClient' ) ) {
			$this->soapclient = new SoapClient( $url, $options );
			$response['raw'] = $this->soapclient->__soapCall( $command, $content );

			if ( $response['raw']->error != 0 ) {
				$response['error'] = "Error calling native SOAP function: " . $response['raw']->error . ": " . $response['raw']->errorDescription;
			}
		} else {
			$this->soapclient = new nusoap_client( $url );

			if ( !empty( $aecConfig->cfg['use_proxy'] ) && !empty( $aecConfig->cfg['proxy'] ) ) {
				$this->soapclient->setHTTPProxy(	$aecConfig->cfg['proxy'],
													$aecConfig->cfg['proxy_port'],
													$aecConfig->cfg['proxy_username'],
													$aecConfig->cfg['proxy_password']
												);
			}

			if ( !empty( $headers ) ) {
				$this->soapclient->setHeaders( $headers );
			}

			// execute payment transaction
			$response = array();
			$response['raw'] = $this->soapclient->call( $command, $content );

			$err = $this->soapclient->getError();

			if ( $err != false ) {
				$response['error'] = "Error calling nuSOAP function: " . $err;
			}
		}

		return $response;
	}

	function followupRequest( $command, $content )
	{
		if ( empty( $this->soapclient ) ) {
			return null;
		}

		if ( !is_object( $this->soapclient ) ) {
			return null;
		}

		$response = array();

		if ( is_a( $this->soapclient, 'SoapClient' ) ) {
			$response['raw'] = $this->soapclient->__soapCall( $command, $content );

			if ( $return_val->error != 0 ) {
				$response['error'] = "Error calling SOAP function: " . $return_val->error;
			}

			return $response;
		} else {
			$response['raw'] = $this->soapclient->call( $command, $content );

			$err = $this->soapclient->getError();

			if ( $err != false ) {
				$response['error'] = "Error calling SOAP function: " . $err;
			}

			return $response;
		}
	}
}

class PROFILEprocessor extends XMLprocessor
{

	function ProfileAdd( $request, $profileid )
	{
		$ppParams = new stdClass();

		$ppParams->profileid			= $profileid;

		$ppParams->paymentprofileid		= '';
		$ppParams->paymentProfiles		= array();

		$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );

		return $ppParams;
	}

	function payProfileSelect( $var, $ppParams, $select=false, $btn=true )
	{
		$var['params'][] = array( 'p', _AEC_USERFORM_BILLING_DETAILS_NAME, '' );

		if ( !empty( $ppParams->paymentProfiles ) ) {
			// Single-Select Payment Option
			foreach ( $ppParams->paymentProfiles as $pid => $pobj ) {
				$info = array();

				$info_array = get_object_vars( $pobj->profilehash );

				foreach ( $info_array as $iak => $iav ) {
					if ( !empty( $iav ) ) {
						$info[] = $iav;
					}
				}

				if ( empty( $ppParams->paymentprofileid ) ) {
					$ppParams->paymentprofileid = $pid;
				}

				if ( $ppParams->paymentprofileid == $pid ) {
					$text = '<strong>' . implode( '<br />', $info ) . '</strong>';
				} else {
					$text = implode( '<br />', $info );
				}

				$var['params'][] = array( 'radio', 'payprofileselect', $pid, $ppParams->paymentprofileid, $text );
			}

			if ( count( $ppParams->paymentProfiles ) < 10 ) {
				$var['params'][] = array( 'radio', 'payprofileselect', "new", $ppParams->paymentprofileid, 'create new profile' );
			}

			if ( $btn ) {
				$var['params']['edit_payprofile'] = array( 'submit', '', '', ( $select ? _BUTTON_SELECT : _BUTTON_EDIT ) );
			}
		}

		return $var;
	}

	function payProfileAdd( $request, $profileid, $details, $ppParams )
	{
		$pointer = count( $ppParams->paymentProfiles );

		$data = new stdClass();
		$data->profileid	= $profileid;
		$data->profilehash	= $this->payProfileHash( $details );

		$ppParams->paymentProfiles[$pointer] = $data;

		$ppParams->paymentprofileid = $pointer;

		$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );

		return $ppParams;
	}

	function payProfileUpdate( $request, $profileid, $details, $ppParams )
	{
		$ppParams->paymentProfiles[$profileid]->profilehash = $this->payProfileHash( $details );

		$ppParams->paymentprofileid = $profileid;

		$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );

		return $ppParams;
	}

	function payProfileHash( $post )
	{
		$hash = new stdClass();
		$hash->name		= $post['billFirstName'] . ' ' . $post['billLastName'];
		$hash->address	= $post['billAddress'];
		$hash->zipcity	= $post['billZip'] . ' ' . $post['billCity'];

		if ( !empty( $post['account_no'] ) ) {
			$hash->cc		= 'XXXX' . substr( $post['account_no'], -4 );
		} else {
			$hash->cc		= 'XXXX' . substr( $post['cardNumber'], -4 );
		}

		return $hash;
	}

	function shipProfileSelect( $var, $ppParams, $select=false, $btn=true, $new=true )
	{
		$var['params'][] = array( 'p', _AEC_USERFORM_SHIPPING_DETAILS_NAME, '' );

		if ( !empty( $ppParams->shippingProfiles ) ) {
			// Single-Select Shipment Data
			foreach ( $ppParams->shippingProfiles as $pid => $pobj ) {
				$info = array();

				$info_array = get_object_vars( $pobj->profilehash );

				foreach ( $info_array as $iak => $iav ) {
					if ( !empty( $iav ) ) {
						$info[] = $iav;
					}
				}

				if ( empty( $ppParams->shippingprofileid ) ) {
					$ppParams->shippingprofileid = $pid;
				}

				if ( $ppParams->shippingprofileid == $pid ) {
					$text = '<strong>' . implode( '<br />', $info ) . '</strong>';
				} else {
					$text = implode( '<br />', $info );
				}

				$var['params'][] = array( 'radio', 'shipprofileselect', $pid, $ppParams->shippingprofileid, $text );
			}

			if ( ( count( $ppParams->shippingProfiles ) < 10 ) && $new ) {
				$var['params'][] = array( 'radio', 'shipprofileselect', "new", $ppParams->shippingprofileid, 'create new profile' );
			}

			if ( $btn ) {
				$var['params']['edit_shipprofile'] = array( 'submit', '', '', ( $select ? _BUTTON_SELECT : _BUTTON_EDIT ) );
			}
		}

		return $var;
	}

	function shipProfileAdd( $request, $profileid, $post, $ppParams )
	{
		$pointer = count( $ppParams->paymentProfiles );

		$ppParams->shippingProfiles[$pointer] = new stdClass();
		$ppParams->shippingProfiles[$pointer]->profileid = $profileid;

		$ppParams->shippingProfiles[$pointer]->profilehash = $this->shipProfileHash( $post );

		$ppParams->shippingprofileid = $pointer;

		$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );

		return $ppParams;
	}

	function shipProfileUpdate( $request, $profileid, $post, $ppParams )
	{
		$ppParams->shippingProfiles[$profileid]->profilehash = $this->shipProfileHash( $post );

		$ppParams->shippingprofileid = $profileid;

		$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );

		return $ppParams;
	}

	function shipProfileHash( $post )
	{
		$hash = new stdClass();
		$hash->name		= $post['billFirstName'] . ' ' . $post['billLastName'];
		$hash->address	= $post['billAddress'];
		$hash->zipcity	= $post['billZip'] . ' ' . $post['billCity'];

		return $hash;
	}

}

class POSTprocessor extends processor
{
	function checkoutAction( $request )
	{
		$var = $this->createGatewayLink( $request );

		if ( !empty( $this->settings['customparams'] ) ) {
			$var = $this->customParams( $this->settings['customparams'], $var, $request );
		}

		if ( isset( $var['_aec_checkout_onclick'] ) ) {
			$onclick = 'onclick="' . $var['_aec_checkout_onclick'] . '"';
			unset( $var['_aec_checkout_onclick'] );
		} else {
			$onclick = ""; // TODO: 'onclick="javascript:document.getElementById(\'aec_checkout_btn\').disabled=true"';
		}

		$return = '<form action="' . $var['post_url'] . '" method="post">' . "\n";
		unset( $var['post_url'] );

		foreach ( $var as $key => $value ) {
			$return .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />' . "\n";
		}

		$return .= '<input type="submit" class="button" id="aec_checkout_btn" ' . $onclick . ' value="' . _BUTTON_CHECKOUT . '" />' . "\n";
		$return .= '</form>' . "\n";

		return $return;
	}
}

class GETprocessor extends processor
{
	function checkoutAction( $request )
	{
		$var = $this->createGatewayLink( $request );

		if ( !empty( $this->settings['customparams'] ) ) {
			$var = $this->customParams( $this->settings['customparams'], $var, $request );
		}

		if ( isset( $var['_aec_checkout_onclick'] ) ) {
			$onclick = ' onclick="' . $var['_aec_checkout_onclick'] . '"';
			unset( $var['_aec_checkout_onclick'] );
		} else {
			$onclick = '';
		}

		$return = '<form action="' . $var['post_url'] . '" method="get">' . "\n";
		unset( $var['post_url'] );

		foreach ( $var as $key => $value ) {
			$return .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />' . "\n";
		}

		$return .= '<input type="submit" class="button"' . $onclick . ' value="' . _BUTTON_CHECKOUT . '" />' . "\n";
		$return .= '</form>' . "\n";

		return $return;
	}
}

class URLprocessor extends processor
{
	function checkoutAction( $request )
	{
		global $mainframe;

		$var = $this->createGatewayLink( $request );

		if ( isset( $var['_aec_html_head'] ) ) {
			if ( is_array( $var['_aec_html_head'] ) ) {
				foreach ( $var['_aec_html_head'] as $content ) {
					$mainframe->addCustomHeadTag( $content );
				}
			} else {
				$mainframe->addCustomHeadTag( $var['_aec_html_head'] );
			}

			unset( $var['_aec_html_head'] );
		}

		if ( !empty( $this->settings['customparams'] ) ) {
			$var = $this->customParams( $this->settings['customparams'], $var, $request );
		}

		if ( isset( $var['_aec_checkout_onclick'] ) ) {
			$onclick = ' onclick="' . $var['_aec_checkout_onclick'] . '"';
			unset( $var['_aec_checkout_onclick'] );
		} else {
			$onclick = '';
		}

		$return = '<a href="' . $var['post_url'];
		unset( $var['post_url'] );

		$vars = array();
		if ( !empty( $var ) ) {
			foreach ( $var as $key => $value ) {
				$vars[] .= urlencode( $key ) . '=' . urlencode( $value );
			}

			$return .= implode( '&amp;', $vars );
		}

		$return .= '"' . $onclick . ' class="linkbutton" >' . _BUTTON_CHECKOUT . '</a>' . "\n";

		return $return;
	}
}

class aecSettings
{

	function aecSettings( $area, $subarea='' )
	{
		$this->area				= $area;
		$this->original_subarea	= $subarea;
		$this->subarea			= $subarea;
	}

	function fullSettingsArray( $params, $params_values, $lists = array(), $settings = array() ) {
		$this->params			= $params;
		$this->params_values	= $params_values;
		$this->lists			= $lists;
		$this->settings			= $settings;
		$this->prefix			= '';

		foreach ( $this->params as $name => $content ) {

			// $content[0] = type
			// $content[1] = value
			// $content[2] = disabled?
			// $content[3] = set name
			// $content[4] = set description

			$cname = $name;

			if ( !empty( $this->prefix ) ) {
				if ( strpos( $name, $this->prefix ) === 0 ) {
					$cname = str_replace( $this->prefix, '', $name );
				}
			}

			$name = $this->prefix . $cname;

			if ( !isset( $this->params_values[$name] ) ) {
				if ( isset( $content[3] ) ) {
					$this->params_values[$name] = $content[3];
				} elseif ( isset( $content[1] ) && !isset( $content[2] ) ) {
					$this->params_values[$name] = $content[1];
				} else {
					$this->params_values[$name] = '';
				}
			}

			if ( isset( $this->params_values[$name] ) ) {
				$value = $this->params_values[$name];
			}

			// Checking for remap functions
			$remap = 'remap_' . $content[0];

			if ( method_exists( $this, $remap ) ) {
				$type = $this->$remap( $name, $value );
			} else {
				$type = $content[0];
			}

			if ( strcmp( $type, 'DEL' ) === 0 ) {
				continue;
			}

			if ( !isset( $content[2] ) || ( ( $content[2] === false ) && ( $content[2] !== '' ) ) ) {
				// Create constant names
				$constant_generic	= '_' . strtoupper($this->area)
										. '_' . strtoupper( $this->original_subarea )
										. '_' . strtoupper( $cname );
				$constant			= '_' . strtoupper( $this->area )
										. '_' . strtoupper( $this->subarea )
										. '_' . strtoupper( $cname );
				$constantname		= $constant . '_NAME';
				$constantdesc		= $constant . '_DESC';

				// If the constantname does not exists, try a generic name or insert an error
				if ( defined( $constantname ) ) {
					$info_name = constant( $constantname );
				} else {
					$genericname = $constant_generic . '_NAME';
					if ( defined( $genericname ) ) {
						$info_name = constant( $genericname );
					} else {
						$info_name = sprintf( _AEC_CMN_LANG_CONSTANT_IS_MISSING, $constantname );
					}
				}

				// If the constantname does not exists, try a generic name or insert an error
				if ( defined( $constantdesc ) ) {
					$info_desc = constant( $constantdesc );
				} else {
					$genericdesc = $constant_generic . '_DESC';
					if ( defined( $genericname ) ) {
						$info_desc = constant( $genericdesc );
					} else {
						$info_desc = sprintf( _AEC_CMN_LANG_CONSTANT_IS_MISSING, $constantdesc );
					}
				}
			} else {
				$info_name = $content[1];
				$info_desc = $content[2];
			}

			if ( isset( $content[4] ) ) {
				$this->settings[$name] = array( $type, $info_name, $info_desc, $value, $content[4] );
			} else {
				$this->settings[$name] = array( $type, $info_name, $info_desc, $value );
			}
		}
	}

	function remap_add_prefix( $name, $value )
	{
		$this->prefix = $value;
		return 'DEL';
	}

	function remap_area_change( $name, $value )
	{
		$this->area = $value;
		$this->prefix = '';
		return 'DEL';
	}

	function remap_subarea_change( $name, $value )
	{
		$this->subarea = $value;
		$this->prefix = '';
		return 'DEL';
	}

	function remap_list_yesno( $name, $value )
	{
		$this->lists[$name] = mosHTML::yesnoSelectList( $name, '', $value );
		return 'list';
	}

	function remap_list_currency( $name, $value )
	{
		$currency_code_list = AECToolbox::aecCurrencyField( true, true, true );

		$this->lists[$name] = mosHTML::selectList( $currency_code_list, $name, 'size="10"', 'value', 'text', $value );

		return 'list';
	}

	function remap_list_yesnoinherit( $name, $value )
	{
		$this->lists[$name] = mosHTML::yesnoSelectList( $name, '', $value );

		$arr = array(
		mosHTML::makeOption( '0', _AEC_CMN_NO ),
		mosHTML::makeOption( '1', _AEC_CMN_YES ),
		mosHTML::makeOption( '1', _AEC_CMN_INHERIT ),
		);

		$this->lists[$name] = mosHTML::selectList( $arr, $name, '', 'value', 'text', $value );
		return 'list';
	}

	function remap_list_recurring( $name, $value )
	{
		$recurring[] = mosHTML::makeOption( 0, _AEC_SELECT_RECURRING_NO );
		$recurring[] = mosHTML::makeOption( 1, _AEC_SELECT_RECURRING_YES );
		$recurring[] = mosHTML::makeOption( 2, _AEC_SELECT_RECURRING_BOTH );

		$this->lists[$name] = mosHTML::selectList( $recurring, $name, 'size="3"', 'value', 'text', $value );

		return 'list';
	}

	function remap_list_date( $name, $value )
	{
		if ( !aecJoomla15check() ) {
			$this->lists[$name] = '<input class="text_area" type="text" name="' . $name . '" id="' . $name . '" size="19" maxlength="19" value="' . $value . '"/>'
				.'<input type="reset" name="reset" class="button" onClick="return showCalendar(\'' . $name . '\', \'y-mm-dd\');" value="..." />';
		} else {
			$this->lists[$name] = JHTML::_('calendar', $value, $name, $name, '%Y-%m-%d %H:%M:%S', array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'19'));
		}

		return 'list';
	}
}

class aecHTML
{

	function aecHTML( $rows, $lists=null, $js=array() )
	{
		//$this->area = $area;
		//$this->fallback = $fallback;

		$this->rows		= $rows;
		$this->lists	= $lists;
		$this->js		= $js;
	}

	function createSettingsParticle( $name, $notooltip=false )
	{
		if ( !isset( $this->rows[$name] ) ) {
			return;
		}

		$row	= $this->rows[$name];
		$type	= $row[0];

		$return = '';

		if ( isset( $row[2] ) ) {
			if ( isset( $row[3] ) ) {
				$value = $row[3];
			} else {
				$value = '';
			}

			if ( !empty( $row[1] ) && !empty( $row[2] ) && !$notooltip ) {
				if ( aecJoomla15check() ) {
					$return = '<div class="setting_desc">';
					$return .= '<span class="editlinktip hasTip" title="';

					if ( strnatcmp( phpversion(),'5.2.3' ) >= 0 ) {
						$return .= htmlentities( $row[1], ENT_QUOTES, "ISO-8859-1", false ) . ( ( strpos( $row[1], ':' ) === false ) ? ':' : '' ) . ':' . htmlentities( $row[2], ENT_QUOTES, "ISO-8859-1", false );
						$return .= '">' . $this->Icon( 'help.png') . htmlentities( $row[1], ENT_QUOTES, "ISO-8859-1", false ) . ( ( strpos( $row[1], ':' ) === false ) ? ':' : '' ) . '</span>';
					} else {
						$return .= htmlentities( $row[1], ENT_QUOTES, "ISO-8859-1" ) . ( ( strpos( $row[1], ':' ) === false ) ? ':' : '' ) . ':' . htmlentities( $row[2], ENT_QUOTES, "ISO-8859-1" );
						$return .= '">' . $this->Icon( 'help.png') . htmlentities( $row[1], ENT_QUOTES, "ISO-8859-1" ) . ( ( strpos( $row[1], ':' ) === false ) ? ':' : '' ) . '</span>';
					}

					$return .= '</div>';
				} else {
					$return = '<div class="setting_desc">' . $this->ToolTip( $row[2], $row[1] ) . $row[1] . '</div>';
				}
			}
		} else {
			if ( isset( $row[1] ) ) {
				$value = $row[1];
			} else {
				$value = '';
			}
		}

		switch ( $type ) {
			case 'inputA':
				$return .= '<div class="setting_form">';
				$return .= '<input name="' . $name . '" type="text" size="4" value="' . $value . '" />';
				$return .= '</div>';
				break;
			case 'inputB':
				$return .= '<div class="setting_form">';
				$return .= '<input class="inputbox" type="text" name="' . $name . '" size="8" value="' . $value . '" />';
				$return .= '</div>';
				break;
			case 'inputC':
				$return .= '<div class="setting_form">';
				$return .= '<input type="text" size="20" name="' . $name . '" class="inputbox" value="' . $value . '" />';
				$return .= '</div>';
				break;
			case 'inputD':
				$return .= '<div class="setting_form">';
				$return .= '<textarea cols="50" rows="5" name="' . $name . '" >' . $value . '</textarea>';
				$return .= '</div>';
				break;
			case 'inputE':
				$return .= '<div class="setting_form">';
				$return .= '<textarea style="width:520px" cols="450" rows="1" name="' . $name . '" >' . $value . '</textarea>';
				$return .= '</div>';
				break;
			case 'checkbox':
				$return .= '<div class="setting_form">';
				$return .= '<input type="checkbox" name="' . $name . '" ' . ( $value ? 'checked="checked" ' : '' ) . '/>';
				$return .= '</div>';
				break;
			case 'editor':
				$return .= '<div class="setting_form">';

				if ( aecJoomla15check() ) {
					$editor = &JFactory::getEditor();

					$return .= '<div>' . $editor->display( $name,  $value , '100%', '250', '50', '20' ) . '</div>';
				} else {
					$return .= '<div>' . editorArea( $name, $value, $name, '100%;', '250', '50', '20' ) . '</div>';
				}

				$return .= '</div>';
				break;
			case 'list':
				$return .= '<div class="setting_form">';
				$return .= $this->lists[$name];
				$return .= '</div>';
				break;
			case 'accordion_start':
				if ( !isset( $this->accordions ) ) {
					$this->accordions = 1;
				} else {
					$this->accordions++;
				}

				// small accordion code
				$this->js[] = "window.addEvent('domready',function(){ var accordion" . $this->accordions . " = new Accordion($('accordion" . $this->accordions . "'), '#accordion" . $this->accordions . " h3.atStart', '#accordion" . $this->accordions . " div.atStart', {
					duration: 200, alwaysHide: true,
					onActive: function(toggler, element){
						var activeFX = new Fx.Styles(toggler, {duration: 300, transition: Fx.Transitions.Expo.easeOut});
						activeFX.start({ 'color':'#222', 'paddingLeft':'20px' });
						toggler.setStyle('font-weight', 'bold');
					},
					onBackground: function(toggler, element){
						var backFX = new Fx.Styles(toggler, {duration: 300, transition: Fx.Transitions.Expo.easeOut});
						backFX.start({ 'color':'#444', 'paddingLeft':'10px' });
						toggler.setStyle('font-weight', 'normal');
					} } ); });";
				$return = '<div id="accordion' . $this->accordions . '"' . ( !empty( $value ) ? ('class="'.$value.'"') : 'accordion') . '>';
				break;
			case 'accordion_itemstart':
				$return = '<h3 class="aec_toggler atStart">' . $value . '</h3><div class="element atStart">';
				break;
			case 'div_end':
				$return = '</div>';
				break;
			case '2div_end':
				$return = '</div></div>';
				break;
			case 'userinfobox':
				$return = '<div style="position:relative;float:left;width:' . $value . '%;padding:4px;"><div class="userinfobox">';
				break;
			case 'userinfobox_sub':
				$return = '<div class="aec_userinfobox_sub"><h4>' . $value . '</h4>';
				break;
			case 'fieldset':
				$return = '<div class="setting_form">' . "\n"
				. '<fieldset><legend>' . $row[1] . '</legend>' . "\n"
				. '<table cellpadding="1" cellspacing="1" border="0">' . "\n"
				. '<tr align="left" valign="middle" ><td>' . $row[2] . '</td></tr>' . "\n"
				. '</table>' . "\n"
				. '</fieldset>' . "\n"
				. '</div>'
				;
				break;
			case 'hidden':
				$return = '';
				if ( is_array( $value ) ) {
					foreach ( $value as $v ) {
						$return .= '<input type="hidden" name="' . $name . '[]" value="' . $v . '" />';
					}
				} else {
					$return .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
				}
				break;
			default:
				$return = $value;
				break;
		}
		return $return;
	}

	function loadJS( $return=null )
	{
		if ( !empty( $this->js ) || !empty( $return ) ) {
			$js = "\n" . '<script type="text/javascript">';

			if ( !empty( $this->js ) ) {
				foreach ( $this->js as $scriptblock ) {
					$js .= "\n";
					$js .= $scriptblock;
				}
			}

			$js .= $return;
			$js .= "\n" . '</script>';

			$return = $js;
		}

		return $return;
	}

	function returnFull( $notooltip=false, $formsonly=false, $table=false )
	{
		$return = '';
		foreach ( $this->rows as $rowname => $rowcontent ) {
			if ( $formsonly ) {
				$return .= $this->createFormParticle( $rowname, $this->rows[$rowname], $this->lists, $table );
			} else {
				$return .= $this->createSettingsParticle( $rowname, $notooltip );
			}
		}

		return $return;
	}

	function printFull( $notooltip=false, $formsonly=false )
	{
		echo $this->returnFull( $notooltip, $formsonly );
	}

	function createFormParticle( $name, $row=null, $lists=array(), $table=0 )
	{
		if ( is_null( $row ) && !empty( $this->rows ) ) {
			if ( isset( $this->rows[$name] ) ) {
				$row = $this->rows[$name];
			} else {
				return '';
			}
		}

		$return = '';
		if ( isset( $row[3] ) ) {
			$value = $row[3];
		} else {
			$value = '';
		}

		$return .= $table ? '<tr><td class="cleft">' : '<p>';

		if ( !empty( $row[1] ) ) {
			$return .= '<strong>' . $row[1] . ':</strong>';
		}

		$return .= $table ? '</td><td class="cright">' : ' ';

		$noappend = false;
		switch ( $row[0] ) {
			case 'submit':
				$return .= '<input type="submit" class="button" name="' . $name . '" value="' . $value . '" />' . "\n";
				break;
			case "inputA":
				$return .= '<input name="' . $name . '" type="text" size="4" maxlength="5" value="' . $value . '"/>';
				break;
			case "inputB":
				$return .= '<input class="inputbox" type="text" name="' . $name . '" size="2" maxlength="10" value="' . $value . '" />';
				break;
			case "inputC":
				$return .= '<input type="text" size="20" name="' . $name . '" class="inputbox" value="' . $value . '" />';
				break;
			case "inputD":
				$return .= '<textarea align="left" cols="60" rows="5" name="' . $name . '" />' . $value . '</textarea>';
				break;
			case 'radio':
				$return = '<tr><td class="cleft">';
				$return .= '<input type="radio" name="' . $row[1] . '"' . ( ( $row[3] === $row[2] ) ? ' checked="checked"' : '' ) . ' value="' . $row[2] . '" />';
				$return .= '</td><td class="cright">' . $row[4];
				break;
			case 'checkbox':
				$return = '<tr><td class="cleft">';
				$return .= '<input type="checkbox" name="' . $row[1] . '"' . ( ( $row[3] === $row[2] ) ? ' checked="checked"' : '' ) . ' value="' . $row[2] . '" />';
				$return .= '</td><td class="cright">' . $row[4];
				break;
			case "list":
				$return .= $lists[$value ? $value : $name];
				break;
			case 'tabberstart':
				$return = '<tr><td colspan="2"><div id="myTabs">';
				break;
			case 'tabregisterstart':
				$return = '<ul class="mootabs_title">';
				break;
			case 'tabregister':
				$return = '<li title="' . $row[1] . '">' . $row[2] . '</li> ';
				break;
			case 'tabregisterend':
				$return = '</ul>';
				break;
			case 'tabstart':
				$return = '<div id="' . $row[1] . '" class="mootabs_panel"><table>';
				break;
			case 'tabend':
				$return = '</table></div>';
				break;
			case 'tabberend':
				$return = '</div></td></tr>';
				break;
			case 'divstart':
				if ( isset( $row[4] ) ) {
					$return = '<div id="' . $row[4] . '">';
				} else {
					$return = '<div class="' . $row[3] . '">';
				}
				break;
			case 'divend':
				$return = '</div>';
				break;
			case 'hidden':
				if ( !empty( $row[2] ) ) {
					$name = $row[2];
				}

				$return = '';
				if ( is_array( $value ) ) {
					foreach ( $value as $v ) {
						$return .= '<input type="hidden" name="' . $name . '[]" value="' . $v . '" />';
					}
				} else {
					$return .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
				}
				break;
			default:
				if ( !empty( $row[0] ) ) {
					if ( empty( $row[1] ) ) {
						$return .= '<tr><td class="cboth" colspan="2"><' . $row[0] . '>' . $row[2] . $value . '</' . $row[0] . '></td></tr>';
					} else {
						$return .= '<' . $row[0] . '>' . $row[2] . $value . '</' . $row[0] . '>';
					}
				} elseif ( empty( $row[0] ) && empty( $row[2] ) ) {
					$return .= '<' . $row[1] . $value . ' />';
				} else {
					$return .= $row[2] . $value;
				}
				break;
		}

		if ( strpos( $return, ($table ? '<tr><td class="cleft">' : '<p>') ) !== false ) {
			$return .= $table ? '</td></tr>' : '</p>';
		}

		return $return;
	}

	/**
	* Utility function to provide ToolTips
	* @param string ToolTip text
	* @param string Box title
	* @returns HTML code for ToolTip
	*/
	function ToolTip( $tooltip, $title='', $width='', $image='help.png', $text='', $href='#', $link=1 )
	{
		if ( $width ) {
			$width = ', WIDTH, \''.$width .'\'';
		}
		if ( $title ) {
			$title = ', CAPTION, \''.$title .'\'';
		}
		if ( !$text ) {
			$image 	= JURI::root() . 'media/com_acctexp/images/admin/icons/'. $image;
			$text 	= '<img src="'. $image .'" border="0" alt=""/>';
		}
		$style = 'style="text-decoration: none; color: #586C79;"';
		if ( $href ) {
			$style = '';
		} else{
			$href = '#';
		}

		$mousover = 'return overlib(\''. htmlentities( $tooltip, ENT_QUOTES, "ISO-8859-1", false ) .'\''. $title .', BELOW, RIGHT'. $width .');';

		$tip = '';
		if ( $link ) {
			$tip .= '<a href="'. $href .'" onmouseover="'. $mousover .'" onmouseout="return nd();" '. $style .'>'. $text .'</a>';
		} else {
			$tip .= '<span onmouseover="'. $mousover .'" onmouseout="return nd();" '. $style .'>'. $text .'</span>';
		}

		return $tip . '&nbsp;';
	}

	/**
	 * displays an icon
	 * mic: corrected name
	 *
	 * @param 	string	$image	image name
	 * @param	string	$alt	optional alt/title text
	 * @return html string
	 */
	function Icon( $image = 'error.png', $alt = '' )
	{
		if ( !$alt ) {
			$name	= explode( '.', $image );
			$alt	= $name[0];
		}
		$image 	= JURI::root() . 'media/com_acctexp/images/site/icons/'. $image;

		return '<img src="'. $image .'" border="0" alt="' . $alt . '" class="aec_icon" />';
	}

}

class ItemGroupHandler
{
	function getGroups()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
				. ' FROM #__acctexp_itemgroups'
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function getTree()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
				. ' FROM #__acctexp_itemxgroup'
				. ' WHERE `type` = \'group\''
				;
		$database->setQuery( $query );
		$nitems = $database->loadResultArray();

		$query = 'SELECT id'
				. ' FROM #__acctexp_itemgroups'
				. ( !empty( $nitems ) ? ' WHERE `id` NOT IN (' . implode( ',', $nitems ) . ')' : '' )
				;
		$database->setQuery( $query );
		$items = $database->loadResultArray();

		$list = array();
		foreach( $items as $itemid ) {
			$tree = ItemGroupHandler::resolveTreeItem( $itemid );

			ItemGroupHandler::indentList( $tree, $list );
		}

		return $list;
	}

	function indentList( $tree, &$list, $indent=0 )
	{
		$list[] = array( $tree['id'], str_repeat( '&nbsp;', $indent ) . ( ( $indent > 0 ) ? '-' : '' ) . $tree['name'] . ' (#' . $tree['id'] . ')' );

		if ( isset( $tree['children'] ) ) {
			foreach ( $tree['children'] as $id => $co ) {
				ItemGroupHandler::indentList( $co, $list, $indent+1 );
			}
		}

		return $list;
	}

	function resolveTreeItem( $id )
	{
		$tree = array();
		$tree['id']		= $id;
		$tree['name']	= ItemGroupHandler::groupName( $id );

		$groups = ItemGroupHandler::getChildren( $id, 'group' );

		if ( !empty( $groups ) ) {
			// Has children, append them
			$tree['children'] = array();
			foreach ( $groups as $child_id ) {
				$tree['children'][] = ItemGroupHandler::resolveTreeItem( $child_id );
			}
		}

		return $tree;
	}

	function groupName( $groupid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT name'
				. ' FROM #__acctexp_itemgroups'
				. ' WHERE `id` = \'' . $groupid . '\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function groupColor( $groupid )
	{
		$database = &JFactory::getDBO();

		$group = new ItemGroup( $database );
		$group->load( $groupid );

		return $group->params['color'];
	}

	function groupIcon( $groupid )
	{
		$database = &JFactory::getDBO();

		$group = new ItemGroup( $database );
		$group->load( $groupid );

		return $group->params['icon'];
	}

	function parentGroups( $item_id, $type='item' )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT group_id'
				. ' FROM #__acctexp_itemxgroup'
				. ' WHERE `type` = \'' . $type . '\''
				. ' AND `item_id` = \'' . $item_id . '\''
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function updateChildRelation( $item_id, $groups, $type='item' )
	{
		$currentParents	= ItemGroupHandler::parentGroups( $item_id, $type );

		// Filtering out which groups will stay
		$keepGroups		= array_intersect( $currentParents, $groups );

		// Which will be newly added
		$addGroups		= array_diff( $groups, $keepGroups );
		ItemGroupHandler::setChildren( $item_id, $addGroups, $type );

		// And which removed
		$delGroups		= array_diff( $currentParents, $keepGroups, $addGroups );
		ItemGroupHandler::removeChildren( $item_id, $delGroups, $type );
	}

	function setChild( $child_id, $group_id, $type='item' )
	{
		$database = &JFactory::getDBO();

		if ( $type == 'group' ) {
			// Don't let a group be assigned to itself
			if ( ( $group_id == $child_id ) ) {
				continue;
			}

			$children = ItemGroupHandler::getChildren( $child_id, 'group' );

			// Don't allow circular assignment
			if ( in_array( $group_id, $children ) ) {
				continue;
			}
		}

		$ig = new itemXgroup( $database );
		return $ig->createNew( $type, $child_id, $group_id );
	}

	function setChildren( $group_id, $children, $type='item' )
	{
		$database = &JFactory::getDBO();

		foreach ( $children as $child_id ) {
			// Check bogus assignments
			if ( $type == 'group' ) {
				// Don't let a group be assigned to itself
				if ( ( $child_id == $group_id ) ) {
					continue;
				}

				$children = ItemGroupHandler::getChildren( $child_id, 'group' );

				// Don't allow circular assignment
				if ( in_array( $group_id, $children ) ) {
					continue;
				}
			}

			$ig = new itemXgroup( $database );

			if ( !$ig->createNew( $type, $child_id, $group_id ) ) {
				return false;
			}
		}

		return true;
	}

	function getParents( $item_id, $type='item' )
	{
		$itemParents = ItemGroupHandler::parentGroups( $item_id, $type );

		$allParents = $itemParents;
		foreach ( $itemParents as $parentid ) {
			$parentParents = ItemGroupHandler::getParents( $parentid, 'group' );

			$allParents = array_merge( $allParents, $parentParents );
		}

		return $allParents;
	}

	function getChildren( $groups, $type )
	{
		$database = &JFactory::getDBO();

		$where = array();

		if ( is_array( $groups ) ) {
			$where[] = '`group_id` IN (' . implode( ',', $groups ) . ')';
		} else {
			$where[] = '`group_id` = ' . $groups . '';
		}

		if ( !empty( $type ) ) {
			$where[] = '`type` = \'' . $type . '\'';
		}

		$query = 'SELECT item_id'
				. ' FROM #__acctexp_itemxgroup'
				;

		if ( !empty( $where ) ) {
			$query .= ' WHERE ( ' . implode( ' AND ', $where ) . ' )';
		}

		$database->setQuery( $query );
		$result = $database->loadResultArray();

		if ( !empty( $result ) ) {
		// Order results
			$query = 'SELECT id'
					. ' FROM #__acctexp_' . ( ( $type == 'group' ) ? 'itemgroups' : 'plans' )
					. ' WHERE id IN (' . implode( ',', $result ) . ')'
					. ' ORDER BY `ordering`'
					;
			$database->setQuery( $query );

			return $database->loadResultArray();
		} else {
			return $result;
		}
	}

	function getGroupsPlans( $groups )
	{
		static $groupstore;

		$plans = array();
		foreach ( $groups as $group ) {
			if ( !isset( $groupstore[$group] ) ) {
				$groupstore[$group] = ItemGroupHandler::getTotalChildItems( array( $group ) );

				array_unique( $groupstore[$group] );
			}

			$plans = array_merge( $plans, $groupstore[$group] );
		}

		if ( !empty( $plans ) ) {
			return $plans;
		} else {
			return array();
		}
	}

	function checkParentRestrictions( $item, $type, $metaUser )
	{
		$parents = ItemGroupHandler::parentGroups( $item->id, $type );

		if ( !empty( $parents ) ) {
			foreach ( $parents as $parent ) {
				$g = new ItemGroup( $item->_db );
				$g->load( $parent );

				// Only check for permission, visibility might be overridden
				if ( !$g->checkPermission( $metaUser ) ) {
					return false;
				}

				if ( !ItemGroupHandler::checkParentRestrictions( $g, 'group', $metaUser ) ) {
					return false;
				}
			}
		}

		return true;
	}

	function hasVisibleChildren( $group, $metaUser )
	{
		$children = ItemGroupHandler::getChildren( $group->id, 'item' );
		if ( !empty( $children ) ) {
			$i = 0;
			foreach( $children as $itemid ) {
				$plan = new SubscriptionPlan( $group->_db );
				$plan->load( $itemid );

				if ( $plan->checkVisibility( $metaUser ) ) {
					return true;
				}
			}
		}

		$groups = ItemGroupHandler::getChildren( $group->id, 'group' );
		if ( !empty( $groups ) ) {
			foreach ( $groups as $groupid ) {
				$g = new ItemGroup( $group->_db );
				$g->load( $groupid );

				if ( !$g->checkVisibility( $metaUser ) ) {
					continue;
				}

				if ( ItemGroupHandler::hasVisibleChildren( $g, $metaUser ) ) {
					return true;
				}
			}
		}

		return false;
	}

	function getTotalChildItems( $gids, $list=array() )
	{
		$groups = ItemGroupHandler::getChildren( $gids, 'group' );

		foreach ( $groups as $groupid ) {
			$list = ItemGroupHandler::getTotalChildItems( $groupid, $list );
		}

		$items = ItemGroupHandler::getChildren( $gids, 'item' );

		return array_merge( $list, $items );
	}

	function getTotalAllowedChildItems( $gids, $metaUser, $list=array() )
	{
		$database = &JFactory::getDBO();

		$groups = ItemGroupHandler::getChildren( $gids, 'group' );

		foreach ( $groups as $groupid ) {
			$group = new ItemGroup( $database );
			$group->load( $groupid );

			if ( !$group->checkVisibility( $metaUser ) ) {
				continue;
			}

			if ( $group->params['reveal_child_items'] && empty( $group->params['symlink'] ) ) {
				$list = ItemGroupHandler::getTotalAllowedChildItems( $groupid, $metaUser, $list );
			} else {
					if ( ItemGroupHandler::hasVisibleChildren( $group, $metaUser ) ) {
						$list[] = ItemGroupHandler::getGroupListItem( $group );
					}
				}
		}

		$items = ItemGroupHandler::getChildren( $gids, 'item' );

		$i = 0;
		foreach( $items as $itemid ) {
			$plan = new SubscriptionPlan( $database );
			$plan->load( $itemid );

			if ( !$plan->checkVisibility( $metaUser ) ) {
				continue;
			}

			$list[] = ItemGroupHandler::getItemListItem( $plan );
			$i++;
		}

		return $list;
	}

	function getGroupListItem( $group )
	{
		return array(	'type'	=> 'group',
						'id'	=> $group->id,
						'name'	=> $group->getProperty( 'name' ),
						'desc'	=> $group->getProperty( 'desc' )
						);
	}

	function getItemListItem( $plan )
	{
		return array(	'type'		=> 'item',
						'id'		=> $plan->id,
						'plan'		=> $plan,
						'name'		=> $plan->getProperty( 'name' ),
						'desc'		=> $plan->getProperty( 'desc' ),
						'ordering'	=> $plan->ordering,
						'lifetime'	=> $plan->params['lifetime']
						);
	}

	function removeChildren( $items, $groups, $type='item' )
	{
		$database = &JFactory::getDBO();

		$query = 'DELETE'
				. ' FROM #__acctexp_itemxgroup'
				. ' WHERE `type` = \'' . $type . '\''
				;

		if ( is_array( $items ) ) {
			$query .= ' AND `item_id` IN (' . implode( ',', $items ) . ')';
		} else {
			$query .= ' AND `item_id` = \'' . $items . '\'';
		}

		if ( !empty( $groups ) ) {
			$query .= ' AND `group_id` IN (' . implode( ',', $groups ) . ')';
		}

		$database->setQuery( $query );
		return $database->loadResultArray();
	}

}

class ItemGroup extends serialParamDBTable
{
	/** @var int Primary key */
	var $id 				= null;
	/** @var int */
	var $active				= null;
	/** @var int */
	var $visible			= null;
	/** @var int */
	var $ordering			= null;
	/** @var string */
	var $name				= null;
	/** @var string */
	var $desc				= null;
	/** @var text */
	var $params 			= null;
	/** @var text */
	var $custom_params		= null;
	/** @var text */
	var $restrictions		= null;

	function ItemGroup( &$db )
	{
		parent::__construct( '#__acctexp_itemgroups', 'id', $db );
	}

	function getProperty( $name )
	{
		if ( isset( $this->$name ) ) {
			return stripslashes( $this->$name );
		} else {
			return null;
		}
	}

	function declareParamFields()
	{
		return array( 'params', 'custom_params', 'restrictions' );
	}

	function checkVisibility( $metaUser )
	{
		if ( !$this->visible ) {
			return false;
		} else {
			return $this->checkPermission( $metaUser );
		}
	}

	function checkPermission( $metaUser )
	{
		if ( !$this->active ) {
			return false;
		}

		$restrictions = $this->getRestrictionsArray();

		return aecRestrictionHelper::checkRestriction( $restrictions, $metaUser );
	}

	function getRestrictionsArray()
	{
		return aecRestrictionHelper::getRestrictionsArray( $this->restrictions );
	}

	function savePOSTsettings( $post )
	{
		$database = &JFactory::getDBO();

		// Fake knowing the planid if is zero.
		if ( !empty( $post['id'] ) ) {
			$groupid = $post['id'];
		} else {
			$groupid = $this->getMax() + 1;
		}

		if ( isset( $post['id'] ) ) {
			unset( $post['id'] );
		}

		if ( !empty( $post['add_group'] ) ) {
			ItemGroupHandler::setChildren( $post['add_group'], array( $groupid ), 'group' );
		}

		if ( $this->id == 1 ) {
			$post['active']				= 1;
			$post['visible']			= 1;
			$post['name']				= _AEC_INST_ROOT_GROUP_NAME;
			$post['desc']				= _AEC_INST_ROOT_GROUP_DESC;
			$post['reveal_child_items']	= 1;
		}

		// Filter out fixed variables
		$fixed = array( 'active', 'visible', 'name', 'desc' );

		foreach ( $fixed as $varname ) {
			$this->$varname = $post[$varname];
			unset( $post[$varname] );
		}

		// Filter out params
		$fixed = array( 'color', 'icon', 'reveal_child_items', 'symlink', 'notauth_redirect', 'micro_integrations' );

		$params = array();
		foreach ( $fixed as $varname ) {
			if ( !isset( $post[$varname] ) ) {
				continue;
			}

			$params[$varname] = $post[$varname];

			unset( $post[$varname] );
		}

		$this->saveParams( $params );

		// Filter out restrictions
		$fixed = aecRestrictionHelper::paramList();

		$restrictions = array();
		foreach ( $fixed as $varname ) {
			if ( !isset( $post[$varname] ) ) {
				continue;
			}

			$restrictions[$varname] = $post[$varname];

			unset( $post[$varname] );
		}

		$this->restrictions = $restrictions;

		// There might be deletions set for groups
		foreach ( $post as $varname => $content ) {
			if ( strpos( $varname, 'group_delete_' ) !== false ) {
				$parentid = (int) str_replace( 'group_delete_', '', $varname );

				ItemGroupHandler::removeChildren( $groupid, array( $parentid ), 'group' );

				unset( $post[$varname] );
			}
		}

		// The rest of the vars are custom params
		$custom_params = array();
		foreach ( $post as $varname => $content ) {
			if ( substr( $varname, 0, 4 ) != 'mce_' ) {
				$custom_params[$varname] = $content;
			}
			unset( $post[$varname] );
		}

		$this->custom_params = $custom_params;
	}

	function saveParams( $params )
	{
		$this->params = $params;
	}

	function delete()
	{
		$database = &JFactory::getDBO();

		if ( $this->id == 1 ) {
			return false;
		}

		// Delete possible item connections
		$query = 'DELETE FROM #__acctexp_itemxgroup'
				. ' WHERE `group_id` = \'' . $this->id . '\''
				. ' AND `type` = \'item\''
				;
		$database->setQuery( $query );
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		// Delete possible group connections
		$query = 'DELETE FROM #__acctexp_itemxgroup'
				. ' WHERE `group_id` = \'' . $this->id . '\''
				. ' AND `type` = \'group\''
				;
		$database->setQuery( $query );
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		return parent::delete();
	}
}

class itemXgroup extends JTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var string */
	var $type				= null;
	/** @var int */
	var $item_id			= null;
	/** @var int */
	var $group_id			= null;

	function itemXgroup( &$db )
	{
		parent::__construct( '#__acctexp_itemxgroup', 'id', $db );
	}

	function createNew( $type, $item_id, $group_id )
	{
		$this->id		= 0;
		$this->type		= $type;
		$this->item_id	= $item_id;
		$this->group_id	= $group_id;

		$this->check();
		$this->store();

		return true;
	}

}

class ItemRelationHandler
{
	/**
	 * Well well, we have lots of similar stuff going on
	 * maybe we need a root relation handler that others can bind to
	 * in any case, the ItemRelationHandler should do stuff like
	 * keeping track of similar or equal plans or groups
	 */
}

class SubscriptionPlanHandler
{
	function getPlanList( $limitstart=false, $limit=false, $use_order=false )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
			 	. ' FROM #__acctexp_plans'
			 	. ' GROUP BY ' . ( $use_order ? '`ordering`' : '`id`' )
			 	;

		if ( !empty( $limitstart ) && !empty( $limit ) ) {
			$query .= 'LIMIT ' . $limitstart . ',' . $limit;
		}

		$database->setQuery( $query );

		$rows = $database->loadResultArray();
		if ( $database->getErrorNum() ) {
			echo $database->stderr();
			return false;
		} else {
			return $rows;
		}
	}

	function getActivePlanList()
	{
		$database = &JFactory::getDBO();

		// get entry Plan selection
		$available_plans	= array();
		$available_plans[]	= mosHTML::makeOption( '0', _PAYPLAN_NOPLAN );

		$query = 'SELECT `id` AS value, `name` AS text'
				. ' FROM #__acctexp_plans'
				. ' WHERE `active` = \'1\''
				;
		$database->setQuery( $query );
		$dbaplans = $database->loadObjectList();

	 	if ( is_array( $dbaplans ) ) {
	 		$available_plans = array_merge( $available_plans, $dbaplans );
	 	}

		return $available_plans;
	}

	function getFullPlanList( $limitstart=false, $limit=false, $subselect=array() )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT *'
				. ' FROM #__acctexp_plans'
				. ( empty( $subselect ) ? '' : ' WHERE id IN (' . implode( ',', $subselect ) . ')' )
				. ' GROUP BY `id`'
				. ' ORDER BY `ordering`'
			 	;

		if ( !empty( $limitstart ) && !empty( $limit ) ) {
			$query .= 'LIMIT ' . $limitstart . ',' . $limit;
		}

		$database->setQuery( $query );

		$rows = $database->loadObjectList();
		if ( $database->getErrorNum() ) {
			echo $database->stderr();
			return false;
		} else {
			return $rows;
		}
	}

	function getPlanUserlist( $planid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `userid`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `plan` = \'' . $database->getEscaped( $planid ) . '\' AND ( `status` = \'Active\' OR `status` = \'Trial\' ) '
				;
		$database->setQuery( $query );

		return $database->loadResultArray();
	}

	function PlanStatus( $planid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `active`'
				. ' FROM #__acctexp_plans'
				. ' WHERE `id` = \'' . $database->getEscaped( $planid ) . '\''
				;
		$database->setQuery( $query );

		return $database->loadResult();
	}

	function listPlans()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
				. ' FROM #__acctexp_plans'
				;
		$database->setQuery( $query );

		return $database->loadResultArray();
	}
}

class SubscriptionPlan extends serialParamDBTable
{
	/** @var int Primary key */
	var $id 				= null;
	/** @var int */
	var $active				= null;
	/** @var int */
	var $visible			= null;
	/** @var int */
	var $ordering			= null;
	/** @var string */
	var $name				= null;
	/** @var string */
	var $desc				= null;
	/** @var string */
	var $email_desc			= null;
	/** @var text */
	var $params 			= null;
	/** @var text */
	var $custom_params		= null;
	/** @var text */
	var $restrictions		= null;
	/** @var text */
	var $micro_integrations	= null;

	function SubscriptionPlan( &$db )
	{
		parent::__construct( '#__acctexp_plans', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'params', 'custom_params', 'restrictions', 'micro_integrations' );
	}

	function getProperty( $name )
	{
		if ( isset( $this->$name ) ) {
			return stripslashes( $this->$name );
		} else {
			return null;
		}
	}

	function checkVisibility( $metaUser )
	{
		if ( !$this->visible ) {
			return false;
		} else {
			return $this->checkPermission( $metaUser );
		}
	}

	function checkPermission( $metaUser )
	{
		if ( !$this->active ) {
			return false;
		}

		$restrictions = $this->getRestrictionsArray();

		return aecRestrictionHelper::checkRestriction( $restrictions, $metaUser );
	}

	function applyPlan( $user, $processor = 'none', $silent = 0, $multiplicator = 1, $invoice = null, $tempparams = null )
	{
		$database = &JFactory::getDBO();

		global $mainframe, $aecConfig;

		$forcelifetime = false;

		if ( is_string( $multiplicator ) ) {
			if ( strcmp( $multiplicator, 'lifetime' ) === 0 ) {
				$forcelifetime = true;
			}
		} elseif ( is_int( $multiplicator ) && ( $multiplicator < 1 ) ) {
			$multiplicator = 1;
		}

		if ( empty( $user ) ) {
			return false;
		}
		if ( is_object( $user ) ) {
			if ( is_a( $user, 'metaUser' ) ) {
				$metaUser = $user;
			} elseif( is_a( $user, 'Subscription' ) ) {
				$metaUser = new metaUser( $user->userid );

				$metaUser->focusSubscription = $user;
			}
		} else {
			$metaUser = new metaUser( $user );
		}

		if ( !isset( $this->params['make_primary'] ) ) {
			$this->params['make_primary'] = 1;
		}

		if ( !$metaUser->hasSubscription ) {
			$status = $metaUser->establishFocus( $this, $processor, false );

			if ( !empty( $this->params['update_existing'] ) && ( $status == 'existing') ) {
				$is_pending	= ( strcmp( $metaUser->focusSubscription->status, 'Pending' ) === 0 );
				$is_trial	= ( strcmp( $metaUser->focusSubscription->status, 'Trial' ) === 0 );
			} else {
				$is_pending	= true;
				$is_trial	= false;
			}
		} else {
			$is_pending	= ( strcmp( $metaUser->focusSubscription->status, 'Pending' ) === 0 );
			$is_trial	= ( strcmp( $metaUser->focusSubscription->status, 'Trial' ) === 0 );
		}

		$comparison		= $this->doPlanComparison( $metaUser->focusSubscription );
		$renew = $metaUser->is_renewing();

		$lifetime		= $metaUser->focusSubscription->lifetime;

		$amount = "0.00";
		if ( ( $comparison['total_comparison'] === false ) || $is_pending ) {
			// If user is using global trial period he still can use the trial period of a plan
			if ( ( $this->params['trial_period'] > 0 ) && !$is_trial ) {
				$trial		= true;
				$value		= $this->params['trial_period'];
				$perunit	= $this->params['trial_periodunit'];
				$this->params['lifetime']	= 0; // We are entering the trial period. The lifetime will come at the renew.

				$amount		= $this->params['trial_amount'];
			} else {
				$trial		= false;
				$value		= $this->params['full_period'];
				$perunit	= $this->params['full_periodunit'];

				$amount		= $this->params['full_amount'];
			}
		} elseif ( !$is_pending ) {
			$trial		= false;
			$value		= $this->params['full_period'];
			$perunit	= $this->params['full_periodunit'];
			$amount		= $this->params['full_amount'];
		} else {
			return false;
		}

		if ( $this->params['lifetime'] || $forcelifetime ) {
			$metaUser->focusSubscription->expiration = '9999-12-31 00:00:00';
			$metaUser->focusSubscription->lifetime = 1;
		} else {
			$metaUser->focusSubscription->lifetime = 0;

			$value *= $multiplicator;

			if ( ( $comparison['comparison'] == 2 ) && !$lifetime ) {
				$metaUser->focusSubscription->setExpiration( $perunit, $value, 1 );
			} else {
				$metaUser->focusSubscription->setExpiration( $perunit, $value, 0 );
			}
		}

		if ( $is_pending ) {
			// Is new = set signup date
			$metaUser->focusSubscription->signup_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
			if ( ( $this->params['trial_period'] ) > 0 && !$is_trial ) {
				$status = 'Trial';
			} else {
				if ( $this->params['full_period'] || $this->params['lifetime'] ) {
					if ( !isset( $this->params['make_active'] ) ) {
						$status = 'Active';
					} else {
						$status = ( $this->params['make_active'] ? 'Active' : 'Pending' );
					}
				} else {
					// This should not happen
					$status = 'Pending';
				}
			}
		} else {
			// Renew subscription - Do NOT set signup_date
			if ( !isset( $this->params['make_active'] ) ) {
				$status = $trial ? 'Trial' : 'Active';
			} else {
				$status = ( $this->params['make_active'] ? ( $trial ? 'Trial' : 'Active' ) : 'Pending' );
			}
			$renew = 1;
		}

		$metaUser->focusSubscription->status = $status;
		$metaUser->focusSubscription->plan = $this->id;

		$metaUser->meta->addPlanID( $this->id );

		$metaUser->focusSubscription->lastpay_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$metaUser->focusSubscription->type = $processor;

		// Clear parameters
		$metaUser->focusSubscription->params = array();

		if ( is_object( $invoice ) ) {
			if ( !empty( $invoice->params ) ) {
				$tempparam = array();
				if ( !empty( $invoice->params['creator_ip'] ) ) {
					$tempparam['creator_ip'] = $invoice->params['creator_ip'];
				}

				if ( !empty( $tempparam ) ) {
					$metaUser->focusSubscription->addParams( $tempparam, 'params', false );
					$metaUser->focusSubscription->storeload();
				}
			}
		}

		$pp = new PaymentProcessor();
		if ( $pp->loadName( strtolower( $processor ) ) ) {
			$pp->init();
			$pp->getInfo();
			$metaUser->focusSubscription->recurring = $pp->is_recurring();
		} else {
			$metaUser->focusSubscription->recurring = 0;
		}

		if ( empty( $invoice ) ) {
			$invoice = new stdClass();
			$invoice->amount = $amount;
		}

		$exchange = $add = null;

		$result = $this->triggerMIs( 'action', $metaUser, $exchange, $invoice, $add, $silent );

		if ( $result === false ) {
			return false;
		}

		if ( $this->params['gid_enabled'] ) {
			$metaUser->instantGIDchange( $this->params['gid'] );
		}

		$metaUser->focusSubscription->storeload();

		if ( !( $silent || $aecConfig->cfg['noemails'] ) ) {
			$adminonly = $this->id !== $aecConfig->cfg['entry_plan'];

			$metaUser->focusSubscription->sendEmailRegistered( $renew, $adminonly );
		}

		$result = $this->triggerMIs( 'afteraction', $metaUser, $exchange, $invoice, $add, $silent );

		if ( $result === false ) {
			return false;
		}

		return $renew;
	}

	function getTermsForUser( $recurring, $metaUser )
	{
		if ( $metaUser->hasSubscription ) {
			return $this->getTerms( $recurring, $metaUser->objSubscription, $metaUser );
		} else {
			return $this->getTerms( $recurring, false, $metaUser );
		}
	}

	function getTerms( $recurring=false, $user_subscription=false, $metaUser=false )
	{
		$plans_comparison		= false;
		$plans_comparison_total	= false;
		$is_trial				= 0;

		if ( is_object( $metaUser ) ) {
			if ( is_object( $metaUser->objSubscription ) ) {
				$comparison				= $this->doPlanComparison( $metaUser->focusSubscription );
				$plans_comparison		= $comparison['comparison'];
				$plans_comparison_total	= $comparison['total_comparison'];
				$is_trial				= ( strcmp( $metaUser->focusSubscription->status, 'Trial' ) === 0 );
			}
		} elseif ( is_object( $user_subscription ) ) {
			$comparison				= $this->doPlanComparison( $user_subscription );
			$plans_comparison		= $comparison['comparison'];
			$plans_comparison_total	= $comparison['total_comparison'];
			$is_trial				= ( strcmp( $user_subscription->status, 'Trial' ) === 0 );
		}

		if ( !isset( $this->params['full_free'] ) ) {
			$this->params['full_free'] = false;
		}

		$allow_trial = ( $plans_comparison === false ) && ( $plans_comparison_total === false ) && !$is_trial;

		$terms = new mammonTerms();
		$terms->readParams( $this->params, $allow_trial );

		if ( !$allow_trial && ( count( $terms->terms ) > 1 ) ) {
			$terms->incrementPointer();
		}

		if ( !empty( $this->micro_integrations ) && ( is_object( $user_subscription ) || is_object( $metaUser ) ) ) {
			$mih = new microIntegrationHandler();

			if ( !is_object( $metaUser ) ) {
				$metaUser = new metaUser( $user_subscription->userid );
			}

			$mih->applyMIs( $terms, $this, $metaUser );
		}

		return $terms;
	}

	function doPlanComparison( $user_subscription )
	{
		$database = &JFactory::getDBO();

		$return['total_comparison']	= false;
		$return['comparison']		= false;

		if ( !empty( $user_subscription->plan ) ) {
			if ( !empty( $user_subscription->used_plans ) ) {
				$plans_comparison	= false;

				if ( is_array( $user_subscription->used_plans ) ) {
					foreach ( $user_subscription->used_plans as $planid => $pusage ) {
						if ( $planid ) {
							if ( empty( $planid ) ){
								continue;
							}

							$used_subscription = new SubscriptionPlan( $database );
							$used_subscription->load( $planid );

							if ( $this->id === $used_subscription->id ) {
								$used_comparison = 2;
							} elseif ( empty( $this->params['similarplans'] ) && empty( $this->params['equalplans'] ) ) {
								$used_comparison = false;
							} else {
								$used_comparison = $this->compareToPlan( $used_subscription );
							}

							if ( $used_comparison > $plans_comparison ) {
								$plans_comparison = $used_comparison;
							}
							unset( $used_subscription );
						}
					}
					$return['total_comparison'] = $plans_comparison;
				}
			}

			$last_subscription = new SubscriptionPlan( $database );
			$last_subscription->load( $user_subscription->plan );

			if ( $this->id === $last_subscription->id ) {
				$return['comparison'] = 2;
			} else {
				$return['comparison'] = $this->compareToPlan( $last_subscription );
			}
		}

		$return['full_comparison'] = ( ( $return['comparison'] === false ) && ( $return['total_comparison'] === false ) );

		return $return;
	}

	function compareToPlan( $plan )
	{
		if ( !isset( $this->params['similarplans'] ) ) {
			$this->params['similarplans'] = array();
		}

		if ( !isset( $plan->params['similarplans'] ) ) {
			$plan->params['similarplans'] = array();
		}

		if ( !isset( $this->params['equalplans'] ) ) {
			$this->params['equalplans'] = array();
		}

		if ( !isset( $plan->params['equalplans'] ) ) {
			$plan->params['equalplans'] = array();
		}

		$spg1	= $this->params['similarplans'];
		$spg2	= $plan->params['similarplans'];

		$epg1	= $this->params['equalplans'];
		$epg2	= $plan->params['equalplans'];

		if ( empty( $spg1 ) && empty( $spg2 ) && empty( $epg1 ) && empty( $epg2 ) ) {
			return false;
		}

		if ( in_array( $this->id, $epg2 ) || in_array( $plan->id, $epg1 ) ) {
			return 2;
		} elseif ( in_array( $this->id, $spg2 ) || in_array( $plan->id, $spg1 ) ) {
			return 1;
		} else {
			return false;
		}
	}

	function getMIformParams( $metaUser, $errors=array() )
	{
		$mis = $this->getMicroIntegrations();

		if ( !empty( $mis ) ) {
			$database = &JFactory::getDBO();

			$params = array();
			$lists = array();
			foreach ( $mis as $mi_id ) {

				$mi = new MicroIntegration( $database );
				$mi->load( $mi_id );

				if ( !$mi->callIntegration() ) {
					continue;
				}

				$miform_params = $mi->getMIformParams( $this, $metaUser, $errors );

				if ( !empty( $miform_params['lists'] ) ) {
					foreach ( $miform_params['lists'] as $lname => $lcontent ) {
						$lists[$lname] = $lcontent;
					}

					unset( $miform_params['lists'] );
				}

				foreach ( $miform_params as $pk => $pv ) {
					$params[$pk] = $pv;
				}
			}

			$params['lists'] = $lists;

			return $params;
		} else {
			return false;
		}
	}

	function verifyMIformParams( $metaUser )
	{
		$mis = $this->getMicroIntegrations();

		if ( !empty( $mis ) ) {
			$database = &JFactory::getDBO();

			$v = array();
			foreach ( $mis as $mi_id ) {
				$mi = new MicroIntegration( $database );
				$mi->load( $mi_id );

				if ( !$mi->callIntegration() ) {
					continue;
				}

				$verify = $mi->verifyMIform( $this, $metaUser );

				if ( !empty( $verify ) && is_array( $verify ) ) {
					$v[] = array_merge( array( 'id' => $mi->id ), $verify );
				}
			}

			if ( empty( $v ) ) {
				return true;
			} else {
				return $v;
			}
		} else {
			return true;
		}
	}

	function getMIforms( $metaUser, $errors=array() )
	{
		$params = $this->getMIformParams( $metaUser, $errors );

		if ( empty( $params ) ) {
			return false;
		} else {
			$lists = $params['lists'];
			unset( $params['lists'] );

			if ( !empty( $params ) ) {
			$settings = new aecSettings ( 'mi', 'frontend_forms' );
			$settings->fullSettingsArray( $params, array(), $lists ) ;

			$aecHTML = new aecHTML( $settings->settings, $settings->lists );
			return "<table>" . $aecHTML->returnFull( true, true, true ) . "</table>";
			} else {
				return null;
			}
		}
	}

	function getMicroIntegrations( $inherited=false )
	{
		$database = &JFactory::getDBO();

		if ( $inherited ) {
			$milist = array();
		} else {
			if ( empty( $this->micro_integrations ) ) {
				$milist = array();
			} else {
				$milist = $this->micro_integrations;
			}
		}

		// Find parent ItemGroups to attache their MIs
		$parents = ItemGroupHandler::getParents( $this->id );

		foreach ( $parents as $parent ) {
			$g = new ItemGroup( $database );
			$g->load( $parent );

			if ( !empty( $g->params['micro_integrations'] ) ) {
				$milist = array_merge( $milist, $g->params['micro_integrations'] );
			}
		}

		if ( empty( $milist ) ) {
			return false;
		}

		array_unique($milist);

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `id` IN (' . $this->_db->getEscaped( implode( ',', $milist ) ) . ')'
	 			. ' AND `active` = \'1\''
				. ' ORDER BY `ordering` ASC'
				;
		$this->_db->setQuery( $query );
		$list = $this->_db->loadResultArray();

		return $list;
	}

	function triggerMIs( $action, &$metaUser, &$exchange, &$invoice, &$add, &$silent )
	{
		global $aecConfig;

		$micro_integrations = $this->getMicroIntegrations();

		if ( is_array( $micro_integrations ) ) {
			foreach ( $micro_integrations as $mi_id ) {
				$mi = new microIntegration( $this->_db );

				if ( !$mi->mi_exists( $mi_id ) ) {
					continue;
				}

				$mi->load( $mi_id );

				if ( !$mi->callIntegration() ) {
					continue;
				}

				$is_email = strcmp( $mi->class_name, 'mi_email' ) === 0;

				// TODO: Only trigger if this is not email or made not silent
				if ( method_exists( $metaUser, $action ) ) {
					if ( $mi->$action( $metaUser, null, $invoice, $this ) === false ) {
						if ( $aecConfig->cfg['breakon_mi_error'] ) {
							return false;
						}
					}
				} else {
					if ( $mi->relayAction( $metaUser, $exchange, $invoice, $this, $action, $add ) === false ) {
						if ( $aecConfig->cfg['breakon_mi_error'] ) {
							return false;
						}
					}
				}

				unset( $mi );
			}
		}
	}

	function getProcessorParameters( $processorid )
	{
		$procparams = array();
		if ( !empty( $this->custom_params ) ) {
			foreach ( $this->custom_params as $name => $value ) {
				$realname = explode( '_', $name, 2 );

				if ( ( $realname[0] == $processorid ) && isset( $realname[1] ) ) {
					$procparams[$realname[1]] = $value;
				}
			}
		}

		return $procparams;
	}

	function getRestrictionsArray()
	{
		return aecRestrictionHelper::getRestrictionsArray( $this->restrictions );
	}

	function savePOSTsettings( $post )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $post['id'] ) ) {
			$planid = $post['id'];
		} else {
			// Fake knowing the planid if is zero.
			$planid = $this->getMax() + 1;
		}

		if ( isset( $post['id'] ) ) {
			unset( $post['id'] );
		}

		if ( !empty( $post['add_group'] ) ) {
			ItemGroupHandler::setChildren( $post['add_group'], array( $planid ) );
			unset( $post['add_group'] );
		}

		if ( empty( $post['micro_integrations'] ) ) {
			$post['micro_integrations'] = array();
		}

		if ( !empty( $post['micro_integrations_plan'] ) ) {
			foreach ( $post['micro_integrations_plan'] as $miname ) {
				// Create new blank MIs
				$mi = new microIntegration( $database );
				$mi->load(0);

				$mi->class_name = $miname;

				if ( !$mi->callIntegration( true ) ) {
					continue;
				}

				$mi->hidden = 1;

				$mi->storeload();

				// Add in new MI id
				$post['micro_integrations'][] = $mi->id;
			}

			$mi->reorder();

			unset( $post['micro_integrations_plan'] );
		}

		if ( !empty( $post['micro_integrations_hidden'] ) ) {
			// Recover hidden MI relation to full list
			$post['micro_integrations'] = array_merge( $post['micro_integrations'], $post['micro_integrations_hidden'] );

			unset( $post['micro_integrations_hidden'] );
		}

		if ( !empty( $post['micro_integrations_inherited'] ) ) {
			unset( $post['micro_integrations_inherited'] );
		}

		// Update MI settings
		foreach ( $post['micro_integrations'] as $miid ) {
			$mi = new microIntegration( $database );
			$mi->load( $miid );

			// Only act special on hidden MIs
			if ( !$mi->hidden ) {
				continue;
			}

			$prefix = 'MI_' . $miid . '_';

			// Get Settings from post array
			$settings = array();
			foreach ( $post as $name => $value ) {
				if ( strpos( $name, $prefix ) === 0 ) {
					$rname = str_replace( $prefix, '', $name );

					$settings[$rname] = $value;
					unset( $post[$name] );
				}
			}

			// If we indeed HAVE settings, more to come here
			if ( !empty( $settings ) ) {
				$mi->savePostParams( $settings );

				// First, check whether there is already an MI with the exact same settings
				$similarmis = microIntegrationHandler::getMIList( false, false, true, false, $mi->classname );

				$similarmi = false;
				if ( !empty( $similarmis ) ) {
					foreach ( $similarmis as $miobj ) {
						if ( $miobj->id == $mi->id ) {
							continue;
						}

						if ( microIntegrationHandler::compareMIs( $mi, $miobj->id ) ) {
							$similarmi = $miobj->id;
						}
					}
				}

				if ( $similarmi ) {
					// We have a similar MI - unset old reference
					$ref = array_search( $mi->id, $post['micro_integrations'] );
					unset( $post['micro_integrations'][$ref] );

					// No MI is similar, lets check for other plans
					$plans = microIntegrationHandler::getPlansbyMI( $mi->id );

					foreach ( $plans as $cid => $pid ) {
						if ( $pid == $this->id ) {
							unset( $plans[$cid] );
						}
					}

					if ( count( $plans ) <= 1 ) {
						// No other plan depends on this MI, just delete it
						$mi->delete;
					}

					// Set new MI
					$post['micro_integrations'][] = $similarmi;
				} else {
					// No MI is similar, lets check for other plans
					$plans = microIntegrationHandler::getPlansbyMI( $mi->id );

					foreach ( $plans as $cid => $pid ) {
						if ( $pid == $this->id ) {
							unset( $plans[$cid] );
						}
					}

					if ( count( $plans ) > 1 ) {
						// We have other plans depending on THIS setup of the MI, unset original reference
						$ref = array_search( $mi->id, $post['micro_integrations'] );
						unset( $post['micro_integrations'][$ref] );

						// And create new MI
						$mi->id = 0;

						$mi->storeload();

						// Set new MI
						$post['micro_integrations'][] = $mi->id;
					} else {
						$mi->storeload();
					}
				}
			}
		}

		// Filter out fixed variables
		$fixed = array( 'active', 'visible', 'name', 'desc', 'email_desc', 'micro_integrations' );

		foreach ( $fixed as $varname ) {
			if ( isset( $post[$varname] ) ) {
				$this->$varname = $post[$varname];

				unset( $post[$varname] );
			} else {
				$this->$varname = '';
			}
		}

		// Get selected processors ( have to be filtered out )

		$processors = array();
		foreach ( $post as $key => $value ) {
			if ( ( strpos( $key, 'processor_' ) === 0 ) && ( $value == 'on') ) {
				$ppid = str_replace( 'processor_', '', $key );

				if ( !in_array( $ppid, $processors ) ) {
					$processors[] = $ppid;
					unset( $post[$key] );
				}
			}
		}

		// Filter out params
		$fixed = array( 'full_free', 'full_amount', 'full_period', 'full_periodunit',
						'trial_free', 'trial_amount', 'trial_period', 'trial_periodunit',
						'gid_enabled', 'gid', 'lifetime', 'standard_parent',
						'fallback', 'similarplans', 'equalplans', 'make_active',
						'make_primary', 'update_existing', 'customthanks', 'customtext_thanks_keeporiginal',
						'customamountformat', 'customtext_thanks', 'override_activation', 'override_regmail',
						'notauth_redirect'
						);

		$params = array();
		foreach ( $fixed as $varname ) {
			if ( !isset( $post[$varname] ) ) {
				continue;
			}

			$params[$varname] = $post[$varname];

			unset( $post[$varname] );
		}

		$params['processors'] = $processors;

		$this->saveParams( $params );

		// Filter out restrictions
		$fixed = aecRestrictionHelper::paramList();

		$restrictions = array();
		foreach ( $fixed as $varname ) {
			if ( !isset( $post[$varname] ) ) {
				continue;
			}

			$restrictions[$varname] = $post[$varname];

			unset( $post[$varname] );
		}

		$this->restrictions = $restrictions;

		// There might be deletions set for groups
		foreach ( $post as $varname => $content ) {
			if ( strpos( $varname, 'group_delete_' ) !== false ) {
				$parentid = (int) str_replace( 'group_delete_', '', $varname );

				ItemGroupHandler::removeChildren( $planid, array( $parentid ) );

				unset( $post[$varname] );
			}
		}

		// The rest of the vars are custom params
		$custom_params = array();
		foreach ( $post as $varname => $content ) {
			if ( substr( $varname, 0, 4 ) != 'mce_' ) {
				$custom_params[$varname] = $content;
			}
			unset( $post[$varname] );
		}

		$this->custom_params = $custom_params;
	}

	function saveParams( $params )
	{
		$database = &JFactory::getDBO();

		// If the admin wants this to be a free plan, we have to make this more explicit
		// Setting processors to zero and full_free
		if ( $params['full_free'] && ( $params['processors'] == '' ) ) {
			$params['processors']	= '';
		} elseif ( !$params['full_amount'] || ( $params['full_amount'] == '0.00' ) || ( $params['full_amount'] == '' ) ) {
			$params['full_free']	= 1;
			$params['processors']	= '';
		}

		// Correct a malformed Full Amount
		if ( !strlen( $params['full_amount'] ) ) {
			$params['full_amount']	= '0.00';
			$params['full_free']	= 1;
			$params['processors']	= '';
		} else {
			$params['full_amount'] = AECToolbox::correctAmount( $params['full_amount'] );
		}

		// Correct a malformed Trial Amount
		if ( strlen( $params['trial_amount'] ) ) {
			$params['trial_amount'] = AECToolbox::correctAmount( $params['trial_amount'] );
		}

		// Prevent setting Trial Amount to 0.00 if no free trial was asked for
		if ( !$params['trial_free'] && ( strcmp( $params['trial_amount'], "0.00" ) === 0 ) ) {
			$params['trial_amount'] = '';
		}

		$this->params = $params;
	}
}

class logHistory extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $proc_id;
	/** @var string */
	var $proc_name;
	/** @var int */
	var $user_id;
	/** @var string */
	var $user_name;
	/** @var int */
	var $plan_id;
	/** @var string */
	var $plan_name;
	/** @var datetime */
	var $transaction_date	= null;
	/** @var string */
	var $amount;
	/** @var string */
	var $invoice_number;
	/** @var string */
	var $response;

	/**
	* @param database A database connector object
	*/
	function logHistory( &$db )
	{
		parent::__construct( '#__acctexp_log_history', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'response' );
	}

	function entryFromInvoice( $objInvoice, $response, $pp )
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		$user = new JTableUser( $database );
		$user->load( $objInvoice->userid );

		$plan = new SubscriptionPlan( $database );
		$plan->load( $objInvoice->usage );

		$this->proc_id			= $pp->id;
		$this->proc_name		= $pp->processor_name;
		$this->user_id			= $user->id;
		$this->user_name		= $user->username;
		$this->plan_id			= $plan->id;
		$this->plan_name		= $plan->name;
		$this->transaction_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->amount			= $objInvoice->amount;
		$this->invoice_number	= $objInvoice->invoice_number;
		$this->response			= $response;

		$short	= 'history entry';
		$event	= 'Processor (' . $pp->processor_name . ') notification for ' . $objInvoice->invoice_number;
		$tags	= 'history,processor,payment';
		$params = array( 'invoice_number' => $objInvoice->invoice_number );

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, $tags, $event, 2, $params );

		$this->check();
		$this->store();
	}
}

class aecTempToken extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var string */
	var $token 				= null;
	/** @var text */
	var $content 			= null;
	/** @var datetime */
	var $created_date	 	= null;
	/** @var string */
	var $ip		 			= null;

	function aecTempToken(&$db)
	{
		parent::__construct( '#__acctexp_temptoken', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'content' );
	}

	function getToken()
	{
		if ( aecJoomla15check() ) {
			$session =& JFactory::getSession();
			return $session->getToken();
		} else {
			global $mainframe;

			return $mainframe->_session->session_id;
		}
	}

	function getComposite()
	{
		$token = $this->getToken();

		$this->getByToken( $token );

		if ( empty( $this->content ) && !empty( $_COOKIE['aec_token'] ) ) {
			$token = $_COOKIE['aec_token'];

			$this->getByToken( $token );
		}

		if ( empty( $this->token ) ) {
			$this->token = $token;
		}

		if ( empty( $this->ip ) ) {
			global $mainframe;

			$this->created_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
			$this->ip			= $_SERVER['REMOTE_ADDR'];
		}
	}

	function getByToken( $token )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
		. ' FROM #__acctexp_temptoken'
		. ' WHERE `token` = \'' . $token . '\''
		;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( empty( $id ) ) {
			$query = 'SELECT `id`'
			. ' FROM #__acctexp_temptoken'
			. ' WHERE `ip` = \'' . $_SERVER['REMOTE_ADDR'] . '\''
			;
			$database->setQuery( $query );
			$id = $database->loadResult();
		}

		$this->load( $id );

		if ( $this->ip != $_SERVER['REMOTE_ADDR'] ) {
			$this->delete();

			$this->load(0);
		}
	}

	function create( $content, $token=null )
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		if ( empty( $token ) ) {
			if ( aecJoomla15check() ) {
				$session =& JFactory::getSession();
				$token = $session->getToken();
			} else {
				$token = $mainframe->_session->session_id;
			}
		}

		$query = 'SELECT `id`'
		. ' FROM #__acctexp_temptoken'
		. ' WHERE `token` = \'' . $token . '\''
		. ' OR `ip` = \'' . $_SERVER['REMOTE_ADDR'] . '\''
		;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( $id ) {
			$this->id		= $id;
		}

		if ( empty( $token ) ) {
			$token = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		}

		$this->token		= $token;
		$this->content		= $content;
		$this->created_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->ip			= $_SERVER['REMOTE_ADDR'];

		setcookie( 'aec_token', $token, time()+600 );

		return $this->storeload();
	}
}
class InvoiceFactory
{
	/** @var int */
	var $userid			= null;
	/** @var string */
	var $usage			= null;
	/** @var string */
	var $processor		= null;
	/** @var string */
	var $invoice		= null;
	/** @var int */
	var $confirmed		= null;

	function InvoiceFactory( $userid=null, $usage=null, $group=null, $processor=null, $invoice=null, $passthrough=null )
	{
		$database = &JFactory::getDBO();
		$user = &JFactory::getUser();

		global $mainframe;

		$this->userid = $userid;
		$this->authed = false;

		require_once( $mainframe->getPath( 'front_html', 'com_acctexp' ) );

		// Check whether this call is legitimate
		if ( !$user->id ) {
			if ( !$this->userid ) {
				// Its ok, this is a registration/subscription hybrid call
				$this->authed = true;
			} elseif ( $this->userid ) {
				if ( AECToolbox::quickVerifyUserID( $this->userid ) === true ) {
					// This user is not expired, so he could log in...
					return aecNotAuth();
				} else {
					$this->userid = $database->getEscaped( $userid );
				}
			}
		} else {
			// Overwrite the given userid when user is logged in
			$this->userid = $user->id;
			$this->authed = true;
		}

		// Init variables
		$this->usage			= $usage;
		$this->group			= $group;
		$this->processor		= $processor;
		$this->invoice_number	= $invoice;

		if ( empty( $passthrough ) ) {
			$passthrough = aecPostParamClear( $_POST );
		}

		if ( isset( $passthrough['aec_passthrough'] ) ) {
			if ( is_array( $passthrough['aec_passthrough'] ) ) {
				$this->passthrough = $passthrough['aec_passthrough'];
			} else {
				$this->passthrough = unserialize( base64_decode( $passthrough['aec_passthrough'] ) );
			}

			unset( $passthrough['aec_passthrough'] );

			if ( !empty( $passthrough ) ) {
				foreach ( $passthrough as $k => $v ) {
					$this->passthrough[$k] = $v;
				}
			}
		} else {
			$this->passthrough = $passthrough;
		}

		// Delete set userid if it doesn't exist
		if ( !is_null( $this->userid ) ) {
			$query = 'SELECT `id`'
					. ' FROM #__users'
					. ' WHERE `id` = \'' . $this->userid . '\'';
			$database->setQuery( $query );

			if ( !$database->loadResult() ) {
				$this->userid = null;
			}
		}

		if ( $this->usage ) {
			$this->verifyUsage();
		}
	}

	function verifyUsage()
	{
		$database = &JFactory::getDBO();

		$this->loadMetaUser( false, true );

		$row = new SubscriptionPlan( $database );
		$row->load( $this->usage );

		$restrictions = $row->getRestrictionsArray();

		if ( !aecRestrictionHelper::checkRestriction( $restrictions, $this->metaUser ) ) {
			return aecNotAuth();
		}

		if ( !ItemGroupHandler::checkParentRestrictions( $row, 'item', $this->metaUser ) ) {
			return aecNotAuth();
		}
	}

	function getPassthrough( $unset=null )
	{
		if ( !empty( $this->passthrough ) ) {
			$passthrough = $this->passthrough;

			$unsets = array( 'id', 'gid', 'forget', 'task', 'option' );

			switch ( $unset ) {
				case 'userdetails':
					$unsets[] = 'name';
					$unsets[] = 'username';
					$unsets[] = 'password';
					$unsets[] = 'password2';
					$unsets[] = 'email';
					break;
				case 'usage':
					$unsets[] = 'usage';
					$unsets[] = 'processor';
					$unsets[] = 'recurring';
					break;
				default:
					break;
			}

			foreach ( $unsets as $n ) {
				if ( isset( $passthrough[$n] ) ) {
					unset( $passthrough[$n] );
				}
			}

			return base64_encode( serialize( $passthrough ) );
		} else {
			return "";
		}
	}

	function puffer( $option )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $this->usage ) && ( strpos( $this->usage, 'c' ) === false ) ) {
			// get the payment plan
			$this->plan = new SubscriptionPlan( $database );
			$this->plan->load( $this->usage );

			if ( !is_object( $this->plan ) ) {
				return aecNotAuth();
			}
		} else {
			if ( empty( $this->metaUser ) ) {
				return aecNotAuth();
			}

			$this->getCart();

			$this->usage = 'c.' . $this->cartobject->id;

			$procs = aecCartHelper::getCartProcessorList( $this->cartobject );

			if ( count( $procs ) > 1 ) {
				$pgroups = aecCartHelper::getCartProcessorGroups( $this->cartobject );

				$procnames = PaymentProcessorHandler::getProcessorNameListbyId( $procs );

				$c	= false;
				$s	= array();
				$se	= true;

				foreach ( $pgroups as $pgid => $pgroup ) {
					if ( count( $pgroup['processors'] ) < 2 ) {
						if ( !empty( $pgroup['processors'][0] ) ) {
							$pgroups[$pgid]['processor'] = $pgroup['processors'][0];
						}

						continue;
					}

					$ex = array();
					if ( $c ) {
						$ex['head'] = null;
						$ex['desc'] = null;
					} else {
						$ex['head'] = "Select Payment Processor";
						$ex['desc'] = "There are a number of possible payment processors for one or more of your items, please select one below:<br />";
					}

					$ex['rows'] = array();

					$fname = 'cartgroup_'.$pgid.'_processor';

					$pgsel = aecGetParam( $fname, null, true, array( 'word', 'string' ) );

					$selection = false;
					if ( !is_null( $pgsel ) ) {
						if ( in_array( $pgsel, $pgroup['processors'] ) ) {
							$selection = $pgsel;
						}
					}

					if ( !empty( $selection ) ) {
						if ( count( $s ) > 0 ) {
							if ( !in_array( $selection, $s ) ) {
								$se = false;
							}
						}

						$pgroups[$pgid]['processor'] = $selection;
						$s[] = $selection;

						continue;
					} else {
						$ex['desc'] .= "<ul>";

						foreach ( $pgroup['members'] as $pgmember ) {
							$ex['desc'] .= "<li><strong>" . $this->cart[$pgmember]['name'] . "</strong><br /></li>";
						}

						$ex['desc'] .= "</ul>";

						foreach ( $pgroup['processors'] as $pid => $pgproc ) {
							$pgex = $pgproc;

							if ( strpos( $pgproc, '_recurring' ) ) {
								$pgex = str_replace( '_recurring', '', $pgproc );
								$recurring = true;
							} else {
								$recurring = false;
							}

							$ex['rows'][] = array( 'radio', $fname, $pgproc, true, $procnames[$pgex].( $recurring ? ' (recurring billing)' : '') );
						}
					}

					if ( !empty( $ex['rows'] ) ) {
						$c = true;

						$this->raiseException( $ex );
					}
				}

				if ( !$se ) {
					// We have different processors selected for this cart
					$prelg = array();
					foreach ( $pgroups as $pgid => $pgroup ) {
						$prelg[$pgroup['processor']][] = $pgroup;
					}

					$invoice_highest = 0;
					foreach ( $prelg as $processor => $pgroups ) {
						if ( strpos( $processor, '_recurring' ) ) {
							$processor_name = PaymentProcessor::getNameById( str_replace( '_recurring', '', $processor ) );

							$procrecurring = true;
						} else {
							$processor_name = PaymentProcessor::getNameById( $processor );

							$procrecurring = false;
						}

						$mpg = array_pop( array_keys( $pgroups ) );
						if ( ( count( $pgroups ) > 1 ) || ( count( $pgroups[$mpg]['members'] ) > 1 ) ) {
							// We have more than one item for this processor, create temporary cart
							$tempcart = new aecCart( $database );
							$tempcart->userid = $this->userid;

							foreach ( $pgroups as $pgr ) {
								foreach ( $pgr['members'] as $member ) {
									$r = $tempcart->addItem( array(), $this->cartobject->content[$member]['id'] );
								}
							}

							$tempcart->storeload();

							$carthash = 'c.' . $tempcart->id;

							// Create a cart invoice
							$invoice = new Invoice( $database );
							$invoice->create( $this->userid, $carthash, $processor_name, null, true, $this, $procrecurring );
						} else {
							// Only one item in this, create a simple invoice
							$member = $pgroups[$mpg]['members'][0];

							$invoice = new Invoice( $database );
							$invoice->create( $this->userid, $this->cartobject->content[$member]['id'], $processor_name, null, true, $this, $procrecurring );
						}

						$invoice->addParams( array( 'userselect_recurring' => $procrecurring ) );
						$invoice->storeload();

						if ( $invoice->amount == "0.00" ) {
							$invoice->pay();
						} elseif ( $invoice->amount > $invoice_highest ) {
							$finalinvoice = $invoice;
						}
					}

					$ex['head'] = "Invoice split up";
					$ex['desc'] = "The contents of your shopping cart cannot be processed in one go. This is why we have split up the invoice - you can pay for the first part right now and access the other parts as separate invoices later from your membership page.";
					$ex['rows'] = array();

					$this->raiseException( $ex );

					$this->invoice_number = $finalinvoice->invoice_number;
					$this->invoice = $finalinvoice;

					$this->touchInvoice( $option );

					$objUsage = $this->invoice->getObjUsage();

					if ( is_a( $objUsage, 'aecCart' ) ) {
						$this->cartobject = $objUsage;

						$this->getCart();
					} else {
						$this->plan = $objUsage;
					}
				} else {
					$mpg = array_pop( array_keys( $pgroups ) );

					if ( strpos( $pgroups[$mpg]['processor'], '_recurring' ) ) {
						$processor = str_replace( '_recurring', '', $pgroups[$mpg]['processor'] );
						$this->recurring = true;
					} else {
						$processor = $pgroups[$mpg]['processor'];
						$this->recurring = false;
					}

					$procname = PaymentProcessorHandler::getProcessorNamefromId( $processor );

					if ( !empty( $procname ) ) {
						$this->processor = $procname;
					}
				}
			} else {
				if ( isset( $procs[0] ) ) {
					$pgroups = aecCartHelper::getCartProcessorGroups( $this->cartobject );

					$proc = $pgroups[0]['processors'][0];

					if ( strpos( $proc, '_recurring' ) ) {
						$this->recurring = 1;

						$proc = str_replace( '_recurring', '', $proc );
					}

					$procname = PaymentProcessorHandler::getProcessorNamefromId( $proc );

					if ( !empty( $procname ) ) {
						$this->processor = $procname;
					}

					$this->plan = aecCartHelper::getCartItemObject( $this->cartobject, 0 );
				} else {
					$am = $this->cartobject->getAmount( $this->metaUser );

					if ( $am['amount'] == "0.00" ) {
						$this->processor = 'free';
					} else {
						$this->processor = 'none';
					}
				}
			}
		}

		if ( !empty( $this->processor ) ) {
			$this->pp					= false;
			$this->payment->method_name = _AEC_PAYM_METHOD_NONE;
			$this->payment->currency	= '';

			if ( !isset( $this->recurring ) ) {
				$this->recurring		= 0;
			}

			switch ( $this->processor ) {
				case 'free': $this->payment->method_name = _AEC_PAYM_METHOD_FREE; break;
				case 'none': break;
				default:
					$this->pp = new PaymentProcessor();
					if ( $this->pp->loadName( $this->processor ) ) {
						$this->pp->fullInit();
						if ( !empty( $this->plan ) ) {
							$this->pp->exchangeSettingsByPlan( $this->plan );
						}

						$this->payment->method_name	= $this->pp->info['longname'];

						// Check whether we have a recurring payment
						// If it has been selected just now, or earlier, check whether that is still permitted
						if ( isset( $_POST['recurring'] ) ) {
							$this->recurring	= $this->pp->is_recurring( $_POST['recurring'] );
						} else {
							$this->recurring	= $this->pp->is_recurring( $this->recurring );
						}

						$this->payment->currency	= isset( $this->pp->settings['currency'] ) ? $this->pp->settings['currency'] : '';
					} else {
						$short	= 'processor loading failure';
						$event	= 'Tried to load processor: ' . $this->processor;
						$tags	= 'processor,loading,error';
						$params = array();

						$eventlog = new eventLog( $database );
						$eventlog->issue( $short, $tags, $event, 128, $params );
					}
					break;
			}
		}

		$user_subscription = false;
		$this->renew = 0;

		if ( !empty( $this->userid ) ) {
			if ( !empty( $this->metaUser ) ) {
				$this->renew = count( $this->metaUser->meta->plan_history ) > 1;
			} elseif ( AECfetchfromDB::SubscriptionIDfromUserID( $this->userid ) ) {
				$user_subscription = new Subscription( $database );
				$user_subscription->loadUserID( $this->userid );

				if ( ( strcmp( $user_subscription->lastpay_date, '0000-00-00 00:00:00' ) !== 0 )  ) {
					$this->renew = true;
				}
			}
		}

		$this->payment->freetrial = 0;
		$this->payment->amount = null;

		if ( empty( $this->cart ) && !empty( $this->plan ) ) {
			$terms = $this->plan->getTermsForUser( $this->recurring, $this->metaUser );

			if ( !empty( $terms ) ) {
				if ( is_object( $terms->nextterm ) ) {
					$this->payment->amount = $terms->nextterm->renderTotal();

					if ( $terms->nextterm->free && ( $terms->nextterm->get( 'type' ) == 'trial' ) ) {
						$this->payment->freetrial = 1;
					}
				}
			} else {
				$this->payment->amount = null;
			}

			$this->items[] = array( 'item' => array( 'obj' => $this->plan ), 'terms' => $terms );
		} elseif( !empty( $this->cart ) ) {
			$this->getCart();

			$this->payment->amount = $this->cartobject->getAmount( $this->metaUser );
		}

		// Amend ->payment
		$this->payment->currency_symbol = AECToolbox::getCurrencySymbol( $this->payment->currency );

		$amount_array = explode( '.', $this->payment->amount );

		$this->payment->amount_significant	= $amount_array[0];

		if ( isset( $amount_array[1] ) ) {
			$this->payment->amount_decimal		= $amount_array[1];
		} else {
			$this->payment->amount_decimal		= '00';
		}

		if ( !empty( $this->plan ) ) {
			$this->payment->amount_format = AECToolbox::formatAmountCustom( $this, $this->plan );
		} else {
			$this->payment->amount_format = $this->payment->amount;
		}

		return;
	}

	function raiseException( $exception )
	{
		if ( empty( $this->exceptions ) ) {
			$this->exceptions = array();
		}

		$this->exceptions[] = $exception;
	}

	function hasExceptions()
	{
		return !empty( $this->exceptions );
	}

	function addressExceptions( $option )
	{
		global $mainframe;

		$hasform = false;

		$params = array();
		foreach ( $this->exceptions as $eid => $ex ) {
			// Convert Exception into actionable form

			if ( !empty( $ex['rows'] ) ) {
				$hasform = true;
			}

			foreach ( $ex['rows'] as $rid => $row ) {
				$params[$eid.'_'.$rid] = $row;
			}
		}

		$settings = new aecSettings ( 'exception', 'frontend_exception' );
		$settings->fullSettingsArray( $params, array(), array() ) ;

		$aecHTML = new aecHTML( $settings->settings, $settings->lists );

		if ( $hasform ) {
			$mainframe->SetPageTitle( _EXCEPTION_TITLE );
		} else {
			$mainframe->SetPageTitle( _EXCEPTION_TITLE_NOFORM );
		}

		Payment_HTML::exceptionForm( $option, $this, $aecHTML, $hasform );
	}

	function getCart()
	{
		if ( empty( $this->cartobject ) ) {
			$this->cartobject = aecCartHelper::getCartbyUserid( $this->userid );
		}

		if ( empty( $this->cartobject->content ) && !empty( $this->invoice->params['cart'] ) ) {
			$this->cartobject = $this->invoice->params['cart'];
		}

		$this->loadMetaUser();

		if ( !empty( $this->cartobject->id ) ) {
			$this->cart = $this->cartobject->getCheckout( $this->metaUser );
		}
	}

	function loadItems( $force=false )
	{
		$this->items = array();

		if ( empty( $this->cartobject ) ) {
			$database = &JFactory::getDBO();

			$terms = $this->plan->getTermsForUser( $this->recurring, $this->metaUser );

			if ( !empty( $this->plan ) ) {
				$c = $this->plan->doPlanComparison( $this->metaUser->objSubscription );

				// Do not allow a Trial if the user has used this or a similar plan
				if ( $terms->hasTrial && !$c['full_comparison'] ) {
					$terms->incrementPointer();
				}
			}

			$this->items[] = array(	'obj'		=> $this->plan,
									'name'		=> $this->plan->getProperty( 'name' ),
									'desc'		=> $this->plan->getProperty( 'desc' ),
									'quantity'	=> 1,
									'terms'		=> $terms
								);

			$this->cartobject = new aecCart( $database );
			$this->cartobject->addItem( array(), $this->plan );
		} else {
			$this->getCart();

			$this->payment->amount = $this->cartobject->getAmount( $this->metaUser );

			foreach ( $this->cart as $cid => $citem ) {
				if ( $citem['obj'] !== false ) {
					$this->items[$cid] = $citem;

					$terms = $citem['obj']->getTermsForUser( $this->recurring, $this->metaUser );

					$c = $citem['obj']->doPlanComparison( $this->metaUser->focusSubscription );

					// Do not allow a Trial if the user has used this or a similar plan
					if ( $terms->hasTrial && !$c['full_comparison'] ) {
						$terms->incrementPointer();
					}

					$this->items[$cid]['terms'] = $terms;
				} else {
					$terms = new mammonTerms();
					$term = new mammonTerm();

					$term->set( 'duration', array( 'none' => true ) );
					$term->set( 'type', 'total' );
					$term->addCost( $citem['cost'] );

					$terms->addTerm( $term );

					$this->items[] = array( 'cost' => $citem['cost'], 'terms' => $terms );
				}
			}
		}
	}

	function applyCoupons()
	{
		global $aecConfig;

		if ( !empty( $aecConfig->cfg['enable_coupons'] ) && !empty( $this->invoice->coupons ) ) {
			$coupons = $this->invoice->coupons;

			$cpsh = new couponsHandler( $this->metaUser, $this, $coupons );

			if ( !empty( $this->cartobject ) && !empty( $this->cart ) ) {
				$this->items = $cpsh->applyToCart( $this->items, $this->cartobject, $this->cart );

				if ( count( $cpsh->delete_list ) ) {
					foreach ( $cpsh->delete_list as $couponcode ) {
						$this->invoice->removeCoupon( $couponcode );
					}

					$this->invoice->storeload();
				}

				if ( $cpsh->affectedCart ) {
					// Reload cart object and cart - was changed by $cpsh
					$this->cartobject->reload();
					$this->getCart();

					$this->loadItems();
					$cpsh = new couponsHandler( $this->metaUser, $this, $coupons );
					$this->items = $cpsh->applyToCart( $this->items, $this->cartobject, $this->cart );
				}
			} else {
				$this->items = $cpsh->applyToItemList( $this->items );

				if ( count( $cpsh->delete_list ) ) {
					foreach ( $cpsh->delete_list as $couponcode ) {
						$this->invoice->removeCoupon( $couponcode );
					}

					$this->invoice->storeload();
				}
			}

			$cpsh_err = $cpsh->getErrors();

			if ( !empty( $cpsh_err ) ) {
				$this->errors = $cpsh_err;
			}

			if ( !empty( $this->cartobject ) && !empty( $this->cart ) ) {
				$cpsh_exc = $cpsh->getExceptions();

				if ( count( $cpsh_exc ) ) {
					foreach ( $cpsh_exc as $exception ) {
						$this->raiseException( $exception );
					}
				}
			}

			if ( !empty( $this->cart ) ) {
				$this->payment->amount = $this->cartobject->getAmount( $this->metaUser );
			}
		}
	}

	function addtoCart( $option, $usage )
	{
		if ( empty( $this->cartobject ) ) {
			$this->cartobject = aecCartHelper::getCartbyUserid( $this->userid );
		}

		if ( is_array( $usage ) ) {
			foreach ( $usage as $us ) {
				$this->cartobject->action( 'addItem', $us );
			}
		} else {
			$this->cartobject->action( 'addItem', $usage );
		}
	}

	function updateCart( $option, $data )
	{
		$update = array();
		foreach ( $data as $dn => $dv ) {
			if ( strpos( $dn, 'cartitem_' ) !== false ) {
				$n = str_replace( 'cartitem_', '', $dn );
				$update[$n] = $dv;
			}
		}

		if ( empty( $this->cartobject ) ) {
			$this->cartobject = aecCartHelper::getCartbyUserid( $this->userid );
		}

		$this->cartobject->action( 'updateItems', $update );
	}

	function clearCart( $option )
	{
		if ( empty( $this->cartobject ) ) {
			$this->cartobject = aecCartHelper::getCartbyUserid( $this->userid );
		}

		$this->cartobject->action( 'clearCart' );
	}

	function touchInvoice( $option, $invoice_number=false, $storenew=false, $coupon=false )
	{
		// Checking whether we are trying to repeat an invoice
		if ( !empty( $invoice_number ) ) {
			// Make sure the invoice really exists and that its the correct user carrying out this action
			$invoiceid = AECfetchfromDB::InvoiceIDfromNumber($invoice_number, $this->userid);

			if ( $invoiceid ) {
				$this->invoice_number = $invoice_number;
			}
		}

		if ( !empty( $this->invoice_number ) ) {
			if ( !isset( $this->invoice ) ) {
				$this->invoice = null;
			}

			if ( !is_object( $this->invoice ) ) {
				$database = &JFactory::getDBO();
				$this->invoice = new Invoice( $database );
			}

			if ( $this->invoice->invoice_number != $this->invoice_number ) {
				$this->invoice->loadInvoiceNumber( $this->invoice_number );
			}

			if ( !empty( $coupon ) ) {
				$this->invoice->addCoupon( $coupon );
			}

			$this->invoice->computeAmount( $this, empty( $this->invoice->id ) );

			$this->processor = $this->invoice->method;
			$this->usage = $this->invoice->usage;

			if ( empty( $this->usage ) && empty( $this->invoice->conditions ) ) {
				$this->create( $option, 0, 0, $this->invoice_number );
			} elseif ( empty( $this->processor ) && ( strpos( 'c', $this->usage ) !== false ) ) {
				$this->create( $option, 0, $this->usage, $this->invoice_number );
			}
		} else {
			$database = &JFactory::getDBO();

			$this->invoice = new Invoice( $database );

			$id = 0;
			if ( strpos( $this->usage, 'c' ) !== false ) {
				$id = aecCartHelper::getInvoiceIdByCart( $this->cartobject );
			}

			if ( $id ) {
				$this->invoice->load( $id );

				if ( !empty( $coupon ) ) {
					$this->invoice->addCoupon( $coupon );
				}
			} else {
				if ( strpos( $this->processor, '_recurring' ) !== false ) {
					$processor = str_replace( '_recurring', '', $this->processor );
					$recurring = true;
				} else {
					$processor = $this->processor;
					$recurring = null;
				}

				$this->invoice->create( $this->userid, $this->usage, $processor, null, $storenew, null, $recurring );

				if ( !empty( $coupon ) ) {
					$this->invoice->addCoupon( $coupon );
				}

				if ( $storenew ) {
					$this->storeInvoice();
				}
			}

			// Reset parameters
			if ( !empty( $this->invoice->method ) ) {
				$this->processor			= $this->invoice->method;
			}

			if ( !empty( $this->invoice->usage ) ) {
				$this->usage				= $this->invoice->usage;
			}
		}

		$recurring = aecGetParam( 'recurring', null );

		if ( isset( $this->invoice->params['userselect_recurring'] ) ) {
			$this->recurring = $this->invoice->params['userselect_recurring'];
		} elseif ( !is_null( $recurring ) ) {
			$this->invoice->addParams( array( 'userselect_recurring' => $recurring ) );
		}

		return;
	}

	function storeInvoice()
	{
		$database = &JFactory::getDBO();

		$this->invoice->computeAmount( $this, true );

		if ( is_object( $this->pp ) ) {
			$this->pp->invoiceCreationAction( $this->invoice );
		}

		$exchange = $add = $silent = null;

		$this->triggerMIs( '_invoice_creation', $exchange, $add, $silent );

		$temptoken = new aecTempToken( $database );
		$temptoken->getComposite();

		if ( $temptoken->id ) {
			$temptoken->delete();
		}
	}

	function triggerMIs( $action, &$exchange, &$add, &$silent )
	{
		if ( !empty( $this->cart ) && !empty( $this->cartobject ) ) {
			$this->cartobject->triggerMIs( $action, $this->metaUser, $exchange, $this->invoice, $add, $silent );
		} elseif ( !empty( $this->plan ) ) {
			$this->plan->triggerMIs( $action, $this->metaUser, $exchange, $this->invoice, $add, $silent );
		}
	}

	function loadMetaUser( $force=false )
	{
		if ( isset( $this->metaUser ) ) {
			if ( is_object( $this->metaUser ) && !$force ) {
				if ( !isset( $this->metaUser->_incomplete ) ) {
					return true;
				}
			}
		}

		if ( empty( $this->userid ) ) {
			// Creating a dummy user object
			$this->metaUser = new metaUser( 0 );
			$this->metaUser->hasSubscription = false;

			$this->metaUser->cmsUser = new stdClass();
			$this->metaUser->cmsUser->gid = 29;

			if ( is_array( $this->passthrough ) && !empty( $this->passthrough ) && !empty( $this->passthrough['username'] ) ) {
				$cpass = $this->passthrough;
				unset( $cpass['id'] );

				$cmsfields = array( 'name', 'username', 'email', 'password' );

				// Create dummy CMS user
				foreach( $cmsfields as $cmsfield ) {
					foreach ( $cpass as $k => $v ) {
						if ( $k == $cmsfield ) {
							$this->metaUser->cmsUser->$cmsfield = $v;
							unset( $cpass[$k] );
						}
					}
				}

				// Create dummy CB/CBE user
				if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
					$this->metaUser->hasCBprofile = 1;
					$this->metaUser->cbUser = new stdClass();

					foreach ( $cpass as $cbfield => $cbvalue ) {
						if ( is_array( $cbvalue ) ) {
							$this->metaUser->cbUser->$cbfield = implode( ';', $cbvalue );
						} else {
							$this->metaUser->cbUser->$cbfield = $cbvalue;
						}
					}
				}

				if ( isset( $this->metaUser->_incomplete ) ) {
					unset( $this->metaUser->_incomplete );
				}

				return false;
			} else {
				$this->metaUser->_incomplete = true;

				return true;
			}
		} else {
			// Loading the actual user
			$this->metaUser = new metaUser( $this->userid );
			return false;
		}
	}

	function checkAuth( $option )
	{
		$return = true;

		$this->loadMetaUser();

		// Add in task in case this is not set in passthrough
		if ( !isset( $this->passthrough['task'] ) ) {
			$this->passthrough['task'] = 'subscribe';
		}

		// Add in userid in case this is not set in passthrough
		if ( !isset( $this->passthrough['userid'] ) ) {
			$this->passthrough['userid'] = $this->userid;
		}

		if ( empty( $this->authed ) ) {
			if ( !$this->metaUser->getTempAuth() ) {
				if ( isset( $this->passthrough['password'] ) ) {
					if ( !$this->metaUser->setTempAuth( $this->passthrough['password'] ) ) {
						unset( $this->passthrough['password'] );
						$this->promptpassword( $option, true );
						$return = false;
					}
				} elseif ( !empty( $this->metaUser->cmsUser->password ) ) {
					$this->promptpassword( $option );
					$return = false;
				}
			}
		}

		return $return;
	}

	function promptpassword( $option, $wrong=false )
	{
		global $mainframe;

		$mainframe->SetPageTitle( _AEC_PROMPT_PASSWORD );

		Payment_HTML::promptpassword( $option, $this->getPassthrough(), $wrong );
	}

	function create( $option, $intro=0, $usage=0, $group=0, $processor=null, $invoice=0 )
	{
		$database = &JFactory::getDBO();

		$user = &JFactory::getUser();

		global $mainframe, $aecConfig;

		$register = $this->loadMetaUser( true );

		if ( empty( $this->usage ) ) {
			// Check if the user has already subscribed once, if not - link to intro
			if ( $this->metaUser->hasSubscription && !$aecConfig->cfg['customintro_always'] ) {
				$intro = false;
			}

			if ( !$intro && !empty( $aecConfig->cfg['customintro'] ) ) {
				if ( !empty( $aecConfig->cfg['customintro_userid'] ) ) {
					aecRedirect( $aecConfig->cfg['customintro'], $this->userid, "aechidden" );
				} else {
					aecRedirect( $aecConfig->cfg['customintro'] );
				}
			}
		}

		$subscriptionClosed = false;
		if ( $this->metaUser->hasSubscription ) {
			$subscriptionClosed = ( strcmp( $this->metaUser->objSubscription->status, 'Closed' ) === 0 );
		}

		$recurring = aecGetParam( 'recurring', null );

		if ( !is_null( $recurring ) ) {
			$this->recurring = $recurring;
		} else {
			$this->recurring = null;
		}

		$list = array();

		$auth_problem = false;

		if ( !empty( $usage ) ) {
			$query = 'SELECT `id`'
					. ' FROM #__acctexp_plans'
					. ' WHERE `id` = \'' . $usage . '\' AND `active` = \'1\''
					;
			$database->setQuery( $query );
			$id = $database->loadResult();

			if ( $database->getErrorNum() ) {
				echo $database->stderr();
				return false;
			}

			if ( $id ) {
				$plan = new SubscriptionPlan( $database );
				$plan->load( $id );

				$restrictions = $plan->getRestrictionsArray();

				if ( aecRestrictionHelper::checkRestriction( $restrictions, $this->metaUser ) !== false ) {
					if ( ItemGroupHandler::checkParentRestrictions( $plan, 'item', $this->metaUser ) ) {
						$list[] = ItemGroupHandler::getItemListItem( $plan );
					} else {
						$auth_problem = true;
					}
				} else {
					$auth_problem = true;
				}

				if ( $auth_problem && !empty( $plan->params['notauth_redirect'] ) ) {
					$auth_problem = $plan->params['notauth_redirect'];
				}
			}
		} elseif ( !empty( $group ) ) {
			$g = new ItemGroup( $database );
			$g->load( $group );

			if ( $g->checkVisibility( $this->metaUser ) ) {
				if ( !empty( $g->params['symlink'] ) ) {
					aecRedirect( $g->params['symlink'] );
				}

				$list = ItemGroupHandler::getTotalAllowedChildItems( array( $group ), $this->metaUser );

				if ( count( $list ) == 0 ) {
					$auth_problem = true;
				}
			} else {
				$auth_problem = true;
			}

			if ( $auth_problem && !empty( $g->params['notauth_redirect'] ) ) {
				$auth_problem = $g->params['notauth_redirect'];
			}
		} else {
			if ( !empty( $aecConfig->cfg['root_group_rw'] ) ) {
				$x = AECToolbox::rewriteEngine( $this->metaUser, $this->metaUser );
			} else {
				$x = array( $aecConfig->cfg['root_group'] );
			}

			if ( !is_array( $x ) && !empty( $x ) ) {
				$x = array( $x );
			} else {
				$x = array( $aecConfig->cfg['root_group'] );
			}

			$list = ItemGroupHandler::getTotalAllowedChildItems( $x, $this->metaUser );

			// Retry in case a RWengine call didn't work out
			if ( empty( $list ) && !empty( $aecConfig->cfg['root_group_rw'] ) ) {
				$list = ItemGroupHandler::getTotalAllowedChildItems( $aecConfig->cfg['root_group'], $this->metaUser );
			}
		}

		// There are no plans to begin with, so we need to punch out an error here
		if ( count( $list ) == 0 ) {
			if ( $auth_problem ) {
				if ( is_bool( $auth_problem ) ) {
					aecRedirect( AECToolbox::deadsureURL( 'index.php?mosmsg=' . _NOPLANS_AUTHERROR ), false, true );
				} else {
					aecRedirect( $auth_problem );
				}
			} else {
				aecRedirect( AECToolbox::deadsureURL( 'index.php?mosmsg=' . _NOPLANS_ERROR ), false, true );
			}

			return;
		}

		$groups	= array();
		$plans	= array();

		$gs = array();
		$ps = array();
		// Break apart groups and items, make sure we have no duplicates
		foreach ( $list as $litem ) {
			if ( $litem['type'] == 'group' ) {
				if ( !in_array( $litem['id'], $gs ) ) {
					$gs[] = $litem['id'];
					$groups[] = $litem;
				}
			} else {
				if ( !in_array( $litem['id'], $ps ) ) {

					if ( ItemGroupHandler::checkParentRestrictions( $litem['plan'], 'item', $this->metaUser ) ) {
						$ps[] = $litem['id'];
						$plans[] = $litem;
					}
				}
			}
		}

		foreach ( $plans as $pid => $plan ) {
			if ( $this->userid && $aecConfig->cfg['enable_shoppingcart'] ) {
				// We have a shopping cart situation, care about processors later

				if ( ( $plan['plan']->params['processors'] == '' ) || is_null( $plan['plan']->params['processors'] ) ) {
					if ( !$plan['plan']->params['full_free'] ) {
						continue;
					}
				}

				$plans[$pid]['gw'][0]						= new stdClass();
				$plans[$pid]['gw'][0]->processor_name		= 'add_to_cart';
				$plans[$pid]['gw'][0]->info['statement']	= '';
				$plans[$pid]['gw'][0]->recurring			= 0;

				continue;
			}

			if ( $plan['plan']->params['full_free'] ) {
				$plans[$pid]['gw'][0]						= new stdClass();
				$plans[$pid]['gw'][0]->processor_name		= 'free';
				$plans[$pid]['gw'][0]->info['statement']	= '';
				$plans[$pid]['gw'][0]->recurring			= 0;
			} else {
				if ( ( $plan['plan']->params['processors'] != '' ) && !is_null( $plan['plan']->params['processors'] ) ) {
					$processors = $plan['plan']->params['processors'];

					// Restrict to pre-chosen processor (if set)
					if ( !empty( $this->processor ) ) {
						$processorid = PaymentProcessorHandler::getProcessorIdfromName( $this->processor );
						if ( in_array( $processorid, $processors ) ) {
							$processors = array( $processorid );
						}
					}

					$plan_gw = array();
					if ( count( $processors ) ) {
						foreach ( $processors as $n ) {
							if ( empty( $n ) ) {
								continue;
							}

							$pp = new PaymentProcessor();

							if ( !$pp->loadId( $n ) ) {
								continue;
							}

							$pp->init();
							$pp->getInfo();
							$pp->exchangeSettingsByPlan( $plan['plan'] );

							$recurring = $pp->is_recurring( $this->recurring );

							if ( $recurring > 1 ) {
								$pp->recurring = 0;
								$plan_gw[] = $pp;

								if ( !$plan['plan']->params['lifetime'] ) {
									$pp = new PaymentProcessor();

									$pp->loadId( $n );
									$pp->init();
									$pp->getInfo();
									$pp->exchangeSettingsByPlan( $plan['plan'] );

									$pp->recurring = 1;
									$plan_gw[] = $pp;
								}
							} elseif ( !( $plan['plan']->params['lifetime'] && $recurring ) ) {
								if ( is_int( $recurring ) ) {
									$pp->recurring	= $recurring;
								}
								$plan_gw[] = $pp;
							}
						}
					}

					if ( !empty( $plan_gw ) ) {
						$plans[$pid]['gw'] = $plan_gw;
					} else {
						unset( $plans[$pid] );
					}
				}
			}
		}

		$list = array_merge( $groups, $plans );

		// After filtering out the processors, no plan or group can be used, so we have to again issue an error
		 if ( count( $list ) == 0 ) {
			aecRedirect( AECToolbox::deadsureURL( 'index.php?mosmsg=' . _NOPLANS_ERROR, false, true ), false, true );
			return;
		}

		$nochoice = false;

		// There is no choice if we have only one group or only one item with one payment option
		if ( count( $list ) === 1 ) {
			if ( $list[0]['type'] == 'item' ) {
				if ( count( $plans[0]['gw'] ) === 1 ) {
					$nochoice = true;
				}
			} else {
				// Jump back and use the only group we found
				return $this->create( $option, $intro, 0, $list[0]['id'] );
			}
		}

		// If we have only one processor on one plan, there is no need for a decision
		if ( $nochoice && !( $aecConfig->cfg['show_fixeddecision'] && empty( $processor ) ) ) {
			// If the user also needs to register, we need to guide him there after the selection has now been made
			if ( $register ) {
				// The plans are supposed to be first, so the details form should hold the values
				if ( !empty( $plans[0]['id'] ) ) {
					$_POST['usage']		= $plans[0]['id'];
					$_POST['processor']	= $plans[0]['gw'][0]->processor_name;

					if ( isset( $plans[0]['gw'][0]->recurring ) ) {
						$_POST['recurring']	= $plans[0]['gw'][0]->recurring;
					}
				}

				// Send to CB or joomla!
				if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
					// This is a CB registration, borrowing their code to register the user

					if ( GeneralInfoRequester::detect_component( 'CB1.2' ) ) {
						$content = array();
						$content['usage']		= $plans[0]['id'];
						$content['processor']	= $plans[0]['gw'][0]->processor_name;
						if ( isset( $plans[0]['gw'][0]->recurring ) ) {
							$content['recurring']	= $plans[0]['gw'][0]->recurring;
						}

						$temptoken = new aecTempToken( $database );
						$temptoken->create( $content );

						$myparams = "";

						if ( $_GET['fname'] ) {
							setcookie( "fname", $_GET['fname'], time()+60*10 );
						}

						if ( $_GET['femail'] ) {
							setcookie( "femail", $_GET['femail'], time()+60*10 );
						}

						aecRedirect( 'index.php?option=com_comprofiler&task=registers' );
					} else {
						global $task, $mainframe, $_PLUGINS, $ueConfig, $_CB_database;;

						$savetask	= $task;
						$_REQUEST['task'] = 'done';

						include_once( JPATH_SITE . '/components/com_comprofiler/comprofiler.php' );
						include_once( JPATH_SITE . '/components/com_comprofiler/comprofiler.html.php' );

						$task = $savetask;

						registerForm($option, $mainframe->getCfg( 'emailpass' ), null);
					}
				} elseif ( GeneralInfoRequester::detect_component( 'JUSER' ) ) {
					// This is a JUSER registration, borrowing their code to register the user

					global $task;

					$savetask	= $task;
					$task = 'blind';

					include_once( JPATH_SITE . '/components/com_juser/juser.html.php' );
					include_once( JPATH_SITE . '/components/com_juser/juser.php' );

					$task = $savetask;

					userRegistration( $option, null );
				} elseif ( GeneralInfoRequester::detect_component( 'JOMSOCIAL' ) ) {
					$temptoken = new aecTempToken( $database );
					$temptoken->getComposite();

					if ( empty( $temptoken->content ) ) {
						$content = array();
						$content['usage']		= $plans[0]['id'];
						$content['processor']	= $plans[0]['gw'][0]->processor_name;
						if ( isset( $plans[0]['gw'][0]->recurring ) ) {
							$content['recurring']	= $plans[0]['gw'][0]->recurring;
						}

						$temptoken->create( $content );
					} elseif ( empty( $temptoken->content['usage'] ) ) {
						$temptoken->content['usage']		= $plans[0]['id'];
						$temptoken->content['processor']	= $plans[0]['gw'][0]->processor_name;
						if ( isset( $plans[0]['gw'][0]->recurring ) ) {
							$temptoken->content['recurring']	= $plans[0]['gw'][0]->recurring;
						}

						$temptoken->storeload();
					}

					aecRedirect( 'index.php?option=com_community&view=register' );
				} else {
					if ( !isset( $_POST['usage'] ) ) {
						$_POST['intro'] = $intro;
						$_POST['usage'] = $plans[0]['id'];
					}

					if ( aecJoomla15check() ) {
						$mainframe->redirect( 'index.php?option=com_user&view=register&usage=' . $plans[0]['id'] . '&processor=' . $plans[0]['gw'][0]->processor_name . '&recurring=' . $plans[0]['gw'][0]->recurring );
					} else {
						$activation = $mainframe->getCfg( 'useractivation' );

						joomlaregisterForm( $option, $activation );
					}
				}
			} else {
				// The user is already existing, so we need to move on to the confirmation page with the details

				$this->usage		= $plans[0]['id'];

				if ( isset( $plans[0]['gw'][0]->recurring ) ) {
					$this->recurring	= $plans[0]['gw'][0]->recurring;
				} else {
					$this->recurring	= 0;
				}

				$this->processor	= $plans[0]['gw'][0]->processor_name;

				if ( ( $invoice != 0 ) && !is_null( $invoice ) ) {
					$this->invoice_number	= $invoice;
				}

				$password = aecGetParam( 'password', null );

				$var = array();
				if ( !is_null( $password ) ) {
					$var['password'] = $password;
				}

				$this->confirm( $option, $var );
			}
		} else {
			// Reset $register if we seem to have all data
			if ( $register && !empty( $this->passthrough['username'] ) ) {
				$register = 0;
			}

			$mainframe->SetPageTitle( _PAYPLANS_HEADER );

			if ( $group ) {
				$g = new ItemGroup( $database );
				$g->load( $group );

				$list['group'] = ItemGroupHandler::getGroupListItem( $g );
			}

			if ( $this->userid ) {
				$cart = aecCartHelper::getCartidbyUserid( $this->userid );
			} else {
				$cart = false;
			}

			// Of to the Subscription Plan Selection Page!
			Payment_HTML::selectSubscriptionPlanForm( $option, $this->userid, $list, $subscriptionClosed, $this->getPassthrough(), $register, $cart );
		}
	}

	function confirm( $option )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( empty( $this->passthrough ) ) {
			if ( !$this->checkAuth( $option ) ) {
				return false;
			}
		}

		if ( $aecConfig->cfg['use_recaptcha'] && !empty( $aecConfig->cfg['recaptcha_privatekey'] ) ) {
			// require the recaptcha library
			require_once( JPATH_SITE . '/components/com_acctexp/lib/recaptcha/recaptchalib.php' );

			if ( !isset( $_POST["recaptcha_challenge_field"] ) || !isset( $_POST["recaptcha_response_field"] ) ) {
				echo "<script> alert('The reCAPTCHA was not correct. Please try again.'); window.history.go(-1);</script>\n";

				return;
			}

			// finally chack with reCAPTCHA if the entry was correct
			$resp = recaptcha_check_answer ( $aecConfig->cfg['recaptcha_privatekey'], $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"] );

			// if the response is INvalid, then go back one page, and try again. Give a nice message
			if (!$resp->is_valid) {
				echo "<script> alert('The reCAPTCHA was not correct. Please try again.'); window.history.go(-1);</script>\n";

				return;
			}
		}

		$this->puffer( $option );

		$this->coupons = array();
		$this->coupons['active'] = $aecConfig->cfg['enable_coupons'];

		if ( empty( $this->mi_error ) ) {
			$this->mi_error = array();
		}

		if ( !empty( $this->plan ) ) {
			$this->mi_form = $this->plan->getMIforms( $this->metaUser, $this->mi_error );
		}

		if ( !empty( $this->mi_form ) ) {
			$params = $this->plan->getMIformParams( $this->metaUser );
			foreach ( $params as $mik => $miv ) {
				if ( $mik == 'lists' ) {
					continue;
				}

				if ( is_array( $this->passthrough ) ) {
					foreach ( $this->passthrough as $pid => $pk ) {
						if ( is_array( $pk ) ) {
							if ( ( $pk[0] == $mik ) || ( $pk[0] == $mik.'[]' ) ) {
								unset($this->passthrough[$pid]);
							}
						}
					}
				}
			}
		}

		if ( $aecConfig->cfg['skip_confirmation'] && empty( $this->mi_form ) ) {
			$confirm = false;
		} else {
			$confirm = true;
		}

		if ( $confirm ) {
			global $mainframe;

			$mainframe->SetPageTitle( _CONFIRM_TITLE );

			if ( empty( $aecConfig->cfg['custom_confirm_userdetails'] ) ) {
				$this->userdetails = "";

				if ( !empty( $this->metaUser->cmsUser->name ) ) {
					$this->userdetails .= '<p>' . _CONFIRM_ROW_NAME . $this->metaUser->cmsUser->name . '</p>';
				}

				$this->userdetails .= '<p>' . _CONFIRM_ROW_USERNAME . $this->metaUser->cmsUser->username . '</p>';
				$this->userdetails .= '<p>' . _CONFIRM_ROW_EMAIL . $this->metaUser->cmsUser->email . '</p>';
			} else {
				$this->userdetails = AECToolbox::rewriteEngine( $aecConfig->cfg['custom_confirm_userdetails'], $this );
			}

			Payment_HTML::confirmForm( $option, $this, $this->metaUser->cmsUser, $this->getPassthrough() );
		} else {
			$this->save( $option );
		}
	}

	function cart( $option )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$this->getCart();

		$this->coupons = array();
		$this->coupons['active'] = $aecConfig->cfg['enable_coupons'];

		$query = 'SELECT `invoice_number`'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `userid` = \'' . $this->userid . '\''
				. ' AND `usage` = \'c.' . $this->cartobject->id . '\''
				;

		$database->setQuery( $query );
		$in = $database->loadResult();

		if ( !empty( $in ) ) {
			$this->invoice_number = $in;

			$this->touchInvoice( $option );
		}

		Payment_HTML::cart( $option, $this );
	}

	function confirmcart( $option, $coupon=null )
	{
		$database = &JFactory::getDBO();

		global $mainframe, $task;

		$this->confirmed = 1;

		$this->loadMetaUser( false, true );
		$this->metaUser->setTempAuth();

		$this->puffer( $option );

		if ( !empty( $coupon ) ) {
			$this->invoice->addCoupon( $coupon );
			$this->invoice->storeload();

			// Make sure we have the correct amount loaded
			$this->touchInvoice( $option );
		}

		if ( $this->hasExceptions() ) {
			return $this->addressExceptions( $option );
		} else {
			$this->checkout( $option );
		}
	}

	function save( $option, $coupon=null )
	{
		$database = &JFactory::getDBO();

		global $mainframe, $task;

		$this->confirmed = 1;

		if ( !empty( $this->usage ) ) {
			// get the payment plan
			$this->plan = new SubscriptionPlan( $database );
			$this->plan->load( $this->usage );
		}

		if ( empty( $this->userid ) ) {
			if ( !empty( $this->plan ) ) {
				if ( isset( $this->plan->params['override_activation'] ) ) {
					$overrideActivation = $this->plan->params['override_activation'];
				} else {
					$overrideActivation = false;
				}

				if ( isset( $this->plan->params['override_regmail'] ) ) {
					$overrideEmail = $this->plan->params['override_regmail'];
				} else {
					$overrideEmail = false;
				}

				$this->userid = AECToolbox::saveUserRegistration( $option, $this->passthrough, false, $overrideActivation, $overrideEmail );
			} else {
				$this->userid = AECToolbox::saveUserRegistration( $option, $this->passthrough );
			}
		}

		$this->loadMetaUser( true );
		$this->metaUser->setTempAuth();

		if ( !empty( $this->plan ) ) {
			if ( is_object( $this->plan ) ) {
				$mi_form = $this->plan->getMIformParams( $this->metaUser );

				if ( !empty( $mi_form ) ) {
					$params = array();
					foreach ( $mi_form as $key => $value ) {
						if ( strpos( $key,'[]' ) ) {
							$key = str_replace( '[]', '', $key );
						}

						$value = aecGetParam( $key, '__DEL' );

						if ( $value !== '__DEL' ) {
							$k = explode( '_', $key, 3 );

							if ( !isset( $params[$k[1]] ) ) {
								$params[$k[1]] = array();
							}

							$params[$k[1]][$k[2]] = $value;
						}
					}

					if ( !empty( $params ) ) {
						foreach ( $params as $mi_id => $content ) {
							$this->metaUser->meta->setMIParams( $mi_id, $this->plan->id, $content, true );
						}

						$this->metaUser->meta->storeload();
					}

					$verifymi = $this->plan->verifyMIformParams( $this->metaUser );

					$this->mi_error = array();
					if ( is_array( $verifymi ) && !empty( $verifymi ) ) {
						foreach ( $verifymi as $vmi ) {
							if ( !is_array( $vmi ) ) {
								continue;
							}

							if ( !empty( $vmi['error'] ) ) {
								$this->mi_error[$vmi['id']] = $vmi['error'];
							}
						}
					}

					if ( !empty( $this->mi_error ) ) {
						$this->confirmed = 0;
						return $this->confirm( $option );
					}
				}
			}
		}

		$this->checkout( $option, 0, null, $coupon );
	}

	function checkout( $option, $repeat=0, $error=null, $coupon=null )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( !$this->checkAuth( $option ) ) {
			return false;
		}

		$this->puffer( $option );

		$this->touchInvoice( $option, false, true, $coupon );

		$user_ident	= aecGetParam( 'user_ident', 0, true, array( 'string', 'clear_nonemail' ) );

		if ( !empty( $user_ident ) && !empty( $this->invoice ) ) {
			if ( is_object( $this->invoice ) ) {
				if ( $this->invoice->addTargetUser( strtolower( $user_ident ) ) ) {
					$this->invoice->storeload();
				}

				if ( !empty( $this->cartobject ) && !empty( $this->cart ) ) {
					// Bounce back to cart
					return $this->cart( $option );
				} else {
					// or confirmation
					return $this->confirm( $option );
				}
			}
		}

		$repeat = empty( $repeat ) ? 0 : $repeat;

		$exceptproc = array( 'none', 'free' );

		// If this is marked as supposedly free
		if ( in_array( strtolower( $this->processor ), $exceptproc ) && !empty( $this->plan ) ) {
			// And if it is either made free through coupons
			if (
				!empty( $this->invoice->made_free )
				// Or a free full period that the user CAN use
				|| ( $this->plan->params['full_free'] && $this->invoice->counter )
				|| ( $this->plan->params['full_free'] && empty( $this->invoice->counter ) && empty( $this->plan->params['trial_period'] ) )
				// Or a free trial that the user CAN use
				|| ( $this->plan->params['trial_free'] && empty( $this->invoice->counter ) )
			) {
				// Then mark payed
				if ( $this->invoice->pay() !== false ) {
					return $this->thanks( $option, false, true );
				}
			}

			return notAllowed( $option );
		} elseif ( strcmp( strtolower( $this->processor ), 'error' ) === 0 ) {
			// Nope, won't work buddy
			return notAllowed( $option );
		}

		if ( !empty( $this->pp->info['secure'] ) && empty( $_SERVER['HTTPS'] ) && !$aecConfig->cfg['override_reqssl'] ) {
			aecRedirect( AECToolbox::deadsureURL( "index.php?option=" . $option . "&task=repeatPayment&invoice=" . $this->invoice->invoice_number . "&first=" . ( $repeat ? 0 : 1 ), true, true ) );
			exit();
		}

		$this->loadItems();

		$this->applyCoupons();

		if ( is_array( $this->payment->amount ) ) {
			$amt = $this->payment->amount['amount'];
		} else {
			$amt = $this->payment->amount;
		}

		// Either this is fully free, or the next term is free and this is non recurring
		if ( !empty( $this->items ) && !$this->recurring ) {
			if ( ( count( $this->items ) == 1 ) || ( $this->payment->amount['amount'] == "0.00" ) ) {
				$min = array_shift( array_keys( $this->items ) );

				if ( $this->items[$min]['terms']->checkFree() || ( $this->items[$min]['terms']->nextterm->free && !$this->recurring ) || ( $amt == "0.00" ) ) {
					$this->invoice->pay();
					return $this->thanks( $option, false, true );
				}
			}
		}

		// Argh, this is bad :-(
		if ( $this->invoice->amount != $amt ) {
			$this->invoice->amount = $amt;

			$this->invoice->storeload();
		}

		$exchange = $silent = null;

		$this->triggerMIs( 'invoice_items_checkout', $exchange, $this->items, $silent );

		$this->InvoiceToCheckout( $option, $repeat, $error );
	}

	function InvoiceToCheckout( $option, $repeat=0, $error=null )
	{
		global $mainframe;

		if ( $this->hasExceptions() ) {
			$this->addressExceptions( $option );
		} else {
			$int_var = $this->invoice->getWorkingData( $this );

			// Assemble Checkout Response
			if ( !empty( $int_var['objUsage'] ) ) {
				if ( is_a( $int_var['objUsage'], 'SubscriptionPlan' ) ) {
					$int_var['var']		= $this->pp->checkoutAction( $int_var, $this->metaUser, $int_var['objUsage'], $this->invoice );
				} else {
					$int_var['var']		= $this->pp->checkoutAction( $int_var, $this->metaUser, null, $this->invoice, $int_var['objUsage'] );
				}
			}

			$int_var['params']	= $this->pp->getParamsHTML( $int_var['params'], $this->pp->getParams( $int_var['params'] ) );

			if ( empty( $int_var['params'] ) ) {
				$int_var['params'] = null;
			}

			$this->invoice->formatInvoiceNumber();

			$mainframe->SetPageTitle( _CHECKOUT_TITLE );

			Payment_HTML::checkoutForm( $option, $int_var['var'], $int_var['params'], $this, $error, $repeat );
		}
	}

	function getObjUsage()
	{
		$database = &JFactory::getDBO();

		$usage = null;
		if ( isset( $this->invoice->usage ) ) {
			return $this->invoice->getObjUsage();
		} elseif ( isset( $this->usage ) ) {
			$usage = $this->usage;
		}

		if ( !empty( $usage ) ) {
			$u = explode( '.', $usage );

			switch ( strtolower( $u[0] ) ) {
				case 'c':
				case 'cart':
					$objUsage = new aecCart( $database );
					$objUsage->load( $u[1] );
					break;
				case 'p':
				case 'plan':
				default:
					if ( !isset( $u[1] ) ) {
						$u[1] = $u[0];
					}

					$objUsage = new SubscriptionPlan( $database );
					$objUsage->load( $u[1] );
					break;
			}

			return $objUsage;
		} else {
			return null;
		}
	}

	function internalcheckout( $option )
	{
		$database = &JFactory::getDBO();

		$this->metaUser = new metaUser( $this->userid );

		$this->puffer( $option );

		$this->touchInvoice( $option );

		$var = $this->invoice->getWorkingData( $this );

		$objUsage = $this->getObjUsage();

		if ( is_a( $objUsage, 'SubscriptionPlan' ) ) {
			$new_subscription = $objUsage;
		} else {
			$new_subscription = $objUsage->getTopPlan();
		}

		$badbadvars = array( 'userid', 'invoice', 'task', 'option' );
		foreach ( $badbadvars as $badvar ) {
			if ( isset( $_POST[$badvar] ) ) {
				unset( $_POST[$badvar] );
			}
		}

		$post = aecPostParamClear( $_POST );

		foreach ( $post as $pk => $pv ) {
			$var['params'][$pk] = $pv;
		}

		if ( !empty( $this->invoice->params['target_user'] ) ) {
			$targetUser = new metaUser( $this->invoice->params['target_user'] );
		} else {
			$targetUser =& $this->metaUser;
		}

		if ( !empty( $this->cartobject ) && !empty( $this->cart ) ) {
			$response = $this->pp->checkoutProcess( $var, $targetUser, $new_subscription, $this->invoice, $this->cart );
		} else {
			$response = $this->pp->checkoutProcess( $var, $targetUser, $new_subscription, $this->invoice );
		}

		if ( isset( $response['error'] ) ) {
			$this->checkout( $option, true, $response['error'] );
		} else {
			$this->thanks( $option );
		}
	}

	function processorResponse( $option, $response )
	{
		$database = &JFactory::getDBO();

		$this->touchInvoice( $option );

		$this->userid = $this->invoice->userid;
		$this->loadMetaUser();

		$this->puffer( $option );

		$this->invoice->processorResponse( $this->pp, $response );

		if ( isset( $response['error'] ) ) {
			$this->checkout( $option, true, $response['error'] );
		} else {
			if ( !empty( $this->pp->info['notify_trail_thanks'] ) ) {
				$this->thanks( $option );
			} else {
				header("HTTP/1.0 200 OK");
				exit;
			}
		}
	}

	function planprocessoraction( $action, $subscr=null )
	{
		$database = &JFactory::getDBO();

		$this->loadMetaUser();

		$invoice = new Invoice( $database );

		if ( !empty( $subscr ) ) {
			if ( $this->metaUser->moveFocus( $subscr ) ) {
				$invoice->loadbySubscriptionId( $this->metaUser->focusSubscription->id, $this->metaUser->userid );
			}
		}

		if ( empty( $invoice->id ) ) {
			$invoice->load( AECfetchfromDB::lastClearedInvoiceIDbyUserID( $this->userid, $this->metaUser->focusSubscription->plan ) );
		}

		if ( empty( $invoice->id ) ) {
			$invoice->load( AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $this->userid, $this->metaUser->focusSubscription->plan ) );
		}

		$pp = new PaymentProcessor( $database );
		if ( $pp->loadName( $invoice->method ) ) {
			$pp->fullInit();
		}

		$response = $pp->customAction( $action, $invoice, $this->metaUser );

		$invoice->processorResponse( $pp, $response, '', true );

		if ( isset( $response['cancel'] ) ) {
			HTML_Results::cancel( 'com_acctexp' );
		}
	}

	function invoiceprocessoraction( $action, $invoiceNum=null )
	{
		$database = &JFactory::getDBO();

		$this->loadMetaUser();

		$invoice = new Invoice( $database );
		$invoice->loadInvoiceNumber( $invoiceNum );

		$pp = new PaymentProcessor( $database );
		if ( $pp->loadName( $invoice->method ) ) {
			$pp->fullInit();
		}

		$response = $pp->customAction( $action, $invoice, $this->metaUser );

		$invoice->processorResponse( $pp, $response, '', true );

		if ( isset( $response['cancel'] ) ) {
			HTML_Results::cancel( 'com_acctexp' );
		}
	}

	function invoiceprint( $option, $invoice_number )
	{
		$database = &JFactory::getDBO();

		$this->loadMetaUser();

		$this->touchInvoice( $option, $invoice_number );

		$this->puffer( $option );

		$this->loadItems();

		$this->applyCoupons();

		if ( count( $this->items ) == 1 ) {
			// Create a fake total here.
			$terms = new mammonTerms();
			$term = new mammonTerm();

			$term->set( 'duration', array( 'none' => true ) );
			$term->set( 'type', 'total' );
			$term->addCost( $this->items[0]['terms']->nextterm->renderTotal() );

			$terms->addTerm( $term );

			$this->items[] = array( 'cost' => $this->items[0]['terms']->nextterm->renderTotal(), 'terms' => $terms );
		}

		$exchange = $silent = null;

		$this->triggerMIs( 'invoice_items', $exchange, $this->items, $silent );

		$this->invoice->formatInvoiceNumber();

		$data = $this->invoice->getPrintout( $this );

		$this->triggerMIs( 'invoice_printout', $exchange, $data, $silent );

		Payment_HTML::printInvoice( $option, $data );
	}

	function thanks( $option, $renew=false, $free=false )
	{
		global $mainframe, $aecConfig, $mainframe;

		if ( isset( $this->plan ) ) {
			if ( is_object( $this->plan ) ) {
				if ( !empty( $this->plan->params['customthanks'] ) ) {
					aecRedirect( $this->plan->params['customthanks'] );
				} elseif ( $aecConfig->cfg['customthanks'] ) {
					aecRedirect( $aecConfig->cfg['customthanks'] );
				}
			} else {
				return $this->simplethanks( $option, $renew, $free );
			}
		} else {
			return $this->simplethanks( $option, $renew, $free );
		}

		if ( isset( $this->renew ) ) {
			$renew = $this->renew;
		}

		if ( $renew ) {
			$msg = _SUB_FEPARTICLE_HEAD_RENEW . '</p><p>' . _SUB_FEPARTICLE_THANKSRENEW;
			if ( $free ) {
				$msg .= _SUB_FEPARTICLE_LOGIN;
			} else {
				$msg .= _SUB_FEPARTICLE_PROCESSPAY . _SUB_FEPARTICLE_MAIL;
			}
		} else {
			$msg = _SUB_FEPARTICLE_HEAD . '</p><p>' . _SUB_FEPARTICLE_THANKS;

			$msg .=  $free ? _SUB_FEPARTICLE_PROCESS : _SUB_FEPARTICLE_PROCESSPAY;

			$msg .= $mainframe->getCfg( 'useractivation' ) ? _SUB_FEPARTICLE_ACTMAIL : _SUB_FEPARTICLE_MAIL;
		}

		$b = '';
		if ( $aecConfig->cfg['customtext_thanks_keeporiginal'] ) {
			$b .= '<div class="componentheading">' . _THANKYOU_TITLE . '</div>';
		}

		if ( $aecConfig->cfg['customtext_thanks'] ) {
			$b .= $aecConfig->cfg['customtext_thanks'];
		}

		if ( $aecConfig->cfg['customtext_thanks_keeporiginal'] ) {
			$b .= '<div id="thankyou_page">' . '<p>' . $msg . '</p>' . '</div>';
		}

		$up =& $this->plan->params;

		$msg = "";
		if ( !empty( $up['customtext_thanks'] ) ) {
			if ( isset( $up['customtext_thanks_keeporiginal'] ) ) {
				if ( empty( $up['customtext_thanks_keeporiginal'] ) ) {
					$msg = $up['customtext_thanks'];
				} else {
					$msg = $b . $up['customtext_thanks'];
				}
			} else {
				$msg = $up['customtext_thanks'];
			}
		} else {
			$msg = $b;
		}

		$mainframe->SetPageTitle( _THANKYOU_TITLE );

		HTML_Results::thanks( $option, $msg );
	}

	function simplethanks( $option, $renew, $free )
	{
		global $mainframe, $aecConfig, $mainframe;

		// Look whether we have a custom ThankYou page
		if ( $aecConfig->cfg['customthanks'] ) {
			aecRedirect( $aecConfig->cfg['customthanks'] );
		}

		if ( isset( $this->renew ) ) {
			$renew = $this->renew;
		}

		if ( $renew ) {
			$msg = _SUB_FEPARTICLE_HEAD_RENEW . '</p><p>' . _SUB_FEPARTICLE_THANKSRENEW;
			if ( $free ) {
				$msg .= _SUB_FEPARTICLE_LOGIN;
			} else {
				$msg .= _SUB_FEPARTICLE_PROCESSPAY . _SUB_FEPARTICLE_MAIL;
			}
		} else {
			$msg = _SUB_FEPARTICLE_HEAD . '</p><p>' . _SUB_FEPARTICLE_THANKS;

			$msg .=  $free ? _SUB_FEPARTICLE_PROCESS : _SUB_FEPARTICLE_PROCESSPAY;

			$msg .= $mainframe->getCfg( 'useractivation' ) ? _SUB_FEPARTICLE_ACTMAIL : _SUB_FEPARTICLE_MAIL;
		}

		$b = '';
		if ( $aecConfig->cfg['customtext_thanks_keeporiginal'] ) {
			$b .= '<div class="componentheading">' . _THANKYOU_TITLE . '</div>';
		}

		if ( $aecConfig->cfg['customtext_thanks'] ) {
			$b .= $aecConfig->cfg['customtext_thanks'];
		}

		if ( $aecConfig->cfg['customtext_thanks_keeporiginal'] ) {
			$b .= '<div id="thankyou_page">' . '<p>' . $msg . '</p>' . '</div>';
		}

		$mainframe->SetPageTitle( _THANKYOU_TITLE );

		HTML_Results::thanks( $option, $b );
	}

	function error( $option, $objUser, $invoice, $error )
	{
		global $mainframe;

		$mainframe->SetPageTitle( _CHECKOUT_ERROR_TITLE );

		Payment_HTML::error( $option, $objUser, $invoice, $error );
	}
}

class Invoice extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $active 			= null;
	/** @var int */
	var $counter 			= null;
	/** @var int */
	var $userid 			= null;
	/** @var int */
	var $subscr_id 			= null;
	/** @var string */
	var $invoice_number 	= null;
	/** @var string */
	var $invoice_number_format 	= null;
	/** @var string */
	var $secondary_ident 	= null;
	/** @var datetime */
	var $created_date	 	= null;
	/** @var datetime */
	var $transaction_date 	= null;
	/** @var string */
	var $method 			= null;
	/** @var string */
	var $amount 			= null;
	/** @var string */
	var $currency 			= null;
	/** @var string */
	var $usage				= null;
	/** @var int */
	var $fixed	 			= null;
	/** @var text */
	var $coupons 			= null;
	/** @var text */
	var $transactions		= null;
	/** @var text */
	var $params 			= null;
	/** @var text */
	var $conditions			= null;

	function Invoice(&$db)
	{
		parent::__construct( '#__acctexp_invoices', 'id', $db );
	}

	function load( $id )
	{
		parent::load( $id );

		if ( empty( $this->counter ) && ( $this->transaction_date != '0000-00-00 00:00:00' ) && !is_null( $this->transaction_date ) ) {
			$this->counter = 1;
		}
	}

	function declareParamFields()
	{
		return array( 'coupons', 'transactions', 'params', 'conditions' );
	}

	function check()
	{
		$unset = array( 'made_free' );

		foreach ( $unset as $varname ) {
			if ( isset( $this->$varname ) ) {
				unset( $this->$varname );
			}
		}

		parent::check();

		return true;
	}

	function loadInvoiceNumber( $invoiceNum )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
		. ' FROM #__acctexp_invoices'
		. ' WHERE invoice_number = \'' . $invoiceNum . '\''
		. ' OR secondary_ident = \'' . $invoiceNum . '\''
		;
		$database->setQuery( $query );
		$this->load($database->loadResult());
	}

	function formatInvoiceNumber( $invoice=null, $nostore=false )
	{
		global $aecConfig;

		if ( empty( $invoice ) ) {
			$subject = $this;
		} else {
			$subject = $invoice;
		}

		$invoice_number = $subject->invoice_number;

		if ( empty( $subject->invoice_number_format ) && $aecConfig->cfg['invoicenum_doformat'] ) {
			$invoice_number = AECToolbox::rewriteEngine( $aecConfig->cfg['invoicenum_formatting'], null, null, $subject );
		} elseif ( !empty( $subject->invoice_number_format ) ) {
			$invoice_number = $subject->invoice_number_format;
		}

		if ( empty( $invoice ) ) {
			if ( $aecConfig->cfg['invoicenum_doformat'] && empty( $this->invoice_number_format ) && !empty( $invoice_number ) && !$nostore ) {
				if ( $invoice_number != "JSON PARSE ERROR - Malformed String!" ) {
					$this->invoice_number_format = $invoice_number;
					$this->storeload();
				}
			}

			$this->invoice_number = $invoice_number;
			return true;
		} else {
			return $invoice_number;
		}

	}

	function deformatInvoiceNumber()
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$query = 'SELECT invoice_number'
		. ' FROM #__acctexp_invoices'
		. ' WHERE id = \'' . $database->getEscaped( $this->id ) . '\''
		. ' OR secondary_ident = \'' . $database->getEscaped( $this->invoice_number ) . '\''
		;
		$database->setQuery( $query );

		$this->invoice_number = $database->loadResult();
	}

	function loadbySubscriptionId( $subscrid, $userid=null )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `subscr_id` = \'' . $subscrid . '\''
				. ' ORDER BY `transaction_date` DESC'
				;

		if ( !empty( $userid ) ) {
			$query .= ' AND `userid` = \'' . $userid . '\'';
		}

		$database->setQuery( $query );
		$this->load( $database->loadResult() );
	}

	function hasDuplicate( $userid, $invoiceNum )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT count(*)'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `userid` = ' . (int) $userid
				. ' AND `invoice_number` = \'' . $invoiceNum . '\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function computeAmount( $InvoiceFactory=null, $save=true, $recurring_choice=null )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $InvoiceFactory->metaUser ) ) {
			$metaUser = $InvoiceFactory->metaUser;
		} else {
			$metaUser = new metaUser( $this->userid ? $this->userid : 0 );
		}

		$pp = null;

		$madefree = false;

		if ( is_null( $recurring_choice ) && isset( $this->params['userselect_recurring'] ) ) {
			$recurring_choice = $this->params['userselect_recurring'];
		}

		if ( !is_null( $this->usage ) && !( $this->usage == '' ) ) {
			$recurring = 0;

			$original_amount = $this->amount;

			if ( !empty( $this->method ) ) {
				switch ( $this->method ) {
					case 'none':
					case 'free':
						break;
					default:
						$pp = new PaymentProcessor();
						if ( $pp->loadName( $this->method ) ) {
							$pp->fullInit();

							if ( $pp->is_recurring( $recurring_choice ) ) {
								$recurring = $pp->is_recurring( $recurring_choice );
							}

							if ( empty( $this->currency ) ) {
								$this->currency = isset( $pp->settings['currency'] ) ? $pp->settings['currency'] : '';
							}
						} else {
							$short	= 'processor loading failure';
							$event	= 'When computing invoice amount, tried to load processor: ' . $this->method;
							$tags	= 'processor,loading,error';
							$params = array();

							$eventlog = new eventLog( $database );
							$eventlog->issue( $short, $tags, $event, 128, $params );

							return;
						}
				}
			}

			$usage = explode( '.', $this->usage );

			// Update old notation
			if ( !isset( $usage[1] ) ) {
				$temp = $usage[0];
				$usage[0] = 'p';
				$usage[1] = $temp;
			}

			$allfree = false;

			switch ( strtolower( $usage[0] ) ) {
				case 'c':
				case 'cart':
					$cart = $this->getObjUsage();

					if ( $cart->id ) {
						$return = $cart->getAmount( $metaUser, $this->counter );

						$this->amount = $return;
					} elseif ( isset( $this->params->cart ) ) {
						// Cart has been deleted, use copied data
						$vars = get_object_vars( $this->params->cart );
						foreach ( $vars as $v => $c ) {
							// Make extra sure we don't put through any _properties
							if ( strpos( $v, '_' ) !== 0 ) {
								$cart->$v = $c;
							}
						}

						$return = $cart->getAmount( $metaUser, $this->counter );

						$this->amount = $return;
					} else {
						$this->amount = '0.00';
					}
					break;
				case 'p':
				case 'plan':
				default:
					$plan = $this->getObjUsage();

					if ( is_object( $pp ) ) {
						$pp->exchangeSettingsByPlan( $plan );

						if ( $pp->is_recurring( $recurring_choice ) ) {
							$recurring = $pp->is_recurring( $recurring_choice );
						} else {
							$recurring = 0;
						}
					}

					$terms = $plan->getTermsForUser( $recurring, $metaUser );

					$terms->incrementPointer( $this->counter );

					$item = array( 'item' => array( 'obj' => $plan ), 'terms' => $terms );

					if ( $this->coupons ) {
						$cpsh = new couponsHandler( $metaUser, $InvoiceFactory, $this->coupons );

						$item = $cpsh->applyAllToItems( 0, $item );

						$terms = $item['terms'];
					}

					// Coupons might have changed the terms - reset pointer
					$terms->setPointer( $this->counter );

					$allfree = $terms->checkFree();

					if ( is_object( $terms->nextterm ) ) {
						$this->amount = $terms->nextterm->renderTotal();
					} else {
						$this->amount = '0.00';
					}
				break;
			}

			$this->amount = AECToolbox::correctAmount( $this->amount );

			if ( !$recurring || $allfree ) {
				if ( ( strcmp( $this->amount, '0.00' ) === 0 ) ) {
					$this->method = 'free';
					$madefree = true;
				} elseif ( ( strcmp( $this->amount, '0.00' ) === 0 ) && ( strcmp( $this->method, 'free' ) !== 0 ) ) {
					$short	= 'invoice amount error';
					$event	= 'When computing invoice amount: Method error, amount 0.00, but method = ' . $this->method;
					$tags	= 'processor,loading,error';
					$params = array();

					$eventlog = new eventLog( $database );
					$eventlog->issue( $short, $tags, $event, 128, $params );

					$this->method = 'error';
				}
			}

			if ( $save ) {
				$this->storeload();
			}

			if ( $madefree ) {
				$this->made_free = true;
			}
		}
	}

	function create( $userid, $usage, $processor, $second_ident=null, $store=true, $InvoiceFactory=null, $recurring_choice=null )
	{
		global $mainframe;

		$invoice_number			= $this->generateInvoiceNumber();

		$this->load(0);
		$this->invoice_number	= $invoice_number;

		if ( !is_null( $second_ident ) ) {
			$this->secondary_ident		= $second_ident;
		}

		$this->active			= 1;
		$this->fixed			= 0;
		$this->created_date		= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' )*3600 );
		$this->transaction_date	= '0000-00-00 00:00:00';
		$this->userid			= $userid;
		$this->method			= $processor;
		$this->usage			= $usage;

		$this->params = array( 'creator_ip' => $_SERVER['REMOTE_ADDR'] );

		$this->computeAmount( $InvoiceFactory, $store, $recurring_choice );
	}

	function generateInvoiceNumber( $maxlength = 16 )
	{
		$database = &JFactory::getDBO();

		$numberofrows	= 1;
		while ( $numberofrows ) {
			$inum =	'I' . substr( base64_encode( md5( rand() ) ), 0, $maxlength );
			// Check if already exists
			$query = 'SELECT count(*)'
					. ' FROM #__acctexp_invoices'
					. ' WHERE `invoice_number` = \'' . $inum . '\''
					. ' OR `secondary_ident` = \'' . $inum . '\''
					;
			$database->setQuery( $query );
			$numberofrows = $database->loadResult();
		}
		return $inum;
	}

	function processorResponse( $pp, $response, $resp='', $altvalidation=false )
	{
		global $aecConfig;

		if ( !empty( $aecConfig->cfg['invoice_cushion'] ) && ( $this->transaction_date !== '0000-00-00 00:00:00' ) ) {
			if ( ( strtotime( $this->transaction_date ) + $aecConfig->cfg['invoice_cushion']*60 ) > time() ) {
				// The last notification has not been too long ago - skipping this one
				return null;
			}
		}

		$database = &JFactory::getDBO();

		$this->computeAmount();

		$objUsage = $this->getObjUsage();

		if ( is_a( $objUsage, 'SubscriptionPlan' ) ) {
			$plan = $objUsage;
		} else {
			$plan = $objUsage->getTopPlan();
		}

		$post = aecPostParamClear( $_POST );
		$post['planparams'] = $plan->getProcessorParameters( $pp->id );

		$response['userid'] = $this->userid;

		$pp->exchangeSettingsByPlan( $plan, $plan->params );

		if ( $altvalidation ) {
			$response = $pp->instantvalidateNotification( $response, $post, $this );
		} else {
			$response = $pp->validateNotification( $response, $post, $this );
		}

		if ( isset( $response['userid'] ) ) {
			unset( $response['userid'] );
		}

		if ( isset( $response['invoiceparams'] ) ) {
			$this->addParams( $response['invoiceparams'] );
			$this->storeload();
			unset( $response['invoiceparams'] );
		}

		if ( isset( $response['multiplicator'] ) ) {
			$multiplicator = $response['multiplicator'];
			unset( $response['multiplicator'] );
		} else {
			$multiplicator = 1;
		}

		if ( isset( $response['fullresponse'] ) ) {
			$resp = $response['fullresponse'];
			unset( $response['fullresponse'] );
		}

		$metaUser = new metaUser( $this->userid );

		$mi_event = null;

		// Create history entry
		$history = new logHistory( $database );
		$history->entryFromInvoice( $this, $resp, $pp );

		$short = _AEC_MSG_PROC_INVOICE_ACTION_SH;
		$event = _AEC_MSG_PROC_INVOICE_ACTION_EV . "\n";

		if ( !empty( $response ) ) {
			foreach ( $response as $key => $value ) {
				$event .= $key . "=" . $value . "\n";
			}
		}

		$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_STATUS;
		$tags	= 'invoice,processor';
		$level	= 2;
		$params = array( 'invoice_number' => $this->invoice_number );

		$forcedisplay = false;

		$event .= ' ';

		$notificationerror = null;

		if ( $response['valid'] ) {
			$break = 0;

			// If not in Testmode, check for amount and currency
			if ( empty( $pp->settings['testmode'] ) ) {
				if ( isset( $response['amount_paid'] ) ) {
					if ( $response['amount_paid'] != $this->amount ) {
						// Amount Fraud, cancel payment and create error log addition
						$event	.= sprintf( _AEC_MSG_PROC_INVOICE_ACTION_EV_FRAUD, $response['amount_paid'], $this->amount );
						$tags	.= ',fraud_attempt,amount_fraud';
						$break	= 1;

						$notificationerror = 'Wrong amount for invoice. Amount provided: "' . $response['amount_paid'] . '"';
					}
				}

				if ( isset( $response['amount_currency'] ) ) {
					if ( $response['amount_currency'] != $this->currency ) {
						// Amount Fraud, cancel payment and create error log addition
						$event	.= sprintf( _AEC_MSG_PROC_INVOICE_ACTION_EV_CURR, $response['amount_currency'], $this->currency );
						$tags	.= ',fraud_attempt,currency_fraud';
						$break	= 1;

						$notificationerror = 'Wrong currency for invoice. Currency provided: "' . $response['amount_currency'] . '"';
					}
				}
			}

			if ( !$break ) {
				if ( $this->pay( $multiplicator ) === false ) {
					$notificationerror = 'Item Application failed. Please contact the System Administrator';

					// Something went wrong
					$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_VALID_APPFAIL;
					$tags	.= ',payment,action_failed';
				} else {
					$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_VALID;
					$tags	.= ',payment,action';
				}
			} else {
				$level = 128;
			}
		} else {
			if ( isset( $response['pending'] ) ) {
				if ( strcmp( $response['pending_reason'], 'signup' ) === 0 ) {
					if ( $plan->params['trial_free'] || ( $this->amount == '0.00' ) ) {
						$this->pay( $multiplicator );

						$this->addParams( array( 'free_trial' => $response['pending_reason'] ), 'params', true );

						$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_TRIAL;
						$tags	.= ',payment,action,trial';
					}
				} else {
					$this->addParams( array( 'pending_reason' => $response['pending_reason'] ), 'params', true );
					$event	.= sprintf( _AEC_MSG_PROC_INVOICE_ACTION_EV_PEND, $response['pending_reason'] );
					$tags	.= ',payment,pending' . $response['pending_reason'];

					$mi_event = '_payment_pending';
				}

				$this->storeload();
			} elseif ( isset( $response['cancel'] ) ) {
				$mi_event = '_payment_cancel';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_CANCEL;
				$tags	.= ',cancel';

				if ( $metaUser->hasSubscription ) {
					if ( !empty( $this->subscr_id ) ) {
						$metaUser->moveFocus( $this->subscr_id );
					}

					if ( isset( $response['cancel_expire'] ) ) {
						$mi_event = '_payment_cancel_expire';

						$metaUser->focusSubscription->expire();
						$tags	.= ',expire';
					} else {
						$metaUser->focusSubscription->cancel( $this );
					}

					$event .= _AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS;
				}
			} elseif ( isset( $response['chargeback'] ) ) {
				$mi_event = '_payment_chargeback';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK;
				$tags	.= ',chargeback';
				$level = 128;

				if ( $metaUser->hasSubscription ) {
					if ( !empty( $this->subscr_id ) ) {
						$metaUser->moveFocus( $this->subscr_id );
					}

					$metaUser->focusSubscription->hold( $this );

					$event .= _AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_HOLD;
				}
			} elseif ( isset( $response['chargeback_settle'] ) ) {
				$mi_event = '_payment_chargeback_settle';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK_SETTLE;
				$tags	.= ',chargeback_settle';
				$level = 8;
				$forcedisplay = true;

				if ( $metaUser->hasSubscription ) {
					if ( !empty( $this->subscr_id ) ) {
						$metaUser->moveFocus( $this->subscr_id );
					}

					$metaUser->focusSubscription->hold_settle( $this );

					$event .= _AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_ACTIVE;
				}
			} elseif ( isset( $response['delete'] ) ) {
				$mi_event = '_payment_refund';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_REFUND;
				$tags	.= ',refund';
				if ( $metaUser->hasSubscription ) {
					if ( !empty( $this->subscr_id ) ) {
						$metaUser->moveFocus( $this->subscr_id );
					}

					$metaUser->focusSubscription->expire();
					$event .= _AEC_MSG_PROC_INVOICE_ACTION_EV_EXPIRED;
				}
			} elseif ( isset( $response['eot'] ) ) {
				$mi_event = '_payment_eot';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_EOT;
				$tags	.= ',eot';
			} elseif ( isset( $response['duplicate'] ) ) {
				$mi_event = '_payment_duplicate';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_DUPLICATE;
				$tags	.= ',duplicate';
			} elseif ( isset( $response['null'] ) ) {
				$mi_event = '_payment_null';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_NULL;
				$tags	.= ',null';
			} elseif ( isset( $response['error'] ) && isset( $response['errormsg'] ) ) {
				$mi_event = '_payment_error';

				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_U_ERROR . ' Error:' . $response['errormsg'] ;
				$tags	.= ',error';
				$level = 128;

				$notificationerror = $response['errormsg'];
			} else {
				$event	.= _AEC_MSG_PROC_INVOICE_ACTION_EV_U_ERROR;
				$tags	.= ',general_error';
				$level = 128;

				$notificationerror = 'General Error. Please contact the System Administrator.';
			}
		}

		if ( !empty( $mi_event ) && !empty( $this->usage ) ) {
			$objUsage = new SubscriptionPlan( $database );
			$objUsage->load( $this->usage );

			$exchange = $silent = null;

			$objUsage->triggerMIs( $mi_event, $metaUser, $exchange, $this, $response, $silent );
		}

		if ( isset( $response['explanation'] ) ) {
			$event .= " (" . $response['explanation'] . ")";
		}

		$eventlog = new eventLog( $database );
		$eventlog->issue( $short, $tags, $event, $level, $params, $forcedisplay );

		if ( !empty( $notificationerror ) ) {
			$pp->notificationError( $response, $notificationerror );
		} else {
			$pp->notificationSuccess( $response );
		}
	}

	function pay( $multiplicator=1 )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$metaUser	= false;
		$new_plan	= false;
		$plans		= array();

		if ( !empty( $this->userid ) ) {
			$metaUser = new metaUser( $this->userid );
		}

		if ( !empty( $this->params['target_user'] ) ) {
			$targetUser = new metaUser( $this->params['target_user'] );
		} else {
			$targetUser =& $metaUser;
		}

		if ( !empty( $this->usage ) ) {
			$usage = explode( '.', $this->usage );

			// Update old notation
			if ( !isset( $usage[1] ) ) {
				$temp = $usage[0];
				$usage[0] = 'p';
				$usage[1] = $temp;
			}

			switch ( strtolower( $usage[0] ) ) {
				case 'c':
				case 'cart':
					$this->params['cart'] = new aecCart( $database );
					$this->params['cart']->load( $usage[1] );

					foreach ( $this->params['cart']->content as $c ) {
						$new_plan = new SubscriptionPlan( $database );
						$new_plan->load( $c['id'] );

						for ( $i=0; $i<$c['quantity']; $i++ ) {
							$plans[] = $new_plan;
						}
					}

					$this->params['cart']->clear();

					// Load and delete original entry
					$cart = new aecCart( $database );
					$cart->load( $usage[1] );
					$cart->delete();
					break;
				case 'p':
				case 'plan':
				default:
					$new_plan = new SubscriptionPlan( $database );
					$new_plan->load( $this->usage );

					$plans[] = $new_plan;
					break;
				// Single Payments?
			}

		}

		foreach ( $plans as $plan ) {
			if ( is_object( $targetUser ) && is_object( $plan ) ) {
				if ( $targetUser->userid ) {
					if ( !empty( $this->subscr_id ) ) {
						$targetUser->establishFocus( $plan, $this->method, false, $this->subscr_id );
					} else {
						$targetUser->establishFocus( $plan, $this->method );
					}

					$this->subscr_id = $targetUser->focusSubscription->id;

					// Apply the Plan
					$application = $targetUser->focusSubscription->applyUsage( $plan->id, $this->method, 0, $multiplicator, $this );
				} else {
					$application = $plan->applyPlan( 0, $this->method, 0, $multiplicator, $this );
				}

				if ( $application === false ) {
					return false;
				}
			}
		}

		if ( !empty( $this->conditions ) ) {
			$micro_integrations = false;

			if ( strpos( $this->conditions, 'mi_attendevents' ) ) {
				$micro_integration['name'] = 'mi_attendevents';
				$micro_integration['parameters'] = array( 'registration_id' => $this->substring_between( $this->conditions, '<registration_id>', '</registration_id>' ) );
				$micro_integrations = array();
				$micro_integrations[] = $micro_integration;
			}

			if ( is_array( $micro_integrations ) ) {
				foreach ( $micro_integrations as $micro_int ) {
					$mi = new microIntegration( $database );

					if ( isset( $micro_integration['parameters'] ) ) {
						$exchange = $micro_integration['parameters'];
					} else {
						$exchange = null;
					}

					if ( isset( $micro_int['name'] ) ) {
						if ( $mi->callDry( $micro_int['name'] ) ) {
							if ( is_object( $metaUser ) ) {
								$mi->action( $metaUser, $exchange, $this, $new_plan );
							} else {
								$mi->action( false, $exchange, $this, $new_plan );
							}
						}
					} elseif ( isset( $micro_int['id'] ) ) {
						if ( $mi->mi_exists( $micro_int['id'] ) ) {
							$mi->load( $micro_int['id'] );
							if ( $mi->callIntegration() ) {
								if ( is_object( $metaUser ) ) {
									$mi->action( $metaUser, $exchange, $this, $new_plan );
								} else {
									$mi->action( false, $exchange, $this, $new_plan );
								}
							}
						}
					}

					unset( $mi );
				}
			}
		}

		if ( $this->coupons ) {
			foreach ( $this->coupons as $coupon_code ) {
				$cph = new couponHandler();
				$cph->load( $coupon_code );

				// See whether this coupon has micro integrations
				if ( empty( $cph->coupon->micro_integrations ) ) {
					continue;
				}

				foreach ( $cph->coupon->micro_integrations as $mi_id ) {
					$mi = new microIntegration( $database );

					// Only call if it exists
					if ( !$mi->mi_exists( $mi_id ) ) {
						continue;
					}

					$mi->load( $mi_id );

					// Check whether we can really call
					if ( !$mi->callIntegration() ) {
						continue;
					}

					if ( is_object( $metaUser ) ) {
						if ( $mi->action( $metaUser, null, $this, $new_plan ) === false ) {
							if ( $aecConfig->cfg['breakon_mi_error'] ) {
								return false;
							}
						}
					} else {
						if ( $mi->action( false, null, $this, $new_plan ) === false ) {
							if ( $aecConfig->cfg['breakon_mi_error'] ) {
								return false;
							};
						}
					}
				}
			}
		}

		// We need to at least warn the admin if there is an invoice with nothing to do
		if ( empty( $this->usage ) && empty( $this->conditions ) && empty( $this->coupons ) ) {
			$short	= 'Nothing to do';
			$event	= _AEC_MSG_PROC_INVOICE_ACTION_EV_VALID_APPFAIL;
			$tags	= 'invoice,application,payment,action_failed';
			$params = array( 'invoice_number' => $this->invoice_number );

			$eventlog = new eventLog( $database );
			$eventlog->issue( $short, $tags, $event, 32, $params );
		}

		$this->setTransactionDate();

		return $application;
	}

	function substring_between( $haystack, $start, $end )
	{
		if ( strpos( $haystack, $start ) === false || strpos( $haystack, $end ) === false ) {
			return false;
		} else {
			$start_position = strpos( $haystack, $start ) + strlen( $start );
			$end_position = strpos( $haystack, $end );
			return substr( $haystack, $start_position, $end_position - $start_position );
		}
	}

	function setTransactionDate()
	{
		$database = &JFactory::getDBO();

		global $mainframe, $aecConfig;

		$tdate				= strtotime( $this->transaction_date );
		$time_passed		= ( ( time() + $mainframe->getCfg( 'offset' ) *3600 ) - $tdate ) / 3600;
		$transaction_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );

		if ( !empty( $aecConfig->cfg['invoicecushion'] ) ) {
			$cushion = $aecConfig->cfg['invoicecushion']*60;
		} else {
			$cushion = 0;
		}

		if ( $time_passed > $cushion ) {
			$this->counter += 1;
			$this->transaction_date	= $transaction_date;

			$c = new stdClass();

			$c->timestamp	= $transaction_date;
			$c->amount		= $this->amount;
			$c->currency	= $this->currency;
			$c->processor	= $this->method;

			$this->transactions[] = $c;

			$this->storeload();
		} else {
			return;
		}
	}

	function getWorkingData( $InvoiceFactory )
	{
		$database = &JFactory::getDBO();

		$int_var = array();

		// Defaults
		$int_var['params']		= array();
		$int_var['invoice']		= $this->invoice_number;
		$int_var['usage']		= $this->usage;
		$int_var['amount']		= $this->amount;

		if ( isset( $InvoiceFactory->recurring ) ) {
			$int_var['recurring']	= $InvoiceFactory->recurring;
		} else {
			$int_var['recurring']	= 0;
		}

		if ( is_array( $this->params ) ) {
			$int_var['params'] = $this->params;

			// Filter non-processor params
			$nonproc = array( 'pending_reason', 'deactivated' );

			foreach ( $nonproc as $param ) {
				if ( isset( $int_var['params'][$param] ) ) {
					unset( $int_var['params'][$param] );
				}
			}
		}

		$int_var['objUsage'] = $this->getObjUsage();

		$urladd = '';
		if ( !empty( $int_var['objUsage'] ) ) {
			if ( is_a( $int_var['objUsage'], 'SubscriptionPlan' ) ) {
				$int_var['planparams'] = $int_var['objUsage']->getProcessorParameters( $InvoiceFactory->pp->id );

				if ( isset( $int_var['params']['userselect_recurring'] ) ) {
					$int_var['recurring'] = $InvoiceFactory->pp->is_recurring( $int_var['params']['userselect_recurring'], true );
				} else {
					$int_var['recurring'] = $InvoiceFactory->pp->is_recurring();
				}

				$terms = $int_var['objUsage']->getTermsForUser( $int_var['recurring'], $InvoiceFactory->metaUser );

				$int_var['amount']		= $terms->getOldAmount( $int_var['recurring'] );

				if ( !empty( $int_var['objUsage']->params['customthanks'] ) || !empty( $int_var['objUsage']->params['customtext_thanks'] ) ) {
					$urladd = '&amp;u=' . $this->usage;
				}
			} else {
				if ( !empty( $InvoiceFactory->cart ) && !empty( $InvoiceFactory->cartobject ) ) {
					$int_var['objUsage'] = $InvoiceFactory->cartobject;
				}

				$int_var['amount'] = $int_var['objUsage']->getAmount( $InvoiceFactory->metaUser );
			}
		}

		// Does not apply for Cart - as it has already happened in cart->getAmount()
		// Yet might apply for non-usage invoice
		if ( empty( $int_var['objUsage'] ) || is_a( $int_var['objUsage'], 'SubscriptionPlan' ) ) {
			if ( !empty( $this->coupons ) ) {
				$cph = new couponsHandler( $InvoiceFactory->metaUser, $InvoiceFactory, $this->coupons );

				$int_var['amount'] = $cph->applyToAmount( $int_var['amount'] );
			}
		}

		if ( is_object( $InvoiceFactory->metaUser ) ) {
			$renew = $InvoiceFactory->metaUser->is_renewing();
		} else {
			$renew = 0;
		}

		$int_var['return_url']	= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=thanks&amp;renew=' . $renew . $urladd );

		return $int_var;
	}

	function getObjUsage()
	{
		$database = &JFactory::getDBO();

		$usage = null;
		if ( !empty( $this->usage ) ) {
			$usage = $this->usage;
		}

		if ( !empty( $usage ) ) {
			$u = explode( '.', $usage );

			switch ( strtolower( $u[0] ) ) {
				case 'c':
				case 'cart':
					$objUsage = new aecCart( $database );
					$objUsage->load( $u[1] );

					if ( empty( $objUsage->content ) && !empty( $this->params['cart'] ) ) {
						$objUsage = $this->params['cart'];
					}
					break;
				case 'p':
				case 'plan':
				default:
					if ( !isset( $u[1] ) ) {
						$u[1] = $u[0];
					}

					$objUsage = new SubscriptionPlan( $database );
					$objUsage->load( $u[1] );
					break;
			}

			return $objUsage;
		} else {
			return null;
		}
	}

	function addTargetUser( $user_ident )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( !empty( $aecConfig->cfg['checkout_as_gift'] ) ) {
			if ( !empty( $aecConfig->cfg['checkout_as_gift_access'] ) ) {
				$user = &JFactory::getUser();

				$metaUser = new metaUser( $user->id );

				// Apparently, we cannot trust $user->gid
				$groups = GeneralInfoRequester::getLowerACLGroup( $metaUser->cmsUser->gid );

				if ( !in_array( $aecConfig->cfg['checkout_as_gift_access'], $groups ) ) {
					return false;
				}
			}
		} else {
			return false;
		}

		$queries = array();

		// Try username and name
		$queries[] = 'FROM #__users'
					. ' WHERE LOWER( `username` ) LIKE \'%' . $user_ident . '%\''
					;

		// If its not that, how about the user email?
		$queries[] = 'FROM #__users'
					. ' WHERE LOWER( `email` ) = \'' . $user_ident . '\''
					;

		// Try to find this as a userid
		$queries[] = 'FROM #__users'
					. ' WHERE `id` = \'' . $user_ident . '\''
					;

		// Try to find this as a full name
		$queries[] = 'FROM #__users'
					. ' WHERE LOWER( `name` ) LIKE \'%' . $user_ident . '%\''
					;

		foreach ( $queries as $base_query ) {
			$res = null;
			$query = 'SELECT `id`, `username`, `email` ' . $base_query;
			$database->setQuery( $query );
			if ( aecJoomla15check() ) {
				$res = $database->loadObject();
			} else {
				$database->loadObject($res);
			}

			if ( !empty( $res ) ) {
				$this->params['target_user'] = $res->id;
				$this->params['target_username'] = $res->username . ' (' . $res->email . ')';
				return true;
			}
		}

		return false;
	}

	function removeTargetUser()
	{
		if ( isset( $this->params['target_user'] ) ) {
			unset( $this->params['target_user'] );
			unset( $this->params['target_username'] );

			return true;
		} else {
			return null;
		}
	}

	function addCoupon( $couponcode )
	{
		if ( !empty( $this->coupons ) ) {
			if ( !is_array( $this->coupons ) ) {
				$oldcoupons = explode( ';', $this->coupons );
			} else {
				$oldcoupons = $this->coupons;
			}
		} else {
			$oldcoupons = array();
		}

		if ( !in_array( $couponcode, $oldcoupons ) ) {
			$oldcoupons[] = $couponcode;

			$cph = new couponHandler();
			$cph->load( $couponcode );

			if ( $cph->status ) {
				$cph->incrementCount( $this );
			}
		}

		$this->coupons = $oldcoupons;
	}

	function removeCoupon( $coupon_code )
	{
		$database = &JFactory::getDBO();

		$oldcoupons = $this->coupons;

		if ( !is_array( $oldcoupons ) ) {
			$oldcoupons = array();
		}

		if ( in_array( $coupon_code, $oldcoupons ) ) {
			foreach ( $oldcoupons as $id => $cc ) {
				if ( $cc == $coupon_code ) {
					unset( $oldcoupons[$id] );
				}
			}

			$cph = new couponHandler();
			$cph->load( $coupon_code );
			if ( $cph->coupon->id ) {
				$cph->decrementCount( $this );
			}

			if ( !empty( $this->usage ) ) {
				$usage = explode( '.', $this->usage );

				// Update old notation
				if ( !isset( $usage[1] ) ) {
					$temp = $usage[0];
					$usage[0] = 'p';
					$usage[1] = $temp;
				}

				switch ( strtolower( $usage[0] ) ) {
					case 'c':
					case 'cart':
						$cart = new aecCart( $database );
						$cart->load( $usage[1] );

						$cart->removeCoupon( $coupon_code );
						$cart->storeload();
						break;
				}

			}
		}

		$this->coupons = $oldcoupons;
	}

	function savePostParams( $array )
	{
		unset( $array['task'] );
		unset( $array['option'] );
		unset( $array['invoice'] );

		$this->addParams( $array );
		return true;
	}

	function getPrintout( $InvoiceFactory )
	{
		global $aecConfig;

		$data = $this->getWorkingData( $InvoiceFactory );

		$data['invoice_id'] = $this->id;
		$data['invoice_number'] = $this->invoice_number;

		$data['invoice_date'] = HTML_frontend::DisplayDateInLocalTime( $InvoiceFactory->invoice->created_date );

		$data['itemlist'] = array();
		$total = 0;
		$break = 0;
		foreach ( $InvoiceFactory->items as $iid => $item ) {
			if ( isset( $item['obj'] ) ) {
				$amt =  $item['terms']->nextterm->renderTotal();

				$data['itemlist'][] = '<tr id="invoice_content_item">'
					. '<td>' . $item['name'] . '</td>'
					. '<td>' . AECToolbox::formatAmount( $amt, $InvoiceFactory->invoice->currency ) . '</td>'
					. '<td>' . $item['quantity'] . '</td>'
					. '<td>' . AECToolbox::formatAmount( $amt * $item['quantity'], $InvoiceFactory->invoice->currency ) . '</td>'
					. '</tr>';
			} else {
				if ( !$break ) {
					$data['totallist'][] = '<tr id="invoice_content_item_separator">'
					. '<td colspan="4"></td>'
					. '</tr>';

					$break = 1;
				}

				switch ( $item['terms']->terms[0]->type ){
					case 'tax':
						$data['totallist'][] = '<tr id="invoice_content_item_tax">'
							. '<td>Tax' . null . '</td>'
							. '<td></td>'
							. '<td></td>'
							. '<td>' . AECToolbox::formatAmount( $item['cost'], $InvoiceFactory->invoice->currency ) . '</td>'
							. '</tr>';
						break;
					case 'total':
						$data['totallist'][] = '<tr id="invoice_content_item_total">'
							. '<td>' . ( ( $iid == count( $InvoiceFactory->items )-1 ) ? _INVOICEPRINT_GRAND_TOTAL : _INVOICEPRINT_TOTAL ) . '</td>'
							. '<td></td>'
							. '<td></td>'
							. '<td>' . AECToolbox::formatAmount( $item['cost'], $InvoiceFactory->invoice->currency ) . '</td>'
							. '</tr>';
						break;
				}
			}
		}

		if ( $this->transaction_date == '0000-00-00 00:00:00' ) {
			$data['paidstatus'] = _INVOICEPRINT_PAIDSTATUS_UNPAID;
		} else {
			$date = strftime( $aecConfig->cfg['display_date_frontend'], strtotime( $this->transaction_date ) );

			$data['paidstatus'] = sprintf( _INVOICEPRINT_PAIDSTATUS_PAID, $date );
		}

		$otherfields = array( "page_title", "before_header", "header", "after_header", "address", "before_content", "after_content", "before_footer", "footer", "after_footer" );

		foreach ( $otherfields as $field ) {
			if ( !empty( $aecConfig->cfg["invoice_".$field] ) ) {
				$data[$field] = AECToolbox::rewriteEngineRQ( $aecConfig->cfg["invoice_".$field], $InvoiceFactory );
			} else {
				$data[$field] = "";
			}
		}

		return $data;
	}

	function getTransactionStatus()
	{
		if ( $this->transaction_date == '0000-00-00 00:00:00' ) {
			$transactiondate = 'uncleared';

			if ( empty( $this->params ) || empty( $row->params['pending_reason'] ) ) {
				return $transactiondate;
			}

			if ( defined( '_PAYMENT_PENDING_REASON_' . strtoupper( $row->params['pending_reason'] ) ) ) {
				$transactiondate = constant( '_PAYMENT_PENDING_REASON_' . strtoupper( $row->params['pending_reason'] ) );
			} else {
				$transactiondate = $row->params['pending_reason'];
			}
		} else {
			$transactiondate = HTML_frontend::DisplayDateInLocalTime( $this->transaction_date );
		}

		return $transactiondate;
	}
}

class aecCartHelper
{
	function getCartidbyUserid( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_cart'
				. ' WHERE userid = \'' . $userid . '\''
				;

		$database->setQuery( $query );
		return $database->loadResult();

	}

	function getCartbyUserid( $userid )
	{
		$database = &JFactory::getDBO();

		$id = aecCartHelper::getCartidbyUserid( $userid );

		$cart = new aecCart( $database );
		$cart->load( $id );

		if ( empty( $id ) ) {
			$cart->userid = $userid;
		}

		return $cart;
	}

	function getCartItemObject( $cart, $id )
	{
		$item = $cart->getItem( $id );
		if ( !empty( $item ) ) {
			$database = &JFactory::getDBO();

			$plan = new SubscriptionPlan( $database );
			$plan->load( $item['id'] );

			return $plan;
		}
	}

	function getFirstCartItemObject( $cart )
	{
		foreach ( $cart->content as $cid => $c ) {
			return aecCartHelper::getCartItemObject( $cart, $cid );
		}
	}

	function getFirstSortedCartItemObject( $cart )
	{
		$database = &JFactory::getDBO();

		$highest = 0;
		$cursor = 999999;

		foreach ( $cart->content as $cid => $c ) {
			$query = 'SELECT ordering'
			. ' FROM #__acctexp_plans'
			. ' WHERE `id` = \'' . $c['id'] . '\''
			;
			$database->setQuery( $query );
			$ordering = $database->loadResult();

			if ( $ordering < $cursor ) {
				$highest = $cid;
				$cursor = $ordering;
			}
		}

		return aecCartHelper::getCartItemObject( $cart, $highest );
	}

	function getCartProcessorList( $cart, $nofree=true )
	{
		$proclist = array();

		foreach ( $cart->content as $cid => $c ) {
			$cartitem = aecCartHelper::getCartItemObject( $cart, $cid );

			if ( is_array( $cartitem->params['processors'] ) && !empty( $cartitem->params['processors'] ) ) {
				foreach ( $cartitem->params['processors'] as $pid ) {
					$sid = $pid;

					/*if ( $cartitem->custom_params[$pid . '_aec_overwrite_settings'] == "on" ) {
						if ( !empty( $cartitem->custom_params[$pid . '_recurring'] ) ) {
							if ( $cartitem->custom_params[$pid . '_recurring'] == 2 ) {
								if ( array_search( $sid, $proclist ) === false ) {
									$proclist[] = $sid;
								}
							}

							$sid .= '_recurring';
						}
					}*/

					if ( array_search( $sid, $proclist ) === false ) {
						$proclist[] = $sid;
					}
				}
			}
		}

		return $proclist;
	}

	function getCartProcessorGroups( $cart )
	{
		$pgroups	= array();

		foreach ( $cart->content as $cid => $c ) {
			$cartitem = aecCartHelper::getCartItemObject( $cart, $cid );

			$pplist = array();
			if ( !empty( $cartitem->params['processors'] ) ) {
				foreach ( $cartitem->params['processors'] as $n ) {
					$pp = new PaymentProcessor();

					if ( !$pp->loadId( $n ) ) {
						continue;
					}

					$pp->init();
					$pp->getInfo();
					$pp->exchangeSettingsByPlan( $cartitem );

					if ( isset( $this->recurring ) ) {
						$recurring = $pp->is_recurring( $this->recurring );
					} else {
						$recurring = $pp->is_recurring();
					}

					if ( $recurring > 1 ) {
						$pplist[] = $pp->id;

						if ( !$cartitem->params['lifetime'] ) {
							$pplist[] = $pp->id.'_recurring';
						}
					} elseif ( !( $cartitem->params['lifetime'] && $recurring ) ) {
						$pplist[] = $pp->id . '_recurring';
					} else {
						$pplist[] = $pp->id;
					}
				}
			}

			if ( empty( $pgroups ) ) {
				$pg = array();
				$pg['members']		= array( $cid );
				$pg['processors']	= $pplist;

				$pgroups[] = $pg;
			} else {
				$create = true;

				foreach ( $pgroups as $pgid => $pgroup ) {
					$pg = array();

					if ( count( $pplist ) == count( $pgroup['processors'] ) ) {
						$a = true;
						foreach ( $pplist as $k => $v ) {
							if ( $pgroup['processors'][$k] != $v ) {
								$a = false;
							}
						}

						if ( $a ) {
							$pgroups[$pgid]['members'][] = $cid;
							$create = false;
						}
					}
				}

				if ( $create ) {
					$pg['members']		= array( $cid );
					$pg['processors']	= $pplist;

					$pgroups[] = $pg;
				}
			}
		}

		return $pgroups;
	}

	function getInvoiceIdByCart( $cart )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
		. ' FROM #__acctexp_invoices'
		. ' WHERE `usage` = \'c.' . $cart->id . '\''
		. ' AND active = \'1\''
		;
		$database->setQuery( $query );
		return $database->loadResult();
	}
}

class aecCart extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $userid				= null;
	/** @var datetime */
	var $created_date		= null;
	/** @var datetime */
	var $last_updated		= null;
	/** @var text */
	var $content 			= array();
	/** @var text */
	var $history 			= array();
	/** @var text */
	var $params 			= array();
	/** @var text */
	var $customparams		= array();

	/**
	* @param database A database connector object
	*/
	function aecCart( &$db )
	{
		parent::__construct( '#__acctexp_cart', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'content', 'history', 'params', 'customparams' );
	}

	function check()
	{
		$vars = get_class_vars( 'aecCart' );
		$props = get_object_vars( $this );

		foreach ( $props as $n => $prop ) {
			if ( !array_key_exists( $n, $vars  ) ) {
				unset( $this->$n );
			}
		}

		return parent::check();
	}

	function save()
	{
			global $mainframe;

		if ( !$this->id ) {
			$this->created_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		}

		$this->last_updated = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );

		return parent::save();
	}

	function action( $action, $details=null )
	{
		if ( $action == "clearCart" ) {
			$database = &JFactory::getDBO();

			// Delete Invoices referencing this Cart as well
			$query = 'DELETE FROM #__acctexp_invoices WHERE `usage` = \'c.' . $this->id . '\'';
			$database->setQuery( $query );
			$database->query();

			return $this->delete();
		}

		if ( method_exists( $this, $action ) ) {
			$a = array( 'action' => 'action',
						'event' => $action,
						'details' => $details
			);

			$return = $this->$action( $a, $details );

			$this->issueHistoryEvent( $return['action'], $return['event'], $return['details'] );
		} else {
			$this->issueHistoryEvent( 'error', 'action_not_found', array( $action, $details ) );
		}

		$this->storeload();
	}

	function addItem( $return, $item )
	{
		if ( is_object( $item ) ) {
			$id = $item->id;
		} else {
			$id = $item;
		}

		if ( !empty( $id ) ) {
			$element			= array();
			$element['type']	= 'plan';
			$element['id']		= $id;
			$element['quantity']	= 1;

			$return['details'] = array( 'type' => 'plan', 'id' => $id );

			$update = false;
			if ( !empty( $this->content ) ) {
				foreach ( $this->content as $iid => $item ) {
					if ( ( $item['type'] == $element['type'] ) && ( $item['id'] == $element['id'] ) ) {
						$return['event'] = 'updateItem';
						$this->content[$iid]['quantity']++;
						$update = true;
						break;
					}
				}
			}

			if ( !$update ) {
				$this->content[] = $element;
			}
		} else {
			$return['action']	= 'error';
			$return['event']	= 'no_item_provided';
			$return['details']	= array( 'type' => 'plan', 'item' => $item );
		}

		return $return;
	}

	function addCoupon( $coupon_code, $id=null )
	{
		if ( is_null( $id ) ) {
			if ( !isset( $this->params['overall_coupons'] ) ) {
				$this->params['overall_coupons'] = array();
			}

			if ( !in_array( $coupon_code, $this->content['overall_coupons'] ) ) {
				$this->params['overall_coupons'][] = $coupon_code;
			}
		} elseif ( isset( $this->content[$id] ) ) {
			if ( !isset( $this->content[$id]['coupons'] ) ) {
				$this->content[$id]['coupons'] = array();
			}

			if ( !in_array( $coupon_code, $this->content[$id]['coupons'] ) ) {
				$this->content[$id]['coupons'][] = $coupon_code;
			}
		}
	}

	function removeCoupon( $coupon_code, $id=null )
	{
		foreach ( $this->content as $cid => $content ) {
			if ( !is_null( $id ) ) {
				if ( $id !== $cid ) {
					continue;
				}
			}

			if ( !empty( $content['coupons'] ) ) {
				foreach ( $content['coupons'] as $ccid => $code ) {
					if ( $code == $coupon_code ) {
						unset( $this->content[$cid]['coupons'][$ccid] );
					}
				}
			}
		}

		if ( is_null( $id ) ) {
			if ( is_array( $this->params['overall_coupons'] ) && !empty( $this->params['overall_coupons'] ) ) {
				if ( in_array( $coupon_code, $this->params['overall_coupons'] ) ) {
					$oid = array_search( $coupon_code, $this->params['overall_coupons'] );
					unset( $this->params['overall_coupons'][$oid] );
				}
			}
		}
	}

	function hasCoupon( $coupon_code, $id=null )
	{
		if ( is_null( $id ) ) {
			if ( !empty( $this->params['overall_coupons'] ) ) {
				return in_array( $coupon_code, $this->params['overall_coupons'] );
			} else {
				return false;
			}
		} elseif ( isset( $this->content[$id] ) ) {
			if ( !empty( $this->content[$id]['coupons'] ) ) {
				return in_array( $coupon_code, $this->content[$id]['coupons'] );
			} else {
				return false;
			}
		}

		return false;
	}

	function getItemIdArray()
	{
		$array = array();
		foreach ( $this->content as $cid => $content ) {
			$array[$cid] = $content['id'];
		}

		return $array;
	}

	function getItem( $item )
	{
		if ( isset( $this->content[$item] ) ) {
			return $this->content[$item];
		} else {
			return null;
		}
	}

	function removeItem( $return, $itemid )
	{
		if ( isset( $this->content[$itemid] ) ) {
			$return['details'] = array( 'item_id' => $itemid, 'item' => $this->content[$itemid] );
			unset( $this->content[$itemid] );
		} else {
			$return = array(	'action' => 'error',
								'event' => 'item_not_found',
								'details' => array( 'item_id' => $itemid )
								);
		}

		return $return;
	}

	function updateItems( $return, $updates )
	{
		foreach ( $updates as $uid => $count ) {
			if ( isset( $this->content[$uid] ) ) {
				if ( empty( $count ) ) {
					unset( $this->content[$uid] );
				} else {
					$this->content[$uid]['quantity'] = $count;
				}
			}
		}

		return $return;
	}

	function getCheckout( $metaUser, $counter=0 )
	{
		$database = &JFactory::getDBO();

		$c = array();

		$totalcost = 0;

		if ( empty( $this->content ) ) {
			return array();
		}

		$return = array();
		foreach ( $this->content as $cid => $content ) {
			// Cache items
			if ( !isset( $c[$content['type']][$content['id']] ) ) {
				switch ( $content['type'] ) {
					case 'plan':
						$obj = new SubscriptionPlan( $database );
						$obj->load( $content['id'] );

						$o = array();
						$o['obj']	= $obj;
						$o['name']	= $obj->getProperty( 'name' );
						$o['desc']	= $obj->getProperty( 'desc' );

						$terms = $obj->getTermsForUser( false, $metaUser );

						if ( $counter ) {
							$terms->incrementPointer( $counter );
						}

						$o['terms']	= $terms;
						$o['cost']	= $terms->nextterm->renderCost();

						$c[$content['type']][$content['id']] = $o;
						break;
				}
			}

			$entry = array();
			$entry['obj']			= $c[$content['type']][$content['id']]['obj'];
			$entry['fullamount']	= $c[$content['type']][$content['id']]['cost'];

			$entry['name']			= $c[$content['type']][$content['id']]['name'];
			$entry['desc']			= $c[$content['type']][$content['id']]['desc'];
			$entry['terms']			= $c[$content['type']][$content['id']]['terms'];

			$item = array( 'item' => array( 'obj' => $entry['obj'] ), 'terms' => $entry['terms'] );

			if ( !empty( $content['coupons'] ) ) {
				$cpsh = new couponsHandler( $metaUser, false, $content['coupons'] );

				$item = $cpsh->applyAllToItems( 0, $item );

				$entry['terms'] = $item['terms'];
			}

			$entry['cost'] = $entry['terms']->nextterm->renderTotal();

			if ( $entry['cost'] > 0 ) {
				$total = $content['quantity'] * $entry['cost'];

				$entry['cost_total']	= AECToolbox::correctAmount( $total );
			} else {
				$entry['cost_total']	= AECToolbox::correctAmount( '0.00' );
			}

			if ( $entry['cost_total'] == '0.00' ) {
				$entry['free'] = true;
			} else {
				$entry['free'] = false;
			}

			$entry['cost']			= AECToolbox::correctAmount( $entry['cost'] );

			$entry['quantity']		= $content['quantity'];

			$totalcost += $entry['cost_total'];

			$return[$cid] = $entry;
		}

		if ( !empty( $this->params['overall_coupons'] ) ) {
			$cpsh = new couponsHandler( $metaUser, false, $this->params['overall_coupons'] );

			$totalcost_ncp = $totalcost;
			$totalcost = $cpsh->applyToAmount( $totalcost );
		} else {
			$totalcost_ncp = $totalcost;
		}

		// Append total cost
		$return[] = array( 'name' => '',
							'count' => '',
							'cost' => AECToolbox::correctAmount( $totalcost_ncp ),
							'cost_total' => AECToolbox::correctAmount( $totalcost ),
							'is_total' => true,
							'obj' => false
							);

		return $return;
	}

	function getAmount( $metaUser=null, $counter=0 )
	{
		$checkout = $this->getCheckout( $metaUser, $counter );

		$max = array_pop( array_keys( $checkout ) );

		return $checkout[$max]['cost_total'];
	}

	function getTopPlan()
	{
		return aecCartHelper::getFirstSortedCartItemObject( $this );
	}

	function triggerMIs( $action, &$metaUser, &$exchange, &$invoice, &$add, &$silent )
	{
		$checkout = $this->getCheckout( $metaUser );

		foreach ( $checkout as $item ) {
			if ( !empty( $item['obj'] ) ) {
				$item['obj']->triggerMIs( $action, $metaUser, $exchange, $invoice, $add, $silent );
			}
		}
	}

	function issueHistoryEvent( $class, $event, $details )
	{
		global $mainframe;

		if ( $class == 'error' ) {
			$this->_error = $event;
		}

		if ( !is_array( $this->history ) ) {
			$this->history = array();
		}

		$this->history[] = array(
							'timestamp'	=> date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 ),
							'class'		=> $class,
							'event'		=> $event,
							'details'	=> $details,
							);

		return true;
	}
}

class Subscription extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $userid				= null;
	/** @var int */
	var $primary			= null;
	/** @var string */
	var $type				= null;
	/** @var string */
	var $status				= null;
	/** @var datetime */
	var $signup_date		= null;
	/** @var datetime */
	var $lastpay_date		= null;
	/** @var datetime */
	var $cancel_date		= null;
	/** @var datetime */
	var $eot_date			= null;
	/** @var string */
	var $eot_cause			= null;
	/** @var int */
	var $plan				= null;
	/** @var string */
	var $recurring			= null;
	/** @var int */
	var $lifetime			= null;
	/** @var datetime */
	var $expiration			= null;
	/** @var text */
	var $params 			= null;
	/** @var text */
	var $customparams		= null;

	/**
	* @param database A database connector object
	*/
	function Subscription( &$db )
	{
		parent::__construct( '#__acctexp_subscr', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'params', 'customparams' );
	}

	function check()
	{
		$vars = get_class_vars( 'Subscription' );
		$props = get_object_vars( $this );

		foreach ( $props as $n => $prop ) {
			if ( !array_key_exists( $n, $vars  ) ) {
				unset( $this->$n );
			}
		}

		return parent::check();
	}

	/**
	 * loads specified user
	 *
	 * @param int $userid
	 */
	function loadUserid( $userid )
	{
		$this->load( $this->getSubscriptionID( $userid ) );
	}

	function getSubscriptionID( $userid, $usage=null, $primary=1, $similar=false, $bias=null )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . $userid . '\''
				;

		if ( !empty( $usage ) ) {
			$plan = new SubscriptionPlan( $database );
			$plan->load( $usage );

			if ( ( !empty( $plan->params['similarplans'] ) && $similar ) || !empty( $plan->params['equalplans'] ) ) {
				$allplans = array( $usage );

				if ( !empty( $plan->params['similarplans'] ) || !empty( $plan->params['equalplans'] ) ) {
					if ( empty( $plan->params['similarplans'] ) ) {
						$plan->params['similarplans'] = array();
					}

					if ( empty( $plan->params['equalplans'] ) ) {
						$plan->params['equalplans'] = array();
					}

					if ( $similar ) {
						$allplans = array_merge( $plan->params['similarplans'], $plan->params['equalplans'], $allplans );
					} else {
						$allplans = array_merge( $plan->params['equalplans'], $allplans );
					}
				}

				foreach ( $allplans as $apid => $pid ) {
					$allplans[$apid] = '`plan` = \'' . $pid . '\'';
				}

				$query .= ' AND (' . implode( ' OR ', $allplans ) . ')';
			} else {
				$query .= ' AND ' . '`plan` = \'' . $usage . '\'';
			}
		}

		if ( !empty( $primary ) ) {
			$query .= ' AND `primary` = \'1\'';
		} elseif ( !is_null( $primary ) ) {
			$query .= ' AND `primary` = \'0\'';
		}

		$database->setQuery( $query );

		if ( !empty( $bias ) ) {
			$subscriptionids = $database->loadResultArray();

			if ( in_array( $bias, $subscriptionids ) ) {
				$subscriptionid = $bias;
			}
		} else {
			$subscriptionid = $database->loadResult();
		}

		if ( empty( $subscriptionid ) && !$similar ) {
			return $this->getSubscriptionID( $userid, $usage, false, true, $bias );
		}

		return $subscriptionid;
	}

	function makePrimary()
	{
		$database = &JFactory::getDBO();

		$query = 'UPDATE #__acctexp_subscr'
				. ' SET `primary` = \'0\''
				. ' WHERE `userid` = \'' . $this->userid . '\''
				;
		$database->setQuery( $query );
		$database->query();

		$this->primary = 1;
		$this->storeload();
	}

	function manualVerify()
	{
		if ( $this->is_expired() ) {
			aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=expired&userid=' . (int) $this->userid ), false, true );
			return false;
		} else {
			return true;
		}
	}

	function createNew( $userid, $processor, $pending, $primary=1, $plan=null )
	{
		global $mainframe;

		$this->userid		= $userid;
		$this->primary		= $primary;
		$this->signup_date	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->expiration	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->status		= $pending ? 'Pending' : 'Active';
		$this->type			= $processor;

		if ( !empty( $plan ) ) {
			$this->plan		= $plan;
		}

		$this->storeload();
	}

	function is_expired( $offset=false )
	{
		$database = &JFactory::getDBO();

		global $mainframe, $aecConfig;

		if ( !$this->is_lifetime() ) {
			$expiration_cushion = str_pad( $aecConfig->cfg['expiration_cushion'], 2, '0', STR_PAD_LEFT );

			if ( $offset ) {
				$expstamp = strtotime( ( '-' . $offset . ' days' ), strtotime( $this->expiration ) );
			} else {
				$expstamp = strtotime( ( '+' . $expiration_cushion . ' hours' ), strtotime( $this->expiration ) );
			}

			if ( ( $expstamp > 0 ) && ( ( $expstamp - ( time() + $mainframe->getCfg( 'offset' ) *3600 ) ) < 0 ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function is_lifetime()
	{
		if ( ( $this->expiration === '9999-12-31 00:00:00' ) || ( $this->expiration === '0000-00-00 00:00:00' ) ) {
			return true;
		} else {
			return false;
		}
	}

	function setExpiration( $unit, $value, $extend )
	{
		global $mainframe;

		$now = time() + $mainframe->getCfg( 'offset' ) *3600;

		if ( $extend ) {
			$current = strtotime( $this->expiration );

			if ( $current < $now ) {
				$current = $now;
			}
		} else {
			$current = $now;
		}

		$this->expiration = AECToolbox::computeExpiration( $value, $unit, $current );
	}


	/**
	* Get alert level for a subscription
	* @param int user id
	* @return Object alert
	* alert['level'] = -1 means no threshold has been reached
	* alert['level'] =  0 means subscription expired
	* alert['level'] =  1 means most critical threshold has been reached (default: 7 days or less to expire)
	* alert['level'] =  2 means second level threshold has been reached (default: 14 days or less to expire)
	* alert['daysleft'] = number of days left to expire
	*/
	function GetAlertLevel()
	{
		$database = &JFactory::getDBO();

		global $mainframe, $aecConfig;

		if ( $this->expiration ) {
			$alert['level']		= -1;
			$alert['daysleft']	= 0;

			$expstamp = strtotime( $this->expiration );

			// Get how many days left to expire (3600 sec = 1 hour)
			$alert['daysleft']	= round( ( $expstamp - ( time() + $mainframe->getCfg( 'offset' ) *3600 ) ) / ( 3600 * 24 ) );

			if ( $alert['daysleft'] < 0 ) {
				// Subscription already expired. Alert Level 0!
				$alert['level']	= 1;
			} else {
				// Get alert levels
				if ( $alert['daysleft'] <= $aecConfig->cfg['alertlevel1'] ) {
					// Less than $numberofdays to expire! This is a level 1
					$alert['level']		= 1;
				} elseif ( ( $alert['daysleft'] > $aecConfig->cfg['alertlevel1'] ) && ( $alert['daysleft'] <= $aecConfig->cfg['alertlevel2'] ) ) {
					$alert['level']		= 2;
				} elseif ( $alert['daysleft'] > $aecConfig->cfg['alertlevel2'] ) {
					// Everything is ok. Level 3 means no threshold was reached
					$alert['level']		= 3;
				}
			}
		}
		return $alert;
	}

	function verifylogin( $block, $metaUser=false )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( strcmp( $this->status, 'Excluded' ) === 0 ) {
			$expired = false;
		} elseif ( strcmp( $this->status, 'Expired' ) === 0 ) {
			$expired = true;
		} else {
			$expired = $this->is_expired();
		}

		if ( $expired ) {
			$pp = new PaymentProcessor();

			if ( $pp->loadName( $subscription->type ) ) {
				$validation = $pp->validateSubscription();
			} else {
				$validation = false;
			}
		}

		if ( ( $expired || ( strcmp( $this->status, 'Closed' ) === 0 ) ) && $aecConfig->cfg['require_subscription'] ) {
			if ( $metaUser !== false ) {
				$metaUser->setTempAuth();
			}

			if ( strcmp( $this->status, 'Expired' ) === 0 ) {
				aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=expired&userid=' . $this->userid ), false, true );
			} else {
				if ( $this->expire() ) {
					aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=expired&userid=' . $this->userid ), false, true );
				}
			}
		} elseif ( ( strcmp( $this->status, 'Pending' ) === 0 ) || $block ) {
			if ( $metaUser !== false ) {
				$metaUser->setTempAuth();
			}
			aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=pending&userid=' . $this->userid ), false, true );
		} elseif ( ( strcmp( $this->status, 'Hold' ) === 0 ) || $block ) {
			aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=hold&userid=' . $this->userid ), false, true );
		}
	}

	function verify( $block, $metaUser=false )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( strcmp( $this->status, 'Excluded' ) === 0 ) {
			$expired = false;
		} elseif ( strcmp( $this->status, 'Expired' ) === 0 ) {
			$expired = true;
		} else {
			$expired = $this->is_expired();
		}

		if ( $expired ) {
			$pp = new PaymentProcessor();

			if ( $pp->loadName( $this->type ) ) {
				$expired = !$pp->validateSubscription( $this );
			}
		}

		if ( ( $expired || ( strcmp( $this->status, 'Closed' ) === 0 ) ) && $aecConfig->cfg['require_subscription'] ) {
			if ( $metaUser !== false ) {
				$metaUser->setTempAuth();
			}

			if ( strcmp( $this->status, 'Expired' ) === 0 ) {
				return 'expired';
			} else {
				if ( $this->expire() ) {
					return 'expired';
				}
			}
		} elseif ( ( strcmp( $this->status, 'Pending' ) === 0 ) || $block ) {
			return 'pending';
		} elseif ( ( strcmp( $this->status, 'Hold' ) === 0 ) || $block ) {
			return 'hold';
		}

		return true;
	}

	function expire( $overridefallback=false )
	{
		$database = &JFactory::getDBO();

		// Users who are excluded cannot expire
		if ( strcmp( $this->status, 'Excluded' ) === 0 ) {
			return false;
		}

		// Load plan variables, otherwise load dummies
		if ( $this->plan ) {
			$subscription_plan = new SubscriptionPlan( $database );
			$subscription_plan->load( $this->plan );
		} else {
			$subscription_plan = false;
		}

		// Move the focus Subscription
		$metaUser = new metaUser( $this->userid );
		$metaUser->moveFocus( $this->id );

		// Recognize the fallback plan, if not overridden
		if ( !empty( $subscription_plan->params['fallback'] ) && !$overridefallback ) {
			if ( $subscription_plan !== false ) {
				$mih = new microIntegrationHandler();
				$mih->userPlanExpireActions( $metaUser, $subscription_plan );
			}

			$this->applyUsage( $subscription_plan->params['fallback'], 'none', 1 );
			$this->load( $this->id );
			return false;
		} else {
			// Set a Trial flag if this is an expired Trial for further reference
			if ( strcmp( $this->status, 'Trial' ) === 0 ) {
				$this->addParams( array( 'trialflag' => 1 ) );
			} elseif ( is_array( $this->params ) ) {
				if ( in_array( 'trialflag', $this->params ) ) {
					$this->delParams( array( 'trialflag' ) );
				}
			}

			// Call Expiration MIs
			if ( $subscription_plan !== false ) {
				$mih = new microIntegrationHandler();
				$mih->userPlanExpireActions( $metaUser, $subscription_plan );
			}

			if ( !( strcmp( $this->status, 'Expired' ) === 0 ) || !( strcmp( $this->status, 'Closed' ) === 0 ) ) {
				$this->status = 'Expired';
				$this->storeload();
			} else {
				return false;
			}

			return true;
		}
	}

	function cancel( $invoice=null )
	{
		$database = &JFactory::getDBO();

		// Since some processors do not notify each period, we need to check whether the expiration
		// lies too far in the future and cut it down to the end of the period the user has paid

		if ( $this->plan ) {
			global $mainframe;

			$subscription_plan = new SubscriptionPlan( $database );
			$subscription_plan->load( $this->plan );

			// Resolve blocks that we are going to substract from the set expiration date
			$unit = 60*60*24;
			switch ( $subscription_plan->params['full_periodunit'] ) {
				case 'W':
					$unit *= 7;
					break;
				case 'M':
					$unit *= 31;
					break;
				case 'Y':
					$unit *= 365;
					break;
			}

			$periodlength = $subscription_plan->params['full_period'] * $unit;

			$newexpiration = strtotime( $this->expiration );
			$now = time() + $mainframe->getCfg( 'offset' ) *3600;

			// ...cut away blocks until we are in the past
			while ( $newexpiration > $now ) {
				$newexpiration -= $periodlength;
			}

			// Be extra sure that we did not overachieve
			if ( $newexpiration < $now ) {
				$newexpiration += $periodlength;
			}

			// And we get the bare expiration date
			$this->expiration = date( 'Y-m-d H:i:s', $newexpiration );
		}

		$this->setStatus( 'Cancelled' );

		return true;
	}

	function hold( $invoice=null )
	{
		$this->setStatus( 'Hold' );
		return true;
	}

	function hold_settle( $invoice=null )
	{
		$this->setStatus( 'Active' );
		return true;
	}

	function setStatus( $status )
	{
		$this->status = $status;
		$this->storeload();
	}

	function applyUsage( $usage = 0, $processor = 'none', $silent = 0, $multiplicator = 1, $invoice=null )
	{
		$database = &JFactory::getDBO();

		if ( !$usage ) {
			$usage = $this->plan;
		}

		$new_plan = new SubscriptionPlan( $database );
		$new_plan->load( $usage );

		if ( $new_plan->id ) {
			return $new_plan->applyPlan( $this, $processor, $silent, $multiplicator, $invoice );
		} else {
			return false;
		}
	}

	function sendEmailRegistered( $renew, $adminonly=false )
	{
		$database = &JFactory::getDBO();

		$acl = &JFactory::getACL();

		global $mainframe;

		$langPath = JPATH_SITE . '/components/com_acctexp/lang/';
		if ( file_exists( $langPath . $GLOBALS['mosConfig_lang'] . '.php' ) ) {
			include_once( $langPath . $GLOBALS['mosConfig_lang'] . '.php' );
		} else {
			include_once( $langPath . 'english.php' );
		}

		$free = ( strcmp( strtolower( $this->type ), 'none' ) == 0 || strcmp( strtolower( $this->type ), 'free' ) == 0 );

		$urow = new JTableUser( $database );
		$urow->load( $this->userid );

		$plan = new SubscriptionPlan( $database );
		$plan->load( $this->plan );

		$name			= $urow->name;
		$email			= $urow->email;
		$username		= $urow->username;
		$pwd			= $urow->password;
		$activationcode	= $urow->activation;

		$message = sprintf( _ACCTEXP_MAILPARTICLE_GREETING, $name );

		// Assemble E-Mail Subject & Message
		if ( $renew ) {
			$subject = sprintf( _ACCTEXP_SEND_MSG_RENEW, $name, $mainframe->getCfg( 'sitename' ) );

			$message .= sprintf( _ACCTEXP_MAILPARTICLE_THANKSREN, $mainframe->getCfg( 'sitename' ) );

			if ( $plan->email_desc ) {
				$message .= "\n\n" . $plan->email_desc . "\n\n";
			} else {
				$message .= " ";
			}

			if ( $free ) {
				$message .= sprintf( _ACCTEXP_MAILPARTICLE_LOGIN, JURI::root() );
			} else {
				$message .= _ACCTEXP_MAILPARTICLE_PAYREC . " "
				. sprintf( _ACCTEXP_MAILPARTICLE_LOGIN, JURI::root() );
			}
		} else {
			$subject = sprintf( _ACCTEXP_SEND_MSG, $name, $mainframe->getCfg( 'sitename' ) );

			$message .= sprintf(_ACCTEXP_MAILPARTICLE_THANKSREG, $mainframe->getCfg( 'sitename' ) );

			if ( $plan->email_desc ) {
				$message .= "\n\n" . $plan->email_desc . "\n\n";
			} else {
				$message .= " ";
			}

			if ( $free ) {
				$message .= sprintf( _ACCTEXP_MAILPARTICLE_LOGIN, JURI::root() );
			} else {
				$message .= _ACCTEXP_MAILPARTICLE_PAYREC . " "
				. sprintf( _ACCTEXP_MAILPARTICLE_LOGIN, JURI::root() );
			}
		}

		$message .= _ACCTEXP_MAILPARTICLE_FOOTER;

		$subject = html_entity_decode( $subject, ENT_QUOTES );
		$message = html_entity_decode( $message, ENT_QUOTES );

		// Send email to user
		if ( $mainframe->getCfg( 'mailfrom' ) != '' && $mainframe->getCfg( 'fromname' ) != '' ) {
			$adminName2		= $mainframe->getCfg( 'fromname' );
			$adminEmail2	= $mainframe->getCfg( 'mailfrom' );
		} else {
			$query = 'SELECT `name`, `email`'
					. ' FROM #__users'
					. ' WHERE `usertype` = \'superadministrator\''
					;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			$row2 = $rows[0];

			$adminName2		= $row2->name;
			$adminEmail2	= $row2->email;
		}

		if ( !$adminonly ) {
			if ( aecJoomla15check() ) {
				JUTility::sendMail( $adminEmail2, $adminEmail2, $email, $subject, $message );
			} else {
				mosMail( $adminEmail2, $adminName2, $email, $subject, $message );
			}
		}

		// Send notification to all administrators
		$aecUser = AECToolbox::aecIP();

		if ( $renew ) {
			$subject2 = sprintf( _ACCTEXP_SEND_MSG_RENEW, $name, $mainframe->getCfg( 'sitename' ) );
			$message2 = sprintf( _ACCTEXP_ASEND_MSG_RENEW, $adminName2, $mainframe->getCfg( 'sitename' ), $name, $email, $username, $plan->id, $plan->name, $aecUser['ip'], $aecUser['isp'] );
		} else {
			$subject2 = sprintf( _ACCTEXP_SEND_MSG, $name, $mainframe->getCfg( 'sitename' ) );
			$message2 = sprintf( _ACCTEXP_ASEND_MSG, $adminName2, $mainframe->getCfg( 'sitename' ), $name, $email, $username, $plan->id, $plan->name, $aecUser['ip'], $aecUser['isp'] );
		}

		$subject2 = html_entity_decode( $subject2, ENT_QUOTES );
		$message2 = html_entity_decode( $message2, ENT_QUOTES );

		// get superadministrators id
		$admins = $acl->get_group_objects( 25, 'ARO' );

		foreach ( $admins['users'] as $id ) {
			$query = 'SELECT `email`, `sendEmail`'
					. ' FROM #__users'
					. ' WHERE `id` = \'' . $id . '\''
					;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();

			$row = $rows[0];

			if ( $row->sendEmail ) {
				if ( aecJoomla15check() ) {
					JUTility::sendMail( $adminEmail2, $adminEmail2, $row->email, $subject2, $message2 );
				} else {
					mosMail( $adminEmail2, $adminName2, $row->email, $subject2, $message2 );
				}
			}
		}
	}

	function getMIflags( $usage, $mi )
	{
		// Create the Params Prefix
		$flag_name = 'MI_FLAG_USAGE_' . strtoupper( $usage ) . '_MI_' . strtoupper( $mi );

		// Filter out the params for this usage and MI
		$mi_params = array();
		if ( $this->params ) {
			foreach ( $this->params as $name => $value ) {
				if ( strpos( $name, $flag_name ) == 0 ) {
					$paramname = substr( strtoupper( $name ), strlen( $flag_name ) + 1 );
					$mi_params[$paramname] = $value;
				}
			}
		}

		// Only return params if they exist
		if ( count( $mi_params ) ) {
			return $mi_params;
		} else {
			return false;
		}
	}

	function setMIflags( $usage, $mi, $flags )
	{
		// Create the Params Prefix
		$flag_name = 'MI_FLAG_USAGE_' . strtoupper( $usage ) . '_MI_' . $mi;

		// Write to $params array
		foreach ( $flags as $name => $value ) {
			$param_name = $flag_name . '_' . strtoupper( $name );
			$this->params[$param_name] = $value;
		}

		$this->storeload();
	}
}

class GeneralInfoRequester
{
	/**
	 * Check which CMS system is running
	 * @return string
	 */
	function getCMSName()
	{
		$filename	= JPATH_SITE . '/includes/version.php';

		if ( file_exists( $filename ) ) {
			$originalFileHandle = fopen( $filename, 'r' ) or die ( "Cannot open $filename<br />" );
			// Transfer File into variable
			$Data = fread( $originalFileHandle, filesize( $filename ) );
			fclose( $originalFileHandle );

			if ( strpos( $Data, '@package Joomla' ) ) {
				return 'Joomla';
			} elseif ( strpos( $Data, '@package Mambo' ) ) {
				return 'Mambo';
			} else {
				return 'UNKNOWN';
			}
		} elseif (  aecJoomla15check() ) {
			return 'Joomla15';
		}
	}

	/**
	 * Check whether a component is installed
	 * @return Bool
	 */
	function detect_component( $component )
	{
		$database = &JFactory::getDBO();

		global $mainframe, $aecConfig;

		$tables	= array();
		$tables	= $database->getTableList();

		if ( !empty( $aecConfig->cfg['bypassintegration'] ) ) {
			$bypass = str_replace( ',', ' ', $aecConfig->cfg['bypassintegration'] );

			$overrides = explode( ' ', $bypass );

			foreach ( $overrides as $i => $c ) {
				$overrides[$i] = trim($c);
			}

			if ( in_array( 'CB', $overrides ) ) {
				$overrides[] = 'CB1.2';
			}

			if ( in_array( 'CB', $overrides ) || in_array( 'CB1.2', $overrides ) || in_array( 'CBE', $overrides ) ) {
				$overrides[] = 'anyCB';
			}

			if ( in_array( $component, $overrides ) ) {
				return false;
			}
		}

		$pathCB		= JPATH_SITE . '/components/com_comprofiler';
		$pathSMF	= JPATH_SITE . '/administrator/components/com_smf';
		switch ( $component ) {
			case 'anyCB': // any Community Builder
				return is_dir( $pathCB );
				break;
			case 'CB1.2': // Community Builder 1.2
				$is_cbe	= ( is_dir( $pathCB. '/enhanced' ) || is_dir( $pathCB . '/enhanced_admin' ) );
				$is_cb	= ( is_dir( $pathCB ) && !$is_cbe );

				$is12 = file_exists( $pathCB . '/js/cb12.js' );

				return ( $is_cb && $is12 );
				break;

			case 'CB': // Community Builder
				$is_cbe	= ( is_dir( $pathCB. '/enhanced' ) || is_dir( $pathCB . '/enhanced_admin' ) );
				$is_cb	= ( is_dir( $pathCB ) && !$is_cbe );
				return $is_cb;
				break;

			case 'CBE': // Community Builder Enhanced
				$is_cbe = ( is_dir( $pathCB . '/enhanced' ) || is_dir( $pathCB . '/enhanced_admin' ) );
				return $is_cbe;
				break;

			case 'CBM': // Community Builder Moderator for Workflows
				return file_exists( JPATH_SITE . '/modules/mod_comprofilermoderator.php' );
				break;

			case 'UE': // User Extended
				return in_array( $mainframe->getCfg( 'dbprefix' ) . 'user_extended', $tables );
				break;

			case 'SMF': // Simple Machines Forum
				return file_exists( $pathSMF . '/config.smf.php') || file_exists( $pathSMF . '/smf.php' );
				break;

			case 'VM': // VirtueMart
				return in_array( $mainframe->getCfg( 'dbprefix' ) . 'vm_orders', $tables );
				break;

			case 'JACL': // JACL
				return in_array( $mainframe->getCfg( 'dbprefix' ) . 'jaclplus', $tables );
				break;

			case 'UHP2':
				return file_exists( JPATH_SITE . '/modules/mod_uhp2_manage.php' );
				break;

			case 'JUSER':
				return file_exists( JPATH_SITE . '/components/com_juser/juser.php' );
				break;

			case 'JOMSOCIAL':
				return file_exists( JPATH_SITE . '/components/com_community/community.php' );
				break;
		}
	}

	/**
	 * Return the list of group id with lower priviledge
	 * @parameter group id
	 * @return string
	 */
	function getLowerACLGroup( $group_id )
	{
		$database = &JFactory::getDBO();

		$group_list	= array();
		$groups		= '';

		$query = 'SELECT g2.' . ( aecJoomla15check() ? 'id' : 'group_id' )  . ''
				. ' FROM #__core_acl_aro_groups AS g1'
				. ' INNER JOIN #__core_acl_aro_groups AS g2 ON g1.lft >= g2.lft AND g1.lft <= g2.rgt'
				. ' WHERE g1.' . ( aecJoomla15check() ? 'id' : 'group_id' )  . ' = ' . $group_id
				. ' GROUP BY g2.' . ( aecJoomla15check() ? 'id' : 'group_id' )  . ''
				. ' ORDER BY g2.lft'
				;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		for( $i = 0, $n = count( $rows ); $i < $n; $i++ ) {
			$row = &$rows[$i];
			if ( aecJoomla15check() ) {
				$group_list[$i] = $row->id;
			} else {
				$group_list[$i] = $row->group_id;
			}
		}

		if ( count( $group_list ) > 0 ) {
			return $group_list;
		} else {
			return array();
		}
	}
}

class AECfetchfromDB
{
	function UserIDfromInvoiceNumber( $invoice_number )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `userid`'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `invoice_number` = \'' . $invoice_number . '\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function InvoiceIDfromNumber( $invoice_number, $userid = 0, $override_active = false )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_invoices'
				;

		if ( $override_active ) {
			$query .= ' WHERE';
		} else {
			$query .= ' WHERE `active` = \'1\' AND';
		}

		$query .= ' ( `invoice_number` LIKE \'' . $invoice_number . '\''
				. ' OR `secondary_ident` LIKE \'' . $invoice_number . '\' )'
				;

		if ( $userid ) {
			$query .= ' AND `userid` = \'' . $userid . '\'';
		}

		$database->setQuery( $query );
		return $database->loadResult();
	}

	function InvoiceNumberfromId( $id, $override_active = false )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `invoice_number`'
				. ' FROM #__acctexp_invoices'
				;

		if ( $override_active ) {
			$query .= ' WHERE';
		} else {
			$query .= ' WHERE `active` = \'1\' AND';
		}

		$query .= ' `id` = \'' . $id . '\'';

		$database->setQuery( $query );
		return $database->loadResult();
	}

	function lastUnclearedInvoiceIDbyUserID( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `invoice_number`'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `userid` = \'' . (int) $userid . '\''
				. ' AND `transaction_date` = \'0000-00-00 00:00:00\''
				. ' AND `active` = \'1\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function lastClearedInvoiceIDbyUserID( $userid, $planid=0 )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `userid` = \'' . (int) $userid . '\''
				;

		if ( $planid ) {
			$query .= ' AND `usage` = \'' . (int) $planid . '\'';
		}

		$query .= ' ORDER BY `transaction_date` DESC';

		$database->setQuery( $query );
		return $database->loadResult();
	}

	function InvoiceCountbyUserID( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT count(*)'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `userid` = \'' . (int) $userid . '\''
				. ' AND `active` = \'1\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function InvoiceIdList( $userid, $total, $max=20, $sort='`transaction_date` DESC' )
	{
		$database = &JFactory::getDBO();

		$min_limit	= ( $total > $max ) ? ( $total - $max ) : 0;

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_invoices'
				. ' WHERE `userid` = \'' . $userid . '\''
				. ' AND `active` = \'1\''
				. ' ORDER BY ' . $sort
				. ' LIMIT ' . $min_limit . ',' . $max
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function SubscriptionIDfromUserID( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $userid . '\''
				. ' ORDER BY `primary` DESC'
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function UserIDfromSubscriptionID( $susbcriptionid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `userid`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `id` = \'' . (int) $susbcriptionid . '\''
				. ' ORDER BY `primary` DESC'
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

}

class aecSuperCommand
{
	function aecSuperCommand()
	{

	}

	function parseString( $string )
	{
		$particles = explode( '|', str_replace( 'supercommand:', '', str_replace( '!supercommand:', '', $string ) ) );

		if ( count( $particles ) == 3 ) {
			$this->focus = $particles[0];

			$this->audience = $this->getParticle( $particles[1] );
			$this->action = $this->getParticle( $particles[2] );

			return true;
		} elseif ( count( $particles ) == 2 ) {
			$this->focus = 'users';

			$this->audience = $this->getParticle( $particles[0] );
			$this->action = $this->getParticle( $particles[1] );

			return true;
		} else {
			return false;
		}
	}

	function getParticle( $data )
	{
		$d = explode( ':', $data, 2 );

		$return = array();
		$return['command'] = $d[0];

		if ( !empty( $d[1] ) ) {
			$return['parameters'] = explode( ':', $d[1] );
		}

		return $return;
	}

	function query( $armed )
	{
		$userlist = $this->getAudience();

		$users = count( $userlist );

		if ( $armed && $users ) {
			$x = 0;
			foreach( $userlist as $userid ) {
				if ( ( $this->focus == 'users' ) ) {
					$metaUser = new metaUser( $userid );
				} else {
					$metaUser = new metaUser( null, $userid );
				}

				$r = $this->action( $metaUser );

				if ( $r === false ) {
					return $x;
				}

				$x++;
			}
		}

		return $users;
	}

	function getAudience()
	{
		switch ( $this->audience['command'] ) {
			case 'all':
			case 'everybody':
				$database = &JFactory::getDBO();

				$query = 'SELECT `id`'
						. ' FROM #__users'
						;
				$database->setQuery( $query );
				$userlist = $database->loadResultArray();
				break;
			case 'orphans':
				/*$this->focus == 'subscriptions';

				$database = &JFactory::getDBO();

				$query = 'SELECT id'
						. ' FROM #__acctexp_subscr AS subs'
						. ' WHERE subs.userid NOT IN ('
						. ' SELECT juser.id'
						. ' FROM #__users AS juser)'
						;
				$query = 'SELECT `id`'
						. ' FROM #__users'
						. ' WHERE `userid` IN (' . $params[1] . ')'
						;
				$database->setQuery( $query );*/
				return $database->loadResultArray();
				break;
			case 'subscribers':
				$database = &JFactory::getDBO();

				$query = 'SELECT ' . ( $this->focus == 'users' ) ? 'DISTINCT `userid`' : '`id`';

				$query .= ' FROM #__acctexp_subscr';

				if ( !empty( $this->audience['parameters'][0] ) ) {
					$status = explode( ',', $this->audience['parameters'][0] );

					$stats = array();
					foreach ( $status as $stat ) {
						$stats[] = 'LOWER( `status` ) = \'' . strtolower( $stat ) . '\'';
					}

					$query .= ' WHERE ' . implode( ' AND ', $stats);
				} else {
					$query .= ' WHERE `status` != \'Expired\''
							. ' AND `status` != \'Closed\''
							. ' AND `status` != \'Hold\''
							;
				}

				$database->setQuery( $query );
				return $database->loadResultArray();
			default:
				$cmd = 'cmd' . ucfirst( strtolower( $this->audience['command'] ) );

				if ( method_exists( $this, $cmd ) ) {
					$userlist = $this->$cmd( $this->audience['parameters'] );
				} else {
					return false;
				}
		}

		return $userlist;
	}

	function action( $metaUser )
	{
		switch ( $this->action['command'] ) {
			case 'expire':
				$metaUser->focusSubscription->expire();
				break;
			case 'forget':
				if ( $this->focus == 'users' ) {
					$metaUser->cmsUser->delete();
				} else {
					$metaUser->focusSubscription->delete();
				}
				break;
			case 'forget_it_all':
				$metaUser->delete();
				break;
			case 'amnesia':
				$metaUser->meta->delete();
				break;
			default:
				$cmd = 'cmd' . ucfirst( strtolower( $this->action['command'] ) );

				if ( method_exists( $this, $cmd ) ) {
					$userlist = $this->$cmd( $metaUser, $this->action['parameters'] );
				} else {
					return false;
				}
		}
	}

	function cmdHas( $params )
	{
		switch ( strtolower( $params[0] ) ) {
			case 'subscriptionid':
				return explode( ',', $params[1] );
				break;
			case 'userid':
				$database = &JFactory::getDBO();

				$query = 'SELECT `id`'
						. ' FROM #__users'
						. ' WHERE `userid` IN (' . $params[1] . ')'
						;
				$database->setQuery( $query );
				return $database->loadResultArray();
				break;
			case 'username':
				$database = &JFactory::getDBO();

				$query = 'SELECT `id`'
						. ' FROM #__users'
						. ' WHERE LOWER( `username` ) LIKE \'%' . $params[1] . '%\''
						;
				$database->setQuery( $query );
				$ids = $database->loadResultArray();

				$p = array();
				$p[0] = 'userid';
				$p[1] = implode( ',', $ids );

				return $this->cmdHas( $p );
				break;
			case 'plan':
				$database = &JFactory::getDBO();

				$query = 'SELECT ' . ( ( $this->focus == 'users' ) ? 'DISTINCT `userid`' : '`id`' )
						. ' FROM #__acctexp_subscr'
						. ' WHERE `plan` IN (' . $params[1] . ')'
						. ' AND `status` != \'Expired\''
						. ' AND `status` != \'Closed\''
						. ' AND `status` != \'Hold\''
						;
				$database->setQuery( $query );
				return $database->loadResultArray();
				break;
			case 'mi':
				$database = &JFactory::getDBO();

				$mis = explode( ',', $params[1] );

				$plans = array();
				foreach ( $plans as $plan ) {
					$plans = array_merge( $plans, microIntegrationHandler::getPlansbyMI( $params[1] ) );
				}

				array_unique( $plans );

				$p = array();
				$p[0] = 'plan';
				$p[1] = implode( ',', $plans );

				return $this->cmdHas( $p );
				break;
		}
	}

	function cmdApply( $metaUser, $params )
	{
		$database = &JFactory::getDBO();

		switch ( strtolower( $params[0] ) ) {
			case 'plan':
				$plans = explode( ',', $params[1] );

				foreach ( $plans as $planid ) {
					$plan = new SubscriptionPlan( $database );
					$plan->load( $planid );

					$metaUser->establishFocus( $plan );

					$metaUser->focusSubscription->applyUsage( $planid, 'none', 1 );
				}
				break;
			case 'mi':
				$micro_integrations = explode( ',', $params[1] );

				if ( is_array( $micro_integrations ) ) {
					foreach ( $micro_integrations as $mi_id ) {
						$mi = new microIntegration( $database );

						if ( !$mi->mi_exists( $mi_id ) ) {
							continue;
						}

						$mi->load( $mi_id );

						if ( !$mi->callIntegration() ) {
							continue;
						}

						if ( isset( $params[2] ) ) {
							$action = $params[2];
						} else {
							$action = 'action';
						}

						$invoice = $exchange = $add = null;

						if ( $mi->relayAction( $metaUser, $exchange, $invoice, null, $action, $add ) === false ) {
							if ( $aecConfig->cfg['breakon_mi_error'] ) {
								return false;
							}
						}

						unset( $mi );
					}
				}
				break;
		}
	}
}

class reWriteEngine
{
	function reWriteEngine()
	{

	}

	function isRWEstring( $string )
	{
		if ( ( strpos( $string, '[[' ) !== false ) && ( strpos( $string, ']]' ) !== false ) ) {
			return true;
		}

		if ( ( strpos( $string, '{aecjson}' ) !== false ) && ( strpos( $string, '{/aecjson}' ) !== false ) ) {
			return true;
		}

		return false;
	}

	function info( $switches=array(), $params=null )
	{
		if ( is_array( $switches ) ) {
			if ( !count( $switches ) ) {
				$switches = array( 'cms', 'user', 'subscription', 'invoice', 'plan', 'system' );
			}
		} else {
			if ( empty( $switches ) ) {
				$switches = array( 'cms', 'user', 'subscription', 'invoice', 'plan', 'system' );
			} else {
				$temp = $switches;
				$switches = array( $temp );
			}
		}

		$rewrite = array();

		if ( in_array( 'system', $switches ) ) {
			$rewrite['system'][] = 'timestamp';
			$rewrite['system'][] = 'timestamp_backend';
			$rewrite['system'][] = 'server_timestamp';
			$rewrite['system'][] = 'server_timestamp_backend';
		}

		if ( in_array( 'cms', $switches ) ) {
			$rewrite['cms'][] = 'absolute_path';
			$rewrite['cms'][] = 'live_site';
		}

		if ( in_array( 'user', $switches ) ) {
			$rewrite['user'][] = 'id';
			$rewrite['user'][] = 'username';
			$rewrite['user'][] = 'name';
			$rewrite['user'][] = 'first_name';
			$rewrite['user'][] = 'first_first_name';
			$rewrite['user'][] = 'last_name';
			$rewrite['user'][] = 'email';
			$rewrite['user'][] = 'activationcode';
			$rewrite['user'][] = 'activationlink';

			if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
				$database = &JFactory::getDBO();

				$query = 'SELECT name, title'
						. ' FROM #__comprofiler_fields'
						. ' WHERE `table` != \'#__users\''
						. ' AND name != \'NA\'';
				$database->setQuery( $query );
				$objects = $database->loadObjectList();

				if ( is_array( $objects ) ) {
					foreach ( $objects as $object ) {
						$rewrite['user'][] = $object->name;

						if ( strpos( $object->title, '_' ) === 0 ) {
							$content = $object->name;
						} else {
							$content = $object->title;
						}

						$name = '_REWRITE_KEY_USER_' . strtoupper( $object->name );
						if ( !defined( $name ) ) {
							define( $name, $content );
						}
					}
				}
			}

			if ( GeneralInfoRequester::detect_component( 'JOMSOCIAL' ) ) {
				$database = &JFactory::getDBO();

				$query = 'SELECT `id`, `name`'
						. ' FROM #__community_fields'
						. ' WHERE `type` != \'group\''
						;
				$database->setQuery( $query );
				$fields = $database->loadObjectList();

				if ( is_array( $fields ) ) {
					foreach ( $fields as $field ) {
						$rewrite['user'][] = 'js_' . $field->id;

						$content = $field->name;

						$name = '_REWRITE_KEY_USER_JS_' . $field->id;
						if ( !defined( $name ) ) {
							define( $name, $content );
						}
					}
				}
			}
		}

		if ( in_array( 'subscription', $switches ) ) {
			$rewrite['subscription'][] = 'type';
			$rewrite['subscription'][] = 'status';
			$rewrite['subscription'][] = 'signup_date';
			$rewrite['subscription'][] = 'lastpay_date';
			$rewrite['subscription'][] = 'plan';
			$rewrite['subscription'][] = 'previous_plan';
			$rewrite['subscription'][] = 'recurring';
			$rewrite['subscription'][] = 'lifetime';
			$rewrite['subscription'][] = 'expiration_date';
			$rewrite['subscription'][] = 'expiration_date_backend';
		}

		if ( in_array( 'invoice', $switches ) ) {
			$rewrite['invoice'][] = 'id';
			$rewrite['invoice'][] = 'number';
			$rewrite['invoice'][] = 'number_format';
			$rewrite['invoice'][] = 'created_date';
			$rewrite['invoice'][] = 'transaction_date';
			$rewrite['invoice'][] = 'method';
			$rewrite['invoice'][] = 'amount';
			$rewrite['invoice'][] = 'currency';
			$rewrite['invoice'][] = 'coupons';
		}

		if ( in_array( 'plan', $switches ) ) {
			$rewrite['plan'][] = 'name';
			$rewrite['plan'][] = 'desc';
		}

		if ( !empty( $params ) ) {
			$params[] = array( 'accordion_start', 'small_accordion' );

			$params[] = array( 'accordion_itemstart', constant( '_REWRITE_ENGINE_TITLE' ) );
			$list = '<div class="rewriteinfoblock">' . "\n"
			. '<p>' . constant( '_REWRITE_ENGINE_DESC' ) . '</p>' . "\n"
			. '</div>' . "\n";
			$params[] = array( 'literal', $list );
			$params[] = array( 'div_end', '' );

			foreach ( $rewrite as $area => $keys ) {
				$params[] = array( 'accordion_itemstart', constant( '_REWRITE_AREA_' . strtoupper( $area ) ) );

				$list = '<div class="rewriteinfoblock">' . "\n"
				. '<ul>' . "\n";

				foreach ( $keys as $key ) {
					$list .= '<li>[[' . $area . "_" . $key . ']] =&gt; ' . constant( '_REWRITE_KEY_' . strtoupper( $area . "_" . $key ) ) . '</li>' . "\n";
				}
				$list .= '</ul>' . "\n"
				. '</div>' . "\n";

				$params[] = array( 'literal', $list );
				$params[] = array( 'div_end', '' );
			}

			$params[] = array( 'accordion_itemstart', constant( '_REWRITE_ENGINE_AECJSON_TITLE' ) );
			$list = '<div class="rewriteinfoblock">' . "\n"
			. '<p>' . constant( '_REWRITE_ENGINE_AECJSON_DESC' ) . '</p>' . "\n"
			. '</div>' . "\n";
			$params[] = array( 'literal', $list );
			$params[] = array( 'div_end', '' );

			$params[] = array( 'div_end', '' );

			return $params;
		} else {
			$return = '';
			foreach ( $rewrite as $area => $keys ) {
				$return .= '<div class="rewriteinfoblock">' . "\n"
				. '<p><strong>' . constant( '_REWRITE_AREA_' . strtoupper( $area ) ) . '</strong></p>' . "\n"
				. '<ul>' . "\n";

				foreach ( $keys as $key ) {
					$return .= '<li>[[' . $area . "_" . $key . ']] =&gt; ' . constant( '_REWRITE_KEY_' . strtoupper( $area . "_" . $key ) ) . '</li>' . "\n";
				}
				$return .= '</ul>' . "\n"
				. '</div>' . "\n";
			}

			$return .= '<div class="rewriteinfoblock">' . "\n"
			. '<p><strong>' . constant( '_REWRITE_ENGINE_AECJSON_TITLE' ) . '</strong></p>' . "\n"
			. '<p>' . constant( '_REWRITE_ENGINE_AECJSON_DESC' ) . '</p>' . "\n"
			. '</div>' . "\n";

			return $return;
		}
	}

	function resolveRequest( $request )
	{
		$rqitems = get_object_vars( $request );

		$data = array();
		foreach ( $rqitems as $rqitem => $content ) {
			$data[$rqitem] = $request->$rqitem;
		}

		$this->feedData( $data );

		return true;
	}

	function feedData( $data )
	{
		if ( !isset( $this->data ) ) {
			$this->data = array();
		}

		foreach ( $data as $name => $content ) {
			$this->data[$name] = $content;
		}

		return true;
	}

	function armRewrite()
	{
		$database = &JFactory::getDBO();

		global $aecConfig, $mainframe;

		$this->rewrite = array();

		$this->rewrite['system_timestamp']			= strftime( $aecConfig->cfg['display_date_frontend'],  time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->rewrite['system_timestamp_backend']	= strftime( $aecConfig->cfg['display_date_backend'], time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->rewrite['system_serverstamp_time']	= strftime( $aecConfig->cfg['display_date_frontend'], time() );
		$this->rewrite['system_server_timestamp_backend']	= strftime( $aecConfig->cfg['display_date_backend'], time() );

		$this->rewrite['cms_absolute_path']	= JPATH_SITE;
		$this->rewrite['cms_live_site']		= JURI::root();

		if ( empty( $this->data['invoice'] ) ) {
			$this->data['invoice'] = null;
		}

		if ( !empty( $this->data['metaUser'] ) ) {
			if ( is_object( $this->data['metaUser'] ) ) {
				$name = array();
				$name['first_first']	= "";
				$name['first']			= "";
				$name['last']			= "";

				// Explode Name
				if ( isset( $this->data['metaUser']->cmsUser->name ) ) {
					if ( is_array( $this->data['metaUser']->cmsUser->name ) ) {
						$namearray	= $this->data['metaUser']->cmsUser->name;
					} else {
						$namearray	= explode( " ", $this->data['metaUser']->cmsUser->name );
					}

					$name['first_first']	= $namearray[0];
					$maxname				= count($namearray) - 1;
					$name['last']			= $namearray[$maxname];

					unset( $namearray[$maxname] );

					$name['first']			= implode( ' ', $namearray );
				}

				if ( isset( $this->data['metaUser']->cmsUser->id ) ) {
					$this->rewrite['user_id']				= $this->data['metaUser']->cmsUser->id;
				} else {
					$this->rewrite['user_id']				= 0;
				}

				$this->rewrite['user_username']			= $this->data['metaUser']->cmsUser->username;
				$this->rewrite['user_name']				= $this->data['metaUser']->cmsUser->name;
				$this->rewrite['user_first_name']		= $name['first'];
				$this->rewrite['user_first_first_name']	= $name['first_first'];
				$this->rewrite['user_last_name']		= $name['first'];
				$this->rewrite['user_email']			= $this->data['metaUser']->cmsUser->email;

				if ( GeneralInfoRequester::detect_component( 'JOMSOCIAL' ) ) {
					if ( !$this->data['metaUser']->hasJSprofile ) {
						$this->data['metaUser']->loadJSuser();
					}

					if ( !empty( $this->data['metaUser']->hasJSprofile ) ) {
						foreach ( $this->data['metaUser']->jsUser as $field ) {
							$this->rewrite['user_js_' . $field->field_id] = $field->value;
						}
					}
				}

				if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
					if ( !$this->data['metaUser']->hasCBprofile ) {
						$this->data['metaUser']->loadCBuser();
					}

					if ( !empty( $this->data['metaUser']->hasCBprofile ) ) {
						$fields = get_object_vars( $this->data['metaUser']->cbUser );

						if ( !empty( $fields ) ) {
							foreach ( $fields as $fieldname => $fieldcontents ) {
								$this->rewrite['user_' . $fieldname] = $fieldcontents;
							}
						}

						if ( isset( $this->data['metaUser']->cbUser->cbactivation ) ) {
							$this->rewrite['user_activationcode']		= $this->data['metaUser']->cbUser->cbactivation;
							$this->rewrite['user_activationlink']		= JURI::root()."index.php?option=com_comprofiler&task=confirm&confirmcode=" . $this->data['metaUser']->cbUser->cbactivation;
						} else {
							$this->rewrite['user_activationcode']		= "";
							$this->rewrite['user_activationlink']		= "";
						}
					} else {
						if ( isset( $this->data['metaUser']->cmsUser->activation ) ) {
							$this->rewrite['user_activationcode']		= $this->data['metaUser']->cmsUser->activation;

							if ( aecJoomla15check() ) {
								$this->rewrite['user_activationlink']	= JURI::root()."index.php?option=com_user&task=activate&activation=" . $this->data['metaUser']->cmsUser->activation;
							} else {
								$this->rewrite['user_activationlink']	= JURI::root()."index.php?option=com_registration&task=activate&activation=" . $this->data['metaUser']->cmsUser->activation;
							}
						} else {
							$this->rewrite['user_activationcode']		= "";
							$this->rewrite['user_activationlink']		= "";
						}
					}
				} else {
					if ( isset( $this->data['metaUser']->cmsUser->activation ) ) {
						$this->rewrite['user_activationcode']			= $this->data['metaUser']->cmsUser->activation;

						if ( aecJoomla15check() ) {
							$this->rewrite['user_activationlink']		= JURI::root()."index.php?option=com_user&task=activate&activation=" . $this->data['metaUser']->cmsUser->activation;
						} else {
							$this->rewrite['user_activationlink']		= JURI::root()."index.php?option=com_registration&task=activate&activation=" . $this->data['metaUser']->cmsUser->activation;
						}
					}
				}

				if ( !empty( $this->data['metaUser']->meta->custom_params ) ) {
					foreach ( $this->data['metaUser']->meta->custom_params as $k => $v ) {
						$this->rewrite['user_' . $k] = $v;
					}
				}

				if ( $this->data['metaUser']->hasSubscription ) {
					$this->rewrite['subscription_type']				= $this->data['metaUser']->focusSubscription->type;
					$this->rewrite['subscription_status']			= $this->data['metaUser']->focusSubscription->status;
					$this->rewrite['subscription_signup_date']		= $this->data['metaUser']->focusSubscription->signup_date;
					$this->rewrite['subscription_lastpay_date']		= $this->data['metaUser']->focusSubscription->lastpay_date;
					$this->rewrite['subscription_plan']				= $this->data['metaUser']->focusSubscription->plan;

					if ( !empty( $this->data['metaUser']->focusSubscription->previous_plan ) ) {
						$this->rewrite['subscription_previous_plan']	= $this->data['metaUser']->focusSubscription->previous_plan;
					} else {
						$this->rewrite['subscription_previous_plan']	= "";
					}

					$this->rewrite['subscription_recurring']		= $this->data['metaUser']->focusSubscription->recurring;
					$this->rewrite['subscription_lifetime']			= $this->data['metaUser']->focusSubscription->lifetime;
					$this->rewrite['subscription_expiration_date']	= strftime( $aecConfig->cfg['display_date_frontend'], strtotime( $this->data['metaUser']->focusSubscription->expiration ) );
					$this->rewrite['subscription_expiration_date_backend']	= strftime( $aecConfig->cfg['display_date_backend'], strtotime( $this->data['metaUser']->focusSubscription->expiration ) );
				}

				if ( empty( $this->data['invoice'] ) && !empty( $this->data['metaUser']->cmsUser->id ) ) {
					$lastinvoice = AECfetchfromDB::lastClearedInvoiceIDbyUserID( $this->data['metaUser']->cmsUser->id );

					$this->data['invoice'] = new Invoice( $database );
					$this->data['invoice']->load( $lastinvoice );
				}
			}
		}

		if ( is_object( $this->data['invoice'] ) ) {
			$this->rewrite['invoice_id']				= $this->data['invoice']->id;
			$this->rewrite['invoice_number']			= $this->data['invoice']->invoice_number;
			$this->rewrite['invoice_created_date']		= $this->data['invoice']->created_date;
			$this->rewrite['invoice_transaction_date']	= $this->data['invoice']->transaction_date;
			$this->rewrite['invoice_method']			= $this->data['invoice']->method;
			$this->rewrite['invoice_amount']			= $this->data['invoice']->amount;
			$this->rewrite['invoice_currency']			= $this->data['invoice']->currency;

			if ( !empty( $this->data['invoice']->coupons ) && is_array( $this->data['invoice']->coupons ) ) {
				$this->rewrite['invoice_coupons']		=  implode( ';', $this->data['invoice']->coupons );
			} else {
				$this->rewrite['invoice_coupons']		=  '';
			}

			if ( !empty( $this->data['metaUser'] ) && !empty( $this->data['invoice'] ) ) {
				if ( !empty( $this->data['invoice']->id ) ) {
					$this->data['invoice']->formatInvoiceNumber();
					$this->rewrite['invoice_number_format']	= $this->data['invoice']->invoice_number;
					$this->data['invoice']->deformatInvoiceNumber();
				}
			}
		}

		if ( !empty( $this->data['plan'] ) ) {
			if ( is_object( $this->data['plan'] ) ) {
				$this->rewrite['plan_name'] = $this->data['plan']->getProperty( 'name' );
				$this->rewrite['plan_desc'] = $this->data['plan']->getProperty( 'desc' );
			}
		}
	}

	function resolve( $subject )
	{
		// Check whether a replacement exists at all
		if ( ( strpos( $subject, '[[' ) === false ) && ( strpos( $subject, '{aecjson}' ) === false ) ) {
			return $subject;
		}

		if ( empty( $this->rewrite ) ) {
			$this->armRewrite();
		}

		if ( strpos( $subject, '{aecjson}' ) !== false ) {
			// We have at least one JSON object, switching to JSON mode
			return $this->decodeTags( $subject );
		} else {
			// No JSON found, do traditional parsing
			$search = array();
			$replace = array();
			foreach ( $this->rewrite as $name => $replacement ) {
				$search[]	= '[[' . $name . ']]';
				$replace[]	= $replacement;
			}

			return str_replace( $search, $replace, $subject );
		}
	}

	function decodeTags( $subject )
	{
		// Example:
		// {aecjson} {"cmd":"concat","vars":["These ",{"cmd":"condition","vars":{"cmd":"compare","vars":["apples","=","oranges"]},"appl","orang"},"es"} {/aecjson}
		// ...would return either "These apples" or "These oranges", depending on whether the compare function thinks that they are the same

		$regex = "#{aecjson}(.*?){/aecjson}#s";

		// find all instances of json code
		$matches = array();
		preg_match_all( $regex, $subject, $matches, PREG_SET_ORDER );

		if ( count( $matches ) < 1 ) {
			return $subject;
		}

		foreach ( $matches as $match ) {
			$json = jsoonHandler::decode( $match[1] );

			$result = $this->resolveJSONitem( $json );

			$subject = str_replace( $match, $result, $subject );
		}

		return $subject;
	}

	function resolveJSONitem( $current )
	{
		if ( is_object( $current ) ) {
			if ( !isset( $current->cmd ) || !isset( $current->vars ) ) {
				// Malformed String
				return "JSON PARSE ERROR - Malformed String!";
			}

			$variables = $this->resolveJSONitem( $current->vars );

			$current = $this->executeCommand( $current->cmd, $variables );
		} elseif ( is_array( $current ) ) {
			foreach( $current as $id => $item ) {
				$current[$id] = $this->resolveJSONitem( $item );
			}
		}

		return $current;
	}

	function executeCommand( $command, $vars )
	{
		$result = '';
		switch( $command ) {
			case 'rw_constant':
				if ( isset( $this->rewrite[$vars] ) ) {
					$result = $this->rewrite[$vars];
				}
				break;
			case 'data':
				if ( empty( $this->data ) ) {
					return false;
				}

				// We also support dot notation for the vars,
				// so explode if that is what the admin wants here
				if ( !is_array( $vars ) && ( strpos( $vars, '.' ) !== false ) ) {
					$temp = explode( '.', $vars );
					$vars = $temp;
				} elseif ( !is_array( $vars ) ) {
					return false;
				}

				$result = AECToolbox::getObjectProperty( $this->data, $vars );
				break;
			case 'metaUser':
				if ( !is_object( $this->data['metaUser'] ) ) {
					return false;
				}

				// We also support dot notation for the vars,
				// so explode if that is what the admin wants here
				if ( !is_array( $vars ) && ( strpos( $vars, '.' ) !== false ) ) {
					$temp = explode( '.', $vars );
					$vars = $temp;
				} elseif ( !is_array( $vars ) ) {
					return false;
				}

				$result = $this->data['metaUser']->getProperty( $vars );
				break;
			case 'constant':
				if ( defined( $vars ) ) {
					$result = constant( $vars );
				} else {
					$result = $vars;
				}
				break;
			case 'global':
				if ( is_array( $vars ) ) {
					if ( isset( $vars[0] ) && isset( $vars[1] ) ) {
						$call = strtoupper( $vars[0] );

						$v = $vars[1];

						$allowed = array( 'SERVER', 'GET', 'POST', 'FILES', 'COOKIE', 'SESSION', 'REQUEST', 'ENV' );

						if ( in_array( $call, $allowed ) ) {
							switch ( $call ) {
								case 'SERVER':
									if ( isset( $_SERVER[$v] ) ) {
										$result = $_SERVER[$v];
									}
									break;
								case 'GET':
									if ( isset( $_GET[$v] ) ) {
										$result = $_GET[$v];
									}
									break;
								case 'POST':
									if ( isset( $_POST[$v] ) ) {
										$result = $_POST[$v];
									}
									break;
								case 'FILES':
									if ( isset( $_FILES[$v] ) ) {
										$result = $_FILES[$v];
									}
									break;
								case 'COOKIE':
									if ( isset( $_COOKIE[$v] ) ) {
										$result = $_COOKIE[$v];
									}
									break;
								case 'SESSION':
									if ( isset( $_SESSION[$v] ) ) {
										$result = $_SESSION[$v];
									}
									break;
								case 'REQUEST':
									if ( isset( $_REQUEST[$v] ) ) {
										$result = $_REQUEST[$v];
									}
									break;
								case 'ENV':
									if ( isset( $_ENV[$v] ) ) {
										$result = $_ENV[$v];
									}
									break;
							}
						}
					}
				} else {
					if ( isset( $GLOBALS[$vars] ) ) {
						$result = $GLOBALS[$vars];
					}
				}
				break;
			case 'condition':
				if ( empty( $vars[0] ) || !isset( $vars[1] ) ) {
					if ( isset( $vars[2] ) ) {
						$result = $vars[2];
					} else {
						$result = '';
					}
				} elseif ( isset( $vars[1] ) ) {
					$result = $vars[1];
				} else {
					$result = '';
				}
				break;
			case 'uppercase':
				$result = strtoupper( $vars );
				break;
			case 'lowercase':
				$result = strtoupper( $vars );
				break;
			case 'concat':
				$result = implode( $vars );
				break;
			case 'date':
				$result = date( $vars[0], strtotime( $vars[1] ) );
				break;
			case 'crop':
				if ( isset( $vars[2] ) ) {
					$result = substr( $vars[0], (int) $vars[1], (int) $vars[2] );
				} else {
					$result = substr( $vars[0], (int) $vars[1] );
				}
				break;
			case 'pad':
				if ( isset( $vars[3] ) ) {
					$result = str_pad( $vars[0], (int) $vars[1], $vars[2], constant( "STR_PAD_" . strtoupper( $vars[3] ) ) );
				} elseif ( isset( $vars[2] ) ) {
					$result = str_pad( $vars[0], (int) $vars[1], $vars[2] );
				} else {
					$result = str_pad( $vars[0], (int) $vars[1] );
				}
				break;
			case 'chunk':
				$chunks = str_split( $vars[0], (int) $vars[1] );

				if ( isset( $vars[2] ) ) {
					$result = implode( $vars[2], $chunks );
				} else {
					$result = implode( ' ', $chunks );
				}
				break;
			case 'compare':
				if ( isset( $vars[2] ) ) {
					$result = AECToolbox::compare( $vars[1], $vars[0], $vars[2] );
				} else {
					$result = 0;
				}
				break;
			case 'math':
				if ( isset( $vars[2] ) ) {
					$result = AECToolbox::math( $vars[1], (float) $vars[0], (float) $vars[2] );
				} else {
					$result = 0;
				}
				break;
			case 'php_function':
				if ( isset( $vars[1] ) ) {
					$result = call_user_func_array( $vars[0], $vars[1] );
				} else {
					$result = call_user_func_array( $vars[0] );
				}
				break;
			case 'php_method':
				if ( function_exists( 'call_user_method_array' ) ) {
					if ( isset( $vars[2] ) ) {
						$result = call_user_method_array( $vars[0], $vars[1], $vars[2] );
					} else {
						$result = call_user_method_array( $vars[0], $vars[1] );
					}
				} else {
					$callback = array( $vars[0], $vars[1] );

					if ( isset( $vars[2] ) ) {
						$result = call_user_func_array( $callback, $vars[2] );
					} else {
						$result = call_user_func_array( $callback );
					}
				}
				break;
			default:
				$result = $command;
				break;
		}

		return $result;
	}

}

class AECToolbox
{
	/**
	 * Builds a list of valid currencies
	 *
	 * @param bool	$currMain	main (most important currencies)
	 * @param bool	$currGen	second important currencies
	 * @param bool	$currOth	rest of the world currencies
	 * @since 0.12.4
	 * @return array
	 */
	function aecCurrencyField( $currMain = false, $currGen = false, $currOth = false, $list_only = false )
	{
		$currencies = array();

		if ( $currMain ) {
			$currencies[] = 'EUR,USD,CHF,CAD,DKK,SEK,NOK,GBP,JPY';
		}

		if ( $currGen ) {
			$currencies[]	= 'AUD,CYP,CZK,EGP,HUF,GIP,HKD,UAH,ISK,'
			. 'EEK,HRK,GEL,LVL,RON,BGN,LTL,MTL,FIM,MDL,ILS,NZD,ZAR,RUB,SKK,'
			. 'TRY,PLN'
			;
		}

		if ( $currOth ) {
			$currencies[]	= 'AFA,DZD,ARS,AMD,AWG,AZM,'
			. 'BSD,BHD,THB,PAB,BBD,BYB,BZD,BMD,VEB,BOB,'
			. 'BRL,BND,BIF,CVE,KYD,GHC,XOF,XAF,XPF,CLP,'
			. 'COP,KMF,BAM,NIO,CRC,CUP,GMD,MKD,AED,DJF,'
			. 'STD,DOP,VND,XCD,SVC,ETB,FKP,FJD,CDF,FRF,'
			. 'HTG,PYG,GNF,GWP,GYD,HKD,UAH,INR,IRR,IQD,'
			. 'JMD,JOD,KES,PGK,LAK,KWD,MWK,ZMK,AOR,MMK,'
			. 'LBP,ALL,HNL,SLL,LRD,LYD,SZL,LSL,MGF,MYR,'
			. 'TMM,MUR,MZM,MXN,MXV,MAD,ERN,NAD,NPR,ANG,'
			. 'AON,TWD,ZRN,BTN,KPW,PEN,MRO,TOP,PKR,XPD,'
			. 'MOP,UYU,PHP,XPT,BWP,QAR,GTQ,ZAL,OMR,KHR,'
			. 'MVR,IDR,RWF,SAR,SCR,XAG,SGD,SBD,KGS,SOS,'
			. 'LKR,SHP,ECS,SDD,SRG,SYP,TJR,BDT,WST,TZS,'
			. 'KZT,TPE,TTD,MNT,TND,UGX,ECV,CLF,USN,USS,'
			. 'UZS,VUV,KRW,YER,CNY,ZWD'
			;
		}

		if ( $list_only ) {
			$currency_code_list = implode( ',', $currencies);
		} else {
			$currency_code_list = array();

			foreach ( $currencies as $currencyfield ) {
				$currency_array = explode( ',', $currencyfield );
				foreach ( $currency_array as $currency ) {
					$currency_code_list[] = mosHTML::makeOption( $currency, constant( '_CURRENCY_' . $currency ) );
				}

				$currency_code_list[] = mosHTML::makeOption( '" disabled="disabled', '- - - - - - - - - - - - - -' );
			}
		}

		return $currency_code_list;
	}

	function aecNumCurrency( $string )
	{
		$iso4217num = array( 'AED' => '784', 'AFN' => '971', 'ALL' => '008' ,'AMD' => '051', 'ANG' => '532',
							'AOA' => '973', 'ARS' => '032', 'AUD' => '036', 'AWG' => '533', 'AZN' => '944',
							'BAM' => '977', 'BBD' => '052', 'BDT' => '050', 'BGN' => '975', 'BHD' => '048',
							'BIF' => '108', 'BMD' => '060', 'BND' => '096', 'BOB' => '068', 'BOV' => '984',
							'BRL' => '986', 'BSD' => '044', 'BTN' => '064', 'BWP' => '072', 'BYR' => '974',
							'BZD' => '084', 'CAD' => '124', 'CDF' => '976', 'CHE' => '947', 'CHF' => '756',
							'CHW' => '948', 'CLF' => '990', 'CLP' => '152', 'CNY' => '156', 'COP' => '170',
							'COU' => '970', 'CRC' => '188', 'CUP' => '192', 'CVE' => '132', 'CZK' => '203',
							'DJF' => '262', 'DKK' => '208', 'DOP' => '214', 'DZD' => '012', 'EEK' => '233',
							'EGP' => '818', 'ERN' => '232', 'ETB' => '230', 'EUR' => '978', 'FJD' => '242',
							'FKP' => '238', 'GBP' => '826', 'GEL' => '981', 'GHS' => '936', 'GIP' => '292',
							'GMD' => '270', 'GNF' => '324', 'GTQ' => '320', 'GYD' => '328', 'HKD' => '344',
							'HNL' => '340', 'HRK' => '191', 'HTG' => '332', 'HUF' => '348', 'IDR' => '360',
							'ILS' => '376', 'INR' => '356', 'IQD' => '368', 'IRR' => '364', 'ISK' => '352',
							'JMD' => '388', 'JOD' => '400', 'JPY' => '392', 'KES' => '404', 'KGS' => '417',
							'KHR' => '116', 'KMF' => '174', 'KPW' => '408', 'KRW' => '410', 'KWD' => '414',
							'KYD' => '136', 'KZT' => '398', 'LAK' => '418', 'LBP' => '422', 'LKR' => '144',
							'LRD' => '430', 'LSL' => '426', 'LTL' => '440', 'LVL' => '428', 'LYD' => '434',
							'MAD' => '504', 'MDL' => '498', 'MGA' => '969', 'MKD' => '807', 'MMK' => '104',
							'MNT' => '496', 'MOP' => '446', 'MRO' => '478', 'MUR' => '480', 'MVR' => '462',
							'MWK' => '454', 'MXN' => '484', 'MXV' => '979', 'MYR' => '458', 'MZN' => '943',
							'NAD' => '516', 'NGN' => '566', 'NIO' => '558', 'NOK' => '578', 'NPR' => '524',
							'NZD' => '554', 'OMR' => '512', 'PAB' => '590', 'PEN' => '604', 'PGK' => '598',
							'PHP' => '608', 'PKR' => '586', 'PLN' => '985', 'PYG' => '600', 'QAR' => '634',
							'RON' => '946', 'RSD' => '941', 'RUB' => '643', 'RWF' => '646', 'SAR' => '682',
							'SBD' => '090', 'SCR' => '690', 'SDG' => '938', 'SEK' => '752', 'SGD' => '702',
							'SHP' => '654', 'SKK' => '703', 'SLL' => '694', 'SOS' => '706', 'SRD' => '968',
							'STD' => '678', 'SYP' => '760', 'SZL' => '748', 'THB' => '764', 'TJS' => '972',
							'TMM' => '795', 'TND' => '788', 'TOP' => '776', 'TRY' => '949', 'TTD' => '780',
							'TWD' => '901', 'TZS' => '834', 'UAH' => '980', 'UGX' => '800', 'USD' => '840',
							'USN' => '997', 'USS' => '998', 'UYU' => '858', 'UZS' => '860', 'VEF' => '937',
							'VND' => '704', 'VUV' => '548', 'WST' => '882', 'XAF' => '950', 'XAG' => '961',
							'XAU' => '959', 'XBA' => '955', 'XBB' => '956', 'XBC' => '957', 'XBD' => '958',
							'XCD' => '951', 'XDR' => '960', 'XFU' => 'Nil', 'XOF' => '952', 'XPD' => '964',
							'XPF' => '953', 'XPT' => '962', 'XTS' => '963', 'XXX' => '999', 'YER' => '886',
							'ZMK' => '894', 'ZWD' => '716'
							);

		if ( isset( $iso4217num[$string] ) ) {
			return $iso4217num[$string];
		} else {
			return '';
		}
	}

	function aecCurrencyExp( $string )
	{
		$iso4217exp3 = array( 'BHD', 'IQD', 'JOD', 'KRW', 'LYD', 'OMR', 'TND'  );
		$iso4217exp0 = array( 'BIF', 'BYR', 'CLF', 'CLP', 'DJF', 'GNF', 'ISK', 'JPY', 'KMF', 'KRW',
								'PYG', 'RWF', 'VUV', 'XAF', 'XAG', 'XAU', 'XBA', 'XBB', 'XBC', 'XBD',
								'XDR', 'XFU', 'XOF', 'XPD', 'XPF', 'XPT', 'XTS', 'XXX' );
		$iso4217exp07 = array( 'MGA', 'MRO' );

		if ( in_array( $string, $iso4217exp0 ) ) {
			return 0;
		} elseif ( in_array( $string, $iso4217exp3 ) ) {
			return 3;
		} elseif ( in_array( $string, $iso4217exp07 ) ) {
			return 0.7;
		} else {
			return 2;
		}
	}

	function getISO4271_codes()
	{
		return array( 'AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ',
						'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BA', 'BW', 'BV', 'BR', 'IO',
						'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO',
						'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG',
						'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE',
						'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA',
						'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO',
						'KZ', 'KE', 'KI', 'KP', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU',
						'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD',
						'MC', 'MN', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'AN', 'NC', 'NZ', 'NI', 'NE', 'NG',
						'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT',
						'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'SH', 'KN', 'LC', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN',
						'CS', 'SC', 'SL', 'SG', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ',
						'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC',
						'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH',
						'YE', 'ZM', 'ZW' );
	}

	/**
	 * get user ip & isp
	 *
	 * @return array w/ values
	 */
	function aecIP()
	{
		global $aecConfig;

		// user IP
		$aecUser['ip'] 	= $_SERVER['REMOTE_ADDR'];

		// user Hostname (if not deactivated)
		if ( $aecConfig->cfg['gethostbyaddr'] ) {
			$aecUser['isp'] = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
		} else {
			$aecUser['isp'] = 'deactivated';
		}

		return $aecUser;
	}

	function in_ip_range( $ip_one, $ip_two=false )
	{
		if ( $ip_two === false ) {
			if ( $ip_one == $_SERVER['REMOTE_ADDR'] ) {
				$ip = true;
			} else {
				$ip = false;
			}
		} else {
			if ( ( ip2long( $ip_one ) <= ip2long( $_SERVER['REMOTE_ADDR'] ) ) && ( ip2long( $ip_two ) >= ip2long( $_SERVER['REMOTE_ADDR'] ) ) ) {
				$ip = true;
			} else {
				$ip = false;
			}
		}
		return $ip;
	}

	/**
	 * Return a URL based on the sef and user settings
	 * @parameter url
	 * @return string
	 */
	function backendTaskLink( $task, $text )
	{
		return '<a href="' .  JURI::root() . 'administrator/index2.php?option=com_acctexp&amp;task=' . $task . '" title="' . $text . '">' . $text . '</a>';
	}

	/**
	 * Return a URL based on the sef and user settings
	 * @parameter url
	 * @return string
	 */
	function deadsureURL( $url, $secure=false, $internal=false )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$base = JURI::root();

		if ( $secure ) {
			if ( $aecConfig->cfg['override_reqssl'] ) {
				$secure = false;
			} elseif ( !empty( $aecConfig->cfg['altsslurl'] ) ) {
				$base = $aecConfig->cfg['altsslurl'];
			}
		}

		if ( $aecConfig->cfg['simpleurls'] ) {
			$new_url = $base . $url;
		} else {
			if ( !strpos( strtolower( $url ), 'itemid' ) ) {
				global $Itemid;
				if ( $Itemid ) {
					$url .= '&amp;Itemid=' . $Itemid;
				} else {
					$url .= '&amp;Itemid=';
				}
			}

			if ( !function_exists( 'sefRelToAbs' ) ) {
				include_once( JPATH_SITE . '/includes/sef.php' );
			}

			$new_url = sefRelToAbs( $url );

			if ( !( strpos( $new_url, $base ) === 0 ) ) {
				// look out for malformed live_site
				if ( strpos( $base, '/' ) === strlen( $base ) ) {
					$new_url = substr( $base, 0, -1 ) . $new_url;
				} else {
					// It seems we have a sefRelToAbs malfunction (subdirectory is not appended)
					$metaurl = explode( '/', $base );
					$rooturl = $metaurl[0] . '//' . $metaurl[2];

					// Replace root to include subdirectory - if all fails, just prefix the live site
					if ( strpos( $new_url, $rooturl ) === 0 ) {
						$new_url = $base . substr( $new_url, strlen( $rooturl ) );
					} else {
						$new_url = $base . '/' . $new_url;
					}
				}
			}
		}

		if ( strpos( $new_url, '//administrator' ) !== 0 ) {
			$new_url = str_replace( '//administrator', '/administrator', $new_url );
		}

		if ( $secure && ( strpos( $new_url, 'https:' ) !== 0 ) ) {
			$new_url = str_replace( 'http:', 'https:', $new_url );
		}

		if ( $internal ) {
			$new_url = str_replace( '&amp;', '&', $new_url );
		}

		return $new_url;
	}

	/**
	 * Return true if the user exists and is not expired, false if user does not exist
	 * Will reroute the user if he is expired
	 * @parameter username
	 * @return bool
	 */
	function VerifyUsername( $username )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$heartbeat = new aecHeartbeat( $database );
		$heartbeat->frontendping();

		$query = 'SELECT id'
		. ' FROM #__users'
		. ' WHERE username = \'' . aecEscape( $username, array( 'string', 'badchars' ) ) . '\''
		;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( empty( $id ) ) {
			return false;
		}

		$metaUser = new metaUser( $id );

		if ( $metaUser->hasSubscription ) {
			$metaUser->objSubscription->verifylogin( $metaUser->cmsUser->block, $metaUser );
		} else {
			if ( $aecConfig->cfg['require_subscription'] ) {
				if ( $aecConfig->cfg['entry_plan'] ) {
					$payment_plan = new SubscriptionPlan( $database );
					$payment_plan->load( $aecConfig->cfg['entry_plan'] );

					$metaUser->establishFocus( $payment_plan, 'Free', false );

					$metaUser->focusSubscription->applyUsage( $payment_plan->id, 'Free', 1, 0 );

					return AECToolbox::VerifyUsername( $username );
				} else {
					$invoices = AECfetchfromDB::InvoiceCountbyUserID( $metaUser->userid );

					if ( $invoices ) {
						$invoice = AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $metaUser->userid );

						if ( $invoice ) {
							$metaUser->setTempAuth();
							aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=pending&userid=' . $id ), false, true );
							return null;
						}
					}

					$metaUser->setTempAuth();
					aecRedirect( AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=subscribe&userid=' . $id . '&intro=1' ), false, true );
					return null;
				}
			}
		}
		return true;
	}

	function VerifyUser( $username )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$heartbeat = new aecHeartbeat( $database );
		$heartbeat->frontendping();

		$query = 'SELECT id'
		. ' FROM #__users'
		. ' WHERE username = \'' . aecEscape( $username, array( 'string', 'badchars' ) ) . '\''
		;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( empty( $id ) ) {
			return false;
		}

		$metaUser = new metaUser( $id );

		if ( $metaUser->hasSubscription ) {
			$result = $metaUser->objSubscription->verify( $metaUser->cmsUser->block, $metaUser );

			if ( ( $result == 'expired' ) || ( $result == 'pending' ) ) {
				$metaUser->setTempAuth();
			}

			return $result;
		} else {
			if ( $aecConfig->cfg['require_subscription'] ) {
				if ( !empty( $aecConfig->cfg['entry_plan'] ) ) {
					$payment_plan = new SubscriptionPlan( $database );
					$payment_plan->load( $aecConfig->cfg['entry_plan'] );

					$metaUser->establishFocus( $payment_plan, 'Free', false );

					$metaUser->focusSubscription->applyUsage( $payment_plan->id, 'Free', 1, 0 );

					return AECToolbox::VerifyUser( $username );
				} else {
					$invoices = AECfetchfromDB::InvoiceCountbyUserID( $metaUser->userid );

					$metaUser->setTempAuth();

					if ( $invoices ) {
						$invoice = AECfetchfromDB::lastUnclearedInvoiceIDbyUserID( $metaUser->userid );

						if ( $invoice ) {
							return 'open_invoice';
						}
					}

					return 'subscribe';
				}
			}
		}
		return true;
	}

	function saveUserRegistration( $option, $var, $internal=false, $overrideActivation=false, $overrideEmails=false )
	{
		$database = &JFactory::getDBO();

		$acl = &JFactory::getACL();

		global $mainframe, $task, $aecConfig;

		ob_start();

		// Let CB/JUSER think that everything is going fine
		if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
			if ( GeneralInfoRequester::detect_component( 'CBE' ) || $overrideActivation ) {
				global $ueConfig;
			}

			$savetask	= $task;
			$_REQUEST['task']	= 'done';
			include_once ( JPATH_SITE . '/components/com_comprofiler/comprofiler.php' );
			$task		= $savetask;

			if ( $overrideActivation ) {
				$ueConfig['reg_confirmation'] = 0;
			}

			if ( $overrideEmails ) {
				$ueConfig['reg_welcome_sub'] = '';

				// Only disable "Pending Approval / Confirmation" emails if it makes sense
				if ( !$ueConfig['reg_confirmation'] || !$ueConfig['reg_admin_approval'] ) {
					$ueConfig['reg_pend_appr_sub'] = '';
				}
			}
		} elseif ( GeneralInfoRequester::detect_component( 'JUSER' ) ) {
			$savetask	= $task;
			$task		= 'blind';
			include_once( JPATH_SITE . '/components/com_juser/juser.php' );
			include_once( JPATH_SITE .'/administrator/components/com_juser/juser.class.php' );
			$task		= $savetask;
		} elseif ( GeneralInfoRequester::detect_component( 'JOMSOCIAL' ) ) {
			$savetask	= $task;
			$task		= 'blind';
			include_once( JPATH_SITE . '/components/com_juser/juser.php' );
			include_once( JPATH_SITE .'/administrator/components/com_juser/juser.class.php' );
			$task		= $savetask;
		}

		// For joomla and CB, we must filter out some internal variables before handing over the POST data
		$badbadvars = array( 'userid', 'method_name', 'usage', 'processor', 'recurring', 'currency', 'amount', 'invoice', 'id', 'gid' );
		foreach ( $badbadvars as $badvar ) {
			if ( isset( $var[$badvar] ) ) {
				unset( $var[$badvar] );
			}
		}

		$_POST = $var;

		$var['username'] = aecEscape( $var['username'], array( 'string', 'badchars' ) );

		$savepwd = aecEscape( $var['password'], array( 'string', 'badchars' ) );

		if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
			// This is a CB registration, borrowing their code to save the user
			@saveRegistration( $option );
		} elseif ( GeneralInfoRequester::detect_component( 'JUSER' ) ) {
			// This is a JUSER registration, borrowing their code to save the user
			saveRegistration( $option );

			$query = 'SELECT `id`'
					. ' FROM #__users'
					. ' WHERE `username` = \'' . $var['username'] . '\''
					;
			$database->setQuery( $query );
			$uid = $database->loadResult();
			JUser::saveUser_ext( $uid );
			//synchronize dublicate user data
			$query = 'SELECT `id`' .
					' FROM #__juser_integration' .
					' WHERE `published` = \'1\'' .
					' AND `export_status` = \'1\'';
			$database->setQuery( $query );
			$components = $database->loadObjectList();
			if ( !empty( $components ) ) {
				foreach ( $components as $component ) {
					$synchronize = require_integration( $component->id );
					$synchronize->synchronizeFrom( $uid );
				}
			}
		} else {
			// This is a joomla registration, borrowing their code to save the user
			global $mainframe;

			if ( aecJoomla15check() ) {
				global $mainframe;

				// Check for request forgeries
				JRequest::checkToken() or die( 'Invalid Token' );

				// Get required system objects
				$user 		= clone(JFactory::getUser());
				$pathway 	=& $mainframe->getPathway();
				$config		=& JFactory::getConfig();
				$authorize	=& JFactory::getACL();
				$document   =& JFactory::getDocument();

				// If user registration is not allowed, show 403 not authorized.
				$usersConfig = &JComponentHelper::getParams( 'com_users' );
				if ($usersConfig->get('allowUserRegistration') == '0') {
					JError::raiseError( 403, JText::_( 'Access Forbidden' ));
					return;
				}

				// Initialize new usertype setting
				$newUsertype = $usersConfig->get( 'new_usertype' );
				if (!$newUsertype) {
					$newUsertype = 'Registered';
				}

				// Bind the post array to the user object
				if (!$user->bind( JRequest::get('post'), 'usertype' )) {
					JError::raiseError( 500, $user->getError());

					unset($_POST);
					subscribe();
					return false;
				}

				// Set some initial user values
				$user->set('id', 0);
				$user->set('usertype', '');
				$user->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));

				$user->set('registerDate', date('Y-m-d H:i:s'));

				// If user activation is turned on, we need to set the activation information
				$useractivation = $usersConfig->get( 'useractivation' );
				if ( ($useractivation == '1') &&  !$overrideActivation )
				{
					jimport('joomla.user.helper');
					$user->set('activation', md5( JUserHelper::genRandomPassword()) );
					$user->set('block', '1');
				}

				// If there was an error with registration, set the message and display form
				if ( !$user->save() )
				{
					JError::raiseWarning('', JText::_( $user->getError()));
					echo JText::_( $user->getError());
					return false;
				}

				$row = $user;
			} else {
				// simple spoof check security
				if ( function_exists( 'josSpoofCheck' ) && !$internal ) {
					josSpoofCheck();
				}

				$row = new JTableUser( $database );

				if ( !$row->bind( $_POST, 'usertype' )) {
					mosErrorAlert( $row->getError() );
				}

				mosMakeHtmlSafe( $row );

				$row->id 		= 0;
				$row->usertype 	= '';
				$row->gid 		= $acl->get_group_id( 'Registered', 'ARO' );

				if ( ( $mainframe->getCfg( 'useractivation' ) == 1 ) && !$overrideActivation ) {
					$row->activation = md5( mosMakePassword() );
					$row->block = '1';
				}

				if ( !$row->check() ) {
					echo '<script>alert(\''
					. html_entity_decode( $row->getError() )
					. '\');window.history.go(-1);</script>' . "\n";
					exit();
				}

				$pwd 				= $row->password;
				$row->password 		= md5( $row->password );

				$row->registerDate 	= date( 'Y-m-d H:i:s' );

				if ( !$row->store() ) {
					echo '<script>alert(\''
					. html_entity_decode( $row->getError())
					. '\');window.history.go(-1);</script>' . "\n";
					exit();
				}
				$row->checkin();
			}

			$mih = new microIntegrationHandler();
			$mih->userchange($row, $_POST, 'registration');

			$name 		= $row->name;
			$email 		= $row->email;
			$username 	= $row->username;

			$subject 	= sprintf ( _AEC_SEND_SUB, $name, $mainframe->getCfg( 'sitename' ) );
			$subject 	= html_entity_decode( $subject, ENT_QUOTES );
			if ( aecJoomla15check() ) {
				$usersConfig = &JComponentHelper::getParams( 'com_users' );
				$activation = $usersConfig->get('useractivation');
			} else {
				$activation = $mainframe->getCfg( 'useractivation' );
			}

			if ( ( $activation == 1 ) && !$overrideActivation ) {
				$message = sprintf( _AEC_USEND_MSG_ACTIVATE, $name, $mainframe->getCfg( 'sitename' ), JURI::root()."index.php?option=" . ( aecJoomla15check() ? 'com_user' : 'com_registration' ) . "&task=activate&activation=".$row->activation, JURI::root(), $username, $savepwd );
			} else {
				$message = sprintf( _AEC_USEND_MSG, $name, $mainframe->getCfg( 'sitename' ), JURI::root() );
			}

			$message = html_entity_decode( $message, ENT_QUOTES );

			// check if Global Config `mailfrom` and `fromname` values exist
			if ( $mainframe->getCfg( 'mailfrom' ) != '' && $mainframe->getCfg( 'fromname' ) != '' ) {
				$adminName2 	= $mainframe->getCfg( 'fromname' );
				$adminEmail2 	= $mainframe->getCfg( 'mailfrom' );
			} else {
				// use email address and name of first superadmin for use in email sent to user
				$query = 'SELECT `name`, `email`'
						. ' FROM #__users'
						. ' WHERE LOWER( usertype ) = \'superadministrator\''
						. ' OR LOWER( usertype ) = \'super administrator\''
						;
				$database->setQuery( $query );
				$rows = $database->loadObjectList();
				$row2 			= $rows[0];

				$adminName2 	= $row2->name;
				$adminEmail2 	= $row2->email;
			}

			// Send email to user
			if ( !$aecConfig->cfg['nojoomlaregemails'] || $overrideEmails ) {
				if ( aecJoomla15check() ) {
					JUTility::sendMail( $adminEmail2, $adminEmail2, $email, $subject, $message );
				} else {
					mosMail( $adminEmail2, $adminName2, $email, $subject, $message );
				}
			}

			// Send notification to all administrators
			$aecUser	= AECToolbox::aecIP();

			$subject2	= sprintf( _AEC_SEND_SUB, $name, $mainframe->getCfg( 'sitename' ) );
			$message2	= sprintf( _AEC_ASEND_MSG_NEW_REG, $adminName2, $mainframe->getCfg( 'sitename' ), $row->name, $email, $username, $aecUser['ip'], $aecUser['isp'] );

			$subject2	= html_entity_decode( $subject2, ENT_QUOTES );
			$message2	= html_entity_decode( $message2, ENT_QUOTES );

			// get email addresses of all admins and superadmins set to recieve system emails
			$query = 'SELECT email, sendEmail'
			. ' FROM #__users'
			. ' WHERE ( gid = 24 OR gid = 25 )'
			. ' AND sendEmail = 1'
			. ' AND block = 0'
			;
			$database->setQuery( $query );
			$admins = $database->loadObjectList();

			foreach ( $admins as $admin ) {
				// send email to admin & super admin set to recieve system emails
				if ( aecJoomla15check() ) {
					JUTility::sendMail( $adminEmail2, $adminEmail2, $admin->email, $subject2, $message2 );
				} else {
					mosMail( $adminEmail2, $adminName2, $admin->email, $subject2, $message2 );
				}
			}
		}

		ob_clean();

		// We need the new userid, so we're fetching it from the newly created entry here
		$query = 'SELECT `id`'
				. ' FROM #__users'
				. ' WHERE `username` = \'' . $var['username'] . '\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function quickVerifyUserID( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `status`'
				. ' FROM #__acctexp_subscr'
				. ' WHERE `userid` = \'' . (int) $userid . '\''
				. ' AND `primary` = \'1\''
				;
		$database->setQuery( $query );
		$aecstatus = $database->loadResult();

		if ( $aecstatus ) {
			if ( ( strcmp( $aecstatus, 'Active' ) === 0 ) || ( strcmp( $aecstatus, 'Trial' ) === 0 ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return null;
		}
	}

	function formatAmountCustom( $request, $plan, $forcedefault=false, $proposed=null )
	{
		if ( empty( $plan->params['customamountformat'] ) || $forcedefault ) {
			$format = '{aecjson}{"cmd":"condition","vars":[{"cmd":"data","vars":"payment.freetrial"},'
						.'{"cmd":"concat","vars":[{"cmd":"constant","vars":"_CONFIRM_FREETRIAL"},"&nbsp;",{"cmd":"data","vars":"payment.method_name"}]},'
						.'{"cmd":"concat","vars":[{"cmd":"data","vars":"payment.amount"},{"cmd":"data","vars":"payment.currency_symbol"},"&nbsp;-&nbsp;",{"cmd":"data","vars":"payment.method_name"}]}'
						.']}{/aecjson}'
						;
		} else {
			$format = $plan->params['customamountformat'];
		}

		$rwEngine = new reWriteEngine();
		$rwEngine->resolveRequest( $request );

		$amount = $rwEngine->resolve( $format );

		if ( strpos( $amount, 'JSON PARSE ERROR' ) !== false ) {
			if ( !$forcedefault ) {
				return AECToolbox::formatAmountCustom( $request, $plan, true, $amount );
			} else {
				return $proposed;
			}
		}

		return $amount;
	}

	function formatAmount( $amount, $currency=null ) {
		global $aecConfig;

		if ( !empty( $currency ) ) {
			if ( !empty( $aecConfig->cfg['amount_currency_symbol'] ) ) {
				switch ( $currency ) {
					case 'USD':
						$currency = '$';
						break;
					case 'GBP':
						$currency = '&pound;';
						break;
					case 'EUR':
						$currency = '&euro;';
						break;
					case 'CNY':
					case 'JPY':
						$currency = '&yen;';
						break;
				}
			}

			$amount = AECToolbox::correctAmount( $amount );

			if ( $aecConfig->cfg['amount_use_comma'] ) {
				$amount = str_replace( '.', ',', $amount );
			}

			if ( $aecConfig->cfg['amount_currency_symbolfirst'] ) {
				return $currency . '&nbsp;' . $amount;
			} else {
				return $amount . '&nbsp;' . $currency;
			}
		} else {
			if ( $aecConfig->cfg['amount_use_comma'] ) {
				$amount = str_replace( '.', ',', $amount );
			}

			return $amount;
		}
	}

	function correctAmount( $amount )
	{
		if ( strpos( $amount, '.' ) === 0 ) {
			$amount = '0' . $amount;
		} elseif ( strpos( $amount, '.') === false ) {
			if ( strpos( $amount, ',' ) !== false ) {
				$amount = str_replace( ',', '.', $amount );
			} else {
				$amount = $amount . '.00';
			}
		}

		$a = explode( '.', (string) round( $amount, 2 ) );

		if ( empty( $a[1] ) ) {
			$amount = $a[0] . '.00';
		} else {
			$amount = $a[0] . '.' . substr( str_pad( $a[1], 2, '0' ), 0, 2 );
		}

		return $amount;
	}

	function getCurrencySymbol( $currency )
	{
		global $aecConfig;

		$cursym = array(	'AUD' => 'AU$', 'AWG' => '&#402;', 'ANG' => '&#402;', 'BDT' => '&#2547;',
							'BRL' => 'R$', 'BWP' => 'P', 'BYR' => 'Br', 'CHF' => 'Fr.',
							'CLP' => '$', 'CNY' => '&#165;', 'CRC' => '&#8353;', 'CVE' => '$',
							'CZK' => '&#75;&#269;', 'DKK' => 'kr', 'EUR' => '&euro;', 'GBP' => '&pound;',
							'GHS' => '&#8373;', 'GTQ' => 'Q', 'HUF' => 'Ft', 'HKD' => 'HK$',
							'INR' => '&#8360;', 'IDR' => 'Rp', 'ILS' => '&#8362;', 'IRR' => '&#65020;',
							'ISK' => 'kr', 'JPY' => '&yen;', 'KRW' => '&#8361;', 'KPW' => '&#8361;',
							'LAK' => '&#8365;', 'LBP' => '&#1604;.&#1604;', 'LKR' => '&#8360;', 'MYR' => 'RM',
							'MUR' => '&#8360;', 'MVR' => 'Rf', 'MNT' => '&#8366;', 'NDK' => 'kr',
							'NGN' => '&#8358;', 'NIO' => 'C$', 'NPR' => '&#8360;', 'NZD' => 'NZ$',
							'PAB' => 'B/.', 'PEH' => 'S/.', 'PEN' => 'S/.', 'PCA' => 'PC&#1044;',
							'PHP' => '&#8369;', 'PKR' => '&#8360;', 'PLN' => '&#122;&#322;', 'PYG' => '&#8370;',
							'RUB' => '&#1088;&#1091;&#1073;', 'SCR' => '&#8360;', 'SEK' => 'kr', 'SGD' => 'S$',
							'SRC' => '&#8353;', 'THB' => '&#3647;', 'TOP' => 'T$', 'TRY' => 'TL',
							'USD' => '$', 'UAH' => '&#8372;', 'VND' => '&#8363;', 'VEF' => 'Bs. F',
							'ZAR' => 'R',
							);

		if ( array_key_exists( $currency, $cursym ) ) {
			return $cursym[$currency];
		} elseif( array_key_exists( $aecConfig->cfg['standard_currency'], $cursym ) ) {
			return $cursym[$aecConfig->cfg['standard_currency']];
		} else {
			return '&#164;';
		}
	}

	function computeExpiration( $value, $unit, $timestamp )
	{
		$sign = strpos( $value, '-' ) ? '-' : '+';

		switch ( $unit ) {
			case 'H':
				$add = $sign . $value . ' hour';
				break;
			case 'D':
				$add = $sign . $value . ' day';
				break;
			case 'W':
				$add = $sign . $value . ' week';
				break;
			case 'M':
				$add = $sign . $value . ' month';
				break;
			case 'Y':
				$add = $sign . $value . ' year';
				break;
		}

		$timestamp = strtotime( $add, $timestamp );
		return date( 'Y-m-d H:i:s', $timestamp );
	}

	function cleanPOST( $post, $safe=true )
	{
		$badparams = array( 'option', 'task' );

		foreach ( $badparams as $param ) {
			if ( isset( $post[$param] ) ) {
				unset( $post[$param] );
			}
		}

		if ( $safe ) {
			return aecPostParamClear( $post );
		} else {
			return $post;
		}
	}

	function getFileArray( $dir, $extension=false, $listDirectories=false, $skipDots=true )
	{
		$dirArray	= array();
		$handle		= dir( $dir );

		while ( false !== ( $file = $handle->read() ) ) {
			if ( ( $file != '.' && $file != '..' ) || $skipDots === true ) {
				if ( $listDirectories === false ) {
					if ( is_dir( $file ) ) {
						continue;
					}
				}
				if ( $extension !== false ) {
					if ( strpos( basename( $file ), $extension ) === false ) {
						continue;
					}
				}

				array_push( $dirArray, basename( $file ) );
				}
		}
		$handle->close();
		return $dirArray;
	}

	function versionSort( $array )
	{
		// Bastardized Quicksort
		if ( !isset( $array[2] ) ) {
			return $array;
		}

		$piv = $array[0];
		$x = $y = array();
		$len = count( $array );
		$i = 1;

		while ( $i < $len ) {
			if ( version_compare( AECToolbox::normVersionName( $array[$i] ), AECToolbox::normVersionName( $piv ), '<' ) ) {
				$x[] = $array[$i];
			} else {
				$y[] = $array[$i];
			}
			++$i;
		}

		return array_merge( AECToolbox::versionSort($x), array($piv), AECToolbox::versionSort($y) );
	}

	function normVersionName( $name )
	{
		$str = str_replace( "RC", "_", $name );

		$lastchar = substr( $str, -1, 1 );

		if ( !is_numeric( $lastchar ) ) {
			$str = substr( $str, 0, strlen( $str )-1 ) . "_" . ord( $lastchar );
		}

		return $str;
	}

	function visualstrlen( $string )
	{
		// Visually Short Chars
		$srt = array( 'i', 'j', 'l', ',', '.' );
		// Visually Long Chars
		$lng = array( 'm', 'w', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Y', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );

		// Break String into individual characters
		$char_array = preg_split( '#(?<=.)(?=.)#s', $string );

		$vlen = 0;
		// Iterate through array counting the visual length of the string
		foreach ( $char_array as $char ) {
			if ( in_array( $char, $srt ) ) {
				$vlen += 0.5;
			} elseif ( in_array( $char, $srt ) ) {
				$vlen += 2;
			} else {
				$vlen += 1;
			}
		}

		return (int) $vlen;
	}

	function rewriteEngineInfo( $switches=array(), $params=null )
	{
		$rwEngine = new reWriteEngine();
		return $rwEngine->info( $switches, $params );
	}

	function rewriteEngine( $content, $metaUser=null, $subscriptionPlan=null, $invoice=null )
	{
		return AECToolbox::rewriteEngineRQ( $content, null, $metaUser, $subscriptionPlan, $invoice );
	}

	function rewriteEngineRQ( $content, $request, $metaUser=null, $subscriptionPlan=null, $invoice=null )
	{
		if ( !is_object( $request ) ) {
			$request = new stdClass();
		}

		if ( !empty( $metaUser ) ) {
			$request->metaUser = $metaUser;
		}

		if ( !empty( $subscriptionPlan ) ) {
			$request->plan = $subscriptionPlan;
		}

		if ( !empty( $invoice ) ) {
			$request->invoice = $invoice;
		}

		$rwEngine = new reWriteEngine();
		$rwEngine->resolveRequest( $request );

		return $rwEngine->resolve( $content );
	}

	function compare( $eval, $check1, $check2 )
	{
		$status = false;
		switch ( $eval ) {
			case '=':
				$status = (bool) ( $check1 == $check2 );
				break;
			case '!=':
			case '<>':
				$status = (bool) ( $check1 != $check2 );
				break;
			case '<=':
				$status = (bool) ( $check1 <= $check2 );
				break;
			case '>=':
				$status = (bool) ( $check1 >= $check2 );
				break;
			case '>':
				$status = (bool) ( $check1 > $check2 );
				break;
			case '<':
				$status = (bool) ( $check1 < $check2 );
				break;
		}

		return $status;
	}

	function math( $sign, $val1, $val2 )
	{
		$result = false;
		switch ( $sign ) {
			case '+':
				$result = $val1 + $val2;
				break;
			case '-':
				$result = $val1 - $val2;
				break;
			case '*':
				$result = $val1 * $val2;
				break;
			case '/':
				$result = $val1 / $val2;
				break;
			case '%':
				$result = $val1 % $val2;
				break;
		}

		return $result;
	}

	function getObjectProperty( $object, $key )
	{
		if ( strpos( '.', $key ) !== false ) {
			$key = explode( '.', $key );
		}

		if ( !is_array( $key ) ) {
			if ( isset( $object->$key ) ) {
				return $object->$key;
			} else {
				return null;
			}
		} else {
			$return = $object;

			$err = 'AECjson cmd:data Syntax Error';
			$erp = 'aecjson,data,syntax,error';
			$erx = 'Syntax Parser cannot parse next property: ';

			foreach ( $key as $k ) {
				// and use {}/variable variables instead
				$subject =& $return;

				if ( is_object( $subject ) ) {
					if ( property_exists( $subject, $k ) ) {
						$return =& $subject->$k;
					} else {
						$database = &JFactory::getDBO();

						$props = array_keys( get_object_vars( $subject ) );

						$event = $erx . $k . ' does not exist! Possible object values are: ' . implode( ';', $props );

						$eventlog = new eventLog( $database );
						$eventlog->issue( $err, $erp, $event, 128, array() );
					}
				} elseif ( is_array( $subject ) ) {
					if ( isset( $subject[$k] ) ) {
						$return =& $subject[$k];
					} else {
						$database = &JFactory::getDBO();

						$props = array_keys( $subject );

						$event = $erx . $k . ' does not exist! Possible array values are: ' . implode( ';', $props );

						$eventlog = new eventLog( $database );
						$eventlog->issue( $err, $erp, $event, 128, array() );
					}

				} else {
					$database = &JFactory::getDBO();

					$event = $erx . $k . '; neither property nor array field';

					$eventlog = new eventLog( $database );
					$eventlog->issue( $err, $erp, $event, 128, array() );
					return false;
				}
			}

			return $return;
		}
	}
}

class microIntegrationHandler
{
	function microIntegrationHandler()
	{
		global $mainframe;

		$this->mi_dir = JPATH_SITE . '/components/com_acctexp/micro_integration';
	}

	function getMIList( $limitstart=false, $limit=false, $use_order=false, $name=false, $classname=false )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id, class_name' . ( $name ? ', name' : '' )
			 	. ' FROM #__acctexp_microintegrations'
		 		. ' WHERE `hidden` = \'0\''
		 		. ( !empty( $classname ) ? ' AND `class_name` = \'' . $classname . '\'' : '' )
			 	. ' GROUP BY ' . ( $use_order ? '`ordering`' : '`id`' )
			 	. ' ORDER BY `class_name`'
			 	;

		if ( !empty( $limitstart ) && !empty( $limit ) ) {
			$query .= 'LIMIT ' . $limitstart . ',' . $limit;
		}

		$database->setQuery( $query );

		$rows = $database->loadObjectList();
		if ( $database->getErrorNum() ) {
			echo $database->stderr();
			return false;
		} else {
			return $rows;
		}
	}

	function compareMIs( $mi, $cmi_id )
	{
		$database = &JFactory::getDBO();

		$excluded_props = array( 'id' );

		$cmi = new microIntegration( $database );
		$cmi->load( $cmi_id );

		if ( !$cmi->callIntegration( true ) ) {
			return false;
		}

		$props = get_object_vars( $mi );

		$similar = true;
		foreach ( $props as $prop => $value ) {
			if ( ( strpos( $prop, '_' ) === 0 ) || in_array( $prop, $excluded_props ) ) {
				// This is an internal or excluded variable
				continue;
			}

			if ( $cmi->$prop != $mi->$prop ) {
				// Nope, this one is different
				$similar = false;
			}
		}

		return $similar;
	}

	function getIntegrationList()
	{
		$list = AECToolbox::getFileArray( $this->mi_dir, 'php', false, true );

		asort( $list );

		$integration_list = array();
		foreach ( $list as $name ) {
			$parts = explode( '.', $name );
			$integration_list[] = $parts[0];
		}

		return $integration_list;
	}

	function getMIsbyPlan( $plan_id )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `micro_integrations`'
				. ' FROM #__acctexp_plans'
				. ' WHERE `id` = \'' . $plan_id . '\''
				;
		$database->setQuery( $query );
		$mis = $database->loadResult();

		if ( empty( $mis ) ) {
			return array();
		}

		return unserialize( base64_decode( $mis ) );
	}

	function getPlansbyMI( $mi_id )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_plans'
				. ' WHERE `micro_integrations` != \'\''
				;
		$database->setQuery( $query );
		$plans = $database->loadResultArray();

		$plan_list = array();
		foreach ( $plans as $planid ) {
			$plan = new SubscriptionPlan( $database );
			$plan->load( $planid );
			$mis = $plan->getMicroIntegrations();
			if ( is_array( $mis ) ) {
				if ( in_array( $mi_id, $mis ) ) {
					$plan_list[] = $planid;
				}
			}
		}

		return $plan_list;
	}

	function userPlanExpireActions( $metaUser, $subscription_plan )
	{
		$database = &JFactory::getDBO();

		$mi_autointegrations = $this->getAutoIntegrations();

		if ( is_array( $mi_autointegrations ) || ( $subscription_plan !== false ) ) {
			$mis = $subscription_plan->getMicroIntegrations();

			if ( is_array( $mis ) ) {
				$user_auto_integrations = array_intersect( $mis, $mi_autointegrations );
			} else {
				return null;
			}

			if ( count( $user_auto_integrations ) ) {
				foreach ( $user_auto_integrations as $mi_id ) {
					$mi = new microIntegration( $database );
					$mi->load( $mi_id );
					if ( $mi->callIntegration() ) {
						$mi->expiration_action( $metaUser, $subscription_plan );
					}
				}
			}
		}
	}

	function getHacks()
	{
		$integrations = $this->getIntegrationList();

		$hacks = array();
		foreach ( $integrations as $n => $name ) {
			$file = $this->mi_dir . '/' . $name . '.php';

			if ( file_exists( $file ) ) {
				include_once $file;

				$mi = new $name();

				if ( method_exists( $mi, 'hacks' ) ) {
					if ( method_exists( $mi, 'detect_application' ) ) {
						if ( $mi->detect_application() ) {
							$mihacks = $mi->hacks();
							if ( is_array( $mihacks ) ) {
								$hacks = array_merge( $hacks, $mihacks );
							}
						}
					}
				}
			}
		}

		return $hacks;
	}

	function getAutoIntegrations()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `auto_check` = \'1\''
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function getUserChangeIntegrations()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `active` = \'1\''
				. ' AND `on_userchange` = \'1\''
				;
		$database->setQuery( $query );
		return $database->loadResultArray();
	}

	function userchange( $row, $post, $trace = '' )
	{
		$database = &JFactory::getDBO();

		$mi_list = $this->getUserChangeIntegrations();

		if ( is_int( $row ) ) {
			$userid = $row;
		} elseif ( is_string( $row ) ){
			$query = 'SELECT id'
			. ' FROM #__users'
			. ' WHERE username = \'' . $row . '\''
			;
			$database->setQuery( $query );
			$userid = $database->loadResult();
		} elseif ( is_array( $row ) ) {
			$userid = $row['id'];
		} elseif ( !is_object( $row ) ) {
			$userid = $row;
		}

		if ( !is_object( $row ) ) {
			$row = new JTableUser( $database );
			$row->load( $userid );
		}

		if ( !empty( $mi_list ) ) {
			foreach ( $mi_list as $mi_id ) {;
				if ( !is_null( $mi_id ) && ( $mi_id != '' ) && $mi_id ) {
					$mi = new microIntegration($database);
					$mi->load( $mi_id );
					if ( $mi->callIntegration() ) {
						$mi->on_userchange_action( $row, $post, $trace );
					}
				}
			}
		}
	}

	function applyMIs( &$terms, $subscription, $metaUser )
	{
		$database = &JFactory::getDBO();

		$add = new stdClass();
		$add->terms =& $terms;

		if ( !empty( $subscription->micro_integrations ) ) {
			foreach ( $subscription->micro_integrations as $mi_id ) {
				$mi = new microIntegration( $database );

				if ( !$mi->mi_exists( $mi_id ) ) {
					continue;
				}

				$mi->load( $mi_id );

				if ( !$mi->callIntegration() ) {
					continue;
				}

				if ( method_exists( $mi->mi_class, 'modifyPrice' )  ) {
					$mi->relayAction( $metaUser, null, null, $subscription, 'modifyPrice', $add );
				}

				unset( $mi );
			}
		}
	}
}

class MI
{
	function autoduplicatesettings( $settings, $ommit=array(), $collate=true )
	{
		if ( isset( $settings['lists'] ) ) {
			$lists = $settings['lists'];
			unset( $settings['lists'] );
		} else {
			$lists = array();
		}

		$new_settings = array();
		$new_lists = array();
		foreach ( $settings as $name => $content ) {
			if ( in_array( $name, $ommit ) ) {
				continue;
			}

			if ( $collate ) {
				$new_settings[$name]				= $content;
				$new_settings_exp[$name.'_exp']		= $content;
				$new_settings_pxp[$name.'_pre_exp']	= $content;
			} else {
				$new_settings[$name]			= $content;
				$new_settings[$name.'_exp']		= $content;
				$new_settings[$name.'_pre_exp']	= $content;
			}
		}

		if ( $collate ) {
			$new_settings = array_merge( $new_settings, $new_settings_exp, $new_settings_pxp );
		}

		if ( !empty( $new_lists ) ) {
			$new_settings['lists'] = $lists;
		}

		return $new_settings;
	}

	function pre_expiration_action( $params, $metaUser, $plan )
	{
		return $this->relayAction( $params, $metaUser, $plan, null, '_pre_exp', $add=false );
	}

	function expiration_action( $params, $metaUser, $plan )
	{
		return $this->relayAction( $params, $metaUser, $plan, null, '_exp', $add=false );
	}

	function action( $params, $metaUser, $invoice, $plan )
	{
		return $this->relayAction( $params, $metaUser, $plan, $invoice, '', $add=false );
	}

	function setError( $error )
	{
		if ( !isset( $this->error ) ) {
			$this->error = array();
		}

		$this->error[] = $error;
	}

	function setWarning( $warning )
	{
		if ( !isset( $this->warning ) ) {
			$this->warning = array();
		}

		$this->warning[] = $warning;
	}

	function issueUniqueEvent( $request, $event, $due_date, $context=array(), $params=array(), $customparams=array() )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_event'
				. ' WHERE `userid` = \'' . $request->metaUser->userid . '\''
				. ' AND `appid` = \'' . $this->id . '\''
				. ' AND `event` = \'' . $event . '\''
				. ' AND `type` = \'mi\''
	 			. ' AND `status` = \'waiting\''
				;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( $id ) {
			return null;
		} else {
			return $this->issueEvent( $request, $event, $due_date, $context, $params, $customparams );
		}
	}

	function redateUniqueEvent( $request, $event, $due_date, $context=array(), $params=array(), $customparams=array() )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_event'
				. ' WHERE `userid` = \'' . $request->metaUser->userid . '\''
				. ' AND `appid` = \'' . $this->id . '\''
				. ' AND `event` = \'' . $event . '\''
				. ' AND `type` = \'mi\''
	 			. ' AND `status` = \'waiting\''
				;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( $id ) {
			$aecEvent = new aecEvent( $database );
			$aecEvent->load( $id );

			if ( $aecEvent->due_date != $due_date ) {
				$aecEvent->due_date = $due_date;
				$aecEvent->storeload();
			}
		} else {
			return $this->issueEvent( $request, $event, $due_date, $context, $params, $customparams );
		}
	}

	function removeEvents( $request, $event )
	{
		$database = &JFactory::getDBO();

		$query = 'DELETE'
				. ' FROM #__acctexp_event'
				. ' WHERE `userid` = \'' . $request->metaUser->userid . '\''
				. ' AND `appid` = \'' . $this->id . '\''
				. ' AND `event` = \'' . $event . '\''
				. ' AND `type` = \'mi\''
	 			. ' AND `status` = \'waiting\''
				;
		$database->setQuery( $query );
		$database->query();
	}

	function issueEvent( $request, $event, $due_date, $context=array(), $params=array(), $customparams=array() )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $request->metaUser ) ) {
			$context['user_id']	= $request->metaUser->userid;
			$userid				= $request->metaUser->userid;
		} else {
			$context['user_id']	= 0;
			$userid				= 0;
		}

		if ( !empty( $request->metaUser->focusSubscription->id ) ) {
			$context['subscription_id'] = $request->metaUser->focusSubscription->id;
		}

		if ( !empty( $request->invoice->id ) ) {
			$context['invoice_id'] = $request->invoice->id;
		}

		if ( !empty( $request->invoice->invoice_number ) ) {
			$context['invoice_number'] = $request->invoice->invoice_number;
		}

		$aecEvent = new aecEvent( $database );

		return $aecEvent->issue( 'mi', $this->info['name'], $this->id, $event, $userid, $due_date, $context, $params, $customparams );
	}

	function aecEventHook( $event )
	{
		$database = &JFactory::getDBO();

		$method = 'aecEventHook' . $event->event;

		if ( !method_exists( $this, $method ) ) {
			return null;
		}

		$request = new stdClass();

		$request->parent	=& $this;
		$request->event		=& $event;

		// Establish metaUser object
		if ( !empty( $event->userid ) ) {
			$request->metaUser = new metaUser( $event->userid );
		} else {
			$request->metaUser = false;
		}

		// Select correct subscription
		if ( !empty( $event->context['subscription_id'] ) && !empty( $request->metaUser ) ) {
			$request->metaUser->moveFocus( $event->context['subscription_id'] );
		}

		// Select correct invoice
		if ( !empty( $event->context['invoice_id'] ) ) {
			$request->invoice = new Invoice( $database );
			$request->invoice->load( $event->context['invoice_id'] );
		}

		return $this->$method( $request );
	}
}

class microIntegration extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $active 			= null;
	/** @var int */
	var $system 			= null;
	/** @var int */
	var $hidden 			= null;
	/** @var int */
	var $ordering			= null;
	/** @var string */
	var $name				= null;
	/** @var text */
	var $desc				= null;
	/** @var string */
	var $class_name			= null;
	/** @var text */
	var $params				= null;
	/** @var int */
	var $auto_check			= null;
	/** @var int */
	var $pre_exp_check		= null;
	/** @var int */
	var $on_userchange		= null;

	function microIntegration(&$db)
	{
		parent::__construct( '#__acctexp_microintegrations', 'id', $db );

		if ( !defined( '_AEC_LANG_INCLUDED_MI' ) ) {
			$this->callMILanguage();
		}
	}

	function declareParamFields()
	{
		return array( 'params' );
	}

	function functionProxy( $function, $data, $default=null )
	{
		if ( method_exists( $this->mi_class, $function ) ) {
			return $this->mi_class->$function( $data );
		} else {
			return $default;
		}
	}

	function check()
	{
		if ( isset( $this->settings ) ) {
			unset( $this->settings );
		}

		if ( isset( $this->mi_class ) ) {
			unset( $this->mi_class );
		}

		if ( isset( $this->info ) ) {
			unset( $this->info );
		}

		return parent::check();
	}

	function callMILanguage()
	{
		global $mainframe;

		$langPathMI = JPATH_SITE . '/components/com_acctexp/micro_integration/lang/';
		if ( file_exists( $langPathMI . $mainframe->getCfg( 'lang' ) . '.php' ) ) {
			include_once( $langPathMI . $mainframe->getCfg( 'lang' ) . '.php' );
		} else {
			include_once( $langPathMI . 'english.php' );
		}
	}

	function mi_exists( $mi_id )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT count(*)'
				. ' FROM #__acctexp_microintegrations'
				. ' WHERE `id` = \'' . $mi_id . '\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function callDry( $mi_name )
	{
		$this->class_name = $mi_name;

		return $this->callIntegration( true );
	}

	function callIntegration( $override = 0 )
	{
		$filename = JPATH_SITE . '/components/com_acctexp/micro_integration/' . $this->class_name . '.php';

		$file_exists = file_exists( $filename );

		if ( ( ( !$this->active && !empty( $this->id ) ) || !$file_exists ) && !$override ) {
			// MI does not exist or is deactivated
			return false;
		} elseif ( $file_exists ) {
			include_once $filename;

			$class = $this->class_name;

			$this->mi_class = new $class();
			$this->mi_class->id = $this->id;

			$this->getInfo();

			if ( is_null( $this->name ) || ( $this->name == '' ) ) {
				$this->name = $this->info['name'];
			}

			if ( is_null( $this->desc ) || ( $this->desc == '' ) ) {
				$this->desc = $this->info['desc'];
			}

			$this->settings				=& $this->params;
			$this->mi_class->settings	=& $this->settings;

			return true;
		} else {
			return false;
		}
	}

	function action( $metaUser, $exchange=null, $invoice=null, $objplan=null )
	{
		$add = false;

		return $this->relayAction( $metaUser, $exchange, $invoice, $objplan, 'action', $add );
	}

	function pre_expiration_action( $metaUser, $objplan=null )
	{
		if ( method_exists( $this->mi_class, 'pre_expiration_action' ) || method_exists( $this->mi_class, 'relayAction' ) ) {
			$userflags = $metaUser->meta->getMIParams( $this->id, $objplan->id );

			// We need the standard variables and their uppercase pendants
			// System MI vars have to be stored and will automatically converted to uppercase
			$spc	= strtoupper( 'system_preexp_call' );
			$spca	= strtoupper( 'system_preexp_call_abandoncheck' );

			$current_expiration = strtotime( $metaUser->focusSubscription->expiration );

			// Check whether we have userflags to work with
			if ( is_array( $userflags ) && !empty( $userflags ) ) {
				// Check whether flags exist
				if ( isset( $userflags[$spc] ) ) {
					if ( $current_expiration == $userflags[$spc] ) {
						// This is a retrigger as expiration dates are equal => break
						return false;
					} else {
						if ( time() > $current_expiration ) {
							// This trigger comes too late as the expiration already happened => break
							return false;
						}
					}
				}
			}

			$newflags[$spc]		= $current_expiration;
			$newflags[$spca]	= time();

			// Create the new flags
			$metaUser->meta->setMIParams( $this->id, $objplan->id, $newflags );

			$metaUser->meta->storeload();

			$add = false;

			return $this->relayAction( $metaUser, null, null, $objplan, 'pre_expiration_action', $add );
		} else {
			return null;
		}
	}

	function expiration_action( $metaUser, $objplan=null )
	{
		// Needs to be declared as variable due to call by reference
		$add = false;

		// IF ExpireAllInstances=0 AND hasMoreThanOneInstance -> return null
		if ( empty( $this->settings['_aec_global_exp_all'] ) ) {
			if ( $metaUser->getMIcount( $this->id ) > 1 ) {
				// We have more instances than this one attached to the user, pass on.
				return null;
			}
		}

		return $this->relayAction( $metaUser, null, null, $objplan, 'expiration_action', $add );
	}

	function relayAction( &$metaUser, $exchange=null, $invoice=null, $objplan=null, $stage='action', &$add )
	{
		// Exchange Settings
		if ( is_array( $exchange ) && !empty( $exchange ) ) {
			$this->exchangeSettings( $exchange );
		}

		$request = new stdClass();
		$request->action	=	$stage;
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->invoice	=&	$invoice;
		$request->plan		=&	$objplan;

		$request->params	=&	$metaUser->meta->getMIParams( $this->id, $objplan->id );

		if ( $add !== false ) {
			$request->add	=& $add;
		} else {
			$request->add	= null;
		}

		// Call Action
		if ( method_exists( $this->mi_class, 'relayAction' ) ) {
			switch ( $stage ) {
				case 'action':
					$request->area = '';
					break;
				case 'pre_expiration_action':
					$request->area = '_pre_exp';
					break;
				case 'expiration_action':
					$request->area = '_exp';
					break;
				default:
					$request->area = $stage;
					break;
			}

			$return = $this->mi_class->relayAction( $request );
		} elseif ( method_exists( $this->mi_class, $stage ) ) {
			$return = $this->mi_class->$stage( $request );
		} else {
			return null;
			/*$eventlog = new eventLog( $this->_db );
			$eventlog->issue( 'MI application problems', 'mi, problems, '.$this->class_name, 'Action not found: '.$stage, 32 );
			$return = null;*/
		}

		// Gather Errors and Warnings
		$errors = $this->getErrors();
		$warnings = $this->getWarnings();

		if ( ( $errors !== false ) || ( $warnings !== false )  ) {
			$level = 2;
			$error = 'The MI "' . $this->name . '" ('.$this->class_name.') encountered problems.';

			if ( $warnings !== false ) {
				$error .= ' ' . $warnings;
				$level = 32;
			}

			if ( $errors !== false ) {
				$error .= ' ' . $errors;
				$level = 128;
			}

			if ( !empty( $request->invoice->invoice_number ) ) {
				$params = array( 'invoice_number' => $request->invoice->invoice_number );
			} else {
				$params = array();
			}

			$eventlog = new eventLog( $this->_db );
			$eventlog->issue( 'MI application problems', 'mi, problems, '.$this->class_name, $error, $level, $params );
		}

		// If returning fatal error, issue additional entry
		if ( $return === false ) {
			$database = &JFactory::getDBO();

			$error = 'The MI "' . $this->name . '" ('.$this->class_name.') could not be carried out due to errors, plan application was halted';

			$err = $this->_db->getErrorMsg();
			if ( !empty( $err ) ) {
				$error .= ' Last Database Error: ' . $err;
			}

			if ( !empty( $request->invoice->invoice_number ) ) {
				$params = array( 'invoice_number' => $request->invoice->invoice_number );
			} else {
				$params = array();
			}

			$eventlog = new eventLog( $database );
			$eventlog->issue( 'MI application failed', 'mi, failure, '.$this->class_name, $error, 128, $params );
		}

		return $return;
	}

	function getMIform( $plan, $metaUser )
	{
		$params	= $metaUser->meta->getMIParams( $this->id, $plan->id, false );

		$request = new stdClass();
		$request->action	=	'getMIform';
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->plan		=&	$plan;
		$request->params	=&	$params;

		return $this->functionProxy( 'getMIform', $request );
	}

	function verifyMIform( $plan, $metaUser )
	{
		$params	= $metaUser->meta->getMIParams( $this->id, $plan->id, false );

		$request = new stdClass();
		$request->action	=	'verifyMIform';
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->plan		=&	$plan;
		$request->params	=&	$params;

		return $this->functionProxy( 'verifyMIform', $request );
	}

	function getMIformParams( $plan, $metaUser, $errors )
	{
		$mi_form = $this->getMIform( $plan, $metaUser );

		$params	= array();
		$lists	= array();
		if ( !empty( $mi_form ) ) {
			$pref = 'mi_'.$this->id.'_';

			if ( !empty( $mi_form['lists'] ) ) {
				foreach ( $mi_form['lists'] as $lname => $lcontent ) {
					$tempname = $pref.$lname;
					$lists[$tempname] = str_replace( $lname, $tempname, $lcontent );
				}

				unset( $mi_form['lists'] );
			}

			$params[$pref.'remap_area'] = array( 'subarea_change', $this->class_name );

			if ( array_key_exists( $this->id, $errors ) ) {
				$params[] = array( 'divstart', null, null, 'confirmation_error_bg' );
				//$params[] = array( 'h2', $errors[$mi->id] );
			}

			foreach ( $mi_form as $fname => $fcontent ) {
				$params[$pref.$fname] = $fcontent;
			}

			if ( array_key_exists( $this->id, $errors ) ) {
				$params[] = array( 'divend' );
			}
		}

		$params['lists'] = $lists;

		return $params;
	}

	function getErrors()
	{
		if ( !empty( $this->mi_class->error ) ) {
			if ( count( $this->mi_class->error ) > 1 ) {
				$return = 'Error:';
			} else {
				$return = 'Errors:';
			}

			foreach ( $this->mi_class->error as $error ) {
				$return .= ' ' . $error;
			}
		} else {
			return false;
		}

		return $return;
	}

	function getWarnings()
	{
		if ( !empty( $this->mi_class->warning ) ) {
			if ( count( $this->mi_class->warning ) > 1 ) {
				$return = 'Warning:';
			} else {
				$return = 'Warnings:';
			}

			foreach ( $this->mi_class->warning as $warning ) {
				$return .= ' ' . $warning;
			}
		} else {
			return false;
		}

		return $return;
	}

	function aecEventHook( $event )
	{
		if ( empty( $this->mi_class ) ) {
			$this->callIntegration();
		}

		return $this->functionProxy( 'aecEventHook', $event );
	}

	function on_userchange_action( $row, $post, $trace )
	{
		$request = new stdClass();
		$request->parent			=& $this;
		$request->row				=& $row;
		$request->post				=& $post;
		$request->trace				=& $trace;

		return $this->functionProxy( 'on_userchange_action', $request );
	}

	function profile_info( $metaUser )
	{
		$request = new stdClass();
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;

		return $this->functionProxy( 'profile_info', $request );
	}

	function admin_info( $metaUser )
	{
		$request = new stdClass();
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;

		return $this->functionProxy( 'admin_info', $request );
	}

	function profile_form( $metaUser )
	{
		$request = new stdClass();
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->params	=&	$metaUser->meta->getMIParams( $this->id );

		$settings = $this->functionProxy( 'profile_form', $request, array() );

		if ( !empty( $settings ) ) {
			foreach ( $settings as $k => $v ) {
				if ( isset( $request->params[$k] ) && !isset( $v[3] ) ) {
					$settings[$v][3] = $request->params[$k];
				}
			}
		}

		return $settings;
	}

	function profile_form_save( $metaUser )
	{
		$request = new stdClass();
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->params	=&	$metaUser->meta->getMIParams( $this->id );

		return $this->functionProxy( 'profile_form_save', $request );
	}

	function admin_form( $metaUser )
	{
		$request = new stdClass();
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->params	=&	$metaUser->meta->getMIParams( $this->id );

		$settings = $this->functionProxy( 'admin_form', $request, array() );

		if ( !empty( $settings ) ) {
			foreach ( $settings as $k => $v ) {
				if ( isset( $request->params[$k] ) && !isset( $v[3] ) ) {
					$settings[$k][3] = $request->params[$k];
				}
			}
		}

		return $settings;
	}

	function admin_form_save( $metaUser )
	{
		$request = new stdClass();
		$request->parent	=&	$this;
		$request->metaUser	=&	$metaUser;
		$request->params	=&	$metaUser->meta->getMIParams( $this->id );

		return $this->functionProxy( 'admin_form_save', $request );
	}

	function getInfo()
	{
		if ( method_exists( $this->mi_class, 'Info' ) ) {
			$this->info = $this->mi_class->Info();
		} else {
			$nname = strtoupper( '_aec_' . $this->class_name . '_name' );
			$ndesc = strtoupper( '_aec_' . $this->class_name . '_desc' );

			$this->info = array();
			if ( defined( $nname ) && defined( $ndesc ) ) {
				$this->info['name'] = constant( $nname );
				$this->info['desc'] = constant( $ndesc );
			} else {
				$this->info['name'] = 'NONAME';
				$this->info['desc'] = 'NODESC';
			}
		}
	}

	function getGeneralSettings()
	{
		$settings['name']			= array( 'inputC', '' );
		$settings['desc']			= array( 'inputD', '' );
		$settings['active']			= array( 'list_yesno', 1 );
		$settings['auto_check']		= array( 'list_yesno', '' );
		$settings['_aec_global_exp_all']		= array( 'list_yesno', 0 );
		$settings['on_userchange']	= array( 'list_yesno', '' );
		$settings['pre_exp_check']	= array( 'inputB', '' );

		return $settings;
	}

	function getSettings()
	{
		// See whether an install is neccessary (and possible)
		if ( method_exists( $this->mi_class, 'checkInstallation' ) && method_exists( $this->mi_class, 'install' ) ) {
			if ( !$this->mi_class->checkInstallation() ) {
				$this->mi_class->install();
			}
		}

		if ( method_exists( $this->mi_class, 'Settings' ) ) {
			if ( method_exists( $this->mi_class, 'Defaults' ) && empty( $this->settings ) ) {
				$defaults = $this->mi_class->Defaults();
			} else {
				$defaults = array();
			}

			$settings = $this->mi_class->Settings();

			// Autoload Params if they have not been called in by the MI
			foreach ( $settings as $name => $setting ) {
				// Do we have a parameter at first position?
				if ( isset( $setting[1] ) && !isset( $setting[3] ) ) {
					if ( isset( $this->settings[$name] ) ) {
						$settings[$name][3] = $this->settings[$name];
					} elseif( isset( $defaults[$name] ) ) {
						$settings[$name][3] = $defaults[$name];
					}
				} else {
					if ( isset( $this->settings[$name] ) ) {
						$settings[$name][1] = $this->settings[$name];
					} elseif( isset( $defaults[$name] ) ) {
						$settings[$name][1] = $defaults[$name];
					}
				}
			}

			return $settings;
		} else {
			return false;
		}
	}

	function exchangeSettings( $exchange )
	{
		 if ( !empty( $exchange ) ) {
			 foreach ( $exchange as $key => $value ) {
				if( is_string( $value ) ) {
					if ( strcmp( $value, '[[SET_TO_NULL]]' ) === 0 ) {
						// Exception for NULL case
						$this->settings[$key] = null;
					} else {
						$this->settings[$key] = $value;
					}
				} else {
					$this->settings[$key] = $value;
				}
			 }
		 }
	}

	function savePostParams( $array )
	{
		// Strip out params that we don't need
		$params = $this->stripNonParams( $array );

		// Check whether there is a custom function for saving params
		$new_params = $this->functionProxy( 'saveparams', $params, $params );

		$this->name				= $array['name'];
		$this->desc				= $array['desc'];
		$this->active			= $array['active'];
		$this->auto_check		= $array['auto_check'];
		$this->on_userchange	= $array['on_userchange'];
		$this->pre_exp_check	= $array['pre_exp_check'];

		if ( !empty( $new_params['rebuild'] ) ) {
			$database = &JFactory::getDBO();

			$planlist = MicroIntegrationHandler::getPlansbyMI( $this->id );

			foreach ( $planlist as $planid ) {
				$plan = new SubscriptionPlan( $database );
				$plan->load( $planid );

				$userlist = SubscriptionPlanHandler::getPlanUserlist( $planid );
				foreach ( $userlist as $userid ) {
					$metaUser = new metaUser( $userid );

					if ( $metaUser->cmsUser->id ) {
						$this->action( $metaUser, $params, null, $plan );
					}
				}
			}

			$newparams['rebuild'] = 0;
		}

		if ( !empty( $new_params['remove'] ) ) {
			$database = &JFactory::getDBO();

			$planlist = MicroIntegrationHandler::getPlansbyMI( $this->id );

			foreach ( $planlist as $planid ) {
				$plan = new SubscriptionPlan( $database );
				$plan->load( $planid );

				$userlist = SubscriptionPlanHandler::getPlanUserlist( $planid );
				foreach ( $userlist as $userid ) {
					$metaUser = new metaUser( $userid );

					$this->expiration_action( $metaUser, $plan );
				}
			}

			$newparams['remove'] = 0;
		}

		$this->params = $new_params;

		return true;
	}

	function stripNonParams( $array )
	{
		// All variables of the class have to be stripped out
		$vars = get_class_vars( 'microIntegration' );

		foreach ( $vars as $name => $blind ) {
			if ( isset( $array[$name] ) ) {
				unset( $array[$name] );
			}
		}

		return $array;
	}

	function registerProfileTabs()
	{
		if ( method_exists( $this->mi_class, 'registerProfileTabs' ) ) {
			$response = $this->mi_class->registerProfileTabs();
		} else {
			$response = null;
		}

		return $response;
	}

	function customProfileTab( $action, $metaUser )
	{
		if ( empty( $this->settings ) ) {
			$this->getSettings();
		}

		$method = 'customtab_' . $action;

		if ( method_exists( $this->mi_class, $method ) ) {
			$database = &JFactory::getDBO();

			$request = new stdClass();
			$request->parent			=& $this;
			$request->metaUser			=& $metaUser;

			$invoice = new Invoice( $database );
			$invoice->loadbySubscriptionId( $metaUser->objSubscription->id );

			$request->invoice			=& $invoice;


			return $this->mi_class->$method( $request );
		} else {
			return false;
		}
	}

	function delete ()
	{
		// Maybe this function needs special actions on delete?
		// TODO: There should be a way to manage complete deletion of use of an MI type
		if ( method_exists( $this->mi_class, 'delete' ) ){
			$this->mi_class->delete();
		}
	}
}

class couponsHandler extends eucaObject
{
	/** @var bool - Was the cart changed? Needed to signal reload action */
	var $affectedCart		= false;
	/** @var array - Coupons that should not be applied on any later action */
	var $noapplylist		= array();
	/** @var array - List of coupons */
	var $coupons_list		= array();
	/** @var array - Coupons that will be applied to the whole cart */
	var $fullcartlist		= array();
	/** @var array - Global List of coupon mix rules */
	var $mixlist	 		= array();
	/** @var array - Global List of applied coupons */
	var $global_applied 	= array();
	/** @var array - Local List of excluding coupons */
	var $item_applied 		= array();
	/** @var array - Coupons that need to be deleted */
	var $delete_list	 	= array();
	/** @var array - Exceptions that need to be addressed (by the user) */
	var $exceptions			= array();

	function couponsHandler( $metaUser, $InvoiceFactory, $coupons )
	{
		$this->metaUser			=& $metaUser;
		$this->InvoiceFactory	=& $InvoiceFactory;
		$this->coupons			=& $coupons;
	}

	function raiseException( $exception )
	{
		$this->exceptions[] = $exception;
	}

	function getExceptions()
	{
		return $this->exceptions;
	}

	function addCouponToRecord( $itemid, $coupon_code, $ccombo )
	{
		if ( !empty( $ccombo['bad_combinations_cart'] ) ) {
			if ( !empty( $this->mixlist['global']['restrictmix'] ) ) {
				$this->mixlist['global']['restrictmix'] = array_merge( $this->mixlist['global']['restrictmix'], $ccombo['bad_combinations_cart'] );
			} else {
				$this->mixlist['global']['restrictmix'] = $ccombo['bad_combinations_cart'];
			}
		}

		if ( !empty( $ccombo['good_combinations_cart'] ) ) {
			if ( !empty( $this->mixlist['global']['allowmix'] ) ) {
				$this->mixlist['global']['allowmix'] = array_merge( $this->mixlist['global']['allowmix'], $ccombo['good_combinations_cart'] );
			} else {
				$this->mixlist['global']['allowmix'] = $ccombo['good_combinations_cart'];
			}
		}

		$this->global_applied[] = $coupon_code;

		if ( $itemid !== false ) {
			if ( !empty( $ccombo['bad_combinations'] ) ) {
				if ( !empty( $this->mixlist['local'][$itemid]['restrictmix'] ) ) {
					$this->mixlist['local'][$itemid]['restrictmix'] = array_merge( $this->mixlist['local'][$itemid]['restrictmix'], $ccombo['bad_combinations'] );
				} else {
					$this->mixlist['local'][$itemid]['restrictmix'] = $ccombo['bad_combinations'];
				}
			}

			if ( !empty( $ccombo['good_combinations'] ) ) {
				if ( !empty( $this->mixlist['local'][$itemid]['allowmix'] ) ) {
					$this->mixlist['local'][$itemid]['allowmix'] = array_merge( $this->mixlist['local'][$itemid]['allowmix'], $ccombo['good_combinations'] );
				} else {
					$this->mixlist['local'][$itemid]['allowmix'] = $ccombo['good_combinations'];
				}
			}

			$this->item_applied[$itemid][] = $coupon_code;
		}
	}

	function mixCheck( $itemid, $coupon_code, $ccombo )
	{
		// First check whether any other coupon in the cart could block this
		if ( !empty( $this->mixlist['global']['allowmix'] ) ) {
			// Or maybe it just blocks everything?
			if ( !is_array( $this->mixlist['global']['allowmix'] ) ) {
				return false;
			} else {
				// Nope, check which ones it blocks
				if ( !in_array( $coupon_code, $this->mixlist['global']['allowmix'] ) ) {
					return false;
				}
			}
		}

		if ( $itemid !== false ) {
			// Now check whether any other coupon for this item could block this
			if ( !empty( $this->mixlist['local'][$itemid]['allowmix'] ) ) {
				// Or maybe it just blocks everything?
				if ( !is_array( $this->mixlist['local'][$itemid]['allowmix'] ) ) {
					return false;
				} else {
					// Nope, check which ones it blocks
					if ( !in_array( $coupon_code, $this->mixlist['local'][$itemid]['allowmix'] ) ) {
						return false;
					}
				}
			}
		}

		if ( !empty( $this->global_applied ) && !empty( $ccombo['good_combinations_cart'] ) ) {
			// Now check whether any other coupon in the cart could interfere with this ones restrictions
			// Maybe it just blocks everything?
			if ( !is_array( $ccombo['good_combinations_cart'] ) ) {
				return false;
			} else {
				// Nope, check which ones it blocks
				if ( !count( array_intersect( $this->global_applied, $ccombo['good_combinations_cart'] ) ) ) {
					return false;
				}
			}
		}

		if ( $itemid !== false ) {
			if ( !empty( $this->item_applied[$itemid] ) && !empty( $ccombo['good_combinations'] ) ) {
				// Now check whether any other coupon for this item could interfere with this ones restrictions
				// Maybe it just blocks everything?
				if ( !is_array( $ccombo['good_combinations'] ) ) {
					return false;
				} else {
					// Nope, check which ones it blocks
					if ( !count( array_intersect( $this->item_applied[$itemid], $ccombo['good_combinations'] ) ) ) {
						return false;
					}
				}
			}
		}

		// Now check for restrictions the other way around
		if ( !empty( $this->mixlist['global']['restrictmix'] ) && is_array( $this->mixlist['global']['restrictmix'] ) ) {
			if ( in_array( $coupon_code, $this->mixlist['global']['restrictmix'] ) ) {
				return false;
			}
		}

		if ( $itemid !== false ) {
			if ( !empty( $this->mixlist['local'][$itemid]['restrictmix'] ) && is_array( $this->mixlist['local'][$itemid]['restrictmix'] ) ) {
				if ( in_array( $coupon_code, $this->mixlist['local'][$itemid]['restrictmix'] ) ) {
					return false;
				}
			}
		}

		if ( !empty( $this->global_applied ) && !empty( $ccombo['bad_combinations_cart'] ) && is_array( $ccombo['bad_combinations_cart'] ) ) {
			if ( count( array_intersect( $this->global_applied, $ccombo['bad_combinations_cart'] ) ) ) {
				return false;
			}
		}

		if ( $itemid !== false ) {
			if ( !empty( $this->item_applied[$itemid] ) && !empty( $ccombo['bad_combinations'] ) && is_array( $ccombo['bad_combinations'] ) ) {
				if ( count( array_intersect( $this->item_applied[$itemid], $ccombo['bad_combinations'] ) ) ) {
					return false;
				}
			}
		}

		return true;
	}

	function loadCoupon( $coupon_code, $strict=true )
	{
		if ( in_array( $coupon_code, $this->delete_list ) && $strict ) {
			return false;
		}

		$cph = new couponHandler();
		$cph->load( $coupon_code );

		if ( $cph->coupon->coupon_code !== $coupon_code ) {
			$this->setError( "The code entered is not valid" );

			$this->delete_list[] = $coupon_code;
			return false;
		}

		if ( !$cph->status ) {
			$this->setError( $cph->error );

			$this->delete_list[] = $coupon_code;
			return false;
		}

		$this->coupons_list[] = array( 'coupon_code' => $coupon_code/*, 'cph' => $cph*/ );

		$this->cph = $cph;

		return true;
	}

	function applyToCart( $items, $cart=false, $fullcart=false )
	{
		$this->prefilter( $items, $cart, $fullcart );

		foreach ( $items as $iid => $item ) {
			$items[$iid] = $this->applyAllToItems( $iid, $item, $cart );
		}

		return $items;
	}

	function prefilter( $items, $cart=false, $fullcart=false )
	{
		foreach ( $this->coupons as $ccid => $coupon_code ) {
			if ( !$this->loadCoupon( $coupon_code ) ) {
				continue;
			}

			if ( $this->cph->coupon->restrictions['usage_cart_full'] ) {
				$this->fullcartlist[] = $coupon_code;

				if ( !$cart->hasCoupon( $coupon_code ) ) {
					$cart->addCoupon( $coupon_code );
					$cart->storeload();

					$this->affectedCart = true;
				}

				continue;
			}

			$plans = $cart->getItemIdArray();

			if ( $this->cph->coupon->restrictions['usage_plans_enabled'] ) {
				$allowed = array_intersect( $plans, $this->cph->coupon->restrictions['usage_plans'] );

				if ( empty( $allowed ) ) {
					$allowed = false;
				}
			} else {
				$allowed = $plans;
			}

			foreach ( $cart->content as $iid => $c ) {
				if ( $cart->hasCoupon( $coupon_code, $iid ) ) {
					continue 2;
				}
			}

			if ( !is_array( $allowed ) ) {
				continue;
			}

			$fname = 'cartcoupon_'.$ccid.'_item';

			$pgsel = aecGetParam( $fname, null, true, array( 'word', 'int' ) );

			if ( ( count( $allowed ) == 1 ) ) {
				$min = array_shift( array_keys( $allowed ) );

				foreach ( $items as $iid => $item ) {
					if ( $item['obj']->id == $allowed[$min] ) {
						$pgsel = $iid;
					}
				}
			}

			if ( !is_null( $pgsel ) ) {
				$items[$pgsel] == $this->applyToItem( $pgsel, $items[$pgsel], $coupon_code );

				if ( !$cart->hasCoupon( $coupon_code, $pgsel ) ) {
					$cart->addCoupon( $coupon_code, $pgsel );
					$cart->storeload();

					$this->affectedCart = true;
				}
			} else {
				$found = false;
				foreach ( $cart->content as $cid => $content ) {
					if ( $cart->hasCoupon( $coupon_code, $cid ) ) {
						$items[$cid] == $this->applyToItem( $cid, $items[$cid], $coupon_code );
						$found = true;

						$this->noapplylist[] = $coupon_code;
					}
				}

				if ( !$found ) {
					$ex = array();
					$ex['head'] = "Select Item for Coupon \"" . $coupon_code . "\"";
					$ex['desc'] = "The coupon you have entered can be applied to one of the following items:<br />";

					$ex['rows'] = array();

					foreach ( $allowed as $cid => $objid ) {
						if ( empty( $fullcart[$cid]['free'] ) ) {
							$ex['rows'][] = array( 'radio', $fname, $cid, true, $fullcart[$cid]['name'] );
						}
					}

					if ( !empty( $ex['rows'] ) ) {
						$this->raiseException( $ex );
					}
				}
			}
		}
	}

	function applyToItemList( $items )
	{
		foreach ( $items as $iid => $item ) {
			$items[$iid] = $this->applyAllToItems( $iid, $item );
		}

		return $items;
	}

	function applyAllToItems( $id, $item, $cart=false )
	{
		$this->global_applied = array();

		$hasterm = !empty( $item['terms'] );

		if ( $hasterm ) {
			if ( !empty( $item['terms']->terms[0]->type ) ) {
				$termtype = $item['terms']->terms[0]->type;
			} else {
				$termtype = null;
			}
		} else {
			$termtype = null;
		}

		if ( empty( $item['obj'] ) && ( !$hasterm || ( $termtype == "total" ) ) ) {
			// This is the total item - apply total coupons - totally
			foreach ( $this->coupons as $coupon_code ) {
				if ( in_array( $coupon_code, $this->fullcartlist ) ) {
					$item = $this->applyToItem( $id, $item, $coupon_code );
				}
			}
		} else {
			foreach ( $this->coupons as $coupon_code ) {
				if ( in_array( $coupon_code, $this->noapplylist ) ) {
					continue;
				}

				if ( $this->loadCoupon( $coupon_code ) ) {
					if ( $cart != false ) {
						if ( $cart->hasCoupon( $coupon_code, $id ) ) {
							$item = $this->applyToItem( $id, $item, $coupon_code );
						}
					} else {
						$item = $this->applyToItem( $id, $item, $coupon_code );
					}
				}
			}
		}

		$item['terms']->checkFree();

		return $item;
	}

	function applyToItem( $id, $item, $coupon_code )
	{
		if ( !$this->loadCoupon( $coupon_code, false ) ) {
			return $item;
		}

		if ( !empty( $this->item_applied[$id] ) ) {
			if ( in_array( $coupon_code, $this->item_applied[$id] ) ) {
				return $item;
			}
		}

		if ( isset( $item['terms'] ) ) {
			$terms = $item['terms'];
		} elseif ( isset( $item['obj'] ) ) {
			$terms = $item['obj']->getTerms( false, $this->metaUser->focusSubscription, $this->metaUser );
		} elseif ( isset( $item['cost'] ) ) {
			$terms = $item['cost'];
		} else {
			return $item;
		}

		$ccombo		= $this->cph->getCombinations();

		if ( !empty( $item['obj']->id ) ) {
			$this->InvoiceFactory->usage = $item['obj']->id;
		} else {
			$this->InvoiceFactory->usage = null;
		}

		if ( !$this->mixCheck( $id, $coupon_code, $ccombo ) ) {
			$this->setError( _COUPON_ERROR_COMBINATION );
		} else {
			if ( $this->cph->status ) {
				// Coupon approved, checking restrictions
				$r = $this->cph->checkRestrictions( $this->metaUser, $terms, $this->InvoiceFactory->usage );

				if ( $this->cph->status ) {
					$item['terms'] = $this->cph->applyToTerms( $terms, $this->cph );

					$this->addCouponToRecord( $id, $coupon_code, $ccombo );

					return $item;
				} else {
					$this->setError( $this->cph->error );
				}
			}
		}

		$this->delete_list[] = $coupon_code;

		return $item;
	}

	function applyToAmount( $amount, $original_amount=null )
	{
		if ( empty( $this->coupons ) || !is_array( $this->coupons ) ) {
			return $amount;
		}

		foreach ( $this->coupons as $coupon_code ) {
			if ( !$this->loadCoupon( $coupon_code ) ) {
				continue;
			}

			$ccombo	= $this->cph->getCombinations();

			if ( !$this->mixCheck( false, $coupon_code, $ccombo ) ) {
				$this->setError( _COUPON_ERROR_COMBINATION );
			} else {
				if ( $this->cph->status ) {
					// Coupon approved, checking restrictions
					$this->cph->checkRestrictions( $this->metaUser, $amount, $original_amount, $this->InvoiceFactory->usage );

					if ( $this->cph->status ) {
						$amount = $this->cph->applyCoupon( $amount );

						$this->addCouponToRecord( false, $coupon_code, $ccombo );
					}
				}
			}
		}

		$this->setError( $this->cph->error );

		return $amount;
	}

}

class couponHandler
{
	/** @var bool */
	var $status				= null;
	/** @var string */
	var $error				= null;
	/** @var object */
	var $coupon				= null;

	function couponHandler(){}

	function setError( $error )
	{
		// Status = NOT OK
		$this->status = false;
		// Set error message
		$this->error = $error;
	}

	function idFromCode( $coupon_code )
	{
		$database = &JFactory::getDBO();

		$return = array();

		// Get this coupons id from the static table
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_coupons_static'
				. ' WHERE `coupon_code` = \'' . $coupon_code . '\''
				;
		$database->setQuery( $query );
		$couponid = $database->loadResult();

		if ( $couponid ) {
			// Its static, so set type to 1
			$return['type'] = 1;
		} else {
			// Coupon not found, take the regular table
			$query = 'SELECT `id`'
					. ' FROM #__acctexp_coupons'
					. ' WHERE `coupon_code` = \'' . $coupon_code . '\''
					;
			$database->setQuery( $query );
			$couponid = $database->loadResult();

			// Its not static, so set type to 0
			$return['type'] = 0;
		}

		$return['id'] = $couponid;

		return $return;
	}

	function load( $coupon_code )
	{
		$database = &JFactory::getDBO();

		$cc = $this->idFromCode( $coupon_code );

		$this->type = $cc['type'];

		if ( $cc['id'] ) {
			// Status = OK
			$this->status = true;

			// establish coupon object
			$this->coupon = new coupon( $database, $this->type );
			$this->coupon->load( $cc['id'] );

			// Check whether coupon is active
			if ( !$this->coupon->active ) {
				$this->setError( _COUPON_ERROR_EXPIRED );
			}

			// load parameters into local array
			$this->discount		= $this->coupon->discount;
			$this->restrictions = $this->coupon->restrictions;

			// Check whether coupon can be used yet
			if ( $this->restrictions['has_start_date'] && !empty( $this->restrictions['start_date'] ) ) {
				$expstamp = strtotime( $this->restrictions['start_date'] );

				// Error: Use of this coupon has not started yet
				if ( ( $expstamp > 0 ) && ( ( $expstamp-time() ) > 0 ) ) {
					$this->setError( _COUPON_ERROR_NOTSTARTED );
				}
			}

			// Check whether coupon is expired
			if ( $this->restrictions['has_expiration'] ) {
				$expstamp = strtotime( $this->restrictions['expiration'] );

				// Error: Use of this coupon has expired
				if ( ( $expstamp > 0 ) && ( ( $expstamp-time() ) < 0 ) ) {
					$this->setError( _COUPON_ERROR_EXPIRED );
					$this->coupon->deactivate();
				}
			}

			// Check for max reuse
			if ( !empty( $this->restrictions['has_max_reuse'] ) ) {
				if ( !empty( $this->restrictions['max_reuse'] ) ) {
					// Error: Max Reuse of this coupon is exceeded
					if ( (int) $this->coupon->usecount > (int) $this->restrictions['max_reuse'] ) {
						$this->setError( _COUPON_ERROR_MAX_REUSE );
						return;
					}
				}
			}

			// Check for dependency on subscription
			if ( !empty( $this->restrictions['depend_on_subscr_id'] ) ) {
				if ( $this->restrictions['subscr_id_dependency'] ) {
					// See whether this subscription is active
					$query = 'SELECT `status`'
							. ' FROM #__acctexp_subscr'
							. ' WHERE `id` = \'' . $this->restrictions['subscr_id_dependency'] . '\''
							;
					$database->setQuery( $query );

					$subscr_status = strtolower( $database->loadResult() );

					// Error: The Subscription this Coupon depends on has run out
					if ( ( strcmp( $subscr_status, 'active' ) === 0 ) || ( ( strcmp( $subscr_status, 'trial' ) === 0 ) && $this->restrictions['allow_trial_depend_subscr'] ) ) {
						$this->setError( _COUPON_ERROR_SPONSORSHIP_ENDED );
						return;
					}
				}
			}
		} else {
			// Error: Coupon does not exist
			$this->setError( _COUPON_ERROR_NOTFOUND );
		}
	}

	function forceload( $coupon_code )
	{
		$database = &JFactory::getDBO();

		$cc = $this->idFromCode( $coupon_code );

		$this->type = $cc['type'];

		if ( $cc['id'] ) {
			// Status = OK
			$this->status = true;

			// establish coupon object
			$this->coupon = new coupon( $database, $this->type );
			$this->coupon->load( $cc['id'] );
			return true;
		} else {
			return false;
		}
	}

	function switchType()
	{
		$database = &JFactory::getDBO();

		// Duplicate Coupon at other table
		$newcoupon = new coupon( $database, !$this->type );
		$newcoupon->createNew( $this->coupon->coupon_code, $this->coupon->created_date );

		// Switch id over to new table max
		$oldid = $this->coupon->id;
		$newid = $newcoupon->getMax();

		// Delete old coupon
		$this->coupon->delete();

		// Create new entry
		$this->coupon = $newcoupon;

		// Migrate usage entries
		$query = 'UPDATE #__acctexp_couponsxuser'
				. ' SET `coupon_id` = \'' . $newid . '\''
				. ' WHERE `coupon_id` = \'' . $oldid . '\''
				;

		$database->setQuery( $query );
		$database->query();
	}

	function incrementCount( $invoice )
	{
		$database = &JFactory::getDBO();

		// Get existing coupon relations for this user
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_couponsxuser'
				. ' WHERE `userid` = \'' . $invoice->userid . '\''
				. ' AND `coupon_id` = \'' . $this->coupon->id . '\''
				. ' AND `coupon_type` = \'' . $this->type . '\''
				;

		$database->setQuery( $query );
		$id = $database->loadResult();

		$couponxuser = new couponXuser( $database );

		if ( !empty( $id ) ) {
			// Relation exists, update count
			global $mainframe;

			$couponxuser->load( $id );
			$couponxuser->usecount += 1;
			$couponxuser->addInvoice( $invoice->invoice_number );
			$couponxuser->last_updated = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
			$couponxuser->storeload();
		} else {
			// Relation does not exist, create one
			$couponxuser->createNew( $invoice->userid, $this->coupon, $this->type );
			$couponxuser->addInvoice( $invoice->invoice_number );
			$couponxuser->storeload();
		}

		$this->coupon->incrementcount();
	}

	function decrementCount( $invoice )
	{
		$database = &JFactory::getDBO();

		// Get existing coupon relations for this user
		$query = 'SELECT `id`'
				. ' FROM #__acctexp_couponsxuser'
				. ' WHERE `userid` = \'' . $invoice->userid . '\''
				. ' AND `coupon_id` = \'' . $this->coupon->id . '\''
				. ' AND `coupon_type` = \'' . $this->type . '\''
				;

		$database->setQuery( $query );
		$id = $database->loadResult();

		$couponxuser = new couponXuser( $database );

		// Only do something if a relation exists
		if ( $id ) {
			global $mainframe;

			// Decrement use count
			$couponxuser->load( $id );
			$couponxuser->usecount -= 1;
			$couponxuser->last_updated = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );

			if ( $couponxuser->usecount ) {
				// Use count is 1 or above - break invoice relation but leave overall relation intact
				$couponxuser->delInvoice( $invoice->invoice_number );
				$couponxuser->storeload();
			} else {
				// Use count is 0 or below - delete relationship
				$couponxuser->delete();
			}
		}

		$this->coupon->decrementCount();
	}

	function checkRestrictions( $metaUser, $terms=null, $usage=null )
	{
		if ( empty( $metaUser ) ) {
			return false;
		}

		$restrictionHelper = new aecRestrictionHelper();

		// Load Restrictions and resulting Permissions
		$restrictions	= $restrictionHelper->getRestrictionsArray( $this->restrictions );
		$permissions	= $metaUser->permissionResponse( $restrictions );

		// Check for a set usage
		if ( !empty( $this->restrictions['usage_plans_enabled'] ) && !is_null( $usage ) ) {
			if ( !empty( $this->restrictions['usage_plans'] ) ) {
				// Check whether this usage is restricted
				$plans = $this->restrictions['usage_plans'];

				if ( in_array( $usage, $plans ) ) {
					$permissions['usage'] = true;
				} else {
					$permissions['usage'] = false;
				}
			}
		}

		// Check for Trial only
		if ( $this->discount['useon_trial'] && !$this->discount['useon_full'] && is_object( $terms ) ) {
			$permissions['trial_only'] = false;

			if ( $terms->nextterm->type == 'trial' ) {
				$permissions['trial_only'] = true;
			}
		}

		// Check for max reuse per user
		if ( !empty( $this->restrictions['has_max_peruser_reuse'] ) && !empty( $this->restrictions['max_peruser_reuse'] ) ) {
			$used = $metaUser->usedCoupon( $this->coupon->id, $this->type );

			if ( $used == false ) {
				$permissions['max_peruser_reuse'] = true;
			} elseif ( (int) $used  <= (int) $this->restrictions['max_peruser_reuse'] ) {
				// use count was set immediately before, so <= is accurate
				$permissions['max_peruser_reuse'] = true;
			} else {
				$permissions['max_peruser_reuse'] = false;
			}
		}

		// Plot out error messages
		if ( count( $permissions ) ) {
			foreach ( $permissions as $name => $status ) {
				if ( !$status ) {
					$errors = array(	'fixgid'			=> 'permission',
										'mingid'			=> 'permission',
										'maxgid'			=> 'permission',
										'setgid'			=> 'permission',
										'usage'				=> 'wrong_usage',
										'trial_only'		=> 'trial_only',
										'plan_previous'		=> 'wrong_plan_previous',
										'plan_present'		=> 'wrong_plan',
										'plan_overall'		=> 'wrong_plans_overall',
										'plan_amount_min'	=> 'wrong_plan',
										'plan_amount_max'	=> 'wrong_plans_overall',
										'max_reuse'			=> 'max_reuse',
										'max_peruser_reuse'	=> 'max_reuse'
									);

					if ( isset( $errors[$name] ) ) {
						$this->setError( constant( strtoupper( '_coupon_error_' . $errors[$name] ) ) );
					} else {
						$this->status = false;
					}

					return false;
				}
			}
		}

		return true;
	}

	function getInfo( $amount )
	{
		$this->code = $this->coupon->coupon_code;
		$this->name = $this->coupon->name;

		if ( is_array( $amount ) ) {
			$newamount = $this->applyCoupon( $amount['amount'] );
		} else {
			$newamount = $this->applyCoupon( $amount );
		}

		// Load amount or convert amount array to current amount
		if ( is_array( $newamount ) ) {
			if ( isset( $newamount['amount1'] ) ) {
				$this->amount = $newamount['amount1'];
			} elseif ( isset( $newamount['amount2'] ) ) {
				$this->amount = $newamount['amount2'];
			} elseif ( isset( $newamount['amount3'] ) ) {
				$this->amount = $newamount['amount3'];
			}
		} else {
			$this->amount = $newamount;
		}

		// Load amount or convert discount amount array to current amount
		if ( is_array( $newamount ) ) {
			if ( isset( $newamount['amount1'] ) ) {
				$this->discount_amount = $amount['amount']['amount1'] - $newamount['amount1'];
			} elseif ( isset( $newamount['amount2'] ) ) {
				$this->discount_amount = $amount['amount']['amount3'] - $newamount['amount2'];
			} elseif ( isset( $newamount['amount3'] ) ) {
				$this->discount_amount = $amount['amount']['amount3'] - $newamount['amount3'];
			}
		} else {
			$this->discount_amount = $amount['amount'] - $newamount;
		}

		$action = '';

		// Convert chosen rules to user information
		if ( $this->discount['percent_first'] ) {
			if ( $this->discount['amount_percent_use'] ) {
				$action .= '-' . $this->discount['amount_percent'] . '%';
			}
			if ( $this->discount['amount_use'] ) {
				if ( !( $action === '' ) ) {
					$action .= ' &amp; ';
				}
				$action .= '-' . $this->discount['amount'];
			}
		} else {
			if ( $this->discount['amount_use']) {
				$action .= '-' . $this->discount['amount'];
			}
			if ($this->discount['amount_percent_use']) {
				if ( !( $action === '' ) ) {
					$action .= ' &amp; ';
				}
				$action .= '-' . $this->discount['amount_percent'] . '%';
			}
		}

		$this->action = $action;
	}

	function getCombinations()
	{
		$combinations = array();

		$cpl = array( 'bad_combinations', 'good_combinations', 'bad_combinations_cart', 'good_combinations_cart' );

		foreach ( $cpl as $cpn ) {
			if ( strpos( 'bad', $cpn ) !== false ) {
				$cmd = str_replace( "bad", "restrict", $cpn );
			} else {
				$cmd = str_replace( "good", "allow", $cpn );
			}

			if ( !empty( $this->restrictions[$cmd] ) && !empty( $this->restrictions[$cpn] ) ) {
				$combinations[$cpn] = $this->restrictions[$cpn];
			} elseif ( !empty( $this->restrictions[$cmd] ) ) {
				$combinations[$cpn] = true;
			} else {
				$combinations[$cpn] = false;
			}
		}

		return $combinations;
	}

	function applyCoupon( $amount )
	{
		// Distinguish between recurring and one-off payments
		if ( is_array( $amount ) ) {
			// Check for Trial Rules
			if ( isset( $amount['amount1'] ) ) {
				if ( $this->discount['useon_trial'] ) {
					if ( $amount['amount1'] > 0 ) {
						$amount['amount1'] = $this->applyDiscount( $amount['amount1'] );
					}
				}
			}

			// Check for Full Rules
			if ( isset( $amount['amount3'] ) ) {
				if ( $this->discount['useon_full'] ) {
					if ( $this->discount['useon_full_all'] ) {
						$amount['amount3']	= $this->applyDiscount( $amount['amount3'] );
					} else {
						// If we have no trial yet, the one-off discount will be one
						if ( empty( $amount['period1'] ) ) {
							$amount['amount1']	= $this->applyDiscount( $amount['amount3'] );
							$amount['period1']	= $amount['period3'];
							$amount['unit1']	= $amount['unit3'];
						} else {
							if ( $amount['amount1'] > 0 ) {
								// If we already have a trial that costs, we can put the discount on that
								$amount['amount1']	= $this->applyDiscount( $amount['amount1'] );
								$amount['period1']	= $amount['period1'];
								$amount['unit1']	= $amount['unit1'];
							} else {
								// Otherwise we need to create a new period
								// Even in case the user cannot get it - then it will just be skipped anyhow
								$amount['amount2']	= $this->applyDiscount( $amount['amount3'] );
								$amount['period2']	= $amount['period3'];
								$amount['unit2']	= $amount['unit3'];
							}
						}
					}
				}
			}
		} else {
			$amount = $this->applyDiscount( $amount );
		}

		return $amount;
	}

	function applyDiscount( $amount )
	{
		// Apply Discount according to rules
		if ( $this->discount['percent_first'] ) {
			if ( $this->discount['amount_percent_use'] ) {
				$amount -= round( ( ( $amount / 100 ) * $this->discount['amount_percent'] ), 2 );
			}
			if ( $this->discount['amount_use'] ) {
				$amount -= $this->discount['amount'];
			}
		} else {
			if ( $this->discount['amount_use'] ) {
				$amount -= $this->discount['amount'];
			}
			if ( $this->discount['amount_percent_use'] ) {
				$amount -= round( ( ( $amount / 100 ) * $this->discount['amount_percent'] ), 2 );
			}
		}

		$amount = round( $amount, 2 );

		// Fix Amount if broken and return
		return AECToolbox::correctAmount( $amount );
	}

	function applyToTerms( $terms )
	{
		$offset = 0;

		// Only allow application on trial when there is one and the pointer is correct
		if ( $this->discount['useon_trial'] && $terms->hasTrial && ( $terms->pointer == 0 ) ) {
			$offset = 0;
		} elseif( $terms->hasTrial ) {
			$offset = 1;
		}

		$info = array();
		$info['coupon'] = $this->coupon->coupon_code;

		$initcount = count( $terms->terms );

		for ( $i = $offset; $i < $initcount; $i++ ) {
			if ( !$this->discount['useon_full'] && ( $i > 0 ) ) {
				continue;
			}

			if ( !$this->discount['useon_full_all'] && ( $i < $initcount ) ) {
				// Duplicate current term
				$terms->addTerm( clone( $terms->terms[$i] ) );
			}

			if ( $this->discount['percent_first'] ) {
				if ( $this->discount['amount_percent_use'] ) {
					$info['details'] = '-' . $this->discount['amount_percent'] . '%';
					$terms->terms[$i]->discount( null, $this->discount['amount_percent'], $info );
				}
				if ( $this->discount['amount_use'] ) {
					$info['details'] = null;
					$terms->terms[$i]->discount( $this->discount['amount'], null, $info );
				}
			} else {
				if ( $this->discount['amount_use'] ) {
					$info['details'] = null;
					$terms->terms[$i]->discount( $this->discount['amount'], null, $info );
				}
				if ( $this->discount['amount_percent_use'] ) {
					$info['details'] = '-' . $this->discount['amount_percent'] . '%';
					$terms->terms[$i]->discount( null, $this->discount['amount_percent'], $info );
				}
			}
		}

		$terms->checkFree();

		return $terms;
	}
}

class coupon extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $active				= null;
	/** @var int */
	var $ordering			= null;
	/** @var string */
	var $coupon_code		= null;
	/** @var datetime */
	var $created_date 		= null;
	/** @var string */
	var $name				= null;
	/** @var string */
	var $desc				= null;
	/** @var text */
	var $discount			= null;
	/** @var text */
	var $restrictions		= null;
	/** @var text */
	var $params				= null;
	/** @var int */
	var $usecount			= null;
	/** @var text */
	var $micro_integrations	= null;

	function coupon( &$db, $type )
	{
		if ( $type ) {
			parent::__construct( '#__acctexp_coupons_static', 'id', $db );
		} else {
			parent::__construct( '#__acctexp_coupons', 'id', $db );
		}
	}

	function declareParamFields()
	{
		return array( 'discount', 'restrictions', 'params', 'micro_integrations'  );
	}

	function deactivate()
	{
		$this->active = 0;
		$this->storeload();
	}

	function createNew( $code=null, $created=null )
	{
		$this->id		= 0;
		$this->active	= 1;
		// Override creation of new Coupon Code if one is supplied
		if ( is_null( $code ) ) {
			$this->coupon_code = $this->generateCouponCode();
		} else {
			$this->coupon_code = $code;
		}
		// Set created date if supplied
		if ( is_null( $created ) ) {
			global $mainframe;

			$this->created_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		} else {
			$this->created_date = $created;
		}
		$this->usecount = 0;
	}

	function savePOSTsettings( $post )
	{
		if ( !empty( $post['coupon_code'] ) ) {
			$query = 'SELECT `id`'
					. ' FROM #__acctexp_coupons_static'
					. ' WHERE `coupon_code` = \'' . $post['coupon_code'] . '\''
					;
			$this->_db->setQuery( $query );
			$couponid = $this->_db->loadResult();

			if ( empty( $couponid ) ) {
				$query = 'SELECT `id`'
						. ' FROM #__acctexp_coupons'
						. ' WHERE `coupon_code` = \'' . $post['coupon_code'] . '\''
						;
				$this->_db->setQuery( $query );
				$couponid = $this->_db->loadResult();
			}

			if ( !empty( $couponid ) && ( $couponid !== $this->id ) ) {
				$post['coupon_code'] = $this->generateCouponCode();
			}
		}

		// Filter out fixed variables
		$fixed = array( 'active', 'name', 'desc', 'coupon_code', 'usecount', 'micro_integrations' );

		foreach ( $fixed as $varname ) {
			$this->$varname = $post[$varname];
			unset( $post[$varname] );
		}

		// Filter out params
		$fixed = array( 'amount_use', 'amount', 'amount_percent_use', 'amount_percent', 'percent_first', 'useon_trial', 'useon_full', 'useon_full_all' );

		$params = array();
		foreach ( $fixed as $varname ) {
			if ( !isset( $post[$varname] ) ) {
				continue;
			}

			$params[$varname] = $post[$varname];
			unset( $post[$varname] );
		}

		$this->saveDiscount( $params );

		// the rest is restrictions
		$this->saveRestrictions( $post );
	}

	function saveDiscount( $params )
	{
		// Correct a malformed Amount
		if ( !strlen( $params['amount'] ) ) {
			$params['amount_use'] = 0;
		} else {
			$params['amount'] = AECToolbox::correctAmount( $params['amount'] );
		}

		$this->discount = $params;
	}

	function saveRestrictions( $restrictions )
	{
		$this->restrictions = $restrictions;
	}

	function incrementCount()
	{
		$this->usecount += 1;
		$this->storeload();
	}

	function decrementCount()
	{
		$this->usecount -= 1;
		$this->storeload();
	}

	function generateCouponCode( $maxlength = 6 )
	{
		$database = &JFactory::getDBO();

		$numberofrows = 1;

		while ( $numberofrows ) {
			$inum =	strtoupper( substr( base64_encode( md5( rand() ) ), 0, $maxlength ) );
			// check single coupons
			$query = 'SELECT count(*)'
					. ' FROM #__acctexp_coupons'
					. ' WHERE `coupon_code` = \'' . $inum . '\''
					;
			$database->setQuery( $query );
			$numberofrows_normal = $database->loadResult();

			// check static coupons
			$query = 'SELECT count(*)'
					. ' FROM #__acctexp_coupons_static'
					. ' WHERE `coupon_code` = \'' . $inum . '\''
					;
			$database->setQuery( $query );
			$numberofrows_static = $database->loadResult();

			$numberofrows = $numberofrows_normal + $numberofrows_static;
		}
		return $inum;
	}
}

class couponXuser extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $coupon_id			= null;
	/** @var int */
	var $coupon_type		= null;
	/** @var string */
	var $coupon_code		= null;
	/** @var int */
	var $userid				= null;
	/** @var datetime */
	var $created_date 		= null;
	/** @var datetime */
	var $last_updated		= null;
	/** @var text */
	var $params				= null;
	/** @var int */
	var $usecount			= null;

	function couponXuser( &$db )
	{
		parent::__construct( '#__acctexp_couponsxuser', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'params'  );
	}

	function createNew( $userid, $coupon, $type, $params=null )
	{
		global $mainframe;

		$this->id = 0;
		$this->coupon_id = $coupon->id;
		$this->coupon_type = $type;
		$this->coupon_code = $coupon->coupon_code;
		$this->userid = $userid;
		$this->created_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->last_updated = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );

		if ( is_array( $params ) ) {
			$this->params = $params;
		}

		$this->usecount = 1;

		$this->storeload();
	}

	function getInvoiceList()
	{
		$invoicelist = array();
		if ( isset( $this->params['invoices'] ) ) {
			$invoices = explode( ';', $this->params['invoices'] );

			foreach ( $invoices as $invoice ) {
				$inv = explode( ',', $invoice );

				if ( isset( $invoice[1] ) ) {
					$invoicelist[$invoice[0]] = $invoice[1];
				} else {
					$invoicelist[$invoice[0]] = 1;
				}
			}
		}

		return $invoicelist;
	}

	function setInvoiceList( $invoicelist )
	{
		$invoices = array();

		foreach ( $invoicelist as $invoicenumber => $counter ) {
			$invoices[] = $invoicenumber . ',' . $counter;
		}

		$params['invoices'] = implode( ';', $invoices );

		$this->addParams( $params );
	}

	function addInvoice( $invoicenumber )
	{
		$invoicelist = $this->getInvoiceList();

		if ( isset( $invoicelist[$invoicenumber] ) ) {
			$invoicelist[$invoicenumber] += 1;
		} else {
			$invoicelist[$invoicenumber] = 1;
		}

		$this->setInvoiceList( $invoicelist );
	}

	function delInvoice( $invoicenumber )
	{
		$invoicelist = $this->getInvoiceList();

		if ( isset( $invoicelist[$invoicenumber] ) ) {
			$invoicelist[$invoicenumber] -= 1;

			if ( $invoicelist[$invoicenumber] === 0 ) {
				unset( $invoicelist[$invoicenumber] );
			}
		}

		$this->setInvoiceList( $invoicelist );
	}
}

class aecExport extends serialParamDBTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $system				= null;
	/** @var string */
	var $name				= null;
	/** @var datetime */
	var $created_date 		= null;
	/** @var datetime */
	var $lastused_date 		= null;
	/** @var text */
	var $filter				= null;
	/** @var text */
	var $options			= null;
	/** @var text */
	var $params				= null;

	function aecExport( &$db )
	{
		parent::__construct( '#__acctexp_export', 'id', $db );
	}

	function declareParamFields()
	{
		return array( 'filter', 'options', 'params'  );
	}

	function useExport()
	{
		global $mainframe;

		// Load Exporting Class
		$filename = JPATH_SITE . '/components/com_acctexp/lib/export/' . $this->params->export_method . '.php';
		$classname = 'AECexport_' . $this->params->export_method;

		include_once( $filename );

		$exphandler = new $classname();

		$fname = 'aecexport_' . urlencode( stripslashes( $this->name ) ) . '_' . date( 'Y_m_d', time() + $mainframe->getCfg( 'offset' ) *3600 );

		// Send download header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");

		header("Content-Type: application/download");
		header('Content-Disposition: inline; filename="' . $fname . '.csv"');

		// Assemble Database call
		$where = array();
		if ( !empty( $this->filter->planid ) ) {
			$where[] = '`plan` IN (' . implode( ',', $this->filter->planid ) . ')';
		}

		$query = 'SELECT a.id, a.userid'
				. ' FROM #__acctexp_subscr AS a'
				. ' INNER JOIN #__users AS b ON a.userid = b.id';

		if ( !empty( $where ) ) {
			$query .= ' WHERE ( ' . implode( ' OR ', $where ) . ' )';
		}

		if ( !empty( $this->filter->status ) ) {
			$stati = array();
			foreach ( $this->filter->status as $status ) {
				$stati[] = 'LOWER( `status` ) = \'' . strtolower( $status ) . '\'';
			}

			if ( !empty( $where ) ) {
				$query .= ' AND (' . implode( ' OR ', $stati ) . ')';
			} else {
				$query .= ' WHERE (' . implode( ' OR ', $stati ) . ')';
			}
		}

		if ( !empty( $this->filter->orderby ) ) {
			$query .= ' ORDER BY ' . $this->filter->orderby . '';
		}

		$this->_db->setQuery( $query );

		// Fetch Userlist
		$userlist = $this->_db->loadObjectList();

		// Plans Array
		$plans = array();

		// Iterate through userlist
		if ( !empty( $userlist ) ) {
			foreach ( $userlist as $entry ) {
				$metaUser = new metaUser( $entry->userid );
				$metaUser->moveFocus( $entry->id );

				$planid = $metaUser->focusSubscription->plan;

				if ( !isset( $plans[$planid] ) ) {
					$plans[$planid] = new SubscriptionPlan( $this->_db );
					$plans[$planid]->load( $planid );
				}

				$line = AECToolbox::rewriteEngine( $this->options->rewrite_rule, $metaUser, $plans[$planid] );
				$larray = explode( ';', $line );

				// Remove whitespaces and newlines
				foreach( $larray as $larrid => $larrval ) {
					$larray[$larrid] = trim($larrval);
				}

				echo $exphandler->export_line( $larray );
			}
		}

		$this->setUsedDate();
		exit;
	}

	function setUsedDate()
	{
		global $mainframe;

		$this->lastused_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		$this->storeload();
	}

	function save( $name, $filter, $options, $params, $system=false )
	{
		global $mainframe;

		// Drop old system saves to always keep 10 records
		if ( $system ) {
			$query = 'SELECT count(*) '
					. ' FROM #__acctexp_export'
					. ' WHERE `system` = \'1\''
					;
			$this->_db->setQuery( $query );
			$sysrows = $this->_db->loadResult();

			if ( $sysrows > 9 ) {
				$query = 'DELETE'
						. ' FROM #__acctexp_export'
						. ' WHERE `system` = \'1\''
						. ' ORDER BY `id` ASC'
						. ' LIMIT 1'
						;
				$this->_db->setQuery( $query );
				$this->_db->query();
			}
		}

		$this->name = $name;
		$this->system = $system ? 1 : 0;
		$this->filter = $filter;
		$this->options = $options;
		$this->params = $params;

		if ( ( strcmp( $this->created_date, '0000-00-00 00:00:00' ) === 0 ) || empty( $this->created_date ) ) {
			$this->created_date = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg( 'offset' ) *3600 );
		}

		$this->storeload();
	}

}

class aecReadout
{

	function aecReadout( $optionlist, $method )
	{
		$this->optionlist = $optionlist;
		$this->method = "conversionHelper" . strtoupper( $method );

		$this->lists = array();

		if ( aecJoomla15check() ) {
			$acl =& JFactory::getACL();

			$this->acllist = $acl->get_group_children( 28 );
		} else {
			global $acl;

			$this->acllist = $acl->_getBelow( '#__core_acl_aro_groups', 'g1.group_id, g1.name, COUNT(g2.name) AS level', 'g1.name', null, 'USERS', true );

		}

		foreach ( $this->acllist as $aclitem ) {
			$this->lists['gid'][$aclitem->group_id] = $aclitem->name;
		}

		$this->planlist = SubscriptionPlanHandler::getFullPlanList();

		foreach ( $this->planlist as $planitem ) {
			$this->lists['plan'][$planitem->id] = $planitem->name;
		}

		$this->milist = microIntegrationHandler::getMIList( null, null, isset( $_POST['use_ordering'] ), true );

		foreach ( $this->milist as $miitem ) {
			$this->lists['mi'][$miitem->id] = $miitem->name;
		}
	}

	function conversionHelper( $content, $obj )
	{
		return $this->{$this->method}( $content, $obj );
	}

	function readSettings()
	{
		global $aecConfig;

		$r = array();
		$r['head'] = "Settings";
		$r['type'] = "table";

		$setdef = Config_General::paramsList();

		$r['def'] = array();
		foreach ( $setdef as $sd => $sdd ) {
			if ( ( $sdd === 0 ) || ( $sdd === 1 ) ) {
				$tname = str_replace( ':', '', constant( '_CFG_GENERAL_' . strtoupper( $sd ) . '_NAME' ) );

				$r['def'][$tname] = array( $sd, 'bool' );
			}
		}

		$r['set'][] = $aecConfig->cfg;

		if ( !empty( $_POST['show_extsettings'] ) ) {
			$readout[] = $r;

			unset($r);

			$r['head'] = "";
			$r['type'] = "table";

			$setdef = Config_General::paramsList();

			$r['def'] = array();
			foreach ( $setdef as $sd => $sdd ) {
				if ( ( $sdd !== 0 ) && ( $sdd !== 1 ) ) {
					$reg = array( 'GENERAL', 'MI' );

					foreach ( $reg as $regg ) {
						$cname = '_CFG_' . $regg . '_' . strtoupper( $sd ) . '_NAME';

						if ( defined( $cname ) )  {
							$tname = str_replace( ':', '', constant( $cname ) );
						}
					}

					$r['def'][$tname] = array( $sd );
				}
			}

			$r['set'][] = $aecConfig->cfg;
		}

		$readout[] = $r;

		return $readout;
	}

	function readProcessors()
	{
		$database = &JFactory::getDBO();

		$readout = array();

		$r = array();
		$r['head'] = "Processors";

		$processors = PaymentProcessorHandler::getInstalledNameList();

		foreach ( $processors as $procname ) {
			$pp = null;
			$pp = new PaymentProcessor( $database );

			if ( !$pp->loadName( $procname ) ) {
				continue;
			}

			$pp->fullInit();

			$readout[] = $r;

			$r = array();

			$r['head'] = $pp->info['longname'];
			$r['type'] = "table";
			$r['sub'] = true;

			$r['def'] = array (
				"ID" => array( 'id' ),
				"Published" => array( 'active', 'bool' )
			);

			foreach ( $pp->info as $iname => $ic ) {
				if ( empty( $iname ) ) {
					continue;
				}

				$cname = '_CFG_' . strtoupper( $procname ) . '_' . strtoupper($iname) . '_NAME';
				$gname = '_CFG_PROCESSOR_' . strtoupper($iname) . '_NAME';

				if ( defined( $cname ) )  {
					$tname = constant( $cname );
				} elseif ( defined( $gname ) )  {
					$tname = constant( $gname );
				} else {
					$tname = $iname;
				}

				$r['def'][$tname] = array( array( 'info', $iname ), 'smartlimit' );
			}

			$bsettings = $pp->getBackendSettings();

			foreach ( $bsettings as $psname => $sc ) {
				if ( empty( $psname ) || is_numeric( $psname ) || ( $psname == 'lists') ) {
					continue;
				}

				$cname = '_CFG_' . strtoupper( $procname ) . '_' . strtoupper($psname) . '_NAME';
				$gname = '_CFG_PROCESSOR_' . strtoupper($psname) . '_NAME';

				if ( defined( $cname ) )  {
					$tname = constant( $cname );
				} elseif ( defined( $gname ) )  {
					$tname = constant( $gname );
				} else {
					$tname = $psname;
				}

				if ( $sc[0] == 'list_yesno' ) {
					$stype = 'bool';
				} else {
					$stype = 'smartlimit';
				}

				$r['def'][$tname] = array( array( 'settings', $psname ), $stype );
			}

			$ps = array();
			foreach ( $r['def'] as $nn => $def ) {
				$ps = array_merge( $ps, $this->conversionHelper( $def, $pp ) );
			}

			$r['set'] = array( 0 => $ps );
		}

		$readout[] = $r;

		return $readout;
	}

	function readPlans()
	{
		$database = &JFactory::getDBO();

		$r = array();
		$r['head'] = "Payment Plans";
		$r['type'] = "table";

		$r['def'] = array (
			"ID" => array( 'id' ),
			"Published" => array( 'active', 'bool' ),
			"Visible" => array( 'visible', 'bool' ),
			"Name" => array( 'name', 'smartlimit haslink', 'editSubscriptionPlan', 'id' ),
			"Desc" => array( 'desc', 'notags smartlimit' ),
			"Primary" => array( array( 'params', 'make_primary' ), 'bool' ),
			"Activate" => array( array( 'params', 'make_active' ), 'bool' ),
			"Update Exist." => array( array( 'params', 'update_existing' ), 'bool' ),
			"Override Activat." => array( array( 'params', 'override_activation' ), 'bool' ),
			"Override Reg. Email" => array( array( 'params', 'override_regmail' ), 'bool' ),
			"Set GID" => array( array( 'params', 'gid_enabled' ), 'bool' ),
			"GID" => array( array( 'params', 'list', 'gid' ), 'list', 'gid' ),

			"Standard Parent Plan" => array( array( 'params', 'standard_parent' ), 'list', 'plan' ),
			"Fallback Plan" => array( array( 'params', 'fallback' ), 'list', 'plan' ),

			"Free" => array( array( 'params', 'full_free' ), 'bool' ),
			"Cost" => array( array( 'params', 'full_amount' ) ),
			"Lifetime" => array( array( 'params', 'lifetime' ), 'bool' ),
			"Period" => array( array( 'params', 'full_period' ) ),
			"Unit" => array( array( 'params', 'full_periodunit' ) ),

			"Free Trial" => array( array( 'params', 'trial_free' ), 'bool' ),
			"Trial Cost" => array( array( 'params', 'trial_amount' ) ),
			"Trial Period" => array( array( 'params', 'trial_period' ) ),
			"Trial Unit" => array( array( 'params', 'trial_periodunit' ) ),

			"Has MinGID" => array( array( 'restrictions', 'mingid_enabled' ), 'bool' ),
			"MinGID" => array( array( 'restrictions', 'mingid' ), 'list', 'gid' ),
			"Has FixGID" => array( array( 'restrictions', 'fixgid_enabled' ), 'bool' ),
			"FixGID" => array( array( 'restrictions', 'fixgid' ), 'list', 'gid' ),
			"Has MaxGID" => array( array( 'restrictions', 'fixgid_enabled' ), 'bool' ),
			"MaxGID" => array( array( 'restrictions', 'fixgid' ), 'list', 'gid' ),

			"Requires Prev. Plan" => array( array( 'restrictions', 'previousplan_req_enabled' ), 'bool' ),
			"Prev. Plan" => array( array( 'restrictions', 'previousplan_req' ), 'list', 'plan' ),
			"Excluding Prev. Plan" => array( array( 'restrictions', 'previousplan_req_enabled_excluded' ), 'bool' ),
			"Excl. Prev. Plan" => array( array( 'restrictions', 'previousplan_req_excluded' ), 'list', 'plan' ),
			"Requires Curr. Plan" => array( array( 'restrictions', 'currentplan_req_enabled' ), 'bool' ),
			"Curr. Plan" => array( array( 'restrictions', 'currentplan_req' ), 'list', 'plan' ),
			"Excluding Curr. Plan" => array( array( 'restrictions', 'currentplan_req_enabled_excluded' ), 'bool' ),
			"Excl. Curr. Plan" => array( array( 'restrictions', 'currentplan_req_excluded' ), 'list', 'plan' ),
			"Requires Overall Plan" => array( array( 'restrictions', 'overallplan_req_enabled' ), 'bool' ),
			"Overall Plan" => array( array( 'restrictions', 'overallplan_req' ), 'list', 'plan' ),
			"Excluding Overall. Plan" => array( array( 'restrictions', 'overallplan_req_enabled_excluded' ), 'bool' ),
			"Excl. Overall. Plan" => array( array( 'restrictions', 'overallplan_req_excluded' ), 'list', 'plan' ),

			"Min Used Plan" => array( array( 'restrictions', 'used_plan_min_enabled' ), 'bool' ),
			"Min Used Plan Amount" => array( array( 'restrictions', 'used_plan_min_amount' ) ),
			"Min Used Plans" => array( array( 'restrictions', 'used_plan_min' ), 'list', 'plan' ),
			"Max Used Plan" => array( array( 'restrictions', 'used_plan_max_enabled' ), 'bool' ),
			"Max Used Plan Amount" => array( array( 'restrictions', 'used_plan_max_amount' ) ),
			"Max Used Plans" => array( array( 'restrictions', 'used_plan_max' ), 'list', 'plan' ),

			"Custom Restrictions" => array( array( 'restrictions', 'custom_restrictions_enabled' ), 'bool' ),
			"Restrictions" => array( array( 'restrictions', 'custom_restrictions' ) )
		);

		$plans = SubscriptionPlanHandler::getPlanList( null, null, isset( $_POST['use_ordering'] ) );

		$r['set'] = array();
		foreach ( $plans as $planid ) {
			$plan = new SubscriptionPlan( $database );
			$plan->load( $planid );

			$ps = array();
			foreach ( $r['def'] as $nn => $def ) {
				$ps = array_merge( $ps, $this->conversionHelper( $def, $plan ) );
			}

			$r['set'][] = $ps;
		}

		return $r;
	}

	function readPlanMIrel()
	{
		$database = &JFactory::getDBO();

		$r = array();
		$r['head'] = "Payment Plan - MicroIntegration relationships";
		$r['type'] = "table";

		$r['def'] = array (
			"ID" => array( 'id' ),
			"Published" => array( 'active', 'bool' ),
			"Visible" => array( 'visible', 'bool' ),
			"Name" => array( 'name', 'smartlimit' )
		);

		$micursor = '';
		$mis = array();
		foreach ( $this->milist as $miobj ) {
			$mi = new microIntegration( $database );
			$mi->load( $miobj->id );
			if ( !$mi->callIntegration() ) {
				continue;
			}

			if ( $miobj->class_name != $micursor ) {
				if ( !empty( $mi->info ) ) {
					$miname = $mi->info['name'];
				} else {
					$miname = $miobj->class_name;
				}
				$r['def'][$miname] = array( $miobj->class_name, 'list', 'mi' );

				$micursor = $miobj->class_name;
			}

			$mis[$mi->id] = array( $miobj->class_name, $mi->name );
		}

		$r['set'] = array();
		foreach ( $this->planlist as $planid => $planobj ) {
			$plan = new SubscriptionPlan( $database );
			$plan->load( $planobj->id );

			if ( !empty( $plan->micro_integrations ) ) {
				foreach ( $plan->micro_integrations as $pmi ) {
					if ( isset( $mis[$pmi] ) ) {
						$plan->{$mis[$pmi][0]}[] = $pmi;
					}
				}
			}

			$ps = array();
			foreach ( $r['def'] as $nn => $def ) {
				$ps = array_merge( $ps, $this->conversionHelper( $def, $plan ) );
			}

			$r['set'][] = $ps;
		}

		return $r;
	}

	function readMIs()
	{
		$database = &JFactory::getDBO();

		$r = array();
		$r['head'] = "Micro Integration";
		$r['type'] = "";

		$micursor = '';
		foreach ( $this->milist as $miobj ) {
			$mi = new microIntegration( $database );
			$mi->load( $miobj->id );
			$mi->callIntegration(true);

			if ( $miobj->class_name != $micursor ) {
				$readout[] = $r;
				unset($r);
				$r = array();
				if ( !empty( $mi->info ) ) {
					$r['head'] = $mi->info['name'];
				} else {
					$r['head'] = $miobj->class_name;
				}
				$r['type'] = "table";
				$r['sub'] = true;
				$r['set'] = array();

				$r['def'] = array (
					"ID" => array( 'id' ),
					"Published" => array( 'active', 'bool' ),
					"Visible" => array( 'visible', 'bool' ),
					"Name" => array( 'name', 'smartlimit haslink', 'editMicroIntegration', 'id' ),
					"Desc" => array( 'desc', 'notags smartlimit' ),
					"Exp Action" => array( 'auto_check', 'bool' ),
					"PreExp Action" => array( 'pre_exp_check' ),
					"UserChange Action" => array( 'on_userchange', 'bool' )
					);

				$settings = $mi->getSettings();

				if ( isset( $settings['lists'] ) ) {
					unset( $settings['lists'] );
				}

				if ( !empty( $settings ) ) {
					foreach ( $settings as $sname => $setting ) {
						$name =  '_MI_' . strtoupper( $miobj->class_name ) . '_' . strtoupper( $sname ) .'_NAME';

						if ( defined( $name ) ) {
							$r['def'][constant($name)] = array( array( 'settings', $sname ), 'notags smartlimit' );
						} else {
							$r['def'][$sname] = array( array( 'settings', $sname ), 'notags smartlimit' );
						}
					}
				}
			}

			$ps = array();
			foreach ( $r['def'] as $nn => $def ) {
				$ps = array_merge( $ps, $this->conversionHelper( $def, $mi ) );
			}

			$r['set'][] = $ps;

			$micursor = $miobj->class_name;
		}

		$readout[] = $r;

		return $readout;
	}

	function conversionHelperHTML( $content, $obj )
	{
		$cc = $content[0];

		if ( is_array( $cc ) ) {
			$dname = $cc[0].'_'.$cc[1];
			if ( !isset( $obj->{$cc[0]}[$cc[1]] ) ) {
				return array( $dname => '' );
			}
			$dvalue = $obj->{$cc[0]}[$cc[1]];
		} else {
			$dname = $cc;
			if ( !isset( $obj->{$cc} ) ) {
				return array( $dname => '' );
			}
			$dvalue = $obj->{$cc};
		}

		if ( isset( $content[1] ) ) {
			$type = $content[1];
		} else {
			$type = null;
		}

		if ( isset( $_POST['noformat_newlines'] ) ) {
			$nnl = ', ';
		} else {
			$nnl = ',<br />';
		}

		if ( !empty( $type ) ) {
			$types = explode( ' ', $type );

			foreach ( $types as $tt ) {
				switch ( $tt ) {
					case 'notags':
						$dvalue = strip_tags( $dvalue );
						break;
					case 'limit32':
						$dvalue = substr( $dvalue, 0, 32 );
						break;
					case 'smartlimit':
						if ( isset( $_POST['truncation_length'] ) ) {
							$truncation = $_POST['truncation_length'];
						} else {
							$truncation = 42;
						}

						if ( $truncation > 12 ) {
							$tls = 12;
						} else {
							$tls = $truncation/2;
						}

						if ( is_array( $dvalue ) ) {
							$vv = array();
							foreach ( $dvalue as $val ) {
								if ( strlen( $val ) > $truncation ) {
									$vv[] = substr( $val, 0, $truncation-$tls ) . '<strong>[...]</strong>' . substr( $val, -$tls, $tls );
								} else {
									$vv[] = $val;
								}
							}
							$dvalue = implode( $nnl, $vv );
						} else {
							if ( strlen( $dvalue ) > $truncation ) {
								$dvalue = substr( $dvalue, 0, $truncation-$tls ) . '<strong>[...]</strong>' . substr( $dvalue, -$tls, $tls );
							}
						}
						break;
					case 'list':
						if ( is_array( $dvalue ) ) {
							$vv = array();
							foreach ( $dvalue as $val ) {
								if ( $val == 0 ) {
									$vv[] = '--';
								} else {
									$vv[] = "#" . $val . ":&nbsp;<strong>" . $this->lists[$content[2]][$val] . "</strong>";
								}
							}
							$dvalue = implode( $nnl, $vv );
						} else {
							if ( $dvalue == 0 ) {
								$dvalue = '--';
							} else {
								$dvalue = "#" . $dvalue . ":&nbsp;<strong>" . $this->lists[$content[2]][$dvalue] . "</strong>";
							}
						}
						break;
					case 'haslink':
						if ( isset( $content[3] ) ) {
							$tasklink = $content[2] . "&amp;" . $content[3] . "=" . $obj->{$content[3]};
							$dvalue = AECToolbox::backendTaskLink( $tasklink, $dvalue );
						} else {
							$dvalue = AECToolbox::backendTaskLink( $content[2], $dvalue );
						}
						break;
				}
			}
		}

		return array( $dname => $dvalue );
	}

	function conversionHelperCSV( $content, $obj )
	{
		$cc = $content[0];

		if ( is_array( $cc ) ) {
			$dname = $cc[0].'_'.$cc[1];
			if ( !isset( $obj->{$cc[0]}[$cc[1]] ) ) {
				return array( $dname => '' );
			}
			$dvalue = $obj->{$cc[0]}[$cc[1]];
		} else {
			$dname = $cc;
			if ( !isset( $obj->{$cc} ) ) {
				return array( $dname => '' );
			}
			$dvalue = $obj->{$cc};
		}

		if ( isset( $content[1] ) ) {
			$type = $content[1];
		} else {
			$type = null;
		}

		if ( isset( $_POST['noformat_newlines'] ) ) {
			$nnl = ', ';
		} else {
			$nnl = ',' . "\n";
		}

		if ( !empty( $type ) ) {
			$types = explode( ' ', $type );

			foreach ( $types as $tt ) {
				switch ( $tt ) {
					case 'notags':
						$dvalue = strip_tags( $dvalue );
						break;
					case 'limit32':
						$dvalue = substr( $dvalue, 0, 32 );
						break;
					case 'smartlimit':
						if ( isset( $_POST['truncation_length'] ) ) {
							$truncation = $_POST['truncation_length'];
						} else {
							$truncation = 42;
						}

						if ( $truncation > 12 ) {
							$tls = 12;
						} else {
							$tls = $truncation/2;
						}

						if ( is_array( $dvalue ) ) {
							$vv = array();
							foreach ( $dvalue as $val ) {
								if ( strlen( $val ) > $truncation ) {
									$vv[] = substr( $val, 0, $truncation-$tls ) . '[...]' . substr( $val, -$tls, $tls );
								} else {
									$vv[] = $val;
								}
							}
							$dvalue = implode( $nnl, $vv );
						} else {
							if ( strlen( $dvalue ) > $truncation ) {
								$dvalue = substr( $dvalue, 0, $truncation-$tls ) . '[...]' . substr( $dvalue, -$tls, $tls );
							}
						}
						break;
					case 'list':
						if ( is_array( $dvalue ) ) {
							$vv = array();
							foreach ( $dvalue as $val ) {
								if ( $dvalue == 0 ) {
									$vv[] = '--';
								} else {
									$vv[] = "#" . $val . ": " . $this->lists[$content[2]][$val];
								}
							}
							$dvalue = implode( $nnl, $vv );
						} else {
							if ( $dvalue == 0 ) {
								$dvalue = '--';
							} else {
								$dvalue = "#" . $dvalue . ": " . $this->lists[$content[2]][$dvalue];
							}
						}
						break;
					case 'haslink':
						$dvalue = $dvalue;
						break;
				}
			}
		}

		return array( $dname => $dvalue );
	}
}

class aecRestrictionHelper
{
	function checkRestriction( $restrictions, $metaUser )
	{
		if ( count( $restrictions ) ) {
			$status = array();

			if ( isset( $restrictions['custom_restrictions'] ) ) {
				$status = array_merge( $status, $metaUser->CustomRestrictionResponse( $restrictions['custom_restrictions'] ) );
				unset( $restrictions['custom_restrictions'] );
			}

			$status = array_merge( $status, $metaUser->permissionResponse( $restrictions ) );

			foreach ( $status as $stname => $ststatus ) {
				if ( !$ststatus ) {
					return false;
				}
			}
		}

		return true;
	}

	function getRestrictionsArray( $restrictions )
	{
		$newrest = array();

		// Check for a fixed GID - this certainly overrides the others
		if ( !empty( $restrictions['fixgid_enabled'] ) ) {
			$newrest['fixgid'] = (int) $restrictions['fixgid'];
		} else {
			// No fixed GID, check for min GID
			if ( !empty( $restrictions['mingid_enabled'] ) ) {
				$newrest['mingid'] = (int) $restrictions['mingid'];
			}
			// Check for max GID
			if ( !empty( $restrictions['maxgid_enabled'] ) ) {
				$newrest['maxgid'] = (int) $restrictions['maxgid'];
			}
		}

		// First we sort out the group restrictions and convert them into plan restrictions

		// Check for a directly previously used group
		if ( !empty( $restrictions['previousgroup_req_enabled'] ) ) {
			if ( !empty( $restrictions['previousgroup_req'] ) ) {
				$restrictions = $this->addGroupPlans( $restrictions, 'previousgroup_req', 'previousplan_req' );
			}
		}

		// Check for a directly previously used group
		if ( !empty( $restrictions['previousgroup_req_enabled_excluded'] ) ) {
			if ( !empty( $restrictions['previousgroup_req_excluded'] ) ) {
				$restrictions = $this->addGroupPlans( $restrictions, 'previousgroup_req_excluded', 'previousplan_req_excluded' );
			}
		}

		// Check for a currently used group
		if ( !empty( $restrictions['currentgroup_req_enabled'] ) ) {
			if ( !empty( $restrictions['currentgroup_req'] ) ) {
				$restrictions = $this->addGroupPlans( $restrictions, 'currentgroup_req', 'currentplan_req' );
			}
		}

		// Check for a currently used group
		if ( !empty( $restrictions['currentgroup_req_enabled_excluded'] ) ) {
			if ( !empty( $restrictions['currentgroup_req_excluded'] ) ) {
				$restrictions = $this->addGroupPlans( $restrictions, 'currentgroup_req_excluded', 'currentplan_req_excluded' );
			}
		}

		// Check for a overall used group
		if ( !empty( $restrictions['overallgroup_req_enabled'] ) ) {
			if ( !empty( $restrictions['overallgroup_req'] ) ) {
				$restrictions = $this->addGroupPlans( $restrictions, 'overallplan_req', 'overallgroup_req' );
			}
		}

		// Check for a overall used group
		if ( !empty( $restrictions['overallgroup_req_enabled_excluded'] ) ) {
			if ( !empty( $restrictions['overallgroup_req_excluded'] ) ) {
				$restrictions = $this->addGroupPlans( $restrictions, 'overallgroup_req_excluded', 'overallplan_req_excluded' );
			}
		}

		// And now we prepare the individual plan restrictions

		// Check for a directly previously used plan
		if ( !empty( $restrictions['previousplan_req_enabled'] ) ) {
			if ( !empty( $restrictions['previousplan_req'] ) ) {
				$newrest['plan_previous'] = $restrictions['previousplan_req'];
			}
		}

		// Check for a directly previously used plan
		if ( !empty( $restrictions['previousplan_req_enabled_excluded'] ) ) {
			if ( !empty( $restrictions['previousplan_req_excluded'] ) ) {
				$newrest['plan_previous_excluded'] = $restrictions['previousplan_req_excluded'];
			}
		}

		// Check for a currently used plan
		if ( !empty( $restrictions['currentplan_req_enabled'] ) ) {
			if ( !empty( $restrictions['currentplan_req'] ) ) {
				$newrest['plan_present'] = $restrictions['currentplan_req'];
			}
		}

		// Check for a currently used plan
		if ( !empty( $restrictions['currentplan_req_enabled_excluded'] ) ) {
			if ( !empty( $restrictions['currentplan_req_excluded'] ) ) {
				$newrest['plan_present_excluded'] = $restrictions['currentplan_req_excluded'];
			}
		}

		// Check for a overall used plan
		if ( !empty( $restrictions['overallplan_req_enabled'] ) ) {
			if ( !empty( $restrictions['overallplan_req'] ) ) {
				$newrest['plan_overall'] = $restrictions['overallplan_req'];
			}
		}

		// Check for a overall used plan
		if ( !empty( $restrictions['overallplan_req_enabled_excluded'] ) ) {
			if ( !empty( $restrictions['overallplan_req_excluded'] ) ) {
				$newrest['plan_overall_excluded'] = $restrictions['overallplan_req_excluded'];
			}
		}

		if ( !empty( $restrictions['used_plan_min_enabled'] ) ) {
			if ( !empty( $restrictions['used_plan_min_amount'] ) && isset( $restrictions['used_plan_min'] ) ) {
				if ( !isset( $newrest['plan_amount_min'] ) ) {
					$newrest['plan_amount_min'] = array();
				}

				if ( is_array( $restrictions['used_plan_min'] ) ) {
					foreach ( $restrictions['used_plan_min'] as $planid ) {
						$newrest['plan_amount_min'][] = ( (int) $planid ) . ',' . ( (int) $restrictions['used_plan_min_amount'] );
					}
				} else {
					$newrest['plan_amount_min'][] = array( ( (int) $restrictions['used_plan_min'] ) . ',' . ( (int) $restrictions['used_plan_min_amount'] ) );
				}
			}
		}

		// Check for a overall used group with amount minimum
		if ( !empty( $restrictions['used_group_min_enabled'] ) ) {
			if ( !empty( $restrictions['used_group_min_amount'] ) && isset( $restrictions['used_group_min'] ) ) {
				$temp = $this->addGroupPlans( $restrictions, 'used_group_min', 'used_plan_min', array() );

				$ps = array();
				foreach ( $temp['used_plan_min'] as $planid ) {
					$newrest['used_plan_min'][] = ( (int) $planid ) . ',' . ( (int) $restrictions['used_group_min_amount'] );
				}
			}
		}

		// Check for a overall used plan with amount maximum
		if ( !empty( $restrictions['used_plan_max_enabled'] ) ) {
			if ( !empty( $restrictions['used_plan_max_amount'] ) && isset( $restrictions['used_plan_max'] ) ) {
				if ( !isset( $newrest['plan_amount_max'] ) ) {
					$newrest['plan_amount_max'] = array();
				}

				if ( is_array( $restrictions['used_plan_max'] ) ) {
					foreach ( $restrictions['used_plan_max'] as $planid ) {
						$newrest['plan_amount_max'][] = ( (int) $planid ) . ',' . ( (int) $restrictions['used_plan_max_amount'] );
					}
				} else {
					$newrest['plan_amount_max'][] = ( (int) $restrictions['used_plan_max'] ) . ',' . ( (int) $restrictions['used_plan_max_amount'] );
				}
			}
		}

		// Check for a overall used group with amount maximum
		if ( !empty( $restrictions['used_group_max_enabled'] ) ) {
			if ( !empty( $restrictions['used_group_max_amount'] ) && isset( $restrictions['used_group_max'] ) ) {
				$temp = aecRestrictionHelper::addGroupPlans( $restrictions, 'used_group_max', 'used_plan_max', array() );

				$ps = array();
				foreach ( $temp['used_plan_max'] as $planid ) {
					$newrest['used_plan_max'][] = ( (int) $planid ) . ',' . ( (int) $restrictions['used_group_max_amount'] );
				}
			}
		}

		// Check for a directly previously used plan
		if ( !empty( $restrictions['custom_restrictions_enabled'] ) ) {
			if ( !empty( $restrictions['custom_restrictions'] ) ) {
				$newrest['custom_restrictions'] = aecRestrictionHelper::transformCustomRestrictions( $restrictions['custom_restrictions'] );
			}
		}

		return $newrest;
	}

	function addGroupPlans( $source, $gkey, $pkey, $target=null )
	{
		if ( !is_array( $source[$pkey] ) ) {
			$plans = array();
		} else {
			$plans = $source[$pkey];
		}

		$newplans = ItemGroupHandler::getGroupsPlans( $source[$gkey] );

		$plans = array_merge( $plans, $newplans );

		array_unique( $plans );

		if ( is_null( $target ) ) {
			$restrictions[$pkey] = $plans;

			return $restrictions;
		} else {
			$target[$pkey] = $plans;

			return $target;
		}
	}

	function transformCustomRestrictions( $customrestrictions )
	{
		$cr = explode( "\n", $customrestrictions);

		$custom = array();
		foreach ( $cr as $field ) {
			// WAT?! yes.
			if ( strpos( nl2br( substr( $field, -1, 1 ) ), "<br" ) !== false ) {
				$field = substr( $field, 0, -1 );
			}

			$custom[] = explode( ' ', $field, 3 );
		}

		return $custom;
	}

	function paramList()
	{
		return array( 'mingid_enabled', 'mingid', 'fixgid_enabled', 'fixgid',
						'maxgid_enabled', 'maxgid', 'previousplan_req_enabled', 'previousplan_req',
						'currentplan_req_enabled', 'currentplan_req', 'overallplan_req_enabled', 'overallplan_req',
						'previousplan_req_enabled_excluded', 'previousplan_req_excluded', 'currentplan_req_enabled_excluded', 'currentplan_req_excluded',
						'overallplan_req_enabled_excluded', 'overallplan_req_excluded', 'used_plan_min_enabled', 'used_plan_min_amount',
						'used_plan_min', 'used_plan_max_enabled', 'used_plan_max_amount', 'used_plan_max',
						'custom_restrictions_enabled', 'custom_restrictions', 'previousgroup_req_enabled', 'previousgroup_req',
						'previousgroup_req_enabled_excluded', 'previousgroup_req_excluded', 'currentgroup_req_enabled', 'currentgroup_req',
						'currentgroup_req_enabled_excluded', 'currentgroup_req_excluded', 'overallgroup_req_enabled', 'overallgroup_req',
						'overallgroup_req_enabled_excluded', 'overallgroup_req_excluded', 'used_group_min_enabled', 'used_group_min_amount',
						'used_group_min', 'used_group_max_enabled', 'used_group_max_amount', 'used_group_max' );
	}

	function getParams()
	{
		$params = array();
		$params['mingid_enabled']					= array( 'list_yesno', 0 );
		$params['mingid']							= array( 'list', 18 );
		$params['fixgid_enabled']					= array( 'list_yesno', 0 );
		$params['fixgid']							= array( 'list', 19 );
		$params['maxgid_enabled']					= array( 'list_yesno', 0 );
		$params['maxgid']							= array( 'list', 21 );
		$params['previousplan_req_enabled'] 		= array( 'list_yesno', 0 );
		$params['previousplan_req']					= array( 'list', 0 );
		$params['previousplan_req_enabled_excluded']	= array( 'list_yesno', 0 );
		$params['previousplan_req_excluded']			= array( 'list', 0 );
		$params['currentplan_req_enabled']			= array( 'list_yesno', 0 );
		$params['currentplan_req']					= array( 'list', 0 );
		$params['currentplan_req_enabled_excluded']	= array( 'list_yesno', 0 );
		$params['currentplan_req_excluded']			= array( 'list', 0 );
		$params['overallplan_req_enabled']			= array( 'list_yesno', 0 );
		$params['overallplan_req']					= array( 'list', 0 );
		$params['overallplan_req_enabled_excluded']	= array( 'list_yesno', 0 );
		$params['overallplan_req_excluded']			= array( 'list', 0 );
		$params['used_plan_min_enabled']			= array( 'list_yesno', 0 );
		$params['used_plan_min_amount']				= array( 'inputB', 0 );
		$params['used_plan_min']					= array( 'list', 0 );
		$params['used_plan_max_enabled']			= array( 'list_yesno', 0 );
		$params['used_plan_max_amount']				= array( 'inputB', 0 );
		$params['used_plan_max']					= array( 'list', 0 );
		$params['previousgroup_req_enabled'] 		= array( 'list_yesno', 0 );
		$params['previousgroup_req']				= array( 'list', 0 );
		$params['previousgroup_req_enabled_excluded']	= array( 'list_yesno', 0 );
		$params['previousgroup_req_excluded']		= array( 'list', 0 );
		$params['currentgroup_req_enabled']			= array( 'list_yesno', 0 );
		$params['currentgroup_req']					= array( 'list', 0 );
		$params['currentgroup_req_enabled_excluded']	= array( 'list_yesno', 0 );
		$params['currentgroup_req_excluded']		= array( 'list', 0 );
		$params['overallgroup_req_enabled']			= array( 'list_yesno', 0 );
		$params['overallgroup_req']					= array( 'list', 0 );
		$params['overallgroup_req_enabled_excluded']	= array( 'list_yesno', 0 );
		$params['overallgroup_req_excluded']		= array( 'list', 0 );
		$params['used_group_min_enabled']			= array( 'list_yesno', 0 );
		$params['used_group_min_amount']			= array( 'inputB', 0 );
		$params['used_group_min']					= array( 'list', 0 );
		$params['used_group_max_enabled']			= array( 'list_yesno', 0 );
		$params['used_group_max_amount']			= array( 'inputB', 0 );
		$params['used_group_max']					= array( 'list', 0 );
		$params['custom_restrictions_enabled']		= array( 'list_yesno', '' );
		$params['custom_restrictions']				= array( 'inputD', '' );

		return $params;
	}

	function getLists( $params_values, $restrictions_values )
	{
		$database = &JFactory::getDBO();

		$user = &JFactory::getUser();

		$acl = &JFactory::getACL();

		// ensure user can't add group higher than themselves
		$my_groups = $acl->get_object_groups( 'users', $user->id, 'ARO' );
		if ( is_array( $my_groups ) && count( $my_groups ) > 0) {
			$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
		} else {
			$ex_groups = array();
		}

		$gtree = $acl->get_group_children_tree( null, 'USERS', true );

		$ex_groups = array_merge( $ex_groups, array( 28, 29, 30 ) );

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
		$lists['gid'] 		= mosHTML::selectList( $gtree, 'gid', 'size="6"', 'value', 'text', arrayValueDefault($params_values, 'gid', 18) );
		$lists['mingid'] 	= mosHTML::selectList( $gtree, 'mingid', 'size="6"', 'value', 'text', arrayValueDefault($restrictions_values, 'mingid', 18) );
		$lists['fixgid'] 	= mosHTML::selectList( $gtree, 'fixgid', 'size="6"', 'value', 'text', arrayValueDefault($restrictions_values, 'fixgid', 19) );
		$lists['maxgid'] 	= mosHTML::selectList( $gtree, 'maxgid', 'size="6"', 'value', 'text', arrayValueDefault($restrictions_values, 'maxgid', 21) );

		$available_plans = array();
		$available_plans[] = mosHTML::makeOption( '0', "- " . _PAYPLAN_NOPLAN . " -" );

		// Fetch Payment Plans
		$query = 'SELECT `id` AS value, `name` AS text'
				. ' FROM #__acctexp_plans'
				;
		$database->setQuery( $query );
		$plans = $database->loadObjectList();

	 	if ( is_array( $plans ) ) {
	 		$all_plans	= array_merge( $available_plans, $plans );
	 	} else {
	 		$all_plans	= $available_plans;
	 	}

		$total_all_plans	= min( max( ( count( $all_plans ) + 1 ), 4 ), 20 );

		$planrest = array( 'previousplan_req', 'currentplan_req', 'overallplan_req', 'used_plan_min', 'used_plan_max', 'previousplan_req_excluded', 'currentplan_req_excluded', 'overallplan_req_excluded'  );

		foreach ( $planrest as $name ) {
			$lists[$name] = mosHTML::selectList( $all_plans, $name.'[]', 'size="' . $total_all_plans . '" multiple="multiple"', 'value', 'text', arrayValueDefault($restrictions_values, $name, 0) );
		}

		$available_groups = array();
		$available_groups[] = mosHTML::makeOption( '0', _PAYPLAN_NOGROUP );

		// Fetch Item Groups
		$query = 'SELECT `id` AS value, `name` AS text'
				. ' FROM #__acctexp_itemgroups'
				;
		$database->setQuery( $query );
		$groups = $database->loadObjectList();

	 	if ( is_array( $groups ) ) {
	 		$all_groups	= array_merge( $available_groups, $groups );
	 	} else {
	 		$all_groups	= $available_groups;
	 	}

		$total_all_groups	= min( max( ( count( $all_groups ) + 1 ), 4 ), 20 );

		$grouprest = array( 'previousgroup_req', 'currentgroup_req', 'overallgroup_req', 'used_group_min', 'used_group_max', 'previousgroup_req_excluded', 'currentgroup_req_excluded', 'overallgroup_req_excluded' );

		foreach ( $grouprest as $name ) {
			$lists[$name] = mosHTML::selectList( $all_groups, $name.'[]', 'size="' . $total_all_groups . '" multiple="multiple"', 'value', 'text', arrayValueDefault($restrictions_values, $name, 0) );
		}

		return $lists;
	}

	function echoSettings( $aecHTML )
	{
		$width = 1200;

		$stdvars =	array(	array(
									array( 'mingid_enabled', 'mingid' ),
									array( 'fixgid_enabled', 'fixgid' ),
									array( 'maxgid_enabled', 'maxgid' ),
							),	array(
									array( 'previous*_req_enabled', 'previous*_req' ),
									array( 'previous*_req_enabled_excluded', 'previous*_req_excluded' ),
									array( 'current*_req_enabled', 'current*_req' ),
									array( 'current*_req_enabled_excluded', 'current*_req_excluded' ),
									array( 'overall*_req_enabled', 'overall*_req' ),
									array( 'overall*_req_enabled_excluded', 'overall*_req_excluded' ),
							), array(
									array( 'used_*_min_enabled', 'used_*_min_amount', 'used_*_min' ),
									array( 'used_*_max_enabled', 'used_*_max_amount', 'used_*_max' ),
							)
					);

		$types = array( 'plan', 'group' );

		foreach ( $types as $type ) {
			foreach ( $stdvars as $block ) {
				// non-* blocks only once
				if ( ( strpos( $block[0][0], '*' ) === false ) && ( $type != 'plan') ) {
					continue;
				}

				echo '<tr><td><div class="userinfobox">';
				$sblockwidth = $width / count( $block );
				foreach ( $block as $sblock ) {
					echo '<div style="position:relative;float:left;width:' . $sblockwidth . 'px;">';
					foreach ( $sblock as $vname ) {
						echo $aecHTML->createSettingsParticle( str_replace( '*', $type, $vname ) );
					}
					echo '</div>';
				}
				echo '</div></td></tr>';
			}
		}
	}
}

class PluginHandler
{
	function PluginHandler() { }

	function &getPlugin($type, $plugin = null)
	{
		$result = array();

		$plugins = PluginHandler::_load();

		$total = count($plugins);
		for($i = 0; $i < $total; $i++)
		{
			if(is_null($plugin))
			{
				if($plugins[$i]->type == $type) {
						$result[] = $plugins[$i];
				}
			}
			else
			{
				if($plugins[$i]->type == $type && $plugins[$i]->name == $plugin) {
						$result = $plugins[$i];
						break;
				}
			}

		}

		return $result;
	}

	function _load()
	{
		$db        =& JFactory::getDBO();
		$user    =& JFactory::getUser();

		if (isset($user))
		{
			$aid = $user->get('aid', 0);

			$query = 'SELECT folder AS type, element AS name, params'
					. ' FROM #__plugins'
					. ' WHERE access <= ' . (int) $aid
					. ' ORDER BY ordering';
		}
		else
		{
			$query = 'SELECT folder AS type, element AS name, params'
					. ' FROM #__plugins'
					. ' ORDER BY ordering';
		}

		$db->setQuery( $query );

		if (!($plugins = $db->loadObjectList())) {
				JError::raiseWarning( 'SOME_ERROR_CODE', "Error loading Plugins: " . $db->getErrorMsg());
				return false;
		}

		return $plugins;
	}
}

?>
