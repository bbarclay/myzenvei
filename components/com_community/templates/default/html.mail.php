<?php
/**
 * @package		JomSocial
 * @subpackage	Core 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<center>
<table bgcolor="#FFFFFF" width="640" cellpadding="0" cellspacing="0" border="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; text-align: left;">
<tr>
	<td background="<?php echo $template . '/images/mail_header.png' ?>" height="30"></td>
</tr>
<tr>
	<td background="<?php echo $template . '/images/mail_body.png' ?>" style="padding: 15px;">
	<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 28px; font-weight: bold; margin: 0 0 20px 0; border-bottom: 1px solid #CCCCCC;"><a href="<?php echo JURI::root();?>" style="text-decoration: none; color: #333333;"><?php echo $sitename;?></a></h1>
	<?php echo $content; ?>
	</td>
</tr>
<tr>
	<td background="<?php echo $template . '/images/mail_footer.png' ?>" height="10"></td>
</tr>
<tr>
	<td style="font-size: 11px; padding: 10px;"><center><a href="<?php echo JURI::root();?>" style="text-decoration: none;"><?php echo JURI::root();?></a></center></td>
</tr>
</table>
</center>