<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class  plgSystemJsUsernames extends JPlugin
{
	function plgSystemJsUsernames(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}
	
	function onAfterInitialise()
	{
		$subfolder = trim(JURI::root(true),'/') . '/';
		$username = trim( JRequest::getVar( 'REQUEST_URI' , '' , 'SERVER' ) , '/');
		$username = JString::str_ireplace($subfolder,'',$username);

		$db =&JFactory::getDBO();
		$query = 'select count(*) from #__jsusernames where username='.$db->Quote($username);
		$db->setQuery($query);
		$count = $db->loadResult();
		if($count)
		{
			$db =& JFactory::getDBO();
			$query = 'select userid from #__jsusernames where username=' . $db->Quote($username);
			$db->setQuery($query);
			$id =$db->loadResult();

			if($id)
			{
				$Itemid = $this->params->get('mymenuitem' , 1 );
				JRequest::setVar( 'option' , 'com_community');
				JRequest::setVar( 'view' , 'profile' );
				JRequest::setVar( 'userid' , $id );
				JRequest::setVar( 'Itemid' , $Itemid );
			}
		}
	}
}