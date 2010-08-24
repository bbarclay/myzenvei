<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	author		string
 * @param	id			integer the wall object id 
 * @param	authorLink 	string link to author 
 * @param	created		string(date)
 * @param	content		string 
 * @param	avatar		string(link) to avatar
 * @params	isMine		boolean is this wall entry belong to me ? 
 */
defined('_JEXEC') or die();
CFactory::load('helpers' , 'user' );
?>

<div id="wall_<?php echo $id; ?>">
	<div class="ctitle">
		<span class="createby">
			<a href="<?php echo $authorLink; ?>"><?php echo $author; ?></a>,
		</span>
		<span class="createdate"><?php echo $created; ?></span>
		<?php if($isMine) { ?>
			<span><a onclick="wallRemove(<?php echo $id; ?>);" href="javascript:void(0)">[<?php echo JText::_('CC WALL REMOVE');?>]</a></span>
		<?php } ?>
	</div>
	<div class="cavatar"><?php echo $avatarHTML; ?></div>
	<div class="ccontent-avatar"><?php echo $content; ?></div>
	<div class="clr">&nbsp;</div>
</div>

