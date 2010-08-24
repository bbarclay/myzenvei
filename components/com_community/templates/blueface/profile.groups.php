<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	groups		Array	Array of groups object
 * @param	total		integer total number of groups
 * @param	user		CFactory User object 
 */
defined('_JEXEC') or die();
?>

<div class="app-box">
	<div class="app-box-header">
        <h2 class="app-box-title"><?php echo JText::_('CC PROFILE GROUPS'); ?></h2>
	</div>

	<div class="app-box-content">
        <div>
            <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&userid=' . $user->id ); ?>" class="small" style="float: left;">
                <span><?php echo JText::_('CC SHOW ALL GROUPS'); ?></span>
            </a>
            <span class="small" style="text-align: right; float: right;"><?php echo JText::sprintf((cIsPlural($total)) ? 'CC GROUPS COUNT MANY' : 'CC GROUPS COUNT', $total); ?></span>
            <div class="clr"></div>
        </div>
        <ul class="friend-right-info">
            <?php
            for($i = 0; ($i < 12) && ($i < count($groups)); $i++)
            {
                $row	=& $groups[$i];
            ?>
            <li>
                <a href="<?php echo $row->link;?>">
                    <img title="<?php echo $row->name;?>::<?php echo $row->description;?>" alt="<?php echo $row->name;?>" src="<?php echo $row->avatar; ?>" width="33" class="avatar jomTips"/>
                </a>
            </li>
            <?php
            }
            ?>
        </ul>
        <div class="clr"></div>
	</div>
</div>