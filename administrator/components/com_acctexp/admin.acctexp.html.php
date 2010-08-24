<?php
/**
 * @version $Id: admin.acctexp.html.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Main HTML Backend
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class HTML_myCommon
{
	function ContentLegend()
	{
		?>
		<table cellspacing="0" cellpadding="4" border="0" align="center">
			<tr align="center">
				<td><?php echo aecHTML::Icon( 'accept.png', _AEC_CMN_PUBLISHED ); ?></td>
				<td><?php echo _AEC_CMN_PUBLISHED; ?>&nbsp;|</td>
				<td><?php echo aecHTML::Icon( 'cancel.png', _AEC_CMN_NOT_PUBLISHED . '/' . _AEC_CMN_INVISIBLE ); ?></td>
				<td><?php echo _AEC_CMN_NOT_PUBLISHED . '/' . _AEC_CMN_INVISIBLE; ?>&nbsp;|</td>
				<td><?php echo aecHTML::Icon( 'eye.png', _PAYPLAN_VISIBLE ); ?></td>
				<td><?php echo _PAYPLAN_VISIBLE; ?></td>
			</tr>
			<tr>
				<td colspan="6" align="center"><?php echo _AEC_CMN_CLICK_TO_CHANGE; ?></td>
			</tr>
		</table>
		<?php
	}

	/**
	* Generates an HTML radio list formatted as a table
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @returns string HTML for the select list
	*/
	function radioListTable( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' )
	{
		reset( $arr );
		$html = '<table>';
		$flop = 1;
		for( $i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = @$arr[$i]->id;

			$extra = '';
			$extra .= $id ? ' id="' . $arr[$i]->id . '"' : '';
			if ( is_array( $selected ) ) {
				foreach ( $selected as $obj ) {
					$k2 = $obj->$key;
					if ($k == $k2) {
					$extra .= ' selected="selected"';
					break;
					}
				}
			} else {
				$extra .= ( $k == $selected ? ' checked="checked"' : '');
			}
			if ( $flop ) {
				$html .= "\n\t" . '<tr><td height="50" valign="center">' . "\n"
				. '<input type="radio" name="' . $tag_name . '" value="' . $k . '"'
				. $extra . $tag_attribs . ' />' . $t . '</td>';
				if ( ( $i + 1 ) == $n ) {
					// Last interaction, odd number of itens, we have to tr
					$html .= '<td></td></tr>' . "\n";
				}
				$flop = 0;
				} else {
					$html .= "\n\t" . '<td height="50" valign="center">'
					. '<input type="radio" name="' . $tag_name . '" value="' . $k . '"'
					. $extra . $tag_attribs . ' />' . $t . '</td></tr>' . "\n";
					$flop = 1;
				}
		}
		$html .= '</table>' . "\n";
		return $html;
	}

	function Valanx()
	{
		?>
		<div align="center" id="aec_footer">
			<table width="500" border="0">
			<tr>
				<td align="center">
					<img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_logo_small_footer.png" border="0" alt="aec" />
				</td>
				<td align="center">
					<div align="center" class="smallgrey">
						<p><strong>Account Expiration Control</strong> Component - Version <?php echo _AEC_VERSION ?><br />
						<a href="http://www.valanx.org/index.php?option=com_docman&amp;Itemid=27" target="_blank"><?php echo _AEC_FOOT_VERSION_CHECK; ?></a>&nbsp;&nbsp;|&nbsp;
						<a href="http://www.valanx.org/index.php?option=com_content&amp;task=view&amp;id=14&amp;Itemid=28" target="_blank"><?php echo _AEC_FOOT_MEMBERSHIP; ?></a></p>
					</div>
					<div align="center">
						<p><?php echo _AEC_FOOT_TX_GPL; ?></p>
						<p><?php printf( _AEC_FOOT_CREDIT, AECToolbox::backendTaskLink( 'credits', _AEC_FOOT_CREDIT_LTEXT ) ); ?></p>
					</div>
				</td>
				<td align="center">
					<a href="https://www.valanx.org" target="_blank"><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/valanx_logo_tiny.png" border="0" alt="valanx" /></a>
				</td>
			</tr>
			</table>
		</div>
		<?php

		if ( _EUCA_DEBUGMODE ) {
			global $eucaDebug;

			$eucaDebug->displayDebug();
		}
	}

	function sidebar( $focus )
	{
		$sizing = array( 'small', 'mid', 'big' );

		$group = array();
		// Group Name | Number of Items
		$group[0] = array( 'User', 7 );
		$group[1] = array( 'Settings', 4 );

		// Detect Focusgroup
		$cursor		= 0;
		$cursormax	= 0;

		for( $i = 0, $cursormax = $group[$i][1]; $i <= count( $group ); $i++, $cursormax += $group[$i][1] ) {
			for( $k = 0; $k <= $cursormax; $k++, $cursor++) {
				if ( $cursor === $focus ) {
					$focusgroup = $i;
				}
			}
		}

		$items = array();
		// function name | Text under Button | png name

		$items = array(	'config'				=> array( 'Edit Expiration', 'edit' ),
						'notconfig'				=> array( 'Excluded', 'excluded' ),
						'showPending'			=> array( 'Pending', 'pending' ),
						'showActive'			=> array( 'Active', 'active' ),
						'showCancelled'			=> array( 'Cancelled', 'cancelled' ),
						'showClosed'			=> array( 'Closed', 'closed' ),
						'showManual'			=> array( 'Manual', 'manual' ),
						'showSubscriptionPlans' => array( 'Subscription Plans', 'plans' ),
						'showSettings'			=> array( 'Settings', 'settings' ),
						'editCSS'				=> array( 'Edit CSS', 'css' ),
						'hacks'					=> array( 'Hacks', 'hacks' ),
						'help'					=> array( 'Help', 'help' )
						);

		$html = '<div id="sidebar">'
		. '<table>' . "\n";

		$cursor = 0;
		for( $i = 0; $i <= count( $group ); $i++ ) {
			$html .= '<tr><th><p>' . $group[$i][0] . '</p></th></tr>' . "\n"
			. '<tr><td>' . "\n";

			switch( $i ) {
				case $focusgroup:
					$size = 1;
					break;
				default:
					$size = 0;
					break;
			}

			for( $k = $cursor; $k <= $group[$i][1]; $k++, $cursor++ ) {
				if ( $cursor == $focus ) {
					$add = 1;
				}
				$html .= '<div class="sidebar_button_' . $sizing[$size + $add] . '>'
				. '<a href="index2.php?option=com_acctexp&amp;task=' . $items[$cursor][1] . '>'
				. '<img src="' . JURI::root() . 'media/com_acctexp/images/admin/icons/aec_icon_' . $items[$cursor][2] . '_' . $sizing[$size + $add] . '.png" alt="" title="" />'
				. '<p>' . $items[$cursor][2] . '</p></a>'
				. '</div>' . "\n";
				unset( $add );
			}
			$html .= '</td></tr>' . "\n";
		}

		$html .= '</table>' . "\n";

		return $html;
	}

	function addBackendCSS()
	{
		?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo JURI::root(); ?>media/com_acctexp/css/admin.css" />
		<?php if ( !aecJoomla15check() ) { ?>
			<script type="text/javascript" src="<?php echo JURI::root(); ?>components/com_acctexp/lib/mootools/mootools.js"></script>
		<?php } ?>
		<?php
	}

	function addReadoutCSS()
	{
		?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo JURI::root(); ?>media/com_acctexp/css/readout.css" />
		<?php
	}
}

class formParticles
{
	function formParticles()
	{

	}

	function createSettingsParticle( $rows, $lists )
	{
		$thisrow_type	= $rows[0];
		$thisrow_name	= $rows[1];
		$thisrow_desc	= $rows[2];
		$thisrow_var	= $rows[3];
		$thisrow_extra	= $rows[4];

		switch( $thisrow_type ) {
			case 'subtitle': ?>
				<tr align="center" valign="middle">
					<th colspan="3" width="20%"><?php echo $thisrow_desc; ?></th>
				</tr>
				<?php
				break;

			case 'inputA': ?>
				<tr align="left" valign="middle" >
					<td width="10%" align="right"><?php echo $thisrow_name; ?></td>
        			<td align="left">
	        			<input name="<?php echo $thisrow_extra; ?>" type="text" size="4" maxlength="5" value="<?php echo $thisrow_var; ?>" />
					</td>
					<td><?php echo $thisrow_desc; ?></td>
				</tr>
				<?php
				break;

			case 'inputB': ?>
				<tr>
					<td width="10%"><?php echo $thisrow_name; ?></td>
					<td width="10%"><input class="inputbox" type="text" name="<?php echo $thisrow_extra; ?>" size="2" maxlength="10" value="<?php echo $thisrow_var; ?>" /></td>
					<td align="left"><?php echo $thisrow_desc; ?></td>
				</tr>
				<?php
				break;

			case 'inputC': ?>
				<tr align="left" valign="middle" >
					<td width="10%" align="right"><?php echo $thisrow_name; ?></td>
					<td width="10%"><input type="text" size="20" name="<?php echo $thisrow_extra; ?>" class="inputbox" value="<?php echo $thisrow_var; ?>" /></td>
					<td><?php echo $thisrow_desc; ?></td>
				</tr>
				<?php
				break;

			case 'inputD': ?>
				<tr align="left" valign="middle" >
					<td width="10%" align="right"><?php echo $thisrow_name; ?></td>
					<td width="10%"><textarea align="left" cols="60" rows="5" name="<?php echo $thisrow_extra; ?>" /><?php echo $thisrow_var; ?></textarea></td>
					<td><?php echo $thisrow_desc; ?></td>
				</tr>
				<?php
				break;

			case 'inputE': ?>
				<tr align="left" valign="middle" >
					<td><?php echo aecHTML::ToolTip( $thisrow_desc, $thisrow_name, null ); ?><?php echo $thisrow_name; ?></td>
					<td colspan="2" align="left"><input type="text" size="70" name="<?php echo $thisrow_extra; ?>" class="inputbox" value="<?php echo $thisrow_var; ?>" /></td>
				</tr>
				<?php
				break;

			case 'editor': ?>
        		<tr align="left" valign="middle" >
					<td width="10%" align="right">
					<?php echo aecHTML::ToolTip( $thisrow_desc, $thisrow_name, null ); ?>
					<?php echo $thisrow_name; ?>
					</td>
					<td width="10%" colspan="2">
					<!-- <textarea name="<?php echo $thisrow_extra; ?>" align="left" cols="60" maxlength="2048" rows="5"><?php echo $thisrow_var; ?></textarea> //-->
					<?php
					if ( aecJoomla15check() ) {
						$editor = &JFactory::getEditor();

						$return .= $editor->display( $thisrow_extra,  $thisrow_var , '100%', '250', '50', '20' );
					} else {
						$return .= editorArea( $thisrow_extra, $thisrow_var, $thisrow_extra, '100%;', '250', '50', '20' );
					}
					?>
					</td>
				</tr>
				<?php
				break;

			case 'list': ?>
				<tr>
					<td width="10%"><?php echo $thisrow_name; ?></td>
					<td width="10%" align="left"><?php echo $lists[$thisrow_extra]; ?></td>
					<td align="left"><?php echo $thisrow_desc; ?></td>
				</tr>
				<?php
				break;

			case 'list_big': ?>
				<tr>
					<td><?php echo aecHTML::ToolTip( $thisrow_desc, $thisrow_name, null ); ?><?php echo $thisrow_name; ?></td>
					<td colspan="2" align="left"><?php echo $lists[$thisrow_extra]; ?></td>
				</tr>
				<?php
				break;

			case 'fieldset': ?>
				<tr><td colspan="3" >
					<fieldset><legend><?php echo $thisrow_name; ?></legend>
						<table cellpadding="1" cellspacing="1" border="0">
							<tr align="left" valign="middle">
								<td><?php echo $thisrow_desc; ?></td>
							</tr>
						</table>
					</fieldset>
					</td>
				</tr>
				<?php
				break;
		}
	}
}

class General_css
{
	function editCSSSource( &$content, $option )
	{
		$file = JPATH_SITE . '/media/' . $option . '/css/site.css';
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table cellpadding="1" cellspacing="1" border="0" width="100%">
				<tr>
					<td width="180">
						<table class="adminheading">
							<tr><th class="templates" style="color: #586c79;"><?php echo _AEC_HEAD_CSS_EDITOR; ?></th></tr>
						</table>
					</td>
					<td width="260">
						<span class="componentheading"><?php echo $file; ?>:&nbsp;
							<?php echo is_writable( $file ) ? '<span style="color:green;">' . _AEC_CMN_WRITEABLE . '</span>' : '<span style="color:red;">' . _AEC_CMN_UNWRITEABLE . '</span>'; ?>
						</span>
					</td>
					<?php
					if ( aecJoomla15check() ) {
						jimport('joomla.filesystem.path');

						$chmod = JPath::canChmod( $file );
					} else {
						$chmod = mosIsChmodable( $file );
					}

					if ( $chmod ) {
						if ( is_writable( $file ) ) { ?>
							<td>
								<input type="checkbox" id="disable_write" name="disable_write" value="1" />
								<label for="disable_write"><?php echo _AEC_CMN_UNWRITE_AFTER_SAVE; ?></label>
							</td>
							<?php
						} else {
							?>
							<td>
								<input type="checkbox" id="enable_write" name="enable_write" value="1" />
								<label for="enable_write"><?php echo_AEC_CMN_OVERRIDE_WRITE_PROT; ?></label>
							</td>
							<?php
						}
					} ?>
				</tr>
			</table>
			<table class="aecadminform">
				<tr>
					<th>
						<?php echo $file; ?>
					</th>
				</tr>
				<tr>
					<td>
						<textarea style="width:100%;height:500px" cols="110" rows="25" name="filecontent" class="inputbox"><?php echo $content; ?></textarea>
					</td>
				</tr>
			</table>
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="" />
		</form>

		<?php HTML_myCommon::Valanx();
	}
}

class HTML_AcctExp
{
	function HTML_AcctExp()
	{

	}

	function userForm( $option, $metaUser, $invoices, $coupons, $mi, $lists, $nexttask, $aecHTML )
	{
		HTML_myCommon::addBackendCSS();

		loadOverlib();
		if ( aecJoomla15check() ) {
			JHTML::_('behavior.calendar');
		} else {
			mosCommonHTML::loadCalendar();
		}

		if ( aecJoomla15check() ) {
			$edituserlink = "index.php?option=com_users&amp;view=user&amp;task=edit&amp;cid[]=" . $metaUser->userid;
			JHTML::_('behavior.calendar');
		} else {
			$edituserlink = "index2.php?option=com_users&amp;task=editA&amp;id=" . $metaUser->userid . "&amp;hidemainmenu=1";
		}

		$cb = GeneralInfoRequester::detect_component('anyCB');

		$exp = "";

		if ( $metaUser->hasSubscription ) {
			if ( isset( $metaUser->focusSubscription->expiration ) ) {
				$exp = $metaUser->focusSubscription->expiration;
			}
		}

		?>
		<script type="text/javascript">
			/* <![CDATA[ */
			function swap() {
				lifechecked = document.adminForm.ck_lifetime.checked;
				if (lifechecked==false) {
					document.adminForm.expiration.disabled = false;
					document.adminForm.reset.disabled = false;
				} else {
					document.adminForm.expiration.disabled = true;
					document.adminForm.reset.disabled = true;
				}
			}
			/* ]]> */
		</script>

		<table class="adminheading">
			<tr>
				<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_edit.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
					<?php echo _AEC_HEAD_SUBCRIBER; ?>:
					&nbsp;
					<small><?php echo !empty( $metaUser->userid ) ? $metaUser->cmsUser->username . ' (' . _AEC_CMN_ID . ': ' . $metaUser->userid . ')' : _AEC_CMN_NEW; ?></small>
	        	</th>
			</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
			<?php
			$tabs = new JPaneTabs(0);
			echo $tabs->startPane( 'settings' );

			echo $tabs->startPanel(_AEC_HEAD_PLAN_INFO, _AEC_HEAD_PLAN_INFO);
			echo '<div class="aec_tabheading"><h2>' . _AEC_HEAD_PLAN_INFO . '</h2></div>';
			?>
			<table class="aecadminform">
				<tr>
					<td width="50%" style="padding:10px;" valign="top">
						<div class="userinfobox">
							<h3><?php echo _AEC_USER_USER_INFO; ?></h3>
							<p>
								<?php echo _AEC_USER_USERID; ?>:&nbsp;<strong><?php echo $metaUser->userid; ?></strong>
								&nbsp;|&nbsp;
								<?php echo _AEC_USER_STATUS; ?>:&nbsp;
								<strong><?php echo !$metaUser->cmsUser->block ? aecHTML::Icon( 'accept.png', _AEC_USER_ACTIVE ) . '&nbsp;' . _AEC_USER_ACTIVE . '</strong>' : aecHTML::Icon( 'exclamation.png', _AEC_USER_BLOCKED ) . '&nbsp;' . _AEC_USER_BLOCKED . '</strong>' . ( ( $metaUser->cmsUser->activation == '' ) ? '' : ' (<a href="' . JURI::root() . 'index.php?option=' . ( aecJoomla15check() ? 'com_user' : 'com_registration' ) . '&amp;task=activate&amp;activation=' . $metaUser->cmsUser->activation . '" target="_blank">' . _AEC_USER_ACTIVE_LINK . '</a>)' ); ?>
							</p>
							<p>
								<?php echo _AEC_USER_PROFILE; ?>:
								&nbsp;
								<a href="<?php echo $edituserlink; ?>"><?php echo aecHTML::Icon( 'user.png', _AEC_USER_PROFILE_LINK ); ?>&nbsp;<?php echo _AEC_USER_PROFILE_LINK; ?></a>
								<?php echo $cb ? (' | CB Profile: <a href="index2.php?option=com_comprofiler&amp;task=edit&amp;cid=' . $metaUser->userid . '">' . aecHTML::Icon( 'user_orange.png', _AEC_USER_PROFILE_LINK ) . '&nbsp;' . _AEC_USER_PROFILE_LINK . '</a>') : ''; ?>
							</p>
							<p>
								<?php echo _AEC_USER_USERNAME; ?>:&nbsp;
								<strong><?php echo $metaUser->cmsUser->username; ?></strong>
								&nbsp;|&nbsp;
								<?php echo _AEC_USER_NAME; ?>:&nbsp;<strong>
								<?php echo $metaUser->cmsUser->name; ?></strong>
							</p>
							<p>
								<?php echo _AEC_USER_EMAIL; ?>:&nbsp;<strong><?php echo $metaUser->cmsUser->email; ?></strong>
							 	(<a href="mailto:<?php echo $metaUser->cmsUser->email; ?>"><?php echo aecHTML::Icon( 'email.png', _AEC_USER_SEND_MAIL ); ?>&nbsp;<?php echo _AEC_USER_SEND_MAIL; ?></a>)
							</p>
							<p><?php echo _AEC_USER_TYPE; ?>:&nbsp;<strong><?php echo $metaUser->cmsUser->usertype; ?></strong></p>
							<p>
								<?php echo _AEC_USER_REGISTERED; ?>:&nbsp;<?php echo aecHTML::Icon( 'date.png', _AEC_USER_REGISTERED ); ?>&nbsp;
								<strong><?php echo $metaUser->cmsUser->registerDate; ?></strong>
								&nbsp;|&nbsp;
								<?php echo _AEC_USER_LAST_VISIT; ?>:&nbsp;
								<strong><?php echo aecHTML::Icon( 'door_in.png', _AEC_USER_LAST_VISIT ); ?>&nbsp;<?php echo $metaUser->cmsUser->lastvisitDate; ?></strong>
							</p>
						</div>
						<div class="userinfobox">
							<h3><?php echo _AEC_USER_EXPIRATION; ?></h3>
							<?php
							if ( !empty( $exp ) && $metaUser->focusSubscription->lifetime ) { ?>
								<p>
								<?php echo _AEC_USER_CURR_EXPIRE_DATE; ?>:&nbsp;
								<?php echo aecHTML::Icon( 'clock_pause.png', _AEC_USER_LIFETIME ); ?>&nbsp;
								<strong><?php echo _AEC_USER_LIFETIME; ?></strong></p>
								<p>
									<?php echo _AEC_USER_LIFETIME; ?>:&nbsp;
									<input class="checkbox" type="checkbox" name="ck_lifetime" id="ck_lifetime" checked="checked" onclick="swap();" />
								</p>
								<p>
									<?php echo _AEC_USER_RESET_EXP_DATE; ?>:&nbsp;
									<?php echo aecHTML::Icon( 'clock_edit.png', _AEC_USER_RESET_EXP_DATE ); ?>
									<?php if ( !aecJoomla15check() ) { ?>
										<input class="text_area" type="text" name="expiration" id="expiration" size="19" maxlength="19" value="<?php echo $exp; ?>" disabled="disabled" />
										<input type="reset" name="reset" class="button" onClick="return showCalendar('expiration', 'y-mm-dd');" value="..." disabled="disabled" />
									<?php } else {
										echo JHTML::_('calendar', $exp, 'expiration', 'expiration', '%Y-%m-%d %H:%M:%S', array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'19', 'disabled'=>"disabled" ));
									} ?>
									<input type="hidden" name="expiration_check" id="expiration_check" value="<?php echo ( !empty( $exp ) ? $exp : date( 'Y-m-d H:i:s' ) ); ?>"/>
								</p>
								<?php
							} else {
								?>
								<p>
									<?php echo _AEC_USER_CURR_EXPIRE_DATE; ?>:&nbsp;
									<?php echo aecHTML::Icon( 'clock_red.png', _AEC_USER_CURR_EXPIRE_DATE ); ?>&nbsp;
									<strong><?php echo ( !empty( $exp ) ? $exp : _AEC_CMN_NOT_SET ); ?></strong>
								</p>
								<p>
									<?php echo _AEC_USER_LIFETIME; ?>:&nbsp;
									<input class="checkbox" type="checkbox" name="ck_lifetime" id="ck_lifetime" onclick="swap();" />
								</p>
								<p>
									<?php echo _AEC_USER_RESET_EXP_DATE; ?>:&nbsp;<?php echo aecHTML::Icon( 'clock_edit.png', _AEC_USER_RESET_EXP_DATE ); ?>
									<?php if ( !aecJoomla15check() ) { ?>
										<input class="text_area" type="text" name="expiration" id="expiration" size="19" maxlength="19" value="<?php echo $exp; ?>" />
										<input type="reset" name="reset" class="button" onClick="return showCalendar('expiration', 'y-mm-dd');" value="..." />
									<?php } else {
										echo JHTML::_('calendar', $exp, 'expiration', 'expiration', '%Y-%m-%d %H:%M:%S', array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'19'));
									} ?>
									<input type="hidden" name="expiration_check" id="expiration_check" value="<?php echo ( !empty( $exp ) ? $exp : date( 'Y-m-d H:i:s' ) ); ?>"/>
								</p>
								<?php
							} ?>
							<p><?php echo _AEC_USER_RESET_STATUS; ?>:&nbsp;<?php echo $lists['set_status']; ?></p>
						</div>
						<div class="userinfobox">
							<h3><?php echo _AEC_USER_SUBSCRIPTION; ?></h3>
								<?php if ( $metaUser->hasSubscription ) { ?>
								<table>
									<tr>
										<td width="120"><?php echo _AEC_USER_SUBSCRIPTIONS_ID;?>:</td>
										<td><strong><?php echo $metaUser->focusSubscription->id; ?></strong></td>
									</tr>
									<tr>
										<td width="120"><?php echo _AEC_USER_STATUS; ?>:</td>
										<?php
										switch( $metaUser->focusSubscription->status ) {
											case 'Excluded':
												$icon = 'cut_red.png';
												$status	= _AEC_CMN_EXCLUDED;
												break;
											case 'Trial':
												$icon 	= 'star.png';
												$status	= _AEC_CMN_TRIAL;
												break;
											case 'Pending':
												$icon 	= 'star.png';
												$status	= _AEC_CMN_PENDING;
												break;
											case 'Active':
												$icon	= 'tick.png';
												$status	= _AEC_CMN_ACTIVE;
												break;
											case 'Cancel':
												$icon	= 'exclamation.png';
												$status	= _AEC_CMN_CANCEL;
												break;
											case 'Hold':
												$icon	= 'exclamation.png';
												$status	= _AEC_CMN_HOLD;
												break;
											case 'Expired':
												$icon	= 'cancel.png';
												$status	= _AEC_CMN_EXPIRED;
												break;
											case 'Closed':
												$icon	= 'cancel.png';
												$status	= _AEC_CMN_CLOSED;
												break;
											default:
												$icon	= 'thumb_down.png';
												$status	= _AEC_CMN_NOT_SET;
												break;
										} ?>
										<td><strong><?php echo aecHTML::Icon( $icon, $status ); ?>&nbsp;<?php echo $status; ?></strong></td>
									</tr>
									<tr>
										<td width="120"><?php echo _AEC_USER_PAYMENT_PROC; ?>:</td>
										<td><strong><?php echo aecHTML::Icon( 'money.png', _AEC_USER_PAYMENT_PROC ); ?>&nbsp;<?php echo $metaUser->focusSubscription->type ? $metaUser->focusSubscription->type : _AEC_CMN_NOT_SET; ?></strong></td>
									</tr>
									<tr>
										<td width="120"><?php echo _AEC_USER_CURR_SUBSCR_PLAN_PRIMARY; ?>:</td>
										<td><input class="checkbox" type="checkbox" name="ck_primary" id="ck_primary" <?php echo $metaUser->focusSubscription->primary ? 'checked="checked" disabled="disabled" ' : ''; ?>/></td>
									</tr>
									<tr>
										<td width="120"><?php echo _AEC_USER_CURR_SUBSCR_PLAN; ?>:</td>
										<td><strong>#<?php echo $metaUser->focusSubscription->plan; ?></strong> - "<?php echo ( $metaUser->focusSubscription->plan ? HTML_AcctExp::SubscriptionName( $metaUser->focusSubscription->plan ) : '<span style="color:#FF0000;">' . _AEC_CMN_NOT_SET . '</span>' ); ?>"</td>
									</tr>
									<tr>
										<td><?php echo _AEC_USER_PREV_SUBSCR_PLAN; ?>:</td>
										<td><strong>#<?php echo $metaUser->focusSubscription->previous_plan; ?></strong> - "<?php echo ( $metaUser->focusSubscription->previous_plan ? HTML_AcctExp::SubscriptionName( $metaUser->focusSubscription->previous_plan ) : '<span style="color: #FF0000;">' . _AEC_CMN_NOT_SET . '</span>' ); ?>"</td>
									</tr>
									<tr>
										<td><?php echo _AEC_USER_USED_PLANS; ?>:</td>
										<td>
											<?php
											if ( !empty( $metaUser->meta->plan_history->used_plans ) ) {
												foreach ( $metaUser->meta->plan_history->used_plans as $used => $amount ) { ?>
													<strong>#<?php echo $used; ?></strong> - "<?php echo HTML_AcctExp::SubscriptionName( $used ); ?>" (<?php echo $amount . " " . ( ( $amount > 1 ) ? _AEC_USER_TIMES : _AEC_USER_TIME ); ?>)
													<?php
												}
											} else {
												echo '<span style="color: #FF0000;">' . _AEC_USER_NO_PREV_PLANS . '</span>';
											} ?>
										</td>
									</tr>
								</table>
								<?php } ?>
								<p>
									<span style="vertical-align:top;"><?php echo _AEC_USER_ASSIGN_TO_PLAN; ?>:</span>&nbsp;
									<?php echo $lists['assignto_plan']; ?>
								</p>
								<?php if ( $metaUser->hasSubscription && !empty( $metaUser->allSubscriptions ) ) { ?>
									<br />
									<p><strong><?php echo _AEC_USER_ALL_SUBSCRIPTIONS;?>:</strong></p>
									<table>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td><?php echo _AEC_USER_SUBSCRIPTIONS_ID;?></td>
											<td><?php echo _AEC_USER_SUBSCRIPTIONS_STATUS;?></td>
											<td><?php echo _AEC_USER_SUBSCRIPTIONS_PROCESSOR;?></td>
											<td><?php echo _AEC_USER_SUBSCRIPTIONS_SINGUP;?></td>
											<td><?php echo _AEC_USER_SUBSCRIPTIONS_EXPIRATION;?></td>
										</tr>
										<tr>
											<td colspan="7" style="border-top: 2px solid #999999;"></td>
										</tr>
										<?php foreach ( $metaUser->allSubscriptions as $subs ) { ?>
											<tr<?php echo isset( $subs->current_focus ) ? ' style="background-color:#eff;"' : ''; ?>>
												<td><?php echo isset( $subs->current_focus ) ? '&rArr;' : '&nbsp;'; ?></td>
												<td><?php echo $subs->primary ? aecHTML::Icon( 'star.png', _AEC_USER_SUBSCRIPTIONS_PRIMARY ) : '&nbsp;'; ?></td>
												<td><?php echo !isset( $subs->current_focus ) ? '<a href="index2.php?option=com_acctexp&amp;task=edit&subscriptionid=' . $subs->id . '">' . $subs->id . '</a>' : $subs->id; ?></td>
												<td><?php echo $subs->status; ?></td>
												<td><?php echo $subs->type; ?></td>
												<td><?php echo $subs->signup_date; ?></td>
												<td><?php echo $subs->lifetime ? _AEC_CMN_LIFETIME : HTML_AcctExp::DisplayDateInLocalTime($subs->expiration); ?></td>
											</tr>
											<?php
										} ?>
									</table>
								<?php } else { ?>
									<p><?php echo _AEC_USER_ALL_SUBSCRIPTIONS_NOPE;?></p>
								<?php } ?>
						</div>
					</td>
					<td width="50%" style="padding:10px; padding-right:20px; vertical-align:top;">
						<div class="userinfobox">
							<div style="float: left; text-align: right;">
								<h3><?php echo _AEC_USER_INVOICES; ?></h3>
							</div>
							<div style="float: left; text-align: left;">
								<table width="100%">
										<tr>
											<td><?php echo _HISTORY_COL_INVOICE;?></td>
											<td><?php echo _HISTORY_COL_AMOUNT;?></td>
											<td><?php echo _HISTORY_COL_DATE;?></td>
											<td><?php echo _HISTORY_COL_METHOD;?></td>
											<td><?php echo _HISTORY_COL_PLAN;?></td>
											<td><?php echo _HISTORY_COL_ACTION;?></td>
										</tr>
										<tr>
											<td colspan="6" style="border-top: 2px solid #999999;"></td>
										</tr>
										<?php
										if ( !empty( $invoices ) ) {
											foreach ( $invoices as $invoice ) { ?>
												<tr<?php echo $invoice['rowstyle']; ?>>
													<td><?php echo $invoice['invoice_number']; ?></td>
													<td><?php echo $invoice['amount']; ?></td>
													<td><?php echo $invoice['status']; ?></td>
													<td><?php echo $invoice['processor']; ?></td>
													<td><?php echo $invoice['usage']; ?></td>
													<td style="text-align:center;"><?php echo $invoice['actions']; ?></td>
												</tr>
												<?php
											}
										} else {
											echo '<tr><td colspan="6" style="text-align:center;">&gt;&gt;&nbsp;'
											. _AEC_USER_NO_COUPONS
											. '&nbsp;&lt;&lt;</td></tr>' . "\n";
										} ?>
								</table>
							</div>
						</div>
						<div class="userinfobox">
							<div style="float: left; text-align: right;">
								<h3><?php echo _AEC_USER_COUPONS; ?></h3>
							</div>
							<div style="float: left; text-align: left;">
								<table width="100%">
										<tr>
											<td><?php echo _HISTORY_COL_COUPON_CODE;?></td>
											<td><?php echo _HISTORY_COL_INVOICE;?></td>
										</tr>
										<tr>
											<td colspan="6" style="border-top: 2px solid #999999;"></td>
										</tr>
										<?php
										if ( !empty( $coupons ) ) {
											foreach ( $coupons as $coupon ) { ?>
												<tr>
													<td><?php echo $coupon['coupon_code']; ?></td>
													<td><?php echo $coupon['invoices']; ?></td>
												</tr>
												<?php
											}
										} else {
											echo '<tr><td colspan="6" style="text-align:center;">&gt;&gt;&nbsp;'
											. _AEC_USER_NO_INVOICES
											. '&nbsp;&lt;&lt;</td></tr>' . "\n";
										} ?>
								</table>
							</div>
						</div>
						<div class="userinfobox">
							<div style="float: left; text-align: right;">
								<h3><?php echo 'Notes'; ?></h3>
							</div>
							<div style="float: left; text-align: left;">
							<textarea style="width:90%" cols="450" rows="10" name="notes" id="notes" ><?php echo ( !empty( $metaUser->focusSubscription->customparams['notes'] ) ? $metaUser->focusSubscription->customparams['notes'] : "" ); ?></textarea>
							</div>
					</td>
				</tr>
			</table>
			<?php
			echo $tabs->endPanel();
			echo $tabs->startPanel(_AEC_USER_MICRO_INTEGRATION, _AEC_USER_MICRO_INTEGRATION);
			?>
			<div class="aec_tabheading"><h2><?php echo _AEC_USER_MICRO_INTEGRATION; ?>: <?php echo _AEC_USER_MICRO_INTEGRATION_USER; ?></h2></div>
			<?php if ( !empty( $mi['profile'] ) || !empty( $mi['profile_form'] ) ) {
				if ( !empty( $mi['profile'] ) ) { ?>
				<table class="aecadminform">
					<tr>
						<td valign="top" style="padding: 10px;">
							<?php foreach ( $mi['profile'] as $mi ) { ?>
									<div class="profileinfobox">
										<h3><?php echo $mi['name']; ?></h3>
										<p><?php echo $mi['info']; ?></p>
									</div>
								<?php
							} ?>
						</td>
					</tr>
				</table>
				<?php }
				if ( !empty( $mi['profile_form'] ) ) { ?>
				<table class="aecadminform">
					<tr>
						<td valign="top" style="padding: 10px;">
							<?php foreach ( $mi['profile_form'] as $k ) { ?>
									<?php echo $aecHTML->createSettingsParticle( $k ); ?>
								<?php
							} ?>
						</td>
					</tr>
				</table>
				<?php }
			} ?>
			<div class="aec_tabheading"><h2><?php echo _AEC_USER_MICRO_INTEGRATION; ?>: <?php echo _AEC_USER_MICRO_INTEGRATION_ADMIN; ?></h2></div>
			<?php if ( !empty( $mi['admin'] ) || !empty( $mi['admin_form'] ) ) {
				if ( !empty( $mi['admin'] ) ) { ?>
				<table class="aecadminform">
					<tr>
						<td valign="top" style="padding: 10px;">
							<?php foreach ( $mi['admin'] as $mi ) { ?>
									<div class="admininfobox">
										<h3><?php echo $mi['name']; ?></h3>
										<p><?php echo $mi['info']; ?></p>
									</div>
								<?php
							} ?>
						</td>
					</tr>
				</table>
				<?php }
				if ( !empty( $mi['admin_form'] ) ) { ?>
				<table class="aecadminform">
					<tr>
						<td valign="top" style="padding: 10px;">
							<?php foreach ( $mi['admin_form'] as $k ) { ?>
									<?php echo $aecHTML->createSettingsParticle( $k ); ?>
								<?php
							} ?>
						</td>
					</tr>
				</table>
				<?php }
			}

			if ( !empty( $metaUser->meta->params->mi ) ) { ?>
			<div class="aec_tabheading"><h2><?php echo _AEC_USER_MICRO_INTEGRATION; ?>: <?php echo _AEC_USER_MICRO_INTEGRATION_DB; ?></h2></div>
			<table class="aecadminform">
				<tr>
					<td valign="top" style="padding: 10px;">
						<pre><?php print_r( $metaUser->meta->params->mi ); ?></pre>
					</td>
				</tr>
			</table>
			<?php
			}
			echo $tabs->endPanel();
			echo $tabs->endPane();
			?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="id" value="<?php echo !empty( $metaUser->focusSubscription->id ) ? $metaUser->focusSubscription->id : ''; ?>" />
			<input type="hidden" name="userid" value="<?php echo $metaUser->userid; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="nexttask" value="<?php echo $nexttask;?>" />
		</form>

		<?php

		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $metaUser, $invoices, $lists, $nexttask );
		}

 		HTML_myCommon::Valanx();
	}

	function SubscriptionName( $subscriptionid )
	{
		$database = &JFactory::getDBO();

		$subscription = new SubscriptionPlan($database);
		$subscription->load($subscriptionid);

		return $subscription->name;
	}

	/**
	 * Builds a link plus button
	 *
	 * @param string	$link
	 * @param string	$image
	 * @param string	$text
	 * @param bool		$hideMenu
	 */
	function quickiconButton( $link, $image, $text, $hideMenu = false )
	{
		if ( $hideMenu ) {
			$hideMenu = '&amp;hidemainmenu=1';
		} ?>
		<div class="icon">
			<a href="<?php echo $link . $hideMenu; ?>">
				<img border="0" align="middle" alt="<?php echo $text; ?>" src="<?php echo JURI::root() . "media/com_acctexp/images/admin/icons/" . $image; ?>"/>
				<span><?php echo $text; ?></span>
			</a>
		</div>
	<?php
	}

	function quickSearchBar( $display, $searchcontent=null )
	{
		?>
		<div class="central_quicksearch">
			<h2><?php echo _AEC_QUICKSEARCH; ?></h2>
			<p><?php echo _AEC_QUICKSEARCH_DESC; ?></p>
			<form action="<?php echo JURI::base(); ?>index2.php?option=com_acctexp&amp;task=quicklookup" method="post">
			<textarea cols="80" rows="1" name="search" /><?php echo $searchcontent; ?></textarea>
			<input type="submit" />
			</form>
			<?php
			if ( !empty( $display ) ) {
			?>
				<?php if ( !strpos( $display, '</div>' ) ) { ?>
				<h2><?php echo _AEC_QUICKSEARCH_MULTIRES; ?></h2>
				<p><?php echo _AEC_QUICKSEARCH_MULTIRES_DESC; ?></p>
				<?php } ?>
				<p><?php echo $display; ?></p>
			<?php
			}
			?>
		</div>
		<?php
	}

	function central( $display=null, $notices=null, $searchcontent=null )
	{
		global $aecConfig;

		HTML_myCommon::addBackendCSS();
		// frontpage table
		?>
		<table class="aecadminform">
			<tr>
				<td valign="top">
					<div id="aec_center">
						<?php if ( !empty( $aecConfig->cfg['quicksearch_top'] ) ) {
							HTML_AcctExp::quickSearchBar( $display, $searchcontent );
						} ?>
						<h3>&raquo;<?php echo _AEC_CENTR_AREA_MEMBERSHIPS; ?></h3>
						<div class="central_group">
						<?php // Assemble Buttons
						$links = array(	array( 'showExcluded', 'excluded', _AEC_CENTR_EXCLUDED ),
										array( 'showPending', 'pending', _AEC_CENTR_PENDING ),
										array( 'showActive', 'active', _AEC_CENTR_ACTIVE ),
										array( 'showExpired', 'expired', _AEC_CENTR_EXPIRED ),
										array( 'showCancelled', 'cancelled', _AEC_CENTR_CANCELLED ),
										array( 'showHold', 'hold', _AEC_CENTR_HOLD ),
										array( 'showClosed', 'closed', _AEC_CENTR_CLOSED ),
										array( 'showManual', 'manual', _AEC_CENTR_MANUAL ),
										_AEC_CENTR_AREA_PAYMENT,
										array( 'showSubscriptionPlans', 'plans', _AEC_CENTR_PLANS ),
										array( 'showItemGroups', 'itemgroups', _AEC_CENTR_GROUPS ),
										array( 'showMicroIntegrations', 'microintegrations', _AEC_CENTR_M_INTEGRATION ),
										array( 'invoices', 'invoices', _AEC_CENTR_V_INVOICES ),
										array( 'showCoupons', 'coupons', _AEC_CENTR_COUPONS ),
										array( 'showCouponsStatic', 'coupons_static', _AEC_CENTR_COUPONS_STATIC ),
										_AEC_CENTR_AREA_SETTINGS,
										array( 'showSettings', 'settings', _AEC_CENTR_SETTINGS ),
										array( 'showProcessors', 'settings', _AEC_CENTR_PROCESSORS ),
										array( 'editCSS', 'css', _AEC_CENTR_EDIT_CSS ),
										array( 'history', 'history', _AEC_CENTR_VIEW_HISTORY ),
										array( 'eventlog', 'eventlog', _AEC_CENTR_LOG ),
										array( 'hacks', 'hacks', _AEC_CENTR_HACKS ),
										array( 'help', 'help', _AEC_CENTR_HELP ),
										array( 'export', 'export', _AEC_CENTR_EXPORT ),
										array( 'readout', 'export', _AEC_READOUT )
						);

						$linkroot = "index2.php?option=com_acctexp&amp;task=";
						foreach ( $links as $litem ) {
							if ( is_array( $litem ) ) {
								HTML_AcctExp::quickiconButton( $linkroot.$litem[0], 'aec_symbol_'.$litem[1].'.png', $litem[2] );
							} else {
								?></div><h3>&raquo;<?php echo $litem; ?></h3><div class="central_group"><?php
							}
						}

						?></div><?php

						if ( empty( $aecConfig->cfg['quicksearch_top'] ) ) {
							HTML_AcctExp::quickSearchBar( $display, $searchcontent );
						}

						if ( !empty( $notices ) ) {
						?>
						<div class="central_notices">
							<h2><?php echo _AEC_NOTICES_FOUND; ?></h2>
							<p><?php echo _AEC_NOTICES_FOUND_DESC; ?></p>
							<p><a href="index2.php?option=com_acctexp&amp;task=readAllNotices"><?php echo _AEC_NOTICE_MARK_ALL_READ; ?></a></p>
							<table align="center">
							<?php
							foreach( $notices as $notice ) {
							?>
								<tr><td class="notice_level_<?php echo $notice->level; ?>" colspan="3"><?php echo constant( "_AEC_NOTICE_NUMBER_" . $notice->level ); ?></tr>
								<tr>
									<td><?php echo $notice->datetime; ?></td>
									<td><?php echo $notice->short; ?></td>
									<td>[<a href="index2.php?option=com_acctexp&amp;task=readNotice&amp;id=<?php echo $notice->id; ?>"><?php echo _AEC_NOTICE_MARK_READ; ?></a>]</td>
								</tr>
								<tr>
									<td class="notice_level_<?php echo $notice->level; ?>">&nbsp;</td>
									<td><?php echo htmlentities( stripslashes( $notice->event ) ); ?></td>
									<td><?php echo $notice->tags; ?></td>
								</tr>
							<?php
							}
							?>
							</table>
						</div>
						<?php
						}
						?>
					</div>
				</td>
				<td width="320" valign="top" class="centerlogo">
					<br />
					<center><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_logo_big.png" border="0" alt="AEC" width="200" height="232" /></center>
					<br />
					<div style="margin-left:auto;margin-right:auto;width:400px;text-align:center;"><p><strong>Account Expiration Control</strong> Component - Version <?php echo _AEC_VERSION; ?></p>
						<p><?php echo _AEC_FOOT_TX_CHOOSING; ?></p>
						<div style="margin: 0 auto;text-align:center;">
							<a href="http://www.valanx.org"> <img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/valanx_logo.png" border="0" alt="valanx" /></a>
							<p><?php echo _AEC_FOOT_TX_GPL; ?></p>
							<p><?php echo _AEC_FOOT_TX_SUBSCRIBE; ?></p>
							<p><?php printf( _AEC_FOOT_CREDIT, AECToolbox::backendTaskLink( 'credits', _AEC_FOOT_CREDIT_LTEXT ) ); ?></p>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<?php
	}

	function credits()
	{
		HTML_myCommon::addBackendCSS();
		?>
		<table class="aecadminform">
			<tr>
				<td width="55%" valign="top" style="background-color: #eee;">
					<div style="background-color: #949494; margin: 2px; padding: 6px;">
						<div style="width: 100%; background-color: #000;">
							<center><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_dist_gfx.png" border="0" alt="" /></center>
						</div>
					</div>
					<div style="margin: 12px;">
					<h1>Leading Programmers</h1>
					<p>David 'skOre' Deutsch</p>
					<h1>Contributing Programmers</h1>
					<p>Mati 'mtk' Kochen, Calum 'polc1410' Polwart, Ethan 'ethanchai' Chai Voon Chong, Jake Jacobs</p>
					<h1>Past Contributing Programmers</h1>
					<p>Helder 'hlblog' Garcia, Michael 'mic' Pagler, Steven 'corephp' Pignataro, Ben 'Slinky' Ingram, Charles 'Slydder' Williams</p>
					<h1>Graphics</h1>
					<p>All layout and graphics design is CC-BY-NC-SA 2006-2009 David 'skOre' Deutsch. Additional icons are the silk icon set by Mark James (<a href="http://www.famfamfam.com/">famfamfam.com</a>).
					<h1>Eternal Gratitude</h1>
					<p>These are the people without whom I could not have kept up the pace:</p>
					<p>William 'Jake' Jacobs, Calum 'polc1410' Polwart</p>
					<h1>Beta-Testers</h1>
					<p>People who have helped to check releases before they went out:</p>
					<p>Calum 'polc1410' Polwart, Aleksey Pikulik</p>
					<h1>Contributors</h1>
					<p>People who have helped on our code at one place or another:</p>
					<p>Kirk Lampert (who found lots and lots of rather embarrassing bugs), Rasmus Dahl-Sorensen</p>
					<h1>Translators</h1>
					<p>Jarno en Mark Baselier from Q5 Grafisch Webdesign (for help on dutch translation)</p>
					<p>Traduction fran&ccedil;aise par Garstud, Johnpoulain, Cobayes, cb75ter, Sharky</p>
					</div>
				</td>
				<td width="45%" valign="top">
					<br />
					<center><img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_logo_big.png" border="0" alt="AEC" width="200" height="232" /></center>
					<br />
					<div style="margin-left:auto;margin-right:auto;width:400px;text-align:center;"><p><strong>Account Expiration Control</strong> Component - Version <?php echo _AEC_VERSION ?></p>
						<p><?php echo _AEC_FOOT_TX_CHOOSING; ?></p>
					<div style="margin: 0 auto;text-align:center;">
						<a href="http://www.valanx.org"> <img src="<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/valanx_logo.png" border="0" alt="valanx" /></a>
						<p><?php echo _AEC_FOOT_TX_GPL; ?></a></p>
						<p><?php echo _AEC_FOOT_TX_SUBSCRIBE; ?></p>
					</div>
				</td>
			</tr>
		</table>
		<?php
	}

	function hacks ( $option, $hacks )
	{
		$infohandler	= new GeneralInfoRequester();
		$cmsname		= strtolower($infohandler->getCMSName());
		HTML_myCommon::addBackendCSS(); ?>

		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="returnTask" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<table class="adminheading">
			<tr>
				<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_hacks.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
				<?php echo _AEC_HEAD_HACKS; ?>
				</th>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<table class="aecadminform">
			<tr><td>
				<div style="width:100%; float:left;">
					<div class="usernote" style="width:350px; margin:5px;">
						<h2 style="color: #FF0000;"><?php echo _AEC_HACKS_NOTICE; ?>:</h2>
						<p><?php echo _AEC_HACKS_NOTICE_DESC; ?></p>
						<p><?php echo _AEC_HACKS_NOTICE_DESC2; ?></p>
						<p><?php echo _AEC_HACKS_NOTICE_DESC3; ?></p>
					</div>
					<?php if ( !aecJoomla15check() ) { ?>
						<div class="usernote" style="width:350px; margin:5px;">
							<h2><?php echo _AEC_HACKS_NOTICE_JACL; ?>:</h2>
							<p><?php echo _AEC_HACKS_NOTICE_JACL_DESC; ?></p>
						</div>
					<?php } ?>
				</div>
				<?php
				foreach ( $hacks as $handle => $content ) {
					if ( !$content['status'] ) {
						if ( isset($content['uncondition'] ) ) {
							if ( !empty( $hacks[$content['uncondition']]['status'] ) ) {
								continue ;
							}
						}
						if ( isset($content['condition'] ) ) {
							if ( empty( $hacks[$content['condition']]['status'] ) ) {
								continue ;
							}
						}
						if ( !empty($content['legacy'] ) ) {
							continue;
						}
					} ?>
					<div class="userinfobox">
						<a name="<?php echo $handle; ?>"></a>
						<h3><?php echo $content['name']; ?></h3>
						<div class="action">
							<?php
							echo aecHTML::Icon( $content['status'] ? 'tick.png' : 'stop.png' )
							. ' ' . ( $content['status'] ? _AEC_HACKS_ISHACKED : _AEC_HACKS_NOTHACKED ) ; ?>
							&nbsp;|&nbsp;
							 <a href="<?php echo 'index2.php?option=com_acctexp&amp;task=hacks&amp;filename=' . $handle . '&amp;undohack=' . $content['status'] ?>#<?php echo $handle; ?>"><?php echo $content['status'] ? _AEC_HACKS_UNDO : _AEC_HACKS_COMMIT ; ?></a>
						</div>
						<?php
						if ( !empty( $content['important'] ) && !$content['status'] ) { ?>
							<div class="important">&nbsp;</div>
							<?php
						} ?>
						<p style="width:60%; padding:3px;">
							<?php
							if ( !empty( $content['legacy'] ) ) { ?>
								<img src="<?php echo JURI::root();?>media/com_acctexp/images/admin/icons/aec_symbol_importance_3.png" title="<?php echo _AEC_HACKS_LEGACY; ?>" alt="<?php echo _AEC_HACKS_LEGACY; ?>" />
								<?php
							} ?>
							<?php echo $content['desc']; ?>
						</p>
						<?php if ( isset( $content['filename'] ) ) { ?>
							<div class="explainblock">
								<p>
									<strong><?php echo _AEC_HACKS_FILE; ?>:&nbsp;<?php echo $content['filename']; ?></strong>
								</p>
							<?php
							if ( ( strcmp( $content['type'], 'file' ) === 0 ) && !$content['status'] ) {
								if ( empty( $content['legacy'] ) ) { ?>
									<p><?php echo _AEC_HACKS_LOOKS_FOR; ?>:</p>
									<pre><?php print htmlentities( $content['read'] ); ?></pre>
									<p><?php echo _AEC_HACKS_REPLACE_WITH; ?>:</p>
									<pre><?php print htmlentities( $content['insert'] ); ?></pre>
									<?php
								}
							} ?>
							</div>
							<?php
						} ?>
					</div>
					<?php
				} ?>
			</td></tr>
		</table>

 		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $hacks );
		}

 		HTML_myCommon::Valanx();
	}

	function help ( $option, $diagnose )
	{
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="returnTask" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<table class="adminheading">
			<tr>
				<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_help.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
				<?php echo _AEC_CMN_HELP; ?>
				</th>
			</tr>
			<tr><td></td></tr>
		</table>
		<table class="aecadminform">
			<tr><td>
				<table border="0">
					<tr><td>
					<p><?php echo _AEC_HELP_DESC; ?></p>
					<p><strong class="importance_1"><?php echo _AEC_HELP_GREEN; ?></p>
					<p><strong class="importance_2"><?php echo _AEC_HELP_YELLOW; ?></p>
					<p><strong class="importance_3"><?php echo _AEC_HELP_RED; ?></p>
					<p><?php echo _AEC_HELP_GEN; ?></p>
					<?php
					/**
					 * Syntax:
					 * 0 Name
					 * 1 Status
					 * 2 Importance
					 * 3 Explaination
					 * 4 Advice
					 * 5 DetectOnly (0:No, 1:Yes -Don't display if Status=0)
					 */
					foreach ( $diagnose as $dia ) {
						if (!$dia[5] || ($dia[5] && $dia[1])) {
							if (!$dia[5]) {
								$importance = $dia[1] ? 1 : $dia[2];
								$advice = !$dia[1];
								$icon_status = aecHTML::Icon( $dia[1] ? 'tick.png' : 'stop.png' );
							} else {
								$importance = $dia[2];
								$advice = $dia[1];
								$icon_status = aecHTML::Icon( 'stop.png' );
							} ?>
							<div class="diagnose">
								<img src="<?php echo JURI::root();?>media/com_acctexp/images/admin/icons/aec_symbol_importance_<?php echo $importance; ?>.png" width="60" height="80" alt="" />
								<h1 class="importance_<?php echo $importance; ?>"><?php echo $dia[0]; ?></h1>
								<p class="notice_<?php echo $advice; ?>"><?php echo $icon_status; ?> <?php echo $dia[3]; ?></p>
								<?php
								if ($dia[4] && $advice) { ?>
									<p class="notice_1"><?php echo aecHTML::Icon("arrow_right.png"); ?> <?php echo $dia[4]; ?></p>
									<?php
								} ?>
							</div>
							<?php
						}
					} ?>
					</td></tr>
				</table>
			</tr>
		</table>

 		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $diagnose );
		}

 		HTML_myCommon::Valanx();
	}

	function Settings( $option, $aecHTML, $tab_data, $editors )
	{
		HTML_myCommon::addBackendCSS();
		loadOverlib();
		?>
		<script language="javascript" type="text/javascript">
		    /* <![CDATA[ */
			function submitbutton(pressbutton) {
				<?php
				$k = 1;
				foreach ($editors as $editor) {
					getEditorContents( 'editor' . $k, $editor );
					$k++;
				}
				?>
				submitform( pressbutton );
			}
			/* ]]> */
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_settings.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
					<?php echo _AEC_HEAD_SETTINGS; ?>
				</th>
			</tr>
			<tr><td></td></tr>
		</table>
		<?php

		$tabs = new JPaneTabs(0);
		echo $tabs->startPane( 'settings' );

		$i = 0;

		foreach( $tab_data as $tab ) {
			echo $tabs->startPanel( $tab[0], $tab[0] );

			if ( isset( $tab[2] ) ) {
				echo '<div class="aec_tabheading">' . $tab[2] . '</div>';
			}

			echo '<table width="100%" class="aecadminform"><tr><td>';

			foreach ( $aecHTML->rows as $rowname => $rowcontent ) {
				echo $aecHTML->createSettingsParticle( $rowname );
				unset( $aecHTML->rows[$rowname] );
				// Skip to next tab if last item in this one reached
				if ( strcmp( $rowname, $tab[1] ) === 0 ) {
					echo '</td></tr></table>';
					echo $tabs->endPanel();
					continue 2;
				}
			}

			echo '</td></tr></table>';
			echo $tabs->endPanel();
		}
		?>
		<input type="hidden" name="id" value="1" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		</form>
		<?php
		// close pane and include footer
		echo $tabs->endPane();

		echo $aecHTML->loadJS();

		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML, $tab_data, $editors );
		}

 		HTML_myCommon::Valanx();
	}

	function listProcessors( $rows, $pageNav, $option )
	{
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
				<tr>
					<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_settings.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
						<?php echo _PROCESSORS_TITLE; ?>
					</th>
				</tr>
				<tr><td></td></tr>
			</table>

			<table class="adminlist">
				<tr>
					<th width="1%">#</th>
					<th width="1%">id</th>
					<th width="1%"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _PROCESSOR_NAME; ?></th>
					<th align="left" nowrap="nowrap"><?php echo _PROCESSOR_INFO; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _PROCESSOR_ACTIVE; ?></th>
				</tr>

		<?php
		$k = 0;
		for( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
			$row = &$rows[$i]; ?>
				<tr class="row<?php echo $k; ?>">
					<td width="1%" align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
					<td width="1%" align="center"><?php echo $row->processor->id; ?></td>
					<td width="1%"><?php echo mosHTML::idBox( $i, $row->processor->id, false, 'id' ); ?></td>
					<td width="15%">
						<a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','editProcessor')" title="<?php echo _AEC_CMN_CLICK_TO_EDIT; ?>"><?php echo $row->processor->info['longname']; ?></a>
					</td>
					<td><?php echo $row->processor->info['statement']; ?></td>
					<td width="3%" align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->processor->active ? 'unpublishProcessor' : 'publishProcessor'; ?>')">
							<img src="<?php echo JURI::base(); ?>images/<?php echo $row->processor->active ? 'publish_g.png' : 'publish_x.png'; ?>" width="12" height="12" border="0" alt="<?php echo $row->processor->active ? _AEC_CMN_YES : _AEC_CMN_NO; ?>" title="<?php echo $row->processor->active ? _AEC_CMN_YES : _AEC_CMN_NO; ?>" />
						</a>
					</td>
				</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
 		<?php
 		echo $pageNav->getListFooter();
		HTML_myCommon::ContentLegend(); ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="showProcessors" />
		<input type="hidden" name="returnTask" value="showProcessors" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $rows, $pageNav, $option );
		}

 		HTML_myCommon::Valanx();
	}

	function editProcessor( $option, $aecHTML )
	{
		HTML_myCommon::addBackendCSS();
		loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
			<tr>
				<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_settings.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
					<?php echo _AEC_HEAD_SETTINGS . ': ' . ( !empty( $aecHTML->pp->info['longname'] ) ? $aecHTML->pp->info['longname'] : '' ); ?>
				</th>
			</tr>
			<tr><td></td></tr>
		</table>
		<?php

		$tabs = new JPaneTabs(0);
		echo $tabs->startPane( 'settings' );
		if ( !empty( $aecHTML->pp ) ) {
			echo $tabs->startPanel( $aecHTML->pp->processor_name, $aecHTML->pp->info['longname'] );

			echo '<div class="aec_tabheading"><h2>' . $aecHTML->pp->info['longname'] . '</h2>';
			echo '<img src="' . JURI::root( true ) . '/media/' . $option . '/images/site/gwlogo_' . $aecHTML->pp->processor_name . '.png" alt="' . $aecHTML->pp->processor_name . '" title="' . $aecHTML->pp->processor_name .'" class="plogo" />';
			echo '</div>';
			$id = $aecHTML->pp->id;
		} else {
			echo $tabs->startPanel( 'new processor', 'new processor' );

			echo '<div class="aec_tabheading"><h2>' . '' . '</h2></div>';

			$id = 0;
		}

		echo '<table width="100%" class="aecadminform"><tr><td>';

		foreach ( $aecHTML->rows as $rowname => $rowcontent ) {
			echo $aecHTML->createSettingsParticle( $rowname );
		}

		echo '</td></tr></table>';
		echo $tabs->endPanel();
		?>
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		</form>
		<?php
		// close pane and include footer
		echo $tabs->endPane();

		echo $aecHTML->loadJS();

		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML );
		}

 		HTML_myCommon::Valanx();
	}

	function listSubscriptions( $rows, $pageNav, $search, $option, $lists, $subscriptionid, $action )
	{
		$user = &JFactory::getUser();

		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_<?php echo $action[0]; ?>.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;"><?php echo $action[1]; ?></th>
					<td nowrap="nowrap"><?php echo $lists['groups'];?></td>
					<td style="text-align:center;">
						<?php echo _PLAN_FILTER . '<br />' . $lists['filterplanid'] . _ORDER_BY . '<br />' . $lists['orderNav']; ?>
						<input type="button" class="button" onclick="document.adminForm.submit();" value="<?php echo _AEC_CMN_APPLY; ?>" style="margin:2px;text-align:center;" />
					</td>
					<td style="white-space:nowrap; float:right; text-align:left; padding:3px; margin:3px;">
						<?php echo $lists['planid']; ?>
						<br />
						<?php echo $lists['set_expiration']; ?>
						<br />
						<?php echo _AEC_CMN_SEARCH; ?>
						<br />
						<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
					</td>
				</tr>
				<tr><td></td></tr>
			</table>
			<table class="adminlist">
				<tr>
					<th width="20">#</th>
					<th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
					<th width="20">&nbsp;</th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _CNAME; ?></th>
					<th width="10%" align="left" nowrap="nowrap"><?php echo _USERLOGIN; ?></th>
					<th width="10%" align="left" nowrap="nowrap"><?php echo _AEC_CMN_STATUS; ?></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _SUBSCR_DATE; ?></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _LASTPAY_DATE; ?></th>
					<th width="10%" align="left" nowrap="nowrap"><?php echo _METHOD; ?></th>
					<th width="10%" align="left" nowrap="nowrap"><?php echo _USERPLAN; ?></th>
					<th width="27%" align="left" nowrap="nowrap"><?php echo _EXPIRATION; ?></th>
				</tr>
				<?php
				$k = 0;
				for( $i=0; $i < count( $rows ); $i++ ) {
					$row = &$rows[$i];

					if ( !isset( $row->status ) ) {
						$row->status		= '-';
						$row->lastpay_date	= '-';
						$row->type			= '-';
						$row->plan_name		= '-';
						$row->lifetime		= '-';
						$row->expiration	= '-';
					}

					$rowstyle = '';
					if ( is_array( $subscriptionid ) ) {
						if ( in_array( $row->id, $subscriptionid ) ) {
							$rowstyle = ' style="border: 2px solid #DD0;"';
						}
					} ?>
						<tr class="row<?php echo $k; ?>"<?php echo $rowstyle; ?>>
							<td width="20" align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
							<td width="20"><?php echo mosHTML::idBox( $i, $row->id, false, ( ( $action[0] == 'manual' ) ? 'userid' : 'subscriptionid' ) ); ?></td>
							<td width="20"><?php echo !empty( $row->primary ) ? aecHTML::Icon( 'star.png', _AEC_USER_SUBSCRIPTIONS_PRIMARY ) : '&nbsp;'; ?></td>
							<td width="15%" align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','edit')" title="<?php echo _AEC_CMN_CLICK_TO_EDIT; ?>"><?php echo $row->name; ?> </a></td>
							<td width="10%" align="left"><?php echo $row->username; ?></td>
							<td width="10%" align="left"><?php echo $row->status; ?></td>
							<td width="15%" align="left"><?php echo HTML_AcctExp::DisplayDateInLocalTime( $row->signup_date ); ?></td>
							<td width="15%" align="left"><?php echo HTML_AcctExp::DisplayDateInLocalTime( $row->lastpay_date ); ?></td>
							<td width="10%" align="left"><?php echo $row->type; ?></td>
							<td width="10%" align="left"><?php echo $row->plan_name; ?> </td>
							<td width="27%" align="left"><?php echo $row->lifetime ? _AEC_CMN_LIFETIME : HTML_AcctExp::DisplayDateInLocalTime($row->expiration); ?></td>
						</tr>
					<?php
					$k = 1 - $k;
				} ?>
			</table>
			<?php echo $pageNav->getListFooter(); ?>
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="showActive" />
			<input type="hidden" name="returnTask" value="showActive" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>

 		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $user, $rows, $pageNav, $search, $option, $lists, $subscriptionid, $action );
		}

 		HTML_myCommon::Valanx();
	}

	function listMicroIntegrations( $rows, $pageNav, $option, $lists, $search, $ordering )
	{
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
				<tr>
					<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_microintegrations.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;"><?php echo _MI_TITLE; ?></th>
					<td style="text-align:center;">
						<?php echo _PLAN_FILTER; ?>
						&nbsp;
						<?php echo $lists['filterplanid'] . _ORDER_BY . $lists['orderNav']; ?>
						<input type="button" class="button" onclick="document.adminForm.submit();" value="<?php echo _AEC_CMN_APPLY; ?>" style="margin:2px;text-align:center;" />
					</td>
					<td style="white-space:nowrap; float:right; text-align:left; padding:3px; margin:3px;">
						<br />
						<br />
						<?php echo _AEC_CMN_SEARCH; ?>
						<br />
						<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
					</td>
				</tr>
				<tr><td></td></tr>
			</table>
			<table class="adminlist">
				<tr>
					<th width="20">#</th>
					<th width="20">id</th>
					<th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _MI_NAME; ?></th>
					<th width="20%" align="left" nowrap="nowrap" ><?php echo _MI_DESC; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _MI_ACTIVE; ?></th>
					<?php if ( $ordering ) { ?>
						<th width="5%" colspan="2" nowrap="nowrap"><?php echo _MI_REORDER; ?></th>
					<?php } ?>
					<th width="5%" align="right" nowrap="nowrap"><?php echo _MI_FUNCTION; ?></th>
				</tr>

		<?php
		$k = 0;
		for( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
			$row = &$rows[$i]; ?>
				<tr class="row<?php echo $k; ?>">
					<td width="20" align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
					<td width="20" align="center"><?php echo $row->id; ?></td>
					<td width="20"><?php echo mosHTML::idBox( $i, $row->id, false, 'id' ); ?></td>
					<td width="15%">
						<?php
						if (!isset($row->id)) {
							echo $row->name;
						} else { ?>
							<a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','editMicroIntegration')" title="<?php echo _AEC_CMN_CLICK_TO_EDIT; ?>"><?php echo $row->name; ?></a> <?php
						} ?>
					</td>
					<td width="20%" align="left">
						<?php
						echo $row->desc ? ( strlen( strip_tags( $row->desc ) > 50 ) ? substr( strip_tags( $row->desc ), 0, 50) . ' ...' : strip_tags( $row->desc ) ) : ''; ?>
						</td>
					<td width="3%" align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo ($row->active) ? 'unpublishMicroIntegration' : 'publishMicroIntegration'; ?>')">
							<img src="<?php echo JURI::base(); ?>images/<?php echo ( $row->active ) ? 'publish_g.png' : 'publish_x.png'; ?>" width="12" height="12" border="0" alt="<?php echo ( $row->active ) ? _AEC_CMN_YES : _AEC_CMN_NO; ?>" title="<?php echo ( $row->active ) ? _AEC_CMN_YES : _AEC_CMN_NO; ?>" />
						</a>
					</td>
					<?php if ( $ordering ) { ?>
						<td align="right"><?php echo $pageNav->orderUpIcon( $i, true, 'ordermiup' ); ?></td>
						<td align="right"><?php echo $pageNav->orderDownIcon( $i, $n, true, 'ordermidown' ); ?></td>
					<?php } ?>
					<td width="45%" align="right"><?php echo $row->class_name; ?></td>
				</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
 		<?php
 		echo $pageNav->getListFooter();
		HTML_myCommon::ContentLegend(); ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="showMicroIntegrations" />
		<input type="hidden" name="returnTask" value="showMicroIntegrations" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $rows, $pageNav, $option );
		}

 		HTML_myCommon::Valanx();
	}

	function editMicroIntegration( $option, $row, $lists, $aecHTML )
	{
		//$Returnid = intval( aecGetParam( $_REQUEST, 'Returnid', 0 ) );

		$tabs = new JPaneTabs(0);
		loadOverlib();
		HTML_myCommon::addBackendCSS();

		?>
		<script type="text/javascript">
			/* <![CDATA[ */
			/*
			function swap() {
				lifechecked = document.adminForm.ck_lifetime.checked;
				if (lifechecked==false) {
					document.adminForm.expiration.disabled = false;
					document.adminForm.reset.disabled = false;
				} else {
					document.adminForm.expiration.disabled = true;
					document.adminForm.reset.disabled = true;
				}
			}
			*/
			/* ]]> */
		</script>
		<table class="adminheading">
			<tr>
				<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_microintegrations.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
					<?php echo _AEC_HEAD_MICRO_INTEGRATION; ?>:&nbsp;
					<small><?php echo $row->id ? $row->name : _AEC_CMN_NEW; ?></small>
	        	</th>
			</tr>
		</table>
		<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td valign="top">
						<?php
		                echo $tabs->startPane( 'createMicroIntegration' );
		                echo $tabs->startPanel( _MI_E_TITLE, _MI_E_TITLE );
		                ?>
		                <div class="aec_tabheading"><h2><?php echo _MI_E_TITLE; ?></h2></div>
		                <table width="100%" class="aecadminform">
							<tr>
							<td>
								<h2><?php echo _MI_E_TITLE_LONG; ?></h2>
								<div class="userinfobox">
									<div style="position:relative;float:left;">
										<?php echo $aecHTML->createSettingsParticle( 'active' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'name' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'desc' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'auto_check' ); ?>
										<?php echo $aecHTML->createSettingsParticle( '_aec_global_exp_all' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'on_userchange' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'pre_exp_check' ); ?>
									</div>
								</div>
							</td>
							<td valign="top">
								<h3><?php echo _MI_E_FUNCTION_NAME; ?></h3>
								<div class="userinfobox">
									<div style="position:relative;float:left;">
									<?php if ( !$aecHTML->hasSettings ) {
										if ( $lists['class_name'] ) {
											echo $lists['class_name']; ?>
											<br />
											<?php
											echo _MI_E_FUNCTION_DESC;
										} else {
											echo _AEC_MSG_MIS_NOT_DEFINED;
										}
									} else {
										echo "<p><strong>" . $row->class_name . "</p></strong>";
									}
									?>
								</td>
							</tr>
							</table>
							<?php if ( $aecHTML->hasSettings ) {
			                echo $tabs->endPanel();
			                echo $tabs->startPanel( _MI_E_SETTINGS, _MI_E_SETTINGS ); ?>
				                <div class="aec_tabheading"><h2><?php echo _MI_E_SETTINGS; ?></h2></div>
				                <table width="100%" class="aecadminform">
									<?php
									foreach ( $aecHTML->customparams as $name ) { ?>
				                		<tr><td><?php echo $aecHTML->createSettingsParticle( $name ); ?></td></tr>
				                		<?php
									} ?>
								</table>
								<?php
							}
			                echo $tabs->endPanel();
			                echo $tabs->endPane(); ?>
						</td>
					</tr>
				</table>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $row, $lists, $aecHTML );
		}

 		HTML_myCommon::Valanx();
	}

	function listSubscriptionPlans( $rows, $lists, $pageNav, $option )
	{
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
				<tr>
					<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_plans.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;"><?php echo _PAYPLANS_TITLE; ?></th>
					<td nowrap="nowrap">
						<?php echo $lists['filter_group'];?>
						<input type="button" class="button" onclick="document.adminForm.submit();" value="<?php echo _AEC_CMN_APPLY; ?>" style="margin:2px;text-align:center;" />
					</td>
				</tr>
				<tr><td></td></tr>
			</table>

			<table class="adminlist">
				<tr>
					<th width="1%">#</th>
					<th width="1%"><?php echo _AEC_CMN_ID; ?></th>
					<th width="1%"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
					<th width="2%" align="left" nowrap="nowrap"><?php echo _PAYPLAN_GROUP; ?></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _PAYPLAN_NAME; ?></th>
					<th width="20%" align="left" nowrap="nowrap"><?php echo _PAYPLAN_DESC; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _PAYPLAN_ACTIVE; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _PAYPLAN_VISIBLE; ?></th>
					<th width="5%" colspan="2" nowrap="nowrap"><?php echo _PAYPLAN_REORDER; ?></th>
					<th width="5%" nowrap="nowrap" align="center"><?php echo _PAYPLAN_USERCOUNT; ?></th>
					<th width="5%" nowrap="nowrap" align="center"><?php echo _PAYPLAN_EXPIREDCOUNT; ?></th>
					<th width="5%" nowrap="nowrap" align="center"><?php echo _PAYPLAN_TOTALCOUNT; ?></th>
				</tr>

		<?php
		$k = 0;
		for( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
				switch( $rows[$i]->visible ) {
					case '1':
						$vaction	= 'invisibleSubscriptionPlan';
						$vicon		= 'eye.png';
						$vtext		= _PAYPLAN_VISIBLE;
						break;

					case '0':
						$vaction	= 'visibleSubscriptionPlan';
						$vicon		= 'cancel.png';
						$vtext		= _AEC_CMN_INVISIBLE;
						break;
				}

				switch( $rows[$i]->active ) {
					case '1':
						$aaction	= 'unpublishSubscriptionPlan';
						$aicon		= 'accept.png';
						$atext		= _AEC_CMN_PUBLISHED;
						break;

					case '0':
						$aaction	= 'publishSubscriptionPlan';
						$aicon		= 'cancel.png';
						$atext		= _AEC_CMN_NOT_PUBLISHED;
						break;
				}

				if ( !is_null( $rows[$i]->desc ) ) {
					$description = strip_tags( $rows[$i]->desc );
					if ( strlen( $description ) > 50 ) {
						$description = substr( $description, 0, 50) . ' ...';
					}
				} else {
					$description = '';
				}

				?>
				<tr class="row<?php echo $k; ?>">
					<td align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
					<td align="right"><?php echo $rows[$i]->id; ?></td>
					<td><?php echo mosHTML::idBox( $i, $rows[$i]->id, false, 'id' ); ?></td>
					<td align="right" style="background: #<?php echo $rows[$i]->color; ?>;"><?php echo $rows[$i]->group; ?></td>
					<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','editSubscriptionPlan')" title="<?php echo _AEC_CMN_CLICK_TO_EDIT; ?>"><?php echo $rows[$i]->name; ?></a></td>
					<td  align="left">
						<?php
						echo $description; ?>
					</td>
					<td align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $aaction; ?>')">
							<?php echo aecHTML::Icon( $aicon, $atext ); ?>
						</a>
					</td>
					<td align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $vaction; ?>')">
							<?php echo aecHTML::Icon( $vicon, $vtext ); ?>
						</a>
					</td>
					<td align="right"><?php echo $pageNav->orderUpIcon( $i, true, 'orderplanup' ); ?></td>
					<td align="right"><?php echo $pageNav->orderDownIcon( $i, $n, true, 'orderplandown' ); ?></td>
					<?php if ( aecJoomla15check() ) { ?>
						<td align="center"><a href="index.php?option=com_acctexp&amp;task=showSubscriptions&amp;plan=<?php echo $rows[$i]->id; ?>"><strong><?php echo $rows[$i]->usercount; ?></strong></a></td>
						<td align="center"><a href="index.php?option=com_acctexp&amp;task=showExpired&amp;plan=<?php echo $rows[$i]->id; ?>"><?php echo $rows[$i]->expiredcount; ?></a></td>
						<td align="center"><a href="index.php?option=com_acctexp&amp;task=showAllSubscriptions&amp;plan=<?php echo $rows[$i]->id; ?>"><strong><?php echo $rows[$i]->usercount + $rows[$i]->expiredcount; ?></strong></a></td>
					<?php } else { ?>
						<td align="center"><a href="index2.php?option=com_acctexp&amp;task=showSubscriptions&amp;plan=<?php echo $rows[$i]->id; ?>"><strong><?php echo $rows[$i]->usercount; ?></strong></a></td>
						<td align="center"><a href="index2.php?option=com_acctexp&amp;task=showExpired&amp;plan=<?php echo $rows[$i]->id; ?>"><?php echo $rows[$i]->expiredcount; ?></a></td>
						<td align="center"><a href="index2.php?option=com_acctexp&amp;task=showAllSubscriptions&amp;plan=<?php echo $rows[$i]->id; ?>"><strong><?php echo $rows[$i]->usercount + $rows[$i]->expiredcount; ?></strong></a></td>
					<?php } ?>
				</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
 		<?php
 		echo $pageNav->getListFooter();
		HTML_myCommon::ContentLegend(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="showSubscriptionPlans" />
		<input type="hidden" name="returnTask" value="showSubscriptionPlans" />
		<input type="hidden" name="boxchecked" value="0" />
	</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $rows, $pageNav, $option );
		}

 		HTML_myCommon::Valanx();
	}

	function editSubscriptionPlan( $option, $aecHTML, $row, $hasrecusers )
	{
		$user = &JFactory::getUser();

		loadOverlib();
		HTML_myCommon::addBackendCSS(); ?>

		<script type="text/javascript">
		    /* <![CDATA[ */
			function submitbutton(pressbutton) {
				<?php getEditorContents( 'desc', 'desc' ) ; ?>;
				submitform( pressbutton );
			}
			/* ]]> */
		</script>
		<table class="adminheading">
			<tr>
				<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_plans.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
					<?php echo _AEC_HEAD_PLAN_INFO; ?>:
					&nbsp;
					<small><?php echo $row->id ? $row->name : _AEC_CMN_NEW; ?></small>
	        	</th>
			</tr>
		</table>
		<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td valign="top">
						<?php
						$tabs = new JPaneTabs(0);
		                echo $tabs->startPane( 'editSubscriptionPlan' );
		                echo $tabs->startPanel( _PAYPLAN_DETAIL_TITLE, _PAYPLAN_DETAIL_TITLE );
		                ?>
		                <div class="aec_tabheading"><h2><?php echo _PAYPLAN_DETAIL_TITLE; ?></h2></div>
						<table class="aecadminform">
							<tr>
								<td style="padding:10px;" valign="top">
									<div style="position:relative;float:left;width:32%;padding:4px;">
										<div class="userinfobox">
											<div style="position:relative;float:left;width:100%;">
												<?php
												if ( $row->id ) { ?>
													<p style="float:right;padding:2px;clear:right;"><a href="<?php echo JURI::root(); ?>index.php?option=com_acctexp&amp;task=subscribe&amp;usage=<?php echo $row->id; ?>" title="<?php echo _AEC_CGF_LINK_ABO_FRONTEND; ?>" target="_blank"><?php echo _AEC_CGF_LINK_ABO_FRONTEND; ?></a></p>
													<p style="float:right;padding:2px;clear:right;"><a href="<?php echo JURI::root(); ?>index.php?option=com_acctexp&amp;task=addtocart&amp;usage=<?php echo $row->id; ?>" title="<?php echo _AEC_CGF_LINK_CART_FRONTEND; ?>" target="_blank"><?php echo _AEC_CGF_LINK_CART_FRONTEND; ?></a></p>
													<?php
												}
												echo $aecHTML->createSettingsParticle( 'name' );
												?>
											</div>
											<?php echo $aecHTML->createSettingsParticle( 'active' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'visible' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'notauth_redirect' ); ?>
										</div>
										<div class="userinfobox">
											<h2 style="clear:both;"><?php echo _ITEMGROUPS_TITLE; ?></h2>
											<table style="width:100%;">
												<tr>
													<th>ID</td>
													<th>Name</td>
													<th>delete</td>
												</tr>
												<?php
												if ( !empty( $aecHTML->customparams->groups ) ) {
													foreach ( $aecHTML->customparams->groups as $id => $group ) {
														?>
														<tr>
															<td align="right" style="background: #<?php echo $group['color']; ?>;"><?php echo $group['group']; ?></td>
															<td><?php echo $group['name']; ?></td>
															<td><?php echo $aecHTML->createSettingsParticle( 'group_delete_'.$id ); ?></td>
														</tr>
														<?php
													}
												}
												?>
												<tr>
													<td><?php echo _NEW_ITEMGROUP; ?>:</td>
													<td colspan="2"><?php echo $aecHTML->createSettingsParticle( 'add_group' ); ?></td>
												</tr>
											</table>
										</div>
									</div>
									<div style="position:relative;float:left;width:32%;padding:4px;">
										<div class="userinfobox">
											<?php echo $aecHTML->createSettingsParticle( 'gid_enabled' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'gid' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'make_active' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'make_primary' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'update_existing' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'override_activation' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'override_regmail' ); ?>
											<div style="width:180px;float:left;"><?php echo $aecHTML->createSettingsParticle( 'fallback' ); ?></div>
											<div style="width:180px;float:left;"><?php echo $aecHTML->createSettingsParticle( 'standard_parent' ); ?></div>
										</div>
									</div>
									<div style="position:relative;float:left;width:32%;padding:4px;">
										<div class="userinfobox">
											<?php echo $aecHTML->createSettingsParticle( 'full_free' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'full_amount' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'lifetime' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'full_period' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'full_periodunit' ); ?>
											<div class="usernote" style="width:200px;">
												<?php echo _PAYPLAN_AMOUNT_NOTICE_TEXT; ?>
											</div>
											<?php if ( $hasrecusers ) { ?>
												<div class="usernote" style="width:200px;">
													<strong><?php echo _PAYPLAN_AMOUNT_EDITABLE_NOTICE; ?></strong>
												</div>
											<?php } ?>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_PROCESSORS_TITLE, _PAYPLAN_PROCESSORS_TITLE );
						?>
						<div class="aec_tabheading"><h2><?php echo _PAYPLAN_PROCESSORS_TITLE_LONG; ?></h2></div>
						<table width="100%" class="aecadminform"><tr><td>
							<?php
							if ( !empty( $aecHTML->customparams->pp ) ) {
								foreach ( $aecHTML->customparams->pp as $id => $processor ) {
									?>
									<div class="userinfobox clear">
										<h2 style="clear:both;"><?php echo $processor['name']; ?></h2>
										<p><a href="<?php echo JURI::root( true ); ?>/index.php?option=com_acctexp&amp;task=subscribe&amp;usage=<?php echo $row->id; ?>&amp;processor=<?php echo $processor['handle']; ?>" title="<?php echo _AEC_CGF_LINK_ABO_FRONTEND; ?>" target="_blank"><?php echo _AEC_CGF_LINK_ABO_FRONTEND; ?></a></p>
										<?php
										foreach ( $processor['params'] as $customparam ) {
											echo $aecHTML->createSettingsParticle( $customparam );
										}
										?>
									</div>
									<?php
								}
							}
							?>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_TEXT_TITLE, _PAYPLAN_TEXT_TITLE );
		                ?>
		                <div class="aec_tabheading"><h2><?php echo _PAYPLAN_TEXT_TITLE; ?></h2></div>
		                <table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'customamountformat' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'desc' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'email_desc' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'customthanks' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'customtext_thanks_keeporiginal' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'customtext_thanks' ); ?>
							</div>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_RESTRICTIONS_TITLE, _PAYPLAN_RESTRICTIONS_TITLE );
		                ?>
		                <div class="aec_tabheading"><h2><?php echo _PAYPLAN_RESTRICTIONS_TITLE; ?></h2></div>
						<table class="aecadminform">
							<?php echo aecRestrictionHelper::echoSettings( $aecHTML ); ?>
						<tr><td>
								<div class="userinfobox">
									<div style="position:relative;float:left;">
										<?php echo $aecHTML->createSettingsParticle( 'custom_restrictions_enabled' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'custom_restrictions' ); ?>
										<br />
										<?php echo $aecHTML->createSettingsParticle( 'rewriteInfo' ); ?>
									</div>
								</div>
						</td></tr>
						</table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_TRIAL_TITLE, _PAYPLAN_TRIAL_TITLE );
						?>
						<div class="aec_tabheading"><h2><?php echo _PAYPLAN_TRIAL_TITLE; ?><?php echo $aecHTML->ToolTip( _PAYPLAN_TRIAL_DESC, _PAYPLAN_TRIAL ); ?></h2></div>
						<table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'trial_free' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'trial_amount' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'trial_period' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'trial_periodunit' ); ?>
								<div class="usernote" style="width:200px;">
									<?php echo _PAYPLAN_AMOUNT_NOTICE_TEXT; ?>
								</div>
							</div>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_RELATIONS_TITLE, _PAYPLAN_RELATIONS_TITLE );
						?>
						<div class="aec_tabheading"><h2><?php echo _PAYPLAN_RELATIONS_TITLE; ?></h2></div>
						<table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'similarplans' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'equalplans' ); ?>
							</div>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_MI, _PAYPLAN_MI );
		                ?>
		                <div class="aec_tabheading"><h2><?php echo _PAYPLAN_MI; ?></h2></div>
		                <table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'micro_integrations_inherited' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'micro_integrations' ); ?>
							</div>
							<?php if ( !empty( $aecHTML->customparams->hasperplanmi ) ) { ?>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'micro_integrations_plan' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'micro_integrations_hidden' ); ?>
							</div>
							<?php } ?>
							<?php
							if ( !empty( $aecHTML->customparams->mi ) ) {
								foreach ( $aecHTML->customparams->mi as $id => $mi ) {
									?>
									<div class="userinfobox clear">
										<h2 style="clear:both;"><?php echo $mi['name']; ?></h2>
										<?php
										foreach ( $mi['params'] as $customparam ) {
											echo $aecHTML->createSettingsParticle( $customparam );
										}
										?>
									</div>
									<?php
								}
							}
							?>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->endPane();
						?>
					</td>
				</tr>
			</table>
		<br />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<!--<script>swap();</script>-->

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML, $row, $hasrecusers );
		}

 		HTML_myCommon::Valanx();
	}

	function listItemGroups( $rows, $pageNav, $option )
	{
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
				<tr>
					<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_itemgroups.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
						<?php echo _ITEMGROUPS_TITLE; ?>
					</th>
				</tr>
				<tr><td></td></tr>
			</table>

			<table class="adminlist">
				<tr>
					<th width="1%">#</th>
					<th width="1%"><?php echo _AEC_CMN_ID; ?></th>
					<th width="1%"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
					<th width="5%"></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _ITEMGROUP_NAME; ?></th>
					<th width="20%" align="left" nowrap="nowrap"><?php echo _ITEMGROUP_DESC; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _ITEMGROUP_ACTIVE; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _ITEMGROUP_VISIBLE; ?></th>
					<th width="5%" colspan="2" nowrap="nowrap"><?php echo _ITEMGROUP_REORDER; ?></th>
				</tr>

		<?php
		$k = 0;
		for( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
				switch( $rows[$i]->visible ) {
					case '1':
						$vaction	= 'invisibleItemGroup';
						$vicon		= 'eye.png';
						$vtext		= _AEC_CMN_VISIBLE;
						break;

					case '0':
						$vaction	= 'visibleItemGroup';
						$vicon		= 'cancel.png';
						$vtext		= _AEC_CMN_INVISIBLE;
						break;
				}

				switch( $rows[$i]->active ) {
					case '1':
						$aaction	= 'unpublishItemGroup';
						$aicon		= 'accept.png';
						$atext		= _AEC_CMN_PUBLISHED;
						break;

					case '0':
						$aaction	= 'publishItemGroup';
						$aicon		= 'cancel.png';
						$atext		= _AEC_CMN_NOT_PUBLISHED;
						break;
				}

				if ( !is_null( $rows[$i]->desc ) ) {
					$description = strip_tags( $rows[$i]->desc );
					if ( strlen( $description ) > 50 ) {
						$description = substr( $description, 0, 50) . ' ...';
					}
				} else {
					$description = '';
				}

				?>
				<tr class="row<?php echo $k; ?>">
					<td align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
					<td align="right"><?php echo $rows[$i]->id; ?></td>
					<td><?php echo mosHTML::idBox( $i, $rows[$i]->id, false, 'id' ); ?></td>
					<td align="right" style="background: #<?php echo $rows[$i]->color; ?>;"><?php echo $rows[$i]->group; ?></td>
					<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','editItemGroup')" title="<?php echo _AEC_CMN_CLICK_TO_EDIT; ?>"><?php echo $rows[$i]->name; ?></a></td>
					<td  align="left">
						<?php
						echo $description; ?>
					</td>
					<td align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $aaction; ?>')">
							<?php echo aecHTML::Icon( $aicon, $atext ); ?>
						</a>
					</td>
					<td align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $vaction; ?>')">
							<?php echo aecHTML::Icon( $vicon, $vtext ); ?>
						</a>
					</td>
					<td align="right"><?php echo $pageNav->orderUpIcon( $i, true, 'ordergroupup' ); ?></td>
					<td align="right"><?php echo $pageNav->orderDownIcon( $i, $n, true, 'ordergroupdown' ); ?></td>
				</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
 		<?php
 		echo $pageNav->getListFooter();
		HTML_myCommon::ContentLegend(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="showItemGroups" />
		<input type="hidden" name="returnTask" value="showItemGroups" />
		<input type="hidden" name="boxchecked" value="0" />
	</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $rows, $pageNav, $option );
		}

 		HTML_myCommon::Valanx();
	}

	function editItemGroup( $option, $aecHTML, $row )
	{
		$user = &JFactory::getUser();

		loadOverlib();
		HTML_myCommon::addBackendCSS(); ?>

		<table class="adminheading">
			<tr>
				<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_itemgroups.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
					<?php echo _AEC_HEAD_ITEMGROUP_INFO; ?>:
					&nbsp;
					<small><?php echo $row->id ? $row->name : _AEC_CMN_NEW; ?></small>
	        	</th>
			</tr>
		</table>
		<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td valign="top">
						<?php
						$tabs = new JPaneTabs(0);
		                echo $tabs->startPane( 'editItemGroup' );
		                echo $tabs->startPanel( _ITEMGROUP_DETAIL_TITLE, _ITEMGROUP_DETAIL_TITLE );
		                ?>
		                <h2><?php echo _ITEMGROUP_DETAIL_TITLE; ?></h2>
						<table class="aecadminform">
							<tr>
								<td style="padding:10px;" valign="top">
									<div style="position:relative;float:left;width:32%;padding:4px;">
										<div class="userinfobox">
											<div style="position:relative;float:left;width:100%;">
												<?php
												echo $aecHTML->createSettingsParticle( 'name' );
												if ( $row->id ) { ?>
													<p><a href="<?php echo JURI::root( true ); ?>/index.php?option=com_acctexp&amp;task=subscribe&amp;group=<?php echo $row->id; ?>" title="<?php echo _AEC_CGF_LINK_ABO_FRONTEND; ?>" target="_blank"><?php echo _AEC_CGF_LINK_ABO_FRONTEND; ?></a></p>
													<?php
												} ?>
											</div>
											<?php echo $aecHTML->createSettingsParticle( 'active' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'visible' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'color' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'icon' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'reveal_child_items' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'symlink' ); ?>
											<?php echo $aecHTML->createSettingsParticle( 'notauth_redirect' ); ?>
										</div>
									</div>
									<div style="position:relative;float:left;width:32%;padding:4px;">
										<div class="userinfobox">
											<h2 style="clear:both;"><?php echo _ITEMGROUPS_TITLE; ?></h2>
											<table style="width:100%;">
												<tr>
													<th>ID</td>
													<th>Name</td>
													<th>delete</td>
												</tr>
												<?php
												if ( !empty( $aecHTML->customparams->groups ) ) {
													foreach ( $aecHTML->customparams->groups as $id => $group ) {
														?>
														<tr>
															<td align="right" style="background: #<?php echo $group['color']; ?>;"><?php echo $group['group']; ?></td>
															<td><?php echo $group['name']; ?></td>
															<td><?php echo $aecHTML->createSettingsParticle( 'group_delete_'.$id ); ?></td>
														</tr>
														<?php
													}
												}
												?>
												<tr>
													<td><?php echo _NEW_ITEMGROUP; ?>:</td>
													<td colspan="2"><?php echo $aecHTML->createSettingsParticle( 'add_group' ); ?></td>
												</tr>
											</table>
										</div>
									</div>
									<div style="position:relative;float:left;width:98%;padding:4px;">
										<div class="userinfobox">
											<?php echo $aecHTML->createSettingsParticle( 'desc' ); ?>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _ITEMGROUP_RESTRICTIONS_TITLE, _ITEMGROUP_RESTRICTIONS_TITLE );
		                ?>
		                <h2><?php echo _ITEMGROUP_RESTRICTIONS_TITLE; ?></h2>
						<table class="aecadminform">
							<?php echo aecRestrictionHelper::echoSettings( $aecHTML ); ?>
						<tr><td>
							<div class="userinfobox">
								<div style="position:relative;float:left;">
									<?php echo $aecHTML->createSettingsParticle( 'custom_restrictions_enabled' ); ?>
									<?php echo $aecHTML->createSettingsParticle( 'custom_restrictions' ); ?>
									<br />
									<?php echo $aecHTML->createSettingsParticle( 'rewriteInfo' ); ?>
								</div>
							</div>
						</td></tr>
						</table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _ITEMGROUP_RELATIONS_TITLE, _ITEMGROUP_RELATIONS_TITLE );
						?>
						<h2><?php echo _ITEMGROUP_RELATIONS_TITLE; ?></h2>
						<table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'similargroups' ); ?>
								<?php echo $aecHTML->createSettingsParticle( 'equalgroups' ); ?>
							</div>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _PAYPLAN_MI, _PAYPLAN_MI );
		                ?>
		                <div class="aec_tabheading"><h2><?php echo _PAYPLAN_MI; ?></h2></div>
		                <table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<?php echo $aecHTML->createSettingsParticle( 'micro_integrations' ); ?>
							</div>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->endPane();
						?>
					</td>
				</tr>
			</table>
		<br />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<!--<script>swap();</script>-->

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML, $row );
		}

 		HTML_myCommon::Valanx();
	}

	function listCoupons( $rows, $pageNav, $option, $type )
	{
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
				<tr>
					<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_coupons<?php echo $type ? '_static' : ''; ?>.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
						<?php echo constant( '_COUPON_TITLE' . ( $type ? '_STATIC' : '' ) ); ?>
					</th>
				</tr>
				<tr><td></td></tr>
			</table>

			<table class="adminlist">
				<tr>
					<th width="1%">#</th>
					<th width="1%"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
					<th width="15%" align="left" nowrap="nowrap"><?php echo _COUPON_NAME; ?></th>
					<th width="20%" align="center" nowrap="nowrap" ><?php echo _COUPON_CODE; ?></th>
					<th width="20%" align="left" nowrap="nowrap" ><?php echo _COUPON_DESC; ?></th>
					<th width="3%" nowrap="nowrap"><?php echo _COUPON_ACTIVE; ?></th>
					<th width="5%" colspan="2" nowrap="nowrap"><?php echo _COUPON_REORDER; ?></th>
					<th width="5%" nowrap="nowrap" align="center"><?php echo _COUPON_USECOUNT; ?></th>
				</tr>

		<?php
		$k = 0;
		for( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
			?>
				<tr class="row<?php echo $k; ?>">
					<td align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
					<td><?php echo mosHTML::idBox( $i, $rows[$i]->id, false, 'id' ); ?></td>
					<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','editCoupon<?php echo $type ? "Static" : ""; ?>')" title="<?php echo _AEC_CMN_CLICK_TO_EDIT; ?>"><?php echo $rows[$i]->name; ?></a></td>
					<td align="center"><strong><?php echo $rows[$i]->coupon_code; ?></strong></td>
					<td align="left">
						<?php
						echo $rows[$i]->desc ? ( strlen( strip_tags( $rows[$i]->desc ) > 50 ) ? substr( strip_tags( $rows[$i]->desc ), 0, 50) . ' ...' : strip_tags( $rows[$i]->desc ) ) : ''; ?>
					</td>
					<td align="center">
						<a href="javascript:void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo ( ( $rows[$i]->active ? 'unpublishCoupon' : 'publishCoupon') . ( $type ? 'Static' : '' ) ); ?>')">
							<?php echo aecHTML::Icon( ( $rows[$i]->active ) ? 'accept.png' : 'cancel.png' ); ?>
						</a>
					</td>
					<td align="right"><?php echo $pageNav->orderUpIcon( $i, true, 'ordercoupon' . ( $type ? 'static' : '' ) . 'up' ); ?></td>
					<td align="right"><?php echo $pageNav->orderDownIcon( $i, $n, true, 'ordercoupon' . ( $type ? 'static' : '' ) . 'down' ); ?></td>
					<td align="center"><strong><?php echo $rows[$i]->usecount; ?></strong></td>
				</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
 		<?php
 		echo $pageNav->getListFooter();
		HTML_myCommon::ContentLegend(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="showCoupons<?php echo $type ? 'Static' : ''; ?>" />
		<input type="hidden" name="returnTask" value="showCoupons<?php echo $type ? 'Static' : ''; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $rows, $pageNav, $option, $type );
		}

 		HTML_myCommon::Valanx();
	}

	function editCoupon( $option, $aecHTML, $row, $type )
	{
		$user = &JFactory::getUser();

		loadOverlib();
		HTML_myCommon::addBackendCSS();

		if ( aecJoomla15check() ) {
			JHTML::_('behavior.calendar');
		} else {
			mosCommonHTML::loadCalendar();
		}

		?>
		<table class="adminheading">
			<tr>
				<th width="100%" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_coupons<?php echo $type ? '_static' : ''; ?>.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;">
				<?php echo _AEC_COUPON; ?>:&nbsp;<small><?php echo $row->id ? $row->name : _AEC_CMN_NEW; ?></small>
	        	</th>
			</tr>
		</table>
		<!--<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data" onLoad="swap();" >-->
		<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td valign="top">
						<?php
						$tabs = new JPaneTabs(0);
		                echo $tabs->startPane( 'editSubscriptionPlan' );
		                echo $tabs->startPanel( _COUPON_DETAIL_TITLE, _COUPON_DETAIL_TITLE ); ?>
		                <h2><?php echo _COUPON_DETAIL_TITLE; ?></h2>
						<table class="aecadminform">
							<tr>
								<td style="padding:10px;" valign="top">
									<div style="position:relative;float:left;width:48%;padding:4px;">
										<div class="userinfobox">
											<div style="position:relative;float:left;width:100%;">
												<?php echo $aecHTML->createSettingsParticle( 'name' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'coupon_code' ); ?>
												<div style="position:relative;float:left;">
													<?php echo $aecHTML->createSettingsParticle( 'active' ); ?>
													<?php echo $aecHTML->createSettingsParticle( 'type' ); ?>
												</div>
												<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'desc' ); ?>
												</div>
											</div>
										</div>
									</div>
									<div style="position:relative;float:left;width:48%;padding:4px;">
										<div class="userinfobox">
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'amount_use' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'amount' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'amount_percent_use' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'amount_percent' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'percent_first' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'useon_trial' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'useon_full' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'useon_full_all' ); ?>
											</div>
										</div>
									</div>
									<div style="position:relative;float:left;width:90%;padding:4px;">
										<div class="userinfobox">
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'has_start_date' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'start_date' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'has_expiration' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'expiration' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'has_max_reuse' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'max_reuse' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'usecount' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'has_max_peruser_reuse' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'max_peruser_reuse' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'usage_plans_enabled' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'usage_plans' ); ?>
											</div>
											<div style="position:relative;float:left;">
												<?php echo $aecHTML->createSettingsParticle( 'usage_cart_full' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'cart_multiple_items' ); ?>
												<?php echo $aecHTML->createSettingsParticle( 'cart_multiple_items_amount' ); ?>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _COUPON_RESTRICTIONS_TITLE, _COUPON_RESTRICTIONS_TITLE );
		                ?>
		                <h2><?php echo _COUPON_RESTRICTIONS_TITLE_FULL; ?></h2>
						<table class="aecadminform">
							<tr><td>
								<div class="userinfobox">
									<div style="position:relative;float:left;width:200px;">
										<?php echo $aecHTML->createSettingsParticle( 'depend_on_subscr_id' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'subscr_id_dependency' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'allow_trial_depend_subscr' ); ?>
									</div>
									<div style="position:relative;float:left;width:200px;">
										<?php echo $aecHTML->createSettingsParticle( 'restrict_combination' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'bad_combinations' ); ?>
									</div>
									<div style="position:relative;float:left;width:200px;">
										<?php echo $aecHTML->createSettingsParticle( 'allow_combination' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'good_combinations' ); ?>
									</div>
									<div style="position:relative;float:left;width:240px;">
										<?php echo $aecHTML->createSettingsParticle( 'restrict_combination_cart' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'bad_combinations_cart' ); ?>
									</div>
									<div style="position:relative;float:left;width:240px;">
										<?php echo $aecHTML->createSettingsParticle( 'allow_combination_cart' ); ?>
										<?php echo $aecHTML->createSettingsParticle( 'good_combinations_cart' ); ?>
									</div>
								</div>
							</td></tr>
							<?php echo aecRestrictionHelper::echoSettings( $aecHTML ); ?>
						</table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->startPanel( _COUPON_MI, _COUPON_MI );
		                ?>
		                <table width="100%" class="aecadminform"><tr><td>
							<div class="userinfobox">
								<h2><?php echo _COUPON_MI_FULL; ?></h2>
								<?php echo $aecHTML->createSettingsParticle( 'micro_integrations' ); ?>
							</div>
						</td></tr></table>
						<?php
		                echo $tabs->endPanel();
		                echo $tabs->endPane();
						?>
					</td>
				</tr>
			</table>
		<br />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<!--<script>swap();</script>-->

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML, $row, $type );
		}

 		HTML_myCommon::Valanx();
	}

	function viewinvoices( $option, $rows, $search, $pageNav )
	{
		$user = &JFactory::getUser();

		loadOverlib();
		HTML_myCommon::addBackendCSS();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_invoices.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;" rowspan="2" nowrap="nowrap">
			<?php echo _INVOICE_TITLE; ?>
			</th>
			<td nowrap="nowrap" style="padding: 0 5px;">
			<?php echo _INVOICE_SEARCH; ?>: <br />
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5%">#</th>
			<th align="left" width="10%"><?php echo _INVOICE_USERID; ?></th>
			<th align="center" width="10%"><?php echo _INVOICE_INVOICE_NUMBER; ?></th>
			<th align="center" width="10%"><?php echo _INVOICE_SECONDARY_IDENT; ?></th>
			<th align="center" width="30%"><?php echo _INVOICE_CREATED_DATE; ?></th>
			<th align="center" width="30%"><?php echo _INVOICE_TRANSACTION_DATE; ?></th>
			<th align="center" width="10%"><?php echo _USERPLAN; ?></th>
			<th align="center" width="10%"><?php echo _INVOICE_COUPONS; ?></th>
			<th align="center" width="10%"><?php echo _INVOICE_METHOD; ?></th>
			<th align="center" width="10%"><?php echo _INVOICE_AMOUNT; ?></th>
			<th width="10%"><?php echo _INVOICE_CURRENCY; ?></th>
		  </tr>
		<?php
		$k = 0;
		for( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $i + 1 + $pageNav->limitstart; ?></td>
				<td><a href="index2.php?option=com_acctexp&amp;task=edit&userid=<?php echo $rows[$i]->userid; ?>"><?php echo $rows[$i]->username; ?></a></td>
				<td align="center"><?php echo $rows[$i]->invoice_number; ?></td>
				<td align="center"><?php echo $rows[$i]->secondary_ident; ?></td>
				<td align="center"><?php echo $rows[$i]->created_date; ?></td>
				<td align="center"><?php echo $rows[$i]->transaction_date; ?></td>
	  			<td align="center"><?php echo $rows[$i]->usage; ?></td>
	  			<td align="center"><?php echo $rows[$i]->coupons; ?></td>
	  			<td align="center"><?php echo $rows[$i]->method; ?></td>
				<td align="center"><?php echo $rows[$i]->amount; ?></td>
				<td align="center"><?php echo $rows[$i]->currency; ?></td>
			</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="invoices" />
		<input type="hidden" name="returnTask" value="invoices" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $rows, $search, $pageNav );
		}

 		HTML_myCommon::Valanx();
	}

	function viewhistory( $option, $rows, $search, $pageNav )
	{
		$user = &JFactory::getUser();

		loadOverlib();
		HTML_myCommon::addBackendCSS();

		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_history.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;" rowspan="2" nowrap="nowrap">
			<?php echo _HISTORY_TITLE2; ?>
			</th>
			<td nowrap="nowrap" style="padding: 0 5px;">
			<?php echo _HISTORY_SEARCH; ?>: <br />
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th align="left" width="15%"><?php echo _HISTORY_USERID; ?></th>
			<th align="center" width="10%"><?php echo _HISTORY_INVOICE_NUMBER; ?></th>
			<th width="10%"><?php echo _HISTORY_PLAN_NAME; ?></th>
			<th align="center" width="15%"><?php echo _HISTORY_TRANSACTION_DATE; ?></th>
			<th align="center" width="10%"><?php echo _HISTORY_METHOD; ?></th>
			<th align="center" width="10%"><?php echo _HISTORY_AMOUNT; ?></th>
			<th width="30%"><?php echo _HISTORY_RESPONSE; ?></th>
		  </tr>
		<?php
		$k = 0;
		foreach ( $rows as $row ) { ?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $row->user_name; ?></td>
				<td align="center"><?php echo $row->invoice_number; ?></td>
				<td align="center"><?php echo $row->plan_name; ?></td>
	  			<td align="center"><?php echo $row->transaction_date; ?></td>
				<td align="center"><?php echo $row->proc_name; ?></td>
				<td align="center"><?php echo $row->amount; ?></td>
				<td align="left">
					<?php if ( !empty( $row->response ) ) { $field = unserialize( base64_decode( $row->response ) ); foreach ( $field as $n => $v) { echo $n." = ".$v."<br />"; } } ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="history" />
		<input type="hidden" name="returnTask" value="history" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $rows, $search, $pageNav );
		}

 		HTML_myCommon::Valanx();
	}

	function eventlog( $option, $events, $search, $pageNav )
	{
		loadOverlib();
		HTML_myCommon::addBackendCSS(); ?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_eventlog.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;" rowspan="2" nowrap="nowrap">
				<?php echo _AEC_HEAD_LOG; ?>
			</th>
			<td nowrap="nowrap" style="padding: 0 5px;">
			<?php echo _HISTORY_SEARCH; ?>: <br />
			<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th align="left" width="30"><?php echo _AEC_CMN_ID; ?></th>
			<th align="left" width="120"><?php echo _AEC_CMN_DATE; ?></th>
			<th align="left">&nbsp;</th>
			<th align="left">&nbsp;</th>
			<th align="left"><?php echo _AEC_CMN_EVENT; ?></th>
			<th align="left"><?php echo _AEC_CMN_TAGS; ?></th>
			<th align="left"><?php echo _AEC_CMN_ACTION; ?></th>
			<th align="left"><?php echo _AEC_CMN_PARAMETER; ?></th>
		  </tr>
		<?php
		$k = 0;
		foreach ( $events as $row ) { ?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $row->id; ?></td>
				<td align="left" width="120"><?php echo $row->datetime; ?></td>
				<td align="left"><?php echo $row->notify ? aecHTML::Icon( 'star.png', '' ) : '&nbsp;'; ?></td>
				<td class="notice_level_<?php echo $row->level; ?>"><?php echo constant( "_AEC_NOTICE_NUMBER_" . $row->level ); ?>
				<td align="left"><?php echo $row->short; ?></td>
	  			<td align="left"><?php echo $row->tags; ?></td>
				<td align="left" class="aec_bigcell"><?php echo htmlentities( stripslashes( $row->event ) ); ?></td>
				<td align="left"><?php echo ( $row->params ? $row->params : _AEC_CMN_NONE ); ?></td>
			</tr>
			<?php
			$k = 1 - $k;
		} ?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="eventlog" />
		<input type="hidden" name="returnTask" value="eventlog" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>

		<?php
		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $events, $search, $pageNav );
		}

 		HTML_myCommon::Valanx();
	}

	function readoutSetup( $option, $aecHTML )
	{
		loadOverlib();
		HTML_myCommon::addBackendCSS();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_export.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;" rowspan="2" nowrap="nowrap">
				<?php echo _AEC_READOUT; ?>
			</th>
			<td nowrap="nowrap" style="padding: 0 5px;">
			</td>
		</tr>
		</table>

		<div class="aec_readout">
			<table style="text-align:right;width:250px;">
				<tr>
					<td valign="top">
						<?php foreach ( $aecHTML->rows as $rowname => $rowcontent ) {
							echo $aecHTML->createSettingsParticle( $rowname );
						} ?>
					</td>
				</tr>
			</table>

			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="readout" />
			<input type="hidden" name="returnTask" value="readout" />
			<input type="hidden" name="display" value="1" />
			<br />
			<input type="submit" />
			<br />
		</div>

		</form>


		<?php
		echo $aecHTML->loadJS();

		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML );
		}

 		HTML_myCommon::Valanx();
	}

	function readout( $option, $readout )
	{
		loadOverlib();
		HTML_myCommon::addReadoutCSS();

		if ( isset( $_POST['column_headers'] ) ) {
			$ch = $_POST['column_headers'];
		} else {
			$ch = 20;
		}

		?>

		<table class="aec_bg"><tr><td>
			<?php foreach ( $readout as $part ) { ?>
				<?php
				if ( !empty( $part['head'] ) ) {
					if ( !empty( $part['sub'] ) ) {
						echo "<h2>" . $part['head'] . "</h2>";
					} else {
						echo "<h1>" . $part['head'] . "</h1>";
					}
				}

				if ( !empty( $part['type'] ) ) {
				switch ( $part['type'] ) {
					case 'table':
						echo "<table class=\"aec_readout\">";

						$i = 0; $j = 0;
						foreach ( $part['set'] as $entry ) {
							if ( $j%$ch == 0 ) {
								echo "<tr>";
								$k = 0;
								foreach ( $part['def'] as $def => $dc ) {
									if ( is_array( $dc[0] ) ) {
										$dn = $dc[0][0].'_'.$dc[0][1];
									} else {
										$dn = $dc[0];
									}

									echo "<th class=\"col".$k." ".$dn."\">" . $def . "</th>";
									$k = $k ? 0 : 1;
								}
								echo "</tr>";
							}

							echo "<tr class=\"row".$i."\">";

							foreach ( $part['def'] as $def => $dc ) {
								if ( is_array( $dc[0] ) ) {
									$dn = $dc[0][0].'_'.$dc[0][1];
								} else {
									$dn = $dc[0];
								}

								$tdclass = $dn;

								$dcc = $entry[$dn];

								if ( isset( $dc[1] ) ) {
									$types = explode( ' ', $dc[1] );

									foreach ( $types as $tt ) {
										switch ( $tt ) {
											case 'bool';
												$dcc = $dcc ? 'Yes' : 'No';
												$tdclass .= " bool".$dcc;
												break;
										}
									}
								} else {
									if ( is_array( $dcc ) ) {
										$dcc = implode( ', ', $dcc );
									}
								}

								echo "<td class=\"".$tdclass."\">" . $dcc . "</td>";
							}

							echo "</tr>";

							$i = $i ? 0 : 1;
							$j++;
						}

						echo "</table>";
						break;
				}
				} ?>
			<?php } ?>
		</td></tr></table>
		<?php

 		HTML_myCommon::Valanx();
	}

	function readoutCSV( $option, $readout )
	{
		// Send download header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");

		header("Content-Type: application/download");
		header('Content-Disposition: inline; filename="aec_readout.csv"');

		// Load Exporting Class
		$filename = JPATH_SITE . '/components/com_acctexp/lib/export/csv.php';
		$classname = 'AECexport_csv';

		include_once( $filename );

		$exphandler = new $classname();


		if ( isset( $_POST['column_headers'] ) ) {
			$ch = $_POST['column_headers'];
		} else {
			$ch = 20;
		}

		foreach ( $readout as $part ) {
			if ( !empty( $part['head'] ) ) {
				echo $exphandler->export_line( array( $part['head'] ) );
			}

			switch ( $part['type'] ) {
				case 'table':

					$i = 0; $j = 0;
					foreach ( $part['set'] as $entry ) {
						if ( $j%$ch == 0 ) {
							$array = array();
							foreach ( $part['def'] as $k => $v ) {
								$array[] = $k;
							}
							echo $exphandler->export_line( $array );
						}

						$array = array();
						foreach ( $part['def'] as $def => $dc ) {
							if ( is_array( $dc[0] ) ) {
								$dn = $dc[0][0].'_'.$dc[0][1];
							} else {
								$dn = $dc[0];
							}

							$dcc = $entry[$dn];

							if ( isset( $dc[1] ) ) {
								$types = explode( ' ', $dc[1] );

								foreach ( $types as $tt ) {
									switch ( $tt ) {
										case 'bool';
											$dcc = $dcc ? 'Yes' : 'No';
											break;
									}
								}
							}

							if ( is_array( $dcc ) ) {
								$dcc = implode( ', ', $dcc );
							}

							$array[] = $dcc;
						}

						echo $exphandler->export_line( $array );

						$j++;
					}

					echo "\n\n";
					break;
			}
		}
 		exit;
	}

	function export( $option, $aecHTML )
	{
		loadOverlib();
		HTML_myCommon::addBackendCSS();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%" class="sectionname" style="background: url(<?php echo JURI::root(); ?>media/com_acctexp/images/admin/icons/aec_symbol_export.png) no-repeat left; color: #586c79; height: 70px; padding-left: 70px;" rowspan="2" nowrap="nowrap">
				<?php echo _AEC_HEAD_EXPORT; ?>
			</th>
			<td nowrap="nowrap" style="padding: 0 5px;">
			</td>
		</tr>
		</table>

		<table class="aecadminform">
			<tr>
				<td valign="top">
					<?php foreach ( $aecHTML->rows as $rowname => $rowcontent ) {
						echo $aecHTML->createSettingsParticle( $rowname );
					} ?>
				</td>
			</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="returnTask" value="export" />
		</form>

		<?php
		echo $aecHTML->loadJS();

		if ( _EUCA_DEBUGMODE ) {
			krumo( $option, $aecHTML );
		}

 		HTML_myCommon::Valanx();
	}

	/**
	 * Formats a given date
	 *
	 * @param string	$SQLDate
	 * @return string	formatted date
	 */
	function DisplayDateInLocalTime( $SQLDate )
	{
		if ( $SQLDate == '' || $SQLDate == '-' || $SQLDate == '0000-00-00 00:00:00')  {
			return _AEC_CMN_NOT_SET;
		} else {
			$database = &JFactory::getDBO();

			global $aecConfig;

			return strftime( $aecConfig->cfg['display_date_backend'], strtotime( $SQLDate )  );
		}
	}
}
?>
