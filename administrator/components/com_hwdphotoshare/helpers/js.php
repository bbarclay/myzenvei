<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
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
 * This class is the HTML generator for hwdphotoshare frontend
 *
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_javascript
{
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
    function confirmDelete()
	{
		$code=null;
		$code.='<script language="javascript" type="text/javascript">
		<!--
			function confirmDelete()
			{
				var agree=confirm("'._HWDPS_INFO_CONFIRMFRONTDEL.'");
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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function confirmEdit()
	{
		$code=null;
		$code.='<script language="javascript" type="text/javascript">
		<!--
			function confirmEdit()
			{
				var agree=confirm("'._HWDPS_INFO_CONFIRMFRONTEDIT.'");
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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function chkNewAlbumForm()
	{
	$c = hwd_ps_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
		function chkNewAlbumForm () {
		var form = document.createalbum;
		if (form.album_name.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOATITLE ?>");
    		form.album_name.focus();
    		return false;
  		} else if (form.album_description.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOADESC ?>");
    		form.album_description.focus();
    		return false;
  		} else if (form.category_id.value == "0") {
    		alert("<?php echo _HWDPS_ALERT_NOACAT ?>");
    		form.category_id.focus();
    		return false;
  		} else {
			document.createalbum.send.disabled=true;
  		}
	}
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
    function chkUpdateAlbumForm()
	{
	$c = hwd_ps_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
		function chkUpdateAlbumForm () {
		var form = document.updatealbum;
		if (form.title.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOATITLE ?>");
    		form.title.focus();
    		return false;
  		} else if (form.description.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOADESC ?>");
    		form.description.focus();
    		return false;
  		} else if (form.category_id.value == "0") {
    		alert("<?php echo _HWDPS_ALERT_NOACAT ?>");
    		form.category_id.focus();
    		return false;
  		} else if (form.tags.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOATAG ?>");
    		form.tags.focus();
    		return false;
  		} else {
			document.updatealbum.send.disabled=true;
  		}
	}
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
    function checkUploadForm()
	{
	$c = hwd_ps_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
		function chkNewAlbumForm () {
		var form = document.videoupload;
		if (form.title.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOTITLE ?>");
    		form.title.focus();
    		return false;
  		} else if (form.description.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NODESC ?>");
    		form.description.focus();
    		return false;
  		} else if (form.category_id.value == "0") {
    		alert("<?php echo _HWDPS_ALERT_NOCAT ?>");
    		form.category_id.focus();
    		return false;
  		} else if (form.tags.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOTAG ?>");
    		form.tags.focus();
    		return false;
  		<?php
  		if ($c->disablecaptcha == 0) {
  			echo "} else if (form.security_code.value == \"\") {";
  			echo "alert(\""._HWDPS_ALERT_NOSECURE."\");";
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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function CheckEditForm()
	{
	$c = hwd_ps_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
		function chkform () {
		videoupload.send.disabled=true
		var form = document.videoupload;
		if (form.title.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOTITLE ?>");
    		form.title.focus();
    		return false;
  		} else if (form.description.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NODESC ?>");
    		form.description.focus();
    		return false;
  		} else if (form.category_id.value == "none") {
    		alert("<?php echo _HWDPS_ALERT_NOCAT ?>");
    		form.category_id.focus();
    		return false;
  		} else if (form.tags.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOTAG ?>");
    		form.tags.focus();
    		return false;
  		<?php
  		if ($c->disablecaptcha == 0) {
  			echo "} else if (form.security_code.value == \"\") {";
  			echo "alert(\""._HWDPS_ALERT_NOSECURE."\");";
  			echo "form.security_code.focus();";
  			echo "return false;";
		}
		?>
  		}
	}
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
    function checkAddGroupForm()
	{
	$c = hwd_ps_Config::get_instance();
	?>
	<script language="javascript" type="text/javascript">
	function chkform () {
		var form = document.creategroup;
		if (form.group_name.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOGNAME ?>");
    		form.group_name.focus();
    		return false;
  		} else if (form.group_description.value == "") {
    		alert("<?php echo _HWDPS_ALERT_NOGDESC ?>");
    		form.group_description.focus();
    		return false;
  		<?php
  		if ($c->disablecaptcha == 0) {
  			echo "} else if (form.security_code.value == \"\") {";
  			echo "alert(\""._HWDPS_ALERT_NOSECURE."\");";
  			echo "form.security_code.focus();";
  			echo "return false;";
		}
		?>
  		}
	}
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
    function ajaxAddToFav($row)
	{
	global $Itemid;
	$c = hwd_ps_Config::get_instance();
	$db = & JFactory::getDBO();
	$my = & JFactory::getUser();
	?>
	<script language='javascript' type='text/javascript'>
	//Browser Support Code
	function ajaxFunctionATF(pid){

		var remfav = '<form name="favourite1" onsubmit="ajaxFunctionRFF('+pid+');return false;" style="display: inline;" action="<?php echo JURI::root(true);?>/index.php?option=com_hwdphotoshare&amp;Itemid=<?php echo $Itemid;?>&amp;task=removefavourite" method="post"><input type="image" src="<?php echo URL_HWDPS_IMAGES;?>icons/rff.png" alt="<?php echo _HWDPS_DETAILS_REMFAV;?>" /></form>';
		var addfav = '<form name="favourite2" onsubmit="ajaxFunctionATF('+pid+');return false;" style="display: inline;" action="<?php echo JURI::root(true);?>/index.php?option=com_hwdphotoshare&amp;Itemid=<?php echo $Itemid;?>&amp;task=favourite" method="post"><input type="image" src="<?php echo URL_HWDPS_IMAGES;?>icons/atf.png" alt="<?php echo _HWDPS_DETAILS_ADDFAV;?>" /></form>';

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
					alert("<?php echo _HWDPS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('ajaxresponse'+pid).style.textAlign = "center";
				document.getElementById('ajaxresponse'+pid).innerHTML = ajaxRequest.responseText;
				document.getElementById('addremfav'+pid).innerHTML = remfav;
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdphotoshare&task=ajax_addfavourite&no_html=1&userid=".$my->id."&photoid="; ?>"+pid, true);
		ajaxRequest.send(null);
	}
	function ajaxFunctionRFF(pid){

		var remfav = '<form name="favourite1" onsubmit="ajaxFunctionRFF('+pid+');return false;" style="display: inline;" action="<?php echo JURI::root(true);?>/index.php?option=com_hwdphotoshare&amp;Itemid=<?php echo $Itemid;?>&amp;task=removefavourite" method="post"><input type="image" src="<?php echo URL_HWDPS_IMAGES;?>icons/rff.png" alt="<?php echo _HWDPS_DETAILS_REMFAV;?>" /></form>';
		var addfav = '<form name="favourite2" onsubmit="ajaxFunctionATF('+pid+');return false;" style="display: inline;" action="<?php echo JURI::root(true);?>/index.php?option=com_hwdphotoshare&amp;Itemid=<?php echo $Itemid;?>&amp;task=favourite" method="post"><input type="image" src="<?php echo URL_HWDPS_IMAGES;?>icons/atf.png" alt="<?php echo _HWDPS_DETAILS_ADDFAV;?>" /></form>';

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
					alert("<?php echo _HWDPS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('ajaxresponse'+pid).style.textAlign = "center";
				document.getElementById('ajaxresponse'+pid).innerHTML = ajaxRequest.responseText;
				document.getElementById('addremfav'+pid).innerHTML = addfav;
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdphotoshare&task=ajax_removefavourite&no_html=1&userid=".$my->id."&photoid="; ?>"+pid, true);
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
    function ajaxAddToGroup($row)
	{
	global $mosConfig_live_site;
	$c = hwd_ps_Config::get_instance();
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
					alert("<?php echo _HWDPS_AJAX_BBROKE; ?>");
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
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdphotoshare&task=ajaxadd2group&no_html=1&videoid=".$row->id."&groupid=" ?>"+ chosen_value , true);
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
	$c = hwd_ps_Config::get_instance();
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
					alert("<?php echo _HWDPS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('hwdpsrb').innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdphotoshare&task=ajax_rate&photoid=".$row->id."&rating="; ?>"+rate, true);
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
    function ajaxReportMedia($row)
	{
	$c = hwd_ps_Config::get_instance();
	$db = & JFactory::getDBO();
	$my = & JFactory::getUser();
	?>
	<script language='javascript' type='text/javascript'>
	//Browser Support Code
	function ajaxFunctionReportPhoto(pid){
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
					alert("<?php echo _HWDPS_AJAX_BBROKE; ?>");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById('ajaxresponse'+pid).style.textAlign = "center";
				document.getElementById('ajaxresponse'+pid).innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "<?php echo JURI::base( true )."/index.php?option=com_hwdphotoshare&task=ajax_reportphoto&no_html=1&userid=".$my->id."&userid=".$my->id."&photoid=";?>"+pid, true);
		ajaxRequest.send(null);
	}

	//-->
	</script>
	<?php }
}
?>