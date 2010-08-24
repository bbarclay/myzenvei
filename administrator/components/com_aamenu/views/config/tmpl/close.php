<?php
/**
 * @version		$Id: close.php 67 2009-05-29 13:02:32Z eddieajau $
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 * @copyright	(C) 2008 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License
 * @author		Andrew Eddie <andrew.eddie@newlifeinit.com>
 */

defined('_JEXEC') or die;

JHTML::_('behavior.mootools');
?>

<script type="text/javascript">
	window.addEvent('domready', function() {
		// Attach to the close event of the squeezebox to cancel the AJAX request.
		if (typeof window.parent.SqueezeBox == 'object') {
			window.parent.SqueezeBox.addEvent('onClose', function() {
				window.parent.location.reload(true);
			});
		}
	});
	window.addEvent('domready', function() {
		window.parent.document.getElementById('sbox-window').close();
	});
</script>