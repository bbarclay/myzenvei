<?php
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.folder' );
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.archive' );

function com_install()
{
	$db =& JFactory::getDBO();
	
	$query = "select count(*) from #__plugins where element=" . $db->Quote('jsusernames') . " and folder='community'";
	$db->setQuery($query);
	$count = $db->loadResult();
	
	if($count <= 0 )
	{
		JArchive::extract( JPATH_ROOT . DS .'administrator'.DS.'components'.DS.'com_jsusernames'.DS.'community.zip' , JPATH_PLUGINS.DS.'community');
		
		$language	= JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jsusernames'.DS.'en-GB.plg_jsusernames.ini';
		
		JFile::copy( $language , JPATH_ROOT.DS.'administrator'.DS.'language'.DS.'en-GB'.DS.'en-GB.plg_jsusernames.ini');
		
		$query = "insert into #__plugins set name='Community - JSUsernames',element='jsusernames',folder='community',access='0',ordering='0',published='1'";
		$db->setQuery($query);
		$db->query();
	}

	$query = "select count(*) from #__plugins where element=" . $db->Quote('jsusernames') . " and folder='system'";
	$db->setQuery($query);
	$count = $db->loadResult();
	
	if($count <= 0 )
	{
		JArchive::extract( JPATH_ROOT . DS .'administrator'.DS.'components'.DS.'com_jsusernames'.DS.'system.zip' , JPATH_PLUGINS.DS.'system');
				
		$query = "insert into #__plugins set name='System - JomSocial Usernames',element='jsusernames',folder='system',access='0',ordering='0',published='1'";
		$db->setQuery($query);
		$db->query();
	}
	
	ob_start();
	?>
<h3>Installation completed - JS Usernames plugin for JomSocial</h3>
<div>There is nothing much to configure here. Most of the application details can be found in the user profile area</div>
<div style="font-weight: bold;text-decoration: underline;">Requirements</div>
<ul>
	<li>mod_rewrite must be enabled.</li>
	<li>If you are using 3rd party SEF Components, ensure that the community plugin is configured and the excluded usernames include the custom aliases</li>
</ul>
	<?php
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}