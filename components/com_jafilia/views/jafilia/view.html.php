<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport( 'joomla.application.component.view');
class JafiliaViewJafilia extends JView {
	function display($tpl = null) {
		/* Get the Cpanel images */
		$cpanel_images = new stdClass();
		$cpanel_images->config = $this->CpanelButton('configuration48.jpg', 'index.php?option=com_jafilia&controller=config', JText::_('JAF_CONFIG'));
		$cpanel_images->user = $this->CpanelButton('partner48.jpg', 'index.php?option=com_jafilia&controller=user', JText::_('JAF_USER'));
		$cpanel_images->clicks = $this->CpanelButton('clicks48.jpg', 'index.php?option=com_jafilia&controller=clicks', JText::_('JAF_REFERER'));
		$cpanel_images->help = $this->CpanelButton('help48.jpg', 'http://www.jafilia.com/index.php/forum', JText::_('JAF_HELP'));
		$cpanel_images->sales = $this->CpanelButton('fee48.jpg', 'index.php?option=com_jafilia&controller=sales', JText::_('JAF_LEADS'));
		$cpanel_images->links = $this->CpanelButton('banners48.jpg', 'index.php?option=com_jafilia&controller=links', JText::_('JAF_LINKS'));
		$cpanel_images->charts = $this->CpanelButton('Charts.gif', 'index.php?option=com_jafilia&controller=charts', JText::_('JAF_CHARTS'));
		$cpanel_images->about = $this->CpanelButton('aboutus48.jpg', 'index.php?option=com_jafilia&controller=about', JText::_('JAF_ABOUT'));
		$this->toolbar();		
	    $this->assignRef('cpanel_images', $cpanel_images);	
		$this->overview();
		parent::display($tpl);
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');
	}	
	function CpanelButton($image, $link, $title) {
		global $mainframe;
		$cpanelbutton = '<div class="cpanel_button">';
		$cpanelbutton .= '	<div class="icon">';
		$cpanelbutton .= '		<a href="'.$link.'"';
		if (substr($link, 0, 4) == "http") $cpanelbutton .= ' target="_new"';
		$cpanelbutton .= '      >';
		//$cpanelbutton .= '			<img src="'.JURI::root().'/media/com_jafilia/images/'.$image.'" title="'.$title.'"';	//to do
		$cpanelbutton .= '			<img src="components/com_jafilia/images/'.$image.'" title="'.$title.'"';
		$cpanelbutton .= '			<span>'.$title.'</span>';
		$cpanelbutton .= '		</a>';
		$cpanelbutton .= '	</div>';
		$cpanelbutton .= '</div>';
		return $cpanelbutton;
	}	
	function overview() {
		$database = &JFactory::getDbo();
		$path = JPATH_COMPONENT.DS.'config.jafilia.php';
		include($path);
		$reached = array();
		$database->setQuery("SELECT * FROM #__jafilia_user");
		$rows = $database->loadObjectList();		
		foreach($rows as $row)  {
			$database->setQuery("SELECT SUM(sale) FROM #__jafilia_sales WHERE uid='".$row->uid."' AND paid='0'");
			$result = $database->loadResult();
			if($result >= $jafpayout)  {
				$reached[] = $row->uid;
			}
		}	
		if ($reached) {
			$uids = implode(',', $reached);
			$database->setQuery("SELECT * FROM #__jafilia_user WHERE uid IN($uids)");
			$rrows = $database->loadObjectList();			
			if ($rrows) $this->assignRef('rows', $rrows);
		}		
		if($jafpayout) $this->assignRef('payoutlimit', $jafpayout);
	}	
	function toolbar() {
		JToolBarHelper::title(JText::_('JAF_COM_TITLE'), 'jafilia-logo48x48.png' );
	}
}
?>