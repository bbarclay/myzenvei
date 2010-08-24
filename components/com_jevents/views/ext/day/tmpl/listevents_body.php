<?php 
defined('_JEXEC') or die('Restricted access');

$cfg	 = & JEVConfig::getInstance();

$data = $this->datamodel->getDayData( $this->year, $this->month, $this->day );

$cfg = & JEVConfig::getInstance();
$Itemid = JEVHelper::getItemid();
$cfg = & JEVConfig::getInstance();

// previous and following month names and links
$followingDay = $this->datamodel->getFollowingDay($this->year, $this->month, $this->day);
$precedingDay = $this->datamodel->getPrecedingDay($this->year, $this->month, $this->day);

?>
<table class="maintable" align="center" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="tableh1" colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr> 
					<td><h2><?php echo JText::_("Daily View");?></h2></td>
					<td class="today" align="right"><?php echo JEventsHTML::getDateFormat( $this->year, $this->month, $this->day, 0) ;?></td>
				</tr>
			</table>
	  </td>
	</tr>
		<tr>
			<td  class="previousmonth" align="center" height="22" nowrap="nowrap" valign="middle" width="33%">&nbsp;
<!-- BEGIN previous_month_link_row -->
      	<?php echo "<a href='".$precedingDay."' title='".JText::_("Preceeding Day")."' >"?>
      	<?php echo JText::_("Preceeding Day")."</a>";?>
      	

<!-- END previous_month_link_row -->
			</td>
			<td  class="currentmonth" style="background-color: rgb(208, 230, 246);" align="center" height="22" nowrap="nowrap" valign="middle">
				<?php echo JEventsHTML::getDateFormat( $this->year, $this->month, $this->day, 0) ;?>
			</td>
			<td  class="nextmonth" align="center" height="22" nowrap="nowrap" valign="middle"  width="33%">
      	<?php echo "<a href='".$followingDay."' title='next month' >"?>
      	<?php echo JText::_("Following Day")."</a>";?>
      	<?php echo "</a>";?>

			</td>
		</tr>
<?php
// Timeless Events First
if (count($data['hours']['timeless']['events'])>0){
	$start_time = JText::_("Timeless");

	echo '<tr><td class="ev_td_right" colspan="3"><ul class="ev_ul">' . "\n";
	foreach ($data['hours']['timeless']['events'] as $row) {
		$listyle = 'style="border-color:'.$row->bgcolor().';"';
		echo "<li class='ev_td_li' $listyle>\n";

		$this->viewEventRowNew ( $row);
		echo '&nbsp;::&nbsp;';
		$this->viewEventCatRowNew($row);
		echo "</li>\n";
	}
	echo "</ul></td></tr>\n";
}

for ($h=0;$h<24;$h++){
	if (count($data['hours'][$h]['events'])>0){
		$start_time = ($cfg->get('com_calUseStdTime')== '1') ? strftime("%I:%M%p",$data['hours'][$h]['hour_start']) : strftime("%H:%M",$data['hours'][$h]['hour_start']);

		echo '<tr><td class="ev_td_right" colspan="3"><ul class="ev_ul">' . "\n";
		foreach ($data['hours'][$h]['events'] as $row) {
		$listyle = 'style="border-color:'.$row->bgcolor().';"';
			echo "<li class='ev_td_li' $listyle>\n";

			$this->viewEventRowNew ( $row);
			echo '&nbsp;::&nbsp;';
			$this->viewEventCatRowNew($row);
			echo "</li>\n";
		}
		echo "</ul></td></tr>\n";
	}
}



?>
</table>