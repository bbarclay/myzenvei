<?php
/**
 * @version		$Id: view.pdf.php 11371 2008-12-30 01:31:50Z ian $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */
defined('_JEXEC') or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
/**
 * PDF Jafilia user View class
 * @since 1.5
 */
class JafiliaViewUser extends JView {
	function display($tpl = null) {
		global $mainframe;
		jimport('joomla.filesystem.folder');
		$lang =& JFactory::getLanguage();
		$langTag = $lang->getTag();
		if( !JFolder::exists( JPATH_BASE.DS.'language'.DS.$langTag )) { $langTag = 'en-GB'; }
		$lang->setLanguage($langTag);
		$lang->load();
		$lang->_metadata['pdffontname'] = 'freesans';
		$lang->load('joomla',JPATH_BASE,$langTag,true);
		$lang->load('com_jafilia',JPATH_BASE,$langTag,true);
		//========================================
		$mosConfig_live_site = JUri::base(true);
		$path = JPATH_COMPONENT.DS.'helpers'.DS.'jafilia.class.php';
		include($path);
		$id = intval($_GET['id']);
		$db = &JFactory::getDbo(); 	
		$db->setQuery("SELECT uid FROM #__jafilia_payings WHERE id='".$id."'");
		$uid = $db->loadResult();	
		$db->setQuery("SELECT * FROM #__vm_vendor");
		$vendor = $db->loadRow();
		$vendor_adress = '';
		$vendor_adress .= $vendor[1] . "<br>";
		$vendor_adress .= $vendor[11] . "<br>";
		$vendor_adress .= "<br>";
		$vendor_adress .= $vendor[16] . " " . $vendor[13];
		$user = new cluserdata($uid);
		$user->getSinglePayout($id, $uid);
		$payout = $user->singlepayout;
		$date = JText::_('JAF_DATE'). " " . JHTML::_('date', $payout[4], '%d.%m.%Y');
		$paying = JText::_('JAF_PAYOUT') . " #: " . $payout[0];
		$user->userdata($uid);
		$partner = $user->data;//$user->get('Data');
		$partner_adr = '';
		$partner_adr .= $partner[2] . " " . $partner[3] . "<br>";
		$partner_adr .= $partner[4] . "<br>";
		$partner_adr .= "<br>";
		$partner_adr .= $partner[5] . " " . $partner[6];	
		$amount = $payout[2] . " " . $user->getCurrency();
		//echo "[<pre>".$id."|".print_r($partner)."|".$uid."</pre>]";
		$id = intval($_GET['id']);
		//==============================================
		$document = &JFactory::getDocument();
		$document->setTitle($mosConfig_live_site.': '.JText::_('JAF_PAYOUT'));
		$document->setName("alias_test_pdf");
		$document->setHeader($date);
		$jafpdftext = '';
		$jafpdftext .= $vendor_adress;
		$jafpdftext .= '<br><br><br><br><br><br>';
		$jafpdftext .= $partner_adr;
		$jafpdftext .= '<br><br><br><br><br><h1>';
		$jafpdftext .= $paying;
		$jafpdftext .= '</h1><hr><table width="100%" border="0"><tr><td>';
		$jafpdftext .= JText::_('JAF_YOUR_AMOUNT').':';
		$jafpdftext .= '</td><td>';
		$jafpdftext .= $amount;
		$jafpdftext .= '</td></tr></table><hr><br>';
		$jafpdftext .= JText::_('JAF_THANX');
		echo $jafpdftext; 
	}
}
?>