<?php
/*
 JoomlaXTC Community Builder User Plugin: Virtuemart Buys
 version 1.3
 copyright (C) JoomlaXTC   www.joomlaxtc.com
 license Limited  http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

if ( !defined( '_VALID_MOS' ) && !defined('_JEXEC') ) die('Direct Access to this location is not allowed.');

class jxtc_vmbuys extends cbTabHandler {

	function jxtc_vmbuys() {
		$this->cbTabHandler();
	}

	function getDisplayTab($tab,$user,$ui) {
		global $database, $sess;
		$params = $this->params;
		$location = $params->get('location', 'f');
		if ($location == 'a') return;
		$qty = $params->get('qty', 5);
		return $this->getData($tab,$qty,$user);
	}
	
	function getEditTab($tab,$user,$ui) {
		global $database, $sess;
		$params = $this->params;
		$location = $params->get('location', 'f');
		if ($location == 'f') return;
		$qty = $params->get('qty', 5);
		return $this->getData($tab,$qty,$user);
	}
	
	function getData($tab,$qty,$user) {
		global $database, $sess;
		$html = (empty($tab->description)) ? '' : "<div class=\"tab_Description\">".$tab->description."</div>\n";
		require_once( dirname(__FILE__).'/../../../../com_virtuemart/virtuemart_parser.php' );
		$itemid = $sess->getShopItemid();
		$itemid = (empty($itemid)) ? '' : '&Itemid='.$itemid;
		$sql = "select c.product_id, c.order_item_name, d.product_thumb_image
						from #__".VM_TABLEPREFIX."_orders a, #__".VM_TABLEPREFIX."_order_status b, #__".VM_TABLEPREFIX."_order_item c, #__".VM_TABLEPREFIX."_product d
						where b.order_status_code = a.order_status
						and c.order_id = a.order_id AND d.product_id = c.product_id
						and a.user_id=".$user->id." order by a.cdate DESC, c.order_item_id ASC LIMIT ".$qty;
		$database->setQuery($sql);
		$items = $database->loadObjectList();
		if (count($items) > 0) {
			$html .='<table border="0" cellspacing="5" cellpadding="5">';
			foreach ($items as $item) {
				$url = 'index.php?option=com_virtuemart&page=shop.product_details&product_id='.$item->product_id.$itemid;
				$img = "components/com_virtuemart/show_image_in_imgtag.php?filename=".urlencode($item->product_thumb_image)."&newxsize=".PSHOP_IMG_WIDTH."&newysize=".PSHOP_IMG_HEIGHT."&fileout=";
				$html .= '<tr><td><a href="'.$url.'"><img src="'.$img.'" /></a></td><td><a href="'.$url.'">'.$item->order_item_name.'</a></td></tr>';
			}
			$html .= '</table>';
		}
		else {
			$html .= 'No purchases done.';
		}
		return $html;
	}
}
?>