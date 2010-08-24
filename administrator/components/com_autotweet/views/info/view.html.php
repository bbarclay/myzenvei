<?php
/**
 * Shows general information.
 * 
 * @version		1.0
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Posts View
 *
 */
class AutotweetViewInfo extends JView
{
	function display()
	{
		global $mainframe, $option;

		// add logo for backend view
		$doc =& JFactory::getDocument();
		$doc->addStyleDeclaration('table.adminlist { width:auto !important; }');
		$doc->addStyleDeclaration('.icon-48-fm-logo { background-image:url(components/com_autotweet/assets/fm-logo.png); no-repeat; }');
		
		JToolBarHelper::title( JText::_( 'Autotweet Manager' ), 'fm-logo.png' );
		JToolBarHelper::preferences('com_autotweet', '500', '600');
		JToolBarHelper::help('screen.autotweet', true);

		// Get data from the model
		$comp =& $this->get('ComponentInfo');
		$plugins =& $this->get('PluginInfo');
		
		$this->assignRef('comp', $comp);
		$this->assignRef('plugins', $plugins);
		
		parent::display();
	}
}