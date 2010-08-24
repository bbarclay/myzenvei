<?php

/**

 * @package		JomSocial

 * @subpackage 	Template 

 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!

 * @license http://www.jomsocial.com Copyrighted Commercial Software

 * 

 */

defined('_JEXEC') or die();

?>

<div id="social-bookmarks" class="page-action">
<?php
	/*Fahd URL Tempering*/
	$user_id =  $_GET['userid'];
	$sql="SELECT `userid`,`username` FROM jos_jsusernames WHERE `userid`=".$user_id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
  	$refname = $row['username'];
	$uri = "http://www.".$refname.".myzenvei.com/"; 
?>
	<a class="icon-bookmark" href="javascript:void(0);" onclick="joms.bookmarks.show('<?php echo $uri;?>');"><span><?php echo JText::_('CC SHARE THIS');?></span></a>

</div>