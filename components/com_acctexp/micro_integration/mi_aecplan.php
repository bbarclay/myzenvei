<?php
/**
 * @version $Id: mi_aecplan.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - AEC Plan Application
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_aecplan
{
	function Settings()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id` AS value, `name` AS text'
				. ' FROM #__acctexp_plans'
				. ' WHERE `active` = 1'
				;
		$database->setQuery( $query );
		$plans = $database->loadObjectList();

		$payment_plans = array_merge( array( mosHTML::makeOption( '0', "- " . _PAYPLAN_NOPLAN . " -" ) ), $plans );

		$total_plans = min( max( (count( $payment_plans ) + 1 ), 4 ), 20 );

		$settings = array();

		$settings['first_plan_not_membership']		= array( 'list_yesno' );

		$settings['plan_apply_first']				= array( 'list' );
		$settings['lists']['plan_apply_first']		= mosHTML::selectList( $payment_plans, 'plan_apply_first', 'size="' . $total_plans . '"', 'value', 'text', $this->settings['plan_apply_first'] );

		$settings['plan_apply']						= array( 'list' );
		$settings['lists']['plan_apply']			= mosHTML::selectList( $payment_plans, 'plan_apply', 'size="' . $total_plans . '"', 'value', 'text', $this->settings['plan_apply'] );

		$settings['plan_apply_pre_exp']				= array( 'list' );
		$settings['lists']['plan_apply_pre_exp']	= mosHTML::selectList( $payment_plans, 'plan_apply_pre_exp', 'size="' . $total_plans . '"', 'value', 'text', $this->settings['plan_apply_pre_exp'] );

		$settings['plan_apply_exp']					= array( 'list' );
		$settings['lists']['plan_apply_exp']		= mosHTML::selectList( $payment_plans, 'plan_apply_exp', 'size="' . $total_plans . '"', 'value', 'text', $this->settings['plan_apply_exp'] );

		return $settings;
	}

	function relayAction( $request )
	{
		if ( $request->action == 'action' ) {
			// Do NOT act on regular action call
			return null;
		}

		if ( $request->area == 'afteraction' ) {
			// But on after action
			$request->area = '';

			// Or maybe this is a first plan?
			if ( !empty( $this->settings['plan_apply_first'] ) ) {
				if ( !empty( $this->settings['first_plan_not_membership'] ) ) {
					$used_plans = $request->metaUser->meta->getUsedPlans();

					if ( empty( $used_plans ) ) {
						$request->area = '_first';
					} else {
						if ( !in_array( $request->plan->id, $used_plans ) ) {
							$request->area = '_first';
						}
					}
				} else {
					if ( empty( $request->metaUser->objSubscription->previous_plan ) ) {
						$request->area = '_first';
					}
				}
			}
		}

		if ( !isset( $this->settings['plan_apply'.$request->area] ) ) {
			return null;
		}

		if ( empty( $this->settings['plan_apply'.$request->area] ) ) {
			return null;
		}

		if ( $request->action == 'action' ) {
			if ( !empty( $this->settings['plan_apply_first'] ) ) {
				if ( empty( $request->metaUser->objSubscription->previous_plan ) ) {
					$request->area = '_first';
				}
			}
		}

		$database = &JFactory::getDBO();

		$new_plan = new SubscriptionPlan( $database );
		$new_plan->load( $this->settings['plan_apply'.$request->area] );

		$request->metaUser->establishFocus( $new_plan, 'none', false );

		$request->metaUser->focusSubscription->applyUsage( $this->settings['plan_apply'.$request->area] );

		return true;
	}
}
?>
