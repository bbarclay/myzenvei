<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Return the time difference. Take 
 *   
 */ 
function cTimeDifference( $start, $end )
{
	jimport('joomla.utilities.date');
	
	if(is_string($start) && ($start != intval($start))){
		$start = new JDate($start);
		$start = $start->toUnix();
	}
	
	if(is_string($end) && ($end != intval($end) )){
		$end = new JDate($end);
		$end = $end->toUnix();
	}
		
    $uts['start']      =    $start ;
    $uts['end']        =    $end ;
    if( $uts['start']!==-1 && $uts['end']!==-1 )
    {
        if( $uts['end'] >= $uts['start'] )
        {
            $diff    =    $uts['end'] - $uts['start'];
            if( $days=intval((floor($diff/86400))) )
                $diff = $diff % 86400;
            if( $hours=intval((floor($diff/3600))) )
                $diff = $diff % 3600;
            if( $minutes=intval((floor($diff/60))) )
                $diff = $diff % 60;
            $diff    =    intval( $diff );            
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
        }
        else
        {
            trigger_error( JText::_("CC TIME IS EARLIER THAN START"), E_USER_WARNING );
        }
    }
    else
    {
        trigger_error( JText::_("CC INVALID DATETIME"), E_USER_WARNING );
    }
    return( false );
}

/**
 * Return the number of seconds given the date data, which is an array of days,
 * hours, minutes and seconds 
 */ 
function cDateToSeconds($dateArray){
	
}

/**
 * Returna formatted time
 * @param	jdate		JDate object 
 */ 
function cFormatTime(&$jdate){
	jimport('joomla.utilities.date');
	return JString::strtolower($jdate->toFormat('%I:%M %p'));
}


/**
 * Return the JDate object with the correct offset.
 * If current registered user specified a custom offset, it will follow it.
 * Otherwise, it will return with default server offset  
 */ 
function cGetDate($str = ''){
	require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

	$mainframe	=& JFactory::getApplication();
	$config		=& CFactory::getConfig();	
	
	
	$extraOffset	= $config->get('daylightsavingoffset');
	
	$date	= new JDate($str);
	$my		=& JFactory::getUser();
	$cMy	= CFactory::getUser();
	
	if(!$my->id){
		$date->setOffset($mainframe->getCfg('offset') + $extraOffset);
	} else{
		if(!empty($my->params)){
			$pos = JString::strpos($my->params, 'timezone');
			
			$offset = $mainframe->getCfg('offset') + $extraOffset;
			if ($pos === false) {
			   $offset = $mainframe->getCfg('offset') + $extraOffset;
			} else {
				$offset 	= $my->getParam('timezone', -100);
			   
				$myParams	= $cMy->getParams();
				$myDTS		= $myParams->get('daylightsavingoffset');			   		
				$cOffset	= (! empty($myDTS)) ? $myDTS : $config->get('daylightsavingoffset');			   
			   
				if($offset == -100)
					$offset = $mainframe->getCfg('offset') + $extraOffset;
				else
					$offset = $offset + $cOffset;	
			}
			$date->setOffset($offset);
		} else
			$date->setOffset($mainframe->getCfg('offset') + $extraOffset);
	}
	
	return $date;
}
