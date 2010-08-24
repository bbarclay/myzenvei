<?php

/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT .DS.'components' .DS.'com_community' .DS.'libraries' .DS.'core.php');
require_once( JPATH_ROOT .DS.'plugins'.DS.'community'.DS.'twitter'.DS.'api_class.php');

if(!class_exists('plgCommunityTwitter'))
{
	class plgCommunityTwitter extends CApplications
	{
		var $name 		= "My on twitter";
		var $_name		= 'twitter';
		var $_path		= '';
		var $_user		= '';
		var $_my		= '';
		
		
		function onProfileDisplay()
		{	
			$phpVersion = floatval(phpversion());
			if($phpVersion >= 5)
			{
				if (function_exists('curl_init'))
				{
					JPlugin::loadLanguage('plg_twitter', JPATH_ADMINISTRATOR);
				
					$config	= CFactory::getConfig();
					$this->loadUserParams();
					
					$uri		= JURI::base();
					$user		= CFactory::getRequestUser();
					$document	=& JFactory::getDocument();
					$css		= $uri	.'plugins/community/groups/style.css';
					$document->addStyleSheet($css);	
					
					$username = $this->userparams->get('username');
					$password = $this->userparams->get('password');
					
					if( !empty($username) && !empty($password) )
					{
						
						$mainframe =& JFactory::getApplication();
						$caching = $this->params->get('cache', 1);		
						if($caching)
						{
							$caching = $mainframe->getCfg('caching');
						}
					
						$cache =& JFactory::getCache('plgCommunityTwitter');
						$cache->setCaching($caching);
						$callback = array('plgCommunityTwitter', '_getTwitterHTML');
						
						$content = $cache->call($callback, $username, $password, $this->userparams, $user->id);		
					}
					else
					{
						$content = "<div class=\"icon-nopost\"><img src='".JURI::base()."components/com_community/assets/error.gif' alt=\"\" /></div>";	
						$content .= "<div class=\"content-nopost\">".JText::_('PLG_TWITTER NOT SET')."</div>";
					}
				}
				else
				{
					$content = "<div class=\"icon-nopost\"><img src='".JURI::base()."components/com_community/assets/error.gif' alt=\"\" /></div>";	
					$content .= "<div class=\"content-nopost\">".JText::_('PLG_TWITTER CURL NOT INSTALL')."</div>";
				}
			}
			else
			{
				$content = "<div class=\"icon-nopost\"><img src='".JURI::base()."components/com_community/assets/error.gif' alt=\"\" /></div>";	
				$content .= "<div class=\"content-nopost\">".JText::_('PLG_TWITTER OLD PHP VERSION')."</div>";
			}
			
			return $content;
		}
		
		function _getTwitterHTML($username, $password, &$params, $userId) {
			$groupsModel		= CFactory::getModel( 'groups' );
			$avatarModel		= CFactory::getModel( 'avatar' );
			$groups				= $groupsModel->getGroups( $userId );
			$my					=& JFactory::getUser();
				
			$twitter = new Twitter($username, $password);
			$showFriend = $params->get('showFriends', false);
			$public_timeline_xml = $showFriend ? $twitter->getFriendsTimeline("json") : $twitter->getUserTimeline("json");
			$json = new Services_JSON();
			$rows = $json->decode($public_timeline_xml);
			unset($json);		
			
			ob_start();
				
			$maxCount = $params->get('count', 5);
			$totalCount = count($rows);
			$totalCount = $totalCount > $maxCount ? $maxCount : $totalCount;
			
			if(is_array($rows)) {
	  			for($i = 0; $i< $totalCount; $i++) {
	  				$update =& $rows[$i];
	  				
	  				$date	=& JFactory::getDate( $update->created_at );
	  				?>
	  				<div>
						<div style="border-top:1px solid #CCCCCC;padding-top:8px;margin-top:5px;">
							<div class="cavatar" style="height:60px;">
							<a href="http://twitter.com/<?php echo $update->user->screen_name; ?>" target="blank">
								<img class="avatar" src="<?php echo $update->user->profile_image_url; ?>" alt="<?php echo $update->user->screen_name; ?>" style="height: 60px;"/>
							</a>
							</div>
						<div class="ccontent-avatar" style="padding:0px">
		  				<?php echo $update->text; ?><br/>
		  				<span><?php echo $date->toFormat(JText::_('DATE_FORMAT_LC2')); ?></span>
		  				</div>
		  				<div class="clr">&nbsp;</div>
		  				</div>
	  				</div>
	  				<?php
				}
			}else{
				?>
				<div class="icon-nopost">
					<img src="<?php echo JURI::base()?>components/com_community/assets/error.gif" alt="" />
				</div>
				<div class="content-nopost">
					<?php echo JText::_('PLG_TWITTER NOT UPDATES');?>
				</div>
				<?php
			}
			
			$contents	= ob_get_contents();
			ob_end_clean();		
			return $contents;
		}
		
		function onProfileStatusUpdate( &$userid, &$old_status, &$new_status) 
		{
			$user				= CFactory::getUser( $userid );
			$this->userparams	= $user->getAppParams( $this->_name );

			if($this->userparams->get("updateTwitter", 0))
			{
				$phpVersion = floatval(phpversion());
				if($phpVersion >= 5)
				{
					if (function_exists('curl_init'))
					{
						$username = $this->userparams->get('username');
						$password = $this->userparams->get('password');
						
						$twitter = new Twitter($username, $password);
						
						$twitter->updateStatus($new_status);
					}
				}
			}
		}
	}
}

