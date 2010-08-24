<?php
/**
 * @version		$Id: k2extrafieldsgroup.php 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		K2
 * @author    JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableK2ExtraFieldsGroup extends JTable
{

	var $id = null;
	var $name = null;

	function __construct( & $db) {
		parent::__construct('#__k2_extra_fields_groups', 'id', $db);
	}
	
	function check() {
		if (trim($this->name) == '') {
			$this->setError(JText::_('Group must have a name'));
			return false;
		}
		return true;
	}

}
