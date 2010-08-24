<?php
/**
 * @version $Id: eucalib.admin.proxy.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Admin Proxy to relay to subtask files
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

$task		= trim( aecGetParam( $_REQUEST, 'task', null ) );
$returntask = trim( aecGetParam( $_REQUEST, 'returntask', null ) );

resolveProxy( $task, $returntask, true );

?>
