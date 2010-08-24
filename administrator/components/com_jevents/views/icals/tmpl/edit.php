<?php 
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: edit.php 1552 2009-09-04 09:38:02Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */
defined('_JEXEC') or die('Restricted access'); 


global $task,$catid, $mainframe;
$db	=& JFactory::getDBO();
$editor =& JFactory::getEditor();

// clean any existing cache files
$cache =& JFactory::getCache(JEV_COM_COMPONENT);
$cache->clean(JEV_COM_COMPONENT);
$action = $mainframe->isAdmin()?"index.php":"index.php?option=".JEV_COM_COMPONENT."&Itemid=".JEVHelper::getItemid();
?>
<div id="jevents">
<form action="<?php echo $action;?>" method="post" name="adminForm"  accept-charset="UTF-8" enctype="multipart/form-data" >
<table width="90%" border="0" cellpadding="2" cellspacing="2" class="adminform">
<tr><td>
<?php

global $task;

if (isset($this->editItem->ics_id)){
	$id = $this->editItem->ics_id;
	$catid = $this->editItem->catid;
	$access = $this->editItem->access;
	$srcURL = $this->editItem->srcURL;
	$filename = $this->editItem->filename;
	$label = $this->editItem->label;
	$icaltype = $this->editItem->icaltype;
	if ($srcURL == "") $filemessage=JText::_("Loaded from Local file called"." ");
	else $filemessage=JText::_("From file");
}
else {
	$id=0;
	$catid = 0;
	$access = 0;
	$srcURL = "";
	$filename = "";
	$label = "";
	$icaltype = 2;
	$filemessage=JText::_("From file");
}

// get list of groups
$db	=& JFactory::getDBO();
$query = "SELECT id AS value, name AS text"
. "\n FROM #__groups"
. "\n ORDER BY id"	;
$db->setQuery( $query );
$groups = $db->loadObjectList();

// build the html select list
$glist = JHTML::_('select.genericlist', $groups, 'access', 'class="inputbox" size="1"',	'value', 'text', $access );

$disabled ="";
echo JEventsHTML::buildScriptTag('start');
?>
function submitbutton(pressbutton) {
	if (pressbutton.substr(0, 10) == 'icals.list') {
		submitform( pressbutton );
		return;
	}

	var form = document.adminForm;
	if (form.catid.value == "0"){
		alert( "<?php echo html_entity_decode( JText::_('JEV_E_WARNCAT') ); ?>" );
		return(false);
	} else {
		//alert('about to submit the form');
		submitform(pressbutton);
	}
}
<?php
echo JEventsHTML::buildScriptTag('end');
?>
<table style="width:90%">
	<tr>
    	<td style="width:200px;font-weight:bold" colspan="3">
        <?php echo JText::_("Unique Identifier");?> : <input class="inputbox" type="text" name="icsLabel" id="icsLabel" value="<?php echo $label;?>" size="80" />
        <br/>
        <br/>
        </td>
	</tr>
	<tr>
    	<td style="width:200px;font-weight:bold" >
        <?php echo JText::_("Select Default Category")." : ". JEventsHTML::buildCategorySelect($catid ,"", null, $this->with_unpublished_cat, true,0,'catid'); ?>
        </td>
		<td width="10%" align="left"><?php echo JText::_('JEV_EVENT_ACCESSLEVEL'); ?></td>
        <td><?php echo $glist; ?></td>
	</tr>
</table>	
	<?php
	// Tabs
	jimport('joomla.html.pane');
	$tabs = & JPane::getInstance('tabs');
	echo $tabs->startPane( 'icals' );

	if ($id==0 || $icaltype==2){
	echo $tabs->startPanel( JText::_("FROM SCRATCH"), 'icalsnative' );
	if (!isset($this->editItem->isdefault) || $this->editItem->isdefault==0){
		$checked0=' checked="checked"';
		$checked1='';
	}
	else {
		$checked1=' checked="checked"';
		$checked0='';
	}
	?>
    <?php echo JText::_('JEV_EVENT_ISDEFAULT'); ?>
	<input id="isdefault0" type="radio" value="0" name="isdefault" <?php echo $checked0;?>/>
	<label for="isdefault0"><?php echo JText::_('No'); ?></label>
	<input id="isdefault1" type="radio" value="1" name="isdefault" <?php echo $checked1;?>/>
	<label for="isdefault1"><?php echo JText::_('Yes'); ?></label><br/><br/>
	<?php if ($id==0){ ?>
	<button name="newical"  title="Create New" onclick="submitbutton('icals.new');return false;"><?php echo JText::_("CREATE FROM SCRATCH");?></button>
	<?php
	}
		echo $tabs->endPanel();
	}
	
	if ($id==0 || $icaltype==1){
	echo $tabs->startPanel( $filemessage, 'icalsfile' );
	?>
	<?php if ($id==0){ ?>
	<h3><?php echo $filename;?></h3>
	<input class="inputbox" type="file" name="upload" id="upload" size="80" /><br/><br/>
	<button name="loadical"  title="Load Ical" onclick="var icalfile=document.getElementById('upload').value;if (icalfile.length==0)return false; else submitbutton('icals.save');return false;"><?php echo JText::_("Load Ical from File");?></button>
	<?php
	}
	echo $tabs->endPanel();
	}
	
	if ($id==0 || $icaltype==0){
	echo $tabs->startPanel( JText::_("From URL"), 'icalsurl' );
	?>
		<?php
		$urlsAllowed = ini_get("allow_url_fopen");
		if (!$urlsAllowed && !is_callable("curl_exec")) {
			echo "<h3>".JText::_("JEV_ICAL_IMPORTDISABLED")."</h3>";
			echo "<p>".JText::_("JEV_SAVEFILELOCALLY")."</p>";
			$disabled = "disabled";
		}
		else {
			$disabled ="";
		}
	
		if (!isset($this->editItem->autorefresh) || $this->editItem->autorefresh==0){
			$checked0=' checked="checked"';
			$checked1='';
		}
		else {
			$checked1=' checked="checked"';
			$checked0='';
		}
		?>
	    <?php echo JText::_('JEV_EVENT_AUTOREFRESH'); ?>
		<input id="autorefresh0" type="radio" value="0" name="autorefresh" <?php echo $checked0;?>/>
		<label for="autorefresh0"><?php echo JText::_('No'); ?></label>
		<input id="autorefresh1" type="radio" value="1" name="autorefresh" <?php echo $checked1;?>/>
		<label for="autorefresh1"><?php echo JText::_('Yes'); ?></label><br/><br/>
		<?php
		if (!isset($this->editItem->ignoreembedcat) || $this->editItem->ignoreembedcat==0){
			$checked0=' checked="checked"';
			$checked1='';
		}
		else {
			$checked1=' checked="checked"';
			$checked0='';
		}
		?>
			
	    <?php echo JText::_('JEV IGNORE EMBEDDED CATEGORIES'); ?>
		<input id="ignoreembedcat0" type="radio" value="0" name="ignoreembedcat" <?php echo $checked0;?>/>
		<label for="ignoreembedcat0"><?php echo JText::_('No'); ?></label>
		<input id="ignoreembedcat1" type="radio" value="1" name="ignoreembedcat" <?php echo $checked1;?>/>
		<label for="ignoreembedcat1"><?php echo JText::_('Yes'); ?></label><br/><br/>
		
		<input class="inputbox" type="text" name="uploadURL" id="uploadURL" <?php echo $disabled;?> size="120" value="<?php echo $srcURL;?>"/><br/><br/>
		<?php if ($id==0){ ?>
		<button name="loadical"  title="Load Ical"  <?php echo $disabled;?> onclick="var icalfile=document.getElementById('uploadURL').value;if (icalfile.length==0)return false; else submitbutton('icals.save');return false;"><?php echo JText::_("Load Ical from URL");?></button>
		<?php
		}
	echo $tabs->endPanel();
	}
	
	echo $tabs->endPane();
	
	?>
<input type="hidden" name="icsid" id="icsid"  <?php echo $disabled;?> value="<?php echo $id;?>"/>

</td>
</tr>
</table>
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="icals.edit" />
<input type="hidden" name="option" value="<?php echo JEV_COM_COMPONENT;?>" />
</form>
</div>