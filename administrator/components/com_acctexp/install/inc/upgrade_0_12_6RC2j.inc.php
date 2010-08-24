<?php
/**
 * @version $Id: upgrade_0_12_6_RC2j.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

if ( $jsonconversion ) {
	// undo jsonized fields (well, that much for great ideas)

	$updates = array(	0 => array( 'displayPipeline', 'displaypipeline' ),
						1 => array( 'eventLog', 'eventlog' ),
						2 => array( 'processor', 'config_processors' ),
						3 => array( 'SubscriptionPlan', 'plans' ),
						4 => array( 'Invoice', 'invoices' ),
						5 => array( 'Subscription', 'subscr' ),
						6 => array( 'microIntegration', 'microintegrations' ),
						7 => array( 'coupon', 'coupons' ),
						8 => array( 'coupon', 'coupons_static' ),
						9 => array( 'metaUserDB', 'metauser' )
						);

	foreach ( $updates as $uid => $ucontent ) {
		$classname	= $ucontent[0];
		$dbtable	= $ucontent[1];

		$fielddeclare = call_user_func( array( $classname, 'declareParamFields' ) );

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_' . $dbtable
				;
		$database->setQuery( $query );
		$entries = $database->loadResultArray();

		if ( empty( $entries ) ) {
			continue;
		}

		foreach ( $entries as $id ) {
			$object = null;
			$query = 'SELECT `' . implode( '`, `', $fielddeclare ) . '` FROM #__acctexp_' . $dbtable
			. ' WHERE `id` = \'' . $id . '\''
			;
			$database->setQuery( $query );
			if ( aecJoomla15check() ) {
				$object = $database->loadObject();
			} else {
				$database->loadObject($object);
			}

			$dec = $fielddeclare;
			foreach ( $fielddeclare as $fieldname ) {
				// No need to update what is empty
				if ( empty( $object->$fieldname ) ) {
					unset( $dec[array_search( $fieldname, $dec )] );
				}
			}

			if ( count( $dec ) < 1 ) {
				continue;
			}

			$sets = array();
			foreach ( $dec as $fieldname ) {
				// Decode from jsonized fields
				if ( ( strpos( $object->$fieldname, "{" ) === 0 ) || strpos( $object->$fieldname, "\n" ) === false ) {
					$decode = stripslashes( str_replace( array( '\n', '\t', '\r' ), array( "\n", "\t", "\r" ), trim($object->$fieldname) ) );
					$temp = jsoonHandler::decode( $decode );
				} elseif ( strpos( $object->$fieldname, "\n" ) !== false ) {
					// Has stripslashes stuff built in
					$temp = parameterHandler::decode( $object->$fieldname );
				} else {
					continue;
				}

				// ... to serialized
				if ( is_array( $temp ) || is_object( $temp ) ) {
					$sets[] = '`' . $fieldname . '` = \'' . base64_encode( serialize( $temp ) ) . '\'';
				}
			}

			if ( !empty( $sets ) ) {
				$query = 'UPDATE #__acctexp_' . $dbtable
				. ' SET ' . implode( ', ', $sets ) . ''
				. ' WHERE `id` = \'' . $id . '\''
				;
				$database->setQuery( $query );
				if ( !$database->query() ) {
			    	$errors[] = array( $database->getErrorMsg(), $query );
				}
			}
		}
	}

} elseif ( $serialupdate ) {
	// Update database fields to serialized fields

	$updates = array(	0 => array( 'displayPipeline', 'displaypipeline', array( 'params' => array('displayedto') ) ),
						1 => array( 'eventLog', 'eventlog', array( 'info' => array('actions') ) ),
						2 => array( 'processor', 'config_processors', array() ),
						3 => array( 'SubscriptionPlan', 'plans', array( 'params' => array('similarplans','equalplans','processors'), 'micro_integrations' => array('_self'), 'restrictions' => array('previousplan_req','currentplan_req','overallplan_req','previousplan_req_excluded','currentplan_req_excluded','overallplan_req_excluded') ) ),
						4 => array( 'Invoice', 'invoices', array( 'coupons' => array('_self'), 'micro_integrations' => array('_self') ) ),
						5 => array( 'Subscription', 'subscr', array() ),
						6 => array( 'microIntegration', 'microintegrations', array() ),
						7 => array( 'coupon', 'coupons', array( 'restrictions' => array('bad_combinations','usage_plans') ) ),
						8 => array( 'coupon', 'coupons_static', array( 'restrictions' => array('bad_combinations','usage_plans') ) )
						);

	$miupdate = array(	'mi_acl' => array( 'sub_gid_del', 'sub_gid', 'sub_gid_exp_del', 'sub_gid_exp', 'sub_gid_pre_exp_del', 'sub_gid_pre_exp' ),
						'mi_docman' => array( 'group', 'group_exp' ),
						'mi_g2' => array( 'groups', 'groups_sel_scope' ),
						'mi_juga' => array( 'enroll_group', 'enroll_group_exp' ),
						'mi_remository' => array( 'group', 'group_exp' )
						);

	foreach ( $updates as $uid => $ucontent ) {
		$classname	= $ucontent[0];
		$dbtable	= $ucontent[1];

		$fielddeclare = call_user_func( array( $classname, 'declareParamFields' ) );

		$unsetdec = array();
		if ( $dbtable == 'subscr' ) {
			$query = 'SHOW COLUMNS'
					. ' FROM #__acctexp_subscr'
					;
			$database->setQuery( $query );
			$entries = $database->loadResultArray();

			$unsetdec[] = 'userid';
			$unsetdec[] = 'plan';
			if ( in_array( 'used_plans', $entries ) ) {
				$unsetdec[] = 'used_plans';
				$unsetdec[] = 'previous_plan';
			}
		} elseif ( $dbtable == 'microintegrations' ) {
			$unsetdec[] = 'class_name';
		}

		$fielddeclare = array_merge( $fielddeclare, $unsetdec );

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_' . $dbtable
				;
		$database->setQuery( $query );
		$entries = $database->loadResultArray();

		if ( empty( $entries ) ) {
			continue;
		}

		foreach ( $entries as $id ) {
			$object = null;
			$query = 'SELECT `' . implode( '`, `', $fielddeclare ) . '` FROM #__acctexp_' . $dbtable
			. ' WHERE `id` = \'' . $id . '\''
			;
			$database->setQuery( $query );
			if ( aecJoomla15check() ) {
				$object = $database->loadObject();
			} else {
				$database->loadObject($object);
			}

			$dec = $fielddeclare;
			foreach ( $fielddeclare as $fieldname ) {
				if ( in_array( $fieldname, $unsetdec ) ) {
					unset( $dec[array_search( $fieldname, $dec )] );
					continue;
				}

				// No need to update what is empty
				if ( empty( $object->$fieldname ) || ( strpos( $object->$fieldname, '{' ) === 0 ) || ( strpos( $object->$fieldname, '[' ) === 0 ) ) {
					unset( $dec[array_search( $fieldname, $dec )] );
				}
			}

			if ( ( $dbtable == 'subscr' ) && empty( $object->params ) ) {
				$dec[] = 'params';
			}

			if ( count( $dec ) < 1 ) {
				continue;
			}

			$sets = array();
			foreach ( $dec as $fieldname ) {
				// Decode from newline separated variables
				$temp = parameterHandler::decode( stripslashes( $object->$fieldname ) );

				if ( !empty( $ucontent[2] ) ) {
					if ( isset( $ucontent[2][$fieldname] ) ) {
						if ( in_array( '_self', $ucontent[2][$fieldname] ) ) {
							$temp = explode( ';', $object->$fieldname );
							array_walk( $temp, 'trim' );
						} else {
							foreach ( $temp as $key => $value ) {
								if ( in_array( $key, $ucontent[2][$fieldname] ) ) {
									$temp[$key] = explode( ';', $value );
									array_walk( $temp[$key], 'trim' );
								}
							}
						}
					}
				}

				// Make sure to capture exceptions
				if ( ( $dbtable == 'subscr' ) && ( $fieldname == 'params' ) ) {
					if ( isset( $object->userid ) ) {
						$metaUserDB = new metaUserDB( $database );
						$metaUserDB->loadUserid( $object->userid );

						if ( !empty( $temp ) ) {
							$vs		= new stdClass();
							$vsmi	= new stdClass();

							foreach ( $temp as $key => $value ) {
								if ( strpos( $key, 'MI_FLAG' ) !== false ) {
									$ks = explode( '_', $key );

									$vname = array();

									foreach ( $ks as $n => $k ) {
										if ( in_array( $n, array( 0,1,2,4 ) ) ) {
											// And nothing of value was lost
										} elseif( $n == 3 ) {
											// Set usage
											$usage = $k;
										} elseif( $n == 5 ) {
											// Set MI
											$mi = $k;
										} elseif( $n > 5 ) {
											// Set MI Variable name
											$vname[] = $k;
										}
									}

									// Well, the cool stuff doesnt happen without some lameness
									if ( !isset( $vs->$usage ) ) {
										$vs->$usage = new stdClass();
									}

									if ( !isset( $vs->$usage->$mi ) ) {
										$vs->$usage->$mi = array();
									}

									if ( !isset( $vsmi->$mi ) ) {
										$vsmi->$mi = array();
									}

									$vnam = implode( '_', $vname );
									$var = array( $vnam => $value );

									$vs->$usage->$mi = array_merge( $vs->$usage->$mi, $var );
									$vsmi->$mi = array_merge( $vsmi->$mi, $var );
									unset( $temp[$key] );
								}
							}

							if ( !empty( $vs ) || !empty( $vsmi ) ) {
								$metaUserDB->addPreparedMIParams( $vs, $vsmi );
							}
						}

						$plans = array();

						if ( !empty( $object->used_plans ) ) {
							$used_plans = explode( ";", $object->used_plans );

							foreach ( $used_plans as $plan ) {
								$p = explode( ',', $plan );

								if ( empty( $p[0] ) ) {
									continue;
								}

								if ( $p[0] == $object->plan ) {
									$end = $p;
								} elseif ( $p[0] == $object->previous_plan ) {
									$bend = $p;
								} else {
									if ( !empty( $p[1] ) ) {
										$plans[$p[0]] = $p[1];
									} else {
										$plans[$p[0]] = 1;
										if ( !empty( $vs ) || !empty( $vsmi ) ) {
											$metaUserDB->addPreparedMIParams( $vs, $vsmi );
										}
									}
								}
							}
						}

						// Preserve previous plan with this
						if ( isset( $bend ) ) {
							if ( !empty( $bend[1] ) ) {
								$plans[$bend[0]] = $bend[1];
							} else {
								$plans[$bend[0]] = 1;
							}

							unset($bend);
						} elseif( !empty( $object->previous_plan ) ) {
							$plans[$object->previous_plan] = 1;
						}

						// Preserve current plan with this
						if ( isset( $end ) ) {
							if ( !empty( $end[1] ) ) {
								$plans[$end[0]] = $end[1];
							} else {
								$plans[$end[0]] = 1;
							}

							unset($end);
						} elseif( !empty( $object->plan ) ) {
							$plans[$object->plan] = 1;
						}

						$history = array();
						foreach ( $plans as $pid => $poc ) {
							for( $i=0; $i<$poc; $i++ ) {
								$history[] = $pid;
							}
						}

						$up = new stdClass();
						$up->plan_history	= $history;
						$up->used_plans		= $plans;

						$metaUserDB->addParams( $up, 'plan_history' );
						$metaUserDB->storeload();
					}
				} elseif ( ( $dbtable == 'plans' ) && ( $fieldname == 'custom_params' ) ) {
					$newtemp = array();
					foreach ( $temp as $locator => $content ) {
						$p = explode( '_', $locator, 2 );

						if ( isset( $p[1] ) ) {
							$newtemp[$p[0]][$p[1]] = $content;
						} else {
							$newtemp[$locator] = $content;
						}
					}

					$temp = $newtemp;
				} elseif ( ( $dbtable == 'microintegrations' ) && ( $fieldname == 'params' ) ) {
					if ( isset( $miupdate[$object->class_name] ) ) {
						$newtemp = array();
						foreach ( $temp as $locator => $content ) {
							if ( in_array( $locator, $miupdate[$object->class_name] ) ) {
								$newtemp[$locator] = explode( ';', $content );
								array_walk( $newtemp[$locator], 'trim' );
							}
						}

						$temp = $newtemp;
					}
				} elseif ( ( $dbtable == 'invoices' ) && ( $fieldname == 'transactions' ) ) {
					$newtemp = array();
					foreach ( $temp as $locator => $content ) {
						$p = explode( ';', $locator );

						$c = new stdClass();

						$c->timestamp	= $p[0];
						$c->amount		= $p[1];
						$c->currency	= $p[2];
						$c->processor	= $p[3];

						$newtemp[] = $c;
					}

					$temp = $newtemp;
				}

				// ... to serialized
				$sets[] = '`' . $fieldname . '` = \'' . base64_encode( serialize( $temp ) ) . '\'';
			}

			unset( $object );

			if ( !empty( $sets ) ) {
				$query = 'UPDATE #__acctexp_' . $dbtable
				. ' SET ' . implode( ', ', $sets ) . ''
				. ' WHERE `id` = \'' . $id . '\''
				;
				$database->setQuery( $query );
				if ( !$database->query() ) {
			    	$errors[] = array( $database->getErrorMsg(), $query );
				}
			}
		}
	}
}

$eucaInstalldb->dropColifExists( 'used_plans', 'subscr' );
$eucaInstalldb->dropColifExists( 'previous_plan', 'subscr' );
?>