<?php
/**
 * @category 	Template
 * @package		JomSocial
 * @subpackage	Core 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
?>
<script type="text/javascript">
jQuery(document).ready( function() {
	jQuery('#community-wrap ul.submenu li a:last').css('border-right', '0');
});
</script>
<div class="cSubmenu clrfix">

		<div class="buttonGroup">
		<?php
		foreach($submenu as $menu)
		{
			$action		= (isset($menu->action) && ($menu->action) ) ? ' class="action"' : '';
			$active		= '';
			
			if( isset( $menu->onclick ) && !empty( $menu->onclick) )
			{
				$link	= 'href="javascript:void(0);" onclick="' . $menu->onclick . '"';
			}
			else
			{
				$active		= ( JString::strtolower( $menu->view ) == JString::strtolower($view) && JString::strtolower( $menu->task ) == JString::strtolower($task) ) ? ' class="active"' : '';
				$link		= 'href="' . CRoute::_( $menu->link ) . '"';
			}
		?>			
			<a <?php echo $link;?><?php echo $active;?><?php echo $action;?>>
			<div class="Button">
				<div class="ButtonLeft"></div>
				<div class="ButtonMiddle"><p class="Text"><?php echo $menu->title;?></p></div>
				<div class="ButtonRight"></div>
			</div>			
			</a>
		<?php
		}
		?>
		</div>

</div>