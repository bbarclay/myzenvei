<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	$groupId	The current group id.
 */
defined('_JEXEC') or die();
?>
<div class="cModule">
	<p class="info"><?php echo JText::_('CC GROUP UPLOAD DESC');?></p>
	<form action="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=uploadavatar');?>" method="post" enctype="multipart/form-data">
	    <input type="file" name="filedata" size="40" class="button" />
	    <input type="submit" value="<?php echo JText::_('CC BUTTON UPLOAD');?>" class="button" />
	    <input type="hidden" name="groupid" value="<?php echo $groupId; ?>" />
	    <input type="hidden" name="action" value="avatar"/>
	</form>
	<p class="info"><?php echo JText::sprintf('CC MAX FILE SIZE FOR UPLOAD' , $uploadLimit ); ?></p>
</div>

<div class="cModule avatarPreview leftside">
	<h3><?php echo JText::_('CC GROUP LARGE AVATAR');?></h3>
	<p><?php echo JText::_('CC GROUP AVATAR NOTE LARGE');?></p>
	<img src="<?php echo $avatar;?>" alt="<?php echo JText::_('CC GROUP LARGE AVATAR');?>" border="0" />
</div>

<div class="cModule avatarPreview rightside">
	<h3><?php echo JText::_('CC GROUP THUMBNAIL AVATAR');?></h3>
	<p><?php echo JText::_('CC GROUP AVATAR NOTE SMALL');?></p>
	<img src="<?php echo $thumbnail;?>" alt="<?php echo JText::_('Thumbnail Avatar');?>" border="0" />
</div>