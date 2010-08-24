<?php
/**
 * @version $Id: create_rootgroup.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Check for a root group
$database->setQuery("SELECT id FROM  #__acctexp_itemgroups WHERE id='1'");

// Create root group completely out of thin air (tadaa!)
if ( $database->loadResult() != 1 ) {
	$rootgroup = new ItemGroup( $database );

	$rootgroup->id = 0;
	$rootgroup->active = 1;
	$rootgroup->visible = 1;
	$rootgroup->name = _AEC_INST_ROOT_GROUP_NAME;
	$rootgroup->desc = _AEC_INST_ROOT_GROUP_DESC;
	$rootgroup->params = array( 'color' => 'bbddff', 'icon' => 'flag_blue', 'reveal_child_items' => 1 );

	$rootgroup->storeload();

	if ( $rootgroup->id != 1 ) {
		$database->setQuery("UPDATE #__acctexp_itemgroups SET id='1' WHERE id='" . $rootgroup->id . "'");
		$database->query();
	}

	// Adding in root group relation for all plans
	$planlist = SubscriptionPlanHandler::listPlans();

	$database->setQuery("SELECT count(*) FROM  #__acctexp_itemxgroup");

	if ( count( $planlist ) > $database->loadResult() ) {
		ItemGroupHandler::setChildren( 1, $planlist );
	}
}

?>