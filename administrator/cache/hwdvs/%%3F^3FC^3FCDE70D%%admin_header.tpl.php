<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:57
         compiled from admin_header.tpl */ ?>

<?php echo '
	<script language="javascript" type="text/javascript">
	<!--
	//Browser Support Code
	function ajaxClearTemplateCache(){

		document.getElementById(\'ajaxmresponse\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/assets/images/processing.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";

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
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById(\'ajaxmresponse\').style.padding = "2px 0 2px 0";
				document.getElementById(\'ajaxmresponse\').innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=cleartemplatecache", true);
		ajaxRequest.send(null);
	}

	//-->
	</script>
	<script language="javascript" type="text/javascript">
	<!--
	//Browser Support Code
	function ajaxClearPlaylistCache(){

		document.getElementById(\'ajaxmresponse\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/assets/images/processing.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";

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
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				document.getElementById(\'ajaxmresponse\').style.padding = "2px 0 2px 0";
				document.getElementById(\'ajaxmresponse\').innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=clearplaylistcache", true);
		ajaxRequest.send(null);
	}

	//-->
	</script>
	<script language="javascript" type="text/javascript">
	<!--
	//Browser Support Code
	function ajaxGenerateMaintenace(){

		document.getElementById(\'ajaxmresponse\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/assets/images/processing.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
		
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
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if (ajaxRequest.readyState == 4){
				document.getElementById(\'ajaxmresponse\').style.padding = "2px 0 2px 0";
				document.getElementById(\'ajaxmresponse\').innerHTML = ajaxRequest.responseText;
			}
		}
		ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/index.php?option=com_hwdvideoshare&maintenance=generateplaylists", true);
		ajaxRequest.send(null);
	}

	//-->
	</script>	
'; ?>

<form action="index.php" method="post" name="adminForm">
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform" style="margin:10px 0;">
    <tr>
      <td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;">
        <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/logo.png" height="47" width="250" alt="Logo" style="float: left;" />
        <font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo $this->_tpl_vars['header_title']; ?>
</font>
      </td>
    </tr>
    <?php if ($this->_tpl_vars['print_search']): ?>
    <tr>
      <td style="width:100%; text-align: right;"><?php echo $this->_tpl_vars['search']; ?>
</td>
    </tr>
    <?php endif; ?>
  </table>

  
  <?php if (! $this->_tpl_vars['block_maintenance']): ?>
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
    <tr>
      <td>
        <div style="float:right;">
          <span style="cursor:pointer;" onclick="ajaxClearTemplateCache();"><img src="components/com_hwdvideoshare/assets/images/icons/bin.png" border="0" alt="" title="" style="padding:1px 5px;vertical-align:bottom;" /><b><?php echo @_HWDVIDS_CTC; ?>
</b></span>
          <span style="cursor:pointer;" onclick="ajaxClearPlaylistCache();"><img src="components/com_hwdvideoshare/assets/images/icons/bin.png" border="0" alt="" title="" style="padding:1px 5px;vertical-align:bottom;" /><b><?php echo @_HWDVIDS_CPC; ?>
</b></span>
          <span style="cursor:pointer;" onclick="ajaxGenerateMaintenace();"><img src="components/com_hwdvideoshare/assets/images/menu/maintenance.png" border="0" alt="" title="" style="padding:1px 5px;vertical-align:bottom;" /><b><?php echo @_HWDVIDS_RGP; ?>
</b></span>
        </div>      
        <div id="ajaxmresponse"></div> 
      </td>
    </tr>
  </table>
  <?php endif; ?>
  