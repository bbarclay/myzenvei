<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	posted	boolean	Determines whether the current state is a posted event.
 * @param	search	string	The text that the user used to search 
 */
defined('_JEXEC') or die();
?>
<div id="community-groups-wrap">
	<form method="post" action="">
		<input type="text" class="inputbox" name="search" value="" size="40" />
		<input type="submit" value="<?php echo JText::_('CC SEARCH BUTTON');?>" class="button" />
	</form>

	<?php
	if( $posted )
	{
	?>
		<div style="border: 1px solid #eee; padding: 4px; background-color: #fff;">
			<span style="float: left; width: 50%;"><?php echo JText::sprintf( 'CC SEARCH RESULT' , $search ); ?></span>
			<span style="float: right; text-align: right;">
				<?php echo JText::sprintf( (cIsPlural($groupsCount)) ? 'CC SEARCH RESULT TOTAL MANY' : 'CC SEARCH RESULT TOTAL' , $groupsCount ); ?></span>
			<div style="clear:both;"></div>
		</div>
		<?php echo $groupsHTML; ?>
	<?php
	}
	?>
</div>