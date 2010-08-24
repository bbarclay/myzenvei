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


<?php if ( $index ) : ?>
<div id="cCategories">
	<h3><?php echo JText::_('CC CATEGORIES');?></h3>
	<ul class="category-items">
	<?php if( $categories ): ?>
		<li class="category-item">
			<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups');?>">
				<?php echo JText::_( 'CC ALL GROUPS' ); ?>
			</a>
		</li>
		<?php foreach( $categories as $row ): ?>
			<li class="category-item">
				<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&categoryid=' . $row->id ); ?>">
					<?php echo $row->name; ?>
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


<?php echo $sortings; ?>

<?php if( $index ): ?>
<h3 style="text-decoration: underline;">
	<?php echo ( isset($category) && ($category->id != '0') ) ? JText::sprintf('CC VIEW BY CATEGORY NAME' , $category->name) : JText::_( 'CC ALL GROUPS' ); ?>
</h3>
<?php endif; ?>

<div id="community-groups-results-wrapper">
	<?php echo $groupsHTML;?>
	<div class="pagination-container"><?php echo $pagination->getPagesLinks(); ?></div>
</div>