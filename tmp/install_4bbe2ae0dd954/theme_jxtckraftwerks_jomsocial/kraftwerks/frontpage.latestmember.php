<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();
?>

<!-- Featured Members -->
<div class="app-box" id="latest-members">
	<div class="app-box-header">
    <div class="app-box-header">    
    	<h2 class="app-box-title"><?php echo JText::_('CC MEMBERS'); ?></h2>
        <div class="app-box-menus">
            <div class="app-box-menu toggle">
                <a id="members-collapse" class="app-box-menu-icon"
                   href="javascript: void(0)"
                   onclick="joms.apps.toggle('#latest-members');">
                    <span class="app-box-menu-title"><?php echo JText::_('CC EXPAND');?></span>
                </a>
            </div>
        </div>
    </div>
	</div>

    <div class="app-box-content out">

		<div class="app-box-shadow">
			<div id="latest-members-nav" class="filterlink">
				<div style="float: left;">
					<a class="newest-member active-state" href="javascript:void(0);">
					<div class="Button">
						<div class="ButtonLeft"></div>
						<div class="ButtonMiddle"><p class="Text"><?php echo JText::_('CC NEWEST MEMBERS') ?></p></div>
						<div class="ButtonRight"></div>
					</div>				
					</a>
					<a class="featured-member" href="javascript:void(0);">					
						<div class="Button">
							<div class="ButtonLeft"></div>
							<div class="ButtonMiddle"><p class="Text"><?php echo JText::_('CC FEATURED MEMBERS') ?></p></div>
							<div class="ButtonRight"></div>
						</div>	
					</a>
					<a class="active-member" href="javascript:void(0);">				
						<div class="Button">
							<div class="ButtonLeft"></div>
							<div class="ButtonMiddle"><p class="Text"><?php echo JText::_('CC ACTIVE MEMBERS') ?></p></div>
							<div class="ButtonRight"></div>
						</div>	
					</a>
					<a class="popular-member" href="javascript:void(0);">
						<div class="Button">
							<div class="ButtonLeft"></div>
							<div class="ButtonMiddle"><p class="Text"><?php echo JText::_('CC POPULAR MEMBERS') ?></p></div>
							<div class="ButtonRight"></div>
						</div>					
					</a>
					<a href="<?php echo CRoute::_('index.php?option=com_community&view=search&task=browse' ); ?>">
						<div class="Button">
							<div class="ButtonLeft"></div>
							<div class="ButtonMiddle"><p class="Text"><?php echo JText::sprintf('CC BROWSE ALL' , $totalMembers ); ?></p></div>
							<div class="ButtonRight"></div>
						</div>					
					</a>
				</div>
				<div class="loading"></div>
			</div>
		</div>
         <div class="app-box-info">         
       		 <div id="latest-members-container"><?php echo $memberList ?></div>
		 </div>
	</div>        
</div>

<div style="margin-top:-10px;margin-bottom:10px;" class="app-box-footer">
	<div class="app-box-footer">
	</div>	
</div>
<!-- Featured Members -->