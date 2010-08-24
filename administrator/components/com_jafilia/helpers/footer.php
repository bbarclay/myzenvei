<?php
defined( '_JEXEC' ) or die( '=;)' );
//error_reporting(E_ALL);
include( JPATH_COMPONENT.DS."helpers".DS."version.php" );
$JAFVERSION =& new jafVersion();
//$shortversion = $JAFVERSION->PRODUCT . " " . $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " (" . $JAFVERSION->REVISION. ")";
$shortversion = $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " " . $JAFVERSION->REVISION;
?>
<br style="clear:both;" />	
<div id="footer">
	<p class="copyright">
		Jafilia <?php echo $shortversion; ?> is Free Software released under the <a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GNU/GPL License</a>.<br>
		Copyright &copy; 2008-2009 by <a href="http://www.jafilia.com" target="_blank">Jafilia.com</a>				
	</p>
</div>

