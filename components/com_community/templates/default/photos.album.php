<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	applications	An array of applications object
 * @param	pagination		JPagination object 
 */
defined('_JEXEC') or die();
?>
<div class="page-actions">
  <?php echo $bookmarksHTML;?>
  <div class="clr"></div>
</div>

<?php if( !empty($album->description) ) { ?>
<div class="community-photo-desc"><?php echo $album->description; ?></div>
<?php } ?>

<div id="community-photo-items" class="photo-list-item">
<div class="container">
	<?php
	if($photos)
	{	
		for( $i=0; $i<count($photos); $i++ )
		{
			$row =& $photos[$i];
	?>
        <div class="photo-item jomTips" title="<strong><?php echo htmlspecialchars($row->caption);?></strong>">
            <a href="<?php echo $row->link;?>">
                <img src="<?php echo $row->getThumbURI();?>" alt="<?php echo htmlspecialchars($row->caption);?>"/>
            </a>
        </div>
	<?php
		}
	?>
		<div class="clr"></div>
    <?php
	}
	else
	{
	?>
		<div><?php echo JText::_('CC NO PHOTOS UPLOADED YET');?></div>
	<?php
	}
	?>
</div>
</div>