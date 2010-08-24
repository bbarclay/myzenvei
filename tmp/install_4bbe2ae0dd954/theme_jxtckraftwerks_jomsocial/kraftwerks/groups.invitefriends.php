<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 *
 * @params	isMine		boolean is this group belong to me
 * @params	categories	Array	An array of categories object
 * @params	members		Array	An array of members object
 * @params	group		Group	A group object that has the property of a group
 * @params	wallForm	string A html data that will output the walls form.
 * @params	wallContent string A html data that will output the walls data.
 */
defined('_JEXEC') or die();
?>
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
		<h2 class="app-box-title"></h2>
	</div>
</div>
<div class="app-box-content">

<div id="community-groups-wrap" style="padding-top: 20px;">
	<div id="community-groups-news-items" class="app-box" style="width: 70%; float: left;margin-top: 0px;">
		<div class="app-box">
			<div class="app-box-l">
				<div class="app-box-r"><h2 class="expand app-box-title"><?php echo JText::_('CC MY FRIENDS');?></h2></div>
			</div>
		</div>
		<ul id="friends-list">
		<?php
			foreach( $friends as $friend )
			{
		?>
			<li id="friend-<?php echo $friend->id;?>" class="friend-list">
				<span><img width="45" height="45" src="<?php echo $friend->getThumbAvatar();?>" alt="" /></span>
				<span class="friend-name">
					<a href="javascript:void(0);" onclick="joms.groups.addInvite('friend-<?php echo $friend->id;?>');"><?php echo $friend->getDisplayName();?></a>
				</span>
				<input name="invite-list[]" value="<?php echo $friend->id;?>" type="hidden" />
			</li>
		<?php
			}
		?>
		</ul>
	</div>
	
	<form name="invited-list" id="invited-list" action="<?php echo CRoute::getURI();?>" method="post">
	<div id="friend-selected-list">
		<ul id="friends-invited">
			<li style=""><?php echo JText::_('CC SELECTED FRIENDS');?></li>
		</ul>
	</div>
	<div class="clr"></div>
	<label for="invite-message" style="font-weight: 700;: 10px;"><?php echo JText::_('CC INVITATION MESSAGE');?></label>
	<textarea id="invite-message" name="invite-message" style="margin-top: 10px; width: 92%; height: 100px;"></textarea>
	<div style="text-align: center;">
		<input type="submit" value="<?php echo JText::_('CC BUTTON SUBMIT');?>" class="button" />
	</div>
	<input type="hidden" name="groupid" value="<?php echo $group->id;?>" />
	</form>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>