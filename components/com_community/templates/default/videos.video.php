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

<div class="page-actions">
    <?php echo $reportHTML;?>
    <?php echo $bookmarksHTML;?>
    <div class="clr"></div>
</div>

<div class="video-full" id="<?php echo "video-" . $video->id ?>">
    <div class="video-player">
        <?php echo $video->player; ?>
    </div>
    
    <div class="video-summary" style="margin-left: <?php echo $video->_width; ?>px">		
        <div class="video-details">
            <div class="video-created">
            	<dt><?php echo JText::_('CC VIDEO CREATE DATE') ?></dt>
                <dd><?php echo JHTML::_('date', $video->created, JText::_('DATE_FORMAT_LC3')); ?></dd>
			</div>
            <div class="video-niceDuration">
				<dt><?php echo JText::_('CC VIDEO DURATION') ?></dt>
				<dd><?php echo $video->durationHMS; ?></dd>
			</div>
            <div class="video-hits">
				<dt><?php echo JText::_('CC VIDEO HITS') ?></dt>
				<dd><?php echo $video->hits; ?></dd>
			</div>
            <div class="video-wallcount">
				<dt><?php echo JText::_('CC VIDEO WALL POSTS') ?></dt>
				<dd><?php echo $video->wallcount; ?></dd>
			</div>
        </div>

        <div class="video-actions">
            <?php if ($video->canEdit) { ?>
            <a class="video-action edit icon-edit" href="javascript:void(0);" onclick="joms.videos.showEditWindow('<?php echo $video->id; ?>','<?php echo $redirectUrl;?>');"><span><?php echo JText::_('CC EDIT') ?></span></a>
            <a class="video-action delete icon-remove" href="javascript:void(0);" onclick="joms.videos.deleteVideo('<?php echo $video->id;?>');"><span><?php echo JText::_('CC DELETE') ?></span></a>
            <?php } ?>
        </div>        
    </div>
	
   
    <div class="clr"></div>

    <p class="video-description"><?php echo $video->description; ?></p>
    
    <div class="video-permalink">
        <label for="video-permalink"><?php echo JText::_('CC VIDEO PERMALINK') ?></label>
        <input id="video-permalink" type="text" readonly="" onclick="jQuery(this).focus().select()" value="<?php echo $video->permalink; ?>" name="video_link" style="width: 95%"/>
    </div>          
    
    <div class="ctitle"><?php echo JText::_('CC COMMENTS') ?></div>
    <div class="video-wall">
		<div id="wallForm"><?php echo $wallForm; ?></div>			
        <div id="wallContent"><?php echo $wallContent; ?></div>
    </div>
</div>