/**
 * Javascript file for template: Khepri
 *
 * @package     AdminBar Docker
 * @version     1.1.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

window.addEvent( 'domready', function() {
	/* Add ALL toolbars (in desired order) to abd_top */
	abd_top.include( $E( 'div#header-box' ) );
	abd_top.include( $E( 'div#toolbar-box' ) );
	abd_top.include( $E( 'div#submenu-box' ) );

	/* Add only the elements for the 'dock to bottom' option (in desired order) to abd_bottom */
	abd_bottom.include( $E( 'div#toolbar-box' ) );
	abd_bottom.include( $E( 'div#submenu-box' ) );
});