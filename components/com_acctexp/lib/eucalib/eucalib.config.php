<?php
/**
 * @version $Id: eucalib.common.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Eucalib Common Files
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

include_once( JPATH_SITE . '/components/com_acctexp/lib/eucalib/eucalib.php' );

define( '_EUCA_CFG_LOADED', 1 );
define( '_EUCA_APP_SHORTNAME', 'acctexp' );
define( '_EUCA_APP_COMPNAME', 'com_' . _EUCA_APP_SHORTNAME );
define( '_EUCA_APP_PEAR', JPATH_SITE . '/includes/PEAR/PEAR.php' );
define( '_EUCA_BASEDIR', JPATH_SITE . '/components/' . _EUCA_APP_COMPNAME . '/lib/eucalib' );
define( '_EUCA_APP_COMPDIR', JPATH_SITE . '/components/' . _EUCA_APP_COMPNAME );
define( '_EUCA_APP_LIBDIR', _EUCA_APP_COMPDIR . '/lib' );
define( '_EUCA_APP_ICONSDIR', _EUCA_APP_COMPDIR . '/images/icons' );
define( '_EUCA_APP_ADMINDIR', JPATH_SITE . '/administrator/components/' . _EUCA_APP_COMPNAME );
define( '_EUCA_APP_ADMINICONSDIR', _EUCA_APP_ADMINDIR . '/images/icons' );
define( '_EUCA_APP_ADMINACTIONURL', JURI::root() . 'administrator/index2.php?option=' . _EUCA_APP_COMPNAME );


?>
