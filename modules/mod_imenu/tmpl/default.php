<?php
/*------------------------------------------------------------------------
# ogweb.net All rights reserved.
# ------------------------------------------------------------------------
# Copyright © 2009 ogweb.net. 
# Website:  http://www.ogweb.net/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');

//init menu with parameters
	echo '<ntb:fisheye id="fisheye1" growpercent="'.$__maxwidth.'" opendirection="'.$__menutype.'" expanddirection="'.$__direction.'" iconwidth="'.$__itemwidth.'" theme="'.$__menutheme.'">';
	
	//adding menu item
	foreach ($_items as $_item)
	{
		$_params = explode( "&", str_replace( "<br />", "&", nl2br($_item->params) ) );
		
		$_checkimg = 0;
		
		while (list($key, $value) = each($_params))
		{
			$_exp = explode( "=", $value );	
			
			if(strstr($_exp[1], ".jpg") || strstr($_exp[1], ".png") || strstr($_exp[1], ".bmp") || strstr($_exp[1], ".gif")) {
				echo '<ntb:menuitem imagesrc="images/stories/';
				echo $_exp[1];
				echo '" label="';
				echo $_item->name;
				echo '" onclick="location.href =';
				echo "'";
				echo $_item->link.'&Itemid='.$_item->id;
				echo "'";
				echo '"></ntb:menuitem>';
				
				$_checkimg = 1;
			} 
			else {
			}
		}
		if($_checkimg == 0){
			echo '<ntb:menuitem imagesrc="modules/mod_imenu/theme/';
			echo "qmark.png";
			echo '" label="';
			echo $_item->name;
			echo '" onclick="location.href =';
			echo "'";
			echo $_item->link.'&Itemid='.$_item->id;
			echo "'";
			echo '"></ntb:menuitem>';
		}

	}
	
	//closing menu item tag
	echo '</ntb:fisheye>';

?>