<?php
/*
	JoomlaXTC Virtuemart purchase orders plugin for JomSocial

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

if(!class_exists('plgCommunityjxtcvmorders')) {
	class plgCommunityjxtcvmorders extends CApplications {
		var $name 		= "My orders";
		var $_name		= 'orders';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
	
		function onProfileDisplay() {
		
			$cache =& JFactory::getCache('community');
			$callback = array('plgCommunityjxtcvmorders', '_buildHTML');
			$content = $cache->call($callback, $this);
			
			return $content; 		
		}
		
		function _buildHTML($that) {
			$user =& CFactory::getActiveProfile();

			$maxqty = $that->params->get('maxqty', 20);
			$template = $that->params->get('template','{product_name} - {download_url}<br/>');
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

			$sql = "select a.order_id as id,FROM_UNIXTIME(a.cdate, '%Y-%m-%d') as order_date,b.order_status_name as status
							from #__".VM_TABLEPREFIX."_orders a, #__".VM_TABLEPREFIX."_order_status b
							where b.order_status_code = a.order_status
							and a.user_id=".$user->id." order by a.cdate DESC LIMIT ".$limit;
			$db->setQuery($sql);
			$items = $db->loadObjectList();
			if (count($items) > 0) {
				$html ='<table border="0" cellspacing="1" cellpadding="1" width="100%">';
				$html .='<tr><th width="80">Order ID</th><th>Date</th><th>Status</th></tr>';
				foreach ($items as $item) {
					$url = JRoute::_($live_site.'index.php?option=com_virtuemart&page=account.order_details&order_id='.$item->id.$itemid);
					$html .= '<tr><td align="center"><a href="'.$url.'">'.$item->id.'</a></td>
					<td>'.$item->order_date.'</td>
					<td><a href="'.$url.'">'.$item->status.'</a></td></tr>';
				}
				$html .= '</table>';
			}
			else {
				$html = 'No orders available.';
			}

			return $html;
		}
	}
}


