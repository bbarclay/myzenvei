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
<?php echo $sortings; ?>
<?php echo $featuredHTML; ?>

<div class="cModule">
	<h3><?php echo JText::_('CC CATEGORIES');?></h3>
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



<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
	</div>
</div>
<div class="app-box-content">
<?php echo $videosHTML; ?>
<div style="clear: both;"></div>
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>