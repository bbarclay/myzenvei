<?php
/**
 * @version $Id: toolbar.acctexp.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Menubar Handler
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {

	case 'add':
		ComponentMenu::ADD_MENU();
		break;

	case 'edit':
		ComponentMenu::EDIT_MENU();
		break;

	case 'showSettings':
		ComponentMenu::EDIT_SETTINGS();
		break;

	case 'showProcessors':
		ComponentMenu::LIST_PROCESSORS();
		break;

	case 'newProcessor':
		ComponentMenu::EDIT_PROCESSOR();
		break;

	case 'editProcessor':
		ComponentMenu::EDIT_PROCESSOR();
		break;

	case 'showSubscriptionPlans':
		ComponentMenu::LIST_SUBSCRIPTIONPLANS();
		break;

	case 'newSubscriptionPlan':
		ComponentMenu::EDIT_SUBSCRIPTIONPLAN();
		break;

	case 'editSubscriptionPlan':
		ComponentMenu::EDIT_SUBSCRIPTIONPLAN();
		break;

	case 'showItemGroups':
		ComponentMenu::LIST_ITEMGROUPS();
		break;

	case 'newItemGroup':
		ComponentMenu::EDIT_ITEMGROUP();
		break;

	case 'editItemGroup':
		ComponentMenu::EDIT_ITEMGROUP();
		break;

	case 'showMicroIntegrations':
		ComponentMenu::LIST_MICROINTEGRATIONS();
		break;

	case 'newMicroIntegration':
		ComponentMenu::EDIT_MICROINTEGRATION();
		break;

	case 'editMicroIntegration':
		ComponentMenu::EDIT_MICROINTEGRATION();
		break;

	case 'showCoupons':
		ComponentMenu::LIST_COUPONS();
		break;

	case 'newCoupon':
		ComponentMenu::EDIT_COUPON();
		break;

	case 'editCoupon':
		ComponentMenu::EDIT_COUPON();
		break;

	case 'showCouponsStatic':
		ComponentMenu::LIST_COUPONS_STATIC();
		break;

	case 'newCouponStatic':
		ComponentMenu::EDIT_COUPON_STATIC();
		break;

	case 'editCouponStatic':
		ComponentMenu::EDIT_COUPON_STATIC();
		break;

	case 'loadExport':
	case 'applyExport':
	case 'saveExport':
	case 'exportExport':
	case 'export':
		ComponentMenu::EDIT_EXPORT();
		break;

	case 'import':
		ComponentMenu::EDIT_IMPORT();
		break;

	case 'editCSS':
		CommonMenu::EDIT_CSS_MENU();
		break;

	case 'eventlog':
	case 'hacks':
	case 'help':
	case 'history':
	case 'invoices':
	case 'showActive':
	case 'showCancelled':
	case 'showClosed':
	case 'showExpired':
	case 'showExcluded':
	case 'showManual':
	case 'showPending':
		ComponentMenu::NO_MENU();
		break;

	default:
		ComponentMenu::NO_MENU();
		break;
}
?>
