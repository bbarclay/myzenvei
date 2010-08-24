<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');

jimport('joomla.html.pagination');

class plgCommunityJsUsernames extends CApplications
{
	var $name		= 'JsUsernames';
	var $_name		= 'jsusernames';
	var $_user		= null;
	var $pagination	= null;
	
    function plgCommunityJsUsernames(& $subject, $config)
    {
		$this->_user	=& CFactory::getActiveProfile();
		$this->_my		=& CFactory::getUser();

		parent::__construct($subject, $config);
    }
	
	function save( &$response , $url )
	{
		JPlugin::loadLanguage( 'plg_jsusernames', JPATH_ADMINISTRATOR );
		
		$folders = JFolder::folders(JPATH_ROOT);
		$url = JFilterOutput::stringURLSafe($url);
		
		$db =& JFactory::getDBO();
		$query= 'select count(*) from #__menu where alias='.$db->Quote($url);
		$db->setQuery($query);
		$count = $db->loadResult();
		
		$query ='select count(*) from #__content where alias='.$db->Quote($url);
		$db->setQuery($query);
		$count1 = $db->loadResult();
		
		$query	= 'select params FROM #__plugins where element="jsusernames" AND folder="community"';
		$db->setQuery($query);
		$param	= $db->loadResult();
		
		$params	= new JParameter($param);
		$excluded = $params->get('excluded'); 
		$excluded = explode(',',$excluded);
		$disallowed = array_merge($folders, $excluded);

		if(in_array( $url , $disallowed ) || empty($url) || $count >= 1 || $count1 >= 1)
		{
			$response->addScriptCall('alert', JText::_('USERNAMES NOT ALLOWED') );
			return $response->sendResponse();
		}

		
		$query = 'select count(*) from #__jsusernames where username='.$db->Quote($url);
		$db->setQuery($query);
		
		if(!$db->loadResult())
		{
			$my	=& JFactory::getUser();
			$query ='delete from #__jsusernames where userid=' . $db->Quote($my->id);
			$db->setQuery($query);
			$db->query();
			
			
			$query ='insert into #__jsusernames set userid='.$db->Quote($my->id).',username='.$db->Quote($url);
			$db->setQuery($query);
			$db->query();
			
			$response->addScriptCall('jQuery("#custom-url").val("'.$url.'");');
			$response->addScriptCall('jQuery("#custom-url-link").html("'.JURI::root().$url.'");');
			$response->addScriptCall('jQuery("#custom-url-link").attr("href","'.JURI::root().$url.'");');
			$response->addScriptCall('alert', JText::_('USERNAMES SAVED') );
			return $response->sendResponse();
		}
		
		$response->addScriptCall('alert', JText::_('USERNAMES EXISTS') );
		return $response->sendResponse();
	}
	
	function _getURL( $id = false )
	{
		$db =& JFactory::getDBO();
		
		if( !$id )
		{
			$my =& JFactory::getUser();
			$id = $my->id;
		}

		$query = 'select * from #__jsusernames where userid='.$db->quote($id);
		$db->setQuery($query);
		$url = $db->loadObject();
		$url = isset($url->username)?$url->username:'';
		
		return $url;
	}
	
	function onProfileDisplay()
	{
		JPlugin::loadLanguage( 'plg_jsusernames', JPATH_ADMINISTRATOR );

		$document		=& JFactory::getDocument();
		$document->addStyleSheet( JURI::root() . 'plugins/community/' . $this->_name . '/style.css' );
		
		$url			= $this->_getURL( $this->_user->id );
		$content		= '';
		ob_start();
		if( !empty($url) )
		{
			$url	= JURI::root() . $this->_getURL();
		?>
		<div class="myurl-wrapper">
			<div class="myurl"><?php echo JText::_('USERNAMES CURRENT URL');?> <a href="<?php echo $url;?>"><?php echo $url;?></a></div>
		</div>
		<?php
		}
		
		$content	= ob_get_contents();
		@ob_end_clean();
		return $content;
	}
	
	function onAppDisplay()
	{
		JPlugin::loadLanguage( 'plg_jsusernames', JPATH_ADMINISTRATOR );
		
		$document		=& JFactory::getDocument();
		$document->addStyleSheet( JURI::root() . 'plugins/community/jsusernames/style.css' );

		if( $this->_my->id == $this->_user->id )
		{	
			CFactory::load( 'helpers' , 'user' );
			ob_start();
			$url = $this->_getURL();
		?>
		<script type="text/javascript">
		function save()
		{
			var custom_url	= jQuery('#custom-url').val();
			jax.call('community','plugins,jsusernames,save',custom_url);
		}
		</script>
		<div class="jsusernames-info">
		<div><?php echo JText::_('USERNAMES DESC'); ?></div>
		<div style="margin-top:5px;"><a href="<?php echo JURI::root().$url;?>" id="custom-url-link"><?php echo JURI::root().$url;?></a></div>
		</div>
		<div style="margin-top:15px;">
			<span style="font-weight: bold;margin-right: 2px;"><?php echo JURI::root(); ?></span>
			<input type="textbox" class="inputbox" style="width: 170px;" value="<?php echo $url;?>" name="url" id="custom-url" />
			<input type="button" onclick="save();" value="<?php echo JText::_('Save');?>" class="button" style="margin-left: 3px;" />
			<div style="color: red;"><?php echo JText::_('USERNAMES ALLOWED'); ?></div>
		</div>
	<?php
			$content	= ob_get_contents();
			@ob_end_clean();

			return $content;
		}
	}

	function onSystemStart()
	{
		$this->_my	=& CFactory::getUser();
		if( $this->_my->id != 0 )
		{
			//Load Language file.
			JPlugin::loadLanguage( 'plg_jsusernames', JPATH_ADMINISTRATOR );		
			
			$toolbar	=& CFactory::getToolbar();
			$toolbar->addItem( 'APP' , 'USERNAMES_VIEW' , JText::_('USERNAMES MENU') , CRoute::_('index.php?option=com_community&view=profile&userid=' . $this->_my->id . '&task=app&app=jsusernames') );
		}
	}
}