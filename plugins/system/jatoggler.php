<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemJatoggler extends JPlugin {
	var $active = true;

	function plgSystemJatoggler(& $subject, $config) {
		global $mainframe;
		
		if ($mainframe->isSite()) {
			return;
		}

		parent::__construct($subject, $config);
		
		$exclude = $this->params->get('exclude');
		if (isset($exclude{0})) {
			$exclude = array_flip(explode(',', $exclude));
			if (isset($exclude[JRequest::getCmd('option')])) {
				$this->active = false;
				return;
			}
		}

		$jat	 = $mainframe->getUserStateFromRequest('jatoggler', 'jatoggler', 0);
		$task	 = $mainframe->getUserStateFromRequest('jatoggler_task', 'jatoggler_task', '');

		if (!$jat) 	$mainframe->setUserState('jatoggler', JRequest::getCmd('jatoggler'));
		if (!$task) $mainframe->setUserState('jatoggler_task', JRequest::getCmd('task'));
		
	}

	function onAfterRoute() {
		global $mainframe;

		if (!$this->active || !$mainframe->isAdmin() || JRequest::getInt('nojatoggler')) {
			return;
		}
		
		$js = "var jatogglerData = {Base: '".JUri::root()."', Public: '".JText::_('Public')."', Registered: '".JText::_('Registered')."', Special: '".JText::_('Special')."'};\n";
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);

		JHTML::script('jatoggler.js', JUri::root().'plugins/system/jatoggler/', true);
	}
	
	function onAfterDispatch() {
		global $mainframe;

		if (!$this->active || $mainframe->isSite()) {
			return;
		}

		$jat	 = $mainframe->getUserStateFromRequest('jatoggler', 'jatoggler', 0);
		$task	 = $mainframe->getUserStateFromRequest('jatoggler_task', 'jatoggler_task', '');

		$mainframe->setUserState('jatoggler', '');
		$mainframe->setUserState('jatoggler_task', '');
		 
		 if ($jat) {
			 switch($task) {
				case 'publish':
				case 'unpublish':
				case 'block':
				case 'unblock':
				case 'toggle_frontpage':
				case 'accessregistered':
				case 'accessspecial':
				case 'accesspublic':
					$this->clearMessages();
					while (@ob_end_clean());

					echo 'JAT OK';
					die();
				break;

				case 'orderup':
				case 'orderdown':
				case 'saveorder':
				default:
					$buf = $this->getTable();
					$this->clearMessages();
					while (@ob_end_clean());
					echo $buf;
					die();
				break;
			 }
		}
	}
	
	function getTable() {
		$buf = JFactory::getDocument()->getBuffer('component');
		
		if (preg_match_all('/(<table.*<\/table>)/iUs', $buf, $m)) {
			$m = $m[1];
			for($i=0, $c=sizeof($m); $i<$c; $i++) {
				if (strpos($m[$i], 'return listItemTask')) {
					$buf = $m[$i];
					break;
				}
			}
		}
		
		$buf = strtr($buf, array(
			"\r" => '',
			"\n" => '',
			"\t" => ''
		));
		
		return $buf;
	}
	
	function clearMessages() {
		$session =& JFactory::getSession();
		$session->set('application.queue', null);
	}

}