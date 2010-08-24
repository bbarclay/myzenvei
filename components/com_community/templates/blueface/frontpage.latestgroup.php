<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();

if ( !empty( $groups ) ) {
	$count = 1;
?>
<div class="app-box" id="latest-groups">
	<div class="app-box-header">
    	<h2 class="app-box-title"><?php echo JText::_('CC GROUP LATEST'); ?></h2>
	</div>
    
    <div class="app-box-content">
        <ul class="avatar-list">
		<?php
		foreach ( $groups as $group ) {
		if ( $count == 1 ) {			
        ?>
            <li class="first pos-rel">
                <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>" class="avatar-link">
                    <!--<span class="tag-new"></span>-->
                    <img src="<?php echo JURI::root() . $group->avatar; ?>" alt="<?php echo $group->name; ?>" class="profile-avatar" style="float: none;" />
                </a>
                
                <div class="title">
                    <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>">
                        <?php echo JText::_( $group->name ); ?>
                    </a>
                </div>
                <div class="desc-details">
                    <?php echo JText::_( $group->description ); ?>
                </div>
            </li>
            
            <?php if ( count($groups) > 1 )  { ?>
            <li>
                <div class="desc-title"><?php echo JText::_('CC GROUP INFO OTHERS'); ?></div>
            </li>
            <?php } ?>

		<?php
        } else {
        ?>
            <li>
                <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>">
                    <img src="<?php echo JURI::root() . $group->thumb; ?>" alt="<?php echo $group->name; ?>" class="avatar jomTips" width="45" title="<?php echo htmlspecialchars( JText::_( $group->name )); ?>::<?php echo JText::_( $group->description ); ?>" />
                </a>
            </li>
		<?php
        } // end if
        $count++;
        } // end foreach
        ?>
        </ul>
	</div>

    <div class="app-box-footer" style="clear: left;">
        <a href="<?php echo JText::_('index.php?option=com_community&view=groups'); ?>">
        	<span><?php echo JText::_('CC VIEW ALL GROUPS'); ?></span>
		</a>
	</div>
        
</div>
<?php
} // end if
?>