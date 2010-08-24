<?php 
defined('_JEXEC') or die('Restricted access');

function DefaultViewEventRowNew($view,$row,$args="") {

	$cfg = & JEVConfig::getInstance();

	$rowlink = $row->viewDetailLink($row->yup(),$row->mup(),$row->dup(),false);
	$rowlink = JRoute::_($rowlink.$view->datamodel->getCatidsOutLink());

	// I choost not to use $row->fgcolor
	$fgcolor="inherit";
	// [mic] if title is too long, cut 'em for display
	$tmpTitle = $row->title();

	if( JString::strlen( $row->title() ) >= 50 ){
		$tmpTitle = JString::substr( $row->title(), 0, 50 ) . ' ...';
	}

	$jevtask  = JRequest::getString("jevtask");
	$jevtask = str_replace(".listevents","",$jevtask);

	$showyeardate = $cfg->get("showyeardate",0);


	$times = "";
	if (($showyeardate && $jevtask=="year") || $jevtask=="search.results" || $jevtask=="cat"){

		$start_publish  = $row->getUnixStartDate();
		$stop_publish  = $row->getUnixEndDate();

		$start_date	= JEventsHTML::getDateFormat( $row->yup(), $row->mup(), $row->dup(), 0 );
		$start_time = ( $cfg->get('com_calUseStdTime') == '1' ) ?  (JUtility::isWinOS()?date("g:ia",$row->getUnixStartTime()):strftime("%I:%M%p",$row->getUnixStartTime())) : sprintf( '%02d:%02d', $row->hup(),$row->minup());

		$stop_date	= JEventsHTML::getDateFormat(  $row->ydn(), $row->mdn(), $row->ddn(), 0 );
		$stop_time	= ( $cfg->get('com_calUseStdTime') == '1' ) ?  (JUtility::isWinOS()?date("g:ia",$row->getUnixEndTime()):strftime("%I:%M%p",$row->getUnixEndTime())) : sprintf( '%02d:%02d', $row->hdn(),$row->mindn());

		if( $stop_publish == $start_publish ){
			if ($row->noendtime()){
				$times = $start_time;
			}
			else if ($row->alldayevent()){
				$times = "";
			}
			else if($start_time != $stop_time ){
				$times = $start_time . ' - ' . $stop_time;
			}
			else {
				$times = $start_time;
			}

			$times = $start_date." ". $times."<br/>";
		} else {
			if ($row->noendtime()){
				$times = $start_time;
			}
			else if($start_time != $stop_time && !$row->alldayevent()){
				$times = $start_time . '&nbsp;-&nbsp;' . $stop_time;
			}
			$times =$start_date . ' - '	. $stop_date." ". $times."<br/>";
		}
	}
	else if (($jevtask=="day" || $jevtask=="week" )  && ($row->starttime() != $row->endtime()) && !($row->alldayevent())){
		if ($row->noendtime()){
			if ($showyeardate && $jevtask=="year"){
				$times = $row->starttime(). '&nbsp;-&nbsp;' . $row->endtime() . '&nbsp;';
			}
			else {
				$times = $row->starttime(). '&nbsp;';
			}
		}
		else {
			$times = $row->starttime(). '&nbsp;-&nbsp;' . $row->endtime() . '&nbsp;';
		}
	}

	echo $times;
		?>
			<a class="ev_link_row" href="<?php echo $rowlink; ?>" <?php echo $args;?> style="font-weight:bold;color:<?php echo $fgcolor;?>;" title="<?php echo JEventsHTML::special($row->title()) ;?>"><?php echo $tmpTitle ;?></a>
			<?php
			if( $cfg->get('com_byview') == '1' ) {
				echo JText::_('JEV_BY') . '&nbsp;<i>'. $row->contactlink() .'</i>';
			}
			?>
		<?php
}