<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class jposition_detailModeljposition_detail extends JModel
{
	var $_id = null;
	var $_data = null;
	var $_xml;
	var $_pagination = null;
	var $_total = null;
	var $_table_prefix = null;
	var $_positions = null;
	var $_menujdata = null;
	
	function __construct()
	{
		parent::__construct();
		global $mainframe, $context;
	  	$this->_table_prefix = '#__';			
		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0 );
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);	
	  
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
		
	}

	function setId($id)
	{
		$this->_id		= $id;
	}

	/*=======================================================================================================*/
	/*  joomla 1.5 com_modules -> module.php original function,  2 last lines changed                      */
	/*=======================================================================================================*/ 
	
	function getPositions()
	{
		jimport('joomla.filesystem.folder');

		$client =& JApplicationHelper::getClientInfo($this->getState('clientId'));
		if ($client === false) {
			return false;
		}

		//Get the database object
		$db	=& JFactory::getDBO();

		// template assignment filter
		$query = 'SELECT DISTINCT(template) AS text, template AS value'.
				' FROM #__templates_menu' .
				' WHERE client_id = '.(int) $client[0]->id;
		$db->setQuery( $query );
		$templates = $db->loadObjectList();

		// Get a list of all module positions as set in the database
		$query = 'SELECT DISTINCT(position)'.
				' FROM #__modules' .
				' WHERE client_id = '.(int) $client[0]->id;
		$db->setQuery( $query );
		$positions = $db->loadResultArray();
		$positions = (is_array($positions)) ? $positions : array();

		// Get a list of all template xml files for a given application

		// Get the xml parser first
		for ($i = 0, $n = count($templates); $i < $n; $i++ )
		{
			$path = $client[0]->path.DS.'templates'.DS.$templates[$i]->value;

			$xml =& JFactory::getXMLParser('Simple');
			if ($xml->loadFile($path.DS.'templateDetails.xml'))
			{
				$p =& $xml->document->getElementByPath('positions');
				if (is_a($p, 'JSimpleXMLElement') && count($p->children()))
				{
					foreach ($p->children() as $child)
					{
						if (!in_array($child->data(), $positions)) {
							$positions[] = $child->data();
						}
					}
				}
			}
		}

		if(defined('_JLEGACY') && _JLEGACY == '1.0')
		{
			$positions[] = 'left';
			$positions[] = 'right';
			$positions[] = 'top';
			$positions[] = 'bottom';
			$positions[] = 'inset';
			$positions[] = 'banner';
			$positions[] = 'header';
			$positions[] = 'footer';
			$positions[] = 'newsflash';
			$positions[] = 'legals';
			$positions[] = 'pathway';
			$positions[] = 'breadcrumb';
			$positions[] = 'user1';
			$positions[] = 'user2';
			$positions[] = 'user3';
			$positions[] = 'user4';
			$positions[] = 'user5';
			$positions[] = 'user6';
			$positions[] = 'user7';
			$positions[] = 'user8';
			$positions[] = 'user9';
			$positions[] = 'advert1';
			$positions[] = 'advert2';
			$positions[] = 'advert3';
			$positions[] = 'debug';
			$positions[] = 'syndicate';
		}

		$positions = array_unique($positions);
		sort($positions);
		
		$this->_positions = $positions;
		return $this->_positions;
	}

	/*================================================================================================================*/
	function getData()
	{
		//DEVNOTE: function returns all available modules for frontside;
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query);
		}		
		return $this->_data;
	}

	
	function getTotal()
	{
		//DEVNOTE: function returns total number of records set by _buildQuery() function
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
  	
	function _buildQuery()
	{
		$orderby = $this->_buildContentOrderBy();
		
		$query_include =' SELECT moduleid'.
				' FROM #__modules_menu'.
				' WHERE menuid=0 OR menuid='.$this->_id;
		
		$query =' SELECT id, title, position, published, module'.
				' FROM #__modules'.
				' WHERE module LIKE "mod_%" AND client_id=0 '.
				' AND id IN ('.$query_include.')';
				$orderby;	

		return $query;
	}
	
	function _buildContentOrderBy()
	{
		$orderby 	= ' ORDER BY ordering ';
		return $orderby;
	}
	
	function getMenujdata()
	{
		if (empty($this->_menujdata))
		{
		$query =' SELECT m.id, m.menutype, m.name, m.published, mt.title'.
				' FROM #__menu AS m'.
				' LEFT JOIN #__menu_types AS mt'.
				' ON mt.menutype = m.menutype'.
				' ORDER BY mt.id, m.id';
		}			
		$this->_menujdata = $this->_getList($query);
		return $this->_menujdata;
	}
	
}

?>
