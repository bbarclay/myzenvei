<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );

class jposition_detailVIEWjposition_detail extends JView
{
	function __construct( $config = array())
	{ 
 	 global $context;
	 $context = 'jposition.list.';
 	 parent::__construct( $config );
	}
 
	function display($tpl = null)
	{
	 				 
		global $mainframe, $context;
		
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('J!Position') );
    	JToolBarHelper::title(   JText::_( 'J!POSITION' ), 'module.png' );
		
		$uri			= & JFactory::getURI();
		$positions 		= & $this->get( 'Positions');		//object of positions
		$items			= & $this->get( 'Data');			//object of module: id, title, module, position, published
		$total_items	= & $this->get( 'Total');			//total numbers of modules for front end
		$menu_data		= & $this->get( 'Menujdata');		//object of menu buttons: id, menutype, name, title
		$pagination 	= & $this->get( 'Pagination' );		//object of modules pagination
		/*$Positionjdata	= & $this->get( 'Positionjdata');*/	
		
		
		
		$menutype_names = array();
		$menutype_types = array();
		for ($i=0, $n = count( $menu_data ); $i < $n; $i++)
			{
				$menutype_names[] = $menu_data[$i]->title;
				$menutype_types[] = $menu_data[$i]->menutype;
			}
		$menutype_names = array_values(array_unique($menutype_names));
		$menutype_types = array_values(array_unique($menutype_types));
		
		$this->assignRef('request_url',	$uri->toString());
		$this->assignRef('positions',	$positions);	
		$this->assignRef('items',		$items);
		$this->assignRef('items_total',	$total_items);
		$this->assignRef('menujdata',	$menu_data);
		/*$this->assignRef('pagination',	$pagination);*/
		$this->assignRef('jmenutype_names',	$menutype_names);
		$this->assignRef('jmenutype_types',	$menutype_types);
		
		parent::display($tpl);
  }
}

?>
