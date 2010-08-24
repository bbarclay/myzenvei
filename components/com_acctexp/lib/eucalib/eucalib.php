<?php
/**
 * @version $Id: eucalib.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Abstract Library for Joomla Components
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 *
 *                         _ _ _
 *                        | (_) |
 *     ___ _   _  ___ __ _| |_| |__
 *    / _ \ | | |/ __/ _` | | | '_ \
 *   |  __/ |_| | (_| (_| | | | |_) |
 *    \___|\__,_|\___\__,_|_|_|_.__/  v1.0
 *
 * The Extremely Useful Component LIBrary will rock your socks. Seriously. Reuse it!
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Restricted access' );

if ( !defined( '_EUCA_CFG_LOADED' ) ){
	$require_file = dirname( __FILE__ ).'/eucalib.config.php';

	if( file_exists( $require_file ) ) {
		require_once( $require_file );
	}

	$require_file = dirname( __FILE__ ).'/eucalib.common.php';

	if( !class_exists( 'paramDBTable') ) {
		require_once( $require_file );
	}
}

?>
