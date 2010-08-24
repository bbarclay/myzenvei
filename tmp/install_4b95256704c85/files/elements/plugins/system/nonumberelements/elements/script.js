/**
 * JavaScript file for Elements: Main stuff
 *
 * @package     NoNumber! Elements
 * @version     1.2.11
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

function NoNumberElementsHideTD( id )
{
	var div = document.getElementById(id);
	div.parentNode.style.padding=0;
	div.parentNode.style.height=0;
	div.parentNode.style.border=0;

	div.parentNode.parentNode.style.display='none';
}