<?php
/*
	JoomlaXTC Virtuemart purchases plugin for JomSocial

	version 1.0
	
	Copyright (C) 2009  Monev Software LLC.	All Rights Reserved.
	
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

if (!defined( '_JEXEC' )) die( 'Direct Access to this location is not allowed.' );

require_once JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php';

if(!class_exists('plgCommunityjxtcvmbuys')) {
	class plgCommunityjxtcvmbuys extends CApplications {
		var $name 		= "My Purchases";
		var $_name		= 'purchases';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
	
		function onProfileDisplay() {
		
			$cache =& JFactory::getCache('community');
			$callback = array('plgCommunityjxtcvmbuys', '_buildHTML');
			$content = $cache->call($callback, $this);
			
			return $content; 		
		}
		
		function _buildHTML($that) {
			$user =& CFactory::getActiveProfile();

			$maxqty = $that->params->get('maxqty', 20);
			$that->loadUserParams();
	    $qty = $that->userparams->get('qty', 5);
	    $limit = ($maxqty > $qty) ? $maxqty : $qty;

			global $sess;
			require_once JPATH_ROOT.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart_parser.php';
			if (isset($sess)) {
				$itemid = '&Itemid='.$sess->getShopItemid();
			}
			else {
				$itemid = '';
			}
	
			$live_site = JURI::base();
			$db =& JFactory::getDBO();

			$sql = "select c.product_id, c.order_item_name, d.product_thumb_image
							from #__".VM_TABLEPREFIX."_orders a, #__".VM_TABLEPREFIX."_order_status b, #__".VM_TABLEPREFIX."_order_item c, #__".VM_TABLEPREFIX."_product d
							where b.order_status_code = a.order_status
							and c.order_id = a.order_id AND d.product_id = c.product_id
							and a.user_id=".$user->id." order by a.cdate DESC, c.order_item_id ASC LIMIT ".$limit;
			$db->setQuery($sql);
			$items = $db->loadObjectList();
			if (count($items) > 0) {
				$html ='<table border="0" cellspacing="5" cellpadding="5">';
				foreach ($items as $item) {
					$url = JRoute::_($live_site.'index.php?option=com_virtuemart&page=shop.product_details&product_id='.$item->product_id.$itemid);
					$img = "components/com_virtuemart/show_image_in_imgtag.php?filename=".urlencode($item->product_thumb_image)."&newxsize=".PSHOP_IMG_WIDTH."&newysize=".PSHOP_IMG_HEIGHT."&fileout=";
					$html .= '<tr><td><a href="'.$url.'"><img src="'.$img.'" /></a></td><td><a href="'.$url.'">'.$item->order_item_name.'</a></td></tr>';
				}
				$html .= '</table>';
			}
			else {
				$html = 'No purchases done.';
			}

			return $html;
		}
	}
}


