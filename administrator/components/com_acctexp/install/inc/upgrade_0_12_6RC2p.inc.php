<?php
/**
 * @version $Id: upgrade_0_12_6_RC2p.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

$database->setQuery("ALTER TABLE #__acctexp_invoices CHANGE `coupons` `coupons` text NULL");
if ( !$database->query() ) {
	$errors[] = array( $database->getErrorMsg(), $query );
}

?>