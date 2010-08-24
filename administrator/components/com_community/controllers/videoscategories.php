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
class CommunityControllerVideosCategories extends CommunityController
{
	function __construct()
	{
		parent::__construct();
		
		$this->registerTask( 'publish' , 'savePublish' );
		$this->registerTask( 'unpublish' , 'savePublish' );
	}

	function ajaxTogglePublish( $id , $type )
	{
		return parent::ajaxTogglePublish( $id , $type , 'videoscategories' );
	}
	
	function ajaxSaveCategory( $data )
	{
		$response	= new JAXResponse();
	
		$row		=& JTable::getInstance( 'videoscategories', 'CommunityTable' );
		$row->load( $data['id'] );
		$row->name			= $data['name'];
		$row->description	= $data['description'];
		$row->store();
		
		if( $data['id'] != 0 )
		{
			// Update the rows in the table at the page.			
			$response->addAssign( 'videos-title-' . $data['id'] , 'innerHTML' , $row->name );
			$response->addAssign( 'videos-description-' . $data['id'] , 'innerHTML' , $row->description );
		}
		else
		{	
			$response->addScriptCall('azcommunity.redirect', JURI::base() . 'index.php?option=com_community&view=videoscategories');
		}
		$response->addScriptCall('cWindowHide');
		
		return $response->sendResponse();
	}
	
	function ajaxEditCategory( $id )
	{
		$response	= new JAXResponse();
		
		$uri		= JURI::base();
		$db			=& JFactory::getDBO();
		$data		= '';
		
		$row		=& JTable::getInstance( 'videoscategories', 'CommunityTable' );
		$row->load( $id );

		ob_start();
?>
		<div style="line-height: 32px; padding-bottom: 10px;">
			<img src="<?php echo $uri; ?>components/com_community/assets/icons/groups_add.gif" style="float: left;" />
			<?php echo JText::_('CC CREATE NEW VIDEOS CATEGORIES');?>
		</div>
		<div style="clear: both;"></div>
		
		<form action="#" method="post" name="editVideosCategory" id="editVideosCategory">
		<table cellspacing="0" class="admintable" border="0" width="100%">
			<tbody>
				<tr>
					<td class="key" width="10%"><?php echo JText::_('CC NAME');?></td>
					<td>:</td>
					<td><input type="text" name="name" size="35" value="<?php echo ($id) ? $row->name : ''; ?>" /></td>
				</tr>
				<tr>
					<td class="key" valign="top"><?php echo JText::_('CC DESCRIPTION');?></td>
					<td valign="top">:</td>
					<td>
						<textarea name="description" rows="5" cols="30"><?php echo ($id) ? $row->description : ''; ?></textarea>
					</td>
				</tr>
			</tbody>
		
			<input type="hidden" name="id" value="<?php echo ($id) ? $row->id : 0; ?>" />
		</table>
		</form>

<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$buttons	= '<input type="button" class="button" onclick="javascript:azcommunity.saveVideosCategory();return false;" value="' . JText::_('CC SAVE') . '"/>';
		$buttons	.= '&nbsp;&nbsp;<input type="button" class="button" onclick="javascript:cWindowHide();" value="' . JText::_('CC CANCEL') . '"/>';

		$response->addAssign('cWindowContent', 'innerHTML' , $contents);
		$response->addScriptCall( 'cWindowActions' , $buttons );
		return $response->sendResponse();
	}

	/**
	 * Remove a category
	 **/	 	
	function removecategory()
	{
		$mainframe	=& JFactory::getApplication();
		
		$ids	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$count	= count($ids);

		$row		=& JTable::getInstance( 'videoscategories', 'CommunityTable' );
		
		foreach( $ids as $id )
		{
			if(!$row->delete( $id ))
			{
				// If there are any error when deleting, we just stop and redirect user with error.
				$message	= JText::_('CC THERE ARE VIDEOS STILL ASSIGNED TO THE CATEGORIES');
				$mainframe->redirect( 'index.php?option=com_community&view=videoscategories' , $message);
				exit;
			}
		}
		$message	= JText::sprintf( '%1$s Category(s) successfully removed.' , $count );
		$mainframe->redirect( 'index.php?option=com_community&view=videoscategories' , $message );
	}
	
	function Publish()
	{
	    //TODO
		exit;
	}
}