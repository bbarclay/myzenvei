<?php
/**
 * @version $Id: mi_email_files.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Email Files
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_email_files
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_EMAIL_FILES;
		$info['desc'] = _AEC_MI_DESC_EMAIL_FILES;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['sender']				= array( 'inputE' );
		$settings['sender_name']		= array( 'inputE' );

		$settings['recipient']			= array( 'inputE' );

		$settings['subject']			= array( 'inputE' );
		$settings['text_html']			= array( 'list_yesno' );
		$settings['text']				= array( !empty( $this->settings['text_html'] ) ? 'editor' : 'inputD' );

		$settings['base_path']			= array( 'inputE' );
		$settings['file_list']			= array( 'inputD' );
		$settings['desc_list']			= array( 'inputD' );
		$settings['max_choices']		= array( 'inputA' );
		$settings['min_choices']		= array( 'inputA' );

		$rewriteswitches				= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']		= array( 'fieldset', _AEC_MI_SET11_EMAIL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function getMIform( $request )
	{
		$settings = array();

		if ( !empty( $this->settings['desc_list'] ) ) {
			$settings['exp'] = array( 'p', _MI_MI_USER_CHOICE_FILES_NAME, _MI_MI_USER_CHOICE_FILES_DESC );

			$list = explode( "\n", $this->settings['desc_list'] );

			$gr = array();
			foreach ( $list as $id => $choice ) {
				$choice = trim( $choice );

				if ( $this->settings['max_choices'] > 1 ) {
					$settings['ef'.$id] = array( 'checkbox', 'mi_'.$this->id.'_mi_email_files[]', $id, true, $choice );
				} else {
					$settings['ef'.$id] = array( 'radio', 'mi_'.$this->id.'_mi_email_files', $id, true, $choice );
				}
			}
			$settings['mi_email_files'] = array( 'hidden', null, 'mi_'.$this->id.'_mi_email_files[]' );
		} else {
			return false;
		}

		return $settings;
	}

	function verifyMIform( $request )
	{
		$return = array();

		if ( !empty( $request->params['mi_email_files'] ) ) {
			foreach ( $request->params['mi_email_files'] as $i => $v ) {
				if ( is_null( $v ) || ( $v == "" ) ) {
					unset( $request->params['mi_email_files'][$i] );
				}
			}
		}

		if ( empty( $request->params['mi_email_files'] ) ) {
			if ( $this->settings['min_choices'] == $this->settings['max_choices'] ) {
				$return['error'] = "Please select " . $this->settings['min_choices'] . " options!";
			} else {
				$return['error'] = "Please select at least " . $this->settings['min_choices'] . " options!";
			}
			return $return;
		}

		$selected = count( $request->params['mi_email_files'] );

		if ( $selected > $this->settings['max_choices'] ) {
			if ( $this->settings['min_choices'] == $this->settings['max_choices'] ) {
				$return['error'] = "Too many options selected - Please select exactly " . $this->settings['max_choices'] . " options!";
			} else {
				$return['error'] = "Too many options selected! Please select no more than " . $this->settings['max_choices'] . " options!";
			}
		}

		if ( $selected < $this->settings['min_choices'] ) {
			if ( $this->settings['min_choices'] == $this->settings['max_choices'] ) {
				$return['error'] = "Not enough options selected - Please select exactly " . $this->settings['min_choices'] . " options!";
			} else {
				$return['error'] = "Please select more than " . $this->settings['min_choices'] . " options!";
			}
		}

		return $return;
	}

	function action( $request )
	{
		$message	= AECToolbox::rewriteEngineRQ( $this->settings['text'], $request );
		$subject	= AECToolbox::rewriteEngineRQ( $this->settings['subject'], $request );

		if ( empty( $message ) ) {
			return null;
		}

		$recipients = AECToolbox::rewriteEngineRQ( $this->settings['recipient'], $request );
		$recips = explode( ',', $recipients );

        $recipients2 = array();
        foreach ( $recips as $k => $email ) {
            $recipients2[$k] = trim( $email );
        }

        $recipients = $recipients2;

		$f = explode( "\n", $this->settings['file_list'] );

		if ( !empty( $this->settings['desc_list'] ) ) {
			$userchoice = $request->params['mi_email_files'];

			if ( !empty( $this->settings['max_choices'] ) ) {
				if ( count( $userchoice ) > $this->settings['max_choices'] ) {
					$userchoice = array_slice( $userchoice, 0, $this->settings['max_choices']);
				}
			}
		} else {
			$userchoice = false;
		}

		if ( !empty( $this->settings['base_path'] ) ) {
			$b = $this->settings['base_path'] . '/';
		} else {
			$b = '';
		}

		$attach = array();
		foreach ( $f as $fid => $fname ) {
			if ( empty( $fname ) ) {
				continue;
			}

			if ( $userchoice != false ) {
				if ( !in_array( $fid, $userchoice ) ) {
					continue;
				}
			}

			$ff = $b . trim( $fname );

			if ( file_exists( $ff ) ) {
				$attach[] = $ff;
			}
		}

		if ( aecJoomla15check() ) {
			JUTility::sendMail( $this->settings['sender'], $this->settings['sender_name'], $recipients, $subject, $message, $this->settings['text_html'], null, null, $attach );
		} else {
			mosMail( $this->settings['sender'], $this->settings['sender_name'], $recipients, $subject, $message, $this->settings['text_html'], null, null, $attach );
		}

		return true;
	}
}
?>
