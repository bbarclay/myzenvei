<?php 
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: edit.php 1519 2009-07-16 09:09:45Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */
defined('_JEXEC') or die('Restricted access');

// get configuration object
$cfg = & JEVConfig::getInstance();
if( $cfg->get('com_calUseStdTime') == 0 ) {
	$clock24=true;
}
else $clock24=false;
if ($this->editCopy || $this->repeatId==0) {
	$repeatStyle="";
	$repeatStyle="";
}
else {
	$repeatStyle="style='display:none;'";
}
?>
   <div style="clear:both;">
    <fieldset class="jev_sed"><legend><?php echo JText::_("Start, End, Duration");?></legend>
    <span>
		<span ><?php echo JText::_('JEV_EVENT_ALLDAY');?></span>
		<span><input type="checkbox" id='allDayEvent' name='allDayEvent' <?php echo $this->row->alldayevent()?"checked='checked'":"";?> onclick="toggleAllDayEvent();" />
		</span>
    </span>
	<span style="margin:20px" class='checkbox12h'>
		<span style="font-weight:bold"><?php echo JText::_("12 Hour");?></span>
		<span><input type="checkbox" id='view12Hour' name='view12Hour' <?php echo !$clock24 ?"checked='checked'":"";?> onclick="toggleView12Hour();" value="1"/>
		</span>
	</span>
    <div>
        <fieldset><legend><?php echo JText::_('JEV_EVENT_STARTDATE'); ?></legend>
        <div style="float:left">
			<?php
			/*
			echo JHTML::calendar($this->row->startDate(), 'publish_up', 'publish_up', '%Y-%m-%d',
			array('size'=>'12',
			'maxlength'=>'10',
			'onchange'=>'checkDates(this);fixRepeatDates();'));
			*/

			$params =& JComponentHelper::getParams( JEV_COM_COMPONENT );
			$minyear = $params->get("com_earliestyear",1970);
			$maxyear = $params->get("com_latestyear",2150);
			$document =& JFactory::getDocument();
			JHTML::script("calendar11.js","components/".JEV_COM_COMPONENT."/assets/js/",true);
			JHTML::stylesheet("dashboard.css","components/".JEV_COM_COMPONENT."/assets/css/",true);
			$document->addScriptDeclaration('window.addEvent("domready", function() {
				new NewCalendar(
					{ publish_up :  "Y-m-d"},
					{
					direction:0, 
					classes: ["dashboard"],
					draggable:true,
					navigation:2,
					tweak:{x:0,y:-75},
					offset:1,
					range:{min:'.$minyear.',max:'.$maxyear.'},
					months:["'.JText::_("JEV_JANUARY").'",
					"'.JText::_("JEV_FEBRUARY").'",
					"'.JText::_("JEV_MARCH").'",
					"'.JText::_("JEV_APRIL").'",
					"'.JText::_("JEV_MAY").'",
					"'.JText::_("JEV_JUNE").'",
					"'.JText::_("JEV_JULY").'",
					"'.JText::_("JEV_AUGUST").'",
					"'.JText::_("JEV_SEPTEMBER").'",
					"'.JText::_("JEV_OCTOBER").'",
					"'.JText::_("JEV_NOVEMBER").'",
					"'.JText::_("JEV_DECEMBER").'"
					],
					days :["'.JText::_("JEV_SUNDAY").'",
					"'.JText::_("JEV_MONDAY").'",
					"'.JText::_("JEV_TUESDAY").'",
					"'.JText::_("JEV_WEDNESDAY").'",
					"'.JText::_("JEV_THURSDAY").'",
					"'.JText::_("JEV_FRIDAY").'",
					"'.JText::_("JEV_SATURDAY").'"
					], 
					onHideStart : function () { var elem = $("publish_up");checkDates(elem);fixRepeatDates();}
					}
				);
			});');


			echo '<input type="text" name="publish_up" id="publish_up" value="'.htmlspecialchars($this->row->startDate(), ENT_COMPAT, 'UTF-8').'" maxlength="10" onchange="checkDates(this);fixRepeatDates();" size="12"  />';
			
			?>
         </div>
         <div style="float:left;margin-left:20px!important;">
            <?php echo JText::_('JEV_EVENT_STARTTIME')."&nbsp;"; ?>
			<span id="start_24h_area" style="display:inline">
            <input class="inputbox" type="text" name="start_time" id="start_time" size="8" <?php echo $this->row->alldayevent()?"disabled='disabled'":"";?> maxlength="8" value="<?php echo $this->row->starttime24();?>" onchange="checkTime(this);"/>
			</span>
			<span id="start_12h_area" style="display:inline">
           	<input class="inputbox" type="text" name="start_12h" id="start_12h" size="8" maxlength="8" <?php echo $this->row->alldayevent()?"disabled='disabled'":"";?> value="" onchange="check12hTime(this);" />
      		<input type="radio" name="start_ampm" id="startAM" value="none" checked="checked" onclick="toggleAMPM('startAM');" <?php echo $this->row->alldayevent()?"disabled='disabled'":"";?> /><?php echo JText::_("am");?>
      		<input type="radio" name="start_ampm" id="startPM" value="none" onclick="toggleAMPM('startPM');" <?php echo $this->row->alldayevent()?"disabled='disabled'":"";?> /><?php echo JText::_("pm");?>
			</span>
         </div>
         </fieldset>
     </div>
    <div>
        <fieldset><legend><?php echo JText::_('JEV_EVENT_ENDDATE'); ?></legend>
        <div style="float:left">
				<?php
				/*
				echo JHTML::calendar($this->row->endDate(), 'publish_down', 'publish_down', '%Y-%m-%d',
				array('size'=>'12',
				'maxlength'=>'10',
				'onchange'=>'checkDates(this);'));
				*/
			$params =& JComponentHelper::getParams( JEV_COM_COMPONENT );
			$minyear = $params->get("com_earliestyear",1970);
			$maxyear = $params->get("com_latestyear",2150);
			$document =& JFactory::getDocument();
			JHTML::script("calendar11.js","components/".JEV_COM_COMPONENT."/assets/js/",true);
			JHTML::stylesheet("dashboard.css","components/".JEV_COM_COMPONENT."/assets/css/",true);
			$document->addScriptDeclaration('window.addEvent(\'domready\', function() {
				new NewCalendar({ publish_down :  "Y-m-d"},{
					direction:0, 
					classes: ["dashboard"],
					draggable:true,
					navigation:2,
					tweak:{x:0,y:-75},
					offset:1,
					range:{min:'.$minyear.',max:'.$maxyear.'},
					months:["'.JText::_("JEV_JANUARY").'",
					"'.JText::_("JEV_FEBRUARY").'",
					"'.JText::_("JEV_MARCH").'",
					"'.JText::_("JEV_APRIL").'",
					"'.JText::_("JEV_MAY").'",
					"'.JText::_("JEV_JUNE").'",
					"'.JText::_("JEV_JULY").'",
					"'.JText::_("JEV_AUGUST").'",
					"'.JText::_("JEV_SEPTEMBER").'",
					"'.JText::_("JEV_OCTOBER").'",
					"'.JText::_("JEV_NOVEMBER").'",
					"'.JText::_("JEV_DECEMBER").'"
					],
					days :["'.JText::_("JEV_SUNDAY").'",
					"'.JText::_("JEV_MONDAY").'",
					"'.JText::_("JEV_TUESDAY").'",
					"'.JText::_("JEV_WEDNESDAY").'",
					"'.JText::_("JEV_THURSDAY").'",
					"'.JText::_("JEV_FRIDAY").'",
					"'.JText::_("JEV_SATURDAY").'"
					], 
					onHideStart : function () { var elem = $("publish_down");checkDates(elem);}
				});
			});');


			echo '<input type="text" name="publish_down" id="publish_down" value="'.htmlspecialchars($this->row->endDate(), ENT_COMPAT, 'UTF-8').'" onchange="checkDates(this);" maxlength="10" size="12"  />';
				
			?>
         </div>
         <div style="float:left;margin-left:20px!important">
             <?php echo JText::_('JEV_EVENT_ENDTIME')."&nbsp;"; ?>
			<span id="end_24h_area" style="display:inline">
           	<input class="inputbox" type="text" name="end_time" id="end_time" size="8" maxlength="8" <?php echo ($this->row->alldayevent() || $this->row->noendtime())?"disabled='disabled'":"";?> value="<?php echo $this->row->endtime24();?>" onchange="checkTime(this);" />
			</span>
			<span id="end_12h_area" style="display:inline">
           	<input class="inputbox" type="text" name="end_12h" id="end_12h" size="8" maxlength="8" <?php echo ($this->row->alldayevent() || $this->row->noendtime())?"disabled='disabled'":"";?> value="" onchange="check12hTime(this);" />
      		<input type="radio" name="end_ampm" id="endAM" value="none" checked="checked" onclick="toggleAMPM('endAM');" <?php echo ($this->row->alldayevent() || $this->row->noendtime())?"disabled='disabled'":"";?> /><?php echo JText::_("am");?>
      		<input type="radio" name="end_ampm" id="endPM" value="none" onclick="toggleAMPM('endPM');" <?php echo ($this->row->alldayevent() || $this->row->noendtime())?"disabled='disabled'":"";?> /><?php echo JText::_("pm");?>
			</span>
		    <span style="margin-left:10px">
				<span><input type="checkbox" id='noendtime' name='noendtime' <?php echo $this->row->noendtime()?"checked='checked'":"";?> onclick="toggleNoEndTime();" value="1" />
				<span ><?php echo JText::_('JEV_EVENT_NOENDTIME');?></span>
				</span>
		    </span>
         </div>
         </fieldset>
     </div>
    <div id="jevmultiday" style="display:<?php echo $this->row->endDate()>$this->row->startDate()?"block":"none";?>">
        <fieldset><legend><?php echo JText::_('JEV_EVENT_MULTIDAY'); ?></legend>
            <?php echo JText::_('JEV_EVENT_MULTIDAY_LONG')."&nbsp;"; ?>
      		<input type="radio" name="multiday" value="1" <?php echo $this->row->multiday()?'checked="checked"':'';?>  onclick="updateRepeatWarning();" /><?php echo JText::_("JEV_YES");?>
      		<input type="radio" name="multiday" value="0" <?php echo $this->row->multiday()?'':'checked="checked"';?>  onclick="updateRepeatWarning();" /><?php echo JText::_("JEV_NO");?>
         </fieldset>
     </div>
     </fieldset>
     </div>
     <div <?php echo $repeatStyle;?>>
	 <!-- REPEAT FREQ -->
     <div style="clear:both;">
		<fieldset><legend><?php echo JText::_('JEV_EVENT_REPEATTYPE'); ?></legend>
        <table border="0" cellspacing="2">
        	<tr>                                	
            <td ><input type="radio" name="freq" id="NONE" value="none" checked="checked" onclick="toggleFreq('NONE');" /><label for='NONE'><?php echo JText::_("no repeat");?></label></td>
            <td ><input type="radio" name="freq" id="DAILY" value="DAILY" onclick="toggleFreq('DAILY');" /><label for='DAILY'><?php echo JText::_("daily");?></label></td>
            <td ><input type="radio" name="freq" id="WEEKLY" value="WEEKLY" onclick="toggleFreq('WEEKLY');" /><label for='WEEKLY'><?php echo JText::_("weekly");?></label></td>
            <td ><input type="radio" name="freq" id="MONTHLY" value="MONTHLY" onclick="toggleFreq('MONTHLY');" /><label for='MONTHLY'><?php echo JText::_("monthly");?></label></td>
            <td ><input type="radio" name="freq" id="YEARLY" value="YEARLY" onclick="toggleFreq('YEARLY');" /><label for='YEARLY'><?php echo JText::_("yearly");?></label></td>
            </tr>
		</table>
        </fieldset>
	</div>			
   <!-- END REPEAT FREQ-->
   <div style="clear:both;display:none" id="interval_div">
   		<div style="float:left">
   		<fieldset><legend><?php echo JText::_("Repeat Interval") ?></legend>
            <input class="inputbox" type="text" name="rinterval" id="rinterval" size="2" maxlength="2" value="<?php echo $this->row->interval();?>" onchange="checkInterval();" /><span id='interval_label' style="margin-left:1em"></span>
   		</fieldset>
   		</div>
   		<div style="float:left;margin-left:20px!important"  id="cu_count" >
   		<fieldset><legend><input type="radio" name="countuntil" value="count" id="cuc" checked="checked" onclick="toggleCountUntil('cu_count');" /><?php echo JText::_("Repeat Count") ?></legend>
            <input class="inputbox" type="text" name="count" id="count" size="3" maxlength="3" value="<?php echo $this->row->count();?>" onchange="checkInterval();" /><span id='count_label' style="margin-left:1em"><?php echo JText::_("repeats");?></span>
   		</fieldset>
   		</div>
   		<div style="float:left;margin-left:20px!important;" id="cu_until">
   		<fieldset style="background-color:#dddddd"><legend><input type="radio" name="countuntil" value="until" id="cuu" onclick="toggleCountUntil('cu_until');" /><?php echo JText::_("Repeat Until"); ?></legend>
			<?php
			/*
			 echo JHTML::calendar(strftime("%Y-%m-%d",$this->row->until()), 'until', 'until', '%Y-%m-%d',	array('size'=>'12','maxlength'=>'10'));
			 */
			$params =& JComponentHelper::getParams( JEV_COM_COMPONENT );
			$minyear = $params->get("com_earliestyear",1970);
			$maxyear = $params->get("com_latestyear",2150);
			$document =& JFactory::getDocument();
			JHTML::script("calendar11.js","components/".JEV_COM_COMPONENT."/assets/js/",true);
			JHTML::stylesheet("dashboard.css","components/".JEV_COM_COMPONENT."/assets/css/",true);
			$document->addScriptDeclaration('window.addEvent(\'domready\', function() {
				new NewCalendar({ until :  "Y-m-d"},{
					direction:0, 
					classes: ["dashboard"],
					draggable:true,
					navigation:2,
					tweak:{x:0,y:-75},
					offset:1,
					range:{min:'.$minyear.',max:'.$maxyear.'},
					months:["'.JText::_("JEV_JANUARY").'",
					"'.JText::_("JEV_FEBRUARY").'",
					"'.JText::_("JEV_MARCH").'",
					"'.JText::_("JEV_APRIL").'",
					"'.JText::_("JEV_MAY").'",
					"'.JText::_("JEV_JUNE").'",
					"'.JText::_("JEV_JULY").'",
					"'.JText::_("JEV_AUGUST").'",
					"'.JText::_("JEV_SEPTEMBER").'",
					"'.JText::_("JEV_OCTOBER").'",
					"'.JText::_("JEV_NOVEMBER").'",
					"'.JText::_("JEV_DECEMBER").'"
					],
					days :["'.JText::_("JEV_SUNDAY").'",
					"'.JText::_("JEV_MONDAY").'",
					"'.JText::_("JEV_TUESDAY").'",
					"'.JText::_("JEV_WEDNESDAY").'",
					"'.JText::_("JEV_THURSDAY").'",
					"'.JText::_("JEV_FRIDAY").'",
					"'.JText::_("JEV_SATURDAY").'"
					],
					onHideStart : function () { updateRepeatWarning();}
				});
			});');


			echo '<input type="text" name="until" id="until" value="'.htmlspecialchars(strftime("%Y-%m-%d",$this->row->until()), ENT_COMPAT, 'UTF-8').'" maxlength="10" size="12"   onchange="updateRepeatWarning();" />';
			
			?>

   		</fieldset>
   		</div>
   </div>
   <div style="clear:both;">
   <div  style="float:left;display:none;margin-right:1em;" id="byyearday">
   		<fieldset><legend><input type="radio" name="whichby" id="jevbyd" value="byd"  onclick="toggleWhichBy('byyearday');" /><?php echo JText::_("By Year Day"); ?></legend>
   			<?php echo JText::_("Comma separated list");?>
            <input class="inputbox" type="text" name="byyearday" size="20" maxlength="50" value="<?php echo $this->row->byyearday();?>" onchange="checkInterval();" />
   			<br/><?php echo JText::_("Count back year");?><input type="checkbox" name="byd_direction"  onclick="fixRepeatDates();" <?php echo $this->row->getByDirectionChecked("byyearday");?>/>
   		</fieldset>
   </div>
   <div  style="float:left;display:none;margin-right:1em;" id="bymonth">
   		<fieldset><legend><input type="radio" name="whichby"  id="jevbm" value="bm"  onclick="toggleWhichBy('bymonth');" /><?php echo JText::_("By Month"); ?></legend>
   			<?php echo JText::_("Comma separated list");?>
            <input class="inputbox" type="text" name="bymonth" size="30" maxlength="20" value="<?php echo $this->row->bymonth();?>" onchange="checkInterval();" />
        </fieldset>
   </div>
   <div  style="float:left;display:none;margin-right:1em;" id="byweekno">
   		<fieldset><legend><input type="radio" name="whichby"  id="jevbwn" value="bwn"  onclick="toggleWhichBy('byweekno');" /><?php echo JText::_("By Week No"); ?></legend>
   			<?php echo JText::_("Comma separated list");?>
            <input class="inputbox" type="text" name="byweekno" size="20" maxlength="20" value="<?php echo $this->row->byweekno();?>" onchange="checkInterval();" />
   			<br/>Count back from year end<input type="checkbox" name="bwn_direction"  <?php echo $this->row->getByDirectionChecked("byweekno");?> />
        </fieldset>
   </div>
   <div  style="float:left;display:none;margin-right:1em;" id="bymonthday">
   		<fieldset><legend><input type="radio" name="whichby"  id="jevbmd" value="bmd"  onclick="toggleWhichBy('bymonthday');" /><?php echo JText::_("By Month Day"); ?></legend>
   			<?php echo JText::_("Comma separated list");?>
            <input class="inputbox" type="text" name="bymonthday" size="30" maxlength="20" value="<?php echo $this->row->bymonthday();?>" onchange="checkInterval();" />
   			<br/><?php echo JText::_("Count back");?><input type="checkbox" name="bmd_direction"  onclick="fixRepeatDates();"  <?php echo $this->row->getByDirectionChecked("bymonthday");?>/>
        </fieldset>
   </div>
   <div  style="float:left;display:none;margin-right:1em;" id="byday">
   		<fieldset><legend><input type="radio" name="whichby"  id="jevbd" value="bd"  onclick="toggleWhichBy('byday');" /><?php echo JText::_("By Day"); ?></legend>           			
            <?php 
            JEventsHTML::buildWeekDaysCheck( $this->row->getByDay_days(), '' ,"weekdays");
            ?>
            <div id="weekofmonth">
   			<?php
   			JEventsHTML::buildWeeksCheck( $this->row->getByDay_weeks(), "" ,"weeknums");
            ?>
   			<br/><?php echo JText::_("Count back");?><input type="checkbox" name="bd_direction" <?php echo $this->row->getByDirectionChecked("byday");?>  onclick="updateRepeatWarning();"/>
            </div>
   		</fieldset>
   </div>
   <div  style="float:left;display:none;margin-right:1em;" id="bysetpos">
   		<fieldset><legend><?php echo "NOT YET SUPPORTED" ?></legend>
   		</fieldset>
   </div>
   </div>
   <div style="clear:both;"></div>
</div>
<script type="text/javascript" language="Javascript">
// make the correct frequency visible
function setupRepeats(){
	<?php
	if ($this->row->id()!=0 && $this->row->freq()){
		?>
		var freq = "<?php echo strtoupper($this->row->freq());?>";
		document.getElementById(freq).checked=true;
		toggleFreq(freq, true);
		var by = "<?php
		if ($this->row->byyearday(true)!="") echo "jevbyd";
		else if ($this->row->bymonth(true)!="") echo "jevbm";
		else if ($this->row->bymonthday(true)!="") echo "jevbmd";
		else if ($this->row->byweekno(true)!="") echo "jevbwn";
		else if ($this->row->byday(true)!="") echo "jevbd";
		// default repeat is by day
		else echo "jevbd";
		?>";
		document.getElementById(by).checked=true;
		var by = "<?php
		if ($this->row->byyearday(true)!="") echo "byyearday";
		else if ($this->row->bymonth(true)!="") echo "bymonth";
		else if ($this->row->bymonthday(true)!="") echo "bymonthday";
		else if ($this->row->byweekno(true)!="") echo "byweekno";
		else if ($this->row->byday(true)!="") echo "byday";
		?>";
		toggleWhichBy(by);
		var cu = "cu_<?php
		if ($this->row->rawuntil()!="") echo "until";
		else echo "count";
		?>";
		document.getElementById(cu=="cu_until"?"cuu":"cuc").checked=true;
		toggleCountUntil(cu);

		// Now reset the repeats warning so we can track any changes
		document.adminForm.updaterepeats.value = 0;
		<?php
	}
	?>
}
//if (window.attachEvent) window.attachEvent("onload",setupRepeats);
//else window.onload=setupRepeats;
//setupRepeats();
window.setTimeout("setupRepeats()", 500);
// move to 12h fields
set12hTime(document.adminForm.start_time);
set12hTime(document.adminForm.end_time);
// toggle unvisible time fields
toggleView12Hour();
</script>
