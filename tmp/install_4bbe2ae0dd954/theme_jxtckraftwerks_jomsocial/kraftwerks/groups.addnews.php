<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @params	isMine		boolean is this group belong to me
 * @params	members		An array of member objects 
 */
defined('_JEXEC') or die();
?>
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
		<h2 class="app-box-title"></h2>
	</div>
</div>
<div class="app-box-content">

<form name="addnews" method="post" action="<?php echo CRoute::getURI(); ?>">
<table class="formtable">
		
	<?php if ( $config->get( 'htmleditor' ) == 'jce' ) : ?>
	
	<tr>
		<td class="key" colspan="2">
			<label for="title" class="label" style="text-align: left;">*<?php echo JText::_('CC NEWS TITLE'); ?></label>
		</td>
	</tr>
	<tr>
		<td class="value" colspan="2">
			<input type="text" name="title" id="title" size="40" class="inputbox" style="width: 90%" />
		</td>
	</tr>	
	<tr>
		<td class="key" colspan="2">
			<label for="message" class="label" style="text-align: left;">*<?php echo JText::_('CC NEWS DESCRIPTION'); ?></label>
		</td>
	</tr>
	<tr>
		<td class="value" colspan="2">
			<?php if( $config->get( 'htmleditor' ) ) : ?>
				<?php echo $editor->display( 'message',  $message , '95%', '450', '10', '20' , false ); ?>
			<?php else : ?>
				<textarea rows="3" cols="40" name="message" id="message" class="inputbox" style="width: 90%"></textarea>
			<?php endif; ?>
		</td>
	</tr>
		
	<?php else : ?>
	
	<tr>
		<td class="key">
			<label for="title" class="label">*<?php echo JText::_('CC NEWS TITLE'); ?></label>
		</td>
		<td class="value">
			<input type="text" name="title" id="title" size="40" class="inputbox" style="width: 90%" />
		</td>
	</tr>	
	<tr>
		<td class="key">
			<label for="message" class="label">*<?php echo JText::_('CC NEWS DESCRIPTION'); ?></label>
		</td>
		<td class="value">
			<?php if( $config->get( 'htmleditor' ) ) : ?>
				<?php echo $editor->display( 'message',  $message , '95%', '450', '10', '20' , false ); ?>
			<?php else : ?>
				<textarea rows="3" cols="40" name="message" id="message" class="inputbox" style="width: 90%"></textarea>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr>
		<td class="key"></td>
		<td class="value">
			<span class="hints"><?php echo JText::_( 'CC_REG_REQUIRED_FILEDS' ); ?></span>
		</td>
	</tr>
	
	<tr>
		<td class="key"></td>
		<td class="value">
			<input type="submit" name="submit" value="<?php echo JText::_('CC NEWS ADD REPLY'); ?>" class="button" />
			<input type="button" name="cancel" value="<?php echo JText::_('CC BUTTON CANCEL'); ?>" onclick="javascript:history.go(-1);return false;" class="button" />
		</td>
	</tr>
</table>
</form>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>