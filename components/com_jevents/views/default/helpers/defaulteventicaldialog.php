<?php 
defined('_JEXEC') or die('Restricted access');

function DefaultEventIcalDialog($view,$row, $mask){

        ?>
        <div id="ical_dialog"  style="position:absolute;right:0px;background-color:#dedede;border:solid 1px #000000;width:200px;padding:10px;visibility:hidden;z-index:999;">
        	<?php  ?>
        	<div style="width:12px!important;float:right;background-color:#ffffff;;border:solid #000000;border-width:0 0 1px 1px;text-align:center;margin:-10px;">
        		<a href="javascript:void(0)" onclick="closeical()" style="font-weight:bold;text-decoration:none;color:#000000;">x</a>
        	</div>
        	<a href="<?php echo $row->vCalExportLink(false,false);?>" style="text-decoration:none;" title="<?php echo JText::_("JEV_SAVEICAL")?>">
        	<?php
        	echo '<img src="'. JURI::root() . 'images/save_f2.png" style="border:0px;margin-right:1em;height:16px" alt="'.JText::_("JEV_SAVEICAL").'"  />';
             echo JText::_("JEV All Recurrences");?>
             </a><br/>
        	<a href="<?php echo $row->vCalExportLink(false,true);?>" style="text-decoration:none;" title="<?php echo JText::_("JEV_SAVEICAL")?>">
        	<?php
        	echo '<img src="'. JURI::root() . 'images/save_f2.png" alt="'.JText::_("JEV_SAVEICAL").'" style="border:0px;margin-right:1em;;height:16px"  />';
             echo JText::_("JEV Single Recurrence");?>
             </a><br/>
        	 <?php  ?>
        </div>
        <?php
}

