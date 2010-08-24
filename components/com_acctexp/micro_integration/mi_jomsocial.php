<?php
/**
 * @version $Id: mi_jomsocial.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - JomSocial
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_jomsocial
{
	function Info ()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_JOMSOCIAL;
		$info['desc'] = _AEC_MI_DESC_JOMSOCIAL;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$settings = array();
		$settings['overwrite_existing']	= array( 'list_yesno' );
		$settings['set_fields']			= array( 'list_yesno' );
		$settings['set_fields_exp']		= array( 'list_yesno' );

		$query = 'SELECT `id`, `name`'
				. ' FROM #__community_fields'
				. ' WHERE `type` != \'group\''
				;
		$database->setQuery( $query );
		$objects = $database->loadObjectList();

		foreach ( $objects as $object ) {
			$settings['jsfield_' . $object->id] = array( 'inputE', $object->name, $object->name );
			$expname = $object->name . " " . _MI_MI_JOMSOCIAL_EXPMARKER;
			$settings['jsfield_' . $object->id . '_exp' ] = array( 'inputE', $expname, $expname );
		}

		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']	= array( 'fieldset', _AEC_MI_SET11_EMAIL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function relayAction( $request )
	{
		if ( ( $request->action == 'action' ) || ( $request->action == 'expiration_action' ) ) {
			$database = &JFactory::getDBO();

			if ( $this->settings['set_fields'.$request->area] ) {
				$query = 'SELECT `id`, `name`'
						. ' FROM #__community_fields'
						. ' WHERE `type` != \'group\''
						;
				$database->setQuery( $query );
				$objects = $database->loadObjectList();

				foreach ( $objects as $object ) {
					if ( isset( $this->settings['jsfield_' . $object->id.$request->area] ) ) {
						if ( $this->settings['jsfield_' . $object->id.$request->area] !== '' ) {
							$changes[$object->id] = AECToolbox::rewriteEngineRQ( $this->settings['jsfield_' . $object->id.$request->area], $request );
						}
					}
				}

				if ( !empty( $changes ) ) {
					$this->setFields( $changes, $request->metaUser->userid );
				}
			}
		}
	}

	function setFields( $fields, $userid )
	{
		$database = &JFactory::getDBO();

		$ids = array();
		foreach ( $fields as $fi => $ff ) {
			$ids[] = $fi;
		}

		$query = 'SELECT `field_id`, `value`'
				. ' FROM #__community_fields_values'
					. ' WHERE `field_id` IN (' . implode( ',', $ids ) . ')'
					. ' AND `user_id` = \'' . (int) $userid . '\'';
				;
		$database->setQuery( $query );
		$existingfields = $database->loadObjectList();

		foreach( $fields as $id => $value ) {
			$existingfield = false;
			if ( !empty( $existingfields ) ) {
				foreach ( $existingfields as $ff ) {
					if ( $ff->field_id == $id ) {
						$existingfield = true;

						continue;
					}
				}
			}

			$query = null;
			if ( $existingfield && $this->settings['overwrite_existing'] ) {
				$query	= 'UPDATE #__community_fields_values SET '
						. ' `value` = \'' . $value . '\''
						. ' WHERE `user_id` = \'' . (int) $userid . '\''
						. ' AND `field_id` = \'' . (int) $id . '\''
						;
			} elseif ( !$existingfield ) {
				$query	= 'INSERT INTO #__community_fields_values'
						. ' (`user_id`, `field_id`, `value` )'
						. ' VALUES ( \'' . (int) $userid . '\', \'' . (int) $id . '\', \'' . $database->getEscaped( $value ) . '\' )'
						;
			}

			if ( !empty( $query ) ) {
				$database->setQuery( $query );
				$database->query();
			}
		}

	}
}
?>
