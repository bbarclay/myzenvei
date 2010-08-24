<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 **/
defined('_JEXEC') or die();
?>
<script type="text/javascript"> joms.filters.bind();</script>


<!-- begin: #cProfileWrapper -->
<div id="cProfileWrapper">

	<!-- begin: .cLayout -->
	<div class="cLayout clrfix">

		<!-- begin: .cSidebar -->
	    <div class="cSidebar clrfix">
			<?php $this->renderModules( 'js_side_top' ); ?>
			<?php $this->renderModules( 'js_profile_side_top' ); ?>
			<?php echo $about; ?>
			<?php echo $friends; ?>
			<?php $this->renderModules( 'js_profile_side_bottom' ); ?>
			<?php $this->renderModules( 'js_side_bottom' ); ?>
	    </div>
	    <!-- end: .cSidebar -->




        <!-- begin: .cMain -->
	    <div class="cMain">
		    <div class="app-box-header"><div class="app-box-header">			
			<h2 style="float:left;width:60%;" class="app-box-title"><?php echo $profileOwnerName ?></h2>
			<div style="padding-top:14px;" class="page-actions">
			  <?php echo $reportsHTML;?>
			  <?php echo $bookmarksHTML;?>
			</div>
			</div></div>
			<?php echo @$header; ?>
			
			<?php $this->renderModules( 'js_profile_feed_top' ); ?>
			
			<div class="app-box">
				<div class="app-box-header"><div class="app-box-header"></div></div>
				<div class="app-box-content">
					<div id="activity-stream-nav" class="filterlink">
						<div style="float: right;">
							<a class="p-active-profile-and-friends-activity active-state" href="javascript:void(0);">							
							<div class="Button">
								<div class="ButtonLeft"></div>
								<div class="ButtonMiddle"><p class="Text"><?php echo JText::sprintf('CC PROFILE OWNER AND FRIENDS' , $profileOwnerName );?></p></div>
								<div class="ButtonRight"></div>
							</div>
							</a>
							<a class="p-active-profile-activity" href="javascript:void(0);">							
							<div class="Button">
								<div class="ButtonLeft"></div>
								<div class="ButtonMiddle"><p class="Text"><?php echo $profileOwnerName ?></p></div>
								<div class="ButtonRight"></div>
							</div>
							</a>
						</div>
						<div class="loading"></div>
					</div>
					
					<div style="position: relative;">
						<div id="activity-stream-container">
						<?php echo $newsfeed; ?>
						</div>
					</div>
				</div>
				<div class="app-box-footer"> <div class="app-box-footer"> </div> </div>
			</div>
			
			<?php $this->renderModules( 'js_profile_feed_bottom' ); ?>
			<?php echo $content; ?> 
			<?php $this->renderModules( 'js_profile_bottom' ); ?>


		</div>
	    <!-- end: .cMain -->

	</div>
	<!-- end: .cLayout -->

</div>
<!-- begin: #cProfileWrapper -->