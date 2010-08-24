<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

/**
 * Jom Social Component Controller
 */
class CommunityControllerGroups extends CommunityController
{
	function __construct()
	{
		parent::__construct();
		
		$this->registerTask( 'publish' , 'savePublish' );
		$this->registerTask( 'unpublish' , 'savePublish' );	
	}

	function ajaxTogglePublish( $id , $type )
	{
		return parent::ajaxTogglePublish( $id , $type , 'groups' );
	}
	
	function ajaxChangeGroupOwner( $groupId )
	{
		$response	= new JAXResponse();

		$group		=& JTable::getInstance( 'Groups' , 'CommunityTable' );
		$group->load( $groupId );
		
		$group->owner	=& JFactory::getUser( $group->ownerid );
		
		$model			= $this->getModel( 'users' );
		$users			= $model->getAllUsers(false);

		ob_start();
?>
<div style="background-color: #F9F9F9; border: 1px solid #D5D5D5; margin-bottom: 10px; padding: 5px;font-weight: bold;">
	<?php echo JText::_('CC CHANGE THE GROUP OWNERSHIP TO ANOTHER USER');?>
</div>
<form name="editgroup" method="post" action="">
<table cellspacing="0" class="admintable" border="0" width="100%">
	<tbody>
		<tr>
			<td class="key" valign="top"><?php echo JText::_('CC CURRENT GROUP OWNER');?></td>
			<td valign="top" width="1%">:</td>
			<td align="left">
				<?php echo $group->owner->name; ?>
			</td>
		</tr>
		<tr>
			<td class="key" valign="top"><?php echo JText::_('CC NEW GROUP OWNER');?></td>
			<td valign="top">:</td>
			<td align="left">
				<select name="ownerid">
					<?php
						foreach( $users as $user )
						{
					?>
						<option value="<?php echo $user->id;?>"><?php echo JText::sprintf('%1$s [ %2$s ]' , $user->name , $user->email );?></option>
					<?php
						}
					?>
				</select>
			</td>
		</tr>
	</tbody>
</table>
<input name="id" value="<?php echo $group->id;?>" type="hidden" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="task" value="updateGroupOwner" />
<input type="hidden" name="view" value="groups" />
</form>
<?php
		$contents	= ob_get_contents();
		ob_end_clean();
		
		$response->addAssign( 'cWindowContent' , 'innerHTML' , $contents );

		$action = '<input type="button" class="button" onclick="azcommunity.saveGroupOwner();" name="' . JText::_('CC SAVE') . '" value="' . JText::_('CC SAVE') . '" />';
		$action .= '&nbsp;<input type="button" class="button" onclick="cWindowHide();" name="' . JText::_('CC CLOSE') . '" value="' . JText::_('CC CLOSE') . '" />';
		$response->addScriptCall( 'cWindowActions' , $action );

		return $response->sendResponse();
	}

	function ajaxAssignGroup( $memberId )
	{
		require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );
		$response	= new JAXResponse();

		$model		= $this->getModel( 'groups' );
		$groups		= $model->getAllGroups();
		$user		= CFactory::getUser( $memberId );
		ob_start();
?>
<form name="assignGroup" action="" method="post" id="assignGroup">
<div style="background-color: #F9F9F9; border: 1px solid #D5D5D5; margin-bottom: 10px; padding: 5px;">
	<?php echo JText::sprintf('Assign <strong>%1$s</strong> to be a member of the following group. When assigning a user to a group, it will make the user automatically a member of the group.', $user->getDisplayName() );?>
</div>
<table cellspacing="0" class="admintable" border="0" width="100%">
	<tbody>
		<tr>
			<td class="key" valign="top"><?php echo JText::_('CC GROUP');?></td>
			<td valign="top">:</td>
			<td>
				<select name="groupid" id="groupid">
					<option value="-1" selected="selected"><?php echo JText::_('CC SELECT A GROUP');?></option>
				<?php
					foreach($groups as $row )
					{
						if( !$model->isMember($user->id , $row->id) )
						{
				?>
					<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
				<?php
						}
					}		
				?>
				</select>
			</td>
		</tr>
	</tbody>
</table>
<div id="group-error-message" style="color: red;font-weight:700;"></div>
<input type="hidden" name="memberid" value="<?php echo $user->id;?>" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="task" value="addmember" />
<input type="hidden" name="view" value="groups" />
<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$response->addAssign( 'cWindowContent' , 'innerHTML' , $contents );

		$action = '<input type="button" class="button" onclick="azcommunity.saveAssignGroup();" name="' . JText::_('CC SAVE') . '" value="' . JText::_('CC SAVE') . '" />';
		$action .= '&nbsp;<input type="button" class="button" onclick="cWindowHide();" name="' . JText::_('CC CLOSE') . '" value="' . JText::_('CC CLOSE') . '" />';
		$response->addScriptCall( 'cWindowActions' , $action );
		$response->addScriptCall( 'jQuery("#cwin_logo").html("' . JText::_('CC ASSIGN USER TO GROUP') . '");');
		return $response->sendResponse();
	}
	
	function ajaxEditGroup( $groupId )
	{
		$response	= new JAXResponse();

		$model		= $this->getModel( 'groupcategories' );
		
		$categories	= $model->getCategories();
		$group		=& JTable::getInstance( 'Groups' , 'CommunityTable' );
		
		$group->load( $groupId );
		
		$requireApproval	= ($group->approvals) ? ' checked="true"' : '';
		$noApproval			= (!$group->approvals) ? '' : ' checked="true"';
		ob_start();
?>
<form name="editgroup" action="" method="post" id="editgroup">
<div style="background-color: #F9F9F9; border: 1px solid #D5D5D5; margin-bottom: 10px; padding: 5px;font-weight: bold;">
	<?php echo JText::_('CC EDIT GROUP DETAILS TO CREATE A NEW GROUP IT HAS TO BE DONE FROM THE FRONT END');?>
</div>
<table cellspacing="0" class="admintable" border="0" width="100%">
	<tbody>
		<tr>
			<td class="key" valign="top"><?php echo JText::_('CC AVATAR');?></td>
			<td valign="top">:</td>
			<td>
				<img width="90" src="<?php echo JURI::root() . $group->avatar;?>" style="border: 1px solid #eee;"/>
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC PUBLISH STATUS');?></td>
			<td>:</td>
			<td>
				<input type="radio" name="published" value="1" id="publish" <?php echo ( $group->published == '1' ) ? 'checked="true"' : '';?>/>
				<label for="publish"><?php echo JText::_('CC PUBLISH'); ?></label>
				<input type="radio" name="published" value="0" id="unpublish" <?php echo ( $group->published == '0' ) ? 'checked="true"' : '';?>>
				<label for="unpublish"><?php echo JText::_('CC UNPUBLISH');?></label>
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC REQUIRE APPROVALS');?></td>
			<td>:</td>
			<td>
				<input type="radio" name="approvals" value="1" id="approve" <?php echo ( $group->approvals == '1' ) ? 'checked="true"' : '';?>/>
				<label for="approve"><?php echo JText::_('CC YES'); ?></label>
				<input type="radio" name="approvals" value="0" id="unapprove" <?php echo ( $group->approvals == '0' ) ? 'checked="true"' : '';?>/>
				<label for="unapprove"><?php echo JText::_('CC NO');?></label>
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC CATEGORY');?></td>
			<td>:</td>
			<td>
				<select name="categoryid">
				<?php
					for( $i = 0; $i < count( $categories ); $i++ )
					{
						$selected	= ($group->categoryid == $categories[$i]->id ) ? ' selected="selected"' : '';
				?>
						<option value="<?php echo $categories[$i]->id;?>"<?php echo $selected;?>><?php echo $categories[$i]->name;?></option>
				<?php
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC NAME');?></td>
			<td>:</td>
			<td>
				<span>
					<input type="text" name="name" class="inputbox" value="<?php echo $group->name;?>" style="width: 250px;" />
				</span>
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC DESCRIPTION');?></td>
			<td>:</td>
			<td>
				<textarea name="description" style="width: 250px;" rows="5"><?php echo $group->description;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC WEBSITE');?></td>
			<td>:</td>
			<td>
				<input name="website" type="text" class="inputbox" value="<?php echo $group->website;?>" style="width: 250px;" />
			</td>
		</tr>
		<tr>
			<td class="key"><?php echo JText::_('CC EMAIL');?></td>
			<td>:</td>
			<td>
				<input name="email" type="text" class="inputbox" value="<?php echo $group->email;?>" style="width: 250px;" />
			</td>
		</tr>
	</tbody>
</table>
<input type="hidden" name="id" value="<?php echo $group->id;?>" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="task" value="savegroup" />
<input type="hidden" name="view" value="groups" />
<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$response->addAssign( 'cWindowContent' , 'innerHTML' , $contents );

		$action = '<input type="button" class="button" onclick="azcommunity.saveGroup();" name="' . JText::_('CC SAVE') . '" value="' . JText::_('CC SAVE') . '" />';
		$action .= '&nbsp;<input type="button" class="button" onclick="cWindowHide();" name="' . JText::_('CC CLOSE') . '" value="' . JText::_('CC CLOSE') . '" />';
		$response->addScriptCall( 'cWindowActions' , $action );
		
		return $response->sendResponse();
	}
	
	function updateGroupOwner()
	{
		$group	=& JTable::getInstance( 'Groups' , 'CommunityTable' );

		$groupId	= JRequest::getVar( 'id' , '' , 'post' );
		$group->load( $groupId );

		$oldOwner	= $group->ownerid;
		$newOwner	= JRequest::getVar( 'ownerid' ) ;

		// Add member if member does not exist.
		if( !$group->isMember( $newOwner , $group->id ) )
		{
			$data 	= new stdClass();
			$data->groupid			= $group->id;
			$data->memberid		= $newOwner;
			$data->approved		= 1;
			$data->permissions	= 1;
			
			// Add user to group members table
			$group->addMember( $data );
			
			// Add the count.
			$group->addMembersCount( $group->id );
			
			$message	= JText::_('CC GROUP SUCCESSFULLY SAVED');
		}
		else
		{
			// If member already exists, update their permission
			$member	=& JTable::getInstance( 'GroupMembers' , 'CommunityTable' );
			$member->load( $group->id , $newOwner );
			$member->permissions	= '1';

			$member->store();
		}
		
		$group->ownerid	= $newOwner;
		$group->store();
		
		$message	= JText::_('CC GROUP OWNER SUCCESSFULLY CHANGED');
		
		$mainframe	=& JFactory::getApplication();
		$mainframe->redirect( 'index.php?option=com_community&view=groups' , $message );
	}

	/**
	 *	Adds a user to an existing group
	 **/	 	
	function addMember()
	{
		require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );
		
		$groupId	= JRequest::getVar( 'groupid' , '-1' , 'REQUEST' );
		$memberId	= JRequest::getVar( 'memberid' , '' , 'REQUEST' );
		$mainframe	=& JFactory::getApplication();
		
		if( empty($memberId) || $groupId == '-1' )
		{
			$message	= JText::_('CC INVALID ID PROVIDED');
			$mainframe->redirect( 'index.php?option=com_community&view=users' , $message , 'error');
		}

		$group		=& JTable::getInstance( 'Groups' , 'CommunityTable' );
		$model		=& $this->getModel( 'groups' );
		$group->load( $groupId );
		$user		= CFactory::getUser($memberId);
	
		
		if( !$model->isMember( $memberId , $group->id ) )
		{
			$data 	= new stdClass();
			$data->groupid		= $group->id;
			$data->memberid		= $memberId;
			$data->approved		= 1;
			$data->permissions	= 0;
			
			// Add user to group members table
			$group->addMember( $data );

			// Add the count.
			$group->addMembersCount( $group->id );
			
			$message	= JText::sprintf('%1$s has been assigned into the group %2$s.' , $user->getDisplayName() , $group->name );
			$mainframe->redirect( 'index.php?option=com_community&view=users' , $message );
		}
		$message	= JText::sprintf('Cannot assign %1$s to the group %2$s. User is already assigned to the group %2$s.' , $user->getDisplayName() , $group->name );
		$mainframe->redirect( 'index.php?option=com_community&view=users' , $message , 'error');
	}
	
	function saveGroup()
	{
		$group	=& JTable::getInstance( 'Groups' , 'CommunityTable' );
		
		$id			= JRequest::getVar( 'id' , '' , 'post' );
		
		if( empty($id) )
		{
			JError::raiseError( '500' , JText::_('CC INVALID ID') );
		}

		$postData	= JRequest::get( 'post' );
		$group->load( $id );
		
		$group->bind( $postData );

		$message	= '';		
		if( $group->store() )
		{
			$message	= JText::_('CC GROUP SUCCESSFULLY SAVED');
		}
		else
		{
			$message	= JText::_('CC ERROR WHILE SAVING GROUP');
		}
		
		$mainframe	=& JFactory::getApplication();

		$mainframe->redirect( 'index.php?option=com_community&view=groups' , $message );
	}
	
	function deleteGroup()
	{
		require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'featured.php');
    	require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'defines.community.php');
		
		$featured	= new CFeatured(FEATURED_GROUPS);
		
		$groupWithError = array();
		
		$group	=& JTable::getInstance( 'Groups' , 'CommunityTable' );
		
		$id			= JRequest::getVar( 'cid' , '' , 'post' );
		
		if( empty($id) )
		{
			JError::raiseError( '500' , JText::_('CC INVALID ID') );
		}
		
		foreach($id as $data)
		{
			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'models' .DS . 'groups.php' );
						
			//delete group bulletins
			CommunityModelGroups::deleteGroupBulletins($data);
						
			//delete group members
			CommunityModelGroups::deleteGroupMembers($data);
			
			//delete group wall
			CommunityModelGroups::deleteGroupWall($data);
			
			//delete group discussions		
			CommunityModelGroups::deleteGroupDiscussions($data);
			
			//delete group media files
			CommunityModelGroups::deleteGroupMedia($data);
						
			//load group data before delete
			$group->load( $data );
			$groupData = $group;
			
			//delete group avatar.
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
						
			if( !$group->delete( $data ) )
			{
				array_push($groupWithError, $data.':'.$groupData->name);
			}
			
    		$featured->delete( $data );
		}
		
		$message	= '';		
		if( empty($error) )
		{
			$message	= JText::_('CC GROUP DELETED');
		}
		else
		{
			$error = implode(',', $groupWithError);
			$message	= JText::_('Error while deleting group ' . $error);
		}
		
		$mainframe	=& JFactory::getApplication();

		$mainframe->redirect( 'index.php?option=com_community&view=groups' , $message );
	}
}