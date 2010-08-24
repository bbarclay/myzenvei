<?php
// Dont allow direct linking
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

function com_install() {
	//add new admin menu images
	$jdatabase = jfactory::getDBO();
	$jdatabase->setQuery( "UPDATE `#__components` SET admin_menu_img = '../administrator/components/com_virtuemartremoteinstaller/getter.png' WHERE admin_menu_link = 'option=com_virtuemartremoteinstaller'");
	$jdatabase->query();
}
?>
