/**
 * Javascript file for template: APLite
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
	abd_top.include( $E( 'div#module-status' ) );
	abd_top.include( $E( 'div#ap-header' ) );
	abd_top.include( $E( 'div#ap-submenu' ) );
	abd_top.include( $E( 'div#ap-title' ) );

	/* Add only the elements for the 'dock to bottom' option (in desired order) to abd_bottom */
	abd_bottom.include( $E( 'div#ap-title' ) );
	abd_bottom.include( $E( 'div#ap-header' ) );
	abd_bottom.include( $E( 'div#ap-submenu' ) );
});