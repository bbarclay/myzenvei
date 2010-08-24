<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * This class is the HTML generator for hwdVideoShare frontend
 *
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_vs_javascript
{
    /**
     *
     */
    function confirmDelete()
	{
		$code=null;
		$code.='<script language="javascript" type="text/javascript">
		<!--
			function confirmDelete()
			{
				var agree=confirm("'._HWDVIDS_INFO_CONFIRMFRONTDEL.'");
				if (agree)
					return true ;
				else
					return false ;
			}
		// -->
		</script>';
		return $code;
	}
    /**
     *
     */
    function confirmEdit()
	{
		$code=null;
		$code.='<script language="javascript" type="text/javascript">
		<!--
			function confirmEdit()
			{
				var agree=confirm("'._HWDVIDS_INFO_CONFIRMFRONTEDIT.'");
				if (agree)
					return true ;
				else
					return false ;
			}
		// -->
		</script>';
		return $code;
	}
    /**
     *
     */
    function disableSubmit()
	{ ?>
	<script language="javascript" type="text/javascript">
		<!--
			function disablesubmit () {

			videoupload.send.disabled=true

			}
		// -->
	</script>
	<?php }
    /**
     *
     */
    function checkUploadForm()
	{
	$c = hwd_vs_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
		function chkform () {
		var form = document.videoupload;
		if (form.title.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOTITLE ?>");
    		form.title.focus();
    		return false;
  		} else if (form.description.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NODESC ?>");
    		form.description.focus();
    		return false;
  		} else if (form.category_id.value == "0") {
    		alert("<?php echo _HWDVIDS_ALERT_NOCAT ?>");
    		form.category_id.focus();
    		return false;
  		} else if (form.tags.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOTAG ?>");
    		form.tags.focus();
    		return false;
  		<?php
  		if ($c->disablecaptcha == 0) {
  			echo "} else if (form.security_code.value == \"\") {";
  			echo "alert(\""._HWDVIDS_ALERT_NOSECURE."\");";
  			echo "form.security_code.focus();";
  			echo "return false;";
		}
		?>
  		} else {
			document.videoupload.send.disabled=true;
  		}
	}
	</script>
	<?php }
    /**
     *
     */
	function checkAddForm()
	{ ?>
	<script language="javascript" type="text/javascript">
		function chkaddform () {
		var form = document.videoadd;
		if (form.embeddump.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOEMBEDCODE ?>");
    		form.embeddump.focus();
    		return false;
  		} else if (form.category_id.value == "0") {
    		alert("<?php echo _HWDVIDS_ALERT_NOCAT ?>");
    		form.category_id.focus();
    		return false;
    	} else {
			document.videoadd.send.disabled=true;
  		}
	}
	</script>
	<?php }
    /**
     *
     */
    function CheckEditForm()
	{
	$c = hwd_vs_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
		function chkform () {
		videoupload.send.disabled=true
		var form = document.videoupload;
		if (form.title.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOTITLE ?>");
    		form.title.focus();
    		return false;
  		} else if (form.description.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NODESC ?>");
    		form.description.focus();
    		return false;
  		} else if (form.category_id.value == "none") {
    		alert("<?php echo _HWDVIDS_ALERT_NOCAT ?>");
    		form.category_id.focus();
    		return false;
  		} else if (form.tags.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOTAG ?>");
    		form.tags.focus();
    		return false;
  		<?php
  		if ($c->disablecaptcha == 0) {
  			echo "} else if (form.security_code.value == \"\") {";
  			echo "alert(\""._HWDVIDS_ALERT_NOSECURE."\");";
  			echo "form.security_code.focus();";
  			echo "return false;";
		}
		?>
  		}
	}
	</script>
	<?php }
    /**
     *
     */
    function checkAddGroupForm()
	{
	$c = hwd_vs_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
	function chkform () {
		var form = document.creategroup;
		if (form.group_name.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOGNAME ?>");
    		form.group_name.focus();
    		return false;
  		} else if (form.group_description.value == "") {
    		alert("<?php echo _HWDVIDS_ALERT_NOGDESC ?>");
    		form.group_description.focus();
    		return false;
  		<?php
  		if ($c->disablecaptcha == 0) {
  			echo "} else if (form.security_code.value == \"\") {";
  			echo "alert(\""._HWDVIDS_ALERT_NOSECURE."\");";
  			echo "form.security_code.focus();";
  			echo "return false;";
		}
		?>
  		}
	}
	</script>
	<?php }
    /**
     *
     */
    function ajaxAddToFav($row, $remfav, $addfav)
	{
	$c = hwd_vs_Config::get_instance();
	$my = & JFactory::getUser();
	?>
	<script language='javascript' type='text/javascript'>
	//Browser Support Code
	function ajaxFunctionATF(){
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("<?php echo _HWDVIDS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('ajaxresponse').style.border = "1px solid #171d25";
				document.getElementById('ajaxresponse').style.overflow = "hidden";
				document.getElementById('ajaxresponse').style.padding = "3px";
				document.getElementById('ajaxresponse').style.margin = "3px 0 3px 0";
				document.getElementById('ajaxresponse').innerHTML = ajaxRequest.responseText;
				document.getElementById('addremfav').innerHTML = '<?php echo $remfav ?>';
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajax_addtofavourites&no_html=1&userid=".$my->id."&videoid=".$row->id ?>", true);
		ajaxRequest.send(null);
	}
	function ajaxFunctionRFF(){
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("<?php echo _HWDVIDS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('ajaxresponse').style.border = "1px solid #171d25";
				document.getElementById('ajaxresponse').style.overflow = "hidden";
				document.getElementById('ajaxresponse').style.padding = "3px";
				document.getElementById('ajaxresponse').style.margin = "3px 0 3px 0";
				document.getElementById('ajaxresponse').innerHTML = ajaxRequest.responseText;
				document.getElementById('addremfav').innerHTML = '<?php echo $addfav ?>';
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajax_removefromfavourites&no_html=1&userid=".$my->id."&videoid=".$row->id ?>", true);
		ajaxRequest.send(null);
	}
	//-->
	</script>
	<?php }
    /**
     *
     */
    function ajaxAddToGroup($row)
	{
	$c = hwd_vs_Config::get_instance();
	?>
	<script language='javascript' type='text/javascript'>
	//Browser Support Code
	function ajaxFunctionA2G(){
		var box = document.add2group.groupid.options;
		var chosen_value = box[box.selectedIndex].value;
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("<?php echo _HWDVIDS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('add2groupresponse').style.border = "1px solid #171d25";
				document.getElementById('add2groupresponse').innerHTML = ajaxRequest.responseText;
				document.getElementById('add2groupresponse').style.margin = "3px 0 3px 0";
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajax_addvideotogroup&no_html=1&videoid=".$row->id."&groupid=" ?>"+ chosen_value , true);
		ajaxRequest.send(null);
	}
	//-->
	</script>
	<?php }
    /**
     *
     */
    function ajaxReportMedia($row)
	{
	$c = hwd_vs_Config::get_instance();
	$my = & JFactory::getUser();
	?>
	<script language='javascript' type='text/javascript'>
	//Browser Support Code
	function ajaxFunctionRV(){
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("<?php echo _HWDVIDS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('ajaxresponse').style.border = "1px solid #171d25";
				document.getElementById('ajaxresponse').style.overflow = "hidden";
				document.getElementById('ajaxresponse').style.padding = "3px";
				document.getElementById('ajaxresponse').style.margin = "3px 0 3px 0";
				document.getElementById('ajaxresponse').innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajax_reportvideo&no_html=1&userid=".$my->id."&videoid=".$row->id."&userid=".$my->id ?>", true);
		ajaxRequest.send(null);
	}

	//-->
	</script>
	<?php }
    /**
     *
     */
    function ajaxRate($row)
	{
	$c = hwd_vs_Config::get_instance();
	$my = & JFactory::getUser();
	$ip = $_SERVER['REMOTE_ADDR'];
	?>
	<script language='javascript' type='text/javascript'>
	//Browser Support Code
	function ajaxFunctionRate(rate){
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("<?php echo _HWDVIDS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('hwdvsrb').innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajax_rate&videoid=".$row->id."&rating="; ?>"+rate, true);
		ajaxRequest.send(null);
	}

	//-->
	</script>
	<?php }
	/**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function ajaxStarbox($row, $rating)
	{
	$c = hwd_vs_Config::get_instance();

	$code = null;
	$code.= "<script language='javascript' type='text/javascript'>
					new Starbox('hwdvid_sb', ".$rating.", { overlay: 'big.png', buttons: 10, rerate: false, indicator: '#{average} rating from #{total} votes', total: ".$row->rating_number_votes.", onRate: function(element, info) {

						var ajaxRequest;  // The variable that makes Ajax possible!

						try{
							// Opera 8.0+, Firefox, Safari
							ajaxRequest = new XMLHttpRequest();
						} catch (e){
							// Internet Explorer Browsers
							try{
								ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
							} catch (e) {
								try{
									ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
								} catch (e){
									// Something went wrong
									alert(\""._HWDVIDS_AJAX_BBROKE."\");
									return false;
								}
							}
						}
						// Create a function that will receive data sent from the server
						ajaxRequest.onreadystatechange = function(){
							if(ajaxRequest.readyState == 4){
								document.getElementById('ajaxresponse').style.border = '1px solid #171d25';
								document.getElementById('ajaxresponse').style.overflow = 'hidden';
								document.getElementById('ajaxresponse').style.padding = '3px';
								document.getElementById('ajaxresponse').style.margin = '3px 0 3px 0';
								document.getElementById('ajaxresponse').innerHTML = ajaxRequest.responseText;
							}
						}
						ajaxRequest.open(\"GET\", \"".JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajaxrate&no_html=1&rating=\" + info.rated + \"&video_id=".$row->id."\", true);
						ajaxRequest.send(null);

					  var indicator = element.down('.indicator');
					  indicator.update('You rated ' + info.rated);
					  window.setTimeout(function() { indicator.update('"._HWDVIDS_AJAX_THANKVOTE."') }, 2000);
					  new Effect.Highlight(indicator);
					}});
		     </script>";

	return $code;
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function ajaxMasuga()
	{
	global $Itemid;
	$c = hwd_vs_Config::get_instance();

	$code=null;
	$code.="<script language='javascript' type='text/javascript'>
	/*
	Page:           rating.js
	Created:        Aug 2006
	Last Mod:       Mar 11 2007
	Handles actions and requests for rating bars.
	---------------------------------------------------------
	ryan masuga, masugadesign.com
	ryan@masugadesign.com
	Licensed under a Creative Commons Attribution 3.0 License.
	http://creativecommons.org/licenses/by/3.0/
	See readme.txt for full credit details.
	--------------------------------------------------------- */

	var xmlhttp
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		  try {
		  xmlhttp=new ActiveXObject(\"Msxml2.XMLHTTP\")
		 } catch (e) {
		  try {
			xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\")
		  } catch (E) {
		   xmlhttp=false
		  }
		 }
		@else
		 xmlhttp=false
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		 try {
		  xmlhttp = new XMLHttpRequest();
		 } catch (e) {
		  xmlhttp=false
		 }
		}
		function myXMLHttpRequest() {
		  var xmlhttplocal;
		  try {
			xmlhttplocal= new ActiveXObject(\"Msxml2.XMLHTTP\")
		 } catch (e) {
		  try {
			xmlhttplocal= new ActiveXObject(\"Microsoft.XMLHTTP\")
		  } catch (E) {
			xmlhttplocal=false;
		  }
		 }

		if (!xmlhttplocal && typeof XMLHttpRequest!='undefined') {
		 try {
		  var xmlhttplocal = new XMLHttpRequest();
		 } catch (e) {
		  var xmlhttplocal=false;
		  alert('couldn\'t create xmlhttp object');
		 }
		}
		return(xmlhttplocal);
	}

	function sndReq(vote,id_num,ip_num,units) {
		var theUL = document.getElementById('unit_ul'+id_num); // the UL

		// switch UL with a loading div
		theUL.innerHTML = '<div class=\"loading\"></div>';

		xmlhttp.open('get', '".JURI::base( true )."/index.php?option=com_hwdvideoshare&task=ajaxratedb&Itemid=".$Itemid."&j='+vote+'&q='+id_num+'&t='+ip_num+'&c='+units);
		xmlhttp.onreadystatechange = handleResponse;
		xmlhttp.send(null);

	}

	function handleResponse() {
	  if(xmlhttp.readyState == 4){
			if (xmlhttp.status == 200){

			var response = xmlhttp.responseText;
			var update = new Array();

			if(response.indexOf('|') != -1) {
				update = response.split('|');
				changeText(update[0], update[1]);
			}
			}
		}
	}

	function changeText( div2show, text ) {
		// Detect Browser
		var IE = (document.all) ? 1 : 0;
		var DOM = 0;
		if (parseInt(navigator.appVersion) >=5) {DOM=1};

		// Grab the content from the requested \"div\" and show it in the \"container\"
		if (DOM) {
		document.getElementById('ajaxratemasuga').innerHTML = text;
		}  else if(IE) {
			document.all['ajaxratemasuga'].innerHTML = text;
		}
	}

	/* =============================================================== */


	var ratingAction = {
			'a.hwdvsmrater' : function(element){
				element.onclick = function(){

				var parameterString = this.href.replace(/.*\?(.*)/, \"$1\"); // onclick=\"sndReq('j=1&q=2&t=127.0.0.1&c=5');
				var parameterTokens = parameterString.split(\"&\"); // onclick=\"sndReq('j=1,q=2,t=127.0.0.1,c=5');
				var parameterList = new Array();

				for (j = 0; j < parameterTokens.length; j++) {
					var parameterName = parameterTokens[j].replace(/(.*)=.*/, \"$1\"); // j
					var parameterValue = parameterTokens[j].replace(/.*=(.*)/, \"$1\"); // 1
					parameterList[parameterName] = parameterValue;
				}
				var theratingID = parameterList['q'];
				var theVote = parameterList['j'];
				var theuserIP = parameterList['t'];
				var theunits = parameterList['c'];

				//for testing alert('sndReq('+theVote+','+theratingID+','+theuserIP+','+theunits+')'); return false;
				sndReq(theVote,theratingID,theuserIP,theunits); return false;
				}
			}

		};

	Behaviour.register(ratingAction);
	</script>";
	return $code;

	}
}
?>