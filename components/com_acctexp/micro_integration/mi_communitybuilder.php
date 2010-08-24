<?php
/**
 * @version $Id: mi_communitybuilder.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - CommunityBuilder (CB)
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_communitybuilder
{
	function Info ()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_COMMUNITYBUILDER;
		$info['desc'] = _AEC_MI_DESC_COMMUNITYBUILDER;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$settings = array();
		$settings['approve']		= array( 'list_yesno' );
		$settings['unapprove_exp']	= array( 'list_yesno' );
		$settings['set_fields']		= array( 'list_yesno' );
		$settings['set_fields_exp']	= array( 'list_yesno' );

		$query = 'SELECT `name`, `title`'
				. ' FROM #__comprofiler_fields'
				. ' WHERE `table` != \'#__users\''
				. ' AND `name` != \'NA\''
				;
		$database->setQuery( $query );
		$objects = $database->loadObjectList();

		foreach ( $objects as $object ) {
			if ( strpos( $object->title, '_' ) === 0 ) {
				$title = $object->name;
			} else {
				$title = $object->title;
			}

			$settings['cbfield_' . $object->name] = array( 'inputE', $title, $title );
			$expname = $title . " "  . _MI_MI_COMMUNITYBUILDER_EXPMARKER;
			$settings['cbfield_' . $object->name . '_exp' ] = array( 'inputE', $expname, $expname );
		}

		$rewriteswitches				= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']		= array( 'fieldset', _AEC_MI_SET11_EMAIL,
										AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		if( $this->settings['approve'] ) {
			$query = 'UPDATE #__comprofiler'
					.' SET `approved` = \'1\''
					.' WHERE `user_id` = \'' . (int) $request->metaUser->userid . '\''
					;
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}

		if ( $this->settings['set_fields'] ) {
			$query = 'SELECT `name`, `title`'
					. ' FROM #__comprofiler_fields'
					. ' WHERE `table` != \'#__users\''
					. ' AND `name` != \'NA\''
					;
			$database->setQuery( $query );
			$objects = $database->loadObjectList();

			foreach ( $objects as $object ) {
				if ( isset( $this->settings['cbfield_' . $object->name] ) ) {
					if ( $this->settings['cbfield_' . $object->name] !== '' ) {
						$changes[$object->name] = $this->settings['cbfield_' . $object->name];
					}
				}
			}

			if ( !empty( $changes ) ) {
				$alterstring = array();
				foreach ( $changes as $name => $value ) {
					$v = AECToolbox::rewriteEngineRQ( $value, $request );

					if ( ( $v === 0 ) || ( $v === "0" ) ) {
						$alterstring[] = "`" . $name . "`" . ' = \'0\'';
					} elseif ( ( $v === 1 ) || ( $v === "1" ) ) {
						$alterstring[] = "`" . $name . "`" . ' = \'1\'';
					} elseif ( strcmp( $v, 'NULL' ) === 0 ) {
						$alterstring[] = "`" . $name . "`" . ' = NULL';
					} elseif ( !empty( $v ) ) {
						$alterstring[] = "`" . $name . "`" . ' = \'' . $v . '\'';
					}
				}

				$query = 'UPDATE #__comprofiler'
						. ' SET ' . implode( ', ', $alterstring )
						. ' WHERE `user_id` = \'' . (int) $request->metaUser->userid . '\''
						;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			}
		}
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

		if( $this->settings['unapprove_exp'] ) {
			$query = 'UPDATE #__comprofiler'
					.' SET `approved` = \'0\''
					.' WHERE `user_id` = \'' . (int) $request->metaUser->userid . '\''
					;
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}

		if ( $this->settings['set_fields_exp'] ) {
			$query = 'SELECT `name`, `title`'
					. ' FROM #__comprofiler_fields'
					. ' WHERE `table` != \'#__users\''
					. ' AND `name` != \'NA\''
					;
			$database->setQuery( $query );
			$objects = $database->loadObjectList();

			foreach ( $objects as $object ) {
				if ( !empty( $this->settings['cbfield_' . $object->name . '_exp' ] ) ) {
					$changes[$object->name] = $this->settings['cbfield_' . $object->name . '_exp' ];
				}
			}

			if ( !empty( $changes ) ) {
				$alterstring = array();
				foreach ( $changes as $name => $value ) {
					if ( ( $value === 0 ) || ( $value === "0" ) ) {
						$alterstring[] = "`" . $name . "`" . ' = \'0\'';
					} elseif ( ( $value === 1 ) || ( $value === "1" ) ) {
						$alterstring[] = "`" . $name . "`" . ' = \'1\'';
					} elseif ( strcmp( $value, 'NULL' ) === 0 ) {
						$alterstring[] = "`" . $name . "`" . ' = NULL';
					} else {
						$alterstring[] = "`" . $name . "`" . ' = \'' . AECToolbox::rewriteEngineRQ( $value, $request ) . '\'';
					}
				}

				$query = 'UPDATE #__comprofiler'
						. ' SET ' . implode( ', ', $alterstring )
						. ' WHERE `user_id` = \'' . (int) $request->metaUser->userid . '\''
						;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			}
		}
	}

}
?>
