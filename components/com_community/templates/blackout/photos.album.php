<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @param	applications	An array of applications object
 * @param	pagination		JPagination object 
 */
defined('_JEXEC') or die();
?>
<ul id="photo-items" class="photo-list">
	<?php
	if($photos)
	{	
		for( $i = 0; $i < count( $photos ); $i++ )
		{
			$row	=& $photos[$i];
	?>
	<li class="hasTip" title="<?php echo htmlspecialchars($row->caption);?>::">
		<a href="<?php echo CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $row->albumid) . '#photoid=' . $row->id ;?>">
			<img class="avatar" alt="<?php echo htmlspecialchars($row->caption);?>" src="<?php echo $row->thumbnail;?>" />
		</a>
	</li>
	<?php
		}
	}
	else
	{
	?>
		<li><?php echo JText::_('CC NO PHOTOS UPLOADED YET');?></li>
	<?php
	}
	?>
</ul>
