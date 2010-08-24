<?php
/**
 * @version $Id: acctexp.html.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Main HTML Frontend
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class HTML_frontEnd
{
	function HTML_frontEnd()
	{
		$this->aec_styling( 'com_acctexp' );
	}

	function aec_styling( $option )
	{
		global $mainframe;

		$html = '<link rel="stylesheet" type="text/css" media="all" href="'
		. JURI::root() . 'media/' . $option . '/css/site.css" />';

		$mainframe->addCustomHeadTag( $html );
 		$mainframe->appendMetaTag( 'description', 'AEC Account Expiration Control' );
			$mainframe->appendMetaTag( 'keywords', 'AEC Account Expiration Control' );
	}

	function expired( $option, $metaUser, $expiration, $invoice, $trial, $continue=0 )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( $metaUser->objSubscription->status == "Expired" ) {
			$intro = "&intro=" . $aecConfig->cfg['intro_expired'] ? "0" : "1";
		} else {
			$intro = "&intro=0";
		}

		if ( $aecConfig->cfg['customtext_expired_keeporiginal'] ) {?>
			<div class="componentheading"><?php echo _EXPIRED_TITLE; ?></div>
			<div id="expired_greeting">
				<p><?php echo sprintf( _DEAR, $metaUser->cmsUser->name ); ?></p><p><?php
					if ( $trial ) {
						echo _EXPIRED_TRIAL;
					} else {
						echo _EXPIRED;
					}
					echo $expiration; ?>
				</p>
			</div>
			<?php
		}
		if ( $aecConfig->cfg['customtext_expired'] ) { ?>
			<p><?php echo $aecConfig->cfg['customtext_expired']; ?></p>
			<?php
		} ?>
		<div id="box_expired">
			<div id="alert_level_1">
				<?php
				if ( $invoice ) {
					?>
					<p>
						<?php echo _PENDING_OPENINVOICE; ?>&nbsp;
						<a href="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option . '&amp;task=repeatPayment&amp;invoice=' . $invoice . '&amp;userid=' . $metaUser->userid ); ?>" title="<?php echo _GOTO_CHECKOUT; ?>"><?php echo _GOTO_CHECKOUT; ?></a>
					</p>
					<?php
				} ?>
				<?php
				if ( $continue ) {
					?>
					<div id="renew_button">
						<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=renewSubscription'.$intro, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
						<input type="hidden" name="option" value="<?php echo $option; ?>" />
						<input type="hidden" name="userid" value="<?php echo $metaUser->userid; ?>" />
						<input type="hidden" name="usage" value="<?php echo $metaUser->focusSubscription->plan; ?>" />
						<input type="hidden" name="task" value="renewSubscription" />
						<input type="submit" class="button" value="<?php echo _RENEW_BUTTON_CONTINUE;?>" />
						</form>
					</div>
					<?php
				} ?>
				<div id="renew_button">
					<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=renewSubscription'.$intro, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
					<input type="hidden" name="option" value="<?php echo $option; ?>" />
					<input type="hidden" name="userid" value="<?php echo $metaUser->userid; ?>" />
					<input type="hidden" name="task" value="renewSubscription" />
					<input type="submit" class="button" value="<?php echo _RENEW_BUTTON;?>" />
					</form>
				</div>
			</div>
		</div>
		<?php
	}

	function hold( $option, $metaUser )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ($aecConfig->cfg['customtext_hold_keeporiginal'] ) {?>
			<div class="componentheading"><?php echo _HOLD_TITLE; ?></div>
			<div id="expired_greeting">
				<p><?php echo sprintf( _DEAR, $metaUser->cmsUser->name ); ?></p>
				<p><?php echo _HOLD_EXPLANATION; ?></p>
			</div>
			<?php
		}
		if ( $aecConfig->cfg['customtext_hold'] ) { ?>
			<p><?php echo $aecConfig->cfg['customtext_hold']; ?></p>
			<?php
		} ?>
		<?php
	}

	function pending( $option, $objUser, $invoice, $reason=0 )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$actions =	_PENDING_OPENINVOICE
		. ' <a href="'
		.  AECToolbox::deadsureURL( 'index.php?option=' . $option . '&amp;task=repeatPayment&amp;invoice='
		. $invoice . '&amp;userid=' . $objUser->id ) . '" title="' . _GOTO_CHECKOUT . '">'
		. _GOTO_CHECKOUT
		. '</a>'
		. ', ' . _GOTO_CHECKOUT_CANCEL . ' '
		. '<a href="'
		. AECToolbox::deadsureURL( 'index.php?option=' . $option . '&amp;task=cancelPayment&amp;invoice='
		. $invoice . '&amp;userid=' . $objUser->id . '&amp;pending=1' )
		. '" title="' . _HISTORY_ACTION_CANCEL . '">'
		. _HISTORY_ACTION_CANCEL
		. '</a>';

		if ( $reason !== 0 ) {
			$actions .= ' ' . $reason;
		}

		if ( $aecConfig->cfg['customtext_pending_keeporiginal'] ) { ?>
			<div class="componentheading"><?php echo _PENDING_TITLE; ?></div>
			<p class="expired_dear"><?php echo sprintf( _DEAR, $objUser->name ) . ','; ?></p>
			<p class="expired_date"><?php echo _WARN_PENDING; ?></p>
			<?php
		}
		if ( $aecConfig->cfg['customtext_pending'] ) { ?>
			<p><?php echo $aecConfig->cfg['customtext_pending']; ?></p>
			<?php
		} ?>
		<div id="box_pending">
		<?php
		if ( strcmp($invoice, "none") === 0 ) { ?>
			<p><?php echo _PENDING_NOINVOICE; ?></p>
			<div id="upgrade_button">
				<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=renewSubscription', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
					<input type="hidden" name="option" value="<?php echo $option; ?>" />
					<input type="hidden" name="userid" value="<?php echo $objUser->id; ?>" />
					<input type="hidden" name="task" value="renewSubscription" />
					<input type="submit" class="button" value="<?php echo _PENDING_NOINVOICE_BUTTON;?>" />
				</form>
			</div>
			<?php
		} elseif ( $invoice ) { ?>
			<p><?php echo $actions; ?></p>
			<?php
		} ?>
		</div>
		<div style="clear:both"></div>
		<?php
	}

	function subscriptionDetails( $option, $tabs, $sub, $invoices, $metaUser, $mi, $subscriptions = null, $custom = null, $properties )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		$trial = false;
		if ( !empty( $metaUser->objSubscription->status ) ) {
			$trial = $metaUser->objSubscription->status == 'Trial';
		}

		?>
		<script type="text/javascript">
		function show_confirm( msg )
		{
			var r = confirm(msg);
			return r;
		}
		</script>
		<div class="componentheading"><?php echo _MYSUBSCRIPTION_TITLE;?></div>
		<div id="subscription_details">
			<div id="aec_navlist_profile">
				<ul id="aec_navlist_profile">
				<?php
				foreach ( $tabs as $fieldlink => $fieldname ) {
					if ( $fieldlink == $sub ) {
						$id = ' id="current"';
					} else {
						$id = '';
					}
					echo '<li><a href="' . AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=subscriptiondetails&amp;sub=' . $fieldlink, !empty( $aecConfig->cfg['ssl_profile'] ) ) . '"'.$id.'>' . $fieldname . '</a></li>';
				}
				?>
				</ul>
			</div>
			<?php
			switch ( $sub ) {
				case 'overview':
					if ( !empty( $metaUser->objSubscription->signup_date ) ) {
						echo '<p>' . _MEMBER_SINCE . '&nbsp;' . HTML_frontend::DisplayDateInLocalTime( $metaUser->objSubscription->signup_date ) .'</p>';
					}

					if ( $properties['hascart'] ) { ?>
					<form name="confirmForm" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option . '&task=cart', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
					<div id="update_button"><input type="image" src="<?php echo JURI::root() . 'media/com_acctexp/images/site/your_cart_button.png'; ?>" border="0" name="submit" alt="submit" /></div>
					</form><br /><br />
					<?php }

					if ( !empty( $properties['showcheckout'] ) ) {
						?>
						<br /><br />
						<p>
							<?php echo _PENDING_OPENINVOICE; ?>&nbsp;
							<a href="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option . '&amp;task=repeatPayment&amp;invoice=' . $properties['showcheckout'] . '&amp;userid=' . $metaUser->userid ); ?>" title="<?php echo _GOTO_CHECKOUT; ?>"><?php echo _GOTO_CHECKOUT; ?></a>
						</p>
						<br /><br />
						<?php
					}

					if ( $metaUser->hasSubscription ) {
						foreach ( $subscriptions as $sid => $subscription ) {
							switch ( $sid ) {
								case 0:
									echo '<h2>' . _YOUR_SUBSCRIPTION . '</h2>';
									break;
								case 1:
									echo '<div style="clear:both"></div><h2>' . _YOUR_FURTHER_SUBSCRIPTIONS . '</h2>';
									break;
							}

							?><div class="subscription_info"><?php

							echo '<p><strong>' . $subscription->getProperty( 'name' ) . '</strong></p>';
							echo '<p>' . $subscription->getProperty( 'desc' ) . '</p>';
							if ( !empty( $subscription->proc_actions ) ) {
								echo '<p>' . _PLAN_PROCESSOR_ACTIONS . ' ' . implode( " | ", $subscription->proc_actions ) . '</p>';
							}
							?></div><?php
						}
						?>
						<div id="box_expired">
						<div id="alert_level_<?php echo $properties['alert']['level']; ?>">
							<div id="expired_greeting">
								<?php
								$lifetime = false;
								if ( !empty( $metaUser->objSubscription->lifetime ) ) {
									$lifetime = true;
								}

								if ( $lifetime ) { ?>
									<p><strong><?php echo _RENEW_LIFETIME; ?></strong></p><?php
								} else { ?>
									<p>
										<?php echo HTML_frontend::DisplayDateInLocalTime( $metaUser->focusSubscription->expiration, true, true, $trial ); ?>
									</p>
									<?php
								}
								?>
							</div>
							<div id="days_left">
								<?php
								if ( strcmp( $properties['alert']['daysleft'], 'infinite' ) === 0 ) {
									$daysleft			= _RENEW_DAYSLEFT_INFINITE;
									$daysleft_append	= $trial ? _RENEW_DAYSLEFT_TRIAL : _RENEW_DAYSLEFT;
								} elseif ( strcmp( $properties['alert']['daysleft'], 'excluded' ) === 0 ) {
									$daysleft			= _RENEW_DAYSLEFT_EXCLUDED;
									$daysleft_append	= '';
								} else {
									if ( $properties['alert']['daysleft'] >= 0 ) {
										$daysleft			= $properties['alert']['daysleft'];
										$daysleft_append	= $trial ? _RENEW_DAYSLEFT_TRIAL : _RENEW_DAYSLEFT;
									} else {
										$daysleft			= $properties['alert']['daysleft'];
										$daysleft_append	= _AEC_DAYS_ELAPSED;
									}
								}
								?>
								<p><strong><?php echo $daysleft; ?></strong>&nbsp;&nbsp;<?php echo $daysleft_append; ?></p>
							</div>
							<?php
							if ( !empty( $properties['upgrade_button'] ) ) { ?>
								<div id="upgrade_button">
									<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=renewsubscription', !empty( $aecConfig->cfg['ssl_signup'] ) ); ?>" method="post">
										<input type="hidden" name="option" value="<?php echo $option; ?>" />
										<input type="hidden" name="task" value="renewsubscription" />
										<input type="hidden" name="userid" value="<?php echo $metaUser->cmsUser->id; ?>" />
										<input type="submit" class="button" value="<?php echo _RENEW_BUTTON_UPGRADE;?>" />
									</form>
								</div>
								<?php
							}
							?>
							</div>
						</div>
					<?php
					}
					break;
				case 'invoices':
					?>
					<table>
						<tr>
							<th><?php echo _HISTORY_COL1_TITLE;?></th>
							<th><?php echo _HISTORY_COL2_TITLE;?></th>
							<th><?php echo _HISTORY_COL3_TITLE;?></th>
							<th><?php echo _HISTORY_COL4_TITLE;?></th>
							<th><?php echo _HISTORY_COL5_TITLE;?></th>
						</tr>
						<?php
						foreach ( $invoices as $invoice ) { ?>
							<tr<?php echo $invoice['rowstyle'] ?>>
								<td><?php echo $invoice['invoice_number']; ?></td>
								<td><?php echo $invoice['amount'] . '&nbsp;' . $invoice['currency_code']; ?></td>
								<td><?php echo $invoice['transactiondate']; ?></td>
								<td><?php echo $invoice['processor']; ?></td>
								<td><?php echo $invoice['actions']; ?></td>
							</tr>
							<?php
						} ?>
					</table>
					<?php
					break;
				case 'details':
					if ( $mi ) {
						echo $mi;
					}
					break;
				default:
					echo $custom;
					break;
			}
			?>
		</div><div class="aec_clearfix"></div>
		<?php
	}

	function notAllowed( $option, $processors, $registerlink, $loggedin = 0 )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( !is_object( $this ) ) {
			HTML_frontEnd::aec_styling();
		} ?>
		<?php
		if ( $aecConfig->cfg['customtext_notallowed_keeporiginal'] ) {?>
			<div class="componentheading"><?php echo _NOT_ALLOWED_HEADLINE; ?></div>
			<p>
				<?php
				if ( $loggedin ) {
					echo _NOT_ALLOWED_FIRSTPAR_LOGGED; ?>&nbsp;
					<a href="<?php echo $registerlink; ?>" title="<?php echo _NOT_ALLOWED_REGISTERLINK_LOGGED; ?>"><?php echo _NOT_ALLOWED_REGISTERLINK_LOGGED; ?></a>
					<?php
				} else {
					echo _NOT_ALLOWED_FIRSTPAR; ?>&nbsp;
					<a href="<?php echo $registerlink; ?>" title="<?php echo _NOT_ALLOWED_REGISTERLINK; ?>"><?php echo _NOT_ALLOWED_REGISTERLINK; ?></a>
					<?php
				} ?>
			</p>
			<?php
		}
		if ( $aecConfig->cfg['customtext_notallowed'] ) { ?>
			<?php echo $aecConfig->cfg['customtext_notallowed']; ?>
		<?php } ?>
		<?php
		if ( !empty( $processors ) && !empty( $aecConfig->cfg['gwlist'] ) ) { ?>
			<p>&nbsp;</p>
			<p><?php echo _NOT_ALLOWED_SECONDPAR; ?></p>
			<table id="cc_list">
				<?php
				foreach ( $processors as $processor ) {
					HTML_frontEnd::processorInfo( $option, $processor, $aecConfig->cfg['displayccinfo'] );
				} ?>
			</table>
			<?php
		}
		?><div class="aec_clearfix"></div><?php
	}

	function processorInfo( $option, $processorObj, $displaycc = 1 )
	{
		global $aecConfig;

		if ( empty( $aecConfig->cfg['gwlist'] ) ) {
			return;
		}

		if ( !in_array( $processorObj->processor_name, $aecConfig->cfg['gwlist'] ) ) {
			return;
		}

		?>
		<tr>
			<td class="cc_gateway">
				<p align="center"><img src="<?php echo JURI::root() . 'media/' . $option . '/images/site/gwlogo_' . $processorObj->processor_name . '.png" alt="' . $processorObj->processor_name . '" title="' . $processorObj->processor_name; ?>" /></p>
			</td>
			<td class="cc_icons">
				<p>
					<?php
					if ( isset( $processorObj->info['description'] ) ) {
						echo $processorObj->info['description'];
					} ?>
				</p>
			</td>
		</tr>
		<?php
		if ( $displaycc && !empty( $processorObj->info['cc_list'] ) ) { ?>
			<tr>
				<td class="cc_gateway"></td>
				<td class="cc_icons">
					<?php
					if ( isset( $processorObj->settings['cc_icons'] ) ) {
						echo Payment_HTML::getCCiconsHTML ( $option, $processorObj->settings['cc_icons'] );
					} else {
						echo Payment_HTML::getCCiconsHTML ( $option, $processorObj->info['cc_list'] );
					}
					?>
				</td>
			</tr>
			<?php
		}
		?><div class="aec_clearfix"></div><?php
	}

	/**
	 * Formats a given date
	 *
	 * @param string	$SQLDate
	 * @param bool		$check		check time diference
	 * @param bool		$display	out with text (only in combination with $check)
	 * @return formatted date
	 */
	function DisplayDateInLocalTime( $SQLDate, $check = false, $display = false, $trial = false )
	{
		global $aecConfig;

		if ( $SQLDate == '' ) {
			return _AEC_EXPIRE_NOT_SET;
		} else {
			$database = &JFactory::getDBO();

			$retVal = strftime( $aecConfig->cfg['display_date_frontend'], strtotime( $SQLDate ) );

			if ( $check ) {
				$timeDif = strtotime( $SQLDate ) - time();
				if ( $timeDif < 0 ) {
					$retVal = ( $trial ? _AEC_EXPIRE_TRIAL_PAST : _AEC_EXPIRE_PAST ) . ':&nbsp;<strong>' . $retVal . '</strong>';
				} elseif ( ( $timeDif >= 0 ) && ( $timeDif < 86400 ) ) {
					$retVal = ( $trial ? _AEC_EXPIRE_TRIAL_TODAY : _AEC_EXPIRE_TODAY );
				} else {
					$retVal = ( $trial ? _AEC_EXPIRE_TRIAL_FUTURE : _AEC_EXPIRE_FUTURE ) . ': ' . $retVal;
				}
			}

			return $retVal;
		}
	}

}

class HTML_Results
{
	function thanks( $option, $msg )
	{
		global $aecConfig;

		HTML_frontend::aec_styling( $option );

		echo $msg;
	}

	function cancel( $option )
	{
		global $aecConfig;

		HTML_frontend::aec_styling( $option );

		?>
		<div class="componentheading"><?php echo _CANCEL_TITLE; ?></div>
		<?php
		if ( $aecConfig->cfg['customtext_cancel'] ) { ?>
			<p><?php echo $aecConfig->cfg['customtext_cancel']; ?></p>
			<?php
		}
		if ( $aecConfig->cfg['customtext_cancel_keeporiginal'] ) { ?>
			<div id="cancel_page">
			<p><?php echo _CANCEL_MSG; ?></p>
			</div>
			<?php
		}
		?><div class="aec_clearfix"></div><?php
	}
}

class Payment_HTML
{
	function selectSubscriptionPlanForm( $option, $userid, $list, $expired, $passthrough=false, $register=false, $cart=false )
	{
		global $aecConfig;

		HTML_frontend::aec_styling( $option );
		?>

		<div class="componentheading"><?php echo _PAYPLANS_HEADER; ?></div>
		<?php if ( !empty( $cart ) ) { ?>
			<div id="checkout">
			<table id="aec_checkout">
			<form name="confirmForm" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option . '&task=cart', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
			<div id="update_button">You can always go back to: <input type="image" src="<?php echo JURI::root() . 'media/com_acctexp/images/site/your_cart_button.png'; ?>" border="0" name="submit" alt="submit" /></div>
			</form><br /><br />
			</table>
			</div>
			<div class="aec_clearfix"></div>
		<?php } ?>
		<div class="subscriptions">
			<?php
			if ( $aecConfig->cfg['customtext_plans'] ) { ?>
				<p><?php echo $aecConfig->cfg['customtext_plans']; ?></p>
				<?php
			} ?>
			<?php
			if ( isset( $list['group'] ) ) { ?>
				<div class="aec_group_backlink">
					<?php
					$urlbutton = JURI::root() . 'media/com_acctexp/images/site/back_button.png';
					echo Payment_HTML::planpageButton( $option, 'subscribe', '', $urlbutton, array(), $userid, $passthrough, 'func_button' );
					?>
				</div>
				<h2><?php echo $list['group']['name']; ?></h2>
				<p><?php echo $list['group']['desc']; ?></p>
				<?php
				unset( $list['group'] );
			} ?>
			<table class="aec_items">
			<?php
			foreach ( $list as $litem ) {
				?>
				<tr><td>
				<div class="aec_ilist_<?php echo $litem['type']; ?> aec_ilist_<?php echo $litem['type'] . '_' . $litem['id']; ?>">
				<?php
				if ( $litem['type'] == 'group' ) {
					?>
						<h2><?php echo $litem['name']; ?></h2>
						<p><?php echo $litem['desc']; ?></p>
						<div class="aec_groupbutton">
							<?php
							$urlbutton = JURI::root() . 'media/com_acctexp/images/site/select_button.png';
							$hidden = array( array( 'group', $litem['id'] ) );
							echo Payment_HTML::planpageButton( $option, 'subscribe', '', $urlbutton, $hidden, $userid, $passthrough );
							?>
						</div>
					<?php
				} else {
					?>
						<h2><?php echo $litem['name']; ?></h2>
						<p><?php echo $litem['desc']; ?></p>
						<div class="aec_procbuttons">
							<?php echo Payment_HTML::getPayButtonHTML( $litem['gw'], $litem['id'], $userid, $passthrough, $register ); ?>
						</div>
					<?php
				}
				?>
				</div>
				</td></tr>
				<?php
			}
			?>
			</table>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

	function getPayButtonHTML( $pps, $planid, $userid, $passthrough = false, $register = false )
	{
		$html_code = '';

		$imgroot = JURI::root() . 'media/com_acctexp/images/site/';

		foreach ( $pps as $pp ) {
			$gw_current = strtolower( $pp->processor_name );

			$view = '';

			if ( $gw_current == 'add_to_cart' ) {
				$option		= 'com_acctexp';
				$task		= 'addtocart';
				$urlbutton	= $imgroot . 'add_to_cart_button.png';

				$hidden = array();
				if ( !empty( $planid ) ) {
					$hidden[] = array( 'usage', $planid );
				}
			} else {
				if ( $register ) {
					if ( GeneralInfoRequester::detect_component( 'anyCB' ) ) {
						$option	= 'com_comprofiler';
						$task	= 'registers';
					} elseif ( GeneralInfoRequester::detect_component( 'JOMSOCIAL' ) ) {
						$option	= 'com_community';
						$task	= '';
						$view 	= 'register';
					} elseif ( aecJoomla15check() ) {
						$option	= 'com_user';
						$task	= '';
						$view 	= 'register';
					} else {
						$option	= 'com_acctexp';
						$task	= 'subscribe';
					}
				} else {
					$option		= 'com_acctexp';
					$task		= 'confirm';
				}

				if ( !empty( $pp->settings['generic_buttons'] ) ) {
					if ( !empty( $pp->recurring ) ) {
						$urlbutton = $imgroot . 'gw_button_generic_subscribe.png';
					} else {
						$urlbutton = $imgroot . 'gw_button_generic_buy_now.png';
					}
				} else {
					if ( isset( $pp->info['recurring_buttons'] ) ) {
						if ( $pp->recurring ) {
							$urlbutton = $imgroot . 'gw_button_' . $pp->processor_name . '_recurring_1' . '.png';
						} else {
							$urlbutton = $imgroot . 'gw_button_' . $pp->processor_name . '_recurring_0' . '.png';
						}
					} else {
						$urlbutton = $imgroot . 'gw_button_' . $pp->processor_name . '.png';
					}
				}

				$hidden = array();

				if ( !empty( $pp->recurring ) ) {
					$hidden[] = array( 'recurring', 1 );
				} else {
					$hidden[] = array( 'recurring', 0 );
				}

				$hidden[] = array( 'processor', strtolower( $pp->processor_name ) );

				if ( !empty( $planid ) ) {
					$hidden[] = array( 'usage', $planid );
				}
			}

			$html_code .= Payment_HTML::planpageButton( $option, $task, $view, $urlbutton, $hidden, $userid, $passthrough );
		}

		return $html_code;
	}

	function planpageButton( $option, $task, $view, $urlbutton, $hidden, $userid, $passthrough, $class="gateway_button" )
	{
		global $aecConfig;

		$t = "";
		if ( !empty( $task ) ) {
			$t = '&amp;task=' . $task;
		}

		if ( !empty( $view ) ) {
			$t = '&amp;view=' . $view;
		}

		$html_code = '';
		$html_code .= '<div class="' . $class . '">' . "\n"
		. '<form action="' . AECToolbox::deadsureURL( 'index.php?option=' . $option . $t, $aecConfig->cfg['ssl_signup'] ) . '"'
		. ' method="post">' . "\n"
		. '<input type="image" src="' . $urlbutton . '" border="0" name="submit" alt="submit" />';

		$hidden[] = array( 'option', $option );

		if ( !empty( $task ) ) {
			$hidden[] = array( 'task', $task );
		}

		if ( !empty( $view ) ) {
			$hidden[] = array( 'view', $view );
		}

		$hidden[] = array( 'userid', ( $userid ? $userid : 0 ) );

		// Rewrite Passthrough
		if ( !empty( $passthrough ) ) {
			$hidden[] = array( 'aec_passthrough', $passthrough );
		}

		// Assemble hidden fields
		foreach ( $hidden as $h ) {
			$html_code .= '<input type="hidden" name="' . $h[0] . '" value="' . $h[1] . '" />' . "\n";
		}

		$html_code .= '</form></div>' . "\n";

		return $html_code;
	}

	function getCCiconsHTML( $option, $cc_list )
	{
		// This function first looks whether a specific gateway has been asked for,
		// if that is the case, it creates a cc list that is to be passed on.
		// If there was no gateway specified, it passes the cc list on to the next function
		$html_code	= '';
		// Function to create a string of images by a list of CreditCards
		if ( is_array( $cc_list ) ) {
			$cc_array = $cc_list;
		} else {
			$cc_array = explode( ',', $cc_list );
		}

		for( $i = 0; $i < count( $cc_array ); $i++ ) {
			$html_code .= '<img src="' . JURI::root() . 'media/' . $option
			. '/images/site/cc_icons/ccicon_' . $cc_array[$i] . '.png"'
			. ' alt="' . $cc_array[$i] . '"'
			. ' title="' . $cc_array[$i] . '"'
			. ' class="cc_icon" />';
		}

		return $html_code;
	}

	function promptpassword( $option, $passthrough, $wrong )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;
		?>
		<div id="box_pending">
			<p><?php echo _AEC_PROMPT_PASSWORD; ?></p>
			<?php
				if ( $wrong ) {
					echo '<p><strong>' . _AEC_PROMPT_PASSWORD_WRONG . '</strong></p>';
				}
			?>
			<div id="upgrade_button">
				<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
					<input type="password" size="20" class="inputbox" id="password" name="password"/>
					<?php if ( $passthrough != false ) {
						$pt = unserialize( base64_decode( $passthrough ) );

						if ( isset( $pt['task'] ) ) {
							echo '<input type="hidden" name="task" value="' . $pt['task'] . '" />';
						}

						if ( isset( $pt['userid'] ) ) {
							echo '<input type="hidden" name="userid" value="' . $pt['userid'] . '" />';
						} ?>
						<input type="hidden" name="aec_passthrough" value="<?php echo $passthrough; ?>" />
					<?php } ?>
					<input type="submit" class="button" value="<?php echo _AEC_PROMPT_PASSWORD_BUTTON;?>" />
				</form>
			</div>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

	function confirmForm( $option, $InvoiceFactory, $user, $passthrough = false)
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		HTML_frontend::aec_styling( $option );
		?>

		<div class="componentheading"><?php echo _CONFIRM_TITLE; ?></div>
		<?php
		if ( !empty( $aecConfig->cfg['tos'] ) ) { ?>
			<script type="text/javascript">
				/* <![CDATA[ */
				function submitPayment() {
					if ( document.confirmForm.tos.checked ) {
						document.confirmForm.submit();
					} else {
						alert("<?php echo html_entity_decode( _CONFIRM_TOS_ERROR ); ?>");
					}
				}
				/* ]]> */
			</script>
			<?php
		} ?>
		<div id="confirmation">
			<div id="confirmation_info">
				<table>
					<tr>
						<th><?php echo _CONFIRM_COL1_TITLE; ?></th>
						<th><?php echo _CONFIRM_COL2_TITLE; ?></th>
						<th><?php echo _CONFIRM_COL3_TITLE; ?></th>
					</tr>
					<tr>
						<td><?php echo $InvoiceFactory->userdetails; ?></td>
						<td><p><?php echo $InvoiceFactory->plan->name; ?></p></td>
						<td><p><?php echo $InvoiceFactory->payment->amount_format ?></p></td>
					</tr>
					<?php if ( $aecConfig->cfg['confirmation_changeusername'] || $aecConfig->cfg['confirmation_changeusage'] ) { ?>
					<tr>
						<td>
							<?php if ( empty( $user->id ) && $aecConfig->cfg['confirmation_changeusername'] ) { ?>
								<form class="aectextright" name="backFormUserDetails" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
									<input type="hidden" name="option" value="<?php echo $option; ?>" />
									<input type="hidden" name="userid" value="<?php echo $user->id ? $user->id : 0; ?>" />
									<input type="hidden" name="task" value="subscribe" />
									<input type="hidden" name="usage" value="<?php echo $InvoiceFactory->usage; ?>" />
									<input type="hidden" name="processor" value="<?php echo $InvoiceFactory->processor; ?>" />
									<input type="hidden" name="recurring" value="<?php echo $InvoiceFactory->recurring;?>" />
									<input type="hidden" name="forget" value="userdetails" />
									<?php if ( $passthrough != false ) { ?>
										<input type="hidden" name="aec_passthrough" value="<?php echo $InvoiceFactory->getPassthrough( 'userdetails' ); ?>" />
									<?php } ?>
									<button class="aeclink" type="submit"><span>Want to change the user details?</span></button>
								</form>
							<?php } ?>
						</td>
						<td colspan="2">
							<?php if ( $aecConfig->cfg['confirmation_changeusage'] ) { ?>
								<form class="aectextright" name="backFormUserDetails" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
									<input type="hidden" name="option" value="<?php echo $option; ?>" />
									<input type="hidden" name="userid" value="<?php echo $user->id ? $user->id : 0; ?>" />
									<input type="hidden" name="task" value="subscribe" />
									<input type="hidden" name="forget" value="usage" />
									<?php if ( $passthrough != false ) { ?>
										<input type="hidden" name="aec_passthrough" value="<?php echo $InvoiceFactory->getPassthrough( 'usage' ); ?>" />
									<?php } ?>
									<button class="aeclink" type="submit"><span>Wanted to select a different item?</span></button>
								</form>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="4" class="confirmation_description"><?php echo stripslashes( $InvoiceFactory->plan->desc ); ?></td>
					</tr>
				</table>
			</div>
			<form name="confirmForm" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
			<table>
				<tr>
					<td id="confirmation_extra">
						<?php if ( !empty( $InvoiceFactory->mi_form ) ) {
							if ( !empty( $InvoiceFactory->mi_error ) ) {
								echo '<div id="confirmation_error">';
								foreach ( $InvoiceFactory->mi_error as $error ) {
									echo '<p>' . $error . '</p>';
								}
								echo '</div>';
							}
							echo '<div id="confirmation_extra">' . $InvoiceFactory->mi_form . '</div>';
						} ?>
						<?php
						if ( $aecConfig->cfg['customtext_confirm'] ) { ?>
							<p><?php echo $aecConfig->cfg['customtext_confirm']; ?></p>
							<?php
						}
						if ( $aecConfig->cfg['customtext_confirm_keeporiginal'] ) { ?>
							<p><?php echo _CONFIRM_INFO; ?></p>
							<?php
						}
						if ( $InvoiceFactory->coupons['active'] ) {
							if ( !empty( $aecConfig->cfg['confirmation_coupons'] ) ) {
								?><p><?php echo _CONFIRM_COUPON_INFO_BOTH; ?></p><?php
							} else {
								?><p><?php echo _CONFIRM_COUPON_INFO; ?></p><?php
							}
						} ?>
						<?php if ( !empty( $aecConfig->cfg['confirmation_coupons'] ) ) { ?>
							<strong><?php echo _CHECKOUT_COUPON_CODE; ?></strong>
							<input type="text" size="20" name="coupon_code" class="inputbox" value="" />
						<?php } ?>
					</td>
				</tr>
				<?php
				$makegift = false;

				if ( !empty( $aecConfig->cfg['confirm_as_gift'] ) ) {
					if ( !empty( $aecConfig->cfg['checkout_as_gift_access'] ) ) {
						// Apparently, we cannot trust $user->gid
						$groups = GeneralInfoRequester::getLowerACLGroup( $InvoiceFactory->metaUser->cmsUser->gid );

						if ( in_array( $aecConfig->cfg['checkout_as_gift_access'], $groups ) ) {
							$makegift = true;
						}
					} else {
						$makegift = true;
					}
				}

				if ( $makegift ) { ?>
						<tr>
							<td class="couponinfo">
								<strong><?php echo _CHECKOUT_GIFT_HEAD; ?></strong>
							</td>
						</tr>
						<tr>
							<td class="giftdetails">
								<?php if ( !empty( $InvoiceFactory->invoice->params['target_user'] ) ) { ?>
									<p>This purchase will be gifted to: <?php echo $InvoiceFactory->invoice->params['target_username']; ?> (<a href="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=InvoiceRemoveGiftConfirm&amp;invoice='.$InvoiceFactory->invoice->invoice_number, $aecConfig->cfg['ssl_signup'] ); ?>">undo?</a>)</p>
								<?php } else { ?>
									<p><?php echo _CHECKOUT_GIFT_INFO; ?></p>
									<input type="text" size="20" name="user_ident" class="inputbox" value="" />
								<?php } ?>
							</td>
						</tr>
					<?php
				} ?>
				<tr>
					<td id="confirmation_button">
					<div id="confirmation_button">
						<input type="hidden" name="option" value="<?php echo $option; ?>" />
						<input type="hidden" name="userid" value="<?php echo $user->id ? $user->id : 0; ?>" />
						<input type="hidden" name="task" value="saveSubscription" />
						<input type="hidden" name="usage" value="<?php echo $InvoiceFactory->usage; ?>" />
						<input type="hidden" name="processor" value="<?php echo $InvoiceFactory->processor; ?>" />
						<?php if ( isset( $InvoiceFactory->recurring ) ) { ?>
						<input type="hidden" name="recurring" value="<?php echo $InvoiceFactory->recurring;?>" />
						<?php }
						if ( !empty( $aecConfig->cfg['tos_iframe'] ) && !empty( $aecConfig->cfg['tos'] ) ) { ?>
							<iframe src="<?php echo $aecConfig->cfg['tos']; ?>" width="100%" height="150px"></iframe>
							<p><input name="tos" type="checkbox" /><?php echo _CONFIRM_TOS_IFRAME; ?></p>
							<input type="button" onclick="javascript:submitPayment()" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
							<?php
						} elseif ( !empty( $aecConfig->cfg['tos'] ) ) { ?>
							<p><input name="tos" type="checkbox" /><?php echo sprintf( _CONFIRM_TOS, $aecConfig->cfg['tos'] ); ?></p>
							<input type="button" onclick="javascript:submitPayment()" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
							<?php
						} else { ?>
							<input type="submit" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
							<?php
						} ?>
						<?php if ( $passthrough != false ) { ?>
							<input type="hidden" name="aec_passthrough" value="<?php echo $passthrough; ?>" />
						<?php } ?>
					</div>
					</td>
				</tr>
				<tr><td>
					<table>
						<?php if ( is_object( $InvoiceFactory->pp ) ) {
							HTML_frontEnd::processorInfo( $option, $InvoiceFactory->pp, $aecConfig->cfg['displayccinfo'] );
						} ?>
					</table>
				</td></tr>
			</table>
			</form>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

	function cart( $option, $InvoiceFactory )
	{
		global $aecConfig;

		$database = &JFactory::getDBO();

		HTML_frontend::aec_styling( $option );
		?>

		<div class="componentheading"><?php echo _CART_TITLE; ?></div>
		<?php
		if ( !empty( $aecConfig->cfg['tos'] ) ) { ?>
			<script type="text/javascript">
				/* <![CDATA[ */
				function submitPayment() {
					if ( document.confirmForm.tos.checked ) {
						document.confirmForm.submit();
					} else {
						alert("<?php echo html_entity_decode( _CONFIRM_TOS_ERROR ); ?>");
					}
				}
				/* ]]> */
			</script>
			<?php
		} ?>
		<div id="confirmation">
			<div id="confirmation_info">
				<?php if ( empty( $InvoiceFactory->cart ) ) { ?>
				<p>Your Shopping Cart is empty!</p>
				<?php } else { ?>
				<p>&nbsp;</p>
				<div id="update_button"><a href="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option . '&task=clearCart', $aecConfig->cfg['ssl_signup'] ); ?>">clear the whole cart</a></div>
				<form name="confirmForm" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
				<table>
					<tr>
						<th>Item</th>
						<th>Cost</th>
						<th>Amount</th>
						<th>Total</th>
					</tr>
					<?php
					foreach ( $InvoiceFactory->cart as $bid => $bitem ) {
						if ( !empty( $bitem['name'] ) ) {
							?><tr>
								<td><?php echo $bitem['name']; ?></td>
								<td><?php echo $bitem['cost']; ?></td>
								<td><input type="inputbox" type="text" size="2" name="cartitem_<?php echo $bid; ?>" value="<?php echo $bitem['quantity']; ?>" /></td>
								<td><?php echo $bitem['cost_total']; ?></td>
							</tr><?php
						} else {
							?><tr>
								<td><strong><?php echo _CART_ROW_TOTAL; ?></strong></td>
								<td></td>
								<td></td>
								<td><strong><?php echo $bitem['cost']; ?></strong></td>
							</tr><?php
						}
					}
					?>
				</table>
				<input type="hidden" name="option" value="<?php echo $option; ?>" />
				<input type="hidden" name="userid" value="<?php echo $user->id ? $user->id : 0; ?>" />
				<input type="hidden" name="task" value="updateCart" />
				<div id="update_button"><input type="image" src="<?php echo JURI::root() . 'media/com_acctexp/images/site/update_button.png'; ?>" border="0" name="submit" alt="submit" /></div>
				</form>
				<?php } ?>
				<?php if ( empty( $InvoiceFactory->userid ) ) { ?>
				<p>Save Registration to Continue Shopping functionlink:confirm_savereg</p>
				<?php } else {
					if ( !empty( $aecConfig->cfg['customlink_continueshopping'] ) ) {
						$continueurl = $aecConfig->cfg['customlink_continueshopping'];
					} else {
						$continueurl = AECToolbox::deadsureURL( 'index.php?option=' . $option . '&task=subscribe', $aecConfig->cfg['ssl_signup'] );
					}
				?>
				<div id="continue_button">
					<form name="confirmForm" action="<?php echo $continueurl; ?>" method="post">
						<input type="image" src="<?php echo JURI::root() . 'media/com_acctexp/images/site/continue_shopping_button.png'; ?>" border="0" name="submit" alt="submit" />
					</form>
				</div>
				<?php } ?>
			</div>
			<?php if ( !empty( $InvoiceFactory->cart ) ) { ?>
			<form name="confirmForm" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option, $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
			<table>
				<tr>
					<td id="confirmation_extra">
						<?php if ( !empty( $InvoiceFactory->mi_form ) ) {
							if ( !empty( $InvoiceFactory->mi_error ) ) {
								echo '<div id="confirmation_error">';
								foreach ( $InvoiceFactory->mi_error as $error ) {
									echo '<p>' . $error . '</p>';
								}
								echo '</div>';
							}
							echo '<div id="confirmation_extra">' . $InvoiceFactory->mi_form . '</div>';
						} ?>
						<?php
						if ( $aecConfig->cfg['customtext_confirm'] ) { ?>
							<p><?php echo $aecConfig->cfg['customtext_confirm']; ?></p>
							<?php
						}
						if ( $aecConfig->cfg['customtext_confirm_keeporiginal'] ) { ?>
							<p><?php echo _CART_INFO; ?></p>
							<?php
						} ?>
					</td>
				</tr>
				<?php
				$makegift = false;

				if ( !empty( $aecConfig->cfg['confirm_as_gift'] ) ) {
					if ( !empty( $aecConfig->cfg['checkout_as_gift_access'] ) ) {
						// Apparently, we cannot trust $user->gid
						$groups = GeneralInfoRequester::getLowerACLGroup( $InvoiceFactory->metaUser->cmsUser->gid );

						if ( in_array( $aecConfig->cfg['checkout_as_gift_access'], $groups ) ) {
							$makegift = true;
						}
					} else {
						$makegift = true;
					}
				}

				if ( $makegift ) { ?>
						<tr>
							<td class="couponinfo">
								<strong><?php echo _CHECKOUT_GIFT_HEAD; ?></strong>
							</td>
						</tr>
						<tr>
							<td class="giftdetails">
								<?php if ( !empty( $InvoiceFactory->invoice->params['target_user'] ) ) { ?>
									<p>This purchase will be gifted to: <?php echo $InvoiceFactory->invoice->params['target_username']; ?> (<a href="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=InvoiceRemoveGiftCart&amp;invoice='.$InvoiceFactory->invoice->invoice_number, $aecConfig->cfg['ssl_signup'] ); ?>">undo?</a>)</p>
								<?php } else { ?>
									<p><?php echo _CHECKOUT_GIFT_INFO; ?></p>
									<input type="text" size="20" name="user_ident" class="inputbox" value="" />
								<?php } ?>
							</td>
						</tr>
					<?php
				} ?>
				<tr>
					<td id="confirmation_button">
					<div id="confirmation_button">
						<input type="hidden" name="option" value="<?php echo $option; ?>" />
						<input type="hidden" name="userid" value="<?php echo $user->id ? $user->id : 0; ?>" />
						<input type="hidden" name="task" value="confirmCart" />
						<?php if ( isset( $InvoiceFactory->recurring ) ) { ?>
						<input type="hidden" name="recurring" value="<?php echo $InvoiceFactory->recurring;?>" />
						<?php }
						if ( !empty( $aecConfig->cfg['tos_iframe'] ) && !empty( $aecConfig->cfg['tos'] ) ) { ?>
							<iframe src="<?php echo $aecConfig->cfg['tos']; ?>" width="100%" height="150px"></iframe>
							<p><input name="tos" type="checkbox" /><?php echo _CONFIRM_TOS_IFRAME; ?></p>
							<input type="button" onclick="javascript:submitPayment()" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
							<?php
						} elseif ( !empty( $aecConfig->cfg['tos'] ) ) { ?>
							<p><input name="tos" type="checkbox" /><?php echo sprintf( _CONFIRM_TOS, $aecConfig->cfg['tos'] ); ?></p>
							<input type="button" onclick="javascript:submitPayment()" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
							<?php
						} else { ?>
							<input type="submit" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
							<?php
						} ?>
					</div>
					</td>
				</tr>
				<tr><td>
					<table>
						<?php
						if ( !empty( $InvoiceFactory->pp ) ) {
							if ( is_object( $InvoiceFactory->pp ) ) {
								HTML_frontEnd::processorInfo( $option, $InvoiceFactory->pp, $aecConfig->cfg['displayccinfo'] );
							}
						} ?>
					</table>
				</td></tr>
			</table>
			</form>
			<?php } ?>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

	function checkoutForm( $option, $var, $params = null, $InvoiceFactory, $error = null, $repeat = 0 )
	{
		global $aecConfig;

		$database = &JFactory::getDBO();

		$user = &JFactory::getUser();

		HTML_frontend::aec_styling( $option );

		$introtext = '_CHECKOUT_INFO' . ( $repeat ? '_REPEAT' : '' );

		?>
		<div class="componentheading"><?php echo _CHECKOUT_TITLE; ?></div>
		<div id="checkout">
			<?php
			if ( $aecConfig->cfg['customtext_checkout_keeporiginal'] ) { ?>
				<p><?php echo sprintf( constant( $introtext ), $InvoiceFactory->invoice->invoice_number ); ?></p>
				<?php
			}

			$InvoiceFactory->invoice->deformatInvoiceNumber();

			if ( $aecConfig->cfg['customtext_checkout'] ) { ?>
				<p><?php echo $aecConfig->cfg['customtext_checkout']; ?></p>
				<?php
			} ?>
			<table id="aec_checkout">
			<?php if ( !empty( $InvoiceFactory->cartobject ) && !empty( $InvoiceFactory->cart ) ) { ?>
				<form name="confirmForm" action="<?php echo AECToolbox::deadsureURL( 'index.php?option=' . $option . '&task=cart', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
				<div id="update_button">You can always go back to: <input type="image" src="<?php echo JURI::root() . 'media/com_acctexp/images/site/your_cart_button.png'; ?>" border="0" name="submit" alt="submit" /></div>
				</form><br /><br />
			<?php } ?>
			<?php
				foreach ( $InvoiceFactory->items as $item ) {
					if ( !empty( $item['terms'] ) ) {
						$terms = $item['terms']->getTerms();
					} else {
						$terms = false;
					}

					foreach ( $terms as $tid => $term ) {
						if ( !is_object( $term ) ) {
							continue;
						}

						$ttype = 'aec_termtype_' . $term->type;

						$applicable = ( $tid >= $item['terms']->pointer ) ? '' : '&nbsp;('._AEC_CHECKOUT_NOTAPPLICABLE.')';

						$current = ( $tid == $item['terms']->pointer ) ? ' current_period' : '';

						$add = "";

						if ( isset( $item['quantity'] ) ) {
							if ( $item['quantity'] > 1 ) {
								$add = " (x" . $item['quantity'] . ")";
							}
						}

						if ( isset( $item['name'] ) ) {
							// This is an item, show its name (skip for total)
							echo '<tr><td><h4>' . $item['name'] . $add . '</h4></td></tr>';
						}

						if ( isset( $item['desc'] ) && $aecConfig->cfg['checkout_display_descriptions'] ) {
							// This is an item, show its name (skip for total)
							echo '<tr><td>' . $item['desc'] . '</td></tr>';
						}

						if ( defined( strtoupper( '_' . $ttype ) ) ) {
							// Headline - What type is this term
							echo '<tr class="aec_term_typerow' . $current . '"><th colspan="2" class="' . $ttype . '">' . constant( strtoupper( '_' . $ttype ) ) . $applicable . '</th></tr>';
						} else {
							echo '<tr class="aec_term_totalhead' . $current . '"><th colspan="2" class="' . $ttype . '">' . _CART_ROW_TOTAL . '</th></tr>';
						}

						if ( !isset( $term->duration['none'] ) ) {
							// Subheadline - specify the details of this term
							echo '<tr class="aec_term_durationrow' . $current . '"><td colspan="2" class="aec_term_duration">' . _AEC_CHECKOUT_DURATION . ': ' . $term->renderDuration() . '</td></tr>';
						}

						// Iterate through costs
						foreach ( $term->renderCost() as $citem ) {
							$t = constant( strtoupper( '_aec_checkout_' . $citem->type ) );

							if ( isset( $item['quantity'] ) ) {
								$amount = AECToolbox::correctAmount( $citem->cost['amount'] * $item['quantity'] );
							} else {
								$amount = AECToolbox::correctAmount( $citem->cost['amount'] );
							}

							$c = AECToolbox::formatAmount( $amount, $InvoiceFactory->payment->currency );

							switch ( $citem->type ) {
								case 'discount':
									$ta = $t;
									if ( !empty( $citem->cost['details'] ) ) {
										$ta .= '&nbsp;(' . $citem->cost['details'] . ')';
									}
									$ta .= '&nbsp;[<a href="'
										. AECToolbox::deadsureURL( 'index.php?option=' . $option
										. '&amp;task=InvoiceRemoveCoupon&amp;invoice=' . $InvoiceFactory->invoice->invoice_number
										. '&amp;coupon_code=' . $citem->cost['coupon'] )
										. '" title="' . _CHECKOUT_INVOICE_COUPON_REMOVE . '">'
										. _CHECKOUT_INVOICE_COUPON_REMOVE . '</a>]';

									$t = $ta;

									// Strip out currency symbol and replace with blanks
									if ( !$aecConfig->cfg['amount_currency_symbolfirst'] ) {
										$strlen = 2;

										if ( !$aecConfig->cfg['amount_currency_symbol'] ) {
											$strlen = 1 + strlen( $InvoiceFactory->payment->currency ) * 2;
										}

										for( $i=0; $i<=$strlen+1;$i++ ) {
											//$c .= '&nbsp;';
										}
									}
									break;
								case 'tax':
									$t .= '&nbsp;( ' . $citem->cost['details'] . ' )';
									break;
								case 'cost': break;
								case 'total': break;
								default: break;
							}

							echo '<tr class="aec_term_' . $citem->type . 'row' . $current . '"><td class="aec_term_' . $citem->type . 'title">' . $t . ':' . '</td><td class="aec_term_' . $citem->type . 'amount">' . $c . '</td></tr>';
						}

						// Draw Separator Line
						echo '<tr class="aec_term_row_sep"><td colspan="2"></td></tr>';
					}
				}
			?>
			</table>

			<?php
			if ( !empty( $aecConfig->cfg['enable_coupons'] ) ) { ?>
				<table width="100%" id="couponsbox">
					<tr>
						<td class="couponinfo">
							<strong><?php echo _CHECKOUT_COUPON_CODE; ?></strong>
						</td>
					</tr>
					<?php
					if ( !empty( $InvoiceFactory->errors ) ) {
						foreach ( $InvoiceFactory->errors as $err ) { ?>
						<tr>
							<td class="couponerror">
								<p>
									<strong><?php echo _COUPON_ERROR_PRETEXT; ?></strong>
									&nbsp;
									<?php echo $err; ?>
								</p>
							</td>
						</tr>
						<?php
						}
					} ?>
					<tr>
						<td class="coupondetails">
							<p><?php echo _CHECKOUT_COUPON_INFO; ?></p>
							<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=InvoiceAddCoupon', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
								<input type="text" size="20" name="coupon_code" class="inputbox" value="" />
								<input type="hidden" name="option" value="<?php echo $option; ?>" />
								<input type="hidden" name="task" value="InvoiceAddCoupon" />
								<input type="hidden" name="invoice" value="<?php echo $InvoiceFactory->invoice->invoice_number; ?>" />
								<input type="submit" class="button" value="<?php echo _BUTTON_APPLY; ?>" />
							</form>
						</td>
					</tr>
				</table>
				<?php
			}

			$makegift = false;

			if ( !empty( $aecConfig->cfg['checkout_as_gift'] ) ) {
				if ( !empty( $aecConfig->cfg['checkout_as_gift_access'] ) ) {
					// Apparently, we cannot trust $user->gid
					$groups = GeneralInfoRequester::getLowerACLGroup( $InvoiceFactory->metaUser->cmsUser->gid );

					if ( in_array( $aecConfig->cfg['checkout_as_gift_access'], $groups ) ) {
						$makegift = true;
					}
				} else {
					$makegift = true;
				}
			}

			if ( $makegift ) { ?>
				<table width="100%" id="giftbox">
					<tr>
						<td class="couponinfo">
							<strong><?php echo _CHECKOUT_GIFT_HEAD; ?></strong>
						</td>
					</tr>
					<tr>
						<td class="giftdetails">
							<?php if ( !empty( $InvoiceFactory->invoice->params['target_user'] ) ) { ?>
								<p>This purchase will be gifted to: <?php echo $InvoiceFactory->invoice->params['target_username']; ?> (<a href="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=InvoiceRemoveGift&amp;invoice='.$InvoiceFactory->invoice->invoice_number, $aecConfig->cfg['ssl_signup'] ); ?>">undo?</a>)</p>
							<?php } else { ?>
							<p><?php echo _CHECKOUT_GIFT_INFO; ?></p>
							<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=InvoiceMakeGift', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
								<input type="text" size="20" name="user_ident" class="inputbox" value="" />
								<input type="hidden" name="option" value="<?php echo $option; ?>" />
								<input type="hidden" name="task" value="InvoiceMakeGift" />
								<input type="hidden" name="invoice" value="<?php echo $InvoiceFactory->invoice->invoice_number; ?>" />
								<input type="submit" class="button" value="<?php echo _BUTTON_APPLY; ?>" />
							</form>
							<?php } ?>
						</td>
					</tr>
				</table>
				<?php
			}
			if ( !empty( $params ) ) { ?>
				<table width="100%" id="paramsbox">
					<tr>
						<td class="append_button">
							<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=InvoiceAddParams', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
								<?php echo $params; ?>
								<input type="hidden" name="option" value="<?php echo $option; ?>" />
								<input type="hidden" name="task" value="InvoiceAddParams" />
								<input type="hidden" name="invoice" value="<?php echo $InvoiceFactory->invoice->invoice_number; ?>" />
								<input type="submit" class="button" value="<?php echo _BUTTON_APPEND; ?>" />
							</form>
						</td>
					</tr>
				</table>
				<?php
			}

		$var = trim ( $var );

		if ( $var == "<p></p>" ) {
			$var = null;
		}

		if ( !empty( $var ) ) { ?>
		<table width="100%" id="checkoutbox">
			<tr><th><?php echo _CHECKOUT_TITLE; ?></th></tr>
		<?php if ( is_string( $error ) ) { ?>
			<tr>
				<td class="checkout_error">
					<p>
						<?php echo _CHECKOUT_ERROR_EXPLANATION . ":"; ?>&nbsp;<strong><?php echo $error; ?></strong>
					</p>
				</td>
			</tr>
		<?php } ?>
			<tr>
				<td class="checkout_action">
					<?php
					print $var;
					?>
				</td>
			</tr>
		<?php } ?>
		</table>
		<table width="100%">
			<tr><td>
				<?php
				if ( !empty( $InvoiceFactory->pp ) ) {
					if ( is_object( $InvoiceFactory->pp ) ) {
						HTML_frontEnd::processorInfo( $option, $InvoiceFactory->pp, $aecConfig->cfg['displayccinfo'] );
					}
				}
				?>
			</td></tr>
		</table>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

	function exceptionForm( $option, $InvoiceFactory, $aecHTML, $hasform )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		HTML_frontend::aec_styling( $option );

		?>
		<div class="componentheading"><?php echo $hasform ? _EXCEPTION_TITLE : _EXCEPTION_TITLE_NOFORM ; ?></div>
		<div id="checkout">
			<?php
			if ( $aecConfig->cfg['customtext_exception_keeporiginal'] ) { ?>
				<p><?php echo $hasform ? _EXCEPTION_INFO : ""; ?></p>
				<?php
			}
			if ( $aecConfig->cfg['customtext_exception'] ) { ?>
				<p><?php echo $aecConfig->cfg['customtext_exception']; ?></p>
				<?php
			} ?>
			<table id="aec_checkout">
			<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=addressException', $aecConfig->cfg['ssl_signup'] ); ?>" method="post">
			<?php
				foreach ( $InvoiceFactory->exceptions as $eid => $ex ) {
					if ( !empty( $ex['head'] ) ) {
						// Headline - What type is this term
						echo '<tr><th colspan="2">' . $ex['head'] . '</th></tr>';
					}

					if ( !empty( $ex['desc'] ) ) {
						// Subheadline - specify the details of this term
						echo '<tr><td colspan="2">' . $ex['desc'] . '</td></tr>';
					}

					// Iterate through costs
					foreach ( $ex['rows'] as $rid => $row ) {
						echo '<tr><td colspan="2">' . $aecHTML->createFormParticle( $eid.'_'.$rid ) . '</td></tr>';
					}

					// Draw Separator Line
					echo '<tr class="aec_term_row_sep"><td colspan="2"></td></tr>';
				}
			?>
			</table>

		<table width="100%" id="checkoutbox">
			<tr><th><?php echo _CONFIRM_TITLE; ?></th></tr>
			<tr>
				<td class="checkout_action">
						<input type="hidden" name="option" value="<?php echo $option; ?>" />
						<input type="hidden" name="task" value="addressException" />
						<input type="hidden" name="invoice" value="<?php echo !empty( $InvoiceFactory->invoice->invoice_number ) ? $InvoiceFactory->invoice->invoice_number : "c." . $InvoiceFactory->cartobject->id; ?>" />
						<input type="hidden" name="userid" value="<?php echo $InvoiceFactory->metaUser->userid; ?>" />
						<input type="submit" class="button" value="<?php echo _BUTTON_CONFIRM; ?>" />
					</form>
				</td>
			</tr>
		</table>
		<table width="100%">
			<tr><td>
				<?php
				if ( !empty( $InvoiceFactory->pp ) ) {
					if ( is_object( $InvoiceFactory->pp ) ) {
						HTML_frontEnd::processorInfo( $option, $InvoiceFactory->pp, $aecConfig->cfg['displayccinfo'] );
					}
				}
				?>
			</td></tr>
		</table>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

	function printInvoice( $option, $data )
	{
		global $aecConfig;

		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >

		<head>
			<title><?php echo $data['page_title']; ?></title>
			<link rel="stylesheet" href="<?php echo JURI::root() . 'media/' . $option; ?>/css/invoice.css" type="text/css" media="screen, print" />
			<link rel="stylesheet" href="<?php echo JURI::root() . 'media/' . $option; ?>/css/invoice_print.css" type="text/css" media="print" />
			<?php if ( !empty( $aecConfig->cfg['invoice_address_allow_edit'] ) ) { ?>
			<script type="text/javascript" src="<?php echo JURI::root() . 'media/' . $option; ?>/js/jquery/jquery-1.3.2.min.js"></script>
			<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('textarea[name=address]').keyup(function() {
					jQuery('#address pre').text($(this).val());
				});
			 });
			</script>
			<?php } ?>
		</head>
		<body>
			<?php if ( !empty( $aecConfig->cfg['invoice_address_allow_edit'] ) ) { ?>
				<div id="printbutton">
					<div id="printbutton_inner">
						<textarea align="left" cols="40" rows="5" name="address" /><?php echo $data['address']; ?></textarea>
						<button onclick="window.print()" id="printbutton"><?php echo _INVOICEPRINT_PRINT; ?></button>
					</div>
					<p><?php echo _INVOICEPRINT_BLOCKNOTICE; ?></p>
				</div>
			<?php } else { ?>
				<div id="printbutton">
					<div id="printbutton_inner">
						<button onclick="window.print()" id="printbutton"><?php echo _INVOICEPRINT_PRINT; ?></button>
					</div>
				</div>
			<?php } ?>
			<div id="invoice_wrap">
				<div id="before_header"><?php echo $data['before_header']; ?></div>
				<div id="header">
					<?php echo $data['header']; ?>
				</div>
				<div id="after_header"><?php echo $data['after_header']; ?></div>
				<div id="address"><pre><?php echo $data['address']; ?></pre></div>
				<div id="invoice_details">
					<table id="invoice_details">
						<tr><th><?php echo _INVOICEPRINT_DATE; ?></th></tr>
						<tr><td><?php echo $data['invoice_date']; ?></td></tr>
						<tr><th><?php echo _INVOICEPRINT_ID; ?></th></tr>
						<tr><td><?php echo $data['invoice_id']; ?></td></tr>
						<tr><th><?php echo _INVOICEPRINT_REFERENCE_NUMBER; ?></th></tr>
						<tr><td><?php echo $data['invoice_number']; ?></td></tr>
					</table>
				</div>
				<div id="text_before_content"><?php echo $data['before_content']; ?></div>
				<div id="invoice_content">
					<table id="invoice_content">
						<tr>
							<th><?php echo _INVOICEPRINT_ITEM_NAME; ?></th>
							<th><?php echo _INVOICEPRINT_UNIT_PRICE; ?></th>
							<th><?php echo _INVOICEPRINT_QUANTITY; ?></th>
							<th><?php echo _INVOICEPRINT_TOTAL; ?></th>
						</tr>
						<?php echo implode( "\r\n", $data['itemlist'] ); ?>
						<?php echo implode( "\r\n", $data['totallist'] ); ?>
					</table>
				</div>
				<div id="text_after_content"><?php echo $data['after_content']; ?></div>
				<div id="invoice_paidstatus"><?php echo $data['paidstatus']; ?></div>
				<div id="before_footer"><?php echo $data['before_footer']; ?></div>
				<div id="footer"><?php echo $data['footer']; ?></div>
				<div id="after_footer"><?php echo $data['after_footer']; ?></div>
			</div>
		</body>
		<?php
		exit;
	}

	function error( $option, $objUser, $invoice, $error=false, $suppressactions=false )
	{
		$database = &JFactory::getDBO();

		global $aecConfig;

		if ( !$suppressactions ) {
			$actions =	_CHECKOUT_ERROR_OPENINVOICE
			. ' <a href="'
			.  AECToolbox::deadsureURL( 'index.php?option=' . $option . '&amp;task=repeatPayment&amp;invoice='
			. $invoice . '&amp;userid=' . $objUser->id ) . '" title="' . _GOTO_CHECKOUT . '">'
			. _GOTO_CHECKOUT
			. '</a>'
			. ', ' . _GOTO_CHECKOUT_CANCEL . ' '
			. '<a href="'
			. AECToolbox::deadsureURL( 'index.php?option=' . $option . '&amp;task=cancelPayment&amp;invoice='
			. $invoice . '&amp;userid=' . $objUser->id . '&amp;pending=1' )
			. '" title="' . _HISTORY_ACTION_CANCEL . '">'
			. _HISTORY_ACTION_CANCEL
			. '</a>'
			;
		} else {
			$actions = '';
		}
		?>

		<div class="componentheading"><?php echo _CHECKOUT_ERROR_TITLE; ?></div>
		<div id="box_pending">
			<p><?php echo _CHECKOUT_ERROR_EXPLANATION . ( $error ? ( ': ' . $error) : '' ); ?></p>
			<p><?php echo $actions; ?></p>
		</div>
		<div class="aec_clearfix"></div>
		<?php
	}

		function errorAP( $option, $planid, $userid, $username, $name, $recurring )
		{
		HTML_frontend::aec_styling($option);?>
				 <table class="single_subscription">
					 <th class="heading"><?php echo _REGTITLE ?> <?php echo _ERRORCODE ?></th>
					 <tr><td class="description"><?php echo _FTEXTA ?><br /><?php echo _RECODE ?></td></tr>
			<tr><td class="buttons">
				<div class="gateway_button">
					<?php
					$html_code	= '';
					Payment_HTML::getPayButtonHTML( $gw->name, $gw->recurring, $gw->currency_code, $row->id, $userid, $username, $name, $html_code );
					echo $html_code; ?>
				</div>
				</td>
			</tr>
		</table>
		<?php
	}

		function generalError( $option )
		{
		HTML_frontend::aec_styling( $option );
			 echo _AEC_GEN_ERROR;
	}
}

function joomlaregisterForm($option, $useractivation)
{
	global $aecConfig;

	$name = $username = $email = '';

	$values = array( 'name', 'username', 'email' );

	foreach ( $values as $n ) {
		if ( isset( $_POST[$n] ) ) {
			$$n = $_POST[$n];
		}
	}

	// used for spoof hardening
	if ( function_exists( 'josSpoofValue' ) ) {
		$validate = josSpoofValue();
	} else {
		$validate = '';
	}
	?>
	<script type="text/javascript">
		/* <![CDATA[ */
		function submitbutton_reg() {
			var form = document.mosForm;
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (form.name.value == "") {
				alert( "<?php echo html_entity_decode(_REGWARN_NAME);?>" );
			} else if (form.username.value == "") {
				alert( "<?php echo html_entity_decode(_REGWARN_UNAME);?>" );
			} else if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "<?php printf( html_entity_decode(_VALID_AZ09_USER), html_entity_decode(_PROMPT_UNAME), 2 );?>" );
			} else if (form.email.value == "") {
				alert( "<?php echo html_entity_decode(_REGWARN_MAIL);?>" );
			} else if (form.password.value.length < 6) {
				alert( "<?php echo html_entity_decode(_REGWARN_PASS);?>" );
			} else if (form.password2.value == "") {
				alert( "<?php echo html_entity_decode(_REGWARN_VPASS1);?>" );
			} else if ((form.password.value != "") && (form.password.value != form.password2.value)){
				alert( "<?php echo html_entity_decode(_REGWARN_VPASS2);?>" );
			} else if (r.exec(form.password.value)) {
				alert( "<?php printf( html_entity_decode(_VALID_AZ09), html_entity_decode(_REGISTER_PASS), 6 );?>" );
			} else {
				form.submit();
			}
		}
		/* ]]> */
	</script>
	<form action="<?php echo AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=saveRegistration' ); ?>" method="post" name="mosForm">

	<div class="componentheading">
		<?php echo _REGISTER_TITLE; ?>
	</div>

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
	<tr>
		<td colspan="2"><?php echo _REGISTER_REQUIRED; ?></td>
	</tr>
	<tr>
		<td width="30%">
			<?php echo _REGISTER_NAME; ?> *
		</td>
			<td>
				<input type="text" name="name" size="40" value="<?php echo $name;  ?>" class="inputbox" maxlength="50" />
			</td>
	</tr>
	<tr>
		<td>
			<?php echo _REGISTER_UNAME; ?> *
		</td>
		<td>
			<input type="text" name="username" size="40" value="<?php echo $username;  ?>" class="inputbox" maxlength="25" />
		</td>
	</tr>
	<tr>
		<td>
			<?php echo _REGISTER_EMAIL; ?> *
		</td>
		<td>
			<input type="text" name="email" size="40" value="<?php echo $email;  ?>" class="inputbox" maxlength="100" />
		</td>
	</tr>
	<tr>
		<td>
			<?php echo _REGISTER_PASS; ?> *
		</td>
			<td>
				<input class="inputbox" type="password" name="password" size="40" value="" />
			</td>
	</tr>
	<tr>
		<td>
			<?php echo _REGISTER_VPASS; ?> *
		</td>
		<td>
			<input class="inputbox" type="password" name="password2" size="40" value="" />
		</td>
	</tr>
	<tr>
			<td colspan="2">
			</td>
	</tr>
	<?php
	if ( $aecConfig->cfg['use_recaptcha'] && !empty( $aecConfig->cfg['recaptcha_publickey'] ) ) {
		require_once( JPATH_SITE . '/components/com_acctexp/lib/recaptcha/recaptchalib.php' );
		?>
		<tr>
			<td></td>
			<td><?php echo recaptcha_get_html( $aecConfig->cfg['recaptcha_publickey'] ); ?></td>
		</tr>
		<?php
	}
	?>
	</table>
	<input type="hidden" name="id" value="0" />
	<input type="hidden" name="gid" value="0" />
	<input type="hidden" name="useractivation" value="<?php echo $useractivation;?>" />
	<input type="hidden" name="option" value="com_acctexp" />
	<input type="hidden" name="task" value="saveRegistration" />
	<input type="hidden" name="usage" value="<?php echo $_POST['usage'];?>" />
	<input type="hidden" name="processor" value="<?php echo $_POST['processor'];?>" />
	<?php if ( isset( $_POST['recurring'] ) ) { ?>
	<input type="hidden" name="recurring" value="<?php echo $_POST['recurring'];?>" />
	<?php } ?>
	<input type="button" value="<?php echo _BUTTON_SEND_REG; ?>" class="button" onclick="submitbutton_reg()" />
	<input type="hidden" name="<?php echo $validate; ?>" value="1" />
	</form>
	<?php
}
?>
