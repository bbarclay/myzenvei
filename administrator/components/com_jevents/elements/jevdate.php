<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: jevuser.php 1399 2009-03-30 08:31:52Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JElementJevdate extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'JEVDate';

	function fetchElement($name, $value, &$node, $control_name)
	{

		// Must load admin language files
		$lang =& JFactory::getLanguage();
		$lang->load("com_jevents", JPATH_ADMINISTRATOR);

		$option = "com_jevents"; 
		$params =& JComponentHelper::getParams( $option );
		$minyear = $params->get("com_earliestyear",1970);
		$maxyear = $params->get("com_latestyear",2150);
		$document =& JFactory::getDocument();
		JHTML::script("calendar11.js",JURI::root()."components/".$option."/assets/js/",true);
		JHTML::stylesheet("dashboard.css",JURI::root()."components/".$option."/assets/css/",true);
		$document->addScriptDeclaration('
				var '.$control_name.$name.'=false;
				window.addEvent(\'domready\', function() {
				if ('.$control_name.$name.') return;
				'.$control_name.$name.'=true;
				new NewCalendar({ '.$control_name.$name.' :  "Y-m-d"},{
					direction:0, 
					classes: ["dashboard"],
					draggable:true,
					navigation:2,
					tweak:{x:0,y:-75},
					offset:1,
					range:{min:'.$minyear.',max:'.$maxyear.'},
					months:["'.JText::_("JANUARY").'",
					"'.JText::_("FEBRUARY").'",
					"'.JText::_("MARCH").'",
					"'.JText::_("APRIL").'",
					"'.JText::_("MAY").'",
					"'.JText::_("JUNE").'",
					"'.JText::_("JULY").'",
					"'.JText::_("AUGUST").'",
					"'.JText::_("SEPTEMBER").'",
					"'.JText::_("OCTOBER").'",
					"'.JText::_("NOVEMBER").'",
					"'.JText::_("DECEMBER").'"
					],
					days :["'.JText::_("SUNDAY").'",
					"'.JText::_("MONDAY").'",
					"'.JText::_("TUESDAY").'",
					"'.JText::_("WEDNESDAY").'",
					"'.JText::_("THURSDAY").'",
					"'.JText::_("FRIDAY").'",
					"'.JText::_("SATURDAY").'"
					]
				});
			});');


		return '<input type="text" name="'.$control_name.'['.$name.']" id="'.$control_name.$name.'" value="'.htmlspecialchars($value, ENT_COMPAT, 'UTF-8').'" onchange="checkDates(this);" maxlength="10" size="12"  />';

	}
}