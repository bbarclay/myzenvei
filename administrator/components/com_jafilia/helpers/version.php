<?php 
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

if( class_exists( 'jafVersion' ) ) {
	$JAFVERSION =& new jafVersion();
	
	$shortversion = $JAFVERSION->PRODUCT . " " . $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " ";
		
	$myVersion = $shortversion . " [".$JAFVERSION->CODENAME ."] <br />" . $JAFVERSION->RELDATE . " "
	. $JAFVERSION->RELTIME . " " . $JAFVERSION->RELTZ;
	return;
}
if( !class_exists( 'jafVersion' ) ) {
/** Version information */
class jafVersion {
	/** @var string Product */
	var $PRODUCT = 'Jafilia';
	/** @var int Release Number */
	var $RELEASE = '1.5.0';
	/** @var string Development Status */
	var $DEV_STATUS = 'RC';
	/** @var string Codename */
	// Song by Enya
	var $CODENAME = 'SUNSHINE';
	/** @var string Date */
	var $RELDATE = '29/09/2009';
	/** @var string Time */
	var $RELTIME = '17:00';
	/** @var string Timezone */
	var $RELTZ = 'GMT';
	/** @var string Revision */
	var $REVISION = '2 (build: 20)';
	/** @var string Copyright Text */
	var $COPYRIGHT = 'Copyright &copy; 2008-2009 Jafilia Development Team - All rights reserved.'; 
	/** @var string URL */
	var $URL = '<a href="http://www.jafilia.com">Jafilia</a> is a Free Component for Joomla! released under the GNU/GPL License.';
}
$JAFVERSION =& new jafVersion();

$shortversion = $JAFVERSION->PRODUCT . " " . $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " " . $JAFVERSION->REVISION;
	
$myVersion = $shortversion . " [".$JAFVERSION->CODENAME ."] <br />" . $JAFVERSION->RELDATE . " "
	. $JAFVERSION->RELTIME . " " . $JAFVERSION->RELTZ;
	
}

?>