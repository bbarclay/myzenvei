<?php
/*
	JoomlaXTC VTube module

	version 1.4
	
	Copyright (C) 2009,2010  Monev Software LLC.	All Rights Reserved.
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	THIS LICENSE MIGHT NOT APPLY TO OTHER FILES CONTAINED IN THE SAME PACKAGE.
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

define( '_JEXEC', 1 );
define('JPATH_BASE', realpath(dirname(__FILE__).'/../..') );
define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'parameter.php' );
require_once ( JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
jimport( 'joomla.environment.uri' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();

$CONFIG = new JConfig();
$dbhost = $CONFIG->host;
$dbuser = $CONFIG->user;
$dbpwd = $CONFIG->password;
$dbname = $CONFIG->db;
$dbprefix = $CONFIG->dbprefix;

mysql_connect($dbhost,$dbuser,$dbpwd) or die;
mysql_select_db($dbname) or die;

$modulekey = JRequest::getVar('ref');
list($moduleid,$live_site) = explode('|',base64_decode($modulekey));
if (empty($moduleid)) die ('Invalid call');

$result = mysql_query('SELECT params FROM '.$dbprefix.'modules WHERE id = "'.$moduleid.'"');
$row = mysql_fetch_assoc($result);
$params = new JParameter($row['params']);

$jxtc=uniqid('jxtc');
$player_url = $live_site.'modules/mod_jxtc_vtube/flash/videoPlayer.swf';

require 'func_buildparms.php';
?>
<html>
<body style="padding:0px;margin:0px;">
<div id="<?php echo $jxtc ?>">
<a href="http://www.adobe.com/go/getflashplayer">
<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
</a>
</div>
<script type="text/javascript" src="<?php echo $live_site ?>modules/mod_jxtc_vtube/js/jxtcswfobject.js"></script>
<script type="text/javascript">
<?php echo $playvars ?>
swfobject.embedSWF("<?php echo $player_url ?>","<?php echo $jxtc ?>",<?php echo $width ?>,<?php echo $height ?>,"9",null,<?php echo $jxtc ?>flashvars,<?php echo $jxtc ?>params);
</script>
</body>
</html>
