<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	author		string
 * @param	categories	An array of category objects.
 * @param	category	An integer value of the selected category id if 0, not selected. 
 * @params	groups		An array of group objects.
 * @params	pagination	A JPagination object.  
 * @params	isJoined	boolean	determines if the current browser is a member of the group 
 * @params	isMine		boolean is this wall entry belong to me ?
 * @params	config		A CConfig object which holds the configurations for Jom Social
 * @params	sorttype	A string of the sort type. 
 */
defined('_JEXEC') or die();
?>
<?php echo $sortings; ?>
<div id="community-groups-wrap">
	<?php
	if( $featuredList )
	{
	?>
	<div class="ctitle"><?php echo JText::_('CC FEATURED GROUPS');?></div>
	<?php
		foreach($featuredList as $group)
		{
	?>
		<div class="featured-items">
			<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id );?>"><img class="avatar" src="<?php echo JURI::root() . $group->thumb;?>" alt="<?php echo $group->name;?>" /><span style="display: block;font-weight:700;"><?php echo $group->name;?></span></a>
	<?php
			if( $isCommunityAdmin )
			{
	?>
		<div class="icon-removefeatured"><a onclick="joms.featured.remove('<?php echo $group->id;?>','groups');" href="javascript:void(0);"><?php echo JText::_('CC REMOVE FEATURED'); ?></a></div>
	<?php
			}
	?>
		</div>
	<?php
		}
	?>
		<div class="clr"></div>
	<?php
	}
	?>
	<?php if ( $index ) : ?>
	<div  class="cModule">
		<h3><?php echo JText::_('CC CATEGORIES');?></h3>
		<ul style="list-style: none;">
		<?php if( $categories ): ?>
			<li style="width: 33%; background: none; display: inline;float:left; padding: 0;">
				<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups');?>">
					<?php echo JText::_( 'CC ALL GROUPS' ); ?>
				</a>
			</li>
			<?php foreach( $categories as $row ): ?>
				<li style="width: 33%; background: none; display: inline;float:left; padding: 0;">
					<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&categoryid=' . $row->id ); ?>">
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
	<?php endif; ?>

	
	
	<div class="app-box">
	<div class="app-box-header">
		<div class="app-box-header">
			<h2 class="app-box-title">
			<?php if( $index ): ?>
				<?php echo ( isset($category) && ($category->id != '0') ) ? JText::sprintf('CC VIEW BY CATEGORY NAME' , JText::_($category->name) ) : JText::_( 'CC ALL GROUPS' ); ?>
			<?php endif; ?>
			</h2>
		</div>
	</div>
	<div class="app-box-content">	
	<div id="community-groups-results-wrapper">
		<?php echo $groupsHTML;?>
		<div class="pagination-container">
			<?php echo $pagination->getPagesLinks(); ?>
		</div>
	</div>
	</div>
	<div class="app-box-footer"> <div class="app-box-footer"></div></div>
	</div>
</div>