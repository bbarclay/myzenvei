<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * 
 */
defined('_JEXEC') or die();
?>

<?php echo $featuredHTML; ?>

<div style="margin-bottom: 30px;">
	<div class="ctitle"><?php echo JText::_('CC CATEGORIES');?></div>
    <ul style="list-style: none;">
    <?php if( $categories ): ?>
        <li style="width: 33%; background: none; display: inline;float:left; padding: 0;">
            <a href="<?php echo CRoute::_($allVideosUrl);?>">
                <?php echo JText::_( 'CC ALL VIDEOS' ); ?>
            </a>
        </li>
        <?php foreach( $categories as $row ): ?>
            <li style="width: 33%; background: none; display: inline;float:left; padding: 0;">
                <a href="<?php echo CRoute::_($catVideoUrl . $row->id ); ?>">
                    <?php echo JText::_( $row->name ); ?>
                </a> ( <?php echo $row->count; ?> )
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li><?php echo JText::_('CC NO CATEGORIES CREATED'); ?></li>
    <?php endif; ?>
    </ul>
    <div class="clr"></div>
</div>


<?php echo $sortings; ?>

<?php echo $videosHTML; ?>
<div style="clear: both;"></div>
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>