/**
 * Javascript file for template: AdminPraise (1)
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
	abd_top.include( $E( 'div#tools' ) );
	abd_top.include( $E( 'div#topmenu' ) );
	abd_top.include( $E( 'div.header' ) );
	abd_top.include( $E( 'ul#submenu' ) );
	abd_top.include( $E( 'div#toolbar' ) );

	/* Add only the elements for the 'dock to bottom' option (in desired order) to abd_bottom */
	abd_bottom.include( $E( 'div.header' ) );
	abd_bottom.include( $E( 'ul#submenu' ) );
	abd_bottom.include( $E( 'div#toolbar' ) );
});