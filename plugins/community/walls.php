<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');

if(!class_exists('plgCommunityWalls'))
{
	class plgCommunityWalls extends CApplications
	{
		var $name		= 'Walls';
		var $_name		= 'walls';

	    function plgCommunityWalls(& $subject, $config)
	    {
			parent::__construct($subject, $config);
	    }
	
		/**
		 * Ajax function to save a new wall entry
		 * 	 
		 * @param message	A message that is submitted by the user
		 * @param uniqueId	The unique id for this group
		 * 
		 **/	 	 	 	 	 		
		function ajaxSaveWall( &$response, $message , $uniqueId, $cache_id="" )
		{
			$my				=& CFactory::getUser();
			$user			= CFactory::getUser( $uniqueId );
			
			JPlugin::loadLanguage('plg_walls', JPATH_ADMINISTRATOR);
			
			// Load libraries
			CFactory::load( 'models' , 'photos' );
			CFactory::load( 'libraries' , 'wall' );
			CFactory::load( 'helpers' , 'url' );
			CFactory::load( 'libraries', 'activities' );	
	
			// If the content is false, the message might be empty.
			
			$tempMessage = JString::trim($message);		
			if( empty( $tempMessage) )
			{
				$response->addAlert( JText::_('PLG_WALLS PLEASE ADD MESSAGE') );
			}
			else
			{
				$maxchar = $this->params->get('charlimit', 0);
				if(!empty($maxchar))
				{
					$msglength = strlen($message);
					if($msglength > $maxchar)
					{
						$message = substr($message, 0, $maxchar);	
					}	
				}						
				
				$wall		= CWallLibrary::saveWall( $uniqueId , $message , 'user' , $my , ( $my->id == $user->id ) );
	
				CFactory::load( 'libraries' , 'activities' );
	
				$act = new stdClass();
				$act->cmd 		= 'profile.wall.create';
				$act->actor 	= $my->id;
				$act->target 	= $uniqueId;
				$act->title		= JText::_('CC ACTIVITIES WALL POST PROFILE');
				$act->content	= $message;
				$act->app		= 'walls';
				$act->cid		= $wall->id;
				CActivityStream::add($act);
				
				// @rule: Send notification to the profile user.
				if( $my->id != $user->id )
				{
					$nData				= array();
					$nData['url']		= CRoute::emailLink( 'index.php?option=com_community&view=profile&userid=' . $user->id );
					$nData['user']		= $my;
					$nData['message']	= $message;
		
					CFactory::load( 'libraries' , 'notification' );
					
					$notification	= new CNotificationLibrary();
					$notification->add( 'profile.submit.wall' , $my->id , $user->id , JText::sprintf('PLG_WALLS NOTIFY EMAIL SUBJECT' , $my->getDisplayName() ) , '' , 'profile.email.new.wall' , $nData);
				}
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('profile.wall.create');			
				
				$response->addScriptCall( 'joms.walls.insert' , $wall->content );
				$response->addScriptCall( 'if(jQuery(".content-nopost").length){
											jQuery("#wall-empty-container").remove();
										}' );		
				
				$cache = & JFactory::getCache('plgCommunityWalls');
				$cache->remove($cache_id);					
				
				$cache = & JFactory::getCache('plgCommunityWalls_fullview');
				$cache->remove($cache_id);			
			}
			
			return $response;
		}
		
		/**
		 * Delete post message
		 *
		 * @param	response	An ajax Response object
		 * @param	id			A unique identifier for the wall row
		 *
		 * returns	response
		 */
		function ajaxRemoveWall( &$response, $id, $cache_id="" )
		{
			$my 		=& CFactory::getUser();
			$user		=& CFactory::getActiveProfile();
			$wallModel 	=& CFactory::getModel('wall');
			$wall		= $wallModel->get( $id );
			
			CError::assert( $id , '' , '!empty' , __FILE__ , __LINE__ );
			
			// Make sure the current user actually has the correct permission
			// Only the original writer and the person the wall is meant for (and admin of course)
			// can delete the wall
			if( ($my->id == $wall->post_by) || 
				($my->id == $wall->contentid ) ||
				(isCommunityAdmin()) ) 
			{
				if(!$wallModel->deletePost($id))
				{
					$html	= JText::_( 'Error while removing wall. Line:' . __LINE__ );
					$response->addAlert( $html );
				}
				else
				{
					// @rule: Remove the wall activity from the database as well
					CFactory::load( 'libraries' , 'activities' );
					CActivityStream::remove( 'walls' , $id );
					
					//add user points
					if($wall->post_by != 0)
					{
						CFactory::load( 'libraries' , 'userpoints' );		
						CUserPoints::assignPoint('wall.remove', $wall->post_by);
					}
				}
				
				$cache = & JFactory::getCache('plgCommunityWalls');
				$cache->remove($cache_id);		
				
				$cache = & JFactory::getCache('plgCommunityWalls_fullview');
				$cache->remove($cache_id);	
			} 
			else
			{
				$html	= JText::_( 'CC PERMISSION DENIED' );
				$response->addAlert( $html );
			}
				
			
			return $response;	
		}
		
		
		function ajaxAddComment(&$response, $id, $cmt, $cacheId)
		{
			JPlugin::loadLanguage('plg_walls', JPATH_ADMINISTRATOR);
			
			// Add the comment into the db
			CFactory::load('libraries', 'comment');
			$my				=& CFactory::getUser();
			
			// Extract thenumeric id from the wall-cmt-xxx
			$wallid = substr($id, 9);
			
			CFactory::load( 'models' , 'wall' );
			$wall	=& JTable::getInstance( 'Wall' , 'CTable' );
			$wall->load( $wallid );
			
			$db = JFactory::getDBO();
			$sql = "SELECT `comment` FROM #__community_wall WHERE id =" . $db->Quote($wallid);
			$db->setQuery($sql);
			$content = $db->loadResult();
	
			if($db->getErrorNum())
			{
				JError::raiseError( 500, $db->stderr());
			}
			
			$cmt		= trim( $cmt );
	
			if( empty( $cmt ) )
			{
				$response->addScriptCall( 'jQuery( "#' . $id . ' .wall-coc-errors" ).html("' . JText::_('PLG_WALLS COMMENT EMPTY') . '");');
				$response->addScriptCall( 'jQuery( "#' . $id . ' .wall-coc-errors" ).show();');
				$response->addScriptCall( 'jQuery( "#' . $id . ' .wall-coc-errors" ).css("color", "red");');
				$response->addScriptCall( 'jQuery("#' . $id . ' .wall-coc-form-action.add").attr("disabled", false);');
			}
			else
			{
				$comment	= new CComment();
				$content	= $comment->add($my->id, $cmt, $content);
	
				// Update the wall with the comment info
				$sql = "UPDATE #__community_wall SET `comment`=".$db->Quote($content). " WHERE id =" . $db->Quote($wallid);
				$db->setQuery($sql);
				$db->query();

				if($db->getErrorNum())
				{
					JError::raiseError( 500, $db->stderr());
				}
				
				$newComment = new stdClass();
				$date		= new JDate();
				
				$newComment->creator = $my->id;
				$newComment->text 	 = $cmt;
				$newComment->date 	 = $date->toUnix();

				// @rule: Send notification to the parent wall
				$targetUser	=& CFactory::getUser( $wall->post_by );
				$params 	=& $targetUser->getParams();

				if( $my->id != $targetUser->id && $params->get('notifyWallComment') )
				{
					$nData				= array();
					$nData['url']		= CRoute::getExternalURL( 'index.php?option=com_community&view=profile&userid=' . $wall->contentid );
					$nData['user']		= $my;
					$nData['message']	= $newComment->text;
		
					CFactory::load( 'libraries' , 'notification' );
					
					$notification	= new CNotificationLibrary();
					$notification->add( 'profile.submit.wall.comment' , $my->id , $targetUser->id , JText::sprintf('PLG_WALLS WALL COMMENT EMAIL SUBJECT' , $my->getDisplayName() ) , '' , 'profile.email.new.wallcomment' , $nData);
				}
				
				$html = $comment->renderComment($newComment, true);
				
				$response->addScriptCall( 'joms.comments.insert' , $id, $html );
				
				// Clear wall cache
				$cache = & JFactory::getCache('plgCommunityWalls');
				$cache->remove($cacheId);						
				$cache = & JFactory::getCache('plgCommunityWalls_fullview');
				$cache->remove($cacheId);
			}
			
			return $response;	
		}
		
		// Remove the comment
		// Wall id will be in the form or "wall-cmt-xxx" where xxx is the wall contentid
		function ajaxRemoveComment(&$response, $parentWallId, $commentIndex)
		{
			// Add the comment into the db
			CFactory::load('libraries', 'comment');
			$my				=& CFactory::getUser();
			$db 			= JFactory::getDBO();
			$comment 		= new CComment();
			// Extract the numeric id from the wall-cmt-xxx
			$wallid = substr($parentWallId, 9);
			
			$wallModel 	=& CFactory::getModel('wall');
			$wall		= $wallModel->get( $wallid );
			
			$content = $wall->comment;
	
			if($db->getErrorNum())
			{
				JError::raiseError( 500, $db->stderr());
			}
			
			// Get the comment data to determine ownership
			$commentData = $comment->getCommentsData($content);
			
			// Make sure that we have the right permission to delete this comment
			// Make sure the current user actually has the correct permission
			// Only the original writer and the person the wall is meant for (and admin of course)
			// can delete the wall
			if( ($my->id == $commentData[$commentIndex]->creator) || 
				($my->id == $wall->contentid ) ||
				(isCommunityAdmin()) ) 
			{
				$content = $comment->remove( $content, $commentIndex);
				
				// Update the wall with the comment info
				$sql = "UPDATE #__community_wall SET `comment`=".$db->Quote($content). " WHERE id =" . $db->Quote($wallid);
				$db->setQuery($sql);
				$db->query();
				if($db->getErrorNum())
				{
					JError::raiseError( 500, $db->stderr());
				}
				
				$response->addScriptCall('jQuery(\'#'.$parentWallId.'\').children().get('.$commentIndex.').remove();');	
			}
			else 
			{
				$html	= JText::_( 'CC PERMISSION DENIED' );
				$response->addAlert( $html );
			}
			
			return $response;
		}
		
		function onProfileDisplay()
		{
			$mainframe =& JFactory::getApplication();
			
			JPlugin::loadLanguage('plg_walls', JPATH_ADMINISTRATOR);
			
			$document		=& JFactory::getDocument();
			$my				=& CFactory::getUser();
			$config			=& CFactory::getConfig();
			
			// Load libraries
			CFactory::load( 'libraries' , 'wall' );
			CFactory::load( 'helpers' , 'friends' );
			
			$user 			=& CFactory::getActiveProfile();
			
			$friendModel	=& CFactory::getModel('friends');
			$avatarModel 	=& CFactory::getModel('avatar');
			$isMe			= ( ($my->id == $user->id) && ($my->id != 0));
			$isGuest		= ($my->id == 0 ) ? true : false;
			$isConnected	= friendIsConnected( $my->id , $user->id );
	
			CFactory::load( 'helpers' , 'owner' );
			
			$isSuperAdmin	= isCommunityAdmin();
			//$limit		= ((int)$limit <=0)?0:5;
			$limit = JRequest::getVar('limit', 5, 'REQUEST');
			$limitstart = JRequest::getVar('limitstart', 0, 'REQUEST');
					
			if(JRequest::getVar('task', '', 'REQUEST') == 'app'){
				$cache =& JFactory::getCache('plgCommunityWalls_fullview');
			}else{
				$cache =& JFactory::getCache('plgCommunityWalls');
			}
			
			$caching = $this->params->get('cache', 1);		
			if($caching)
			{
				$caching = $mainframe->getCfg('caching');
			}
			
			$cache->setCaching($caching);
			$callback = array('plgCommunityWalls', '_getWallHTML');
			
			$allowPosting = (($isMe) 
				|| (!$config->get('lockprofilewalls')) 
				|| ( $config->get('lockprofilewalls') && $isConnected ) 
				|| ( $isSuperAdmin) )
				&& (! $isGuest );
	
			$allowRemoval = ($isMe || $isSuperAdmin);
			
			$maxchar = $this->params->get('charlimit', 0);			
			if(!empty($maxchar))
			{
				$this->characterLimitScript($maxchar);
			}
			
			$content = $cache->call($callback, $user->id, $limit, $limitstart , $allowPosting , $allowRemoval);
			
			return $content; 			
		}
	
		//function _getWallHTML($userid, $limit, $limitstart , $isMe , $isGuest, $isConnected , $isSuperAdmin)
		function _getWallHTML($userid, $limit, $limitstart , $allowPosting , $allowRemoval)
		{
			$config			=& CFactory::getConfig();
			$html			= '';
			
			$cache_id = JCacheCallback::_makeId(array('plgCommunityWalls', '_getWallHTML'), array($userid, $limit, $limitstart , $allowPosting , $allowRemoval));
			$html .= '	<script type="text/javascript">
							function getCacheId(){
								var cache_id = "'.$cache_id.'";
								return cache_id;
							}
						</script>';
			
			$viewAllLink	= false;
			
			if(JRequest::getVar('task', '', 'REQUEST') != 'app')
			{
				$viewAllLink	= CRoute::_('index.php?option=com_community&view=profile&userid='.$userid.'&task=app&app=walls');
			}
			
			$wallModel		=& CFactory::getModel('wall');		
			if( $allowPosting )
			{
				$wallsinput	= CWallLibrary::getWallInputForm( $userid , 'plugins,walls,ajaxSaveWall' , 'plugins,walls,ajaxRemoveWall', $viewAllLink);
			}else{
				$wallsinput = "";
			}
	
			$contents	= CWallLibrary::getWallContents( 'user' , $userid , $allowRemoval , $limit, $limitstart );
	
			$html.= $wallsinput;
			$html.= '<div id="wallContent" style="display: block; visibility: visible;">';
			
			if ( $contents == '' ) {
				$html .= '
				<div id="wall-empty-container">
					<div class="icon-nopost">
			            <img src="'.JURI::base().'plugins/community/walls/favicon.png" alt="" />
			        </div>
			        <div class="content-nopost">'.
			            JText::_('PLG_WALLS NO WALL POST').'
			        </div>
				</div>';
			}
			else {
				$html .= $contents;
			}
			
			$html.= '</div>';
			
			// Add pagination links, only in full app view
			if(JRequest::getVar('task', '', 'REQUEST') == 'app')
			{
				jimport('joomla.html.pagination');
				$pagination	= new JPagination( $wallModel->getCount($userid, 'user') , $limitstart , $limit );
				$html .= '
				<!-- Pagination -->
				<div style="text-align: center;">
					'.$pagination->getPagesLinks().'
				</div>
				<!-- End Pagination -->';
			}
			
			return $html;
		}
		
		function onAppDisplay()
		{
			ob_start();
			$limit=0;
			$html= $this->onProfileDisplay($limit);
			echo $html;
			
			$content	= ob_get_contents();
			ob_end_clean(); 
		
			return $content;
			
		}
		
		function characterLimitScript($maxchar)
		{
			$text_char_remain	= JText::_('PLG_WALLS CHAR REMAIN');
			$text_trimming 		= JText::_('PLG_WALLS TRIMMING');
			
			$js=<<<SHOWJS
				(function(jQuery) {
					jQuery.fn.textlimit=function(counter_el, thelimit, speed) {
						var charDelSpeed = speed || 15;
						var toggleCharDel = speed != -1;
						var toggleTrim = true;
						var that = this[0];
						var isCtrl = false; 
						updateCounter();
						
						function updateCounter(){
							if(typeof that == "object")
								jQuery('#'+counter_el).text(thelimit - that.value.length+" $text_char_remain");
						};
						
						this.keydown (function(e){ 
							if(e.which == 17) isCtrl = true;
							var ctrl_a = (e.which == 65 && isCtrl == true) ? true : false; // detect and allow CTRL + A selects all.
							var ctrl_v = (e.which == 86 && isCtrl == true) ? true : false; // detect and allow CTRL + V paste.
							// 8 is 'backspace' and 46 is 'delete'
							if( this.value.length >= thelimit && e.which != '8' && e.which != '46' && ctrl_a == false && ctrl_v == false)
								e.preventDefault();
						})
						.keyup (function(e){
							updateCounter();
							if(e.which == 17)
								isCtrl=false;
				
							if( this.value.length >= thelimit && toggleTrim ){
								if(toggleCharDel){
									// first, trim the text a bit so the char trimming won't take forever
									// Also check if there are more than 10 extra chars, then trim. just in case.
									if ( (this.value.length - thelimit) > 10 )
										that.value = that.value.substr(0,thelimit+100);
									var init = setInterval
										( 
											function(){ 
												if( that.value.length <= thelimit ){
													init = clearInterval(init); updateCounter() 
												}
												else{
													// deleting extra chars (one by one)
													that.value = that.value.substring(0,that.value.length-1); jQuery('#'+counter_el).text('$text_trimming '+(thelimit - that.value.length));
												}
											} ,charDelSpeed 
										);
								}
								else this.value = that.value.substr(0,thelimit);
							}
						});
						
					};
				})(jQuery);
				
				jQuery(document).ready(function(){
					//jQuery("#wall-message-counter").show();
					jQuery("#wall-message").textlimit('wall-message-counter', $maxchar, -1);
				});
SHOWJS;
			$document =& JFactory::getDocument();
			$document->addScriptDeclaration($js);
		}
	}	
}


