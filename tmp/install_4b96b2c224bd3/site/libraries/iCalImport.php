<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: iCalImport.php 1652 2010-01-05 01:31:39Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


// This class doesn't yet deal with repeating events

class iCalImport
{
	/**
	 * This array saves the iCalendar parsed data as an array - may make a class later!
	 *
	 * @var array
	 */
	var $cal			= array();

	var $key;
	var $rawData		= '';
	var $srcURL			= '';
	var $eventCount		= -1;
	var $todoCount		= -1;

	var $vevents	= array();

	function __construct () {

	}
	// constructor
	function import($filename,$rawtext="")
	{
		@ini_set("max_execution_time",600);

		echo JText::sprintf("Importing events from ical file %s", $filename)."<br/>";
		$cfg = & JEVConfig::getInstance();
		$option = JEV_COM_COMPONENT;
		// resultant data goes here
		if ($filename!=""){
			$file = $filename;
			if (!file_exists($file)) {
				global $mainframe;
				$file = JPATH_SITE."/components/$option/".$filename;
			}
			if (!file_exists($file)) {
				echo "I hope this is a URL!!<br/>";
				$file = $filename;
			}

			// get name
			$isFile = false;
			if (isset($_FILES['upload']) && is_array($_FILES['upload']) ) {
				$uploadfile = $_FILES['upload'];
				// MSIE sets a mime-type of application/octet-stream
				if ($uploadfile['size']!=0 && ($uploadfile['type']=="text/calendar" || $uploadfile['type']=="application/octet-stream")){
					$this->srcURL = $uploadfile['name'];
					$isFile = true;
				}
			}
			if ($this->srcURL =="")  {
				$this->srcURL = $file;
			}

			// $this->rawData = iconv("ISO-8859-1","UTF-8",file_get_contents($file));

			if (is_callable("curl_exec")){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,($isFile?"file://":"").$file);
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
				curl_setopt($ch, CURLOPT_POST, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				$this->rawData = curl_exec($ch);
				curl_close ($ch);
			}
			else {
				$this->rawData = @file_get_contents($file);
			}
			if ($this->rawData === false) {
				// file_get_contents: no or blocked wrapper for $file
				JError::raiseNotice(0, 'file_get_contents() failed, try fsockopen');
				$parsed_url = parse_url($file);
				if ($parsed_url === false) {
					JError::raiseWarning(0, 'url not parsed: ' . $file);
				} else {
					if ($parsed_url['scheme'] == 'http' || $parsed_url['scheme'] == 'https') {
						// try socked connection
						$fsockhost = $parsed_url['host'];
						$fsockport = 80;
						if ($parsed_url['scheme'] == 'https') {
							$fsockhost = 'ssl://' . $fsockhost;
							$fsockport = 443;
						}
						if (array_key_exists('port', $parsed_url)) $fsockport = $parsed_url['port'];

						$fh = @fsockopen($fsockhost, $fsockport, $errno, $errstr, 3);
						if ($fh === false) {
							// fsockopen: no connect
							JError::raiseWarning(0, 'fsockopen: no connect for ' . $file.' - '.$errstr );
							return false;
						} else {
							$fsock_path = ((array_key_exists('path', $parsed_url)) ? $parsed_url['path'] : '')
							. ((array_key_exists('query', $parsed_url)) ? $parsed_url['query'] : '')
							. ((array_key_exists('fragment', $parsed_url)) ? $parsed_url['fragment'] : '');
							fputs($fh, "GET $fsock_path HTTP/1.0\r\n");
							fputs($fh, "Host: ".$parsed_url['host']."\r\n\r\n");
							while(!feof($fh)) {
								$this->rawData .= fread($fh,4096);
							}
							fclose($fh);
							$this->rawData = substr($this->rawData, strpos($this->rawData, "\r\n\r\n")+4);
						}
					}
				}
			}

			// Returns true if $string is valid UTF-8 and false otherwise.
			/*
			$isutf8 = $this->detectUTF8($this->rawData);
			if ($isutf8) {
			$this->rawData = iconv("ISO-8859-1","UTF-8",$this->rawData);
			}
			*/

		}
		else {
			$this->srcURL="n/a";
			$this->rawData = $rawtext;
		}
		;
		// get rid of spurious carriage returns and spaces
		//$this->rawData = preg_replace("/[\r\n]+ ([:;])/","$1",$this->rawData);

		// simplify line feed
		$this->rawData = str_replace("\r\n","\n",$this->rawData);

		// remove spurious lines before calendar start
		if (!stristr($this->rawData,'BEGIN:VCALENDAR')) {
			JError::raiseWarning(0, 'Not a valid VCALENDAR data file: ' . $this->srcURL);
		}
		$begin = strpos($this->rawData,"BEGIN:VCALENDAR",0);
		$this->rawData = substr($this->rawData,$begin);
		//		$this->rawData = preg_replace('/^.*\n(BEGIN:VCALENDAR)/s', '$1', $this->rawData, 1);

		// unfold content lines according the unfolding procedure of rfc2445
		$this->rawData = str_replace("\n ","",$this->rawData);
		$this->rawData = str_replace("\n\t","",$this->rawData);

		// TODO make sure I can always ignore the second line
		// Some google calendars has spaces and carriage returns in their UIDs

		// Convert string into array for easier processing
		$this->rawData = explode("\n", $this->rawData);

		$skipuntil = null;
		foreach ($this->rawData as $vcLine) {
			//$vcLine = trim($vcLine); // trim one line
			if (!empty($vcLine))
			{
				// skip unhandled block
				if ($skipuntil) {
					if (trim($vcLine) == $skipuntil) {
						// found end of block to skip
						$skipuntil = null;
					}
					continue;
				}
				$matches = explode(":",$vcLine,2);


				if (count($matches) == 2) {
					list($this->key,$value)= $matches;
					//$value = str_replace('\n', "\n", $value);
					//$value = stripslashes($value);
					$append=false;

					// Treat Accordingly
					switch ($vcLine) {
						case "BEGIN:VTODO":
							// start of VTODO section
							$this->todoCount++;
							$parent = "VTODO";
							break;

						case "BEGIN:VEVENT":
							// start of VEVENT section
							$this->eventCount++;
							$parent = "VEVENT";
							break;

						case "BEGIN:VCALENDAR":
						case "BEGIN:DAYLIGHT":
						case "BEGIN:VTIMEZONE":
						case "BEGIN:STANDARD":
							$parent = $value; // save tu array under value key
							break;

						case "END:VTODO":
						case "END:VEVENT":

						case "END:VCALENDAR":
						case "END:DAYLIGHT":
						case "END:VTIMEZONE":
						case "END:STANDARD":
							$parent = "VCALENDAR";
							break;

						default:
							// skip unknown BEGIN/END blocks
							if ($this->key == 'BEGIN') {
								$skipuntil = 'END:' . $value;
								break;
							}
							// Generic processing
							$this->add_to_cal($parent, $this->key, $value,$append);
							break;
					}
				} else {
					// ignore these lines go
				}
			}
		}
		// Sort the events into start date order
		// there's little point in doing this id an RRULE is present!
		//	usort($this->cal['VEVENT'], array("iCalImport","comparedates"));

		// Populate vevent class - should do this first trawl through !!
		if (array_key_exists("VEVENT",$this->cal)) {
			foreach ($this->cal["VEVENT"] as $vevent){
				$this->vevents[] = iCalEvent::iCalEventFromData($vevent);
			}
		}
		return $this;
	}

	function add_to_cal($parent, $key, $value, $append)
	{

		// I'm not interested in when the events were created/modified
		if (($key == "DTSTAMP") or ($key == "LAST-MODIFIED") or ($key == "CREATED")) return;

		if ($key == "RRULE" && $value!="") {
			$value = $this->parseRRULE($value,$parent);
		}

		$rawkey="";
		if (stristr($key,"DTSTART") || stristr($key,"DTEND") || stristr($key,"EXDATE")) {
			list($key,$value,$rawkey,$rawvalue) = $this->handleDate($key,$value);

			if (stristr($key,"DTEND") == "DTEND" && strlen($rawvalue) == 8) {
				// all day event detected YYYYMMDD, set DTEND to last second of previous day
				$value -= 1;
			}
		}
		if (stristr($key,"DURATION")) {
			list($key,$value,$rawkey,$rawvalue) = $this->handleDuration($key,$value);
		}

		switch ($parent)
		{
			case "VTODO":
				$this->cal[$parent][$this->todoCount][$key] = $value;
				break;

			case "VEVENT":
				// strip off unnecessary quoted printable encoding message
				$parts = explode(';',$key);
				if (count($parts)>1 ){
					$key=$parts[0];
					for ($i=1; $i<count($parts);$i++) {
						if ($parts[$i]=="ENCODING=QUOTED-PRINTABLE"){
							//$value=str_replace("=0D=0A","<br/>",$value);
							$value=quoted_printable_decode($value);
						}
						// drop other ibts like language etc.
					}
				}

				// Special treatment of
				if (strpos($key,"EXDATE")===false){
					$target =& $this->cal[$parent][$this->eventCount][$key];
					$rawtarget =& $this->cal[$parent][$this->eventCount][$rawkey];
				}
				else {

					if (!array_key_exists("EXDATE",$this->cal[$parent][$this->eventCount])){
						$this->cal[$parent][$this->eventCount]["EXDATE"]=array();
						$this->cal[$parent][$this->eventCount]["RAWEXDATE"]=array();
					}
					if (is_array($value)){
						$this->cal[$parent][$this->eventCount]["EXDATE"] = array_merge($this->cal[$parent][$this->eventCount]["EXDATE"], $value);
						$this->cal[$parent][$this->eventCount]["RAWEXDATE"][count($this->cal[$parent][$this->eventCount]["RAWEXDATE"])] = $rawvalue;
						break;
					}
					else {
						$target =& $this->cal[$parent][$this->eventCount]["EXDATE"][count($this->cal[$parent][$this->eventCount]["EXDATE"])];
						$rawtarget =& $this->cal[$parent][$this->eventCount]["RAWEXDATE"][count($this->cal[$parent][$this->eventCount]["RAWEXDATE"])];
					}
				}

				// Remove escaping of text
				$value = str_replace('\,',',',$value);
				$value = str_replace('\;',';',$value);

				// convert URLs to links
				//$value = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $value);
				//$value = preg_replace('@(?<![">])\b(?:(?:https?|ftp)://|www\.|ftp\.)[-A-Z0-9+&@#/%=~_|$?!:,.]*[A-Z0-9+&@#/%=~_|$]@',"<a href=\"\\0\">\\0</a>", $value);
				if (is_string($value)){
					if (strpos(str_replace(" ","",strtolower($value)),"<ahref=")===false && strpos(str_replace(" ","",strtolower($value)),"<img")===false){
						$value = preg_replace('@(https?://([\w-.]+)+(:\d+)?(/([\w/_.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $value);
					}
				}

				// THIS IS NEEDED BECAUSE OF DODGY carriage returns in google calendar UID
				// TODO check its enough
				if ($append){
					$target .= $value;
				}
				else {
					$target = $value;
				}
				if ($rawkey!=""){
					$rawtarget = $rawvalue;
				}
				break;

			default:
				$this->cal[$parent][$key] = $value;
				break;
		}
	}

	function parseRRULE($value, $parent)
	{
		$result = array();
		$parts = explode(';',$value);
		foreach ($parts as $part) {
			if (strlen($part)==0) continue;
			$portion = explode('=', $part);
			if (stristr($portion[0],"UNTIL")){
				$untilArray = $this->handleDate($portion[0],$portion[1]);
				$result[$untilArray[0]] = $untilArray[1];
				$result[$untilArray[2]] = $untilArray[3];
			}
			else $result[$portion[0]] = $portion[1];

		}
		return $result;
	}

	/**
	 * iCal spec represents date in ISO 8601 format followed by "T" then the time
	 * a "Z at the end means the time is UTC and not local time zone
	 * 
	 * TODO make sure if time is UTC we take account of system time offset properly
	 * 
	 */
	function unixTime($ical_date)
	{
		jimport("joomla.utilities.date");

		static $offset = null;
		if (is_null($offset)) {
			$config	=& JFactory::getConfig();
			$offset = $config->getValue('config.offset', 0);

		}
		if (!is_numeric($ical_date)){
			$t = strtotime($ical_date);

			if (strpos($ical_date,"Z")>0){
				if (is_callable("date_default_timezone_set")){
					$timezone= date_default_timezone_get();
					// See http://www.php.net/manual/en/timezones.php
					$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
					// server offset tiemzone
					if ($params->get("icaltimezone","")!=""){
						date_default_timezone_set($params->get("icaltimezone",""));
					}
					
					// server offset PARAMS
					$serveroffset1 = (strtotime(strftime('%Y%m%dT%H%M%S',$t))-strtotime(strftime('%Y%m%dT%H%M%SZ',$t)))/3600;

					// server offset SERVER
					date_default_timezone_set($timezone);				
					$serveroffset2 = (strtotime(strftime('%Y%m%dT%H%M%S',$t))-strtotime(strftime('%Y%m%dT%H%M%SZ',$t)))/3600;
					$t = new JDate($ical_date,($serveroffset1-$serveroffset2) );					
					
					//$t = new JDate($ical_date );
					
					date_default_timezone_set($timezone);					
					
					echo "icaldate = ".$ical_date." imported date=".$t->toMySQL()."<br/>";
				}
				else {
					// Summer Time adjustment
					list($y,$m,$d,$h,$min,$s) = explode(":", strftime('%Y:%m:%d:%H:%M:%S',$t));
					$dst = (mktime($h,$min,$s,$m,$d,$y,0)-mktime($h,$min,$s,$m,$d,$y,-1))/3600;
					// server offset including DST
					$serveroffset = (strtotime(strftime('%Y%m%dT%H%M%S',$t))-strtotime(strftime('%Y%m%dT%H%M%SZ',$t)))/3600;
					$serveroffset += $dst;

					$t = new JDate($ical_date , -($serveroffset+$offset));
				}
/*
				echo "<h3>SET TIMEZONE</h3>";
				$timezone= date_default_timezone_get();
				date_default_timezone_set('America/New_York');

				$tempIcal  = "20091020T163000Z";
				echo $tempIcal."<br/>";
				$temp = strtotime($tempIcal);
				list($y,$m,$d,$h,$min,$s) = explode(":", strftime('%Y:%m:%d:%H:%M:%S',$temp));
				echo "$y,$m,$d,$h,$min,$s<br/>";
				$dst = (mktime($h,$min,$s,$m,$d,$y,0)-mktime($h,$min,$s,$m,$d,$y,-1))/3600;
				$so = (strtotime(strftime('%Y%m%dT%H%M%S',$temp))-strtotime(strftime('%Y%m%dT%H%M%SZ',$temp)))/3600;
				echo " dst=".$dst." serverforoffset=".$so."<br/>";
				$so += $dst;
				$t = new JDate($tempIcal);
				echo $t->toMySQL()."<br><br/>";


				$tempIcal  = "20091029T163000Z";
				echo $tempIcal."<br/>";
				$temp = strtotime($tempIcal);
				list($y,$m,$d,$h,$min,$s) = explode(":", strftime('%Y:%m:%d:%H:%M:%S',$temp));
				echo "$y,$m,$d,$h,$min,$s<br/>";
				$dst = (mktime($h,$min,$s,$m,$d,$y,0)-mktime($h,$min,$s,$m,$d,$y,-1))/3600;
				$so = (strtotime(strftime('%Y%m%dT%H%M%S',$temp))-strtotime(strftime('%Y%m%dT%H%M%SZ',$temp)))/3600;
				echo " dst=".$dst." serverforoffset=".$so."<br/>";
				$so += $dst;
				$t = new JDate($tempIcal );
				echo $t->toMySQL()."<br><br/>";

				$tempIcal  = "20091103T163000Z";
				echo $tempIcal."<br/>";
				$temp = strtotime($tempIcal);
				list($y,$m,$d,$h,$min,$s) = explode(":", strftime('%Y:%m:%d:%H:%M:%S',$temp));
				echo "$y,$m,$d,$h,$min,$s<br/>";
				$dst = (mktime($h,$min,$s,$m,$d,$y,0)-mktime($h,$min,$s,$m,$d,$y,-1))/3600;
				$so = (strtotime(strftime('%Y%m%dT%H%M%S',$temp))-strtotime(strftime('%Y%m%dT%H%M%SZ',$temp)))/3600;
				echo " dst=".$dst." serverforoffset=".$so."<br/>";
				$so += $dst;
				$t = new JDate($tempIcal);
				echo $t->toMySQL()."<br>";
*/

			}
			else {
				// really should use the timezone of the inputted date
				$t = new JDate($ical_date);
			}
			//$result = $t->toMySQL();
			$result = $t->toUnix();

			return $result;
		}

		$isUTC = false;
		if (strpos($ical_date,"Z")!== false){
			$isUTC = true;
		}
		// strip "T" and "Z" from the string
		$ical_date = str_replace('T', '', $ical_date);
		$ical_date = str_replace('Z', '', $ical_date);

		// split it out intyo YYYY MM DD HH MM SS
		preg_match("#([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})([0-9]{0,2})#", $ical_date,$date);
		list($temp,$y,$m,$d,$h,$min,$s)=$date;
		if (!$min) $min=0;
		if (!$h) $h=0;
		if (!$d) $d=0;
		if (!$s) $s=0;

		// Trap unix dated beofre 1970
		$y = max($y,1970);
		if ($isUTC) {
			$t = gmmktime($h,$min,$s,$m,$d,$y) + 3600 * $offset;
			$result = strtotime(gmdate('Y-m-d H:i:s', $t));
		} else {
			$result = mktime($h,$min,$s,$m,$d,$y);
		}

		// double check!!
		//list($y1,$m1,$d1,$h1,$min1,$s1)=explode(":",strftime('%Y:%m:%d:%H:%M:%S',$result));
		return  $result;
	}

	function handleDate($key, $value)
	{
		$rawvalue = $value;
		// we have an array of exdates
		if (strpos($key,"EXDATE")===0 && strpos($value,",")>0){
			$parts = explode(",",$value);
			$value = array();
			foreach ($parts as $val){
				$value[] = $this->unixTime($val);
			}
		}
		else {
			$value = $this->unixTime($value);
		}
		$parts = explode(";",$key);

		if (count($parts)<2 || strlen($parts[1])==0)
		{
			$rawkey=$key."RAW";
			return array($key,$value, $rawkey, $rawvalue);
		}
		$key = 	$parts[0];
		$rawkey=$key."RAW";
		return array($key,$value, $rawkey, $rawvalue);
	}

	function handleDuration($key,$value)
	{
		$rawvalue = $value;
		// strip "P" from the string
		$value = str_replace('P', '', $value);
		// split it out intyo W D H M S
		preg_match("/([0-9]*W)*([0-9]*D)*T?([0-9]*H)*([0-9]*M)*([0-9]*S)*/",$value,$details);
		@list($temp,$w,$d,$h,$min,$s)=$details;
		$duration = 0;
		$multiplier=1;
		$duration += intval(str_replace('S','',$s))*$multiplier;
		$multiplier=60;
		$duration += intval(str_replace('M','',$min))*$multiplier;
		$multiplier=3600;
		$duration += intval(str_replace('H','',$h))*$multiplier;
		$multiplier=86400;
		$duration += intval(str_replace('D','',$d))*$multiplier;
		$multiplier=604800;
		$duration += intval(str_replace('W','',$w))*$multiplier;

		$rawkey=$key."RAW";
		return array($key, $duration, $rawkey, $rawvalue);
	}

	/**
	 * Compare two unix timestamp
	 *
	 * @param array $a
	 * @param array $b
	 * @return integer
	 */
	function comparedates($a, $b)
	{
		if (!array_key_exists('DTSTART',$a) || !array_key_exists('DTSTART',$b) ){
			echo "help<br/>";
		}
		if ($a['DTSTART'] == $b['DTSTART']) return 0;
		return ($a['DTSTART'] > $b['DTSTART'])? +1 : -1;
	}


	// from http://fr3.php.net/manual/en/function.mb-detect-encoding.php#50087
	function is_utf8($string) {

		// From http://w3.org/International/questions/qa-forms-utf-8.html
		$result =  preg_match('%^(?:
         [\x09\x0A\x0D\x20-\x7E]            # ASCII
       | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
       |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
       |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
       |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
       | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
       |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
   )*$%xs', $string);

		return $result;

	} // function is_utf8

	// from http://fr3.php.net/manual/en/function.mb-detect-encoding.php#68607
	function detectUTF8($string)
	{
		return preg_match('%(?:
       [\xC2-\xDF][\x80-\xBF]        # non-overlong 2-byte
       |\xE0[\xA0-\xBF][\x80-\xBF]              # excluding overlongs
       |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}      # straight 3-byte
       |\xED[\x80-\x9F][\x80-\xBF]              # excluding surrogates
       |\xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
       |[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
       |\xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
       )+%xs', $string);
	}


}
