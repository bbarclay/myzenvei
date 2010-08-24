<?php
/**
 * @version $Id: toolbar.acctexp.html.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Menubar HTML Writer
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class ComponentMenu
{
	/**
	* Draws the menu
	*/
	function NEW_MENU()
	{  // To be deleted?
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'save', 'save.png',  'save_f2.png', _SAVE, false );
		JToolBarHelper::custom( 'cancel', 'cancel.png',  'cancel_f2.png', _CANCEL, false );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
		}
	}

	function NEW_EXPIRATION()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'add', 'edit.png',  'edit_f2.png', _CONFIGURE );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_EXPIRATION()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'edit', 'edit.png',  'edit_f2.png', _CONFIGURE );
		JToolBarHelper::custom( 'expire', 'restore.png',  'restore_f2.png', _REMOVE );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function ADD_MENU()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'save', 'save.png',  'save_f2.png', _SAVE, false );
		JToolBarHelper::custom( 'cancel', 'cancel.png',  'cancel_f2.png', _CANCEL, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_MENU()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'save', 'save.png',  'save_f2.png', _SAVE, false );
		JToolBarHelper::custom( 'apply', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'cancel', 'cancel.png',  'cancel_f2.png', _CANCEL, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_SETTINGS()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'applySettings', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'saveSettings', 'save.png',  'save_f2.png', _SAVE, false );
		JToolBarHelper::custom( 'cancelSettings', 'cancel.png',  'cancel_f2.png', _CANCEL, false );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function LIST_PROCESSORS()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'publishProcessor', 'publish.png',  'publish_f2.png', _PUBLISH_PROCESSOR, true );
		JToolBarHelper::custom( 'unpublishProcessor', 'unpublish.png',  'unpublish_f2.png', _UNPUBLISH_PROCESSOR, true );
		JToolBarHelper::custom( 'newProcessor', 'new.png',  'new_f2.png', _NEW_PROCESSOR, false );
		JToolBarHelper::custom( 'editProcessor', 'edit.png',  'edit_f2.png', _EDIT_PROCESSOR, true );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_PROCESSOR()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'saveProcessor', 'save.png',  'save_f2.png', _SAVE_PROCESSOR, false );
		JToolBarHelper::custom( 'applyProcessor', 'apply.png',  'apply_f2.png', _APPLY_PROCESSOR, false );
		JToolBarHelper::custom( 'cancelProcessor', 'cancel.png',  'cancel_f2.png', _CANCEL_PROCESSOR, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function LIST_SUBSCRIPTIONPLANS()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'publishSubscriptionPlan', 'publish.png',  'publish_f2.png', _PUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'unpublishSubscriptionPlan', 'unpublish.png',  'unpublish_f2.png', _UNPUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'newSubscriptionPlan', 'new.png',  'new_f2.png', _NEW_PAYPLAN, false );
		JToolBarHelper::custom( 'editSubscriptionPlan', 'edit.png',  'edit_f2.png', _EDIT_PAYPLAN, true );
		JToolBarHelper::custom( 'copySubscriptionPlan', 'copy.png', 'copy_f2.png', _COPY_PAYPLAN, true );
		JToolBarHelper::custom( 'removeSubscriptionPlan', 'delete.png',  'delete_f2.png', _REMOVE_PAYPLAN, true );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_SUBSCRIPTIONPLAN()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'saveSubscriptionPlan', 'save.png',  'save_f2.png', _SAVE_PAYPLAN, false );
		JToolBarHelper::custom( 'applySubscriptionPlan', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'cancelSubscriptionPlan', 'cancel.png',  'cancel_f2.png', _CANCEL_PAYPLAN, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function LIST_ITEMGROUPS()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'publishItemGroup', 'publish.png',  'publish_f2.png', _PUBLISH_ITEMGROUP, true );
		JToolBarHelper::custom( 'unpublishItemGroup', 'unpublish.png',  'unpublish_f2.png', _UNPUBLISH_ITEMGROUP, true );
		JToolBarHelper::custom( 'newItemGroup', 'new.png',  'new_f2.png', _NEW_ITEMGROUP, false );
		JToolBarHelper::custom( 'editItemGroup', 'edit.png',  'edit_f2.png', _EDIT_ITEMGROUP, true );
		JToolBarHelper::custom( 'copyItemGroup', 'copy.png', 'copy_f2.png', _COPY_ITEMGROUP, true );
		JToolBarHelper::custom( 'removeItemGroup', 'delete.png',  'delete_f2.png', _REMOVE_ITEMGROUP, true );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_ITEMGROUP()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'saveItemGroup', 'save.png',  'save_f2.png', _SAVE_ITEMGROUP, false );
		JToolBarHelper::custom( 'applyItemGroup', 'apply.png',  'apply_f2.png', _APPLY_ITEMGROUP, false );
		JToolBarHelper::custom( 'cancelItemGroup', 'cancel.png',  'cancel_f2.png', _CANCEL_ITEMGROUP, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function LIST_MICROINTEGRATIONS()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'publishMicroIntegration', 'publish.png',  'publish_f2.png', _PUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'unpublishMicroIntegration', 'unpublish.png',  'unpublish_f2.png', _UNPUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'newMicroIntegration', 'new.png',  'new_f2.png', _NEW_PAYPLAN, false );
		JToolBarHelper::custom( 'editMicroIntegration', 'edit.png',  'edit_f2.png', _EDIT_PAYPLAN, true );
		JToolBarHelper::custom( 'copyMicroIntegration', 'copy.png', 'copy_f2.png', _COPY_PAYPLAN, true );
		JToolBarHelper::custom( 'removeMicroIntegration', 'delete.png',  'delete_f2.png', _REMOVE_PAYPLAN, true );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_MICROINTEGRATION()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'saveMicroIntegration', 'save.png',  'save_f2.png', _SAVE_PAYPLAN, false );
		JToolBarHelper::custom( 'applyMicroIntegration', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'cancelMicroIntegration', 'cancel.png',  'cancel_f2.png', _CANCEL_PAYPLAN, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function LIST_COUPONS()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'publishCoupon', 'publish.png',  'publish_f2.png', _PUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'unpublishCoupon', 'unpublish.png',  'unpublish_f2.png', _UNPUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'newCoupon', 'new.png',  'new_f2.png', _NEW_PAYPLAN, false );
		JToolBarHelper::custom( 'editCoupon', 'edit.png',  'edit_f2.png', _EDIT_PAYPLAN, true );
		JToolBarHelper::custom( 'copyCoupon', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::custom( 'removeCoupon', 'delete.png',  'delete_f2.png', _REMOVE_PAYPLAN, true );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_COUPON()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'saveCoupon', 'save.png',  'save_f2.png', _SAVE_PAYPLAN, false );
		JToolBarHelper::custom( 'applyCoupon', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'cancelCoupon', 'cancel.png',  'cancel_f2.png', _CANCEL_PAYPLAN, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function LIST_COUPONS_STATIC()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'publishCouponStatic', 'publish.png',  'publish_f2.png', _PUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'unpublishCouponStatic', 'unpublish.png',  'unpublish_f2.png', _UNPUBLISH_PAYPLAN, true );
		JToolBarHelper::custom( 'newCouponStatic', 'new.png',  'new_f2.png', _NEW_PAYPLAN, false );
		JToolBarHelper::custom( 'editCouponStatic', 'edit.png',  'edit_f2.png', _EDIT_PAYPLAN, true );
		JToolBarHelper::custom( 'copyCouponStatic', 'copy.png', 'copy_f2.png', _COPY_PAYPLAN, true );
		JToolBarHelper::custom( 'removeCouponStatic', 'delete.png',  'delete_f2.png', _REMOVE_PAYPLAN, true );
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_COUPON_STATIC()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'saveCouponStatic', 'save.png',  'save_f2.png', _SAVE_PAYPLAN, false );
		JToolBarHelper::custom( 'applyCouponStatic', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'cancelCouponStatic', 'cancel.png',  'cancel_f2.png', _CANCEL_PAYPLAN, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_EXPORT()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'loadExport', 'next.png',  'next_f2.png', _EXPORT_LOAD, false );
		JToolBarHelper::custom( 'applyExport', 'apply.png',  'apply_f2.png', _EXPORT_APPLY, false );
		JToolBarHelper::custom( 'exportExport', 'download.png',  'download_f2.png', _AEC_HEAD_EXPORT, false );
		JToolBarHelper::custom( 'saveExport', 'save.png',  'save_f2.png', _SAVE_PAYPLAN, false );
		JToolBarHelper::custom( 'cancelSettings', 'cancel.png',  'cancel_f2.png', _CANCEL, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function EDIT_IMPORT()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::custom( 'applyImport', 'apply.png',  'apply_f2.png', _APPLY_PAYPLAN, false );
		JToolBarHelper::custom( 'cancelSettings', 'cancel.png',  'cancel_f2.png', _CANCEL, false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}

	function NO_MENU()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::back();
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}
}

class CommonMenu
{
	function EDIT_CSS_MENU()
	{
		if ( !aecJoomla15check() ) {
			JToolBarHelper::startTable();
		}
		JToolBarHelper::save( 'saveCSS' );
		JToolBarHelper::cancel('cancelCSS');
		JToolBarHelper::custom( 'showCentral', 'extensions.png',  'extensions_f2.png', _CENTRAL_PAGE , false );
		if ( !aecJoomla15check() ) {
			JToolBarHelper::endTable();
		}
	}
}

?>
