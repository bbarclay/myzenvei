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

<!-- Sorry, I don't like this here but RT and some others need this for now. -->
<style type="text/css">
#community-wrap .cThumbList {
	margin:				0;
	padding:			0;
	list-style: 		none;
}

	#community-wrap .cThumbList li {
		background: 		none;
		display:			block;
		float: 				left;
		line-height:		100%;
		list-style-type: 	none;
		margin: 			0 2px 2px;
		padding:			0;
	}
</style>

<ul class="cThumbList clrfix">
	<?php foreach($members as $member) { ?>
	<li><a href="<?php echo $member->profileLink;?>"><img class="avatar jomTips" src="<?php echo $member->avatar; ?>" title="<?php echo $member->tooltip; ?>" width="45" height="45" alt="<?php echo $member->displayName ?>"/></a></li>
	<?php } ?>
</ul>