<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: edit.php 1457 2009-06-01 09:49:51Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

global $option, $task;
$index=JRoute::_("index.php");
?>
<script type="text/javascript" language="Javascript">
function submitbutton(pressbutton) {
	if (pressbutton.substr(0, 6) == 'cancel' || (pressbutton == 'user.overview')) {
		submitform( pressbutton );
		return;
	}
	var form = document.adminForm;
	// do field validation
	if (form.user_id.value == -1) {
		alert( "<?php echo JText::_( 'MISSING USER SELECTION' ); ?>" );
	}
	else {
		submitform(pressbutton);
	}
}
</script>

<form action="<?php echo $index;?>" method="post" name="adminForm">
    <input type="hidden" name="cid" value="<?php echo $this->jevuser->id;?>" />
	<table border="0" cellpadding="2" cellspacing="2" class="adminform" >
		<tr>
			<td width="20%"><?php echo JText::_("User");?></td>
			<td><?php echo $this->users;?></td>
		</tr>
		<tr>
			<td><?php echo JText::_("User Enabled?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "published", null,$this->jevuser->published);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Create Events?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "cancreate", null,$this->jevuser->cancreate);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Events Limit");?></td>
			<td>
			<input type="text" size="15" name="eventslimit" id="eventslimit" value="<?php echo $this->jevuser->eventslimit;?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Publish Own?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "canpublishown", null,$this->jevuser->canpublishown);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Delete Own Events?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "candeleteown", null,$this->jevuser->candeleteown);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Edit Events?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "canedit", null,$this->jevuser->canedit);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Publish All?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "canpublishall", null,$this->jevuser->canpublishall);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Delete All Events?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "candeleteall", null,$this->jevuser->candeleteall);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Upload Images?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "canuploadimages", null,$this->jevuser->canuploadimages);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Can Up-load Files?");?></td>
			<td><?php 
			echo JHTML::_("select.booleanlist", "canuploadmovies", null,$this->jevuser->canuploadmovies);
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_("Extras Limit");?></td>
			<td>
			<input type="text" size="15" name="extraslimit" id="extraslimit" value="<?php echo $this->jevuser->extraslimit;?>" />
			</td>
		</tr>
	
    </table>
    <input type="hidden" name="hidemainmenu" value="" />
	<input type="hidden" name="task" value="<?php echo $task; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
	