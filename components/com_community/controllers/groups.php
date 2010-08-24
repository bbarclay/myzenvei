<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 */
class CommunityGroupsController extends CommunityBaseController
{
    function ajaxRemoveFeatured( $groupId )
    {
    	$objResponse	= new JAXResponse();
    	CFactory::load( 'helpers' , 'owner' );
		
		if( isCommunityAdmin() )
    	{
			$model	=& CFactory::getModel('Featured');

    		CFactory::load( 'libraries' , 'featured' );
    		$featured	= new CFeatured(FEATURED_GROUPS);
    		$my			= CFactory::getUser();
    		
    		if($featured->delete($groupId))
    		{
    			$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC GROUP REMOVED FROM FEATURED'));	
			}
			else
			{
				$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC ERROR REMOVING GROUP FROM FEATURED'));
			}
		}
		else
		{
			$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC NOT ALLOWED TO ACCESS SECTION'));
		}
		$buttons   = '<input type="button" class="button" onclick="window.location.reload();" value="' . JText::_('CC BUTTON CLOSE') . '"/>';
		
		$objResponse->addScriptCall( 'cWindowActions' , $buttons );
		return $objResponse->sendResponse();
	}
	
    function ajaxAddFeatured( $groupId )
    {
    	$objResponse	= new JAXResponse();
    	CFactory::load( 'helpers' , 'owner' );
		
		if( isCommunityAdmin() )
    	{
			$model	=& CFactory::getModel('Featured');
			
			if( !$model->isExists( FEATURED_GROUPS , $groupId ) )
			{
	    		CFactory::load( 'libraries' , 'featured' );
	    		CFactory::load( 'models', 'groups' );
	    		
	    		$featured	= new CFeatured( FEATURED_GROUPS );
	    		$table		=& JTable::getInstance( 'Group' , 'CTable' );
	    		$table->load( $groupId );
	    		$my			= CFactory::getUser();
	    		$featured->add( $groupId , $my->id );
				$objResponse->addAssign('cWindowContent', 'innerHTML', JText::sprintf('CC GROUP IS FEATURED', $table->name ));
			}
			else
			{
				$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC GROUP ALREADY FEATURED'));
			}
		}
		else
		{
			$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC NOT ALLOWED TO ACCESS SECTION'));
		}
		$buttons   = '<input type="button" class="button" onclick="window.location.reload();" value="' . JText::_('CC BUTTON CLOSE') . '"/>';
		
		$objResponse->addScriptCall( 'cWindowActions' , $buttons );
		return $objResponse->sendResponse();
	}
	
	/**
	 * Method is called from the reporting library. Function calls should be
	 * registered here.
	 *
	 * return	String	Message that will be displayed to user upon submission.
	 **/	 	 	
	function reportDiscussion( $link, $message , $discussionId )
	{
		CFactory::load( 'libraries' , 'reporting' );
		$report = new CReportingLibrary();
		
		$report->createReport( JText::_('CC INVALID DISCUSSION') , $link , $message );

		$action					= new stdClass();
		$action->label			= 'Remove discussion';
		$action->method			= 'groups,removeDiscussion';
		$action->parameters		= $discussionId;
		$action->defaultAction	= true;
		
		$report->addActions( array( $action ) );
		
		return JText::_('CC REPORT SUBMITTED');
	}
	
	function removeDiscussion( $discussionId )
	{
		$model		=& CFactory::getModel('groups');
		$my			= CFactory::getUser();
		
		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		CFactory::load( 'models' , 'discussions' );
		$discussion	=& JTable::getInstance( 'Discussion' , 'CTable' );
		
		$discussion->load( $discussionId );
		$discussion->delete();
		$model->substractDiscussCount( $discussion->groupid );
		
		return JText::_('CC DISCUSSION REMOVED');
	}
	
	/**
	 * Method is called from the reporting library. Function calls should be
	 * registered here.
	 *
	 * return	String	Message that will be displayed to user upon submission.
	 **/	 	 	
	function reportGroup( $link, $message , $groupId )
	{
		CFactory::load( 'libraries' , 'reporting' );
		$report = new CReportingLibrary();
		
		$report->createReport( JText::_('Bad group') , $link , $message );

		$action					= new stdClass();
		$action->label			= 'Unpublish group';
		$action->method			= 'groups,unpublishGroup';
		$action->parameters		= $groupId;
		$action->defaultAction	= true;
		
		$report->addActions( array( $action ) );
		
		return JText::_('CC REPORT SUBMITTED');
	}
	
	function unpublishGroup( $groupId )
	{	
		CFactory::load( 'models' , 'groups' );
		
		$group	=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		$group->published	= '0';
		$group->store();
		
		return JText::_('CC GROUP IS UNPUBLISHED');
	}
	
	/**
	 * Displays the default groups view
	 **/
	function display()
	{
		$config	=& CFactory::getConfig();

		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}
		$my			=& JFactory::getUser();
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType);

 		echo $view->get( __FUNCTION__ );
	}

	/**
	 * Full application view
	 */
	function app()
	{
		$view	=& $this->getView('groups');

		echo $view->get( 'appFullView' );
	}

	/**
	 * Full application view for discussion
	 */
	function discussApp()
	{
		$view	=& $this->getView('groups');

		echo $view->get( 'discussAppFullView' );
	}

	/**
	 *  Ajax function to unpublish a group
	 *
	 * @param	$groupId	The specific group id to unpublish
	 **/
	function ajaxUnpublishGroup( $groupId )
	{
		$response	= new JAXResponse();

		CFactory::load( 'helpers' , 'owner' );

		if( !isCommunityAdmin() )
		{
			$response->addScriptCall( 'alert' , JText::_('CC NOT ALLOWED TO UNPUBLISH GROUP'));
		}
		else
		{
			CFactory::load( 'models' , 'groups' );

			$group	=& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $groupId );

			if( $group->id == 0 )
			{
				$response->addScriptCall( 'alert' , JText::_('CC INVALID GROUP ID'));
			}
			else
			{
				$group->published	= 0;

				if( $group->store() )
				{
					$html	= '<div class=\"warning\">' . JText::_('CC GROUP UNPUBLISHED') . '</div>';
					$response->addScriptCall('jQuery("#community-wrap .group .warning").remove();');
					$response->addScriptCall('jQuery("' . $html . '").prependTo("#community-wrap .group");');
					$response->addScriptCall('jQuery("#community-wrap .group").css("border","3px solid red");');

					//trigger for onGroupDisable
					$this->triggerGroupEvents( 'onGroupDisable' , $group);
				}
				else
				{
					$response->addScriptCall( 'alert' , JText::_('CC ERROR WHILE SAVING GROUP') );
				}
			}
		}

		return $response->sendResponse();
	}

	/**
	 *  Ajax function to delete a group
	 *
	 * @param	$groupId	The specific group id to unpublish
	 **/
	function ajaxDeleteGroup( $groupId, $step=1 )
	{
		$response	= new JAXResponse();

		CFactory::load( 'libraries' , 'activities' );
		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'models' , 'groups' );
		
		$group	=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		$groupModel		=& CFactory::getModel( 'groups' );		
		$membersCount	= $groupModel->getMembersCount($groupId);	
		$my				= CFactory::getUser();
		$isMine			= ($my->id == $group->ownerid);		
		
		if( !isCommunityAdmin() && !($isMine && $membersCount<=1))
		{
			$content = JText::_('CC NOT ALLOWED TO DELETE GROUP');
			$buttons  = '<input type="button" class="button" onclick="cWindowHide();" value="' . JText::_('CC CANCEL') . '"/>';
			$response->addScriptCall('cWindowResize', 100);
			$response->addAssign('cWindowContent', 'innerHTML' , $content);
			$response->addScriptCall('cWindowActions', $buttons);
		}
		else
		{
			$response->addScriptCall('cWindowResize', 160);
			
			$doneMessage	= ' - <span class=\'success\'>'.JText::_('CC DONE').'</span><br />';
			$failedMessage	= ' - <span class=\'failed\'>'.JText::_('CC FAILED').'</span><br />';
			
			switch($step)
			{
				case 1:
					// Nothing gets deleted yet. Just show a messge to the next step					
					if( empty($groupId) )
					{
						$content = JText::_('CC INVALID GROUP ID');
					}
					else
					{
						$content	= '<strong>' . JText::sprintf( 'CC DELETING GROUP' , $group->name ) . '</strong><br/>';
						$content .= JText::_('CC DELETING GROUP BULLETIN');
						
						$response->addScriptCall('jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 2);' );
						
						//trigger for onBeforeGroupDelete			
						$this->triggerGroupEvents( 'onBeforeGroupDelete' , $group);
					}
					$response->addAssign('cWindowContent', 'innerHTML' , $content);
					break;
				case 2:
					// Delete all group bulletins
					if(CommunityModelGroups::deleteGroupBulletins($groupId))
					{
						$content = $doneMessage;
					}
					else
					{
						$content = $failedMessage;
					}
					$content .= JText::_('CC DELETING GROUP MEMBERS');
					$response->addScriptCall('jQuery("#cWindowContent").append("' . $content . '");' );
					$response->addScriptCall('jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 3);' );			
					break;
				case 3:
					// Delete all group members
					if(CommunityModelGroups::deleteGroupMembers($groupId))
					{	
						$content = $doneMessage;
					}
					else
					{
						$content = $failedMessage;
					}
					$content .= JText::_('CC DELETING GROUP WALLS'); 
					$response->addScriptCall('jQuery("#cWindowContent").append("' . $content . '");' );
					$response->addScriptCall('jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 4);' );			
					break;
				case 4:
					// Delete all group wall
					if(CommunityModelGroups::deleteGroupWall($groupId))
					{
						$content = $doneMessage;
					}
					else
					{
						$content = $failedMessage;
					}
					$content .= JText::_('CC DELETING GROUP DISCUSSIONS');
					$response->addScriptCall('jQuery("#cWindowContent").append("' . $content . '");' );
					$response->addScriptCall('jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 5);' );			
					break;
				case 5:
					// Delete all group discussions
					if(CommunityModelGroups::deleteGroupDiscussions($groupId))
					{
						$content = $doneMessage;
					}
					else
					{
						$content = $failedMessage;
					}
					$content .= JText::_('CC DELETING GROUP MEDIA');
					$response->addScriptCall('jQuery("#cWindowContent").append("' . $content . '");' );
					$response->addScriptCall('jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 6);' );			
					break;
				case 6:
					// Delete all group's media files
					if(CommunityModelGroups::deleteGroupMedia($groupId))
					{
						$content = $doneMessage;
					}
					else
					{
						$content = $failedMessage;
					}
					$response->addScriptCall('jQuery("#cWindowContent").append("' . $content . '");' );
					$response->addScriptCall('jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 7);' );			
					break;					
					
				case 7:
					// Delete group
					$group	=& JTable::getInstance( 'Group' , 'CTable' );
					$group->load( $groupId );
					$groupData = $group;
					
					if( $group->delete( $groupId ) )
					{
						CFactory::load( 'libraries' , 'featured' );
			    		$featured	= new CFeatured(FEATURED_GROUPS);
			    		$featured->delete($groupId);
						
						jimport( 'joomla.filesystem.file' );			
						if($groupData->avatar != "components/com_community/assets/group.jpg")
						{
							//images/avatar/groups/d203ccc8be817ad5b6a8335c.png
							$path = explode('/', $groupData->avatar);
							$file = JPATH_ROOT . DS . $path[0] . DS . $path[1] . DS . $path[2] .DS . $path[3];
							if(file_exists($file))
							{
								JFile::delete($file);
							}
						}
						
						if($groupData->thumb != "components/com_community/assets/group_thumb.jpg")
						{
							//images/avatar/groups/thumb_d203ccc8be817ad5b6a8335c.png
							$path = explode('/', $groupData->thumb);
							$file = JPATH_ROOT . DS . $path[0] . DS . $path[1] . DS . $path[2] .DS . $path[3];
							if(file_exists($file))
							{
								JFile::delete($file);
							}
						}						
						
						$html	= '<div class=\"info\" style=\"display: none;\">' . JText::_('CC GROUP DELETED') . '</div>';
						$response->addScriptCall('jQuery("' . $html . '").prependTo("#community-wrap").fadeIn();');
						$response->addScriptCall('jQuery("#community-groups-wrap").fadeOut();');
												
						$content = JText::_('CC GROUP DELETED');						
					
						//trigger for onGroupDelete			
						$this->triggerGroupEvents( 'onAfterGroupDelete' , $groupData);
						 
						// Remove from activity stream
						CActivityStream::remove('groups', $groupId);
					}
					else
					{
						$content = JText::_('CC ERROR WHILE DELETING GROUP');
					}
					$redirect = CRoute::_(JURI::root().'index.php?option=com_community&view=groups');	
					$buttons  = '<input type="button" class="button" id="groupDeleteDone" onclick="cWindowHide(); window.location=\''.$redirect.'\';" value="' . JText::_('Done') . '"/>';
															
					$response->addAssign('cWindowContent', 'innerHTML' , $content);
					$response->addScriptCall('cWindowActions', $buttons);
					$response->addScriptCall('cWindowResize', 100);
					break;
				default:
					break;
			}
		}
		
		return $response->sendResponse();
	}
	
	/**
	 *  Ajax function to prompt warning during group deletion
	 *
	 * @param	$groupId	The specific group id to unpublish
	 **/
	function ajaxWarnGroupDeletion( $groupId )
	{
		$response	= new JAXResponse();
		
		$title      = JText::_('CC DELETE GROUP');
		$content 	= JText::_('CC GROUP DELETION WARNING');
		$buttons	= '<input type="button" class="button" onclick="jax.call(\'community\', \'groups,ajaxDeleteGroup\', \''.$groupId.'\', 1);" value="' . JText::_('CC DELETE') . '"/>';
		$buttons   .= '<input type="button" class="button" onclick="cWindowHide();" value="' . JText::_('CC BUTTON CANCEL') . '"/>';
		
		$response->addAssign('cWindowContent', 'innerHTML' , $content);
		$response->addScriptCall( 'cWindowActions' , $buttons );
		$response->addAssign('cwin_logo', 'innerHTML', $title);

		return $response->sendResponse();
	}

	/**
	 * Ajax function to remove a reply from the discussions
	 *
	 * @params $discussId	An string that determines the discussion id
	 **/
	function ajaxRemoveReply( $wallId )
	{
		CError::assert($wallId , '', '!empty', __FILE__ , __LINE__ );

		$response	= new JAXResponse();
		
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}

		//@rule: Check if user is really allowed to remove the current wall
		$my			= CFactory::getUser();
		$model		=& $this->getModel( 'wall' );
		$wall		= $model->get( $wallId );
		CFactory::load( 'models' , 'discussions' );
		
		$discussion	=& JTable::getInstance( 'Discussion' , 'CTable' );
		$discussion->load( $wall->contentid );
		
		$groupModel	=& CFactory::getModel( 'groups' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $discussion->groupid );
		
		CFactory::load( 'helpers' , 'owner' );

		if( !isCommunityAdmin() && !$groupModel->isAdmin( $my->id , $group->id ) )
		{
			$response->addScriptCall( 'alert' , JText::_('CC NOT ALLOWED TO REMOVE WALL') );
		}
		else
		{
			if( !$model->deletePost( $wallId ) )
			{
				$response->addAlert( JText::_('CC CANNOT REMOVE WALL') );
			} 
			else
			{
				//add user points
				if($wall->post_by != 0)
				{
					CFactory::load( 'libraries' , 'userpoints' );		
					CUserPoints::assignPoint('wall.remove', $wall->posted_by);
				}				
			}
		}

		return $response->sendResponse();
	}

	/**
	 * Ajax function to display the remove bulletin information
	 **/
	function ajaxShowRemoveBulletin( $groupid , $bulletinId )
	{
		$response	= new JAXResponse();

		ob_start();
?>
		<div id="community-groups-join">
			<p>
				<?php echo JText::_('CC REMOVE GROUP BULLETIN QUESTION');?>
			</p>
		</div>
<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$buttons	= '<form method="post" action="' . CRoute::_('index.php?option=com_community&view=groups&task=deleteBulletin') . '">';
		$buttons	.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" name="Submit"/>';
		$buttons	.= '<input type="hidden" value="' . $groupid . '" name="groupid" />';
		$buttons	.= '<input type="hidden" value="' . $bulletinId . '" name="bulletinid" />';
		$buttons	.= '&nbsp;';
		$buttons	.= '<input onclick="cWindowHide();return false" type="button" value="' . JText::_('CC BUTTON NO') . '" class="button" name="Submit"/>';
		$buttons	.= '</form>';

		$response->addAssign('cWindowContent' , 'innerHTML' , $contents);
		$response->addScriptCall('cWindowActions', $buttons);

		return $response->sendResponse();
	}

	/**
	 * Ajax function to display the remove discussion information
	 **/
	function ajaxShowRemoveDiscussion( $groupid , $topicid )
	{
		$response	= new JAXResponse();

		ob_start();
?>
		<div id="community-groups-join">
			<p>
				<?php echo JText::_('CC REMOVE GROUP DISCUSSION QUESTION');?>
			</p>
		</div>
<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$buttons	= '<form method="post" action="' . CRoute::_('index.php?option=com_community&view=groups&task=deleteTopic') . '">';
		$buttons	.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" name="Submit"/>';
		$buttons	.= '<input type="hidden" value="' . $groupid . '" name="groupid" />';
		$buttons	.= '<input type="hidden" value="' . $topicid . '" name="topicid" />';
		$buttons	.= '&nbsp;';
		$buttons	.= '<input onclick="cWindowHide();return false" type="button" value="' . JText::_('CC BUTTON NO') . '" class="button" name="Submit"/>';
		$buttons	.= '</form>';

		$response->addAssign('cWindowContent' , 'innerHTML' , $contents);
		$response->addScriptCall('cWindowActions', $buttons);

		return $response->sendResponse();
	}

	/**
	 * Ajax function to approve a specific member
	 *
	 * @params	string	id	The member's id that needs to be approved.
	 * @params	string	groupid	The group id that the user is in.
	 **/
	function ajaxApproveMember( $memberId , $groupId )
	{
		$response	= new JAXResponse();

		$my			= CFactory::getUser();
		$model		= $this->getModel( 'groups' );

		CFactory::load( 'helpers' , 'owner' );

		if( !$model->isAdmin( $my->id , $groupId ) && !isCommunityAdmin() )
		{
			$response->addScriptCall( JText::_('CC NOT ALLOWED TO ACCESS SECTION') );
		}
		else
		{
			// Load required tables
			$member		=& JTable::getInstance( 'GroupMembers' , 'CTable' );
			$group		=& JTable::getInstance( 'Group' , 'CTable' );

			// Load the group and the members table
			$group->load( $groupId );
			$member->load( $memberId , $groupId );
			$member->approve();

			// Update the members count
			$model->addMembersCount( $group->id );

			// Build the URL.
			$url	= CUrl::build( 'groups' , 'viewgroup' , array( 'groupid' => $group->id ) , true );

			$act = new stdClass();
			$act->cmd 		= 'group.join';
			$act->actor   	= $memberId;
			$act->target  	= 0;
			$act->title	  	= JText::sprintf('CC ACTIVITIES MEMBER JOIN GROUP' , $url , $group->name );
			$act->content	= '';
			$act->app		= 'groups';
			$act->cid		= $group->id;

			// Add activity logging
			CFactory::load ( 'libraries', 'activities' );
			CActivityStream::add( $act );
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('group.join', $memberId);			

			$response->addScriptCall('jQuery("#member_' . $memberId . '").css("border","3px solid blue");');
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC MEMBER APPROVED') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","info");');
			
			//trigger for onGroupJoinApproved
			$this->triggerGroupEvents( 'onGroupJoinApproved' , $group , $memberId);			
		}
		return $response->sendResponse();
	}

	/**
	 * Ajax method to remove specific member
	 *
	 * @params	string	id	The member's id that needs to be approved.
	 * @params	string	groupid	The group id that the user is in.
	 **/
	function ajaxRemoveMember( $memberId , $groupId )
	{
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}

		$response	= new JAXResponse();

		$model		=& $this->getModel( 'groups' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );

		$my			= CFactory::getUser();
		
		CFactory::load( 'helpers' , 'owner' );
		
		if( $group->ownerid != $my->id || !isCommunityAdmin() )
		{
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC PERMISSION DENIED') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","error");');			
		}
		
		if( $group->ownerid == $memberId )
		{
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC YOU ARE NOT ALLOWED TO REMOVE YOURSELF') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","error");');
		}
		else
		{
			$groupMember	=& JTable::getInstance( 'GroupMembers' , 'CTable' );
			$groupMember->load( $memberId , $groupId );

			$data		= new stdClass();

			$data->groupid	= $groupId;
			$data->memberid	= $memberId;

			$model->removeMember($data);
			
			// Test if user is already approved before substracting the count.
			if( $groupMember->approved == '1' )
			{
				$model->substractMembersCount( $groupId );
			}
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('group.member.remove', $memberId);			
			
			$response->addScriptCall('jQuery("#member_' . $memberId . '").css("border","3px solid red");');
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC GROUP MEMBER REMOVED') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","info");');
			
			//trigger for onGroupLeave
			$this->triggerGroupEvents( 'onGroupLeave' , $group , $memberId);
		}

		return $response->sendResponse();
	}

	/**
	 * Ajax method to display HTML codes to leave group
	 *
	 * @params	string	id	The member's id that needs to be approved.
	 * @params	string	groupid	The group id that the user is in.
	 **/
	function ajaxShowLeaveGroup( $groupId )
	{
		$response	= new JAXResponse();

		$model		=& $this->getModel( 'groups' );
		$my			=& JFactory::getUser();

		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );

		ob_start();
?>
		<div id="community-groups-join">
			<p><?php echo JText::_('CC CONFIRM LEAVE GROUP');?> <strong><?php echo $group->name; ?></strong>?</p>
		</div>
<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$buttons	= '<form method="post" action="' . CRoute::_('index.php?option=com_community&view=groups&task=leavegroup') . '">';
		$buttons	.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" name="Submit"/>';
		$buttons	.= '<input type="hidden" value="' . $groupId . '" name="groupid" />';
		$buttons	.= '<input onclick="cWindowHide();return false" type="button" value="' . JText::_('CC BUTTON NO') . '" class="button" name="Submit"/>';
		$buttons	.= '</form>';

		// Change cWindow title
		$response->addAssign('cwin_logo', 'innerHTML', JText::_('CC LEAVE GROUP TITLE'));
		$response->addAssign('cWindowContent' , 'innerHTML' , $contents);
		$response->addScriptCall('cWindowActions', $buttons);
		return $response->sendResponse();
	}

	/**
	 * Ajax function to display the join group
	 *
	 * @params $groupid	A string that determines the group id
	 **/
	function ajaxShowJoinGroup( $groupId , $redirectUrl)
	{
		if (!isRegisteredUser()) 
		{
			return $this->ajaxBlockUnregister();
		}

		$response	= new JAXResponse();

		$model		=& $this->getModel( 'groups' );
		$my			= CFactory::getUser();
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );

		$members	= $model->getMembersId( $groupId );

		ob_start();
		?>
		<div id="community-groups-join">
			<?php if( in_array( $my->id , $members ) ): ?>
			<?php
			$buttons	= '<input onclick="cWindowHide();" type="submit" value="' . JText::_('CC BUTTON CLOSE') . '" class="button" name="Submit"/>';
			?>
				<p><?php echo JText::_('CC ALREADY MEMBER OF GROUP'); ?></p>
			<?php else: ?>
			<?php
			$buttons	= '<form method="post" action="' . CRoute::_('index.php?option=com_community&view=groups&task=joingroup') . '">';
			$buttons	.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" name="Submit"/>';
			$buttons	.= '<input type="hidden" value="' . $groupId . '" name="groupid" />';
			$buttons	.= '<input onclick="cWindowHide();" type="button" value="' . JText::_('CC BUTTON NO') . '" class="button" name="Submit" />';
			$buttons	.= '</form>';
			?>
				<p>
					<?php echo JText::sprintf('CC CONFIRM JOIN GROUP', $group->name );?>
				</p>
			<?php endif; ?>
		</div>
		<?php

		$contents	= ob_get_contents();
		ob_end_clean();

		// Change cWindow title
		$response->addAssign('cwin_logo', 'innerHTML', JText::_('CC JOIN GROUP TITLE'));

		$response->addAssign('cWindowContent' , 'innerHTML' , $contents);
		$response->addScriptCall('cWindowActions', $buttons);
		return $response->sendResponse();
	}

	/**
	 * Ajax Method to remove specific wall from the specific group
	 *
	 * @param wallId	The unique wall id that needs to be removed.
	 * @todo: check for permission
	 **/
	function ajaxRemoveWall( $wallId )
	{
		CError::assert($wallId , '', '!empty', __FILE__ , __LINE__ );

		$response	= new JAXResponse();
		
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}

		//@rule: Check if user is really allowed to remove the current wall
		$my			= CFactory::getUser();
		$model		=& $this->getModel( 'wall' );
		$wall		= $model->get( $wallId );
		
		$groupModel	=& CFactory::getModel( 'groups' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $wall->contentid );
		
		CFactory::load( 'helpers' , 'owner' );

		if( !isCommunityAdmin() && !$groupModel->isAdmin( $my->id , $group->id ) )
		{
			$response->addScriptCall( 'alert' , JText::_('CC NOT ALLOWED TO REMOVE WALL') );
		}
		else
		{
			if( !$model->deletePost( $wallId ) )
			{
				$response->addAlert( JText::_('CC CANNOT REMOVE WALL') );
			}
			else
			{
				if($wall->post_by != 0)
				{
					//add user points
					CFactory::load( 'libraries' , 'userpoints' );		
					CUserPoints::assignPoint('wall.remove', $wall->post_by);
				}			
			}
	
			// Substract the count
			$groupModel->substractWallCount( $wall->contentid );
		}

		return $response->sendResponse();
	}

	/**
	 * Ajax function to add new admin to the group
	 *
	 * @param memberid	Members id
	 * @param groupid	Groupid
	 *
	 **/
	function ajaxRemoveAdmin( $memberId , $groupId )
	{
		$response	= new JAXResponse();
		
		$my			= CFactory::getUser();

		$model		=& $this->getModel( 'groups' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		CFactory::load( 'helpers' , 'owner' );
		
		if( $group->ownerid != $my->id && !isCommunityAdmin() )
		{
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC PERMISSION DENIED') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","error");');			
		}
		else
		{
			$member		=& JTable::getInstance( 'GroupMembers' , 'CTable' );

			$member->load( $memberId , $group->id );
			$member->permissions	= 0;
	
			$member->store();
	
			$response->addScriptCall('jQuery("#member_' . $memberId . '").css("border","3px solid blue");');
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC MEMBER MADE USER') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","info");');
		}
		
		return $response->sendResponse();
	}
	
	/**
	 * Ajax function to add new admin to the group
	 *
	 * @param memberid	Members id
	 * @param groupid	Groupid
	 *
	 **/
	function ajaxAddAdmin( $memberId , $groupId )
	{
		$response	= new JAXResponse();
		
		$my			= CFactory::getUser();

		$model		=& $this->getModel( 'groups' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		CFactory::load( 'helpers' , 'owner' );
		
		
		
		if( $group->ownerid != $my->id && !isCommunityAdmin() )
		{
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC PERMISSION DENIED') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","error");');			
		}
		else
		{
			$member		=& JTable::getInstance( 'GroupMembers' , 'CTable' );

			$member->load( $memberId , $group->id );
			$member->permissions	= 1;
	
			$member->store();
	
			$response->addScriptCall('jQuery("#member_' . $memberId . '").css("border","3px solid green");');
			$response->addScriptCall('jQuery("#notice").html("' . JText::_('CC MEMBER MADE ADMIN') . '");');
			$response->addScriptCall('jQuery("#notice").attr("class","info");');
		}
		
		return $response->sendResponse();
	}
	
	/**
	 * Ajax function to save a new wall entry
	 *
	 * @param message	A message that is submitted by the user
	 * @param uniqueId	The unique id for this group
	 *
	 **/
	function ajaxSaveDiscussionWall( $message , $uniqueId )
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}

		$response		= new JAXResponse();

		$my				= CFactory::getUser();

		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'models' , 'discussions' );
		CFactory::load( 'helpers' , 'url' );
		CFactory::load( 'libraries', 'activities' );
		CFactory::load( 'libraries', 'wall' );

		// Load models
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$discussion		=& JTable::getInstance( 'Discussion' , 'CTable' );

		$discussion->load( $uniqueId );
		$group->load( $discussion->groupid );

		// If the content is false, the message might be empty.
		if( empty( $message) )
		{
			$response->addAlert( JText::_('CC EMPTY MESSAGE') );
		}
		else
		{
			// Save the wall content
			$wall		= CWallLibrary::saveWall( $uniqueId , $message , 'discussions' , $my , ($my->id == $discussion->creator) );

			$date			=& JFactory::getDate();
			
			$discussion->lastreplied	= $date->toMySQL();
			
			$discussion->store();

			// @rule: only add the activities of the wall if the group is not private.
			if( $group->approvals == COMMUNITY_PUBLIC_GROUP )
			{
				// Build the URL
				$discussURL		= CUrl::build( 'groups' , 'viewdiscussion', array( 'groupid' => $discussion->groupid , 'topicid' => $discussion->id) , true );
	
				$act = new stdClass();
				$act->cmd 		= 'group.discussion.reply';
				$act->actor 	= $my->id;
				$act->target 	= 0;
				$act->title		= JText::sprintf('CC ACTIVITIES REPLY DISCUSSION' , $discussURL, $discussion->title );
				$act->content	= $message;
				$act->app		= 'groups';
				$act->cid		= $group->id;
				// Add activity log
				CActivityStream::add( $act );
			}
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('group.discussion.reply');			

			$response->addScriptCall( 'joms.walls.insert' , $wall->content );
		}

		return $response->sendResponse();
	}


	/**
	 * Ajax function to save a new wall entry
	 *
	 * @param message	A message that is submitted by the user
	 * @param uniqueId	The unique id for this group
	 *
	 **/
	function ajaxSaveWall( $message , $uniqueId )
	{
		$response		= new JAXResponse();
		$my				= CFactory::getUser();

		// Load necessary libraries
		CFactory::load( 'libraries' , 'wall' );
		CFactory::load( 'helpers' , 'url' );
		CFactory::load ( 'libraries', 'activities' );

		$groupModel		=& CFactory::getModel( 'groups' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $uniqueId );

		// If the content is false, the message might be empty.
		if( empty( $message) )
		{
			$response->addAlert( JText::_('CC EMPTY MESSAGE') );
		}
		else
		{
			$isAdmin		= $groupModel->isAdmin( $my->id , $group->id );
			// Save the wall content
			$wall			= CWallLibrary::saveWall( $uniqueId , $message , 'groups' , $my , $isAdmin );
			$groupModel->addWallCount( $uniqueId );

			// @rule: only add the activities of the wall if the group is not private.
			if( $group->approvals == COMMUNITY_PUBLIC_GROUP )
			{
				// Build the URL
				$url			= CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $uniqueId , true );
	
				$act = new stdClass();
				$act->cmd 		= 'group.wall.create';
				$act->actor 	= $my->id;
				$act->target 	= 0;
				$act->title		= JText::sprintf('CC ACTIVITIES WALL POST GROUP' , $url , $group->name );
				$act->content	= $message;
				$act->app		= 'groups';
				$act->cid		= $uniqueId;
				CActivityStream::add( $act );
			}
			
			// @rule: Add user points
			CFactory::load( 'libraries' , 'userpoints' );
			CUserPoints::assignPoint('group.wall.create');

			$response->addScriptCall( 'joms.walls.insert' , $wall->content );
		}

		return $response->sendResponse();
	}

	function edit()
	{
		$document	=& JFactory::getDocument();
		$viewType	= $document->getType();
		$viewName	= JRequest::getCmd( 'view' , $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType );
		$mainframe	=& JFactory::getApplication();
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$model		=& $this->getModel( 'groups' );
		$my			= CFactory::getUser();
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		CFactory::load( 'helpers' , 'owner' );

		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		if( !$group->isAdmin($my->id) && !isCommunityAdmin() )
		{
			echo JText::_('CC ACCESS FORBIDDEN');
			return;
		}
		
		if( JRequest::getMethod() == 'POST' )
		{
			$data		= JRequest::get( 'POST' );
			$group->bind( $data );
			
			$redirect	= CRoute::_('index.php?option=com_community&view=groups&task=edit&groupid=' . $groupId , false );

			$removeActivity		= JRequest::getVar( 'removeactivities' , false , 'POST' );
			
			if( $removeActivity )
			{
				$activityModel	=& CFactory::getModel( 'activities' );
				
				$activityModel->removeActivity( 'groups' , $group->id );
			}
			
			// validate all fields
			if( empty($group->name ))
			{
				$mainframe->redirect( $redirect , JText::_('CC GROUP NAME CANNOT BE EMPTY') );
				return;
			}
	
			if( $model->groupExist($group->name, $group->id) )
			{
				$mainframe->redirect( $redirect , JText::_('CC GROUP NAME TAKEN') );
				return;
			}
	
			if( empty($group->description ))
			{
				$mainframe->redirect( $redirect , JText::_('CC GROUP DESCRIPTION CANNOT BE EMPTY') );
				return;
			}
			
			// @rule: Retrieve params and store it back as raw string
			$params	= new JParameter('');
			
			$discussordering			= JRequest::getVar( 'discussordering' , DISCUSSION_ORDER_BYLASTACTIVITY , 'REQUEST' );
			$params->set('discussordering' , $discussordering );
			
			$photopermission			= JRequest::getVar( 'photopermission' , GROUP_PHOTO_PERMISSION_ADMINS , 'REQUEST' );
			$params->set('photopermission' , $photopermission );
			
			$videopermission			= JRequest::getVar( 'videopermission' , GROUP_PHOTO_PERMISSION_ADMINS , 'REQUEST' );
			$params->set('videopermission' , $videopermission );
			
			$grouprecentphotos			= JRequest::getVar( 'grouprecentphotos' , GROUP_PHOTO_RECENT_LIMIT , 'REQUEST' );
			$params->set('grouprecentphotos' , $grouprecentphotos );
			
			$grouprecentvideos			= JRequest::getVar( 'grouprecentvideos' , GROUP_VIDEO_RECENT_LIMIT , 'REQUEST' );
			$params->set('grouprecentvideos' , $grouprecentvideos );
			
			$newmembernotification		= JRequest::getVar( 'newmembernotification' , '1' , 'REQUEST' );
			$params->set('newmembernotification' , $newmembernotification );
			
			$joinrequestnotification	= JRequest::getVar( 'joinrequestnotification' , '1' , 'REQUEST' );
			$params->set('joinrequestnotification' , $joinrequestnotification );
			
			$group->params		= $params->toString();
			
			CFactory::load('helpers' , 'owner' );
			
			if( $model->isAdmin($my->id, $group->id) || isCommunityAdmin() )
			{
				
				$group->store();
				// Add logging.
				$url				= cGroupLink($group->id);
	
				$act = new stdClass();
				$act->cmd 		= 'group.updated';
				$act->actor   	= $my->id;
				$act->target  	= 0;
				$act->title	  	= JText::sprintf('CC ACTIVITIES GROUP UPDATED' , $url , $group->name );
				$act->content	= '';
				$act->app		= 'groups';
				$act->cid		= $group->id;
	
				// Add activity logging
				CFactory::load ( 'libraries', 'activities' );
				CActivityStream::add( $act );
				
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('group.updated');			
	
				// Reupdate the display.
				$redirect	= CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id , false );
				$mainframe->redirect( $redirect , JText::_('CC GROUP UPDATED') );
				return;
			}
		}
		
		echo $view->get( __FUNCTION__ );
	}
	
	function _saveGroup( $groupId = '' , $data )
	{
		$validated  = true;

	}
	
	/**
	 * Method to display the create group form
	 **/
	function create()
	{
		$my =& JFactory::getUser();
		if($my->id == 0){
			return $this->blockUnregister();
		}

		$config 	=& CFactory::getConfig();
		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}
		
		if( !$config->get('creategroups') )
		{
			echo JText::_('CC GROUPS CREATION DISABLED');
			return;
		}

		CFactory::load('helpers' , 'limits' );						
		if(cExceededGroupCreationLimit($my->id))
		{
			$groupLimit	= $config->get('groupcreatelimit');			
			echo JText::sprintf('CC GROUPS CREATION REACH LIMIT' , $groupLimit);
			return;
		}
		
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view = & $this->getView( $viewName , '' , $viewType);

		$model		=& $this->getModel( 'groups' );
 		$data		= new stdClass(); 		
		$data->categories	=	$model->getCategories();

		if( JRequest::getVar('action', '', 'POST') == 'save')
		{
			$gid = $this->save();
			
			if($gid !== FALSE )
			{
				$mainframe =& JFactory::getApplication();

				$group		=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load($gid);
				
				//trigger for onGroupCreate
				$this->triggerGroupEvents( 'onGroupCreate' , $group);
				
				$url = CRoute::_( 'index.php?option=com_community&view=groups&task=created&groupid='.$gid , false );
				$mainframe->redirect( $url , JText::sprintf('CC GROUP CREATED NOTICE', $group->name ));
				return;
			}
		}

		echo $view->get( __FUNCTION__ , $data );
	}

	/**
	 * A new group has been created
	 */
	function created()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		echo $view->get( __FUNCTION__ );
	}

	/**
	 * Method to save the group
	 * @return false if create fail, return the group id if create is successful
	 **/
	function save()
	{
		if( JString::strtoupper(JRequest::getMethod()) != 'POST')
		{
			$view->addWarning( JText::_('CC PERMISSION DENIED'));
			return false;
		}

		$mainframe =& JFactory::getApplication();
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType);

 		// Get my current data.
		$my			= CFactory::getUser();
		$validated	= true;

		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$model		=& $this->getModel( 'groups' );

		$name			= JRequest::getVar('name' , '' , 'POST');
		$description	= JRequest::getVar('description' , '' , 'POST');
		$categoryId		= JRequest::getVar('categoryid' , '' , 'POST');
		$website		= JRequest::getVar('website' , '' , 'POST');

		// @rule: Test for emptyness
		if( empty( $name ) )
		{
			$validated = false;
			$mainframe->enqueueMessage( JText::_('CC GROUP NAME CANNOT BE EMPTY'), 'error');
		}

		// @rule: Test if group exists
		if( $model->groupExist( $name ) )
		{
			$validated = false;
			$mainframe->enqueueMessage( JText::_('CC GROUP NAME TAKEN'), 'error');
		}

		// @rule: Test for emptyness
		if( empty( $description ) )
		{
			$validated = false;
			$mainframe->enqueueMessage( JText::_('CC GROUP DESCRIPTION CANNOT BE EMPTY'), 'error');
		}

		if( empty( $categoryId ) )
		{
			$validated	= false;
			$mainframe->enqueueMessage(JText::_('CC GROUP CATEGORY NOT SELECTED'), 'error');
		}

		if($validated)
		{
			// Assertions
			// Category Id must not be empty and will cause failure on this group if its empty.
			CError::assert( $categoryId , '', '!empty', __FILE__ , __LINE__ );

			// Get the configuration object.
			$config	=& CFactory::getConfig();

			// @rule: Retrieve params and store it back as raw string
			$params	= new JParameter('');
			
			$discussordering			= JRequest::getVar( 'discussordering' , DISCUSSION_ORDER_BYLASTACTIVITY , 'REQUEST' );
			$params->set('discussordering' , $discussordering );
			
			$photopermission			= JRequest::getVar( 'photopermission' , GROUP_PHOTO_PERMISSION_ADMINS , 'REQUEST' );
			$params->set('photopermission' , $photopermission );
			
			$videopermission			= JRequest::getVar( 'videopermission' , GROUP_PHOTO_PERMISSION_ADMINS , 'REQUEST' );
			$params->set('videopermission' , $videopermission );
			
			$grouprecentphotos			= JRequest::getVar( 'grouprecentphotos' , GROUP_PHOTO_RECENT_LIMIT , 'REQUEST' );
			$params->set('grouprecentphotos' , $grouprecentphotos );
			
			$grouprecentvideos			= JRequest::getVar( 'grouprecentvideos' , GROUP_VIDEO_RECENT_LIMIT , 'REQUEST' );
			$params->set('grouprecentvideos' , $grouprecentvideos );			
			
			$newmembernotification		= JRequest::getVar( 'newmembernotification' , '1' , 'REQUEST' );
			$params->set('newmembernotification' , $newmembernotification );
			
			$joinrequestnotification	= JRequest::getVar( 'joinrequestnotification' , '1' , 'REQUEST' );
			$params->set('joinrequestnotification' , $joinrequestnotification );
			
			CFactory::load('helpers' , 'owner' );
			
			// Bind the post with the table first
			$group->name		= $name;
			$group->description	= $description;
			$group->categoryid	= $categoryId;
			$group->website		= $website;
			$group->ownerid		= $my->id;
			$group->created		= gmdate('Y-m-d H:i:s');
			$group->approvals	= JRequest::getVar('approvals' , '0' , 'POST');
			$group->params		= $params->toString();
			
			// Set the default thumbnail and avatar for the group just in case
			// the user decides to skip this
			$group->thumb		= 'components/com_community/assets/group_thumb.jpg';
			$group->avatar		= 'components/com_community/assets/group.jpg';

			// @rule: check if moderation is turned on.
			$group->published	= ( $config->get('moderategroupcreation') ) ? 0 : 1;
			

			// Store the group now.
			$group->store();
			
			// Since this is storing groups, we also need to store the creator / admin
			// into the groups members table
			$member				=& JTable::getInstance( 'GroupMembers' , 'CTable' );
			$member->groupid	= $group->id;
			$member->memberid	= $group->ownerid;
			
			// Creator should always be 1 as approved as they are the creator.
			$member->approved	= 1;
			
			// @todo: Setup required permissions in the future
			$member->permissions	= '1';
			
			$member->store();
			
			// Increment the member count
			$model->addMembersCount( $group->id );


			$url			= CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id , true );

			$act = new stdClass();
			$act->cmd 		= 'group.create';
			$act->actor   	= $my->id;
			$act->target  	= 0;
			$act->title	  	= JText::sprintf('CC ACTIVITIES NEW GROUP' , $url , $group->name );
			$act->content	= ( $group->approvals == 0) ? $group->description : '';
			$act->app		= 'groups';
			$act->cid		= $group->id;
			
			$params = new JParameter('');
			$params->set( 'action', 'group.create' );
	
			// Add activity logging
			CFactory::load ( 'libraries', 'activities' );
			CActivityStream::add( $act, $params->toString() );
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('group.create');			

			$validated = $group->id;
		}

		return $validated;
	}

	/**
	 * Method to search for a group based on the parameter given
	 * in a POST request
	 **/
	function search()
	{
		$config 	=& CFactory::getConfig();
		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}	
	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType );

		echo $view->get( __FUNCTION__  );
	}

	/**
	 * Ajax function call that allows user to leave group
	 *
	 * @param groupId	The groupid that the user wants to leave from the group
	 *
	 **/
	function leaveGroup()
	{
		$groupId	= JRequest::getVar('groupid' , '' , 'POST');
		CError::assert( $groupId , '' , '!empty' , __FILE__ , __LINE__ );

		$model		=& $this->getModel('groups');
		$my			= CFactory::getUser();

		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		$data		= new stdClass();
		$data->groupid	= $groupId;
		$data->memberid	= $my->id;

		$model->removeMember($data);
		
		//add user points
		CFactory::load( 'libraries' , 'userpoints' );		
		CUserPoints::assignPoint('group.leave');		

		$model->substractMembersCount( $groupId );

		$mainframe =& JFactory::getApplication();
		
		//trigger for onGroupLeave
		$group = $model->getGroup($groupId);
		$this->triggerGroupEvents( 'onGroupLeave' , $group , $my->id);
		
		$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups' , false) , JText::_('CC SUCCESS LEFT GROUP') );
	}

	/**
	 * Method is used to receive POST requests from specific user
	 * that wants to join a group
	 *
	 * @return	void
	 **/
	function joinGroup()
	{
		$mainframe =& JFactory::getApplication();

		$groupId	= JRequest::getVar('groupid' , '' , 'POST');

		// Add assertion to the group id since it must be specified in the post request
		CError::assert( $groupId , '' , '!empty' , __FILE__ , __LINE__ );

		// Get the current user's object
		$my			= CFactory::getUser();

		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		// Load necessary tables
		$groupModel	=& CFactory::getModel('groups');

		if( $groupModel->isMember( $my->id , $groupId ) )
		{
			$url 	= CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$groupId, false);
			$mainframe->redirect( $url , JText::_( 'CC ALREADY MEMBER OF GROUP' ) );
		}
		else
		{
			$group		=& JTable::getInstance( 'Group' , 'CTable' );
			$member		=& JTable::getInstance( 'GroupMembers' , 'CTable' );
			$group->load( $groupId );
			
			$params		= $group->getParams();
			
			// Set the properties for the members table
			$member->groupid	= $group->id;
			$member->memberid	= $my->id;

			CFactory::load( 'helpers' , 'owner' );
			// @rule: Special users should be able to join the group regardless if it requires approval or not
			if( isCommunityAdmin() )
			{
				$member->approved	= 1;
			}
			else
			{
				// @rule: If approvals is required, set the approved status accordingly.
				$member->approved	= ( $group->approvals == COMMUNITY_PRIVATE_GROUP ) ? '0' : 1;
			}

	 		//@todo: need to set the privileges
	 		$member->permissions	= '0';
	 		
			// Get the owner data
			$owner	= CFactory::getUser( $group->ownerid );

			$store	= $member->store();

			// Add assertion if storing fails
			CError::assert( $store , true , 'eq' , __FILE__ , __LINE__ );

			// Build the URL.
			//$url	= CUrl::build( 'groups' , 'viewgroup' , array( 'groupid' => $group->id ) , true );
			$url 	= CRoute::getExternalURL('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id, false);

			// Notify admin via email if user is unapproved or approved.
			// @todo: If user is not approve yet, display links to approve , reject
			$tmplData				= array();
			$tmplData['url']		= $url;
			$tmplData['group']		= $group->name;
			$tmplData['user']		= $my->getDisplayName();
			$tmplData['approved']	= $member->approved;
			
			//trigger for onGroupJoin
			$this->triggerGroupEvents( 'onGroupJoin' , $group , $my->id);
			
			// Test if member is approved, then we add logging to the activities.
			if( $member->approved )
			{
				// Update the members count
				$groupModel->addMembersCount( $group->id );
				
				if($params->get('newmembernotification', '1'))
				{
					// Send email to group owner that someone recently joined the group
					$this->_notify( 'groups.member.join' , $my->id , $group->ownerid , JText::sprintf( 'CC NEW MEMBER JOIN EMAIL SUBJECT' , $group->name ) ,
								 	'' , 'groups.email.memberjoin' , $tmplData );
				}
				
				$act = new stdClass();
				$act->cmd 		= 'group.join';
				$act->actor   	= $my->id;
				$act->target  	= 0;
				$act->title	  	= JText::sprintf('CC ACTIVITIES GROUP JOIN' , $url , $group->name );
				$act->content	= '';
				$act->app		= 'groups';
				$act->cid		= $group->id;

				// Add logging
				CFactory::load ( 'libraries', 'activities' );
				CActivityStream::add($act);
				
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('group.join');				

				$mainframe->redirect( $url , JText::_('CC SUCCESS JOIN GROUP') );
			}
			else
			{
				if($params->get('joinrequestnotification', '1'))
				{
					// Send email to group owner that they need to approve the request
					$this->_notify( 'groups.member.join' , $my->id , $group->ownerid , JText::sprintf( 'CC NEW MEMBER NEEDS APPROVAL EMAIL SUBJECT' , $group->name ) ,
								 	'' , 'groups.email.memberjoin' , $tmplData );
				}
			}
			
			$mainframe->redirect( $url , JText::_( 'CC USER JOIN GROUP NEED APPROVAL' ) );
		}
	}

	function uploadAvatar()
	{
		$mainframe =& JFactory::getApplication();

		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);
		$my			=& JFactory::getUser();


		$groupid	= JRequest::getVar('groupid' , '' , 'REQUEST');
		$data		= new stdClass();
		$data->id	= $groupid;

		$groupsModel	=& $this->getModel( 'groups' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupid );

		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		if( !$group->isAdmin($my->id) && !isCommunityAdmin() )
		{
			echo JText::_('CC ACCESS FORBIDDEN');
			return;
		}
		
		if( JRequest::getMethod() == 'POST' )
		{
			CFactory::load( 'helpers' , 'image' );

			$file		= JRequest::getVar('filedata' , '' , 'FILES' , 'array');

			if( empty( $file ) )
			{
				$mainframe->enqueueMessage(JText::_('CC NO POST DATA'), 'error');
			}
			else
			{

				$config			= CFactory::getConfig();
				$uploadLimit	= (double) $config->get('maxuploadsize');
				$uploadLimit	= ( $uploadLimit * 1024 * 1024 );

				// @rule: Limit image size based on the maximum upload allowed.
				if( filesize( $file['tmp_name'] ) > $uploadLimit )
				{
					$mainframe->enqueueMessage( JText::_('CC IMAGE FILE SIZE EXCEEDED') , 'error' );
					$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=uploadavatar&groupid=' . $group->id , false) );
				}
				
				if( !cValidImage($file['tmp_name'] ) )
				{
					$mainframe->enqueueMessage( JText::_('CC IMAGE FILE NOT SUPPORTED') , 'error');
				}
				else
				{
					$imageSize		= cImageGetSize( $file['tmp_name'] );

					// @todo: configurable width?
					$imageMaxWidth	= 160;

					if( $imageSize->width > $imageMaxWidth )
					{
						$mainframe->enqueueMessage( JText::sprintf('CC IMAGE WIDTH LARGER' , $imageSize->width , $imageMaxWidth ) );
					}

					// Get a hash for the file name.
					$fileName		= JUtility::getHash( $file['tmp_name'] . time() );
					$hashFileName	= JString::substr( $fileName , 0 , 24 );

					//@todo: configurable path for avatar storage?
					$storage			= JPATH_ROOT . DS . 'images' . DS . 'avatar' . DS . 'groups';
					$storageImage		= $storage . DS . $hashFileName . cImageTypeToExt( $file['type'] );
					$storageThumbnail	= $storage . DS . 'thumb_' . $hashFileName . cImageTypeToExt( $file['type'] );
					$image				= 'images/avatar/groups/' . $hashFileName . cImageTypeToExt( $file['type'] );
					$thumbnail			= 'images/avatar/groups/' . 'thumb_' . $hashFileName . cImageTypeToExt( $file['type'] );

					// Generate full image
					if(!cImageResizePropotional( $file['tmp_name'] , $storageImage , $file['type'] , $imageMaxWidth ) )
					{
						$mainframe->enqueueMessage(JText::sprintf('CC ERROR MOVING UPLOADED FILE' , $storageImage), 'error');
					}

					// Generate thumbnail
					if(!cImageCreateThumb( $file['tmp_name'] , $storageThumbnail , $file['type'] ))
					{
						$mainframe->enqueueMessage(JText::sprintf('CC ERROR MOVING UPLOADED FILE' , $storageThumbnail), 'error');
					}

					// Update the group with the new image
					$groupsModel->setImage( $groupid , $image , 'avatar' );
					$groupsModel->setImage( $groupid , $thumbnail , 'thumb' );

					// Add logging.
					$url = CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$groupid);
					$act = new stdClass();
					$act->cmd 		= 'group.avatar.upload';
					$act->actor   	= $my->id;
					$act->target  	= 0;
					$act->title	  	= JText::sprintf('CC ACTIVITIES NEW GROUP AVATAR' , $url , $group->name );
					$act->content	= '<img src="' . rtrim( JURI::root() , '/' ) . '/' . $thumbnail . '" style="border: 1px solid #eee;margin-right: 3px;" />';
					$act->app		= 'groups';
					$act->cid		= $group->id;


					CFactory::load ( 'libraries', 'activities' );
					CActivityStream::add( $act);
					
					//add user points
					CFactory::load( 'libraries' , 'userpoints' );		
					CUserPoints::assignPoint('group.avatar.upload');					

					$mainframe =& JFactory::getApplication();
					$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid , false ) , JText::_('CC GROUP AVATAR UPLOADED') );
					exit;
				}
			}
		}

		// We assume that user wants to edit their avatar.
		$data->avatar		= $groupsModel->getLargeAvatar( $groupid , $group->avatar );
		$data->thumb		= $groupsModel->getThumbAvatar( $groupid , $group->thumb );

		echo $view->get( __FUNCTION__ , $data );
	}

	/**
	 * Method that loads the viewing of a specific group
	 **/
	function viewGroup()
	{
		$config 	=& CFactory::getConfig();
		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		echo $view->get( __FUNCTION__ );
	}

	/**
	 * Show only current user group
	 */
	function mygroups(){
		$config 	=& CFactory::getConfig();
		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		echo $view->get( __FUNCTION__ );
	}

	function viewmembers()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		$data		= new stdClass();
		$data->id	= JRequest::getVar('groupid' , '' , 'GET');
		echo $view->get( __FUNCTION__ , $data );
	}

	/**
	 * Show full view of the news for the group
	 **/
	function viewbulletin()
	{
		$config 	=& CFactory::getConfig();
		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		$data		= new stdClass();

		echo $view->get( __FUNCTION__ );
	}

	/**
	 * Show all news from specific groups
	 **/
	function viewbulletins()
	{
		$my			= CFactory::getUser();		
		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		echo $view->get( __FUNCTION__ );
	}

	/**
	 * Show all discussions from specific groups
	 **/
	function viewdiscussions()
	{
		$my			= CFactory::getUser();		
		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		echo $view->get( __FUNCTION__ );
	}

	function adddiscussion()
	{
		$mainframe	=& JFactory::getApplication();
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);
		$my			= CFactory::getUser();
		$groupid		= JRequest::getVar('groupid' , '' , 'REQUEST');
		$groupsModel	=& $this->getModel( 'groups' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupid );
						
		if($my->id == 0)
		{
			return $this->blockUnregister();
		}

		if( !$group->isMember($my->id) && !isCommunityAdmin() )
		{
			echo JText::_('CC ACCESS FORBIDDEN');
			return;
		}
		
		if( JRequest::getMethod() == 'POST' )
		{
			$validated		= true;
			$title			= JRequest::getVar('title' , '' , 'POST');
			$message		= JRequest::getVar( 'message', '', 'post', 'string', JREQUEST_ALLOWRAW );


			if( empty($title) )
			{
				$validated = false;
				$mainframe->enqueueMessage(JText::_('CC DISCUSSION TOPIC CANNOT BE EMPTY'), 'notice');
			}

			if( empty($message) )
			{
				$validated = false;
				$mainframe->enqueueMessage(JText::_('CC DISCUSSION CANNOT BE EMPTY'), 'notice');
			}

			CFactory::load( 'helpers' , 'owner' );
			// Make sure this user is a member of this group
			if( !$groupsModel->isMember( $my->id, $groupid ) && !isCommunityAdmin() )
			{
				$validated = false;
				$mainframe->enqueueMessage(JText::_('CC NOT MEMBER OF GROUP'), 'error');
			}

			if( $validated )
			{
				CFactory::load( 'models' , 'discussions' );
				$discussion	=& JTable::getInstance( 'Discussion' , 'CTable' );
				
				$discussion->title		= $title;
				$discussion->message	= $message;
				$discussion->creator	= $my->id;
				$discussion->groupid	= $groupid;
				$discussion->created	= gmdate('Y-m-d H:i:s');
				$discussion->lastreplied	= $discussion->created;
				$discussion->store();
				// Update discussion count
				$groupsModel->addDiscussCount( $groupid );

				$group			=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load( $groupid );

				// @rule: only add the activities of the discussion if the group is not private.
				if( $group->approvals == COMMUNITY_PUBLIC_GROUP )
				{
					// Add logging.
					$url				= CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid );
					CFactory::load ( 'libraries', 'activities' );
	
					$act = new stdClass();
					$act->cmd 		= 'group.discussion.create';
					$act->actor 	= $my->id;
					$act->target 	= 0;
					$act->title		= JText::sprintf('CC ACTIVITIES NEW GROUP DISCUSSION' , $url , $group->name );
					$act->content	= $message;
					$act->app		= 'groups';
					$act->cid		= $group->id;
					
					$params				= new JParameter('');
					$params->set( 'action', 'group.discussion.create' );
					$params->set( 'topic_id', $discussion->id );
					$params->set( 'topic', $discussion->title );
					$params->set( 'topic_url', CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussion&groupid='.$group->id.'&topicid='.$discussion->id ));
					
					CActivityStream::add( $act, $params->toString() );
				}


				//@rule: Add notification for group members whenever a new discussion created.
				$config		=& CFactory::getConfig();
				
				if($config->get('groupdiscussnotification') == 1 )
				{
					$model			=& $this->getModel( 'groups' );
					$memberCount 	= $model->getMembersCount($groupid);
					$members		= $model->getMembers($groupid, $memberCount);
					$membersArray	= array();

					foreach($members as $row)
					{
						$membersArray[] = $row->id;
					}
					unset($members);
	
					$nData				= array();

					$nData['url']		= CRoute::getExternalURL( 'index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $group->id . '&topicid=' . $discussion->id );
					$nData['group']		= $group;
					$nData['subject']	= $discussion->title;
					$nData['creator']	= CFactory::getUser( $discussion->creator );
					$nData['message']	= $discussion->message;
					
					$this->_notify('groups.create.discussion', $my->id, $membersArray, JText::sprintf('CC NEW DISCUSSION NOTIFICATION EMAIL SUBJECT' , $group->name ), '', 'groups.email.new.discussion', $nData);
				}
								
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('group.discussion.create');
				
				$redirectUrl	= CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussion&topicid=' . $discussion->id . '&groupid=' . $groupid , false );

				$mainframe->redirect( $redirectUrl , JText::_('CC DISCUSSION ADDED'));
				exit;
			}
		}

		$data		= new stdClass();
		$data->id	= JRequest::getVar('groupid' , '' , 'GET');
		echo $view->get( __FUNCTION__ , $data );

	}

	/**
	 * Show discussion
	 */
	function viewdiscussion()
	{
		$config 	=& CFactory::getConfig();
		if( !$config->get('enablegroups') )
		{
			echo JText::_('CC GROUPS DISABLED');
			return;
		}	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		echo $view->get( __FUNCTION__ );
	}

	/**
	 * Show Invite
	 */
	function invitefriends()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);
		$my			= CFactory::getUser();
		$invited		= JRequest::getVar( 'invite-list' , '' , 'POST' );
		$inviteMessage	= JRequest::getVar( 'invite-message' , '' , 'POST' );
		$groupId		= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$groupsModel	=& $this->getModel( 'groups' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		
		if( !$group->isMember($my->id) && !isCommunityAdmin() )
		{
			echo JText::_('CC ACCESS FORBIDDEN');
			return;
		}
				
		if( JRequest::getMethod() == 'POST' )
		{			
			if( !empty($invited ) )
			{
				$my				= CFactory::getUser();
				$mainframe		=& JFactory::getApplication();
				$groupsModel	=& CFactory::getModel( 'Groups' );
				$group			=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load( $groupId );

				$tmplData				= array();
				$tmplData['url']		= CRoute::getExternalURL('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id );
				$tmplData['groupname']	= $group->name;
				$tmplData['message']	= $inviteMessage;

				// Send notification to the invited user.
				$this->_notify( 'groups.invite' , $my->id , $invited , JText::sprintf('CC INVITED TO JOIN GROUP' , $group->name ) , '' , 'groups.invite' , $tmplData );
				
				$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id , false ) , JText::_( 'CC GROUP INVITATIONS SENT' ) );				
			}
			else
			{
				$view->addWarning( JText::_('CC INVITE NEED AT LEAST 1 FRIEND') );
			}
		}
		echo $view->get( __FUNCTION__ );
	}

	function editNews()
	{
		$mainframe		=& JFactory::getApplication();
		$my				= CFactory::getUser();

		if($my->id == 0)
		{
			return $this->blockUnregister();
		}

		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		// Load necessary models
		$groupsModel	=& CFactory::getModel( 'groups' );
		CFactory::load( 'models' , 'bulletins' );
		
		$groupId		= JRequest::getVar( 'groupid' , '' , 'REQUEST' );

		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		CFactory::load( 'helpers' , 'owner' );
		
		// Ensure user has really the privilege to view this page.
		if( $my->id != $group->ownerid && !isCommunityAdmin() && !$groupsModel->isAdmin( $my->id , $groupId ) )
		{
			echo JText::_('CC PERMISSION DENIED');
			return;
		}

		if( JRequest::getMethod() == 'POST' )
		{
			// Get variables from query
			$bulletin			=& JTable::getInstance( 'Bulletin' , 'CTable' );
			$bulletinId			= JRequest::getVar( 'bulletinid' , '' , 'POST' );
			
			$bulletin->load( $bulletinId );
			$bulletin->message	= JRequest::getVar( 'message', '', 'post', 'string', JREQUEST_ALLOWRAW );
			$bulletin->title	= JRequest::getVar( 'title', '', 'post', 'string' );
			// Groupid should never be empty. Add some assert codes here
			CError::assert( $groupId , '' , '!empty' , __FILE__ , __LINE__ );
			CError::assert( $bulletinId , '' , '!empty' , __FILE__ , __LINE__ );

			if( empty( $bulletin->message ) )
			{
				$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewbulletin&bulletinid=' . $bulletinId . '&groupid=' . $groupId , false ), JText::_('CC BULLETIN NO MESSAGE') );
			}

			$bulletin->store();
			$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewbulletin&bulletinid=' . $bulletinId . '&groupid=' . $groupId , false ), JText::_('CC BULLETIN UPDATED') );
		}
	}
	
	/**
	 * Method to add a new discussion
	 **/
	function addNews()
	{
		$mainframe =& JFactory::getApplication();

		$my = CFactory::getUser();

		if($my->id == 0)
		{
			return $this->blockUnregister();
		}

		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		// Load necessary models
		$groupsModel	=& CFactory::getModel( 'groups' );
		CFactory::load( 'models' , 'bulletins' );
		$groupId		= JRequest::getVar( 'groupid' , '' , 'REQUEST' );

		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		CFactory::load( 'helpers' , 'owner' );
		
		// Ensure user has really the privilege to view this page.
		if( $my->id != $group->ownerid && !isCommunityAdmin() && !$groupsModel->isAdmin( $my->id , $groupId ) )
		{
			echo JText::_('CC PERMISSION DENIED');
			return;
		}

		$title		= '';
		$message	= '';

		if( JRequest::getMethod() == 'POST' )
		{
			// Get variables from query
			$bulletin			=& JTable::getInstance( 'Bulletin' , 'CTable' );
			$bulletin->title	= JRequest::getVar( 'title' , '' , 'post' );
			$bulletin->message	= JRequest::getVar( 'message', '', 'post', 'string', JREQUEST_ALLOWRAW );

			// Groupid should never be empty. Add some assert codes here
			CError::assert( $groupId , '' , '!empty' , __FILE__ , __LINE__ );

			$validated	= true;

			if( empty($bulletin->title) )
			{
				$validated	= false;
				$mainframe->enqueueMessage( JText::_('CC BULLETIN NO TITLE'), 'notice');
			}

			if( empty($bulletin->message) )
			{
				$validated 	= false;
				$mainframe->enqueueMessage(JText::_('CC BULLETIN NO MESSAGE'), 'notice');
			}

			if( $validated )
			{
				$bulletin->groupid		= $groupId;
				$bulletin->date			= gmdate( 'Y-m-d H:i:s' );
				$bulletin->created_by	= $my->id;

	 			// @todo: Add moderators for the groups.
				// Since now is default to the admin, default to publish the news
	 			$bulletin->published	= 1;

				$bulletin->store();

				// Send notification to all user
				$model			=& $this->getModel( 'groups' );
				$memberCount 	= $model->getMembersCount($groupId);
				$members 		= $model->getMembers($groupId, $memberCount);
				
				$membersArray = array();

				foreach($members as $row)
				{
					$membersArray[] = $row->id;
				}
				unset($members);

				$nData				= array();
				$nData['url']		= CRoute::getExternalURL( 'index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupId );
				$nData['group']		= $group;
				$nData['subject']	= $bulletin->title;

				$this->_notify('groups.create.news', $my->id, $membersArray, JText::sprintf('CC NEW BULLETIN NOTIFICATION EMAIL SUBJECT' , $group->name ), '', 'groups.email.bulletin', $nData);

				// @rule: only add the activities of the news if the group is not private.
				if( $group->approvals == COMMUNITY_PUBLIC_GROUP )
				{
					// Add logging to the bulletin
					$url	= CRoute::_('index.php?option=com_community&view=groups&task=viewbulletin&groupid=' . $group->id . '&bulletinid=' . $bulletin->id );
	
					// Add activity logging
					CFactory::load ( 'libraries', 'activities' );
					$act = new stdClass();
					$act->cmd 		= 'group.news.create';
					$act->actor 	= $my->id;
					$act->target 	= 0;
					$act->title		= JText::sprintf('CC ACTIVITIES NEW GROUP NEWS' , $url , $bulletin->title );
					$act->content	= ( $group->approvals == 0 ) ? JString::substr( strip_tags( $bulletin->message ) , 0 , 100 ) : '';
					$act->app		= 'groups';
					$act->cid		= $bulletin->groupid;
					CActivityStream::add( $act );
				}
							
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('group.news.create');				

				$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupId , false ), JText::_('CC BULLETIN ADDED') );
			}
			else
			{
				echo $view->get( __FUNCTION__ , $bulletin );
				return;
			}
		}

		echo $view->get( __FUNCTION__ , false );
	}

	function deleteTopic()
	{
		$mainframe =& JFactory::getApplication();

		$my	= CFactory::getUser();
		if($my->id == 0)
		{
			return $this->blockUnregister();
		}

		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
		$view		=& $this->getView( $viewName , '' , $viewType);

		$topicid	= JRequest::getVar( 'topicid' , '' , 'POST' );
		$groupid	= JRequest::getVar( 'groupid' , '' , 'POST' );

		if( empty( $topicid ) || empty($groupid ) )
		{
			echo JText::_('Invalid id');
			return;
		}

		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'models' , 'discussions' );

		$groupsModel	=& CFactory::getModel( 'groups' );
		$wallModel		=& CFactory::getModel( 'wall' );
		$discussion		=& JTable::getInstance( 'Discussion' , 'CTable' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupid );
		$isGroupAdmin	= $groupsModel->isAdmin( $my->id , $group->id );

		if( $isGroupAdmin || isCommunityAdmin() )
		{
			$discussion->load( $topicid );

			if( $discussion->delete() )
			{
				// Remove the replies to this discussion as well since we no longer need them
				$wallModel->deleteAllChildPosts( $topicid , 'discussions' );

				// Substract the count from the groups table
				$groupsModel->substractDiscussCount( $groupid );

				$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid , false ), JText::_('CC DISCUSSION REMOVED') );
			}
		}
		else
		{
			$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid , false ), JText::_('CC NOT ALLOWED TO REMOVE GROUP TOPIC') );
		}
	}

	function deleteBulletin()
	{
		$mainframe	=& JFactory::getApplication();
		$my			= CFactory::getUser();

		if($my->id == 0)
		{
			return $this->blockUnregister();
		}

		$bulletinId	= JRequest::getVar( 'bulletinid' , '' , 'POST' );
		$groupid	= JRequest::getVar( 'groupid' , '' , 'POST' );

		if( empty( $bulletinId ) || empty($groupid ) )
		{
			echo JText::_('CC INVALID ID');
			return;
		}

		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'models' , 'bulletins' );

		$groupsModel	=& CFactory::getModel( 'groups' );
		$bulletin		=& JTable::getInstance( 'Bulletin' , 'CTable' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupid );

		if( $groupsModel->isAdmin( $my->id , $group->id ) || isCommunityAdmin() )
		{
			$bulletin->load( $bulletinId );

			if( $bulletin->delete() )
			{
			
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('group.news.remove');			
			
				$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid , false ), JText::_('CC BULLETIN REMOVED') );
			}
		}
		else
		{
			$mainframe->redirect( CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid , false ), JText::_('CC NOT ALLOWED TO REMOVE GROUP TOPIC') );
		}
	}
	
	/*
	 * group event name
	 * object array	 	
     */	
	
	function triggerGroupEvents( $eventName, &$args, $target = null)
	{
		CError::assert( $args , 'object', 'istype', __FILE__ , __LINE__ );
		
		require_once( COMMUNITY_COM_PATH.DS.'libraries' . DS . 'apps.php' );
		$appsLib	=& CAppPlugins::getInstance();
		$appsLib->loadApplications();		
		
		$params		= array();
		$params[]	= &$args;
		
		if(!is_null($target))
			$params[]	= $target;
				
		$appsLib->triggerEvent( $eventName , $params);
		return true;
	}
}